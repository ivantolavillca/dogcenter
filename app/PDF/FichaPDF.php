<?php
namespace App\PDF;
use Codedge\Fpdf\Fpdf\Fpdf;
class FichaPDF extends FPDF 
{
    // Variable para almacenar el número de registro
    private $numero_registro;
    private $fecha;
    public function __construct($numero_registro,$fecha) {
        parent::__construct(); // Llama al constructor de la clase padre (FPDF)
        $this->numero_registro = $numero_registro;
        $this->fecha = $fecha;
    }
    // Método para generar el encabezado
    public function Header() {
        // Aquí defines el contenido del encabezado del PDF
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10); // Espacio horizontal
        $this->Cell(0, 10, utf8_decode('Ticket Nº: '. $this->numero_registro), 0, 0, 'L'); // Alineado a la izquierda
        $this->Ln(5); // Salto de línea
        $this->Cell(0, 10, 'Fecha: '. $this->fecha, 0, 0, 'L'); // Alineado a la izquierda
        $this->Ln(10); // Salto de línea
    }
    
    // Método para generar el reporte
    public function generarReporte($registro) {
        $this->AddPage();
        // Contenido de la tabla
        $this->SetFont('Arial', '', 10);
        if ($registro) {
            // Acceder a los campos del registro
            $id = $registro->id;
            $nombre = $registro->nombre_cli;
            $numeracion = $registro->numeracion;
            $this->Cell(50, 10, "Consulta General", 1, 1, 'C'); // Primera fila
            $this->Cell(50, 10, "Nombre: " . $nombre, 1, 1, 'C'); // Segunda fila
            $this->SetFont('times', '', 18); // Ejemplo de fuente y tamaño
            $this->Cell(50, 10, utf8_decode("Nº: ".$numeracion), 1, 1, 'C');
            $nombre_archivo = 'reporte_ficha_' . $id . '.pdf';
            $this->Output($nombre_archivo, 'I');
            exit;
        } else {
            $this->Output();
        }
    }
}
