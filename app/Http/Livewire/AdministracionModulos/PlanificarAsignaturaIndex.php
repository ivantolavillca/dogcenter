<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiAsignatura;
use App\Models\AdministracionModulos\SiadiConvocartoriaEstudiante;
use App\Models\AdministracionModulos\SiadiConvocatoria;
use App\Models\AdministracionModulos\SiadiCosto;
use App\Models\AdministracionModulos\SiadiGestion;
use App\Models\AdministracionModulos\SiadiParalelo;
use App\Models\AdministracionModulos\SiadiIdioma;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiNivelIdioma;
use App\Models\AdministracionModulos\SiadiNota;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use App\Models\base_upea\tabla_persona;
use App\Models\base_upea\tabla_vista_nombramiento_general;

class PlanificarAsignaturaIndex extends Component
{


    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    protected $paginationTheme = 'bootstrap';
    public $pages_show = 6;
    public $convocatoria_estudiante;
    public $tipo_estudiante;
    public $asignatura;
    public $carga_horaria = 160;
    public $id_paralelo;
    public $turno_paralelo;
    public $hora_inicio;
    public $hora_fin;
    public $cupo_minimo = 20;
    public $cupo_maximo = 40;
    public $fecha_inicio;
    public $fecha_fin;
    public $id_planificar_asignatura; # se usa para editar
    public $estilo_asignaturas = true;

    //BORRAR
    public function delete(SiadiPlanificarAsignatura $siadi_planificar_asignatura): void
    {
        $siadi_planificar_asignatura->estado_planificar_asignartura = 'ELIMINADO';
        $siadi_planificar_asignatura->update();
    }

    /* ****************** init rules ********************* */
    public $operation;
    public $action;
    public $estado_horas = true;
    public $FECHA_MINIMA_SUBIR_NOTA = "2015-01-01";

    public function rules() {
        if($this->operation=='guardar'){
            return $this->rulesForSave();
        } else if( $this->operation == 'editar'){
            return $this->rulesForEdit();
        } else if($this->operation == 'limite_subir_nota'){
            return $this->rulesForUploadNote();
        } else if($this->operation == 'limite_subir_nota_convocatoria'){
            return $this->rulesForUploadNoteConvocatoria();
        } else if($this->operation == 'editar_nota_folio'){
            return $this->rulesForUpdateFolioLibro();
        } else if($this->operation == 'asignar_docente'){
            return $this->rulesForAsignDocente();
        }
        return array_merge($this->rulesForSave(), $this->rulesForEdit(),
            $this->rulesForUploadNote(),
            $this->rulesForUploadNoteConvocatoria(),
            $this->rulesForUpdateFolioLibro(),
            $this->rulesForAsignDocente()
        );
    } 
    protected function rulesForSave(){
        $fecha = "";
        try{
            $fecha = Carbon::parse($this->fecha_inicio)->addMonth(9)->format('Y-m-d');
        }catch(\Exception $e){
            #nada
        }

        # para validar horarios 
        $rule_hora_init = $this->getRulesHoraInicio();
        $rule_horas_end = $this->getRulesHoraFin();
        
        return [
            'convocatoria_estudiante' => 'required',
            'asignatura' => 'required',
            'id_paralelo' => 'required',
            'turno_paralelo' => 'required',
            'cupo_minimo' => 'required|numeric|min:20',
            'cupo_maximo' => 'required|numeric|min:'. ($this->cupo_minimo==""?0: $this->cupo_minimo). '|max:1000',
            'carga_horaria' => 'required|numeric|min:100|max:200',
            'fecha_inicio' => 'required|date_format:Y-m-d|after_or_equal:2000-09-05|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
            'fecha_fin' => 'required|date_format:Y-m-d|after:'. $this->fecha_inicio. '|before_or_equal:'. $fecha,
            'hora_inicio' => 'required|date_format:H:i'. $rule_hora_init,
            'hora_fin' => 'required|date_format:H:i'. $rule_horas_end,
        ];
    }

    protected function rulesForEdit(){
        $fecha = "";
        try{
            $fecha = Carbon::parse($this->fecha_inicio)->addMonth(9)->format('Y-m-d');
        }catch(\Exception $e){
            #nada
        }

        # para validar horarios 
        $rule_hora_init = $this->getRulesHoraInicio();
        $rule_horas_end = $this->getRulesHoraFin();
        
        return [
            'convocatoria_estudiante' => 'required',
            'asignatura' => 'required',
            'id_paralelo' => 'required',
            'turno_paralelo' => 'required',
            'cupo_minimo' => 'required|numeric|min:20',
            'cupo_maximo' => 'required|numeric|min:'. ($this->cupo_minimo==""?0: $this->cupo_minimo). '|max:1000',
            'carga_horaria' => 'required|numeric|min:100|max:200',
            'fecha_inicio' => 'required|date_format:Y-m-d|after_or_equal:2000-09-05|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
            'fecha_fin' => 'required|date_format:Y-m-d|after:'. $this->fecha_inicio. '|before_or_equal:'. $fecha,
            'hora_inicio' => 'required|date_format:H:i'. $rule_hora_init,
            'hora_fin' => 'required|date_format:H:i'. $rule_horas_end,
        ];
    }

	public $estado_docente;
    protected function rulesForUploadNote(){
        return [
            'fecha_limite_notas' => 'required|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA_SUBIR_NOTA .'|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
            'estado_docente' => ''
        ];
    }
    
    public $fecha_limite_notas_conv;
    public $estado_docente_conv;
    public $convocatoria_actual_subir_nota;
    protected function rulesForUploadNoteConvocatoria(){
        return [
            'fecha_limite_notas_conv' => 'required|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA_SUBIR_NOTA .'|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
            'estado_docente_conv' => ''
        ];
    }

