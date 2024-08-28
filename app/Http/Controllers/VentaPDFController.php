<?php

namespace App\Http\Controllers;

use App\Models\Modulos\Cirugias;
use Illuminate\Http\Request;

use App\PDF\VentaPDF;
use App\PDF\AtendidosPDF;
use App\PDF\historialespPDF;
use App\PDF\CostosTotalesPDF;
use App\Models\Modulos\Ventas;
use App\Models\Modulos\Compras;
use App\Models\Modulos\ComprasProductos;
use App\Models\Modulos\Fichas;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\VentasProductos;
use App\Models\Modulos\HistorialesPsados;
use App\Models\Modulos\Vacunas;
use App\Models\User;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\farmaciasVentas;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Internacion;
use App\Models\Modulos\Tratamiento_historial_clinico;

class VentaPDFController extends Controller
{

    protected $pdf;
    public $data;
    public $registrovc;
    public function generarPDFVentas($id,$es)
    {

        if($es==1)
        {
            $this->registrovc = Compras::find($id);
            $data = ComprasProductos::where('id_compra', $id)->get();
        }else
        {
            $this->registrovc = Ventas::find($id);
            $data = VentasProductos::where('id_venta', $id)->get();
        }
        
        if (!$this->registrovc) {
            abort(404, 'Registro no encontrado');
        }
        $this->pdf = new VentaPDF($id, $this->registrovc, $data,$es);

        $this->pdf->AliasNbPages();
        $this->pdf->generarReporte( $this->registrovc,$es);
    }
    public function generarPDFAnteciones($f1, $f2, $id_u)
    {
        if ($f1 == 0 && $f2 == 0) {
            $this->data = Fichas::where('id_usuario', $id_u)
                ->where('estado', 'atendido')
                ->get();
               // ->toArray();
           // dd($data);
        } else {
            $this->data = Fichas::where('id_usuario', $id_u)
                ->where('estado', 'atendido')
                ->whereDate('created_at', '>=', $f1)
                ->whereDate('created_at', '<=', $f2)
                ->get();
               // ->toArray();
                // dd($data);
        }

        $registro = User::find($id_u);

        if (!$registro) {
            abort(404, 'Registro no encontrado');
        }
        $this->pdf = new AtendidosPDF($id_u,$registro,$this->data);
        $this->pdf->AliasNbPages();
        $this->pdf->generarReporte($registro);
    }

