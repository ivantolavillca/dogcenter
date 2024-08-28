<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class PlantillaCertificadoPDF extends Fpdf
{
    protected $posicionesContenido = [
        "codigo" => ["x"=> 0, "y"=> 0, "ancho"=> 34.5],
        "ci" => ["x"=> 10, "y"=> 10, "ancho"=> 38], 
    ];
    private $hpvy = 0; # Desplazamiento extra en vertical
    private $hphx = 0; # Desplazamiento extra en horizontal

    private $fill = false;

    function __construct($orientation = 'P', $unit = 'mm', $size = 'Letter') {
        parent::__construct($orientation, $unit, $size);

        $this->SetFillColor(50, 255, 50);
        $this->SetFont('Arial', 'B', 12);
        $this->SetAutoPageBreak(false, 0);
    }

    /* public function Header()
    {
        // Configura el encabezado de tu plantilla aquí
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Mi Encabezado', 0, 1, 'C');
    } */

    public function Footer()
    {
        // Configura el pie de página de tu plantilla aquí
        $this->SetY(-1); # -15
        #$this->SetFont('Arial', 'I', 8);
        #$this->Cell(0, 0, 'Página ' . $this->PageNo(), 0, 0, 'C');
    } 

    # si no se define $formato, solo se restablece la fuente
    public function iniciarPosiciones($formato = null){
        if($formato=='formato1' || $formato=='formato3' || $formato=='formato4'){
            $this->posicionesContenido = [
                "codigo" => ["x"=> 169, "y"=> 55.5, "ancho"=> 35.5],
                "ci" => ["x"=> 166.5, "y"=> 96, "ancho"=> 38], 
                "nombres" => ["x"=> 37.5, "y"=> 115, "ancho"=> 168.5],
                "idioma" => ["x"=> 37.5, "y"=> 135, "ancho"=> 168.5],
                "modalidad" => ["x"=> 78, "y"=> 146.5, "ancho"=> 128],
                "gestion" => ["x"=> 97, "y"=> 155.5, "ancho"=> 109],
                "carga_horaria" => ["x"=> 111.5, "y"=> 164.5, "ancho"=> 94.5],
                "qr" => ["x"=> ($formato=='formato4'?32 :177), "y"=> ($formato=='formato4'?246 :33), "ancho"=> 20], # "x"=> 177.5 # 52

                "fecha_dia" => ["x"=> 117.5, "y"=> ($formato=='formato3'? 204.5: 198), "ancho"=> 10.5],
                "fecha_mes" => ["x"=> 134, "y"=> 25, "ancho"=> 40.5],
                "fecha_anio" => ["x"=> 185.5, "y"=> 25, "ancho"=> 14],
            ];
            $this->hpvy = -2.5; 
            $this->hphx = .5; 
        } else if ($formato=='formato2') {
            $this->posicionesContenido = [
                "codigo" => ["x"=> 171, "y"=> 53, "ancho"=> 36],
                "ci" => ["x"=> 172, "y"=> 96, "ancho"=> 35], 
                "nombres" => ["x"=> 40, "y"=> 118, "ancho"=> 162],
                "idioma" => ["x"=> 40, "y"=> 140, "ancho"=> 162],
                "modalidad" => ["x"=> 79, "y"=> 153.5, "ancho"=> 124],
                "gestion" => ["x"=> 98.5, "y"=> 164.2, "ancho"=> 104.5],
                "qr" => ["x"=> 52, "y"=> 246, "ancho"=> 20],

                "fecha_dia" => ["x"=> 119.5, "y"=> 195, "ancho"=> 14],
                "fecha_mes" => ["x"=> 139.5, "y"=> 25, "ancho"=> 40],
                "fecha_anio" => ["x"=> 191, "y"=> 25, "ancho"=> 13],
            ];
            $this->hpvy = -1;
            $this->hphx = -2;
        } else {
            $this->posicionesContenido = [
                "codigo" => ["x"=> 10, "y"=> 10, "ancho"=> 34.5],
                "ci" => ["x"=> 15, "y"=> 25, "ancho"=> 38], 
                "nombres" => ["x"=> 20, "y"=> 40, "ancho"=> 162],
                "idioma" => ["x"=> 35, "y"=> 55, "ancho"=> 162],
                "modalidad" => ["x"=> 40, "y"=> 70, "ancho"=> 124],
                "gestion" => ["x"=> 45, "y"=> 85, "ancho"=> 104],
                "carga_horaria" => ["x"=> 50, "y"=> 167.5, "ancho"=> 89],
                "qr" => ["x"=> 55, "y"=> 100, "ancho"=> 20], # "x"=> 177.5

                "fecha_dia" => ["x"=> 60, "y"=> 130, "ancho"=> 10.5],
                "fecha_mes" => ["x"=> 65, "y"=> 25, "ancho"=> 40.5],
                "fecha_anio" => ["x"=> 70, "y"=> 25, "ancho"=> 13],
            ];
            $this->hpvy = 0; 
            $this->hphx = 0; 
        }
    }



    public function setCodigo($codigo){
        $this->SetFont('', 'B', 12);
        $this->SetXY(
            $this->posicionesContenido["codigo"]["x"] + $this->hphx, 
            $this->posicionesContenido["codigo"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["codigo"]["ancho"], 5, utf8_decode('N° '.$codigo), 0, 1, 'L', $this->fill);
    }

    public function setCI($ci){
        $this->SetXY(
            $this->posicionesContenido["ci"]["x"] + $this->hphx, 
            $this->posicionesContenido["ci"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["ci"]["ancho"], 5, utf8_decode($ci), 0, 1, 'C', $this->fill);
    }

    public function setNombres($nombres){
        $this->SetFont('', 'B', 22);
        $this->SetXY(
            $this->posicionesContenido["nombres"]["x"] + $this->hphx, 
            $this->posicionesContenido["nombres"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["nombres"]["ancho"], 8, utf8_decode($nombres), 0, 1, 'C', $this->fill);
    }

    public function setIdioma($idioma){
        $this->SetFont('', 'B', 25);
        $this->SetXY(
            $this->posicionesContenido["idioma"]["x"] + $this->hphx, 
            $this->posicionesContenido["idioma"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["idioma"]["ancho"], 9, utf8_decode($idioma), 0, 1, 'C', $this->fill);
    }

    public function setModalidad($modalidad){
        $this->SetFont('', 'B', 14);
        $this->SetXY(
            $this->posicionesContenido["modalidad"]["x"] + $this->hphx, 
            $this->posicionesContenido["modalidad"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["modalidad"]["ancho"], 5, utf8_decode($modalidad), 0, 1, 'C', $this->fill);
    }

    public function setGestion($gestion){
        $this->SetFont('', 'B', 12);
        $this->SetXY(
            $this->posicionesContenido["gestion"]["x"] + $this->hphx, 
            $this->posicionesContenido["gestion"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["gestion"]["ancho"], 5, utf8_decode($gestion), 0, 1, 'C', $this->fill);
    }

    public function setCargaHoraria($carga_horaria){
        $this->SetXY(
            $this->posicionesContenido["carga_horaria"]["x"] + $this->hphx, 
            $this->posicionesContenido["carga_horaria"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["carga_horaria"]["ancho"], 5, utf8_decode($carga_horaria), 0, 1, 'C', $this->fill);
    }

    public function setQR($datos_qr){
        $this->Image("data:image/png;base64, ".base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->color(0, 0, 0)->generate($datos_qr)),
        $this->posicionesContenido["qr"]["x"] + $this->hphx, $this->posicionesContenido["qr"]["y"] + $this->hpvy, 
        $this->posicionesContenido["qr"]["ancho"], $this->posicionesContenido["qr"]["ancho"], "PNG");
    }

    public function setFecha($fecha_in){
        $fecha = Carbon::parse($fecha_in);
        $this->SetXY($this->posicionesContenido["fecha_dia"]["x"] + $this->hphx, $this->posicionesContenido["fecha_dia"]["y"] + $this->hpvy);
        $this->Cell($this->posicionesContenido["fecha_dia"]["ancho"], 5, $fecha->isoFormat('DD'), 0, 0, 'C', $this->fill); # dia
        $this->SetX($this->posicionesContenido["fecha_mes"]["x"] + $this->hphx);
        $this->Cell($this->posicionesContenido["fecha_mes"]["ancho"], 5, utf8_decode(strtoupper($fecha->locale('es')->isoFormat('MMMM'))), 0, 0, 'C', $this->fill); # mes
        $this->SetX($this->posicionesContenido["fecha_anio"]["x"] + $this->hphx);
        $this->Cell($this->posicionesContenido["fecha_anio"]["ancho"], 5, $fecha->isoFormat('YY'), 0, 1, 'L', $this->fill); # anio
    }
}