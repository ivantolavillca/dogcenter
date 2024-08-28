<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class PlantillaPreInscripcionPDF extends Fpdf
{

    function __construct($orientation = 'P', $unit = 'mm', $size = 'letter') {
        parent::__construct($orientation, $unit, $size);
        $this->AliasNbPages();

        $this->SetFillColor(50, 255, 50);
        //$this->SetAutoPageBreak(false, 0);
    }

    /* public function SetDataCabezera($asignatura, $docente, $curso, $paralelo, $sigla_codigo, $gestion, $nombramiento_docente){
        $this->asignatura = $asignatura;
        $this->docente = $docente;
        $this->curso = $curso;
        $this->paralelo = $paralelo;
        $this->sigla_codigo = $sigla_codigo;
        $this->gestion = $gestion;
        $this->nombramiento_docente = $nombramiento_docente;
    } */

    public function Header(){
        $this->AddFont('EdwardianScriptITC', 'I', 'EdwardianScriptITC.php');
        $this->AddFont('Erinal', 'I', 'Erinal.php');
        $this->AddFont('Episode', 'I', 'Episode.php');
        $this->AddFont('Splash', 'I', 'Splash.php');
        $this->AddFont('helvetica', 'I', 'helvetica.php');

        $this->SetFillColor(243, 136, 68, 0.34); //cada fila
        $this->Ln(7);
        $this->Cell(185, 5.5, '', 0, 0);
        $this->SetDrawColor(105, 105, 105);

        $this->Image(public_path("cert") . '/logo_upea.png', 21, 7, 25, 25);

        $this->SetTextColor(0, 0, 0); //Color del texto: Negro

        $this->SetFont('Arial', 'I', 6);
        $altoTitulo = 3;
        $setearX = 44;
        $this->SetY(16);
        $this->SetX($setearX);
        $this->Cell(60, $altoTitulo, utf8_decode('UNIVERSIDAD PÚBLICA DE EL ALTO'), 0, 1, 'L');
        $this->SetX($setearX);
        $this->Cell(60, $altoTitulo, utf8_decode('ÁREA: CIENCIAS SOCIALES'), 0, 1, 'L');
        $this->SetX($setearX);
        $this->Cell(60, $altoTitulo, utf8_decode('CARRERA: LINGÜISTICA E IDIOMAS'), 0, 1, 'L');

        $this->SetFont('Arial', 'B', 11);
        $this->SetY(17);
        $this->SetX($setearX);
        // $this->Rect(22, 39.5, 20, 20, '');		
        $this->Cell(60, 22, utf8_decode('FORMULARIO DE PRE - INSCRIPCIÓN  - ' . date('Y')), 0, 1, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetY(12);
        $this->SetX(122);
        $this->Cell(0, 22, utf8_decode('DEPARTAMENTO DE IDIOMAS'), 0, 1, 'C');
        $this->SetTextColor(16, 192, 156, 0.95);
        $this->SetY(17);
        $this->SetX(123);
        $this->Cell(0, 1, '___________________________', 0, 1, 'C');
    }

    /*
    public function Footer(){

        $bordeCelda = 0;
        $this->SetXY(18, -92);
        $this->SetFont('Arial', 'B', 6);
        $this->Cell(127, $this->CeldaAlto, utf8_decode('ADVERTENCIA: Este documento queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.'), $bordeCelda, 0, 'L');
        $this->SetXY(18, -92 + $this->CeldaAlto);
        $this->Cell(58, $this->CeldaAlto, utf8_decode('C.F. s/100 pts. = Calificación Final sobre 100 puntos.'), $bordeCelda, 0, 'L');

        $fecha = Carbon::now();
        $this->SetFont('Arial', 'B', 10);
        $this->SetXY(113.3, -88);
        $this->Cell(90, $this->CeldaAlto+2, utf8_decode('Lugar y Fecha: El Alto, '. $fecha->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY')), $bordeCelda, 0, 'L');

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
    }  */
}