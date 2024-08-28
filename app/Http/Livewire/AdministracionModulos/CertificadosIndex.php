<?php

namespace App\Http\Livewire\AdministracionModulos;

use Livewire\Component;
use Livewire\WithPagination;
use DB;
use Illuminate\Support\Facades\Auth;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use App\Models\AdministracionModulos\Certificados;
use App\Models\AdministracionModulos\SiadiNota;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use App\Models\CertificadosReimpresion;

class CertificadosIndex extends Component
{
    use WithPagination;
    public $search;
    public $filter = "";
    public $status = false;
    protected $paginationTheme = 'bootstrap';

    public $icdActualCertificado;
    public $inicial, $nro, $anio, $fecha;
    public $nro_libro_nota;
    public $formatocd;
    public $nro_disponible, $statusNro, $nroMax, $nroMin;
    public $icdInscripcionActual, $datos_inscripcion_estudiante;

    public $datosImpresion = [
        'certificado_id' => '',
        'codigo' => '',
        'ci' => '',
        'nombre' => '',
        'idioma' => '',
        'modalidad' => '',
        'carga_horaria' => '',
        'gestion' => '',
        'fecha_original' => '',
        'final_nota' => '',
        'nro_folio_nota' => '',
        'materia' => '',
        'imagen' => '',
        'qr_code' => '',
        'formato' => ''
    ];
    public $estadoCargaHoraria, $fechaImpresion, $formatoImpresion, $codigo_migra;
    
    /* 
    "id_convocartoria_estudiante","nombre_convocatoria_estudiante"
    "1","CURSO REGULAR" -> CURSO REGULAR [(autofinanciado) | (convenio) 
    "2","PRUEBA DE EXAMEN DE SUFICIENCIA" -> examen de suficiencia
    "3","CONVALIDACIÓN DEPARTAMENTO IDIOMAS" -> convalidacion
    "4","ACTUALIZACION DE CERTIFICADO" -> actualizacion
    "5","MIGRACIÓN","ACTIVO" -> migracion
    "6","HOMOLOGACIÓN DEPARTAMENTO IDIOMAS" -> homologacion
    "7","CONVALIDACIÓN LINGUISTICA E IDIOMAS" -> convalidacion
    "8","HOMOLOGACIÓN LINGUISTICA E IDIOMAS" -> homologacion
    "9","CURSO REGULAR (T.G.N.)" -> curso regular (tgn)
    */

    public function render()
    {
        $this->loadFormat();
        $gestiones = DB::table('siadi_gestions')
            ->select('nombre_gestion', 'id_gestion')
            ->where('estado_gestion', '<>', 'ELIMINAR')
            ->get();
        #$this->emit("Mostrar", "-->>".$this->operation);
        

        $cert = new Certificados();
        return view('livewire.administracion-modulos.certificados-index', [
            'estudiantes'=> $this->get_estudiante_materias(),
            'numeros_disponibles' => $cert->get_numeros_disponibles($this->anio),
            'gestiones' => $gestiones,

            # reimpresiones
            'reimpreion_modal' => $this->get_all_data_reimpresion_by_id_certificado(),

            #'personas' =>  DB::table('siadi_personas')->select('ci_persona')->get() # borrar solo para pruebas
        ]); 
    }

    # carga modelos de certificados
    public $formatos = [];
    public function loadFormat(){
        try{
            $this->formatos = include( app_path('ArraysData/formatos_data_array.php') );
        } catch(\Exception $e){
            $this->emit("Mostrar", "Error al cargar formatos de certificado");
        }
    }

    public function clear_filter(){
        $this->status = false;
        $this->filter = "";
    }

