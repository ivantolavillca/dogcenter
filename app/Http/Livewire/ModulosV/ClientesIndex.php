<?php

namespace App\Http\Livewire\ModulosV;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Modulos\Cajas;
use App\Models\Modulos\Razas;
use Livewire\WithFileUploads;
use App\Models\Modulos\Cobros;
use App\Models\Modulos\Fichas;
use App\Models\Modulos\Gastos;
use App\Models\Modulos\Ventas;
use App\Models\Modulos\Vacunas;
use App\Models\Modulos\Cirugias;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\Especies;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\farmacias;
use App\Models\Modulos\Productos;
use App\Events\FichaStatusUpdated;
use App\Models\Modulos\CirugiasPre;
use App\Models\Modulos\Internacion;
use App\Models\Modulos\FotosEstudio;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulos\CirugiasDatos;
use Intervention\Image\Facades\Image;
use App\Models\Modulos\ColoresMascotas;
use App\Models\Modulos\farmaciasVentas;
use App\Models\Modulos\VentasProductos;
use Illuminate\Support\Facades\Storage;
use App\Models\Modulos\Imagenes_cirgias;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\ComentariosInternacion;
use App\Models\Modulos\EstudiosComplementarios;
use App\Models\Modulos\ImagenesInternacion;
use App\Models\Modulos\MedicamentosInternacion;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class ClientesIndex  extends Component
{
    public $registroCompletodetodomascota;
    public $search;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    //FUNCIONES DE VALIDACION
    use WithFileUploads;
    public function rules()
    {
        if ($this->operation === 'crearcliente') {
            return $this->rulesCrearCliente();
        } elseif ($this->operation === 'guardareditarcliente') {
            return $this->rulesEditarCliente();
        } elseif ($this->operation === 'crearMascota') {
            return $this->rulesCrearMascota();
        } elseif ($this->operation === 'CrearEspecie') {
            return $this->rulesCrearEspecie();
        } elseif ($this->operation === 'CrearRaza') {
            return $this->rulesCrearRaza();
        } elseif ($this->operation === 'CrearColor') {
            return $this->rulesCrearColor();
        } elseif ($this->operation === 'CrearConsulta') {
            return $this->rulesCrearConsultas();
        } elseif ($this->operation === 'guardarvacuna') {
            return $this->rulesCreaVacuna();
        } elseif ($this->operation === 'guardardesparacitacion') {
            return $this->rulesCreaDesparacitacion();
        } elseif ($this->operation === 'crearestudiocomplementariorulepdf') {
            return $this->rulesestudiocomplementariocreatepdf();
        } elseif ($this->operation === 'crearestudiocomplementarioruleimagensubida') {
            return $this->rulesguardarestudioconcaptura();
        } elseif ($this->operation === "nuevo") {
            return $this->validartodocirugi();
        } elseif ($this->operation === "datos") {
            return $this->validartododatoscirugi();
        } elseif ($this->operation === "datosprecirugia") {
            return $this->validartodoprecirugi();
        } elseif ($this->operation === "guardareditarmascota") {
            return $this->validareditarmascota();
        } elseif ($this->operation === "ValidarNuevoEstudio") {
            return $this->ValidarNuevoEstudio();
        } elseif ($this->operation === 'validarcomentariointernacion') {
            return $this->rulesvalidarcomentarioInternacion();
        } elseif ($this->operation === 'validarinternacionmedicamentos') {
            return $this->rulesguardarinternacionmedicamentos();
        } elseif ($this->operation === 'validarcostointernacion') {
            return $this->rulesgcostointernacion();
        } elseif ($this->operation === 'ValidarNuevoVentaFarmacia') {
            return $this->ValidarNuevoVentaFar();
        } elseif ($this->operation === 'validarEstudioNuevo') {
            return $this->rulesEstudionuevo();
        } elseif ($this->operation === 'crearestudiocomplementarioruleimagen') {
            return $this->rulesestudiocomplementariocreateimgen();
        } elseif ($this->operation === 'validarpago') {
            return $this->rulesCrearpago();
        } elseif ($this->operation === 'validardescuento') {
            return $this->rulesCreardescuento();
        } elseif ($this->operation === 'datoscirugia') {
            return $this->rulesCirugias();
        } elseif ($this->operation === 'datoscirugiapreo') {
            return $this->rulesCirugiasPre();
        } elseif ($this->operation === 'validareutanacianuevoimagen') {
            return $this->RulesEutanaciaNuevoImagen();
        } elseif ($this->operation === 'validareutanacianuevocamara') {
            return $this->RulesEutanaciaNuevoCamara();
        } elseif ($this->operation === 'validareutanacianuevovacio') {
            return $this->RulesEutanaciaNuevoVacio();
        
        } elseif ($this->operation === 'validacionguardarimagenesinternacion') {
            return $this->RulesInternacionNuevoImagen();
        }
       
    
        return array_merge( $this->RulesInternacionNuevoImagen(),$this->RulesEutanaciaNuevoVacio(), $this->RulesEutanaciaNuevoCamara(), $this->RulesEutanaciaNuevoImagen(), $this->rulesCirugiasPre(), $this->rulesCirugias(), $this->rulesCreardescuento(), $this->rulesCrearpago(), $this->rulesEstudionuevo(), $this->rulesestudiocomplementariocreateimgen(), $this->rulesgcostointernacion(), $this->rulesvalidarcomentarioInternacion(), $this->rulesguardarinternacionmedicamentos(), $this->validartodocirugi(), $this->validareditarmascota(), $this->rulesestudiocomplementariocreatepdf(), $this->rulesguardarestudioconcaptura(), $this->rulesCreaDesparacitacion(), $this->rulesCreaVacuna(), $this->rulesCrearColor(), $this->rulesCrearConsultas(), $this->rulesCrearColor(), $this->rulesCrearEspecie(), $this->rulesCrearCliente(), $this->rulesEditarCliente(), $this->rulesCrearMascota());
    }

  
    public function RulesEutanaciaNuevoImagen()
    {
        return  [
            'ArchivoDelEstudio' => 'required',
            'FechaDeEutanacia' => 'required',
            'RazonDeEutanacia' => 'required|string|max:255',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
            'SeleccionTipoDeArchivo' => 'required',
        ];
    }
    public function RulesInternacionNuevoImagen()
    {
        return  [
            'ImagenesInternacion' => 'required',
            
        ];
    }
    public function RulesEutanaciaNuevoCamara()
    {
        return  [
            'rutaImagenfinal' => 'required',
            'FechaDeEutanacia' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'RazonDeEutanacia' => 'required|string|max:255',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',

        ];
    }
    public function RulesEutanaciaNuevoVacio()
    {
        return  [

            'FechaDeEutanacia' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'RazonDeEutanacia' => 'required|string|max:255',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',

        ];
    }
    public $operation;
    public $tipo_historial, $Past, $Pad, $Pam, $PulsoDeLaMascota, $Dht, $Peso, $ActitudDeMascota,
        $ActitudDeMascotaOtraOpcion, $TllcMascota, $ConductaDeMascota,
        $OtraOpcionConductaDeMascota, $EstadoNutricionalDeMascota,
        $EstadoNutricionalDeMascotaOtraOpcion, $MmDeMascota, $ConstanteVitalFcDeMascota,
        $ConstanteVitalFrDeMascota, $ConstanteVitalTemperaturaDeMascota, $CapaDePielDeMascota,
        $NroDeHistorialDeMascota, $AnamensisDeMascota, $Recomendacionconsulta, $Diagnosticoconsulta, $Precio;

    protected $listeners = [
        'eliminarcliente', 'imagenCapturadaMascota', 'EliminarMascota', 'resultadoReconocimientoAnamensis', 'crearcajanuevo', 'cerrarcajaanterior',
        'resultadoReconocimientoMotivoConsulta',
        'EliminarVacuna', 'EliminarDesparacitaciones', 'EliminarEstudio', 'resultadoReconocimientoDiagnostico', 'resultadoReconocimientoRecomendacione',
        'imagenCapturada', 'eliminarcarro', 'imagenCapturadaEstudio', 'BorrarCirugia', 'borrarinternacionn', 'eliminarmedicamentoo', 'borrardatosinternacion'
    ];
    public $a = false;
    public $b = false;
    public $c = false;

    public $imagenBinaria;
    public $nombreImagen;
    public $rutaImagen, $PrecioVacuna = 0.00, $PrecioDesparacitacion = 0.00;


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
        $this->emit('AbrirModalConsultas');
    }
    public   $rutaImagenfinalMascota, $ArchivoDelEstudioImagenColeccion = [];
    public $facingModeMascota = 'sin';

    // Valor predeterminado para la cámara frontal
    public function cambiarCamaratMascota()
    {
        $this->facingModeMascota = 'environment';
        $this->emit('refreshCamaraMacota', $this->facingModeMascota);
    }
    #
    public function cambiarCamaradMascota()
    {
        $this->facingModeMascota = 'user';
        $this->emit('refreshCamaraMacota', $this->facingModeMascota);
    }
    public function imagenCapturadaMascota($imagenBase64)
    {
        $imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
        $nombreImagen = uniqid('imagen') . '.jpg';
        $rutaImagen = 'public/imagen_mascotas/' . $nombreImagen;


        $imagenRedimensionada = Image::make($imagenBinaria)->resize(500, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg');


        Storage::put($rutaImagen, $imagenRedimensionada);

        $rutaImagenAnterior = str_replace('public', 'storage', $rutaImagen);
        $this->rutaImagenfinalMascota = '/' . $rutaImagenAnterior;
    }
    public function eliminarfoto()
    {
        $this->rutaImagenfinalMascota = null;
        $this->emit('refreshCamaraMacota', $this->facingModeMascota);
    }
    public $ComentarioEstudio;
    public function GuardarEstudioComplementario()
    {
        if ($this->SeleccionTipoDeArchivo == 'pdf') {
            $this->operation = "crearestudiocomplementariorulepdf";
            $this->validate();

            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_estudio_complementario') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/estudio_complementario', $nombreArchivo);
            $usuario = Auth::user();

            $historial = Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 2,
                'estudio_complementario_id' => $this->TipoDeEstudioComplementario,
                'comentario_estudio' => $this->ComentarioEstudio,
                // 'imagen_pdf_estudio_complementario' => '/storage/estudio_complementario/' . $nombreArchivo,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
            ]);
            FotosEstudio::create([
                'historial_id' => $historial->id,
                'imagen' => '/storage/estudio_complementario/' . $nombreArchivo,
                'user_id' => $usuario->id,
            ]);
            $this->limpiarmodalhistorial();
            $this->emit('cerrarmodalhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'imagen') {

            $this->operation = "crearestudiocomplementarioruleimagen";
            $this->validate();

            $usuario = Auth::user();

            $historial = Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 2,
                'estudio_complementario_id' => $this->TipoDeEstudioComplementario,
                'comentario_estudio' => $this->ComentarioEstudio,
                // 'imagen_pdf_estudio_complementario' => '/storage/estudio_complementario/' . $nombreArchivo,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
            ]);
            foreach ($this->ArchivoDelEstudioImagenColeccion as $key => $imagenc) {
                $archivo = $imagenc;
                $nombreArchivo = uniqid('archivo_estudio_complementario') . '.' . $archivo->getClientOriginalExtension();

                // Guardar el archivo en el almacenamiento
                $rutaArchivo = $archivo->storeAs('public/estudio_complementario', $nombreArchivo);

                FotosEstudio::create([
                    'historial_id' => $historial->id,
                    'imagen' => '/storage/estudio_complementario/' . $nombreArchivo,
                    'user_id' => $usuario->id,
                ]);
            }

            $this->limpiarmodalhistorial();
            $this->emit('cerrarmodalhistorial');
            $this->emit('alert', 'estudio complementario guardado con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = "crearestudiocomplementarioruleimagensubida";
            $this->validate();
            if ($this->rutaImagenfinal) {

                $usuario = Auth::user();

                $historial = Historias_clinico::create([
                    'mascota_id' => $this->mascota,
                    'tipo_historial_id' => 2,
                    'estudio_complementario_id' => $this->TipoDeEstudioComplementario,
                    // 'imagen_pdf_estudio_complementario' => $this->rutaImagenfinal,
                    'comentario_estudio' => $this->ComentarioEstudio,
                    'precio' => $this->Precio,
                    'user_id' => $usuario->id,


                ]);
                FotosEstudio::create([
                    'historial_id' => $historial->id,
                    'imagen' => $this->rutaImagenfinal,
                    'user_id' => $usuario->id,
                ]);
                $this->a = false;
                $this->limpiarmodalhistorial();
                $this->emit('cerrarmodalhistorial');
                $this->emit('alert', 'estudio complementario guardado con exito');
            } else {
                $this->addError('errorsacarfoto', 'Se debe  tomar una captura');
            }
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->addError('errortipodedato', 'Debe seleccionar algun tipo de archivo que desea agregar');
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function EliminarVacuna(Vacunas $id)
    {
        $id->estado = "eliminado";
        $id->update();
    }
    public function EliminarDesparacitaciones(Desparacitaciones $id)
    {
        $id->estado = "eliminado";
        $id->update();
    }

    public $DomicilioCliente, $Correo, $NuevaEspecie, $NuevoColor, $NuevaRaza, $ExpedidoCliente, $CiCliente, $TelefonoCliente, $ApellidoCliente, $NombreCliente;
    public function rulesEstudionuevo()
    {
        #validarpago
        return [
            'TipoDeEstudioComplementario' => 'required',

        ];
    }
    public function rulesCrearCliente()
    {
        return [
            'DomicilioCliente' => 'required|string|max:125',
            'ExpedidoCliente' => 'required|string|max:10',
            'CiCliente' => 'required|string|max:20|unique:clientes,ci',
            'TelefonoCliente' => 'required|string|max:15',
            'ApellidoCliente' => 'required|string|max:55',
            'NombreCliente' => 'required|string|max:55',
            'Correo' => 'required|string|email|max:100',

        ];
    }
    public function rulesCrearpago()
    {
        return [
            'MontoPago' => 'required|gt:0',
            'TipoPago' => 'required',
            'MotivoDePago' => 'required',


        ];
    }
    public function rulesCreardescuento()
    {
        return [
            'PrecioGasto' => 'required|gt:0',
            'RazonGasto' => 'required|string|max:250',


        ];
    }
    public function rulesguardarinternacionmedicamentos()
    {
        return [

            'MedicamentoMascota' => 'required|string|max:99',
            'DosisEnMgMascota' => 'nullable|string|max:10',
            'DosisEnMlMascota' => 'nullable|string|max:10',
            'ViaMascota' => 'required',
            'AdministradoMascota' => 'required',
            # 'Precio' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',

        ];
    }
    public function rulesvalidarcomentarioInternacion()
    {

        return [
            'DescripcionInternacion' => 'required|string|max:3998',

        ];
    }
    public function rulesgcostointernacion()
    {
        return [

            'CostoInternacion' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',

        ];
    }
    public function rulesguardarestudioconcaptura()
    {

        return [
            'SeleccionTipoDeArchivo' => 'required',
            'rutaImagenfinal' => 'required',
            'TipoDeEstudioComplementario' => 'required',
            'ComentarioEstudio' => 'nullable|string|max:1990',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];
    }
    public function rulesestudiocomplementariocreatepdf()
    {

        return [
            'TipoDeEstudioComplementario' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'ArchivoDelEstudio' => 'required',
            'ComentarioEstudio' => 'nullable|string|max:1990',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];
    }
    //ArchivoDelEstudioImagenColeccion
    public function rulesestudiocomplementariocreateimgen()
    {

        return [
            'TipoDeEstudioComplementario' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'ArchivoDelEstudioImagenColeccion' => 'required',
            'ComentarioEstudio' => 'nullable|string|max:1990',
            'Precio' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];
    }

    public function ValidarNuevoEstudio()
    {

        return [
            'NuevoEstudio' => 'required|string|max:70',

        ];
    }

    public function rulesCreaVacuna()
    {

        return [
            'EdadEnVacunas' => 'required|string|max:10',
            'VacunaMM' => 'nullable|string|max:49',
            'VacunaPeso' => 'nullable|string|max:49',
            'VacunaTllc' => 'nullable|string|max:999',
            'VacunaRecomendacion' => 'nullable|string|max:999',
            'VacunaAnamensis' => 'nullable|string|max:49',
            'VacunaT' => 'nullable|string|max:49',
            'VacunaFR' => 'nullable|string|max:49',
            'VacunaFC' => 'nullable|string|max:49',
            'ProximaFecha' => 'required|date',
            'VacunaAplicada' => 'required|string|max:70',

            'PrecioVacuna' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',


        ];
    }
    public function rulesCreaDesparacitacion()
    {
        return [
            'EdadEnDesparacitacion' => 'required|string|max:10',
            'PesoEnDesparacitacion' => 'required|string|max:10',
            'ProximaFechaDesparacitacion' => 'required|date',
            'ProductoDosis' => 'required',
            'PrecioDesparacitacion' => 'required|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
        ];
    }
    public function rulesCrearEspecie()
    {
        return [
            'NuevaEspecie' => 'required|string|max:125',


        ];
    }
    public function rulesCrearColor()
    {
        return [
            'NuevoColor' => 'required|string|max:125',


        ];
    }
    public function rulesCirugias()
    {

        return [
            'FC' => 'nullable|string|max:49',
            'FR' => 'nullable|string|max:49',
            'tem' => 'nullable|string|max:49',
            'MM' => 'nullable|string|max:49',
            'TLLC' => 'nullable|string|max:49',
            'SOPO2' => 'nullable|string|max:49',
            'Valoracion' => 'nullable|string|max:499',



        ];
    }
    public function rulesCirugiasPre()
    {

        return [
            'mg' => 'nullable|string|max:19',
            'ml' => 'nullable|string|max:19',
            'via' => 'nullable|string|max:19',
            'observaciones' => 'nullable|string|max:299',
            'num' => 'nullable',




        ];
    }

    public function rulesCrearRaza()
    {
        return [
            'NuevaRaza' => 'required|string|max:125',


        ];
    }
    public function rulesEditarCliente()
    {
        return [
            'DomicilioClienteEdit' => 'required|string|max:125',
            'ExpedidoClienteEdit' => 'required|string|max:10',
            'CiClienteEdit' => 'required|string|max:20',
            'TelefonoClienteEdit' => 'required|string|max:20',
            'ApellidoClienteEdit' => 'required|string|max:55',
            'NombreClienteEdit' => 'required|string|max:55',
            'EditarCorreo' => 'required|string|email|max:100',
        ];
    }

    public function rulesCrearMascota()
    {
        return [
            'NombreMascota' => 'required|string|max:55',
            'EspecieMascota' => 'required|not_in:CrearEspecie',
            'RazaMascota' => 'required',
            'SexoMascota' => 'required|string',
            'EsterilizadoMascota' => 'required',
            'EdadMascota' => 'required|string|max:254',
            'ClienteMascota' => 'required',
            'ColorMascota' => 'required',

        ];
    }
    public function validareditarmascota()
    {
        return [
            'NombreMascota' => 'required|string|max:55',
            'EspecieMascota' => 'required|not_in:CrearEspecie',
            'RazaMascota' => 'required',
            'SexoMascota' => 'required|string',
            'EsterilizadoMascota' => 'required',
            'EdadMascota' => 'required|string|max:254',
            'ClienteMascota' => 'required',
            'ColorMascota' => 'required',
            'rutaImagenfinalMascota' => 'nullable',

        ];
    }
    public function rulesCrearConsultas()
    {
        $rules = [
            /* 'MotivoDeAtencion' => 'required|string|max:4900',
            'AnamensisDeMascota' => 'required|string|max:4900',
            'Precio' => 'required|numeric|regex:/^[\d]{0,9}(\.[\d]{1,2})?$/',
            'TllcMascota' => 'required|string|max:4900',
            'MmDeMascota' => 'required|string|max:54',
            'Past' => 'nullable|string|max:54',
            'Pad' => 'nullable|string|max:54',
            'Pam' => 'nullable|string|max:54',
            'PulsoDeLaMascota' => 'nullable|string|max:54',
            'Dht' => 'nullable|string|max:54',
            'Peso' => 'required|string|max:54',
            'ConstanteVitalFcDeMascota' => 'required|string|max:54',
            'ConstanteVitalFrDeMascota' => 'required|string|max:54',
            'ConstanteVitalTemperaturaDeMascota' => 'required|string|max:54',
            'ConstanteVitalTemperaturaDeMascota' => 'required|string|max:54',
            'Precio' => 'required|numeric|regex:/^[\d]{0,9}(\.[\d]{1,2})?$/',*/
            'MotivoDeAtencion' => 'nullable|string|max:4900',
            'AnamensisDeMascota' => 'nullable|string|max:4900',
            'Diagnosticoconsulta' => 'nullable|string|max:1999',
            'PrecioConsulta' => 'nullable|numeric|regex:/^[\d]{0,7}(\.[\d]{1,2})?$/',
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
            // 'Precio' => 'nullable|numeric|between:0,999999.99',
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
    public function limpiarcamara()
    {

        //$this->limpiarproducto();
        $this->emit('cerrarmodalcamara');
        $this->campoImagenHabilitado = false;
        $this->emit('AbrirModalConsultas');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    //FUNCION CAMBIAR ESTADO CLIENTE
    public function cambiarestadocliente($clienteid)
    {
        $cliente = Clientes::find($clienteid);

        if ($cliente) {

            if ($cliente->estado == 'activo') {
                $cliente->estado = 'inactivo';
                $cliente->save();
                $this->emit('alert', 'Se cambio el estado del cliente con éxito');
            } elseif ($cliente->estado == 'inactivo') {
                $cliente->estado = 'activo';
                $cliente->save();
                $this->emit('alert', 'Se cambio el estado del cliente con éxito');
            }
        }
    }
    //FUNCION ELIMINAR CLIENTE
    public function eliminarcliente($id)
    {
        $cliente = Clientes::find($id);
        if ($cliente) {
            $cliente->estado = 'eliminado';
            $cliente->save();
        }
    }


    //FUNCION CREAR CLIENTE
    public   function GuardarCliente()
    {
        $this->operation = "crearcliente";
        $this->validate();

        $this->guardardbcliente();
        $this->limpiarmodal();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalcrearclientee');
    }
    public function guardardbcliente()
    {
        Clientes::create([
            'nombre' => $this->NombreCliente,
            'apellidos' => $this->ApellidoCliente,
            'telefono' => $this->TelefonoCliente,
            'ci' => $this->CiCliente,
            'expedido' => $this->ExpedidoCliente,
            'domicilio' => $this->DomicilioCliente,
            'correo' => $this->Correo,
            'codigo' => 'DGC-' . $this->CiCliente,
            'estado' => 'activo',


        ]);
    }
    public function limpiarmodal()
    {
        $this->reset(['NombreCliente', 'Correo', 'ApellidoCliente', 'TelefonoCliente', 'CiCliente', 'ExpedidoCliente', 'DomicilioCliente']);
        $this->resetValidation();
    }
    public $idClienteEditar, $EditarCorreo, $DomicilioClienteEdit, $ExpedidoClienteEdit,
        $CiClienteEdit, $TelefonoClienteEdit, $estado2,
        $ApellidoClienteEdit, $NombreClienteEdit;


    public function updatedSeleccionTipoDeArchivo()
    {
        $this->ArchivoDelEstudio = null;
    }
    public function editarcliente($id)
    {
        $cliente = Clientes::find($id);

        $this->idClienteEditar = $id;
        $this->DomicilioClienteEdit = $cliente->domicilio;
        $this->ExpedidoClienteEdit = $cliente->expedido;
        $this->CiClienteEdit = $cliente->ci;
        $this->TelefonoClienteEdit = $cliente->telefono;
        $this->ApellidoClienteEdit = $cliente->apellidos;
        $this->NombreClienteEdit = $cliente->nombre;
        $this->EditarCorreo = $cliente->correo;
        $this->estado2 = $cliente->estado2;
        $this->emit('abrirmodaleditarcliente');
    }
    public  function GuardarClienteEditado()
    {
        $this->operation = "guardareditarcliente";
        $this->validate();
        $cliente = Clientes::find($this->idClienteEditar);
        $cliente->nombre = $this->NombreClienteEdit;
        $cliente->apellidos = $this->ApellidoClienteEdit;
        $cliente->telefono = $this->TelefonoClienteEdit;
        $cliente->ci = $this->CiClienteEdit;
        $cliente->expedido = $this->ExpedidoClienteEdit;
        $cliente->domicilio = $this->DomicilioClienteEdit;
        $cliente->correo = $this->EditarCorreo;
        $cliente->codigo = 'DGC-' . $this->CiClienteEdit;
        $cliente->update();

        $this->emit('cerrarmodaleditarcliente');
        $this->limpiarmodalEditar();
        $this->emit('alert', 'El cliente ' . $cliente->nombre . ' fue editado exitosamente');
    }
    public  function limpiarmodalEditar()
    {
        $this->reset(['EditarCorreo', 'DomicilioClienteEdit', 'ExpedidoClienteEdit', 'CiClienteEdit', 'TelefonoClienteEdit', 'ApellidoClienteEdit', 'NombreClienteEdit']);
        $this->resetValidation();
    }


    //FUNCIONES PARA MASCOTAS
    //CREAR MASCOTA
    public $NombreMascota, $EspecieMascota, $PesoMascota, $ColorMascota, $RazaMascota, $SexoMascota, $EsterilizadoMascota = 0, $EdadMascota, $ClienteMascota, $NombreCompletoDeCliente;
    public function crearmascota($user_id)
    {


        $cliente = Clientes::find($user_id);
        $this->NombreCompletoDeCliente = $cliente->nombre . ' ' . $cliente->apellidos;

        $this->ClienteMascota = $user_id;
        $this->emit('AbrirModalCrearMascota');
    }

    public  function GuardarMascota()
    {
        $this->operation = "crearMascota";
        $this->validate();

        if ($this->EsterilizadoMascota == 1) {
            $mascotaesterilizadoa = 'SI';
        } elseif ($this->EsterilizadoMascota == 0) {
            $mascotaesterilizadoa = 'NO';
        }
        $macota_creada = Mascotas::create([
            'nombre' => $this->NombreMascota,
            'especie_id' => $this->EspecieMascota,
            'raza_id' => $this->RazaMascota,
            'sexo' => $this->SexoMascota,
            'esterilizado' => $mascotaesterilizadoa,
            'edad_mascota' => $this->EdadMascota,
            'cliente_id' => $this->ClienteMascota,
            'color_id' => $this->ColorMascota,
            'peso' => $this->PesoMascota,
            'imagen' => $this->rutaImagenfinalMascota,
            'estado' => 'activo',
        ]);
        $this->emit('cerrarModarCrearMascota');
        $this->emit('AbrirModalVerMascotas');

        $this->limpiarModalCrearMascota();
        $this->emit('alert', 'Se agrego la mascota ' . $macota_creada->nombre);
    }
    public $idmascotaedit;
    public function editarmascota($id)
    {

        $mascota = Mascotas::find($id);

        $this->idmascotaedit = $id;
        $this->NombreMascota = $mascota->nombre;
        $this->EspecieMascota = $mascota->especie_id;
        $this->RazaMascota = $mascota->raza_id;
        $this->ColorMascota = $mascota->color_id;
        $this->SexoMascota = $mascota->sexo;
        if ($mascota->esterilizado == 'SI') {
            $this->EsterilizadoMascota = 1;
        } elseif ($mascota->esterilizado == 'NO') {
            $this->EsterilizadoMascota = 0;
        }


        $this->EdadMascota = $mascota->edad_mascota;


        $this->emit('CerrarModalVerMascotas');
        $this->emit('AbrirModalCrearMascota');
    }

    public function GuardarEditarMascota()
    {

        $this->operation = "guardareditarmascota";
        $this->validate();
        if ($this->EsterilizadoMascota == 1) {
            $mascotaesterilizadoa = 'SI';
        } elseif ($this->EsterilizadoMascota == 0) {
            $mascotaesterilizadoa = 'NO';
        }
        $mascota = Mascotas::find($this->idmascotaedit);
        $mascota->nombre = $this->NombreMascota;
        $mascota->especie_id = $this->EspecieMascota;
        $mascota->raza_id = $this->RazaMascota;
        $mascota->color_id = $this->ColorMascota;
        $mascota->sexo = $this->SexoMascota;
        $mascota->esterilizado = $mascotaesterilizadoa;

        $mascota->edad_mascota = $this->EdadMascota;
        if ($this->rutaImagenfinalMascota) {
            $mascota->imagen = $this->rutaImagenfinalMascota;
        }

        $mascota->update();

        $this->emit('cerrarModarCrearMascota');
        $this->emit('AbrirModalVerMascotas');
        $this->limpiarModalCrearMascota();
        $this->emit('alert', 'El cliente ' . $mascota->nombre . ' fue editado exitosamente');
    }
    public function limpiarModalCrearMascota()
    {
        $this->reset([
            'idmascotaedit', 'PesoMascota', 'rutaImagenfinalMascota', 'ColorMascota', 'NombreMascota', 'EspecieMascota', 'RazaMascota', 'SexoMascota', 'EsterilizadoMascota', 'EdadMascota'
        ]);
        $this->gotoPage(1, 'mascotas_page');
        $this->resetValidation();
    }
    //VER CRUD DE MASCOTAS
    public $ListadoDeMascotas = [];
    public function VerMascotas($user_id)
    {

        $cliente = Clientes::find($user_id);
        $this->NombreCompletoDeCliente = $cliente->nombre . ' ' . $cliente->apellidos;
        $this->ClienteMascota = $user_id;

        $this->emit('AbrirModalVerMascotas');
    }
    //FUNCION PARA REDIRECCIONAR AL MODAL DE AGREGAR MASCOTA DESDE LISTA DE MASCOTAS
    public function AgregarMascotaDesdeModalDeMascotas()
    {
        $this->emit('CerrarModalVerMascotas');
        $this->crearmascota($this->ClienteMascota);
    }
    public $verhistorial = 'listadomascotas';
    public   function VerHistorialClinico()
    {
        $this->verhistorial = 'listadohistorial';
    }
    public   function CerrarHistorialClinico()
    {
        $this->verhistorial = 'listadomascotas';
    }
    public   function CrearHistorialClinico()
    {
        $this->verhistorial = 'crearhistorial';
    }
    // TRATAMIENTOS
    public $tratamientos = [];
    public $lista;
    public function mount()
    {
        $this->lista = [];
        $this->tratamientos = [''];
    }

    public function addTratamiento()
    {
        $this->tratamientos[] = '';
    }

    public function removeTratamiento($index)
    {
        unset($this->tratamientos[$index]);
        $this->tratamientos = array_values($this->tratamientos);
    }
    public function EliminarMascota($mascota)
    {
        $mascota_unica = Mascotas::find($mascota);
        $mascota_unica->estado = 'eliminado';
        $mascota_unica->update();
    }
    public function CrearEspecie()
    {
        $this->operation = "CrearEspecie";
        $this->validate();
        $especie = Especies::create([
            'nombre' => $this->NuevaEspecie,
        ]);
        $this->EspecieMascota = $especie->id;
        $this->reset('NuevaEspecie');
        $this->emit('alert', 'NUEVA ESPECIE CREADA CON EXITO');
    }
    public function CancelarCrearEspecie()
    {
        $this->reset('NuevaEspecie', 'EspecieMascota');
    }
    public function CrearRaza()
    {
        $this->operation = "CrearRaza";
        $this->validate();
        $raza = Razas::create([
            'nombre' => $this->NuevaRaza,
        ]);
        $this->RazaMascota = $raza->id;
        $this->reset('NuevaRaza');
        $this->emit('alert', 'NUEVA RAZA CREADA CON EXITO');
    }
    public function CancelarCrearRaza()
    {
        $this->reset('NuevaRaza', 'RazaMascota');
    }
    public function CrearColor()
    {
        $this->operation = "CrearColor";
        $this->validate();
        $color = ColoresMascotas::create([
            'nombre' => $this->NuevoColor,
        ]);
        $this->ColorMascota = $color->id;
        $this->reset('NuevoColor');
        $this->emit('alert', 'NUEVO COLOR DE MASCOTA CREADA CON EXITO');
    }
    public function CancelarCrearColor()
    {
        $this->reset('NuevoColor', 'RazaMascota');
    }
    public $Raza, $Sexo, $Edad, $Especie, $MotivoDeAtencion, $mascota;
    public function crearhistorial($mascota)
    {
        $this->registroCompletodetodomascota = Mascotas::find($mascota);
        $this->tipo_historial = 'historial_clinico';
        $mascota = Mascotas::find($mascota);
        $this->nombreTipohistorial = 'CONSULTA';
        $this->mascota = $mascota->id;
        $this->Raza = $mascota->mascotas_razas->nombre;
        if ($mascota->sexo == 'M') {
            $this->Sexo = 'MACHO';
        } else {
            $this->Sexo = 'HEMBRA';
        }


        $this->Edad = $mascota->edad_mascota;
        $this->Especie = $mascota->mascotas_especies->nombre;
        $persona = Clientes::find($mascota->cliente_id);
        $this->NroDeHistorialDeMascota = 'DGC-' . $persona->ci;
        $this->emit('AbrirModalConsultas');
    }
    public $nombreTipohistorial;
    public function crearreconsulta($mascota)
    {
        $this->registroCompletodetodomascota = Mascotas::find($mascota);
        $this->tipo_historial = 'historial_clinico';
        $this->nombreTipohistorial = 'RECONSULTA';

        $mascota = Mascotas::find($mascota);
        $this->mascota = $mascota->id;
        $this->Raza = $mascota->mascotas_razas->nombre;
        if ($mascota->sexo == 'M') {
            $this->Sexo = 'MACHO';
        } else {
            $this->Sexo = 'HEMBRA';
        }


        $this->Edad = $mascota->edad_mascota;
        $this->Especie = $mascota->mascotas_especies->nombre;
        $persona = Clientes::find($mascota->cliente_id);
        $this->NroDeHistorialDeMascota = 'DGC-' . $persona->ci;
        $this->emit('AbrirModalConsultas');
    }

    public function CrearEstudio($mascota)
    {

        $this->registroCompletodetodomascota = Mascotas::find($mascota);
        $this->tipo_historial = 'estudio_complementario';
        $mascota = Mascotas::find($mascota);
        $this->mascota = $mascota->id;

        $this->emit('AbrirModalConsultas');
    }
    public $MascotaVacunas, $EdadEnVacunas, $PesoEnDesparacitacion,
        $VacunaAplicada, $ProximaFecha, $Veterinario, $EdadEnDesparacitacion,
        $Producto, $VacunaAnamensis, $VacunaRecomendacion, $ProximaFechaDesparacitacion, $VeterinarioDesparacitacion, $ProductoDosis, $VacunaFC, $VacunaFR, $VacunaT, $VacunaTllc, $VacunaPeso, $VacunaMM;
    public  function VerVacunas($mascota)
    {
        $this->registroCompletodetodomascota = Mascotas::find($mascota);
        $this->MascotaVacunas = $mascota;
        $this->emit('abrirmodalvervacunas');
    }
    public  function GuardaVacuna()
    {
        $this->operation = "guardarvacuna";
        $this->validate();

        $NuevaVacuna = Vacunas::create([
            'mascota_id' => $this->MascotaVacunas,
            'fecha' => date("Y-m-d"),
            'edad' => $this->EdadEnVacunas,
            'vacuna_aplicada' => $this->VacunaAplicada,
            'MM' => $this->VacunaMM,
            'PESO' => $this->VacunaPeso,
            'TLLC' => $this->VacunaTllc,
            'T' => $this->VacunaT,
            'FR' => $this->VacunaFR,
            'FC' => $this->VacunaFC,
            'proxima_fecha' => $this->ProximaFecha,
            'recomendacion' => $this->VacunaRecomendacion,
            'anamensis' => $this->VacunaAnamensis,
            'precio' => $this->PrecioVacuna,
            'veterinario' => Auth::user()->id,
            'user_id' => Auth::user()->id,

        ]);
        $this->emit('alert', 'NUEVA VACUNA AGREGADA CON ÈXITO');

        $this->reset('VacunaAplicada', 'VacunaAnamensis', 'VacunaRecomendacion', 'VacunaFC', 'VacunaTllc', 'VacunaT', 'VacunaFR', 'VacunaMM', 'VacunaPeso', 'VacunaTllc', 'EdadEnVacunas', 'ProximaFecha', 'Veterinario', 'PrecioVacuna');
    }
    public $IdVacuna, $FechaVacuna;
    public function EditarVacuna(Vacunas $vacuna)
    {
        $this->IdVacuna = $vacuna->id;
        $this->FechaVacuna = $vacuna->fecha;
        $this->EdadEnVacunas = $vacuna->edad;
        $this->VacunaAplicada = $vacuna->vacuna_aplicada;
        $this->VacunaMM = $vacuna->MM;
        $this->VacunaPeso = $vacuna->PESO;
        $this->VacunaTllc = $vacuna->TLLC;
        $this->VacunaT = $vacuna->T;
        $this->VacunaFR = $vacuna->FR;
        $this->VacunaFC = $vacuna->FC;
        $this->VacunaAnamensis = $vacuna->anamensis;
        $this->VacunaRecomendacion = $vacuna->recomendacion;
        $this->ProximaFecha = $vacuna->proxima_fecha;
        $this->PrecioVacuna = $vacuna->precio;
    }

    public function CancelarGuardaVacuna()
    {
        $this->reset(
            'IdVacuna',
            'FechaVacuna',
            'EdadEnVacunas',
            'VacunaAplicada',
            'VacunaRecomendacion',
            'VacunaAnamensis',
            'VacunaMM',
            'VacunaPeso',
            'VacunaTllc',
            'VacunaT',
            'VacunaFR',
            'VacunaFC',
            'ProximaFecha',
            'PrecioVacuna',
        );
    }
    public  function GuardaEditarVacuna()
    {
        $this->operation = "guardarvacuna";
        $this->validate();
        $vacuna = Vacunas::find($this->IdVacuna);
        $vacuna->fecha = $this->FechaVacuna;
        $vacuna->edad = $this->EdadEnVacunas;
        $vacuna->vacuna_aplicada = $this->VacunaAplicada;
        $vacuna->MM = $this->VacunaMM;
        $vacuna->PESO = $this->VacunaPeso;
        $vacuna->TLLC = $this->VacunaTllc;
        $vacuna->T = $this->VacunaT;
        $vacuna->FR = $this->VacunaFR;
        $vacuna->anamensis = $this->VacunaAnamensis;
        $vacuna->recomendacion = $this->VacunaRecomendacion;
        $vacuna->FC = $this->VacunaFC;
        $vacuna->proxima_fecha = $this->ProximaFecha;
        $vacuna->precio = $this->PrecioVacuna;
        $vacuna->update();

        $this->emit('alert', ' VACUNA EDITADA CON ÈXITO');
        $this->CancelarGuardaVacuna();
    }
    public  function GuardaDesparacitacion()
    {
        $this->operation = "guardardesparacitacion";
        $this->validate();

        $NuevaVacuna = Desparacitaciones::create([
            'mascota_id' => $this->MascotaVacunas,
            'fecha' => date("Y-m-d"),
            'edad' => $this->EdadEnDesparacitacion,
            //'producto_id' => $this->Producto,
            //'producto_id' => 1,
            'peso' => $this->PesoEnDesparacitacion,
            'proxima_fecha' => $this->ProximaFechaDesparacitacion,
            'precio' => $this->PrecioDesparacitacion,
            'id_producto2' => $this->ProductoDosis,
            'veterinario' => Auth::user()->id,
            'user_id' => Auth::user()->id,

        ]);
        $this->emit('alert', 'NUEVA DESPARACITACIÓN AGREGADA CON EXITO');

        $this->reset('EdadEnDesparacitacion', 'ProductoDosis', 'PesoEnDesparacitacion', 'ProximaFechaDesparacitacion', 'VeterinarioDesparacitacion');
    }
    public function CancelarVacunas()
    {
        $this->gotoPage(1, 'vacunas_page');
        $this->gotoPage(1, 'desparacitacion_page');
    }

    public $historial_id_selected, $archivo_anterior;

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
        $this->AnamensisDeMascota = $texto;
    }

    public function resultadoReconocimientoMotivoConsulta($texto)
    {
        $this->MotivoDeAtencion = $texto;
    }

    public function comenzarReconocimientoDiagnostico()
    {
        $this->emit('ReconocerDiagnostico');
    }
    public function resultadoReconocimientoDiagnostico($texto)
    {
        $this->Diagnosticoconsulta = $texto;
    }
    public function comenzarReconocimientoRecomendacione()
    {
        $this->emit('ReconocerRecomendaciones');
    }
    public function resultadoReconocimientoRecomendacione($texto)
    {
        $this->Recomendacionconsulta = $texto;
    }
    public $PrecioConsulta;
    public function guardarhistorialclinico()
    {
        $this->operation = "CrearConsulta";
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

        if ($this->nombreTipohistorial == 'CONSULTA') {

            $tipohistorial = 1;
        } elseif ($this->nombreTipohistorial == 'RECONSULTA') {

            $tipohistorial = 10;
        }
        if ($this->PrecioConsulta == null) {
            $precionuevo = 0;
        } else {
            $precionuevo = $this->PrecioConsulta;
        }
        $crearhistorial = Historias_clinico::create([
            'precio' => $precionuevo,
            'mascota_id' => $this->mascota,
            'tipo_historial_id' => $tipohistorial,
            'anamensis' => $this->AnamensisDeMascota,

            'user_id' => $usuario->id,

            'actitud' => $actitud,
            'tllc' => $this->TllcMascota,
            'conducta' => $conducta,
            'esta_nutricional' => $estadonutricional,
            'mm' => $this->MmDeMascota,
            'const_v_fc' => $this->ConstanteVitalFcDeMascota,
            'const_v_fr' => $this->ConstanteVitalFrDeMascota,
            'const_v_t' => $this->ConstanteVitalTemperaturaDeMascota,
            'motivo_atencion' => $this->MotivoDeAtencion,
            'Past' => $this->Past,
            'Pad' => $this->Pad,
            'Pam' => $this->Pam,
            'Pulso' => $this->PulsoDeLaMascota,
            'Dht' => $this->Dht,
            'Peso' => $this->Peso,
            'recomendacion' => $this->Recomendacionconsulta,
            'diagnostico' => $this->Diagnosticoconsulta,
            'capa_piel' => $capadepiel,


        ]);

        $this->limpiarmodalhistorial();
        $this->emit('cerrarmodalhistorial');

        redirect('admin/mascotas-historial/' . $crearhistorial->mascota_id);
        $this->emit('alert', 'consulta guardada con exito');
    }
    public $TipoDeEstudioComplementario, $SeleccionTipoDeArchivo, $ArchivoDelEstudioPdf, $ArchivoDelEstudioImagen, $OtraCapaDePielDeMascota, $ArchivoDelEstudio, $SubirFichaClinica = false, $SubirRecomendacionesOperatorias = false, $ArchivoFichaClinicaCirugia, $ArchivoRecomentacionesOperatorias, $PesoIntenacion, $FechaIngresoInternacion;
    public   $rutaImagenfinal, $campoImagenHabilitado, $Imagenproducto, $FechaDeEutanacia, $RazonDeEutanacia, $SubirConcentimientoInformado = false, $ArchivoConcentimientoInformado, $SubirAutorizacionDeSedacion = false, $ArchivoAutorizacionDeSedacion;

    public function limpiarmodalhistorial()
    {
        $this->reset([

            'TipoDeEstudioComplementario', 'OtraCapaDePielDeMascota', 'ArchivoDelEstudio', 'SubirFichaClinica', 'SubirRecomendacionesOperatorias', 'ArchivoFichaClinicaCirugia', 'SeleccionTipoDeArchivo', 'ArchivoDelEstudioPdf', 'ArchivoDelEstudioImagen', 'rutaImagenfinal',
            'ArchivoRecomentacionesOperatorias', 'PesoIntenacion', 'FechaDeEutanacia', 'FechaIngresoInternacion', 'RazonDeEutanacia', 'SubirConcentimientoInformado',
            'ArchivoConcentimientoInformado', 'SubirAutorizacionDeSedacion', 'ArchivoAutorizacionDeSedacion', 'ActitudDeMascota', 'ActitudDeMascotaOtraOpcion', 'TllcMascota',
            'tipo_historial', 'ConductaDeMascota', 'OtraOpcionConductaDeMascota', 'EstadoNutricionalDeMascota', 'EstadoNutricionalDeMascotaOtraOpcion', 'MmDeMascota',
            'ConstanteVitalFcDeMascota', 'PrecioConsulta', 'ArchivoDelEstudioImagenColeccion', 'Diagnosticoconsulta', 'ConstanteVitalTemperaturaDeMascota', 'CapaDePielDeMascota', 'NroDeHistorialDeMascota', 'AnamensisDeMascota', 'Recomendacionconsulta', 'Precio'
        ]);
        $this->resetValidation();
        #$this->resetPage();
    }

    //------------------------------------------------------- TODO MOLQUI ------------------------------------------------------------------------------------------------------------------------------------------------------
    public $conta = 1;
    //-------------------------------
    public $registro_completo, $id_masco, $operationss, $descripcion, $cirugia_id, $costocirugia, $asa;
    public $archivosPdfciru, $pesocirugia;
    // todo para crear cirugias -------------------------------------------------------------------------
    public function validartodocirugi()
    {
        return [
            'descripcion' => 'required', 'costocirugia' => 'required|numeric', 'asa' => 'required', 'pesocirugia' => 'required'
        ];
    }
    public function limpiarmodalcirugia()
    {
        $this->reset(['descripcion', 'costocirugia', 'asa', 'pesocirugia', 'id_cirugiaEdita']);
        $this->emit("cerrarmodalcirugia");
        $this->reset(['id_cirugiaEdita']);
    }
    public function GuardarCirugia()
    {
        $this->operation = "nuevo";
        $this->validate();
        $this->guardardatosBDcirugia();
        $this->emit("alert", "CIRUGIA CREADA");
        $this->limpiarmodalcirugia();
    }

    public function guardardatosBDcirugia()
    {
        $Id_user = Auth::id();
        Cirugias::create([
            'id_mascota' =>  $this->id_masco,
            'id_usuario' => $Id_user,
            'descripcion' =>  $this->descripcion,
            'asa' =>  $this->asa,
            'total' =>  $this->costocirugia,
            'peso' =>  $this->pesocirugia,
        ]);
    }
    public function BorrarCirugia($id_datocit)
    {
        $registro = Cirugias::find($id_datocit);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
            // $this->emit('alert', 'Se Elimino con exito');
        }
    }
    public $id_cirugiaEdita;
    public function GuardarCirugiaEditarAbrir($id_cir)
    {
        $this->registro_completo = Mascotas::find($this->id_masco);
        $registro = Cirugias::find($id_cir);
        $this->id_cirugiaEdita = $id_cir;
        $this->descripcion = $registro->descripcion;
        $this->asa = $registro->asa;
        $this->costocirugia = $registro->total;
        $this->pesocirugia = $registro->peso;

        $this->emit("abrirmodalcirugia");
    }
    public function GuardarCirugiaeditarf()
    {
        $registro = Cirugias::find($this->id_cirugiaEdita);
        if ($registro) {
            $registro->descripcion = $this->descripcion;
            $registro->asa = $this->asa;
            $registro->total = $this->costocirugia;
            $registro->peso =   $this->pesocirugia;
            $registro->save();
            $this->emit('alert', 'Se Elimino con exito');
            $this->limpiarmodalcirugia();
            $this->reset(['id_cirugiaEdita']);
        } else {
            $this->emit("alerterror", "Error: Imagenes Vacias");
        }
    }

    public function crearcirugias($mas_id)
    {
        //$this->emit("alert","hola miky".$mas_id);
        $this->registroCompletodetodomascota = Mascotas::find($mas_id);
        $this->id_masco = $mas_id;
        $this->registro_completo = Mascotas::find($mas_id);
        $this->emit("abrirmodalcirugiapre");
    }
    public function Crearcirugiamascota()
    {
        // $this->registro_completo = Mascotas::find($this->id_masco)->toArray();  dd($this->registro_completo);
        $this->registro_completo = Mascotas::find($this->id_masco);
        $this->emit("abrirmodalcirugia");
    }
    public function CerrarModalPrincipal()
    {
        $this->reset(['id_masco', 'cirugia_id', 'registro_completo', 'costocirugia', 'archivosPdfciru']);
        // $this->limpiarmodaldatoscirugia();
        //$this->limpiarmodalprecirugia();
        $this->emit("cerrarmodalcirugiapre");
    }
    public function limpiartortododatoscirugiaf()
    {
        $this->limpiarmodaldatoscirugia();
        $this->limpiarmodalprecirugia();
    }
    //----------------------------------------------------------------------------------------------------
    // todo para crear datos cirugias -------------------------------------------------------------------------
    public $Hora, $FC, $FR, $tem, $MM, $TLLC, $SOPO2, $num, $Valoracion;
    public function limpiarmodaldatoscirugia()
    {
        $this->reset(['FC', 'FR', 'tem', 'MM', 'TLLC', 'SOPO2', 'num',  'Valoracion']);
        $this->resetValidation();
    }
    public function validartododatoscirugi()
    {
        return [
            //  'FC' => 'required', 'FR' => 'required', 'tem' => 'required',
            // 'MM' => 'required', 'TLLC' => 'required', 'SOPO2' => 'required'
        ];
    }
    public function GuardarDatosCirugia($nu, $id_ciru)
    {
        // $this->cirugia_id = $id_ciru;
        // $this->num = $nu;
        $this->operation = "datoscirugia";
        $this->validate();
        CirugiasDatos::create([
            'cirugia_id' =>  $id_ciru,
            'hora' =>  date('H:i:s'), 'FC' =>  $this->FC, 'FR' =>  $this->FR,
            'Tem' =>  $this->tem, 'MM' =>  $this->MM, 'TLLC' =>  $this->TLLC,
            'sopo2' =>  $this->SOPO2, 'total' =>  $nu, 'valoracion' =>  $this->Valoracion,
        ]);
        // $this->guardardatosBDdatoscirugia();
        $this->emit("alert", "CIRUGIA CREADA");
        // $this->limpiarmodaldatoscirugia();
        $this->reset(['FC', 'FR', 'tem', 'MM', 'TLLC', 'SOPO2',  'Valoracion']);
    }
    public function guardardatosBDdatoscirugia()
    {

        CirugiasDatos::create([
            'cirugia_id' =>  $this->cirugia_id,
            'hora' =>  date('H:i:s'), 'FC' =>  $this->FC, 'FR' =>  $this->FR,
            'Tem' =>  $this->tem, 'MM' =>  $this->MM, 'TLLC' =>  $this->TLLC,
            'sopo2' =>  $this->SOPO2, 'total' =>  $this->num, 'valoracion' =>  $this->Valoracion,
        ]);
    }
    public function BorrarDatosCirugia($id_datocit)
    {
        $registro = CirugiasDatos::find($id_datocit);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
            $this->emit('alert', 'Se Elimino con exito');
        }
    }
    // todo para crear datos cirugias -------------------------------------------------------------------------
    public  $medicamento, $medicamento2, $mg, $ml, $via, $observaciones, $bandera = true;
    public function obtenerHora2()
    {
    }
    public function validartodoprecirugi()
    {
        return [
            //'medicamento' => 'required', 'mg' => 'required', 'ml' => 'required', 'via' => 'required'
        ];
    }
    public function limpiarmodalprecirugia()
    {
        $this->reset(['medicamento', 'medicamento2', 'mg', 'ml', 'via', 'observaciones', 'operation']);
        $this->resetValidation();
    }
    public function GuardarpreOperatorio($nu, $id_ciru)
    {
        $this->operation = "datoscirugiapreo";
        $this->validate();
        $this->cirugia_id = $id_ciru;
        $this->num = $nu;

        $this->guardardatosBDpreoperacion();
        $this->emit("alert", "preoperatorio creado");
        $this->limpiarmodalprecirugia();
    }
    public function guardardatosBDpreoperacion()
    {

        $medi = "sin datos";
        if ($this->medicamento && $this->medicamento != 'Otros') {
            $medi = $this->medicamento;
        } elseif ($this->medicamento2) {
            $medi = $this->medicamento2;
        }
        CirugiasPre::create([
            'cirugia_id' =>  $this->cirugia_id, 'detalle' =>  $medi,
            'hora' => date('H:i:s'), 'mg' =>  $this->mg, 'ml' =>  $this->ml,
            'via' =>  $this->via, 'observaciones' =>  $this->observaciones, 'tipo' =>  $this->num
        ]);
    }
    public function BorrarpreCirugia($id_datocit)
    {
        $registro = CirugiasPre::find($id_datocit);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
            $this->emit('alert', 'Se Elimino con exito');
        }
    }

    public function GuardarTareaPDF($id_cir)
    {
        // Validar si se han enviado archivos PDF
        if ($this->archivosPdfciru  && $id_cir) {
            foreach ($this->archivosPdfciru as $archivo) {
                $extension = $archivo->getClientOriginalExtension();
                if (!in_array($extension, ['jpg', 'pdf', 'png', 'jpeg'])) {
                    $this->addError('archivosPdfciru', 'Todos los archivos deben ser PDF o imágenes.');
                    return;
                }
            }
            $this->validate([
                'archivosPdfciru' => 'required|array|min:1', // Se espera que sea un array con al menos un elemento
                'archivosPdfciru.*' => 'mimes:pdf,jpg,png,jpeg|max:20000', // Cada archivo debe ser un PDF o una imagen y no mayor a 20 MB
            ], [
                'archivosPdfciru.required' => 'Debe seleccionar al menos un archivo.',
                'archivosPdfciru.*.mimes' => 'Todos los archivos deben ser PDF o imágenes (JPG, PNG, JPEG).',
                'archivosPdfciru.*.max' => 'Todos los archivos no deben ser mayores a 20 MB.'
            ]);

            // Iterar sobre los archivos y guardarlos en la base de datos
            foreach ($this->archivosPdfciru as $archivo) {
                $nombreArchivo = uniqid('archivo_tarea') . '.' . $archivo->getClientOriginalExtension();

                // Guardar el archivo en el almacenamiento y obtener la ruta
                $rutaArchivo = $archivo->storeAs('public/archivosPdfciru', $nombreArchivo);

                // Crear un nuevo registro en la base de datos
                Imagenes_cirgias::create([
                    'cirugia_id' => $id_cir,
                    'url' => '/storage/archivosPdfciru/' . $nombreArchivo,
                ]);
            }
            session()->flash('success', 'Los archivos PDF se han subido correctamente.');
            // Limpiar los archivos cargados
            $this->reset('archivosPdfciru');
            $this->emit('alert', 'Datos Alamcenados Con exito');
        } else {
            $this->emit("alerterror", "Error: Imagenes Vacias");
        }
    }
    public function LimpiarDatosimagenescirugia()
    {
        $this->reset('archivosPdfciru');
        $this->resetValidation(); // Esto limpiará la validación
        $this->emit('alert', 'Datos Limpiados con Exito');
        #  session()->forget('success');
        # $this->resetErrorBag();
    }
    public $registrosciruimg,  $idregistrosciruimg;
    public function VerImagenesCirugias($id_cir)
    {
        $this->idregistrosciruimg = $id_cir;
        $this->registrosciruimg = Imagenes_cirgias::where('cirugia_id', $id_cir)
            ->where('estado', '<>', 'eliminado')
            ->get();

        $this->emit('abrirmodalcirugiaimagen');
    }
    public function CerrarImagenesCirugias()
    {
        $this->reset('registrosciruimg');
        $this->emit('cerrarmodalcirugiaimagen');
    }
    public function BorrarImagen_cirugia($id_im)
    {
        $regisciruimg = Imagenes_cirgias::find($id_im);

        if ($regisciruimg) {
            $regisciruimg->estado = 'eliminado';
            $regisciruimg->save();
            $this->emit('alert', 'Se Elimino con exito');
        } else {
        }
        $this->registrosciruimg = Imagenes_cirgias::where('cirugia_id', $this->idregistrosciruimg)
            ->where('estado', '<>', 'eliminado')
            ->get();
    }


    //-------------------------------------todo farmacia -----------------------------------------------
    /*public $id_masfarma,$Searchproductof,$bloque=false,$registro_produf,$totalprecio=0;
    public function crearfarmacias($id_masco)
    {
        $this->id_masfarma=$id_masco;
        //$this->registro_completof=$id_masco;
        $this->emit("abrirmodalfarmaciaf");
    }
    public function cerarFarmacias()
    {
        $this->limpiarmodalbusquedaf();
        $this->emit("cerrarmodalfarmaciaf");
    }
    public function CargarDatosproductof($id_produ)
    {
        $registro_produf = Productos::find($id_produ);
        if ($registro_produf->stock < 1) {
            $this->emit("alerterror", "Error: Stock Vacío");
        } else {
            // Busca si el producto ya está en la lista
            $index = array_search($id_produ, array_column($this->lista, 'id'));
            if ($index !== false) {
                $this->emit("alerterror", "Error: El producto ya existe");
            } else {
                // Si el producto no está en la lista, lo agrega con cantidad 1
                $this->lista[] = ['id' => $id_produ, 
                'nombre' => $registro_produf->nombre, 'precio'=>$registro_produf->precio, 
                'preciom' => 0, 'tuni'=>$registro_produf->unidad_de_medida, 
                'cantidad' => 1,'stock'=>$registro_produf->stock,'total'=>0,'estado'=>0];
                //$this->emit("abrirmodalcarro");
            }
        }
        $this->reset(['Searchproductof']);
    }
    public function editarcarroventa($index)
    {
            $this->lista[$index]['estado']=0;
    }
    public function eliminarcarro($index)
    {
        unset($this->lista[$index]); // Eliminar el elemento del array en el índice proporcionado
    }
    public function validarcarroventa($index)
    {
        $cantidadIngresada = $this->lista[$index]['cantidad'];
        $stockDisponible = $this->lista[$index]['stock'];
        $preciom=$this->lista[$index]['preciom'];
        if ($cantidadIngresada > $stockDisponible ) {
            $this->emit('alerterror', 'La cantidad ingresada supera el stock disponible.');
        } elseif ($cantidadIngresada<1) {
            $this->emit('alerterror', 'El Cantidad tiene que ser mayor a 0');
        }
       elseif ($preciom<1) {
            $this->emit('alerterror', 'El precio tiene que ser mayor a 1 ');
        } else {
            $this->lista[$index]['estado']=1;
            $this->lista[$index]['total'] = $this->lista[$index]['cantidad'] * $this->lista[$index]['preciom'];
        }
    }
    public function venderProductos()
    {
        $this->emit("alert","realizando venta");
        $this->limpiarmodalbusquedaf();
    }
    public function limpiarmodalbusquedaf()
    {
        $this->reset(['id_masfarma','bloque','Searchproductof']);
        $this->lista = []; 
    }
    public $NuevoEstudio;
    public function CrearEstudioNuevo()
    {
        $this->operation='ValidarNuevoEstudio';
        $this->validate();

        $estudio = EstudiosComplementarios::create([
            'nombre' => strtoupper($this->NuevoEstudio),
            'descripcion' => strtoupper($this->NuevoEstudio),

        ]);
        $this->TipoDeEstudioComplementario=$estudio->id;
        $this->emit('alert','Nuevo estudio creado con éxito');
        $this->reset('NuevoEstudio');
    }
    public function CancelarCreaEstudio(){
        $this->reset('TipoDeEstudioComplementario','NuevoEstudio');
    }
    public function buscarCero()
    {
        return in_array(0, array_column($this->lista, 'estado'));
    }
    public function btncalularstok($id)
    {
        $produ = Productos::find($id);
        $stock = $this->obtenerStock($id);
        $produ->update([
            'stock' => $stock,
        ]);
    }
    public function vendercarro()
    {
        $hayCero = $this->buscarCero();
        if ($hayCero) {
            $this->emit('alerterror', 'Falta Validar Ventas');
        }
        else
        {
            $id_cli = $this->id_masfarma;
            $totalPrecio = array_sum(array_column($this->lista, 'total'));
                $venta = Ventas::create([
                    'cliente_id'   =>  $id_cli,
                    'usuario_id' =>Auth::user()->id,
                    'descripcion' => "todo en buen estado",
                    'total' =>  $totalPrecio
                ]);
           if($venta)
           {
            foreach ($this->lista as $producto) {
                    VentasProductos::create([
                        'producto_id' =>  $producto['id'],
                        'id_venta' =>  $venta->id,
                        'descripcion' => "todo en buen estado",
                        'cantidad' => $producto['cantidad'],
                        //'precio' => $registro->preciom,
                        'precio' =>$producto['preciom'],
                        'estado' => 'activo'
                    ]);
                    $this->btncalularstok($producto['id']);
                }
                $this->limpiarmodalbusquedaf();
                $this->emit("alert", "Productos vendidos con éxito");
                $this->emit("cerrarmodalfarmaciaf");
           }
            else{
                        $this->emit('alerterror', 'Error al realizar la venta');
            }
        }
    }
    public $ClienteParaDia=0,$MascotaeParaDia;
    public function SacarTotalDia( $cliente)
    {
        $this->ClienteParaDia = $cliente;
      
        $this->emit('AbrirModalPreciosTotal');
    }*/
    //-------------------------------------todo farmacia 2-----------------------------------------------
    public $id_masfarma, $Searchproductof, $bloque = false,
        $registro_produf, $totalprecio = 0, $id_productof, $UnidadFarmacia, $CostoFarmacia, $CantidadFarmacia;
    public function crearfarmacias($id_masco)
    {
        $this->id_masfarma = $id_masco;
        //$this->registro_completof=$id_masco;
        $this->emit("abrirmodalfarmaciaf");
    }
    public function CargarDatosproductof($id_produ)
    {
        $this->id_productof = $id_produ;
        $registro_produf = farmacias::find($id_produ);
        $this->Searchproductof = $registro_produf->nombre;
        $this->bloque = true;
    }
    public function crearProducto()
    {
        if ($this->Searchproductof) {

            farmacias::create([
                'nombre' =>  $this->Searchproductof,
            ]);
            $this->emit('alert', 'Producto creado con exito');
        } else {
            $this->emit('alerterror', 'Asigne un nombre al nuevo producto');
        }
    }
    public function ValidarNuevoVentaFar()
    {
        return [
            'UnidadFarmacia' => 'required|string',
            'CostoFarmacia' => 'required|numeric',
            'CantidadFarmacia' => 'required|numeric',
        ];
    }
    public function vendercarro()
    {
        if ($this->id_productof) {
            $this->operation = 'ValidarNuevoVentaFarmacia';
            $this->validate();
            farmaciasVentas::create([
                'mascota_id' =>  $this->id_masfarma,
                'farmacia_id' =>  $this->id_productof,
                'doctor_id' =>  Auth::user()->id,
                'unidad' =>  $this->UnidadFarmacia,
                'cantidad' =>  $this->CantidadFarmacia,
                'precio' =>  $this->CostoFarmacia,
            ]);
            $this->emit('alert', 'Venta creada con exito');
            $this->LimpiarDatosproductof();
        } else {
            $this->emit('alerterror', 'Asigne un nombre del producto');
        }
    }

    public function LimpiarDatosproductof()
    {
        $this->reset(['Searchproductof', 'CantidadFarmacia', 'CostoFarmacia', 'UnidadFarmacia', 'id_productof']);
        $this->bloque = false;
        $this->resetValidation();
    }
    public function cerarFarmacias()
    {
        $this->LimpiarDatosproductof();
        $this->emit("cerrarmodalfarmaciaf");
    }

    public function editarcarroventa($index)
    {
        $registro = farmaciasVentas::find($index);
        if ($registro) {
            /* $this->Searchproductof = $registro->id,
        $this->CantidadFarmacia
        $this->CostoFarmacia
        $this-> UnidadFarmacia
        $this->id_productof*/
        }
    }
    public function eliminarcarro($index)
    {
        $registro = farmaciasVentas::find($index);
        if ($registro) {
            $registro->estado = 'eliminado';
            $registro->save();
        }
    }

    public function validarcarroventa($index)
    {
        $cantidadIngresada = $this->lista[$index]['cantidad'];
        $stockDisponible = $this->lista[$index]['stock'];
        $preciom = $this->lista[$index]['preciom'];
        if ($cantidadIngresada > $stockDisponible) {
            $this->emit('alerterror', 'La cantidad ingresada supera el stock disponible.');
        } elseif ($cantidadIngresada < 1) {
            $this->emit('alerterror', 'El Cantidad tiene que ser mayor a 0');
        } elseif ($preciom < 1) {
            $this->emit('alerterror', 'El precio tiene que ser mayor a 1 ');
        } else {
            $this->lista[$index]['estado'] = 1;
            $this->lista[$index]['total'] = $this->lista[$index]['cantidad'] * $this->lista[$index]['preciom'];
        }
    }
    public function venderProductos()
    {
        $this->emit("alert", "realizando venta");
        $this->limpiarmodalbusquedaf();
    }
    public function limpiarmodalbusquedaf()
    {
        $this->reset(['id_masfarma', 'bloque', 'Searchproductof']);
        $this->lista = [];
    }

    //--------------------------------estudios -----------------------------------------------------------------
    public $NuevoEstudio;
    public function CrearEstudioNuevo()
    {
        $this->operation = 'ValidarNuevoEstudio';
        $this->validate();

        $estudio = EstudiosComplementarios::create([
            'nombre' => strtoupper($this->NuevoEstudio),
            'descripcion' => strtoupper($this->NuevoEstudio),

        ]);
        $this->TipoDeEstudioComplementario = $estudio->id;
        $this->emit('alert', 'Nuevo estudio creado con éxito');
        $this->reset('NuevoEstudio');
    }
    public function CancelarCreaEstudio()
    {
        $this->reset('TipoDeEstudioComplementario', 'NuevoEstudio');
    }


    public $ClienteParaDia = 0, $MascotaeParaDia;
    public function SacarTotalDia($cliente)
    {
        $this->ClienteParaDia = $cliente;

        $this->emit('AbrirModalPreciosTotal');
    }
    //---------------------------- todo poner en cola -----------------------------------

    public function ultima()
    {
        // Obtener la fecha actual
        $fechaActual = Carbon::now('America/La_Paz')->toDateString();
        // Buscar la última numeración para la fecha actual
        $ultimaNumeracion = Fichas::whereDate('created_at', $fechaActual)->max('numeracion');
        // Si no hay registros para la fecha actual, comenzar desde 1
        return $ultimaNumeracion ? $ultimaNumeracion + 1 : 1;
    }
    public function fponer_cola($id_m)
    {
        Fichas::create([
            'id_cliente' =>  $id_m,
            'numeracion' =>  $this->ultima(),
            'estado' => 'activo',
        ]);
        $fichaSta = new FichaStatusUpdated();
        event($fichaSta);
        $this->emit('alert', 'Cliente en Cola');
    }

    //--------------------

    //--------------------------------------------------------------------------------------------------------






    //---------------------------------------------------------------------------------------
    //FUNCIONES PARA INTERNACION

    public $MedicamentoMascota, $DosisEnMgMascota, $DosisEnMlMascota, $ViaMascota, $AdministradoMascota = 0, $DescripcionInternacion;
    public $Mascota_id;
    public function VerTInternacion($mascota)
    {
        $this->Mascota_id = $mascota;
        $this->emit('Abrirmodalinternacion');
    }
    public function CrearInternacion()
    {
        $NuevoTratamiento = Internacion::create([
            'mascota_id' => $this->Mascota_id,


            'user_id' => Auth::user()->id,

        ]);

        // $this->emit('Abrirmodaltratamiento');
    }

    //VARIABLES DE INTERNACION

    public $CFC, $CFR, $CTMM, $CTLMC, $CPulso;
    //------------------
    public function GuardarComentarioInternacion($internacionid)
    {
        $this->operation = 'validarcomentariointernacion';
        $this->validate();
        $NuevoTratamiento = ComentariosInternacion::create([
            'internacion_id' => $internacionid,
            'comentario' => $this->DescripcionInternacion,
            'fc' => $this->CFC,
            'fr' => $this->CFR,
            'tmm' => $this->CTMM,
            'tlmc' => $this->CTLMC,
            'pulso' => $this->CPulso,


            'user_id' => Auth::user()->id,

        ]);
        $this->reset('DescripcionInternacion', 'CPulso', 'CTLMC', 'CTMM', 'CFR', 'CFC');
    }
    public function GuardarMedicamentoInternacion($internacionid)
    {

        $this->operation = 'validarinternacionmedicamentos';
        $this->validate();
        $usuario = Auth::user();
        if ($this->AdministradoMascota == 1) {
            $Administrado = 'SI';
        } elseif ($this->AdministradoMascota == 0) {
            $Administrado = 'NO';
        }
        MedicamentosInternacion::create([

            'internacion_id' => $internacionid,
            'Medicamento' => $this->MedicamentoMascota,
            'dosis_mg' => $this->DosisEnMgMascota,
            'dosis_ml' => $this->DosisEnMlMascota,
            'via' => $this->ViaMascota,
            'administrado' => $Administrado,
            'hora' => date('h:i:s'),

            'user_id' => $usuario->id,
        ]);

        $this->reset('MedicamentoMascota', 'DosisEnMgMascota', 'DosisEnMlMascota', 'ViaMascota', 'AdministradoMascota');
    }
    public function comenzarReconocimiento()
    {
        $this->emit('Reconocer');
    }

    public function resultadoReconocimiento($texto)
    {
        $this->DescripcionInternacion .= ' ' . $texto;
    }
    public $CostoInternacion;
    public function NuevoCosto($internacion)
    {
        $this->operation = 'validarcostointernacion';
        $this->validate();
        $nuevoprecio = Internacion::find($internacion);
        $nuevoprecio->precio = $this->CostoInternacion;
        $nuevoprecio->update();
        $this->reset('CostoInternacion');
    }
    public function HistorialAntiguo($id_cli)
    {
        //$registro = Fichas::find($idf);

        $url = route('historialespx', [
            'id' => $id_cli
        ]);
        $this->emit('openNewTabssunic', ['url' => $url]);
    }
    public function CambiarEstadoclientef()
    {
        $cliente = Clientes::find($this->idClienteEditar);

        if ($cliente) {

            if ($cliente->estado2 == 'azul') {
                $cliente->estado2 = 'naranja';
                $cliente->save();
                $this->emit('alert', 'Se cambio el estado del cliente con éxito');
            } elseif ($cliente->estado2 == 'naranja') {
                $cliente->estado2 = 'azul';
                $cliente->save();
                $this->emit('alert', 'Se cambio el estado del cliente con éxito');
            }
            $this->emit('cerrarmodaleditarcliente');
            $this->limpiarmodalEditar();
        }
    }
    public $id_cliuni;
    //---------------------------------------------------------------



    public $rutaImagenfinalHistorial;
    public $imagennueva;
    public function cambiarCamaratMascota2()
    {
        $this->facingModeMascota = 'environment';
        $this->emit('refreshCamaraEstudio', $this->facingModeMascota);
    }

    public function cambiarCamaradEstudio()
    {
        $this->facingModeMascota = 'user';
        $this->emit('refreshCamaraEstudio', $this->facingModeMascota);
    }


    public function imagenCapturadaEstudio($imagenBase64)
    {
        $imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
        $nombreImagen = uniqid('imagen') . '.jpg';
        $rutaImagen = 'public/imagen_estudio/' . $nombreImagen;


        $imagenRedimensionada = Image::make($imagenBinaria)->resize(500, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg');


        Storage::put($rutaImagen, $imagenRedimensionada);

        $rutaImagenAnterior = str_replace('public', 'storage', $rutaImagen);

        $this->rutaImagenfinalHistorial = '/' . $rutaImagenAnterior;
        $this->emit('Abrirmodalestudios');
    }
    //NUEVA MANERA ESTUDIOS
    public function CrearEstudiocomple()
    {
        Historias_clinico::create([
            'mascota_id' => $this->mascota,
            'tipo_historial_id' => 2,
        ]);
        // $this->emit('alert','dasdsada');
    }
    public function TomarCapturaEstudio()
    {
        $this->emit('Cerrarmodalestudios');
        $this->emit('Abrirmodalestudioscaptura2');
    }

    public function eliminarfotoEstudio()
    {
        $this->reset('rutaImagenfinalHistorial');
    }
    public function GuardarImagenEstudio($hitorialid)
    {
        FotosEstudio::create([
            'historial_id' => $hitorialid,
            'imagen' => $this->rutaImagenfinalHistorial,
            'user_id' => Auth::user()->id,
        ]);
        $this->reset('rutaImagenfinalHistorial');
    }
    public function EliminarEstudio(Historias_clinico $historial)
    {
        $historial->estado = 'eliminado';
        $historial->update();
    }
    public function IngresarTipoEstudio(Historias_clinico $historial)
    {
        $this->operation = 'validarEstudioNuevo';
        $this->validate();

        $historial->estudio_complementario_id = $this->TipoDeEstudioComplementario;
        $historial->update();
    }
    public function NuevoCostoEstudio($internacion)
    {
        $this->operation = 'validarcostointernacion';
        $this->validate();
        $nuevoprecio = Historias_clinico::find($internacion);
        $nuevoprecio->precio = $this->CostoInternacion;
        $nuevoprecio->update();
        $this->reset('CostoInternacion');
    }

    public function borrarinternacionn(ComentariosInternacion $id)
    {
        $id->estado = "ELIMINADO";
        $id->update();
    }
    public function eliminarmedicamentoo(MedicamentosInternacion $id)
    {
        $id->estado = "ELIMINADO";
        $id->update();
    }

    public function borrardatosinternacion(Internacion $id)
    {
        $id->estado = "ELIMINADO";
        $id->update();
    }
    public $idinternacionupdate;
    public function EditarInternacion(ComentariosInternacion $id)
    {
        $this->idinternacionupdate = $id->id;
        $this->DescripcionInternacion = $id->comentario;
        $this->CFC = $id->fc;
        $this->CFR = $id->fr;
        $this->CTMM = $id->tmm;
        $this->CTLMC = $id->tlmc;
        $this->CPulso = $id->pulso;
    }
    public function CancelarUpdateInternacion()
    {
        $this->reset('idinternacionupdate', 'CFC', 'CFR', 'CTMM', 'CTLMC', 'CPulso', 'DescripcionInternacion');
    }
    public function GuardarComentarioInternacionUpdate()
    {


        $internacion = ComentariosInternacion::find($this->idinternacionupdate);
        $internacion->comentario = $this->DescripcionInternacion;
        $internacion->fc = $this->CFC;
        $internacion->fr = $this->CFR;
        $internacion->tmm = $this->CTMM;
        $internacion->tlmc = $this->CTLMC;
        $internacion->pulso = $this->CPulso;
        $internacion->update();
        $this->CancelarUpdateInternacion();

        $this->emit('alert', 'Se actualizo el registro con éxito');
    }
    //--------------------------MODULO DE CAJA
    public function crearcajanuevo()
    {
        $caja = Cajas::where('estado', 'activo')->first();
        if ($caja) {

            $this->addError('cajaexistente', 'YA EXISTE UNA CAJA ADMINISTRADA POR EL DOCTOR:');
        } else {
            $nuevacaja = Cajas::create([


                'encargado_id' => Auth::user()->id,
            ]);
            $this->emit('alert', 'Se hizo la apertura de caja por :');
        }
    }
    public function cerrarcajaanterior()
    {
        $caja = Cajas::where('estado', 'activo')->first();
        if ($caja->encargado_id ==  Auth::user()->id) {
            $caja->estado = 'terminado';
            $caja->update();
            $this->emit('alert', 'Se cerro  caja con exito');
        } else {
            $this->addError('cajaexistente', 'SOLO EL ENCARGADO PUEDE CERRAR LA CAJA');
        }
    }
    public $MontoPago, $TipoPago, $MotivoDePago;
    public function GuardarPago()
    {
        $this->operation = 'validarpago';
        $this->validate();
        $caja = Cajas::where('estado', 'activo')->first();
        if ($caja) {
            Cobros::create([
                'caja_id' => $caja->id,
                'costo' => $this->MontoPago,
                'tipo' => $this->TipoPago,
                'user_id' => Auth::user()->id,
                'cliente_id' => $this->ClienteParaDia,
                'motivo' => $this->MotivoDePago
            ]);
            $this->reset('MontoPago', 'TipoPago', 'MotivoDePago');
            $this->emit('alert', 'El pago fue registrado con exito');
        }
    }
    public $RazonGasto, $PrecioGasto;

    public function guardardescuento()
    {
        $this->operation = 'validardescuento';
        $this->validate();
        $caja = Cajas::where('estado', 'activo')->first();
        if ($caja) {
            Gastos::create([
                'caja_id' => $caja->id,
                'costo' => $this->PrecioGasto,
                'razon' => $this->RazonGasto,
                'user_id' => Auth::user()->id,
                # 'cliente_id' =>$this->ClienteParaDia
            ]);
            $this->reset('PrecioGasto', 'RazonGasto');
            $this->emit('alert', 'El gasto fue registrado con exito');
        }
    }
    //------------------------------------------
    public function LimpiarCaptura()
    {
        $this->reset('rutaImagenfinal', 'a');
    }

    //FUNCIONES PARA IMAGENES DE INTERNACION}

    //CREAR EUTANACIA



    public function CrearEutanacia($mascota)
    {
        $this->registroCompletodetodomascota = Mascotas::find($mascota);
        $this->tipo_historial = 'eutanacia';
        $mascota = Mascotas::find($mascota);
        $this->nombreTipohistorial = 'CONSULTA';
        $this->mascota = $mascota->id;
        // $this->Raza = $mascota->mascotas_razas->nombre;
        // if ($mascota->sexo == 'M') {
        //     $this->Sexo = 'MACHO';
        // } else {
        //     $this->Sexo = 'HEMBRA';
        // }


        // $this->Edad = $mascota->edad_mascota;
        // $this->Especie = $mascota->mascotas_especies->nombre;
        // $persona = Clientes::find($mascota->cliente_id);
        // $this->NroDeHistorialDeMascota = 'DGC-' . $persona->ci;
        $this->emit('AbrirModalConsultas');
    }

    public function GuardarEutanaciaNuevo()
    {

        if ($this->SeleccionTipoDeArchivo == 'imagen') {

            $this->operation = 'validareutanacianuevoimagen';
            $this->validate();


            $archivo = $this->ArchivoDelEstudio;
            $nombreArchivo = uniqid('archivo_eutanacia') . '.' . $archivo->getClientOriginalExtension();

            // Guardar el archivo en el almacenamiento
            $rutaArchivo = $archivo->storeAs('public/eutanacia', $nombreArchivo);
            $usuario = Auth::user();

            $historial = Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 9,
                'informe_de_eutanacia' => $this->RazonDeEutanacia,
                'fecha_de_eutanacia' => $this->FechaDeEutanacia,

                'imagen_eutanacia' => '/storage/eutanacia/' . $nombreArchivo,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
            ]);
            // FotosEstudio::create([
            //     'historial_id' => $historial->id,
            //     'imagen' => '/storage/estudio_complementario/' . $nombreArchivo,
            //     'user_id' => $usuario->id,
            // ]);
            $this->limpiarmodalhistorial();
            $this->emit('cerrarmodalhistorial');
            $this->emit('alert', 'Eutanacia guardada con exito');
        } elseif ($this->SeleccionTipoDeArchivo == 'usarcamara') {
            $this->operation = 'validareutanacianuevocamara';
            $this->validate();



            $usuario = Auth::user();

            $historial = Historias_clinico::create([
                'mascota_id' => $this->mascota,
                'tipo_historial_id' => 9,
                'informe_de_eutanacia' => $this->RazonDeEutanacia,
                'fecha_de_eutanacia' => $this->FechaDeEutanacia,
                'imagen_eutanacia' => $this->rutaImagenfinal,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
            ]);
            $this->limpiarmodalhistorial();
            $this->emit('cerrarmodalhistorial');
            $this->emit('alert', 'Eutanacia guardada con exito');
        } elseif ($this->SeleccionTipoDeArchivo == '') {
            $this->operation = 'validareutanacianuevovacio';
            $this->validate();
        }
    }
    public $ImagenesInternacion=[];
    public function GuardarImgenesInternacion($id)
    {
        $this->operation='validacionguardarimagenesinternacion';
        $this->validate();

        foreach ($this->ImagenesInternacion as $key => $img) {

            
            $archivo = $img;
            $nombreArchivo = uniqid('archivo_internacion') . '.' . $archivo->getClientOriginalExtension();

            
            $rutaArchivo = $archivo->storeAs('public/internacion', $nombreArchivo);
           

       
            ImagenesInternacion::create([
                'internacion_id' => $id,
                'imagen' => '/storage/internacion/' . $nombreArchivo,
            ]);
        }
        $this->reset('ImagenesInternacion');
        $this->emit('alert', 'Imagen guardada con éxito');
    }
    public $IdInternacion;
    public function VerImagenenesInternacion($id)
    {
        $this->IdInternacion=$id;
        $this->emit('Cerrarmodalinternacion');
       $this->emit('abrirmodalimageninter');
       
        
    }
    public function cerrarimagenesinternacion()
    {
       
        $this->emit('cerrarmodalimageninter');
       $this->emit('Abrirmodalinternacion');
       
        
    }

    public function render()
    {
        if ($this->id_cliuni) {
            $this->search = $this->id_cliuni;
        }
        $registro_completoprodu = $this->registro_produf;
        $registro_completof = Mascotas::find($this->id_masfarma);
        /*$productosfar = Productos::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->Searchproductof . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
         
            })
            ->orderBy('id', 'desc')
            ->paginate(3);*/
        $productosfar = farmacias::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->Searchproductof . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        $cirugiass = Cirugias::where('id_mascota', $this->id_masco)->where('estado', "activo")->get();
        $datoscirugiaspre = CirugiasDatos::where('total', 1)->where('estado', "activo")->get();
        $cirugiapreope = CirugiasPre::where('tipo', 1)->where('estado', "activo")->get();
        $datoscirugiaspre2 = CirugiasDatos::where('total', 2)->where('estado', "activo")->get();
        $cirugiapreope2 = CirugiasPre::where('tipo', 2)->where('estado', "activo")->get();
        $datoscirugiaspre3 = CirugiasDatos::where('total', 3)->where('estado', "activo")->get();
        $cirugiapreope3 = CirugiasPre::where('tipo', 3)->where('estado', "activo")->get();
        $farmaciaventas = farmaciasVentas::where('estado', '<>', 'eliminado')->get();
        if ($this->id_cliuni) {
            $clientes = Clientes::where('estado', '<>', 'eliminado')
                ->where(function ($query) {
                    $searchTerm =  $this->search;
                    $query->orWhere('id', 'LIKE', $searchTerm);
                })
                ->orderBy('id', 'desc')
                ->paginate(4);
        } else {
            $clientes = Clientes::where('estado', '<>', 'eliminado')
                ->where(function ($query) {
                    $searchTerm = '%' . $this->search . '%';
                    $query->orWhere('id', 'LIKE', $searchTerm);
                    $query->orWhere('nombre', 'LIKE', $searchTerm);
                    $query->orWhere('apellidos', 'LIKE', $searchTerm);
                    $query->orWhere('telefono', 'LIKE', $searchTerm);
                    $query->orWhere('ci', 'LIKE', $searchTerm);
                    $query->orWhere('expedido', 'LIKE', $searchTerm);
                    $query->orWhere('domicilio', 'LIKE', $searchTerm);
                    // Concatenar nombre y apellido y buscar en esa cadena
                    $query->orWhere(function ($q) use ($searchTerm) {
                        $q->whereRaw("CONCAT(nombre, ' ', apellidos) LIKE ?", [$searchTerm]);
                    });
                    // $query->orWhere(function ($q) use ($searchTerm) {
                    //     $q->where('nombre', 'LIKE', '%' . $this->search . '%')
                    //         ->orWhere('apellidos', 'LIKE', '%' . $this->search . '%');
                    // });
                    // Si el término de búsqueda tiene el formato "DGC-ci"
                    if (strpos($this->search, '-') !== false) {
                        list($codigo, $ci) = explode('-', $this->search, 2);
                        // Solo buscaremos en 'ci' si el formato es "DGC-ci"
                        if ($codigo === 'DGC') {
                            $query->orWhere('ci', 'LIKE', '%' . $ci . '%');
                        }
                    }
                    // Filtrar por el nombre de la mascota
                    $query->orWhereHas('cliente_mascotas', function ($query) use ($searchTerm) {
                        $query->where('nombre', 'LIKE', $searchTerm);
                    });
                })
                ->orderBy('id', 'desc')
                ->paginate(4);
        }


        $VacunasPorMascota = Vacunas::where('mascota_id', $this->MascotaVacunas)->where('estado', 'ACTIVO')->paginate(3, ['*'], 'vacunas_page');
        $DesparacitacionPorMascota = Desparacitaciones::where('mascota_id', $this->MascotaVacunas)->where('estado', 'ACTIVO')->paginate(3, ['*'], 'desparacitacion_page');
        $especies = Especies::where('estado', '<>', 'eliminado')->get();
        $razas = Razas::where('estado', '<>', 'eliminado')->get();
        $colores = ColoresMascotas::where('estado', '<>', 'eliminado')->get();
        $mascotas = Mascotas::where('cliente_id', $this->ClienteMascota)->where('estado', '<>', 'eliminado')->paginate(2, ['*'], 'mascotas_page');
        $doctores = User::where('estado', 1)->get();
        $productos = Productos::where('estado', 'activo')->get();
        $estudiosComplementarios = Historias_clinico::where('mascota_id', $this->mascota)->where('estado', '<>', 'eliminado')->where('tipo_historial_id', '2')->paginate(2, ['*'], 'estudios_page');
        #datos para precios
        $animales = Mascotas::where('estado', '!=', 'eliminado')->get();
        $AtencionDiaHistorial = [];
        if ($this->ClienteParaDia) {
            $cliente_id = $this->ClienteParaDia;
            $AtencionDiaHistorial = Historias_clinico::where('estado', '<>', 'eliminado')
                ->whereHas('historial_clinico_mascotas.mascotas_clientes', function ($query) use ($cliente_id) {
                    $query->where('id', $cliente_id);
                })
                ->whereDate('created_at', Carbon::today())
                ->get();
        }
        $AtencionDiaVacunas = [];
        if ($this->ClienteParaDia) {
            $cliente_id = $this->ClienteParaDia;
            $AtencionDiaVacunas = Vacunas::where('estado', '<>', 'eliminado')
                ->whereHas('vacuna_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
                    $query->where('id', $cliente_id);
                })
                ->whereDate('created_at', Carbon::today())
                ->get();
        }
        $AtencionDiaDesparacitaciones = [];
        if ($this->ClienteParaDia) {
            $cliente_id = $this->ClienteParaDia;
            $AtencionDiaDesparacitaciones = Desparacitaciones::where('estado', '<>', 'eliminado')
                ->whereHas('desparacitaciones_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
                    $query->where('id', $cliente_id);
                })
                ->whereDate('created_at', Carbon::today())
                ->get();
        }
        $AtencionDiaCitugias = [];
        if ($this->ClienteParaDia) {
            $cliente_id = $this->ClienteParaDia;
            $AtencionDiaCitugias = Cirugias::where('estado', '<>', 'eliminado')
                ->whereHas('cirugia_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
                    $query->where('id', $cliente_id);
                })
                ->whereDate('created_at', Carbon::today())
                ->get();
        }
        $AtencionFarmacia = [];
        if ($this->ClienteParaDia) {
            $cliente_id = $this->ClienteParaDia;
            $AtencionFarmacia = farmaciasVentas::where('estado', '<>', 'eliminado')
                ->whereHas('farmacia_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
                    $query->where('id', $cliente_id);
                })
                ->whereDate('created_at', Carbon::today())
                ->get();
        }
        $AtencionInteracion = [];
        if ($this->ClienteParaDia) {
            $cliente_id = $this->ClienteParaDia;
            $AtencionInteracion = Internacion::where('estado', '<>', 'eliminado')
                ->whereHas('internacion_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
                    $query->where('id', $cliente_id);
                })
                ->whereDate('created_at', Carbon::today())
                ->get();
        }
        $internaciones = Internacion::where('estado', 'activo')->where('mascota_id', $this->Mascota_id)->orderBy('id', 'desc')->get();
        $estudios_complemetarios = EstudiosComplementarios::where('estado', 'activo')->orderBy('nombre', 'asc')->get();
        // $this->mascota  tipo_historial_id
        $consultasMascota = Historias_clinico::where('estado', 'activo')->where('mascota_id', $this->mascota)->where('tipo_historial_id', 1)->get();
        $caja = Cajas::where('estado', 'activo')->first();
        $Imagenesinternacion=ImagenesInternacion::where('internacion_id',$this->IdInternacion)->where('estado','activo')->get();
        return view('livewire.modulos-v.clientes-index', compact(
            'clientes',
            'caja',
            'AtencionInteracion',
            'internaciones',
            'especies',
            'razas',
            'mascotas',
            'colores',
            'VacunasPorMascota',
            'doctores',
            'productos',
            'DesparacitacionPorMascota',
            'estudios_complemetarios',
            'cirugiass',
            'datoscirugiaspre',
            'cirugiapreope',
            'datoscirugiaspre2',
            'cirugiapreope2',
            'datoscirugiaspre3',
            'cirugiapreope3',
            'registro_completof',
            'productosfar',
            'registro_completoprodu',
            'AtencionFarmacia',
            'AtencionDiaCitugias',
            'AtencionDiaVacunas',
            'AtencionDiaHistorial',
            'AtencionDiaDesparacitaciones',
            'farmaciaventas',
            'estudiosComplementarios',
            'animales',
            'Imagenesinternacion',
            'consultasMascota'
        ));
    }
}