    public $plan_asignatura_actual_folio_materia;
    public $libro_notas_materia;
    public $nro_folio_materia;
    protected function rulesForUpdateFolioLibro(){
        return [
            'libro_notas_materia' => 'nullable|numeric|min:1|max:3000',
        'nro_folio_materia' => 'nullable|numeric|min:1|max:3000'
        ];
    }

    public $plan_asignatura_docente;
    public $buscar_ci_docente;
    public $id_base_upea_docente;
    public $id_nombramiento_docente;
    public $nro_resolucion_hcc_examen;
    protected function rulesForAsignDocente(){
        return [
            'id_base_upea_docente' => 'nullable',
            'id_nombramiento_docente' => 'nullable',
            'nro_resolucion_hcc_examen' => 'nullable|string|min:3'
        ];
    }

    /* ****************** end rules  ******************** */
    protected $validationAttributes = [
        # rulesForSave
        'convocatoria_estudiante' => '"CONVOCATORIA"',
        'asignatura' => '"ASIGNATURA"',
        'id_paralelo' => '"PARALELO"',
        'turno_paralelo' => '"TURNO PARALELO"',
        'cupo_minimo' => '"CUPO MÍNIMO"',
        'cupo_maximo' => '"CUPO MÁXIMO"',
        'carga_horaria' => '"CARGA HORARIA"',
        'fecha_inicio' => '"FECHA DE INICIO CLASES"',
        'fecha_fin' => '"FECHA FIN"',
        'hora_inicio' => '"HORARIO DE INICIO"',
        'hora_fin' => '"HORARIO FIN"',

        # rulesForUploadNote
        'fecha_limite_notas' => '"FECHA LÍMITE"',
        'estado_docente' => '"Estado docente"',
        
        # rulesForUploadNote
        'fecha_limite_notas_conv' => '"FECHA LÍMITE"',
        'estado_docente_conv' => '"Estado docente"',

        # rulesForUpdateFolioLibro
        'libro_notas_materia' => '"Libro de Actas"',
        'nro_folio_materia' => '"Número de Folio"',

        # rulesForAsignDocente
        'id_base_upea_docente' => '"Docente"',
        'id_nombramiento_docente' => '"Nombramiento Docente"',
        'nro_resolucion_hcc_examen' => '"Resolución RHCC"'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

    }
    public $title_form = "";

    public function agregar_asignatura() {
        $this->cancelar();
        $this->title_form = "AGREGAR PLANIFICACIÓN ASIGNATURA";
        $this->action = "guardar_planificar_asignatura";
        $this->operation = 'guardar';
        $this->emit('openModalCreate');
    }

    public function cancelar() {
        $this->operation = '';
        $this->action = "";
        $this->reset([
            'convocatoria_estudiante',
            'asignatura',
            'id_paralelo',
            'turno_paralelo',
            'cupo_minimo',
            'cupo_maximo',
            'carga_horaria',
            'fecha_inicio',
            'fecha_fin',
            'hora_inicio',
            'hora_fin'
        ]);
        $this->resetValidation();
        $this->title_form = "";
        $this->id_planificar_asignatura = null;
    }

    public function guardar_planificar_asignatura()
    {
        $this->validate();

        $guardar_planificar_asignatura = new SiadiPlanificarAsignatura();
        $guardar_planificar_asignatura->id_siadi_convocatoria  = $this->convocatoria_estudiante;
        $guardar_planificar_asignatura->id_siadi_asignatura = $this->asignatura;
        $guardar_planificar_asignatura->id_paralelo = $this->id_paralelo;
        $guardar_planificar_asignatura->turno_paralelo = $this->turno_paralelo;
        $guardar_planificar_asignatura->cupo_minimo_paralelo = $this->cupo_minimo;
        $guardar_planificar_asignatura->cupo_maximo_paralelo = $this->cupo_maximo;
        $guardar_planificar_asignatura->carga_horaria_planificar_asignartura = $this->carga_horaria;
        $guardar_planificar_asignatura->hora_clases_inicio = $this->hora_inicio;
        $guardar_planificar_asignatura->hora_clases_fin =  $this->hora_fin;
        $guardar_planificar_asignatura->fecha_inicio = $this->fecha_inicio;
        $guardar_planificar_asignatura->fecha_fin = $this->fecha_fin;

        $guardar_planificar_asignatura->id_usuario = Auth::user()->id;
        $guardar_planificar_asignatura->save();

        $this->cancelar();
        $this->emit('closeModalCreate');
        $this->emit('alert', 'Planificar asignatura se guardó satisfactoriamente');

    }

    //EDITAR PLANIFICAR ASIGNATURA
    public $convocatoria_estudiante2;
    public $id_tipo_convocatoria_actual;
    public function editar_planificar_asignatura(SiadiPlanificarAsignatura $planificar_asignatura)
    {
        if(!is_null($planificar_asignatura)){
            $this->cancelar();
            // dd($planificar_asignatura);
            $this->id_planificar_asignatura = $planificar_asignatura->id_planificar_asignatura;
            $this->convocatoria_estudiante = $planificar_asignatura->id_siadi_convocatoria;
            $this->asignatura = $planificar_asignatura->id_siadi_asignatura;
            $this->id_paralelo = $planificar_asignatura->id_paralelo;
            $this->turno_paralelo = $planificar_asignatura->turno_paralelo;
            $this->cupo_minimo = $planificar_asignatura->cupo_minimo_paralelo;
            $this->cupo_maximo = $planificar_asignatura->cupo_maximo_paralelo;
            $this->carga_horaria = $planificar_asignatura->carga_horaria_planificar_asignartura;
            $this->hora_inicio = $planificar_asignatura->hora_clases_inicio;
            $this->hora_fin = $planificar_asignatura->hora_clases_fin;
            $this->fecha_inicio = $planificar_asignatura->fecha_inicio;
            $this->fecha_fin = $planificar_asignatura->fecha_fin;
            
            $this->title_form = "EDITAR PLANIFICACIÓN ASIGNATURA";
            $this->operation = 'editar';
            $this->action = "guardarEditado_planificarAsignatura";
            $this->emit('openModalCreate');
        } else {
            $this->emit("vacio", "No hay asignatura");
        }
    }

