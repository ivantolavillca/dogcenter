<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Vacunas;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteDoctores extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public $user_id, $AnioInicio, $AnioFinal, $Anio, $search;

    public function VerAtenciones($user)
    {
        $this->user_id = $user;
        $this->emit('abrirmodalveratenciones');
    }
    public function updatedAnioInicio()
    {
        $this->resetPage();
    }


    public function GetHistorial()
    {
        $query = Historias_clinico::where('user_id', $this->user_id)
            ->where('estado', 'activo')
            ->orderBy('id', 'desc');

        if ($this->AnioInicio != null) {
            $query->whereYear('created_at', '>=', $this->AnioInicio);
        }

        if ($this->AnioFinal != null) {
            $query->whereYear('created_at', '<=', $this->AnioFinal);
        }

        return $query->paginate(4, ['*'], 'historial_page');
    }

    public $consulta;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function ResetFecha()
    {
        $this->reset('AnioInicio','AnioFinal');
    }
    
    public function Cerrar()
    {
        $this->gotoPage(1, 'historial_page');
        $this->gotoPage(1, 'desparacitaciones_page');
        $this->gotoPage(1, 'vacunas_page');
        $this->gotoPage(1, 'cirugias_page');
    }

    public function render()
    {
        $query1 = Historias_clinico::where('user_id', $this->user_id)
            ->where('estado', 'activo');

        if ($this->AnioInicio != null) {
            $query1->whereDate('created_at', '>=', $this->AnioInicio);
        }

        if ($this->AnioFinal != null) {
            $query1->whereDate('created_at', '<=', $this->AnioFinal);
        }

        $UsuarioHistorialClinico = $query1->orderBy('id', 'desc')->paginate(4, ['*'], 'historial_page');

        $query2 = Desparacitaciones::where('veterinario', $this->user_id)
            ->where('estado', 'activo');

        if ($this->AnioInicio != null) {
            $query2->whereDate('created_at', '>=', $this->AnioInicio);
        }

        if ($this->AnioFinal != null) {
            $query2->whereDate('created_at', '<=', $this->AnioFinal);
        }

        $UsuarioDesparacitaciones = $query2->orderBy('id', 'desc')->paginate(4, ['*'], 'desparacitaciones_page');

        $query3 = Vacunas::where('veterinario', $this->user_id)
            ->where('estado', 'activo');

        if ($this->AnioInicio != null) {
            $query3->whereDate('created_at', '>=', $this->AnioInicio);
        }

        if ($this->AnioFinal != null) {
            $query3->whereDate('created_at', '<=', $this->AnioFinal);
        }

        $UsuarioVacunas = $query3->orderBy('id', 'desc')->paginate(4, ['*'], 'vacunas_page');
        $query4 = Cirugias::where('id_usuario', $this->user_id)
            ->where('estado', 'activo');

        if ($this->AnioInicio != null) {
            $query4->whereDate('created_at', '>=', $this->AnioInicio);
        }

        if ($this->AnioFinal != null) {
            $query4->whereDate('created_at', '<=', $this->AnioFinal);
        }

        $UsuarioCirugias = $query4->orderBy('id', 'desc')->paginate(4, ['*'], 'cirugias_page');




        // $UsuarioDesparacitaciones = Desparacitaciones::where('veterinario', $this->user_id)->paginate(4, ['*'], 'desparacitacion_page');
        // $UsuarioVacunas = Vacunas::where('user_id', $this->user_id)->paginate(4, ['*'], 'vacunas_page');

        $usuarios = User::where('estado', '<>', '0')
            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->orWhere('name', 'LIKE', $searchTerm);
                $query->orWhere('email', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(4);
            $totalHistoriasClinico = Historias_clinico::where('user_id', $this->user_id)
            ->where('estado', 'activo')
            ->when($this->AnioInicio, function ($query) {
                $query->whereDate('created_at', '>=', $this->AnioInicio);
            })
            ->when($this->AnioFinal, function ($query) {
                $query->whereDate('created_at', '<=', $this->AnioFinal);
            })
            ->sum('precio');
    
        $totalDesparacitaciones = Desparacitaciones::where('veterinario', $this->user_id)
            ->where('estado', 'activo')
            ->when($this->AnioInicio, function ($query) {
                $query->whereDate('created_at', '>=', $this->AnioInicio);
            })
            ->when($this->AnioFinal, function ($query) {
                $query->whereDate('created_at', '<=', $this->AnioFinal);
            })
            ->sum('precio');
    
        $totalVacunas = Vacunas::where('veterinario', $this->user_id)
            ->where('estado', 'activo')
            ->when($this->AnioInicio, function ($query) {
                $query->whereDate('created_at', '>=', $this->AnioInicio);
            })
            ->when($this->AnioFinal, function ($query) {
                $query->whereDate('created_at', '<=', $this->AnioFinal);
            })
            ->sum('precio');
    
        $totalCirugias = Cirugias::where('id_usuario', $this->user_id)
            ->where('estado', 'activo')
            ->when($this->AnioInicio, function ($query) {
                $query->whereDate('created_at', '>=', $this->AnioInicio);
            })
            ->when($this->AnioFinal, function ($query) {
                $query->whereDate('created_at', '<=', $this->AnioFinal);
            })
            ->sum('total');
    
        $total = $totalHistoriasClinico + $totalDesparacitaciones + $totalVacunas + $totalCirugias;
    
    return view('livewire.modulos-v.reporte-doctores', compact(
        'usuarios',
        'UsuarioHistorialClinico',
        'UsuarioVacunas',
        'UsuarioDesparacitaciones',
        'UsuarioCirugias',
        'totalHistoriasClinico',
        'totalDesparacitaciones',
        'totalVacunas',
        'totalCirugias',
        'total'
    ));
    }
}
