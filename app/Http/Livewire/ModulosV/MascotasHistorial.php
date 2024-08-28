<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\CirugiasDatos;
use App\Models\Modulos\CirugiasPre;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\ComentariosTratamiento;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\EstudiosComplementarios;
use App\Models\Modulos\FotosEstudio;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\MedicamentosTratamiento;
use App\Models\Modulos\TipoHistorial;
use App\Models\Modulos\Tratamiento_historial_clinico;
use App\Models\Modulos\TratamientosHistorial;
use App\Models\Modulos\Vacunas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\PdfToImage\Pdf;
use Illuminate\Database\Query\Builder;


class MascotasHistorial extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;
    public $mascota, $operation, $SeleccionTipoDeArchivo, $ArchivoDelEstudioPdf, $ArchivoDelEstudioImagen;
    protected $listeners = [
        'resultadoReconocimiento',  'resultadoReconocimientoAnamensis',
        'resultadoReconocimientoMotivoConsulta', 'eliminarhistorial', 'eliminar_historial',
        'eliminar_tratamiento_internacion', 'imagenCapturada', 'eliminarimg', 'eliminar_tratamiento', 'borrartratamientodato', 'borrartratamientocuerpo'
    ];
    public $imagenrescatada;

    public function eliminarhistorial($id)
    {
        $historial = Historias_clinico::find($id);
        if ($historial) {
            $historial->estado = 'eliminado';
            $historial->save();
        }
    }
    public function eliminarimg(FotosEstudio $img)
    {
        $img->estado = 'eliminado';
        $img->update();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function rules()
    {
        if ($this->operation === 'crearestudiocomplementariorulepdf') {
            return $this->rulesestudiocomplementariocreatepdf();
        } elseif ($this->operation === 'crearestudiocomplementarioruleimagen') {
            return $this->rulesestudiocomplementariocreateimg();
        } elseif ($this->operation === 'guadareutanacia') {
            return $this->rulesguardareutanacia();
        } elseif ($this->operation === 'guardarhistorialclinico') {
            return $this->rulesguardarhistorialclinico();
        } elseif ($this->operation === 'guardarinternacion') {
            return $this->rulesguardarinternacion();
        } elseif ($this->operation === 'guardareditarhistorialclinico') {
            return $this->ruleseditarhistorialclinico();
        } elseif ($this->operation === 'guardareditarfichaclinica') {
            return $this->ruleseditfichaclinica();
        } elseif ($this->operation === 'crearestudiocomplementarioruleimagensubida') {
            return $this->rulesguardarestudioconcaptura();
        } elseif ($this->operation === 'guardartratamiento') {
            return $this->rulesguardartratamiento();
        } elseif ($this->operation === 'guardartratamientointernacion') {
            return $this->rulesguardartratamientointernacion();
        } elseif ($this->operation === 'crearfichaclinicarulepdf') {
            return $this->rulescrearfichaclinica();
        } elseif ($this->operation === 'crearfichaclinicaruleimagensubida') {
            return $this->rulescrearfichaclinicasubidaimagen();
        } elseif ($this->operation === 'guardareditarestudiocomplementario') {
            return $this->ruleseditarestudiocomplementario();
        } elseif ($this->operation === 'validarcomentario') {
            return $this->rulesvalidarcomentario();
        } elseif ($this->operation === 'validarcostotratamiento') {
            return $this->rulesgcostotratamiento();
        }
        elseif ($this->operation === 'validareditarestudiopdf') {
            return $this->rulesValidarEditarEstudiopdf();
        }
        elseif ($this->operation === 'validareditarestudioimagen') {
            return $this->rulesValidarEditarEstudioimagen();
        }
        elseif ($this->operation === 'validareditarestudiocamara') {
            return $this->rulesValidarEditarEstudiocaptura();
        }
        elseif ($this->operation === 'validareditarestudiovacio') {
            return $this->rulesValidarEditarEstudiovacio();
        }


        return array_merge($this->rulesValidarEditarEstudiovacio(),$this->rulesValidarEditarEstudiocaptura(),$this->rulesValidarEditarEstudioimagen(),$this->rulesValidarEditarEstudiopdf(),$this->rulesgcostotratamiento(), $this->rulesvalidarcomentario(), $this->ruleseditarestudiocomplementario(), $this->rulescrearfichaclinicasubidaimagen(), $this->rulescrearfichaclinica(), $this->rulesguardartratamientointernacion(), $this->rulesguardartratamiento(), $this->rulesguardarestudioconcaptura(), $this->ruleseditfichaclinica(), $this->ruleseditinternacion(), $this->ruleseditestudiocomplemtario(), $this->ruleseditarhistorialclinico(), $this->rulesestudiocomplementariocreatepdf(), $this->rulesestudiocomplementariocreateimg(), $this->rulesguardareutanacia(), $this->rulesguardarhistorialclinico(), $this->rulesguardarinternacion());
    }
    public function rulesValidarEditarEstudiopdf(){
        return [
            'SeleccionTipoDeArchivo' => 'required',
            'TipoDeEstudioComplementario' => 'required',
            'ArchivoDelEstudio' => 'required',
           'Precio' => 'nullable|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];
        
    }
    public function rulesValidarEditarEstudioimagen(){
        return [
            'SeleccionTipoDeArchivo' => 'required',
            'TipoDeEstudioComplementario' => 'required',
            'ArchivoDelEstudioImagenColeccion' => 'required',
           'Precio' => 'nullable|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];
         
    }
    public function rulesValidarEditarEstudiocaptura(){
        return [
            'SeleccionTipoDeArchivo' => 'required',
            'TipoDeEstudioComplementario' => 'required',
            'rutaImagenfinal' => 'required',
           'Precio' => 'nullable|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ]; 
    }
    public function rulesValidarEditarEstudiovacio(){
        return [
            'SeleccionTipoDeArchivo' => 'nullable',
            'TipoDeEstudioComplementario' => 'required',
            
           'Precio' => 'nullable|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ]; 
    }
    private function rulesgcostotratamiento()
    {
        return [

            'CostoTratamiento' => 'required|numeric|between:0,999999.99',

        ];
    }
    private function rulesvalidarcomentario()
    {

        return [
            'DescripcionTratamiento' => 'required|string|max:3998',

        ];
    }
    private function rulesestudiocomplementariocreatepdf()
    {

        return [
            'TipoDeEstudioComplementario' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'ArchivoDelEstudio' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function ruleseditarestudiocomplementario()
    {

        return [
            'TipoDeEstudioComplementario' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',

        ];
    }

    private function rulescrearfichaclinica()
    {

        return [

            'SeleccionTipoDeArchivo' => 'required',
            'ArchivoDelEstudio' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',

        ];
    }
    private function rulescrearfichaclinicasubidaimagen()
    {

        return [

            'SeleccionTipoDeArchivo' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',

        ];
    }

    private function rulesguardartratamientointernacion()
    {

        return [
            'encargado' => 'required',
            'fecha' => 'required|date',
            'tratamiento' => 'required|string|max:4999',
            'observaciones' => 'required|string|max:4999',

        ];
    }
    private function rulesguardartratamiento()
    {
        return [

            'Medicamento' => 'required|string|max:99',
            'DosisEnMg' => 'nullable|string|max:10',
            'DosisEnMl' => 'nullable|string|max:10',
            'Via' => 'required',
            'Administrado' => 'required',


        ];
    }
    private function rulesguardarestudioconcaptura()
    {

        return [
            'SeleccionTipoDeArchivo' => 'required',
            'rutaImagenfinal' => 'required',
            'TipoDeEstudioComplementario' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function ruleseditestudiocomplemtario()
    {
        return [
            'TipoDeEstudioComplementario' => 'required',

            'ArchivoDelEstudioPdf' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function ruleseditinternacion()
    {
        return [
            'PesoIntenacion' => 'required|integer|max:9999',
            'FechaIngresoInternacion' => 'required|date',
            'Precio' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function ruleseditfichaclinica()
    {
        return [
            'ArchivoFichaClinicaCirugia' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',

        ];
    }
    private function ruleseditarhistorialclinico()
    {
        return [
            'NroDeHistorialDeMascota' => 'required|string|max:999999999',
            'AnamensisDeMascota' => 'required|string|max:4900',
            'TllcMascota' => 'required|string|max:4900',
            'MmDeMascota' => 'required|string|max:54',
            'ConstanteVitalFcDeMascota' => 'required|string|max:54',
            'ConstanteVitalFrDeMascota' => 'required|string|max:54',
            'ConstanteVitalTemperaturaDeMascota' => 'required|string|max:54',
            'ActitudDeMascotaOtraOpcion' => 'required|string|max:54',
            'OtraOpcionConductaDeMascota' => 'required|string|max:54',
            'EstadoNutricionalDeMascotaOtraOpcion' => 'required|string|max:54',
            'OtraCapaDePielDeMascota' => 'required|string|max:54',
            'Precio' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function rulesguardarhistorialclinico()
    {
        $rules = [
            'MotivoDeAtencion' => 'nullable|string|max:4900',
            'AnamensisDeMascota' => 'nullable|string|max:4900',
            'Precio' => 'nullable|numeric|between:0,999999.99',
            'TllcMascota' => 'nullable|string|max:4900',
            'MmDeMascota' => 'nullable|string|max:54',
            'Past' => 'nullable|string|max:54',
            'Pad' => 'nullable|string|max:54',
            'Pam' => 'nullable|string|max:54',
            'PulsoDeLaMascota' => 'nullable|string|max:54',
            'Dht' => 'nullable|string|max:54',
            'Peso' => 'nullable|string|max:54',
            'ConstanteVitalFcDeMascota' => 'nullable|string|max:54',
            'ConstanteVitalFrDeMascota' => 'nullable|string|max:54',
            'ConstanteVitalTemperaturaDeMascota' => 'nullable|string|max:54',
            'ConstanteVitalTemperaturaDeMascota' => 'nullable|string|max:54',
           
            'Precio' => 'nullable|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];


        if ($this->ActitudDeMascota == 'otros') {
            $rules['ActitudDeMascotaOtraOpcion'] = 'nullable';
        } elseif ($this->ActitudDeMascota != 'otros') {
            $rules['ActitudDeMascota'] = 'nullable';
        }

        if ($this->ConductaDeMascota == 'otros') {
            $rules['OtraOpcionConductaDeMascota'] = 'nullable';
        } elseif ($this->ConductaDeMascota != 'otros') {
            $rules['ConductaDeMascota'] = 'nullable';
        }
        if ($this->EstadoNutricionalDeMascota == 'otros') {
            $rules['EstadoNutricionalDeMascotaOtraOpcion'] = 'nullable';
        } elseif ($this->EstadoNutricionalDeMascota != 'otros') {
            $rules['EstadoNutricionalDeMascota'] = 'nullable';
        }
        if ($this->CapaDePielDeMascota == 'otros') {
            $rules['OtraCapaDePielDeMascota'] = 'nullable';
        } elseif ($this->CapaDePielDeMascota != 'otros') {
            $rules['CapaDePielDeMascota'] = 'nullable';
        }

        return $rules;
    }
    private function rulesguardarinternacion()
    {
        return [

            'PesoIntenacion' => 'required|numeric|between:0,999',
            'FechaIngresoInternacion' => 'required|date',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',

        ];
    }
    private function rulesguardareutanacia()
    {
        return [


            'FechaDeEutanacia' => 'required',
            'RazonDeEutanacia' => 'required|string|max:255',
            'SeleccionTipoDeArchivo' => 'required',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',

        ];
    }
    private function rulesestudiocomplementariocreateimg()
    {
        return [
            'TipoDeEstudioComplementario' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'ArchivoDelEstudioImagen' => 'required',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',


        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount($mascota)
    {
        $this->mascota = $mascota;
    }



    public function actualizarTexto($texto)
    {
        $this->AnamensisDeMascota = $texto;
    }

    public $tipo_historial, $ActitudDeMascota, $ActitudDeMascotaOtraOpcion, $TllcMascota, $ConductaDeMascota, $OtraOpcionConductaDeMascota, $EstadoNutricionalDeMascota, $EstadoNutricionalDeMascotaOtraOpcion, $MmDeMascota, $ConstanteVitalFcDeMascota, $ConstanteVitalFrDeMascota, $ConstanteVitalTemperaturaDeMascota, $CapaDePielDeMascota, $NroDeHistorialDeMascota, $AnamensisDeMascota, $Precio;
    public function crearhistorial()
    {
        $this->tipo_historial = "historial_clinico";
        $mascota = Mascotas::find($this->mascota);
        $persona = Clientes::find($mascota->cliente_id);
        $this->NroDeHistorialDeMascota = 'DGC-' . $persona->ci;
        $this->emit('crearhistorial');
    }
    public function crearestudiocomplementario()
    {
        $this->tipo_historial = "estudio_complementario";
        $this->emit('crearhistorial');
    }
    public function crearinternacion()
    {
        $this->tipo_historial = "internacion";
        $this->emit('crearhistorial');
    }
    public function creareutanacia()
    {
        $this->tipo_historial = "eutanacia";
        $this->emit('crearhistorial');
    }
    public function crearfichaclinica()
    {
        $this->tipo_historial = "ficha_clinica";
        $this->emit('crearhistorial');
    }
    public function crearrecomendacionesoperatorias()
    {
        $this->tipo_historial = "recomendaciones_operatorias";
        $this->emit('crearhistorial');
    }
    public function crearconcentimientoinformado()
    {
        $this->tipo_historial = "concentimiento_informado";
        $this->emit('crearhistorial');
    }
    public function crearautorizaciondesedacion()
    {
        $this->tipo_historial = "autorizacion_de_sedacion";
        $this->emit('crearhistorial');
    }
    // public function crearderivacion()
    // {
    //     $this->tipo_historial = "derivacion";
    //     $this->emit('crearhistorial');
    // }


    public function UpdatedActitudDeMascota()
    {
        $this->reset(['ActitudDeMascotaOtraOpcion']);
    }

    public $TipoDeEstudioComplementario, $OtraCapaDePielDeMascota, $ArchivoDelEstudio, $SubirFichaClinica = false, $SubirRecomendacionesOperatorias = false, $ArchivoFichaClinicaCirugia, $ArchivoRecomentacionesOperatorias, $PesoIntenacion, $FechaIngresoInternacion;
    public $FechaDeEutanacia, $RazonDeEutanacia, $SubirConcentimientoInformado = false, $ArchivoConcentimientoInformado, $SubirAutorizacionDeSedacion = false, $ArchivoAutorizacionDeSedacion;

    public function guardarhistorial()
    {
        $mascota_actual = Mascotas::find($this->mascota);
        $cliente_actual = Clientes::find($mascota_actual->cliente_id);
        if ($this->tipo_historial == "historial_clinico") {
        } elseif ($this->tipo_historial == "estudio_complementario") {
        } elseif ($this->tipo_historial == "internacion") {
        } elseif ($this->tipo_historial == "eutanacia") {
            $this->operation = "guadareutanacia";
            $this->validate();
            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 9,
                'informe_de_eutanacia' => $this->RazonDeEutanacia,
                'fecha_de_eutanacia' => $this->FechaDeEutanacia,

            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'eutanacia guardado con exito');
        } elseif ($this->tipo_historial == "derivacion") {
            $this->operation = "guadarderivacion";
            // $this->validate();
            $this->emit('alert', 'derivacion guardado con exito');
        } elseif ($this->tipo_historial == "estudio_complementario") {
        }
    }

    #GUARDAR ESTUDIO COMPLEMENTARIO
    public function GuardarEstudioComplementario()
    {
        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearestudiocomplementariorulepdf";
            $this->validate();

            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_estudio_complementario') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/estudio_complementario', $nombreArchivo);
            $usuario = Auth::user();

            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 2,
                'estudio_complementario_id' => $this->TipoDeEstudioComplementario,

                'imagen_pdf_estudio_complementario' => '/storage/estudio_complementario/' . $nombreArchivo,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearestudiocomplementarioruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {

                $usuario = Auth::user();

                Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 2,
                    'estudio_complementario_id' => $this->TipoDeEstudioComplementario,
                    'imagen_pdf_estudio_complementario' => $this->rutaImagenfinal,

                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,


                ]);

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'estudio complementario guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }

    public function GuardarEditarEstudioComplementario()
    {


        $historial_actual = Historias_clinico::find($this->historial_id_selected);



        if ($this->SeleccionTipoDeArchivo == 'pdf') {

            $this->operation = 'validareditarestudiopdf';
            $this->validate();

            if ($this->ArchivoDelEstudio) {
                $archivo = $this->ArchivoDelEstudio;
                $nombreArchivo = uniqid('archivo_estudio_complementario') . '.' . $archivo->getClientOriginalExtension();

                // Guardar el archivo en el almacenamiento
                $rutaArchivo = $archivo->storeAs('public/estudio_complementario', $nombreArchivo);
            }
            $historial_actual->estudio_complementario_id = $this->TipoDeEstudioComplementario;
            $historial_actual->user_id = Auth::user()->id;
            $historial_actual->precio = $this->Precio;
            # $historial_actual->imagen_pdf_estudio_complementario =  '/storage/estudio_complementario/' . $nombreArchivo;
            $historial_actual->update();
            $fotoss = FotosEstudio::where('historial_id', $historial_actual->id)->first();
            $fotoss->imagen = '/storage/estudio_complementario/' . $nombreArchivo;
            $fotoss->update();
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'imagen') {

            $this->operation = 'validareditarestudioimagen';
            $this->validate();
            $historial_actual->estudio_complementario_id = $this->TipoDeEstudioComplementario;
            $historial_actual->user_id = Auth::user()->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->update();
            foreach ($this->ArchivoDelEstudioImagenColeccion as $key => $imagenc) {
                $archivo = $imagenc;
                $nombreArchivo = uniqid('archivo_estudio_complementario') . '.' . $archivo->getClientOriginalExtension();

                // Guardar el archivo en el almacenamiento
                $rutaArchivo = $archivo->storeAs('public/estudio_complementario', $nombreArchivo);

                FotosEstudio::create([
                    'historial_id' => $historial_actual->id,
                    'imagen' => '/storage/estudio_complementario/' . $nombreArchivo,
                    'user_id' => Auth::user()->id,
                ]);
            }
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = 'validareditarestudiocamara';
            $this->validate();
            $historial_actual->estudio_complementario_id = $this->TipoDeEstudioComplementario;
            $historial_actual->user_id = Auth::user()->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->update();
            FotosEstudio::create([
                'historial_id' => $historial_actual->id,
                'imagen' => $this->rutaImagenfinal,
                'user_id' => Auth::user()->id,
            ]);
            $this->a = false;
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->operation = 'validareditarestudiovacio';
            $this->validate();
            $usuario = Auth::user();
            $historial_actual->estudio_complementario_id = $this->TipoDeEstudioComplementario;
            $historial_actual->user_id = $usuario->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->update();
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        }
    }
    public function guardarhistorialclinicofichaclinica()
    {

        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();

            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_ficha_clinica') . '.' . $archivo->getClientOriginalExtension();
            $usuario = Auth::user();
            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/ficha_clinica', $nombreArchivo);
            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 4,
                'precio' => $this->Precio,
                'user_id' => $usuario->id,

                'imagen_pdf_ficha_clinica_cirugia' =>  '/storage/ficha_clinica/' . $nombreArchivo,


            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {

                $usuario = Auth::user();
                Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 4,

                    'imagen_pdf_ficha_clinica_cirugia' => $this->rutaImagenfinal,
                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,



                ]);

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'estudio complementario guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardareditarhistorialclinicofichaclinica()
    {

        $historial_actual = Historias_clinico::find($this->historial_id_selected);
        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();
            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_ficha_clinica') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/ficha_clinica', $nombreArchivo);
            $historial_actual->imagen_pdf_ficha_clinica_cirugia =  '/storage/ficha_clinica/' . $nombreArchivo;

            $historial_actual->user_id = $usuario->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->update();
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();
                $historial_actual->user_id = $usuario->id;
                $historial_actual->precio = $this->Precio;
                $historial_actual->imagen_pdf_ficha_clinica_cirugia = $this->rutaImagenfinal;
                $historial_actual->update();

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'estudio complementario guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardarrecomendacionesoperatorias()
    {

        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();

            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_recomendaciones_operatorias') . '.' . $archivo->getClientOriginalExtension();
            $usuario = Auth::user();
            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/recomendaciones_operatorias', $nombreArchivo);
            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 5,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
                'imagen_pdf_recomendaciones_operatorias' =>  '/storage/recomendaciones_operatorias/' . $nombreArchivo,


            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();

                Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 5,
                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,
                    'imagen_pdf_recomendaciones_operatorias' => $this->rutaImagenfinal,




                ]);

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'estudio complementario guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardareditarrecomendacionesoperatorias()
    {
        $historial_actual = Historias_clinico::find($this->historial_id_selected);

        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();

            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_recomendaciones_operatorias') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/recomendaciones_operatorias', $nombreArchivo);
            $historial_actual->user_id = $usuario->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->imagen_pdf_recomendaciones_operatorias = '/storage/recomendaciones_operatorias/' . $nombreArchivo;
            $historial_actual->update();


            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();
                $historial_actual->user_id = $usuario->id;
                $historial_actual->precio = $this->Precio;
                $historial_actual->imagen_pdf_recomendaciones_operatorias = $this->rutaImagenfinal;
                $historial_actual->update();

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'estudio complementario guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardarconcentimientoinformado()
    {

        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();
            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_concentimiento_informado') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/concentimiento_informado', $nombreArchivo);
            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 6,
                'precio' => $this->Precio,
                'user_id' => $usuario->id,

                'imagen_pdf_concentimiento_infomado' =>  '/storage/concentimiento_informado/' . $nombreArchivo,


            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'concentimiento informado guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();

                Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 6,
                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,
                    'imagen_pdf_concentimiento_infomado' => $this->rutaImagenfinal,




                ]);

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'concentimiento informado guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardareditarconcentimientoinformado()
    {
        $historial_actual = Historias_clinico::find($this->historial_id_selected);
        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();
            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_concentimiento_informado') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/concentimiento_informado', $nombreArchivo);
            $historial_actual->user_id = $usuario->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->imagen_pdf_concentimiento_infomado =  '/storage/concentimiento_informado/' . $nombreArchivo;
            $historial_actual->update();

            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'concentimiento informado guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();
                $historial_actual->imagen_pdf_concentimiento_infomado = $this->rutaImagenfinal;
                $historial_actual->user_id = $usuario->id;
                $historial_actual->precio = $this->Precio;
                $historial_actual->update();



                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'concentimiento informado guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }

    public function guardarhistorialclinicoeutanacia()
    {
        $this->operation = "guadareutanacia";
        $this->validate();

        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();
            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_concentimiento_informado') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/concentimiento_informado', $nombreArchivo);
            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 6,
                'precio' => $this->Precio,
                'user_id' => $usuario->id,
                'fecha_de_eutanacia' => $this->FechaDeEutanacia,
                'informe_de_eutanacia' => $this->RazonDeEutanacia,
                'imagen_eutanacia' =>  '/storage/concentimiento_informado/' . $nombreArchivo,


            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'eutanacia guardada con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();

                Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 9,
                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,
                    'fecha_de_eutanacia' => $this->FechaDeEutanacia,
                    'informe_de_eutanacia' => $this->RazonDeEutanacia,
                    'imagen_eutanacia' => $this->rutaImagenfinal,




                ]);

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'eutanacia guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardarautorizaciondesedacion()
    {

        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();
            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_autorizacion_sedacion') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/autorizacion_de_sedacion', $nombreArchivo);
            Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 7,
                'precio' => $this->Precio,
                'user_id' => $usuario->id,

                'imagen_pdf_autorizacion_de_sedacion' =>  '/storage/autorizacion_de_sedacion/' . $nombreArchivo,


            ]);
            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'autorización de sedación guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {

                $usuario = Auth::user();
                Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 7,
                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,
                    'imagen_pdf_autorizacion_de_sedacion' => $this->rutaImagenfinal,




                ]);

                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'autorización de sedación guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function guardareditarautorizaciondesedacion()
    {
        $historial_actual = Historias_clinico::find($this->historial_id_selected);
        if ($this->SeleccionTipoDeArchivo == 'pdf' or $this->SeleccionTipoDeArchivo == 'imagen') {
            $this->operation = "crearfichaclinicarulepdf";
            $this->validate();
            $usuario = Auth::user();
            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_autorizacion_sedacion') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/autorizacion_de_sedacion', $nombreArchivo);
            $historial_actual->user_id = $usuario->id;
            $historial_actual->precio = $this->Precio;
            $historial_actual->imagen_pdf_autorizacion_de_sedacion =  '/storage/autorizacion_de_sedacion/' . $nombreArchivo;
            $historial_actual->update();

            $this->limpiarmodalhistorial();
            $this->emit('crearmodalcrearhistorial');
            $this->emit('alert', 'autorización de sedación guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearfichaclinicaruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {
                $usuario = Auth::user();
                $historial_actual->user_id = $usuario->id;
                $historial_actual->precio = $this->Precio;
                $historial_actual->imagen_pdf_autorizacion_de_sedacion = $this->rutaImagenfinal;
                $historial_actual->update();


                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('crearmodalcrearhistorial');
                $this->emit('alert', 'autorización de sedación guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function GuardarEditarInternacion()
    {

        $this->operation = "guardarinternacion";
        $this->validate();
        $usuario = Auth::user();
        $historial_actual = Historias_clinico::find($this->historial_id_selected);
        $historial_actual->peso_internacion = $this->PesoIntenacion;
        $historial_actual->user_id = $usuario->id;
        $historial_actual->precio = $this->Precio;
        $historial_actual->fecha_ingreso_internacion = $this->FechaIngresoInternacion;
        $historial_actual->update();


        $this->limpiarmodalhistorial();
        $this->emit('crearmodalcrearhistorial');
        $this->emit('alert', 'intentación guardado con exito');
    }
    public function GuardarInternacion()
    {
        $this->operation = "guardarinternacion";
        $this->validate();
        $usuario = Auth::user();
        Historias_clinico::create([
            'mascota_id' => $this->mascota,
            'tipo_historial_id' => 3,
            'peso_internacion' => $this->PesoIntenacion,
            'fecha_ingreso_internacion' => $this->FechaIngresoInternacion,
            'precio' => $this->Precio,
            'user_id' => $usuario->id,

        ]);

        $this->limpiarmodalhistorial();
        $this->emit('crearmodalcrearhistorial');
        $this->emit('alert', 'intentación guardado con exito');
    }
    public function guardarhistorialclinico()
    {
        $this->operation = "guardarhistorialclinico";
        $this->validate();

        $actitud = '';
        if ($this->ActitudDeMascota == 'otros') {
            $actitud = $this->ActitudDeMascotaOtraOpcion;
        } elseif ($this->ActitudDeMascota != 'otros') {
            $actitud = $this->ActitudDeMascota;
        }
        $conducta = '';
        if ($this->ConductaDeMascota == 'otros') {
            $conducta = $this->OtraOpcionConductaDeMascota;
        } elseif ($this->ConductaDeMascota != 'otros') {
            $conducta = $this->ConductaDeMascota;
        }
        $estadonutricional = '';
        if ($this->EstadoNutricionalDeMascota == 'otros') {
            $estadonutricional = $this->EstadoNutricionalDeMascotaOtraOpcion;
        } elseif ($this->EstadoNutricionalDeMascota != 'otros') {
            $estadonutricional = $this->EstadoNutricionalDeMascota;
        }
        $capadepiel = '';
        if ($this->CapaDePielDeMascota == 'otros') {
            $capadepiel = $this->OtraCapaDePielDeMascota;
        } elseif ($this->CapaDePielDeMascota != 'otros') {
            $capadepiel = $this->CapaDePielDeMascota;
        }

        $usuario = Auth::user();
        $crearhistorial = Historias_clinico::create([
            'nro_historial_clinico' => $this->NroDeHistorialDeMascota,
            'mascota_id' => $this->mascota,
            'tipo_historial_id' => 1,
            'anamensis' => $this->AnamensisDeMascota,
            'precio' => $this->Precio,
            'user_id' => $usuario->id,

            'actitud' => $actitud,
            'tllc' => $this->TllcMascota,
            'conducta' => $conducta,
            'esta_nutricional' => $estadonutricional,
            'mm' => $this->MmDeMascota,
            'const_v_fc' => $this->ConstanteVitalFcDeMascota,
            'const_v_fr' => $this->ConstanteVitalFrDeMascota,
            'const_v_t' => $this->ConstanteVitalTemperaturaDeMascota,
            'capa_piel' => $capadepiel,


        ]);
        $this->crear_tratamiento($crearhistorial->id);
        $this->limpiarmodalhistorial();
        $this->emit('crearmodalcrearhistorial');

        $this->emit('alert', 'historial clinico guardado con exito');
    }
    public function limpiarmodalhistorial()
    {
        $this->reset([
            'historial_id_selected', 'MotivoDeAtencion', 'Past', 'Pad', 'Pam', 'PulsoDeLaMascota', 'Dht', 'Peso',
            'TipoDeEstudioComplementario', 'OtraCapaDePielDeMascota', 'ArchivoDelEstudio', 'SubirFichaClinica', 'SubirRecomendacionesOperatorias', 'ArchivoFichaClinicaCirugia', 'SeleccionTipoDeArchivo', 'ArchivoDelEstudioPdf', 'ArchivoDelEstudioImagen', 'rutaImagenfinal',
            'ArchivoRecomentacionesOperatorias', 'PesoIntenacion', 'FechaDeEutanacia', 'FechaIngresoInternacion', 'RazonDeEutanacia', 'SubirConcentimientoInformado',
            'ArchivoConcentimientoInformado', 'SubirAutorizacionDeSedacion', 'ArchivoAutorizacionDeSedacion', 'ActitudDeMascota', 'ActitudDeMascotaOtraOpcion', 'TllcMascota',
            'tipo_historial', 'ConductaDeMascota', 'OtraOpcionConductaDeMascota', 'EstadoNutricionalDeMascota', 'EstadoNutricionalDeMascotaOtraOpcion', 'MmDeMascota',
            'ConstanteVitalFcDeMascota', 'ArchivoDelEstudioImagenColeccion', 'Diagnosticoconsulta', 'ConstanteVitalTemperaturaDeMascota', 'CapaDePielDeMascota', 'NroDeHistorialDeMascota', 'AnamensisDeMascota', 'Recomendacionconsulta', 'Precio'
        ]);
        $this->resetValidation();
        #$this->resetPage();
    }

    //funcion para editar

    public $Raza, $Sexo, $Edad, $Especie, $MotivoDeAtencion;
    public $historial_id_selected, $archivo_anterior, $Diagnosticoconsulta, $nombreTipohistorial, $Past, $Pad, $Pam, $PulsoDeLaMascota, $Dht, $Peso, $Recomendacionconsulta;
    public function EditarHistorial($historial)
    {
        // $this->emit('alert','dasdasd');
        $historialSelect = Historias_clinico::find($historial);
        if ($historialSelect->tipo_historial_id == 1 || $historialSelect->tipo_historial_id == 10) {
            $this->tipo_historial = 'historial_clinico';
            if ($historialSelect->tipo_historial_id == 1) {
                $this->nombreTipohistorial = 'CONSULTA';
            } else {
                $this->nombreTipohistorial = 'RECONSULTA';
            }



            $this->historial_id_selected = $historial;
            $this->NroDeHistorialDeMascota = $historialSelect->nro_historial_clinico;
            $this->AnamensisDeMascota = $historialSelect->anamensis;
            $this->MotivoDeAtencion = $historialSelect->motivo_atencion;
            $this->Especie = $historialSelect->historial_clinico_mascotas->mascotas_especies->nombre;
            $this->Raza = $historialSelect->historial_clinico_mascotas->mascotas_razas->nombre;
            $this->Sexo = $historialSelect->historial_clinico_mascotas->sexo;
            $this->Edad = $historialSelect->historial_clinico_mascotas->edad_mascota;

            $this->Precio = $historialSelect->precio;
            $this->Past = $historialSelect->Past;
            $this->Pad = $historialSelect->Pad;
            $this->Pam = $historialSelect->Pam;
            $this->PulsoDeLaMascota = $historialSelect->Pulso;
            $this->Dht = $historialSelect->Dht;
            $this->Peso = $historialSelect->Peso;
            $this->Recomendacionconsulta = $historialSelect->recomendacion;
            $this->Diagnosticoconsulta = $historialSelect->diagnostico;
            if (!in_array($historialSelect->actitud, [
                'Jugueton@',
                'Amigable',
                'Cautelosa',
                'Protectora',
                'Sumisa',
                'Independiente',
                'Curios@',
                'Reservada',
                'Alegre',
                'Agresiva',
            ])) {

                $this->ActitudDeMascotaOtraOpcion = $historialSelect->actitud;
                $this->ActitudDeMascota = 'otros';
            } else {

                $this->ActitudDeMascota = $historialSelect->actitud;
                $this->ActitudDeMascotaOtraOpcion = '';
            }
            $this->TllcMascota = $historialSelect->tllc;
            if (!in_array($historialSelect->conducta, [
                'Sociable',
                'Carácter fuerte',
                'Miedoso',
                'Tranquilo',
                'Activo',
                'Juguetón',
                'Tímido',
                'Asustadizo',
                'Agresivo',
                'Amigable',
            ])) {
                // Si no está en las opciones predeterminadas, establecer OtraOpcionConductaDeMascota
                $this->OtraOpcionConductaDeMascota = $historialSelect->conducta;
                $this->ConductaDeMascota = 'otros'; // Establecer ConductaDeMascota como 'otros'
            } else {
                // Si está en las opciones predeterminadas, establecer ConductaDeMascota
                $this->ConductaDeMascota = $historialSelect->conducta;
                $this->OtraOpcionConductaDeMascota = ''; // Vaciar OtraOpcionConductaDeMascota
            }
            if (!in_array($historialSelect->esta_nutricional, [
                'Bajo peso',
                'Peso ideal',
                'Sobrepeso',
                'Obesidad',
                'Delgado',
                'Normal',
                'Sobrealimentado',
                'Desnutrido',
                'Enfermedad / Tratamiento',
                'Cachorro / Crecimiento',
            ])) {
                // Si no está en las opciones predeterminadas, establecer EstadoNutricionalDeMascotaOtraOpcion
                $this->EstadoNutricionalDeMascotaOtraOpcion = $historialSelect->esta_nutricional;
                $this->EstadoNutricionalDeMascota = 'otros'; // Establecer EstadoNutricionalDeMascota como 'otros'
            } else {
                // Si está en las opciones predeterminadas, establecer EstadoNutricionalDeMascota
                $this->EstadoNutricionalDeMascota = $historialSelect->esta_nutricional;
                $this->EstadoNutricionalDeMascotaOtraOpcion = ''; // Vaciar EstadoNutricionalDeMascotaOtraOpcion
            }
            $this->MmDeMascota = $historialSelect->mm;
            $this->ConstanteVitalFcDeMascota = $historialSelect->const_v_fc;
            $this->ConstanteVitalFrDeMascota = $historialSelect->const_v_fr;
            $this->ConstanteVitalTemperaturaDeMascota = $historialSelect->const_v_t;
            if (!in_array($historialSelect->capa_piel, [
                'Brillante',
                'Áspero',
                'Suave',
                'Esponjoso',
                'Opaco',
                'Rizado',
                'Lacio',
                'Densa',
                'Irregular',
                'Descamación',
            ])) {
                // Si no está en las opciones predeterminadas, establecer OtraCapaDePielDeMascota
                $this->OtraCapaDePielDeMascota = $historialSelect->capa_piel;
                $this->CapaDePielDeMascota = 'otros'; // Establecer CapaDePielDeMascota como 'otros'
            } else {
                // Si está en las opciones predeterminadas, establecer CapaDePielDeMascota
                $this->CapaDePielDeMascota = $historialSelect->capa_piel;
                $this->OtraCapaDePielDeMascota = ''; // Vaciar OtraCapaDePielDeMascota
            }
            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 2) {
            $this->tipo_historial = 'estudio_complementario';

            $this->historial_id_selected = $historial;
            $this->Precio = $historialSelect->precio;
            $showCarousel = true;
            foreach ($historialSelect->fotosestudio as $imagen) {
                if (str_ends_with($imagen->imagen, '.pdf')) {
                    $showCarousel = false;
                    break;
                }
            }
            if ($showCarousel) {
                $this->banseraEstudio = 1;
            } else {
                $this->SeleccionTipoDeArchivo = 'pdf';
                $this->banseraEstudio = 2;
            }




            $this->TipoDeEstudioComplementario = $historialSelect->estudio_complementario_id;

            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 3) {
            $this->tipo_historial = 'internacion';
            $this->historial_id_selected = $historial;
            $this->Precio = $historialSelect->precio;
            $this->PesoIntenacion = $historialSelect->peso_internacion;
            $this->FechaIngresoInternacion = $historialSelect->fecha_ingreso_internacion;
            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 4) {
            $this->historial_id_selected = $historial;
            $this->tipo_historial = 'ficha_clinica';
            $this->archivo_anterior = $historialSelect->imagen_pdf_ficha_clinica_cirugia;
            $this->Precio = $historialSelect->precio;
            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 5) {

            $this->tipo_historial = 'recomendaciones_operatorias';
            $this->historial_id_selected = $historial;
            $this->Precio = $historialSelect->precio;
            $this->archivo_anterior = $historialSelect->imagen_pdf_recomendaciones_operatorias;
            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 6) {
            $this->tipo_historial = 'concentimiento_informado';
            $this->historial_id_selected = $historial;
            $this->Precio = $historialSelect->precio;
            $this->archivo_anterior = $historialSelect->imagen_pdf_concentimiento_infomado;
            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 7) {
            $this->tipo_historial = 'autorizacion_de_sedacion';
            $this->historial_id_selected = $historial;
            $this->Precio = $historialSelect->precio;
            $this->archivo_anterior = $historialSelect->imagen_pdf_autorizacion_de_sedacion;
            $this->emit('AbrirModalEditarHistorial');
        } elseif ($historialSelect->tipo_historial_id == 9) {
            $this->tipo_historial = 'eutanacia';
            $this->historial_id_selected = $historial;
            $this->archivo_anterior = $historialSelect->informe_de_eutanacia;
            $this->Precio = $historialSelect->precio;
            $this->archivo_anterior = $historialSelect->imagen_eutanacia;
            $this->archivo_anterior = $historialSelect->fecha_de_eutanacia;
            $this->emit('AbrirModalEditarHistorial');
        }
    }
    public $banseraEstudio;
    public function guardareditarhistorial()
    {
        $historial_actual = Historias_clinico::find($this->historial_id_selected);
        $this->operation = "guardarhistorialclinico";
        $this->validate();
        $usuario = Auth::user();
        $actitud = '';
        if ($this->ActitudDeMascota == 'otros') {
            $actitud = $this->ActitudDeMascotaOtraOpcion;
        } elseif ($this->ActitudDeMascota != 'otros') {
            $actitud = $this->ActitudDeMascota;
        }
        $conducta = '';
        if ($this->ConductaDeMascota == 'otros') {
            $conducta = $this->OtraOpcionConductaDeMascota;
        } elseif ($this->ConductaDeMascota != 'otros') {
            $conducta = $this->ConductaDeMascota;
        }
        $estadonutricional = '';
        if ($this->EstadoNutricionalDeMascota == 'otros') {
            $estadonutricional = $this->EstadoNutricionalDeMascotaOtraOpcion;
        } elseif ($this->EstadoNutricionalDeMascota != 'otros') {
            $estadonutricional = $this->EstadoNutricionalDeMascota;
        }
        $capadepiel = '';
        if ($this->CapaDePielDeMascota == 'otros') {
            $capadepiel = $this->OtraCapaDePielDeMascota;
        } elseif ($this->CapaDePielDeMascota != 'otros') {
            $capadepiel = $this->CapaDePielDeMascota;
        }


        $historial_actual->nro_historial_clinico = $this->NroDeHistorialDeMascota;
        $historial_actual->anamensis = $this->AnamensisDeMascota;
        $historial_actual->motivo_atencion = $this->MotivoDeAtencion;
        $historial_actual->actitud = $actitud;
        $historial_actual->user_id = $usuario->id;
        $historial_actual->precio = $this->Precio;
        $historial_actual->recomendacion = $this->Recomendacionconsulta;
        $historial_actual->diagnostico = $this->Diagnosticoconsulta;
        $historial_actual->tllc = $this->TllcMascota;
        $historial_actual->conducta = $conducta;
        $historial_actual->esta_nutricional = $estadonutricional;
        $historial_actual->mm = $this->MmDeMascota;
        $historial_actual->const_v_fc = $this->ConstanteVitalFcDeMascota;
        $historial_actual->const_v_fr = $this->ConstanteVitalFrDeMascota;
        $historial_actual->const_v_t = $this->ConstanteVitalTemperaturaDeMascota;
        $historial_actual->Past = $this->Past;
        $historial_actual->Pad = $this->Pad;
        $historial_actual->Pam = $this->Pam;
        $historial_actual->Pulso = $this->PulsoDeLaMascota;
        $historial_actual->Dht = $this->Dht;
        $historial_actual->Peso = $this->Peso;
        $historial_actual->capa_piel = $capadepiel;
        $historial_actual->update();


        $this->limpiarmodalhistorial();
        $this->emit('crearmodalcrearhistorial');

        $this->emit('alert', 'historial clinico editado con exito');
    }
    public function comenzarReconocimientoMotivoDeAtencion()
    {
        $this->emit('ReconocerMotivoDeconsulta');
    }
    public function comenzarReconocimientoAnamensis()
    {
        $this->emit('ReconocerAnamensis');
    }
    public function resultadoReconocimientoAnamensis($texto)
    {
        $this->AnamensisDeMascota .= ' ' . $texto;
    }
    public function resultadoReconocimientoMotivoConsulta($texto)
    {
        $this->MotivoDeAtencion .= ' ' . $texto;
    }

    public $a = false;
    public $b = false;
    public $c = false;

    public $imagenBinaria;
    public $nombreImagen;
    public $rutaImagen;
    public $rutaImagenfinal, $campoImagenHabilitado, $Imagenproducto;

    // public $facingMode;
    public $facingMode = 'user';

    // Valor predeterminado para la cámara frontal
    public function cambiarCamarat()
    {
        $this->facingMode = 'environment';
        $this->emit('refreshCamara', $this->facingMode);
    }
    #
    public function cambiarCamarad()
    {
        $this->facingMode = 'user';
        $this->emit('refreshCamara', $this->facingMode);
    }


    public $texto;

    public function comenzarReconocimiento()
    {
        $this->emit('Reconocer');
    }

    public function resultadoReconocimiento($texto)
    {
        $this->DescripcionTratamiento .= ' ' . $texto;
    }
    public function nuevo()
    {
        $this->emit('alert', $this->texto);
    }


    public function imagenCapturada($imagenBase64)
    {
        $this->imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
        $this->nombreImagen = uniqid('imagen') . '.jpg';
        $this->rutaImagen = 'public/imagenes_capturadas/' . $this->nombreImagen;
        Storage::put($this->rutaImagen, $this->imagenBinaria);
        $urlImagenAnterior = parse_url($this->rutaImagen, PHP_URL_PATH);
        $rutaImagenAnterior = str_replace('public', 'storage', $this->rutaImagen);
        $this->rutaImagenfinal = '/' . $rutaImagenAnterior;
        //dd($this->rutaImagenfinal);
        $this->campoImagenHabilitado = true;
        $this->a = true;
        $this->b = true;
        $this->emit('crearhistorial');
    }
    public function limpiarbotonpro()
    {
        if ($this->rutaImagen !== null) {
            Storage::delete($this->rutaImagen);
        }
        $this->a = false;
        $this->b = false;
        $this->reset(['rutaImagenfinal', 'rutaImagen', 'Imagenproducto']);
        $this->emit('alert', 'IMAGEN REMOVIDA CON EXITO');
    }
    public function limpiarcamara()
    {

        //$this->limpiarproducto();
        $this->emit('cerrarmodalcamara');
        $this->campoImagenHabilitado = false;
        $this->emit('crearhistorial');
    }

    #ELIMINAR HISTORIAL
    public function eliminar_historial($id)
    {
        $historial = Historias_clinico::find($id);
        $historial->estado = 'eliminado';
        $historial->update();
    }
    public function eliminar_tratamiento($id)
    {
        $historial = Tratamiento_historial_clinico::find($id);
        $historial->estado = 'eliminado';
        $historial->update();
    }
    #VER TRATAMIENTOS
    public $tratamientos_historial = [];
    public function ver_tratamientos($id)
    {
        $this->tratamiento_seleccionado = $id;
        $this->tratamientoid = $id;

        $this->emit('vermodaltratamietnoshistorial');
    }
    public $tratamiento_internacion_select, $tratamientointernacionid;
    public function ver_tratamientos_internacion($id)
    {
        $this->tratamientointernacionid = $id;
        $this->tratamiento_internacion_select = $id;


        $this->emit('vermodaltratamietnoshistorialinternacionlistar');
    }
    #CREAR TRATAMIENTO HISTORIAL
    public  $tratamiento_seleccionado, $tratamientoid;
    public function crear_tratamiento($id)
    {
        $this->tratamiento_seleccionado = $id;
        # $tratamiento_select=Tratamiento_historial_clinico::find($id);


        $this->emit('vermodalcreartratamiento');
    }
    public function crear_tratamiento_internacion($id)
    {
        $this->tratamiento_internacion_select = $id;
        # $tratamiento_select=Tratamiento_historial_clinico::find($id);


        $this->emit('vermodaltratamietnoshistorialinternacion');
    }

    public function limpiarmodaltratamientos()
    {
        $this->reset('DescripcionTratamiento', 'tratamientoid_select');
        $this->resetValidation();
    }
    public $encargado, $fecha, $tratamiento, $observaciones;
    public function guardartratamientointernacion()
    {
        $this->operation = 'guardartratamientointernacion';
        $this->validate();
        $usuario = Auth::user();
        TratamientosHistorial::create([
            'encargado' => $this->encargado,
            'fecha' => $this->fecha,
            'tratamiento' => $this->tratamiento,
            'observaciones' => $this->observaciones,
            'historial_id' => $this->tratamiento_internacion_select,
            'precio' => $this->Precio,
            'user_id' => $usuario->id,

        ]);
        $this->emit('cerrarmodaltratamietnoshistorialinternacion');
        $this->ver_tratamientos_internacion($this->tratamiento_internacion_select);
        $this->limpiarmodalcrear();
        $this->emit('alert', 'TRATAMIENTO CREADO CON EXITO');
    }
    public function guardareditartratamientointernacion()
    {

        $this->operation = 'guardartratamientointernacion';
        $this->validate();
        $usuario = Auth::user();
        $tratamiento_select_i = TratamientosHistorial::find($this->tratamientointernacion_id);
        $tratamiento_select_i->encargado = $this->encargado;
        $tratamiento_select_i->fecha = $this->fecha;
        $tratamiento_select_i->observaciones = $this->observaciones;
        $tratamiento_select_i->tratamiento = $this->tratamiento;
        $tratamiento_select_i->user_id = $usuario->id;
        $tratamiento_select_i->precio = $this->Precio;
        $tratamiento_select_i->update();


        $this->emit('cerrarmodaltratamietnoshistorialinternacion');
        $this->ver_tratamientos_internacion($this->tratamiento_internacion_select);
        $this->limpiarmodalcrear();
        $this->emit('alert', 'TRATAMIENTO EDITADO CON EXITO');
    }
    public $tratamientointernacion_id;
    public function editartratamientointernacion($id)
    {
        $this->emit('cerrarmodalvertratamientointernacion');

        $tratamiento_i = TratamientosHistorial::find($id);

        $this->tratamientointernacion_id = $id;
        $this->encargado = $tratamiento_i->encargado;
        $this->fecha = $tratamiento_i->fecha;
        $this->tratamiento = $tratamiento_i->tratamiento;
        $this->Precio = $tratamiento_i->precio;
        $this->observaciones = $tratamiento_i->observaciones;

        $this->emit('vermodaltratamietnoshistorialinternacion');
    }
    public function limpiarmodalcrear()
    {
        $this->reset('encargado', 'fecha', 'observaciones', 'tratamiento', 'tratamientointernacion_id');
        $this->resetValidation();
    }
    public function creartratamiendonew()
    {
        $this->emit('cerrarmodalvertratamiento');
        $this->crear_tratamiento($this->tratamiento_seleccionado);
    }
    public $tratamientoid_select;
    public function editartratamientohistorial($id)
    {
        $this->emit('cerrarmodalvertratamiento');
        $tratamiento_a = Tratamiento_historial_clinico::find($id);
        $this->tratamientoid_select = $id;
        $this->DescripcionTratamiento = $tratamiento_a->descripcion;
        $this->Precio = $tratamiento_a->precio;

        $this->emit('vermodalcreartratamiento');
    }

    public function guardarEditartratamiento()
    {

        $this->operation = 'guardartratamiento';
        $this->validate();
        $usuario = Auth::user();
        $tratamiento_select = Tratamiento_historial_clinico::find($this->tratamientoid_select);
        $tratamiento_select->descripcion = $this->DescripcionTratamiento;
        $tratamiento_select->user_id = $usuario->id;
        $tratamiento_select->precio = $this->Precio;
        $tratamiento_select->update();


        $this->emit('cerrarmodalcreartratamiento');
        $this->ver_tratamientos($this->tratamiento_seleccionado);
        $this->limpiarmodaltratamientos();
        $this->emit('alert', 'TRATAMIENTO CREADO CON EXITO');
    }

    public function creartratamiendointernacionnew()
    {
        $this->emit('cerrarmodalvertratamientointernacion');
        $this->crear_tratamiento_internacion($this->tratamiento_internacion_select);
    }
    public function cancelarmodaltramite()
    {
        $this->reset('tratamientoid');
    }

    public function eliminar_tratamiento_internacion($id)
    {
        $tratamiento = TratamientosHistorial::find($id);
        $tratamiento->estado = 'eliminado';
        $tratamiento->update();
        $this->emit('alert', 'TRATAMIENTO ELIMINADO CON EXITO');
    }

    #PARTE DE TRATAMIENTOS
    public $Medicamento, $DosisEnMg, $DosisEnMl, $DosisComrpimido, $Via, $Administrado = 0, $DescripcionTratamiento;
    public function guardartratamiento()
    {
        $this->operation = 'guardartratamiento';
        $this->validate();
        $usuario = Auth::user();
        if ($this->Administrado == 1) {
            $Administrado = 'SI';
        } elseif ($this->Administrado == 0) {
            $Administrado = 'NO';
        }
        Tratamiento_historial_clinico::create([
            'descripcion' => $this->DescripcionTratamiento,
            'historial_id' => $this->tratamiento_seleccionado,
            'Medicamento' => $this->Medicamento,
            'dosis_mg' => $this->DosisEnMg,
            'dosis_ml' => $this->DosisEnMl,
            'comprimido' => $this->DosisComrpimido,
            'via' => $this->Via,
            'administrado' => $Administrado,
            'hora' => date('h:i:s'),
            'precio' => $this->Precio,
            'user_id' => $usuario->id,
        ]);

        $this->reset('DescripcionTratamiento', 'Medicamento', 'DosisEnMg', 'DosisComrpimido', 'DosisEnMl', 'Via', 'Administrado', 'Precio');
        $this->emit('alert', 'TRATAMIENTO CREADO CON EXITO');
    }

    // FUNCIONES PARA TRATAMIENTOS
    public $HistorialId;
    public function VerTratamientos($consulta)
    {
        $this->HistorialId = $consulta;
        $this->emit('Abrirmodaltratamiento');
    }
    public function CrearTratamiento()
    {
        $NuevoTratamiento = Tratamiento_historial_clinico::create([
            'historial_id' => $this->HistorialId,


            'user_id' => Auth::user()->id,

        ]);

        $this->emit('Abrirmodaltratamiento');
    }
    public function GuardarComentarioTratamiento($tratamientoid)
    {
        $this->operation = 'validarcomentario';
        $this->validate();
        $NuevoTratamiento = ComentariosTratamiento::create([
            'tratamiento_id' => $tratamientoid,
            'comentario' => $this->DescripcionTratamiento,


            'user_id' => Auth::user()->id,

        ]);
        $this->reset('DescripcionTratamiento');
    }
    public function GuardarMedicamento($tratamientoid)
    {

        $this->operation = 'guardartratamiento';
        $this->validate();
        $usuario = Auth::user();
        if ($this->Administrado == 1) {
            $Administrado = 'SI';
        } elseif ($this->Administrado == 0) {
            $Administrado = 'NO';
        }
        MedicamentosTratamiento::create([

            'tratamiento_id' => $tratamientoid,
            'Medicamento' => $this->Medicamento,
            'dosis_mg' => $this->DosisEnMg,
            'dosis_ml' => $this->DosisEnMl,
            'comprimido' => $this->DosisComrpimido,
            'via' => $this->Via,
            'administrado' => $Administrado,
            'hora' => date('h:i:s'),

            'user_id' => $usuario->id,
        ]);

        $this->reset('Medicamento', 'DosisEnMg', 'DosisEnMl', 'DosisComrpimido', 'Via', 'Administrado');
    }

    public $CostoTratamiento;
    public function NuevoCostoTratamiento($tratamiento)
    {
        $this->operation = 'validarcostotratamiento';
        $this->validate();
        $nuevoprecio = Tratamiento_historial_clinico::find($tratamiento);
        $nuevoprecio->precio = $this->CostoTratamiento;
        $nuevoprecio->update();
        $this->reset('CostoTratamiento');
    }
    //------------------------------- toto molqui tratamiento editar------------------
    public $estadocomen = true, $id_comen;
    public function editartratamientodato($idcomentario)
    {
        $regitro = ComentariosTratamiento::find($idcomentario);
        $this->id_comen = $idcomentario;
        $this->estadocomen = false;
        $this->DescripcionTratamiento = $regitro->comentario;
    }
    public function EditarComentarioTratamiento()
    {
        $regitro = ComentariosTratamiento::find($this->id_comen);
        if ($regitro) {
            $regitro->comentario = $this->DescripcionTratamiento;
            $regitro->update();
        }

        $this->reset('DescripcionTratamiento', 'id_comen');
        $this->estadocomen = true;
    }
    public function borrartratamientodato($idcomentario)
    {
        $regitro = ComentariosTratamiento::find($idcomentario);
        if ($regitro) {
            $regitro->estado = 'eliminado';
            $regitro->update();
        }
        $this->reset('DescripcionTratamiento', 'id_comen');
        $this->estadocomen = true;
    }
    public function borrartratamientocuerpo($idcomentario)
    {
        $regitro = MedicamentosTratamiento::find($idcomentario);
        if ($regitro) {
            $regitro->estado = 'eliminado';
            $regitro->update();
        }
        $this->reset('DescripcionTratamiento', 'id_comen');
        $this->estadocomen = true;
    }
    public $Medicamentototal, $ArchivoDelEstudioImagenColeccion = [];
    public function Guardarcostototalmedicamento($idtrtamiento)
    {
        // Busca todos los registros de medicamentos asociados al tratamiento
        $registros = MedicamentosTratamiento::where('tratamiento_id', $idtrtamiento)->get();
        $registros2 = Tratamiento_historial_clinico::find($idtrtamiento);

        // Verifica si se encontraron registros
        if ($registros->isNotEmpty()) {
            // Itera sobre cada registro
            foreach ($registros as $registro) {
                // Actualiza el precio del medicamento
                $registro->precio = $this->Medicamentototal;
                $registro->save();
            }
            $registros2->precio = $this->Medicamentototal;
            $registros2->save();
            // Emite un mensaje de éxito
            $this->emit('alert', 'Precios de medicamentos actualizados con éxito');
        } else {
            // Emite un mensaje de error si no se encontraron registros
            $this->emit('alert', 'No se encontraron medicamentos asociados al tratamiento');
        }

        // Reinicia la propiedad Medicamentototal
        $this->reset('Medicamentototal');
    }
    public function borrarcostototalmedicamento($idtrtamiento)
    {
        $registros = MedicamentosTratamiento::where('tratamiento_id', $idtrtamiento)->get();
        $registros2 = Tratamiento_historial_clinico::find($idtrtamiento);
        // Verifica si se encontraron registros
        if ($registros->isNotEmpty()) {
            // Itera sobre cada registro
            foreach ($registros as $registro) {
                // Actualiza el precio del medicamento
                $registro->precio = 0;
                $registro->save();
            }
            $registros2->precio = 0;
            $registros2->save();
            // Emite un mensaje de éxito
            $this->emit('alert', 'Eliminado con exito');
        } else {
            // Emite un mensaje de error si no se encontraron registros
            $this->emit('alert', 'No se encontraron medicamentos asociados al tratamiento');
        }

        // Reinicia la propiedad Medicamentototal
        $this->reset('Medicamentototal');
    }
    //-----------------------------------------------------------------------------boton atraz
    public function reporteunicoregistro($id)
    {
        $url = route('ClienteUnico2', [
            'id' => $id
        ]);
        $this->emit('openNewTabssunic', ['url' => $url]);
    }
    //----------------------------------------------------------------------redet ------------------------------------------------
    public $MascotaVacunas, $EdadEnVacunas, $PesoEnDesparacitacion,
        $VacunaAplicada, $ProximaFecha, $Veterinario, $EdadEnDesparacitacion,
        $Producto, $ProximaFechaDesparacitacion, $VeterinarioDesparacitacion, $ProductoDosis, $VacunaFC, $VacunaFR, $VacunaT, $VacunaTllc, $VacunaPeso, $VacunaMM;
    public $registroCompletodetodomascota;
    public  function VerVacunas()
    {
        // $this->registroCompletodetodomascota = Mascotas::find($mascota);
        // $this->MascotaVacunas = $mascota;
        $this->emit('abrirmodalvervacunas');
    }
    public function vercirugias()
    {
        // //$this->emit("alert","hola miky".$mas_id);
        // $this->registroCompletodetodomascota = Mascotas::find($mas_id);
        // $this->id_masco = $mas_id;
        // $this->registro_completo = Mascotas::find($mas_id);
        $this->emit("abrirmodalcirugiapre");
    }
    public function CancelarVacunas()
    {
        $this->gotoPage(1, 'vacunas_page');
        $this->gotoPage(1, 'desparacitacion_page');
    }
    public  $medicamento, $medicamento2, $mg, $ml, $via,  $bandera = true;
    public function render()
    {
        $VacunasPorMascota = Vacunas::where('mascota_id', $this->mascota)->where('estado', 'ACTIVO')->paginate(3, ['*'], 'vacunas_page');
        $DesparacitacionPorMascota = Desparacitaciones::where('mascota_id', $this->mascota)->where('estado', 'ACTIVO')->paginate(3, ['*'], 'desparacitacion_page');

        $tratamientos_usados = [];
        if ($this->tratamiento_seleccionado) {
            $tratamientos_usados = Tratamiento_historial_clinico::where('historial_id', $this->tratamiento_seleccionado)->where('estado', 'activo')->orderBy('id', 'desc')->get();
        }
        $tratamientos_usados_internacion = [];
        if ($this->tratamientointernacionid) {
            $tratamientos_usados_internacion = TratamientosHistorial::where('historial_id', $this->tratamientointernacionid)->where('estado', 'activo')->get();
        }
        $mascota_actual = Mascotas::find($this->mascota);
        $cliente_actual = Clientes::find($mascota_actual->cliente_id);
        $tipo_historia_complementarios = TipoHistorial::where('estado', 'activo')->get();
        $estudios_complemetarios = EstudiosComplementarios::where('estado', 'activo')->get();
        $historiales = Historias_clinico::where('mascota_id', $this->mascota)->where('estado', '<>', 'eliminado')
            ->orderBy('id', 'desc')
            ->paginate(6);
        $historial_eutanacia = Historias_clinico::where('mascota_id', $this->mascota)->where('estado', '<>', 'eliminado')
            ->where('tipo_historial_id', 9)

            ->first();
        $usuarios = User::get();

        $tratamientos = Tratamiento_historial_clinico::where('estado', 'activo')->where('historial_id', $this->HistorialId)->orderBy('id', 'desc')->get();
        $consultasMascota = Historias_clinico::where('estado', 'activo')->where('mascota_id', $this->mascota)->where('tipo_historial_id', 1)->get();
        $imagenesEstudio = FotosEstudio::where('estado', 'activo')->where('historial_id', $this->historial_id_selected)->get();
        $cirugiass = Cirugias::where('id_mascota', $this->mascota)->where('estado', "activo")->get();
        $datoscirugiaspre = CirugiasDatos::where('total', 1)->where('estado', "activo")->get();
        $cirugiapreope = CirugiasPre::where('tipo', 1)->where('estado', "activo")->get();
        $datoscirugiaspre2 = CirugiasDatos::where('total', 2)->where('estado', "activo")->get();
        $cirugiapreope2 = CirugiasPre::where('tipo', 2)->where('estado', "activo")->get();
        $datoscirugiaspre3 = CirugiasDatos::where('total', 3)->where('estado', "activo")->get();
        $cirugiapreope3 = CirugiasPre::where('tipo', 3)->where('estado', "activo")->get();
        return view('livewire.modulos-v.mascotas-historial', compact(
            'tratamientos_usados_internacion',
            'tratamientos',
            'VacunasPorMascota',
            'cirugiass',
            'DesparacitacionPorMascota',
            'estudios_complemetarios',
            'historiales',
            'mascota_actual',
            'cliente_actual',
            'tipo_historia_complementarios',
            'imagenesEstudio',
            'historial_eutanacia',
            'datoscirugiaspre',
            'cirugiapreope',
            'datoscirugiaspre2',
            'cirugiapreope2',
            'datoscirugiaspre3',
            'cirugiapreope3',
            'tratamientos_usados',
            'usuarios',
            'consultasMascota'
        ));
    }
}
