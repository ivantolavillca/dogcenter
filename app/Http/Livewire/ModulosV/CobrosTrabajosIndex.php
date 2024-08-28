<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\farmaciasVentas;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Internacion;
use App\Models\Modulos\Tratamiento_historial_clinico;
use App\Models\Modulos\Vacunas;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CobrosTrabajosIndex extends Component
{

    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $Doctor, $AnioInicio, $AnioFinal, $tratamiento;

    public function VerTratamientos($id)
    {
        $this->tratamiento = $id;
        $this->emit('abrirmodaltratamiento');
    }
    public function UpdatedDoctor()
    {
        $this->gotoPage(1, 'consulta_page');
        $this->gotoPage(1, 'desparacitaciones_page');
        $this->gotoPage(1, 'vacunas_page');
        $this->gotoPage(1, 'cirugias_page');
        $this->gotoPage(1, 'farmacia_page');
        $this->gotoPage(1, 'internacion_page');
    }
    public function render()
    {
        $doctorseleccionado = [];
        if ($this->Doctor != null) {
            $doctorseleccionado = User::find($this->Doctor);
        }
        $tratamientos = Tratamiento_historial_clinico::where('historial_id', $this->tratamiento)->get();
        $query1 = Historias_clinico::where('user_id', $this->Doctor)
            ->where('estado', 'activo')
            ->where(function ($query) {
                $query->where('tipo_historial_id', 1)
                    ->orWhere('tipo_historial_id', 10);
            });
        if ($this->AnioInicio != null) {
            $query1->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query1->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioHistorialClinico = $query1->orderBy('created_at', 'desc')->paginate(10, ['*'], 'consulta_page');
        $query2 = Desparacitaciones::where('veterinario', $this->Doctor)
            ->where('estado', 'activo');
        if ($this->AnioInicio != null) {
            $query2->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query2->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioDesparacitaciones = $query2->orderBy('created_at', 'desc')->paginate(10, ['*'], 'desparacitaciones_page');
        $query3 = Vacunas::where('veterinario', $this->Doctor)
            ->where('estado', 'activo');
        if ($this->AnioInicio != null) {
            $query3->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query3->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioVacunas = $query3->orderBy('created_at', 'desc')->paginate(10, ['*'], 'vacunas_page');
        $query4 = Cirugias::where('id_usuario', $this->Doctor)
            ->where('estado', 'activo');
        if ($this->AnioInicio != null) {
            $query4->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query4->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioCirugias = $query4->orderBy('created_at', 'desc')->paginate(10, ['*'], 'cirugias_page');
        $query5 = farmaciasVentas::where('doctor_id', $this->Doctor)
            ->where('estado', 'activo');
        if ($this->AnioInicio != null) {
            $query5->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query5->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioFarmacia = $query5->orderBy('created_at', 'desc')->paginate(10, ['*'], 'farmacia_page');
        $query6 = Internacion::where('user_id', $this->Doctor)
            ->where('estado', 'activo');
        if ($this->AnioInicio != null) {
            $query6->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query6->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioInternacion = $query6->orderBy('created_at', 'desc')->paginate(10, ['*'], 'internacion_page');
        $query7 = Historias_clinico::where('user_id', $this->Doctor)
            ->where('estado', 'activo')
            ->where('tipo_historial_id', 2);
        if ($this->AnioInicio != null) {
            $query7->whereDate('created_at', '>=', $this->AnioInicio);
        }
        if ($this->AnioFinal != null) {
            $query7->whereDate('created_at', '<=', $this->AnioFinal);
        }
        $UsuarioEstudio = $query7->orderBy('created_at', 'desc')->paginate(10, ['*'], 'estudio_page');
        $personas = User::orderBy('name', 'asc')->get();
        return view('livewire.modulos-v.cobros-trabajos-index', compact(
            'personas',
            'doctorseleccionado',
            'UsuarioCirugias',
            'UsuarioVacunas',
            'UsuarioDesparacitaciones',
            'UsuarioHistorialClinico',
            'tratamientos',
            'UsuarioFarmacia',
            'UsuarioInternacion',
            'UsuarioEstudio',
        ));
    }
}