    public function cancelarEditar()
    {
        $this->reset([
            'id_planificar_asignatura',
            'convocatoria_estudiante',
            'asignatura',
            'id_paralelo',
            'turno_paralelo',
            'cupo_minimo',
            'cupo_maximo',
            'carga_horaria',
        ]);
        $this->resetValidation();

    }
    public function guardarEditado_planificarAsignatura()
    {
        $this->validate();
        $guardarEditar_planificar_asignatura = SiadiPlanificarAsignatura::find($this->id_planificar_asignatura);
        $guardarEditar_planificar_asignatura->id_siadi_convocatoria = $this->convocatoria_estudiante;
        $guardarEditar_planificar_asignatura->id_siadi_asignatura = $this->asignatura;
        $guardarEditar_planificar_asignatura->id_paralelo = $this->id_paralelo;
        $guardarEditar_planificar_asignatura->turno_paralelo = $this->turno_paralelo;
        $guardarEditar_planificar_asignatura->cupo_minimo_paralelo = $this->cupo_minimo;
        $guardarEditar_planificar_asignatura->cupo_maximo_paralelo = $this->cupo_maximo;
        $guardarEditar_planificar_asignatura->carga_horaria_planificar_asignartura = $this->carga_horaria;
        $guardarEditar_planificar_asignatura->hora_clases_inicio = $this->hora_inicio;
        $guardarEditar_planificar_asignatura->hora_clases_fin =  $this->hora_fin;
        $guardarEditar_planificar_asignatura->fecha_inicio = $this->fecha_inicio;
        $guardarEditar_planificar_asignatura->fecha_fin = $this->fecha_fin;
        $guardarEditar_planificar_asignatura->id_usuario = Auth::user()->id;
        $guardarEditar_planificar_asignatura->save();

        $this->cancelar();
        $this->emit('closeModalCreate');
        #$this->emit('closeModalEdit');
        $this->emit('alert', 'Se editó satisfactoriamente');
    }

    public $titulo_aignatura = "";
    public $fecha_limite_notas;
    public function subir_nota_limite(SiadiPlanificarAsignatura $planificar_asignatura)
    {
        if(!is_null($planificar_asignatura)){
            $this->cancelar_subir_nota();
            $this->titulo_aignatura = $planificar_asignatura->siadi_asignatura->idioma->nombre_idioma. ' '. $planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma .' '. $planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma .' ('. $planificar_asignatura->siadi_paralelo->nombre_paralelo .')';
            $this->id_planificar_asignatura = $planificar_asignatura->id_planificar_asignatura;
            $this->fecha_limite_notas = $planificar_asignatura->fecha_limite_subir_nota; 
            $this->estado_docente = $planificar_asignatura->estado_docente==1 || $planificar_asignatura->estado_docente=='1'? true: false;
            $this->operation = "limite_subir_nota";
            $this->emit("openModalUploadNote");
        }
    }

    public function guardar_subir_nota(){
        $this->validate();
        $guardarEditar_planificar_asignatura = SiadiPlanificarAsignatura::find($this->id_planificar_asignatura);
        if(!is_null($guardarEditar_planificar_asignatura)){
            $guardarEditar_planificar_asignatura->fecha_limite_subir_nota = $this->fecha_limite_notas;
            $guardarEditar_planificar_asignatura->estado_docente = $this->estado_docente? 1: 0; 
            $guardarEditar_planificar_asignatura->id_usuario = Auth::user()->id;
            $guardarEditar_planificar_asignatura->save();

            $this->cancelar();
            $this->emit('closeModalUploadNote');
            $this->emit('alert', 'Se editó fecha satisfactoriamente');
        } else {
            $this->cancelar_subir_nota();
            $this->emit("closeModalUploadNote");
            $this->emit("vacio", "No hay asignatura que guardar");
        }
    }

    public function cancelar_subir_nota(){
        $this->operation = '';
        $this->reset([
            'fecha_limite_notas',
            'estado_docente'
        ]);
        $this->resetValidation();
        $this->titulo_aignatura = "";
        $this->id_planificar_asignatura = null;
    }
   
	# nuevo convocatoria_actual_subir_nota 
    public function subir_nota_limite_convocatoria( $id_convoc)
    {
        $this->cancelar_subir_nota_convocatoria();
    	$this->convocatoria_actual_subir_nota = SiadiConvocatoria::where('id_siadi_convocatoria', $id_convoc)->first();
        if(!is_null($this->convocatoria_actual_subir_nota)){
            $this->operation = "limite_subir_nota_convocatoria";
            $this->emit("openModalUploadNoteConvocatoria");
        } else {
        	$this->emit("vacio", "Acceso ilegal");
		}
    }
    
    public function cancelar_subir_nota_convocatoria(){
    	$this->operation = '';
        $this->reset([
            'fecha_limite_notas_conv',
            'estado_docente_conv'
        ]);
        $this->emit("closeModalUploadNoteConvocatoria");
        $this->resetValidation();
        $this->convocatoria_actual_subir_nota = null;
	}

