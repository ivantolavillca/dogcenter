<?php

namespace App\Http\Livewire\ModulosV;



use Livewire\Component;
use App\Models\Modulos\ColoresMascotas;
use Livewire\WithPagination;
class MascotaColor extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $searchRaza;
    public $NombreRaza;
    public $razaId;

    use WithPagination;
    // para escuchar al javascrip
    protected $listeners = [
        'eliminarraza',
    ];
    public $operation;

    public function rules()
    {
        if ($this->operation === 'editarraza') {
            return $this->rulesEditarRaza();
        } elseif ($this->operation === 'crearraza') {
            return $this->rulesEditarRaza();
        }

        return array_merge($this->rulesEditarRaza());
    }

    private function rulesEditarRaza()
    {
        return [
            'NombreRaza' => 'required|string|max:125',
        ];
    }

    public function limpiarmodalraza()
    {
        $this->reset(['NombreRaza', 'razaId']);
        $this->resetValidation();
    }
    //--------------------------------------------------------------------------- todo para raza -----------------

    public function GuardarRaza()
    {
        $this->operation = "crearraza";
        $this->validate();
        $this->guardarbdraza();
        $this->limpiarmodalraza();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalcrearraza');
    }

    public function guardarbdraza()
    {
        ColoresMascotas::create([
            'nombre' => $this->NombreRaza,
            'estado' => 'activo',
        ]);
    }
    public function eliminarraza($id)
    {
        $raza = ColoresMascotas::find($id);
        if ($raza) {
            $raza->estado = 'eliminado';
            $raza->save();
        }
    }
    public function editarazasmas($id)
    {

        $raza = ColoresMascotas::find($id);
        $this->NombreRaza = $raza->nombre;
        $this->razaId = $raza->id;
        $this->emit('abrirmodaleditarraza');
    }

    public function btnEditarDatos()
    {
        $this->operation = 'editarraza';
        $this->validate();
        $raza = ColoresMascotas::find($this->razaId);
        $raza->update([
            'nombre' => $this->NombreRaza,
        ]);
        $this->limpiarmodalraza();
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalcrearraza');
    }

    public function CambiarEstadoraza($id)
    {
        $produ = ColoresMascotas::find($id);
        if ($produ->estado == 'activo') {
            $produ->estado = 'inactivo';
            $produ->save();
            $this->emit('alert', 'Cuenta desactivada');
        } elseif ($produ->estado == 'inactivo') {
            $produ->estado = 'activo';
            $produ->save();
            // $this->emit('alert', 'Cuenta activa');
            $this->emit('alertaaa', 'Mensaje de prueba para pruebas en tiempo real');
        }
    }

    public function render()
    {

        $razas = ColoresMascotas::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm2 = '%' . $this->searchRaza . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm2);
            })
            ->orderBy('id', 'desc')
            ->paginate(6, ['*'], 'razas_page');

        return view('livewire..modulos-v.mascota-color', compact('razas'));
    }

    public function updatingSearchRaza()
    {
        $this->resetPage('razas_page');
    }

}
