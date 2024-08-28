<?php

namespace App\Http\Livewire\AdministracionModulos;

use Livewire\Component;
use \DB;
use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use App\Models\AdministracionModulos\CertificadosProvisional;
use App\Models\AdministracionModulos\SiadiNota;

use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\PDF\PlantillaCertirficadosNotasProvisionalPDF;

class CertificadoProvisionalLotesIndex extends Component
{
    
    public function render()
    {
        $certif = new CertificadosProvisional();
        #$this->emit("Mostrar", "Es". json_encode($certif->get_data_lote_aprobado_agrupar(true)));
        #$this->emit('Mostrar', "Id con", $this->id_convocatoria);
        return view('livewire.administracion-modulos.certificado-provisional-lotes-index',
        [
            'numeros_disponibles' => $this->operation=="guardar_lote"? $certif->get_numeros_disponibles($this->anio_2): [],
            'gestiones' => $this->get_gestiones(), # filtrador
            'periodos' =>  $this->get_periodos(), # filtrador
            'convocatorias' => $this->get_convocatorias(), # filtrador
            'asignaturas' => $this->get_asignaturas_planificadas(), # filtrador
            'asignaturas_all' => ($this->asignatura!=="" && $this->statusAsignatura)? $this->pruebaFuncionNotasAsignatura(true, $this->asignatura): $this->pruebaFuncionNotasAsignatura(true) 
        ]);

    }

    public function mount(){
        
    }


