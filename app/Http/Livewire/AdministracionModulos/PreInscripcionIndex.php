<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiConvocatoria;
use App\Models\AdministracionModulos\SiadiPreInscripcion;
use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiNota;
use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\base_upea\tabla_persona;
use App\Models\PreRequisito;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\AssignThisVariablePass;

class PreInscripcionIndex extends Component
{


   use WithPagination;
   protected $listeners = [
      'render', 'inscripbir', 'hola', 'myCustomEvent' => 'handleCustomEvent'
   ];
   public function handleCustomEvent($data)
   {
      $this->addError('holaaa', 'error');
      $this->emit('alert', 'Se recibieron los datos: ' . $data);
   }
   public function hola($datos)
   {
      // Realiza alguna acción con los datos, por ejemplo, emitir una respuesta
      $this->emit('respuesta', 'Se recibieron los datos: ' . $datos);
   }

   public $search = '';
   protected $paginationTheme = 'bootstrap';

   public $asignaturas = [];
   public function updatingSearch()
   {
      $this->resetPage();
   }




   public $operation;

   public function rules()
   {
      if ($this->operation === 'saveinscribir') {
         return $this->rulesForInscribir();
      } elseif ($this->operation === 'savepreinscribir') {
         return $this->rulesForPreIncribir();
      } elseif ($this->operation == 'saveeditinscipcion') {
         return $this->rulesForIncribirEdit();
      }

      return array_merge($this->rulesForInscribir(), $this->rulesForPreIncribir(), $this->rulesForIncribirEdit());
   }

   private function rulesForInscribir()
   {
      return [
         // 'nro_folio' => 'required',
        #'nro_carperta' => 'required',
         'asignaturas' => 'required',
      ];
   }
   private function rulesForIncribirEdit()
   {
      return [
         'asignaturaGuardar' => 'required|not_in:Elegir...',
      ];
   }


   private function rulesForPreIncribir()
   {
      return [
         'nroDeposito.*' => 'required|numeric|max:999999999',
         'fechaDeposito.*' => 'required|date',
         'idasignatura.*' => 'required',
      ];
   }


   public function updated($propertyName)
   {
      $this->validateOnly($propertyName);
   }

   public function inscripbir($preinscripcion)
   {

      $materias_preinscritas = SiadiPreInscripcion::where('id_siadi_persona', $preinscripcion)
         ->where('observacion_inscripcion', '!=', 'INSCRITO')->get();

      foreach ($materias_preinscritas as  $preinscripcion) {

         $inscripcionac = SiadiInscripcion::create([
            'id_siadi_persona' =>  $preinscripcion->id_siadi_persona,
            'id_planificar_paralelo' =>  $preinscripcion->id_planificar_paralelo,
            'tipo_pago_inscripcion' =>  $preinscripcion->tipo_pago_inscripcion,
            'fecha_inscripcion' =>  $preinscripcion->fecha_inscripcion,
            'observacion_inscripcion' =>  $preinscripcion->observacion_inscripcion,
            'monto_deposito' =>  $preinscripcion->monto_deposito,
         ]);
         SiadiNota::create([
            'id_inscripcion' =>  $inscripcionac->id_inscripcion,
            'nro_folio_nota' =>  'NO ASIGNADO',
            'nro_carpeta_nota' =>  'NO ASIGNADO',
            'observaciones_detalle' =>  'INSCRITO',
         ]);
         $preinscripcion->observacion_inscripcion = 'INSCRITO';
         $preinscripcion->update();
      }

      $this->emit('alert', 'Estidiante inscritó con éxito');
   }
   public $estudiante;
   public $idestudianteactual;
   public $ciestudiante;
   public $nombre_estudiante;
   public $id_estudiante_encontrado;
   public $id_tipo_estudiante_encontrado;

   public function updatedCiestudiante()
   {
      $this->buscarestudiante();
   }
   public function buscarestudiante()
   {
      $estudiante_encontrado = SiadiPersona::where('ci_persona', $this->ciestudiante)->first();
      if ($estudiante_encontrado) {
         $this->nombre_estudiante = $estudiante_encontrado->nombres_persona . ' ' . $estudiante_encontrado->paterno_persona . ' ' . $estudiante_encontrado->materno_persona;
         $this->id_estudiante_encontrado = $estudiante_encontrado->id_siadi_persona;
         $this->id_tipo_estudiante_encontrado = $estudiante_encontrado->id_tipo_estudiante;
      } else {
         $this->nombre_estudiante = '';
         $this->id_estudiante_encontrado = '';
         $this->addError('estudiantenoencontrado', 'EL ESTUDIANTE NO SE ENCUENTRA EN LOS REGISTROS DE PERSONA');
      }
   }



