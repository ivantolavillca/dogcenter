<?php

namespace App\Http\Livewire\LandigPage;

use App\Models\AdministracionModulos\Pais;
use App\Models\AdministracionModulos\SiadiAsignatura;
use App\Models\AdministracionModulos\SiadiIdioma;
use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiPlanificarParalelo;
use App\Models\AdministracionModulos\SiadiPreInscripcion;
use App\Models\AdministracionModulos\SiadiTipoEstudiante;
use App\Models\base_upea\tabla_persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PreinscripcionIndex extends Component
{
    private $FECHA_MINIMA_NACIMIENTO = "1900-01-01";
    public $EXPEDIDO_DATA = [];
    public $ESTADOS_CIVILES = [];
    public function mount(){
        $this->EXPEDIDO_DATA = include( app_path('ArraysData/extension_data.php') );
        $this->ESTADOS_CIVILES = include( app_path('ArraysData/estado_civil_data.php') );
        $this->validacionClic = false;
    }

    public $ci;
    public $ci2;
    public $fecha_de_nacimiento;

    public $nombre;
    public $paterno;
    public $materno;
    public $email;
    public $id_persona;
    public $expedido;
    public $direccion;
    public $telefono;
    public $celular;
    public $fecha_nac;
    public $estado_civil;
    public $pais;
    public $genero_persona;
    public $profesion;
    public $dada;
    public $tipo_pago;
    public $tipo_estudiante;
    public $CiIngreso;
    public $tipo_documento;
    public $nrodeposito;
    public $fechadeposito;

    public $persona_inscritaa = [];
    public $asignaturas = [];

    public $selectedAsignaturas = [];
    public $validacionClic = false;

    public function validar_ci_user()
    {
        $this->operation = ''; #'validarporci';
        #$this->validacionClic = true ;
        $this->validate([
            'CiIngreso' => ['required', 'string', 'max:12', 'regex:/^(?:[a-zA-Z]?-?\d+|\d+-\d+[a-zA-Z]?)$/']
        ]);
        
        // Validar si el usuario ya existe por CI
        $persona_por_ci = User::leftJoin('siadi_personas', 'siadi_personas.id_siadi_persona', '=', 'users.id_persona_siadi')
            ->where('users.ci', $this->CiIngreso)->first();
        
        // Consulta para verificar si la persona existe en la base de datos externa
        $persona = DB::connection('base_upea')
            ->selectOne(
                "SELECT p.*
                FROM persona p
                JOIN vista_asignacion_control_docente_actua v ON p.id = v.id_persona
                WHERE v.carrera_id = 13 AND p.ci = :ciIngreso",
                    ['ciIngreso' => $this->CiIngreso]
            );
            $persona_siadi = SiadiPersona::where('ci_persona', $this->CiIngreso)->first();
            
        $this->email = "";
        if ($persona_por_ci) {
            // El usuario ya existe, mostrar mensaje o modal aquí
            $this->emit('cerrarvalidacionperosna');
            if(is_null($persona_por_ci->email_persona) || trim($persona_por_ci->email_persona)==""){
                $this->email = $this->CiIngreso.'@upea.bo';
            }
            $this->emit('abrirlogin');
        } elseif ($persona) {
            // Crear un nuevo usuario y mostrar el modal de login
            $newUser = new User();
            $newUser->name = $persona->nombre;
            $newUser->paterno = $persona->paterno;
            $newUser->materno = $persona->materno;
            $newUser->id_persona_siadi = $persona->id;
            $newUser->ci = $persona->ci;
            $newUser->id_persona = $persona->id;
            $newUser->email  = $persona->ci . '@upea.bo';
            $newUser->password = bcrypt($persona->fecha_nac);
            $newUser->save();
            $newUser->assignRole(5);

            // Mostrar mensaje o modal de login aquí
            $this->emit('cerrarvalidacionperosna');
            $this->emit('abrirlogin');
        } elseif ($persona_siadi) {
            $newUser = new User();
            $newUser->name = $persona_siadi->nombres_persona;
            $newUser->paterno = $persona_siadi->paterno_persona;
            $newUser->materno = $persona_siadi->materno_persona;
            $newUser->id_persona_siadi = $persona_siadi->id_siadi_persona;
            $newUser->ci = $persona_siadi->ci_persona;
            $newUser->id_persona = $persona_siadi->id_persona_base_upea;
            $newUser->email  = $persona_siadi->ci_persona . '@upea.bo';
            $newUser->password = bcrypt($persona_siadi->fecha_nacimiento_persona);
            $newUser->save();
            $newUser->assignRole(6);

            // Mostrar mensaje o modal de login aquí
            $this->emit('cerrarvalidacionperosna');
            $this->emit('abrirlogin');
        } else {
            $this->emit('cerrarvalidacionperosna');

            $this->ci = $this->CiIngreso;
            $this->email = $this->CiIngreso.'@upea.bo';
            $this->updatedCi();

            $this->emit('registropersonapreinscripcion');
        }
        $this->validacionClic = false;
        
    }

    public $tipo_persona_guardado;
    public $id_persona_guardado;
    public function guardar_persona()
    {
        $this->operation = 'savepersona';
        $this->validate();
        
        $persona_encontrada = tabla_persona::where('ci', $this->ci)->first();
        if ($persona_encontrada) {
            $guardar_persona = new SiadiPersona();
            $guardar_persona->ci_persona         = $this->ci;
            $guardar_persona->id_persona_base_upea         = $persona_encontrada->id;
            $guardar_persona->expedido_persona         = strtoupper($this->expedido);
            $guardar_persona->estado_civil_persona         = $this->estado_civil;
            $guardar_persona->paterno_persona         = strtoupper($this->paterno);
            $guardar_persona->materno_persona         = strtoupper($this->materno);
            $guardar_persona->nombres_persona         = strtoupper($this->nombre);
            $guardar_persona->id_pais         = $this->pais;
            $pais_seleccionado = Pais::where('id_siadi_pais', $this->pais)->first();
            $guardar_persona->pais_persona         = strtoupper($pais_seleccionado->nombre_siadi_pais);
            $guardar_persona->genero_persona         = $this->genero_persona;
            $guardar_persona->fecha_nacimiento_persona         = $this->fecha_nac;
            $guardar_persona->profesion_persona         = strtoupper($this->profesion);
            $guardar_persona->direccion_persona         = strtoupper($this->direccion);
            $guardar_persona->id_tipo_estudiante          = $this->tipo_estudiante;
            $guardar_persona->tipo_documento          = 'CI'; # $this->tipo_documento; 
            if ($this->telefono == '') {
                $guardar_persona->telefono_persona         = null;
            } else {
                $guardar_persona->telefono_persona         = $this->telefono;
            }

            $guardar_persona->celular_persona         = $this->celular;
            $guardar_persona->email_persona          = $this->email;
            $guardar_persona->save();

            $id_persona_actual = $guardar_persona->id_siadi_persona;
            // foreach ($this->selectedAsignaturas as $idioma => $idAsignatura) {
            //     $crear_preinscripcion = new SiadiPreInscripcion();
            //     $crear_preinscripcion->id_siadi_persona = $id_persona_actual;
            //     $crear_preinscripcion->id_planificar_asignatura = $idAsignatura;
            //     $crear_preinscripcion->tipo_pago_inscripcion = $this->tipo_pago;
            //     $crear_preinscripcion->fecha_inscripcion = date("Y-m-d");
            //     $crear_preinscripcion->observacion_inscripcion = 'SIN OBSERVACION';
            //     $crear_preinscripcion->save();
            // }

            $user = new User();

            $user->name         = strtoupper($this->nombre);
            $user->ci         = $this->ci;
            $user->paterno         = strtoupper($this->paterno);
            $user->materno  = strtoupper($this->materno);
            $user->email           = $this->email;
            $user->id_persona_siadi           = $id_persona_actual;







            $user->password   = bcrypt($this->fecha_nac);
            $user->save();

            $user->assignRole(6);

            $this->cancelar();
            $this->tipo_persona_guardado = $guardar_persona->id_tipo_estudiante;
            $this->id_persona_guardado = $guardar_persona->id_siadi_persona;
            $this->emit('closeModalCreate');


           Auth::login($user); // This will log in the user

            return redirect()->to('/user/profile');
        } else {
            $guardar_persona = new SiadiPersona();
            $guardar_persona->ci_persona         = $this->ci;

            $guardar_persona->expedido_persona         = strtoupper($this->expedido);
            $guardar_persona->estado_civil_persona         = $this->estado_civil;
            $guardar_persona->paterno_persona         = strtoupper($this->paterno);
            $guardar_persona->materno_persona         = strtoupper($this->materno);
            $guardar_persona->nombres_persona         = strtoupper($this->nombre);
            $guardar_persona->id_pais         = $this->pais;
            $pais_seleccionado = Pais::where('id_siadi_pais', $this->pais)->first();
            $guardar_persona->pais_persona         = strtoupper($pais_seleccionado->nombre_siadi_pais);
            $guardar_persona->genero_persona         = $this->genero_persona;
            $guardar_persona->fecha_nacimiento_persona         = $this->fecha_nac;
            $guardar_persona->profesion_persona         = strtoupper($this->profesion);
            $guardar_persona->direccion_persona         = strtoupper($this->direccion);
            $guardar_persona->direccion_persona         = strtoupper($this->direccion);
            $guardar_persona->id_tipo_estudiante          = $this->tipo_estudiante;
            if ($this->telefono == '') {
                $guardar_persona->telefono_persona         = 0;
            } else {
                $guardar_persona->telefono_persona         = $this->telefono;
            }
            $guardar_persona->tipo_documento          =  'CI'; #$this->tipo_documento;
            $guardar_persona->celular_persona         = $this->celular;
            $guardar_persona->email_persona          = $this->email;
            $guardar_persona->save();
            $id_persona_actual2 = $guardar_persona->id_siadi_persona;
            // foreach ($this->selectedAsignaturas as $idioma => $idAsignatura) {
            //     $crear_preinscripcion = new SiadiPreInscripcion();
            //     $crear_preinscripcion->id_siadi_persona = $id_persona_actual2;
            //     $crear_preinscripcion->id_planificar_asignatura = $idAsignatura;
            //     $crear_preinscripcion->tipo_pago_inscripcion = $this->tipo_pago;
            //     $crear_preinscripcion->fecha_inscripcion = date("Y-m-d");
            //     $crear_preinscripcion->observacion_inscripcion = 'SIN OBSERVACION';
            //     $crear_preinscripcion->save();
            // }
            $user = new User();

            $user->name         = strtoupper($this->nombre);
            $user->ci         = $this->ci;
            $user->paterno         = strtoupper($this->paterno);
            $user->materno  = strtoupper($this->materno);
            $user->materno  = strtoupper($this->materno);
            $user->id_persona_siadi           = $id_persona_actual2;
            $user->email           = $this->email;







            $user->password   = bcrypt($this->fecha_nac);
            $user->save();

            $user->assignRole(6);


            $this->cancelar();
            $this->tipo_persona_guardado = $guardar_persona->id_tipo_estudiante;
            $this->id_persona_guardado = $guardar_persona->id_siadi_persona;
            $this->emit('closeModalCreate');
            Auth::login($user); // This will log in the user

            return redirect()->to('/user/profile');
        }
    }

    private function getMateriasPredeterminadas($tipopersona)
    {
        return DB::table('siadi_planificar_asignaturas AS p')
            ->join('siadi_convocatorias AS c', 'p.id_siadi_convocatoria', '=', 'c.id_siadi_convocatoria')
            ->join('siadi_tipo_convocatorias AS tc', 'c.id_tipo_convocatoria', '=', 'tc.id_tipo_convocatoria')
            ->join('siadi_tipo_estudiantes AS te', 'tc.id_tipo_estudiante', '=', 'te.id_tipo_estudiante')
            ->join('siadi_asignaturas AS asig', 'p.id_siadi_asignatura', '=', 'asig.id_siadi_asignatura')
            ->join('siadi_idiomas AS idiom', 'asig.id_idioma', '=', 'idiom.id_idioma')
            ->join('siadi_nivel_idiomas AS na', 'asig.id_nivel_idioma', '=', 'na.id_nivel_idioma')
            ->join('siadi_paralelos AS par', 'p.id_paralelo', '=', 'par.id_paralelo')
            ->join('siadi_convocartoria_estudiantes AS sce', 'tc.id_convocartoria_estudiante', '=', 'sce.id_convocartoria_estudiante')
            ->join('siadi_modalidad_curso AS mt', 'c.id_modalidad_curso', '=', 'mt.id_convocartoria_estudiante')
            ->whereIn('p.id_siadi_asignatura', [1, 7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67])
            ->where('p.estado_planificar_asignartura', 'ACTIVO')
            ->whereDate('c.fecha_fin', '>=', DB::raw('CURDATE()'))
            ->get();
    }
    public $numero_deposito;
    public $tipopago;
    public $monto;
    public $fecha_deposito;

    public function updatedTipopago()
    {

        $this->reset(['numero_deposito', 'monto', 'fecha_deposito']);
    }
    public function guardarasignaturas($idinscripcion,$numerodeposito,$fechadeposito)
    {
        $this->operation = 'saveasginatura';
        $this->validate();
        $cantidadestudiantesinscritos =  DB::selectOne("SELECT COUNT(*) AS preinscritos  FROM siadi_pre_inscripcions WHERE id_planificar_asignatura=:inscripcion AND estado_inscripcion='ACTIVO';", [
            'inscripcion' => $idinscripcion,
        ]);

        $planificar_asignatura_seleccionada =
            DB::selectOne("SELECT pa.id_planificar_asignatura, si.id_idioma, sc.id_siadi_convocatoria , pa.cupo_maximo_paralelo FROM siadi_planificar_asignaturas AS pa JOIN siadi_convocatorias AS sc ON pa.id_siadi_convocatoria= sc.id_siadi_convocatoria JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura= a.id_siadi_asignatura JOIN siadi_idiomas AS si ON a.id_idioma = si.id_idioma WHERE pa.id_planificar_asignatura= :inscripcion ;", [
                'inscripcion' => $idinscripcion,
            ]);


        $existencia_de_idioma = DB::select(
            "SELECT spi.id_pre_inscripcion, spi.id_planificar_asignatura, si.id_idioma, sc.id_siadi_convocatoria, spi.id_siadi_persona FROM siadi_pre_inscripcions AS spi JOIN siadi_planificar_asignaturas AS pa ON spi.id_planificar_asignatura=pa.id_planificar_asignatura JOIN siadi_convocatorias AS sc ON pa.id_siadi_convocatoria= sc.id_siadi_convocatoria JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura= a.id_siadi_asignatura JOIN siadi_idiomas AS si ON a.id_idioma = si.id_idioma WHERE si.id_idioma=:idioma AND spi.id_siadi_persona=:persona AND sc.id_siadi_convocatoria=:convocatoria;",
            [
                'idioma' => $planificar_asignatura_seleccionada->id_idioma,
                'persona' =>  $this->id_persona_guardado,
                'convocatoria' =>  $planificar_asignatura_seleccionada->id_siadi_convocatoria,
            ]
        );
        $cantidad = DB::select(
            "SELECT COUNT(*) AS cantidad_registros FROM siadi_pre_inscripcions AS spi JOIN siadi_planificar_asignaturas AS pa ON spi.id_planificar_asignatura = pa.id_planificar_asignatura JOIN siadi_convocatorias AS sc ON pa.id_siadi_convocatoria = sc.id_siadi_convocatoria JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura = a.id_siadi_asignatura JOIN siadi_idiomas AS si ON a.id_idioma = si.id_idioma WHERE spi.id_siadi_persona = :persona AND sc.id_siadi_convocatoria = :convocatoria;",
            [

                'persona' =>  $this->id_persona_guardado,
                'convocatoria' =>  $planificar_asignatura_seleccionada->id_siadi_convocatoria,
            ]
        );


        if ($cantidadestudiantesinscritos->preinscritos <= $planificar_asignatura_seleccionada->cupo_maximo_paralelo) {
            if ($existencia_de_idioma) {
                $this->emit('errorvalidate', 'Usted ya se encuentra preinscrito en este idioma');
            } else {
                if ($cantidad[0]->cantidad_registros < 2) {

                    $nueva_preinscripcion = new SiadiPreInscripcion();
                    $nueva_preinscripcion->id_siadi_persona  = $this->id_persona_guardado;
                    $nueva_preinscripcion->id_planificar_asignatura  = $idinscripcion;
                    $nueva_preinscripcion->tipo_pago_inscripcion  = $this->tipopago;
                    $nueva_preinscripcion->fecha_inscripcion  = $this->fecha_deposito;
                    $nueva_preinscripcion->observacion_inscripcion  = 'SIN OBSERVACION';

                    $nueva_preinscripcion->nro_deposito  = $this->numero_deposito;
                    $nueva_preinscripcion->monto_deposito  = $this->monto;
                    $nueva_preinscripcion->save();

                    $this->emit('alert', 'se realizo la preinscipcion');
                } else {
                    $this->emit('errorvalidate', 'Solo puede realizar la preinscripcion de dos idiomas');
                }
            }
        } else {
            $this->emit('errorvalidate', 'ASIGNATURA SIN CUPOS');
        }
    }

    public $idasignatura;
    public function validar_existencia_persona()
    {
        $this->operation = 'validarpersona';
        $this->validate();

        $persona_existente = SiadiPersona::where('ci_persona', $this->ci)
            ->where('fecha_nacimiento_persona', $this->fecha_nac)
            ->first();
        if ($persona_existente) {
            $this->emit('cerrarvalidacionperosna');
            $this->emit('abrirlogin');
        } else {
            $this->emit('cerrarvalidacionperosna');

            $this->emit('registropersonapreinscripcion');
        }
    }

    public $operation;

    public function rules()
    {
        if ($this->operation === 'savepersona') {
            return $this->rulesguardarpersona();
        } elseif ($this->operation === 'validarpersona') {
            return $this->validarpersona();
        } elseif ($this->operation === 'validarporci') {
            return $this->validarpersonaporci();
        } elseif ($this->operation === 'saveasginatura') {
            return $this->validarasignatura();
        }

        return array_merge($this->rulesguardarpersona(), $this->validarpersona(), $this->validarpersonaporci(), $this->validarasignatura());
    }

    private function rulesguardarpersona()
    {
        return [
            'ci' => 'required|string|unique:siadi_personas,ci_persona|max:15|regex:/^[0-9]{4,12}(-[A-Z0-9]{1,2})?$/i',
            'nombre' => 'required|string|uppercase|max:240',
            'paterno' => 'required_if:materno,'.null.'|string|uppercase|max:240',
            'materno' => 'required_if:paterno,'.null.'|string|uppercase|max:240',
            'email' => 'required|email|unique:siadi_personas,email_persona',
            'expedido' => 'string|required|max:240',
            'direccion' => 'string|required|max:240',
            'telefono' => 'nullable|integer|digits_between:7,8',
            'celular' => 'required|integer|digits:8',
            'estado_civil' => 'required|not_in:Elegir...',
            'fecha_nac' => 'required|date|date_format:Y-m-d|after_or_equal:'.$this->FECHA_MINIMA_NACIMIENTO.'|before_or_equal:'.date('Y-m-d', strtotime('-5 year')),
            'pais' => 'required',
            'genero_persona' => 'required|not_in:Elegir...',
            'profesion' => 'string|required|max:240',
            'tipo_documento' => '', #required

            'tipo_estudiante' => 'required|not_in:Elegir...',
        ];
    }


    private function validarpersona()
    {
        return [
            'ci' => 'required|integer',
            'fecha_nac' => 'required|date',
            // |before_or_equal:' . now()->subYears(10)->format('Y-m-d')
        ];
    }
    private function validarasignatura()
    {
        return [
            'tipopago' => 'required|not_in:Elegir...',
        ];
    }

    private function validarpersonaporci()
    {
        return [
            'CiIngreso' => ['required', 'string', 'max:12', 'regex:/^(?:[a-zA-Z]?-?\d+|\d+-\d+[a-zA-Z]?)$/'],
        ];
    }

    protected $validationAttributes = [
        'CiIngreso' => '"CI"',
    ];

    protected $messages = [
        'CiIngreso.regex' => 'El campo :attribute debe tener el formato de uno de los ejemplos.'
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }




    public function cancelar()
    {

        $this->reset([

            'ci',
            'ci2',
            'nombre',
            'paterno',
            'materno',
            'email',
            'expedido',
            'direccion',
            'telefono',
            'celular',
            'estado_civil',
            'fecha_nac',
            'pais',
            'genero_persona',
            'profesion',
            'tipo_pago',
            'tipo_estudiante',
            'tipo_documento',

        ]);
        $this->selectedAsignaturas = [];

        $this->resetValidation();
    }


    public  function updatedCi()
    {
        $this->autocompletar();
    }
    public function autocompletar()
    {
        $persona_autocomplet = tabla_persona::where('ci', $this->ci)->first();
        if ($persona_autocomplet) {
            $this->nombre = $persona_autocomplet->nombre;
            $this->paterno = $persona_autocomplet->paterno;
            $this->materno = $persona_autocomplet->materno;
            $this->expedido = $persona_autocomplet->expedido;
            $this->email = '@upea.bo';
            $this->tipo_documento =  'CI'; #$persona_autocomplet->tipo_documento;
        }
    }




    public $ci3;
    public function validar_user()
    {
        $this->validate([
            'ci3' => 'required|integer',
        ]);
        $year = date("Y");
        $existingUser = User::where('ci', $this->ci3)->first();
        if ($existingUser) {
            return redirect()->route('login');
        } else {
            $this->emit('error', 'Usuario No Encontrado');
        }
        $persona = DB::connection('base_upea')
            ->selectOne("SELECT p.*
                FROM persona p
                JOIN vista_asignacion_control_docente_actua v ON p.id = v.id_persona
                WHERE v.carrera_id = 13 AND p.ci = $this->ci3");
        //cambiar de vista
        //planificar paralelo y planificar asignatura en uno gestiones sedes niveles
        //BOTON PARA BUSQUEDA DE CI Y INSCRIBIR LAS MASTERIA HABILITADAS CON PRE REQUISITO
        if ($persona && $persona->id) {
            $user = User::where('id_persona_siadi', $persona->id)->first();

            if ($user) {
                // Si el usuario existe, redirige al login
                return redirect()->route('login');
            } else {

                $newUser = new User();
                $newUser->name = $persona->nombre;
                $newUser->paterno = $persona->paterno;
                $newUser->materno = $persona->materno; // Cambia esto por el campo correcto en tu tabla persona
                $newUser->id_persona_siadi = $persona->id; // Cambia esto por el campo correcto en tu tabla persona
                $newUser->ci = $persona->ci; // Cambia esto por el campo correcto en tu tabla persona
                $newUser->id_persona = $persona->id; // Cambia esto por el campo correcto en tu tabla persona

                $newUser->email  = $persona->ci . '@upea.bo'; // Cambia esto por el campo correcto en tu tabla persona

                $newUser->password = bcrypt($persona->fecha_nac); // Cambia la contraseña temporal por lo que desees
                $newUser->save();
                $newUser->assignRole(5);

                // Luego, inicia sesión con el nuevo usuario
                Auth::login($newUser);

                // Redirige al login
                return redirect()->route('login');
            }
        }
    }


    public function render()
    {
        $paises = Pais::all();
        $materiashablilitadas = [];
        $materiashablilitadas = $this->getMateriasPredeterminadas($this->tipo_persona_guardado);
        $materiaspreinsciptas = [];
        $materiaspreinsciptas = SiadiPreInscripcion::where('id_siadi_persona', $this->id_persona_guardado)->get();

        $tipo_estudiantes = SiadiTipoEstudiante::where('estado_tipo_estudiante', 'ACTIVO')->get();
        $idiomas_activos = SiadiIdioma::where('estado_idioma', 'ACTIVO')->get();
        $asignaturas_todas = SiadiAsignatura::where('estado_asignatura', 'ACTIVO')->get();
        return view('livewire.landig-page.preinscripcion-index', compact('tipo_estudiantes', 'idiomas_activos', 'asignaturas_todas', 'materiashablilitadas', 'paises', 'materiaspreinsciptas'));
    }
}
