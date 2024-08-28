<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\CasosEnfermedades;
class CasosEnferIndex extends Component
{
    public $Idcasosenfermedad;
    public $CasoEnfermedad;
    public $operacion;
    public $searchCaso;
    protected $listeners = [
        'EliminarCasosAtencion'
    ];
    //abrirmodalenfermedad
    public function rules()
    {
        if($this->operacion==="nuevo")
        {
            return  $this->reglasfinales();         
        }
    }
    public function reglasfinales()
    {
        return [
            'CasoEnfermedad' => 'required|string|max:125',
        ];        
    }        
    public function limpiarmodalcaso()
    {
       $this->reset(['Idcasosenfermedad','CasoEnfermedad','operacion']);
       $this->resetValidation();
       $this->emit("cerrarmodalenfermedad");
    }
    
    public function GuardarCasos()
    {
        $this->operacion="nuevo";
        $this->validate();
        $this->guardardatosBD();
        $this->emit("alert","CASO DE ENFERMDAD CREADA");
        $this->limpiarmodalcaso();
    }
    public function guardardatosBD()
    {
        CasosEnfermedades::create([
            'descripcion' =>  $this->CasoEnfermedad,
            'estado' => 'activo',
        ]);
    }
    public function CambiarEstado($id)
    {
        $registro = CasosEnfermedades::find($id);
        if ($registro->estado == 'activo') {
            $registro->estado = 'inactivo';
            $registro->save();
            $this->emit('alert', 'Cuenta desactivada');
        } elseif ($registro->estado == 'inactivo') {
            $registro->estado = 'activo';
            $registro->save();
            $this->emit('alert', 'Cuenta activa');
        }
    }
    public function editarDatos($id)
    {   
        $registro = CasosEnfermedades::find($id);
        $this->Idcasosenfermedad = $registro->id;
        $this->CasoEnfermedad = $registro->descripcion;
        $this->emit('abrirmodalenfermedad');
    }
    public function EditarDatosCasos()
    {   
        $this->operacion='nuevo';
        $this->validate();
        $registro = CasosEnfermedades::find($this->Idcasosenfermedad);
        $registro->update([
            'descripcion' =>  $this->CasoEnfermedad,
        ]);
        $this->limpiarmodalcaso();
        $this->emit('alert', 'REGISTRO EDITADO');
    }
    
    public function EliminarCasosAtencion($id)
    {
        $registro = CasosEnfermedades::find($id);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
        }
    }

    public function render()
    {
        $atenciones = CasosEnfermedades::where('estado', '<>', 'eliminado')
        ->where(function ($query) {
            $searchTerm = '%' . $this->searchCaso . '%';
            $query->orWhere('descripcion', 'LIKE', $searchTerm);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
    return view('livewire.modulos-v.casos-enfer-index', compact('atenciones'));
        
    }

}