   public function inscribirestudiante($id_estudiante)
   {



      $estudiante = SiadiPersona::where('id_siadi_persona', $id_estudiante)->first();

      $this->idestudianteactual = $estudiante->id_siadi_persona;
      $this->emit('abrimodalinscripcion');

      $this->estudiante = $estudiante->paterno_persona . ' ' . $estudiante->materno_persona . ' ' . $estudiante->nombres_persona;
   }

   public $preinscipcionesaular = array();

   public $nro_folio;
   public $nro_carperta;
   public function guardar_inscripcion_estudiante()
   {
      $this->operation = 'saveinscribir';
      $this->validate();
     

      foreach ($this->asignaturas as  $asignatura_select) {

         $preinscripcion_actual = SiadiPreInscripcion::where('id_pre_inscripcion', $asignatura_select)->first();
         $inecripcion_existente = SiadiInscripcion::where('id_siadi_persona', $preinscripcion_actual->id_siadi_persona)
            ->where('id_planificar_asignatura', $preinscripcion_actual->id_planificar_asignatura)->first();
         if ($inecripcion_existente) {
            $this->emit('errorvalidate', 'YA EXISTE LA INSCRIPCIÓN');
         } else {
            $inscripcionac = SiadiInscripcion::create([
               'id_siadi_persona' =>   $preinscripcion_actual->id_siadi_persona,
               'id_planificar_asignatura' =>  $preinscripcion_actual->id_planificar_asignatura,
               'tipo_pago_inscripcion' =>  $preinscripcion_actual->tipo_pago_inscripcion,
               'fecha_inscripcion' => $preinscripcion_actual->fecha_inscripcion,
               'observacion_inscripcion' =>  $preinscripcion_actual->observacion_inscripcion,
               'monto_deposito' =>  $preinscripcion_actual->monto_deposito,
               'nro_deposito' =>  $preinscripcion_actual->nro_deposito,
               'id_usuario' =>  Auth::id(),
            ]);
            SiadiNota::create([
               'id_inscripcion' =>  $inscripcionac->id_inscripcion,
               'nro_folio_nota' =>  'NO ASIGNADO',
               'nro_carpeta_nota' =>  $this->nro_carperta,
               'observacion_nota' =>  'NO SE PRESENTO',
               'observaciones_detalle' =>  'INSCRITO',
               'id_usuario' =>  Auth::id(),
               'nota_convalidacion' => 0,
               'final_nota' => 0,
            ]);
            $preinscripcion_actual->observacion_inscripcion = 'INSCRITO';
            $preinscripcion_actual->update();
            $this->emit('alert', 'INSCRITO SATISFACTORIAMENTE');
             
            $this->emit('cerrarmodalinscripcion');
            $this->cancelar();
          
         }
      }
       $this->reset('search');
   }

   public function anular_preinscripcion(SiadiPreInscripcion $id_preinscripcion)
   {
      $id_preinscripcion->estado_inscripcion = 'ELIMINAR';
      $id_preinscripcion->update();
   }
   public function anular_array_preinscripcion()
   {
      if ($this->preinscipcionesaular) {
         foreach ($this->preinscipcionesaular as $key => $value) {
            $preinscripciones = SiadiPreInscripcion::where('estado_inscripcion', 'ACTIVO')
               ->where('observacion_inscripcion', 'SIN OBSERVACION')
               ->where('id_siadi_persona', $value)->get();
            foreach ($preinscripciones as  $value2) {
               $preinscripcionunica = SiadiPreInscripcion::find($value2->id_pre_inscripcion);
               $preinscripcionunica->estado_inscripcion = 'ELIMINAR';
               $preinscripcionunica->update();
            }
         }
         $this->emit('alert', 'ANULACIÓN EXITOSA');
         $this->resetanulacion();
      } else {
         $this->emit('errorvalidate', 'SELECCIONE A LAS PERSONAS QUE DESEA ANULAR LA PREINSCRIPCIÓN');
      }
   }
   public function resetanulacion()
   {
      $this->reset('preinscipcionesaular');
      $this->resetPage();
   }
   public function cancelar()
   {
      $this->reset([
         'nro_folio',
         'nro_carperta',
         'asignaturas',
         'estudiante',
         'idestudianteactual',
      ]);
      $this->resetValidation();
   }
   //PREEINSCRIPCION

