<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\Publicaciones;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PublicacionesIndex extends Component
{

    use WithFileUploads;
    public $PAGINATE = 4;

    public $titulo;
    public $descripcion;
    public $imagen;
    public $tipopublicacion;
    public $fecha_inicio_convocatoria;
    public $fecha_fin_convocatoria;
    public $url_video;

    public $titulo_edit;
    public $descripcion_edit;
    public $imagen_edit;
    public $tipo_publicacion_edit;
    public $fecha_inicio_convocatoria_edit;
    public $fecha_fin_convocatoria_edit;
    public $url_video_edit;
    
    # 
    public $COMUNICADO_PX_ANCHO = 800;
    public $COMUNICADO_PX_ALTO = 575;
    public $CONVOCATORIA_PX_ANCHO = 550;
    public $CONVOCATORIA_PX_ALTO = 849;

    public $categorias =  ["Convocatoria", "Comunicados", "Horario", "Video"];

    public $FECHA_MINIMA = '2000-09-05';

    public $operation;

    public function rules()
    {
        if ($this->operation === 'savepublicacion') {
            return $this->rulesguardarpublicacion();
        } elseif ($this->operation === 'editpublicacion') {
            return $this->ruleseditarpublicacion();
        }

        return array_merge($this->rulesguardarpublicacion(), $this->ruleseditarpublicacion());
    }

    private function rulesguardarpublicacion()
    {
        $fecha_minima = is_null($this->fecha_inicio_convocatoria) && $this->fecha_inicio_convocatoria==''? $this->FECHA_MINIMA: $this->fecha_inicio_convocatoria;
        
        return [
            'titulo' => 'required|string|max:2000',
            'descripcion' => 'required|string|max:2000',
            'tipopublicacion' => 'required',
            'imagen' => $this->tipopublicacion!=='Video'?'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:23096': '',
            'fecha_inicio_convocatoria' => $this->tipopublicacion=='Convocatoria'? 'required|date|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA. '|before_or_equal:'.date('Y-m-d', strtotime('+1 year')) : 'nullable',
            'fecha_fin_convocatoria' => $this->tipopublicacion=='Convocatoria'? 'required|date|date_format:Y-m-d|after_or_equal:'. $fecha_minima. '|before_or_equal:'.date('Y-m-d', strtotime('+1 year')) : 'nullable',
            'url_video' => $this->tipopublicacion=='Video'? 'required|string|min:3|max:200': '',
        ];
    }
    private function ruleseditarpublicacion()
    {
        $fecha_minima = is_null($this->fecha_inicio_convocatoria_edit) && $this->fecha_inicio_convocatoria_edit==''? $this->FECHA_MINIMA: $this->fecha_inicio_convocatoria_edit;
        return [
 
            'titulo_edit' => 'required|string|max:2000',
            'descripcion_edit' => 'required|string|max:2000',
            
            'imagen_edit_nuevo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf|max:23096',
            'fecha_inicio_convocatoria_edit' => $this->tipo_publicacion_edit=='Convocatoria'? 'required|date|date_format:Y-m-d|after_or_equal:'. $this->FECHA_MINIMA. '|before_or_equal:'.date('Y-m-d', strtotime('+1 year')) : 'nullable',
            'fecha_fin_convocatoria_edit' => $this->tipo_publicacion_edit=='Convocatoria'? 'required|date|date_format:Y-m-d|after_or_equal:'. $fecha_minima. '|before_or_equal:'.date('Y-m-d', strtotime('+1 year')) : 'nullable',
            'url_video_edit' => $this->tipo_publicacion_edit=='Video'? 'required|string|min:3|max:200': '',
        ];
    }
    public function updatedTipopublicacion()
    {
        $this->reset([
            'titulo', 'descripcion', 'imagen'
        ]);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear_publicacion(){
        $this->cancelar();
        $this->emit("Mostrar", "crear");
        $this->operation = 'savepublicacion';
        $this->emit("abrirmodalcrearpublicacion");
    }

    public function guardar_publicacion()
    {
        if($this->operation=='savepublicacion') {
            $this->validate();
            
            if ($this->tipopublicacion == 'Comunicados' || $this->tipopublicacion == 'Convocatoria') {
                $crear_publicacion = new Publicaciones();
                $crear_publicacion->publicaciones_titulo = $this->titulo;
                $crear_publicacion->publicaciones_descripcion = $this->descripcion;

                $nombreImagen2 = uniqid('imagen_publicacion_') . '.' . $this->imagen->getClientOriginalExtension();
                $rutaImagen2 = $this->imagen->storeAs('public/imagenes_publicacion', $nombreImagen2);

                if($this->tipopublicacion=='Convocatoria'){
                    // Redimensionar la imagen para que quepa en un marco de 700x523 píxeles 
                    Image::make(storage_path('app/' . $rutaImagen2))
                    ->fit($this->CONVOCATORIA_PX_ANCHO, $this->CONVOCATORIA_PX_ALTO) #->fit(350, 450)
                    ->save();
                } else { # Comunicado
                    Image::make(storage_path('app/' . $rutaImagen2))
                    ->fit($this->COMUNICADO_PX_ANCHO, $this->COMUNICADO_PX_ALTO) # 1027 x 575
                    ->save();
                }

                $crear_publicacion->publicaciones_imagen_url = url('/') . '/storage/imagenes_publicacion/' . $nombreImagen2;

                $crear_publicacion->publicaciones_imagen = $nombreImagen2;

                $crear_publicacion->fecha_inicio = ($this->tipopublicacion=='Convocatoria')? $this->fecha_inicio_convocatoria: null;
                $crear_publicacion->fecha_fin = ($this->tipopublicacion=='Convocatoria')? $this->fecha_inicio_convocatoria: null;

                $crear_publicacion->publicaciones_tipo = $this->tipopublicacion;
                $crear_publicacion->user_id = Auth::id();

                $crear_publicacion->save();

                $this->emit('alert','LA PUBLICACIÓN SE GUARDÓ EXITÓSAMENTE');
                $this->cancelar();
            } elseif ($this->tipopublicacion == 'Horario') {
                $crear_publicacion = new Publicaciones();
                $crear_publicacion->publicaciones_titulo = $this->titulo;
                $crear_publicacion->publicaciones_descripcion = $this->descripcion;
    
                $nombreImagen2 = uniqid('pdf_publicacion_') . '.' . $this->imagen->getClientOriginalExtension();
                $rutaImagen2 = $this->imagen->storeAs('public/imagenes_publicacion', $nombreImagen2);

                $crear_publicacion->publicaciones_imagen_url = url('/') . '/storage/imagenes_publicacion/' . $nombreImagen2;

                $crear_publicacion->publicaciones_imagen = $nombreImagen2;

                $crear_publicacion->publicaciones_tipo = $this->tipopublicacion;
                $crear_publicacion->user_id = Auth::id();

                $crear_publicacion->save();
                $this->cancelar();
                $this->emit('alert','EL HORARIO SE GUARDÓ EXITOSAMENTE');
                $this->emit('cerrarmodalcrearpublicacion');
            } else if($this->tipopublicacion == 'Video'){
                $this->emit("Mostrar", "listo fd");
                $crear_publicacion = new Publicaciones();
                $crear_publicacion->publicaciones_titulo = $this->titulo;
                $crear_publicacion->publicaciones_descripcion = $this->descripcion;
                $crear_publicacion->publicaciones_tipo = $this->tipopublicacion;
                $crear_publicacion->user_id = Auth::id();
                $crear_publicacion->publicaciones_imagen_url = $this->url_video;
                $crear_publicacion->publicaciones_imagen = "";
                $crear_publicacion->save();

                $this->cancelar();
                $this->emit('alert','LA URL DEL VIDEO SE GUARDÓ EXITOSAMENTE');
            }
        } else {
            $this->emit("vacio", "Acceso ilegal cp.");
        }
    }

    public function cancelar(){
        $this->emit("cerrarmodalcrearpublicacion");
        $this->reset(['titulo', 'descripcion', 'imagen','tipopublicacion']);
        $this->resetValidation();
    }

    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
        public function updatingSearch(){
        $this->resetPage();
    }
   
    protected $listeners = [
        'delete',
    ];

    public function delete(Publicaciones $idpublicacion):void{
        $idpublicacion->publicaciones_estado='ELIMINAR';
        $idpublicacion->save();
    }

    public $idpublicacionactual;
    public $imagen_edit_nuevo;
    public function editar_publicacion(Publicaciones $publicacion){
        if(!is_null($publicacion)){
            $this->operation = 'editpublicacion';
            $this->titulo_edit= $publicacion->publicaciones_titulo;
            $this->descripcion_edit=$publicacion->publicaciones_descripcion;
            $this->imagen_edit=$publicacion->publicaciones_imagen_url;
            $this->tipo_publicacion_edit=$publicacion->publicaciones_tipo;
            $this->idpublicacionactual=$publicacion->publicaciones_id ;
            if($this->tipo_publicacion_edit=="Convocatoria"){
                $this->fecha_inicio_convocatoria_edit = $publicacion->fecha_inicio;
                $this->fecha_fin_convocatoria_edit = $publicacion->fecha_fin;
            } else if($this->tipo_publicacion_edit=="Video"){
                $this->url_video_edit = $publicacion->publicaciones_imagen_url;
            }
            $this->emit('abrirmodaleditarpublicacion');
        } else {
            $this->emit("vacio", "No existe publicaciónn");
        }
    }

    public function guardar_editar_publicacion(){
        $publicacion_edit=Publicaciones::find( $this->idpublicacionactual);
        if(!is_null($publicacion_edit) && $this->operation=="editpublicacion"){
            $this->validate();
            $publicacion_edit->publicaciones_titulo=$this->titulo_edit;
            $publicacion_edit->publicaciones_descripcion=$this->descripcion_edit;

            if ($this->tipo_publicacion_edit=='Comunicados' || $this->tipo_publicacion_edit=='Convocatoria') {
                if ($this->imagen_edit_nuevo) {
                    Storage::delete('public/imagenes_publicacion/' . $publicacion_edit->publicaciones_imagen);
                    $nombreImagen2 = uniqid('imagen_publicacion_') . '.' . $this->imagen_edit_nuevo->getClientOriginalExtension();
                    $rutaImagen2 = $this->imagen_edit_nuevo->storeAs('public/imagenes_publicacion', $nombreImagen2);
                    if($this->tipo_publicacion_edit=='Convocatoria'){
                            // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
                        Image::make(storage_path('app/' . $rutaImagen2))
                        ->fit($this->CONVOCATORIA_PX_ANCHO, $this->CONVOCATORIA_PX_ALTO)
                        ->save();
                    } else {
                        # Comunicado
                        Image::make(storage_path('app/' . $rutaImagen2))
                        ->fit($this->COMUNICADO_PX_ANCHO, $this->COMUNICADO_PX_ALTO) # 350, 450
                        ->save();
                    }
                    $publicacion_edit->publicaciones_imagen_url = url('/') . '/storage/imagenes_publicacion/' . $nombreImagen2;
                    $publicacion_edit->publicaciones_imagen = $nombreImagen2;
                }
            } else if($this->tipo_publicacion_edit=='Video'){
                $publicacion_edit->publicaciones_imagen_url = $this->url_video_edit;
            } else { # CASO CONTRARIO ES UN HORARIO PDF
                if ($this->imagen_edit_nuevo) {
                    Storage::delete('public/imagenes_publicacion/' . $publicacion_edit->publicaciones_imagen);
                    $nombreImagen2 = uniqid('pdf_publicacion_') . '.' . $this->imagen_edit_nuevo->getClientOriginalExtension();
                    $rutaImagen2 = $this->imagen_edit_nuevo->storeAs('public/imagenes_publicacion', $nombreImagen2);
                    $publicacion_edit->publicaciones_imagen_url = url('/') . '/storage/imagenes_publicacion/' . $nombreImagen2;
                    $publicacion_edit->publicaciones_imagen = $nombreImagen2;
                }
            }

            if($this->tipo_publicacion_edit=='Convocatoria'){
                $publicacion_edit->fecha_inicio = $this->fecha_inicio_convocatoria_edit;
                $publicacion_edit->fecha_fin = $this->fecha_fin_convocatoria_edit;
            }
            $publicacion_edit->user_id = Auth::id();
            $publicacion_edit->save();

            $this->emit('alert','LA PUBLICACIÓN SE EDITÓ EXITÓSAMENTE');
            $this->cancereditar();
        } else {
            $this->emit("vacio", "No existe publicacion");
            $this->cancereditar();
        }
    }


    public function cancereditar(){
        $this->emit("cerrarmodaleditarpublicacion");
        $this->reset([
            'titulo_edit','descripcion_edit','descripcion_edit','imagen_edit','tipo_publicacion_edit','idpublicacionactual','imagen_edit_nuevo',
            'fecha_inicio_convocatoria_edit', 'fecha_fin_convocatoria_edit'
        ]);
        $this->idpublicacionactual = null;
        $this->imagen_edit_nuevo = null;
        $this->resetValidation();
    }


    public function render()
    {
        $publicaciones=Publicaciones::
            where('publicaciones_estado', '<>', 'ELIMINAR')
            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';       
                $query->orWhere('publicaciones_titulo', 'LIKE', $searchTerm);
                $query->orWhere('publicaciones_descripcion', 'LIKE', $searchTerm);
            })
            ->latest('publicaciones_id')
            ->paginate($this->PAGINATE);    
        return view('livewire.administracion-modulos.publicaciones-index',compact('publicaciones'));
    }
}
