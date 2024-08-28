<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiNivelIdioma;
use Livewire\Component;
use Livewire\WithPagination;
class NivelIdiomaIndex extends Component
{
    
    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $nombre_idioma;
    public $descripcion_idioma;
  

    public function cancelar(){
        $this->reset([
'nombre_idioma','descripcion_idioma'
        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

  //BORRAR
    public function delete(SiadiNivelIdioma $id_nivel_idioma): void
    {
        $id_nivel_idioma->estado_nivel_idioma = 'ELIMINAR';
        $id_nivel_idioma->update();

    
          
           
    }

//CREAR

    public function rules()
    {
        return [
            'nombre_idioma' => 'required',
            'descripcion_idioma' => 'required',
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_idioma()
      {        
        $this->validate();
       
        $guardar_nivel_idioma = new SiadiNivelIdioma();
        $guardar_nivel_idioma->nombre_nivel_idioma         = $this->nombre_idioma;
        $guardar_nivel_idioma->descripcion_nivel_idioma         = $this->descripcion_idioma;
        $guardar_nivel_idioma->save();   

        $this->reset([

        ]);
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','El idioma se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $nombre_idioma2;
      public $descripcion_idioma2;
   
      public $id_nivel_idioma_actual;
      public function editar_idioma(SiadiNivelIdioma $id_nivel_idioma){

        $this->nombre_idioma2 =$id_nivel_idioma->nombre_nivel_idioma	;
        $this->descripcion_idioma2 =$id_nivel_idioma->descripcion_nivel_idioma	;
        $this->id_nivel_idioma_actual =$id_nivel_idioma->	id_nivel_idioma  ;
            }
            public function cancelarEditar() {
                $this->reset([
                    'nombre_idioma2',
                    'descripcion_idioma2',
                    'id_nivel_idioma_actual',
                    
                        ]);
                        
            
            }  
            public function guardarEditadoidioma(){
                $this->validate([
                    
                    'nombre_idioma2' => 'required',
                    'descripcion_idioma2' => 'required',
                  
                    
                ]);

 $siadi_nivel_idioma = SiadiNivelIdioma::find($this->id_nivel_idioma_actual);
    
        $siadi_nivel_idioma->fill([
            
            'nombre_nivel_idioma'          => $this->nombre_idioma2,
            'descripcion_nivel_idioma'          => $this->descripcion_idioma2,
            
            
        ]);
        $siadi_nivel_idioma->save();
    
        $this->reset([
            'nombre_idioma2',
            'descripcion_idioma2',
            'id_nivel_idioma_actual',
                    
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO
    public function render()
    {
        $nivel_idiomas=SiadiNivelIdioma::where('estado_nivel_idioma', '<>', 'ELIMINAR')
        ->latest('id_nivel_idioma')
        ->paginate(5);
        return view('livewire.administracion-modulos.nivel-idioma-index',compact('nivel_idiomas'));
    }
}
