<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiNota;
use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiPreInscripcion;
use App\Models\PreRequisito;
use Livewire\Component;
use Livewire\WithPagination;

class InscripcionIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'render', 'inscripbir',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    public $id_nivel_actual;
    public $siguientenivel;
    public  $idpersona;
    public $operation;
    public function rules()
        {
            if ($this->operation === 'saveeditinscipcion') {
                return $this->rulesForGuardareditarinscripcion();
            }
           elseif ($this->operation === 'guardarnuevainsc') {
                return $this->rulesForGuardarNuevaInxripcion();
            }

            return array_merge($this->rulesForGuardareditarinscripcion(),$this->rulesForGuardarNuevaInxripcion());
        }

        private function rulesForGuardareditarinscripcion()
        {
            return [
                'asignaturaGuardar' => 'required|not_in:Elegir...',
               
            ];
        }

        private function rulesForGuardarNuevaInxripcion()
        {
            return [
                'materiasSeleccionadas' => 'required|not_in:Elegir...',
                'idpersona' => 'required',
                'tipo_pago' => 'required|not_in:Elegir...',
                'numero_carpeta' => 'required',
                'numero_folio' => 'required',
            ];
        }


        public function updated($propertyName){
            $this->validateOnly($propertyName);
        
        }
    public function inscribir($persona){
        $this->idpersona=$persona;
        $this->emit('abrirmodalinscpp');
    }
   public $materiasSeleccionadas = [];
     
    public function cancelar(){
        $this->reset('materiasSeleccionadas');
    }
    public $asignaturaid;
    public $asignaturaGuardar;
    public $id_inscripcion_actual;
    public $tipo_pago;
    public $numero_folio;
    public $numero_carpeta;

    public function editarasig($asignat){
        $inscripcion_ac=SiadiInscripcion::where('id_inscripcion',$asignat)->first();
        $this->asignaturaid=$inscripcion_ac->id_planificar_asignatura ;
        $this->asignaturaGuardar=$inscripcion_ac->id_planificar_asignatura;
        $this->id_inscripcion_actual=$asignat;
    }
    public function guardareditarinscripcion(){
        $this->operation='saveeditinscipcion';
        $this->validate();

        $inscripcion=SiadiInscripcion::find($this->id_inscripcion_actual);
        $inscripcion->fill([
            'id_planificar_asignatura'          => $this->asignaturaGuardar,
        ]);
        $inscripcion->save();
        $this->emit('alert', 'Se editó satisfactoriamente');
    }

    public function guardarinscripcionnuevo(){
        $this->operation='guardarnuevainsc';
        $this->validate();
    foreach ($this->materiasSeleccionadas as  $materia) {
        if ($materia !== '' ) {
          $nueva_inscripcion= new SiadiInscripcion();
        $nueva_inscripcion->id_siadi_persona =$this->idpersona;
        $nueva_inscripcion->id_planificar_asignatura  =$materia;

        $nueva_inscripcion->tipo_pago_inscripcion  =$this->tipo_pago;
        $nueva_inscripcion->fecha_inscripcion	  =date("Y-m-d");
        $nueva_inscripcion->observacion_inscripcion	  ='SIN OBSERVACIÓN';
        $nueva_inscripcion->save();

        SiadiNota::create([
                'id_inscripcion' =>  $nueva_inscripcion->id_inscripcion,
                'nro_folio_nota' => $this->numero_folio,
                'nro_carpeta_nota' =>  $this->numero_carpeta,
                'observacion_nota' =>  'NO SE PRESENTO',
            ]);
            }
            
        }
  
  }

    public   function observar(SiadiPreInscripcion $id_inscrpcion){
        $id_inscrpcion->observacion_inscripcion = 'OBSERVADO';
        $id_inscrpcion->update();
    }
    public   function quitarobservacion(SiadiPreInscripcion $id_inscrpcion){
        $id_inscrpcion->observacion_inscripcion = 'SIN OBSERVACION';
        $id_inscrpcion->update();
    }
    public function render()
    {

        $MateriasPreinscritas=SiadiPreInscripcion::where('id_siadi_persona',$this->idpersona)->get();
//          $materiasInscritas = SiadiInscripcion::where('id_siadi_persona', $this->idpersona)->get();
//         $materiaAtomar = [];

//         foreach ($materiasInscritas as $materias) {
//     // Verifica si la propiedad notas está disponible
//     if ($materias->notas) {
//         if ($materias->notas->observacion_nota == 'REPROBADO') {
//             $nivelActual = $materias->planificar_asignatura->siadi_asignatura->id_siadi_asignatura;
//             $materiaAtomar[] = SiadiPlanificarAsignatura::where('id_siadi_asignatura', $nivelActual)
//                 ->where('estado_planificar_asignartura', 'ACTIVO')
//                 ->get();
//         } elseif ($materias->notas->observacion_nota == 'APROBADO') {
//             $nivelActual = $materias->planificar_asignatura->siadi_asignatura->id_siadi_asignatura;
//             $idsiguintenivel = PreRequisito::where('id_prerequisito_asignatura', $nivelActual)->first();
//             if ($idsiguintenivel) { // Verifica si la consulta devolvió un resultado
//                 $materiaAtomar[] = SiadiPlanificarAsignatura::where('id_siadi_asignatura', $idsiguintenivel->id_asignatura)
//                     ->where('estado_planificar_asignartura', 'ACTIVO')
//                     ->get();
//             }
//         }
//     }
// }

$query = SiadiPersona::query();
 
        if (!empty($this->search)) {
            $searchTerms = explode(' ', $this->search);

            $query->where(function ($subquery) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $subquery->orWhere('nombres_persona', 'like', '%' . $term . '%')
                        ->orWhere('paterno_persona', 'like', '%' . $term . '%')
                        ->orWhere('ci_persona', 'like', '%' . $term . '%')
                        ->orWhere('materno_persona', 'like', '%' . $term . '%');

                     }
            });
        }

        $personasInscritas = $query->get();
      
         
$personaunica=SiadiPersona::where('id_siadi_persona',$this->idpersona)->first();
 
$asignaturas_validas = []; // Inicializa la variable

$asignaturas_deplanifi_actual = SiadiPlanificarAsignatura::where('id_planificar_asignatura', $this->asignaturaid)->first();

if ($asignaturas_deplanifi_actual) {
    $asignaturas_validas = SiadiPlanificarAsignatura::where('id_siadi_asignatura', $asignaturas_deplanifi_actual->id_siadi_asignatura)
        ->where(function ($query) use ($asignaturas_deplanifi_actual) {
            $query->where('estado_planificar_asignartura', 'ACTIVO')
                ->orWhere('id_planificar_asignatura', $asignaturas_deplanifi_actual->id_planificar_asignatura);
        })
        ->get();
}
                                                
        return view('livewire.administracion-modulos.convalidacion-homologacion',compact('personasInscritas','MateriasPreinscritas','personaunica','asignaturas_validas'));
    }
}
