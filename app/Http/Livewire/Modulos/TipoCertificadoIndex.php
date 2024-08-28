<?php

namespace App\Http\Livewire\Modulos;

use App\Models\TipoCertificado;
use Livewire\Component;
use Livewire\WithPagination;
class TipoCertificadoIndex extends Component
{
    use WithPagination;

    public $search = '';
   
    protected $listeners = [
        'delete',
    ];

  

    public function updatingSearch(){
        $this->resetPage();
    }

   
  
 
    public function delete(TipoCertificado $tipocertificado): void
    {
        $tipocertificado->estado_baja_tipo_certificado = ($tipocertificado->estado_baja_tipo_certificado ? 0 : 1);
        $tipocertificado->update();

    
          
           
    }
    public function render()
    {
        $tcertifiado = TipoCertificado::where('estado_baja_tipo_certificado', 1)
        ->Where('nombre_tipo_certificado', 'LIKE', '%'. $this->search . '%')
        
        ->latest('tipo_certificados_id')
        ->paginate(5); 
        return view('livewire.modulos.tipo-certificado-index',compact('tcertifiado'));
    }
}
