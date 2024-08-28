<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cajas;
use Livewire\Component;
use Livewire\WithPagination;

class CobrosCajasIndex extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $fechabusqueda;

    public function ResetFecha(){
        $this->reset('fechabusqueda');
    }
    public function render()
    {
        
        $query1 = Cajas::orderBy('created_at','desc');

        if ($this->fechabusqueda != null) {
            $query1->whereDate('created_at', '=', $this->fechabusqueda);
        }

        

        $cajas = $query1->paginate(4, ['*'], 'cobros_page');

       # $cajas=Cajas::orderBy('created_at','desc')->paginate(5);

        return view('livewire.modulos-v.cobros-cajas-index',compact('cajas'));
    }
}
