<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiIdioma;
use Livewire\Component;
use Livewire\WithPagination;
class IdiomaIndex extends Component
{

    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $idioma;
    public $tipo_idioma;
    public $sigla_idioma;
  

    public function cancelar(){
        $this->reset([
'idioma','tipo_idioma','sigla_idioma',
        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

  //BORRAR
    public function delete(SiadiIdioma $id_idioma): void
    {
        $id_idioma->estado_idioma = 'ELIMINAR';
        $id_idioma->update();

    
          
           
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
            'idioma' => 'required',
            'tipo_idioma' => 'required|not_in:Elegir...',
            'sigla_idioma' => 'required',
        ];
    }

    private function rulesForGuardarEditado()
    {
        return [
            'idioma2' => 'required',
            'tipo_idioma2' => 'required|not_in:Elegir...',
            'sigla_idioma2' => 'required',
        ];
    }


    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }

      public function cambiar_estado_idioma($id_idioma)
      {
          // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
          $idioma_estado = SiadiIdioma::find($id_idioma);
  
          if ($idioma_estado) {
              $idioma_estado->estado_idioma = $idioma_estado->estado_idioma === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
              $idioma_estado->save();
          }
  
          // Emitir evento para notificar que el estado ha cambiado (opcional)
          $this->emit('alert','Se cambio el estado de la convocatoria con éxito');
  
      }


    public function guardar_idioma()
      {        
          $this->operation = 'save';
        $this->validate();
       
        $guardar_idioma = new SiadiIdioma();
        $guardar_idioma->nombre_idioma         = $this->idioma;
        $guardar_idioma->tipo_idioma         = $this->tipo_idioma;
        $guardar_idioma->sigla_codigo_idioma         = $this->sigla_idioma;
        $guardar_idioma->save();   

        $this->cancelar();
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','El idioma se guardo satisfactoriamente');

      }


      //EDITAR GESTION
    
      public $idioma2;
      public $tipo_idioma2;
      public $sigla_idioma2;
      
      public $id_idioma_actual;
      public function editar_idioma(SiadiIdioma $id_idioma){

        $this->idioma2 =$id_idioma->nombre_idioma;
        $this->tipo_idioma2 =$id_idioma->tipo_idioma;
        $this->sigla_idioma2 =$id_idioma->sigla_codigo_idioma;
        $this->id_idioma_actual =$id_idioma->id_idioma ;
            }
            public function cancelarEditar() {
                $this->reset([
                    'idioma2' ,
                    'tipo_idioma2',
                    'sigla_idioma2' ,
                    'id_idioma_actual'
                        ]);
                        
            $this->resetValidation();
            }  
            public function guardarEditadoidioma(){
               $this->operation = 'edit';
        $this->validate();

 $siadi_idioma = SiadiIdioma::find($this->id_idioma_actual);
    
        $siadi_idioma->fill([
            
            'nombre_idioma'          => $this->idioma2,
            'tipo_idioma'          => $this->tipo_idioma2,
            'sigla_codigo_idioma'          => $this->sigla_idioma2,
            
            
        ]);
        $siadi_idioma->save();
    
        $this->cancelarEditar();
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO
    public function render()
    {
        $search = '%' . $this->search . '%';

        $idiomas = SiadiIdioma::where('estado_idioma', '<>', 'ELIMINAR')
            ->where(function ($query) use ($search) {
                $query->where('nombre_idioma', 'LIKE', $search)
                    ->orWhere('tipo_idioma', 'LIKE', $search)
                    ->orWhere('sigla_codigo_idioma', 'LIKE', $search);
            })
            ->latest('id_idioma')
            ->paginate(5);
        return view('livewire.administracion-modulos.idioma-index',compact('idiomas'));
    }
}
