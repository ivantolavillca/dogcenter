<?php

namespace App\Http\Livewire\AdministracionModulos;
use Illuminate\Support\Facades\Auth;

use App\Models\AdministracionModulos\SiadiGestion;
use App\Models\AdministracionModulos\SiadiConvocatoria;
use App\Models\AdministracionModulos\SiadiAsignatura;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\Pais;

use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\base_upea\tabla_persona;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

use App\Models\AdministracionModulos\SiadiTipoEstudiante;

use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiNota;
use Livewire\Component;

class MigrarIndex extends Component
{
    public function render()
    {
        
        return view('livewire.administracion-modulos.migrar-index', [
            'gestiones' => $this->get_gestiones(),
            'periodos' =>  $this->get_periodos(),
            'convocatorias' => $this->get_convocatorias(),

            'asignaturas' => $this->get_asignaturas(),
            'estudiante_buscar_esta_inscrito' => $this->verificar_inscripcion_asignatura(),
            'paises' => ($this->operation=='guardar_persona')? $this->filldDataPaises(): [],
            'tipo_estudiante2' => SiadiTipoEstudiante::where('estado_tipo_estudiante', '<>','ELIMINAR')->get()
        ]);
    }

   public $expedido_data = [];
   public $estados_civiles = [];
   public function mount(){
        $this->estados_civiles = include( app_path('ArraysData/estado_civil_data.php') );
        $this->expedido_data = include( app_path('ArraysData/extension_data.php') );
    }

    private function get_gestiones(){
        return SiadiGestion::where('estado_gestion', '<>', 'ELIMINAR')
            ->latest('nombre_gestion')
            ->get();
    }

    private function get_periodos(){
        return SiadiConvocatoria::select('periodo')
            ->where('estado_convocatoria', '<>', 'ELIMINADO')
            ->where('id_gestion', $this->gestion)
            ->groupBy('periodo')
            ->get();
    }

    private function get_convocatorias(){
        return SiadiConvocatoria::
            where('estado_convocatoria', '<>', 'ELIMINADO')
            ->where('id_gestion', $this->gestion)
            ->where('periodo', $this->periodo)
            ->get();
    }

    private function get_asignaturas(){
        return SiadiAsignatura::
            from('siadi_asignaturas')
            ->join('siadi_planificar_asignaturas', function($query){
                    $query->on('siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura');
                })
            ->join('siadi_convocatorias', function($query){
                    $query->on('siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria');
                })
            ->select(
                '*',
                'siadi_convocatorias.id_siadi_convocatoria',
                'siadi_convocatorias.nombre_convocatoria',
                'id_modalidad_curso'
            )
            ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
            ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
            ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO')
                
            ->where([
                'siadi_convocatorias.id_gestion' => $this->gestion,
                'siadi_convocatorias.periodo' => $this->periodo,
                'siadi_convocatorias.sede' => $this->sede,
                'siadi_convocatorias.id_siadi_convocatoria' => $this->id_convocatoria
            ])
            ->groupBy(\DB::raw("CONCAT(siadi_asignaturas.id_idioma, '.', siadi_asignaturas.id_nivel_idioma)"))
            ->orderBy('siadi_asignaturas.id_idioma', 'asc')
            ->orderBy('siadi_asignaturas.id_nivel_idioma', 'asc')
            ->get(); #->paginate(5);
    }




    public $gestion, $statusGestion;
    public $periodo, $statusPeriodo;
    public $tipo_convocatoria = "", $statusTipoConvocatoria, $sede="", $id_convocatoria = "";
    public $tipo_asignatura = "", $statusAsignatura;

    public function on_change_gestion(){
        if($this->gestion==""){
            $this->statusPeriodo = false;
        } else {
            $this->statusPeriodo = true;
        }
        $this->periodo =  $this->sede = $this->tipo_convocatoria = $this->tipo_asignatura = "";
        $this->statusTipoConvocatoria = $this->statusAsignatura = false;
    }

