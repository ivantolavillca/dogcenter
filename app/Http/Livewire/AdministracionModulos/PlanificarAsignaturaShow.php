<?php

namespace App\Http\Livewire\AdministracionModulos;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\AdministracionModulos\SiadiNota;
use App\Models\base_upea\tabla_vista_asignacion_control_docente_actua;
use Livewire\WithPagination;

class PlanificarAsignaturaShow extends Component
{
    public $asignatura;
    protected $listeners = [
        'edicion_notas',
        'guardar_notas',
        'cancelar_edicion'
    ];

    #public $inscritos;
    public function render()
    {   
        #$asignatura = null;
        return view('livewire.administracion-modulos.planificar-asignatura-show', ['inscritos' =>  $this->getDataNotas(),
            #'nombramiento' => $this->getGradoNombraminetoDocente()
        ]);  
    }

    public function mount($asignatura){
        $this->asignatura = $asignatura;
    }

    private function getDataNotas(){
        return is_null($this->asignatura)? []: 
            SiadiPersona::join('siadi_inscripcions', 'siadi_inscripcions.id_siadi_persona', '=', 'siadi_personas.id_siadi_persona') 
                ->join('siadi_notas', 'siadi_notas.id_inscripcion', '=', 'siadi_inscripcions.id_inscripcion') 
                ->leftJoin('users', 'siadi_notas.id_usuario', '=', 'users.id')
                ->select(
                    'siadi_personas.ci_persona',
                    'siadi_personas.expedido_persona',
                    'siadi_personas.paterno_persona',
                    'siadi_personas.materno_persona',
                    'siadi_personas.nombres_persona',

                    'siadi_inscripcions.id_inscripcion',

                    'siadi_notas.id_nota',
                    'siadi_notas.final_nota',
                    'siadi_notas.observacion_nota',
                    'siadi_notas.observaciones_detalle',
                    'siadi_notas.id_usuario',

                    'users.name',
                    'users.paterno',
                    'users.materno'
                )
                ->where('siadi_personas.estado_persona', '<>', 'ELIMINAR')
                ->where('siadi_inscripcions.estado_inscripcion', '<>', 'ELIMINADO')
                ->where('siadi_notas.estado_nota', '<>', 'ELIMINAR')
                ->where('siadi_inscripcions.id_planificar_asignatura', '=', $this->asignatura->id_planificar_asignatura)
                ->orderBy('siadi_personas.paterno_persona', 'asc')
                ->orderBy('siadi_personas.materno_persona', 'asc')
                ->orderBy('siadi_personas.nombres_persona', 'asc')
                ->get();
    }
    private function getGradoNombraminetoDocente(){
        return (is_null($this->asignatura->siadi_persona_asignada_docente))? null:
            tabla_vista_asignacion_control_docente_actua::
            where('id_persona', '=', $this->asignatura->siadi_persona_asignada_docente->id )
            ->where('vista_asignacion_control_docente_actua.item_nombramiento', 'LIKE', \DB::raw("'%IDI%'"))
            #->where('gestion', '=', $this->asignatura->siadi_convocatoria->gestion->nombre_gestion)
            #->where('periodo', '=', $this->asignatura->siadi_convocatoria->periodo)
            ->orderBy('fecha_conclusion', 'desc')
            ->first();
    }

