<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;

use Spatie\PdfToImage\Pdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParser;
use Dompdf\Dompdf;
use Dompdf\Options;
use TCPDF;

use Illuminate\Support\Facades\Storage;



class historialespPDF extends FPDF
{
    // Variable para almacenar el número de registro
    private $numero_registro;
    protected $data;
    public function __construct($id_mascota, $data)
    {
        // parent::__construct(); // Llama al constructor de la clase padre (Fthis)
        parent::__construct('P', 'mm', 'Letter', true, 'UTF-8', false);
        $this->numero_registro = $id_mascota;
        $this->data = $data;
    }
    public function generarReporte()
    {
        // Crear instancia de FPDI
        $pdf = new Fpdi();

        // Agregar una página en blanco
        $pdf->AddPage();

        // Descargar el PDF desde la URL
        $url = "https://dogcenter.bo/storage/historialPasados/historialpasado6667872529fe0.pdf";

        $contenido = Storage::get($url);
    dd($contenido);
        $path = parse_url($url, PHP_URL_PATH);
        //$new_path = str_replace('/storage', '/public', $path);

        //$existingPdf1 = storage_path('app' . $new_path);
        // dd( $path );
        $urln =  'public' . $path;
        //dd( $urln );
        //$pdfContent = file_get_contents($urln);
        // $pdfContent = Storage::get($urln);
        // Ruta al archivo PDF en el directorio de almacenamiento
        // Ruta al archivo PDF en el directorio de almacenamiento
        $ruta = 'historialPasados/historialpasado6667872529fe0.pdf';

        // Verificar si el archivo existe
        if (Storage::exists($path)) {
            // Obtener el contenido del archivo PDF desde el directorio de almacenamiento
            $contenido = Storage::get($ruta);

            // Crear una instancia de FPDI
            $pdf = new Fpdi();

            // Agregar una página en blanco
            $pdf->AddPage();

            // Agregar el contenido del PDF al PDF principal
            $pageCount = $pdf->setSourceFile($contenido);
            for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
                $templateId = $pdf->importPage($pageNumber);
                $pdf->addPage();
                $pdf->useTemplate($templateId);
            }

            // Salida del PDF
            $pdf->Output('example.pdf', 'I');
            exit;
        } else {
            // Manejar el caso en el que el archivo no existe
            echo "El archivo no existe en la ubicación especificada.";
        }
    }
}