    /* ******************** START RULES *********************** */
    public $operation;

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        # tipo de operacion
        if($this->operation=='guardar_lote'){ # form 2
            return $this->rulesForSaveLote();
        } else if($this->operation == 'imprimir_pdf_lote'){
            return $this->rulesForPrintLote();
        }
        return array_merge( $this->rulesForSaveLote(), $this->rulesForPrintLote());
    }

    protected function rulesForSaveLote(){
        #$this->emit('Mostrar',  "ES sum_max ". $this->sum_nro_dispon_max);
        return [
            'nro_disponible_2' => 'required',
            'inicial_2' => 'required|size:1|alpha|uppercase',
            'anio_2' => 'required',
            'nro_2' => 'required|integer|between:'. $this->nroMin_2 .','. $this->nroMax_2,
            #'sum_nro_dispon_max' => 'required|integer|lte:'. $this->nroMax_2,
        ];
    }
    
    public function cancelarGenLote(){
        $this->emit("closeModalCreateLote");
        $this->reset([
            'nro_disponible_2',
            'inicial_2',
            'nro_2',
            'anio_2',
            # 'sum_nro_dispon_max'
        ]);
        $this->mis_datos = [];
        $this->contador_generar_certificados = 0;
        $this->nro_2 = $this->nroMin_2 = $this->nroMax_2 = "";
        $this->asignaturaPlanificarActual = $this->asignaturaActual = "";
        $this->resetValidation();
    }

    public $fecha_lote;
    protected function rulesForPrintLote(){
        return [
            'fecha_lote' => 'required|date_format:Y-m-d|after_or_equal:2000-09-05|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
        ];
    }

    /* ********************* END RULES ************************ */

     /* ************ INICIO ASIGNACIÓN DE NOMBRES attributes ****************** */
     protected $validationAttributes = [
        # rulesForSaveLote
        'nro_disponible_2' => '"Números Disponibles"',
        'inicial_2' => '"Inicial"',
        'anio_2' => '"Año"',
        'nro_2' => '"Número"',

        # rulesForPrintLote
        'fecha_lote' => '"Fecha de Impresión"',
    ];

    /* ************** FIN ASIGNACIÓN NOMBRES attributes ********************** */




    /* *********************** MODULO DE GENERAR CERTIFICADOS POR LOTES : inicio ********************** */
    public $gestion, $statusGestion;
    public $periodo, $statusPeriodo;
    public $id_convocatoria = "", $statusTipoConvocatoria;
    public $asignatura = "", $statusAsignatura;

    public function on_change_gestion(){
        if($this->gestion==""){
            $this->periodo = $this->id_convocatoria = $this->asignatura = "";
            $this->statusPeriodo = $this->statusTipoConvocatoria = $this->statusAsignatura = false;
        } else {
            $this->statusPeriodo = true;
            $this->periodo = $this->id_convocatoria = $this->asignatura = "";
            $this->statusTipoConvocatoria = $this->statusAsignatura = false;
        }
    }

    public function on_change_periodo(){
        if($this->periodo==""){
            $this->id_convocatoria = $this->asignatura = "";
            $this->statusTipoConvocatoria = $this->statusAsignatura = false;
        } else {
            $this->statusTipoConvocatoria = true;
            $this->asignatura = $this->id_convocatoria = "";
            $this->statusAsignatura = false;
        }
    }

    public function on_change_tipo_convocatoria(){
        if($this->id_convocatoria==""){
            $this->statusAsignatura = false;
        } else {
            $this->statusAsignatura = true;
            //$this->asignatura = $this->id_convocatoria;
        }
        $this->asignatura = "";
    }


    private function get_gestiones(){
        return DB::table('siadi_gestions')
            ->select('nombre_gestion', 'id_gestion')
            ->where('estado_gestion', '<>', 'ELIMINAR')
            ->orderBy('nombre_gestion', 'desc')
            ->get();
    }

    private function get_periodos(){
        return DB::table('siadi_convocatorias')
        ->select('periodo')
        ->where('estado_convocatoria', '<>','ELIMINAR')
        ->where('id_gestion', $this->gestion)
        ->groupBy('periodo')
        ->get();
    }

    private function get_convocatorias(){
        DB::statement("SET SQL_MODE=''");
        return DB::table('siadi_convocatorias')
                ->join('siadi_modalidad_curso', 'siadi_modalidad_curso.id_convocartoria_estudiante', '=', 'siadi_convocatorias.id_modalidad_curso')
                ->join('siadi_costos', 'siadi_costos.id_costo', '=', 'siadi_convocatorias.id_costo') 
                ->join('siadi_sede', 'siadi_sede.id_siadi_sede', '=', 'siadi_convocatorias.id_siadi_sede')
            ->select(
                'id_siadi_convocatoria',
                #'siadi_convocatorias.id_tipo_convocatoria',
                'id_gestion',
                'sede',
                'periodo',
                DB::raw("CONCAT(siadi_modalidad_curso.nombre_convocatoria_estudiante, (
                    CASE 
                        WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 THEN CONCAT(' (', siadi_costos.tipo_costo,')') -- CURSO REGULAR
                        ELSE '' 
                    END
                ), ' .:: ', siadi_sede.direccion) AS convocatoria")
            )
            ->where(function($query){
                $query->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO')
                    ->where('siadi_modalidad_curso.estado_convocatoria_estudiante', '<>', 'ELIMINAR')
                    ->where('siadi_costos.estado_costo', '<>', 'ELIMINAR');
            })
            ->where('id_gestion', $this->gestion)
            ->where('periodo', $this->periodo)
            ->whereNotIn('siadi_modalidad_curso.id_convocartoria_estudiante', [3, 6, 7, 8]) #3,7:CONVALIDACION, 6,8:HOMOLOGACION
            #->groupBy( DB::raw("convocatoria"))
            ->get();
    }

    private function get_asignaturas_planificadas(){
        DB::statement("SET SQL_MODE=''");
        return DB::table('siadi_convocatorias')
            ->join('siadi_modalidad_curso', 'siadi_modalidad_curso.id_convocartoria_estudiante', '=', 'siadi_convocatorias.id_modalidad_curso')
            ->join('siadi_planificar_asignaturas', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
            ->join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
            ->join('siadi_nivel_idiomas', 'siadi_nivel_idiomas.id_nivel_idioma', '=', 'siadi_asignaturas.id_nivel_idioma')
            ->join('siadi_idiomas', 'siadi_idiomas.id_idioma', '=', 'siadi_asignaturas.id_idioma')
        ->select(
            'siadi_asignaturas.id_siadi_asignatura',
            DB::raw("CONCAT(siadi_idiomas.nombre_idioma, ' ', siadi_nivel_idiomas.nombre_nivel_idioma, ' ', siadi_nivel_idiomas.descripcion_nivel_idioma, ' .:: ', COUNT(*), CASE COUNT(*) WHEN 1 THEN ' paralelo' ELSE ' paralelos' END) AS asignatura")
        )
        ->where(function($query){
            $query->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO')
                ->where('siadi_modalidad_curso.estado_convocatoria_estudiante', '<>', 'ELIMINAR')
                ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
                ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
                ->where('siadi_nivel_idiomas.estado_nivel_idioma', '<>', 'ELIMINAR')
                ->where('siadi_idiomas.estado_idioma', '<>', 'ELIMINAR');
        })
        ->where('siadi_convocatorias.id_gestion', $this->gestion)
        ->where('periodo', $this->periodo)
        ->where('siadi_convocatorias.id_siadi_convocatoria', $this->id_convocatoria)
        ->groupBy('siadi_asignaturas.id_siadi_asignatura')
        ->get();
    }

    
    public $certificado_lote = [];
    public function pdf_lote($icd_asignatura, $por_planificar_asignatura = false){
        #$this->emit('Mostrar', "Imprimir lote $icd_asignatura\n, POR_ASIGNATURA: $por_planificar_asignatura, \ngestion: $this->gestion, \nperiodo: $this->periodo ,\nconvo: $this->id_convocatoria");

        $cert = new CertificadosProvisional();
        $certifics = [];
        if($por_planificar_asignatura){
            $certifics = $cert->get_data_certificado_by_planificar_asignatura($this->gestion, $this->periodo, $this->id_convocatoria, $icd_asignatura);
        } else {
            $certifics = $cert->get_data_certificado_by_asignatura($this->gestion, $this->periodo, $this->id_convocatoria, $icd_asignatura);
        }
        #$this->emit("Mostrar", "Son: ". json_encode($certifics));
        
        $this->certificado_lote = [];
        if(count($certifics)>0){
            #$tmpArr = json_encode($certifics);
           
            $this->operation = 'imprimir_pdf_lote';
            $this->fecha_lote = $certifics[0]->fecha;
            foreach($certifics as $datossi){
                $this->certificado_lote[] = get_object_vars($datossi);
            }
            $this->emit("enabledDataTable");
            $this->emit("showModalImprimir");
        } else {
            $this->cancelar_pdf_lote();
            $this->emit("errorvalidate", "No hay datos");
        }
        return;
    }

    public function cancelar_pdf_lote(){
        $this->emit("closeModalImprimir");
        $this->operation = "";
        $this->certificado_lote = [];
        $this->reset([
            'fecha_lote',
        ]);
        $this->resetValidation();
    }

    public function imprimir_pdf_lote(){
        if(count($this->certificado_lote)>0 && $this->operation=="imprimir_pdf_lote"){
        	$this->validate();
            #$this->emit("Mostrar", json_encode($this->certificado_lote));
            $arrayUpdate = [];
		foreach($this->certificado_lote as $cert){
		    if($cert["fecha"]!==$this->fecha_lote){
		        $arrayUpdate[] = $cert["id_certificado_provisional"];
		    }
		}
		if(count($arrayUpdate)>0){
		    try{
		        DB::beginTransaction();
		        #actualizar fecha
		        CertificadosProvisional::whereIn('id_certificado_provisional', $arrayUpdate)->update([ 'fecha_siadi_certificado' => $this->fecha_lote, 'id_usuario' => Auth::user()->id ]);

		        DB::commit();
		    }catch(\Exception $e){
		        DB::rollback();
		        $this->emit("errorvalidate", "Ocurrio un error al actualizar ". $e->getMessage());
		        return;
		    }
		}
            $nombre_archivo = "Certificados Provisional ". $this->certificado_lote[0]["materia"] ." ". str_replace('/', '-',$this->certificado_lote[0]["periodo_gestion"]) .".pdf";
            return response()->streamDownload(function() use ($nombre_archivo) { # use ( $certificados)
                $pdfs = new PlantillaCertirficadosNotasProvisionalPDF(); # 'P', 'mm', array(280, 220)
                $pdfs->SetFecha($this->fecha_lote);
                foreach($this->certificado_lote as $cert){ #$certificados
                    $pdfs->AddPage();
                    
                    $pdfs->SetModalidadCurso($cert['modalidad']);
		    $pdfs->SetCodigo($cert['codigo_certificado_provisional']);
		    $pdfs->SetNombresCompleto($cert['nombres_persona']);
		    $pdfs->SetCIExtGestion($cert['ci'], $cert['periodo_gestion']);
		    $pdfs->SetMateriaNivel($cert['idioma']);
		    $pdfs->setNivelNota($cert['nombre_nivel_idioma'], $cert['final_nota']. "");
                    
                }
                $pdfs->Output();
                $this->cancelar_pdf_lote();
                $this->emit('alert', "Se ha descargado exitósamente: ". $nombre_archivo);
                return; # NOTA: siempre usar return en streamDownload
            }, $nombre_archivo); #certificados
        } else {
            $this->emit("errorvalidate", "Acceso ilegal o no hay datos");
            $this->cancelar_pdf_lote();
        }
    }




    public $asignaturaActual = "", $asignaturaPlanificarActual = "";
    public $inicial_2, $nro_2, $anio_2;
    public $nro_disponible_2, $statusNro_2, $nroMax_2, $nroMin_2; 
    public $mis_datos = [];
    public $contador_generar_certificados;
    public $tipo_guardar = '';
    

    public function mostrar_form_generar_lote($icd_asignatura, $id_planificar_asignatura = false) {
        $this->operation = 'guardar_lote';
        $this->cancelarGenLote();
        $fechaActual = Carbon::now(); 
        $this->anio_2 = $fechaActual->format('Y');
        $this->statusNro_2 = false;
        
        $tmp = $this->pruebaFuncionNotasAsignatura(true, $icd_asignatura); # $this->get_notas_sin_certificado_by_asignatura();

        # eliminar paralelos que no pertenecen
        if($id_planificar_asignatura!==false){
            $encontrado = false;
            foreach($tmp as $paralelosIn){
                if($id_planificar_asignatura == $paralelosIn->id_planificar_asignatura){
                    $tmp = [];
                    $tmp[] = $paralelosIn;
                    $encontrado = true;
                    break;
                }
            }
            if(!$encontrado){
                $tmp = [];
            } else {
                $this->tipo_guardar = "por_paralelos";
                $this->asignaturaActual = $tmp[0]->id_siadi_asignatura;
                $this->asignaturaPlanificarActual = $tmp[0]->id_planificar_asignatura;
            }
                
        } else {
            if(count($tmp)>0){
                $this->tipo_guardar = "por_asignaturas";
                $this->asignaturaActual = $tmp[0]->id_siadi_asignatura;
            }
        }
        
        $this->mis_datos = [];
        if(count($tmp)>0){
            $this->inicial_2 = $tmp[0]->inicial;
            foreach($tmp as $tp){
                $sumaActualSinCertificado = $tp->inscritos_con_nota - $tp->con_certificados;
                $this->mis_datos[] = [
                    "materia" => $tp->materia,
                    "paralelo" => $tp->paralelo,
                    "sin_certificados" => $sumaActualSinCertificado, #$tp->inscritos_sin_cert,
                    "modalidad" => $tp->modalidad,
                    "gestion" => $tp->periodo_gestion
                ];
                $this->contador_generar_certificados += $sumaActualSinCertificado;
            }
            $this->emit("showModalCreateLote");
        }
    }


    /*
    * $agruparParalelos -> false: sin agrupar; true: agrupa por id_planificar_asignatura
    * $solo_asignatura -> 0: mustra todas las asignaturas; caso contrario: se condicionan por id_siadi_asignatura
    * $soloNulos -> false: muestra los que tienen y no tienen certificados; true: solamente los que no generaron certificados
     */
    private function pruebaFuncionNotasAsignatura($agruparParalelos = false, $solo_asignatura = 0, $soloNulos = false){
        $certif = new CertificadosProvisional();
        return $certif->get_data_lote_aprobado_agrupar($agruparParalelos, $solo_asignatura, $soloNulos, $this->gestion, $this->periodo, $this->id_convocatoria);
    }

    public function actualizar_rango_nro_2(){
        if($this->nro_disponible_2==""){
            $this->statusNro_2 = false;
            $this->nro_2 = $this->nroMax_2 = $this->nroMin_2 = "";
        } else {
            $this->resetValidation('nro_2');
            if(count(explode('-', $this->nro_disponible_2))==2){
                $this->nroMin_2 = explode('-', $this->nro_disponible_2)[0];
                # $this->nroMax_2 = explode('-', $this->nro_disponible_2)[1]; 

                $this->nroMax_2 = explode('-', $this->nro_disponible_2)[1] - ($this->contador_generar_certificados - 1);

                $this->nro_2 = $this->nroMin_2;
                $this->statusNro_2 = true;
                if($this->nroMin_2>$this->nroMax_2 && $this->nro_disponible_2!==""){
                    $this->addError('nro_disponible_2', 'Rango de números inválido.');
                }
            } else {
                $this->nro_2 = $this->nroMax_2 = $this->nroMin_2 = $this->nro_disponible_2;
                $this->statusNro_2 = false;
            }
        }
    }

    public function actualiza_anio_2(){
        $this->nro_2 = $this->nroMax_2 = $this->nroMin_2 = "";
        $this->nro_disponible_2 = '';
        $this->statusNro_2 = false;
        if($this->anio_2==''){
            $this->resetValidation('nro_2');
            $this->resetValidation('nroMin_2');
            $this->resetValidation('nroMax_2');
        }
    }

    public function menos(){
        if($this->nroMin_2!=="" || !is_null($this->nroMin_2)){
            if($this->nro_2<$this->nroMin_2){
                $this->nro_2 = $this->nroMin_2;
            } else if($this->nro_2 > $this->nroMax_2){
                $this->nro_2 = $this->nroMax_2;
            }else if($this->nro_2 > $this->nroMin_2){
                $this->nro_2--;
            }
            #$this->actualiza_value_sum();
            $this->resetValidation('nro_2');
        }
    }

    public function mas(){
        if($this->nroMax_2!=="" || !is_null($this->nroMax_2)){
            if($this->nro_2 > $this->nroMax_2 ){
                $this->nro_2 = $this->nroMax_2;
            }else if( $this->nro_2 < $this->nroMin_2){
                $this->nro_2 = $this->nroMin_2;
            }else if($this->nro_2 < $this->nroMax_2){
                $this->nro_2++;
            }
            #$this->actualiza_value_sum();
            $this->resetValidation('nro_2');
        }
    }

    public function guardar_certificados_lote(){
        if($this->operation == 'guardar_lote'){
            $this->validate();
            try { 
                DB::beginTransaction();
                $notas_sin_cert = [];
                if($this->tipo_guardar=="por_asignaturas"){
                    $notas_sin_cert = $this->pruebaFuncionNotasAsignatura(false, $this->asignaturaActual, true); # $this->asignaturaActual
                } else if($this->tipo_guardar=="por_paralelos"){
                    $tmpVer = $this->pruebaFuncionNotasAsignatura(false, $this->asignaturaActual, true);
                    # $this->emit('Mostrar', 'POSI '. count($tmpVer));
                    foreach($tmpVer as $asignActual){
                        if($asignActual->id_planificar_asignatura==$this->asignaturaPlanificarActual){
                            $notas_sin_cert[] = $asignActual;
                        }
                    }
                }
                $contador_notas = 0;
                # $this->emit('Mostrar', $this->tipo_guardar ." ($this->asignaturaPlanificarActual) ". count($notas_sin_cert));
                $limite = $this->nro_2 + $this->contador_generar_certificados - 1;
                $fecha = Carbon::now();
                for($ic=$this->nro_2; $ic<=$limite; $ic++){ # $this->sum_nro_dispon_max
                    #$this->emit('Mostrar', 'Procesa .. '. $ic. ' n.. '. $notas_sin_cert[$contador_notas]->id_nota);
                    $certificado_prov = new CertificadosProvisional();
                    $certificado_prov->id_nota = $notas_sin_cert[$contador_notas]->id_nota;
                    $certificado_prov->gestion = $this->anio_2;
                    $certificado_prov->numero_siadi_certificado_prov = str_pad($ic, 4, "0",  STR_PAD_LEFT);
                    $certificado_prov->tipo_curso = $this->inicial_2. "-"; 
                    $certificado_prov->fecha_siadi_certificado = $fecha->format('Y-m-d');
                    $certificado_prov->id_usuario = Auth::user()->id;
                    $certificado_prov->estado_siadi_certificado_provisional = 'ACTIVO';
                    $certificado_prov->save();

                    $contador_notas++;
                }
                $this->emit('alert', 'Certificados Provisionales  generados satisfactoriamente');
                DB::commit();
                $this->cancelarGenLote();
                return;
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            $this->cancelarGenLote();
        }
        
    }

    
    /* ******************************************* MODULO DE GENERAR CERTIFICADOS POR LOTES :  fin  ******************************** */


}
