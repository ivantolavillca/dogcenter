<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\ComprasProductos;

class HistoriCompra extends Component
{
    public $idpro;
    public $searchcompra;
    protected $listeners = [
        'EliminarCompraHistorial'
    ];
    public function EliminarCompraHistorial($id)
    {
        $compras = ComprasProductos::find($id);
        if ($compras) {
            $compras->estado = 'eliminado';
            $compras->save();
        }
    }

    public function render()
    {
        $compras = ComprasProductos::where('estado', '<>', 'eliminado')
            ->where('producto_id', $this->idpro)
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchcompra . '%';
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.modulos-v.histori-compra', compact('compras'));
    }
}
