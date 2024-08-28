<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiCosto;
use Livewire\Component;
use Livewire\WithPagination;
class CostoIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $costo;
    public $tipo_costo;
    public $deposito;
    public $observacion_costo;
  

    public function cancelar(){
        $this->reset([
            'costo',
            'deposito',
            'tipo_costo',
            'observacion_costo',
        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

  //BORRAR
    public function delete(SiadiCosto $id_costo): void
    {
        $id_costo->estado_costo = 'ELIMINAR';
        $id_costo->update();

    
          
           
    }

//CREAR

    public function rules()
    {
        return [
            'costo' => 'required|numeric|digits:7',
            'deposito' => 'required',
            'tipo_costo' => 'required',
            'observacion_costo' => 'required',
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_costo()
      {        
        $this->validate();
       
        $guardar_costo = new SiadiCosto();
        $guardar_costo->deposito         = $this->deposito;
        $guardar_costo->costo_siado_costo         = $this->costo;
        $guardar_costo->tipo_costo         = $this->tipo_costo;
        $guardar_costo->observacion_costo         = $this->observacion_costo;
        $guardar_costo->save();   

        $this->reset([
            'costo' ,
            'deposito' ,
            'observacion_costo' ,
        ]);
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','El costo se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $costo2;
      public $id_costo_actual;
      public $deposito2;
      public $observacion_costo2;
      public $tipo_costo2;
      public function editar_costo(SiadiCosto $id_costo){

        $this->costo2 =$id_costo->costo_siado_costo;
        $this->tipo_costo2 =$id_costo->tipo_costo;

        $this->deposito2 =$id_costo->deposito;
        $this->observacion_costo2 =$id_costo->observacion_costo;
        $this->id_costo_actual =$id_costo->id_costo ;

            }
            public function cancelarEditar() {
                $this->reset([
                    'costo2',
                    'id_costo_actual',
                    'deposito2' ,
                    'observacion_costo2' ,
                    'tipo_costo2' ,
                        ]);
                        
            
            }  
            public function guardarEditadocosto(){
                $this->validate([
                    
                    'costo2' => 'required|numeric|digits:7',
                    'deposito2' => 'required',
                    'tipo_costo2' => 'required',
                    'observacion_costo2' => 'required',
                ]);

 $siadi_costo = SiadiCosto::find($this->id_costo_actual);
    
        $siadi_costo->fill([
            
            'deposito'          => $this->deposito2,
            'costo_siado_costo'          => $this->costo2,
            'observacion_costo'          => $this->observacion_costo2,
            'tipo_costo'          => $this->tipo_costo2,
            
            
        ]);
        $siadi_costo->save();
    
        $this->reset([
            
           'costo2',
           'id_costo_actual',
           'deposito2' ,
           'observacion_costo2' ,      
           'tipo_costo2' ,      
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO
            public function cambiar_estado_costo($id_costo)
            {
                // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
                $costo_estado = SiadiCosto::find($id_costo);
        
                if ($costo_estado) {
                    $costo_estado->estado_costo = $costo_estado->estado_costo === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
                    $costo_estado->save();
                }
        
                // Emitir evento para notificar que el estado ha cambiado (opcional)
                $this->emit('alert','Se cambio el estado de la convocatoria con éxito');
        
            }
    public function render()
    {
        $costos = SiadiCosto::where('estado_costo', '<>', 'ELIMINAR')
        ->where(function ($query) {
        $searchTerm = '%' . $this->search . '%';       
        $query->orWhere('deposito', 'LIKE', $searchTerm)
                ->orWhere('costo_siado_costo', 'LIKE', $searchTerm)
                ->orWhere('observacion_costo', 'LIKE', $searchTerm);
        })
        ->latest('id_costo')
        ->paginate(5);
        return view('livewire.administracion-modulos.costo-index',compact('costos'));
    }
}