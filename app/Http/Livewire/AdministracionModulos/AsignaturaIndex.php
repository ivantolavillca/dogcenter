<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiAsignatura;
use App\Models\AdministracionModulos\SiadiIdioma;
use App\Models\AdministracionModulos\SiadiNivelIdioma;
use Livewire\Component;
use Livewire\WithPagination;

class AsignaturaIndex extends Component
{
     use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';

public $idioma;
public $nivel_idioma;
public $sigla_asignatura;


    public function cancelar(){
            $this->reset([
    'idioma','nivel_idioma','sigla_asignatura',
            ]);
            $this->resetValidation();
        }
        public function updatingSearch(){
            $this->resetPage();
        }

    //BORRAR
        public function delete(SiadiAsignatura $id_asignatura): void
        {
            $id_asignatura->estado_asignatura = 'ELIMINAR';
            $id_asignatura->update();            
        }

    //CREAR

        public $operation;

        public function rules()
        {
            if ($this->operation === 'save') {
                return $this->rulesForGuardar();
            } elseif ($this->operation === 'edit') {
                return $this->rulesForGuardarEditado();
            }

            return array_merge($this->rulesForGuardar(), $this->rulesForGuardarEditado());
        }

        private function rulesForGuardar()
        {
            return [
                'idioma' => 'required|not_in:Elegir...',
                'nivel_idioma' => 'required|not_in:Elegir...',
                'sigla_asignatura' => 'required|string|max:255',
            ];
        }

        private function rulesForGuardarEditado()
        {
            return [
                'idioma2' => 'required|not_in:Elegir...',
                'nivel_idioma2' => 'required|not_in:Elegir...',
                'sigla_asignatura2' => 'required|string|max:255',
            ];
        }


        public function updated($propertyName){
            $this->validateOnly($propertyName);
        
        }

        public function cambiar_estado_idioma($id_asignatura)
        {
            // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
            $asignatura_estado = SiadiAsignatura::find($id_asignatura);
    
            if ($asignatura_estado) {
                $asignatura_estado->estado_asignatura	 = $asignatura_estado->estado_asignatura	 === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
                $asignatura_estado->save();
            }
    
            // Emitir evento para notificar que el estado ha cambiado (opcional)
            $this->emit('alert','Se cambio el estado con éxito');
    
        }


        public function guardar_asignatura()
        {        
            $this->operation = 'save';
            $this->validate();
        
            $guardar_asignatura = new SiadiAsignatura();
            $guardar_asignatura->id_idioma          = $this->idioma;
            $guardar_asignatura->id_nivel_idioma          = $this->nivel_idioma;
            $guardar_asignatura->sigla_asignatura         = $this->sigla_asignatura;
            $guardar_asignatura->save();   

            $this->cancelar();
    
            $this->emit('closeModalCreate');
                
            $this->emit('alert','El idioma se guardo satisfactoriamente');

        }


      //EDITAR GESTION
    
      
      public $idioma2;
      public $nivel_idioma2;
      public $sigla_asignatura2;
      
      public $id_asignatura_actual;
      public function editar_idioma(SiadiAsignatura $id_asignatura){

        $this->idioma2 =$id_asignatura->id_idioma ;
        $this->nivel_idioma2 =$id_asignatura->id_nivel_idioma;
        $this->sigla_asignatura2 =$id_asignatura->sigla_asignatura;
        $this->id_asignatura_actual =$id_asignatura->id_siadi_asignatura  ;
            }
            public function cancelarEditar() {
                $this->reset([
                    'idioma2' ,
                    'nivel_idioma2',
                    'sigla_asignatura2' ,
                    'id_asignatura_actual'
                        ]);
                        
            $this->resetValidation();
            }  
            public function guardarEditadoAsignatura(){
               $this->operation = 'edit';
        $this->validate();

 $siadi_asignatura = SiadiAsignatura::find($this->id_asignatura_actual);
    
        $siadi_asignatura->fill([
            
            'id_idioma'          => $this->idioma2,
            'id_nivel_idioma'          => $this->nivel_idioma2,
            'sigla_asignatura'          => $this->sigla_asignatura2,
            
            
        ]);
        $siadi_asignatura->save();
    
        $this->cancelarEditar();
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
      

    public function render()
    {
        $nivelidiomas=SiadiNivelIdioma::where('estado_nivel_idioma','=','ACTIVO')->get();
        $idiomas=SiadiIdioma::where('estado_idioma','=','ACTIVO')->get();
        $asignaturas=SiadiAsignatura::where('estado_asignatura','<>','ELIMINAR')
        ->latest('id_siadi_asignatura')
        ->paginate(5);
        return view('livewire.administracion-modulos.asignatura-index',compact('asignaturas','idiomas','nivelidiomas'));
    }
}