    public function generarPDFHistoriap($f1)
    {
        $this->data = HistorialesPsados::where('id_mascota', $f1)
                ->where('estado', 'activo')
                ->get();
        $this->pdf = new historialespPDF($f1,$this->data);

      //  $this->pdf->AliasNbPages();
        $this->pdf->generarReporte();
        $this->pdf->AddPage();
    }
  ///---------------------------------------------------  costos totales mascotas ---------------------------------
    public $dataciru, $datavacu,$dataconsu,$datarecon,$dataestu,$datadespa,$datafarma,$datainter;
    public function generarPDFCostosGeneral($f1, $f2, $id_m)
    {
        if ($f1 == 0 && $f2 == 0) {

            $this->dataconsu = Historias_clinico::where('mascota_id',  $id_m)->where('tipo_historial_id', 1)->where('estado', 'activo')->get();
            $this->datarecon =  Historias_clinico::where('mascota_id', $id_m)->where('tipo_historial_id', 10)->where('estado', 'activo')->get();
            $this->dataestu = Historias_clinico::where('mascota_id', $id_m)->where('estudio_complementario_id', '<>', null)->where('estado', 'activo')->get();
            $this->dataciru = Cirugias::where('id_mascota', $id_m)->where('estado', 'activo') ->get();
            $this->datavacu = Vacunas::where('mascota_id', $id_m)->where('estado', 'ACTIVO') ->get();
            $this->datadespa = Desparacitaciones::where('mascota_id', $id_m)->where('estado', 'ACTIVO')->get();
            $this->datafarma = farmaciasVentas::where('mascota_id', $id_m)->where('estado', 'activo')->get();
            $this->datainter = Internacion::where('mascota_id', $id_m)->where('estado', 'activo')->get();
        } else {
            $this->dataconsu = Historias_clinico::where('mascota_id',  $id_m)->where('tipo_historial_id', 1)->where('estado', 'activo')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->datarecon = Historias_clinico::where('mascota_id', $id_m)->where('tipo_historial_id', 10)->where('estado', 'activo')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->dataestu = Historias_clinico::where('mascota_id', $id_m)->where('estudio_complementario_id', '<>', null)->where('estado', 'activo')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->dataciru = Cirugias::where('id_mascota', $id_m)->where('estado', 'activo')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->datavacu = Vacunas::where('mascota_id', $id_m)->where('estado', 'ACTIVO')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->datadespa = Desparacitaciones::where('mascota_id', $id_m)->where('estado', 'ACTIVO')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->datafarma = farmaciasVentas::where('mascota_id', $id_m)->where('estado', 'activo')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
            $this->datainter = Internacion::where('mascota_id', $id_m)->where('estado', 'activo')
            ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
        }

        //$registro = User::find($id_m);
        $registro = Mascotas::find($id_m);
        if (!$registro) {
            abort(404, 'Registro no encontrado');
        }
        $this->pdf = new CostosTotalesPDF($registro,
        $this->dataconsu,$this->datarecon,$this->dataestu,$this->dataciru,
        $this->datavacu,$this->datadespa,$this->datafarma,$this->datainter);

        $this->pdf->AliasNbPages();
        $this->pdf->generarReporte($registro);
    }
    ///---------------------------------------------------  costos totales mascotas idividual ---------------------------------
    public $dataciru2, $datavacu2,$dataconsu2,$datarecon2,$dataestu2,$datadespa2,$datafarma2,$datainter2;
    public function generarPDFCostosIndividual($f1, $f2, $id_m,$es)
    {
            if ($f1 == 0 && $f2 == 0) {
                if($es==1){
                    $this->dataconsu2 = Historias_clinico::where('mascota_id',  $id_m)->where('tipo_historial_id', 1)->where('estado', 'activo')->get();
                }elseif($es==2)
                {
                    $this->datarecon2 =  Historias_clinico::where('mascota_id', $id_m)->where('tipo_historial_id', 10)->where('estado', 'activo')->get();
                }elseif($es==3)
                {
                    $this->dataestu2 = Historias_clinico::where('mascota_id', $id_m)->where('estudio_complementario_id', '<>', null)->where('estado', 'activo')->get();
                }elseif($es==4)
                {
                    $this->dataciru2 = Cirugias::where('id_mascota', $id_m)->where('estado', 'activo') ->get();
                }elseif($es==5)
                {
                    $this->datavacu2 = Vacunas::where('mascota_id', $id_m)->where('estado', 'ACTIVO') ->get();
                }elseif($es==6)
                {
                    $this->datadespa2 = Desparacitaciones::where('mascota_id', $id_m)->where('estado', 'ACTIVO')->get();
                }elseif($es==7)
                {
                    $this->datafarma2 = farmaciasVentas::where('mascota_id', $id_m)->where('estado', 'activo')->get();
                }
                else
                {
                    $this->datainter2 = Internacion::where('mascota_id', $id_m)->where('estado', 'activo')->get();
                }
            } else {

                    if($es==1){
                        $this->dataconsu2 = Historias_clinico::where('mascota_id',  $id_m)->where('tipo_historial_id', 1)->where('estado', 'activo')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();}
                    elseif($es==2)
                    {
                        $this->datarecon2 = Historias_clinico::where('mascota_id', $id_m)->where('tipo_historial_id', 10)->where('estado', 'activo')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    } elseif($es==3)
                    {
                        $this->dataestu2 = Historias_clinico::where('mascota_id', $id_m)->where('estudio_complementario_id', '<>', null)->where('estado', 'activo')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    } elseif($es==4)
                    {
                        $this->dataciru2 = Cirugias::where('id_mascota', $id_m)->where('estado', 'activo')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    }elseif($es==5)
                    {
                        $this->datavacu2 = Vacunas::where('mascota_id', $id_m)->where('estado', 'ACTIVO')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    }
                    elseif($es==6)
                    {
                        $this->datadespa2 = Desparacitaciones::where('mascota_id', $id_m)->where('estado', 'ACTIVO')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    } elseif($es==7)
                    {
                        $this->datafarma2 = farmaciasVentas::where('mascota_id', $id_m)->where('estado', 'activo')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    } 
                     else
                    {
                        $this->datainter2 = Internacion::where('mascota_id', $id_m)->where('estado', 'activo')
                        ->whereDate('created_at', '>=', $f1)->whereDate('created_at', '<=', $f2)->get();
                    }
               
            }
            $registro = Mascotas::find($id_m);
            if (!$registro) {
                abort(404, 'Registro no encontrado');
            }
        $this->pdf = new CostosTotalesPDF($registro,
        $this->dataconsu2,$this->datarecon2,$this->dataestu2,$this->dataciru2,
        $this->datavacu2,$this->datadespa2,$this->datafarma2,$this->datainter2);
        $this->pdf->AliasNbPages();
        $this->pdf->generarReporte($registro);
    }

    public $dataciru3, $datavacu3,$dataconsu3,$datarecon3,$dataestu3,$datadespa3,$datafarma3,$datainter3;
  
    public function generarPDFCostosunregistro($id_m,$id,$es)
    {
        
                if($es==1){
                    $this->dataconsu3 = Historias_clinico::where('mascota_id',  $id_m)->where('id', $id)->where('tipo_historial_id', 1)->where('estado', 'activo')->get();
                    
                }elseif($es==2)
                {
                    $this->datarecon3 =  Historias_clinico::where('mascota_id', $id_m)->where('id', $id)->where('tipo_historial_id', 10)->where('estado', 'activo')->get();
                }elseif($es==3)
                {
                    $this->dataestu3 = Historias_clinico::where('mascota_id', $id_m)->where('id', $id)->where('estudio_complementario_id', '<>', null)->where('estado', 'activo')->get();
                }elseif($es==4)
                {
                    $this->dataciru3 = Cirugias::where('id_mascota', $id_m)->where('id', $id)->where('estado', 'activo') ->get();
                }elseif($es==5)
                {
                    $this->datavacu3 = Vacunas::where('mascota_id', $id_m)->where('id', $id)->where('estado', 'ACTIVO') ->get();
                }elseif($es==6)
                {
                    $this->datadespa3 = Desparacitaciones::where('mascota_id', $id_m)->where('id', $id)->where('estado', 'ACTIVO')->get();
                }elseif($es==7)
                {
                    $this->datafarma3 = farmaciasVentas::where('mascota_id', $id_m)->where('id', $id)->where('estado', 'ACTIVO')->get();
                }
                else
                {
                    $this->datainter3 = Internacion::where('mascota_id', $id_m)->where('id', $id)->where('estado', 'ACTIVO')->get();
                }
            $registro = Mascotas::find($id_m);
            if (!$registro) {
                abort(404, 'Registro no encontrado');
            }
        $this->pdf = new CostosTotalesPDF($registro,
        $this->dataconsu3,$this->datarecon3,$this->dataestu3,$this->dataciru3,
        $this->datavacu3,$this->datadespa3,$this->datafarma3,$this->datainter3);

        $this->pdf->AliasNbPages();
        $this->pdf->generarReporte($registro);
    }
    
}
