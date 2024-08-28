<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\Pais;
use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiNota;
use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiPreInscripcion;
use App\Models\AdministracionModulos\SiadiTipoEstudiante;
use App\Models\base_upea\tabla_persona;
use App\Models\PreRequisito;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PersonaIndex extends Component
{

    private $FECHA_MINIMA_NACIMIENTO = "1900-01-01";
    public $EXPEDIDO_DATA; 
    public $ESTADOS_CIVILES;

    public function inscribir_estudiante($persona)
    {
        $data = $persona;
        $this->emit('myCustomEvent', $data);
        redirect('/admin/pre-inscripcion');
    }
    use WithPagination;
    protected $listeners = [
        'render', 'delete', 'respuesta'
    ];

    # se ejecuta al iniciar
    public function mount(){
        $this->EXPEDIDO_DATA = include( app_path('ArraysData/extension_data.php') );
        $this->ESTADOS_CIVILES = include( app_path('ArraysData/estado_civil_data.php') );
    }

    public $estudiante;
    public $idestudianteactual;
    public $ciestudiante;
    public $nombre_estudiante;
    public $id_estudiante_encontrado;
    public $id_tipo_estudiante_encontrado;
    public $nro_folio;
    public $nro_carperta;
    public function guardar_inscripcion_estudiante()
    {
        $this->operation = 'saveinscribir';
        $this->validate();
        foreach ($this->asignaturas as  $asignatura_select) {

            $preinscripcion_actual = SiadiPreInscripcion::where('id_pre_inscripcion', $asignatura_select)->first();
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
                'nro_folio_nota' =>  $this->nro_folio,
                'nro_carpeta_nota' =>  $this->nro_carperta,
                'observacion_nota' =>  'NO SE PRESENTO',
                'observaciones_detalle' =>  'INSCRITO',
                'id_usuario' =>  Auth::id(),
                'nota_convalidacion' => 0,
                'final_nota' => 0,
            ]);
            $preinscripcion_actual->observacion_inscripcion = 'INSCRITO';
            $preinscripcion_actual->update();
        }
        $this->emit('alert', 'INSCRITO SATISFACTORIAMENTE');
        $this->emit('cerrarmodalinscripcion');
        $this->cancelar();
    }

    public function anular_preinscripcion(SiadiPreInscripcion $id_preinscripcion)
    {
        $id_preinscripcion->estado_inscripcion = 'ELIMINAR';
        $id_preinscripcion->update();
    }


    public function cancelara()
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

    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public $ci_edit;
    public $expedido_edit;
    public $estado_civil_edit;
    public $paterno_edit;
    public $materno_edit;
    public $nombre_edit;
    public $pais_edit;
    public $genero_edit;
    public $fecha_nacimiento_edit;
    public $profesion_edit;
    public $direccion_edit;
    public $telefono_edit;
    public $celular_edit;
    public $email_edit;
    public $tipo_estudiante_edit;
    public   $id_editar_persona_actual;

    public function editar_persona(SiadiPersona $persona)
    {   
        $this->cancelarEditar();
        if(!is_null($persona)){
            $this->id_editar_persona_actual = $persona->id_siadi_persona;
            $this->ci_edit = $persona->ci_persona;
            $this->expedido_edit = $persona->expedido_persona;
            $this->estado_civil_edit = $persona->estado_civil_persona;
            $this->paterno_edit = $persona->paterno_persona;
            $this->materno_edit = $persona->materno_persona;
            $this->nombre_edit = $persona->nombres_persona;
            $this->pais_edit = $persona->id_pais;
            $this->genero_edit = $persona->genero_persona;
            $this->fecha_nacimiento_edit = $persona->fecha_nacimiento_persona;
            $this->profesion_edit = $persona->profesion_persona;
            $this->direccion_edit = $persona->direccion_persona;
            $this->telefono_edit = $persona->telefono_persona;
            $this->celular_edit = $persona->celular_persona;
            $this->email_edit = $persona->email_persona;
            $this->tipo_estudiante_edit = $persona->id_tipo_estudiante;

            $this->operation = 'guardareditarpersona';
            $this->emit('abrirnodaleditarpersona');
        } else {
            $this->emit("errorvalidate", "No existe persona");
        }
    }

    public function cancelarEditar(){
        $this->emit('cerrarmodaldeeditar');
        $this->reset([
            'id_editar_persona_actual',
            'ci_edit',
            'expedido_edit',
            'estado_civil_edit',
            'paterno_edit',
            'materno_edit',
            'nombre_edit',
            'pais_edit',
            'genero_edit',
            'fecha_nacimiento_edit',
            'profesion_edit',
            'direccion_edit',
            'telefono_edit',
            'celular_edit',
            'email_edit',
            'tipo_estudiante_edit'
        ]);
        $this->resetValidation();
    }

    public $operation;

    public function rules()
    {
        if ($this->operation === 'guardarpersona') {
            return $this->rulesguardarpersona();
        } elseif ($this->operation === 'guardareditarpersona') {
            return $this->guardareditarpersonaaa();
        } elseif ($this->operation === 'saveinscribir') {
            return $this->rulesForInscribir();
        } elseif ($this->operation === 'cambiarnota') {
            return $this->cambiarnota();
        }
        elseif ($this->operation === 'edite_inscripcion') {
            return $this->edite_inscripcion();
        }
        else if($this->operation === 'dar_baja'){
            return $this->rulesForBaja();
        }

        return array_merge($this->rulesguardarpersona(), $this->guardareditarpersonaaa(), $this->rulesForInscribir(), $this->cambiarnota(), $this->edite_inscripcion(),
                $this->rulesForBaja()
            );
    }
    private function rulesForInscribir()
    {
        return [
            'nro_folio' => 'required',
            'nro_carperta' => 'required',
            'asignaturas' => 'required',
        ];
    }
    private function cambiarnota()
    {
        return [
            'editedNota' => 'required|numeric|min:0|max:100',
        ];
    }
    private function edite_inscripcion()
    {
        return [
            'asignatura_edite' => 'required|not_in:Elegir...',

        ];
    }
    private function rulesguardarpersona()
    {
        $rule_paterno = is_null($this->materno) || trim($this->materno)==''? 'required': 'nullable';
        $rule_materno = is_null($this->paterno) || trim($this->paterno)==''? 'required': 'nullable';
        return [
            'ci' => [
                'required', 
                'max:15', 
                'regex:/^[0-9]{4,12}(-[A-Z0-9]{1,2})?$/i', 
                'unique:siadi_personas,ci_persona'],
            'nombre' => 'required|min:3|max:100|uppercase|regex:/^\S(.*\S)?$/', # regex:/^\S(.*\S)?$/ => para evitar espacios en blanco inicio final
            'paterno' => $rule_paterno .'|min:3|max:100|uppercase|regex:/^\S*$/', # regex:/^\S*$/ => para evitar espacios en blanco
            'materno' => $rule_materno .'|min:3|max:100|uppercase|regex:/^\S*$/', # regex:/^\S*$/ => para evitar espacios en blanco
            'email' => 'required|email|unique:siadi_personas,email_persona',
            'expedido' => 'required',
            'direccion' => 'required',
            'telefono' => 'nullable|integer|digits_between:7,8',
            'celular' => 'required|integer|digits:8',
            'estado_civil' => 'required|not_in:Elegir...',
            'fecha_nacimiento' => 'required|date|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA_NACIMIENTO .'|before_or_equal:'.date('Y-m-d', strtotime('-5 year')),
            'pais' => 'required|not_in:Elegir...',
            'genero' => 'required|not_in:Elegir...',
            'profesion' => 'required',
            'tipo_estudiante' => 'required|not_in:Elegir...',

        ];
    }
    private function guardareditarpersonaaa()
    {   
        return [
            'ci_edit' =>
            [
                'required',
                'max:15',
                'regex:/^[0-9]{4,12}(-[A-Z0-9]{1,2})?$/i', # /^[0-9]+(-[A-Z])?$/
                Rule::unique('siadi_personas', 'ci_persona')->ignore($this->id_editar_persona_actual, 'id_siadi_persona')
            ],

            'nombre_edit' => 'required|min:3|max:100|uppercase|regex:/^\S(.*\S)?$/', # regex:/^\S(.*\S)?$/ => para evitar espacios en blanco inicio final
            'paterno_edit' => 'nullable|min:3|max:100|uppercase|regex:/^\S*$/', # regex:/^\S*$/ => para evitar espacios en blanco
            'materno_edit' => 'nullable|min:3|max:100|uppercase|regex:/^\S*$/', # regex:/^\S*$/ => para evitar espacios en blanco
            'email_edit' => [
                'required',
                'email',
                Rule::unique('siadi_personas', 'email_persona')->ignore($this->id_editar_persona_actual, 'id_siadi_persona')
            ],
            'expedido_edit' => 'required',
            'direccion_edit' => 'required',
            'telefono_edit' => 'nullable|integer|digits_between:7,8',
            'celular_edit' => 'required|integer|digits:8',
            'estado_civil_edit' => 'required',
            'fecha_nacimiento_edit' => 'required|date|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA_NACIMIENTO .'|before_or_equal:'.date('Y-m-d', strtotime('-5 year')),
            'pais_edit' => 'required',
            'genero_edit' => 'required',
            'profesion_edit' => 'required',

            'tipo_estudiante_edit' => 'required',
        ];
    }

    # names attributes
    protected $validationAttributes = [
        # rulesguardarpersona
        'ci' => '"CI"',
        'nombre' => '"NOMBRE"',
        'paterno' => '"PATERNO"',
        'materno' => '"MATERNO"',
        'email' => '"EMAIL"',
        'expedido' => '"EXPEDIDO"',
        'direccion' => '"DIRECCIÓN"',
        'telefono' => '"TELÉFONO"',
        'celular' => '"CELULAR"',
        'estado_civil' => '"ESTADO CIVIL"',
        'fecha_nacimiento' => '"FECHA DE NACIMIENTO"',
        'pais' => '"PAÍS"',
        'genero' => '"GÉNERO"',
        'profesion' => '"PROFESIÓN"',
        'tipo_estudiante' => '"TIPO ESTUDIANTE"',

        # ruleseditpersona
        'ci_edit' => '"CI"',
        'nombre_edit' => '"NOMBRE"',
        'paterno_edit' => '"PATERNO"',
        'materno_edit' => '"MATERNO"',
        'email_edit' => '"EMAIL"',
        'expedido_edit' => '"EXPEDIDO"',
        'direccion_edit' => '"DIRECCIÓN"',
        'telefono_edit' => '"TELÉFONO"',
        'celular_edit' => '"CELULAR"',
        'estado_civil_edit' => '"ESTADO CIVIL"',
        'fecha_nacimiento_edit' => '"FECHA DE NACIMIENTO"',
        'pais_edit' => '"PAÍS"',
        'genero_edit' => '"GÉNERO"',
        'profesion_edit' => '"PROFESIÓN"',
        'tipo_estudiante_edit' => '"TIPO ESTUDIANTE"',
    ];

    protected $messages = [
        'nombre.regex' => 'El campo :attribute no puede contener espacios en blanco al inicio o al final.',
        'paterno.regex' => 'El campo :attribute no puede contener espacios en blanco.',
        'materno.regex' => 'El campo :attribute no puede contener espacios en blanco.',

        'nombre_edit.regex' => 'El campo :attribute no puede contener espacios en blanco al inicio o al final.',
        'paterno_edit.regex' => 'El campo :attribute no puede contener espacios en blanco.',
        'materno_edit.regex' => 'El campo :attribute no puede contener espacios en blanco.'
    ];

    public $nota_final_baja;
    public $observacion_nota_baja;
    public $observaciones_detalle_baja;
    private function rulesForBaja()
    {
        return [
            'nota_final_baja' => 'required|numeric|in:0',
            'observacion_nota_baja' => 'required|in:BAJA',
            'observaciones_detalle_baja' => 'required|string|min:5|max:400'
        ];
    }


    public function numeroALetras($numero)
    {
        $unidades = array(
            0 => 'Cero',
            1 => 'Uno',
            2 => 'Dos',
            3 => 'Tres',
            4 => 'Cuatro',
            5 => 'Cinco',
            6 => 'Seis',
            7 => 'Siete',
            8 => 'Ocho',
            9 => 'Nueve',
            10 => 'Diez',
            11 => 'Once',
            12 => 'Doce',
            13 => 'Trece',
            14 => 'Catorce',
            15 => 'Quince',
            16 => 'Dieciséis',
            17 => 'Diecisiete',
            18 => 'Dieciocho',
            19 => 'Diecinueve',
        );

        $decenas = array(
            20 => 'Veinte',
            30 => 'Treinta',
            40 => 'Cuarenta',
            50 => 'Cincuenta',
            60 => 'Sesenta',
            70 => 'Setenta',
            80 => 'Ochenta',
            90 => 'Noventa',
        );

        if ($numero >= 0 && $numero <= 19) {
            return $unidades[$numero];
        } elseif ($numero >= 20 && $numero <= 99) {
            if ($numero % 10 == 0) {
                return $decenas[$numero];
            } else {
                return $decenas[floor($numero / 10) * 10] . ' y ' . $unidades[$numero % 10];
            }
        } elseif ($numero == 100) {
            return 'Cien';
        } else {
            return 'Número no soportado';
        }
    }
    public function fechaEnPalabras($fecha)
    {
        // Obtén el día en numeral
        $dia = $fecha->format('d');

        // Array de nombres de mes en español
        $nombresMeses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        // Obtén el número de mes de la fecha
        $numeroMes = $fecha->format('n');

        // Obtén el nombre del mes en español
        $nombreMes = $nombresMeses[$numeroMes];

        // Obtén el año en numeral
        $anio = $fecha->format('Y');

        return "$dia de $nombreMes de $anio";
    }

    private function consultaMateriasIncritas($idpersonainscripta)
    {
        return DB::select("
        SELECT * FROM siadi_inscripcions AS i JOIN siadi_planificar_asignaturas AS pa ON i.id_planificar_asignatura = pa.id_planificar_asignatura JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura = a.id_siadi_asignatura JOIN siadi_idiomas AS ia ON a.id_idioma = ia.id_idioma JOIN siadi_nivel_idiomas AS na ON a.id_nivel_idioma = na.id_nivel_idioma JOIN siadi_notas AS n ON i.id_inscripcion = n.id_inscripcion
        JOIN siadi_paralelos AS par ON pa.id_paralelo=par.id_paralelo
        JOIN siadi_convocatorias AS conv ON pa.id_siadi_convocatoria =conv.id_siadi_convocatoria
        JOIN siadi_gestions AS gest ON conv.id_gestion=gest.id_gestion
        JOIN siadi_personas AS per ON i.id_siadi_persona = per.id_siadi_persona
        WHERE i.id_siadi_persona = $idpersonainscripta ORDER BY a.id_siadi_asignatura, ia.id_idioma;
        ");
    }
    public function imprimir_record($idpersona)
    {
        $materiasinscritas = $this->consultaMateriasIncritas($idpersona);
        //   if (count($reporte) > 0) {
        if ($materiasinscritas) {
            $fecha = date('Y-m-d H:i:s');
            $title = 'Reporte_' . $fecha;

            return response()->streamDownload(function () use ($materiasinscritas) {
                // $registros = count($reporte);

                $pdf = new Fpdf();

                $pdf->SetTopMargin(18);
                $pdf->SetLeftMargin(10);
                $pdf->SetAutoPageBreak(1, 20);
                $pdf->AliasNbPages();
                $pdf->Addpage('P', array(216, 330));
                $pdf->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");

                // $pdf->AddFont('Erinal', 'I', 'Erinal.php');
                // $pdf->AddFont('Episode', 'I', 'Episode.php');
                // $pdf->AddFont('Splash', 'I', 'Splash.php');
                // $pdf->AddFont('helvetica', 'I', 'helvetica.php');

                $pdf->Image(public_path("cert") . '/logo_upea.png', 15, 8, 25, 25);

                // $pdf->SetX(30);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('EdwardianScriptITC', '', 38);
                $pdf->Cell(0, 5, utf8_decode('Universidad Pública de El Alto'), 0, 1, 'C');
                $pdf->SetFont('Arial', 'I', 6);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(0, 9, 'Creada por Ley 2115 del 5 de Septiembre de 2000 y ' . utf8_decode('Autónoma') . ' por Ley 2556 del 12 de Noviembre de 2003', 0, 1, 'C');

                $pdf->SetFont('Times', 'B', 16);
                $pdf->ln(3);
                $pdf->cell(70);
                $pdf->Cell(75, 10, 'DEPARTAMENTO DE IDIOMAS', 0, 0, 'C');

                $pdf->SetFont('Times', 'B', 16);
                $pdf->ln(6);
                $pdf->cell(70);
                $pdf->Cell(80, 10, 'HISTORIAL ' . utf8_decode('ACADÉMICO'), 0, 0, 'C');
                $pdf->ln(2);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetXY(24, 50);
                $pdf->Cell(45, 7, strtoupper($materiasinscritas[0]->paterno_persona), 0, 0, 'C');

                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(24, 56);
                $pdf->Cell(45, 7, 'APELLIDO PATERNO', 'T', 0, 'C');
                //MATERNO

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetXY(79, 50);
                $pdf->Cell(45, 7, strtoupper($materiasinscritas[0]->materno_persona), 0, 0, 'C');

                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(79, 56);
                $pdf->Cell(45, 7, 'APELLIDO MATERNO', 'T', 0, 'C');
                //NOMBRES

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetXY(140, 50);
                $pdf->Cell(45, 7, strtoupper($materiasinscritas[0]->nombres_persona), 0, 0, 'C');

                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(140, 56);
                $pdf->Cell(45, 7, 'NOMBRE(S)', 'T', 0, 'C');
                //codigo
                $pdf->ln(2);
                // $fpdf->SetFont('Arial', 'B', 10);
                // $fpdf->SetXY(180, 45);
                // $fpdf->Cell(25, 7, 'Nº 00'.$codigo, 0, 0, 'C');

                // $pdf->SetFont('Arial', '', 8);
                // $pdf->SetXY(25, 55);
                // $pdf->Cell(25, 7, 'CODIGO', 'T', 0, 'C');
                // //CEDULA

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(25, 65);
                $pdf->Cell(45, 7, $materiasinscritas[0]->ci_persona . ' ' . $materiasinscritas[0]->expedido_persona, 0, 0, 'C');

                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(25, 71);
                $pdf->Cell(45, 7, (utf8_decode('Nº') . ' DE CEDULA DE IDENTIDAD'), 'T', 0, 'C');
                //REGISTRO

                // Formatea la fecha en el formato deseado (día numérico, mes literal, año numérico)
                $fecha = Carbon::now();
                $fechaLiteral = $this->fechaEnPalabras($fecha);
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(140, 65);
                $pdf->Cell(45, 7, $fechaLiteral, 0, 0, 'C');
                $pdf->Cell(15);
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(140, 71);
                $pdf->Cell(45, 7, 'FECHA DE EMISION', 'T', 0, 'C');

                $pdf->Cell(20, 1, (utf8_decode('Pág. ')) . $pdf->PageNo() . ' de {nb}', 0, 0, 'R');
                //tablaaaaaaaaaa

                $dos = 1;
                $pdf->SetFont('Arial', 'B', 5);
                $pdf->SetXY(10 - $dos, 80);
                $pdf->Cell(5, 10, (utf8_decode('Nº')), 1, 0, 'C');

                $pdf->SetXY(15 - $dos, 80);
                $pdf->Cell(113, 5, 'ASIGNATURA', 1, 0, 'C');

                $pdf->Ln();
                $pdf->SetXY(15 - $dos, 85);
                $pdf->Cell(12, 5, 'SIGLA', 1, 0, 'C');

                $pdf->SetXY(27 - $dos, 85);
                $pdf->Cell(50, 5, 'ASIGNATURA (MATERIA)', 1, 0, 'C');

                $pdf->SetXY(77 - $dos, 85);
                $pdf->Cell(15, 5, 'PRE-REQUISITO', 1, 0, 'C');

                // $pdf->SetFont('Arial', 'B', 4);
                // $pdf->SetXY(90 - $dos, 85);
                // $pdf->Cell(10, 5, ' MODALIDAD', 1, 0, 'C');

                $pdf->SetFont('Arial', 'B', 5);
                $pdf->SetXY(92 - $dos, 85);
                $pdf->Cell(16, 5, ' NIVEL', 1, 0, 'C');

                $pdf->SetXY(108 - $dos, 85);
                $pdf->Cell(20, 3, 'HORAS', 'LRT', 0, 'C');
                $pdf->SetXY(108 - $dos, 88);
                $pdf->Cell(20, 2, 'ACADEMICAS', 'LRB', 0, 'L');

                // $pdf->SetXY(117 - $dos, 85);
                // $pdf->Cell(11, 3, 'PLAN DE', 'LRT', 0, 'L');
                // $pdf->SetXY(117 - $dos, 88);
                // $pdf->Cell(11, 2, 'ESTUDIOS', 'LRB', 0, 'L');

                $pdf->SetFont('Arial', 'B', 4);
                $pdf->SetXY(128 - $dos, 80);
                $pdf->Cell(9, 10, ' GESTION', 1, 0, 'C');

                $pdf->SetXY(137 - $dos, 80);
                $pdf->Cell(10, 10, ' PARALELO', 1, 0, 'C');

                $pdf->SetFont('Arial', 'B', 5);
                $pdf->SetXY(146, 80);
                $pdf->Cell(25, 5, 'CALIFICACIONES', 1, 0, 'C');

                $pdf->Ln(5);

                $pdf->SetFont('Arial', 'B', 4);
                $pdf->SetXY(146, 85);
                $pdf->Cell(9, 5, '  NUMERAL', 1, 0, 'C');

                $pdf->SetFont('Arial', 'B', 5);
                $pdf->SetXY(155, 85);
                $pdf->Cell(16, 5, 'LITERAL', 1, 0, 'C');

                $pdf->SetXY(172 - $dos, 80);
                $pdf->Cell(6, 4, ' LIBRO', 'LRT', 0, 'C');
                $pdf->SetXY(172 - $dos, 85);
                $pdf->Cell(6, 5, (utf8_decode('Nº')), 'LRB', 0, 'C');

                $pdf->SetXY(178 - $dos, 80);
                $pdf->Cell(6, 4, ' FOLIO', 'LRT', 0, 'C');

                $pdf->SetXY(178 - $dos, 85);
                $pdf->Cell(6, 5, (utf8_decode('Nº')), 'LRB', 0, 'C');

                $pdf->SetXY(184 - $dos, 80);
                $pdf->Cell(15, 10, ' RESULTADO', 1, 0, 'C');

                $pdf->SetXY(199 - $dos, 80);
                $pdf->Cell(15, 10, ' OBSERVACIONES', 1, 0, 'C');
                $pdf->Ln(10);
                $pdf->SetFont('Arial', '', 5);

                // $numAsignatura = 0;
                // $notas = 0;
                // $horasAcademica = 0;
                // $otrope2 = '';
                // $gestionesTemp = '';
                // $otrope = '';
                // $planEstudiso = '';
                // $gestiones = '';
                // $planEstudiso1 = '';
                // $otrope1 = '';
                $alturaTabla = 90;
                $apr = 0;
                $notasumatoria = 0;

                $horasacademicas = 0;
                foreach ($materiasinscritas as $key => $value) {

                    $pdf->SetXY(9, $alturaTabla);
                    $pdf->Cell(5, 5, $key + 1, 1, 0, 'C');
                    $pdf->Cell(12, 5, $value->sigla_asignatura, 1, 0, 'C');
                    $pdf->Cell(50, 5, utf8_decode($value->nombre_idioma), 1, 0, 'L');
                    $alturaTabla = $alturaTabla + 5;
                    $prerequisito = PreRequisito::where('id_asignatura', $value->id_siadi_asignatura)->first();
                    if ($prerequisito) {
                        $pdf->Cell(15, 5, $prerequisito->asignaturapre->sigla_asignatura, 1, 0, 'C');
                    } else {
                        $pdf->Cell(15, 5, '-----', 1, 0, 'C');
                    }
                    $pdf->Cell(16, 5, $value->nombre_nivel_idioma, 1, 0, 'C');
                    $pdf->Cell(20, 5, $value->carga_horaria_planificar_asignartura, 1, 0, 'C');

                    $pdf->Cell(9, 5, $value->nombre_gestion, 1, 0, 'C');
                    $pdf->Cell(10, 5, utf8_decode($value->turno_paralelo . ' ' . $value->nombre_paralelo), 1, 0, 'C');

                    $pdf->Cell(9, 5, $value->final_nota, 1, 0, 'C');
                    $numeroEnLetras = $this->numeroALetras($value->final_nota);
                    $pdf->Cell(16, 5, $numeroEnLetras, 1, 0, 'C');
                    $pdf->Cell(6, 5, $value->nro_carpeta_nota, 1, 0, 'C');
                    $pdf->Cell(6, 5, $value->nro_folio_nota, 1, 0, 'C');
                    $pdf->Cell(15, 5, $value->observacion_nota, 1, 0, 'C');
                    $pdf->Cell(15, 5, '', 1, 0, 'C');

                    if ($value->final_nota > 50) {
                        $apr = $apr + 1;
                        $notasumatoria = $notasumatoria + $value->final_nota;
                        $horasacademicas = $horasacademicas + (int)$value->carga_horaria_planificar_asignartura;
                    }
                }

                $pdf->Ln(10);
                $pdf->SetFont('Arial', 'B', 4);
                $pdf->SetXY(130, $pdf->getY());
                $pdf->Cell(60, 4, 'PROMEDIO GENERAL DE NOTAS:', 1, 0, 'L');
                $pdf->Cell(12, 4, round($notasumatoria / $apr), 1, 0, 'C');
                $pdf->Ln(4);
                $pdf->SetXY(130, $pdf->getY());
                $pdf->Cell(60, 4, (utf8_decode('Nº TOTAL DE ASIGNATURAS APROBADAS:')), 1, 0, 'L');
                $pdf->Cell(12, 4, $apr, 1, 0, 'C');

                $pdf->Ln(4);
                $pdf->SetXY(130, $pdf->getY());
                $pdf->Cell(60, 4, 'TOTAL HORAS ACADEMICAS:', 1, 0, 'L');
                $pdf->Cell(12, 4, $horasacademicas, 1, 0, 'C');
                $pdf->Ln(20);

                $pdf->Ln(45);
                $pdf->Cell(20, 7, ('Pág. ') . $pdf->PageNo() . ' de {nb}', 0, 0, 'R');
                $pdf->Cell(10, 5, '', 0, 0, 'C');
                $pdf->Cell(50, 5, 'Kardex', 0, 0, 'C');
                $pdf->Cell(10, 5, '', 0, 0, 'C');
                $pdf->Cell(50, 5, 'Director(a)', 0, 0, 'C');
                $pdf->Cell(10, 5, '', 0, 0, 'C');
                $pdf->Cell(50, 5, 'Sello', 0, 0, 'C');

                $pdf->Ln(13);
                $pdf->Cell(0, 0, 'NOTA: Escala de calificaciones; 1 a 100 y sus valores: 1 a 50 = reprobado; 51 a 63 = suficiente; 64 a 76 = bueno; 77 a 89 = distinguido; 90 a 100 = sobresaliente.', 0, 0, 'L');
                $pdf->Ln(2);
                $pdf->Cell(0, 0, 'ADVERTENCIA: Este Historial Académico de Calificaciones queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.', 0, 0, 'L');

                $pdf->SetXY(20, 50);

                $pdfgenerado = $pdf->Output();
            }, $title . ".pdf");
            exit;
        } else {
            $this->emit('errorvalidate', 'Sin materias inscritas.');
        }
    }

    public $ci;
    public $expedido;
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

    public function updatedCi()
    {
        $this->buscarpersona();
    }

    public function buscarpersona()
    {
        $persona_encontrada = tabla_persona::where('ci', $this->ci)->first();
        if ($persona_encontrada) {
            $this->id_persona_base_upea = $persona_encontrada->id;
            $this->ci = $persona_encontrada->ci;
            $this->expedido = $persona_encontrada->expedido;
            $this->estado_civil = $persona_encontrada->estado_civil;
            $this->paterno = $persona_encontrada->paterno;
            $this->materno = $persona_encontrada->materno;
            $this->nombre = $persona_encontrada->nombre;
            $this->pais = $persona_encontrada->nacionalidad;
            $this->genero = $persona_encontrada->genero;
            $this->fecha_nacimiento = $persona_encontrada->fecha_nac;


            $this->telefono = $persona_encontrada->telefono;
            $this->celular = $persona_encontrada->celular;
            $this->email = $persona_encontrada->email;
        } else {
            $this->id_persona_base_upea = '';
            $this->reset([
                'expedido',
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
            $this->resetValidation([
                'expedido',
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
        }
    }

    public function agregar_persona(){
        $this->cancelar();
        $this->operation = 'guardarpersona';
        $this->emit("abrimodaldeguardarpersona");

    }
    public function guardarpersonanueva()
    {
        
        $this->validate();

        $create_persona = new SiadiPersona();
        $create_persona->ci_persona = $this->ci;
        $create_persona->expedido_persona = $this->expedido;
        if ($this->id_persona_base_upea) {
            $create_persona->id_persona_base_upea = $this->id_persona_base_upea;
        }


        $create_persona->estado_civil_persona = $this->estado_civil;
        $create_persona->paterno_persona = $this->paterno;
        $create_persona->materno_persona = $this->materno;
        $create_persona->nombres_persona = $this->nombre;

        $create_persona->genero_persona = $this->genero;
        $create_persona->fecha_nacimiento_persona = $this->fecha_nacimiento;
        $create_persona->profesion_persona = $this->profesion;
        $create_persona->direccion_persona = $this->direccion;
        $create_persona->telefono_persona = $this->telefono==''? null: $this->telefono;
        $create_persona->celular_persona = $this->celular;
        $create_persona->email_persona  = $this->email;
        $create_persona->id_tipo_estudiante   = $this->tipo_estudiante;
        $create_persona->tipo_documento   = 'CI';
        $create_persona->id_pais         = $this->pais;
        $pais_seleccionado = Pais::where('id_siadi_pais', $this->pais)->first();
        $create_persona->pais_persona         = strtoupper($pais_seleccionado->nombre_siadi_pais);

        $create_persona->save();
        $this->emit('alert', 'Se guardo exitosamente a la Persona');
        $this->cancelar();
    }
    public function cancelar()
    {
        $this->operation = "";
        $this->reset([
            'ci',
            'expedido',
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
        $this->emit('cerrarmodaldeguardarpersona');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function guardareditarapersona()
    {
        if($this->operation=='guardareditarpersona'){
            $this->validate();
            $persona_editar = SiadiPersona::find($this->id_editar_persona_actual);
            $pais_seleccionado = Pais::where('id_siadi_pais', $this->pais_edit)->first();

            $persona_editar->ci_persona =  $this->ci_edit;
            $persona_editar->nombres_persona = $this->nombre_edit;
            $persona_editar->paterno_persona= $this->paterno_edit;
            $persona_editar->materno_persona = $this->materno_edit;
            $persona_editar->email_persona = $this->email_edit;
            $persona_editar->expedido_persona = $this->expedido_edit;
            $persona_editar->direccion_persona = $this->direccion_edit;
            $persona_editar->telefono_persona = $this->telefono_edit==""? null: $this->telefono_edit;
            $persona_editar->celular_persona = $this->celular_edit;
            $persona_editar->estado_civil_persona = $this->estado_civil_edit;
            $persona_editar->fecha_nacimiento_persona = $this->fecha_nacimiento_edit;
            $persona_editar->id_pais = $this->pais_edit;
            $persona_editar->pais_persona = strtoupper($pais_seleccionado->nombre_siadi_pais);
            $persona_editar->genero_persona = $this->genero_edit;
            $persona_editar->profesion_persona = $this->profesion_edit;
            $persona_editar->id_tipo_estudiante = $this->tipo_estudiante_edit;
            $persona_editar->save();
            $this->emit('alert', 'Se edito la Persona satisfactoriamente ');
            $this->cancelarEditar();
        } else {
            $this->emit("errorvalidate", "acceso ilegal");
        }
    }

    public $asignaturas = [];

    public function inscribirestudiante($id_estudiante)
    {



        $estudiante = SiadiPersona::where('id_siadi_persona', $id_estudiante)->first();

        $this->idestudianteactual = $estudiante->id_siadi_persona;
        $this->emit('abrimodalinscripcion');

        $this->estudiante = $estudiante->paterno_persona . ' ' . $estudiante->materno_persona . ' ' . $estudiante->nombres_persona;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $persona_inscripcion;

    public function verhistorial($persona)
    {
        $this->emit('abrirmodalpersonahistorial');

        $this->persona_inscripcion = $persona;
    }






    public $editingNotaId = null;
    public $editedNota;
    // public $editedNotaObs;
    // public $originalNotaObs;
    public $originalNota; // Variable para almacenar el valor original



    public function startEditingNota($id)
    {
        $this->editingNotaId = $id;
        $this->originalNota = SiadiNota::find($id)->final_nota;
        $this->editedNota = $this->originalNota;
        // $this->editedNotaObs = $this->originalNotaObs;
    }

    public function guardar_editar_nota($id)
    {
        $this->operation = 'cambiarnota';
        $this->validate();
        $notaedit = SiadiNota::find($id);
        $notaedit->final_nota = $this->editedNota;
        // $notaedit->observaciones_detalle = $this->originalNotaObs;
        // dd($this->originalNotaObs);

        
        if ($this->editedNota >= 51) {
            $notaedit->observacion_nota = 'APROBADO';
            // $notaedit->observaciones_detalle = $this->originalNotaObs;
            $notaedit->observaciones_detalle = 'APROBADO';
        } else {
            $notaedit->observacion_nota = 'REPROBADO';
            // $notaedit->observaciones_detalle = $this->originalNotaObs;
            $notaedit->observaciones_detalle = 'REPROBADO';
        }
        $notaedit->id_usuario =  Auth::id();
        $notaedit->save();
        $this->emit('alert', 'Se edito con éxito');
        $this->editingNotaId = null;
        $this->cancelar_edit_nota();
    }

    public function cancelar_edit_nota()
    {
        $this->editingNotaId = null;
        $this->operation = '';
    }


    public  function anularinscripcion($inscripcion)
    {
        $anularinsc = SiadiInscripcion::find($inscripcion);
        $anularinsc->estado_inscripcion = 'ANULADO';
        $this->emit('alert', 'ASIGNTURA ANULADA');
        $anularinsc->update();
    }

    /* DAR DE BAJA NOTA INICIO*/
    public $nota_baja_actual;
    public function inicia_baja_nota($id)
    {
        $this->nota_baja_actual = SiadiNota::where('id_nota', $id)->first();
        if(!is_null($this->nota_baja_actual)){
            $this->operation = 'dar_baja';
            $this->nota_final_baja = 0;
            $this->observacion_nota_baja = 'BAJA';
            $this->observaciones_detalle_baja = "BAJA POR ". "CON NOTA ". $this->nota_baja_actual->final_nota;
        }
    }

    public function cancelar_baja(){
        $this->operation = '';
        $this->nota_baja_actual = null;
        $this->reset([
            'nota_final_baja',
            'observacion_nota_baja',
            'observaciones_detalle_baja',
        ]);
        $this->resetValidation();
    }

    public function guardar_baja(){
        if($this->operation === 'dar_baja' && !is_null($this->nota_baja_actual)){
            $this->validate();
            try {
                $nota_find = SiadiNota::find($this->nota_baja_actual->id_nota);
                $nota_find->final_nota = $this->nota_final_baja;
                $nota_find->observacion_nota = $this->observacion_nota_baja;
                $nota_find->observaciones_detalle = $this->observaciones_detalle_baja;
                $nota_find->id_usuario =  Auth::id();
                $nota_find->save();
                $this->emit("alert", "Baja a nota asignada exitosamente");
                $this->cancelar_baja();
            } catch(\Exception $e){
                $this->emit("errorvalidate", "Error al dar de baja: ". $e->getMessage());
            }
        } else {
            $this->emit("errorvalidate", "No hay nota . acceso ilegal");
        }
    }

    /* DAR DE BAJA NOTA FIN */

    
    public function render()
    {
        $paises = Pais::all();
        $materias_preinscritas = SiadiPreInscripcion::where('id_siadi_persona', $this->idestudianteactual)
            ->where('estado_inscripcion', 'ACTIVO')

            ->get();

        $query = SiadiPersona::where('estado_persona', '=', 'ACTIVO');
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('ci_persona', 'LIKE', '%' . $this->search . '%')
                  ->orWhere(DB::raw("CONCAT(nombres_persona, ' ',paterno_persona, ' ', materno_persona)"), 'LIKE', '%' . $this->search . '%');
            });
        }
        $personas = $query



            ->latest('id_siadi_persona')
            ->paginate();

        $inscripciones = [];
        $inscripciones = SiadiInscripcion::where('id_siadi_persona', $this->persona_inscripcion)
            ->get();
        $tipo_estudiante2 = SiadiTipoEstudiante::where('estado_tipo_estudiante', 'ACTIVO')->get();
        $asignaturas_validas = []; // Inicializa la variable

        $asignaturas_deplanifi_actual = SiadiPlanificarAsignatura::where('id_planificar_asignatura', $this->asignaturaid)->first();

        if ($asignaturas_deplanifi_actual) {
            $anioActual = strval(date('Y'));
            $asignaturas_validas =
                DB::table('siadi_planificar_asignaturas')
                ->join('siadi_convocatorias', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'siadi_convocatorias.id_siadi_convocatoria')
                ->join('siadi_tipo_convocatorias', 'siadi_convocatorias.id_tipo_convocatoria', '=', 'siadi_tipo_convocatorias.id_tipo_convocatoria')
                ->join('siadi_tipo_estudiantes', 'siadi_tipo_convocatorias.id_tipo_estudiante', '=', 'siadi_tipo_estudiantes.id_tipo_estudiante')
                ->join('siadi_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')
                ->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')
                ->join('siadi_nivel_idiomas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')
                ->join('siadi_paralelos', 'siadi_planificar_asignaturas.id_paralelo', '=', 'siadi_paralelos.id_paralelo')
                ->join('siadi_gestions', 'siadi_convocatorias.id_gestion', '=', 'siadi_gestions.id_gestion')
                ->join('siadi_modalidad_curso', 'siadi_convocatorias.id_modalidad_curso', '=', 'siadi_modalidad_curso.id_convocartoria_estudiante')
               
                
                ->where('siadi_planificar_asignaturas.id_siadi_convocatoria', '=', $asignaturas_deplanifi_actual->id_siadi_convocatoria )
                ->where('siadi_planificar_asignaturas.id_siadi_asignatura', '=', $asignaturas_deplanifi_actual->id_siadi_asignatura)
                ->get();
        }

        return view('livewire.administracion-modulos.persona-index', compact('personas', 'paises', 'tipo_estudiante2', 'materias_preinscritas', 'inscripciones', 'asignaturas_validas'));
    }


    public $asignaturaid;
    public $asignaturaGuardar;
    public $id_inscripcion_actual;
    public  $idpersona;
    public $tipopersonaunica;
    public $nombre_asignatura_edit;
    public $asignaturaidedit;
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
   
    public function editar_asignatura($inscripcion){
        $inscripcion_ac = SiadiInscripcion::where('id_inscripcion', $inscripcion)->first();
        $this->asignaturaid=$inscripcion_ac->id_planificar_asignatura;
        $this->id_inscripcion_actual = $inscripcion;
    }
    public function cancelareditarinsc(){
        $this->asignaturaid=null;
    }
    public $asignatura_edite;
    public function editar_inscripcion_asignatura(){
        $this->operation = 'edite_inscripcion';
        $this->validate();
    $edite_inscripcion=SiadiInscripcion::find($this->id_inscripcion_actual);
$edite_inscripcion->id_planificar_asignatura =$this->asignatura_edite;
$edite_inscripcion->update();
$this->emit('alert', 'Se actualizó la asignatura con exito');
    }
}
