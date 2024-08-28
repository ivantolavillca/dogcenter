<?php

namespace App\PDF;

use App\Models\Modulos\ComentariosTratamiento;
use App\Models\Modulos\MedicamentosTratamiento;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Modulos\Tratamiento_historial_clinico;

class CostosTotalesPDF extends FPDF
{
    // Variable para almacenar el número de registro

    private $registro;
    protected $dataconsu, $datarecon, $dataestu, $dataciru, $datavacu, $datadespa, $datafarma, $datainter;

    public function __construct($registro, $dataconsu, $datarecon, $dataestu, $dataciru, $datavacu, $datadespa, $datafarma, $datainter)
    {
        // parent::__construct(); // Llama al constructor de la clase padre (Fthis)
        parent::__construct('P', 'mm', 'Letter', true, 'UTF-8', false);
        $this->AddPage();
        $this->registro = $registro;

        $this->dataconsu = $dataconsu;
        $this->datarecon = $datarecon;
        $this->dataestu = $dataestu;
        $this->dataciru = $dataciru;
        $this->datavacu = $datavacu;
        $this->datadespa = $datadespa;
        $this->datafarma = $datafarma;
        $this->datainter = $datainter;
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
        $this->Ln(10);
    }
    public $tratamientos, $totalDinerot;
    public function consultas_tramiento($id)
    {
        $this->tratamientos = Tratamiento_historial_clinico::where('historial_id', $id)->get();
        return $this->tratamientos;
    }

    public function consultasprecio_tramiento($id)
    {
        $this->totalDinerot = Tratamiento_historial_clinico::where('historial_id', $id)->sum('precio');
        return $this->totalDinerot;
    }

