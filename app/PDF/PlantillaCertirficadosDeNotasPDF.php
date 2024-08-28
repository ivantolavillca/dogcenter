<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Luecano\NumeroALetras\NumeroALetras;

class PlantillaCertirficadosDeNotasPDF extends Fpdf
{
    private $area = "CIENCIAS SOCIALES";
    private $carrera = "LINGÜÍSTICA E IDIOMAS";
    public $Altura = 70;
    public $CeldaAlto = 4.2;
    private $fecha = "";

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

    public function SetDataCabezera($asignatura, $docente, $curso, $paralelo, $sigla_codigo, $gestion, $nombramiento_docente){
        $this->asignatura = $asignatura;
        $this->docente = $docente;
        $this->curso = $curso;
        $this->paralelo = $paralelo;
        $this->sigla_codigo = $sigla_codigo;
        $this->gestion = $gestion;
        $this->nombramiento_docente = $nombramiento_docente;
    }

    public function Header(){
        //$this->Image(public_path("cert") . '/IMG_20231029_101618.jpg', 0, 0, 215.9, 279.4, 'JPG');

        $this->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");
        // $this->Image(public_path("cert") . '/logo_transparente.png', 14, 13.5, 26, 61);
        $this->Image(public_path("cert") . '/logo_transparente_tgn.png', 10, -10, 20, 300);
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
        $this->Cell(0, 7, utf8_decode('ÁREA CIENCIAS SOCIALES'), 0, 1, 'C');
        $this->SetxY(22.2, 50);
        $this->Cell(0, 7, utf8_decode('CARRERA DE LINGÜÍSTICA E IDIOMAS'), 0, 1, 'C');
        $this->SetxY(22.2, 57.4);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 8, utf8_decode('DEPARTAMENTO DE IDIOMAS'), 0, 1, 'C');

        $this->SetXY(48, 75);
        $this->SetFont('Arial', 'B', 25);
        $this->Cell(132.2, 9, utf8_decode('CERTIFICADO DE NOTAS'), 0, 1, 'C');


        $x1 = 170;
        $y1 = 70;
        $xyWidh = 32;
        $this->Line($x1, $y1, $x1+$xyWidh, $y1);
        $this->Line($x1, $y1+$xyWidh, $x1+$xyWidh, $y1+$xyWidh);
        $this->Line($x1, $y1, $x1, $y1+$xyWidh);
        $this->Line($x1+$xyWidh, $y1, $x1+$xyWidh, $y1+$xyWidh);

        $borde = 1;
        $this->SetFont('Arial', '', 11.5);
        $this->SetXY($this->MargenIzq, 104.3);
        $this->MultiCell(160, 6, utf8_decode('El Departamento de idiomas dependiente de la Carrera de Lingüística e Idiomas de la Universidad Pública de El Alto.'), $this->bordeDev, 'L', 0);
        $this->SetXY($this->MargenIzq, 116.4);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(160, 5, utf8_decode('Certifica que el(la) Universitario:'), $this->bordeDev, 0, 'L');

        $this->SetFont('Arial', 'B', 11);
        $this->SetXY($this->MargenIzq, $this->MargenInfoTwoY);
        $this->Cell($this->anchoInfo, 5, utf8_decode('Nombres'), $this->bordeDev, 1, 'L');
        $this->SetX($this->MargenIzq);
        $this->Cell($this->anchoInfo, 5, utf8_decode('Paterno'), $this->bordeDev, 1, 'L');
        $this->SetX($this->MargenIzq);
        $this->Cell($this->anchoInfo, 5, utf8_decode('Materno'), $this->bordeDev, 1, 'L');

        $this->SetXY($this->MargenIzq + $this->MargenInfoTwoX, $this->MargenInfoTwoY);
        $this->Cell($this->anchoInfo, 5, utf8_decode('C.I.'), $this->bordeDev, 1, 'L');
        $this->SetX($this->MargenIzq + $this->MargenInfoTwoX);
        $this->Cell($this->anchoInfo, 5, utf8_decode('Reg. Univ.'), $this->bordeDev, 1, 'L');
        $this->SetX($this->MargenIzq + $this->MargenInfoTwoX);  
        $this->Cell($this->anchoInfo, 5, utf8_decode('Carrera'), $this->bordeDev, 1, 'L');

