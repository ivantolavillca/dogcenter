<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class PlantillaReportePDF extends Fpdf
{
    private $area = "CIENCIAS SOCIALES";
    private $carrera = "LINGÜÍSTICA E IDIOMAS";
    private $asignatura = "";
    private $docente = "";
    private $curso = "";
    private $paralelo = "";
    private $sigla_codigo = "";
    private $gestion = "";
    private $nombramiento_docente = "";
    private $fecha = "";
    private $es_examen = false;
    public $Altura = 70;
    public $CeldaAlto = 4.2;


    function __construct($orientation = 'P', $unit = 'mm', $size = array(216, 330)) {
        parent::__construct($orientation, $unit, $size);
        $this->AliasNbPages();

        $this->SetFillColor(50, 255, 50);
        $this->SetFont('Arial', 'B', 12);
        //$this->SetAutoPageBreak(false, 0);
    }

    public function SetDataCabezera($asignatura, $docente, $curso, $paralelo, $sigla_codigo, $gestion, $nombramiento_docente, $fecha, $es_examen){
        $this->asignatura = $asignatura;
        $this->docente = $docente;
        $this->curso = $curso;
        $this->paralelo = $paralelo;
        $this->sigla_codigo = $sigla_codigo;
        $this->gestion = $gestion;
        $this->nombramiento_docente = $nombramiento_docente;
        $this->fecha = $fecha;
        $this->es_examen = $es_examen;
    }

    public function Header(){
        $this->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");
        $this->Image(public_path("cert") . '/logo_upea.png', 15, 8, 25, 25);
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        // $pdf->SetX(30);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('EdwardianScriptITC', '', 38);
        $this->Cell(0, 5, utf8_decode('Universidad Pública de El Alto'), 0, 1, 'C');
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(0, 9, 'Creada por Ley 2115 del 5 de Septiembre de 2000 y ' . utf8_decode('Autónoma') . ' por Ley 2556 del 12 de Noviembre de 2003', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 2, utf8_decode('DEPARTAMENTO DE IDIOMAS'), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('ACTA DE CALIFICACIONES'), 0, 1, 'C');

        $this->SetFont('Arial', 'B', 10);
        $tam = 4;
        $bordeCelda = 0;
        // Area
        $this->SetXY(18, 36);
        $this->Cell(120, $tam, utf8_decode('Área: '. $this->area), $bordeCelda, 0, 'L');
        // Carrera
        $this->SetXY(18, 41);
        $this->Cell(129, $tam, utf8_decode('Carrera: '. $this->carrera), $bordeCelda, 0, 'L');
        // Curso
        $this->SetXY(147, 41);
        $this->Cell(66, $tam, utf8_decode($this->es_examen? $this->curso: 'Curso: ' . $this->curso), $bordeCelda, 0, 'L');
        // Asignatura
        $this->SetXY(18, 46);
        $this->Cell(138, $tam, utf8_decode('Asignatura: ' . $this->asignatura), $bordeCelda, 0, 'L');
        if($this->es_examen){
            // Sigla Codigo
            $this->SetXY(147, 46);
            $this->Cell(84, $tam, utf8_decode('Sigla-Código: ' . $this->sigla_codigo), $bordeCelda, 0, 'L');
            // Gestion
            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(147, 51);
            $this->Cell(93, $tam, utf8_decode('Gestión: ' . $this->gestion), $bordeCelda, 0, 'L');
        } else {
            // Paralelo
            $this->SetXY(147, 46);
            $this->Cell(75, $tam, utf8_decode('Paralelo: ' . $this->paralelo), $bordeCelda, 0, 'L');
            // Sigla Codigo
            $this->SetXY(147, 51);
            $this->Cell(84, $tam, utf8_decode('Sigla-Código: ' . $this->sigla_codigo), $bordeCelda, 0, 'L');
            // Gestion
            $this->SetFont('Arial', 'B', 10);
            $this->SetXY(147, 55);
            $this->Cell(93, $tam, utf8_decode('Gestión: ' . $this->gestion), $bordeCelda, 0, 'L');
        }
        // Docente
        $this->SetXY(18, 51);
        if ($this->docente && $this->docente!=="") {
            //$docente = $this->getDocentePersona($reporte[0]->id_planificar_asignatura, $reporte[0]->id_asignacion_docente, $reporte[0]->direccion);
            $this->Cell(147, $tam, utf8_decode('Docente: '. $this->docente), $bordeCelda, 0, 'L');
        } else {
            $this->Cell(147, $tam, utf8_decode('Docente: ---'), $bordeCelda, 0, 'L');
        }
        
        // Nombramiento
        $this->SetXY(18, 55);
        $this->SetFont('Arial', '', 9);
        if($this->es_examen){
            $this->Cell(147, $tam, utf8_decode('Resolución del Honorable Consejo de Carrera N° ' . $this->nombramiento_docente), $bordeCelda, 0, 'L');
        } else {
            if ($this->nombramiento_docente && $this->nombramiento_docente!=="") {
                //$docente = $this->getDocentePersona($reporte[0]->id_planificar_asignatura, $reporte[0]->id_asignacion_docente, $reporte[0]->direccion);
                $this->Cell(147, $tam, utf8_decode('N° de Nombramiento Docente: ' . $this->nombramiento_docente), $bordeCelda, 0, 'L');
            } else {
                $this->Cell(147, $tam, utf8_decode('N° de Nombramiento Docente: ---'), $bordeCelda, 0, 'L');
            }
        }

        $this->SetFont('Arial', 'B', 6);
        $this->SetXY(190, 55);
        $this->Cell(18, $tam, utf8_decode('Página '). $this->PageNo() .' de {nb}', $bordeCelda, 1, 'R');


        #  HEADER TABLA
        $alturaTabla = 60;
        $tamHead = 5; 
        $bordeCelda = 1;
        
        $this->SetFont('Arial', 'B', 8);
        $this->SetXY(18, $alturaTabla);
        $this->SetFont('Arial', 'B', 7.5);
        $this->Cell(8, $tamHead*2, utf8_decode('N°'), $bordeCelda, 0, 'C');
        $this->SetFont('Arial', 'B', 8.5);
        $this->Cell(80, $tamHead, utf8_decode('NÓMINA'), $bordeCelda, 0, 'C');
        $this->SetFont('Arial', 'B', 6.5);
        $this->MultiCell(18, 3.35, utf8_decode('N° DE CEDULA DE IDENTIDAD'), $bordeCelda, 'C', 0);
        $this->SetXY( 124, $alturaTabla);
        $this->Cell(7, $tamHead*2, utf8_decode('EXP.'), $bordeCelda, 0, 'C');
        $this->Cell(20, $tamHead*2, utf8_decode('CATEGORÍA'), $bordeCelda, 0, 'C');
        $this->MultiCell(8, 3.35, utf8_decode('C.F. s/100 Pts.'), $bordeCelda, 'C', 0); //11 tamHead*2
        $this->SetFont('Arial', 'B', 6);
        $this->SetXY( 159, $alturaTabla);
        $this->Cell(25, $tamHead*2, utf8_decode('CALIFICACION LITERAL'), $bordeCelda, 0, 'C');
        $this->SetFont('Arial', 'B', 6.5);
        $this->Cell(20, $tamHead*2, utf8_decode('RESULTADO'), $bordeCelda, 0, 'C');
		
        $this->SetXY(26, $alturaTabla+$tamHead);
        $this->Cell(25, $tamHead, utf8_decode('APELLIDO PATERNO'), $bordeCelda, 0, 'C');
        $this->Cell(25, $tamHead, utf8_decode('APELLIDO MATERNO'), $bordeCelda, 0, 'C');
        $this->Cell(30, $tamHead, utf8_decode('NOMBRE(S)'), $bordeCelda, 0, 'C');
    }

    public function Footer(){

        $bordeCelda = 0;
        $this->SetXY(18, -92);
        $this->SetFont('Arial', 'B', 6);
        $this->Cell(127, $this->CeldaAlto, utf8_decode('ADVERTENCIA: Este documento queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.'), $bordeCelda, 0, 'L');
        $this->SetXY(18, -92 + $this->CeldaAlto);
        $this->Cell(58, $this->CeldaAlto, utf8_decode('C.F. s/100 pts. = Calificación Final sobre 100 puntos.'), $bordeCelda, 0, 'L');

        $fecha_new = Carbon::parse($this->fecha);
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(113.3, -88);
        // $this->Cell(90, $this->CeldaAlto+2, utf8_decode('Lugar y Fecha: El Alto, '. $fecha->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY')), $bordeCelda, 0, 'L');
        #$this->Cell(90, $this->CeldaAlto+2, utf8_decode('Lugar y Fecha: El Alto, 31 de diciembre de 2023'), $bordeCelda, 0, 'L');
        $this->Cell(90, $this->CeldaAlto+2, utf8_decode('Lugar y Fecha: El Alto, '. $fecha_new->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY')), $bordeCelda, 0, 'L');

        $this->SetXY(19, -8); # -15
        $this->SetFont('Arial', '', 7);
        $this->Cell(120, 4, utf8_decode('NOTA: El llenado de las Actas de Calificaciones debe ser computarizado, sin alterar el formato de las celdas.'), 0, 0, 'C');

        $this->SetFont('Arial', '', 6);
        $this->SetXY(175, -43);
        $this->Cell(35, $this->CeldaAlto, utf8_decode('SELLO CARRERA'), 0, 0, 'C');

        $this->SetDash(0.5, 0.5);
        $this->SetFont('Arial', '', '6');

		$alturaYLinea = 302;
        $this->Line(35, $alturaYLinea, 65, $alturaYLinea);
        $this->SetXY(42, -28);
        $this->Cell(15, $this->CeldaAlto, utf8_decode('DOCENTE'), 0, 0, 'C');

        $this->Line(85, $alturaYLinea, 115, $alturaYLinea);
        $this->SetXY(92, -28);
        $this->Cell(15, $this->CeldaAlto, utf8_decode('ENC. DEPTO. IDIOMAS'), 0, 0, 'C');

        $this->Line(135, $alturaYLinea, 165, $alturaYLinea);
        $this->SetXY(142, -28);
        $this->Cell(15, $this->CeldaAlto, utf8_decode('DIRECTOR(A)'), 0, 0, 'C');
    } 
}
