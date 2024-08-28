<?php

namespace App\Http\Livewire\ModulosV;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Modulos\Fichas;
use Livewire\Component;
use Carbon\Carbon;
class ReportesAtencion extends Component
{
    public $search;
    public $data;
    public $contador=1;
    public $Idatencion;
    public $nombre_usu;
    public $fecha1;
    public $fecha2;
    public $totalDias;
    public $lim=true;
    public $lim2=true;
    public $operation;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public function imprimirPorFecha()
    {
        if (!$this->fecha1 || !$this->fecha2 || !$this->Idatencion) {
            session()->flash('error', 'Fecha requerida');
            return;
        }

        $url = route('imprimiratendidos', [
            'f1' => $this->fecha1,
            'f2' => $this->fecha2,
            'id_u' => $this->Idatencion
        ]);
        $this->emit('openNewTab', ['url' => $url]);
      
    }

    public function LimpiarmodalTabla()
    {
        $this->reset(['search', 'data', 'contador', 'Idatencion', 'fecha1', 'fecha2','nombre_usu','totalDias','lim','lim2']);
        $this->emit("cerrarmodalatencion");
    }
    public function LimpiarFechas()
    {
        $this->reset(['fecha1', 'fecha2']);
        $this->lim=true;
        $this->lim2=true;
    }
    public function openModalVentas($id_usu)
    {
        $this->Idatencion = $id_usu;
        
        // Filtrar los datos por fecha si están definidas
        $query = Fichas::where('id_usuario', $this->Idatencion);
        $this->data = $query->get();
        $this->nombre_usu = User::find($id_usu)->name;
        $this->emit("abrirmodalatencion");
    }
    public function updatereporte()
    {
        // Filtrar los datos por fecha si están definidas
        $query = Fichas::where('id_usuario', $this->Idatencion)
        ->where('estado', 'atendido');
        if ($this->fecha1 && $this->fecha2) {
            $query->whereDate('created_at', '>=', $this->fecha1)
                  ->whereDate('created_at', '<=', $this->fecha2);
                  $this->lim=false;
                  $this->lim2=false;
        } elseif ($this->fecha1) {
            $query->whereDate('created_at', $this->fecha1);
            $this->lim=false;
        } elseif ($this->fecha2) {
            $query->whereDate('created_at', $this->fecha2);
            $this->lim2=false;
        }
        $this->totalDias = $query->count();
       
        return $this->data = $query->get();
     
    }
    public function render()
    {
       
        if($this->contador===1)
        {
            $dato2=$this->data;
            $this->contador=2;
        }
            else
        {
            $dato2=$this->updatereporte();
        }
        
        
        $Personales = User::where('estado', '<>', 'eliminado')
        ->where(function ($query) {
            $searchTerm = '%' . $this->search . '%';
            $query->orWhere('id', 'LIKE', $searchTerm);
            $query->orWhere('name', 'LIKE', $searchTerm);
        })
        ->orderBy('id', 'asc')
        ->paginate(10);
    
    return view('livewire..modulos-v.reportes-atencion',compact('Personales','dato2'));
     
    }
}
