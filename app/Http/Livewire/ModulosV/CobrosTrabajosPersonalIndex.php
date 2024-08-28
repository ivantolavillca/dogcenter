<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\farmaciasVentas;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Internacion;
use App\Models\Modulos\Vacunas;
use Livewire\Component;

class CobrosTrabajosPersonalIndex extends Component
{
    public function GetAnios()
    {

        $query1 = Historias_clinico::where('estado', 'activo')
            ->where(function ($query) {
                $query->where('tipo_historial_id', 1)
                    ->orWhere('tipo_historial_id', 10);
            });



        $UsuarioHistorialClinico = $query1->orderBy('created_at', 'desc')->get();

        $query2 = Desparacitaciones::where('estado', 'activo');


        $UsuarioDesparacitaciones = $query2->orderBy('created_at', 'desc')->get();

        $query3 = Vacunas::where('estado', 'activo');



        $UsuarioVacunas = $query3->orderBy('created_at', 'desc')->get();
        $query4 = Cirugias::where('estado', 'activo');


        $UsuarioCirugias = $query4->orderBy('created_at', 'desc')->get();

        $query5 = farmaciasVentas::where('estado', 'activo');



        $UsuarioFarmacia = $query5->orderBy('created_at', 'desc')->get();

        $query6 = Internacion::where('estado', 'activo');



        $UsuarioInternacion = $query6->orderBy('created_at', 'desc')->get();
        $query7 = Historias_clinico::where('estado', 'activo')
            ->where('tipo_historial_id', 2);



        $UsuarioEstudio = $query7->orderBy('created_at', 'desc')->get();

        $years = [];

        foreach ([$UsuarioHistorialClinico, $UsuarioDesparacitaciones, $UsuarioVacunas, $UsuarioCirugias, $UsuarioFarmacia, $UsuarioInternacion, $UsuarioEstudio] as $collection) {
            foreach ($collection as $item) {
                $year = $item->created_at->format('Y');
                if (!in_array($year, $years)) {
                    $years[] = $year;
                }
            }
        }

        // Ordenamos el array de años
        sort($years);

        return $years;
    }
    public function GetTotalesPrecios()
    {
        // Mapa de campos de precios para cada entidad
        // $camposDePrecio = [
        //     'Historias_clinico' => 'precio', // Nombre del campo para Historias_clinico
        //     'Desparacitaciones' => 'precio', // Nombre del campo para Desparacitaciones
        //     'Vacunas' => 'precio', // Nombre del campo para Vacunas
        //     'Cirugias' => 'total', // Nombre del campo para Cirugias
        //     'farmaciasVentas' => 'precio', // Nombre del campo para farmaciasVentas
        //     'Internacion' => 'precio', // Nombre del campo para Internacion
        //     'Historias_clinico' => 'precio' // Nombre del campo para Estudio
        // ];

        $totalPrecios = [];
        $query1 = Historias_clinico::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(precio) as total_precio')
            ->where('estado', 'activo')
            ->where(function ($query) {
                $query->where('tipo_historial_id', 1)
                    ->orWhere('tipo_historial_id', 10);
            });



        $UsuarioHistorialClinico = $query1->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();

        foreach ($UsuarioHistorialClinico as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;

            // Inicializar el año si no existe
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }

            // Agregar el total al mes correspondiente
            $totalPrecios[$year][$month - 1] += $total;
        }

        $query2 = Desparacitaciones::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(precio) as total_precio')
            ->where('estado', 'activo');


        $UsuarioDesparacitaciones = $query2->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
        foreach ($UsuarioDesparacitaciones as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;

            // Inicializar el año si no existe
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }

            // Agregar el total al mes correspondiente
            $totalPrecios[$year][$month - 1] += $total;
        }

        $query3 = Vacunas::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(precio) as total_precio')
            ->where('estado', 'activo');



        $UsuarioVacunas = $query3->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
        foreach ($UsuarioVacunas as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;

            // Inicializar el año si no existe
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }

            // Agregar el total al mes correspondiente
            $totalPrecios[$year][$month - 1] += $total;
        }
        $query4 = Cirugias::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as total_precio')->where('estado', 'activo');


        $UsuarioCirugias = $query4->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
        foreach ($UsuarioCirugias as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }
            $totalPrecios[$year][$month - 1] += $total;
        }

        $query5 = farmaciasVentas::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(precio) as total_precio')->where('estado', 'activo');
        $UsuarioFarmacia = $query5->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
        foreach ($UsuarioFarmacia as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }
            $totalPrecios[$year][$month - 1] += $total;
        }

        $query6 = Internacion::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(precio) as total_precio')->where('estado', 'activo');



        $UsuarioInternacion = $query6->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
        foreach ($UsuarioInternacion as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }
            $totalPrecios[$year][$month - 1] += $total;
        }
        $query7 = Historias_clinico::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(precio) as total_precio')->where('estado', 'activo')
            ->where('tipo_historial_id', 2);



        $UsuarioEstudio = $query7->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')->get();
        foreach ($UsuarioEstudio as  $item) {

            $year = $item->year;
            $month = $item->month;
            $total = $item->total_precio;
            if (!isset($totalPrecios[$year])) {
                $totalPrecios[$year] = array_fill(0, 12, 0); // Inicializar con 12 meses
            }
            $totalPrecios[$year][$month - 1] += $total;
        }
        return $totalPrecios;
    }




    public function render()
    {

        $anios = $this->GetAnios();
        $precios = $this->GetTotalesPrecios();
        return view('livewire.modulos-v.cobros-trabajos-personal-index', compact('anios', 'precios'));
    }
}
