<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Http\Controllers\AdministracionModulos\SiadiConvocatoriaController;
use App\Models\AdministracionModulos\SiadiConvocartoriaEstudiante;
use App\Models\AdministracionModulos\SiadiConvocatoria;
use App\Models\AdministracionModulos\SiadiCosto;
use App\Models\AdministracionModulos\SiadiGestion;
use App\Models\AdministracionModulos\SiadiIdioma;
use App\Models\AdministracionModulos\SiadiNivelIdioma;
use App\Models\AdministracionModulos\SiadiParalelo;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiSede;
use App\Models\AdministracionModulos\SiadiTipoConvocatoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ConvocatoriaIndex extends Component
{

    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public $nombre_convocatoria;
    public $id_gestion;
    public $periodo;
    public $id_tipo_convocatoria;
    public $sede;
    public $id_modalidad_curso;
    public $monto_convocatoria;

    public $descripcion_convocatoria;
    public $fecha_inicio;
    public $fecha_fin;
    public $languages;
    public $Levels;
    public $selectedLanguages = [];
    public $selectedLevels = [];

    public $nombre_convocatoria2;
    public $id_gestion2;
    public $periodo2;
    public $id_tipo_convocatoria2;
    public $sede2;

    public $descripcion_convocatoria2;
    public $fecha_inicio2;
    public $fecha_fin2;

    public $id_convocatoria_actual;

    public $cont_asignaturas = 0;
    public $asignaturas = array();
    public $id_asignaturas = array();
    public $conv_hom_a = array();
    public $conv_hom = false;

    public function mount()
    {
        $this->languages = SiadiIdioma::pluck('nombre_idioma', 'id_idioma')->toArray();
        SiadiNivelIdioma::pluck('nombre_nivel_idioma', 'id_nivel_idioma')->toArray();
    }

    public function cambiar_estado_convocatoria($idConvocatoria)
    {
        // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
        $convocatoria_estado = SiadiConvocatoria::find($idConvocatoria);

        if ($convocatoria_estado) {
            $convocatoria_estado->estado_convocatoria = $convocatoria_estado->estado_convocatoria === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $convocatoria_estado->save();
        }

        // Emitir evento para notificar que el estado ha cambiado (opcional)
        $this->emit('alert', 'Se cambio el estado de la convocatoria con éxito');

    }

    public function cancelar()
    {
        $this->reset([
            'nombre_convocatoria',
            'id_gestion',
            'periodo',
            'id_tipo_convocatoria',
            'sede',
            'descripcion_convocatoria',
            'fecha_inicio',
            'fecha_fin',
            'asignaturas',
            'id_modalidad_curso',
            'monto_convocatoria',
        ]);
        $this->resetValidation();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //BORRAR
    public function delete(SiadiConvocatoria $id_siadi_convocatoria): void
    {
        $id_siadi_convocatoria->estado_convocatoria = 'ELIMINADO';
        $id_siadi_convocatoria->update();
    }

//CREAR

    /* public function rules()
    {
        return [

            'nombre_convocatoria' => 'required',
            'id_gestion' => 'required|not_in:Elegir...',
            'periodo' => 'required|not_in:Elegir...',
           # 'id_tipo_convocatoria' => 'required|not_in:Elegir...',
            'sede' => 'required|not_in:Elegir...',
            'costoconvocatoria' => 'required|not_in:Elegir...',
            'descripcion_convocatoria' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'asignaturas' => 'required',
            'id_modalidad_curso' => 'required|not_in:Elegir...',
            'monto_convocatoria' => 'required|max:999999999',
        ];
    } */

    public function resetAsignaturas()
    {
        $this->reset([
            'asignaturas',
            'cont_asignaturas',
        ]);
    }

    public function abrir_form_create(){
        $this->operation = "guardar_convocatoria";
    }

    public function guardar_planificarconvocatoria()
    {
        if($this->operation=="guardar_convocatoria"){
            $this->validate();

            $guardar_convocatoria = new SiadiConvocatoria();
            $guardar_convocatoria->nombre_convocatoria = $this->nombre_convocatoria;
            $guardar_convocatoria->id_gestion = $this->id_gestion;
            $guardar_convocatoria->periodo = $this->periodo;

            // Nuevos campos para modalidades
            $guardar_convocatoria->id_modalidad_curso = $this->id_modalidad_curso;
            $guardar_convocatoria->monto_convocatoria = $this->monto_convocatoria;
            $guardar_convocatoria->id_costo = $this->costoconvocatoria;

        # $guardar_convocatoria->id_tipo_convocatoria = $this->id_tipo_convocatoria;
            $guardar_convocatoria->id_siadi_sede = $this->sede;
            $sedeSS = "";
            try { $res = SiadiSede::select('direccion')->where('id_siadi_sede', '=', $this->sede)->first();
                $sedeSS = $res->direccion;} catch (\Exception $e) {}
            $guardar_convocatoria->sede = $sedeSS;
            $guardar_convocatoria->descripcion_convocatoria = $this->descripcion_convocatoria;
            $guardar_convocatoria->fecha_inicio = $this->fecha_inicio;
            $guardar_convocatoria->fecha_fin = $this->fecha_fin;
            $guardar_convocatoria->id_usuario = Auth::user()->id;
            $guardar_convocatoria->save();
            if (!empty($this->asignaturas)) {
                $isc = SiadiConvocatoria::orderBy('id_siadi_convocatoria', 'desc')->limit(1)->get();

                for ($i = 0; $i < $this->cont_asignaturas; $i++) {
                    if (!empty($this->asignaturas[$i])) {
                        foreach ($this->asignaturas[$i]['nivel'] as $key => $value) {
                            if ($this->asignaturas[$i]['nivel'][$key]) {
                                foreach ($this->asignaturas[$i]['paralelos'][$key] as $key2 => $value2) {
                                    if ($value2) {
                                        $guardar_planificar_asignatura = new SiadiPlanificarAsignatura();

                                        $guardar_planificar_asignatura->id_siadi_asignatura = $key;
                                        $guardar_planificar_asignatura->id_siadi_convocatoria = $isc[0]->id_siadi_convocatoria;
                                        $guardar_planificar_asignatura->id_paralelo = $key2;
                                        $guardar_planificar_asignatura->turno_paralelo = $value2;
                                        $guardar_planificar_asignatura->cupo_maximo_paralelo = 40;
                                        $guardar_planificar_asignatura->cupo_minimo_paralelo = 20;
                                        $guardar_planificar_asignatura->carga_horaria_planificar_asignartura = 160;
                                        $guardar_planificar_asignatura->id_usuario = Auth::user()->id;

                                        $guardar_planificar_asignatura->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $this->reset([
                'nombre_convocatoria',
                'id_gestion',
                'periodo',
            #   'id_tipo_convocatoria',
                'sede',
                'descripcion_convocatoria',
                'fecha_inicio',
                'fecha_fin',
                'asignaturas',
                'cont_asignaturas',
                'costoconvocatoria',
                'monto_convocatoria',
            ]);

            $this->emit('closeModalCreate');

            $this->emit('alert', 'La convocatoria se guardo satisfactoriamente');
        } else {
            $this->emit('errorvalidate', "Acceso ilegal cc.");
        }
    }

    public $modalidad_edit;
    public $costo_edit;
    public $monto_edit;
    public function editar_planificarconvocatoria(SiadiConvocatoria $id_convocatoria)
    {

        $this->nombre_convocatoria2 = $id_convocatoria->nombre_convocatoria;
        $this->id_gestion2 = $id_convocatoria->id_gestion;
        $this->periodo2 = $id_convocatoria->periodo;
        $this->id_tipo_convocatoria2 = $id_convocatoria->id_tipo_convocatoria;
        $this->sede2 = $id_convocatoria->id_siadi_sede;

        $this->descripcion_convocatoria2 = $id_convocatoria->descripcion_convocatoria;
        $this->fecha_inicio2 = $id_convocatoria->fecha_inicio;
        $this->fecha_fin2 = $id_convocatoria->fecha_fin;
        $this->id_convocatoria_actual = $id_convocatoria->id_siadi_convocatoria;
        $this->modalidad_edit = $id_convocatoria->id_modalidad_curso;
        $this->costo_edit = $id_convocatoria->id_costo;
        $this->monto_edit = $id_convocatoria->monto_convocatoria;

    }
    public function cancelarEditar()
    {
        $this->reset([

            'nombre_convocatoria2',
            'id_gestion2',
            'periodo2',
          #  'id_tipo_convocatoria2',
            'sede2',
            'descripcion_convocatoria2',
            'fecha_inicio2',
            'fecha_fin2',
            'id_convocatoria_actual',
            'asignaturas',
        ]);

    }
    public function guardarEditadoplanificarconvocatoria()
    {
        $this->validate([
            'nombre_convocatoria2' => 'required',
            'id_gestion2' => 'required|not_in:Elegir...',
            'periodo2' => 'required|not_in:Elegir...',
           
            'sede2' => 'required|not_in:Elegir...',
            'descripcion_convocatoria2' => 'required',
            'fecha_inicio2' => 'required',
            'modalidad_edit' => 'required',
            'costo_edit' => 'required|not_in:Elegir...',
            'monto_edit' => 'required|not_in:Elegir...',
            'fecha_fin2' => 'required|max:999999999',

        ]);

        $siadi_paralelo = SiadiConvocatoria::find($this->id_convocatoria_actual);

        $siadi_paralelo->fill([

            'nombre_convocatoria' => $this->nombre_convocatoria2,
            'id_gestion' => $this->id_gestion2,
            'periodo' => $this->periodo2,
         
            'sede' => $this->sede2,
            'descripcion_convocatoria' => $this->descripcion_convocatoria2,
            'fecha_inicio' => $this->fecha_inicio2,
            'fecha_fin' => $this->fecha_fin2,
            'id_modalidad_curso' => $this->modalidad_edit,
            'monto_convocatoria' => $this->monto_edit,
            'id_costo' => $this->costo_edit,

        ]);
        $siadi_paralelo->save();

        $this->reset([

            'nombre_convocatoria2',
            'id_gestion2',
            'periodo2',
            'id_tipo_convocatoria2',
            'sede2',
            'descripcion_convocatoria2',
            'fecha_inicio2',
            'fecha_fin2',
            'id_convocatoria_actual',
            'asignaturas',
        ]);

        $this->emit('closeModalEdit');

        $this->emit('alert', 'Se editó satisfactoriamente');

    }

    //RENDERIZAR TODO
    public function addAsignatura()
    {
        $this->cont_asignaturas++;
    }

    public function eliminarAsignatura($id)
    {
        $this->asignaturas[$id] = null;
        // $this->cont_asignaturas--;
    }
    public $costoconvocatoria;
    public function updatedCostoconvocatoria(){
        $monto=SiadiCosto::find($this->costoconvocatoria);
        if ($monto) {
        $this->monto_convocatoria=$monto->costo_siado_costo;
        }

    }
    public function render()
    {

        $gestiones = SiadiGestion::where('estado_gestion', '=', 'ACTIVO')->get();
        $paralelos = SiadiParalelo::where('estado_paralelo', '=', 'ACTIVO')->get();
        $siadi_tipo_convocatorias = SiadiTipoConvocatoria::where('estado_tipo_convocatoria', '=', 'ACTIVO')->get();
        $sedes = SiadiSede::where('estado_siadi_sede', '<>', 'ELIMINAR')->get();
        $modalidades = SiadiConvocartoriaEstudiante::where('estado_convocatoria_estudiante', '<>', 'ELIMINAR')->get();
        
        $costos = SiadiCosto::where('estado_costo', '<>', 'ELIMINAR')->get();

        $planificarconvocatorias = SiadiConvocatoria::where('estado_convocatoria', '<>', 'ELIMINADO')
            ->when($this->search, function ($query) {
                $query->whereHas('gestion', function ($query) {
                    $query->where('nombre_gestion', 'LIKE', '%' . $this->search . '%');
                })
                    ->orWhereHas('tipo_convocatoria', function ($query) {
                        $query->whereHas('tipo_estudiante', function ($query) {
                            $query->where('nombre_tipo_estudiante', 'LIKE', '%' . $this->search . '%');
                        });
                    })
                    ->orWhereHas('tipo_convocatoria', function ($query) {
                        $query->whereHas('convocatoria_estudiante', function ($query) {
                            $query->where('nombre_convocatoria_estudiante', 'LIKE', '%' . $this->search . '%');
                        });
                    })
                    ->orWhereHas('tipo_convocatoria', function ($query) {
                        $query->whereHas('costo', function ($query) {
                            $query->where('deposito', 'LIKE', '%' . $this->search . '%');
                        });
                    })
                    ->orWhereHas('tipo_convocatoria', function ($query) {
                        $query->whereHas('costo', function ($query) {
                            $query->where('costo_siado_costo', 'LIKE', '%' . $this->search . '%');
                        });
                    })

                    ->orWhere('nombre_convocatoria', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('periodo', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('sede', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('descripcion_convocatoria', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('fecha_inicio', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('fecha_fin', 'LIKE', '%' . $this->search . '%')

                ;
            })
            ->latest('id_siadi_convocatoria')
            ->paginate(5);

        // $idiomas = SiadiIdioma::where('estado_idioma', '=', 'ACTIVO')->get();
        $idiomas = DB::table('siadi_asignaturas')->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')->select('siadi_asignaturas.id_idioma', 'siadi_idiomas.nombre_idioma')->groupByRaw('id_idioma, nombre_idioma')->get();

        // $planificar = DB::query("SELECT sa.id_idioma, si.nombre_idioma, sa.id_nivel_idioma, sni.nombre_nivel_idioma FROM siadi_asignaturas sa, siadi_idiomas si, siadi_nivel_idiomas sni WHERE sa.id_idioma = si.id_idioma AND sa.id_nivel_idioma = sni.id_nivel_idioma");
        $planificar = DB::table('siadi_asignaturas')->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')->join('siadi_nivel_idiomas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')->select('siadi_asignaturas.id_siadi_asignatura', 'siadi_idiomas.nombre_idioma', 'siadi_asignaturas.id_nivel_idioma', 'siadi_nivel_idiomas.nombre_nivel_idioma')->get();

        $niveles = array();
        foreach ($planificar as $ni) {
            $niveles[$ni->id_siadi_asignatura] = $ni->nombre_nivel_idioma;
        }

        $asignaturas_edit = $this->get_asignaturas();

        return view('livewire.administracion-modulos.convocatoria-index', compact('planificarconvocatorias', 'gestiones', 'paralelos', 'siadi_tipo_convocatorias', 'sedes', 'idiomas', 'niveles', 'planificar', 'modalidades', 'costos', 'asignaturas_edit'));
    }

    public $id_convocatoria_asignaturas;
    public $convocatoria_asignaturas;
    public $asignaturas_estados;
    public $asignaturas_estados_ids = [];
    public $asignaturas_estados_estados = [];
    public $asignaturas_estados_estados_docentes = [];
    public $asignaturas_estados_fechas_limites = [];
    public $convoc_asignaturas_estados_estados;
    public $convoc_asignaturas_estados_docentes;
    public $convoc_asignaturas_fechas_limite;
    public function form_asignaturas($id_conv){
        $this->cancelar_estados();
        $this->convocatoria_asignaturas = SiadiConvocatoria::where('id_siadi_convocatoria', $id_conv)->first();
        if(!is_null($this->convocatoria_asignaturas)){
            $this->operation = "edit_status_asignaturas";
            $this->emit("openModalStatusConvocatory");
            $this->id_convocatoria_asignaturas = $this->convocatoria_asignaturas->id_siadi_convocatoria;
            $datos_tmp = $this->get_asignaturas();
            $this->asignaturas_estados = [];
            foreach($datos_tmp as $tmp){
                $nuevo['id_planificar_asignatura'] = $tmp->id_planificar_asignatura;
                $nuevo['nombre_idioma'] = $tmp->nombre_idioma;
                $nuevo['nivel'] = $tmp->descripcion_nivel_idioma . ' '. $tmp->nombre_nivel_idioma;
                $nuevo['nombre_paralelo'] = $tmp->nombre_paralelo;
                $nuevo['estado_planificar_asignartura'] = $tmp->estado_planificar_asignartura;
                $nuevo['asignaturas_estados_estados_docentes'] = $tmp->estado_docente;
                $nuevo['asignaturas_estados_fechas_limites'] = $tmp->fecha_limite_subir_nota;
                $this->asignaturas_estados[] = $nuevo;
                $this->asignaturas_estados_ids[] = $tmp->id_planificar_asignatura;
                $this->asignaturas_estados_estados[] = $tmp->estado_planificar_asignartura=='ACTIVO';
                $this->asignaturas_estados_estados_docentes[] = $tmp->estado_docente=='1';
                $this->asignaturas_estados_fechas_limites[] = $tmp->fecha_limite_subir_nota;
            }
        } else {
            $this->cancelar_estados();
            $this->emit("errorvalidate", "No existe convocatoria");
        }
    }

    public function cancelar_estados(){
        $this->emit("closeModalStatusConvocatory");
        $this->operation = "";
        $this->id_convocatoria_asignaturas = null;
        $this->convocatoria_asignaturas = null;
        $this->reset([
            'convoc_asignaturas_estados_estados',
            'convoc_asignaturas_estados_docentes',
            'convoc_asignaturas_fechas_limite'
        ]);
        $this->asignaturas_estados_ids = [];
        $this->asignaturas_estados_estados = [];
        $this->asignaturas_estados_estados_docentes = [];
        $this->asignaturas_estados_fechas_limites = [];
        $this->resetValidation();
    }

    public function guardar_estados_asignaturas(){
        if(!is_null($this->convocatoria_asignaturas) && $this->operation=="edit_status_asignaturas"){
            $this->validate();
            try{
                DB::beginTransaction();
                $contador = 0;
                foreach ($this->asignaturas_estados as $key => $estados_asign) {
                    $estado_asignatura = $this->asignaturas_estados_estados[$key]? 'ACTIVO': 'INACTIVO';
                    $estado_docente = $this->asignaturas_estados_estados_docentes[$key]? 1: 0;
                    #$this->emit("Mostrar", ($estado_docente!==$estados_asign['asignaturas_estados_estados_docentes'] && $estado_asignatura!==$estados_asign['estado_planificar_asignartura']));
                    if($estado_docente!==$estados_asign['asignaturas_estados_estados_docentes'] || $estado_asignatura!==$estados_asign['estado_planificar_asignartura'] || $this->asignaturas_estados_fechas_limites[$key]!==$estados_asign['asignaturas_estados_fechas_limites']){
                        $this->emit("Mostrar", json_encode($estados_asign));
                        $asignaturas_editar = SiadiPlanificarAsignatura::where('id_planificar_asignatura', $estados_asign['id_planificar_asignatura'])
                            ->where('estado_planificar_asignartura', '<>', 'ELIMINAR')->first();
                        if(!is_null($asignaturas_editar)){
                            $asignaturas_editar->estado_planificar_asignartura = $estado_asignatura;
                            $asignaturas_editar->estado_docente = $estado_docente;
                            if(!is_null($this->asignaturas_estados_fechas_limites[$key]) && $this->asignaturas_estados_fechas_limites[$key]!==""){
                                $asignaturas_editar->fecha_limite_subir_nota = $this->asignaturas_estados_fechas_limites[$key];
                            } else {
                                $asignaturas_editar->fecha_limite_subir_nota = null;
                            }
                        } 
                        #$asignaturas_editar->id_usuario
                        $asignaturas_editar->save();
                        $contador++;
                    }
                }
                DB::commit();
                $this->emit("alert", "Guardado exitósamente $contador asignaturas.");
                $this->cancelar_estados();
            } catch(\Exception $e){
                DB::rollback();
                $this->emit("errorvalidate", "Ups. Ocurrio un error al guardar estados: \n". $e->getMessage());
            }
        } else {
            $this->emit("errorvalidate", "Acceso ilegal para guardar estados de la planificación de asignaturas");
        }
    }

    /* **************************** INICIO REGLAS ************************************ */
    public $operation;
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    protected function rules(){
        # tipo de operacion
        if($this->operation=="edit_status_asignaturas"){
            return $this->rulesForStatatusAsignaturas();
        } else if($this->operation=="guardar_convocatoria"){
            return $this->rulesForSaveConvocatory();
        }
        return array_merge(
            $this->rulesForStatatusAsignaturas(),
            $this->rulesForSaveConvocatory()
        );
    }

    public function restaurar_fila($indice){
        if(count($this->asignaturas_estados)>0 && $indice>=0 && $indice < count($this->asignaturas_estados)){
            $this->asignaturas_estados_estados[$indice] = $this->asignaturas_estados[$indice]['estado_planificar_asignartura']=='ACTIVO';
            $this->asignaturas_estados_estados_docentes[$indice] = $this->asignaturas_estados[$indice]['asignaturas_estados_estados_docentes']=='1';
            $this->asignaturas_estados_fechas_limites[$indice] = $this->asignaturas_estados[$indice]['asignaturas_estados_fechas_limites'];
        }
    }

    public function cambiar_estados_todo(){
        if(count($this->asignaturas_estados_estados)>0){
            for($i=0; $i<count($this->asignaturas_estados_estados); $i++){
                $this->asignaturas_estados_estados[$i] = $this->convoc_asignaturas_estados_estados;
            }
        }
    }

    public function cambiar_estado_docente_todo(){
        if(count($this->asignaturas_estados_estados_docentes)>0){
            for($i=0; $i<count($this->asignaturas_estados_estados_docentes); $i++){
                $this->asignaturas_estados_estados_docentes[$i] = $this->convoc_asignaturas_estados_docentes;
            }
        }
    }

    public function cambiar_fecha_limite_todo(){
        if(count($this->asignaturas_estados_fechas_limites)>0){
            for($i=0; $i<count($this->asignaturas_estados_fechas_limites); $i++){
                $this->asignaturas_estados_fechas_limites[$i] = $this->convoc_asignaturas_fechas_limite;
            }
        }
    }


    public $FECHA_MINIMA_SUBIR_NOTA = "2015-01-01";
    protected function rulesForStatatusAsignaturas(){
        return [
            'asignaturas_estados_ids.*' => 'required',
            'asignaturas_estados_ids.*' => 'required',
            'asignaturas_estados_estados_docentes.*' => 'required',
            'asignaturas_estados_fechas_limites.*' => 'nullable|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA_SUBIR_NOTA .'|before_or_equal:'.date('Y-m-d', strtotime('+1 year')),
        ];
    }

    protected function rulesForSaveConvocatory(){
        return [
            'nombre_convocatoria' => 'required',
            'id_gestion' => 'required|not_in:Elegir...',
            'periodo' => 'required|not_in:Elegir...',
            #'id_tipo_convocatoria' => 'required|not_in:Elegir...',
            'sede' => 'required|not_in:Elegir...',
            'costoconvocatoria' => 'required|not_in:Elegir...',
            'descripcion_convocatoria' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'asignaturas' => 'required',
            'id_modalidad_curso' => 'required|not_in:Elegir...',
            'monto_convocatoria' => 'required|max:999999999',
        ];
    }

    protected $validationAttributes = [
        'asignaturas_estados_ids.*' => '"ID ASIGNATURA"',
        'asignaturas_estados_ids.*' => '"ESTADO"',
        'asignaturas_estados_estados_docentes.*' => '"ESTADO DOCENTE"',
        'asignaturas_estados_fechas_limites.*' => '"FECHA LÍMITE SUBIR NOTA"'
    ];
    /* ***************************** FIN REGLAS ************************************** */

    private function get_asignaturas(){
        return is_null($this->id_convocatoria_asignaturas)? []:  SiadiPlanificarAsignatura::join('siadi_asignaturas', 'siadi_asignaturas.id_siadi_asignatura', '=', 'siadi_planificar_asignaturas.id_siadi_asignatura')
            ->join('siadi_idiomas', 'siadi_idiomas.id_idioma', '=', 'siadi_asignaturas.id_idioma')
            ->join('siadi_nivel_idiomas', 'siadi_nivel_idiomas.id_nivel_idioma', '=', 'siadi_asignaturas.id_nivel_idioma')
            ->join('siadi_paralelos', 'siadi_paralelos.id_paralelo', '=', 'siadi_planificar_asignaturas.id_paralelo')
            ->where('siadi_planificar_asignaturas.id_siadi_convocatoria', $this->id_convocatoria_asignaturas)
            ->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'ELIMINADO')
            #->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '<>', 'MIGRACIÓN')
            ->where('siadi_asignaturas.estado_asignatura', '<>', 'ELIMINAR')
            ->where('siadi_paralelos.estado_paralelo', '<>', 'ELIMINAR')
            ->orderBy('siadi_planificar_asignaturas.id_siadi_asignatura')
            ->orderBy('siadi_idiomas.nombre_idioma', 'asc')
            ->orderBy('siadi_nivel_idiomas.nombre_nivel_idioma', 'asc')
            ->orderBy('siadi_paralelos.nombre_paralelo', 'asc')
            ->get();
    }
}
