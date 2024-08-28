<?php

namespace App\Http\Livewire\ModulosV;

use Livewire\Component;
//use App\Models\Modulos\Clientes;
use App\Models\Modulos\CasosEnfermedades;
use App\Models\Modulos\Fichas;
use App\Models\Modulos\Mascotas;
use Carbon\Carbon;
use App\Events\FichaStatusUpdated;
use App\Models\User;
use Livewire\WithPagination;
class FinchaIndex extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    
    public $fichasss;
    protected $listeners = [
        'EliminarFicha', 'AtenderFicha','fichaActualizada','LlamarFicha','fichaActualizada'
    ];
    public $Idficha;
    public $Id_Cliente;
    public $Id_user;
    public $NombreCliente;
    public $Nombredoctor;
    public $SearchCliente;
    public $SearchCasos;
    public $SearchFicha;
    public $a = false;
    public $b = false;
    public function updatingSearchFicha()
    {
        $this->resetPage();
    }

     public function AtenderFicha($id)
    {
        $registro = Fichas::find($id);
        if ($registro) {
            $registro->estado = 'atendido';
            $registro->save();
            $fichaSta = new FichaStatusUpdated();
            event($fichaSta);
            $this->emit('fichaEliminada', $id);
        }
    }
    public function EliminarFicha($id)
    {
        $registro = Fichas::find($id);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
           $fichaSta = new FichaStatusUpdated();
           event($fichaSta);
            $this->emit('fichaEliminada', $id);
        }
    }

    public function CancelarFicha($id)
    {
        $registro = Fichas::find($id);
        if ($registro) {
            $registro->estado = 'inactivo';
            $registro->save();
            $fichaSta = new FichaStatusUpdated();
            event($fichaSta);
        }
    }
    public function LlamarFicha($id)
    {
        $fich = Fichas::find($id);
       $fichaSta = new FichaStatusUpdated();
        if ($fich->estado === 'activo') {
            $fich->estado = 'llamar';
            $fich->save();
            event($fichaSta);
          // $this->emit('alert', 'Cuenta desactivada');
            
        } elseif ($fich->estado === 'llamar') {
            $fich->estado = 'activo';
            $fich->save();
            event($fichaSta);
           // $this->emit('alert', 'Cuenta activa');
        }
    }
    public function actualizarFichas($id)
    {
        $this->fichasss = Fichas::where('id', $id)->get(); // Actualizar solo la ficha que ha sido atendida
    }
    public function limpiarmodal()
    {
        $this->reset(['Idficha', 'a', 'b', 'NombreCliente', 'Nombredoctor', 'Id_user', 'Id_Cliente']);
        $this->emit("cerrarmodalFicha");
    }
    public function abrirmodallupa()
    {
        $this->emit("abrirlupaID");
        //IDmodlupacerrar
    }
    public function abrirmodallupa2()
    {
        $this->emit("abrirlupaID2");
        //IDmodlupacerrar
    }
    public function limpiarmodalbusqueda()
    {
        $this->reset(['SearchCliente']);
        $this->emit("IDmodlupacerrar");
    }
    public function limpiarmodalbusqueda2()
    {
        $this->reset(['SearchCasos']);
        $this->emit("IDmodlupacerrar2");
    }
    public function CargarDatosNombreCi($id)
    {
        $registro = Mascotas::find($id);
        $this->reset(['SearchCliente']);
        $this->Id_Cliente = $registro->id;
        $this->NombreCliente = $registro->nombre;
        $this->a = true;
        $this->emit("IDmodlupacerrar");
    }
    public function CargarDatosNombreCi2($id)
    {
        $registro = User::find($id);
        $this->reset(['SearchCasos']);
        $this->Id_user = $registro->id;
        $this->Nombredoctor = $registro->name;
        $this->b = true;
        $this->emit("IDmodlupacerrar2");
    }
    public function ultima()
    {
        // Obtener la fecha actual
        $fechaActual = Carbon::now('America/La_Paz')->toDateString();
        // Buscar la última numeración para la fecha actual
        $ultimaNumeracion = Fichas::whereDate('created_at', $fechaActual)->max('numeracion');
        // Si no hay registros para la fecha actual, comenzar desde 1
        return $ultimaNumeracion ? $ultimaNumeracion + 1 : 1;
    }

    public function GuardarFIchas()
    {

        // $this->operacion="nuevo";
        // $this->validate();
        if($this->Id_Cliente) 
        {
            $this->guardardatosBD();
            $this->emit("alert", "FICHA CREADA");
            $this->limpiarmodal();
            $fichaSta = new FichaStatusUpdated();
            event($fichaSta);
        }       
        else{
            $this->emit("alerterror", "eroor ingrese una mascota");
        }
       
    }
    public function guardardatosBD()
    {
      
            Fichas::create([
                'id_cliente' =>  $this->Id_Cliente,
                'nombre_cli' =>  $this->NombreCliente,
                'id_usuario' => $this->Id_user,
                'usuario' =>  $this->Nombredoctor, 
                'numeracion' =>  $this->ultima(),
                'estado' => 'activo',
            ]);
       
       
    }
    public function mostrarAlerta()
    {
        // Emitir un evento para mostrar la alerta
        $this->emit('alerta.mostrar', '¡Alerta! Esta es una alerta importante.');
    }
    public function fichaActualizada()
    {

    }
    public function render()
    {
        $clientes = Mascotas::where('estado', '=', 'activo')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchCliente . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('peso', 'LIKE', $searchTerm);
                $query->orWhere('edad_mascota', 'LIKE', $searchTerm);
                $query->orWhere('sexo', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        //------------------------------------------------------------------
        $users = User::where('id', '!=', 'null')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchCasos . '%';
                $query->orWhere('name', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        //------------------------------------------------------------------
        $fichas = Fichas::where('estado', '<>', 'eliminado')
            ->where('estado', '<>', 'atendido')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchFicha . '%';
                $query->orWhere('id', 'LIKE', $searchTerm);
                $query->orWhere('nombre_cli', 'LIKE', $searchTerm);
                $query->orWhere('usuario', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

      return view('livewire.modulos-v.fincha-index', compact('clientes', 'users', 'fichas'));
    }
}
