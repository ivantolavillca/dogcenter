<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\TipoHistorial;
use Livewire\WithPagination;

class TiposHistorial extends Component
{
     // todo para la paginacion y otras variables adicionales 
     protected $paginationTheme = 'bootstrap';
     protected $listeners = [
         'Eliminartipohistorial'
     ];
     use WithPagination;
     public $operation;
     // inicializar variables de los modales 
     public $search;
     public $Nombretipohistorial;
     public $Idtipohistorial;
 
     // crear las funciones de validacion 
     public function rules()
     {
         if ($this->operation === 'tipohistorialnuevo') {
             return $this->rulesT_Historial();
         }
         elseif($this->operation === 'edithistorial')
         {
             return $this->rulesT_Historial();
         }
         return array_merge($this->rulesT_Historial());
     }
     public function rulesT_Historial()
     {
         return [
             'Nombretipohistorial' => 'required|string|max:125',
         ];
     }

     public function limpiartipohistorial()
     {
         $this->reset(['Nombretipohistorial','Idtipohistorial']);
         $this->resetValidation();
     }
      //todo para camibar el estado 
    
    public function CambiarEstado($id)
    {
        $thgis = TipoHistorial::find($id);
        if($thgis->estado=='activo')
        {
            $thgis->estado = 'inactivo';
            $thgis->save();
            $this->emit('alert', 'Cuenta desactivada');
        }elseif($thgis->estado=='inactivo')
        {
            $thgis->estado = 'activo';
            $thgis->save();
            $this->emit('alert', 'Cuenta activa');
        }

    }
     public function GuardarHistorial()
     {
         $this->Guardarbdtihistoriales();
         $this->emit('alert', 'Nuevo Registro Guardado');
         $this->limpiartipohistorial();
         $this->emit('cerrarmodaltiphisto');
     }
     public function Guardarbdtihistoriales()
     {
          // asignamoes un valor a la variable operation
          $this->operation='tipohistorialnuevo';
          $this->validate();
         TipoHistorial::create([
             'nombre' => $this->Nombretipohistorial,
             'estado' => 'activo',
         ]);
     }
     // ------------------------------- todo para editarr usar mismo modal para crear 
      // abrimos el modal con los datos cargados
      public function Editartipohist($id)
      {
         $tipohis = TipoHistorial::find($id);
         $this->Idtipohistorial = $tipohis->id;
         $this->Nombretipohistorial = $tipohis->nombre;
         $this->emit('abrirmodalhisto');
      }
      // funcion del boton guardar editar para modificar la bd
      public function EditarTipodeHistorial()
      {
         // asignamoes un valor a la variable operation
         $this->operation='edithistorial';
         $this->validate();
 
         $tiphisto = TipoHistorial::find($this->Idtipohistorial);
         $tiphisto->update([
             'nombre' => $this->Nombretipohistorial,
         ]);
         $this->limpiartipohistorial();
         $this->emit('alert', 'REGISTRO EDITADO');
         $this->emit('cerrarmodaltiphisto');
      }
      // todo para eliminar lo que llega 
      public function Eliminartipohistorial($id)
      {
         $tiphisto = TipoHistorial::find($id);
         if ($tiphisto) {
             $tiphisto->estado = 'eliminado';
             $tiphisto->save();
         }
      }
      
     public function render()
     {
         $tipohistoriales = TipoHistorial::where('estado', '<>', 'eliminado')
             ->where(function ($query) {
                 $searchTerm = '%' . $this->search . '%';
                 $query->orWhere('nombre', 'LIKE', $searchTerm);
             })
             ->orderBy('id', 'desc')
             ->paginate(10);
         return view('livewire.modulos-v.tipos-historial', compact('tipohistoriales'));
     }
     public function updatingSearch()
     {
         $this->resetPage();
     }
}
