<?php

namespace App\Http\Livewire\AdministracionModulos;

use Livewire\Component;
use Livewire\WithPagination;
use DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\AdministracionModulos\Certificados;
use App\Models\AdministracionModulos\CertificadosProvisional;
use App\Models\AdministracionModulos\SiadiNota;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use App\Models\CertificadosReimpresion;

class CertificadosProvisionalIndex extends Component
{
    use WithPagination;
    public $search;
    public $filter = "";
    public $status = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $gestiones = DB::table('siadi_gestions')
            ->select('nombre_gestion', 'id_gestion')
            ->where('estado_gestion', '<>', 'ELIMINAR')
            ->get();
        #$this->emit("Mostrar", "-->>".$this->operation);
        

        $cert = new CertificadosProvisional();
        return view('livewire.administracion-modulos.certificados-provisional-index', [
            'estudiantes_prov'=> $this->get_estudiante_materias_prov(),
            'numeros_disponibles' => ($this->operation=="guardar")?$cert->get_numeros_disponibles($this->anio_prov): [],
            'gestiones' => $gestiones,
            'certificado_notas' => $this->get_estudiante_certificados_notas()
        ]); 
    }


    public function clear_filter(){
        $this->status = false;
        $this->filter = "";
    }

    
    private function get_estudiante_materias_prov(){
        $base =  DB::table('siadi_notas')
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
                ->leftJoin('certificados_provisional', 'certificados_provisional.id_nota', '=','siadi_notas.id_nota')
                #->leftJoin('certificados_reimpresions', 'certificados_reimpresions.')
            ->select('siadi_notas.id_nota',
                'siadi_notas.id_inscripcion AS id_inscripcion', 
                'certificados_provisional.id_certificado_provisional',
                'siadi_notas.final_nota',
                'siadi_notas.observacion_nota',
                'certificados_provisional.fecha_siadi_certificado',
                DB::raw("CONCAT(ci_persona, ' ', expedido_persona) AS ci"),
                'pais_persona',
                DB::raw("UPPER(CONCAT(CASE paterno_persona WHEN '' THEN '' ELSE concat(paterno_persona, ' ') END , ' ', materno_persona, ' ', nombres_persona)) AS nombres_persona"),
                DB::raw("CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS idioma"),
                DB::raw("CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion"),
                'siadi_gestions.nombre_gestion AS anio',
                'siadi_modalidad_curso.id_convocartoria_estudiante',
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
                'siadi_planificar_asignaturas.carga_horaria_planificar_asignartura  AS carga_horaria',
                
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
            });

            #->get(); # si se usa paginate, no sirve esto
            $this->addColumnEsTGNYTieneCertificado($base);
            $estudiantes = $base->paginate(10);
            $this->status = (strlen($this->filter)!=0 || count($estudiantes)>0);
        return $estudiantes;
    }

    private function addColumnEsTGNYTieneCertificado($query){
        $query->addSelect(
            DB::raw("CASE
                WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 AND siadi_costos.tipo_costo='TGN' THEN 'SI'
                ELSE 'NO'
            END AS es_tgn"),
            DB::raw("
                (
                    SELECT 
                        cp.id_certificado_provisional
                        -- cp.numero_siadi_certificado_prov 
                    FROM siadi_notas sn 
                    INNER JOIN siadi_inscripcions si ON(si.id_inscripcion = sn.id_inscripcion)
                    INNER JOIN siadi_personas sper ON(sper.id_siadi_persona = si.id_siadi_persona)
                    INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
                    INNER JOIN siadi_asignaturas sa ON(sa.id_siadi_asignatura = spa.id_siadi_asignatura)
                    INNER JOIN siadi_nivel_idiomas sni ON(sni.id_nivel_idioma = sa.id_nivel_idioma)
                    INNER JOIN siadi_idiomas sid ON(sid.id_idioma = sa.id_idioma)
                    INNER JOIN siadi_convocatorias sco ON(sco.id_siadi_convocatoria = spa.id_siadi_convocatoria)
                    INNER JOIN siadi_gestions sg ON(sg.id_gestion = sco.id_gestion)
                    INNER JOIN siadi_modalidad_curso smc ON(smc.id_convocartoria_estudiante = sco.id_modalidad_curso)
                    INNER JOIN siadi_costos scos ON(scos.id_costo = sco.id_costo)

                    LEFT JOIN certificados_provisional cp ON(cp.id_nota = sn.id_nota)
                    WHERE smc.id_convocartoria_estudiante=1 
                        AND scos.tipo_costo = 'TGN'
                        AND sa.id_idioma = siadi_idiomas.id_idioma
                        AND sid.id_idioma = siadi_idiomas.id_idioma
                        AND sper.id_siadi_persona = siadi_personas.id_siadi_persona
                        AND sn.final_nota >= 51
                    -- ORDER BY sni.id_nivel_idioma ASC
                    GROUP BY sid.id_idioma
                ) id_certificado_notas"),
                DB::raw("
                (
                    SELECT 
                        si.id_inscripcion
                    FROM siadi_notas sn 
                    INNER JOIN siadi_inscripcions si ON(si.id_inscripcion = sn.id_inscripcion)
                    INNER JOIN siadi_personas sper ON(sper.id_siadi_persona = si.id_siadi_persona)
                    INNER JOIN siadi_planificar_asignaturas spa ON(spa.id_planificar_asignatura = si.id_planificar_asignatura)
                    INNER JOIN siadi_asignaturas sa ON(sa.id_siadi_asignatura = spa.id_siadi_asignatura)
                    INNER JOIN siadi_nivel_idiomas sni ON(sni.id_nivel_idioma = sa.id_nivel_idioma)
                    INNER JOIN siadi_idiomas sid ON(sid.id_idioma = sa.id_idioma)
                    INNER JOIN siadi_convocatorias sco ON(sco.id_siadi_convocatoria = spa.id_siadi_convocatoria)
                    INNER JOIN siadi_gestions sg ON(sg.id_gestion = sco.id_gestion)
                    INNER JOIN siadi_modalidad_curso smc ON(smc.id_convocartoria_estudiante = sco.id_modalidad_curso)
                    INNER JOIN siadi_costos scos ON(scos.id_costo = sco.id_costo)

                    LEFT JOIN certificados_provisional cp ON(cp.id_nota = sn.id_nota)
                    WHERE smc.id_convocartoria_estudiante=1 
                        AND scos.tipo_costo = 'TGN'
                        AND sa.id_idioma = siadi_idiomas.id_idioma
                        AND sid.id_idioma = siadi_idiomas.id_idioma
                        AND sper.id_siadi_persona = siadi_personas.id_siadi_persona
                        AND sn.final_nota >= 51
                    -- ORDER BY sni.id_nivel_idioma ASC
                    GROUP BY sid.id_idioma
                ) id_inscrip_cert_notas")
        );
    }

    private function get_estudiante_certificados_notas(){
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
                ->join('certificados_provisional', 'certificados_provisional.id_nota', '=','siadi_notas.id_nota')
                #->leftJoin('certificados_reimpresions', 'certificados_reimpresions.')
            ->select('siadi_notas.id_nota',
                'siadi_notas.id_inscripcion AS id_inscripcion', 
                'certificados_provisional.id_certificado_provisional',
                'siadi_notas.final_nota',
                'certificados_provisional.fecha_siadi_certificado',
                DB::raw("CONCAT(certificados_provisional.tipo_curso, certificados_provisional.numero_siadi_certificado_prov, '/', certificados_provisional.gestion) AS codigo_certificado_provisional"),
                DB::raw("CONCAT(ci_persona, ' ', expedido_persona) AS ci"),
                'pais_persona',
                DB::raw("UPPER(CONCAT(CASE paterno_persona WHEN '' THEN '' ELSE concat(paterno_persona, ' ') END , ' ', materno_persona, ' ', nombres_persona)) AS nombres_persona"),
                DB::raw("CONCAT(siadi_idiomas.sigla_codigo_idioma, ' ', siadi_idiomas.nombre_idioma, ' ',siadi_nivel_idiomas.descripcion_nivel_idioma , ' ', siadi_nivel_idiomas.nombre_nivel_idioma) AS idioma"),
                'siadi_idiomas.nombre_idioma',
                DB::raw("CONCAT(siadi_convocatorias.periodo, '-', siadi_gestions.nombre_gestion) AS gestion"),
                'siadi_gestions.nombre_gestion AS anio',
                DB::raw("CASE 
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante=1 THEN CONCAT(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' (', siadi_costos.tipo_costo, ')')
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante=2 THEN 'EXAMEN DE SUFICIENCIA (AUTOFINANCIADO)'
                    WHEN siadi_modalidad_curso.id_convocartoria_estudiante IN(3, 6, 7, 8) THEN SUBSTRING_INDEX(siadi_modalidad_curso.nombre_convocatoria_estudiante, ' ', 1)
                    ELSE siadi_modalidad_curso.nombre_convocatoria_estudiante
                END AS modalidad"),
                'siadi_planificar_asignaturas.carga_horaria_planificar_asignartura  AS carga_horaria',
                
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
                    ->where('siadi_modalidad_curso.estado_convocatoria_estudiante', '<>', 'ELIMINAR')
                    ->where('siadi_costos.estado_costo', '<>', 'ELIMINAR');
            })
            ->where('siadi_notas.final_nota', '>=', '51')
            # ->where('siadi_notas.observacion_nota', 'APROBADO')
            ->where('ci_persona', $this->search)
            ->orderBy('siadi_convocatorias.periodo', 'asc')
            ->orderBy('siadi_gestions.nombre_gestion', 'asc')
            #->groupBy('siadi_idiomas.id_idioma')
            #->get(); # si se usa paginate, no sirve esto
            ->get();
        return $estudiantes;
    }

    public function mount(){
        $this->search = '8283658'; #'7088751';
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
        } 
        return array_merge($this->rulesForSave(), $this->rulesForPrint()
        );
    }

    public $nro_disponible_prov;
    public $inicial_prov;
    public $anio_prov;
    public $nro_prov;
    protected function rulesForSave(){
        return [
            'nro_disponible_prov' => 'required',
            'inicial_prov' => 'required|size:1|alpha|uppercase',
            'anio_prov' => 'required',
            'nro_prov' => 'required|integer|between:'.$this->nroMin.','.$this->nroMax,
            
        ];
    }

    public $fechaImpresion;
    protected function rulesForPrint(){
        return [
            'fechaImpresion' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:'. now()->toDateString(),
                'before_or_equal:' . now()->toDateString(), // No debe ser después de la fecha actual
            ],
        ];
    }
    /* *********** END RULES ********* */





    /* ************ INICIO ASIGNACIÓN DE NOMBRES attributes ****************** */
    protected $validationAttributes = [
        # rulesForSave
        'nro_disponible_prov' => '"Números Disponibles"',
        'inicial_prov' => '"Inicial"',
        'anio_prov' => '"Año"',
        'nro_prov' => '"Número"',

        # rulesForPrint
        'fechaImpresion' => '"Fecha de Impresión"',
    ];
    /* ************** FIN ASIGNACIÓN NOMBRES attributes ********************** */


    /* ********************* start updates for rulesForSave ************************ */
    public $nroMax, $nroMin;
    public $boton_estado = false;
    public function actualizaNroDisponibleProv(){
        #$this->emit("Mostrar", "ds". $this->nro_disponible_prov);
        if($this->nro_disponible_prov==''){
            $this->boton_estado = false;
            $this->nro_prov = $this->nroMax = $this->nroMin = "";
        } else {
            if(count(explode('-', $this->nro_disponible_prov))==2){
                $this->nroMin = explode('-', $this->nro_disponible_prov)[0];
                $this->nroMax = explode('-', $this->nro_disponible_prov)[1];
                $this->nro_prov = $this->nroMin;
                $this->boton_estado = true;
                $this->validateOnly('nro_prov');
            } else {
                $this->nro_prov = $this->nroMax = $this->nroMin = $this->nro_disponible_prov;
                $this->boton_estado = false;
            }
        }
    }

    public function updatedNroProv(){
        //$this->nro_prov = $this->nroMax = $this->nroMin = "";
        //$this->statusNro = false;
        if($this->anio_prov==''){
            $this->resetValidation('nro_prov');
        }
    }

    public function actualizaAnioProv(){
        if($this->anio_prov==''){
            $this->resetValidation('nro_disponible_prov');
            $this->nro_prov = $this->nroMax = $this->nroMin = $this->nro_disponible_prov = "";;
            $this->boton_estado = false;
        } else {
            $this->validateOnly('nro_disponible_prov');
        }
    }

    public function mas_nro_prov(){
        if(!is_null($this->nroMax) || $this->nroMax!==""){
            if($this->nro_prov > $this->nroMax ){
                $this->nro_prov = $this->nroMax;
            }else if( $this->nro_prov < $this->nroMin){
                $this->nro_prov = $this->nroMin;
            }else if($this->nro_prov < $this->nroMax){
                $this->nro_prov++;
            }
            $this->resetValidation('nro_disponible_prov');
        }
    }

    public function menos_nro_prov(){
        if(!is_null($this->nroMin || $this->nroMin!=="")){
            if($this->nro_prov<$this->nroMin){
                $this->nro_prov = $this->nroMin;
            } else if($this->nro_prov > $this->nroMax){
                $this->nro_prov = $this->nroMax;
            }else if($this->nro_prov > $this->nroMin){
                $this->nro_prov--;
            }
            $this->resetValidation('nro_prov');
        }
    }

    public function cancelar(){
        $this->operation = '';
        $this->reset([
            'nro_disponible_prov',
            'inicial_prov',
            'nro_prov',
            'anio_prov'
        ]);
        $this->datos_certificado_gen = null;
        $this->id_nota = null;
        $this->boton_estado = false;
        $this->nro_prov = $this->nroMin = $this->nroMax = "";

        $this->resetValidation();
    }

    public $datos_certificado_gen = null;
    public $id_nota = null;
    public function abrir_form_create($icd_inscripcion){
        $this->cancelar();

        $fechaActual = Carbon::now(); 
        $this->anio_prov = $fechaActual->format('Y');

        $cer = new CertificadosProvisional();
        $this->datos_certificado_gen = $cer->get_data_estudiante_inscrito_aprobado($icd_inscripcion);
        $this->emit("Mostrar", ">: ". json_encode($this->datos_certificado_gen));
        if(is_null($this->datos_certificado_gen)){
            $this->emit('vacio', 'No se encontro datos');
            return;
        }
        
        # existe llenar datos y mostrar
        $this->operation = 'guardar';
        $this->inicial_prov = $this->datos_certificado_gen->inicial;
        $this->id_nota = $this->datos_certificado_gen->id_nota;
        $this->datos_certificado_gen = json_encode($this->datos_certificado_gen);
        $this->emit("showModalCreateCertProv");
    }


    public function guardar_certificado_provisional($icmprimir = false){
        if($this->operation=='guardar' && !is_null($this->id_nota) && $this->id_nota!==""){
            #$this->emit("Mostrar", 'hola '. $this->id_nota);
            $fecha = Carbon::now();
            $this->validate();
            try {
                DB::beginTransaction();
                #$tmp_cert = json_decode($this->datos_inscripcion_estudiante, false);
                $certificado_provisional = new CertificadosProvisional();
                $certificado_provisional->id_nota = $this->id_nota;
                $certificado_provisional->gestion = $this->anio_prov;
                $certificado_provisional->numero_siadi_certificado_prov = str_pad($this->nro_prov, 4, "0",  STR_PAD_LEFT);
                $certificado_provisional->tipo_curso = $this->inicial_prov. "-";
                $certificado_provisional->fecha_siadi_certificado = $fecha->format('Y-m-d');
                $certificado_provisional->estado_siadi_certificado_provisional = 'ACTIVO';
                $certificado_provisional->id_usuario = Auth::user()->id;
                #$this->emit("Mostrar", json_encode($certificado_provisional));
                $certificado_provisional->save();
                DB::commit();
                
                $this->emit('closeModalCreateCertProv');
                
                $this->emit('alert','El certificado provisional se guardó satisfactoriamente');
                $this->cancelar();
            } catch (\Exception $e) {
                DB::rollback();
                #throw $e;
                $this->emit("errorvalidate", "Ups. Ocurrio un error al generar certificado \n". $e->getMessage());
            }
        } else {
            $this->emit('errorvalidate', 'Operación no permitida');
            $this->cancelar();
            $this->emit("closeModalCreateCertProv");
        }
    }
    /* ********************** end updates for rulesForSave ************************* */



    /* public function mount($asignatura_actual)
    {
        $this->asignatura_actual = $asignatura_actual;
    } */

    /* ********************* start for rulesForPrint ******************************** */
    public $dataImpresion;
    public $idActualCertificadoProv;
    public function mostrar_certificado_provisional($icd_certificado){
        $this->operation = 'imprimir';
        $this->cancelar_impresion(); 
        $cert = new CertificadosProvisional();
        $certificado_prov = $cert->get_data_certifcado($icd_certificado);
        if(is_null($certificado_prov)){
            $this->emit('vacio', 'No se encontró certificado provisional.');
            return;
        } else {
            /* $this->datosImpresion = [
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
            ]; */
            $tmp = json_encode($certificado_prov);
            $this->dataImpresion = json_decode($tmp, true);
            $this->idActualCertificadoProv = $certificado_prov->id_certificado_provisional;
            $this->fechaImpresion = $certificado_prov->fecha;
            $this->emit('showModalImprimirCertificadoProv');
        }
    }

    public function cancelar_impresion(){
        $this->reset([
            'fechaImpresion'
        ]);
        $this->dataImpresion = null;
        $this->idActualCertificadoProv = null;
        $this->emit('closeModalImprimirCertificadoProv');
    }

    public function imprimir(){
        $this->validate();

        #verficar si la fecha es igual a la anterior
        if($this->operation=="imprimir" && !is_null($this->dataImpresion) && !is_null($this->idActualCertificadoProv)){
            $this->validate();
            if($this->dataImpresion['fecha'] !== $this->fechaImpresion){
                try { 
                    DB::beginTransaction();
    
                    $certificado_prov = CertificadosProvisional::findOrFail($this->idActualCertificadoProv); #findOrFail
                    $certificado_prov->fecha_siadi_certificado = $this->fechaImpresion;
                    $certificado_prov->id_usuario = Auth::user()->id;
                    $certificado_prov->save();
    
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    #throw $e;
                    $this->emit("Error", "Ups. Ocurrio un error al actualizar fecha ". $e->getMessage());
                    return;
                }
            }
            
            if($this->dataImpresion['es_tgn']=="SI"){
                $url = route('reporte_pdf_certificado_prov_notas', ['id_nota' => $this->idActualCertificadoProv]);
            }else{
                $url = route('impresion_certificado_provisional', [
                    'id_certificado_provisional' => $this->idActualCertificadoProv
                ]);
            }
            $this->cancelar_impresion();
            $this->emit('abrirNuevaPestania', $url);
        } else {
            $this->emit('errorvalidate', 'Operación no permitida');
            $this->cancelar_impresion();
        }
        
    }
    /* ********************** end for rulesForPrint ******************************** */

    
}