    public function guardar_subir_nota_convocatoria(){
        if($this->operation == "limite_subir_nota_convocatoria" && !is_null($this->convocatoria_actual_subir_nota)){
            $this->validate();
            try{
                SiadiPlanificarAsignatura::where('id_siadi_convocatoria', '=', $this->convocatoria_actual_subir_nota->id_siadi_convocatoria)
                    ->where('estado_planificar_asignartura', '<>', 'ELIMINADO')
                    ->update(['fecha_limite_subir_nota' => $this->fecha_limite_notas_conv,
                            'estado_docente' => $this->estado_docente_conv?1: 0,
                            'id_usuario' => Auth::user()->id
                        ]);
                $this->emit('alert', 'Fecha límite modificado exitosamente.');
                $this->cancelar_subir_nota_convocatoria();
            } catch(\Exception $e){
                $this->emit("errorvalidate", $e->getMessage());
            }
        } else {
        	$this->emit("vacio", "Acceso ilegal");
		} 
    }


    # subir notas libro, folio
    public function mostrar_form_libro_nota($id_planificar){
        $this->plan_asignatura_actual_folio_materia = SiadiPlanificarAsignatura::where('id_planificar_asignatura', $id_planificar)->where('estado_planificar_asignartura', '<>', 'ELIMINADO')->first();
        if(!is_null($this->plan_asignatura_actual_folio_materia)){
            $this->operation = "editar_nota_folio";
            foreach($this->plan_asignatura_actual_folio_materia->inscripcipciones as $inscrip){
                if($inscrip->estado_inscripcion!=='ELIMINADO' && $inscrip->estado_inscripcion!=='ANULADO' && !is_null($inscrip->notas) && $inscrip->notas->estado_nota!=='ELIMINAR'){
                    $this->libro_notas_materia = $inscrip->notas->nro_carpeta_nota;
                    $this->nro_folio_materia = $inscrip->notas->nro_folio_nota;
                    break;
                }
            }
            $this->emit("openModalUpdateLibroFolioNotaAsignatura");
        } else {
            $this->emit("vacio", "Acceso ilegal");
        }
    }

    public function cancelar_libro_nota(){
        $this->operation = '';
        $this->reset([
            'libro_notas_materia',
            'nro_folio_materia'
        ]);
        $this->emit("closeModalUpdateLibroFolioNotaAsignatura");
        $this->resetValidation();
        $this->plan_asignatura_actual_folio_materia = null;
    }

    public function guardar_folio_libro(){
        if($this->operation == "editar_nota_folio" && !is_null($this->plan_asignatura_actual_folio_materia)){
            $this->validate();
            try{
                $notas_act = 0;
                foreach($this->plan_asignatura_actual_folio_materia->inscripcipciones as $inscrip){
                    if($inscrip->estado_inscripcion!=='ELIMINADO' && $inscrip->estado_inscripcion!=='ANULADO' && !is_null($inscrip->notas) && $inscrip->notas->estado_nota!=='ELIMINAR' && ($inscrip->notas->nro_carpeta_nota!==$this->libro_notas_materia || $inscrip->notas->nro_folio_nota!==$this->nro_folio_materia)){
                        $nota = SiadiNota::find($inscrip->notas->id_nota);
                        $nota->nro_carpeta_nota = $this->libro_notas_materia;
                        $nota->nro_folio_nota = $this->nro_folio_materia;
                        $nota->id_usuario = Auth::user()->id;
                        $nota->save();
                        $notas_act++;
                    }
                }
                $this->emit('alert', $notas_act .' Libros y Folios actualizado exitosamente.');
                $this->cancelar_libro_nota();
            } catch(\Exception $e){
                $this->emit("errorvalidate", $e->getMessage());
            }
        } else {
        	$this->emit("vacio", "Acceso ilegal fn.");
		} 
    }



    # asignar docente
    # busca docente, si al menos una vez a sido docente en la carrera
    public $docente_tmp;
    public $nombramientos;
    public function mostrar_form_asignar_docente($id_plan_asignatura){
        $this->cancelar_asigna_docente();
        $this->plan_asignatura_docente = SiadiPlanificarAsignatura::where('id_planificar_asignatura', $id_plan_asignatura)->where('estado_planificar_asignartura', '<>', 'ELIMINADO')->first();
        if(!is_null($this->plan_asignatura_docente)){
            $this->operation = "asignar_docente";
            if(!is_null($this->plan_asignatura_docente->siadi_persona_asignada_docente)){
                $this->id_base_upea_docente = $this->plan_asignatura_docente->id_asignacion_docente;
                $this->docente_tmp = $this->plan_asignatura_docente->siadi_persona_asignada_docente;
                if($this->plan_asignatura_docente->siadi_convocatoria->modalidad->id_convocartoria !== 2){
                	$this->id_nombramiento_docente = $this->plan_asignatura_docente->id_asignacion_nombramiento;
                	$this->loadNombramientoSelect();
                }
            }
            if($this->plan_asignatura_docente->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2){ # 2: examen
            	$this->nro_resolucion_hcc_examen = $this->plan_asignatura_docente->resolucion_rhcc;
            }
            $this->emit("Mostrar", "listo");
            $this->emit("openModalAsignTeacher");
        } else {
            $this->emit("vacio", "Acceso ilegal ad.");
        }
    }

    public function cancelar_asigna_docente(){
        $this->operation = '';
        $this->reset([
            'id_base_upea_docente',
            'id_nombramiento_docente',
            'nro_resolucion_hcc_examen'
        ]);
        $this->emit("closeModalAsignTeacher");
        $this->resetValidation();
        $this->plan_asignatura_docente = null;
        $this->docente_tmp = null;
        $this->nombramientos = [];
    }

