<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\Productos;
use App\Models\Modulos\Proveedor;
use App\Models\Modulos\ComprasProductos;
use App\Models\Modulos\VentasProductos;
class Stock extends Component
{
    public $cantidadProducto=0;
    public $stock=0;
    public $totalCantidad=0;
    public $totalCantidadv=0;
    public function obtenerStock($id)
    {
        $this->totalCantidad = ComprasProductos::where('producto_id', $id)
        ->where('estado', 'activo')
        ->sum('cantidad_inicial');

        $this->totalCantidadv = VentasProductos::where('producto_id', $id)
        ->where('estado', 'activo')
        ->sum('cantidad');

        $producto = Productos::find($id);
        $this->cantidadProducto = $producto ? $producto->cantidad_inicial : 0;
        $this->stock=($this->totalCantidad)+($this->cantidadProducto)-($this->totalCantidadv);
        return $this->stock;

    }
    public function aumentarStock($id,$Cantidad)
    {
        $producto = Productos::find($id);
        $producto->stock = ($this->stock)+$Cantidad;
        $producto->save();
    }
    public function disminuirStock($id,$Cantidad)
    {
        $producto = Productos::find($id);
        $producto->stock = ($this->stock)-$Cantidad;
        $producto->save();
    }
    public function render()
    {
        return view('livewire.modulos-v.stock');
    }
}
