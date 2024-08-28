<?php

namespace App\Http\Livewire\Modulos;

use App\Models\Admin\siadi_asignatura;
use App\Models\Admin\siadi_requisito_idioma;
use Livewire\Component;
use Livewire\WithPagination;

class SiadiRequisitoIdiomaIndex extends Component
{use WithPagination;
    public $search;
    public $id_siadi_convocatoria;
    protected $listeners=['render','delete',];
  
    protected $paginationTheme = 'bootstrap';
    public $idioma = [];
    protected $rules=[
        
        'idioma' => 'required',
    ];
   

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount($id_siadi_convocatoria)
    {
        $this->id_siadi_convocatoria = $id_siadi_convocatoria;
    }

    public function guardarRequisitoIdioma()
    {
        $this->validate();
        foreach ($this->idioma as $idSiadiAsignatura) {
            siadi_requisito_idioma::create([
                'id_convocatoria_id_asignatura' => $this->id_siadi_convocatoria . $idSiadiAsignatura,
                'id_siadi_convocatoria' => $this->id_siadi_convocatoria,
                'id_siadi_asignatura' => $idSiadiAsignatura,
            ]);
        }
        
        $this->reset(['idioma']);
        $this->emit('closeModal');
       
        $this->emit('alert', 'EL O LOS IDIOMA SE GUARDARON EXITOSAMENTE');
       
    }
  
    public function render(){
    //  $ids_siadi_asignatura_existente = siadi_requisito_idioma::where('id_siadi_convocatoria', $this->id_siadi_convocatoria)
    //   ->pluck('id_siadi_asignatura');
    
           
    //   $siadi_asignatura2 = siadi_asignatura::whereNotIn('id_siadi_asignatura', $ids_siadi_asignatura_existente)->get();
    $siadi_asignatura2 = siadi_asignatura::whereDoesntHave('siadiRequisitoIdioma', function ($query) {
        $query->where('id_siadi_convocatoria', $this->id_siadi_convocatoria)
            ->where('estado_siadi_requisito_idioma', 'ACTIVO');
    })
    ->get();
        $siadi_asignatura= siadi_asignatura::all();
        $siadi_requisito_idiomas =siadi_requisito_idioma::where('estado_siadi_requisito_idioma','ACTIVO')
        ->where('id_siadi_convocatoria',$this->id_siadi_convocatoria)

        ->latest('id_siadi_requisito_idioma')
        ->paginate(10);
        return view('livewire.modulos.siadi-requisito-idioma-index',compact('siadi_asignatura2','siadi_asignatura','siadi_requisito_idiomas'));
    }

   
    public function cancelar() {
        $this->reset([
            'idioma'
                ]);
    
    }  
    public function delete(siadi_requisito_idioma $id_siadi_requisito_idioma): void
    {
        $id_siadi_requisito_idioma->estado_siadi_requisito_idioma = 'INACTIVO';
        $id_siadi_requisito_idioma->save();
    
          
           
    }
}
