<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
use App\Models\Modulos\Proveedor;
use Livewire\WithPagination;
class ProveedorIndex extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $Idprovedor;
    public $Nombreproveedor;
    public $ci_pro;
    public $celular_pro;
    public $correo_pro;
    public $Nit_pro;
    public $searchProvedor;

    public $operation;
    protected $listeners = [
        'EliminarProvedor'
    ];

    public function rules()
    {
        if ($this->operation === "reglascrear") {
            return $this->validartodo();
        } elseif ($this->operation === 'xx---------') {
            return $this->validartodo2();
        }
        return array_merge($this->validartodo());
    }
    public function validartodo()
    {
        return [
            'Nombreproveedor' => 'required|string|max:125',
            'ci_pro' => 'required|max:125',
            'celular_pro' => 'required|max:125',
            'correo_pro' => 'required|max:125',
            'Nit_pro' => 'required|max:125',
        ];
    }
    public function limpiarmodalprove()
    {
        $this->reset(['Idprovedor', 'Nombreproveedor', 'ci_pro', 'celular_pro', 'correo_pro', 'Nit_pro']);
        $this->resetValidation();
        $this->emit('cerrarmodalproveedor');
    }
    public function GuardarProveedo()
    {
        $this->operation = "reglascrear";
        $this->validate();
        $this->guardardatosBD();
        $this->emit('alert', 'DATOS REGISTRADOS DEL PROVEEDOR');
        $this->limpiarmodalprove();
    }
    public function guardardatosBD()
    {
        Proveedor::create([
            'nombre' =>  $this->Nombreproveedor,
            'ci' => $this->ci_pro,
            'celular' => $this->celular_pro,
            'correo' => $this->correo_pro,
            'NIT' => $this->Nit_pro,
            'estado' => 'activo',
        ]);
    }
    public function CambiarEstado($id)
    {
        $prove = Proveedor::find($id);
        if ($prove->estado == 'activo') {
            $prove->estado = 'inactivo';
            $prove->save();
            $this->emit('alert', 'Cuenta desactivada');
        } elseif ($prove->estado == 'inactivo') {
            $prove->estado = 'activo';
            $prove->save();
            $this->emit('alert', 'Cuenta activa');
        }
    }
    public function EliminarProvedor($id)
    {
        $prove = Proveedor::find($id);
        if ($prove) {
            $prove->estado = 'eliminado';
            $prove->save();
        }
    }
    public function editarprovedor($id)
    {
        $prove = Proveedor::find($id);

        $this->Idprovedor = $prove->id;
        $this->Nombreproveedor = $prove->nombre;
        $this->ci_pro = $prove->ci;
        $this->celular_pro = $prove->celular;
        $this->correo_pro = $prove->correo;
        $this->Nit_pro = $prove->NIT;
        $this->emit('abrirmodalprovedor');
    }
    public function EditarDatosProveedor()
    {
        $this->operation = 'reglascrear';
        $this->validate();
        $prove = Proveedor::find($this->Idprovedor);
        $prove->update([
            'nombre' =>  $this->Nombreproveedor,
            'ci' => $this->ci_pro,
            'celular' => $this->celular_pro,
            'correo' => $this->correo_pro,
            'NIT' => $this->Nit_pro,
        ]);
        $this->limpiarmodalprove();
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalproveedor');
    }

    public function render()
    {
        $proveedores = Proveedor::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchProvedor . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('ci', 'LIKE', $searchTerm);
                $query->orWhere('celular', 'LIKE', $searchTerm);
                $query->orWhere('correo', 'LIKE', $searchTerm);
                $query->orWhere('NIT', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.modulos-v.proveedor-index', compact('proveedores'));
    }
    public function updatingSearchProvedor()
    {
        $this->resetPage();
    }
}
