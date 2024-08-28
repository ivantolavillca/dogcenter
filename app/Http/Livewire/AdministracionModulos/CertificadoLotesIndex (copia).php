<?php

namespace App\Http\Livewire\AdministracionModulos;

use Livewire\Component;
use \DB;
use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use App\Models\AdministracionModulos\Certificados;
use App\Models\AdministracionModulos\SiadiNota;

use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;

class CertificadoLotesIndex extends Component
{
    
    public function render()
    {
        $certif = new Certificados();
        #$this->emit("Mostrar", "Es". json_encode($certif->get_data_lote_aprobado_agrupar(true)));
        return view('livewire.administracion-modulos.certificado-lotes-index',
        [
            'numeros_disponibles' => $certif->get_numeros_disponibles($this->anio_2), #$this->llenarDisponibles(),
            'gestiones' => $this->get_gestiones(),
            'periodos' =>  $this->get_periodos(),
            'convocatorias' => $this->get_convocatorias(),
            'asignaturas' => $this->get_asignaturas_planificadas(),
            'asignaturas_all' => ($this->asignatura!=="" && $this->statusAsignatura)? $this->pruebaFuncionNotasAsignatura(true, $this->asignatura): $this->pruebaFuncionNotasAsignatura(true) #$this->get_asignaturas_sede_tipo_convocatoria(),
            /* 'asignaturas_all' => ($this->asignatura!=="" && $this->statusAsignatura)
                                    ? $certif->get_data_lote_aprobado_agrupar(true, $this->asignatura, false, $this->gestion, $this->periodo, $this->sede, explode(';',$this->tipo_convocatoria)[0])
                                    : $certif->get_data_lote_aprobado_agrupar(true, 0, false, $this->gestion, $this->periodo, $this->sede, explode(';',$this->tipo_convocatoria)[0]) */
        ]);

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
            'nro_libro_nota' => 'required',
            #'sum_nro_dispon_max' => 'required|integer|lte:'. $this->nroMax_2,
            'fecha_2' => 'required|date_format:Y-m-d|after_or_equal:2000-09-05|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
        ];
    }
    
    public function cancelarGenLote(){
        $this->emit("closeModalCreateLote");
        $this->reset([
            'nro_disponible_2',
            'inicial_2',
            'nro_2',
            'fecha_2',
            'anio_2',
            'nro_libro_nota',
            # 'sum_nro_dispon_max'
        ]);
        $this->mis_datos = [];
        $this->contador_generar_certificados = 0;
        $this->nro_2 = $this->nroMin_2 = $this->nroMax_2 = "";
        $this->asignaturaPlanificarActual = $this->asignaturaActual = "";
        $this->resetValidation();
    }

    protected function rulesForPrintLote(){
        return [
            'formato_lote' => 'required',
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
        'fecha_2' => '"Fecha"',
        'nro_libro_nota' => '"Número de Libro"',

        # rulesForPrintLote
        'fecha_lote' => '"Fecha de Impresión"',
        'formato_lote' => '"Formato de Impresión"',
    ];

    /* ************** FIN ASIGNACIÓN NOMBRES attributes ********************** */




    /* *********************** MODULO DE GENERAR CERTIFICADOS POR LOTES : inicio ********************** */
    public $gestion, $statusGestion;
    public $periodo, $statusPeriodo;
    public $tipo_convocatoria = "", $statusTipoConvocatoria, $sede="";
    public $asignatura = "", $statusAsignatura;

    public function on_change_gestion(){
        if($this->gestion==""){
            $this->periodo = $this->tipo_convocatoria = $this->asignatura = "";
            $this->statusPeriodo = $this->statusTipoConvocatoria = $this->statusAsignatura = false;
        } else {
            $this->statusPeriodo = true;
            $this->periodo = $this->tipo_convocatoria = $this->asignatura = "";
            $this->statusTipoConvocatoria = $this->statusAsignatura = false;
        }
        $this->sede = "";
    }

    public function on_change_periodo(){
        if($this->periodo==""){
            $this->tipo_convocatoria = $this->asignatura = "";
            $this->statusTipoConvocatoria = $this->statusAsignatura = false;
        } else {
            $this->statusTipoConvocatoria = true;
            $this->asignatura = $this->tipo_convocatoria = "";
            $this->statusAsignatura = false;
        }
        $this->sede = "";
    }

    public function on_change_tipo_convocatoria(){
        if($this->tipo_convocatoria==""){
            $this->asignatura = "";
            $this->statusAsignatura = false;
            $this->sede = "";
        } else {
            $this->statusAsignatura = true;
            $this->asignatura = "";
            $this->sede = explode(';', $this->tipo_convocatoria)[1];
        }
    }


    private function get_gestiones(){
        return DB::table('siadi_gestions')
            ->select('nombre_gestion', 'id_gestion')
            ->where('estado_gestion', '=', 'ACTIVO')
            ->get();
    }

    private function get_periodos(){
        return DB::table('siadi_convocatorias')
        ->select('periodo')
        ->where('estado_convocatoria', 'ACTIVO')
        ->where('id_gestion', $this->gestion)
        ->groupBy('periodo')
        ->get();
    }

    private function get_convocatorias(){
        DB::statement("SET SQL_MODE=''");
        return DB::table('siadi_convocatorias')
                ->join('siadi_tipo_convocatorias', 'siadi_convocatorias.id_tipo_convocatoria', '=','siadi_tipo_convocatorias.id_tipo_convocatoria')
                ->join('siadi_convocartoria_estudiantes', 'siadi_tipo_convocatorias.id_convocartoria_estudiante', '=', 'siadi_convocartoria_estudiantes.id_convocartoria_estudiante')
            ->select(
                'id_siadi_convocatoria',
                'siadi_convocatorias.id_tipo_convocatoria',
                'id_gestion',
                'sede',
                'periodo',
                DB::raw("CONCAT(siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante, ' .:: ', siadi_convocatorias.sede) AS convocatoria")
            )
            ->where([
                'siadi_convocatorias.estado_convocatoria' => 'ACTIVO',
                'siadi_tipo_convocatorias.estado_tipo_convocatoria' => 'ACTIVO',
                'siadi_convocartoria_estudiantes.estado_convocatoria_estudiante' => 'ACTIVO',
                ])
            ->where('id_gestion', $this->gestion)
            ->where('periodo', $this->periodo)
            ->groupBy( DB::raw("convocatoria"))
            ->get();
    }

    private function get_asignaturas_planificadas(){
        DB::statement("SET SQL_MODE=''");
        return DB::table('siadi_convocatorias')
            ->join('siadi_tipo_convocatorias', 'siadi_convocatorias.id_tipo_convocatoria', '=','siadi_tipo_convocatorias.id_tipo_convocatoria')
            ->join('siadi_convocartoria_estudiantes', 'siadi_tipo_convocatorias.id_convocartoria_estudiante', '=', 'siadi_convocartoria_estudiantes.id_convocartoria_estudiante')
            ->join('siadi_planificar_asignaturas', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
            ->join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
            ->join('siadi_nivel_idiomas', 'siadi_nivel_idiomas.id_nivel_idioma', '=', 'siadi_asignaturas.id_nivel_idioma')
            ->join('siadi_idiomas', 'siadi_idiomas.id_idioma', '=', 'siadi_asignaturas.id_idioma')
        ->select(
            'siadi_asignaturas.id_siadi_asignatura',
            DB::raw("CONCAT(siadi_idiomas.nombre_idioma, ' ', siadi_nivel_idiomas.nombre_nivel_idioma, ' ', siadi_nivel_idiomas.descripcion_nivel_idioma, ' .:: ', COUNT(*), CASE COUNT(*) WHEN 1 THEN ' paralelo' ELSE ' paralelos' END) AS asignatura")
        )
        ->where([
            'siadi_convocatorias.estado_convocatoria' => 'ACTIVO',
            'siadi_tipo_convocatorias.estado_tipo_convocatoria' => 'ACTIVO',
            'siadi_convocartoria_estudiantes.estado_convocatoria_estudiante' => 'ACTIVO',
            'siadi_planificar_asignaturas.estado_planificar_asignartura' => 'ACTIVO',
            'siadi_asignaturas.estado_asignatura' => 'ACTIVO',
            'siadi_nivel_idiomas.estado_nivel_idioma' => 'ACTIVO',
            'siadi_idiomas.estado_idioma' => 'ACTIVO',
        ])
        ->where('siadi_convocatorias.id_gestion', $this->gestion)
        ->where('periodo', $this->periodo)
        ->where('siadi_convocatorias.id_tipo_convocatoria', explode(';',$this->tipo_convocatoria)[0])
        ->where('sede', $this->sede)
        ->groupBy('siadi_asignaturas.id_siadi_asignatura')
        ->get();
    }

    private function get_asignaturas_sede_tipo_convocatoria(){
        DB::statement("SET SQL_MODE=''");
        return DB::table('siadi_inscripcions')
                ->join('siadi_planificar_asignaturas', 'siadi_planificar_asignaturas.id_planificar_asignatura', '=', 'siadi_inscripcions.id_planificar_asignatura')
                ->join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
                ->join('siadi_nivel_idiomas', 'siadi_nivel_idiomas.id_nivel_idioma', '=', 'siadi_asignaturas.id_nivel_idioma')
                ->join('siadi_paralelos', 'siadi_paralelos.id_paralelo', '=', 'siadi_planificar_asignaturas.id_paralelo') 
                
                ->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')

                ->join('siadi_notas', 'siadi_notas.id_inscripcion', '=', 'siadi_inscripcions.id_inscripcion')
                ->LeftJoin('certificados', 'certificados.id_nota', '=', 'siadi_notas.id_nota')
            ->select(
                'siadi_asignaturas.id_siadi_asignatura',
                'siadi_planificar_asignaturas.id_planificar_asignatura',
                'siadi_planificar_asignaturas.id_paralelo',
                # DB::raw("CONCAT(siadi_asignaturas.sigla_asignatura, ' ', siadi_nivel_idiomas.descripcion_nivel_idioma, ' ', siadi_paralelos.nombre_paralelo) AS materia"),
                DB::raw("CONCAT(siadi_asignaturas.sigla_asignatura, ' ', siadi_nivel_idiomas.descripcion_nivel_idioma) AS materia"),
                DB::raw("CONCAT('Paralelo ', siadi_paralelos.nombre_paralelo, ' (', siadi_planificar_asignaturas.turno_paralelo, ')') AS paralelo"),
                DB::raw("COUNT(siadi_notas.id_inscripcion) AS inscritos_con_nota"),
                DB::raw("COUNT(certificados.certificado_id) AS con_certificados")
            )
            #->select(DB::raw("COUNT(certificados.certificado_id) AS con_certificados"))
            ->where([
                'siadi_inscripcions.estado_inscripcion' => 'ACTIVO',
                'siadi_planificar_asignaturas.estado_planificar_asignartura' => 'ACTIVO',
                'siadi_asignaturas.estado_asignatura' => 'ACTIVO',
                'siadi_nivel_idiomas.estado_nivel_idioma' => 'ACTIVO',
                'siadi_paralelos.estado_paralelo' => 'ACTIVO',

                'siadi_convocatorias.estado_convocatoria' => 'ACTIVO',
                
                'siadi_notas.estado_nota' => 'ACTIVO'
            ])
            ->where('siadi_notas.final_nota', '>=', '51')

            ->where('siadi_convocatorias.id_gestion', $this->gestion)
            ->where('periodo', $this->periodo)
            ->where('siadi_convocatorias.id_tipo_convocatoria', explode(';',$this->tipo_convocatoria)[0])
            ->where('sede', $this->sede)

            ->groupBy("siadi_planificar_asignaturas.id_planificar_asignatura")
            ->orderBy("siadi_planificar_asignaturas.id_planificar_asignatura")
            ->orderBy("siadi_planificar_asignaturas.id_paralelo")
            ->get();    
    }
    
    public $certificado_lote = [];
    public $formato_lote;
    public $fecha_lote;
    public function pdf_lote($icd_asignatura, $por_planificar_asignatura = false){
        #$this->emit('Mostrar', "Imprimir lote $icd_asignatura, POR_ASIGNATURA: $por_planificar_asignatura");

        $cert = new Certificados();
        $certifics = [];
        if($por_planificar_asignatura){
            $certifics = $cert->get_data_certificado_by_planificar_asignatura($this->gestion, $this->periodo, $this->sede, $this->tipo_convocatoria[0], $icd_asignatura);
        } else {
            $certifics = $cert->get_data_certificado_by_asignatura($this->gestion, $this->periodo, $this->sede, $this->tipo_convocatoria[0], $icd_asignatura);
        }
        
        $this->certificado_lote = [];
        if(count($certifics)>0){
            #$tmpArr = json_encode($certifics);
           
            $this->operation = 'imprimir_pdf_lote';
            $this->formato_lote = $certifics[0]->numero_siadi_certificado;
            $this->fecha_lote = $certifics[0]->fecha;
            foreach($certifics as $datossi){
                $this->certificado_lote[] = get_object_vars($datossi);
            }
            $this->emit("showModalImprimir");
        } else {
            $this->cancelar_pdf_lote();
        }
        return;
    }

    public function cancelar_pdf_lote(){
        $this->emit("closeModalImprimir");
        $this->operation = "";
        $this->certificado_lote = [];
        $this->reset([
            'formato_lote',
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
                if($cert["fecha"]!==$this->fecha_lote || $cert["numero_siadi_certificado"]!==$this->formato_lote){
                    $arrayUpdate[] = $cert["certificado_id"];
                }
            }
            if(count($arrayUpdate)>0){
                try{
                    DB::beginTransaction();
                    #actualizar
					Certificados::whereIn('certificado_id', $arrayUpdate)->update([
						'fecha_siadi_certificado' => $this->fecha_lote,
						'numero_siadi_certificado' => $this->formato_lote
					]);
                    DB::commit();
                }catch(\Exception $e){
                    DB::rollback();
                    $this->emit("errorvalidate", "Ocurrio un error al actualizar ". $e->getMessage());
                    return;
                }
            }
            $nombre_archivo = "Certificados ". $this->certificado_lote[0]["materia"] .".pdf";
            return response()->streamDownload(function() use ($nombre_archivo) { # use ( $certificados)
                $pdf = new \App\PDF\PlantillaCertificadoPDF('P', 'mm', array(280, 220));
    
                $pdf->iniciarPosiciones($this->formato_lote); # 'formato1' #$certificados[0] 
                foreach($this->certificado_lote as $cert){ #$certificados
                    $pdf->AddPage();
                    $pdf->setCodigo($cert["codigo_siadi_certificado"]);
                    $pdf->setCI($cert["ci"]);
                    $pdf->setNombres($cert["nombres_persona"]);
                    $pdf->setIdioma($cert["idioma"]);
                    $pdf->setModalidad($cert["modalidad"]);
                    $pdf->setGestion($cert["gestion"]);
                    $pdf->setCargaHoraria($cert["carga_horaria"]);
                    $pdf->setQR($cert["codigo_qr"]); 
                    $pdf->setFecha($this->fecha_lote); # $cert["fecha"]
                }
                $pdf->Output();
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
    public $inicial_2, $nro_2, $anio_2, $fecha_2;
    public $nro_disponible_2, $statusNro_2, $nroMax_2, $nroMin_2; 
    public $nro_libro_nota;
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
            $this->nro_libro_nota = $tmp[0]->nro_folio_nota;
            foreach($tmp as $tp){
                $sumaActualSinCertificado = $tp->inscritos_con_nota - $tp->con_certificados;
                $this->mis_datos[] = [
                    "materia" => $tp->materia,
                    "paralelo" => $tp->paralelo,
                    "sin_certificados" => $sumaActualSinCertificado, #$tp->inscritos_sin_cert,
                    "modalidad" => $tp->modalidad,
                    "gestion" => $tp->gestion
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
        $certif = new Certificados();
        return $certif->get_data_lote_aprobado_agrupar($agruparParalelos, $solo_asignatura, $soloNulos, $this->gestion, $this->periodo, $this->sede, explode(';',$this->tipo_convocatoria)[0]);
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
                for($ic=$this->nro_2; $ic<=$limite; $ic++){ # $this->sum_nro_dispon_max
                    #$this->emit('Mostrar', 'Procesa .. '. $ic. ' n.. '. $notas_sin_cert[$contador_notas]->id_nota);
                    $certificado = new Certificados();
                    $certificado->id_nota = $notas_sin_cert[$contador_notas]->id_nota;
                    $certificado->gestion = $notas_sin_cert[$contador_notas]->gestion;
                    $certificado->numero_siadi_certificado = $notas_sin_cert[$contador_notas]->formato; # formato
                    $certificado->tipo_curso = $notas_sin_cert[$contador_notas]->modalidad; # revisar
                    $certificado->fecha_siadi_certificado = $this->fecha_2;
                    $certificado->codigo_siadi_certificado = $this->inicial_2 .str_pad($ic, 4, "0",  STR_PAD_LEFT). "/". $this->anio_2; 
                    $certificado->id_usuario = Auth::user()->id;
                    $certificado->estado_siadi_certificado = 'ACTIVO';
                    $certificado->save();

                    $nota = SiadiNota::where('id_nota', '=', $notas_sin_cert[$contador_notas]->id_nota)->first();
                    if($this->nro_libro_nota !== $notas_sin_cert[$contador_notas]->nro_folio_nota){
                        $nota->nro_folio_nota = $this->nro_libro_nota;
                        $nota->save();
                    }

                    $contador_notas++;
                }
                $this->emit('alert','Certificado generados satisfactoriamente');
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





    /* private function pruebaFuncionNotasAsignatura($agruparParalelos = false, $solo_asignatura = 0, $soloNulos = false){
        DB::statement("SET SQL_MODE=''");
        $consulta = DB::table('siadi_inscripcions')
            ->join('siadi_planificar_asignaturas', 'siadi_planificar_asignaturas.id_planificar_asignatura', '=', 'siadi_inscripcions.id_planificar_asignatura')
            ->join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
            ->join('siadi_nivel_idiomas', 'siadi_nivel_idiomas.id_nivel_idioma', '=', 'siadi_asignaturas.id_nivel_idioma')
            ->join('siadi_idiomas', 'siadi_idiomas.id_idioma', '=', 'siadi_asignaturas.id_idioma')
            ->join('siadi_paralelos', 'siadi_paralelos.id_paralelo', '=', 'siadi_planificar_asignaturas.id_paralelo') 
            ->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria',  '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
            ->join('siadi_tipo_convocatorias', 'siadi_tipo_convocatorias.id_tipo_convocatoria', '=', 'siadi_convocatorias.id_tipo_convocatoria')
            ->join('siadi_convocartoria_estudiantes', 'siadi_convocartoria_estudiantes.id_convocartoria_estudiante', '=', 'siadi_tipo_convocatorias.id_convocartoria_estudiante')
            ->join('siadi_costos', 'siadi_costos.id_costo', '=','siadi_tipo_convocatorias.id_costo')
            ->join('siadi_gestions', 'siadi_gestions.id_gestion', '=', 'siadi_convocatorias.id_gestion')

            ->join('siadi_notas', 'siadi_notas.id_inscripcion', '=', 'siadi_inscripcions.id_inscripcion')
            ->LeftJoin('certificados', 'certificados.id_nota', '=', 'siadi_notas.id_nota')
        ->select(
            'siadi_asignaturas.id_siadi_asignatura',
            'siadi_planificar_asignaturas.id_planificar_asignatura',
            'siadi_planificar_asignaturas.id_paralelo',
            'siadi_asignaturas.sigla_asignatura',
            # DB::raw("CONCAT(siadi_asignaturas.sigla_asignatura, ' ', siadi_nivel_idiomas.descripcion_nivel_idioma) AS materia"),
            DB::raw("CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS materia"),
            DB::raw("CONCAT('Paralelo ', siadi_paralelos.nombre_paralelo, ' (', siadi_planificar_asignaturas.turno_paralelo, ')') AS paralelo"),

            DB::raw("CASE 
                    WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=1 AND siadi_costos.costo_siado_costo = 0 THEN siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante
                    WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=1 THEN CONCAT(siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante, ' (', siadi_costos.tipo_costo, ')')
                    WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=2 THEN 'EXAMEN DE SUFICIENCIA (AUTOFINANCIADO)'
                    WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante IN(3, 6, 7, 8) THEN SUBSTRING_INDEX(siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante, ' ', 1)
                    WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=9 THEN 'CURSO REGULAR (TGN)'
                    ELSE siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante
                END AS modalidad"),
            DB::raw("CASE 
                        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 9 THEN 'T'
                        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante IN(3, 7) THEN 'C'
                        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante IN(6, 8) THEN 'H'
                        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 1 THEN 'A'
                        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 5 THEN 'M'
                        WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante = 2 THEN 'E'
                        ELSE ''
                    END AS inicial"),
                DB::raw("CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion"),

            $agruparParalelos? DB::raw("COUNT(siadi_notas.id_inscripcion) AS inscritos_con_nota"): 'siadi_notas.id_nota',
            $agruparParalelos? DB::raw("COUNT(certificados.certificado_id) AS con_certificados"): 'siadi_notas.final_nota'
        )
        ->where([
            'siadi_inscripcions.estado_inscripcion' => 'ACTIVO',
            'siadi_planificar_asignaturas.estado_planificar_asignartura' => 'ACTIVO',
            'siadi_asignaturas.estado_asignatura' => 'ACTIVO',
            'siadi_nivel_idiomas.estado_nivel_idioma' => 'ACTIVO',
            'siadi_idiomas.estado_idioma' => 'ACTIVO',
            'siadi_paralelos.estado_paralelo' => 'ACTIVO',
            'siadi_notas.estado_nota' => 'ACTIVO',
            'siadi_convocatorias.estado_convocatoria' => 'ACTIVO',
            'siadi_tipo_convocatorias.estado_tipo_convocatoria' => 'ACTIVO',
            'siadi_convocartoria_estudiantes.estado_convocatoria_estudiante' => 'ACTIVO',
            'siadi_costos.estado_costo' => 'ACTIVO'
        ])
        ->where('siadi_notas.final_nota', '>=', 51)
        ->where('siadi_notas.observacion_nota', 'APROBADO')
        ->where('siadi_convocatorias.id_gestion', $this->gestion)
        ->where('periodo', $this->periodo)
        ->where('siadi_convocatorias.id_tipo_convocatoria', explode(';',$this->tipo_convocatoria)[0])
        ->where('sede', $this->sede);
        if($solo_asignatura!==0){
            $consulta->where('siadi_planificar_asignaturas.id_siadi_asignatura', $solo_asignatura); # $this->asignaturaActual
        }
        if($soloNulos){
            $consulta->whereNull('certificados.id_nota');
        }
        if($agruparParalelos){
            $consulta->groupBy("siadi_planificar_asignaturas.id_planificar_asignatura");
        }        
        $result = $consulta->orderBy("siadi_planificar_asignaturas.id_planificar_asignatura")
        ->orderBy("siadi_planificar_asignaturas.id_paralelo")
        ->get();

        # $this->emit('Mostrar', " agrup: $agruparParalelos, asign: $solo_asignatura, id: $this->asignatura, s:". count($result)." \n". json_encode($result));
        return $result;
    } */
}