   public $idasignatura;
   public $idasignaturaotras;
   public $tipopago;
   public $numero_deposito;
   public $monto_deposito;
   public $fecha_deposito;
   public $nroDeposito;
   public $fechaDeposito;

   public function preinscibir($idplanificarasignatura, $nrodeposito, $fechadeposito)
   {




      $this->operation = 'savepreinscribir';
      $this->validate();

      $nueva_preinscripcion = new SiadiPreInscripcion();
      $nueva_preinscripcion->id_siadi_persona  = $this->id_estudiante_encontrado;
      $nueva_preinscripcion->id_planificar_asignatura  = $idplanificarasignatura;
      $nueva_preinscripcion->tipo_pago_inscripcion  = 'Depósito';
      $asignatura_seleccionada = SiadiPlanificarAsignatura::find($idplanificarasignatura);

      $nueva_preinscripcion->monto_deposito  = $asignatura_seleccionada->siadi_convocatoria->monto_convocatoria;
      $nueva_preinscripcion->fecha_inscripcion  = $fechadeposito;
      $nueva_preinscripcion->observacion_inscripcion  = 'SIN OBSERVACION';

      $nueva_preinscripcion->nro_deposito  = $nrodeposito;



      $nueva_preinscripcion->save();
      $this->cancelarpre_insc();
      $this->emit('alert', 'se realizo la preinscipcion');
   }
   public function preinscribir_array()
   {
      $this->operation = 'savepreinscribir';
      $this->validate();

      foreach ($this->idasignatura as $idioma => $value) {

        
         $nroDepositoValue = $this->nroDeposito[$idioma] ?? null;
         $fechaDepositoValue = $this->fechaDeposito[$idioma] ?? null;
 if (is_null($nroDepositoValue) || is_null($fechaDepositoValue)) {
         $this->emit('errorvalidate', 'complete los campos');
         }else {
            $nueva_preinscripcion = new SiadiPreInscripcion();
      $nueva_preinscripcion->id_siadi_persona  = $this->id_estudiante_encontrado;
      $nueva_preinscripcion->id_planificar_asignatura  = $value;
      $nueva_preinscripcion->tipo_pago_inscripcion  = 'Depósito';
      $asignatura_seleccionada = SiadiPlanificarAsignatura::find($value);

      $nueva_preinscripcion->monto_deposito  = $asignatura_seleccionada->siadi_convocatoria->monto_convocatoria;
      $nueva_preinscripcion->fecha_inscripcion  = $fechaDepositoValue;
      $nueva_preinscripcion->observacion_inscripcion  = 'SIN OBSERVACION';

      $nueva_preinscripcion->nro_deposito  = $nroDepositoValue;



      $nueva_preinscripcion->save();
         }
      
   
      }
         $this->cancelarpre_insc();
      $this->emit('alert', 'se realizo la preinscipcion');
   }
   public function cancelarpre_insc()
   {
      $this->reset(['nroDeposito', 'fechaDeposito', 'idasignatura']);
      $this->resetValidation();
   }
    public function anular_preincripcion($asignatura,$persona){
        $preinscripcion_activa=SiadiPreInscripcion::where('id_planificar_asignatura',$asignatura)
        ->where('id_siadi_persona',$persona)
        ->where('estado_inscripcion','ACTIVO')
        ->first();

        if ($preinscripcion_activa) {
            $preinscripcion_activa->estado_inscripcion='INACTIVO';
            $preinscripcion_activa->update();
            $this->emit('alert','PREINSCIPCIÓN ANULADA');
            $this->cancelarpre_insc();
        }
    }
   public function cancelarpreinscripcion()
   {
      $this->reset(['nroDeposito', 'tipopago', 'idasignatura', 'fechaDeposito', 'id_estudiante_encontrado', 'ciestudiante', 'nombre_estudiante', 'id_tipo_estudiante_encontrado']);
      $this->resetValidation();
   }

