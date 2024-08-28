<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\Especies;
use App\Models\Modulos\Razas;
use Livewire\WithPagination;

class MascotasIndex extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $searchEspecie;
    public $searchRaza;
    use WithPagination;
    // para escuchar al javascrip
    protected $listeners = [
        'eliminarespecie', 'eliminarraza',
    ];
    public $operation;

    public $NombreEspecie;

    public function rules()
    {
        if ($this->operation === 'crearcliente') {
            return $this->rulesCrearEspeci();
        } elseif ($this->operation === 'nombrederaza') {
            return $this->rulesEditarRaza();
        }

        return array_merge($this->rulesCrearEspeci(), $this->rulesEditarRaza());
    }
    private function rulesCrearEspeci()
    {
        return [
            'nombre' => 'required|string|max:125',
        ];
    }

    public function GuardarEspecie()
    {
        // $this->operation = "crearespecie";
        //$this->validate();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->guardarbdespecie();
        $this->limpiarmodalespecie();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalcrearespecie');
    }
    private function rulesCrearEspecie()
    {
        return [
            'NombreEspecie' => 'required|string|max:125',
        ];
    }
    private function rulesEditarRaza()
    {
        return [
            'NombreRazaEdit' => 'required|string|max:125',
        ];
    }
    public function guardarbdespecie()
    {
        Especies::create([
            'nombre' => $this->NombreEspecie,
            'estado' => 'activo',
        ]);
    }
    public function eliminarespecie($id)
    {
        $especie = Especies::find($id);
        if ($especie) {
            $especie->estado = 'eliminado';
            $especie->save();
        }
    }
    public $NombreEspecieEdit;
    public $especieId;
    public function editarespeciemas($id)
    {
        $especie = Especies::find($id);
        $this->NombreEspecieEdit = $especie->nombre;
        $this->especieId = $especie->id;
        $this->emit('abrirmodaleditarespecie');
    }
    public  function limpiarmodalEditar()
    {
        $this->reset(['NombreEspecieEdit']);
        $this->resetValidation();
    }
    public function limpiarmodalespecie()
    {
        $this->reset(['NombreEspecie']);
        $this->resetValidation();
    }
    // GuardarEspecieEditado
    public function GuardarEspecieEditado()
    {
        $especie = Especies::find($this->especieId);
        // Actualiza el nombre
        $especie->update([
            'nombre' => $this->NombreEspecieEdit,
            // Puedes agregar más campos aquí si es necesario
        ]);
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodaleditaespecie');
    }
    //--------------------------------------------------------------------------- todo para raza -----------------
    public $NombreRaza;
    public function GuardarRaza()
    {
        // $this->operation = "crearespecie";
        //$this->validate();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->guardarbdraza();
        $this->limpiarmodalraza();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalcrearraza');
    }
    public function limpiarmodalraza()
    {
        $this->reset(['NombreRaza']);
        $this->resetValidation();
    }
    public function guardarbdraza()
    {
        Razas::create([
            'nombre' => $this->NombreRaza,
            'estado' => 'activo',
        ]);
    }
    public function eliminarraza($id)
    {
        $raza = Razas::find($id);
        if ($raza) {
            $raza->estado = 'eliminado';
            $raza->save();
        }
    }
    public $NombreRazaEdit;
    public $razaId;
    public $operacion;


    public function editarazasmas($id)
    {

        $raza = Razas::find($id);
        $this->NombreRazaEdit = $raza->nombre;
        $this->razaId = $raza->id;
        $this->emit('abrirmodaleditarraza');
    }

    public function GuardarRazaEditado()
    {
        $this->operation = 'nombrederaza';
        $this->validate();
        $raza = Razas::find($this->razaId);
        $raza->update([
            'nombre' => $this->NombreRazaEdit,
        ]);
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodaleditaraza');
    }

    public function CambiarEstadoraza($id)
    {
        $produ = Razas::find($id);
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
    public function CambiarEstadoespecie($id)
    {
        $produ = Especies::find($id);
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
        $especies = Especies::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchEspecie . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3, ['*'], 'especies_page');

        $razas = Razas::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm2 = '%' . $this->searchRaza . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm2);
            })
            ->orderBy('id', 'desc')
            ->paginate(3, ['*'], 'razas_page');

        return view('livewire.modulos-v.mascotas-index', compact('especies', 'razas'));
    }
    public function updatingSearchEspecie()
    {
        $this->resetPage('especies_page');
    }

    public function updatingSearchRaza()
    {
        $this->resetPage('razas_page');
    }
}
