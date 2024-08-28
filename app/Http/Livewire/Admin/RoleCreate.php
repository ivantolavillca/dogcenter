<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $name;
    public $selectedPermissions = [];
    public function render()
    {
        $permissions=Permission::all();
        return view('livewire.admin.role-create',compact('permissions'));
    }

      protected $rules=[
         'name' => 'required|unique:roles,name',
    ];
    
    
  public function updated($propertyName){
    $this->validateOnly($propertyName);

  }
     public function guardarRol()
    {
        $this->validate();
        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selectedPermissions);


        // Aquí podrías agregar más lógica si es necesario, como redireccionar o mostrar un mensaje de éxito.
  $this->emitTo('admin.role-index','render');
        $this->emit('alert','El rol se guardo satisfactoriamente');
        $this->emit('closeModal');
          $this->reset();
    }
       public function cancelar()
    {
        // Limpiar los datos del formulario y cerrar el modal.
        $this->reset(['name','selectedPermissions']);
        
    }
}
