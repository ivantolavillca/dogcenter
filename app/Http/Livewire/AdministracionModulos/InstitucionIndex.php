<?php

namespace App\Http\Livewire\AdministracionModulos;

use App\Models\AdministracionModulos\Institucion;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class InstitucionIndex extends Component
{

   use WithFileUploads;
    public $nombre;
    public $titulo;
    public $sub_titulo;
    public $mision;
    public $vision;
    public $historia;
    public $instagram;
    public $tiktok;
    public $facebook;
    public $youtube;
    public $twitter;
    public $telefono;
    public $logo;
    public $banner1;
    public $banner2;
    public $rector_nombre;
    public $rector_imagen;
    public $vicerector_nombre;
    public $vicerector_imagen;
    public $jefe_imagen;
    public $jefe_nombre;
    public $banner_uno;
    public $banner_dos;
    public $rector_imagen_agregar;
    public $vicerector_imagen_agregar;
    public $jefe_imagen_agregar;
    public $logo_imagen_agregar;

       public function rules()
    {
        return [
            'nombre' => 'required|string|max:254',
            'titulo' => 'required|string|max:254',
            'sub_titulo' => 'required|string|max:254',
            'mision' => 'required|string|max:954',
            'vision' => 'required|string|max:954',
            'historia' => 'required|string|max:954',
            'instagram' => 'nullable|max:254|regex:/^https:\/\/www\.instagram\.com\//|min:28',
            'tiktok' => 'nullable|max:254|regex:/^https:\/\/www\.tiktok\.com\/@/|min:26',
            'facebook' => 'nullable|max:254|regex:/^https:\/\/www\.facebook\.com\//|min:27',
            'youtube' => 'nullable|max:254|regex:/^https:\/\/www\.youtube\.com\/@/|min:27',
            'twitter' => 'nullable|max:254|regex:/^https:\/\/twitter\.com\//|min:22',
            'telefono' => 'required|integer|digits:8',
          
            'rector_nombre' => 'required|string|uppercase|min:10|max:254',
            'vicerector_nombre' => 'required|string|uppercase|min:10|max:254',
            'jefe_nombre' => 'required|string|uppercase|min:10|max:254',
            'banner_uno' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'banner_dos' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'rector_imagen_agregar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'vicerector_imagen_agregar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'jefe_imagen_agregar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'logo_imagen_agregar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
        ];
    }

    protected $messages = [
        'instagram.regex' => 'El campo debe deber ser una url y comenzar con "https://www.instagram.com/"',
        'tiktok.regex' => 'El campo debe ser una url y comenzar con "https://www.tiktok.com/@"',
        'facebook.regex' => 'El campo debe ser una url y comenzar con "https://www.facebook.com/"',
        'youtube.regex' => 'El campo debe ser una url y comenzar con "https://www.youtube.com/@"',
        'twitter.regex' => 'El campo debe ser una url y comenzar con "https://twitter.com/"',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    
      }

     protected $listeners = [
        'updateinstitucion',
    ];
    public function updateinstitucion(){

 $institucion = Institucion::find(1);

    if ($institucion) {
        $this->validate();
       
        $institucion->intitucion_nombre = $this->nombre;
        $institucion->intitucion_titulo = $this->titulo;
        
        
        $institucion->intitucion_subtitulo = $this->sub_titulo;
        
       
        $institucion->intitucion_mision = $this->mision;
        $institucion->intitucion_vision = $this->vision;
        $institucion->intitucion_historia = $this->historia;
        
       
        $institucion->intitucion_url_instagram = $this->instagram;
        $institucion->intitucion_url_tiktok = $this->tiktok;
        $institucion->intitucion_url_facebook = $this->facebook;
        
       
        $institucion->intitucion_url_youtube = $this->youtube;
        $institucion->intitucion_url_twitter = $this->twitter;
        $institucion->intitucion_url_telefono = $this->telefono;
        $institucion->rector_nombre = $this->rector_nombre;
        $institucion->vicerector_nombre  = $this->vicerector_nombre;
        $institucion->jefe_nombre  = $this->jefe_nombre;



        if ($this->logo_imagen_agregar) {
            // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
          // Storage::delete('public/imagenes_institucion/' . $institucion->intitucion_url_logo);
            // $this->emit('loadingImage', 'Guardando la imagen...');

            $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->logo_imagen_agregar->getClientOriginalExtension();
            $rutaImagen2 = $this->logo_imagen_agregar->storeAs('public/imagenes_institucion', $nombreImagen2);

            // Redimensionar la imagen para que quepa en un marco de 100x100 píxeles
            Image::make(storage_path('app/' . $rutaImagen2))
                ->fit(100, 100)
                ->save();

          
            $institucion->intitucion_url_logo = url('/').'/storage/imagenes_institucion/'.$nombreImagen2;
        }

        if ($this->banner_uno) {
            // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
         //  Storage::delete('public/imagenes_institucion/' . $institucion->intitucion_url_banner1);
            // $this->emit('loadingImage', 'Guardando la imagen...');

            $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->banner_uno->getClientOriginalExtension();
            $rutaImagen2 = $this->banner_uno->storeAs('public/imagenes_institucion', $nombreImagen2);

            // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
            Image::make(storage_path('app/' . $rutaImagen2))
                ->fit(1920,1500)
                ->save();

          
            $institucion->intitucion_url_banner1 = url('/').'/storage/imagenes_institucion/'.$nombreImagen2;
        }

        if ($this->banner_dos) {
            // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
        //   Storage::delete('public/imagenes_institucion/' . $institucion->intitucion_url_banner2);
            // $this->emit('loadingImage', 'Guardando la imagen...');

            $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->banner_dos->getClientOriginalExtension();
            $rutaImagen2 = $this->banner_dos->storeAs('public/imagenes_institucion', $nombreImagen2);

            // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
            Image::make(storage_path('app/' . $rutaImagen2))
                ->fit(558, 558)
                ->save();

          
            $institucion->intitucion_url_banner2 = url('/').'/storage/imagenes_institucion/'.$nombreImagen2;
        }

        if ($this->rector_imagen_agregar) {
            // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
        //   Storage::delete('public/imagenes_institucion/' . $institucion->intitucion_url_banner2);
            // $this->emit('loadingImage', 'Guardando la imagen...');

            $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->rector_imagen_agregar->getClientOriginalExtension();
            $rutaImagen2 = $this->rector_imagen_agregar->storeAs('public/imagenes_institucion', $nombreImagen2);

            // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
            Image::make(storage_path('app/' . $rutaImagen2))
                ->fit(400, 600)
                ->save();

            $institucion->intitucion_rector = url('/').'/storage/imagenes_institucion/'.$nombreImagen2;
        }
        if ($this->vicerector_imagen_agregar) {
            // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
        //   Storage::delete('public/imagenes_institucion/' . $institucion->intitucion_url_banner2);
            // $this->emit('loadingImage', 'Guardando la imagen...');

            $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->vicerector_imagen_agregar->getClientOriginalExtension();
            $rutaImagen2 = $this->vicerector_imagen_agregar->storeAs('public/imagenes_institucion', $nombreImagen2);

            // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
            Image::make(storage_path('app/' . $rutaImagen2))
                ->fit(400, 600)
                ->save();
            $institucion->intitucion_vicerector = url('/').'/storage/imagenes_institucion/'.$nombreImagen2;
        }
        if ($this->jefe_imagen_agregar) {
            // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
        //   Storage::delete('public/imagenes_institucion/' . $institucion->intitucion_url_banner2);
            // $this->emit('loadingImage', 'Guardando la imagen...');

            $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->jefe_imagen_agregar->getClientOriginalExtension();
            $rutaImagen2 = $this->jefe_imagen_agregar->storeAs('public/imagenes_institucion', $nombreImagen2);

            // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
            Image::make(storage_path('app/' . $rutaImagen2))
                ->fit(400, 600)
                ->save();
            $institucion->intitucion_jefe = url('/').'/storage/imagenes_institucion/'.$nombreImagen2;
        }
    
    

    $institucion->save();


$this->reset(['jefe_imagen_agregar','vicerector_imagen_agregar','rector_imagen_agregar','banner_dos','banner_uno','logo_imagen_agregar']);
   $this->mount();

        $this->emit('alert', 'Guardado exitosamente');

    
    }
    }

public function mount(){
    $institucion = Institucion::find(1);
    $this->nombre=$institucion->intitucion_nombre;
    $this->titulo=$institucion->intitucion_titulo;
    $this->sub_titulo=$institucion->intitucion_subtitulo;
    $this->mision=$institucion->intitucion_mision;
    $this->vision=$institucion->intitucion_vision;
    $this->historia=$institucion->intitucion_historia;
    $this->instagram=$institucion->intitucion_url_instagram;
    $this->tiktok=$institucion->intitucion_url_tiktok;
    $this->facebook=$institucion->intitucion_url_facebook;
    $this->youtube=$institucion->intitucion_url_youtube;
    $this->twitter=$institucion->intitucion_url_twitter;
    $this->telefono=$institucion->intitucion_url_telefono;
    $this->logo=$institucion->intitucion_url_logo;
    $this->banner1=$institucion->intitucion_url_banner1;
    $this->banner2=$institucion->intitucion_url_banner2;
    $this->rector_nombre=$institucion->rector_nombre;
    $this->rector_imagen=$institucion->intitucion_rector;
    $this->vicerector_nombre=$institucion->vicerector_nombre;
    $this->vicerector_imagen=$institucion->intitucion_vicerector;
    $this->jefe_imagen=$institucion->intitucion_jefe;
    $this->jefe_nombre=$institucion->jefe_nombre;

}

    
    public function render()
    {
        return view('livewire.administracion-modulos.institucion-index');
    }
}
