<?php

namespace App\PDF;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Internacion;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\Vacunas;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class ReporteDerivacion extends FPDF
{
    // Variable para almacenar el número de registro
    // private $numero_registro;
    // private $fecha;
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (FPDF)
        // $this->numero_registro = $numero_registro;
        // $this->fecha = $fecha;
    }
    // Método para generar el encabezado
    public function Header()
    {
        $this->SetTopMargin(18);
        $this->SetLeftMargin(10);
        $this->SetAutoPageBreak(1, 20);
        $this->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");


        $this->Image(public_path("") . '/logo_nuevo.png', 15, 8, 55, 55);


        $this->SetTextColor(0, 80, 0);
        $this->SetFont('EdwardianScriptITC', '', 38);
        $this->Cell(0, 15, utf8_decode('DOG CENTER'), 0, 1, 'C');
        $this->Ln(10); // Salto de línea
    }
    private function GetCliente($id)
    {
        return Clientes::find($id);
    }
    private function GetMascota($id)
    {
        return Mascotas::find($id);
    }
    private function GetHistoriales($id)
    {
        return
            Historias_clinico::where('mascota_id', $id)->where('estado', '<>', 'eliminado')->whereIn('tipo_historial_id', [1, 10])
            ->orderBy('created_at', 'asc')
            ->get();
    }
    private function GetEstudios($id)
    {
        return  Historias_clinico::where('mascota_id', $id)->where('estado', '<>', 'eliminado')->whereIn('tipo_historial_id', [2])
            ->orderBy('created_at', 'asc')
            ->get();
    }
    private function GetCirugias($id)
    {
        return Cirugias::where('id_mascota', $id)->where('estado', '<>', 'eliminado')->orderBy('created_at', 'asc')->get();
    }
    private function GetVacunas($id)
    {
        return Vacunas::where('mascota_id', $id)->where('estado', '<>', 'eliminado')->orderBy('created_at', 'asc')->get();
    }
    private function GetDesparacitaciones($id)
    {
        return Desparacitaciones::where('mascota_id', $id)->where('estado', '<>', 'eliminado')->orderBy('created_at', 'asc')->get();
    }
    private function GetInternaciones($id)
    {
        return Internacion::where('mascota_id', $id)->where('estado', '<>', 'eliminado')->orderBy('created_at', 'asc')->get();
    }
    public function formatDateToLiteral($date)
    {
        // Definir los nombres de los meses en español
        $months = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];

        // Parsear la fecha
        $date = Carbon::parse($date);

        // Formatear la fecha con el mes en inglés
        $formattedDate = $date->format('d F Y');

        // Reemplazar el mes en inglés por el mes en español
        foreach ($months as $english => $spanish) {
            $formattedDate = str_replace($english, $spanish, $formattedDate);
        }

        return $formattedDate;
    }
    // Método para generar el reporte
    public function generarReporte($id)
    {

        $mascota = $this->GetMascota($id);

        $cliente = $this->GetCliente($mascota->cliente_id);
        $historiales = $this->GetHistoriales($id);
        $estudios = $this->GetEstudios($id);
        $cirugias = $this->GetCirugias($id);
        $vacunas = $this->GetVacunas($id);
        $desparacitaciones = $this->GetDesparacitaciones($id);
        $internaciones = $this->GetInternaciones($id);
        $this->AliasNbPages();
        $this->AddPage(); //añade l apagina / en blanco
        $this->SetMargins(10, 10, 10);
        $this->SetAutoPageBreak(true, 20); //salto de pagina automatico
        $this->SetX(15);
        $this->SetFont('Helvetica', 'B', 15);
        $this->SetTextColor(0, 80, 0);
  
        $this->Ln(20);
        $this->setX(15);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(45, 8, utf8_decode(' PROPIETARIO:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(45, 8, utf8_decode($cliente->nombre . ' ' . $cliente->apellidos), 1, 0, 'C', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(45, 8, utf8_decode(' TELF/CEL: '), 1, 0, 'C', 0);

        $this->SetFont('Arial', '', 8);
        $this->Cell(45, 8, utf8_decode($cliente->telefono), 1, 1, 'C', 0);
        $this->setX(15);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(45, 8, utf8_decode(' DOMICILIO:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(135, 8, utf8_decode($cliente->domicilio), 1, 1, 'C', 0);
        $this->SetFont('Arial', 'B', 8);

        $this->Ln(10);

        $this->setX(15);
        $this->SetFillColor(0, 108, 0);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(65, 7, utf8_decode(''), 0, 0, 'C', 0);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(55, 7, utf8_decode(' R E S E Ñ A'), 0, 0, 'C', true);
        $this->Ln(0.6);
        $this->setX(15);
        $this->SetTextColor(0, 80, 0);
        $this->Ln(10);
        $this->setX(15);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(22.5, 8, utf8_decode(' ESPECIE:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(22.5, 8, utf8_decode($mascota->mascotas_especies->nombre), 1, 0, 'C', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(22.5, 8, utf8_decode(' RAZA:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(22.5, 8, utf8_decode($mascota->mascotas_razas->nombre), 1, 0, 'C', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(22.5, 8, utf8_decode(' SEXO:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(22.5, 8, utf8_decode($mascota->sexo), 1, 0, 'C', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(22.5, 8, utf8_decode(' PESO: '), 1, 0, 'C', 0);

        $this->SetFont('Arial', '', 8);
        $this->Cell(22.5, 8, utf8_decode($mascota->peso), 1, 1, 'C', 0);

        $this->setX(15);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(34, 8, utf8_decode('  NOMBRE DEL ANIMAL:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(34, 8, utf8_decode($mascota->nombre), 1, 0, 'C', 0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(28, 8, utf8_decode(' COLOR:'), 1, 0, 'C', 0);
        $this->SetFont('Arial', '', 8);
        $this->Cell(28, 8, utf8_decode($mascota->mascotas_colores->nombre), 1, 0, 'C', 0);

        $this->SetFont('Arial', 'B', 8);
        $this->Cell(28, 8, utf8_decode(' EDAD: '), 1, 0, 'C', 0);

        $this->SetFont('Arial', '', 8);
        $this->Cell(28, 8, utf8_decode($mascota->edad_mascota), 1, 1, 'C', 0);

        foreach ($historiales as $key => $historial) {
            $this->Ln(20);
            $this->setX(15);
            $this->SetFillColor(16, 128, 206);
            $this->SetTextColor(255, 255, 255);

            $fecha = $this->formatDateToLiteral($historial->created_at);
            if ($historial->tipo_historial_id == 1) {
                $nombreHistorial = 'CONSULTA';
            } else {
                $nombreHistorial = 'RECONSULTA';
            }



            $this->SetFont('Arial', 'B', 12);
            $this->Cell(60, 7, utf8_decode(''), 0, 0, 'C', 0);
            $this->Cell(70, 7, utf8_decode($nombreHistorial . ' - ' . $fecha), 0, 0, 'C', true);

            $this->setX(18);
            $this->SetFillColor(75, 242, 95);
            $this->SetTextColor(0, 0, 0);


            $this->Ln(10);
            $this->SetFont('Arial', 'B', 8);
            $this->setX(15);
            $this->Cell(180, 8, utf8_decode('MOTIVO DE ATENCIÓN'), 1, 1, 'C', 0);
            $this->setX(15);

            $this->SetFont('Arial', '', 8);
            $this->MultiCell(180, 8, utf8_decode($historial->motivo_atencion), 1, 'C',  0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode('ANAMENSIS'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFillColor(240, 240, 240);
            $this->SetFont('Arial', '', 8);
            $this->MultiCell(180, 8, utf8_decode($historial->anamensis), 1, 'C',  0);

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, utf8_decode('TLLC'), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode('ACTITUD'), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode('CONDUCTA'), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode('ESTADO NUTRICIONAL'), 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(45, 8, utf8_decode($historial->tllc), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->actitud), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->conducta), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->esta_nutricional), 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'MM', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'Constante vital FC', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'Constante vital FR', 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode('Constante vital T°'), 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(45, 8, utf8_decode($historial->mm), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->const_v_fc), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->const_v_fr), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->const_v_t), 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'PAST', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'PAD', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'PAM', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'PULSO', 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(45, 8, utf8_decode($historial->Past), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->Pad), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->Pam), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->Pulso), 1, 1, 'C', 0);


            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'DHT', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'PESO', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'Capa de piel', 1, 0, 'C', 0);
            $this->Cell(45, 8, '', 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(45, 8, utf8_decode($historial->Dht), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->Peso), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($historial->capa_piel), 1, 0, 'C', 0);
            $this->Cell(45, 8, '', 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode('RECOMENDACIONES'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFillColor(240, 240, 240);
            $this->SetFont('Arial', '', 8);
            $this->MultiCell(180, 8, utf8_decode($historial->recomendacion), 1, 'C',  0);

            if (count($historial->historial_tratamientos) > 0) {

                $this->Ln(10);
                $this->setX(15);
                $this->SetFillColor(16, 128, 206);
                $this->SetTextColor(255, 255, 255);
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(65, 7, utf8_decode(''), 0, 0, 'C', 0);
                $this->Cell(55, 7, utf8_decode('TRATAMIENTOS'), 0, 0, 'C', true);

                $this->setX(18);
                $this->SetFillColor(75, 242, 95);
                $this->SetTextColor(0, 0, 0);
                $this->Ln(10);

                foreach ($historial->historial_tratamientos as $key => $tratamientos) {

                    if (count($tratamientos->tratamiento_comentarios) > 0) {

                        $this->SetFont('Arial', 'B', 8);
                        $this->setX(15);
                        $this->Cell(180, 8, utf8_decode('COMENTARIOS -'), 1, 1, 'C', 0);
                    }

                    foreach ($tratamientos->tratamiento_comentarios as $key => $comentario) {
                        $this->setX(15);

                        $this->SetFont('Arial', '', 8);
                        $this->MultiCell(180, 8, utf8_decode($comentario->comentario), 1, 'C',  0);
                    }
                    if (count($tratamientos->tratamiento_medicamentos) > 0) {

                        $this->SetFont('Arial', 'B', 8);
                        $this->setX(15);
                        $this->Cell(180, 8, utf8_decode('MEDICAMENTOS ADMINISTRADOS -'), 1, 1, 'C', 0);
                        $this->setX(15);
                        $this->SetFont('Arial', 'B', 8);
                        $this->Cell(45, 8, 'MEDICAMENTO', 1, 0, 'C', 0);
                        // $this->Cell(36, 8, 'DOSIS EN MG', 1, 0, 'C', 0);
                        $this->Cell(45, 8, 'DOSIS', 1, 0, 'C', 0);
                        $this->Cell(45, 8, 'VIA', 1, 0, 'C', 0);
                        $this->Cell(45, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
                    }



                    foreach ($tratamientos->tratamiento_medicamentos as $key => $medicamento) {


                        $this->setX(15);
                        $this->SetFont('Arial', '', 8);
                        $this->Cell(45, 8, utf8_decode($medicamento->Medicamento), 1, 0, 'C', 0);
                        $this->Cell(45, 8, utf8_decode($medicamento->dosis_ml . ' ' . $medicamento->dosis_ml), 1, 0, 'C', 0);
                        // $this->Cell(45, 8, $medicamento->dosis_ml, 1, 0, 'C', 0);
                        $this->Cell(45, 8, utf8_decode($medicamento->via), 1, 0, 'C', 0);
                        $this->Cell(45, 8, utf8_decode($medicamento->administrado), 1, 1, 'C', 0);
                    }
                }
            }
        }


        if (count($vacunas) > 0) {
            $this->Ln(10);
            $this->setX(15);
            $this->SetFillColor(16, 128, 206);
            $this->SetTextColor(255, 255, 255);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(65, 7, utf8_decode(''), 0, 0, 'C', 0);
            $this->Cell(55, 7, utf8_decode('VACUNAS'), 0, 0, 'C', true);
            $this->Ln(10);
            $this->setX(18);
            $this->SetFillColor(75, 242, 95);
            $this->SetTextColor(0, 0, 0);



            $this->SetFont('Arial', 'B', 8);
            $this->setX(15);
            $this->Cell(180, 8, utf8_decode('CONTROL DE VACUNAS'), 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(60, 8, 'FECHA', 1, 0, 'C', 0);
            $this->Cell(60, 8, 'EDAD', 1, 0, 'C', 0);
            $this->Cell(60, 8, 'VACUNA APLICADA', 1, 1, 'C', 0);
        }




        foreach ($vacunas as $key => $vacuna) {
            $this->setX(15);
            $this->SetFont('Arial', '', 8);
            $fechavacuna = $this->formatDateToLiteral($vacuna->fecha);
            $this->Cell(60, 8, utf8_decode($fechavacuna), 1, 0, 'C', 0);
            $this->Cell(60, 8, utf8_decode($vacuna->edad), 1, 0, 'C', 0);
            $this->Cell(60, 8, utf8_decode($vacuna->vacuna_aplicada), 1, 1, 'C', 0);
        }


        if (count($desparacitaciones) > 0) {
            $this->Ln(10);
            $this->setX(15);
            $this->SetFillColor(16, 128, 206);
            $this->SetTextColor(255, 255, 255);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(65, 7, utf8_decode(''), 0, 0, 'C', 0);
            $this->Cell(55, 7, utf8_decode('DESPARACITACIONES'), 0, 0, 'C', true);
            $this->Ln(10);
            $this->setX(18);
            $this->SetFillColor(75, 242, 95);
            $this->SetTextColor(0, 0, 0);



            $this->SetFont('Arial', 'B', 8);
            $this->setX(15);
            $this->Cell(180, 8, utf8_decode('CONTROL DE DESPARACITACIONES'), 1, 1, 'C', 0);

            $this->setX(15);
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'FECHA', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'EDAD', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'PESO', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'PRODUCTO APLICADO', 1, 1, 'C', 0);
        }

        foreach ($desparacitaciones as $key => $despa) {
            $this->setX(15);
            $this->SetFont('Arial', '', 8);
            $fechades = $this->formatDateToLiteral($despa->fecha);
            $this->Cell(45, 8, utf8_decode($fechades), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($despa->edad), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($despa->peso), 1, 0, 'C', 0);
            $this->Cell(45, 8, utf8_decode($despa->id_producto2), 1, 1, 'C', 0);
        }

        if (count($internaciones) > 0) {

            $this->Ln(10);
            $this->setX(15);
            $this->SetFillColor(16, 128, 206);
            $this->SetTextColor(255, 255, 255);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(65, 7, utf8_decode(''), 0, 0, 'C', 0);
            $this->Cell(55, 7, utf8_decode('INTERNACIÓNES'), 0, 0, 'C', true);

            $this->Ln(10);
            $this->SetFillColor(75, 242, 95);
            $this->SetTextColor(0, 0, 0);

            $this->SetFont('Arial', 'B', 8);
        }


        foreach ($internaciones as $key => $internacion) {

            if (count($internacion->internacion_comentarios) > 0) {
                $this->setX(15);
                $fechaint = $this->formatDateToLiteral($internacion->created_at);
                $this->Cell(180, 8, utf8_decode('INTERNACIÓN - ' . $fechaint), 1, 1, 'C', 0);
                $this->setX(15);
                $this->Cell(180, 8, utf8_decode('COMENTARIOS DE INTERNACIÓN -'), 1, 1, 'C', 0);
            }


            foreach ($internacion->internacion_comentarios as $key => $comentarioint) {
                $this->setX(15);

                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($comentarioint->comentario), 1, 'C',  0);
            }

            if (count($internacion->internacion_medicamentos) > 0) {

                $this->SetFont('Arial', 'B', 8);
                $this->setX(15);
                $this->Cell(180, 8, utf8_decode('MEDICAMENTOS ADMINISTRADOS -'), 1, 1, 'C', 0);

                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(36, 8, 'MEDICAMENTO', 1, 0, 'C', 0);
                $this->Cell(36, 8, 'DOSIS EN MG', 1, 0, 'C', 0);
                $this->Cell(36, 8, 'DISIS EB ML', 1, 0, 'C', 0);
                $this->Cell(36, 8, 'VIA', 1, 0, 'C', 0);
                $this->Cell(36, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            }


            foreach ($internacion->internacion_medicamentos as $key => $medicamentoint) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(36, 8, utf8_decode($medicamentoint->Medicamento), 1, 0, 'C', 0);
                $this->Cell(36, 8, utf8_decode($medicamentoint->dosis_mg), 1, 0, 'C', 0);
                $this->Cell(36, 8, utf8_decode($medicamentoint->dosis_ml), 1, 0, 'C', 0);
                $this->Cell(36, 8, utf8_decode($medicamentoint->via), 1, 0, 'C', 0);
                $this->Cell(36, 8, utf8_decode($medicamentoint->administrado), 1, 1, 'C', 0);
            }
        }

        if (count($cirugias) > 0) {

            $this->Ln(10);
            $this->setX(15);
            $this->SetFillColor(16, 128, 206);
            $this->SetTextColor(255, 255, 255);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(65, 7, utf8_decode(''), 0, 0, 'C', 0);
            $this->Cell(55, 7, utf8_decode('CIRUGIAS'), 0, 0, 'C', true);

            $this->SetFillColor(75, 242, 95);
            $this->SetTextColor(0, 0, 0);

            $this->SetFont('Arial', 'B', 8);
            $this->Ln(10);
        }

        foreach ($cirugias as $key => $cirugia) {
            $this->setX(15);
            $fechacir = $this->formatDateToLiteral($cirugia->created_at);
            $this->Cell(180, 8, utf8_decode('CIRUGIA - ' . $cirugia->asa . ' - ' . $fechacir), 1, 1, 'C', 0);
            $this->setX(15);

            $this->SetFont('Arial', '', 8);
            $this->MultiCell(180, 8, utf8_decode($cirugia->descripcion), 1, 'C',  0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode(' PRE-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->Cell(180, 8, utf8_decode('DATOS GENERALES DE LA CIRUGIA / PRE-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(25.7, 8, 'HORA', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'FC', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'FR', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'T', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'MM', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'TLLC', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'SOPO2', 1, 1, 'C', 0);
            // $this->Cell(25.7, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            foreach ($cirugia->cirugia_datos1 as $key => $dato1) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(25.7, 8, utf8_decode($dato1->hora), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato1->FC), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato1->FR), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato1->Tem), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato1->MM), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato1->TLLC), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato1->sopo2), 1, 1, 'C', 0);

                // $this->MultiCell(180, 8, $dato1->comentario, 1, 'C',  0);
                // $this->Cell(25.7, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            }

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode('DATOS PRE-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'HORA', 1, 0, 'C', 0);

            $this->Cell(45, 8, 'MG', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'ML', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'VIA', 1, 1, 'C', 0);
            foreach ($cirugia->cirugia_pres1 as $key => $pres1) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(45, 8, utf8_decode($pres1->hora), 1, 0, 'C', 0);

                $this->Cell(45, 8, utf8_decode($pres1->mg), 1, 0, 'C', 0);
                $this->Cell(45, 8, utf8_decode($pres1->ml), 1, 0, 'C', 0);
                $this->Cell(45, 8, utf8_decode($pres1->via), 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(180, 8, 'DETALLE', 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($pres1->detalle), 1, 'C',  0);
                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(180, 8, 'OBSERVACIONES', 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($pres1->observaciones), 1, 'C',  0);
            }
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode(' TRANS-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->Cell(180, 8, utf8_decode('DATOS GENERALES DE LA CIRUGIA / TRANS-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(25.7, 8, 'HORA', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'FC', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'FR', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'T', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'MM', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'TLLC', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'SOPO2', 1, 1, 'C', 0);
            // $this->Cell(25.7, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            foreach ($cirugia->cirugia_datos2 as $key => $dato2) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(25.7, 8, utf8_decode($dato2->hora), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato2->FC), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato2->FR), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato2->Tem), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato2->MM), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato2->TLLC), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato2->sopo2), 1, 1, 'C', 0);

                // $this->MultiCell(180, 8, $dato1->comentario, 1, 'C',  0);
                // $this->Cell(25.7, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            }

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode('DATOS TRANS-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'HORA', 1, 0, 'C', 0);

            $this->Cell(45, 8, 'MG', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'ML', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'VIA', 1, 1, 'C', 0);
            foreach ($cirugia->cirugia_pre2 as $key => $pres2) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(45, 8, utf8_decode($pres2->hora), 1, 0, 'C', 0);

                $this->Cell(45, 8, utf8_decode($pres2->mg), 1, 0, 'C', 0);
                $this->Cell(45, 8, utf8_decode($pres2->ml), 1, 0, 'C', 0);
                $this->Cell(45, 8, utf8_decode($pres2->via), 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(180, 8, 'DETALLE', 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($pres2->detalle), 1, 'C',  0);
                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(180, 8, 'OBSERVACIONES', 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($pres2->observaciones), 1, 'C',  0);
            }
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode(' POST-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->Cell(180, 8, utf8_decode('DATOS GENERALES DE LA CIRUGIA / POST-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(25.7, 8, 'HORA', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'FC', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'FR', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'T', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'MM', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'TLLC', 1, 0, 'C', 0);
            $this->Cell(25.7, 8, 'SOPO2', 1, 1, 'C', 0);
            // $this->Cell(25.7, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            foreach ($cirugia->cirugia_datos3 as $key => $dato3) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(25.7, 8, utf8_decode($dato3->hora), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato3->FC), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato3->FR), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato3->Tem), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato3->MM), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato3->TLLC), 1, 0, 'C', 0);
                $this->Cell(25.7, 8, utf8_decode($dato3->sopo2), 1, 1, 'C', 0);

                // $this->MultiCell(180, 8, $dato1->comentario, 1, 'C',  0);
                // $this->Cell(25.7, 8, 'ADMINISTRADO', 1, 1, 'C', 0);
            }

            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(180, 8, utf8_decode('DATOS POST-OPERATORIO'), 1, 1, 'C', 0);
            $this->setX(15);
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(45, 8, 'HORA', 1, 0, 'C', 0);

            $this->Cell(45, 8, 'MG', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'ML', 1, 0, 'C', 0);
            $this->Cell(45, 8, 'VIA', 1, 1, 'C', 0);
            foreach ($cirugia->cirugia_pre3 as $key => $pres3) {
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->Cell(45, 8, utf8_decode($pres3->hora), 1, 0, 'C', 0);

                $this->Cell(45, 8, utf8_decode($pres3->mg), 1, 0, 'C', 0);
                $this->Cell(45, 8, utf8_decode($pres3->ml), 1, 0, 'C', 0);
                $this->Cell(45, 8, utf8_decode($pres3->via), 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(180, 8, 'DETALLE', 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($pres3->detalle), 1, 'C',  0);
                $this->setX(15);
                $this->SetFont('Arial', 'B', 8);
                $this->Cell(180, 8, 'OBSERVACIONES', 1, 1, 'C', 0);
                $this->setX(15);
                $this->SetFont('Arial', '', 8);
                $this->MultiCell(180, 8, utf8_decode($pres3->observaciones), 1, 'C',  0);
            }
        }

        foreach ($estudios as $key => $est) {
            $showCarousel = true;
            foreach ($est->fotosestudio as $imagen) {
                if (str_ends_with($imagen->imagen, '.pdf')) {
                    
                    $showCarousel = false;
                    break;
                }
            }

            if ($showCarousel) {
             
               foreach ($est->fotosestudio as $key => $imagen) {
                $archivo_verificar = $imagen->imagen;
                if (strpos($archivo_verificar, 'estudio_complementario') !== false) {
                    $apostrofe = url('/'). "/storage/estudio_complementario/";
                    $resto = str_replace($apostrofe, '', $archivo_verificar);
                    $url_imagen = public_path( $imagen->imagen);
                    // $pdf->AddPage();
                    // $ancho_pagina = $pdf->getPageWidth();
                    // $alto_pagina = $pdf->getPageHeight();
                    // $pdf->Image($url_imagen, 0, 0, $ancho_pagina, $alto_pagina);
                    $this->AddPage();
                            $this->Ln(10);
                            $this->setX(15);
                    
                            $this->SetFillColor(16, 128, 206);
                            $this->SetTextColor(255, 255, 255);
                            $this->SetFont('Arial', 'B', 12);
                            $this->Cell(45, 7, utf8_decode(''), 0, 0, 'C', 0);
                            $this->Cell(75, 7, utf8_decode('ESTUDIO COMPLEMENTARIO'), 0, 0, 'C', true);
                            $this->Ln(5);
                            $this->setX(15);
                    
                            $this->SetFillColor(16, 128, 206);
                            $this->SetTextColor(255, 255, 255);
                            $this->SetFont('Arial', 'B', 12);
                            $this->Cell(35, 7, utf8_decode(''), 0, 0, 'C', 0);
                            $this->Cell(105, 7, utf8_decode($est->historial_estudio->nombre . ' ' . $est->created_at), 0, 0, 'C', true);
                            $ancho_pagina = $this->getPageWidth();
                            $alto_pagina = $this->getPageHeight() - 50;
                    
                            $this->Image($url_imagen, 0, 80, $ancho_pagina, $alto_pagina);
                } else {
                    $apostrofe = url('/')."/storage/imagenes_capturadas/";
                    $resto = str_replace($apostrofe, '', $archivo_verificar);
                    $url_imagen = public_path($imagen->imagen);
                    // $pdf->AddPage();
                    // $ancho_pagina = $pdf->getPageWidth();
                    // $alto_pagina = $pdf->getPageHeight();
                    // $pdf->Image($url_imagen, 0, 0, $ancho_pagina, $alto_pagina);
                    $this->AddPage();
                            $this->Ln(10);
                            $this->setX(15);
                    
                            $this->SetFillColor(16, 128, 206);
                            $this->SetTextColor(255, 255, 255);
                            $this->SetFont('Arial', 'B', 12);
                            $this->Cell(45, 7, utf8_decode(''), 0, 0, 'C', 0);
                            $this->Cell(75, 7, utf8_decode('ESTUDIO COMPLEMENTARIO'), 0, 0, 'C', true);
                            $this->Ln(5);
                            $this->setX(15);
                    
                            $this->SetFillColor(16, 128, 206);
                            $this->SetTextColor(255, 255, 255);
                            $this->SetFont('Arial', 'B', 12);
                            $this->Cell(35, 7, utf8_decode(''), 0, 0, 'C', 0);
                            $this->Cell(105, 7, utf8_decode($est->historial_estudio->nombre . ' ' . $est->created_at), 0, 0, 'C', true);
                            $ancho_pagina = $this->getPageWidth();
                            $alto_pagina = $this->getPageHeight() - 50;
                    
                            $this->Image($url_imagen, 0, 80, $ancho_pagina, $alto_pagina);
                }
             
               }
            //    $pdf->Output();
            }

        }

        // foreach ($estudios as $key => $est) {

           
        //     $archivo_verificar = $est->imagen_pdf_estudio_complementario;
        //     if (strpos($archivo_verificar, 'estudio_complementario') !== false) {
        //         $apostrofe = url('/') . "/storage/estudio_complementario/";
        //         $resto = str_replace($apostrofe, '', $archivo_verificar);
        //         $url_imagen = storage_path('app/public/estudio_complementario/' . $resto);
        //     } else {
        //         $apostrofe = url('/') . "/storage/imagenes_capturadas/";
        //         $resto = str_replace($apostrofe, '', $archivo_verificar);
        //         $url_imagen = storage_path('app/public/imagenes_capturadas/' . $resto);
        //     }
        
        //     // Verificar que el archivo sea una imagen
        //     $mime_type = mime_content_type($url_imagen);
        //     if (strpos($mime_type, 'image/') === 0) {
        //         $this->AddPage();
        //         $this->Ln(10);
        //         $this->setX(15);
        
        //         $this->SetFillColor(16, 128, 206);
        //         $this->SetTextColor(255, 255, 255);
        //         $this->SetFont('Arial', 'B', 12);
        //         $this->Cell(45, 7, utf8_decode(''), 0, 0, 'C', 0);
        //         $this->Cell(75, 7, utf8_decode('ESTUDIO COMPLEMENTARIO'), 0, 0, 'C', true);
        //         $this->Ln(5);
        //         $this->setX(15);
        
        //         $this->SetFillColor(16, 128, 206);
        //         $this->SetTextColor(255, 255, 255);
        //         $this->SetFont('Arial', 'B', 12);
        //         $this->Cell(35, 7, utf8_decode(''), 0, 0, 'C', 0);
        //         $this->Cell(105, 7, utf8_decode($est->historial_estudio->nombre . ' ' . $est->created_at), 0, 0, 'C', true);
        //         $ancho_pagina = $this->getPageWidth();
        //         $alto_pagina = $this->getPageHeight() - 50;
        
        //         $this->Image($url_imagen, 0, 80, $ancho_pagina, $alto_pagina);
        //     } 
        // }
        

        // $pdfPath = public_path('nuevo_reporte.pdf');
        // $this->Output('F', $pdfPath);
         $this->Output();
    }
    public function Footer()
    {
        $this->SetFont('Arial', '', 8);
        // $this->SetXY(140, 71);
        // $this->Cell(45, 7, 'FECHA DE EMISION', 'T', 0, 'C');

        // Posicionar a 15 mm de la parte inferior
        $this->SetY(-15);

        // Establecer fuente
        $this->SetFont('Arial', 'I', 8);

        // Número de página
        $this->Cell(0, 10, 'Pagina. ' . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}
