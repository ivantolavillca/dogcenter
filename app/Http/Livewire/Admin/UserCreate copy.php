<?php

namespace App\Http\Livewire\Admin;

use App\Models\base_upea\tabla_persona;
use Livewire\Component;

class UserCreate extends Component
{

  public $open = false;
    public $ci;
    public $nombre;
    public $paterno;
    public $materno;
    public $email;
    public $password;

    
    
    public function abrirModal()
    {
        $this->open = true;
    }

    public function cerrarModal()
    {
        $this->open = false;
    }
    public function render()
    {
        
        return view('livewire.admin.user-create');
    }
    // public function buscarPersona()
    // {
    //     $persona = tabla_persona::where('ci', $this->ci)->first();

    //     if ($persona) {
    //         $this->nombre = $persona->nombre;
    //         $this->paterno = $persona->paterno;
    //         $this->materno = $persona->materno;
    //         $this->email = $persona->email;
    //         $this->password = $persona->nombre.'_'.$persona->ci;
    //     }
    //     else {
    //         session()->flash("error", "No existe la persona con el CI ingresado");
    //     }
    // }
}
