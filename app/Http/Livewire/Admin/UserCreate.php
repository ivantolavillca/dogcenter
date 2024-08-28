<?php

namespace App\Http\Livewire\Admin;

use App\Models\base_upea\tabla_persona;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
  
    public $ci;
    public $nombre;
    public $paterno;
    public $materno;
    public $email;
    public $password;
    public $role;

    
    protected $rules=[

        
        'nombre' => 'required|string|max:255',
       
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|max:255',
        'role' => 'required|not_in:Elegir...',
    ];
    
    
  public function updated($propertyName){
    $this->validateOnly($propertyName);

  }

public function cancelar() {
    $this->reset([
        'ci','nombre','paterno','materno','email','password','role',
        
            ]);
            $this->resetValidation();

}  
    public function render()
    {
        $roles=Role::orderBy('id', 'ASC')->get();
        return view('livewire.admin.user-create',compact('roles'));
    }
    public function buscarPersona()
    {
        $persona = tabla_persona::where('ci', $this->ci)->first();

        if ($persona) {
            $this->nombre = $persona->nombre;
            $this->paterno = $persona->paterno;
            $this->materno = $persona->materno;
            $this->email = $persona->email;
            $this->password = $persona->nombre.'_'.$persona->ci;
        }
        else {
              $this->nombre = '';
            $this->paterno = '';
            $this->materno = '';
            $this->email = '';
            $this->password = '';
            $this->addError('buscarextraviado', 'El usuario no se encuentra registrado en U.P.E.A.');
        }
    }

  
    
    public function guardarUsuario()
{
   $this->validate();

  

    $user = new User;

    $user->name         = $this->nombre;
   
    $user->email           = $this->email;
   
   
   

   
    

    $user->password   = bcrypt($this->password);  
    $user->save();
    
    $user->assignRole($this->role);

    
    $this->reset([
'nombre','email','password','role'
    ]);



    
    $this->emit('closeModal');
        $this->emitTo('admin.users-index','render');
        $this->emit('alert','El usuario se guardo satisfactoriamente');

}
}