        $this->SetFont('Arial', 'B', 8.5);
        $this->SetXY($this->MargenIzq , 138.5);
        $this->Cell(80, 4, utf8_decode('Obtuvo las siguientes calificaciones:'), $this->bordeDev, 1, 'L');
        

        # tabla cabezera
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY($this->MargenIzq, $this->alturaYTable);
        $this->Cell(15, 5, utf8_decode('CÓDIGO'), 1, 0, 'C');
        $this->Cell(20, 5, utf8_decode('IDIOMA'), 1, 0, 'C');
        $this->Cell(14, 5, utf8_decode('NIVEL'), 1, 0, 'C');
        $this->Cell(14, 5, utf8_decode('NOTA'), 1, 0, 'C');
        $this->Cell(39, 5, utf8_decode('LITERAL'), 1, 0, 'C');
        $this->Cell(22, 5, utf8_decode('RESULTADO'), 1, 0, 'C');
        $this->Cell(17, 5, utf8_decode('GESTIÓN'), 1, 0, 'C');
        $this->Cell(20, 5, utf8_decode('C. HORARIA'), 1, 0, 'C');
    }

    public function SetModalidadCurso($curso){
        $this->SetXY(60.2, 83);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(108, 15, utf8_decode($curso), $this->bordeDev, 1, 'C');
    }

    public function SetNombres($nombre){
        $this->settingData($this->MargenIzq + $this->anchoInfo, $this->MargenInfoTwoY);
        $this->Cell(60, 5, ': '. utf8_decode($nombre), $this->bordeDev, 0, 'L');
    }

    public function SetPaterno($paterno){
        $this->settingData($this->MargenIzq + $this->anchoInfo, $this->MargenInfoTwoY + 5);
        $this->Cell(60, 5, ': '. utf8_decode($paterno), $this->bordeDev, 0, 'L');
    }

    public function SetMaterno($materno){
        $this->settingData($this->MargenIzq + 20, $this->MargenInfoTwoY + 10);
        $this->Cell(60, 5, ': '. utf8_decode($materno), $this->bordeDev, 0, 'L');
    }

    public function SetCI($ci){
        $this->settingData($this->MargenIzq + $this->anchoInfo + $this->MargenInfoTwoX, $this->MargenInfoTwoY);
        $this->Cell(55, 5, ': '. utf8_decode($ci), $this->bordeDev, 0, 'L');
    }

    public function SetRegUniv($reg_univ){
        $this->settingData($this->MargenIzq + $this->anchoInfo + $this->MargenInfoTwoX, $this->MargenInfoTwoY + 5);
        $this->Cell(55, 5, ': '. utf8_decode($reg_univ), $this->bordeDev, 0, 'L');
    }

    public function SetCarrera($carrera){
        $this->settingData($this->MargenIzq + $this->anchoInfo + $this->MargenInfoTwoX, $this->MargenInfoTwoY + 10);
        $this->Cell(55, 5, ': '. utf8_decode($carrera), $this->bordeDev, 0, 'L');
    }

    private function settingData($x, $y){
        $this->SetXY($x, $y);
        $this->SetFont('Arial', '', 11);
    }

    public function SetCodigo($codigo){
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(165.4, 64.5);
        $this->Cell(40, 5, utf8_decode("N° ".$codigo), $this->bordeDev, 0, 'C');
    }

    public function SetFecha($fecha){
        $tmp = is_null($fecha) || $fecha==''? Carbon::now(): Carbon::parse($fecha);
        $this->fecha = $tmp->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY');
    }

    public function SetData($dataArray){
        $contador = 5;
        $formatter = new NumeroALetras();
        foreach($dataArray as $data_in){
            $this->SetFont('Arial', '', 8);
            $this->SetXY($this->MargenIzq, $this->alturaYTable + $contador);
            $this->Cell(15, 5, utf8_decode($data_in->sigla_asignatura), 1, 0, 'C');
            if(strlen($data_in->nombre_idioma)>=11){
                $letra = strlen($data_in->nombre_idioma) - 10;
                $tamanio = 7 - ($letra / 4); # 6
                $this->SetFont('Arial', '', $tamanio);
            }
            $this->Cell(20, 5, utf8_decode($data_in->nombre_idioma), 1, 0, 'C');
            $this->SetFont('Arial', '', 8);
            $this->Cell(14, 5, utf8_decode($data_in->nombre_nivel_idioma), 1, 0, 'C');
            $this->Cell(14, 5, utf8_decode($data_in->final_nota), 1, 0, 'C');
            $this->Cell(39, 5, utf8_decode( $formatter->toString($data_in->final_nota) ), 1, 0, 'C');
            if(strlen($data_in->resultado)>=11){
                $letra = strlen($data_in->resultado) - 10;
                $tamanio = 7 - ($letra / 5.7); # 6
                $this->SetFont('Arial', '', $tamanio);
            }
            $this->Cell(22, 5, utf8_decode($data_in->resultado), 1, 0, 'C');

            $this->SetFont('Arial', '', 8);
            $this->Cell(17, 5, utf8_decode($data_in->gestion), 1, 0, 'C');
            $this->Cell(20, 5, utf8_decode($data_in->carga_horaria_planificar_asignartura), 1, 0, 'C');
            $contador+= 5;
        }
        

        /* $this->SetXY($this->MargenIzq, $this->alturaYTable + 10);
        $this->Cell(15, 5, utf8_decode($dataArray[0]), 1, 0, 'C');
        $this->Cell(20, 5, utf8_decode($dataArray[1]), 1, 0, 'C');
        $this->Cell(14, 5, utf8_decode('NIVEL'), 1, 0, 'C');
        $this->Cell(14, 5, utf8_decode('NOTA'), 1, 0, 'C');
        $this->Cell(39, 5, utf8_decode('LITERAL'), 1, 0, 'C');
        $this->Cell(22, 5, utf8_decode('RESULTADO'), 1, 0, 'C');
        $this->Cell(17, 5, utf8_decode('GESTIÓN'), 1, 0, 'C');
        $this->Cell(20, 5, utf8_decode('160'), 1, 0, 'C'); */

        // FIN
        $this->SetFont('Arial', '', 10);
        $this->SetXY(142, $this->alturaYTable + $contador + 2.1);
        $this->Cell(60, 5, utf8_decode('El Alto, '. $this->fecha ), $this->bordeDev, 0, 'R');

        $this->SetFont('Arial', 'B', 10);

        // Párrafo principal
        $this->SetXY($this->MargenIzq, $this->alturaYTable + $contador + 7.1 );
        $this->MultiCell(160, 5, utf8_decode('Nota: El presente documento no es válido como requisito para la convocatoria al ejercicio de Docencia en la Universidad Pública de El Alto.'), $this->bordeDev, 'L');

        $this->SetFont('Arial', '', 10);
        // Separador de la frase alineado a la derecha
        $this->SetXY($this->MargenIzq, $this->GetY() + 3);
        $this->Cell(160, 5, utf8_decode('Documento válido por 30 días a partir de la fecha.'), 0, 1, 'L');

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
    }

    public function Footer(){
        $bordeCelda = 0;
        $this->SetFont('Arial', '', 8);

        $this->SetXY(40, -19);
        $this->Cell(164, 4, utf8_decode('"CON IDEAS CLARAS CONSTRUIMOS UNA NUEVA UNIVERSIDAD"'), $bordeCelda, 0, 'C');
        $this->SetXY(40, -14);
        $this->Cell(164, 4, utf8_decode('"Aski amuyumpiw machaq jach´a yatiqan uta irptastan"'), $bordeCelda, 0, 'C');
    } 
}
