<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\PDF\FichaPDF;
use App\PDF\VentaPDF;
use App\Models\Modulos\Fichas;
class FichaPDFController extends Controller
{
  
    protected $pdf;
    public function generarPDF($id)
    {
        // Obtener el registro de la ficha desde la base de datos utilizando el ID
        $registro = Fichas::find($id);
        // Verificar si se encontró el registro
        if (!$registro) {
            // Manejar el caso en el que no se encuentra el registro
            abort(404, 'Registro no encontrado');
        }
        // Crear una nueva instancia de FichaPDF
        $this->pdf = new FichaPDF($id,$registro->created_at);
        $this->pdf->AliasNbPages();
        // Generar el reporte con los datos del registro de la ficha
        $this->pdf->generarReporte($registro);
      
    }
    public function generarPDFVentas($id)
    {
  
        // Obtener el registro de la ficha desde la base de datos utilizando el ID
        $registro = Fichas::find($id);
        // Verificar si se encontró el registro
        if (!$registro) {
            // Manejar el caso en el que no se encuentra el registro
            abort(404, 'Registro no encontrado');
        }
        // Crear una nueva instancia de FichaPDF
        $this->pdf = new FichaPDF($id,$registro->created_at);
        $this->pdf->AliasNbPages();
        // Generar el reporte con los datos del registro de la ficha
        $this->pdf->generarReporte($registro);
      
    }

    
}

