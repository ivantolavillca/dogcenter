<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\ContenidoPrincipal;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ContenidoPrincipalIndex extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $telefono;
    public $twitter;
    public $youtube;
    public $facebook;
    public $tiktok;
    public $instagram;
    public $vision;
    public $historia;
    public $mision;
    public $subtitulo;
    public $titulo;
    public $nombre;
    public $logo;
    public $direccion;
    public $ubicacion_maps;
    public $banner1;
    public $banner2;
    public $logo2;
    public $banner1_2;
    public $banner2_2;

    public function rules()
    {

        return [
            'nombre' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',


            'subtitulo' => 'required|string|max:255',
            'mision' => 'required|string|max:500',
            'vision' => 'required|string|max:500',
            'historia' => 'required|string|max:3999',
            'ubicacion_maps' => 'required|string|max:999',
            'direccion' => 'required|string|max:499',
            'instagram' => 'required|string|max:255',
            'tiktok' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
            'youtube' => 'required|string|max:255',
            'twitter' => 'required|string|max:255',
            'telefono' => 'required|integer|digits:8',
            'logo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'banner1_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
            'banner2_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:23096',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $institucion = ContenidoPrincipal::find(1);
        $this->nombre = $institucion->nombre;
        $this->titulo = $institucion->titulo;


        $this->subtitulo = $institucion->subtitulo;


        $this->mision = $institucion->mision;
        $this->vision = $institucion->vision;
        $this->historia = $institucion->historia;
        $this->instagram = $institucion->url_instagram;
        $this->tiktok = $institucion->url_tiktok;
        $this->facebook = $institucion->url_facebook;
        $this->youtube = $institucion->url_youtube;
        $this->twitter = $institucion->url_twitter;
        $this->telefono = $institucion->url_telefono;
        $this->logo = $institucion->url_logo;
        $this->banner1 = $institucion->img1;
        $this->banner2 = $institucion->img2;
        $this->ubicacion_maps = $institucion->ubicacion_maps;
        $this->direccion = $institucion->direccion;
    }
    public function guardarinstitucion()
    {
        $institucion = ContenidoPrincipal::find(1);

        if ($institucion) {
            $this->validate();

            $institucion->nombre = $this->nombre;
            $institucion->titulo = $this->titulo;


            $institucion->subtitulo = $this->subtitulo;


            $institucion->mision = $this->mision;
            $institucion->vision = $this->vision;
            $institucion->historia = $this->historia;


            $institucion->url_instagram = $this->instagram;
            $institucion->url_tiktok = $this->tiktok;
            $institucion->url_facebook = $this->facebook;


            $institucion->url_youtube = $this->youtube;
            $institucion->url_twitter = $this->twitter;
            $institucion->url_telefono = $this->telefono;
            $institucion->direccion = $this->direccion;
            $institucion->ubicacion_maps = $this->ubicacion_maps;


            //asdaddddddddddddddddd

            // Obtén el programa existente
            if ($this->logo2) {
                // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
                Storage::delete('public/imagenes_institucion/' . $institucion->url_logo);
                $this->emit('loadingImage', 'Guardando la imagen...');

                $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->logo2->getClientOriginalExtension();
                $rutaImagen2 = $this->logo2->storeAs('public/imagenes_institucion', $nombreImagen2);

                // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
                Image::make(storage_path('app/' . $rutaImagen2))
                    ->fit(200, 150)
                    ->save();


                $institucion->url_logo = '/storage/imagenes_institucion/' . $nombreImagen2;
            }
            if ($this->banner1_2) {
                // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
                Storage::delete('public/imagenes_institucion/' . $institucion->url_banner1);
                $this->emit('loadingImage', 'Guardando la imagen...');

                $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->banner1_2->getClientOriginalExtension();
                $rutaImagen2 = $this->banner1_2->storeAs('public/imagenes_institucion', $nombreImagen2);

                // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
                Image::make(storage_path('app/' . $rutaImagen2))
                    ->fit(1920, 1080)
                    ->save();


                $institucion->img1 = '/storage/imagenes_institucion/' . $nombreImagen2;
            }
            if ($this->banner2_2) {
                // Si el usuario decide cambiar la imagen, eliminar la imagen anterior
                Storage::delete('public/imagenes_institucion/' . $institucion->url_banner2);
                $this->emit('loadingImage', 'Guardando la imagen...');

                $nombreImagen2 = uniqid('imagen_institucion_') . '.' . $this->banner2_2->getClientOriginalExtension();
                $rutaImagen2 = $this->banner2_2->storeAs('public/imagenes_institucion', $nombreImagen2);

                // Redimensionar la imagen para que quepa en un marco de 800x600 píxeles
                Image::make(storage_path('app/' . $rutaImagen2))
                    ->fit(1920, 1080)
                    ->save();


                $institucion->img2 = '/storage/imagenes_institucion/' . $nombreImagen2;
            }



            $institucion->save();


            $this->reset(['logo2', 'banner1_2', 'banner2_2']);
            $this->mount();

            $this->emit('alert', 'Guardado exitosamente');
        }
    }
    public function render()
    {
        return view('livewire.modulos-v.contenido-principal-index');
    }
}
