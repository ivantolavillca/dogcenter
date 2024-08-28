<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiInscripcion;
use App\Models\AdministracionModulos\SiadiNota;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use Illuminate\Support\Facades\Auth;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class ConvalidacionHomologacionIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'render', 'delete',
    ];

    public function mount(){
        $this->search = "8283658";
    }

    private $FECHA_MINIMA_INSCRIPCION = "2000-09-05";
    private $MONTO_MINIMO_INSCRIPCION = "0";
    private $MONTO_MAXIMO_INSCRIPCION = "1500";
    /* ------------------------  INIT RULES ----------------------- */
    public $operation;
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        # tipo de operacion
        if($this->operation=='guardar_convalidacion'){
            return $this->rulesForSaveConvalidacion();
        } else if($this->operation=='guardar_homologacion'){ 
            return $this->rulesForSaveHomologacion();
        } 
        return array_merge($this->rulesForSaveConvalidacion(), $this->rulesForSaveHomologacion()
        );
    }

    protected function rulesForSaveConvalidacion(){
        $rule_nro_deposito = $this->tipo_pago_inscripcion=="Depósito"? 'required|digits_between:5,15': 'nullable';
        return [
            'id_planificar_asignatura' => 'required',
            'tipo_pago_inscripcion' => 'required',
            'fecha_inscripcion' => 'required|date|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA_INSCRIPCION .'|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
            'monto_deposito' => 'required|integer|between:'. $this->MONTO_MINIMO_INSCRIPCION .','. $this->MONTO_MAXIMO_INSCRIPCION,
            'nro_folio_nota' => 'nullable|integer|min:0|max:10000',
            'nro_carpeta_nota' => 'nullable|integer|min:0|max:10000',

            'nro_deposito' => $rule_nro_deposito,
        ];
    }

    protected function rulesForSaveHomologacion(){
        return [];
    }

    protected $validationAttributes = [
        'id_planificar_asignatura' => '"Asignaturas Disponibles"',
        'fecha_inscripcion' => '"FECHA DE INSCRIPCIÓN"',
        'tipo_pago_inscripcion' => '"TIPO DE PAGO"',
        'monto_deposito' => '"MONTO DE DEPÓSITO"',
        'nro_deposito' => '"NÚMERO DE DEPÓSITO"',

        'nro_folio_nota' => '"NRO. DE FOLIO"',
        'nro_carpeta_nota' => '"NRO. DE LIBRO"'
    ];
    /* ------------------------   END RULES ----------------------- */

    public $search = '';
    public $materias = array();
    public $materia = null;

    public $titulo_nivel;
    public $titulo_idioma;
    public $titulo_nivel_numerico;
    public $promedio;

    public $id_planificar_asignatura;
    public $tipo_pago_inscripcion;
    public $fecha_inscripcion;
    public $nro_deposito;
    public $monto_deposito;

    public $nro_folio_nota;
    public $nro_carpeta_nota;

    public $nivelConvalidacion;

    public function cancelar()
    {
        $this->operation = "";
        $this->reset([
            'id_planificar_asignatura',
            'tipo_pago_inscripcion',
            'fecha_inscripcion',
            'nro_deposito',
            'monto_deposito',

            'nro_folio_nota',
            'nro_carpeta_nota',
        ]);
        $this->resetValidation();
        $this->emit("closeModalConvalidacion");
    }

    public function verificarConvalidacion($materia)
    {
        $this->cancelar();
        $verificar = SiadiInscripcion::join('siadi_planificar_asignaturas AS spa', 'siadi_inscripcions.id_planificar_asignatura', '=', 'spa.id_planificar_asignatura')
            ->join('siadi_convocatorias AS sc', 'sc.id_siadi_convocatoria', '=', 'spa.id_siadi_convocatoria')
            #->join('siadi_tipo_convocatorias AS stc', 'stc.id_tipo_convocatoria', '=', 'sc.id_tipo_convocatoria')
            #->join('siadi_convocartoria_estudiantes AS sce', 'sce.id_convocartoria_estudiante', '=', 'stc.id_convocartoria_estudiante')
            ->join('siadi_modalidad_curso AS smc', 'smc.id_convocartoria_estudiante', '=', 'sc.id_modalidad_curso')
            ->join('siadi_asignaturas AS sa', 'sa.id_siadi_asignatura', '=', 'spa.id_siadi_asignatura')
            ->join('siadi_idiomas AS si', 'si.id_idioma', '=', 'sa.id_idioma')
            ->select('siadi_inscripcions.id_inscripcion')
            ->where('siadi_inscripcions.id_siadi_persona', '=', $materia['id_siadi_persona'])
            ->where('si.id_idioma', '=', $materia['id_idioma'])
            ->where('smc.nombre_convocatoria_estudiante', 'LIKE', '%CONVALIDA%')
            ->where('smc.nombre_convocatoria_estudiante', 'LIKE', '%DEPARTAMENTO IDIOMA%')
            ->get();

        if (count($verificar) == 0) {

            $basico = round( ($materia['1.1'] + $materia['1.2']) / 2, 0);
            $intermedio = round( ($basico + (($materia['2.1'] + $materia['2.2']) / 2)) / 2, 0);
            $avanzado = round( ($intermedio + (($materia['3.1'] + $materia['3.2']) / 2)) / 2, 0);

            if ($basico > 50) {
                if ((($materia['2.1'] + $materia['2.2']) / 2) > 50 && $intermedio > 50) {
                    if ((($materia['3.1'] + $materia['3.2']) / 2) > 50 && $avanzado > 50) {
                        // CONVALIDACION NIVEL AVANZADO
                        $this->titulo_nivel = 'AVANZADO';
                        $this->titulo_nivel_numerico = "3.2";
                        $this->titulo_idioma = $materia['nombre'];
                        $this->promedio = $avanzado;
                        $this->materia = $materia;
                        $this->emit('openModalConvalidacion');
                    } else {
                        // CONVALIDACION NIVEL INTERMEDIO
                        $this->titulo_nivel = 'INTERMEDIO';
                        $this->titulo_nivel_numerico = "2.2";
                        $this->titulo_idioma = $materia['nombre'];
                        $this->promedio = $intermedio;
                        $this->materia = $materia;
                        $this->emit('openModalConvalidacion');
                    }
                } else {
                    // CONVALIDACION NIVEL BASICO
                    $this->titulo_nivel = 'BÁSICO';
                    $this->titulo_nivel_numerico = "1.2";
                    $this->titulo_idioma = $materia['nombre'];
                    $this->promedio = $basico;
                    $this->materia = $materia;
                    $this->emit('openModalConvalidacion');
                }
                $this->operation = "guardar_convalidacion";
            } else {
                $this->emit('alerta_gary', 'No se puede convalidar', 'El estudiante debe aprobar el nivel Básico', 'error');
            }
        } else {
            $this->emit('alerta_gary', 'No se puede convalidar', 'El estudiante ya se encuentra Convalidado en el Idioma', 'error');
        }
    }

    public function verificarHomologacion($materia)
    {
        $verificarHom = SiadiInscripcion::join('siadi_planificar_asignaturas AS spa', 'siadi_inscripcions.id_planificar_asignatura', '=', 'spa.id_planificar_asignatura')
            ->join('siadi_convocatorias AS sc', 'sc.id_siadi_convocatoria', '=', 'spa.id_siadi_convocatoria')
            ->join('siadi_tipo_convocatorias AS stc', 'stc.id_tipo_convocatoria', '=', 'sc.id_tipo_convocatoria')
            ->join('siadi_convocartoria_estudiantes AS sce', 'sce.id_convocartoria_estudiante', '=', 'stc.id_convocartoria_estudiante')
            ->join('siadi_asignaturas AS sa', 'sa.id_siadi_asignatura', '=', 'spa.id_siadi_asignatura')
            ->join('siadi_idiomas AS si', 'si.id_idioma', '=', 'sa.id_idioma')
            ->select('siadi_inscripcions.id_inscripcion')
            ->where('siadi_inscripcions.id_siadi_persona', '=', $materia['id_siadi_persona'])
            ->where('si.id_idioma', '=', $materia['id_idioma'])
            ->where('sce.nombre_convocatoria_estudiante', 'LIKE', '%HOMOLOGA%')
            ->where('sce.nombre_convocatoria_estudiante', 'LIKE', '%DEPARTAMENTO IDIOMA%')
            ->get();
        // dd($verificarHom);

        if (count($verificarHom) == 0) {
            $verificarConv = SiadiInscripcion::join('siadi_planificar_asignaturas AS spa', 'siadi_inscripcions.id_planificar_asignatura', '=', 'spa.id_planificar_asignatura')
                ->join('siadi_convocatorias AS sc', 'sc.id_siadi_convocatoria', '=', 'spa.id_siadi_convocatoria')
                ->join('siadi_tipo_convocatorias AS stc', 'stc.id_tipo_convocatoria', '=', 'sc.id_tipo_convocatoria')
                ->join('siadi_convocartoria_estudiantes AS sce', 'sce.id_convocartoria_estudiante', '=', 'stc.id_convocartoria_estudiante')
                ->join('siadi_asignaturas AS sa', 'sa.id_siadi_asignatura', '=', 'spa.id_siadi_asignatura')
                ->join('siadi_idiomas AS si', 'si.id_idioma', '=', 'sa.id_idioma')
                ->join('siadi_nivel_idiomas AS sni', 'sni.id_nivel_idioma', '=', 'sa.id_nivel_idioma')
                ->join('siadi_notas AS sn', 'sn.id_inscripcion', '=', 'siadi_inscripcions.id_inscripcion')
                ->select('siadi_inscripcions.id_inscripcion', 'sn.nota_convalidacion', 'sni.nombre_nivel_idioma')
                ->where('siadi_inscripcions.id_siadi_persona', '=', $materia['id_siadi_persona'])
                ->where('si.id_idioma', '=', $materia['id_idioma'])
                ->where('sce.nombre_convocatoria_estudiante', 'LIKE', '%CONVALIDA%')
                ->where('sce.nombre_convocatoria_estudiante', 'LIKE', '%DEPARTAMENTO IDIOMA%')
                ->get();
            if (count($verificarConv) == 1) {
                switch ($verificarConv[0]->nombre_nivel_idioma) {
                    case '3.2':
                        // CONVALIDACION NIVEL AVANZADO
                        $this->titulo_nivel = 'AVANZADO';
                        $this->titulo_nivel_numerico = "3.2";
                        $this->titulo_idioma = $materia['nombre'];
                        $this->promedio = $verificarConv[0]->nota_convalidacion;
                        $this->materia = $materia;
                        $this->emit('openModalHomologacion');
                        break;
                    case '2.2':
                        // CONVALIDACION NIVEL INTERMEDIO
                        $this->titulo_nivel = 'INTERMEDIO';
                        $this->titulo_nivel_numerico = "2.2";
                        $this->titulo_idioma = $materia['nombre'];
                        $this->promedio = $verificarConv[0]->nota_convalidacion;
                        $this->materia = $materia;
                        $this->emit('openModalHomologacion');
                        break;
                    case '1.2':
                        // CONVALIDACION NIVEL BASICO
                        $this->titulo_nivel = 'BÁSICO';
                        $this->titulo_nivel_numerico = "1.2";
                        $this->titulo_idioma = $materia['nombre'];
                        $this->promedio = $verificarConv[0]->nota_convalidacion;
                        $this->materia = $materia;
                        $this->emit('openModalHomologacion');
                        break;
                    default:
                        break;
                }
            } else {
                $this->emit('alerta_gary', 'No se puede convalidar', 'El estudiante debe convalidarse en el Idioma.', 'error');
            }
        } else {
            $this->emit('alerta_gary', 'No se puede convalidar', 'El estudiante ya se encuentra Homologado en el Idioma', 'error');
        }
    }

    public function getCosto()
    {
        if ($this->id_planificar_asignatura) {
            $monto = SiadiPlanificarAsignatura::join('siadi_convocatorias AS sc', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'sc.id_siadi_convocatoria')
                #->join('siadi_tipo_convocatorias AS stc', 'sc.id_tipo_convocatoria', '=', 'stc.id_tipo_convocatoria')
                #->join('siadi_costos AS scs', 'stc.id_costo', '=', 'scs.id_costo')
                ->join('siadi_modalidad_curso AS smc', 'smc.id_convocartoria_estudiante', '=', 'sc.id_modalidad_curso')
                ->select('sc.monto_convocatoria')
                ->where('siadi_planificar_asignaturas.id_planificar_asignatura', '=', $this->id_planificar_asignatura)
                ->first();
            if(!is_null($monto)){
                $this->monto_deposito = (is_null($monto->monto_convocatoria))? "": $monto->monto_convocatoria;
            } else {
                $this->monto_deposito = "";
            }
        }
    }

    public function convalidarEstudianteAsignatura()
    {
        $this->validate();
        try {
		DB::beginTransaction();
        $nuevaInscripcion = new SiadiInscripcion();
        $nuevaInscripcion->id_siadi_persona = $this->materia['id_siadi_persona'];
        $nuevaInscripcion->id_planificar_asignatura = $this->id_planificar_asignatura;
        $nuevaInscripcion->fecha_inscripcion = $this->fecha_inscripcion;
        $nuevaInscripcion->observacion_inscripcion = 'CONVALIDACIÓN DEPARTAMENTO DE IDIOMAS';

        if ($this->tipo_pago_inscripcion == 'Depósito') {
            $nuevaInscripcion->nro_deposito = $this->nro_deposito;
        }

        $nuevaInscripcion->tipo_pago_inscripcion = $this->tipo_pago_inscripcion;
        $nuevaInscripcion->monto_deposito = $this->monto_deposito;
        $nuevaInscripcion->id_usuario = Auth::user()->id;
        $nuevaInscripcion->save();

        /*$inscripcion = SiadiInscripcion::where('id_planificar_asignatura', '=', $this->id_planificar_asignatura)
            ->where('id_siadi_persona', '=', $this->materia['id_siadi_persona'])
            ->select('id_inscripcion')
            ->orderBy('id_planificar_asignatura', 'desc')
            ->first();*/

        $nuevaNota = new SiadiNota();
        $nuevaNota->id_inscripcion = $nuevaInscripcion->id_inscripcion; #$inscripcion->id_inscripcion;
        $nuevaNota->final_nota = $this->promedio;
        $nuevaNota->nota_convalidacion = $this->promedio;
        $nuevaNota->nro_folio_nota = $this->nro_folio_nota;
        $nuevaNota->nro_carpeta_nota = $this->nro_carpeta_nota;
        $nuevaNota->observacion_nota = 'APROBADO';
        $nuevaNota->observaciones_detalle = 'CONVALIDACIÓN DEPARTAMENTO DE IDIOMAS';
        $nuevaNota->id_usuario = Auth::user()->id;
        $nuevaNota->save();
        #DB::commit();
		$this->emit('alerta_gary', 'Convalidacion true', 'inscripcion: '. json_encode($nuevaInscripcion). ' ;; nota: '. json_encode($nuevaNota), 'success');
		DB::rollback();
        #$this->emit('closeModalConvalidacion');
        $this->cancelar();
        $this->reset();
        #$this->emit('alerta_gary', 'Convalidacion', 'Materia convalidada correctamente', 'success');
        } catch(\Exception $e){
        	DB::rollback();
        	$this->emit('alerta_gary', 'ERROR AL GUARDAR', 'La operación no se realizo debido a: '. $e->getMessage(), 'error');
		}
    }


    public function homologarEstudianteAsignatura()
    {
        $this->validate([
            'id_planificar_asignatura' => 'required',
            'tipo_pago_inscripcion' => 'required',
            'fecha_inscripcion' => 'required',
            'monto_deposito' => 'required',
            'nro_folio_nota' => 'required',
            'nro_carpeta_nota' => 'required',
        ]);

        $nuevaInscripcion = new SiadiInscripcion();
        $nuevaInscripcion->id_siadi_persona = $this->materia['id_siadi_persona'];
        $nuevaInscripcion->id_planificar_asignatura = $this->id_planificar_asignatura;
        $nuevaInscripcion->fecha_inscripcion = $this->fecha_inscripcion;
        $nuevaInscripcion->observacion_inscripcion = 'CONVALIDACIÓN DEPARTAMENTO DE IDIOMAS';

        if ($this->tipo_pago_inscripcion == 'Depósito') {
            $this->validate([
                'nro_deposito' => 'required',
            ]);
            $nuevaInscripcion->nro_deposito = $this->nro_deposito;
        }

        $nuevaInscripcion->tipo_pago_inscripcion = $this->tipo_pago_inscripcion;
        $nuevaInscripcion->monto_deposito = $this->monto_deposito;
        $nuevaInscripcion->id_usuario = Auth::user()->id;
        $nuevaInscripcion->save();

        $inscripcion = SiadiInscripcion::where('id_planificar_asignatura', '=', $this->id_planificar_asignatura)
            ->where('id_siadi_persona', '=', $this->materia['id_siadi_persona'])
            ->select('id_inscripcion')
            ->orderBy('id_planificar_asignatura', 'desc')
            ->first();

        $nuevaNota = new SiadiNota();
        $nuevaNota->id_inscripcion = $inscripcion->id_inscripcion;
        $nuevaNota->final_nota = $this->promedio;
        $nuevaNota->nota_convalidacion = $this->promedio;
        $nuevaNota->nro_folio_nota = $this->nro_folio_nota;
        $nuevaNota->nro_carpeta_nota = $this->nro_carpeta_nota;
        $nuevaNota->observacion_nota = 'APROBADO';
        $nuevaNota->observaciones_detalle = 'CONVALIDACIÓN DEPARTAMENTO DE IDIOMAS';
        $nuevaNota->save();

        $this->emit('closeModalHomologacion');
        $this->reset();
        $this->emit('alerta_gary', 'Homologacion', 'Materia homologada correctamente', 'success');
    }

    public function render()
    {
        $asignaturas_conv = SiadiPlanificarAsignatura::join('siadi_convocatorias AS sc', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'sc.id_siadi_convocatoria')
            ->join('siadi_gestions AS sg', 'sg.id_gestion', '=', 'sc.id_gestion')
            #->join('siadi_tipo_convocatorias AS stc', 'sc.id_tipo_convocatoria', '=', 'stc.id_tipo_convocatoria')
            #->join('siadi_convocartoria_estudiantes AS sce', 'stc.id_convocartoria_estudiante', '=', 'sce.id_convocartoria_estudiante')
            ->join('siadi_modalidad_curso AS smc', 'smc.id_convocartoria_estudiante', '=', 'sc.id_modalidad_curso')
            ->join('siadi_asignaturas AS sa', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'sa.id_siadi_asignatura')
            ->join('siadi_idiomas AS si', 'sa.id_idioma', '=', 'si.id_idioma')
            ->join('siadi_nivel_idiomas AS sni', 'sa.id_nivel_idioma', '=', 'sni.id_nivel_idioma')
            ->select(
                'siadi_planificar_asignaturas.id_planificar_asignatura', 
                'sni.descripcion_nivel_idioma', 'si.nombre_idioma', 
                'sni.nombre_nivel_idioma', 'sc.nombre_convocatoria', 
                'smc.nombre_convocatoria_estudiante',

                # gestion de convocatoria
                DB::raw("CONCAT(sc.periodo, '/', sg.nombre_gestion) AS periodo_gestion"),
                
            )
            ->where('smc.nombre_convocatoria_estudiante', 'LIKE', '%CONVALIDA%')
            ->where('smc.nombre_convocatoria_estudiante', 'LIKE', '%DEPARTAMENTO IDIOMAS%') 
            ->where('sni.nombre_nivel_idioma', $this->titulo_nivel_numerico) # nivel que ha sido seleccionado
            ->where('sc.estado_convocatoria', '=', 'ACTIVO') # que la convocatoria este activa
            
            ->get();

        $asignaturas_hom = SiadiPlanificarAsignatura::join('siadi_convocatorias AS sc', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'sc.id_siadi_convocatoria')
            ->join('siadi_tipo_convocatorias AS stc', 'sc.id_tipo_convocatoria', '=', 'stc.id_tipo_convocatoria')
            ->join('siadi_convocartoria_estudiantes AS sce', 'stc.id_convocartoria_estudiante', '=', 'sce.id_convocartoria_estudiante')
            ->join('siadi_asignaturas AS sa', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'sa.id_siadi_asignatura')
            ->join('siadi_idiomas AS si', 'sa.id_idioma', '=', 'si.id_idioma')
            ->join('siadi_nivel_idiomas AS sni', 'sa.id_nivel_idioma', '=', 'sni.id_nivel_idioma')
            ->select('siadi_planificar_asignaturas.id_planificar_asignatura', 'sni.descripcion_nivel_idioma', 'si.nombre_idioma', 'sni.nombre_nivel_idioma', 'sc.nombre_convocatoria', 'sce.nombre_convocatoria_estudiante')
            ->where('sce.nombre_convocatoria_estudiante', 'LIKE', '%HOMOLOGA%')
            ->where('sce.nombre_convocatoria_estudiante', 'LIKE', '%DEPARTAMENTO IDIOMAS%')
            ->where('sni.nombre_nivel_idioma', $this->titulo_nivel_numerico) # nivel que ha sido seleccionado
            ->where('sc.estado_convocatoria', '=', 'ACTIVO') # que la convocatoria este activa
            ->get();

        $lista = [];
        if (strlen($this->search) >= 7) {
            $lista = SiadiNota::join('siadi_inscripcions as sins', 'siadi_notas.id_inscripcion', '=', 'sins.id_inscripcion')
                ->join('siadi_personas as sp', 'sins.id_siadi_persona', '=', 'sp.id_siadi_persona')
                ->join('siadi_planificar_asignaturas as spa', 'sins.id_planificar_asignatura', '=', 'spa.id_planificar_asignatura')
                ->join('siadi_asignaturas as sa', 'spa.id_siadi_asignatura', '=', 'sa.id_siadi_asignatura')
                ->join('siadi_idiomas as si', 'sa.id_idioma', '=', 'si.id_idioma')
                ->join('siadi_nivel_idiomas as sni', 'sa.id_nivel_idioma', '=', 'sni.id_nivel_idioma')
                ->join('siadi_convocatorias AS sc', 'sc.id_siadi_convocatoria', '=', 'spa.id_siadi_convocatoria')
                ->join('siadi_modalidad_curso AS smc', 'smc.id_convocartoria_estudiante', '=', 'sc.id_modalidad_curso')
                ->join('siadi_costos AS scto', 'scto.id_costo', '=', 'sc.id_costo')
                ->select('siadi_notas.final_nota', 'sni.nombre_nivel_idioma', 'si.id_idioma', 'si.nombre_idioma', 'sins.id_siadi_persona', 
                    'sp.ci_persona', 'sp.expedido_persona', 
                    'sp.paterno_persona', 'sp.materno_persona', 'sp.nombres_persona',
                    DB::raw("
                    (
                        SELECT 
                            sn2.final_nota
                        FROM siadi_notas sn2
                            JOIN siadi_inscripcions si2 ON(si2.id_inscripcion = sn2.id_inscripcion) 
                            JOIN siadi_planificar_asignaturas spa2 ON(spa2.id_planificar_asignatura = si2.id_planificar_asignatura)
                            JOIN siadi_convocatorias sc2 ON (sc2.id_siadi_convocatoria = spa2.id_siadi_convocatoria)
                            JOIN siadi_asignaturas sa2 ON(sa2.id_siadi_asignatura = spa2.id_siadi_asignatura)
                            JOIN siadi_nivel_idiomas sni2 ON(sni2.id_nivel_idioma = sa2.id_nivel_idioma)
                        WHERE 
                            sni.nombre_nivel_idioma = sni2.nombre_nivel_idioma -- preguntando el nivel consulta y subconsulta
                            AND sc.id_modalidad_curso = sc2.id_modalidad_curso -- preguntando la modalidad consulta y subconsulta
                            AND sc2.id_modalidad_curso = 3 -- 3: sea CONVALIDACIÓN DEPARTAMENTO IDIOMAS
                        LIMIT 1
                    )
                     convalidado")
                )
                
                ->where('sp.ci_persona', 'LIKE', '%' . $this->search . '%')
                ->where('smc.id_convocartoria_estudiante', '=', 1) # sea 1, CURSO REGULAR 
                ->where('scto.tipo_costo', '=', 'TGN') # además de curso regular sea TGN
                ->orderBy('si.id_idioma', 'ASC')
                ->orderBy('sins.id_siadi_persona', 'DESC')
                ->get();

            $this->materias = [];
            $mat = array(
                'id_idioma' => 0,
                'nombre' => '',
                '1.1' => 0,
                '1.2' => 0,
                '2.1' => 0,
                '2.2' => 0,
                '3.1' => 0,
                '3.2' => 0,
                'id_siadi_persona' => 0,
                'ci' => '',
                'expedido' => '',
                'paterno' => '',
                'materno' => '',
                'nombres' => '',
            );
            if (count($lista) > 0) {
                foreach ($lista as $list) {
                    if ($list->id_idioma == $mat['id_idioma'] && $list->id_siadi_persona == $mat['id_siadi_persona']) {
                        $mat[$list->nombre_nivel_idioma] = $list->final_nota;
                    } else {
                        if ($mat['id_idioma'] != 0 && $mat['id_siadi_persona'] != 0) {
                            array_push($this->materias, $mat);
                            $mat = array(
                                'id_idioma' => 0,
                                'nombre' => '',
                                '1.1' => 0,
                                '1.2' => 0,
                                '2.1' => 0,
                                '2.2' => 0,
                                '3.1' => 0,
                                '3.2' => 0,
                                'id_siadi_persona' => 0,
                                'ci' => '',
                                'expedido' => '',
                                'paterno' => '',
                                'materno' => '',
                                'nombres' => '',
                            );
                        }
                        $mat['id_idioma'] = $list->id_idioma;
                        $mat['nombre'] = $list->nombre_idioma;
                        $mat['id_siadi_persona'] = $list->id_siadi_persona;
                        $mat['ci'] = $list->ci_persona;
                        $mat['expedido'] = $list->expedido_persona;
                        $mat['paterno'] = $list->paterno_persona;
                        $mat['materno'] = $list->materno_persona;
                        $mat['nombres'] = $list->nombres_persona;
                        $mat[$list->nombre_nivel_idioma] = $list->final_nota;
                    }

                }
                array_push($this->materias, $mat);
            }
        } else {
            $lista = [];
        }
        return view('livewire.administracion-modulos.convalidacion-homologacion-index', compact('lista', 'asignaturas_conv', 'asignaturas_hom'));
    }
}
