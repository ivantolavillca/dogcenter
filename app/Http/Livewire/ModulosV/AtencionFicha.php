<?php

namespace App\Http\Livewire\ModulosV;
use Livewire\Component;
use App\Models\Modulos\Fichas;
class AtencionFicha extends Component
{
   public $SearchFicha;
    protected $listeners = ['fichaActualizada'];
    public function fichaActualizada()
    {
        // aciones a realizar 
    }
    public function GuardarCasos()
    {
        $this->emit("alert","hola como estas");
    }
    public function render()
    {
        $fichas = Fichas::where('estado', '<>', 'eliminado')
            ->where('estado', '<>', 'atendido')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchFicha . '%';
                $query->orWhere('id', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'asc')
            ->paginate(1000);
        return view('livewire.modulos-v.atencion-ficha',compact('fichas'));
        
    }
}
