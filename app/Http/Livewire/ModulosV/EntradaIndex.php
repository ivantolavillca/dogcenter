<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Clientes;
use App\Models\Modulos\Compras;
use App\Models\Modulos\Productos;
use App\Models\Modulos\Proveedor;
use App\Models\Modulos\ComprasProductos;
use App\Models\Modulos\Ventas;
use App\Models\Modulos\VentasProductos;
use Livewire\WithPagination;
class EntradaIndex extends Stock
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $searchProducto;
    public $stock;
    public $data;
    public $Idventa;
    public $productoID;
    public $Nombreproducto;
    public $Descripcion;
    public $Nombrecliente;
    public $Cantidad;
    public $Precio;
    public $operation;
    public $precio_opcion = 'default';
    public $nuevo_precio;
    public $totalDinero;
  
  

    public function openModalVentas($id_ven)
    {
       $this-> Idventa= $id_ven;
       $this->data = ComprasProductos::where('id_compra', $id_ven)->get();
       $this->totalDinero= Compras::find($id_ven)->total;
       $this->emit("abrirmodalcompras");

    }
    public function LimpiarmodalTabla()
    {
       $this->emit("cerrarmodalcompras");
    }

    public function limpiarmodalcompra()
    {
        $this->reset(['productoID', 'Nombreproducto', 'Descripcion', 'Nombrecliente', 'Cantidad', 'Precio', 'nuevo_precio', 'operation']);
        $this->limpiarmodalbusqueda();
        $this->resetValidation();
    }
    public function rules()
    {
        if ($this->operation === 'compracNuevo') {
            return $this->rulescompra();
        } elseif ($this->operation === 'precio2') {
            return $this->rulescompracosto2();
        } elseif ($this->operation === 'precio2') {
            return $this->rulescompracosto2();
        }
        return array_merge($this->rulescompracosto2());
    }
    public function rulescompra()
    {
        return [
            'Nombreproducto' => 'required|string|max:125',
            'Descripcion' => 'required|string|max:125',
            'Cantidad' =>  [
                'required',
                'numeric',
                'regex:/^\d{1,10}(\.\d{1,2})?$/', // Máximo 10 dígitos, con opción de hasta 2 decimales
            ],

        ];
    }
    public function rulescompracosto2()
    {
        return [
            'nuevo_precio' => [
                'required',
                'nullable',
                'numeric',
                'regex:/^\d{1,10}(\.\d{1,2})?$/', // Máximo 10 dígitos, con opción de hasta 2 decimales
            ],
        ];
    }

    public function GuardarCompra()
    {
        $this->Guardarcompras();
        $this->limpiarmodalcompra();
        $this->emit('cerrarmodalcompra');
    }
    public function Guardarcompras()
    {
        $this->Precio = Productos::find($this->productoID)->precio;
        $Nombrecid=null;
        $des = "";
        if($this->Nombrecliente)
        {
            $Nombrecid=$this->Nombrecliente;
        }
        else
        {
            $des=$this->SearchCliente;
        }

        if ($this->precio_opcion == "custom") {
            $this->operation = "precio2";
            $this->Precio = $this->nuevo_precio;
            // dd($this->Precio);
        } else {
            // Asignamos un valor a la variable operation
            $this->operation = 'compracNuevo';
        }
        if($this->Cantidad <1 || $this->Cantidad > $this->stock)
        {
            $this->emit('alerterror','Error en el Stock');
        }
        else{
            $this->validate();
            VentasProductos::create([
                'producto_id' =>  $this->productoID,
                'cliente_id' => $Nombrecid,
                'descripcion' => $des.": ".$this->Descripcion,
                'cantidad' => $this->Cantidad,
                'precio' => $this->Precio,
                'estado' => 'activo',
            ]);
            $this->disminuirStock($this->productoID, $this->Cantidad);
            $this->emit('alert', 'Nuevo Registro Guardado');
           // $this->limpiarmodalcompra();
        }
    
    }
    public function abrirModalCompra($id)
    {

        //-------------------------- asignar datos al modal------------------------------------
        $this->stock = $this->obtenerStock($id);
        $producto = Productos::findOrFail($id);
        $this->productoID = $producto->id;
        $this->Nombreproducto = $producto->nombre;
        $this->emit('abrirmodalcompra');
    }
    public $SearchCliente;
    public $bloque=false;
    public function CargarDatosNombreCi($id)
    {
        $clien = Clientes::findOrFail($id);
        $this->Nombrecliente=$clien->id;
        $this->SearchCliente = $clien->nombre." ".$clien->apellidos;
        $this->bloque=true;
    }
    public function limpiarmodalbusqueda()
    {

        $this->reset(['SearchCliente','Nombrecliente']);
        $this->bloque=false;
    }
  


    public function render()
    {
        $Compras = Compras::where('estado', '=', 'activo')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchProducto . '%';
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $productos = Productos::where('estado', '=', 'activo')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchProducto . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $clientes = Clientes::where('estado', '=', 'activo')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchCliente . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('apellidos', 'LIKE', $searchTerm);
                $query->orWhere('ci', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        //$proveedores = Proveedor::where('estado', '==', 'activo')->get();
        //$clientes = Clientes::get();
        return view('livewire.modulos-v.entrada-index', compact('productos', 'clientes','Compras'));
    }
}
