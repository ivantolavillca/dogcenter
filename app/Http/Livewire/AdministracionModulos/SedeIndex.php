<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\SiadiSede;
use App\Models\AdministracionModulos\SiadiConvocatoria;
use App\Models\base_upea\tabla_sede;
use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SedeIndex extends Component
{
     use WithPagination;
    protected $listeners = [
        'delete',
    ];
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $sedes = SiadiSede::where('estado_siadi_sede','<>','ELIMINAR')
            ->where(function($query){
                $query->where('direccion', 'LIKE', "%$this->search%");
            })
            ->latest('id_siadi_sede')
            ->paginate(5);
        $sedes_upea = ($this->operation=='guardar' || $this->operation=='editar')? tabla_sede::get(): [];
        return view('livewire.administracion-modulos.sede-index',[
            "sedes" => $sedes,
            "sedes_upea" => $sedes_upea
        ]); #compact('sedes', 'sedes_upea')
    }

    /* ***************  INIT RULES   ************ */
    public $operation;

    protected function rules(){
        # tipo de operacion
        if($this->operation=='guardar'){
            return $this->rulesForSave();
        } else if($this->operation=='editar'){
            return $this->rulesForEdit();
        }
        return array_merge($this->rulesForSave(), $this->rulesForEdit());
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public $id_sede_upea;
    public $direccion_siadi;
    protected function rulesForSave(){
        return [
            'id_sede_upea' => 'required|integer',
            'direccion_siadi' => 'required|uppercase|min:5|max:150|unique:siadi_sede,direccion'
        ];
    }

    public $edit_sede_actual;
    public $edit_id_sede_upea;
    public $edit_direccion_siadi;
    protected function rulesForEdit(){
        return [
            'edit_id_sede_upea' => 'required|integer',
            'edit_direccion_siadi' => [
                'required',
                'uppercase',
                'min:5',
                'max:150',
                function($attribute, $value, $fail){
                    $direccion_actual = (!is_null($this->edit_sede_actual)? $this->edit_sede_actual->direccion: null);
                    if($direccion_actual!==$value){
                        $validatedData = Validator::make([$attribute => $value], [
                            $attribute => 'unique:siadi_sede,direccion'
                        ])->validate();
                    }
                }
            ]
        ];
    }

    protected $validationAttributes = [
        # rulesForSave
        'id_sede_upea' => '"Sede U.P.E.A."',
        'direccion_siadi' => '"Dirección"',

        # rulesForEdit
        'edit_id_sede_upea' => '"Sede U.P.E.A."',
        'edit_direccion_siadi' => '"Dirección"'
    ];
    /* *************** END RULES   ************ */

    public function show_form_create(){
        $this->emit("showModalCreate");
        $this->operation = 'guardar';
    }

    public function close_form_create():void{
        $this->emit('closeModalCreate');
        $this->operation = "";
        $this->reset([
            'id_sede_upea',
            'direccion_siadi'
        ]);
        $this->resetValidation();
    }

    public function guardar_sede(){
        if($this->operation == 'guardar'){
            $this->validate();
            $seden = new SiadiSede();
            $seden->id_sede = $this->id_sede_upea;
            $seden->direccion = $this->direccion_siadi;
            $seden->save();
            $this->emit("alert", "Sede Guardado exitosamente.");
            $this->close_form_create();
        } else {
            $this->emit('Acceso ilegal A Formulario Crear Sede');
            $this->close_form_create();
        }
    }

    public $estadoBoton;
    public function show_form_edit($id_sede_update){
        $this->edit_sede_actual = SiadiSede::find($id_sede_update);
        if(!is_null($this->edit_sede_actual)){
            $this->operation = 'editar';
            $this->edit_id_sede_upea = $this->edit_sede_actual->id_sede;
            $this->edit_direccion_siadi = $this->edit_sede_actual->direccion;
            $this->estadoBoton = false;
            $this->emit("showModalEdit");
        } else {
            $this->emit("errorvalidate", "No se encontró Sede");
        }
    }

    public function close_form_edit(): void{
        $this->operation = "";
        $this->resetValidation();
        $this->emit('closeModalEdit');
        $this->reset([
            'edit_id_sede_upea',
            'edit_direccion_siadi'
        ]);
        $this->edit_sede_actual = null;
    }

    public function actualizar_sede(){
        if($this->operation == 'editar' && !is_null($this->edit_sede_actual)){
            $this->validate();
            $this->edit_sede_actual->id_sede = $this->edit_id_sede_upea;
            $this->edit_sede_actual->direccion = $this->edit_direccion_siadi;
            $this->edit_sede_actual->save();
            $this->emit('alert', 'Sede Actualizada exitosamente');
            $this->close_form_edit();
        } else {
            $this->emit("errorvalidate", 'Acceso ilegal A Formulario Actualizar Sede');
            $this->close_form_edit();
        }
    }

    public function updatedEditIdSedeUpea(){ $this->actualizaEstadoBoton(); }
    public function updatedEditDireccionSiadi(){ $this->actualizaEstadoBoton(); }

    private function actualizaEstadoBoton(){
        $this->estadoBoton = false;
        if(!is_null($this->edit_sede_actual)){
            $this->validate();
            /* $this->emit("Mostrar", json_encode([
                "old" => $this->edit_sede_actual->id_sede,
                "new" => $this->edit_id_sede_upea
            ])); */
            $this->estadoBoton = intval($this->edit_id_sede_upea)!==$this->edit_sede_actual->id_sede || $this->edit_direccion_siadi !== $this->edit_sede_actual->direccion;
        }
    }

    public function delete(SiadiSede $sede_update): void{
        $sede_update->estado_siadi_sede = 'ELIMINAR';
        $sede_update->update();
    }

    public function cambiar_estado_idioma($id_sede_change) {
        $sede_estado = SiadiSede::find($id_sede_change);

        if ($sede_estado) {
            $sede_estado->estado_siadi_sede	 = $sede_estado->estado_siadi_sede	 === 'ACTIVO' ? 'INACTIVO' : 'ACTIVO';
            $sede_estado->save();
            $this->emit('alert','Se cambio el estado con éxito');
        }
    }


    # ************************* CAMBIAR SEDE TEXTO
    public function sede_direccion(){
        $tipo = "DIRECCION";
        $this->cambiar_sede_direccion($tipo);
    }
    public function sede_nombre_sede_upea(){
        $tipo = "NOMBRE SEDE UPEA";
        $this->cambiar_sede_direccion($tipo);
    }

    private function cambiar_sede_direccion($tipo){
        $convocatorias = SiadiConvocatoria::get();
        try{
            \DB::beginTransaction();
            foreach($convocatorias as $convocatory){
                if($tipo == "DIRECCION"){
                    $convocatory->sede = $convocatory->siadi_sede->direccion;
                } else if($tipo = "NOMBRE SEDE UPEA"){
                    $convocatory->sede = $convocatory->siadi_sede->sede_upea->nombre;
                }
                $convocatory->save();
            }
            \DB::commit();
            $this->emit("alert", "Actualizada exitosamente a '$tipo'");
        } catch(\Exception $e){
            DB::rollback();
            $this->emit("errorvalidate", "Error al cambiar a sede '$tipo': ". $e->getMessage());
        }
    }
}
