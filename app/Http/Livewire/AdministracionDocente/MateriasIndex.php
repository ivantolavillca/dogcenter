<?php

namespace App\Http\Livewire\AdministracionDocente;

use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiNota;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Luecano\NumeroALetras\NumeroALetras;

class MateriasIndex extends Component
{


    
  public function getReporteSQL($id_planificar_asignatura)
    {
        $reporte = SiadiPlanificarAsignatura::join('siadi_inscripcions as sins', 'sins.id_planificar_asignatura', '=', 'siadi_planificar_asignaturas.id_planificar_asignatura')
            ->join('siadi_notas as sn', 'sn.id_inscripcion', '=', 'sins.id_inscripcion')
            ->join('siadi_personas as sps', 'sps.id_siadi_persona', '=', 'sins.id_siadi_persona')
            ->join('siadi_convocatorias as sc', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'sc.id_siadi_convocatoria')
            ->join('siadi_asignaturas as sa', 'sa.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
            ->join('siadi_idiomas as si', 'si.id_idioma', '=', 'sa.id_idioma')
            ->join('siadi_paralelos as sp', 'sp.id_paralelo', '=', 'siadi_planificar_asignaturas.id_paralelo')
            ->join('siadi_tipo_convocatorias as stc', 'stc.id_tipo_convocatoria', '=', 'sc.id_tipo_convocatoria')
            ->join('siadi_convocartoria_estudiantes as sce', 'sce.id_convocartoria_estudiante', '=', 'stc.id_convocartoria_estudiante')
            ->join('siadi_gestions as sg', 'sg.id_gestion', '=', 'sc.id_gestion')
            ->select('siadi_planificar_asignaturas.id_planificar_asignatura', 'sc.id_gestion', 'sc.sede', 'sa.id_idioma', 'sa.id_nivel_idioma', 'sps.paterno_persona', 'sps.materno_persona', 'sps.nombres_persona', 'sps.ci_persona', 'sps.expedido_persona', 'sn.final_nota', 'sins.observacion_inscripcion', 'sa.sigla_asignatura', 'si.sigla_codigo_idioma', 'sp.nombre_paralelo', 'sce.nombre_convocatoria_estudiante', 'sg.nombre_gestion', 'sc.periodo', 'siadi_planificar_asignaturas.id_asignacion_docente')
            ->where('siadi_planificar_asignaturas.id_planificar_asignatura', '=', $id_planificar_asignatura)
            ->get();

        return $reporte;
    }

//reportes
   public function getDocentePersona($id_planificar_asignatura, $id_asignacion_docente)
    {
        return DB::
            select("SELECT vp.ci, vp.nombre, vp.paterno, vp.materno, asid.grado_nombramiento FROM siadi_planificar_asignaturas JOIN base_upea.vista_persona AS vp ON siadi_planificar_asignaturas.id_asignacion_docente = vp.id JOIN base_upea.vista_asignacion_control_docente_actua AS asid ON vp.id= asid.id_persona WHERE siadi_planificar_asignaturas.id_planificar_asignatura = $id_planificar_asignatura AND vp.id =  $id_asignacion_docente;");
            
    }

  
    public function imprimir_acta($id_planificar_asignatura)
    {
        $reporte = $this->getReporteSQL($id_planificar_asignatura);
        if (count($reporte) > 0) {
            $fecha = date('Y-m-d H:i:s');
            $title = 'Reporte_' . $fecha;
            return response()->streamDownload(function () use ($reporte) {
                $registros = count($reporte);

                $pdf = new Fpdf();
                $pdf->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");
                $pdf->Addpage('P', array(216, 330));
                $pdf->Image(public_path("cert") . '/logo_upea.png', 15, 8, 25, 25);
                $pdf->SetTextColor(0, 0, 0); //Color del texto: Negro
                // $pdf->SetX(30);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('EdwardianScriptITC', '', 38);
                $pdf->Cell(0, 5, utf8_decode('Universidad Pública de El Alto'), 0, 1, 'C');
                $pdf->SetFont('Arial', 'I', 6);
                $pdf->Cell(0, 9, 'Creada por Ley 2115 del 5 de Septiembre de 2000 y ' . utf8_decode('Autónoma') . ' por Ley 2556 del 12 de Noviembre de 2003', 0, 1, 'C');
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(0, 2, utf8_decode('DEPARTAMENTO DE IDIOMAS'), 0, 1, 'C');
                $pdf->Cell(0, 10, utf8_decode('ACTA DE CALIFICACIONES'), 0, 1, 'C');

                $pdf->SetFont('Arial', 'B', 10);
                $tam = 4;
                $bordeCelda = 0;
                $pdf->SetXY(20, 35);
                $pdf->Cell(120, $tam, utf8_decode('Sede: ' . strtoupper($reporte[0]->sede)), $bordeCelda, 0, 'L');
                $pdf->SetXY(135, 35);
                $pdf->Cell(66, $tam, utf8_decode('Curso: ' . $reporte[0]->nombre_convocatoria_estudiante), $bordeCelda, 0, 'L');
                $pdf->SetXY(20, 40);
                $pdf->Cell(129, $tam, utf8_decode('Carrera: LINGÜÍSTICA E IDIOMAS'), $bordeCelda, 0, 'L');
                $pdf->SetXY(135, 40);
                $pdf->Cell(75, $tam, utf8_decode('Paralelo: "' . $reporte[0]->nombre_paralelo . '"'), $bordeCelda, 0, 'L');
                $pdf->SetXY(20, 45);
                $pdf->Cell(138, $tam, utf8_decode('Asignatura: ' . $reporte[0]->sigla_asignatura), $bordeCelda, 0, 'L');
                $pdf->SetXY(135, 45);
                $pdf->Cell(84, $tam, utf8_decode('Sigla-Código: ' . $reporte[0]->sigla_codigo_idioma), $bordeCelda, 0, 'L');
                $pdf->SetXY(20, 50);
                if ($reporte[0]->id_asignacion_docente) {
                    $docente = $this->getDocentePersona($reporte[0]->id_planificar_asignatura, $reporte[0]->id_asignacion_docente);
                    $pdf->Cell(147, $tam, utf8_decode('Docente:'.$docente[0]->grado_nombramiento .' '. $docente[0]->nombre . ' ' . $docente[0]->paterno . ' ' . $docente[0]->materno), $bordeCelda, 0, 'L');
                } else {
                    $pdf->Cell(147, $tam, utf8_decode('Docente: ---'), $bordeCelda, 0, 'L');
                }
                $pdf->SetXY(135, 50);
                $pdf->Cell(93, $tam, utf8_decode('Gestión: ' . $reporte[0]->periodo . '-' . $reporte[0]->nombre_gestion), $bordeCelda, 0, 'L');

                $pager = 1;

                if ($registros > 40) {
                    $reg = $registros - 40;
                    $redondear = intdiv($reg, 45);
                    $residuo = $reg % 45;
                    if ($residuo > 0.0) {
                        $paginas = $redondear + 2;
                    } else {
                        $paginas = $redondear + 1;
                    }
                } else {
                    $paginas = 1;
                }

                $pdf->SetFont('Arial', 'B', 6);
                $pdf->SetXY(184, 55);
                $pdf->Cell(93, $tam, utf8_decode('Pagina ' . $pager . ' de ' . $paginas), $bordeCelda, 0, 'L');

                $bordeCelda = 1;

                $alturaTabla = 59;
                $pdf->SetFont('Arial', 'B', 6);
                $pdf->SetXY(12, $alturaTabla);
                $pdf->Cell(5, $tam, utf8_decode('N°'), $bordeCelda, 0, 'C');
                $pdf->Cell(25, $tam, utf8_decode('APELLIDO PATERNO'), $bordeCelda, 0, 'C');
                $pdf->Cell(25, $tam, utf8_decode('APELLIDO MATERNO'), $bordeCelda, 0, 'C');
                $pdf->Cell(30, $tam, utf8_decode('NOMBRES(S)'), $bordeCelda, 0, 'C');
                $pdf->Cell(12, $tam, utf8_decode('CI'), $bordeCelda, 0, 'C');
                $pdf->Cell(8, $tam, utf8_decode('EXP.'), $bordeCelda, 0, 'C');
                $pdf->Cell(21, $tam, utf8_decode('CATEGORIA'), $bordeCelda, 0, 'C');
                $pdf->Cell(11, $tam, utf8_decode('s/100 Pts'), $bordeCelda, 0, 'C');
                $pdf->Cell(33, $tam, utf8_decode('CALIFICACION LITERAL'), $bordeCelda, 0, 'C');
                $pdf->Cell(20, $tam, utf8_decode('RESULTADO'), $bordeCelda, 0, 'C');

                $pag = 42;
                $alturaTabla += 4;
                $i = 1;
                $aprobados = 0;
                $reprobados = 0;
                $nsp = 0;

                // for ($k = 1; $k <= 38; $k++) {
                //     $pdf->SetFont('Arial', '', 5);
                //     $pdf->SetXY(12, $alturaTabla);
                //     $pdf->Cell(5, $tam, utf8_decode($i), $bordeCelda, 0, 'C');
                //     $pdf->Cell(25, $tam, utf8_decode(strtoupper('PILLCO')), $bordeCelda, 0, 'L');
                //     $pdf->Cell(25, $tam, utf8_decode(strtoupper('QUISPE')), $bordeCelda, 0, 'L');
                //     $pdf->Cell(30, $tam, utf8_decode(strtoupper('JACQUELINE')), $bordeCelda, 0, 'L');
                //     $pdf->Cell(12, $tam, utf8_decode('12345678'), $bordeCelda, 0, 'C');
                //     $pdf->Cell(8, $tam, utf8_decode(strtoupper('LP')), $bordeCelda, 0, 'C');
                //     $pdf->Cell(21, $tam, utf8_decode(strtoupper('ESTUDIANTE REGULAR')), $bordeCelda, 0, 'C');
                //     $pdf->Cell(11, $tam, utf8_decode('100'), $bordeCelda, 0, 'C');
                //     $pdf->Cell(33, $tam, utf8_decode(strtoupper('SETENTA Y SIETE')), $bordeCelda, 0, 'C');
                //     $pdf->Cell(20, $tam, utf8_decode('APROBADO'), $bordeCelda, 0, 'C');
                //     $alturaTabla += 4;
                //     $i++;
                // }

                foreach ($reporte as $rep) {
                    $pdf->SetFont('Arial', '', 5);
                    $pdf->SetXY(12, $alturaTabla);
                    $pdf->Cell(5, $tam, utf8_decode($i), $bordeCelda, 0, 'C');
                    $pdf->Cell(25, $tam, utf8_decode(strtoupper($rep->paterno_persona)), $bordeCelda, 0, 'L');
                    $pdf->Cell(25, $tam, utf8_decode(strtoupper($rep->materno_persona)), $bordeCelda, 0, 'L');
                    $pdf->Cell(30, $tam, utf8_decode(strtoupper($rep->nombres_persona)), $bordeCelda, 0, 'L');
                    $pdf->Cell(12, $tam, utf8_decode($rep->ci_persona), $bordeCelda, 0, 'C');
                    $pdf->Cell(8, $tam, utf8_decode(strtoupper($rep->expedido_persona)), $bordeCelda, 0, 'C');
                    $pdf->Cell(21, $tam, utf8_decode(strtoupper($rep->nombre_convocatoria_estudiante)), $bordeCelda, 0, 'C');
                    if ($rep->final_nota) {
                        $pdf->Cell(11, $tam, utf8_decode($rep->final_nota), $bordeCelda, 0, 'C');
                    } else {
                        $pdf->Cell(11, $tam, utf8_decode('---'), $bordeCelda, 0, 'C');
                    }
                    if ($rep->final_nota) {
                        $formatter = new NumeroALetras();
                        $pdf->Cell(33, $tam, utf8_decode(strtoupper($formatter->toString($rep->final_nota))), $bordeCelda, 0, 'C');
                    } else {
                        $pdf->Cell(33, $tam, utf8_decode('---'), $bordeCelda, 0, 'C');
                    }
                    if ($rep->final_nota) {
                        if ($rep->final_nota > 50) {
                            $pdf->Cell(20, $tam, utf8_decode('APROBADO'), $bordeCelda, 0, 'C');
                            $aprobados++;
                        } else {
                            $pdf->Cell(20, $tam, utf8_decode('REPROBADO'), $bordeCelda, 0, 'C');
                            $reprobados++;
                        }
                    } else {
                        $nsp++;
                        $pdf->Cell(20, $tam, utf8_decode('NO SE PRESENTÓ'), $bordeCelda, 0, 'C');
                    }

                    $alturaTabla = $alturaTabla + 4;
                    // if ($i == $pag) {
                    //     $pager++;
                    //     $pdf->Addpage();
                    //     $pdf->Image(public_path("cert") . '/logo_upea.png', 15, 8, 25, 25);
                    //     $pdf->SetTextColor(0, 0, 0); //Color del texto: Negro
                    //     $pdf->SetX(30);
                    //     $pdf->SetFont('times', '', 30);
                    //     $pdf->Cell(0, 5, utf8_decode('Universidad Pública de El Alto'), 0, 1, 'C'); // $pdf->Cell(ANCHO, ALTO, 'UNIVERSIDAD PUBLICA DE EL ALTO', margen, 1=seguido, 'alineacion');
                    //     $pdf->SetFont('Arial', 'I', 6);
                    //     $pdf->Cell(0, 9, 'Creada por Ley 2115 del 5 de Septiembre de 2000 y ' . utf8_decode('Autónoma') . ' por Ley 2556 del 12 de Noviembre de 2003', 0, 1, 'C');
                    //     $pdf->SetFont('Arial', 'B', 16);
                    //     $pdf->Cell(0, 2, utf8_decode('DEPARTAMENTO DE IDIOMAS'), 0, 1, 'C');
                    //     $pdf->Cell(0, 10, utf8_decode('ACTA DE CALIFICACIONES'), 0, 1, 'C');

                    //     $pdf->SetFont('Arial', 'B', 7);
                    //     $pdf->SetXY(184, 35);

                    //     $pdf->Cell(93, $tam, utf8_decode('Pagina ' . $pager . ' de ' . $paginas), 0, 0, 'L');

                    //     $alturaTabla = 40;
                    //     $pag = $pag + 45;
                    // }
                    $i++;
                }

                if ($i <= 30) {
                    $pdf->SetFont('Arial', '', 5);
                    $pdf->SetXY(12, $alturaTabla);
                    $pdf->Cell(5, $tam, utf8_decode('XX'), $bordeCelda, 0, 'C');
                    $pdf->Cell(25, $tam, utf8_decode('XXXXXXXXXXXXXXX'), $bordeCelda, 0, 'L');
                    $pdf->Cell(25, $tam, utf8_decode('XXXXXXXXXXXXXXX'), $bordeCelda, 0, 'L');
                    $pdf->Cell(30, $tam, utf8_decode('XXXXXXXXXXXXXXXXXXXXXXX'), $bordeCelda, 0, 'L');
                    $pdf->Cell(12, $tam, utf8_decode('XXXXXXXX'), $bordeCelda, 0, 'C');
                    $pdf->Cell(8, $tam, utf8_decode('XX'), $bordeCelda, 0, 'C');
                    $pdf->Cell(21, $tam, utf8_decode('XXXXXXXXXXXXX'), $bordeCelda, 0, 'C');
                    $pdf->Cell(11, $tam, utf8_decode('XXX'), $bordeCelda, 0, 'C');
                    $pdf->Cell(33, $tam, utf8_decode('XXXXXXXXXXXXXXXX'), $bordeCelda, 0, 'C');
                    $pdf->Cell(20, $tam, utf8_decode('XXXXXXXXXXX'), $bordeCelda, 0, 'C');

                    $alturaTabla = $alturaTabla + 4;
                    $i++;

                    if ($i <= 40) {
                        for ($j = $i; $j <= 40; $j++) {
                            $pdf->SetFont('Arial', '', 5);
                            $pdf->SetXY(12, $alturaTabla);
                            $pdf->Cell(5, $tam, utf8_decode($j), $bordeCelda, 0, 'C');
                            $pdf->Cell(25, $tam, '', $bordeCelda, 0, 'L');
                            $pdf->Cell(25, $tam, '', $bordeCelda, 0, 'L');
                            $pdf->Cell(30, $tam, '', $bordeCelda, 0, 'L');
                            $pdf->Cell(12, $tam, '', $bordeCelda, 0, 'C');
                            $pdf->Cell(8, $tam, '', $bordeCelda, 0, 'C');
                            $pdf->Cell(21, $tam, '', $bordeCelda, 0, 'C');
                            $pdf->Cell(11, $tam, '', $bordeCelda, 0, 'C');
                            $pdf->Cell(33, $tam, '', $bordeCelda, 0, 'C');
                            $pdf->Cell(20, $tam, '', $bordeCelda, 0, 'C');

                            $alturaTabla = $alturaTabla + 4;
                        }
                    }
                }

                $bordeCelda = 0;
                $pdf->SetXY(3, $alturaTabla);
                $pdf->SetFont('Arial', 'B', 6);
                $pdf->Cell(127, $tam, utf8_decode('ADVERTENCIA: Este documento queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.'), $bordeCelda, 0, 'C');
                $alturaTabla = $alturaTabla + 3;
                $pdf->SetXY(8, $alturaTabla);
                $pdf->Cell(58, $tam, utf8_decode('C.F. s/100 = Calificación Final sobre 100 puntos.'), $bordeCelda, 0, 'C');

                // $fecha = date();
                $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                $dia = date("j");
                $mes = date("n");
                $anio = date("Y");
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(140, $alturaTabla + 3);
                $pdf->Cell(60, $tam, utf8_decode('Lugar y Fecha: El Alto, ' . $dia . ' de ' . $meses[$mes - 1] . ' de ' . $anio), $bordeCelda, 0, 'C');

                $pdf->SetXY(137, $alturaTabla + 9);
                $pdf->Cell(40, $tam, utf8_decode('CUADRO RESUMEN'), 1, 0, 'C');
                $pdf->Cell(10, $tam, utf8_decode('N°'), 1, 0, 'C');
                $pdf->Cell(15, $tam, utf8_decode('%'), 1, 0, 'C');

                $pdf->SetFont('Arial', '', 7);
                $pdf->SetXY(137, $alturaTabla + 13);
                $pdf->Cell(40, $tam, utf8_decode('APROBADOS'), 1, 0, 'L');
                $pdf->Cell(10, $tam, utf8_decode($aprobados), 1, 0, 'C');
                $pdf->Cell(15, $tam, utf8_decode(number_format(($aprobados * 100) / $registros, 2) . '%'), 1, 0, 'C');

                $pdf->SetXY(137, $alturaTabla + 17);
                $pdf->Cell(40, $tam, utf8_decode('REPROBADOS'), 1, 0, 'L');
                $pdf->Cell(10, $tam, utf8_decode($reprobados), 1, 0, 'C');
                $pdf->Cell(15, $tam, utf8_decode(number_format(($reprobados * 100) / $registros, 2) . '%'), 1, 0, 'C');

                $pdf->SetXY(137, $alturaTabla + 21);
                $pdf->Cell(40, $tam, utf8_decode('NO SE PRESENTÓ'), 1, 0, 'L');
                $pdf->Cell(10, $tam, utf8_decode($nsp), 1, 0, 'C');
                $pdf->Cell(15, $tam, utf8_decode(number_format(($nsp * 100) / $registros, 2) . '%'), 1, 0, 'C');

                $pdf->SetFont('Arial', 'B', 7);
                $pdf->SetXY(137, $alturaTabla + 25);
                $pdf->Cell(40, $tam, utf8_decode('TOTAL'), 1, 0, 'C');
                $pdf->Cell(10, $tam, utf8_decode($registros), 1, 0, 'C');
                $pdf->Cell(15, $tam, utf8_decode(($registros * 100) / $registros . '%'), 1, 0, 'C');

                $pdf->SetFont('Arial', '', 6);
                $pdf->SetXY(170, 280);
                $pdf->Cell(40, $tam, utf8_decode('SELLO CARRERA'), 0, 0, 'C');

                // require('dash.php');
                // $pdf->SetXY(30, -20);
                $pdf->SetDash(0.5, 0.5);
                $pdf->SetFont('Arial', '', '6');

                $pdf->Line(30, 300, 60, 300);
                $pdf->SetXY(37, 300);
                $pdf->Cell(15, $tam, utf8_decode('DOCENTE'), 0, 0, 'C');

                $pdf->Line(80, 300, 110, 300);
                $pdf->SetXY(87, 300);
                $pdf->Cell(15, $tam, utf8_decode('ENC. DEPTO. IDIOMAS'), 0, 0, 'C');

                $pdf->Line(130, 300, 160, 300);
                $pdf->SetXY(137, 300);
                $pdf->Cell(15, $tam, utf8_decode('DIRECTOR(A)'), 0, 0, 'C');

                $pdf->SetAutoPageBreak(false, 5);
                $pdf->SetXY(14, 320);
                $pdf->SetFont('Arial', '', 7);
                $pdf->Cell(120, $tam, utf8_decode('NOTA: El llenado de las Actas de Calificaciones debe ser computarizado, sin alterar el formato de las celdas.'), $bordeCelda, 0, 'C');

                $pdf->Output();
            }, $title . ".pdf");
            exit;
        } else {
            $this->emit('vacio', 'Paralelo sin estudiantes inscritos.');
        }
    }


    //editar notas

    public $id_asignatura_actual;
   
    public $editableNotaId = null;
    public $notaFinal = [];

    public function verestudiantesasignaturas($id_asignatura)
    {
        $this->id_asignatura_actual = $id_asignatura;
        // Cargar estudiantes por materia
       

    }


  
    public function updateNota($notaId)
{
    $nota = SiadiNota::find($notaId);
     if ($this->notaFinal[$notaId] >= 0 && $this->notaFinal[$notaId] <= 100) {
        if ($this->notaFinal[$notaId] >= 51) {
            $nota->final_nota = $this->notaFinal[$notaId];
            $nota->observacion_nota ='APROBADO';
        $nota->save();
        
        } elseif($this->notaFinal[$notaId] < 51) {
            
     
        $nota->final_nota = $this->notaFinal[$notaId];
        $nota->observacion_nota ='REPROBADO';
        $nota->save();
       
        }
   
        
        // Emitir un evento para notificar sobre el cambio en la nota
        $this->emit('notaActualizada', $notaId);
    } else {
        // Si la nota no está en el rango válido, muestra un mensaje de error
        $this->addError('notaerror', 'La nota debe ser de la escala del 1 al 100');
    }
}
// public function saveNota($id)
// {
//     $nota = SiadiNota::find($id);

//     // Validación para asegurarse de que la nota esté en el rango de 1 a 100
//     if ($this->notaFinal[$id] >= 0 && $this->notaFinal[$id] <= 100) {
//         if ($this->notaFinal[$id] >= 51) {
//             $nota->final_nota = $this->notaFinal[$id];
//             $nota->observacion_nota ='APROBADO';
//         $nota->save();
         
//         } elseif($this->notaFinal[$id] < 51) {
            
     
//         $nota->final_nota = $this->notaFinal[$id];
//         $nota->observacion_nota ='REPROBADO';
//         $nota->save();
//         }
   
        
//         // Emitir un evento para notificar sobre el cambio en la nota
//         $this->emit('notaActualizada', $id);
//     } else {
//         // Si la nota no está en el rango válido, muestra un mensaje de error
//         $this->addError('notaerror', 'La nota debe ser de la escala del 1 al 100');
//     }

//     // Limpiar la variable de edición
//     $this->editableNotaId = null;
// }
    public function render()
    {
         $estudiantes_por_materia = [];
$estudiantes_por_materia = SiadiInscripcion::where('id_planificar_asignatura', $this->id_asignatura_actual)->get();
        $usuarioautenticado=Auth::user();
        $id_persona=$usuarioautenticado->id_persona;
        $materiasdocente=SiadiPlanificarAsignatura::where('id_asignacion_docente',$id_persona)
        ->where('estado_planificar_asignartura', '=', 'ACTIVO')->get();
       // $estudiantes_por_materia=SiadiInscripcion::where('id_planificar_asignatura',$this->id_asignatura_actual)->get();
        return view('livewire.administracion-docente.materias-index' ,compact('materiasdocente','estudiantes_por_materia'));
    }
}
