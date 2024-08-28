<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Luecano\NumeroALetras\NumeroALetras;

class PlantillaCertirficadosNotasProvisionalPDF extends Fpdf
{
    public $Altura = 70;
    public $CeldaAlto = 4.2;
    public $fecha = "";

    private $MargenIzq = 41.9;
    private $bordeDev = 0;

    // ancho info estudiate
    private $anchoInfo = 20;
    private $MargenInfoTwoY = 123;
    private $MargenInfoTwoX = 85;

    private $alturaYTable = 143;
    public $tablaWidth = 5;


    function __construct() { # $orientation = 'P', $unit = 'mm', $size = array(216, 330)
        parent::__construct('P', 'mm', 'Letter'); # carta
        $this->AliasNbPages();

        $this->SetFillColor(50, 255, 50);
        $this->SetFont('Arial', 'B', 12);
        //$this->SetAutoPageBreak(false, 0);
    }

    public function Header(){
        #$this->Image(public_path("cert") . '/IMG_20231128_005933.jpg', 0, 0, 215.9, 279.4, 'JPG');

        $this->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");
        $this->Image(public_path("cert") . '/logo_transparente.png', 10, -10, 20, 300);
        // $this->Image(public_path("cert") . '/depto_semi_transparente.png', 60, 87, 120, 140);
        $this->SetTextColor(0, 0, 0); //Color del texto: Negro
        
        $this->SetXY(40.2, 20.4);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('EdwardianScriptITC', '', 38);
        $this->Cell(148, 5, utf8_decode('Universidad Pública de El Alto'), $this->bordeDev, 1, 'C');

        $this->SetXY($this->MargenIzq, 28);
        $this->SetFont('Arial', '', 6);
        $this->Cell(144.5, 2.4, 'Creada por Ley 2115 del 5 de Septiembre de 2000 y ' . utf8_decode('Autónoma') . ' por Ley 2556 del 12 de Noviembre de 2003', $this->bordeDev, 1, 'C');
        $this->SetX($this->MargenIzq);
        $this->Cell(144.5, 2.4, utf8_decode('Dentro del Sistema de la Universidad Boliviana'), $this->bordeDev, 1, 'C');
        $this->SetX($this->MargenIzq);
        $this->Cell(144.5, 3, utf8_decode('XI - CONGRESO NACIONAL DE UNIVERSIDADES RESOLUCION Nro 2/09'), $this->bordeDev, 1, 'C');

        $this->SetxY(22.2, 42);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 7, utf8_decode('ÁREA CIENCIAS SOCIALES'), $this->bordeDev, 1, 'C');
        $this->SetxY(22.2, 50);
        $this->Cell(0, 7, utf8_decode('CARRERA DE LINGÜÍSTICA E IDIOMAS'), $this->bordeDev, 1, 'C');
        $this->SetxY(22.2, 57.4);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 8, utf8_decode('DEPARTAMENTO DE IDIOMAS'), $this->bordeDev, 1, 'C');

        $this->SetXY(48, 75);
        $this->SetFont('Arial', 'B', 25);
        $this->Cell(132.2, 9, utf8_decode('CERTIFICADO DE NOTAS'), $this->bordeDev, 1, 'C');

        $this->SetXY(48, 83.2);
        $this->SetFont('Arial', '', 11.15);
        $this->Cell(132.2, 8, utf8_decode('(PROVISIONAL)'), $this->bordeDev, 1, 'C');


        $x1 = 170;
        $y1 = 70;
        $xyWidh = 32;
        $this->Line($x1, $y1, $x1+$xyWidh, $y1);
        $this->Line($x1, $y1+$xyWidh, $x1+$xyWidh, $y1+$xyWidh);
        $this->Line($x1, $y1, $x1, $y1+$xyWidh);
        $this->Line($x1+$xyWidh, $y1, $x1+$xyWidh, $y1+$xyWidh);

        $borde = 1;
        $this->SetFont('Arial', '', 11);
        $this->SetXY($this->MargenIzq, 104.3);
        $this->MultiCell(156, 6, utf8_decode('En conformidad con lo dispuesto en el Reglamento del Departamento de Idiomas de la carrera de Lingüística e Idiomas de la Universidad Pública de El Alto y en cumplimiento de la normativa vigente, se otorga el presente:'), $this->bordeDev, 'J', 0);

        $this->SetFont('Arial', '', 11);
        $this->SetXY($this->MargenIzq, $this->MargenInfoTwoY+2);
        $this->Cell(6, 5, utf8_decode('A:'), $this->bordeDev, 1, 'L');

        # tabla cabezera
        $this->SetFont('Arial', 'B', 11);
        $this->SetXY($this->MargenIzq, $this->alturaYTable+4);
        $this->Cell(15, 5, utf8_decode('NIVEL'), 1, 0, 'C');
        $this->Cell(15, 5, utf8_decode('NOTA'), 1, 0, 'C');
        $this->Cell(70, 5, utf8_decode('LITERAL'), 1, 0, 'C');
        $this->Cell(60, 5, utf8_decode('OBSERVACIÓN'), 1, 0, 'C');
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function SetModalidadCurso($curso){
        $this->SetXY(60.2, 88);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(108, 10, utf8_decode($curso), $this->bordeDev, 1, 'C');
    }

    public function SetCodigo($codigo){
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(165.4, 64.5);
        $this->Cell(40, 5, utf8_decode("N° ". $codigo), $this->bordeDev, 0, 'C');
    }

    public function SetNombresCompleto($nombre_completo){
        $this->SetFont('Arial', 'BI', 13);
        $anchoTexto = $this->GetStringWidth(utf8_decode($nombre_completo));
        $posX = ($this->GetPageWidth() - $anchoTexto) / 2;
        $this->SetXY($posX, $this->MargenInfoTwoY+2);
        $this->Cell(70, 5, utf8_decode($nombre_completo), $this->bordeDev, 0, 'L');
    }


    public function SetCIExtGestion($ci, $periodo){
        $this->SetFont('Arial', '', 11);

        $this->SetXY($this->MargenIzq, $this->MargenInfoTwoY + 8);
        $this->SetFont('Arial', '', 11); 
        $this->Cell(35, 5, utf8_decode('C.I.:'), $this->bordeDev, 0, 'L');
        $this->SetFont('Arial', 'B', 11);
        $this->SetX($this->GetX() - 25); 
        $this->Cell(35, 5, utf8_decode($ci), $this->bordeDev, 0, 'L');

        $margenDerecho = 10; 
        $this->SetX($this->GetPageWidth() - $margenDerecho - 50);
        $this->SetFont('Arial', '', 11); 
        $this->Cell(50, 5, utf8_decode('Gestión:'), $this->bordeDev, 0, 'L');
        $this->SetFont('Arial', 'B', 11); 
        $this->SetX($this->GetX() - 33);
        $this->Cell(40, 5, utf8_decode($periodo), $this->bordeDev, 1, 'L');
    }




    public function SetMateriaNivel($materia){
        $this->SetFont('Arial', 'B', 16);
        $this->SetXY($this->MargenIzq, $this->MargenInfoTwoY + 15);
        $this->Cell(140, 6, utf8_decode($materia), $this->bordeDev, 1, 'C');
    }

    public function setNivelNota($nivel = null, $nota = null){
        $formatter = new NumeroALetras();
        $this->SetFont('Arial', '', 11);
        $this->SetXY($this->MargenIzq, $this->alturaYTable + 9);
        $this->Cell(15, 5, utf8_decode($nivel), 1, 0, 'C');
        if(!is_null($nota) && ctype_digit($nota) && $nota>=0 && $nota<=100){
            $this->Cell(15, 5, utf8_decode($nota), 1, 0, 'C');
            $this->Cell(70, 5, utf8_decode($formatter->toString($nota)), 1, 0, 'C');
            $observacion = "NO SE PRESENTÓ";
            if($nota>=51){
                $observacion = "APROBADO";
            } else if($nota>0){
                $observacion = "REPROBADO";
            }
            $this->Cell(60, 5, utf8_decode($observacion), 1, 0, 'C');
        } else {
            $this->Cell(15, 5, utf8_decode('--'), 1, 0, 'C');
            $this->Cell(70, 5, utf8_decode('--'), 1, 0, 'C');
            $this->Cell(60, 5, utf8_decode('----'), 1, 0, 'C');
        } 
    }

    public function Footer(){
        $this->SetFont('Arial', '', 11);
        $this->SetXY($this->MargenIzq + 80, $this->alturaYTable + 16);
        $this->fecha = Carbon::parse($this->fecha);
        $this->Cell(80, 5, utf8_decode('El Alto, '. $this->fecha->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY') ), $this->bordeDev, 0, 'R');

        $this->SetFont('Arial', '', 11);
        $this->SetXY($this->MargenIzq, $this->alturaYTable + 22);
        $this->MultiCell(160, 5.5, utf8_decode('Certificamos la autenticidad de la información en este documento, conforme a las normativas vigentes. El presente certificado tiene una validez de 30 días calendario.'), $this->bordeDev, 'J', 0);

        // Sección de firmas
        $this->SetFont('Arial', 'I', 9); 
        $this->SetXY($this->MargenIzq-10, $this->alturaYTable + 70); 
        $this->Cell(60, 5, utf8_decode('..................................'), 0, 0, 'C'); // Firma 1
        $this->SetXY($this->MargenIzq + 70, $this->alturaYTable + 70); 
        $this->Cell(60, 5, utf8_decode('..................................'), 0, 1, 'C'); // Firma 2

        // Descripción de cargos
        $this->SetFont('Arial', 'I', 7);
        $this->SetXY($this->MargenIzq-10, $this->alturaYTable + 73);
        $this->Cell(60, 5, utf8_decode('Encargad@ Depto. Idiomas'), 0, 0, 'C'); // Descripción para Firma 1
        $this->SetXY($this->MargenIzq + 70, $this->alturaYTable + 73);
        $this->Cell(60, 5, utf8_decode('Técnico Académico Kardex'), 0, 1, 'C'); // Descripción para Firma 2

        $this->SetFont('Arial', 'BI', 8);
        $this->SetXY(40, -19);
        $this->Cell(164, 4, utf8_decode('"CON IDEAS CLARAS CONSTRUIMOS UNA NUEVA UNIVERSIDAD"'), $this->bordeDev, 0, 'C');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(40, -14);
        $this->Cell(164, 4, utf8_decode('"Aski amuyumpiw machaq jach´a yatiqan uta irptastan"'), $this->bordeDev, 0, 'C');
    }

 
}