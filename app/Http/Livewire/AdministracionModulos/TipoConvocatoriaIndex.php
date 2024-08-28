<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiConvocartoriaEstudiante;
use App\Models\AdministracionModulos\SiadiCosto;
use App\Models\AdministracionModulos\SiadiTipoConvocatoria;
use App\Models\AdministracionModulos\SiadiTipoEstudiante;
use Livewire\Component;
use Livewire\WithPagination;
class TipoConvocatoriaIndex extends Component
{


    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $convocatoria_estudiante;
    public $tipo_estudiante;
    public $costo;
  

    public function cancelar(){
        $this->reset([
'convocatoria_estudiante',
'tipo_estudiante','costo'
        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

  //BORRAR
    public function delete(SiadiTipoConvocatoria $id_tipo_convocatoria): void
    {
        $id_tipo_convocatoria->estado_tipo_convocatoria = 'ELIMINAR';
        $id_tipo_convocatoria->update();

    
          
           
    }

//CREAR

    public function rules()
    {
        return [
            'tipo_estudiante' => 'required|not_in:Elegir...',
            'convocatoria_estudiante' => 'required|not_in:Elegir...',
            'costo' => 'required|not_in:Elegir...',
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_tipo_convocatoria()
      {        
        $this->validate();
       
        $guardar_tipo_convocatoria = new SiadiTipoConvocatoria();
        $guardar_tipo_convocatoria->id_tipo_estudiante         = $this->tipo_estudiante;
        $guardar_tipo_convocatoria->id_convocartoria_estudiante         = $this->convocatoria_estudiante;
        $guardar_tipo_convocatoria->id_costo          = $this->costo;
        $guardar_tipo_convocatoria->save();   

      $this->cancelar();
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','Se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $convocatoria_estudiante2;
    public $tipo_estudiantee2;
    public $costo2;
      public $id_tipo_convocatoria_actual;
      public function editar_tipo_convocatoria(SiadiTipoConvocatoria $id_tipo_convocatoria){

        
        $this->costo2 =$id_tipo_convocatoria->id_costo ;
        $this->tipo_estudiantee2 =$id_tipo_convocatoria->id_tipo_estudiante ;
        $this->convocatoria_estudiante2 =$id_tipo_convocatoria->id_convocartoria_estudiante ;
        $this->id_tipo_convocatoria_actual =$id_tipo_convocatoria->id_tipo_convocatoria ;
            }
            public function cancelarEditar() {
                $this->reset([
                   'convocatoria_estudiante2',
'tipo_estudiantee2','costo2','id_tipo_convocatoria_actual'
        ]);
        $this->resetValidation();
                        
            
            }  
            public function guardarEditadotipo_convocatoria(){
                $this->validate([
                    
                    'tipo_estudiantee2' => 'required|not_in:Elegir...',
            'convocatoria_estudiante2' => 'required|not_in:Elegir...',
            'costo2' => 'required|not_in:Elegir...',
                    
                ]);

                $siadi_tipo_convocatoria = SiadiTipoConvocatoria::find($this->id_tipo_convocatoria_actual);
                $siadi_tipo_convocatoria->update([
        
       
                    'id_convocartoria_estudiante' => $this->convocatoria_estudiante2,
                    'id_costo' => $this->costo2,
                            
                           
                    'id_tipo_estudiante' => $this->tipo_estudiantee2,
                        ]);
                    
       
    
        $this->reset([
            
            'convocatoria_estudiante2',
            'tipo_estudiantee2','costo2','id_tipo_convocatoria_actual',
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO

            public function cambiar_estado_tipo_convocatoria($id_tipo_convocatoria)
            {
                // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
                $tipo_convocatoria_estado = SiadiTipoConvocatoria::find($id_tipo_convocatoria);
        
                if ($tipo_convocatoria_estado) {
                    $tipo_convocatoria_estado->estado_tipo_convocatoria	 = $tipo_convocatoria_estado->estado_tipo_convocatoria	 === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
                    $tipo_convocatoria_estado->save();
                }
        
                // Emitir evento para notificar que el estado ha cambiado (opcional)
                $this->emit('alert','Se cambio el estado de la convocatoria con éxito');
        
            }
    
    public function render()
    {
       $tipo_estudiantes=SiadiTipoEstudiante::where('estado_tipo_estudiante', '=', 'ACTIVO')->get();
       $convocatoria_estudiantes=SiadiConvocartoriaEstudiante::where('estado_convocatoria_estudiante', '=', 'ACTIVO')->get();
       $costos=SiadiCosto::where('estado_costo', '=', 'ACTIVO')->get();
        $tipo_convocatorias = SiadiTipoConvocatoria::where('estado_tipo_convocatoria', '<>', 'ELIMINAR')
        ->when($this->search, function ($query) {
            $query->whereHas('tipo_estudiante', function ($query) {
                $query->where('nombre_tipo_estudiante', 'LIKE', '%' . $this->search . '%');
                 });
        $query->orWhereHas('convocatoria_estudiante', function ($query) {
                        $query->where('nombre_convocatoria_estudiante', 'LIKE', '%' . $this->search . '%');
                    });

         $query->orWhereHas('costo', function ($query) {
                        $query->where('deposito', 'LIKE', '%' . $this->search . '%');
                    });
         $query->orWhereHas('costo', function ($query) {
                        $query->where('costo_siado_costo', 'LIKE', '%' . $this->search . '%');
                    });
    
              
                
                
        })
        ->latest('id_tipo_convocatoria')
        ->paginate(5);
        return view('livewire.administracion-modulos.tipo-convocatoria-index',compact('tipo_estudiantes','convocatoria_estudiantes','tipo_convocatorias','costos'));
    }
}
