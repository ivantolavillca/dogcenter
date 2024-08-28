<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiAsignatura;
use App\Models\AdministracionModulos\SiadiParalelo;
use App\Models\AdministracionModulos\SiadiPlanificarAsignatura;
use App\Models\AdministracionModulos\SiadiPlanificarParalelo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PlanificarParaleloIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'render', 'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';
     public function updatingSearch()
    {
        $this->resetPage();
    }

public $cidocente;
public $nombre_docente;
public $docente_id_persona;
public $asignatura;
public $asignatura_id;
public function updatedCidocente()
{
    $this->buscar_docente();
}
public function notasdocente($idasignatura){
 $edit = SiadiPlanificarAsignatura::find($idasignatura); 

        if ($edit) {
            $edit->estado_docente = $edit->estado_docente ? 0 : 1;
            $edit->save();
        }
         $this->emit('alert','Se cambio el estado con éxito');
}
public function buscar_docente()
{
   $docente = DB::connection('base_upea')
    ->table('persona AS p')
    ->select('p.nombre', 'p.paterno', 'p.materno','p.id') 
    ->join('vista_asignacion_control_docente_actua AS v', 'p.id', '=', 'v.id_persona')
    ->groupBy('p.id')
    ->where('v.carrera_id', 13)
    ->where('p.ci', $this->cidocente)
    ->first();

    if ($docente) {
        $this->nombre_docente = $docente->nombre . ' ' . $docente->paterno . ' ' . $docente->materno;
        $this->docente_id_persona=$docente->id;
    } else {
        $this->docente_id_persona='';
        $this->nombre_docente='';
      
        $this->addError('buscarextraviado', 'El docente no se encuentra registrado en U.P.E.A.');
    }
}
public function asignar_docente($idAsignatura)
{
    $asignarura_select=SiadiPlanificarAsignatura::where('id_planificar_asignatura',$idAsignatura)->first();
   $this->asignatura_id=$asignarura_select->id_planificar_asignatura;
    $this->asignatura= $asignarura_select->siadi_asignatura->sigla_asignatura. ' '.$asignarura_select->siadi_paralelo->nombre_paralelo.' '.$asignarura_select->siadi_convocatoria->nombre_convocatoria;
}
 public function rules()
    {
        return [
            'docente_id_persona' => 'required',
            'asignatura_id' => 'required',
           
        ];
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }

