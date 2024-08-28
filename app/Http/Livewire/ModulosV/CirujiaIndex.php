<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Mascotas;
use Livewire\Component;
use Livewire\WithPagination;
class CirujiaIndex extends Component
{
    public $conta=1;
    public $id_mascota;
    public $registro_completo;
    public $Id_Cliente;
    public $descripcion;
    public $operation;
    public $search;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    public function mount()
    {
        $this->registro_completo = Mascotas::find($this->id_mascota);
        //$this->Id_Cliente = Mascotas::find($this->id_mascota)->cliente_id;
    }
    public function rules()
    {
        if ($this->operation === "nuevo") {
            return $this->validartodo();
        } 
        return array_merge($this->validartodo());
    }
    public function validartodo()
    {
        return [
            'descripcion' => 'required'
        ];
    }
    public function limpiarmodal()
    {
        $this->reset(['descripcion']);
        $this->emit("cerrarmodalcirugia");
    }
    public function cargardatoscirugia()
    {
       // $this->registro_completo=Mascotas::find($this->id_mascota);
        $this->emit("abrirmodalcirugia");
    }
    public function GuardarCirugia()
    {
        $this->operation="nuevo";
        $this->validate();
        $this->guardardatosBD();
        $this->emit("alert", "CIRUGIA CREADA");
        $this->limpiarmodal();
    }
    public function guardardatosBD()
    {
            Cirugias::create([
                'id_mascota' =>  $this->id_mascota,
               // 'id_usuario' => $this->Id_user,
                'descripcion' =>  $this->descripcion, 
                'estado' => 'activo',
            ]);
    }
    //------------------------------------------------ Todo pre operatorio -----------------------------------------



    public function render()
    {
        $cirugias = Cirugias::where('estado', '<>', 'eliminado')
        ->where('id_mascota', '=', $this->id_mascota)
        ->where(function ($query) {
            $searchTerm = '%' . $this->search . '%';
            $query->orWhere('id', 'LIKE', $searchTerm);
        })
        ->orderBy('id', 'asc')
        ->paginate(10);

    return view('livewire..modulos-v.cirujia-index', compact('cirugias'));
      
    }
}