    public function guardar_nombramiento_docente(){
        if($this->operation == "asignar_docente" && !is_null($this->plan_asignatura_docente)){
            $this->validate();
            if($this->plan_asignatura_docente->id_asignacion_docente!==$this->id_base_upea_docente || $this->plan_asignatura_docente->id_asignacion_nombramiento!==$this->id_nombramiento_docente || $this->nro_resolucion_hcc_examen !== $this->plan_asignatura_docente->resolucion_rhcc){
                try {
                    $plan_doc_nom = SiadiPlanificarAsignatura::find($this->plan_asignatura_docente->id_planificar_asignatura);
                    $plan_doc_nom->id_asignacion_docente = $this->id_base_upea_docente==''? null: $this->id_base_upea_docente;
                    if($this->plan_asignatura_docente->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2){ # 2: examen
                    	$plan_doc_nom->resolucion_rhcc = $this->nro_resolucion_hcc_examen;
                    } else {
                    	$plan_doc_nom->id_asignacion_nombramiento = $this->id_nombramiento_docente==''? null: $this->id_nombramiento_docente;
                    }
                    $plan_doc_nom->id_usuario = Auth::user()->id;
                    $plan_doc_nom->save();

                    $this->emit('alert', 'Asignación guardada exitosamente.');
                    $this->cancelar_asigna_docente();
                } catch(\Exception $e){
                    $this->emit("errorvalidate", $e->getMessage());
                }
            } else {
            	$this->emit('alert', 'Guardado exitosamente sin realizar cambios.');
                $this->cancelar_asigna_docente();
			}
        } else {
        	$this->emit("vacio", "Acceso ilegal ad.");
		} 
    }

    /* public function updatedIdNombramientoDocente(){
        $this->loadNombramientoSelect();
    } */

    private function loadNombramientoSelect(){
        $tmp_nombra = tabla_vista_nombramiento_general::
        where('id_persona', '=', is_null($this->id_base_upea_docente)?'': $this->id_base_upea_docente)
        ->where('carrera_id', '=', 13)
        ->where('gestion', $this->plan_asignatura_docente->siadi_convocatoria->gestion->nombre_gestion)
        ->where('periodo', $this->plan_asignatura_docente->siadi_convocatoria->periodo)
        #->where('item_nombramiento', 'like', '%IDI%')
        ->orderBy('fecha_emision_nombramiento', 'desc')
        ->get();

        $this->nombramientos = $tmp_nombra->map(function ($nombrar) {
            return [
                'codex' => $nombrar->codex,
                'id_persona' => $nombrar->id_persona,
                'item_nombramiento' => $nombrar->item_nombramiento,
                'tipo_categoria_rgs' => $nombrar->tipo_categoria_rgs,
                'sede' =>$nombrar->sede,
                'grado_nombramiento' => $nombrar->grado_nombramiento,
                'fecha_emision_nombramiento' => $nombrar->fecha_emision_nombramiento
            ];
        })->toArray();
        #$this->nombramientos = array_values($tmp_nombra);
    }



    /* buscador */
    public $docente_buscar_upea;
    public function buscar_por_ci_docente(){
        $this->validate([
            'buscar_ci_docente' => 'required|uppercase|min:3|max:14'
        ]);
        $this->docente_buscar_upea = tabla_vista_nombramiento_general::
            where('ci', '=', $this->buscar_ci_docente)
            ->where('carrera_id', '=', 13)
            #->where('item_nombramiento', 'like', '%IDI%')
            ->orderBy('fecha_emision_nombramiento', 'desc')
            ->first();
    }

    public function cancelar_ci_docente(){
        $this->reset([
            'buscar_ci_docente'
        ]);
        $this->docente_buscar_upea = null;
        $this->resetValidation('buscar_ci_docente');
    }

    public function asignar_docente($id_persona){
        $this->id_base_upea_docente = $id_persona;
        $this->cancelar_ci_docente();
        $this->docente_tmp = tabla_persona::where('id', $this->id_base_upea_docente)->first();
        $this->reset(['id_nombramiento_docente']);
        $this->loadNombramientoSelect();
    }



