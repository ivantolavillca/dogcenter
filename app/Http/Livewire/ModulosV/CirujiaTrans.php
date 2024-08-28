<?php
namespace App\Http\Livewire\ModulosV;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\HistorialesPsados;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class CirujiaTrans extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search,$search2, $descripcion,$operationss,$b; 
    public $registro_completoh;
    public $clave=false;
    public $id_mascota,$historial_id_selected,
    $SeleccionTipoDeArchivo,$ArchivoDelEstudio;
    public $rutaImagenfinal,$imagenBinaria,$nombreImagen,$rutaImagen,$a=false;
    use WithPagination;
    protected $listeners = [
        'imagenCapturada','eliminahistorialaa'
    ];
    public $imagenBase6444;
    public function imagenCapturada($imagenBase64)
    {
        $this->emit('alert', 'IMAGEN capturada CON EXITO');
         $this->imagenBase6444 = $imagenBase64;
        $this->emit('alert', "esta tomada la foto");
        $this->imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
        $this->nombreImagen = uniqid('imagen') . '.png';
        $this->rutaImagen = 'public/historialPasados/' . $this->nombreImagen;
        Storage::put($this->rutaImagen, $this->imagenBinaria);
        $urlImagenAnterior = parse_url($this->rutaImagen, PHP_URL_PATH);
        $rutaImagenAnterior = str_replace('public', 'storage', $this->rutaImagen);
        $this->rutaImagenfinal = url($rutaImagenAnterior);
        $this->a = true; 
    }
    public function limpiarbotonpro()
    {
        if ($this->rutaImagen !== null) {
            Storage::delete($this->rutaImagen);
        }
        $this->a = false;
        $this->b = false;
        $this->resetValidation();
        $this->reset(['rutaImagenfinal', 'rutaImagen']);
        $this->emit('alert', 'IMAGEN REMOVIDA CON EXITO');
    }
    public $facingMode;
    
    public function cambiarCamara($n)
    {
        if($n==1)
        {
            $this->facingMode = 'environment';
        $this->emit('refreshCamara2', $this->facingMode);
        }
        else
        {
            $this->facingMode = 'user';
        $this->emit('refreshCamara', $this->facingMode);
        }

    }


    public function rules()
    {
        if ($this->operationss === "nuevo") {
            return $this->validartodo();
        }elseif($this->operationss === "datos") {
            return $this->validartodo();
        }
        return array_merge($this->validartodo());
    }
    public function validartodo()
    {
        return [
            'descripcion' => 'required',
            'ArchivoDelEstudio' => 'required|max:200000'
        ];
    }
    public function limpiarcamara()
    {

        if ($this->rutaImagen !== null) {
            Storage::delete($this->rutaImagen);
            $this->emit('alert', 'IMAGEN ELIMINADA CON EXITO');
        }
        $this->reset(['SeleccionTipoDeArchivo']);
       // $this->emit('cerrarmodalcamara');
       // $this->emit('abrirmodalhistorial');
    }

    public function crearhistorial($idmascota)
    {
        $this->id_mascota=$idmascota;
        $this->registro_completoh = Mascotas::find($idmascota);
        $this->emit("abrirmodalhistorial");
    }
    public function openmodalhistori($idmascota)
    {
     $this->emit("abrirmodalhistorial");
    }
    public function limpiarmodalhistop()
    {
        if ($this->rutaImagen !== null) {
            Storage::delete($this->rutaImagen);
        }
     $this->resetValidation();
     $this->reset(['descripcion','registro_completoh','id_mascota','a','b','rutaImagenfinal', 'rutaImagen',
     'historial_id_selected','SeleccionTipoDeArchivo','ArchivoDelEstudio','search','operationss']);
     $this->LimpiarDatosimagenes();
    }
   
    public function LimpiarDatosimagenes()
    {
        $this->reset('archivosPdfciru');
        $this->resetValidation(); // Esto limpiará la validación
      #  $this->emit('alert', 'Datos Limpiados con Exito');
      #  session()->forget('success');
       # $this->resetErrorBag();
    }
    public $registrosciruimg,  $idregistrosciruimg;
    public function VerImagenesCirugias($id_cir)
    {
        $this->idregistrosciruimg=$id_cir;
        $this->registrosciruimg = HistorialesPsados::where('cirugia_id', $id_cir)
                        ->where('estado', '<>', 'eliminado')
                        ->get();

        $this->emit('abrirmodalcirugiaimagen');
    }
    public function CerrarImagenesCirugias()
    {
        $this->reset('registrosciruimg');
        $this->emit( 'cerrarmodalcirugiaimagen');
    }
    public function BorrarImagen_cirugia($id_im)
    {
        $regisciruimg = HistorialesPsados::find($id_im);

        if($regisciruimg)
        {
            $regisciruimg->estado = 'eliminado';
            $regisciruimg->save();
            $this->emit('alert', 'Se Elimino con exito');
        }
        else {}
        $this->registrosciruimg = HistorialesPsados::where('cirugia_id', $this->idregistrosciruimg)
                        ->where('estado', '<>', 'eliminado')
                        ->get();
    }
    public $archivosPdfciru;
    public function GuardarImagenes()
    {
        if ($this->SeleccionTipoDeArchivo == 'imagen') {
            if($this->archivosPdfciru )
            {
                foreach ($this->archivosPdfciru as $archivo) {
                    $extension = $archivo->getClientOriginalExtension();
                    if (!in_array($extension, ['jpg','png','jpeg'])) {
                        $this->addError('archivosPdfciru', 'Todos los archivos deben ser imágenes.');
                        return;
                    }
                }
                $this->validate([
                    'archivosPdfciru' => 'required|array|min:1', // Se espera que sea un array con al menos un elemento
                    'archivosPdfciru.*' => 'mimes:jpg,png,jpeg|max:20000', // Cada archivo debe ser un PDF o una imagen y no mayor a 20 MB
                ], [
                    'archivosPdfciru.required' => 'Debe seleccionar al menos un archivo.',
                    'archivosPdfciru.*.mimes' => 'Todos los archivos deben ser PDF o imágenes (JPG, PNG, JPEG).',
                    'archivosPdfciru.*.max' => 'Todos los archivos no deben ser mayores a 20 MB.'
                ]);
        
                // Iterar sobre los archivos y guardarlos en la base de datos
                foreach ($this->archivosPdfciru as $archivo) {
                    $nombreArchivo = uniqid('historialPasados') . '.' . $archivo->getClientOriginalExtension();
        
                    // Guardar el archivo en el almacenamiento y obtener la ruta
                    $rutaArchivo = $archivo->storeAs('public/historialPasados', $nombreArchivo);
                
                    // Crear un nuevo registro en la base de datos
                    HistorialesPsados::create([
                    'id_mascota' => $this->id_mascota,
                    'descripcion' => $this->descripcion,
                    'urlimagen' =>url('/') . '/storage/historialPasados/' . $nombreArchivo,
             
                    ]);
                }
                session()->flash('success', 'Los archivos PDF se han subido correctamente.');
                // Limpiar los archivos cargados
                $this->reset('archivosPdfciru');
                $this->emit('alert', 'Datos Alamcenados Con exito');
            }
            else
            {
                $this->emit("alerterror", "Error: Imagenes Vacias");
            }
           
        } elseif($this->SeleccionTipoDeArchivo == 'pdf' ) {
            $this->validate([
                'archivosPdfciru' => 'required|min:1|mimes:pdf|max:20000',

            ]);
            $archivo = $this->archivosPdfciru;
            //dd($archivo);
            $nombreArchivo = uniqid('historialpasado') . '.' . $archivo->getClientOriginalExtension();
            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/historialPasados', $nombreArchivo);
            //$usuario = Auth::user();

            HistorialesPsados::create([
                'id_mascota' => $this->id_mascota,
                'descripcion' => $this->descripcion,
                'urlimagen' =>url('/') . '/storage/historialPasados/' . $nombreArchivo,
         
                ]);
            $this->reset('archivosPdfciru');
            $this->emit('alert', 'Historial creado con exito');
          
        } 
        
        elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            //$this->operation = "nuevo2";
            //$this->validate();
            if ($this->rutaImagenfinal) {
               // $usuario = Auth::user();
               HistorialesPsados::create([
                    'id_mascota' => $this->id_mascota,
                    'descripcion' => $this->descripcion,
                    'urlimagen' => $this->rutaImagenfinal,
                ]);
                $this->a = false;
                $this->b = false;
                $this->limpiarmodalHistorialreporte();
                $this->emit('cerrarmodalhistorial');
                $this->emit('alert', 'Historial Antiguo guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    //---------------------------------------------------------------------todo reportes ------------------- 
    public function openModalReporte($id_masco)
    { 
        
        $this->id_mascota=$id_masco;
        $this->registro_completoh = Mascotas::find($id_masco);
        $this->emit('abrirmodalhistorialreporte');

    }
    public function limpiarmodalHistorialreporte()
    {
        $this->reset(['id_mascota','rutaImagenfinal','rutaImagen']);
            $this->emit('cerrarmodalhistorialreporte');
    }
    public function eliminahistorialaa($id_histo)
    { 
            $registro = HistorialesPsados::find($id_histo);
            if ($registro) {
                $registro->estado = 'eliminado';
                $registro->save();
            }
    }
    public $id_cli;


    /////////////////////////////-------------- todo render 

    public function render()
    {
        if($this->id_cli)
        {
            $this->search=$this->id_cli;
            $Personales = Clientes::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->orWhere('id', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'asc')
            ->paginate(5, ['*'], 'pagclientes');
        }
        else{
            $Personales = Clientes::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->orWhere('id', 'LIKE', $searchTerm);
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('apellidos', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'asc')
            ->paginate(5, ['*'], 'pagclientes');
        }
  

        $historiales= HistorialesPsados::where('estado', '<>', 'eliminado')
        ->where('id_mascota', '=', $this->id_mascota)
        ->where(function ($query) {
            $searchTerm = '%' . $this->search2 . '%';
            $query->orWhere('id', 'LIKE', $searchTerm);
            $query->orWhere('descripcion', 'LIKE', $searchTerm);
        })
        ->orderBy('id', 'asc')
        ->paginate(5, ['*'], 'paghistorial');
    return view('livewire.modulos-v.cirujia-trans', compact('Personales','historiales'));
    }
    public function updatingSearch()
    {
        $this->resetPage('pagclientes');
    }
    public function updatingSearch2()
    {
        $this->resetPage('paghistorial');
    }
}