    public function on_change_periodo(){
        if($this->periodo==""){
            $this->statusTipoConvocatoria = false;
        } else {
            $this->statusTipoConvocatoria = true;
        }
        $this->sede = $this->tipo_convocatoria = $this->tipo_asignatura = "";
        $this->statusAsignatura = false;
    }

    public function on_change_tipo_convocatoria(){
        if($this->tipo_convocatoria==""){
            $this->statusAsignatura = false;
            $this->sede = $this->id_convocatoria = "";
        } else {
            $this->statusAsignatura = true;
            $this->sede = explode(';', $this->tipo_convocatoria)[1];
            $this->id_convocatoria = explode(';', $this->tipo_convocatoria)[0];
        }
        $this->tipo_asignatura = "";
    }



    /* ------------------------  INIT RULES ----------------------- */
    public $operation;
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        # tipo de operacion
        if($this->operation=='buscar_por_ci'){
            return $this->rulesForSearchCI();
        } else if($this->operation=='guardar_persona'){ 
            return $this->rulesForSavePersona();
        } else if($this->operation=='guardar_inscripcion_notas'){
            return $this->rulesForSaveInscripcion();
        }
        return array_merge($this->rulesForSearchCI(), $this->rulesForSavePersona(), $this->rulesForSaveInscripcion()
        );
    }

    protected function rulesForSearchCI(){
        return [
            'ci_buscar' => 'required|min:3|max:15|regex:/^[0-9]{4,12}(-[A-Z0-9]{1,2})?$/i',
        ];
    }

    protected function rulesForSavePersona(){
        $rule_paterno = is_null($this->materno) || trim($this->materno)==''? 'required': 'nullable';
        $rule_materno = is_null($this->paterno) || trim($this->paterno)==''? 'required': 'nullable';
        return [
            'ci' =>'required|unique:siadi_personas,ci_persona|max:15',
            'nombre' =>'required|min:3|max:100|uppercase|regex:/^\S(.*\S)?$/', # regex:/^\S(.*\S)?$/ => para evitar espacios en blanco inicio final
            'paterno' => $rule_paterno .'|min:3|max:100|uppercase|regex:/^\S*$/', # regex:/^\S*$/ => para evitar espacios en blanco
            'materno' => $rule_materno .'|min:3|max:100|uppercase|regex:/^\S*$/',
            'email' =>'required|email|unique:siadi_personas,email_persona',
            'expedido' =>'required',
            'tipo_documento' => 'required',
            'direccion' =>'required',
            'telefono' =>'nullable|integer|digits_between:7,8',
            'celular' =>'required|integer|digits:8',
            'estado_civil' =>'required',
            'fecha_nacimiento' => 'required|date|date_format:Y-m-d|before_or_equal:'.date('Y-m-d', strtotime('-5 year')),
            'pais' => [
                'required', 
                /* Rule::in(array_keys($this->paises)) */
            ],
            'genero' => [
                'required',
                Rule::in(['F', 'M'])
            ],
            'profesion' =>'required',
            
           'tipo_estudiante' =>'required',
            
        ];
    }

    /* public updatedCiBuscar(){

    } */

    protected function rulesForSaveInscripcion(){
        $rule_nro_deposito = $this->statusNroDeposito? 'required|digits_between:5,15': '';
        return [
            'fecha_inscripcion' => 'date|date_format:Y-m-d|after_or_equal:1950-09-05|before_or_equal:today',
            'tipo_pago' => [
                'required',
                Rule::in($this->tipos_de_deposito)
            ],
            'monto_deposito' => 'required|integer|between:0,1500',
            'nro_deposito' => $rule_nro_deposito,

            'nota_final' => 'required|integer|between:0,100',
            'nro_folio' => 'nullable|integer|min:0|max:10000',
            'nro_carpeta_nota' => 'nullable|integer|min:0|max:10000'
        ];
    }

    protected $validationAttributes = [
        'ci_buscar' => '"CI"',

        'fecha_inscripcion' => '"FECHA DE INSCRIPCIÓN"',
        'tipo_pago' => '"TIPO DE PAGO"',
        'monto_deposito' => '"MONTO DE DEPÓSITO"',
        'nro_deposito' => '"NRO. DE DEPÓSITO"',

        'nota_final' => '"NOTA FINAL"',
        'nro_folio' => '"NRO. DE FOLIO"',
        'nro_carpeta_nota' => '"NRO. DE LIBRO"'
    ];

    protected $messages = [
        'nombre.regex' => 'El campo :attribute no puede contener espacios en blanco al inicio o al final.',
        'paterno.regex' => 'El campo :attribute no puede contener espacios en blanco.',
        'materno.regex' => 'El campo :attribute no puede contener espacios en blanco.'
    ];
    /* -------------------------  END RULES ----------------------- */

    

    # CI BUSCAR
    public $ci_buscar;
    public $asignatura_actual;
    public $estudiante_buscar_existe_local;
    
    public function show_asignatura($id_asignatura){
        $this->fillDataAsignaturaActual($id_asignatura);
        if( !is_null($this->asignatura_actual )){
            #$this->asignatura_actual = get_object_vars( $this->asignatura_actual );
            $this->operation = 'buscar_por_ci';
            $this->emit('showModalVerificarInscripcion');
        } else {
            $this->emit('errorvalidate', "No se encontró asignatura");
        }
        
    }

    public function close_asignatura(){
        $this->emit('closeModalVerificarInscripcion');
        $this->asignatura_actual = null;
        $this->reset([
            'ci_buscar'
        ]);
        $this->resetValidation();
        $this->operation = '';
    }

    private function verificar_inscripcion_asignatura(){
        #$this->validate();
        if(strlen($this->ci_buscar)>=3){
            // verificar si esta en la materia
            $this->estudiante_buscar_existe_local = SiadiPersona::where('siadi_personas.estado_persona', '<>', 'ELIMINAR')->where('siadi_personas.ci_persona', '=', $this->ci_buscar)->first();
            return SiadiPersona::
                  join('siadi_inscripcions', 'siadi_inscripcions.id_siadi_persona', '=', 'siadi_personas.id_siadi_persona')
                ->join('siadi_planificar_asignaturas', 'siadi_planificar_asignaturas.id_planificar_asignatura', '=', 'siadi_inscripcions.id_planificar_asignatura')
                ->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
                ->where([
                    'siadi_convocatorias.id_gestion' => $this->gestion,
                    'siadi_convocatorias.periodo' => $this->periodo,
                    'siadi_convocatorias.sede' => $this->sede, 
                    'siadi_convocatorias.id_siadi_convocatoria' => $this->id_convocatoria,
                    'siadi_planificar_asignaturas.id_siadi_asignatura' => $this->asignatura_actual->id_siadi_asignatura, 
                    'siadi_personas.ci_persona' => $this->ci_buscar
                ])
                ->where('siadi_personas.estado_persona', '<>', 'ELIMINAR')
                ->where('siadi_inscripcions.estado_inscripcion', '<>', 'ELIMINADO')
                ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
                ->where('siadi_convocatorias.estado_convocatoria', '<>','ELIMINADO')
    
                ->first();
        } else {
            $this->estudiante_buscar_existe_local = null;
            return null;
        }
    }


    private function fillDataAsignaturaActual($id_asignatura){
        $this->asignatura_actual = SiadiAsignatura::
            from('siadi_asignaturas')
            ->join('siadi_planificar_asignaturas', function($query){
                    $query->on('siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura');
                })
            ->join('siadi_convocatorias', function($query){
                    $query->on('siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria');
                })
            ->join('siadi_modalidad_curso', function($query){
                $query->on('siadi_modalidad_curso.id_convocartoria_estudiante', '=', 'siadi_convocatorias.id_modalidad_curso');
            })
            ->join('siadi_costos', function($query){
                $query->on('siadi_costos.id_costo', '=', 'siadi_convocatorias.id_costo');
            })
            ->select(
                '*',
                'siadi_convocatorias.id_siadi_convocatoria',
                'siadi_convocatorias.nombre_convocatoria',
                'siadi_convocatorias.id_modalidad_curso',
                'siadi_modalidad_curso.nombre_convocatoria_estudiante'
            )
            ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINADO')
            ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
            ->where('siadi_convocatorias.estado_convocatoria', '<>','ELIMINADO')
            ->where('siadi_modalidad_curso.estado_convocatoria_estudiante', '<>', 'ELIMINAR')
            ->where('siadi_costos.estado_costo', '<>', 'ELIMINAR')

            ->where([
                'siadi_convocatorias.id_gestion' => $this->gestion,
                'siadi_convocatorias.periodo' => $this->periodo,
                #'siadi_convocatorias.sede' => $this->sede,
                'siadi_convocatorias.id_siadi_convocatoria' => $this->id_convocatoria,
                'siadi_asignaturas.id_siadi_asignatura' => $id_asignatura
            ])
            ->first();
    }




    # FORM 02 registrar estudiante
    public $ci;
    public $expedido;
    public $tipo_documento;
    public $estado_civil;
    public $paterno;
    public $materno;
    public $nombre;
    public $pais;
    public $genero;
    public $fecha_nacimiento;
    public $profesion;
    public $direccion;
    public $telefono;
    public $celular;
    public $email;
    public $tipo_estudiante;
    public $id_persona_base_upea;

    private function buscarpersona(){
        $persona_encontrada=tabla_persona::select(
            'id',
            'ci',
            'expedido',
            'tipo_documento',
            'estado_civil',
            'paterno',
            'materno',
            'nombre',
            \DB::raw("CASE 
                WHEN TRIM(UPPER(nacionalidad)) IN('BALIVIANA', 'BILIVIANA', 'BOLIIANA', 'BOLIIVIANA', 'BOLIVANA', 'BOLIVANO', 'BOLIVIANA', 'BOLIVIANO', 'BOLIVIANO (A)', 'BOLIVINA', 'BOLVIANA', 'BOLVIANO') THEN '1' -- 1,  BOLIVIA
                WHEN TRIM(UPPER(nacionalidad)) IN('BRASILEÑO', 'BRASILERA') THEN '21' -- 21, brasil
                WHEN TRIM(UPPER(nacionalidad)) IN('PERU', 'PERÚ') THEN '2' -- 2, peru
                ELSE (
                    SELECT sp.id_siadi_pais
                    FROM ". env('DB_DATABASE') .".siadi_pais sp
                    WHERE TRIM(UPPER(persona.nacionalidad)) COLLATE utf8mb3_general_ci = TRIM(UPPER(sp.nombre_siadi_pais))
                    LIMIT 1
                )
            END nacionalidad"), #'nacionalidad',
            #\DB::raw("CONCAT(direccion_calle, ' ', CASE WHEN direccion_numero IS NULL OR direccion_numero='' THEN 'S/N' ELSE CONCAT('#', direccion_numero) END, ' ', direccion_zona_barrio_urbanizacion) AS direccion"),
            'direccion',
            'genero',
            'fecha_nac',
            'telefono',
            'celular',
            'email'
        )
        ->where('ci',$this->ci_buscar)->first();

        if (!is_null($persona_encontrada)) {
            #$this->emit("mostrar", json_encode($persona_encontrada));
            $this->id_persona_base_upea = $persona_encontrada->id ;
            $this->ci = $persona_encontrada->ci ;
            $this->expedido = $persona_encontrada->expedido;
            $this->tipo_documento = "CI"; #$persona_encontrada->tipo_documento;
            $this->estado_civil = $persona_encontrada->estado_civil;
            $this->paterno = $persona_encontrada->paterno;
            $this->materno = $persona_encontrada->materno;
            $this->nombre = $persona_encontrada->nombre;
            $this->pais = $persona_encontrada->nacionalidad;
            $this->genero = $persona_encontrada->genero;
            $this->fecha_nacimiento = $persona_encontrada->fecha_nac;
            $this->direccion = $persona_encontrada->direccion;
            $this->telefono = $persona_encontrada->telefono;
            $this->celular = $persona_encontrada->celular;
            $this->email = mb_strtolower($persona_encontrada->email);
        }else {
            $this->id_persona_base_upea='';
            $this->ci = $this->ci_buscar;
            #$this->pais = 'BOLIVIA';
        }
    }


    public function mostrar_form_registrar_persona(){
        $this->validate();
        # $this->emit('mostrar', 'operation = '. $this->operation);
        if($this->operation=='buscar_por_ci'){
            $this->operation = 'guardar_persona';
            //$this->filldDataPaises();
            $this->buscarpersona();
            $this->emit('showModalAgregarPersona');
        }
    }

    public function guardar_persona_migracion(){
        if($this->operation =='guardar_persona'){
            $this->validate();
            
            try { 
                \DB::beginTransaction();
                $create_persona = new SiadiPersona();
                $create_persona->ci_persona = $this->ci;
                $create_persona->expedido_persona = $this->expedido;
                $create_persona->tipo_documento = "CI"; #$this->tipo_documento;
                if ($this->id_persona_base_upea) {
                    $create_persona->id_persona_base_upea =$this->id_persona_base_upea;
                }
                
                $create_persona->estado_civil_persona = $this->estado_civil;
                $create_persona->paterno_persona = $this->paterno;
                $create_persona->materno_persona = $this->materno;
                $create_persona->nombres_persona = $this->nombre;
                $create_persona->id_pais = $this->pais;
                $pais_nombre = Pais::where('id_siadi_pais', '=', $this->pais)->first();
                $create_persona->pais_persona = $pais_nombre->nombre_siadi_pais;
                $create_persona->genero_persona = $this->genero;
                $create_persona->fecha_nacimiento_persona = $this->fecha_nacimiento;
                $create_persona->profesion_persona = $this->profesion;
                $create_persona->direccion_persona = $this->direccion;
                if($this->telefono=="" || is_null($this->telefono)){
                    $create_persona->telefono_persona = null;
                } else {
                    $create_persona->telefono_persona = $this->telefono;
                }
                $create_persona->celular_persona = $this->celular;
                $create_persona->email_persona  = $this->email;
                $create_persona->id_tipo_estudiante = $this->tipo_estudiante;
                $create_persona->save();

                #buscar rol de estudiante
                $rol = Role::where('name', 'Estudiante')->first();

                # creación de usuario tcon rol de estudiante
                $user = new User();
                $user->name    = $create_persona->nombres_persona;
                $user->ci      = $create_persona->ci_persona;
                $user->paterno = $create_persona->paterno_persona;
                $user->materno = $create_persona->materno_persona;
                $user->id_persona = $create_persona->id_siadi_persona;
                $user->email   = $create_persona->email_persona;
                $contrasenia = $user->name. '_'. $user->ci; # nombres + _ + ci_sin_extension
                $user->password   = bcrypt($contrasenia);
                $user->assignRole($rol);
                $user->save();
                \DB::commit();

                $this->close_agregar_persona();
                $this->emit('alertCreateUser','Usuario: <b>'. $user->email. '</b><br>Contraseña: <b>'. $contrasenia .'</b>');
            } catch (\Exception $e) {
                \DB::rollback();
                #throw $e;
                $this->emit("errorvalidate", "Ups. Ocurrio un error al Usuario \n". $e->getMessage());
            }
        } else {
            $this->emit('errorvalidate','Acceso ilegal');
        }
    }


    public function close_agregar_persona(){
        $this->emit('closeModalAgregarPersona');
        $this->operation = 'buscar_por_ci';

        $this->reset([
            'ci',
            'expedido',
            'tipo_documento',
            'id_persona_base_upea',
            'estado_civil',
            'paterno',
            'materno',
            'nombre',
            'pais',
            'genero',
            'fecha_nacimiento',
            'profesion',
            'direccion',
            'telefono',
            'celular',
            'email',
            'tipo_estudiante',
        ]);
        //$this->paises = [];
        $this->resetValidation();
    }

    private function filldDataPaises(){
        $this->paises = Pais::leftJoin('siadi_personas', 'siadi_personas.id_pais', '=', 'siadi_pais.id_siadi_pais')
            ->select(
                'siadi_pais.id_siadi_pais',
                \DB::raw("COUNT(*)AS  total"),
                'siadi_pais.nombre_siadi_pais'
            )
            ->groupBy('id_siadi_pais')
            ->orderBy('total', 'desc')
            ->orderBy('nombre_siadi_pais', 'asc')
            ->get();
        /* try{
            #$this->paises = require storage_path('app/ArraysData/countries_array.php');
            $this->paises = include( app_path('ArraysData/countries_array.php') );
        } catch(\Exception $e){
            $this->paises = [
            	"Argentina" => [
        			"code_2" => "AR",
        			"continent_es" => "América del Sur",
        			"emoji" => "🇦🇷"
    			],
    			"Bolivia" => [
        			"code_2" => "BO",
        			"continent_es" => "América del Sur",
        			"emoji" => "🇧🇴"
    			],
    			"Brasil" => [
        			"code_2" => "BR",
        			"continent_es" => "América del Sur",
         			"emoji" => "🇧🇷"
    			],
                "CHILE" => [
                    "code_2" => "CL",
                    "continent_es" => "América del Sur",
                    "emoji" => "🇨🇱"
                ],
                "PARAGUAY" => [
                    "code_2" => "PY",
                    "continent_es" => "América del Sur",
                    "emoji" => "🇵🇾"
                ],
                "PERÚ" => [
                    "code_2" => "PE",
                    "continent_es" => "América del Sur",
                    "emoji" => "🇵🇪"
                ],
			];
        } */
    }

    public $dataPlanificarAsignaturaForm;
    public $tipos_de_deposito = [];

    #    FORM 03
    public $fecha_inscripcion;
    public $tipo_pago;
    public $monto_deposito;
    public $nro_deposito; public $statusNroDeposito;

    public $nota_final;
    public $nota_observacion;
    public $nro_folio;
    public $nro_carpeta_nota;

    public function mostrar_form_inscribir($id_planif_asignatura){
        $this->validate();
        # $this->emit('mostrar', 'operation = '. $this->operation);
        if($this->operation=='buscar_por_ci'){
            $this->reset_form_inscribir();
            $this->dataPlanificarAsignaturaForm = SiadiPlanificarAsignatura::where('estado_planificar_asignartura', '<>', 'ELIMINADO')->where('id_planificar_asignatura', '=', $id_planif_asignatura)->first();
            if(!is_null($this->dataPlanificarAsignaturaForm)){
                $this->operation = 'guardar_inscripcion_notas';
                
                $this->tipos_de_deposito = ['Efectivo', 'Depósito'];
                $this->monto_deposito = $this->dataPlanificarAsignaturaForm->siadi_convocatoria->monto_convocatoria;
                $this->tipo_pago = 'Efectivo';
                $this->emit('closeModalVerificarInscripcion');
                $this->emit('showModalAgregarInscripcionMigracion');
                
            }
        } else {
            $this->emit('errorvalidate','Acceso ilegal a FORMULARIO DE INSCRIPCIÓN: MIGRAR ');
        }
    }

    public function close_form_inscribir(){
        $this->emit('closeModalAgregarInscripcionMigracion');
        $this->operation = 'buscar_por_ci';
        $this->reset_form_inscribir();
        $this->emit('showModalVerificarInscripcion');
    }

    private function reset_form_inscribir(){
        $this->dataPlanificarAsignaturaForm = null;
        $this->tipos_de_deposito = [];
        $this->reset([
            'fecha_inscripcion',
            'tipo_pago',
            'monto_deposito',
            'nro_deposito',

            'nota_final',
            'nota_observacion',
            'nro_folio',
            'nro_carpeta_nota'        ]);
        $this->resetValidation();
    }

    public function guardar_form_inscribir(){
        if($this->operation == 'guardar_inscripcion_notas'){
            $this->validate();
            if(!is_null($this->estudiante_buscar_existe_local) && !is_null($this->dataPlanificarAsignaturaForm)){
                $id_planificar_asignatura = $this->dataPlanificarAsignaturaForm->id_planificar_asignatura;
                $id_persona = $this->estudiante_buscar_existe_local->id_siadi_persona;
                try { 
                    \DB::beginTransaction();
                    
                    $inscripcion = new SiadiInscripcion();
                    $inscripcion->id_siadi_persona = $id_persona;
                    $inscripcion->id_planificar_asignatura = $id_planificar_asignatura;
                    $inscripcion->tipo_pago_inscripcion = $this->tipo_pago;
                    $inscripcion->fecha_inscripcion = $this->fecha_inscripcion;
                    $inscripcion->observacion_inscripcion = "MIGRACION";
                    if($this->statusNroDeposito){
                        $inscripcion->nro_deposito = $this->nro_deposito;
                    }
                    $inscripcion->monto_deposito = $this->monto_deposito;
                    $inscripcion->id_usuario = Auth::user()->id;
                    $inscripcion->save();

                    $nota = new SiadiNota();
                    $nota->id_inscripcion = $inscripcion->id_inscripcion;
                    $nota->final_nota = $this->nota_final;
                    $nota->nota_convalidacion = 0;
                    $nota->nro_folio_nota = $this->nro_folio;
                    $nota->nro_carpeta_nota = $this->nro_carpeta_nota;
                    $nota->observacion_nota = $this->nota_observacion;
                    $nota->observaciones_detalle = "MIGRACION";
                    $nota->id_usuario = Auth::user()->id;
                    $nota->save();

                    \DB::commit();
                    $this->close_form_inscribir();
                    $this->emit("alert", "Inscripcioón guardada exitosamente");
                    #$this->fillDataAsignaturaActual($this->asignatura_actual->id_asignatura);
                } catch (\Exception $e) {
                    \DB::rollback();
                    #throw $e;
                    $this->emit("errorvalidate", "Ups. Ocurrio un error al crear inscripcion \n". $e->getMessage());
                }
            } else {
                $this->emit('errorvalidate','"ESTUDIANTE" o "ASIGNATURA" inválidos');
                $this->close_form_inscribir();
            }
        } else {
            $this->emit('errorvalidate','Acceso ilegal a : GUARDAR INSCRIPCIÓN');
            $this->close_form_inscribir();
        }
        
    }

    public function mas(){
        if(is_numeric($this->nota_final)){
            if($this->nota_final<100 && $this->nota_final >= 0){
                $this->nota_final++;
            } else {
                $this->nota_final = 100;
            } 
        } else {
            $this->nota_final = 100;
        }
        $this->resetValidation('nota_final');
        $this->updatedNotaFinal();
    }

    public function menos(){
        if(is_numeric($this->nota_final)){
            if($this->nota_final<=100 && $this->nota_final > 0){
                $this->nota_final--;
            } else {
                $this->nota_final = 0;
            } 
        } else {
            $this->nota_final = 0;
        }
        $this->resetValidation('nota_final');
        $this->updatedNotaFinal();
    }

    public function updatedNotaFinal(){
        if(is_numeric($this->nota_final)){
            if($this->nota_final<=100 && $this->nota_final >= 0){
                if($this->nota_final==0){
                    $this->nota_observacion = "NO SE PRESENTO";
                } else if($this->nota_final<=50){
                    $this->nota_observacion = "REPROBADO";
                } else {
                    $this->nota_observacion = "APROBADO";
                }
            } else {
                $this->nota_observacion = "";
            }
        } else {
            $this->nota_observacion = "";
        }
    }

    public function updatedTipoPago(){
        $this->statusNroDeposito = ($this->tipo_pago=='Depósito');
    }
}
