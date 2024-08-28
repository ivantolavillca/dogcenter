<?php

namespace App\Http\Livewire\ModulosV;
use Livewire\WithPagination;
use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\farmaciasVentas;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Internacion;
use App\Models\Modulos\Tratamiento_historial_clinico;
use App\Models\Modulos\Vacunas;
use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToArray;

class ReporteDiario extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

   public  $id_mascg;

   public $search;
    public $data;
    public $Idatencion;
    public $nombre_usu;
    public $fecha1;
    public $fecha2;
    public $totalDias;
    public $lim=true;
    public $lim2=true;
    public $operation;

    public function mount()
    {
         $this->Idatencion=$this->id_mascg;
    }

    public function imprimirPorFecha()
    {
        if (!$this->fecha1 || !$this->fecha2 || !$this->Idatencion) {
            session()->flash('error', 'Fecha requerida');
            return;
        }

        $url = route('imprimircosotosgeneral', [
            'f1' => $this->fecha1,
            'f2' => $this->fecha2,
            'id_u' => $this->Idatencion
        ]);
        $this->emit('openNewTab', ['url' => $url]);
    }
    public function imprimirPorFecha1($es)
    {
        if (!$this->fecha1 || !$this->fecha2 || !$this->Idatencion) {
            session()->flash('error', 'Fecha requerida');
            return;
        }

        $url = route('imprimircosotoindividual', [
            'f1' => $this->fecha1,
            'f2' => $this->fecha2,
            'id_u' => $this->Idatencion,
            'es' => $es
        ]);
        $this->emit('openNewTab', ['url' => $url]);
    }
    public function imprimirPorGeneral($es)
    {
        
        $url = route('imprimircosotoindividual', [
            'f1' => 0,
            'f2' => 0,
            'id_u' => $this->Idatencion,
            'es' => $es
        ]);
        $this->emit('openNewTab', ['url' => $url]);
    }
    public function reporteunicoregistro($id,$es)
    {
        $url = route('imprimircosotounregistro', [
            'id_m' => $this->Idatencion,
            'id' => $id,
            'es' => $es
        ]);
        $this->emit('openNewTab', ['url' => $url]);
    }
    public $datamodal,$totalDinero;
    public function reporteunitratamiento1($id,$es)
    {
        $this ->datamodal = Tratamiento_historial_clinico::where('historial_id', $id)->get();
        $this ->totalDinero = Tratamiento_historial_clinico::where('historial_id', $id)->sum('precio');
        $this->emit("abrirmodaltratamiento");
    }
    public function LimpiarmodalTabla()
    {
        
        $this->emit("cerrarmodaltratamiento");
        $this->reset(['datamodal', 'totalDinero']);
    }

    public function updatereportecirugia()
    {
        $query = Cirugias::where('id_mascota', $this->Idatencion)->where('estado', 'activo');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereportevacuna()
    {
        $query = Vacunas::where('mascota_id', $this->Idatencion)->where('estado', 'ACTIVO');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereportedesparasitacion()
    {
        $query = Desparacitaciones::where('mascota_id', $this->Idatencion)->where('estado', 'ACTIVO');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereporteconsulta()
    {
        $query = Historias_clinico::where('mascota_id', $this->Idatencion)->where('tipo_historial_id', 1)->where('estado', 'activo');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereportereconsulta()
    {
        $query = Historias_clinico::where('mascota_id', $this->Idatencion)->where('tipo_historial_id', 10)->where('estado', 'activo');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereporteestudios()
    {
        $query = Historias_clinico::where('mascota_id', $this->Idatencion)->where('estudio_complementario_id', '<>', null)->where('estado', 'activo');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereportefarmacias()
    {
        $query = farmaciasVentas::where('mascota_id', $this->Idatencion)->where('estado', 'activo');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
    public function updatereporteinternaciones()
    {  $query = Internacion::where('mascota_id', $this->Idatencion)->where('estado', 'activo');
        $this->applyDateFilters($query);
        $this->totalDias = $query->count();
        return $query->paginate(5);
    }
  
   

    private function applyDateFilters($query)
    {
        if ($this->fecha1 && $this->fecha2) {
            $query->whereDate('created_at', '>=', $this->fecha1)
                  ->whereDate('created_at', '<=', $this->fecha2);
            $this->lim = false;
            $this->lim2 = false;
        } elseif ($this->fecha1) {
            $query->whereDate('created_at', $this->fecha1);
            $this->lim = false;
        } elseif ($this->fecha2) {
            $query->whereDate('created_at', $this->fecha2);
            $this->lim2 = false;
        }
    }
    public function LimpiarFechas()
    {
        $this->reset(['fecha1', 'fecha2']);
        $this->lim = true;
        $this->lim2 = true;
    }
    public function render()
    {
        $cirugias=$this->updatereportecirugia();
        $vacunas=$this->updatereportevacuna();
        $desparasitaciones=$this->updatereportedesparasitacion();
        $consultas=$this->updatereporteconsulta();
        $reconsultas=$this->updatereportereconsulta();
        $estudios=$this->updatereporteestudios();
        $farmacias=$this->updatereportefarmacias();
        $internaciones=$this->updatereporteinternaciones();
        return view('livewire.modulos-v.reporte-diario',
        compact('cirugias','vacunas','desparasitaciones',
        'consultas','reconsultas','estudios','farmacias','internaciones'));
    }
}