    public function getReporteSQL($id_planificar_asignatura)
    {
        $reporte = SiadiPlanificarAsignatura::join('siadi_inscripcions as sins', 'sins.id_planificar_asignatura', '=', 'siadi_planificar_asignaturas.id_planificar_asignatura')
            ->join('siadi_notas as sn', 'sn.id_inscripcion', '=', 'sins.id_inscripcion')
            ->join('siadi_personas as sps', 'sps.id_siadi_persona', '=', 'sins.id_siadi_persona')
            ->join('siadi_convocatorias as sc', 'siadi_planificar_asignaturas.id_siadi_convocatoria', '=', 'sc.id_siadi_convocatoria')
            ->join('siadi_asignaturas as sa', 'sa.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
            ->join('siadi_idiomas as si', 'si.id_idioma', '=', 'sa.id_idioma')
            ->join('siadi_nivel_idiomas as sni', 'sni.id_nivel_idioma', '=', 'sa.id_nivel_idioma')
            ->join('siadi_paralelos as sp', 'sp.id_paralelo', '=', 'siadi_planificar_asignaturas.id_paralelo')
            ->join('siadi_tipo_convocatorias as stc', 'stc.id_tipo_convocatoria', '=', 'sc.id_tipo_convocatoria')
            ->join('siadi_convocartoria_estudiantes as sce', 'sce.id_convocartoria_estudiante', '=', 'stc.id_convocartoria_estudiante')
            ->join('siadi_gestions as sg', 'sg.id_gestion', '=', 'sc.id_gestion')
            ->join('siadi_sede as ss', 'ss.id_siadi_sede', '=', 'sc.id_siadi_sede')
            ->select('siadi_planificar_asignaturas.id_planificar_asignatura', 'sc.id_gestion', 'ss.direccion', 'sa.id_idioma', 'sa.id_nivel_idioma', 'sps.paterno_persona', 'sps.materno_persona', 'sps.nombres_persona', 'sps.ci_persona', 'sps.expedido_persona', 'sn.final_nota', 'sins.observacion_inscripcion', 'sa.sigla_asignatura', 'si.sigla_codigo_idioma', 'sp.nombre_paralelo', 'sce.nombre_convocatoria_estudiante', 'sg.nombre_gestion', 'sc.periodo', 'siadi_planificar_asignaturas.id_asignacion_docente', 'siadi_planificar_asignaturas.cupo_maximo_paralelo', 'sni.nombre_nivel_idioma', 'siadi_planificar_asignaturas.turno_paralelo', 'si.nombre_idioma', 'sni.descripcion_nivel_idioma')
            ->where('siadi_planificar_asignaturas.id_planificar_asignatura', '=', $id_planificar_asignatura)
            ->orderBy('sps.paterno_persona', 'asc')
            ->get();

        return $reporte;
    }

    public function getDocentePersona($id_planificar_asignatura, $id_asignacion_docente, $sede)
    {
        dd($sede);
        $res = SiadiPlanificarAsignatura::join('base_upea.vista_persona as vp', 'siadi_planificar_asignaturas.id_asignacion_docente', '=', 'vp.id')
            ->join('base_upea.vista_asignacion_control_docente_actua as vacda', 'vacda.id_persona', '=', 'siadi_planificar_asignaturas.id_asignacion_docente')
            ->select('vp.ci', 'vp.nombre', 'vp.paterno', 'vp.materno', 'vacda.sede', 'vacda.item_nombramiento')
            ->where('siadi_planificar_asignaturas.id_planificar_asignatura', '=', $id_planificar_asignatura)
            ->where('vp.id', '=', $id_asignacion_docente)
            ->whereRaw($sede, 'LIKE', "CONCAT('%', vacda.sede, '%')")
            ->where('vacda.item_nombramiento', 'LIKE', '%IDI%')
            ->get();
        dd($res);
    }

    public function generarReporteXLS($id_planificar_asignatura)
    {
        $reporte = $this->getReporteSQL($id_planificar_asignatura);
        if (count($reporte) > 0) {

        } else {
            $this->emit('vacio', 'Paralelo sin estudiantes inscritos.');
        }
    }

    //RENDERIZAR TODO

    public function cambiar_estado_planificar_asignatura($id_planificar_asignatura)
    {
        // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
        $siadi_planificar_asignatura = SiadiPlanificarAsignatura::find($id_planificar_asignatura);

        if ($siadi_planificar_asignatura) {
            $siadi_planificar_asignatura->estado_planificar_asignartura = $siadi_planificar_asignatura->estado_planificar_asignartura === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $siadi_planificar_asignatura->save();
        }

        // Emitir evento para notificar que el estado ha cambiado (opcional)
        $this->emit('alert', 'Se cambio el estado de la convocatoria con éxito');

    }

    public function mount($id_convocatoria){
        $conv_tmp = SiadiConvocatoria::select(
            'siadi_convocatorias.id_siadi_convocatoria',
            'siadi_convocatorias.periodo',
            'siadi_convocatorias.id_gestion'
        )
        ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO')
        ->where('siadi_convocatorias.id_siadi_convocatoria', $id_convocatoria)
        ->first();
        if(!is_null($conv_tmp)){
            $this->estado_periodo = $this->estado_convocatoria_sede = $this->estado_f_idioma = true;
            $this->f_gestion = $conv_tmp->id_gestion;
            $this->f_periodo = $conv_tmp->periodo;
            $this->f_convocatoria_sede = $conv_tmp->id_siadi_convocatoria;
        }
    }

    public function render()
    {
        /* INICIO COPIAR AL NUEVO SISTEMA */
        $asignaturas = [];
        if($this->operation=="guardar"){
            $asignaturas = SiadiAsignatura::join('siadi_idiomas', 'siadi_idiomas.id_idioma', '=', 'siadi_asignaturas.id_idioma')
                ->where('estado_asignatura', '=', 'ACTIVO')
                ->where('siadi_idiomas.estado_idioma', '=', 'ACTIVO')->get();
        } elseif($this->operation=="editar"){
            $asignaturas = SiadiAsignatura::where('estado_asignatura', '=', 'ACTIVO')->get();
        }
        /* FIN COPIAR AL NUEVO SISTEMA */
        
        $convocatorias = SiadiConvocatoria::
              select('siadi_convocatorias.*')
            ->where('siadi_convocatorias.estado_convocatoria', '=', 'ACTIVO')
            ->orderBy('siadi_convocatorias.id_gestion', 'desc')
            ->orderBy('siadi_convocatorias.periodo', 'desc')
            ->get();
            
        $convocatoria_estudiantes = SiadiConvocartoriaEstudiante::where('estado_convocatoria_estudiante', '=', 'ACTIVO')->get();
        $costos = SiadiCosto::where('estado_costo', '=', 'ACTIVO')->get();


        return view('livewire.administracion-modulos.planificar-asignatura-index', [
            'planificar_asignaturas' => $this->get_main_planificar_asignaturas(),
            'asignaturas' => $asignaturas, 
            'convocatoria_estudiantes' => $convocatoria_estudiantes, 
            'costos' => $costos, 
            'paralelos' =>  $this->get_parallel_available(), #$paralelos,
            'convocatorias' => $convocatorias, 
            'gestiones' => $this->get_gestiones(), # select filtrador
            'periodos' => $this->get_periodos(), # select filtrador
            'convocatorias_sedes' => $this->get_convocatorias(), # select filtrador
            'idiomas' => $this->get_idiomas(), # select filtrador
            'niveles' => $this->get_niveles() # select filtrador
        ]);
        
    }

    private function get_parallel_available(){
        $consulta = SiadiParalelo::
            whereNotIn('siadi_paralelos.id_paralelo', function($query){
                $query->select('spa.id_paralelo')
                    ->from('siadi_planificar_asignaturas AS spa')
                    ->join('siadi_convocatorias AS sc', 'sc.id_siadi_convocatoria', '=', 'spa.id_siadi_convocatoria')
                    ->join('siadi_modalidad_curso AS stc', 'stc.id_convocartoria_estudiante', '=', 'sc.id_modalidad_curso')
                    ->whereNotNull('spa.id_paralelo')
                    ->where('spa.id_siadi_convocatoria', '=', $this->convocatoria_estudiante)
                    ->where('spa.id_siadi_asignatura', '=', $this->asignatura)
                    ->where('spa.id_planificar_asignatura', '<>', $this->id_planificar_asignatura); # editar
            })
            ->get();
        if(count($consulta)>0){
            $conv = SiadiConvocatoria::find($this->convocatoria_estudiante);

            if(!is_null($conv)){
                if($conv->modalidad->id_convocartoria_estudiante==1){ # curso regular (A-Z)
                    $nuevo = [];
                    foreach($consulta as $paralelo){
                        if(strlen($paralelo->nombre_paralelo)==1){
                            $nuevo[] = $paralelo;
                        }
                    }
                    return $nuevo;
                } else if($conv->modalidad->id_convocartoria_estudiante==2){ # PRUEBA DE EXAMEN DE SUFICIENCIA (examen)
                    $nuevo = [];
                    foreach($consulta as $paralelo){
                        if(strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('examen')) !== false){
                            $nuevo[] = $paralelo;
                        }
                    }
                    return $nuevo;
                } else if($conv->modalidad->id_convocartoria_estudiante==3){ # CONVALIDACIÓN DEPARTAMENTO IDIOMAS (CONVALIDACIÓN DEPTO)
                    $nuevo = [];
                    foreach($consulta as $paralelo){
                        if(strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('convalidación')) !== false && strpos(strtolower($paralelo->nombre_paralelo), mb_strtolower('depto'))){
                            $nuevo[] = $paralelo;
                        }
                    }
                    return $nuevo;
                } else if($conv->modalidad->id_convocartoria_estudiante==6){ # HOMOLOGACIÓN DEPARTAMENTO IDIOMAS (HOMOLOGACIÓN DEPTO)
                    $nuevo = [];
                    foreach($consulta as $paralelo){
                        if(strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('homologación')) !== false && strpos(strtolower($paralelo->nombre_paralelo), mb_strtolower('depto'))){
                            $nuevo[] = $paralelo;
                        }
                    }
                    return $nuevo;
                } else if($conv->modalidad->id_convocartoria_estudiante==7){ # CONVALIDACIÓN LINGUISTICA E IDIOMAS (CONVALIDACIÓN CARRERA)
                    $nuevo = [];
                    foreach($consulta as $paralelo){
                        if(strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('convalidación')) !== false && strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('carrera'))){
                            $nuevo[] = $paralelo;
                        }
                    }
                    return $nuevo;
                } else if($conv->modalidad->id_convocartoria_estudiante==8){ # HOMOLOGACIÓN LINGUISTICA E IDIOMAS (HOMOLOGACIÓN CARRERA)
                    $nuevo = [];
                    foreach($consulta as $paralelo){
                        if(strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('homologación')) !== false && strpos(mb_strtolower($paralelo->nombre_paralelo), mb_strtolower('carrera'))){
                            $nuevo[] = $paralelo;
                        }
                    }
                    return $nuevo;
                }
            }
        }
        return $consulta;
    }

    private function get_main_planificar_asignaturas(){
        $consulta = $planificar_asignaturas = SiadiPlanificarAsignatura::where('estado_planificar_asignartura', '<>', 'ELIMINADO');
        if($this->f_gestion!==""){ # estado_periodo
            $consulta->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
                ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINAR')
                ->where('id_gestion', $this->f_gestion);
            if($this->estado_convocatoria_sede){ # $this->f_periodo!==""
                $consulta->where('periodo', $this->f_periodo);
                if($this->estado_f_idioma){ # $this->f_convocatoria_sede!==""
                    $consulta->where('siadi_convocatorias.id_siadi_convocatoria', $this->f_convocatoria_sede);
                    if($this->estado_f_nivel){ # $this->f_idioma!==""
                        $consulta->join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
                            ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
                            ->where('siadi_asignaturas.id_idioma', $this->f_idioma);
                        if($this->f_nivel!==""){
                            $consulta->where('siadi_asignaturas.id_nivel_idioma', $this->f_nivel);
                        }
                    }
                }
            }
        }
        #return $consulta->paginate(5, ['*'], 'page', $this->page); 
        $res = $consulta->paginate($this->pages_show);
        #$this->emit('Mostrar', $res->currentPage() .'/'. $res->lastPage());
        if($res->currentPage()>$res->lastPage()){ # verificar que la paginacion no sobrepase
            return $consulta->paginate($this->pages_show, ['*'], 'page', $res->lastPage()); 
        }
        return $res;
    }

    public function updatedConvocatoriaEstudiante(){
        $this->asignatura = "";
    }
    public function updatedCupoMinimo(){
    	//if(!$this->errors->has('cupo_minimo')){
    		$this->validateOnly('cupo_maximo');
		//}
	}
	public function updatedTurnoParalelo(){
        $this->resetValidation([
            'hora_inicio',
            'hora_fin'
        ]);
		if($this->turno_paralelo!==''){
            $this->estado_horas = true;
			if($this->turno_paralelo=="Mañana"){
				$this->hora_inicio = "07:00";
				$this->hora_fin = "08:00";
			} else if($this->turno_paralelo=="Tarde"){
				$this->hora_inicio = "12:00";
				$this->hora_fin = "13:00";
			} if($this->turno_paralelo=="Noche"){
				$this->hora_inicio = "18:00";
				$this->hora_fin = "19:00";
			} else if($this->turno_paralelo=="Sin turno"){
                $this->estado_horas = false;
				$this->hora_inicio = "00:00";
				$this->hora_fin = "00:00";
            }
		} else {
            $this->estado_horas = false;
        }
	}
    public function updatedHoraInicio(){
        $this->validateOnly('hora_fin');
    }
    private function getRulesHoraInicio(){
        if($this->turno_paralelo=="Mañana"){
            return "|after_or_equal:07:00|before_or_equal:11:00";
        } else if($this->turno_paralelo=="Tarde"){
            return "|after_or_equal:12:00|before_or_equal:17:00";
        } else if($this->turno_paralelo=="Noche"){
            return "|after_or_equal:18:00|before_or_equal:21:00";
        } else {
            return "";
        }
    }
    private function getRulesHoraFin(){
        if($this->turno_paralelo=="Mañana" || $this->turno_paralelo=="Tarde" || $this->turno_paralelo=="Noche"){
            $tmp = "";
            $hora_end_min = "";
            try{
                $hora_end_min = Carbon::parse($this->hora_inicio)->addHour(1)->format("H:i");
                $tmp = "|after_or_equal:". $hora_end_min;
            } catch (\Exception $e){}
            $hora_end_max = "";
            try{
                $hora_end_max = Carbon::parse($this->hora_inicio)->addHour(4)->format("H:i");
                $tmp = $tmp. "|before_or_equal:". $hora_end_max;
            } catch (\Exception $e){}
            return $tmp;
        } else {
            return "";
        }
    }


    # version 2
    private function get_gestiones(){
        return SiadiGestion::where('estado_gestion', '<>', 'ELIMINAR')
            ->latest('nombre_gestion')
            ->get();
    }

    private function get_periodos(){
        return SiadiConvocatoria::select('periodo')
            ->where('estado_convocatoria', '<>', 'ELIMINADO')
            ->where('id_gestion', $this->f_gestion)
            ->groupBy('periodo')
            ->get();
    }

    private function get_convocatorias(){
        return SiadiConvocatoria::
            where('estado_convocatoria', '<>', 'ELIMINADO')
            ->where('id_gestion', $this->f_gestion)
            ->where('periodo', $this->f_periodo) 
            ->get();
    }

    private function get_idiomas(){
        return SiadiIdioma::
            join('siadi_asignaturas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')
            ->join('siadi_planificar_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')
            ->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
            ->where(function($query){
                $query->where('siadi_idiomas.estado_idioma', '<>', 'ELIMINAR')
                    ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
                    ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
                    ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO');
            })
            ->where(function($query){
                $query->where('siadi_convocatorias.id_gestion', $this->f_gestion);
                $query->where('siadi_convocatorias.periodo', $this->f_periodo);
                $query->where('siadi_convocatorias.id_siadi_convocatoria', $this->f_convocatoria_sede);
            })
            ->groupBy('siadi_idiomas.id_idioma')
            ->orderBy('siadi_idiomas.nombre_idioma')
            ->get();
    }

    private function get_niveles(){
        return SiadiNivelIdioma::
            join('siadi_asignaturas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')
            ->join('siadi_planificar_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')
            ->join('siadi_convocatorias', 'siadi_convocatorias.id_siadi_convocatoria', '=', 'siadi_planificar_asignaturas.id_siadi_convocatoria')
            ->where(function($query){
                $query->where('siadi_nivel_idiomas.estado_nivel_idioma', '<>', 'ELIMINAR')
                    ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
                    ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
                    ->where('siadi_convocatorias.estado_convocatoria', '<>', 'ELIMINADO');
            })
            ->where(function($query){
                $query->where('siadi_convocatorias.id_gestion', $this->f_gestion);
                $query->where('siadi_convocatorias.periodo', $this->f_periodo);
                $query->where('siadi_convocatorias.id_siadi_convocatoria', $this->f_convocatoria_sede);
                $query->where('siadi_asignaturas.id_idioma', $this->f_idioma);
            })
            ->groupBy('siadi_nivel_idiomas.id_nivel_idioma')
            ->orderBy('siadi_nivel_idiomas.nombre_nivel_idioma')
            ->get();
    }


    /* ++++++++++++++++++++++ BARRA PARA FILTRAR INICIO+++++++++++++++++++++++ */
    public $f_gestion = "";
    public $f_periodo = "", $estado_periodo = false;
    public $f_convocatoria_sede = "", $estado_convocatoria_sede = false;
    public $f_idioma = "", $estado_f_idioma = false;
    public $f_nivel = "", $estado_f_nivel = false;

    public function updatedFGestion(){
        if($this->f_gestion==""){
            $this->estado_periodo = false;
        } else {
            $this->estado_periodo = true;
        }
        $this->f_periodo = $this->f_convocatoria_sede = $this->f_idioma = $this->f_nivel = "";
        $this->estado_convocatoria_sede = $this->estado_f_idioma = $this->estado_f_nivel = false;
    }

    public function updatedFPeriodo(){
        if($this->f_periodo==""){
            $this->estado_convocatoria_sede = false;
        } else {
            $this->estado_convocatoria_sede = true;
        }
        $this->f_convocatoria_sede = $this->f_idioma = $this->f_nivel= "";
        $this->estado_f_idioma = $this->estado_f_nivel = false;
    }

    public function updatedFConvocatoriaSede(){
        if($this->f_convocatoria_sede==""){
            $this->estado_f_idioma = false;
        } else {
            $this->estado_f_idioma = true;
        }
        $this->f_idioma = $this->f_nivel = "";
        $this->estado_f_nivel = false;
    }

    public function updatedFIdioma(){
        if($this->f_idioma==""){
            $this->estado_f_nivel = false;
        } else {
            $this->estado_f_nivel = true;
        }
    }
    /* ++++++++++++++++++++++ BARRA PARA FILTRAR FIN   +++++++++++++++++++++++ */
}
