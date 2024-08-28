<?php

namespace App\Http\Livewire\Modulos;

use App\Models\Admin\siadi_asignatura;
use App\Models\Admin\siadi_requisito_idioma;
use Livewire\Component;

class SiadiRequisitoIdiomaCreate extends Component
{



   
    public $id_siadi_convocatoria;
   
    public $idioma = [];
    protected $rules=[
        
        'idioma' => 'required',
    ];
   
    
    public function cancelar() {
        $this->reset([
            'idioma'
                ]);
    
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
    $this->emitTo('modulos.siadi-requisito-idioma-index', 'render');
    $this->emit('alert', 'EL O LOS IDIOMA SE GUARDÓ EXITOSAMENTE');
   
}
  
    
  
    public function render()
    {
        $ids_siadi_asignatura_existente = siadi_requisito_idioma::where('id_siadi_convocatoria', $this->id_siadi_convocatoria)
    ->pluck('id_siadi_asignatura');
       
       
        $siadi_asignatura = siadi_asignatura::whereNotIn('id_siadi_asignatura', $ids_siadi_asignatura_existente)->get();
        return view('livewire.modulos.siadi-requisito-idioma-create',compact('siadi_asignatura'));
    }
}
