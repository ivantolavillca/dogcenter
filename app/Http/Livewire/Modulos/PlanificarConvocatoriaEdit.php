<?php

namespace App\Http\Livewire\Modulos;

use Livewire\Component;
use App\Models\Admin\siadi_convocatoria;
use App\Models\Admin\siadi_documento;
use App\Models\Admin\siadi_gestion;
use App\Models\Admin\siadi_sede;
use App\Models\Admin\siadi_tipo_convocatoria;
use App\Models\Admin\siadi_tipo_estudiante;
class PlanificarConvocatoriaEdit extends Component
{

    public $tipo_estudiante;
    public $convocatoria;
    public $documento;
    public $sede;
 
    public $observacion;
    public $descripcion;
    public $gestion;
    public $periodo;
   
    public $fecha_inicio;
    public $fecha_final;
    
public $id_convocatoria;
public function mount(siadi_convocatoria $id_convocatoria){

$this->id_convocatoria= $id_convocatoria;
$this->gestion = $id_convocatoria->id_siadi_gestion;
$this->periodo = $id_convocatoria->periodo_siadi_convocatoria;
$this->tipo_estudiante = $id_convocatoria->siadi_tipo_convocatoria->siadi_tipo_estudiante->id_siadi_tipo_estudiante;
$this->convocatoria = $id_convocatoria->siadi_tipo_convocatoria->id_siadi_tipo_convocatoria;
$this->sede = $id_convocatoria->siadi_sedes->sede_id;
$this->documento = $id_convocatoria->siadi_documentos->id_siadi_documento;
$this->descripcion = $id_convocatoria->texto_descripcion_siadi_convocatoria;
$this->observacion = $id_convocatoria->texto_observacion_siadi_convocatoria;
$this->fecha_inicio = $id_convocatoria->fecha_inicio_siadi_convocatoria;
$this->fecha_final = $id_convocatoria->fecha_fin_siadi_convocatoria;
}

public function salir(){


}


    
    public function render()
    {
      
       $convocatoria_actual=$this->id_convocatoria;
        $gestiones=siadi_gestion::where('estado_siadi_gestion','ACTIVO')->get();
        $tipo_estudiantes=siadi_tipo_estudiante::where('estado_siadi_tipo_estudiante','ACTIVO')->get();
$listar_tipo_convocatorias=siadi_tipo_convocatoria::where('id_siadi_tipo_estudiante',$this->tipo_estudiante)
->where('estado_siadi_tipo_convocatoria' ,'ACTIVO')
->get();
$siadi_sedes=siadi_sede::where('estado_siadi_sede','ACTIVO')->get();
$listaDeposito=siadi_tipo_convocatoria::where('id_siadi_tipo_convocatoria',$this->convocatoria)
->where('estado_siadi_tipo_convocatoria' ,'ACTIVO')
->first();
$siadi_documentos=siadi_documento::where('estado_siadi_documento','ACTIVO')->get();
        return view('livewire.modulos.planificar-convocatoria-edit',compact('gestiones','tipo_estudiantes','listar_tipo_convocatorias','listaDeposito','siadi_documentos','siadi_sedes','convocatoria_actual'));
    }
}
