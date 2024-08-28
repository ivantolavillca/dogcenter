<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiParalelo;
use Livewire\Component;
use Livewire\WithPagination;
class ParaleloIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $paralelo;
   
   
  

    public function cancelar(){
        $this->reset([

        ]);
        $this->resetValidation();
    }
    public function updatingSearch(){
        $this->resetPage();
    }

  //BORRAR
    public function delete(SiadiParalelo $id_paralelo): void
    {
        $id_paralelo->estado_paralelo = 'ELIMINAR';
        $id_paralelo->update();

    
          
           
    }

//CREAR

    public function rules()
    {
        return [
            'paralelo' => 'required',
           
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }




    public function guardar_paralelo()
      {        
        $this->validate();
       
        $guardar_paralelo = new SiadiParalelo();
      ;
        $guardar_paralelo->nombre_paralelo         = $this->paralelo;
       
        $guardar_paralelo->save();   

        $this->reset([
            'paralelo' ,
            
        ]);
  
        $this->emit('closeModalCreate');
            
        $this->emit('alert','El paralelo se guardo satisfactoriamente');

      }


      //EDITAR GESTION
      public $paralelo2;
      public $id_paralelo_actual;
   
      public function editar_paralelo(SiadiParalelo $id_paralelo){

        $this->paralelo2 =$id_paralelo->nombre_paralelo;
        
        $this->id_paralelo_actual =$id_paralelo->id_paralelo ;

            }
            public function cancelarEditar() {
                $this->reset([
                    'paralelo2',
                    'id_paralelo_actual',
                   
                        ]);
                        
            
            }  
            public function guardarEditadoparalelo(){
                $this->validate([
                    
                    'paralelo2' => 'required',
                   
                ]);

 $siadi_paralelo = SiadiParalelo::find($this->id_paralelo_actual);
    
        $siadi_paralelo->fill([
            
          
            'nombre_paralelo'          => $this->paralelo2,
           
            
            
        ]);
        $siadi_paralelo->save();
    
        $this->reset([
            
           'paralelo2',
           'id_paralelo_actual',
            
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');

            }
            
            //RENDERIZAR TODO

    public function render()
    {

        $paralelos = SiadiParalelo::where('estado_paralelo', '<>', 'ELIMINAR')
        ->where(function ($query) {
        $searchTerm = '%' . $this->search . '%';       
        $query->orWhere('nombre_paralelo', 'LIKE', $searchTerm);
               
        })
       
        ->paginate(5);
        
        return view('livewire.administracion-modulos.paralelo-index',compact('paralelos'));
    }
}
