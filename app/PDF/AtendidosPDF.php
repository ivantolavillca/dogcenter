<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;

class AtendidosPDF extends FPDF
{
    // Variable para almacenar el número de registro
    private $numero_registro;
    private $registro;
    protected $data;
    public function __construct($numero_registro, $registro, $data)
    {
       // parent::__construct(); // Llama al constructor de la clase padre (Fthis)
        parent::__construct('P', 'mm', 'Letter', true, 'UTF-8', false);
        $this->numero_registro = $numero_registro;
        $this->registro = $registro;
        $this->data = $data;
        
    
    }
    // Método para generar el encabezado
    public function Header()
    {
        
        $this->SetTopMargin(15);
        $this->SetLeftMargin(10);
        $this->SetAutoPageBreak(1, 20);
        $this->AliasNbPages();
        // $this->Addpage('P', array(216, 330));
        $this->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");
        $this->Image(public_path("") . '/logo_nuevo.png', 15, 2, 45, 45);
        $this->SetTextColor(0, 80, 0);
        $this->SetFont('EdwardianScriptITC', '', 38);
        $this->Cell(150, 18, utf8_decode('DOG CENTER'), 0, 10, 'R');
    }

    // Método para generar el reporte
    public function generarReporte($registro)
    {
        $this->AddPage();
       
         
            $this->SetFont('Arial', '', 8);
            $this->SetXY(20, 30);
            $this->Cell(45, 25, 'TRABAJADOR:', 0, 0, 'L');
            $this->SetFont('Arial', '', 8);
            $this->SetXY(32, 30);
            if($this->registro->id)
            {
                $this->Cell(60, 25, utf8_decode($this->registro->name), 0, 0, 'R');
            }else
            {
                $this->Cell(60, 25, utf8_decode($this->registro->email), 0, 0, 'R');
            }
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(8, 30, '...............................................................................', 0, 0, 'R');
      
            date_default_timezone_set('America/La_Paz');
            $fechaHoraActual = date('Y-m-d H:i:s');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(140, 30);
        $this->Cell(45, 25, 'FECHA:', 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(124, 30);
        $this->Cell(60, 25, $fechaHoraActual, 0, 0, 'R');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(1, 30, '...................................', 0, 0, 'R');


        $this->SetFont('Arial', '', 8);
        $this->SetXY(20, 30);
        $this->Cell(45, 50, 'CORREO:', 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(42, 30);
        $this->Cell(45, 48, utf8_decode($this->registro->email), 0, 0, 'R');

       
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 50, '...................................................................................................................... ', 0, 0, 'R');

        $this->SetFillColor(0,22,53); // Establecer color de fondo azul petróleo
        $this->SetTextColor(0, 255, 0); // Establecer color de texto verde fosforescente
        $this->SetFont('Arial', '', 10);
        $this->SetXY(75, 60);
        $this->Cell(65, 7, utf8_decode('TRABAJADOR Nº: '.$this->registro->id), 1, 0, 'C', true);
        $this->SetTextColor(0, 0, 0); // Restablecer color de texto a negro



        $pX = 20; // Posición X de inicio de la tabla
        $pY = 75 ; // Posición Y de inicio de la tabla (debajo de la celda anterior)
        
        $anchoCelda1 = 15; // Ancho de la primera celda
        $anchoCelda2 = 40; // Ancho de la segunda celda
        $anchoCelda3 =40 ; // Ancho de la segunda celda


        $altoCelda = 10; // Altura de cada celda
        $numeroFilas = 8; // Número de filas en la tabla
        
        // Loop para generar las filas de la tabla
        $i = 0;
        $posicionYActual = $pY + ($i * $altoCelda);
        $posicionXActual1 = $pX;
        $posicionXActual2 = $pX + $anchoCelda1;
        $posicionXActual3 = $posicionXActual2+$anchoCelda2;
        $posicionXActual4 = $posicionXActual3+$anchoCelda3;
        $posicionXActual5 = $posicionXActual4+$anchoCelda3 ;
        //Dibujar la primera celda
        $this->SetXY($posicionXActual1, $posicionYActual);
        $this->Cell($anchoCelda1, $altoCelda,  utf8_decode("Nº"), 1, 0, 'L');
        // Dibujar la segunda celda
        $this->SetXY($posicionXActual2, $posicionYActual);
        $this->Cell($anchoCelda2, $altoCelda, utf8_decode("Nombre de la mascota"), 1, 0, 'L');
        // Dibujar la tercera celda
        $this->SetXY($posicionXActual3,  $posicionYActual );
        $this->Cell($anchoCelda3,  $altoCelda,utf8_decode("Dueño de la mascota"), 1, 0, 'L');
        $this->SetXY($posicionXActual4,  $posicionYActual );
        $this->Cell($anchoCelda3,  $altoCelda,utf8_decode("Nombre del Doctor"), 1, 0, 'L');
        $this->SetXY($posicionXActual5,  $posicionYActual );
        $this->Cell($anchoCelda3, $altoCelda, utf8_decode("Fecha de Atencion"), 1, 0, 'L');


        $i = 1;

        foreach  ($this->data as $elem) {
            // Establecer la posición Y de la fila actual
            $posicionYActual = $pY + ($i * $altoCelda);
            // Calcular la posición X de la primera celda
            $posicionXActual1 = $pX;
            $posicionXActual2 = $pX + $anchoCelda1;
            $posicionXActual3 = $posicionXActual2+$anchoCelda2;
            $posicionXActual4 = $posicionXActual3+$anchoCelda3;
            $posicionXActual5 = $posicionXActual4+$anchoCelda3 ;
            //Dibujar la primera celda
            $this->SetXY($posicionXActual1, $posicionYActual);
            $this->Cell($anchoCelda1, $altoCelda, $i, 1, 0, 'L');
            // Dibujar la segunda celda
            $this->SetXY($posicionXActual2, $posicionYActual);
            $this->Cell($anchoCelda2, $altoCelda, $elem->ficha_mascota->nombre, 1, 0, 'L');
            // Dibujar la tercera celda
            $this->SetXY($posicionXActual3,  $posicionYActual );
            $this->Cell($anchoCelda3, $altoCelda, $elem->ficha_mascota->mascot_clie->nombre, 1, 0, 'L');
            $this->SetXY($posicionXActual4,  $posicionYActual );
            $this->Cell($anchoCelda3, $altoCelda, $elem->ficha_usuario->name, 1, 0, 'L');
            $this->SetXY($posicionXActual5,  $posicionYActual );
            $this->Cell($anchoCelda3, $altoCelda, $elem->created_at, 1, 0, 'L');

            $i++;
        }
        $i += 1;
        // Establecer la posición Y de la fila adicional
        $posicionYActual = $pY + ($i * $altoCelda);
    
        // Dibujar la segunda celda de la fila adicional
        $this->SetXY($posicionXActual4, $posicionYActual);
        $this->Cell($anchoCelda2, $altoCelda, 'TOTAL DIAS', 1, 0, 'L');
        
        // Dibujar la tercera celda de la fila adicional
        $this->SetXY($posicionXActual5, $posicionYActual);
        $this->Cell($anchoCelda3, $altoCelda, ($i-2)."   Dias", 1, 0, 'L');
        
        // Restaurar el color de texto a negro
        $this->SetTextColor(0, 0, 0);




        $thisgenerado = $this->Output();
        exit;
    }
    public function Footer()
    {
        // Establecer la posición del pie de página a 15 mm del borde inferior
        $this->SetY(-15);
        // Escribir el contenido del pie de página centrado horizontalmente
        $this->Cell(0, 10, utf8_decode(('Pág. ')) . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
}