    public function cancelar(){
        $this->reset([
            'nro_disponible',
            'inicial',
            'nro',
            'fecha',
            'anio',
            'nro_libro_nota',
            'formatocd'
        ]);
        $this->datos_inscripcion_estudiante = null;
        $this->resetValidation();
    }

    
        private function get_estudiante_materias(){
            $estudiantes =  DB::table('siadi_notas')
                    ->join('siadi_inscripcions', 'siadi_inscripcions.id_inscripcion', '=', 'siadi_notas.id_inscripcion')
                    ->join('siadi_personas', 'siadi_personas.id_siadi_persona', '=', 'siadi_inscripcions.id_siadi_persona')
                    ->join('siadi_planificar_asignaturas', 'siadi_planificar_asignaturas.id_planificar_asignatura', '=', 'siadi_inscripcions.id_planificar_asignatura')
                    ->join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
                    ->join('siadi_nivel_idiomas', 'siadi_nivel_idiomas.id_nivel_idioma', '=', 'siadi_asignaturas.id_nivel_idioma')
                    ->join('siadi_idiomas', 'siadi_idiomas.id_idioma', '=', 'siadi_asignaturas.id_idioma')
                    ->join('siadi_paralelos', 'siadi_paralelos.id_paralelo', '=', 'siadi_planificar_asignaturas.id_paralelo')
                    ->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
                    ->join('siadi_gestions', 'siadi_gestions.id_gestion', '=', 'siadi_convocatorias.id_gestion')
                    ->join('siadi_modalidad_curso', 'siadi_modalidad_curso.id_convocartoria_estudiante', '=', 'siadi_convocatorias.id_modalidad_curso')
                    ->join('siadi_costos', 'siadi_costos.id_costo', '=', 'siadi_convocatorias.id_costo') 
                    /* ->join('siadi_tipo_convocatorias', 'siadi_tipo_convocatorias.id_tipo_convocatoria', '=', 'siadi_convocatorias.id_tipo_convocatoria')
                    ->join('siadi_convocartoria_estudiantes', 'siadi_convocartoria_estudiantes.id_convocartoria_estudiante', '=', 'siadi_tipo_convocatorias.id_convocartoria_estudiante')
                    ->join('siadi_costos', 'siadi_costos.id_costo', '=', 'siadi_tipo_convocatorias.id_costo') */
                    ->leftJoin('certificados', 'certificados.id_nota', '=','siadi_notas.id_nota')
                    #->leftJoin('certificados_reimpresions', 'certificados_reimpresions.')
                ->select('siadi_notas.id_nota',
                    'siadi_notas.id_inscripcion AS id_inscripcion', 
                    'certificados.certificado_id',
                    'siadi_notas.final_nota',
                    'certificados.fecha_siadi_certificado',
                    DB::raw("CONCAT(ci_persona, ' ', expedido_persona) AS ci"),
                    'pais_persona',
                    DB::raw("UPPER(CONCAT(CASE paterno_persona WHEN '' THEN '' ELSE concat(paterno_persona, ' ') END , ' ', materno_persona, ' ', nombres_persona)) AS nombres_persona"),
                    DB::raw("CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS idioma"),
                    DB::raw("CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion"),
                    'siadi_gestions.nombre_gestion AS anio',
                    /* DB::raw("CASE 
                                -- WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=1 AND siadi_costos.tipo_costo = 'TGN' THEN siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante
                                WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=1 THEN CONCAT(siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante, ' (', siadi_costos.tipo_costo, ')')
                                WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante=2 THEN 'EXAMEN DE SUFICIENCIA (AUTOFINANCIADO)'
                                WHEN siadi_convocartoria_estudiantes.id_convocartoria_estudiante IN(3, 6, 7, 8) THEN SUBSTRING_INDEX(siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante, ' ', 1)
                                ELSE siadi_convocartoria_estudiantes.nombre_convocatoria_estudiante
                        END AS modalidad"), */
                    DB::raw("CASE 
                        WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 THEN CONCAT(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' (', siadi_costos.tipo_costo, ')')
                        WHEN siadi_modalidad_curso.id_convocartoria_estudiante=2 THEN 'EXAMEN DE SUFICIENCIA (AUTOFINANCIADO)'
                        WHEN siadi_modalidad_curso.id_convocartoria_estudiante IN(3, 6, 7, 8) THEN SUBSTRING_INDEX(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' ', 1)
                        ELSE siadi_modalidad_curso.nombre_convocatoria_estudiante
                    END AS modalidad"),
                    
                    'siadi_modalidad_curso.id_convocartoria_estudiante',
                    'siadi_costos.tipo_costo',
                    'siadi_nivel_idiomas.nombre_nivel_idioma',
                    'siadi_planificar_asignaturas.carga_horaria_planificar_asignartura  AS carga_horaria'
                )
                ->where( function($query){
                    $query->where('siadi_notas.estado_nota', '<>', 'ELIMINAR')
                        ->where('siadi_inscripcions.estado_inscripcion', '<>', 'ELIMINADO')
                        ->where('siadi_personas.estado_persona', '<>', 'ELIMINAR')
                        ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
                        ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
                        ->where('siadi_nivel_idiomas.estado_nivel_idioma', '<>', 'ELIMINAR')
                        ->where('siadi_idiomas.estado_idioma', '<>', 'ELIMINAR')
                        ->where('siadi_paralelos.estado_paralelo', '<>', 'ELIMINAR')
                        ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO')
                        ->where('siadi_gestions.estado_gestion', '<>', 'ELIMINAR')
                        #->where('siadi_tipo_convocatorias.estado_tipo_convocatoria', '<>', 'ELIMINAR')
                        #->where('siadi_convocartoria_estudiantes.estado_convocatoria_estudiante', '<>', 'ELIMINAR')
                        #->where('siadi_costos.estado_costo', '<>', 'ELIMINAR');
                        ->where('siadi_modalidad_curso.estado_convocatoria_estudiante', '<>', 'ELIMINAR')
                        ->where('siadi_costos.estado_costo', '<>', 'ELIMINAR');
                })
                ->where('siadi_notas.final_nota', '>=', 51)
                # ->where('siadi_notas.observacion_nota', 'APROBADO')
                ->where('ci_persona', $this->search)
                ->where(function ($query) {
                    $filterLR = "%$this->filter%";
                    $query->where(DB::raw("CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion)"), 'LIKE', $filterLR)
                            ->orWhere(DB::raw("CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma)"), 'LIKE', $filterLR)
                            ->orWhere(DB::raw("CASE 
                                WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 THEN CONCAT(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' (', siadi_costos.tipo_costo, ')')
                                WHEN siadi_modalidad_curso.id_convocartoria_estudiante=2 THEN 'EXAMEN DE SUFICIENCIA (AUTOFINANCIADO)'
                                WHEN siadi_modalidad_curso.id_convocartoria_estudiante IN(3, 6, 7, 8) THEN SUBSTRING_INDEX(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' ', 1)
                                ELSE siadi_modalidad_curso.nombre_convocatoria_estudiante
                            END "), 'LIKE', $filterLR);
                })
                #->get(); # si se usa paginate, no sirve esto
                ->paginate(10);
                $this->status = (strlen($this->filter)!=0 || count($estudiantes)>0);
            return $estudiantes;
        }

    public function mount(){
        $this->search = '7088751';
    }



    /* =================  CERTIFICADOS 2DA VERSION  ========================= */

    /* =================  fin CERTIFICADOS 2DA VERSION  ========================= */


    /* =============== INICIO CERTIFICADOS 3RA VERSION ======================== */
    public function guardar_certificado($icmprimir = false){
        $this->validate();

        # guardar certificado
         try {
            DB::beginTransaction();
            $tmp_cert = json_decode($this->datos_inscripcion_estudiante, false);
            #$this->emit("Mostrar", $tmp_cert->gestion);
            $certificado = new Certificados();
            $certificado->id_nota = $tmp_cert->id_nota;
            $certificado->gestion = $tmp_cert->gestion;
            $certificado->numero_siadi_certificado = $this->formatocd; #formato
            $certificado->tipo_curso = $tmp_cert->modalidad;
            $certificado->fecha_siadi_certificado = $this->fecha;
            $certificado->imagen_certificado = "";
            # año del codigo tomado de la fecha al momento de generar el certificado
            $certificado->codigo_siadi_certificado = $this->inicial. str_pad($this->nro, 4, "0",  STR_PAD_LEFT). "/". $this->anio;  #Carbon::parse($this->fecha)->format('Y');
            $certificado->estado_siadi_certificado = 'ACTIVO';
            $certificado->id_usuario = Auth::user()->id;
            $certificado->save();
            $nota = SiadiNota::where('id_nota', '=', $tmp_cert->id_nota)->first();
            if($this->nro_libro_nota!==$tmp_cert->nro_folio_nota){
                $nota->nro_folio_nota = $this->nro_libro_nota;
                $nota->save();
            }
            DB::commit();
            
            $this->emit('closeModalCreate');
        	# $this->emit('Mostrar', ">>". $certificado->codigo_siadi_certificado);
        	if($icmprimir){
            	$this->emit('Mostrar', "Se esta imprimiendo");
            	$this->emit('showModalImprimirCertificado');
            	$this->mostrar_certificado($certificado->certificado_id, true);
        	} else {
            	$this->emit('alert','El certificado se guardo satisfactoriamente');
            	$this->cancelar();
        	}
        } catch (\Exception $e) {
        	DB::rollback();
            #throw $e;
            $this->emit("errorvalidate", "Ups. Ocurrio un error al generar certificado \n". $e->getMessage());
        }
    }

    public function actualizar_rango_nro(){
        if($this->nro_disponible==""){
            $this->statusNro = false;
            $this->nro = $this->nroMax = $this->nroMin = "";
        } else {
            if(count(explode('-', $this->nro_disponible))==2){
                $this->nroMin = explode('-', $this->nro_disponible)[0];
                $this->nroMax = explode('-', $this->nro_disponible)[1];
                $this->nro = $this->nroMin;
                $this->statusNro = true;
                $this->validateOnly('nro');
            } else {
                $this->nro = $this->nroMax = $this->nroMin = $this->nro_disponible;
                $this->statusNro = false;
            }
        }
    }

    public function actualiza_anio(){
        $this->nro = $this->nroMax = $this->nroMin = "";
        $this->statusNro = false;
        if($this->anio==''){
            $this->resetValidation('nro');
        }
    }

    public function abrir_form($icd_inscripcion){
        $this->operation = 'guardar';

        $this->cancelar();
        #$this->emit('showLoaderAgregarCerticados');

        $fechaActual = Carbon::now(); 
        $this->anio = $fechaActual->format('Y');
        $this->statusNro = false;
        $this->nro = $this->nroMin = $this->nroMax = "";
        $cer = new Certificados();
        $this->datos_inscripcion_estudiante = $cer->get_data_estudiante_inscrito_aprobado($icd_inscripcion);
        #$this->emit("Mostrar", json_encode($this->datos_inscripcion_estudiante));
        if(is_null($this->datos_inscripcion_estudiante)){
            $this->emit('Error', 'No se encontro datos');
            $this->cancelar();
            return;
        }
        
        # existe llenar datos y mostrar
        $this->inicial = $this->datos_inscripcion_estudiante->inicial;
        $this->nro_libro_nota = $this->datos_inscripcion_estudiante->nro_folio_nota;
        $this->formatocd = $this->datos_inscripcion_estudiante->formato;
        $this->datos_inscripcion_estudiante = json_encode($this->datos_inscripcion_estudiante);
        $this->emit("showModalCreate");
        #$this->emit('hideLoaderAgregarCerticados');
    }

    /* ***********   RULES   ********* */
    public $operation;

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        # tipo de operacion
        if($this->operation=='guardar'){
            return $this->rulesForSave();
        } else if($this->operation=='imprimir'){
            return $this->rulesForPrint();
        } else if($this->operation=='save_image'){
            return $this->rulesForSaveImage();
        } else if($this->operation=='guardar_reimpresion'){
            return $this->rulesForGenerateReimpresion();
        } else if($this->operation=='editar_reimpresion'){
            return $this->rulesForEditReimpresion();
        }
        return array_merge($this->rulesForSave(), $this->rulesForPrint(),
            $this->rulesForSaveImage(),
            $this->rulesForGenerateReimpresion(), $this->rulesForEditReimpresion()
        );
    }


    protected function rulesForSave(){
        return [
            'nro_disponible' => 'required',
            'inicial' => 'required|size:1|alpha|uppercase',
            'anio' => 'required',
            'nro' => 'required|integer|between:'.$this->nroMin.','.$this->nroMax,
            'fecha' => 'required|date|date_format:Y-m-d|after_or_equal:2000-09-05|before_or_equal:'.date('Y-m-d', strtotime('+1 year')), # desde la fundacion de la upea hasta el año actual mas un año
            'nro_libro_nota' => 'required',
            'formatocd' => 'required'
        ];
    }

    protected function rulesForPrint(){
        return [
            'fechaImpresion' => 'required|date|date_format:Y-m-d|after_or_equal:2000-09-05|before_or_equal:'.date('Y-m-d', strtotime('+1 year')), # desde la fundacion de la upea hasta el año actual mas un año
            'formatoImpresion' => 'required',
            'codigo_migra' => 'required|string|uppercase|size:10'
        ];
    }

    protected function rulesForSaveImage(){
        return [
            'imagen' => 'required|image|mimes:jpg,png'
        ];
    }

    public function rulesForGenerateReimpresion(){
        $fecha_minima = is_null($this->certifica_prueba)? '2000-09-05': $this->certifica_prueba["fecha"];
        return [
            'fecha_rimp' => 'required|date|date_format:Y-m-d|after_or_equal:'. $fecha_minima .'|before_or_equal:'.date('Y-m-d', strtotime('+1 year')), # desde la fecha de certificado 
        ];
    }

    public function rulesForEditReimpresion(){
        $fecha_minima = is_null($this->certifica_prueba)? '2000-09-05': $this->certifica_prueba["fecha"];
        return [
            'fecha_edit_reimp' => 'required|date|date_format:Y-m-d|after_or_equal:'. $fecha_minima .'|before_or_equal:'.date('Y-m-d', strtotime('+1 year')), # desde la fecha de certificado 
            'imagen_reimpresion' => 'nullable|image|mimes:jpg,png'
        ];
    }
    /* *********** END RULES ********* */





    /* ************ INICIO ASIGNACIÓN DE NOMBRES attributes ****************** */
    protected $validationAttributes = [
        # rulesForSave
        'nro_disponible' => '"Números Disponibles"',
        'inicial' => '"Inicial"',
        'anio' => '"Año"',
        'nro' => '"Número"',
        'fecha' => '"Fecha"',
        'nro_libro_nota' => '"Número de Libro"',
        'formatocd' => '"Formato de Impresión"',

        # rulesForPrint
        'fechaImpresion' => '"Fecha de Impresión"',
        'formatoImpresion' => '"Formato de Impresión"',

        # rulesForSaveImage
        'imagen' => '"Imagen"',

        # rulesForGenerateReimpresion
        'fecha_rimp' => '"Fecha"',

        # rulesForEditReimpresion
        'fecha_edit_reimp' => '"Fecha Reimpresión"',
        'imagen_reimpresion' => '"Imagen"'
    ];
    /* ************** FIN ASIGNACIÓN NOMBRES attributes ********************** */


    /* public function mount($asignatura_actual)
    {
        $this->asignatura_actual = $asignatura_actual;
    } */


    public function mostrar_certificado($icd_certificado, $imprimir = false){
        $this->operation = 'imprimir';
        $this->clearDataPrint();
        $certificado = $this->get_model_certicado_by_id($icd_certificado);
        if(is_null($certificado)){
            $this->emit('Error', 'No se encontró certificado.');
            return;
        } else {
            $this->datosImpresion = [
                'certificado_id' => $certificado->certificado_id,
                'codigo' => $certificado->codigo_siadi_certificado,
                'ci' => $certificado->ci,
                'nombre' => $certificado->nombres_persona,
                'idioma' => $certificado->idioma,
                'modalidad' => $certificado->modalidad,
                'carga_horaria' => $certificado->carga_horaria,
                'gestion' => $certificado->gestion,
                'fecha_original' => $certificado->fecha,
                'final_nota' => $certificado->final_nota,
                'nro_folio_nota' => $certificado->nro_folio_nota,
                'materia' => $certificado->materia,
                "imagen" => $certificado->imagen_certificado,
                "qr_code" => $certificado->codigo_qr,
                "formato" => $certificado->numero_siadi_certificado
            ];
            $this->fechaImpresion = $certificado->fecha;
            $this->formatoImpresion = $certificado->numero_siadi_certificado;
            $this->codigo_migra = $certificado->codigo_siadi_certificado;
            $this->emit('showModalImprimirCertificado');
        }
    }

    public function mostrar_certificado_pdf_digital($icd_certificado){
        $this->operation = 'save_image';
        $this->cancelar_imagen();
        $certificado = $this->get_model_certicado_by_id($icd_certificado);
        if(is_null($certificado)){
            $this->emit('Error', 'No se encontró certificado.');
            return;
        } else {
            $this->datosImpresion = [
                'certificado_id' => $certificado->certificado_id,
                'codigo' => $certificado->codigo_siadi_certificado,
                'ci' => $certificado->ci,
                'nombre' => $certificado->nombres_persona,
                'idioma' => $certificado->idioma,
                'modalidad' => $certificado->modalidad,
                'carga_horaria' => $certificado->carga_horaria,
                'gestion' => $certificado->gestion,
                'fecha_original' => $certificado->fecha,
                'final_nota' => $certificado->final_nota,
                'nro_folio_nota' => $certificado->nro_folio_nota,
                'materia' => $certificado->materia,
                "imagen" => $certificado->imagen_certificado,
                "qr_code" => $certificado->codigo_qr,
                "formato" => $certificado->numero_siadi_certificado
            ];
            $this->fechaImpresion = $certificado->fecha;
            $this->formatoImpresion = $certificado->formato;
            $this->emit('showModalAgregarCertificadoImagen');
        }
    }

    private function get_model_certicado_by_id($id){
        $certificad = new Certificados();
        return $certificad->get_data_certifcado($id);
    }

    public function clearDataPrint(){
        $this->reset([
            'fechaImpresion',
            'estadoCargaHoraria',
            'formatoImpresion'
        ]);
        $this->datosImpresion = [
            'certificado_id' => '',
            'codigo' => '',
            'ci' => '',
            'nombre' => '',
            'idioma' => '',
            'modalidad' => '',
            'carga_horaria' => '',
            'gestion' => '',
            'fecha_original' => '',
            'final_nota' => '',
            'nro_folio_nota' => '',
            'materia' => '',
            "imagen" => '',
            "qr_code" => '',
            "formato" => ''
        ];
        $this->estadoCargaHoraria = true;
    }

    private function carga_horaria_acumulada($query, $menor_igual = false){
        $query::addSelect([
            ''
        ]);
    }


    public function imprimir(){
        $this->validate();

        #verficar si la fecha es igual a la anterior
        if($this->datosImpresion["fecha_original"]!==$this->fechaImpresion || $this->datosImpresion["formato"] !== $this->formatoImpresion || $this->datosImpresion["codigo"] !== $this->codigo_migra){
            try { 
                DB::beginTransaction();

                $certificado = Certificados::findOrFail($this->datosImpresion["certificado_id"]); #findOrFail
                if($this->datosImpresion["fecha_original"]!==$this->fechaImpresion){
                    $certificado->fecha_siadi_certificado = $this->fechaImpresion;
                }
                if($this->datosImpresion["formato"] !== $this->formatoImpresion){
                    $certificado->numero_siadi_certificado = $this->formatoImpresion;
                }
                if($this->datosImpresion["codigo"] !== $this->codigo_migra){
                    $certificado->codigo_siadi_certificado = $this->codigo_migra;
                }
                $certificado->id_usuario = Auth::user()->id;
                $certificado->save();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                #throw $e;
                $this->emit("Error", "Ups. Ocurrio un error al actualizar fecha");
                return;
            }
        }
        $this->emit('closeModalImprimirCertificado');

        $url = route('impresion_certificado', [
            'id_certificado' => $this->datosImpresion["certificado_id"],
            'carga_horaria' => $this->estadoCargaHoraria
        ]);
        $this->emit('abrirNuevaPestania', $url);

        // Antiguo buscar en  c:\Users\SIE_PC-11\Documents\yo-f\CertificadosIndex_imprimir.php
    }


    public function imprimir_solo(){
        $this->validate();
        #$this->emit('Mostrar', "-> Se imprimira controller $this->formatoImpresion");
        $id = $this->datosImpresion["certificado_id"];
        return redirect()->to("admin/certificado/$id/$this->formatoImpresion/". true);
    }


    /* ===============   fin CERTIFICADOS 3RA VERSION ======================== */





    use WithFileUploads;
    public $imagen;

    public function guardar_imagen(){
        #$this->emit("Mostrar", "Validar imagen");
        $this->validate();
        try { 
            DB::beginTransaction();
            $nombreImagen = $this->imagen->store('', 'cert');
            #$this->emit("Mostrar", "Guardar Imagen". $nombreImagen);
            $certificado = Certificados::findOrFail($this->datosImpresion["certificado_id"]); #findOrFail
            $certificado->imagen_certificado = $nombreImagen;
            $certificado->save();
            DB::commit();
            $this->cancelar_imagen();
            $this->emit("closeModalAgregarCertificadoImagen");
            $this->emit('alert', 'Se añadio certificado digital exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function imprimir_pdf_digital(){
        #$this->emit("Mostrar", "Esta en". Storage::disk('cert')->path($this->datosImpresion["imagen"]));
        $this->emit("closeModalAgregarCertificadoImagen");
        return response()->streamDownload(function () {
            $pdf = new Fpdf('P', 'mm', array(280, 220));
            $pdf->Addpage();
            $pdf->Image(Storage::disk('cert')->path($this->datosImpresion["imagen"]), 0, 0, 220);
            $pdf->Output(); 
        }, "certificadoDig ".$this->datosImpresion['ci'].".pdf");
        $this->cancelar_imagen();
    }

    public function cancelar_imagen(){
        $this->resetValidation();
        $this->imagen = null;
    }

    



    /* ----------    INIIO FORMULARIO REIMPRESION - 21/09/23 ------------------ */
    public $codigo_rimp;
    public $fecha_rimp;
    public $certifica_prueba;

    protected $listeners = [
        'reimpresion_eliminar',
    ];

    public function mostrar_formulario_reimpresion($id_cert){
        $this->operation = 'guardar_reimpresion';
        # $this->emit("Mostrar", "--$this->operation");
        $this->cancelar_form_reimpresion();
        $certifica_tmp = $this->get_model_certicado_by_id($id_cert);
        if(!is_null($certifica_tmp)){
            $this->certifica_prueba = get_object_vars( $certifica_tmp ); #json_encode($certifica_tmp);
            $this->codigo_rimp = "R". substr($certifica_tmp->codigo_siadi_certificado, -9, 9);
            $this->emit("showModalReimpresionCertificado");
        } else {
            $this->emit('Error', 'No se encontro datos de certificado.');
        }
    }

    public function cancelar_form_reimpresion(){
        $this->reset(
            'codigo_rimp',
            'fecha_rimp',
            'certifica_prueba'
        );
        $this->codigo_rimp = '';
        $this->fecha_rimp = '';
        $this->certifica_prueba = null;
        $this->resetValidation();
    }


    public function guardar_reimpresion(){
        if($this->operation=='guardar_reimpresion' && !is_null($this->certifica_prueba)){
            $this->validate();
            DB::table('certificados_reimpresions')
                ->insert([
                    'certificado_id' => $this->certifica_prueba["certificado_id"],
                    'fecha_siadi_certificado' => $this->fecha_rimp,
                    'codigo_siadi_certificado' => "R". substr($this->certifica_prueba["codigo_siadi_certificado"], -9, 9),
                    'imagen_certificado' => ''
                ]);

            $this->fecha_rimp = '';
            $this->resetValidation('fecha_rimp');
            $this->emit('alert','El guardó satisfactoriamente reimpresion');
        } else {
            $this->emit('closeModalReimpresionCertificado');
        }
    }


    private function get_all_data_reimpresion_by_id_certificado(){ #id_certificado
        if(is_null($this->certifica_prueba)){
            return [];
        } else {
            return DB::table('certificados_reimpresions')
                ->select('*')
                ->where(
                    [
                        'certificado_id' => $this->certifica_prueba["certificado_id"]
                    ]
                )
                ->get();
        }
    }

    public function reimpresion_eliminar($id_cimp): void {
        DB::table('certificados_reimpresions')->where('certificados_reimpresions_id', $id_cimp)->delete();
        $this->emit('alert', 'Se eliminó certificado reimpresión satisfactoriamente');
    }



    /* 25 09 2023 */
    public $codigo_edit_reimp,
            $fecha_edit_reimp;
    public $data_reimpresion;
    public $imagen_reimpresion;


    public function mostrar_form_edit_reimpresion($id){
        $this->cancelar_edit_reimpresion();
        $this->operation = 'editar_reimpresion';
        $certiremp_tmp = $this->get_data_reimpresion($id);
        if(!is_null($certiremp_tmp)){
            $this->data_reimpresion = get_object_vars( $certiremp_tmp ); #json_encode($certiremp_tmp);
            $this->codigo_edit_reimp = $certiremp_tmp->codigo_siadi_certificado;
            $this->fecha_edit_reimp = $certiremp_tmp->fecha_siadi_certificado;
            #$this->imagen_reimpresion = $certiremp_tmp->imagen_certificado;
            $this->emit("closeModalReimpresionCertificado");
            $this->emit("showModalEditarReimpresionCertificado");
        } else {
            $this->emit('showModalReimpresionCertificado');
            $this->emit('Error', 'No se encontro datos de reimp-certificado.');
        }
    }

    public function actualizar_form_edit_reimpresion(){
        # Validar que la operacion sea 'editar_reimpresion' y exista datos json en $data_impresion
        if($this->operation=='editar_reimpresion' && !is_null($this->data_reimpresion)){
            $this->validate();
            #$cert_ant = json_decode($this->data_reimpresion, false);
            
            try { 
                DB::beginTransaction();
                $array_actualizar = ['fecha_siadi_certificado' => $this->fecha_edit_reimp];
                if(!is_null($this->imagen_reimpresion)){
                    # si existe una imagen para reimprimir, se guarda la imagen
                    $array_actualizar['imagen_certificado'] = $this->imagen_reimpresion->store('', 'cert_reimpresion');
                }

                DB::table('certificados_reimpresions')
                ->where('certificados_reimpresions_id',  $this->data_reimpresion["certificados_reimpresions_id"]) # $cert_ant
                ->update($array_actualizar);

                DB::commit();
                $this->cancelar_edit_reimpresion();
                $this->emit('alert', 'Actualización satisfactoria de Reimpresión');
            } catch (\Exception $e) {
                DB::rollback();
                $this->emit("Error", "Error al actualizar reimpresion: \n". $e->getMessage());
            }
        } else {
            $this->emit('closeModalEditarReimpresionCertificado');
        }
    }

    private function get_data_reimpresion($id){
        return DB::table('certificados_reimpresions')
            ->select('*')
            ->where(
                [
                    'certificados_reimpresions_id' => $id
                ]
            )
            ->first();
    }

    public function cancelar_edit_reimpresion(){
        $this->reset(
            'codigo_edit_reimp',
            'fecha_edit_reimp',
            'imagen_reimpresion'
        );
        $this->data_reimpresion = null;
        $this->imagen_reimpresion = null;
        $this->resetValidation();
        $this->emit('closeModalEditarReimpresionCertificado');
        $this->emit("showModalReimpresionCertificado");
        $this->operation = 'guardar_reimpresion';
    }

    


    public function imprimir_reimpresion($id_remp){
        #return redirect()->route('reimpresion', ['id_certificado_reimpresion' => $id_remp]);

        $url = route('reimpresion', ['id_certificado_reimpresion' => base64_encode($id_remp)]); # \Illuminate\Support\Facades\Crypt::encrypt($id_remp)
        $this->emit('abrirNuevaPestania', $url);
    }


    /* ----------    FIN FORMULARIO REIMPRESION - 21/09/23 ------------------ */
    
}

# Convocatoria, Encabezado de convocatoria
# PRUEBA DE EXAMEN DE SUFICIENCIA, EXAMEN DE SUFICIENCIA -> Extudiantes externos que toman la carrera de linguistica:
    # - EXAMEN DE SUFICIENCIA(AUTOFINANCIADO)
# CONVALIDACIÓN DEPARTAMENTO IDIOMAS, CONVALIDACION DEPARTAMENTO DE IDIOMAS
# CURSO REGULAR, TGN -> Curso TGN -> Estudiantes de la UPEA que toman materias de linguistica
    # - CURSO REGULAR
# CONVALIDACIÓN LINGUISTICA E IDIOMAS, CONVALIDACIÓN LINGUISTICA E IDIOMAS # 1343

