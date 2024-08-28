<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Mascotas;
use App\PDF\ReporteDerivacion;
use Codedge\Fpdf\Fpdf\Fpdf;

class MascotaController extends Controller
{
 
    public function index()
    {
        $valor="";
        return view(
            'modulos-veterinaria.mascotas',compact('valor')
        );
    }
    public function index2()
    {
        $valor="dos";
        return view(
            'modulos-veterinaria.mascotas',compact('valor')
        );
    }
    public function index3()
    {
        $valor="tres";
        return view(
            'modulos-veterinaria.mascotas',compact('valor')
        );
    }
    public function index4()
    {
        $valor="cuatro";
        return view(
            'modulos-veterinaria.mascotas',compact('valor')
        );
    }
    public function mascotasindex($mascota)
    {
        return view(
            'modulos-veterinaria.mascotas-index',
            compact('mascota')
        );
    }
    private function consultaHistorialDeMascota($id)
    {
        return Historias_clinico::where('mascota_id', $id)
            ->where('estado', 'activo')
            ->get();
    }
    protected $pdf;
    public function derivacion($mascota)
    {
       
        $this->pdf = new ReporteDerivacion();
        $this->pdf->AliasNbPages();
        // Generar el reporte con los datos del registro de la ficha
        $this->pdf->generarReporte($mascota);

   
    }
    public function fechaEnPalabras($fecha)
    {
        // Obtén el día en numeral
        $dia = $fecha->format('d');

        // Array de nombres de mes en español
        $nombresMeses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];

        // Obtén el número de mes de la fecha
        $numeroMes = $fecha->format('n');

        // Obtén el nombre del mes en español
        $nombreMes = $nombresMeses[$numeroMes];

        // Obtén el año en numeral
        $anio = $fecha->format('Y');

        return "$dia de $nombreMes de $anio";
    }
}
