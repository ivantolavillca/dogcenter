<?php

namespace App\Http\Livewire\AdministracionEstudiante;

use App\Models\AdministracionModulos\SiadiPersona;
use App\Models\PreRequisito;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RecordEstudentIndex extends Component
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
        //   if (count($reporte) > 0) {(

            
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
    public function render()
    {

        $persona_auth = Auth::user();

        $datos_persona = SiadiPersona::where('id_siadi_persona', $persona_auth->id_persona_siadi)->first();
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

        return view('livewire.administracion-estudiante.record-estudent-index', compact('materiasInscritas', 'persona_auth'));
    }
}