   private function getMateriasHabilitadas($idSiadiAsignatura)
   {
      return DB::select("SELECT * FROM siadi_planificar_asignaturas AS p JOIN siadi_convocatorias AS c ON p.id_siadi_convocatoria = c.id_siadi_convocatoria JOIN siadi_tipo_convocatorias AS tc ON c.id_tipo_convocatoria = tc.id_tipo_convocatoria JOIN siadi_tipo_estudiantes AS te ON tc.id_tipo_estudiante = te.id_tipo_estudiante JOIN siadi_asignaturas AS asi ON p.id_siadi_asignatura = asi.id_siadi_asignatura JOIN siadi_idiomas AS i ON asi.id_idioma= i.id_idioma JOIN siadi_paralelos AS par ON p.id_paralelo = par.id_paralelo JOIN siadi_nivel_idiomas AS niv ON asi.id_nivel_idioma= niv.id_nivel_idioma 
      
       JOIN siadi_convocartoria_estudiantes AS sce ON tc.id_convocartoria_estudiante= sce.id_convocartoria_estudiante  
        JOIN siadi_modalidad_curso AS mt ON c.id_modalidad_curso=mt.id_convocartoria_estudiante WHERE p.id_siadi_asignatura = $idSiadiAsignatura AND p.estado_planificar_asignartura = 'ACTIVO' ;");
   }

   private function getMateriasPredeterminadas()
   {
      return DB::select("SELECT * FROM siadi_planificar_asignaturas AS p 
    JOIN siadi_convocatorias AS c ON p.id_siadi_convocatoria = c.id_siadi_convocatoria 
    JOIN siadi_tipo_convocatorias AS tc ON c.id_tipo_convocatoria = tc.id_tipo_convocatoria 
    JOIN siadi_tipo_estudiantes AS te ON tc.id_tipo_estudiante = te.id_tipo_estudiante 
    
    JOIN siadi_asignaturas AS asig ON p.id_siadi_asignatura =asig.id_siadi_asignatura
    

     JOIN siadi_idiomas AS idiom ON asig.id_idioma= idiom.id_idioma
       JOIN siadi_nivel_idiomas AS na ON asig.id_nivel_idioma = na.id_nivel_idioma
    JOIN siadi_paralelos AS par ON p.id_paralelo = par.id_paralelo
     JOIN siadi_convocartoria_estudiantes AS sce ON tc.id_convocartoria_estudiante= sce.id_convocartoria_estudiante
     JOIN siadi_modalidad_curso AS mt ON c.id_modalidad_curso=mt.id_convocartoria_estudiante
      
    WHERE te.id_tipo_estudiante = $this->id_tipo_estudiante_encontrado AND p.id_siadi_asignatura IN (1, 7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67) AND p.estado_planificar_asignartura = 'ACTIVO' ;");
   }
   private function getMateriasPredeterminadasextepto()
   {
      return DB::select("SELECT * FROM siadi_planificar_asignaturas AS p 
    JOIN siadi_convocatorias AS c ON p.id_siadi_convocatoria = c.id_siadi_convocatoria 
    JOIN siadi_tipo_convocatorias AS tc ON c.id_tipo_convocatoria = tc.id_tipo_convocatoria JOIN siadi_tipo_estudiantes AS te ON tc.id_tipo_estudiante = te.id_tipo_estudiante WHERE te.id_tipo_estudiante = $this->id_tipo_estudiante_encontrado AND p.id_siadi_asignatura IN (1, 7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67) AND p.estado_planificar_asignartura = 'ACTIVO';");
   }



   public function render()
   {

      $materiaActualAymara = null;
      $materiaActualIngles = null;
      $materiaActualCastellano = null;
      $materiaActualQuechua = null;
      $materiaActualChinoMandarin = null;
      $materiaActualPortugues = null;
      $materiaActualFrances = null;
      $materiaActualItaliano = null;
      $materiaActualAleman = null;
      $materiaActualGuarani = null;
      $materiaActualUruPukina = null;
      $materiaActualUruRuso = null;
      $materiasaprobadas = [];
      $materiaAtomarhabilitadas = [];
      $idiomasExcluidos = [];
      $OtrasAsignaturasHabilitadas = [];
      if ($this->id_estudiante_encontrado) {

         $materiasaprobadas = DB::table('siadi_inscripcions AS i')
            ->join('siadi_planificar_asignaturas AS pa', 'i.id_planificar_asignatura', '=', 'pa.id_planificar_asignatura')
            ->join('siadi_asignaturas AS a', 'pa.id_siadi_asignatura', '=', 'a.id_siadi_asignatura')
            ->join('siadi_idiomas AS ia', 'a.id_idioma', '=', 'ia.id_idioma')
            ->join('siadi_nivel_idiomas AS na', 'a.id_nivel_idioma', '=', 'na.id_nivel_idioma')
            ->join('siadi_notas AS n', 'i.id_inscripcion', '=', 'n.id_inscripcion')
            ->select('i.id_inscripcion', 'pa.id_planificar_asignatura', 'a.id_siadi_asignatura', 'ia.id_idioma')
            ->where('i.id_siadi_persona', $this->id_estudiante_encontrado)
            ->where('n.final_nota', '>=', 51)
            ->orderBy('ia.id_idioma') // Specify the column to order by
            ->orderBy('pa.id_planificar_asignatura') // Specify the column to order by in descending order
            ->get();

         foreach ($materiasaprobadas as $materia) {

            if ($materia->id_idioma == 1) {

               if ($materia->id_siadi_asignatura == 1) {
                  $materiaActualAymara = 2;
               } elseif ($materia->id_siadi_asignatura == 2) {
                  $materiaActualAymara = 3;
               } elseif ($materia->id_siadi_asignatura == 3) {
                  $materiaActualAymara = 4;
               } elseif ($materia->id_siadi_asignatura == 4) {
                  $materiaActualAymara = 5;
               } elseif ($materia->id_siadi_asignatura == 5) {
                  $materiaActualAymara = 6;
               }
            } elseif ($materia->id_idioma == 2) {
               if ($materia->id_siadi_asignatura == 7) {
                  $materiaActualIngles = 8;
               } elseif ($materia->id_siadi_asignatura == 8) {
                  $materiaActualIngles = 9;
               } elseif ($materia->id_siadi_asignatura == 9) {
                  $materiaActualIngles = 10;
               } elseif ($materia->id_siadi_asignatura == 10) {
                  $materiaActualIngles = 11;
               } elseif ($materia->id_siadi_asignatura == 11) {
                  $materiaActualIngles = 12;
               }
            } elseif ($materia->id_idioma == 3) {
               if ($materia->id_siadi_asignatura == 13) {
                  $materiaActualCastellano = 14;
               } elseif ($materia->id_siadi_asignatura == 14) {
                  $materiaActualCastellano = 15;
               } elseif ($materia->id_siadi_asignatura == 15) {
                  $materiaActualCastellano = 16;
               } elseif ($materia->id_siadi_asignatura == 16) {
                  $materiaActualCastellano = 17;
               } elseif ($materia->id_siadi_asignatura == 17) {
                  $materiaActualCastellano = 18;
               }
            } elseif ($materia->id_idioma == 4) {
               if ($materia->id_siadi_asignatura == 19) {
                  $materiaActualQuechua = 20;
               } elseif ($materia->id_siadi_asignatura == 20) {
                  $materiaActualQuechua = 21;
               } elseif ($materia->id_siadi_asignatura == 21) {
                  $materiaActualQuechua = 22;
               } elseif ($materia->id_siadi_asignatura == 22) {
                  $materiaActualQuechua = 23;
               } elseif ($materia->id_siadi_asignatura == 23) {
                  $materiaActualQuechua = 24;
               }
            } elseif ($materia->id_idioma == 5) {
               if ($materia->id_siadi_asignatura == 25) {
                  $materiaActualChinoMandarin = 26;
               } elseif ($materia->id_siadi_asignatura == 26) {
                  $materiaActualChinoMandarin = 27;
               } elseif ($materia->id_siadi_asignatura == 27) {
                  $materiaActualChinoMandarin = 28;
               } elseif ($materia->id_siadi_asignatura == 28) {
                  $materiaActualChinoMandarin = 29;
               } elseif ($materia->id_siadi_asignatura == 29) {
                  $materiaActualChinoMandarin = 30;
               }
            } elseif ($materia->id_idioma == 6) {
               if ($materia->id_siadi_asignatura == 31) {
                  $materiaActualPortugues = 32;
               } elseif ($materia->id_siadi_asignatura == 32) {
                  $materiaActualPortugues = 33;
               } elseif ($materia->id_siadi_asignatura == 33) {
                  $materiaActualPortugues = 34;
               } elseif ($materia->id_siadi_asignatura == 34) {
                  $materiaActualPortugues = 35;
               } elseif ($materia->id_siadi_asignatura == 35) {
                  $materiaActualPortugues = 36;
               }
            } elseif ($materia->id_idioma == 7) {
               if ($materia->id_siadi_asignatura == 37) {
                  $materiaActualFrances = 38;
               } elseif ($materia->id_siadi_asignatura == 38) {
                  $materiaActualFrances = 39;
               } elseif ($materia->id_siadi_asignatura == 39) {
                  $materiaActualFrances = 40;
               } elseif ($materia->id_siadi_asignatura == 40) {
                  $materiaActualFrances = 41;
               } elseif ($materia->id_siadi_asignatura == 41) {
                  $materiaActualFrances = 42;
               }
            } elseif ($materia->id_idioma == 8) {
               if ($materia->id_siadi_asignatura == 43) {
                  $materiaActualItaliano = 44;
               } elseif ($materia->id_siadi_asignatura == 44) {
                  $materiaActualItaliano = 45;
               } elseif ($materia->id_siadi_asignatura == 45) {
                  $materiaActualItaliano = 46;
               } elseif ($materia->id_siadi_asignatura == 46) {
                  $materiaActualItaliano = 47;
               } elseif ($materia->id_siadi_asignatura == 47) {
                  $materiaActualItaliano = 48;
               }
            } elseif ($materia->id_idioma == 9) {
               if ($materia->id_siadi_asignatura == 49) {
                  $materiaActualAleman = 50;
               } elseif ($materia->id_siadi_asignatura == 50) {
                  $materiaActualAleman = 51;
               } elseif ($materia->id_siadi_asignatura == 51) {
                  $materiaActualAleman = 52;
               } elseif ($materia->id_siadi_asignatura == 52) {
                  $materiaActualAleman = 53;
               } elseif ($materia->id_siadi_asignatura == 53) {
                  $materiaActualAleman = 54;
               }
            } elseif ($materia->id_idioma == 10) {
               if ($materia->id_siadi_asignatura == 55) {
                  $materiaActualGuarani = 56;
               } elseif ($materia->id_siadi_asignatura == 56) {
                  $materiaActualGuarani = 57;
               } elseif ($materia->id_siadi_asignatura == 57) {
                  $materiaActualGuarani = 58;
               } elseif ($materia->id_siadi_asignatura == 58) {
                  $materiaActualGuarani = 59;
               } elseif ($materia->id_siadi_asignatura == 59) {
                  $materiaActualGuarani = 60;
               }
            } elseif ($materia->id_idioma == 11) {
               if ($materia->id_siadi_asignatura == 61) {
                  $materiaActualUruPukina = 62;
               } elseif ($materia->id_siadi_asignatura == 62) {
                  $materiaActualUruPukina = 63;
               } elseif ($materia->id_siadi_asignatura == 63) {
                  $materiaActualUruPukina = 64;
               } elseif ($materia->id_siadi_asignatura == 64) {
                  $materiaActualUruPukina = 65;
               } elseif ($materia->id_siadi_asignatura == 65) {
                  $materiaActualUruPukina = 66;
               }
            } elseif ($materia->id_idioma == 12) {
               if ($materia->id_siadi_asignatura == 67) {
                  $materiaActualUruRuso = 68;
               } elseif ($materia->id_siadi_asignatura == 68) {
                  $materiaActualUruRuso = 69;
               } elseif ($materia->id_siadi_asignatura == 69) {
                  $materiaActualUruRuso = 70;
               } elseif ($materia->id_siadi_asignatura == 70) {
                  $materiaActualUruRuso = 71;
               } elseif ($materia->id_siadi_asignatura == 71) {
                  $materiaActualUruRuso = 72;
               }
            }
         }

         if ($materiaActualAymara != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualAymara);
         }
         if ($materiaActualIngles != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualIngles);
         }
         if ($materiaActualCastellano != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualCastellano);
         }
         if ($materiaActualQuechua != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualQuechua);
         }
         if ($materiaActualChinoMandarin != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualChinoMandarin);
         }
         if ($materiaActualPortugues != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualPortugues);
         }
         if ($materiaActualFrances != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualFrances);
         }
         if ($materiaActualItaliano != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualItaliano);
         }
         if ($materiaActualAleman != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualAleman);
         }
         if ($materiaActualGuarani != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualGuarani);
         }
         if ($materiaActualUruPukina != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualUruPukina);
         }
         if ($materiaActualUruRuso != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualUruRuso);
         }

         if ($materiaActualAymara != null) {
            $idiomasExcluidos[] = 1;
         }
         if ($materiaActualIngles != null) {
            $idiomasExcluidos[] = 2;
         }
         if ($materiaActualCastellano != null) {
            $idiomasExcluidos[] = 3;
         }
         if ($materiaActualQuechua != null) {
            $idiomasExcluidos[] = 4;
         }
         if ($materiaActualChinoMandarin != null) {
            $idiomasExcluidos[] = 5;
         }
         if ($materiaActualPortugues != null) {
            $idiomasExcluidos[] = 6;
         }
         if ($materiaActualFrances != null) {
            $idiomasExcluidos[] = 7;
         }
         if ($materiaActualItaliano != null) {
            $idiomasExcluidos[] = 8;
         }
         if ($materiaActualAleman != null) {
            $idiomasExcluidos[] = 9;
         }
         if ($materiaActualGuarani != null) {
            $idiomasExcluidos[] = 10;
         }
         if ($materiaActualUruPukina != null) {
            $idiomasExcluidos[] = 11;
         }
         if ($materiaActualUruRuso != null) {
            $idiomasExcluidos[] = 12;
         }




         if ($idiomasExcluidos) {
            $OtrasAsignaturasHabilitadas = DB::select("
    SELECT * 
    FROM siadi_planificar_asignaturas AS p 
    JOIN siadi_convocatorias AS c ON p.id_siadi_convocatoria = c.id_siadi_convocatoria 
    JOIN siadi_tipo_convocatorias AS tc ON c.id_tipo_convocatoria = tc.id_tipo_convocatoria 
    JOIN siadi_tipo_estudiantes AS te ON tc.id_tipo_estudiante = te.id_tipo_estudiante 
    JOIN siadi_asignaturas AS asig ON p.id_siadi_asignatura = asig.id_siadi_asignatura 
    JOIN siadi_idiomas AS idiom ON asig.id_idioma = idiom.id_idioma 
    JOIN siadi_nivel_idiomas AS na ON asig.id_nivel_idioma = na.id_nivel_idioma
    JOIN siadi_paralelos AS par ON p.id_paralelo = par.id_paralelo
      JOIN siadi_convocartoria_estudiantes AS sce ON tc.id_convocartoria_estudiante= sce.id_convocartoria_estudiante
    JOIN siadi_modalidad_curso AS mt ON c.id_modalidad_curso=mt.id_convocartoria_estudiante
    AND p.id_siadi_asignatura IN (1, 7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67) 
    AND p.estado_planificar_asignartura = 'ACTIVO' 
       AND asig.id_idioma  NOT IN (" . implode(',', $idiomasExcluidos) . ");
");
         } else {
            $OtrasAsignaturasHabilitadas = $this->getMateriasPredeterminadas();
         }
      }




      $materias_preinscritas = SiadiPreInscripcion::where('id_siadi_persona', $this->idestudianteactual)
         ->where('estado_inscripcion', 'ACTIVO')

         ->get();
      // $lista_pre_inscritos=SiadiPreInscripcion::paginate();
      $estudiante_seleccionado = SiadiPersona::where('id_siadi_persona', $this->idestudianteactual)->first();

      //editar inscripcion
      $personaunica = SiadiPersona::where('id_siadi_persona', $this->idpersona)->first();

      $asignaturas_validas = []; // Inicializa la variable

      $asignaturas_deplanifi_actual = SiadiPlanificarAsignatura::where('id_planificar_asignatura', $this->asignaturaid)->first();

      if ($asignaturas_deplanifi_actual) {
         $asignaturas_validas =
            DB::select("
     SELECT * 
    FROM siadi_planificar_asignaturas AS p 
    JOIN siadi_convocatorias AS c ON p.id_siadi_convocatoria = c.id_siadi_convocatoria 
    JOIN siadi_tipo_convocatorias AS tc ON c.id_tipo_convocatoria = tc.id_tipo_convocatoria 
    JOIN siadi_tipo_estudiantes AS te ON tc.id_tipo_estudiante = te.id_tipo_estudiante 
    JOIN siadi_asignaturas AS asig ON p.id_siadi_asignatura = asig.id_siadi_asignatura 
    JOIN siadi_idiomas AS idiom ON asig.id_idioma = idiom.id_idioma 
    JOIN siadi_nivel_idiomas AS na ON asig.id_nivel_idioma = na.id_nivel_idioma
    JOIN siadi_paralelos AS par ON p.id_paralelo = par.id_paralelo
    WHERE te.id_tipo_estudiante = $this->tipopersonaunica 
    
    AND p.estado_planificar_asignartura = 'ACTIVO' 
    AND p.id_siadi_asignatura= $asignaturas_deplanifi_actual->id_siadi_asignatura;
");
      }

      // $personapreinscrita = $query->paginate(5);
      $query = SiadiPersona::query();

      $query->whereHas('persona_preinscrita', function ($query) {
         $query->where('observacion_inscripcion', 'SIN OBSERVACION')
            ->where('estado_inscripcion', 'ACTIVO')->orderBy('id_pre_inscripcion', 'desc');
      });

      if (!empty($this->search)) {
         $searchTerms = explode(' ', $this->search);

         $query->where(function ($subquery) use ($searchTerms) {
            foreach ($searchTerms as $term) {
               $subquery->orWhere('ci_persona', 'like', '%' . $term . '%')
                  ->orWhere(DB::raw("CONCAT(nombres_persona, ' ',paterno_persona, ' ', materno_persona)"), 'like', '%' . $term . '%');
            }
         });
      }

      $personapreinscrita = $query->paginate(20);
      return view('livewire.administracion-modulos.pre-inscripcion-index', compact('personapreinscrita', 'estudiante_seleccionado', 'materias_preinscritas', 'materiasaprobadas', 'materiaActualAymara', 'materiaActualIngles', 'materiaAtomarhabilitadas', 'OtrasAsignaturasHabilitadas', 'idiomasExcluidos', 'personaunica', 'asignaturas_validas'));
   }

   //EDITAR INSCRIPCION
   public $asignaturaid;
   public $asignaturaGuardar;
   public $id_inscripcion_actual;
   public  $idpersona;
   public $tipopersonaunica;
   public $nombre_asignatura_edit;
   public function inscribireditar($persona)
   {
      $this->idpersona = $persona;
      $persona_encontrada = SiadiPersona::find($persona);
      $this->tipopersonaunica = $persona_encontrada->id_tipo_estudiante;
      $this->emit('abrimodaleditarinscripcion');
   }


   public function editarasig($asignat)
   {

      $this->resetValidation();
      $inscripcion_ac = SiadiInscripcion::where('id_inscripcion', $asignat)->first();
      $this->asignaturaid = $inscripcion_ac->id_planificar_asignatura;
      $this->asignaturaGuardar = $inscripcion_ac->id_planificar_asignatura;
      $this->id_inscripcion_actual = $asignat;
      $this->nombre_asignatura_edit = $inscripcion_ac->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma . ' ' . $inscripcion_ac->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma . ' ' . $inscripcion_ac->planificar_asignatura->siadi_paralelo->nombre_paralelo;
   }
   public function guardareditarinscripcion()
   {
      $this->operation = 'saveeditinscipcion';
      $this->validate();




      $inscripcion = SiadiInscripcion::find($this->id_inscripcion_actual);
      $inscripcion->fill([
         'id_planificar_asignatura'          => $this->asignaturaGuardar,
      ]);
      $inscripcion->save();
      $this->emit('alert', 'Se editó satisfactoriamente');
   }
}
