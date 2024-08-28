<?php

namespace App\Http\Livewire\Modulos;

use App\Models\Admin\siadi_convocatoria;
use App\Models\Admin\siadi_documento;
use App\Models\Admin\siadi_gestion;
use App\Models\Admin\siadi_sede;
use App\Models\Admin\siadi_tipo_convocatoria;
use App\Models\Admin\siadi_tipo_estudiante;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PlanificarConvocatoriaCreate extends Component
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

        protected function rules()
        {
            $year = Carbon::now()->year;
    
            return [
                'observacion' => 'required',
            'descripcion' => 'required',
            'gestion' => 'required|not_in:Elegir...',
            'tipo_estudiante' => 'required|not_in:Elegir...',
            'periodo' => 'required|not_in:Elegir...',
            'convocatoria' => 'required|not_in:Elegir...',
            'documento' => 'required|not_in:Elegir...',
            'sede' => 'required|not_in:Elegir...',
                'fecha_inicio' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($year) {
                        $yearInput = Carbon::parse($value)->year;
    
                        if ($yearInput != $year) {
                            $fail('La fecha de inicio debe ser del año actual.');
                        }
                    },
                ],
                'fecha_final' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($year) {
                        $yearInput = Carbon::parse($value)->year;
    
                        if ($yearInput != $year) {
                            $fail('La fecha final debe ser del año actual.');
                        }
                    },
                ],
            ];
        }
    
   
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }
    
    
      public function render()
      {
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
  
          return view('livewire.modulos.planificar-convocatoria-create',compact('gestiones','tipo_estudiantes','listar_tipo_convocatorias','listaDeposito','siadi_documentos','siadi_sedes'));
      }

      

      public function guardar()
      {        
        $this->validate();
       
        $convocatoria = new siadi_convocatoria();
        $convocatoria->tipo_convocatoria_sede_id_id_gestion_periodo         = $this->convocatoria.$this->sede.$this->gestion.$this->periodo;
        $convocatoria->id_siadi_gestion          = $this->gestion;
        $convocatoria->periodo_siadi_convocatoria  = $this->periodo;
        $convocatoria->id_siadi_tipo_convocatoria            = $this->convocatoria;
        $convocatoria->sede_id            = $this->sede;
        $convocatoria->id_siadi_documento             = $this->documento;
        $convocatoria->texto_descripcion_siadi_convocatoria             = $this->descripcion;
        $convocatoria->texto_observacion_siadi_convocatoria             = $this->observacion;
        $convocatoria->fecha_inicio_siadi_convocatoria             = $this->fecha_inicio;
        $convocatoria->fecha_fin_siadi_convocatoria             = $this->fecha_final;
        $convocatoria->fecha_siadi_convocatoria             = date('Y-m-d H:i:s');
        $convocatoria->id_usuario             = Auth::user()->id ;
        $convocatoria->estado_siadi_convocatoria             = 'ACTIVO';
      
       
    
       
        
    
      
        $convocatoria->save();
        
      
    
        
        $this->reset([
    'gestion','periodo','convocatoria','sede','documento','descripcion','observacion','fecha_inicio','fecha_final'
        ]);
    
    
    
        
        $this->emit('closeModal');
             $this->emitTo('modulos.planificar-convocatoria-index','render');
            $this->emit('alert','El usuario se guardo satisfactoriamente');




         
      }
   
}











 


