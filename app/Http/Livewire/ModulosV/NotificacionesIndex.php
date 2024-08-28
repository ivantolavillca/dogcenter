<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Fichas;
use Livewire\Component;
use App\Events\FichaStatusUpdated;
use Illuminate\Support\Facades\Auth;

class NotificacionesIndex extends Component
{
    protected $listeners = ['mensajeria','fichaActualizada','eliminarnotificacion','AtenderFicha'];
    public function mensajeria()
    {
        if (Auth::user()->roles[0]->name=='Doctor') {
            $this->emit('playSound');
        }
       
    }
    public function fichaActualizada()
    {
    }
    public function llamarnotificacion($id)
    {
    
    $userId = Auth::id();
    //dd($userId);
    $fich = Fichas::find($id);
       $fichaSta = new FichaStatusUpdated();
        if ($fich->estado === 'activo') {
            $fich->id_usuario = $userId;
            $fich->estado = 'llamar';
            
            $fich->save();
            event($fichaSta);
          // $this->emit('alert', 'Cuenta desactivada');
        } 
    }

    public function CortarFicha($id)
    {
        $fich = Fichas::find($id);
       $fichaSta = new FichaStatusUpdated();
        if ($fich->estado  === 'llamar') {
            $fich->estado = 'activo';
            $fich->save();
            event($fichaSta);
           // $this->emit('alert', 'Cuenta activa');
        }
    }
    public function eliminarnotificacion($id)
    {
        $registro = Fichas::find($id);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
           $fichaSta = new FichaStatusUpdated();
           event($fichaSta);
            $this->emit('fichaEliminada', $id);
        }
    }
    public function AtenderFicha($id)
    {
        $userId = Auth::id();
        $registro = Fichas::find($id);
        if ($registro) {
            $registro->id_usuario = $userId;
            $registro->estado = 'atendido';
            $registro->save();
            $fichaSta = new FichaStatusUpdated();
            event($fichaSta);
            $this->emit('fichaEliminada', $id);
        }
    }

    public function reporteunicoregistro($id,$idf)
    {
        $registro = Fichas::find($idf);
        if ($registro) {
            $registro->id_usuario = Auth::id();
            $registro->estado = 'atendido';
            $registro->save();
            $fichaSta = new FichaStatusUpdated();
            event($fichaSta);
        }

        $url = route('ClienteUnico2', [
            'id' => $id
        ]);
         $this->emit('openNewTabssunic', ['url' => $url]);
    }


    public function render()
    {
        $fichas = Fichas::where('estado', '<>', 'eliminado')
        ->where('estado', '<>', 'atendido')
        ->orderBy('id', 'desc')
        // ->take(7)
        ->get();
        return view('livewire.modulos-v.notificaciones-index',compact('fichas'));
    }
}
