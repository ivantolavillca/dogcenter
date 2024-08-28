<?php 
namespace App\Exports;
#use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
/* use Maatwebsite\Excel\Concerns\FromGenerator;
use Maatwebsite\Excel\Concerns\WithStartRow; */
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WorkSheet;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

use Generator;

class ReporteExcel implements /*WithHeadings, /* WithStartRow, FromGenerator, */ WithEvents {

    use Exportable;
    private $TITLE_UNIVERSITY = "Universidad Pública de El Alto";
    private $SUBTITLE_UNIVERSITY = "Creada por Ley 2115 del 5 de Septiembre del 2000 y Autonoma por Ley 2556 del 12 de Noviembre de 2003";
    private $TITLE_INSTITUTION  = "DEPARTAMENTO DE IDIOMAS";
    private $TITLE_DATA = "LISTA DE ESTUDIANTES";
    private $IS_EXAMEN_FORMAT = false;

    private $DATA_AREA = "CIENCIAS SOCIALES";
    private $DATA_CAREER = "LINGÜÍSTICA E IDIOMAS";
    private $DATA_SUBJECT = "";
    private $DATA_TEACHER = "";
    private $DATA_APPOINTMENT_OR_RESOLUTION = "";

    private $DATA_COURSE = "";
    private $DATA_PARALLEL = "";
    private $DATA_SIGN_CODE = "";
    private $DATA_PERIOD_MANAGEMENT = "";

    private $DATA_FOOTER_WARNIGN = "ADVERTENCIA: Este documento queda nulo si en el hubiese hecho raspaduras, anotaciones o enmiendas.";
    private $DATA_FOOTER_PLACE_DATE = "Lugar y fecha : El Alto ";
    private $DATA_FOOTER_NOTE_INFO = "C.F. = Calificación Final sobre 100 puntos.";

    private $START_ROW_DATA = 12;
    private $dataArrayNotas;

    /* public function startRow(): int {
        return 5;
    } */

    public function __construct($dataArrayNotas = null)
    {
        $this->dataArrayNotas = $dataArrayNotas;
        $this->methodIntitial();
    }

    private function methodIntitial(){
        if(!is_null($this->dataArrayNotas) && count($this->dataArrayNotas)>0){
            $this->IS_EXAMEN_FORMAT = $this->dataArrayNotas[0]->id_convocartoria_estudiante==2; # 2, examen de suficiencia

            $this->DATA_SUBJECT = $this->dataArrayNotas[0]->asignatura;
            $this->DATA_TEACHER = $this->dataArrayNotas[0]->nombre_docente;
            $this->DATA_APPOINTMENT_OR_RESOLUTION = $this->IS_EXAMEN_FORMAT? $this->dataArrayNotas[0]->resolucion_rhcc : $this->dataArrayNotas[0]->cod_nombramiento;
            $this->DATA_COURSE = $this->dataArrayNotas[0]->curso;
            $this->DATA_PARALLEL = $this->dataArrayNotas[0]->paralelo;
            $this->DATA_SIGN_CODE = $this->dataArrayNotas[0]->sigla_asignatura;
            $this->DATA_PERIOD_MANAGEMENT = $this->dataArrayNotas[0]->gestion;

            $this->START_ROW_DATA = 12;
        }
    }


   /*  public function generator(): Generator{
        for($i=1; $i<=100; $i++){
            yield [$i, $i+1, $i+2];
        }
    } */

   /*  public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->getDelegate()->getStyle('A2:K2')->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'size' => 20,
                        'bold' => true
                    ]
                ]);

                #$event->sheet->getDelegate->setCellValue('A2', 'HOLA MUNDO');
                $event->sheet->getDelegate->setCellValueByColumnAndRow(1, 2, 'HOLA MUNDO');
            }
        ];
    } */

