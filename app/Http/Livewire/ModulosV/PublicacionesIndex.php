<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Publicaciones;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

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

    public $categorias =  ["COMUNICADOS", "EVENTOS", "PROMOCIÓN", "CAMPAÑA"];

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
        $fecha_minima = is_null($this->fecha_inicio_convocatoria) && $this->fecha_inicio_convocatoria == '' ? $this->FECHA_MINIMA : $this->fecha_inicio_convocatoria;

        return [
            'titulo' => 'required|string|max:2000',
            'descripcion' => 'required|string|max:2000',
            'tipopublicacion' => 'required',
            'imagen' =>  'required|mimes:jpeg,png,jpg,gif,svg|max:23096',
            // 'imagen' => $this->tipopublicacion !== 'Video' ? 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:23096' : '',
            // 'fecha_inicio_convocatoria' => $this->tipopublicacion == 'Convocatoria' ? 'required|date|date_format:Y-m-d|after_or_equal:' . $this->FECHA_MINIMA . '|before_or_equal:' . date('Y-m-d', strtotime('+1 year')) : 'nullable',
            // 'fecha_fin_convocatoria' => $this->tipopublicacion == 'Convocatoria' ? 'required|date|date_format:Y-m-d|after_or_equal:' . $fecha_minima . '|before_or_equal:' . date('Y-m-d', strtotime('+1 year')) : 'nullable',
            // 'url_video' => $this->tipopublicacion == 'Video' ? 'required|string|min:3|max:200' : '',
        ];
    }
    private function ruleseditarpublicacion()
    {
        $fecha_minima = is_null($this->fecha_inicio_convocatoria_edit) && $this->fecha_inicio_convocatoria_edit == '' ? $this->FECHA_MINIMA : $this->fecha_inicio_convocatoria_edit;
        return [

            'titulo' => 'required|string|max:2000',
            'descripcion' => 'required|string|max:2000',
            'tipopublicacion' => 'required',
            'imagen' =>  'nullable|mimes:jpeg,png,jpg,gif,svg|max:23096',
            // 'titulo_edit' => 'required|string|max:2000',
            // 'descripcion_edit' => 'required|string|max:2000',

            // 'imagen_edit_nuevo' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf|max:23096',
            // 'fecha_inicio_convocatoria_edit' => $this->tipo_publicacion_edit == 'Convocatoria' ? 'required|date|date_format:Y-m-d|after_or_equal:' . $this->FECHA_MINIMA . '|before_or_equal:' . date('Y-m-d', strtotime('+1 year')) : 'nullable',
            // 'fecha_fin_convocatoria_edit' => $this->tipo_publicacion_edit == 'Convocatoria' ? 'required|date|date_format:Y-m-d|after_or_equal:' . $fecha_minima . '|before_or_equal:' . date('Y-m-d', strtotime('+1 year')) : 'nullable',
            // 'url_video_edit' => $this->tipo_publicacion_edit == 'Video' ? 'required|string|min:3|max:200' : '',
        ];
    }
    // public function updatedTipopublicacion()
    // {
    //     $this->reset([
    //         'titulo',
    //         'descripcion',
    //         'imagen'
    //     ]);
    // }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear_publicacion()
    {
        $this->cancelar();
        $this->emit("Mostrar", "crear");
        $this->operation = 'savepublicacion';
        $this->emit("abrirmodalcrearpublicacion");
    }

    public function guardar_publicacion()
    {
        if ($this->operation == 'savepublicacion') {
            $this->validate();

            if ($this->tipopublicacion == 'COMUNICADOS' || $this->tipopublicacion == 'EVENTOS' || $this->tipopublicacion == 'PROMOCIÓN' || $this->tipopublicacion == 'CAMPAÑA') {
                $crear_publicacion = new Publicaciones();
                $crear_publicacion->titulo = $this->titulo;
                $crear_publicacion->descripcion = $this->descripcion;
                $crear_publicacion->tipo = $this->tipopublicacion;
                $nombreImagen2 = uniqid('imagen_publicacion_') . '.' . $this->imagen->getClientOriginalExtension();
                $rutaImagen2 = $this->imagen->storeAs('public/imagenes_publicacion', $nombreImagen2);

                if ($this->tipopublicacion != '') {
                    // Redimensionar la imagen para que quepa en un marco de 700x523 píxeles 
                    Image::make(storage_path('app/' . $rutaImagen2))
                        ->fit($this->CONVOCATORIA_PX_ANCHO, $this->CONVOCATORIA_PX_ALTO) #->fit(350, 450)
                        ->save();
                }

                $crear_publicacion->imagen =  '/storage/imagenes_publicacion/' . $nombreImagen2;

                // $crear_publicacion->publicaciones_imagen = $nombreImagen2;

                // $crear_publicacion->fecha_inicio = ($this->tipopublicacion=='Convocatoria')? $this->fecha_inicio_convocatoria: null;
                // $crear_publicacion->fecha_fin = ($this->tipopublicacion=='Convocatoria')? $this->fecha_inicio_convocatoria: null;

                // $crear_publicacion->publicaciones_tipo = $this->tipopublicacion;
                // $crear_publicacion->user_id = Auth::id();

                $crear_publicacion->save();

                $this->emit('alert', 'LA PUBLICACIÓN SE GUARDÓ EXITÓSAMENTE');
                $this->cancelar();
            }
        } else {
            $this->emit("vacio", "Acceso ilegal cp.");
        }
    }

    public function cancelar()
    {
        $this->emit("cerrarmodalcrearpublicacion");
        $this->reset(['titulo', 'descripcion', 'imagen', 'tipopublicacion', 'idpublicacionactual']);
        $this->resetValidation();
    }

    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'delete',
    ];

    public function delete(Publicaciones $idpublicacion): void
    {
        $idpublicacion->estado = 'eliminar';
        $idpublicacion->save();
    }

    public $idpublicacionactual;
    public $imagen_edit_nuevo;
    public function editar_publicacion(Publicaciones $publicacion)
    {
        if (!is_null($publicacion)) {
            $this->operation = 'editpublicacion';
            $this->titulo = $publicacion->titulo;
            $this->descripcion = $publicacion->descripcion;
            // $this->imagen_edit = $publicacion->publicaciones_imagen_url;
            $this->tipopublicacion = $publicacion->tipo;
            $this->idpublicacionactual = $publicacion->id;

            $this->emit('abrirmodalcrearpublicacion');
        } else {
            $this->emit("vacio", "No existe publicaciónn");
        }
    }

    public function guardar_editar_publicacion()
    {
        $publicacion_edit = Publicaciones::find($this->idpublicacionactual);
        if (!is_null($publicacion_edit) && $this->operation == "editpublicacion") {
            $this->validate();
            $publicacion_edit->titulo = $this->titulo;
            $publicacion_edit->descripcion = $this->descripcion;
            $publicacion_edit->tipo = $this->tipopublicacion;

            if ($this->tipopublicacion != '') {
                if ($this->imagen) {
                    Storage::delete('public/imagenes_publicacion/' . $publicacion_edit->imagen);
                    $nombreImagen2 = uniqid('imagen_publicacion_') . '.' . $this->imagen->getClientOriginalExtension();
                    $rutaImagen2 = $this->imagen->storeAs('public/imagenes_publicacion', $nombreImagen2);
                    if ($this->tipopublicacion != '') {
                        // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
                        Image::make(storage_path('app/' . $rutaImagen2))
                            ->fit($this->CONVOCATORIA_PX_ANCHO, $this->CONVOCATORIA_PX_ALTO)
                            ->save();
                    }
                    $publicacion_edit->imagen =  '/storage/imagenes_publicacion/' . $nombreImagen2;
                }
            }


            // $publicacion_edit->user_id = Auth::id();
            $publicacion_edit->save();

            $this->emit('alert', 'LA PUBLICACIÓN SE EDITÓ EXITÓSAMENTE');
            $this->cancelar();
        } else {
            $this->emit("vacio", "No existe publicacion");
            $this->cancelar();
        }
    }


    public function cancereditar()
    {
        $this->emit("cerrarmodaleditarpublicacion");
        $this->reset([
            'titulo_edit',
            'descripcion_edit',
            'descripcion_edit',
            'imagen_edit',
            'tipo_publicacion_edit',
            'idpublicacionactual',
            'imagen_edit_nuevo',
            'fecha_inicio_convocatoria_edit',
            'fecha_fin_convocatoria_edit'
        ]);
        $this->idpublicacionactual = null;
        $this->imagen_edit_nuevo = null;
        $this->resetValidation();
    }

    public function render()
    {
        $publicaciones = Publicaciones::where('estado', '<>', 'eliminar')
            ->where(function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->orWhere('titulo', 'LIKE', $searchTerm);
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->latest('id')
            ->paginate($this->PAGINATE);
        return view('livewire.modulos-v.publicaciones-index', compact('publicaciones'));
    }
}
