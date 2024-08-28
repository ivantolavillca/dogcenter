<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiGestion;
use Livewire\Component;
use Livewire\WithPagination;

class GestionIndex extends Component
{

    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $gestion;
    public $gestion2;




    public function cambiar_estado_gestion($id_gestion)
    {
        // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
        $estion_estado = SiadiGestion::find($id_gestion);

        if ($estion_estado) {
            $estion_estado->estado_gestion = $estion_estado->estado_gestion === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $estion_estado->save();
        }

        // Emitir evento para notificar que el estado ha cambiado (opcional)
        $this->emit('alert','Se cambio el estado de la convocatoria con éxito');

    }
    public function mount()
    {
       
        $this->gestion = date('Y');

    }
    public function cancelar(){
        $this->gestion = date('Y');
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }


   

    public function delete(SiadiGestion $id_gestion): void
    {
        $id_gestion->estado_gestion = 'ELIMINAR';
        $id_gestion->update();

    
          
           
    }

    public function rules()
    {
        return [
            'gestion' => 'required|numeric|digits:4',
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_gestion()
      {        
        $this->validate();
       
        $guardar_gestion = new SiadiGestion();
        $guardar_gestion->nombre_gestion         = $this->gestion;
        $guardar_gestion->save();   
        $this->cancelar();
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','La gestión se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $id_gestion_actual;
      public function editar_gestion(SiadiGestion $id_gestion){

        $this->gestion2 =$id_gestion->nombre_gestion;
        $this->id_gestion_actual =$id_gestion->id_gestion ;
            }
            public function cancelarEditar() {
                $this->reset([
                    'gestion2',
                    'id_gestion_actual',
                ]);
                        
            
            }  
            public function guardarEditadoGestion(){
                $this->validate([
                    
                    'gestion2' => 'required|numeric|digits:4',
                    
                ]);

 $siadi_gestion = SiadiGestion::find($this->id_gestion_actual);
    
        $siadi_gestion->fill([
            
            'nombre_gestion'          => $this->gestion2,
            
            
        ]);
        $siadi_gestion->save();
    
        $this->reset([
            
           'gestion2',
           'id_gestion_actual',
                    
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            public function render()
            {   
                $search = '%' . $this->search . '%';

                $gestiones = SiadiGestion::where('estado_gestion', '<>', 'ELIMINAR')
                ->where(function ($query) use ($search) {
                $query->where('nombre_gestion', 'LIKE', $search)
               ;
        })
                ->latest('id_gestion')
                ->paginate(5);
                return view('livewire.administracion-modulos.gestion-index',compact('gestiones'));
            }
    
}
