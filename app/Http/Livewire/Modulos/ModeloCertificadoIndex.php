<?php

namespace App\Http\Livewire\Modulos;

use App\Models\ModeloCertificado;
use Livewire\Component;

class ModeloCertificadoIndex extends Component
{
    public $search = '';
   
    protected $listeners = [
        'delete',
    ];




    public function render()
    {


        $mcertificado = ModeloCertificado::where('estado_baja_certificado', 1)
        ->Where('nombre_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('nombre_area_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('nombre_carrera_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('nombre_departamento_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto1_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto2_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto3_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto4_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto5_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto6_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('texto7_cuerpo_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('cargo_autoridad1_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('cargo_autoridad2_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('cargo_autoridad3_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('ancho_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('alto_certificado', 'LIKE', '%'. $this->search . '%')
        ->orWhere('pie_de_pagina_certificado', 'LIKE', '%'. $this->search . '%')
        
        ->latest('modelo_certificados_id')
        ->paginate(5); 
       
        return view('livewire.modulos.modelo-certificado-index',compact('mcertificado'));
    }
}