    /* **************************** INICIO REGLAS ************************************ */
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        # tipo de operacion
        if($this->operation=="editar_notas"){
            return $this->rulesForUpdateNote();
        }
        return array_merge($this->rulesForUpdateNote());
    }

    protected function rulesForUpdateNote(){
        return [
            'id_notas.*' => 'required',
            'final_notas.*' => 'required|integer|between:0,100',
            'observacion_notas.*' => 'required' # REQUIRED
        ];
    }

    protected $validationAttributes = [
        'final_notas.*' => '"FINAL NOTA"',
        'observacion_notas.*' => '"RESULTADO"'
    ];
    /* ***************************** FIN REGLAS ************************************** */

    public $operation;
    public $edicion = false;
    public $id_notas = [];
    public $final_notas = [];
    public $observacion_notas = [];

    public function edicion_notas(){
        $this->edicion = true;
        $this->operation = "editar_notas";
        $this->clearData();
        $tmp = $this->getDataNotas();
        foreach($tmp as $isnc){
            $this->id_notas[] = $isnc->id_nota;
            $this->final_notas[] = $isnc->final_nota;
            $this->observacion_notas[] = $isnc->observacion_nota;
        }
        $this->emit("deshabilitarRuedasMouse", '.input-notes');
        #$this->emit("Mostrar", json_encode($this->observacion_notas));
    }

    public function updatedFinalNotas($nota_final_actual, $index){
        # $this->emit("Mostrar", "ES ". $nota_final_actual);
        if(is_numeric($nota_final_actual)){
            if($nota_final_actual<=100 && $nota_final_actual >= 0){
                if($nota_final_actual==0){
                    $this->observacion_notas[$index] = "NO SE PRESENTO";
                } else if($nota_final_actual<=50){
                    $this->observacion_notas[$index] = "REPROBADO";
                } else {
                    $this->observacion_notas[$index] = "APROBADO";
                }
                $this->resetValidation('observacion_notas.'. $index);
            } else {
                $this->observacion_notas[$index] = "";
            }
        } else {
            $this->observacion_notas[$index] = "";
        }
    }

    public function guardar_notas(){
    	$this->validate();
        if($this->operation=="editar_notas"){
            $datos_inscripcion = $this->getDataNotas();
            $tipo_nota = ($this->asignatura->siadi_convocatoria->id_modalidad_curso!==1 && $this->asignatura->siadi_convocatoria->id_modalidad_curso!==2? " ". $this->asignatura->siadi_convocatoria->modalidad->nombre_convocatoria_estudiante : "");
            $modificados = [];
            try { 
                \DB::beginTransaction();
                foreach($datos_inscripcion as $indice => $valor){
                    if($this->observacion_notas[$indice]!=='BAJA'){
                        if($this->id_notas[$indice]==$valor->id_nota && strval($valor->final_nota)!==strval($this->final_notas[$indice]) || $this->observacion_notas[$indice]!== $valor->observacion_nota){
                            $nota = SiadiNota::find($valor->id_nota);
                            $nota->final_nota = $this->final_notas[$indice];
                            $nota->observacion_nota = $this->observacion_notas[$indice];
                            $nota->observaciones_detalle = $this->observacion_notas[$indice] . $tipo_nota;
                            $nota->id_usuario = Auth::user()->id;
                            $nota->save();
                            $modificados[] = $valor;
                        }
                    }
                }
                \DB::commit();
                $this->emit('alert', count($modificados). " notas Guardadas exitosamente!");
                # $this->emit("Mostrar", "Total: ". count($modificados));
                $this->cancelar_edicion();
            } catch (\Exception $e) {
                \DB::rollback();
                #throw $e;
                $this->emit("errorvalidate", "Ups. Ocurrio un error al guardar:  \n". $e->getMessage());
            }
        }
    }
    
    public function cancelar_edicion(){
    	$this->edicion = false;
    	$this->operation = '';
    	$this->clearData();
	}

    private function clearData(){
        $this->id_notas = [];
        $this->final_notas = [];
        $this->observacion_notas = [];
    }

    public function tabla(){
        //$query = \DB::table('certificados_provisional')->get();

        /* $permiso = 'planificar_asignatura.show';
        $query = \DB::table('permissions')->where('name', '=', $permiso)->first();
        if(is_null($query)){
            $data = [
                'name' => $permiso,
                'guard_name' => 'web'
            ];
            \DB::table('permissions')->insert($data);
            $this->emit("Mostrar", 'Registro exitoso');
        } */
    }
}
