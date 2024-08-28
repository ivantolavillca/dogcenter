<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\ComprasProductos;
use App\Models\Modulos\VentasProductos;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\Productos;
class HistoriVenta extends Salidas
{
    public $prov;
    //------------------------------------------------
    public $idpro;
    public $Idventa;
    public $productoID;
    public $Nombreproducto;
    public $Descripcion;
    public $Nombrecliente;
    public $Cantidad;
    public $Precio;
    public $operation;
    public $searchcompra;
    protected $listeners = [
        'EliminarVentaHistorial'
    ];
    public function EliminarVentaHistorial($id)
    {
        $compras = VentasProductos::find($id);
        if ($compras) {
            $compras->estado = 'eliminado';
            $compras->save();
        }
    }
    
    // todo para abrir el modal
    public function editarhistory($id)
    {
       
        $ventas = VentasProductos::find($id);
        $this->productoID=$ventas->producto_id;
        $this->stock=$this->obtenerStock($this->productoID);
        $this->Idventa = $ventas->id;
        $this->Nombreproducto = $ventas->produc_ventas->nombre;
        $this->Nombrecliente = $ventas->cliente_id ;
        $this->Descripcion = $ventas->descripcion ;
        $this->Cantidad = $ventas->cantidad;
        $this->Precio = $ventas->precio;
        $this->emit('abrirmodalcompra');
    }
    public function EditarVenta()
     {
        // asignamoes un valor a la variable operation
        $this->operation='compraEditar';
        $this->validate();
        $venta = VentasProductos::find($this->Idventa);
        $venta->update([
            'producto_id' =>  $this->productoID,
            'cliente_id' => $this->Nombrecliente,
            'descripcion' => $this->Descripcion,
            'cantidad' => $this->Cantidad,
            'precio' => $this->Precio,
        ]);
      // ------------ actualizar el estock en la tabla ---- productos 
        $produ = Productos::find($this->productoID);
        $this->stock=$this->obtenerStock($this->productoID);
        $produ->update([
            'stock' => $this->stock,
        ]);
      // ------------ actualizar el estock en la tabla ---- productos      
        $this->limpiarmodalcompra();
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalcompra');

     }

    public function render()
    {
        $ventas = VentasProductos::where('estado', '<>', 'eliminado')
            ->where('producto_id', $this->idpro)
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchcompra . '%';
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $clientes = Clientes::get();
        return view('livewire.modulos-v.histori-venta', compact('ventas','clientes'));
    }
}
