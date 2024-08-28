<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AdministracionModulos\Certificados;
use App\Models\AdministracionModulos\CertificadosReimpresions;

class Verificar extends Component
{
    public $search;
    public $search_codigo;
    public $search_ci, $status_ci = false;
    public $search_fecha_certificado, $status_fecha = false;

    public function render()
    {
        $this->estado_boton_seach_ci();
        $this->estado_boton_fecha_reimpresion();
        return view('livewire.verificar',[
            'certificado' => $this->get_certificado_datos() #buscar
        ]);
    }

    public function mount(){
        $this->search_codigo = ''; #R0005/2023';
        $this->search_ci = '';#'7088751';
        $this->search_fecha_certificado =''; # '2023-10-20';
        #Certificados::whereIn('certificado_id', [17])->delete();
    }

    protected $rules = [
        'search_codigo' => 'required|size:10',
        'search_ci' => 'required|max:12',
        'search_fecha_certificado' => 'required|date|date_format:Y-m-d'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    private function estado_boton_seach_ci(){
        #$this->emit('mos', 'Ingresa');
        if(strlen($this->search_codigo)>0){
            $this->status_ci = true;
        } else {
            $this->status_ci = false;
            $this->search_ci = '';
        }
    }
    
    private function estado_boton_fecha_reimpresion(){
    	if(strlen($this->search_codigo)>0){
    	    if($this->search_codigo[0]=="R"){
                $this->status_fecha = true;
            } else {
            	$this->status_fecha = false;
            }
    	} else {
    	    $this->status_fecha = false;
    	}
    }

    private function get_certificado_datos(){
        if(strlen($this->search_codigo)==10 && strlen($this->search_ci)>0){
            #$this->emit('mos', $this->status_fecha);
            if($this->status_fecha){
                $obj_reimpresion = \DB::table('certificados_reimpresions')
                    ->join('certificados', 'certificados.certificado_id', '=', 'certificados_reimpresions.certificado_id')
                    ->join('siadi_notas', 'siadi_notas.id_nota', '=', 'certificados.id_nota')
                    ->join('siadi_inscripcions', 'siadi_inscripcions.id_inscripcion', '=', 'siadi_notas.id_inscripcion')
                    ->join('siadi_personas', 'siadi_personas.id_siadi_persona', '=', 'siadi_inscripcions.id_siadi_persona')
                ->select(
                    'certificados.certificado_id',
                    'certificados_reimpresions.certificados_reimpresions_id',
                    'certificados_reimpresions.codigo_siadi_certificado',
                    'certificados_reimpresions.fecha_siadi_certificado'
                    )
                ->where([
                    'siadi_notas.estado_nota' => 'ACTIVO',
                    'siadi_personas.estado_persona' => 'ACTIVO',
                    'siadi_inscripcions.estado_inscripcion' => 'ACTIVO'
                ])
                ->where([
                    'certificados_reimpresions.codigo_siadi_certificado' => $this->search_codigo,
                    'siadi_personas.ci_persona' => $this->search_ci,
                    'certificados_reimpresions.fecha_siadi_certificado' => $this->search_fecha_certificado
                ])
                ->first();
                if(is_null($obj_reimpresion)){
                    return null;
                } else {
                    $certificado = new Certificados();
                    $reimpresion_certifiocado = $certificado->get_data_certifcado($obj_reimpresion->certificado_id);
                    if(!is_null($reimpresion_certifiocado)){
                        $reimpresion_certifiocado->codigo_siadi_certificado = $obj_reimpresion->codigo_siadi_certificado;
                        $reimpresion_certifiocado->fecha = $obj_reimpresion->fecha_siadi_certificado;
                        $reimpresion_certifiocado->codigo_qr = "REIMPRESION/". substr($reimpresion_certifiocado->codigo_qr, 1);
                    }
                    return $reimpresion_certifiocado;
                }
            } else {
                $obj_ceritificado = \DB::table('certificados')
                    ->join('siadi_notas', 'siadi_notas.id_nota', '=', 'certificados.id_nota')
                    ->join('siadi_inscripcions', 'siadi_inscripcions.id_inscripcion', '=', 'siadi_notas.id_inscripcion')
                    ->join('siadi_personas', 'siadi_personas.id_siadi_persona', '=', 'siadi_inscripcions.id_siadi_persona')
                ->select('certificados.certificado_id')
                ->where([
                    'siadi_notas.estado_nota' => 'ACTIVO',
                    'siadi_personas.estado_persona' => 'ACTIVO',
                    'siadi_inscripcions.estado_inscripcion' => 'ACTIVO'
                ])
                ->where([
                    'certificados.codigo_siadi_certificado' => $this->search_codigo,
                    'siadi_personas.ci_persona' => $this->search_ci
                ])
                ->first();
                #$this->emit('mos', json_encode($obj_ceritificado). "\n with=$this->search_codigo, $this->search_ci");
                if(is_null($obj_ceritificado)){
                    return null;
                } else {
                    $certificado = new Certificados();
                    return $certificado->get_data_certifcado($obj_ceritificado->certificado_id);
                }
            }
        } else {
            return null;
        }
        
    }

}
