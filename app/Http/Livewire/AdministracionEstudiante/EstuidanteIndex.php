<?php

namespace App\Http\Livewire\AdministracionEstudiante;

use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiPreInscripcion;
use App\Models\PreRequisito;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Livewire\Component;

class EstuidanteIndex extends Component
{

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

    private function getMateriasPredeterminadas($tipopersona = null)
    {

 $materias_preinscritas = $this->materias_preinscritas();

        return DB::table('siadi_planificar_asignaturas AS p')
            ->join('siadi_convocatorias AS c', 'p.id_siadi_convocatoria', '=', 'c.id_siadi_convocatoria')
            ->join('siadi_tipo_convocatorias AS tc', 'c.id_tipo_convocatoria', '=', 'tc.id_tipo_convocatoria')
            ->join('siadi_tipo_estudiantes AS te', 'tc.id_tipo_estudiante', '=', 'te.id_tipo_estudiante')
            ->join('siadi_asignaturas AS asig', 'p.id_siadi_asignatura', '=', 'asig.id_siadi_asignatura')
            ->join('siadi_idiomas AS idiom', 'asig.id_idioma', '=', 'idiom.id_idioma')
            ->join('siadi_nivel_idiomas AS na', 'asig.id_nivel_idioma', '=', 'na.id_nivel_idioma')
            ->join('siadi_paralelos AS par', 'p.id_paralelo', '=', 'par.id_paralelo')
            #->join('siadi_convocartoria_estudiantes AS sce', 'tc.id_convocartoria_estudiante', '=', 'sce.id_convocartoria_estudiante')
            ->join('siadi_modalidad_curso AS mt', 'c.id_modalidad_curso', '=', 'mt.id_convocartoria_estudiante')
            ->whereIn('p.id_siadi_asignatura', [1, 7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67])
            ->where('p.estado_planificar_asignartura', 'ACTIVO')
               ->whereNotIn('p.id_planificar_asignatura', $materias_preinscritas)
            ->whereDate('c.fecha_fin', '>=', DB::raw('CURDATE()'))
            ->get();
      
    }
    
    private function materias_preinscritas(){
        $persona=Auth::user()->id_persona_siadi;
      
        
        $inscripciones_activas=SiadiPreInscripcion::where('id_siadi_persona',$persona)
        ->where('estado_inscripcion','=','ACTIVO')
        ->where('observacion_inscripcion','=','SIN OBSERVACION')
        ->get();

        $asignatura_pendientes=[];
        foreach ($inscripciones_activas as$value) {
            $asignatura_pendientes[]=$value->id_planificar_asignatura ;
        }
  return $asignatura_pendientes;


    }
    private function getMateriasHabilitadas($idSiadiAsignatura, $tipoestudiante)
    {
        $materias_preinscritas = $this->materias_preinscritas();
        
        return  DB::table('siadi_planificar_asignaturas AS p')
            ->join('siadi_convocatorias AS c', 'p.id_siadi_convocatoria', '=', 'c.id_siadi_convocatoria')
            ->join('siadi_tipo_convocatorias AS tc', 'c.id_tipo_convocatoria', '=', 'tc.id_tipo_convocatoria')
            ->join('siadi_tipo_estudiantes AS te', 'tc.id_tipo_estudiante', '=', 'te.id_tipo_estudiante')
            ->join('siadi_asignaturas AS asi', 'p.id_siadi_asignatura', '=', 'asi.id_siadi_asignatura')
            ->join('siadi_idiomas AS i', 'asi.id_idioma', '=', 'i.id_idioma')
            ->join('siadi_paralelos AS par', 'p.id_paralelo', '=', 'par.id_paralelo')
            ->join('siadi_nivel_idiomas AS niv', 'asi.id_nivel_idioma', '=', 'niv.id_nivel_idioma')
            ->join('siadi_convocartoria_estudiantes AS sce', 'tc.id_convocartoria_estudiante', '=', 'sce.id_convocartoria_estudiante')
            ->join('siadi_modalidad_curso AS mt', 'c.id_modalidad_curso', '=', 'mt.id_convocartoria_estudiante')
            ->where('p.id_siadi_asignatura', $idSiadiAsignatura)
           ->whereNotIn('p.id_planificar_asignatura', $materias_preinscritas)
            ->where('p.estado_planificar_asignartura', 'ACTIVO')
            ->whereDate('c.fecha_fin', '>=', DB::raw('CURDATE()'))
            ->get();
    }

