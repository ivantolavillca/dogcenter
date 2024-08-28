<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AdministracionModulos\SiadiSede;
use Livewire\WithPagination;

class Recurso extends Component
{
    use WithPagination; # paginación
    protected $paginationTheme = 'bootstrap'; # usar para decorar los links de paginacion

    public function render()
    {
        $sedes = SiadiSede::where('estado_siadi_sede','<>','ELIMINAR')
            /* ->where(function($query){
                $query->where('direccion', 'LIKE', "%$this->search%");
            }) */
            ->latest('id_siadi_sede')
            ->paginate(5);
        return view('livewire.recurso', [
            'sedes' => $sedes
        ]);
    }

    public $direccion;
    public $sede;
    public function abrir(){
        $this->emit("abrirFormulario");
    }

    public function cancelar(){
        
    }

    public function guardar_direccion(){
        
    }
}