    public function generarReporte($registro)
    {


        $this->SetFont('Arial', '', 8);
        $this->SetXY(20, 30);
        $this->Cell(45, 25, 'CLIENTE:', 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(32, 30);
        if ($this->registro->id) {
            $this->Cell(60, 25, utf8_decode($this->registro->mascot_clie->nombre . " " . $this->registro->mascot_clie->apellidos), 0, 0, 'R');
        } else {
            $this->Cell(60, 25, utf8_decode($this->registro->id), 0, 0, 'R');
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
        $this->Cell(45, 50, 'MASCOTA:', 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(42, 30);
        $this->Cell(45, 48, utf8_decode($this->registro->nombre), 0, 0, 'R');


        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 50, '...................................................................................................................... ', 0, 0, 'R');

        $this->SetFillColor(0, 22, 53); // Establecer color de fondo azul petróleo
        $this->SetTextColor(0, 255, 0); // Establecer color de texto verde fosforescente
        $this->SetFont('Arial', '', 10);
        $this->SetXY(75, 60);
        $this->Cell(65, 7, utf8_decode('MASCOTA Nº: ' . $this->registro->id), 1, 0, 'C', true);
        $this->SetTextColor(0, 0, 0); // Restablecer color de texto a negro
        $this->Ln(15);


        //-----------------------------------------------------------------------------  consultas ---------------------------
        $costo1 = 0;
        $costototal = 0;
        $costototalmedicamento = 0;
        if ($this->dataconsu) {
            if (count($this->dataconsu) != 0) {

                $i = 1;
                foreach ($this->dataconsu as $elem) {

                    $this->SetFont('Arial', 'B', 12);
                    $this->Cell(0, 10, 'Reporte de Consutlas', 0, 1, 'C');
                    $this->SetFillColor(0, 22, 53);
                    $this->SetTextColor(0, 255, 0);
                    // Encabezados de las columnas
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                    $this->Cell(70, 7, 'Doctor', 1, 0, 'L', true);
                    $this->Cell(40, 7, 'Id de Consulta', 1, 0, 'C', true);
                    $this->Cell(40, 7, 'Fecha', 1, 0, 'C', true);
                    $this->Cell(33, 7, 'Precio', 1, 1, 'C', true);
                    $this->SetFillColor(255, 255, 255);
                    $this->SetTextColor(0);

                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(70, 8, utf8_decode($elem->historial_user->name), 1, 0, 'L', true);
                    $this->Cell(40, 8, "Consulta N: " . $elem->id, 1, 0, 'C');
                    $this->Cell(40, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->precio, 1, 1, 'C');
                    $this->MultiCell(160, 5, utf8_decode("Anamensis.- ") . utf8_decode($elem->anamensis), 1, 'B');
                    $this->MultiCell(160, 5, utf8_decode("Motivo de consulta.- " . $elem->motivo_atencion), 1);

                    if ($this->consultas_tramiento($elem->id) && count($this->consultas_tramiento($elem->id)) > 0) {
                        $j = 1;

                        foreach ($this->consultas_tramiento($elem->id) as $elem2) {
                            // Encabezados de las columnas
                            $this->SetFont('Arial', 'B', 10);
                            $this->Cell(0, 10, 'Tratamientos en consultas', 0, 1, 'C');
                            $this->SetFillColor(0, 22, 53);
                            $this->SetTextColor(0, 255, 0);
                            // Encabezados de las columnas
                            $this->SetFont('Arial', 'B', 10);
                            $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                            $this->Cell(70, 7, 'Doctor', 1, 0, 'L', true);
                            $this->Cell(46, 7, 'N: de tratamiento ', 1, 0, 'C', true);
                            $this->Cell(67, 7, 'Fecha', 1, 1, 'C', true);
                            $this->SetFillColor(255, 255, 255);
                            $this->SetTextColor(0);

                            $this->SetFont('Arial', '', 8);
                            $this->Cell(10, 8, $j++, 1, 0, 'C');
                            $this->Cell(70, 8, utf8_decode($elem2->tratamiento_doctor->name), 1, 0, 'L', true);
                            $this->Cell(46, 8, "N: " . $elem2->id, 1, 0, 'C');
                            $this->Cell(67, 8, $elem2->created_at, 1, 1, 'C');

                            if ($elem2->tratamiento_comentarios != null && count($elem2->tratamiento_comentarios) != 0) {
                                $this->SetFont('Arial', 'B', 10);
                                $this->Cell(0, 8, 'Comentarios en el Tratamiento', 0, 1, 'C');
                                $k = 1;
                                foreach ($elem2->tratamiento_comentarios as $elem3) {
                                    $this->SetFont('Arial', '', 8);
                                    $this->MultiCell(193, 7, utf8_decode("Comentario N: " . $k++ . ".- " . $elem3->comentario), 1);
                                }
                            }
                            if ($elem2->tratamiento_medicamentos != null && count($elem2->tratamiento_medicamentos) != 0) {
                                $this->SetFont('Arial', 'B', 10);
                                $this->Cell(0, 8, 'Medicamentos en el Tratamiento', 0, 1, 'C');
                                // Encabezados de las columnas
                                $this->SetFont('Arial', 'B', 8);
                                $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                                $this->Cell(52, 7, 'Doctor', 1, 0, 'L', true);
                                $this->Cell(30, 7, 'Medicamento', 1, 0, 'C', true);
                                $this->Cell(13, 7, 'ml', 1, 0, 'C', true);
                                $this->Cell(13, 7, 'mg', 1, 0, 'C', true);
                                $this->Cell(30, 7, 'comprimido', 1, 0, 'C', true);
                                $this->Cell(20, 7, 'Via', 1, 0, 'C', true);
                                $this->Cell(25, 7, 'Administrado', 1, 1, 'C', true);
                                $k = 1;
                                $ctMedi = 0;
                                foreach ($elem2->tratamiento_medicamentos as $elem3) {
                                    $ctMedi = $elem3->precio;
                                    $this->SetFont('Arial', '', 8);
                                    $this->Cell(10, 7, $k++, 1, 0, 'C', true);
                                    $this->Cell(52, 7, utf8_decode($elem3->user->name), 1, 0, 'L', true);
                                    $this->Cell(30, 7, utf8_decode($elem3->Medicamento), 1, 0, 'C', true);
                                    $this->Cell(13, 7, utf8_decode($elem3->dosis_mg), 1, 0, 'C', true);
                                    $this->Cell(13, 7, utf8_decode($elem3->dosis_ml), 1, 0, 'C', true);
                                    $this->Cell(30, 7, utf8_decode($elem3->comprimido), true);
                                    $this->Cell(20, 7, utf8_decode($elem3->via), true);
                                    $this->Cell(25, 7, utf8_decode($elem3->administrado), 1, 1, 'C', true);
                                }
                                $costototalmedicamento = $costototalmedicamento + $ctMedi;
                                $this->Ln(2);
                                $this->Cell(130, 7, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                                $this->Cell(30, 7, 'SUBTOTAL', 1, 0, 'C');
                                $this->Cell(33, 7, ($ctMedi) . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
                                $this->Ln(5);
                            }
                        }
                    }
                    $costo1 += $elem->precio;
                }
                $costototal = $costototalmedicamento + $costo1;
            }
        }
        //-----------------------------------------------------------------------------  reconsultas ----------------------------------------------------------
        $costo2 = 0;
        $costototal2 = 0;
        $costototalmedicamento2 = 0;
        if ($this->datarecon) {
            if (count($this->datarecon) != 0) {
                $i = 1;
                foreach ($this->datarecon as $elem) {
                    $this->SetFont('Arial', 'B', 12);
                    $this->Cell(0, 10, 'Reporte de Reconsultas', 0, 1, 'C');
                    $this->SetFillColor(0, 22, 53);
                    $this->SetTextColor(0, 255, 0);
                    // Encabezados de las columnas
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                    $this->Cell(70, 7, 'Doctor', 1, 0, 'L', true);
                    $this->Cell(40, 7, 'Id de Consulta', 1, 0, 'C', true);
                    $this->Cell(40, 7, 'Fecha', 1, 0, 'C', true);
                    $this->Cell(33, 7, 'Precio', 1, 1, 'C', true);
                    $this->SetFillColor(255, 255, 255);
                    $this->SetTextColor(0);

                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(70, 8, utf8_decode($elem->historial_user->name), 1, 0, 'L', true);
                    $this->Cell(40, 8, "Consulta N: " . $elem->id, 1, 0, 'C');
                    $this->Cell(40, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->precio, 1, 1, 'C');
                    $this->MultiCell(160, 5, utf8_decode("Anamensis.- ") . utf8_decode($elem->anamensis), 1, 'B');
                    $this->MultiCell(160, 5, utf8_decode("Motivo de consulta.- " . $elem->motivo_atencion), 1);

                    if ($this->consultas_tramiento($elem->id) && count($this->consultas_tramiento($elem->id)) > 0) {
                        $j = 1;

                        foreach ($this->consultas_tramiento($elem->id) as $elem2) {
                            // Encabezados de las columnas
                            $this->SetFont('Arial', 'B', 10);
                            $this->Cell(0, 10, 'Tratamientos en reconsultas', 0, 1, 'C');
                            $this->SetFillColor(0, 22, 53);
                            $this->SetTextColor(0, 255, 0);
                            // Encabezados de las columnas
                            $this->SetFont('Arial', 'B', 8);
                            $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                            $this->Cell(70, 7, 'Doctor', 1, 0, 'L', true);
                            $this->Cell(46, 7, 'N: de tratamiento ', 1, 0, 'C', true);
                            $this->Cell(67, 7, 'Fecha', 1, 1, 'C', true);
                            $this->SetFillColor(255, 255, 255);
                            $this->SetTextColor(0);

                            $this->SetFont('Arial', '', 8);
                            $this->Cell(10, 8, $j++, 1, 0, 'C');
                            $this->Cell(70, 8, utf8_decode($elem2->tratamiento_doctor->name), 1, 0, 'L', true);
                            $this->Cell(46, 8, "N: " . $elem2->id, 1, 0, 'C');
                            $this->Cell(67, 8, $elem2->created_at, 1, 1, 'C');

                            if ($elem2->tratamiento_comentarios != null && count($elem2->tratamiento_comentarios) != 0) {
                                $this->SetFont('Arial', 'B', 10);
                                $this->Cell(0, 8, 'Comentarios en el Tratamiento', 0, 1, 'C');
                                $k = 1;
                                foreach ($elem2->tratamiento_comentarios as $elem3) {
                                    $this->SetFont('Arial', '', 8);
                                    $this->MultiCell(193, 7, utf8_decode("Comentario N: " . $k++ . ".- " . $elem3->comentario), 1);
                                }
                            }
                            if ($elem2->tratamiento_medicamentos != null && count($elem2->tratamiento_medicamentos) != 0) {
                                $this->SetFont('Arial', 'B', 8);
                                $this->Cell(0, 8, 'Medicamentos en el Tratamiento', 0, 1, 'C');
                                // Encabezados de las columnas
                                $this->SetFont('Arial', 'B', 8);
                                $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                                $this->Cell(52, 7, 'Doctor', 1, 0, 'L', true);
                                $this->Cell(30, 7, 'Medicamento', 1, 0, 'C', true);
                                $this->Cell(13, 7, 'ml', 1, 0, 'C', true);
                                $this->Cell(13, 7, 'mg', 1, 0, 'C', true);
                                $this->Cell(30, 7, 'comprimido', 1, 0, 'C', true);
                                $this->Cell(20, 7, 'Via', 1, 0, 'C', true);
                                $this->Cell(25, 7, 'Administrado', 1, 1, 'C', true);
                                $k = 1;
                                $ctMedi = 0;
                                foreach ($elem2->tratamiento_medicamentos as $elem3) {
                                    $ctMedi = $elem3->precio;
                                    $this->SetFont('Arial', '', 8);
                                    $this->Cell(10, 7, $k++, 1, 0, 'C', true);
                                    $this->Cell(52, 7, utf8_decode($elem3->user->name), 1, 0, 'L', true);
                                    $this->Cell(30, 7, utf8_decode($elem3->Medicamento), 1, 0, 'C', true);
                                    $this->Cell(13, 7, utf8_decode($elem3->dosis_mg), 1, 0, 'C', true);
                                    $this->Cell(13, 7, utf8_decode($elem3->dosis_ml), 1, 0, 'C', true);
                                    $this->Cell(30, 7, utf8_decode($elem3->comprimido), true);
                                    $this->Cell(20, 7, utf8_decode($elem3->via), true);
                                    $this->Cell(25, 7, utf8_decode($elem3->administrado), 1, 1, 'C', true);
                                }
                                $costototalmedicamento2 = $costototalmedicamento2 + $ctMedi;
                                $this->Ln(2);
                                $this->Cell(130, 7, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                                $this->Cell(30, 7, 'SUBTOTAL', 1, 0, 'C');
                                $this->Cell(33, 7, ($ctMedi) . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
                                $this->Ln(5);
                            }
                        }
                    }
                    $costo2 += $elem->precio;
                }
                $costototal2 = $costototalmedicamento2 + $costo2;
            }
        }
        //-----------------------------------------------------------------------------  estudios complemenrtarios 
        $costo3 = 0;
        if ($this->dataestu) {
            if (count($this->dataestu) != 0) {

                $this->SetFont('Arial', 'B', 10);
                $this->Cell(0, 10, 'Reporte de datos de Estudios Complementarios', 0, 1, 'C');

                $this->SetFillColor(0, 22, 53);
                $this->SetTextColor(0, 255, 0);
                // Encabezados de las columnas
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(10, 8, 'N', 1, 0, 'C', true);
                $this->Cell(70, 8, 'Descripcion', 1, 0, 'L', true);
                $this->Cell(40, 8, 'Doctor', 1, 0, 'C', true);
                $this->Cell(40, 8, 'Fecha', 1, 0, 'C', true);
                $this->Cell(33, 8, 'Precio', 1, 1, 'C', true);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $i = 1;
                foreach ($this->dataestu as $elem) {
                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(70, 8, utf8_decode($elem->historial_estudio->nombre), 1, 0, 'C');
                    $this->Cell(40, 8, utf8_decode($elem->historial_user->name), 1, 0, 'C');
                    $this->Cell(40, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->precio, 1, 1, 'C');
                    $costo3 += $elem->precio;
                }
                $this->Ln(3);
                $this->Cell(130, 8, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 8, 'SUBTOTAL', 1, 0, 'C');
                $this->Cell(33, 8, $costo3 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
                $this->Ln(5);
            }
        }
        //-----------------------------------------------------------------------------  tablas  de cirugias ------------------------------
        $costo4 = 0;
        if ($this->dataciru) {
            if (count($this->dataciru) != 0) {

                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Reporte de datos de Cirugias', 0, 1, 'C');

                $this->SetFillColor(0, 22, 53);
                $this->SetTextColor(0, 255, 0);
                // Encabezados de las columnas
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(10, 8, 'N', 1, 0, 'C', true);
                $this->Cell(70, 8, 'Cirujano', 1, 0, 'L', true);
                $this->Cell(40, 8, 'Asa', 1, 0, 'C', true);
                $this->Cell(40, 8, 'Fecha', 1, 0, 'C', true);
                $this->Cell(33, 8, 'Precio', 1, 1, 'C', true);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $i = 1;

                foreach ($this->dataciru as $elem) {
                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(70, 8, utf8_decode($elem->cirugia_usuario->name), 1, 0, 'C');
                    $this->Cell(40, 8, $elem->asa, 1, 0, 'C');
                    $this->Cell(40, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->total, 1, 1, 'C');
                    $this->MultiCell(160, 7, utf8_decode("DESCRIPCION.- " . $elem->descripcion), 1);

                    $costo4 += $elem->total;
                }
                $this->Ln(3);
                $this->Cell(130, 10, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 10, 'SUBTOTAL', 1, 0, 'C');
                $this->Cell(33, 10, $costo4 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
                $this->Ln(15);
            }
        }
        //------------------------------ Vacunas------------------------------------------------------------
        $costo5 = 0;
        if ($this->datavacu) {
            if (count($this->datavacu) != 0) {

                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Reporte de datos de Vacunas', 0, 1, 'C');

                $this->SetFillColor(0, 22, 53);
                $this->SetTextColor(0, 255, 0);
                // Encabezados de las columnas
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(10, 8, 'N', 1, 0, 'C', true);
                $this->Cell(45, 8, 'Doctor', 1, 0, 'L', true);
                $this->Cell(37, 8, 'Descripcion', 1, 0, 'L', true);
                $this->Cell(37, 8, 'Proxima Fecha', 1, 0, 'C', true);
                $this->Cell(31, 8, 'Fecha', 1, 0, 'C', true);
                $this->Cell(33, 8, 'Precio', 1, 1, 'C', true);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $i = 1;

                foreach ($this->datavacu as $elem) {
                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(45, 8, utf8_decode($elem->vacuna_veterinario->name), 1, 0, 'C');
                    $this->Cell(37, 8, utf8_decode($elem->vacuna_aplicada), 1, 0, 'C');
                    $this->Cell(37, 8, $elem->proxima_fecha, 1, 0, 'C');
                    $this->Cell(31, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->precio, 1, 1, 'C');
                    $costo5 += $elem->precio;
                }
                $this->Ln(3);
                $this->Cell(130, 7, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 7, 'SUBTOTAL', 1, 0, 'C');
                $this->Cell(33, 7, $costo5 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila

            }
        }
        //------------------------------ Desparacitaciones------------------------------------------------------------
        $costo6 = 0;
        if ($this->datadespa) {
            if (count($this->datadespa) != 0) {
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Reporte de datos de Desparasitaciones', 0, 1, 'C');

                $this->SetFillColor(0, 22, 53);
                $this->SetTextColor(0, 255, 0);
                // Encabezados de las columnas
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(10, 8, 'N', 1, 0, 'C', true);
                $this->Cell(45, 8, 'Doctor', 1, 0, 'L', true);
                $this->Cell(37, 8, 'Descripcion', 1, 0, 'L', true);
                $this->Cell(37, 8, 'Proxima Fecha', 1, 0, 'C', true);
                $this->Cell(31, 8, 'Fecha', 1, 0, 'C', true);
                $this->Cell(33, 8, 'Precio', 1, 1, 'C', true);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $i = 1;
                foreach ($this->datadespa as $elem) {
                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(45, 8, utf8_decode($elem->desparacitaciones_veterinario->name), 1, 0, 'C');
                    $this->Cell(37, 8, utf8_decode($elem->id_producto2), 1, 0, 'C');
                    $this->Cell(37, 8, $elem->proxima_fecha, 1, 0, 'C');
                    $this->Cell(31, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->precio, 1, 1, 'C');
                    $costo6 += $elem->precio;
                }
                $this->Ln(3);
                $this->Cell(130, 7, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 7, 'SUBTOTAL', 1, 0, 'C');
                $this->Cell(33, 7, $costo6 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila

            }
        }
        //------------------------------ Farmacias ------------------------------------------------------------
        $costo7 = 0;
        if ($this->datafarma) {
            if (count($this->datafarma) != 0) {
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Reporte de datos de Farmacias', 0, 1, 'C');

                $this->SetFillColor(0, 22, 53);
                $this->SetTextColor(0, 255, 0);
                // Encabezados de las columnas
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(10, 8, 'N', 1, 0, 'C', true);
                $this->Cell(45, 8, 'Doctor', 1, 0, 'L', true);
                $this->Cell(30, 8, 'Producto', 1, 0, 'L', true);
                $this->Cell(18, 8, 'Unidad', 1, 0, 'C', true);
                $this->Cell(27, 8, 'Cnatidad', 1, 0, 'C', true);
                $this->Cell(30, 8, 'Precio', 1, 0, 'C', true);
                $this->Cell(33, 8, 'Subtotal', 1, 1, 'C', true);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $i = 1;
                foreach ($this->datafarma as $elem) {
                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C', true);
                    $this->Cell(45, 8, utf8_decode($elem->farmacia_doctor->name), 1, 0, 'L', true);
                    $this->Cell(30, 8, utf8_decode($elem->productos_famaciaven->nombre), 1, 0, 'L', true);
                    $this->Cell(18, 8, utf8_decode($elem->unidad), 1, 0, 'C', true);
                    $this->Cell(27, 8, utf8_decode(round($elem->cantidad, 0)), 1, 0, 'C', true);
                    $this->Cell(30, 8, utf8_decode(round($elem->precio, 3)), 1, 0, 'C', true);
                    $this->Cell(33, 8, utf8_decode(round($elem->cantidad, 0) * round($elem->precio, 2)), 1, 1, 'C', true);
                    $costo7 += ($elem->cantidad * $elem->precio);
                }
                $this->Ln(3);
                $this->Cell(130, 7, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 7, 'SUBTOTAL', 1, 0, 'C');
                $this->Cell(33, 7, $costo7 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila

            }
        }
        //-----------------------------------------------------------------------------  tablas  de internaciones ------------------------------
        $costo8 = 0;
        if ($this->datainter) {
            if (count($this->datainter) != 0) {

                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Reporte de datos de Internaciones', 0, 1, 'C');
                $i = 1;
                foreach ($this->datainter as $elem) {

                    $this->SetFillColor(0, 22, 53);
                    $this->SetTextColor(0, 255, 0);
                    // Encabezados de las columnas
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell(10, 8, 'N', 1, 0, 'C', true);
                    $this->Cell(70, 8, 'Doctor', 1, 0, 'L', true);
                    $this->Cell(40, 8, utf8_decode('Nº de Internacion'), 1, 0, 'C', true);
                    $this->Cell(40, 8, 'Fecha', 1, 0, 'C', true);
                    $this->Cell(33, 8, 'Precio', 1, 1, 'C', true);
                    $this->SetFillColor(255, 255, 255);
                    $this->SetTextColor(0);

                    $this->SetFont('Arial', '', 8);
                    $this->Cell(10, 8, $i++, 1, 0, 'C');
                    $this->Cell(70, 8, utf8_decode($elem->intenacion_usuario->name), 1, 0, 'C');
                    $this->Cell(40, 8, $elem->id, 1, 0, 'C');
                    $this->Cell(40, 8, $elem->created_at, 1, 0, 'C');
                    $this->Cell(33, 8, $elem->precio, 1, 1, 'C');


                    if ($elem->internacion_comentarios != null && count($elem->internacion_comentarios) != 0) {
                        $this->SetFont('Arial', 'B', 10);
                        $this->Cell(0, 8, 'Comentarios en la internacion', 0, 1, 'C');
                        $k = 1;
                        foreach ($elem->internacion_comentarios as $elem3) {
                            $this->SetFont('Arial', '', 8);
                            $this->MultiCell(193, 7, utf8_decode("Comentario N: " . $k++ . ".- " . $elem3->comentario), 1);
                        }
                    }
                    if ($elem->internacion_medicamentos != null && count($elem->internacion_medicamentos) != 0) {
                        $this->SetFont('Arial', 'B', 10);
                        $this->Cell(0, 8, 'Medicamentos en la internacion', 0, 1, 'C');
                        // Encabezados de las columnas
                        $this->SetFont('Arial', 'B', 8);
                        $this->Cell(10, 7, 'N', 1, 0, 'C', true);
                        $this->Cell(52, 7, 'Doctor', 1, 0, 'L', true);
                        $this->Cell(30, 7, 'Medicamento', 1, 0, 'C', true);
                        $this->Cell(13, 7, 'ml', 1, 0, 'C', true);
                        $this->Cell(13, 7, 'mg', 1, 0, 'C', true);
                        $this->Cell(30, 7, 'comprimido', 1, 0, 'C', true);
                        $this->Cell(20, 7, 'Via', 1, 0, 'C', true);
                        $this->Cell(25, 7, 'Administrado', 1, 1, 'C', true);
                        $k = 1;
                        foreach ($elem->internacion_medicamentos as $elem3) {
                            $ctMedi = $elem3->precio;
                            $this->SetFont('Arial', '', 8);
                            $this->Cell(10, 7, $k++, 1, 0, 'C', true);
                            $this->Cell(52, 7, utf8_decode($elem3->user->name), 1, 0, 'L', true);
                            $this->Cell(30, 7, utf8_decode($elem3->Medicamento), 1, 0, 'C', true);
                            $this->Cell(13, 7, utf8_decode($elem3->dosis_mg), 1, 0, 'C', true);
                            $this->Cell(13, 7, utf8_decode($elem3->dosis_ml), 1, 0, 'C', true);
                            $this->Cell(30, 7, utf8_decode("---"), true);
                            $this->Cell(20, 7, utf8_decode($elem3->via), true);
                            $this->Cell(25, 7, utf8_decode($elem3->administrado), 1, 1, 'C', true);
                        }
                        $this->Ln(5);
                    }
                    $costo8 += $elem->precio;
                }
                $this->Ln(3);
                $this->Cell(130, 8, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 8, 'SUBTOTAL', 1, 0, 'C');
                $this->Cell(33, 8, $costo8 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
                $this->Ln(10);
            }
        }

        //------------------------------------------------------------------------------------__________________-----------------------------------
        $this->Ln(15);
        $this->Cell(50, 12, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
        $this->Cell(60, 12, 'TOTAL A PAGAR', 1, 0, 'C');
        $this->Cell(45, 12, (($costototal) + ($costototal2) + $costo3 + $costo4 + $costo5 + $costo6 + $costo7 + $costo8) . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
        $this->Ln(15);

        // Salida del PDF
        $this->Output();
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
