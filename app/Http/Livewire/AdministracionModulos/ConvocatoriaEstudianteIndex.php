<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiConvocartoriaEstudiante;
use Livewire\Component;
use Livewire\WithPagination;
class ConvocatoriaEstudianteIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $convocartoria_estudiante;
  

    public function cancelar(){
        $this->reset([

        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

  //BORRAR
    public function delete(SiadiConvocartoriaEstudiante $id_convocartoria_estudiante): void
    {
        $id_convocartoria_estudiante->estado_convocatoria_estudiante = 'ELIMINAR';
        $id_convocartoria_estudiante->update();

    
          
           
    }

//CREAR

    public function rules()
    {
        return [
            'convocartoria_estudiante' => 'required',
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_convocartoria_estudiante()
      {        
        $this->validate();
       
        $guardar_convocartoria_estudiante = new SiadiConvocartoriaEstudiante();
        $guardar_convocartoria_estudiante->nombre_convocatoria_estudiante         = $this->convocartoria_estudiante;
        $guardar_convocartoria_estudiante->save();   

        $this->reset([

        ]);
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','El convocartoria_estudiante se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $convocartoria_estudiante2;
      public $id_convocartoria_estudiante_actual;
      public function editar_convocartoria_estudiante(SiadiConvocartoriaEstudiante $id_convocartoria_estudiante){

        $this->convocartoria_estudiante2 =$id_convocartoria_estudiante->nombre_convocatoria_estudiante;
        $this->id_convocartoria_estudiante_actual =$id_convocartoria_estudiante->id_convocartoria_estudiante ;
            }
            public function cancelarEditar() {
                $this->reset([
                    'convocartoria_estudiante2',
                    'id_convocartoria_estudiante_actual',
                    
                        ]);
                        
            
            }  
            public function guardarEditadoconvocartoria_estudiante(){
                $this->validate([
                    
                    'convocartoria_estudiante2' => 'required',
                    
                ]);

 $siadi_convocartoria_estudiante = SiadiConvocartoriaEstudiante::find($this->id_convocartoria_estudiante_actual);
    
        $siadi_convocartoria_estudiante->fill([
            
            'nombre_convocatoria_estudiante'          => $this->convocartoria_estudiante2,
            
            
        ]);
        $siadi_convocartoria_estudiante->save();
    
        $this->reset([
            
           'convocartoria_estudiante2',
           'id_convocartoria_estudiante_actual',
                    
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO
            public function cambiar_estado_convocatoria_estudiante($id_convocaoria_estudiant3e)
            {
                // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
                $convocatoria_estudiante_estado = SiadiConvocartoriaEstudiante::find($id_convocaoria_estudiant3e);
        
                if ($convocatoria_estudiante_estado) {
                    $convocatoria_estudiante_estado->estado_convocatoria_estudiante = $convocatoria_estudiante_estado->estado_convocatoria_estudiante === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
                    $convocatoria_estudiante_estado->save();
                }
        
                // Emitir evento para notificar que el estado ha cambiado (opcional)
                $this->emit('alert','Se cambio el estado de la convocatoria con éxito');
        
            }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $convocartoria_estudiantes = SiadiConvocartoriaEstudiante::where('estado_convocatoria_estudiante','<>', 'ELIMINAR')
        ->where(function ($query) use ($search) {
            $query->where('nombre_convocatoria_estudiante', 'LIKE', $search)
           ;
    })
        
        ->latest('id_convocartoria_estudiante')
        ->paginate(5);

        return view('livewire.administracion-modulos.convocatoria-estudiante-index',compact('convocartoria_estudiantes'));
    }
}
