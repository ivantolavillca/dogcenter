<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\EstudiosComplementarios;
use Livewire\WithPagination;
class EstudioscomplmentariosIndex extends Component
{
    // todo para la paginacion y otras variables adicionales 
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'Eliminarestudiocomple'
    ];
    use WithPagination;
    public $operation;
    // inicializar variables de los modales 
    public $searchEstudio;
    public $Nombreestudiocomple;
    public $Descriestudiocomple;
    public $estudiocompleID;

    // crear las funciones de validacion 
    public function rules()
    {
        if ($this->operation === 'nombreEstudioNuevo') {
            return $this->rulesEstudios();
        }
        elseif($this->operation === 'nombreEstudioeditar')
        {
            return $this->rulesEstudios();
        }
        return array_merge($this->rulesEstudios());
    }
    public function rulesEstudios()
    {
        return [
            'Nombreestudiocomple' => 'required|string|max:125',
            'Descriestudiocomple' => 'required|string|max:125',
        ];
    }
   // funciones para el index y los controladores 
   public function updatingSearchEstudio()
   {
       $this->resetPage();
   }
    public function limpiarmodalEstu()
    {
        $this->reset(['Nombreestudiocomple','Descriestudiocomple','estudiocompleID']);
        $this->resetValidation();
    }
    public function GuardarEstudioComple()
    {
        $this->GuardarbdEstudioComple();
        $this->limpiarmodalEstu();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalEstudioComple');
    }
    public function GuardarbdEstudioComple()
    {
         // asignamoes un valor a la variable operation
         $this->operation='nombreEstudioNuevo';
         $this->validate();
        EstudiosComplementarios::create([
            'nombre' => $this->Nombreestudiocomple,
            'descripcion' => $this->Descriestudiocomple,
            'estado' => 'activo',
        ]);
    }
    // ------------------------------- todo para editarr usar mismo modal para crear 
     // abrimos el modal con los datos cargados
     public function EditarEstudioComplee($id)
     {
        $EstudioComple = EstudiosComplementarios::find($id);
        $this->estudiocompleID = $EstudioComple->id;
        $this->Nombreestudiocomple = $EstudioComple->nombre;
        $this->Descriestudiocomple = $EstudioComple->descripcion;
        $this->emit('abrirmodalEstudio');
     }
     // funcion del boton guardar editar para modificar la bd
     public function EditarEstudioComple()
     {
        // asignamoes un valor a la variable operation
        $this->operation='nombreEstudioeditar';
        $this->validate();

        $raza = EstudiosComplementarios::find($this->estudiocompleID);
        $raza->update([
            'nombre' => $this->Nombreestudiocomple,
            'descripcion' => $this->Descriestudiocomple,
        ]);
        $this->limpiarmodalEstu();
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalEstudioComple');
     }
     // todo para eliminar lo que llega 
     public function Eliminarestudiocomple($id)
     {
        $estudiocomple = EstudiosComplementarios::find($id);
        if ($estudiocomple) {
            $estudiocomple->estado = 'eliminado';
            $estudiocomple->save();
        }
     }
     public function CambiarEstado($id)
     {
        $produ = EstudiosComplementarios::find($id);
        if ($produ->estado == 'activo') {
            $produ->estado = 'inactivo';
            $produ->save();
            $this->emit('alert', 'Cuenta desactivada');
        } elseif ($produ->estado == 'inactivo') {
            $produ->estado = 'activo';
            $produ->save();
            $this->emit('alert', 'Cuenta activa');
        }
     }

    public function render()
    {
        $Estudiocomp = EstudiosComplementarios::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchEstudio . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('livewire.modulos-v.estudioscomplmentarios-index', compact('Estudiocomp'));
    }
 
}