    public $tipopago;
    public $numero_deposito;
    public $idasignatura;
    public $operation;
    public $fechaDeposito;
    public $nroDeposito;

    public function rules()
    {
        if ($this->operation === 'savepreinscribir') {
            return $this->rulesForPreIncribir();
        }

        return array_merge($this->rulesForPreIncribir());
    }

    public $monto;
    public $fecha_deposito;
    private function rulesForPreIncribir()
    {
        $rules = [

            'nroDeposito.*' => 'required|numeric|max:999999999',
            'fechaDeposito.*' => 'required|date',
            'idasignatura.*' => 'required',
        ];

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function preinscibir($idinscripcion, $idestudiante, $nrodeposito, $fechadeposito)
    {

        $this->operation = 'savepreinscribir';
        $this->validate();

        $cantidadestudiantesinscritos = DB::selectOne("SELECT COUNT(*) AS preinscritos  FROM siadi_pre_inscripcions WHERE id_planificar_asignatura=:inscripcion AND estado_inscripcion='ACTIVO';", [
            'inscripcion' => $idinscripcion,
        ]);

        $planificar_asignatura_seleccionada =
            DB::selectOne("SELECT pa.id_planificar_asignatura, si.id_idioma, sc.id_siadi_convocatoria , pa.cupo_maximo_paralelo FROM siadi_planificar_asignaturas AS pa JOIN siadi_convocatorias AS sc ON pa.id_siadi_convocatoria= sc.id_siadi_convocatoria JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura= a.id_siadi_asignatura JOIN siadi_idiomas AS si ON a.id_idioma = si.id_idioma WHERE pa.id_planificar_asignatura= :inscripcion  ;", [
                'inscripcion' => $idinscripcion,
            ]);

        $existencia_de_idioma = DB::select(
            "SELECT spi.id_pre_inscripcion, spi.id_planificar_asignatura, si.id_idioma, sc.id_siadi_convocatoria, spi.id_siadi_persona FROM siadi_pre_inscripcions AS spi  INNER JOIN siadi_planificar_asignaturas AS pa ON spi.id_planificar_asignatura=pa.id_planificar_asignatura INNER JOIN siadi_convocatorias AS sc ON pa.id_siadi_convocatoria= sc.id_siadi_convocatoria JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura= a.id_siadi_asignatura JOIN siadi_idiomas AS si ON a.id_idioma = si.id_idioma WHERE si.id_idioma=:idioma AND spi.id_siadi_persona=:persona AND sc.id_siadi_convocatoria=:convocatoria AND spi.estado_inscripcion='ACTIVO'  ;",
            [
                'idioma' => $planificar_asignatura_seleccionada->id_idioma,
                'persona' => $idestudiante,
                'convocatoria' => $planificar_asignatura_seleccionada->id_siadi_convocatoria,
            ]
        );
        $cantidad = DB::select(
            "SELECT COUNT(*) AS cantidad_registros FROM siadi_pre_inscripcions AS spi JOIN siadi_planificar_asignaturas AS pa ON spi.id_planificar_asignatura = pa.id_planificar_asignatura JOIN siadi_convocatorias AS sc ON pa.id_siadi_convocatoria = sc.id_siadi_convocatoria JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura = a.id_siadi_asignatura JOIN siadi_idiomas AS si ON a.id_idioma = si.id_idioma WHERE spi.id_siadi_persona = :persona AND sc.id_siadi_convocatoria = :convocatoria AND spi.estado_inscripcion='ACTIVO' ;",
            [

                'persona' => $idestudiante,
                'convocatoria' => $planificar_asignatura_seleccionada->id_siadi_convocatoria,
            ]
        );

        if ($cantidadestudiantesinscritos->preinscritos <= $planificar_asignatura_seleccionada->cupo_maximo_paralelo) {
            if ($existencia_de_idioma) {
                $this->emit('errorvalidate', 'Usted ya se encuentra preinscrito en este idioma');
            } else {
                if ($cantidad[0]->cantidad_registros < 3) {

                    $nueva_preinscripcion = new SiadiPreInscripcion();
                    $nueva_preinscripcion->id_siadi_persona = $idestudiante;
                    $nueva_preinscripcion->id_planificar_asignatura = $idinscripcion;
                    $nueva_preinscripcion->tipo_pago_inscripcion = 'Depósito';
                    $nueva_preinscripcion->fecha_inscripcion = $fechadeposito;
                    $nueva_preinscripcion->observacion_inscripcion = 'SIN OBSERVACION';
                    $asignatura_seleccionada = SiadiPlanificarAsignatura::find($idinscripcion);

                    $nueva_preinscripcion->monto_deposito  = $asignatura_seleccionada->siadi_convocatoria->monto_convocatoria;
                    $nueva_preinscripcion->nro_deposito = $nrodeposito;



                    $nueva_preinscripcion->save();
                    $this->cancelarpreinscripcion();
                    $this->emit('alert', 'se realizo la preinscipcion');
                } else {
                    $this->emit('errorvalidate', 'Solo puede realizar la preinscripcion de dos idiomas');
                }
            }
        } else {
            $this->emit('errorvalidate', 'ASIGNATURA SIN CUPOS');
        }
    }
    public function anular_preincripcion($asignatura, $persona)
    {
        $preinscripcion_activa = SiadiPreInscripcion::where('id_planificar_asignatura', $asignatura)
            ->where('id_siadi_persona', $persona)
            ->where('estado_inscripcion', 'ACTIVO')
            ->first();

        if ($preinscripcion_activa) {
            $preinscripcion_activa->estado_inscripcion = 'INACTIVO';
            $preinscripcion_activa->update();
            $this->emit('alert', 'PREINSCIPCIÓN ANULADA');
        }
    }
    public function cancelarpreinscripcion()
    {
        $this->reset(['nroDeposito', 'fechaDeposito', 'idasignatura']);
        $this->resetValidation();
    }
    public function cancelar_preinscripcion(SiadiPreInscripcion $dipreincripcion){
        $dipreincripcion->estado_inscripcion='ELIMINAR';
        $dipreincripcion->update();
    }
    public function render()
    {

        $persona_auth = Auth::user();

        $datos_persona = SiadiPersona::where('id_siadi_persona', $persona_auth->id_persona_siadi)->first();

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

        $materiasaprobadas = DB::select("
            SELECT i.id_inscripcion, pa.id_planificar_asignatura, a.id_siadi_asignatura, ia.id_idioma
            FROM siadi_inscripcions AS i
            JOIN siadi_planificar_asignaturas AS pa ON i.id_planificar_asignatura = pa.id_planificar_asignatura
            JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura = a.id_siadi_asignatura
            JOIN siadi_idiomas AS ia ON a.id_idioma = ia.id_idioma
            JOIN siadi_nivel_idiomas AS na ON a.id_nivel_idioma = na.id_nivel_idioma
            JOIN siadi_notas AS n ON i.id_inscripcion = n.id_inscripcion
            WHERE i.id_siadi_persona = ?
            AND n.final_nota >= 51
            ORDER BY a.id_siadi_asignatura, ia.id_idioma;", [$persona_auth->id_persona_siadi]);

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
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualAymara, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualIngles != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualIngles, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualCastellano != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualCastellano, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualQuechua != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualQuechua, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualChinoMandarin != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualChinoMandarin, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualPortugues != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualPortugues, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualFrances != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualFrances, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualItaliano != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualItaliano, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualAleman != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualAleman, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualGuarani != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualGuarani, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualUruPukina != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualUruPukina, $datos_persona->id_tipo_estudiante);
        }
        if ($materiaActualUruRuso != null) {
            $materiaAtomarhabilitadas[] = $this->getMateriasHabilitadas($materiaActualUruRuso, $datos_persona->id_tipo_estudiante);
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
             $materias_preinscritas = $this->materias_preinscritas();
            $OtrasAsignaturasHabilitadas =
                DB::table('siadi_planificar_asignaturas AS p')
                ->join('siadi_convocatorias AS c', 'p.id_siadi_convocatoria', '=', 'c.id_siadi_convocatoria')
                #->join('siadi_tipo_convocatorias AS tc', 'c.id_tipo_convocatoria', '=', 'tc.id_tipo_convocatoria')
                #->join('siadi_tipo_estudiantes AS te', 'tc.id_tipo_estudiante', '=', 'te.id_tipo_estudiante')
                ->join('siadi_asignaturas AS asig', 'p.id_siadi_asignatura', '=', 'asig.id_siadi_asignatura')
                ->join('siadi_idiomas AS idiom', 'asig.id_idioma', '=', 'idiom.id_idioma')
                ->join('siadi_modalidad_curso AS mc', 'c.id_modalidad_curso', '=', 'mc.id_convocartoria_estudiante')
                ->join('siadi_nivel_idiomas AS na', 'asig.id_nivel_idioma', '=', 'na.id_nivel_idioma')
                ->join('siadi_paralelos AS par', 'p.id_paralelo', '=', 'par.id_paralelo')
                #->join('siadi_convocartoria_estudiantes AS sce', 'tc.id_convocartoria_estudiante', '=', 'sce.id_convocartoria_estudiante')
                ->join('siadi_modalidad_curso AS mt', 'c.id_modalidad_curso', '=', 'mt.id_convocartoria_estudiante')
                ->whereIn('p.id_siadi_asignatura', [1, 7, 13, 19, 25, 31, 37, 43, 49, 55, 61, 67])
                ->where('p.estado_planificar_asignartura', 'ACTIVO')
                 ->whereNotIn('p.id_planificar_asignatura', $materias_preinscritas)
                ->whereNotIn('asig.id_idioma', $idiomasExcluidos)
                ->whereDate('c.fecha_fin', '>=', DB::raw('CURDATE()'))
                ->get();
        } else {
            $OtrasAsignaturasHabilitadas = $this->getMateriasPredeterminadas(); /* $datos_persona->id_tipo_estudiante */
        }

        $materiasInscritas = DB::select("
            SELECT * FROM siadi_inscripcions AS i JOIN siadi_planificar_asignaturas AS pa ON i.id_planificar_asignatura = pa.id_planificar_asignatura 
                JOIN siadi_asignaturas AS a ON pa.id_siadi_asignatura = a.id_siadi_asignatura 
                JOIN siadi_idiomas AS ia ON a.id_idioma = ia.id_idioma 
                JOIN siadi_nivel_idiomas AS na ON a.id_nivel_idioma = na.id_nivel_idioma 
                JOIN siadi_notas AS n ON i.id_inscripcion = n.id_inscripcion
            JOIN siadi_paralelos AS par ON pa.id_paralelo=par.id_paralelo
            WHERE i.id_siadi_persona = " . (is_null($persona_auth->id_persona_siadi) ? "-1" : $persona_auth->id_persona_siadi)  . "
            ORDER BY ia.id_idioma;
            ");
$materias_preinscritas=SiadiPreInscripcion::where('id_siadi_persona',$persona_auth->id_persona_siadi)
->where('estado_inscripcion','=','ACTIVO')->get();

        # de prueba
        $materias_prueba = $this->getMateriasInscripcion()->get();
        $mat_aprobados = $this->get_materias_aprobadas()->orderBy('siadi_idiomas.id_idioma')->get();
        $mat_inscribir = $this->get_asignaturas_habilitadas();
        $mat_segundo = $this->get_asignaturas_habilitadas_dos();
        $inscripciones = $this->get_materias_disponibles_tgn();

        return view('livewire.administracion-estudiante.estuidante-index', compact('persona_auth', 'materiasInscritas', 'materiaAtomarhabilitadas', 'OtrasAsignaturasHabilitadas','materias_preinscritas', 
            'materias_prueba', 'mat_aprobados', 'mat_inscribir', 'mat_segundo', 'inscripciones'));
    }

    # 1 - curso regular 
    # 2 - examen 
    private function getMateriasInscripcion(){
        $materias = DB::table('siadi_planificar_asignaturas')
            ->join('siadi_convocatorias AS siadi_convocatorias', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'siadi_convocatorias.id_siadi_convocatoria')
            ->join('siadi_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')
            ->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')
            ->join('siadi_nivel_idiomas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')
            ->join('siadi_paralelos', 'siadi_planificar_asignaturas.id_paralelo', '=', 'siadi_paralelos.id_paralelo')
            ->join('siadi_modalidad_curso', 'siadi_convocatorias.id_modalidad_curso', '=', 'siadi_modalidad_curso.id_convocartoria_estudiante')
            ->join('siadi_costos', 'siadi_convocatorias.id_costo', '=', 'siadi_costos.id_costo')
            ->where('siadi_convocatorias.estado_convocatoria', 'ACTIVO')
            ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', 'ACTIVO')
            #->whereNotIn('p.id_planificar_asignatura', $materias_preinscritas)
            #->whereNotIn('asig.id_idioma', $idiomasExcluidos)
            ->whereDate('siadi_convocatorias.fecha_fin', '>=', DB::raw('CURDATE()'));
        return $materias;
    }

    private function get_materias_aprobadas(){
        return DB::table('siadi_inscripcions')
            ->join('siadi_planificar_asignaturas', 'siadi_inscripcions.id_planificar_asignatura', '=', 'siadi_planificar_asignaturas.id_planificar_asignatura')
            ->join('siadi_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')
            ->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')
            ->join('siadi_nivel_idiomas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')
            ->join('siadi_notas', 'siadi_inscripcions.id_inscripcion', '=', 'siadi_notas.id_inscripcion')
            ->join('siadi_convocatorias AS siadi_convocatorias', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'siadi_convocatorias.id_siadi_convocatoria')
            ->join('siadi_modalidad_curso', 'siadi_convocatorias.id_modalidad_curso', '=', 'siadi_modalidad_curso.id_convocartoria_estudiante')
            ->join('siadi_costos', 'siadi_convocatorias.id_costo', '=', 'siadi_costos.id_costo')
            
            ->select(
                'siadi_inscripcions.id_inscripcion',
                'siadi_planificar_asignaturas.id_planificar_asignatura',
                'siadi_asignaturas.id_siadi_asignatura',
                'siadi_idiomas.id_idioma',
                'siadi_planificar_asignaturas.id_paralelo',
                DB::raw("CONCAT(siadi_idiomas.nombre_idioma, ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS materia_ap"),
                DB::raw("CONCAT(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' - ', siadi_costos.tipo_costo) AS modalidad")
            )
            ->where('siadi_inscripcions.id_siadi_persona', Auth::user()->id_persona_siadi)
            ->where('siadi_notas.final_nota', '>=', 51);
    }

    # asumiendo que en un periodo, solo se puede tomar 2 materias 
    private $ID_TIPO_ESTUDIANTE_UNIVERSITARIO = 1; # 1, UNIVERSITARIO U.P.E.A.
    private function get_asignaturas_habilitadas(){
        $this->emit("Mostrar", json_encode(Auth::user()->persona));
        if(!is_null(Auth::user()->persona)){
            $tipo_estudiante = Auth::user()->persona->tipo_estudiante->id_tipo_estudiante;
            if($tipo_estudiante == $this->ID_TIPO_ESTUDIANTE_UNIVERSITARIO){
                # LISTAR SOLO CURSOS TGN, para la preinscripción
                $materias = $this->getMateriasInscripcion()
                    ->where('siadi_modalidad_curso.id_convocartoria_estudiante', 1)
                    ->where('siadi_costos.tipo_costo', 'TGN')
                    ->orderBy('siadi_idiomas.id_idioma')
                    ->get();
                return $materias;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    private function get_asignaturas_habilitadas_dos(){
        if(!is_null(Auth::user()->persona)){
            $tipo_estudiante = Auth::user()->persona->tipo_estudiante->id_tipo_estudiante;
            if($tipo_estudiante == $this->ID_TIPO_ESTUDIANTE_UNIVERSITARIO){
                # LISTAR SOLO CURSOS TGN, para la preinscripción
                $materias = $this->getMateriasInscripcion()
                    ->select(
                        'siadi_idiomas.id_idioma',
                        'siadi_idiomas.nombre_idioma',
                        DB::raw($this->subconsulta_materia_habilitada("vencido_ultimo")),
                        DB::raw("CASE 
                            WHEN ". $this->subconsulta_materia_habilitada() ." IS NULL
                                THEN -- 'buscar convocatoria 1.1'
                                (
                                    SELECT sniv2.id_nivel_idioma
                                    FROM siadi_inscripcions AS sins2
                                        INNER JOIN siadi_planificar_asignaturas AS spas2 ON(sins2.id_planificar_asignatura = spas2.id_planificar_asignatura)
                                        INNER JOIN siadi_asignaturas AS sas2 ON(spas2.id_siadi_asignatura = sas2.id_siadi_asignatura)
                                        INNER JOIN siadi_idiomas AS sidi2 ON(sas2.id_idioma = sidi2.id_idioma)
                                        INNER JOIN siadi_nivel_idiomas AS sniv2 ON(sas2.id_nivel_idioma = sniv2.id_nivel_idioma)
                                        INNER JOIN siadi_notas AS snot2 ON(sins2.id_inscripcion = snot2.id_inscripcion)
                                        INNER JOIN siadi_convocatorias AS scov2 ON(spas2.id_siadi_convocatoria = scov2.id_siadi_convocatoria)
                                        INNER JOIN siadi_modalidad_curso AS smcu2 ON(scov2.id_modalidad_curso = smcu2.id_convocartoria_estudiante)
                                        INNER JOIN siadi_costos AS scos2 ON(scov2.id_costo = scos2.id_costo)
                                    WHERE 
                                        smcu2.id_convocartoria_estudiante = 1 AND
                                        scos2.tipo_costo = 'TGN' AND
                                        siadi_idiomas.id_idioma = sidi2.id_idioma AND
                                        sniv2.nombre_nivel_idioma = '1.1'
                                    LIMIT 1
                                )
                            WHEN ". $this->subconsulta_materia_habilitada() ." = '3.2' 
                                THEN 'FIN asignatura'
                            
                            ELSE 'Buscar siguiente convocatoria' -- NULL -- no hay convocatoria
                                
                        END
                        AS ultimo_nivel")
                    )
                    ->where('siadi_modalidad_curso.id_convocartoria_estudiante', 1)
                    ->where('siadi_costos.tipo_costo', 'TGN')
                    ->groupBy('siadi_idiomas.id_idioma')
                    ->get();
                
                #segundo materias 
                $otro = $this->get_materias_aprobadas()
                    ->addSelect(
                        'siadi_idiomas.id_idioma',
                        DB::raw("MAX(siadi_nivel_idiomas.id_nivel_idioma) AS nivel_maximo"),
                    )
                    ->groupBy('siadi_idiomas.id_idioma');
                    #->get();

                $nev_mat = $this->get_asignaturas_habilitadas_dos() #$this->getMateriasInscripcion()
                    ->leftJoinSub($otro, 'tabla_dos',
                        function(JoinClause $join){
                            $join->on('tabla_dos.id_idioma', '=', 'siadi_idiomas.id_idioma');
                        }
                    )
                    ->where('siadi_modalidad_curso.id_convocartoria_estudiante', 1)
                    ->where('siadi_costos.tipo_costo', 'TGN')
                    ->addSelect(
                        'siadi_nivel_idiomas.id_nivel_idioma',
                        'nivel_maximo',
                        'siadi_nivel_idiomas.descripcion_nivel_idioma',
                        'siadi_nivel_idiomas.nombre_nivel_idioma',
                        'siadi_idiomas.id_idioma',
                        'siadi_idiomas.sigla_codigo_idioma',
                        'siadi_idiomas.nombre_idioma',
                        DB::raw("CASE
                            WHEN nivel_maximo IS NULL
                                THEN -- 'buscar convocatoria 1.1'
                                (
                                    SELECT MIN(sniv3.id_nivel_idioma )
                                    FROM siadi_nivel_idiomas sniv3
                                    INNER JOIN siadi_asignaturas AS sas3 ON(sas3.id_nivel_idioma = sniv3.id_nivel_idioma)
                                    WHERE sas3.id_idioma = siadi_idiomas.id_idioma
                                )
                            WHEN nivel_maximo = (
                                                    SELECT MAX(sniv3.id_nivel_idioma )
                                                    FROM siadi_nivel_idiomas sniv3
                                                    INNER JOIN siadi_asignaturas AS sas3 ON(sas3.id_nivel_idioma = sniv3.id_nivel_idioma)
                                                    WHERE sas3.id_idioma = tabla_dos.id_idioma
                                                )
                                THEN -- 'pregunta si vencio 3.2, si ha vencido retorna NULL' 
                                    NULL
                            ELSE -- 'buscar siguiente nivel'
                                (
                                    SELECT sniv2.id_nivel_idioma
                                    FROM siadi_inscripcions AS sins2
                                        INNER JOIN siadi_planificar_asignaturas AS spas2 ON(sins2.id_planificar_asignatura = spas2.id_planificar_asignatura)
                                        INNER JOIN siadi_asignaturas AS sas2 ON(spas2.id_siadi_asignatura = sas2.id_siadi_asignatura)
                                        INNER JOIN siadi_idiomas AS sidi2 ON(sas2.id_idioma = sidi2.id_idioma)
                                        INNER JOIN siadi_nivel_idiomas AS sniv2 ON(sas2.id_nivel_idioma = sniv2.id_nivel_idioma)
                                        INNER JOIN siadi_notas AS snot2 ON(sins2.id_inscripcion = snot2.id_inscripcion)
                                        INNER JOIN siadi_convocatorias AS scov2 ON(spas2.id_siadi_convocatoria = scov2.id_siadi_convocatoria)
                                        INNER JOIN siadi_modalidad_curso AS smcu2 ON(scov2.id_modalidad_curso = smcu2.id_convocartoria_estudiante)
                                        INNER JOIN siadi_costos AS scos2 ON(scov2.id_costo = scos2.id_costo)
                                    WHERE 
                                        scov2.estado_convocatoria = 'ACTIVO' AND
                                        spas2.estado_planificar_asignartura = 'ACTIVO' AND
                                        smcu2.id_convocartoria_estudiante = 1 AND
                                        scos2.tipo_costo = 'TGN' AND
                                        tabla_dos.id_idioma = sidi2.id_idioma AND
                                        sniv2.id_nivel_idioma = (nivel_maximo + 1) AND
                                        scov2.fecha_fin >= CURDATE()
                                    LIMIT 1
                                )
                        END AS nivel_inscripcion"),
                        )
                        #->orderBy('siadi_idiomas.id_idioma')
                        ->groupBy('siadi_idiomas.id_idioma')
                        ->get();
                return $nev_mat;
                #return $materias;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    # se usa
    private function subconsulta_materia_habilitada($name = null){
        $nuevo = (is_null($name))? "": " AS ". $name;
        return "(
            SELECT sniv2.id_nivel_idioma
            FROM siadi_inscripcions AS sins2
                INNER JOIN siadi_planificar_asignaturas AS spas2 ON(sins2.id_planificar_asignatura = spas2.id_planificar_asignatura)
                INNER JOIN siadi_asignaturas AS sas2 ON(spas2.id_siadi_asignatura = sas2.id_siadi_asignatura)
                INNER JOIN siadi_idiomas AS sidi2 ON(sas2.id_idioma = sidi2.id_idioma)
                INNER JOIN siadi_nivel_idiomas AS sniv2 ON(sas2.id_nivel_idioma = sniv2.id_nivel_idioma)
                INNER JOIN siadi_notas AS snot2 ON(sins2.id_inscripcion = snot2.id_inscripcion)
                INNER JOIN siadi_convocatorias AS scov2 ON(spas2.id_siadi_convocatoria = scov2.id_siadi_convocatoria)
                INNER JOIN siadi_modalidad_curso AS smcu2 ON(scov2.id_modalidad_curso = smcu2.id_convocartoria_estudiante)
                INNER JOIN siadi_costos AS scos2 ON(scov2.id_costo = scos2.id_costo)
            WHERE 
                smcu2.id_convocartoria_estudiante = 1 AND
                scos2.tipo_costo = 'TGN' AND
                siadi_idiomas.id_idioma = sidi2.id_idioma AND
                snot2.final_nota >= 51 AND
                sins2.id_siadi_persona = ". Auth::user()->id_persona_siadi ."
            ORDER BY sniv2.id_nivel_idioma DESC
            LIMIT 1
        )". $nuevo;
    }

    # MATERIAS A TOMAR
    private function get_materias_disponibles_tgn(){
        $array_paralelos = [];
        $mat_segundo = $this->get_asignaturas_habilitadas_dos();
        foreach($mat_segundo as $materia_puede){
            if(!is_null($materia_puede->nivel_inscripcion)){
                $materia_puede->paralelos_habilitados = $this->get_paralelos_tgn($materia_puede->id_idioma, $materia_puede->nivel_inscripcion);
                array_push($array_paralelos, $materia_puede);
                #$paralelos_actuales = $this->get_paralelos_tgn($materia_puede->id_idioma, $materia_puede->nivel_inscripcion);
                #$array_paralelos = array_merge($array_paralelos, $paralelos_actuales);
                #$array_paralelos = $array_paralelos->concat($paralelos_actuales);
            }
        }
        return $array_paralelos;
    }

    public function get_paralelos_tgn($id_idioma, $nivel_idioma){
        return DB::table("siadi_planificar_asignaturas")
            ->join('siadi_convocatorias AS siadi_convocatorias', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'siadi_convocatorias.id_siadi_convocatoria')
            ->join('siadi_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')
            ->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')
            ->join('siadi_nivel_idiomas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')
            ->join('siadi_paralelos', 'siadi_planificar_asignaturas.id_paralelo', '=', 'siadi_paralelos.id_paralelo')
            ->join('siadi_modalidad_curso', 'siadi_convocatorias.id_modalidad_curso', '=', 'siadi_modalidad_curso.id_convocartoria_estudiante')
            ->join('siadi_costos', 'siadi_convocatorias.id_costo', '=', 'siadi_costos.id_costo')
            ->select(
                'siadi_idiomas.nombre_idioma',
                'siadi_idiomas.sigla_codigo_idioma',
                'siadi_nivel_idiomas.nombre_nivel_idioma',
                'siadi_nivel_idiomas.descripcion_nivel_idioma',

                #detalles del paralelo
                'siadi_paralelos.nombre_paralelo',
                'siadi_planificar_asignaturas.id_planificar_asignatura',
                'siadi_planificar_asignaturas.turno_paralelo',
                'siadi_planificar_asignaturas.hora_clases_inicio',
                'siadi_planificar_asignaturas.hora_clases_fin',
                'siadi_planificar_asignaturas.cupo_maximo_paralelo',

                #modalidad
                DB::raw("CASE 
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante=2 THEN 'EXAMEN DE SUFICIENCIA (AUTOFINANCIADO)'
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante IN(3, 6, 7, 8) THEN SUBSTRING_INDEX(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' ', 1)
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 AND siadi_costos.tipo_costo='TGN' THEN 'CURSO REGULAR'
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 THEN CONCAT(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' (', siadi_costos.tipo_costo, ')')
                    ELSE siadi_modalidad_curso.nombre_convocatoria_estudiante
                END AS modalidad"),
            )
            ->where('siadi_convocatorias.estado_convocatoria', 'ACTIVO')
            ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', 'ACTIVO')
            ->whereDate('siadi_convocatorias.fecha_fin', '>=', DB::raw('CURDATE()'))
            ->where('siadi_modalidad_curso.id_convocartoria_estudiante', 1)
            ->where('siadi_costos.tipo_costo', 'TGN')
            ->where('siadi_asignaturas.id_idioma', $id_idioma)
            ->where('siadi_asignaturas.id_nivel_idioma', $nivel_idioma)
            ->get();
    }
}