public function guardar_asignacion(){
 $this->validate();


   $siadi_asignatura_asignacion = SiadiPlanificarAsignatura::find($this->asignatura_id);
        $siadi_asignatura_asignacion->update([

            'id_asignacion_docente' => $this->docente_id_persona,

           
        ]);

 $this->emit('alert', "Se realizó la asignación de {$this->nombre_docente}");

$this->cancelar_asignacion();
$this->emit('cerrarFragmento');

}
public function cancelar_asignacion(){
$this->reset([
   
    'cidocente',
    'nombre_docente',
    'docente_id_persona',
    'asignatura',
    'asignatura_id',
]);
$this->resetValidation();

}
    // public $id_planificar_asignatura;
    // public $id_paralelo;
    // public $turno;
    // public $cupo_maximo;
    // public $cupo_minimo;

    // public function cancelar()
    // {
    //     $this->reset([
    //         'id_planificar_asignatura',
    //         'id_paralelo',
    //         'turno',
    //         'cupo_maximo',
    //         'cupo_minimo',
    //     ]);
    //     $this->resetValidation();
    // }

    // public function rules()
    // {
    //     return [
    //         'id_planificar_asignatura' => 'required',
    //         'id_paralelo' => 'required',
    //         'turno' => 'required',
    //         'cupo_maximo' => 'required',
    //         'cupo_minimo' => 'required',
    //     ];
    // }
     // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);

    // }
    // public function updatingSearch()
    // {
    //     $this->validate([
    //         'search' => 'required|max:50',
    //     ]);

    //     $this->resetPage();
    // }

   

    // public function cancelarEditar()
    // {
    //     $this->reset([
    //         'id_planificar_asignatura',
    //         'id_paralelo',
    //         'turno',
    //         'cupo_maximo',
    //         'cupo_minimo',
    //     ]);

    // }

    // public function guardar_planParalelo()
    // {
    //     $this->validate();

    //     $guardarParalelo = new SiadiPlanificarParalelo();
    //     $guardarParalelo->id_planificar_asignatura = $this->id_planificar_asignatura;
    //     $guardarParalelo->id_paralelo = $this->id_paralelo;
    //     $guardarParalelo->turno_paralelo = $this->turno;
    //     $guardarParalelo->cupo_maximo_paralelo = $this->cupo_maximo;
    //     $guardarParalelo->cupo_minimo_paralelo = $this->cupo_minimo;
    //     $guardarParalelo->save();

    //     $this->reset([
    //         'id_planificar_asignatura',
    //         'id_paralelo',
    //         'turno',
    //         'cupo_maximo',
    //         'cupo_minimo',
    //     ]);

    //     $this->emit('closeModalCreate');

    //     $this->emit('alert', 'La planificacion del paralelo se guardo satisfactoriamente');
    // }

    // public function editar_plan_paralelo(SiadiPlanificarParalelo $planificar_paralelo)
    // {
    //     $this->id_planificar_asignatura = $planificar_paralelo->id_planificar_asignatura;
    //     $this->id_paralelo = $planificar_paralelo->id_paralelo;
    //     $this->turno = $planificar_paralelo->turno_paralelo;
    //     $this->cupo_maximo = $planificar_paralelo->cupo_maximo_paralelo;
    //     $this->cupo_minimo = $planificar_paralelo->cupo_minimo_paralelo;
    // }

    // public function cambiar_estado_planificar_paralelo($id_planificar_paralelo)
    // {
    //     // Utiliza $idConvocatoria en lugar de $this->convocatoriaId
    //     $siadi_planificar_paralelo = SiadiPlanificarParalelo::find($id_planificar_paralelo);

    //     if ($siadi_planificar_paralelo) {
    //         $siadi_planificar_paralelo->estado_paralelo = $siadi_planificar_paralelo->estado_paralelo === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
    //         $siadi_planificar_paralelo->save();
    //     }

    //     // Emitir evento para notificar que el estado ha cambiado (opcional)
    //     $this->emit('alert', 'Se cambio el estado de la convocatoria con éxito');

    // }

    public function render()
    {

       

    


        $search = '%' . $this->search . '%';

        $planificar_asignaturas = SiadiPlanificarAsignatura::where('estado_planificar_asignartura', '<>', 'ELIMINAR')
             ->when($this->search, function ($query, $search) {
        $query->where(function ($subquery) use ($search) {
            $subquery->where('turno_paralelo', 'LIKE', '%' . $search . '%')
            
                ;
        })
        ->orWhereHas('siadi_asignatura', function ($query) use ($search) {
            $query->where('sigla_asignatura', 'LIKE', '%' . $search . '%')
           
           ;
        })
        ->orWhereHas('siadi_paralelo', function ($query) use ($search) {
            $query->where('nombre_paralelo', 'LIKE', '%' . $search . '%');
        })
        ->orWhereHas('siadi_convocatoria', function ($query) use ($search) {
            $query->where('nombre_convocatoria', 'LIKE', '%' . $search . '%')
               ->orWhereHas('gestion', function ($query) use ($search) {
            $query->where('nombre_gestion', 'LIKE', '%' . $search . '%');
        })
            
            ;
        })
     
       ;
    })
            ->latest('id_planificar_asignatura')
            ->paginate(5);

        // $planificar_asignaturas = DB::table('siadi_planificar_asignaturas')->join('siadi_asignaturas', 'siadi_planificar_asignaturas.id_siadi_asignatura', '=', 'siadi_asignaturas.id_siadi_asignatura')->join('siadi_idiomas', 'siadi_asignaturas.id_idioma', '=', 'siadi_idiomas.id_idioma')->join('siadi_nivel_idiomas', 'siadi_asignaturas.id_nivel_idioma', '=', 'siadi_nivel_idiomas.id_nivel_idioma')->select('siadi_planificar_asignaturas.id_planificar_asignatura', 'siadi_planificar_asignaturas.nombre_planificar_asignatura', 'siadi_idiomas.nombre_idioma', 'siadi_nivel_idiomas.nombre_nivel_idioma')->where('siadi_planificar_asignaturas.estado_planificar_asignartura', '=', 'ACTIVO')->get();

        // $paralelos = SiadiParalelo::select('id_paralelo', 'nombre_paralelo')->where('estado_paralelo', '=', 'ACTIVO')->get();

        return view('livewire.administracion-modulos.planificar-paralelo-index', compact('planificar_asignaturas'));
    }
}
