<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\CirugiasDatos;
use App\Models\Modulos\CirugiasPre;
use App\Models\Modulos\Mascotas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

//class CirujiaPre  extends ClientesIndex
class CirujiaPre  extends Component
{
    public $conta=1;
    public $clientess;
    //-------------------------------
    public $registro_completo;
    public $id_masco;
    public $operationss;
    public $descripcion;
    public $horaActual;
    public $cirugia_id;

    public $cirugiasini;
    public $cirugiasdatos;
    
    public function obtenerHora()
    {
        $this->horaActual = date('H:i:s');
        
    }
    // todo para crear cirugias -------------------------------------------------------------------------
    public function rules()
    {
        if ($this->operationss === "nuevo") {
            return $this->validartodocirugi();
        }elseif($this->operationss === "datos") {
            return $this->validartododatoscirugi();
        }

        return array_merge($this->validartodocirugi());
    }
    public function validartodocirugi()
    {
        return [
            'descripcion' => 'required'
        ];
    }
    public function limpiarmodalcirugia()
    {
        $this->reset(['descripcion']);
        $this->emit("cerrarmodalcirugia");
    }
    public function GuardarCirugia()
    {
        $this->operationss="nuevo";
        $this->validate();
        $this->guardardatosBDcirugia();
        $this->emit("alert", "CIRUGIA CREADA");
        $this->limpiarmodalcirugia();
    }
    public function guardardatosBDcirugia()
    {
            $Id_user = Auth::id();
            Cirugias::create([
                'id_mascota' =>  $this->id_masco,
                'id_usuario' => $Id_user,
                'descripcion' =>  $this->descripcion, 
                'estado' => 'activo',
            ]);
    }
    public function crearcirugias($mas_id)
    {
        $this->emit("alert","hola miky".$mas_id);
        $this->id_masco=$mas_id;
        //$this->registro_completo = Mascotas::find($mas_id);
        $this->emit("abrirmodalcirugiapre");
    }
    public function Crearcirugiamascota()
    {
       // $this->registro_completo = Mascotas::find($this->id_masco)->toArray();  dd($this->registro_completo);
        $this->registro_completo = Mascotas::find($this->id_masco);
        $this->emit("abrirmodalcirugia");
    }
    public function CerrarModalPrincipal()
    {
        //$this->reset(['id_masco','cirugia_id','cirugiasini','cirugiasdatos']);
       // $this->limpiarmodaldatoscirugia();
       // $this->emit("cerrarmodalcirugiapre");
    
    }
    //----------------------------------------------------------------------------------------------------
    // todo para crear datos cirugias -------------------------------------------------------------------------
    public $Hora, $FC, $FR, $tem , $MM, $TLLC, $SOPO2,$num;
    public function limpiarmodaldatoscirugia()
    {
        $this->reset(['horaActual','FC','FR','tem','MM','TLLC','SOPO2','num','operation']);
    }
    public function validartododatoscirugi()
    {
        return [
            'horaActual' => 'required','FC' => 'required','FR' => 'required','tem' => 'required',
            'MM' => 'required','TLLC' => 'required','SOPO2' => 'required'
        ];
    }
    public function GuardarDatosCirugia($nu,$id_ciru)
    {
        $this->cirugia_id=$id_ciru;
        $this->num=$nu;
        $this->operationss="datos";
        $this->validate();
        $this->guardardatosBDdatoscirugia();
       // $this->emit("alert", "CIRUGIA CREADA");
        $this->limpiarmodaldatoscirugia();
    }
    public function guardardatosBDdatoscirugia()
    {
        CirugiasDatos::create([ 'cirugia_id'=>  $this->cirugia_id,
        'hora'=>  $this->horaActual,'FC'=>  $this->FC,'FR'=>  $this->FR,
        'Tem'=>  $this->tem,'MM'=>  $this->MM,'TLLC'=>  $this->TLLC,
        'sopo2'=>  $this->SOPO2,'total'=>  $this->num
            ]);
    }


    //----------------------------------------------------------------------------------------------------
  
    
    public function render()
    {
        //$cirugias = Cirugias::All();
       // $cirugias = $this->retonaCirugias();
        $cirugiass = Cirugias::where('id_mascota', $this->id_masco)->get();
        $datoscirugiaspre = CirugiasDatos::where('total', 1)->get();


       // $datoscirugias = CirugiasDatos::where('cirugia_id', $this->id_masco)->get();
       /*  $cirugias = Cirugias::where('estado', '<>', 'eliminado')
        ->where('id_mascota', '=', $this->id_masco)
        ->where(function ($query) {
            $searchTerm = '%' . $this->search . '%';
            $query->orWhere('id', 'LIKE', $searchTerm);
        })
        ->orderBy('id', 'asc')
        ->paginate(10); */

    return view('livewire..modulos-v.cirujia-pre', compact('cirugiass','datoscirugiaspre'));

    }

}
