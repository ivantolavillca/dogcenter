<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Modulos\Fichas;

class FichaIndex2 extends Component
{
   /* protected $listeners = ['fichaActualizada22','EliminarFicha'];

    public function fichaActualizada22()
    {
        // Emitir un evento Livewire
        $this->emit('fichaActualizada22'); // Emitir el evento 'fichaActualizada22' sin ningún dato adicional
    }
    
    public function EliminarFicha($id)
    {
        dd("hola esto fue eliminado = ",$id);
    }
    public function borrardatosss($id)
    {
        dd("hola esto fue eliminado = ",$id);
    }
    public function atender()
    {
        dd("hola esto");
        $this->emit('alert',"hola como estas");
    }

    public function render()
    {
       $fichas = Fichas::where('estado', '=', 'activo')
                        ->orderBy('id', 'asc')
                        ->get(); // Obtener los resultados de la consulta
        return view('livewire.modulos-v.salidaFicha', compact('fichas'));
    }*/
}
