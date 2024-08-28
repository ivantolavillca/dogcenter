<?php
namespace App\Http\Livewire\ModulosV;
use Livewire\Component;
use App\Models\Modulos\TiposImagenologias;
use Livewire\WithPagination;
class TiposdeImagenologias extends Component
{
    // todo para la paginacion y otras variables adicionales 
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'eliminarespecie'
    ];
    use WithPagination;
    public $operation;
    // inicializar variables de los modales 
    public $searchimagen;
    public $NombreImagenologia;
    public $tipoimagenId;

    // crear las funciones de validacion 
    public function rules()
    {
        if ($this->operation === 'nombreImageneNuevo') {
            return $this->rulesEditartiposImg();
        }
        elseif($this->operation === 'nombreImageneditar')
        {
            return $this->rulesEditartiposImg();
        }
        return array_merge($this->rulesEditartiposImg(),$this->rulesEditartiposImg());
    }
    public function rulesEditartiposImg()
    {
        return [
            'NombreImagenologia' => 'required|string|max:125',
        ];
    }
   // funciones para el index y los controladores 
    public function updatingSearch()
    {$this->resetPage();}
    public function limpiarmodalimage()
    {
        $this->reset(['NombreImagenologia','tipoimagenId']);
        $this->resetValidation();
    }
    public function GuardarImagenologia()
    {
        $this->GuardarbdImagenologia();
        $this->limpiarmodalimage();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalImagenologia');
    }
    public function GuardarbdImagenologia()
    {
         // asignamoes un valor a la variable operation
         $this->operation='nombreImageneNuevo';
         $this->validate();
        TiposImagenologias::create([
            'nombre' => $this->NombreImagenologia,
            'estado' => 'activo',
        ]);
    }
    // ------------------------------- todo para editarr usar mismo modal para crear 
     // abrimos el modal con los datos cargados
     public function editartiposimagen($id)
     {
        $tiposimg = TiposImagenologias::find($id);
        $this->tipoimagenId = $tiposimg->id;
        $this->NombreImagenologia = $tiposimg->nombre;
        $this->emit('abrirmodalcreaimg');
     }
     // funcion del boton guardar editar para modificar la bd
     public function EditarImagenologia()
     {
        // asignamoes un valor a la variable operation
        $this->operation='nombreImageneditar';
        $this->validate();

        $raza = TiposImagenologias::find($this->tipoimagenId);
        $raza->update([
            'nombre' => $this->NombreImagenologia,
        ]);
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalImagenologia');
     }
     // todo para eliminar lo que llega 
     public function eliminarespecie($id)
     {
        $tiposimg = TiposImagenologias::find($id);
        if ($tiposimg) {
            $tiposimg->estado = 'eliminado';
            $tiposimg->save();
        }
     }
     
    public function render()
    {
        $tiposimagenes = TiposImagenologias::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchimagen . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        return view('livewire.modulos-v.tiposde-imagenologias', compact('tiposimagenes'));
    }
}
