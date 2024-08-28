<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Historias_clinico;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class TiposHistorialController extends Controller
{
    public function index()
    {
        return view(
            'modulos-veterinaria.tiposhistorialindex'
        );
    }




    //fragmento de reportes
    public function reporte_estudio_complementario($historia)
    {
        $historial = Historias_clinico::find($historia);
        if (count($historial->fotosestudio)) {
            $showCarousel = true;
            foreach ($historial->fotosestudio as $imagen) {
                if (str_ends_with($imagen->imagen, '.pdf')) {
                    
                    $showCarousel = false;
                    break;
                }
            }

            if ($showCarousel) {
                $pdf = new Fpdf();
               foreach ($historial->fotosestudio as $key => $imagen) {
                $archivo_verificar = $imagen->imagen;
                if (strpos($archivo_verificar, 'estudio_complementario') !== false) {
                    $apostrofe = url('/'). "/storage/estudio_complementario/";
                    $resto = str_replace($apostrofe, '', $archivo_verificar);
                    $url_imagen = public_path( $imagen->imagen);
                    $pdf->AddPage();
                    $ancho_pagina = $pdf->getPageWidth();
                    $alto_pagina = $pdf->getPageHeight();
                    $pdf->Image($url_imagen, 0, 0, $ancho_pagina, $alto_pagina);
                } else {
                    $apostrofe = url('/')."/storage/imagenes_capturadas/";
                    $resto = str_replace($apostrofe, '', $archivo_verificar);
                    $url_imagen = public_path($imagen->imagen);
                    $pdf->AddPage();
                    $ancho_pagina = $pdf->getPageWidth();
                    $alto_pagina = $pdf->getPageHeight();
                    $pdf->Image($url_imagen, 0, 0, $ancho_pagina, $alto_pagina);
                }
             
               }
               $pdf->Output();
            }
        }else{

            $archivo_verificar = $historial->imagen_pdf_estudio_complementario;
            if (strpos($archivo_verificar, 'estudio_complementario') !== false) {
                $apostrofe = url('/'). "/storage/estudio_complementario/";
                $resto = str_replace($apostrofe, '', $archivo_verificar);
                $url_imagen = storage_path('app/public/estudio_complementario/'. $resto);


            } else {
                $apostrofe = url('/')."/storage/imagenes_capturadas/";
                $resto = str_replace($apostrofe, '', $archivo_verificar);
                $url_imagen = storage_path('app/public/imagenes_capturadas/' . $resto);
            }
            $pdf = new Fpdf();

            // Agrega una página al PDF
            $pdf->AddPage();
    
            // Establece la posición y tamaño de la imagen en la página PDF
            $ancho_pagina = $pdf->getPageWidth();
            $alto_pagina = $pdf->getPageHeight();
    
            // Insertar la imagen en la posición (0, 0) con el ancho y alto de la página
            $pdf->Image($url_imagen, 0, 0, $ancho_pagina, $alto_pagina);
            // Guarda el archivo PDF en el almacenamiento
    
            $pdfgenerado = $pdf->Output();
    
        } 
        


     


    }
}