    public function registerEvents() : array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $fecha = Carbon::now();
                #configurar página
                $event->sheet->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT)
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LETTER)
                    ->setFitToPage(true)
                    ->setFitToWidth(1)
                    ->setFitToHeight(0);
                $event->sheet->getPageMargins()->setTop(.5)->setBottom(.5)->setLeft(.5)->setRight(.5);

                #$event->sheet->getPageSetup()->setPrintArea('A1:K100');

                # conigurar ancho de columnas
                $event->sheet->getColumnDimension('A')->setWidth(2.57);
                $event->sheet->getColumnDimension('B')->setWidth(14);
                $event->sheet->getColumnDimension('C')->setWidth(14);
                $event->sheet->getColumnDimension('D')->setWidth(17);
                $event->sheet->getColumnDimension('E')->setWidth(8);
                $event->sheet->getColumnDimension('F')->setWidth(2);
                $event->sheet->getColumnDimension('G')->setWidth(15);
                $event->sheet->getColumnDimension('H')->setWidth(5);
                $event->sheet->getColumnDimension('I')->setWidth(4.89);
                $event->sheet->getColumnDimension('J')->setWidth(12);
                $event->sheet->getColumnDimension('K')->setWidth(11);

                # TÍTULO E INFORMACIÓN
                $event->sheet->setCellValue('A1', $this->TITLE_UNIVERSITY);
                $event->sheet->getDelegate()->mergeCells('A1:K1');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setSize(43)->setName('Edwardian Script ITC');
                $event->sheet->getRowDimension('1')->setRowHeight(42);

                $event->sheet->setCellValue('A2', $this->SUBTITLE_UNIVERSITY);
                $event->sheet->getDelegate()->mergeCells('A2:K2');
                $event->sheet->getDelegate()->getStyle('A2')->getFont()->setSize(7.5)->setName('Times');
                $event->sheet->getRowDimension('2')->setRowHeight(11);

                $event->sheet->setCellValue('A3', $this->TITLE_INSTITUTION);
                $event->sheet->getDelegate()->mergeCells('A3:K3');
                $event->sheet->getDelegate()->getStyle('A3')->getFont()->setSize(20)->setName('Arial')->setBold(true);
                $event->sheet->getRowDimension('3')->setRowHeight(25.1);
                $event->sheet->setCellValue('A4', $this->TITLE_DATA);
                $event->sheet->getDelegate()->mergeCells('A4:K4');
                $event->sheet->getDelegate()->getStyle('A4')->getFont()->setSize(20)->setName('Arial')->setBold(true);
                $event->sheet->getRowDimension('4')->setRowHeight(25.1);

                $event->sheet->getDelegate()->getStyle('A1:A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:A4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                # ESTILOS DE INFORMACIÓN DE LA ASIGNATURA
                $detallesAsignaturaRango = "A5:K9";
                $event->sheet->getDelegate()->getStyle($detallesAsignaturaRango)->getFont()->setSize(12.5)->setBold(true);
                $event->sheet->getDelegate()->getStyle($detallesAsignaturaRango)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($detallesAsignaturaRango)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getRowDimension('4')->setRowHeight(18);

                $event->sheet->setCellValue('A5', 'Área: '. $this->DATA_AREA);
                $event->sheet->setCellValue('A6', 'Carrera: '. $this->DATA_CAREER);
                $event->sheet->setCellValue('A7', 'Asignatura: '. $this->DATA_SUBJECT);
                $event->sheet->setCellValue('A8', 'Docente: '. $this->DATA_TEACHER);
                $event->sheet->setCellValue('A9', ($this->IS_EXAMEN_FORMAT?'Resolución del Honorable Consejo de Carrera N° ' :'Nro de Nombramiento Docente: '). $this->DATA_APPOINTMENT_OR_RESOLUTION);

                $event->sheet->getDelegate()->mergeCells('A5:G5');
                $event->sheet->getDelegate()->mergeCells('A6:G6');
                $event->sheet->getDelegate()->mergeCells('A7:G7');
                $event->sheet->getDelegate()->mergeCells('A8:G8');
                $event->sheet->getDelegate()->mergeCells('A9:G9');

                if($this->IS_EXAMEN_FORMAT){
                    $event->sheet->setCellValue('H6', $this->DATA_COURSE);
                    $event->sheet->setCellValue('H7', 'Sigla-Código: '. $this->DATA_SIGN_CODE);
                    $event->sheet->setCellValue('H8', 'Gestión: '. $this->DATA_PERIOD_MANAGEMENT);
                } else {
                    $event->sheet->setCellValue('H6', 'CURSO - '. $this->DATA_COURSE);
                    $event->sheet->setCellValue('H7', 'Paralelo: '. $this->DATA_PARALLEL);
                    $event->sheet->setCellValue('H8', 'Sigla-Código: '. $this->DATA_SIGN_CODE);
                    $event->sheet->setCellValue('H9', 'Gestión: '. $this->DATA_PERIOD_MANAGEMENT);
                }
                
                /* $event->sheet->setCellValue('H7', 'Paralelo: '. $this->DATA_PARALLEL);
                $event->sheet->setCellValue('H8', 'Sigla-Código: '. $this->DATA_SIGN_CODE);
                $event->sheet->setCellValue('H9', 'Gestión: '. $this->DATA_PERIOD_MANAGEMENT); */

                $event->sheet->getDelegate()->mergeCells('H6:K6');
                $event->sheet->getDelegate()->mergeCells('H7:K7');
                $event->sheet->getDelegate()->mergeCells('H8:K8');
                $event->sheet->getDelegate()->mergeCells('H9:J9');

                // Set cell A1 with Your Title 
                /* $event->sheet->setCellValue('A1', 'Your Title Here');

                // Set cells A2:B2 with current date
                $event->sheet->setCellValue('A2', 'Report Date:');
                $event->sheet->setCellValue('B2', now()); */

                # ESTILOS PARA ENCABEZADOS
                $encabezadoNegritasrango = 'A10:K11';
                $event->sheet->getDelegate()->getStyle($encabezadoNegritasrango)->getFont()->setSize(6)->setBold(true);
                $event->sheet->getDelegate()->getStyle($encabezadoNegritasrango)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($encabezadoNegritasrango)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($encabezadoNegritasrango)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle($encabezadoNegritasrango)
                    ->getBorders()
                    ->getAllBorders() # getOutline
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));

                $event->sheet->setCellValue('A10', 'N°');
                $event->sheet->getDelegate()->mergeCells('A10:A11');
                $event->sheet->getDelegate()->getStyle('A10')->getFont()->setSize(9);

                $event->sheet->setCellValue('B10', 'NÓMINA');
                $event->sheet->getDelegate()->mergeCells('B10:D10');
                $event->sheet->getDelegate()->getStyle('B10')->getFont()->setSize(9);
                $event->sheet->setCellValue('B11', 'APELLIDO PATERNO');
                $event->sheet->setCellValue('C11', 'APELLIDO MATERNO');
                $event->sheet->setCellValue('D11', 'NOMBRE(S)');
                #$event->sheet->getDelegate()->getStyle('B11:D11')->getFont()->setSize(6.5);

                $event->sheet->setCellValue('E10', 'N° DE CEDULA DE IDENTIDAD');#->setWrapText(true);
                $event->sheet->getDelegate()->mergeCells('E10:E11');
                $event->sheet->getStyle('E10')->getAlignment()->setWrapText(true);

                $event->sheet->setCellValue('F10', 'EXP.');
                $event->sheet->getDelegate()->mergeCells('F10:F11');

                $event->sheet->setCellValue('G10', 'CATEGORÍA');
                $event->sheet->getDelegate()->mergeCells('G10:G11');
                $event->sheet->getDelegate()->getStyle('G10')->getFont()->setSize(6.5);

                $event->sheet->setCellValue('H10', 'C.F. s/100 pts.');
                $event->sheet->getDelegate()->mergeCells('H10:H11');
                $event->sheet->getStyle('H10')->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle('H10')->getFont()->setSize(7);

                $event->sheet->setCellValue('I10', 'CALIFICACIÓN LITERAL');
                $event->sheet->getDelegate()->mergeCells('I10:J11');
                $event->sheet->getDelegate()->getStyle('I10')->getFont()->setSize(8);

                $event->sheet->setCellValue('K10', 'RESULTADO');
                $event->sheet->getDelegate()->mergeCells('K10:K11');
                $event->sheet->getDelegate()->getStyle('K10')->getFont()->setSize(6);


                /* $cellRange = 'A5:K5'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getColor()
                            ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FF17a2b8');
                $event->sheet->setAutoFilter($cellRange); */

                #   RECORRER
                $actual = $this->START_ROW_DATA;
                $final = $this->START_ROW_DATA + count($this->dataArrayNotas) - 1;

                $estilosFilasRango = 'A'.$this->START_ROW_DATA .':K'. $final;
                $event->sheet->getDelegate()->getStyle($estilosFilasRango)->getFont()->setSize(9)->setName('Arial')->setBold(false);
                $event->sheet->getDelegate()->getStyle($estilosFilasRango)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));
                $event->sheet->getDelegate()->getStyle($estilosFilasRango)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                
                # nro
                $event->sheet->getDelegate()->getStyle('A'.$this->START_ROW_DATA .':A'. $final)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                # ci
                $event->sheet->getDelegate()->getStyle('E'.$this->START_ROW_DATA .':E'. $final)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $event->sheet->getDelegate()->getStyle('E'.$this->START_ROW_DATA .':E'. $final)->getFont()->setSize(8.5)->setName('Arial')->setBold(false);
                # exp, categoria
                $event->sheet->getDelegate()->getStyle('F'.$this->START_ROW_DATA .':H'. $final)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F'.$this->START_ROW_DATA .':F'. $final)->getFont()->setSize(8);
                $event->sheet->getDelegate()->getStyle('G'.$this->START_ROW_DATA .':G'. $final)->getFont()->setSize(5);
                #calificacion
                $event->sheet->getDelegate()->getStyle('I'.$this->START_ROW_DATA .':I'. $final)->getFont()->setSize(8);
                #resultado
                $event->sheet->getDelegate()->getStyle('K'.$this->START_ROW_DATA .':K'. $final)->getFont()->setSize(6);

                foreach($this->dataArrayNotas as $dat_row){
                    #$event->sheet->setCellValue('A'.$actual, $dat_row->nro);
                    $event->sheet->getCell(('A'.$actual))
                    ->setValueExplicit(
                        $dat_row->nro,
                        \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC
                    );
                    $event->sheet->setCellValue('B'.$actual, $dat_row->paterno_persona);
                    $event->sheet->setCellValue('C'.$actual, $dat_row->materno_persona);
                    $event->sheet->setCellValue('D'.$actual, $dat_row->nombres_persona);
                    $event->sheet->setCellValue('E'.$actual, $dat_row->ci_persona);
                    $event->sheet->setCellValue('F'.$actual, $dat_row->expedido_persona);
                    $event->sheet->setCellValue('G'.$actual, $dat_row->categoria);
                    $event->sheet->setCellValue('H'.$actual, $dat_row->final_nota);
                    $event->sheet->setCellValue('I'.$actual, $dat_row->calificacion_literal);
                    $event->sheet->getDelegate()->mergeCells('I'. $actual .':J'. $actual);
                    $event->sheet->setCellValue('K'.$actual, $dat_row->observacion_nota);
                    $actual++;
                }

                # ADVERTECIA
                $row_warning = $final+1;
                $event->sheet->setCellValue('A'. $row_warning, $this->DATA_FOOTER_WARNIGN);
                $event->sheet->getDelegate()->getStyle('A'. $row_warning)->getFont()->setSize(8)->setName('Arial')->setBold(false);
                $event->sheet->getDelegate()->mergeCells('A'. $row_warning .':K'. $row_warning);

                # NOTAS DE CALIFICACION Y LUGAR Y FECHA
                $row_notes_and_date = $final+2;
                $event->sheet->setCellValue('A'. $row_notes_and_date, $this->DATA_FOOTER_NOTE_INFO);
                $event->sheet->getDelegate()->getStyle('A'. $row_notes_and_date)->getFont()->setSize(7)->setName('Arial')->setBold(false);
                $event->sheet->getDelegate()->mergeCells('A'. $row_notes_and_date .':C'. $row_notes_and_date);

                $event->sheet->setCellValue('D'. $row_notes_and_date, $this->DATA_FOOTER_PLACE_DATE. $fecha->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY'));
                $event->sheet->getDelegate()->getStyle('D'. $row_notes_and_date)->getFont()->setSize(11.5)->setName('Arial')->setBold(true);
                $event->sheet->getDelegate()->mergeCells('D'. $row_notes_and_date .':K'. $row_notes_and_date);
                $event->sheet->getDelegate()->getStyle('D'.$row_notes_and_date)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                # CUADRO DE RESUMEN 
                $row_summary_table = $final+4;
                $event->sheet->getDelegate()->getStyle('F'. $row_summary_table. ':I'. ($row_summary_table+4))->getFont()->setSize(8)->setName('Arial')->setBold(false);
                $event->sheet->getDelegate()->getStyle('H'. $row_summary_table. ':I'. ($row_summary_table+4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('F'. $row_summary_table. ':I'. ($row_summary_table+4))
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                    ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF000000'));

                $event->sheet->getDelegate()->getStyle('F'. $row_summary_table. ':I'. $row_summary_table)->getFont()->setBold(true);
                $event->sheet->getDelegate()->mergeCells('F'. $row_summary_table .':G'. $row_summary_table);
                $event->sheet->setCellValue('F'. $row_summary_table, "CUADRO RESUMEN");
                $event->sheet->setCellValue('H'. $row_summary_table, "N°");
                $event->sheet->setCellValue('I'. $row_summary_table, "%");

                $event->sheet->getDelegate()->mergeCells('F'. ($row_summary_table+1) .':G'. ($row_summary_table+1));
                $event->sheet->setCellValue('F'. ($row_summary_table+1), "APROBADOS");
                $event->sheet->setCellValue('H'. ($row_summary_table+1), $this->dataArrayNotas[0]->total_aprobados);
                $event->sheet->setCellValue('I'. ($row_summary_table+1), round(($this->dataArrayNotas[0]->total_aprobados/$this->dataArrayNotas[0]->total_estudiantes)*100, 2) );

                $event->sheet->getDelegate()->mergeCells('F'. ($row_summary_table+2) .':G'. ($row_summary_table+2));
                $event->sheet->setCellValue('F'. ($row_summary_table+2), "REPROBADOS");
                $event->sheet->setCellValue('H'. ($row_summary_table+2), $this->dataArrayNotas[0]->total_reprobados);
                $event->sheet->setCellValue('I'. ($row_summary_table+2), round(($this->dataArrayNotas[0]->total_reprobados/$this->dataArrayNotas[0]->total_estudiantes)*100, 2) );

                $event->sheet->getDelegate()->mergeCells('F'. ($row_summary_table+3) .':G'. ($row_summary_table+3));
                $event->sheet->setCellValue('F'. ($row_summary_table+3), "NO SE PRESENTÓ");
                $event->sheet->setCellValue('H'. ($row_summary_table+3), $this->dataArrayNotas[0]->total_no_se_presento);
                $event->sheet->setCellValue('I'. ($row_summary_table+3), round(($this->dataArrayNotas[0]->total_no_se_presento/$this->dataArrayNotas[0]->total_estudiantes)*100, 2) );

                $event->sheet->getDelegate()->mergeCells('F'. ($row_summary_table+4) .':G'. ($row_summary_table+4));
                $event->sheet->getDelegate()->getStyle('F'. ($row_summary_table+4). ':I'. ($row_summary_table+4))->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('F'. ($row_summary_table+4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('F'. ($row_summary_table+4), "TOTAL");
                $event->sheet->setCellValue('H'. ($row_summary_table+4), $this->dataArrayNotas[0]->total_estudiantes);
                $event->sheet->setCellValue('I'. ($row_summary_table+4), round(($this->dataArrayNotas[0]->total_estudiantes/$this->dataArrayNotas[0]->total_estudiantes)*100, 2) );

                $row_career_stamp = $final + 13;
                $row_career_stamp_range = 'J'. $row_career_stamp .':K'. ($row_career_stamp +1);
                $event->sheet->setCellValue('J'. $row_career_stamp, "SELLO\nCARRERA");
                $this->cellFooterStyles($event, $row_career_stamp_range, 7);
                
                $row_career_stamp_two = $final + 17;
                $event->sheet->setCellValue('B'. $row_career_stamp_two, str_pad("",  27, "-"). "\nDOCENTE");
                $this->cellFooterStyles($event, 'B'. $row_career_stamp_two .':C'. ($row_career_stamp_two +1), 9);
                $event->sheet->setCellValue('D'. $row_career_stamp_two, str_pad("",  31, "-"). "\nENC. DEPTO. IDIOMAS");
                $this->cellFooterStyles($event, 'D'. $row_career_stamp_two .':E'. ($row_career_stamp_two +1), 9);
                $event->sheet->setCellValue('G'. $row_career_stamp_two, str_pad("",  25, "-"). "\nDIRECTOR(A)");
                $this->cellFooterStyles($event, 'G'. $row_career_stamp_two .':I'. ($row_career_stamp_two +1), 9);
            },
        ];
    }  

    private function cellFooterStyles($event, $range, $font_size){
        $event->sheet->getDelegate()->getStyle($range)->getAlignment()->setWrapText(true);
        $event->sheet->getDelegate()->getStyle($range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $event->sheet->getDelegate()->getStyle($range)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $event->sheet->getDelegate()->getStyle($range)->getFont()->setSize($font_size)->setName('Arial')->setBold(false);
        $event->sheet->getDelegate()->mergeCells($range);
    }
/* 
    public static function afterSheet(AfterSheet $event)
    {
        return $event->sheet->setCellValue('A2', 'Your Title Here');
    } */
}