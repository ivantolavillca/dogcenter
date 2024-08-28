<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiTipoEstudiante;
use Livewire\Component;
use Livewire\WithPagination;
class TipoEstudianteIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $tipo_estudiante;
  

    public function cancelar(){
        $this->reset([
'tipo_estudiante'
        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

    public function cambiar_estado_tipo_estudiante($id_tipo_estudiante)
    {
        // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
        $tipo_estudiante_estado = SiadiTipoEstudiante::find($id_tipo_estudiante);

        if ($tipo_estudiante_estado) {
            $tipo_estudiante_estado->estado_tipo_estudiante = $tipo_estudiante_estado->estado_tipo_estudiante === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $tipo_estudiante_estado->save();
        }

        // Emitir evento para notificar que el estado ha cambiado (opcional)
        $this->emit('alert','Se cambio el estado de la convocatoria con éxito');

    }
  //BORRAR
    public function delete(SiadiTipoEstudiante $id_tipo_estudiante): void
    {
        $id_tipo_estudiante->estado_tipo_estudiante = 'ELIMINAR';
        $id_tipo_estudiante->update();

    
          
           
    }

//CREAR

    public function rules()
    {
        return [
            'tipo_estudiante' => 'required',
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_tipo_estudiante()
      {        
        $this->validate();
       
        $guardar_tipo_estudiante = new SiadiTipoEstudiante();
        $guardar_tipo_estudiante->nombre_tipo_estudiante         = $this->tipo_estudiante;
        $guardar_tipo_estudiante->save();   

        $this->reset([
'tipo_estudiante'
        ]);
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','El tipo de estudiante se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $tipo_estudiante2;
      public $id_tipo_estudiante_actual;
      public function editar_tipo_estudiante(SiadiTipoEstudiante $id_tipo_estudiante){

        $this->tipo_estudiante2 =$id_tipo_estudiante->nombre_tipo_estudiante;
        $this->id_tipo_estudiante_actual =$id_tipo_estudiante->id_tipo_estudiante ;
            }
            public function cancelarEditar() {
                $this->reset([
                    'tipo_estudiante2',
                    'id_tipo_estudiante_actual',
                    
                        ]);
                        
            
            }  
            public function guardarEditadotipo_estudiante(){
                $this->validate([
                    
                    'tipo_estudiante2' => 'required',
                    
                ]);

 $siadi_gestion = SiadiTipoEstudiante::find($this->id_tipo_estudiante_actual);
    
        $siadi_gestion->fill([
            
            'nombre_tipo_estudiante'          => $this->tipo_estudiante2,
            
            
        ]);
        $siadi_gestion->save();
    
        $this->reset([
            
           'tipo_estudiante2',
           'id_tipo_estudiante_actual',
                    
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO
            public function render()
            {
                $search = '%' . $this->search . '%';
                $tipo_estudiantes = SiadiTipoEstudiante::where('estado_tipo_estudiante','<>', 'ELIMINAR')
                ->where(function ($query) use ($search) {
                    $query->where('nombre_tipo_estudiante', 'LIKE', $search) ;
            })
                
                ->latest('id_tipo_estudiante')
                ->paginate(5);
                return view('livewire.administracion-modulos.tipo-estudiante-index',compact('tipo_estudiantes'));
            }
}
