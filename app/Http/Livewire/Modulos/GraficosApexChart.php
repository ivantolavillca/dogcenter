<?php

namespace App\Http\Livewire\Modulos;

use Livewire\Component;
use \DB;

class GraficosApexChart extends Component
{
    public function render()
    {
        return view('livewire.modulos.graficos-apex-chart'/* ,
            [
                'estudiantes_total_genero' => $this->get_estudiantes_total_inscritos_genero(),
                # 'estudiantes_perido_gestion' => $this->get_estudiantes_por_periodo_gestion()
            ] */
        );
    }

    private function get_estudiantes_total_inscritos_genero(){
        return DB::table("siadi_inscripcions")
                ->join("siadi_notas", "siadi_notas.id_inscripcion", "=", "siadi_inscripcions.id_inscripcion")
                ->join("siadi_planificar_asignaturas", "siadi_planificar_asignaturas.id_planificar_asignatura", "=", "siadi_inscripcions.id_planificar_asignatura")
                ->join("siadi_convocatorias", "siadi_convocatorias.id_siadi_convocatoria", "=", "siadi_planificar_asignaturas.id_siadi_convocatoria")
                ->join("siadi_gestions", "siadi_gestions.id_gestion", "=", "siadi_convocatorias.id_gestion")
                ->join("siadi_personas", "siadi_personas.id_siadi_persona", "=", "siadi_inscripcions.id_siadi_persona")
            ->select(
                    #'siadi_personas.genero_persona', 
                    DB::raw("CASE siadi_personas.genero_persona
                        WHEN 'F' THEN 'Mujeres'
                        WHEN 'M' THEN 'Hombres'
                        ELSE 'Géneros sin asignar'
                    END AS genero_persona"),
                    DB::raw("COUNT(DISTINCT siadi_personas.id_siadi_persona) AS estudiantes_inscritos") 
                )
            ->where(function($query){
                $query->where('siadi_inscripcions.estado_inscripcion', '<>', 'ELIMINAR')
                    ->where('siadi_notas.estado_nota', '<>', 'ELIMINAR')
                    ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINAR')
                    ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINAR')
                    ->where('siadi_gestions.estado_gestion', '<>', 'ELIMINAR')
                    ->where('siadi_personas.estado_persona', '<>', 'ELIMINAR');
            })
            ->groupBy("siadi_personas.genero_persona")
            ->get();
    }


    private function get_estudiantes_por_periodo_gestion(){
        return DB::table("siadi_inscripcions")
            ->join("siadi_notas", "siadi_notas.id_inscripcion", "=", "siadi_inscripcions.id_inscripcion")
            ->join("siadi_planificar_asignaturas", "siadi_planificar_asignaturas.id_planificar_asignatura", "=", "siadi_inscripcions.id_planificar_asignatura")
            ->join("siadi_convocatorias", "siadi_convocatorias.id_siadi_convocatoria", "=", "siadi_planificar_asignaturas.id_siadi_convocatoria")
            ->join("siadi_gestions", "siadi_gestions.id_gestion", "=", "siadi_convocatorias.id_gestion")
        ->select(
            DB::raw("CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion_literal"),
            DB::raw("COUNT(siadi_inscripcions.id_inscripcion) total_inscritos"),
            DB::raw( $this->get_count_id_nota_nivel_anio_gestion('APROBADO', 'estudiantes_aprobados') ),
            DB::raw( $this->get_count_id_nota_nivel_anio_gestion('REPROBADO', 'estudiantes_reprobados') ),
            DB::raw( $this->get_count_id_nota_nivel_anio_gestion('NO SE PRESENTO', 'estudiantes_no_se_presentaron') ),
            DB::raw( $this->get_count_id_nota_nivel_anio_gestion('NO ASIGNADO', 'estudiantes_no_asignados') )
        )
        ->where(function($query){
            $query->where('siadi_inscripcions.estado_inscripcion', '<>','ELIMINAR')
                ->where('siadi_notas.estado_nota', '<>', 'ELIMINAR')
                ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINAR')
                ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINAR')
                ->where('siadi_gestions.estado_gestion', '<>', 'ELIMINAR');
        })
        ->groupBy("gestion_literal")
        ->take(10)
        ->orderBy("siadi_gestions.nombre_gestion", "desc")
        ->orderBy("siadi_convocatorias.periodo", "desc")->get();
    }

    private function get_count_id_nota_nivel_anio_gestion($condition, $show_as){
        return "(
            SELECT 
                COUNT(sn.id_nota)
            FROM siadi_inscripcions si
                INNER JOIN siadi_notas sn ON(sn.id_inscripcion = si.id_inscripcion)
                INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
                INNER JOIN siadi_convocatorias sc ON(sc.id_siadi_convocatoria = spa.id_siadi_convocatoria)
                INNER JOIN siadi_gestions sg ON(sg.id_gestion = sc.id_gestion)
            WHERE 
                si.estado_inscripcion <> 'ELIMINAR' AND
                sn.estado_nota <> 'ELIMINAR' AND 
                spa.estado_planificar_asignartura <> 'ELIMINAR' AND
                sc.estado_convocatoria <> 'ELIMINAR' AND
                sg.estado_gestion <> 'ELIMINAR'
                
                AND CONCAT(sc.periodo, '-', sg.nombre_gestion) = gestion_literal
                AND sn.observacion_nota = '$condition'
        ) AS $show_as";
    }

    private function get_estudiantes_perdiodo_gestion_tipo_estudiante($tipo_estudiante){}
}
