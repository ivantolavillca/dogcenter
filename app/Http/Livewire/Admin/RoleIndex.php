<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $listeners = [
        'delete','render'
    ];


    public function updatingSearch(){
        $this->resetPage();
    }
          public $name;
    public $selectedPermissions = [];
  
   
 public $operation;
    public function rules()
    {
        if ($this->operation === 'saverol') {
            return $this->rulesSaveRol();
        } elseif ($this->operation === 'editrol') {
            return $this->rulesEditRol();
        }

        return array_merge($this->rulesSaveRol(), $this->rulesEditRol());
    }
    private function rulesSaveRol()
    {
        return [
           'name' => 'required|unique:roles,name',
        ];
    }
    private function rulesEditRol()
    {
        return [
           'name2' => 'required|string|max:255|unique:roles,name,' . $this->roleId,
        ];
    }
    
  public function updated($propertyName){
    $this->validateOnly($propertyName);

  }
    public function guardarRol()
    {
      $this->operation='saverol';
    
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
        $this->reset();
        
    }



    ///editar rol
 
    
    public $roleId;
    public $name2;
    public $selectedPermissions2 = [];

    public function editar_rol($roleId)
    {
        $this->roleId = $roleId;
        $role = Role::findOrFail($roleId);
        $this->name2 = $role->name;
        $this->selectedPermissions2 = $role->permissions()->pluck('name')->toArray();
        $this->emit('editroles'); 
    }

     public function guardarEditarRol()
    {
        $this->operation='editrol';
        $this->validate();

        $role = Role::findOrFail($this->roleId);
        $role->name = $this->name2;
        $role->save();

        $role->syncPermissions($this->selectedPermissions2);
$this->reset(); 
        $this->emit('closeModalEdit');
         $this->emit('alert','El rol se guardo satisfactoriamente');
        
    }

     public function cancelarEditar()
    {
     $this->reset(['name2']);  
    }
    public function render()
    { 
      
     
      $permissions2 = Permission::all();
         $roles = Role::where('name', 'LIKE', '%'. $this->search . '%')->paginate();
        $permissions = Permission::orderBy('id', 'ASC')->get();
        return view('livewire.admin.role-index',compact('roles','permissions','permissions2'));
    }
}
