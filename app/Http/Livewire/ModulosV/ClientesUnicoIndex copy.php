<?php

namespace App\Http\Livewire\ModulosV;

use App\Models\Modulos\Cirugias;
use App\Models\Modulos\CirugiasDatos;
use App\Models\Modulos\CirugiasPre;
use Livewire\Component;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\ColoresMascotas;
use App\Models\Modulos\Desparacitaciones;
use App\Models\Modulos\Especies;
use App\Models\Modulos\EstudiosComplementarios;
use App\Models\Modulos\Historias_clinico;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\Productos;
use App\Models\Modulos\Razas;
use App\Models\Modulos\Vacunas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Modulos\Ventas;
use App\Models\Modulos\VentasProductos;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
class ClientesUnicoIndex extends Stock
{
    public $search, $lista,$ProductoDosis;

    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    //FUNCIONES DE VALIDACION
    use WithFileUploads;
    public $operation;
    public $tipo_historial, $Past, $Pad, $Pam, $PulsoDeLaMascota, $Dht, $Peso, $ActitudDeMascota, $ActitudDeMascotaOtraOpcion, $TllcMascota, $ConductaDeMascota, $OtraOpcionConductaDeMascota, $EstadoNutricionalDeMascota, $EstadoNutricionalDeMascotaOtraOpcion, $MmDeMascota, $ConstanteVitalFcDeMascota, $ConstanteVitalFrDeMascota, $ConstanteVitalTemperaturaDeMascota, $CapaDePielDeMascota, $NroDeHistorialDeMascota, $AnamensisDeMascota, $Precio;

    protected $listeners = [
        'eliminarcliente', 'imagenCapturadaMascota', 'EliminarMascota', 'resultadoReconocimientoAnamensis', 'resultadoReconocimientoMotivoConsulta', 'EliminarVacuna', 'EliminarDesparacitaciones', 'imagenCapturada'
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
        $this->rutaImagenfinal = url($rutaImagenAnterior);
        //dd($this->rutaImagenfinal);
        $this->campoImagenHabilitado = true;
        $this->a = true;
        $this->b = true;
        $this->emit('AbrirModalConsultas');
    }

    public   $rutaImagenfinalMascota;
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
        $this->rutaImagenfinalMascota = url($rutaImagenAnterior);
    }
    public function eliminarfoto()
    {
        $this->rutaImagenfinalMascota = null;
        $this->emit('refreshCamaraMacota', $this->facingModeMascota);
    }
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

                'imagen_pdf_estudio_complementario' => url('/') . '/storage/estudio_complementario/' . $nombreArchivo,

                'precio' => $this->Precio,
                'user_id' => $usuario->id,
            ]);
            $this->limpiarmodalhistorial();
            $this->emit('cerrarmodalhistorial');
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
        } elseif ($this->operationss === "nuevo") {
            return $this->validartodocirugi();
        } elseif ($this->operationss === "datos") {
            return $this->validartododatoscirugi();
        } elseif ($this->operationss === "datosprecirugia") {
            return $this->validartodoprecirugi();
        } elseif ($this->operation === "guardareditarmascota") {
            return $this->validareditarmascota();
        }elseif ($this->operation === "ValidarNuevoEstudio") {
            return $this->ValidarNuevoEstudio();
        }

        return array_merge($this->validartodocirugi(), $this->validareditarmascota(), $this->rulesestudiocomplementariocreatepdf(), $this->rulesguardarestudioconcaptura(), $this->rulesCreaDesparacitacion(), $this->rulesCreaVacuna(), $this->rulesCrearColor(), $this->rulesCrearConsultas(), $this->rulesCrearColor(), $this->rulesCrearEspecie(), $this->rulesCrearCliente(), $this->rulesEditarCliente(), $this->rulesCrearMascota());
    }
    public $DomicilioCliente, $Correo, $NuevaEspecie, $NuevoColor, $NuevaRaza, $ExpedidoCliente, $CiCliente, $TelefonoCliente, $ApellidoCliente, $NombreCliente;
    private function rulesCrearCliente()
    {
        return [
            'DomicilioCliente' => 'required|string|max:125',
            'ExpedidoCliente' => 'required|string|max:10',
            'CiCliente' => 'required|string|max:10|unique:clientes,ci',
            'TelefonoCliente' => 'required|string|max:10',
            'ApellidoCliente' => 'required|string|max:55',
            'NombreCliente' => 'required|string|max:55',
            'Correo' => 'required|string|email|max:25',

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
    private function rulesestudiocomplementariocreatepdf()
    {

        return [
            'TipoDeEstudioComplementario' => 'required',
            'SeleccionTipoDeArchivo' => 'required',
            'ArchivoDelEstudio' => 'required',
            'Precio' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function ValidarNuevoEstudio()
    {

        return [
            'NuevoEstudio' => 'required|string|max:70',
            
        ];
    }
    private function rulesCreaVacuna()
    {
        return [
            'EdadEnVacunas' => 'required|string|max:10',
            'ProximaFecha' => 'required|date',
            'VacunaAplicada' => 'required|string|max:70',

            'PrecioVacuna' => 'required|numeric|between:0,999999.99',


        ];
    }
    private function rulesCreaDesparacitacion()
    {
        return [
            'EdadEnDesparacitacion' => 'required|string|max:10',
            'PesoEnDesparacitacion' => 'required|string|max:10',
            'ProximaFechaDesparacitacion' => 'required|date',
            'ProductoDosis' => 'required',
            'PrecioDesparacitacion' => 'required|numeric|between:0,999999.99',
        ];
    }
    private function rulesCrearEspecie()
    {
        return [
            'NuevaEspecie' => 'required|string|max:125',


        ];
    }
    private function rulesCrearColor()
    {
        return [
            'NuevoColor' => 'required|string|max:125',


        ];
    }
    private function rulesCrearRaza()
    {
        return [
            'NuevaRaza' => 'required|string|max:125',


        ];
    }
    private function rulesEditarCliente()
    {
        return [
            'DomicilioClienteEdit' => 'required|string|max:125',
            'ExpedidoClienteEdit' => 'required|string|max:10',
            'CiClienteEdit' => 'required|string|max:10',
            'TelefonoClienteEdit' => 'required|string|max:10',
            'ApellidoClienteEdit' => 'required|string|max:55',
            'NombreClienteEdit' => 'required|string|max:55',
            'EditarCorreo' => 'required|string|email|max:25',
        ];
    }

    private function rulesCrearMascota()
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
            'rutaImagenfinalMascota' => 'required',

        ];
    }
    private function validareditarmascota()
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
    private function rulesCrearConsultas()
    {
        $rules = [
            'MotivoDeAtencion' => 'required|string|max:4900',
            'AnamensisDeMascota' => 'required|string|max:4900',
            'Precio' => 'required|numeric|between:0,999999.99',
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
            'Precio' => 'required|numeric|between:0,999999.99',
        ];


        if ($this->ActitudDeMascota == 'otros') {
            $rules['ActitudDeMascotaOtraOpcion'] = 'required';
        } elseif ($this->ActitudDeMascota != 'otros') {
            $rules['ActitudDeMascota'] = 'required';
        }

        if ($this->ConductaDeMascota == 'otros') {
            $rules['OtraOpcionConductaDeMascota'] = 'required';
        } elseif ($this->ConductaDeMascota != 'otros') {
            $rules['ConductaDeMascota'] = 'required';
        }
        if ($this->EstadoNutricionalDeMascota == 'otros') {
            $rules['EstadoNutricionalDeMascotaOtraOpcion'] = 'required';
        } elseif ($this->EstadoNutricionalDeMascota != 'otros') {
            $rules['EstadoNutricionalDeMascota'] = 'required';
        }
        if ($this->CapaDePielDeMascota == 'otros') {
            $rules['OtraCapaDePielDeMascota'] = 'required';
        } elseif ($this->CapaDePielDeMascota != 'otros') {
            $rules['CapaDePielDeMascota'] = 'required';
        }

        return $rules;
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
    public $idClienteEditar, $EditarCorreo, $DomicilioClienteEdit, $ExpedidoClienteEdit, $CiClienteEdit, $TelefonoClienteEdit, $ApellidoClienteEdit, $NombreClienteEdit;
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
    public $NombreMascota, $EspecieMascota, $PesoMascota, $ColorMascota, $RazaMascota, $SexoMascota, $EsterilizadoMascota = 0, $EdadMascota = '1 año 1 mes', $ClienteMascota, $NombreCompletoDeCliente;
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
    public $mascotaid;
    public function mount($mascotaid)
    {
        $this->mascotaid = $mascotaid;
        $this->tratamientos = [''];
        $this->lista = [];
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
        $this->tipo_historial = 'estudio_complementario';


        $mascota = Mascotas::find($mascota);
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
    public $MascotaVacunas, $EdadEnVacunas, $PesoEnDesparacitacion, $VacunaAplicada, 
    $ProximaFecha, $Veterinario, $EdadEnDesparacitacion, 
    $Producto, $ProximaFechaDesparacitacion, $VeterinarioDesparacitacion;
    public  function VerVacunas($mascota)
    {
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
            'proxima_fecha' => $this->ProximaFecha,
            'precio' => $this->PrecioVacuna,
            'veterinario' => Auth::user()->id,
            'user_id' => Auth::user()->id,

        ]);
        $this->emit('alert', 'NUEVA VACUNA AGREGADA CON EXITO');

        $this->reset('VacunaAplicada', 'EdadEnVacunas', 'ProximaFecha', 'Veterinario', 'PrecioVacuna');
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
        $crearhistorial = Historias_clinico::create([

            'mascota_id' => $this->mascota,
            'tipo_historial_id' => $tipohistorial,
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
            'motivo_atencion' => $this->MotivoDeAtencion,
            'Past' => $this->Past,
            'Pad' => $this->Pad,
            'Pam' => $this->Pam,
            'Pulso' => $this->PulsoDeLaMascota,
            'Dht' => $this->Dht,
            'Peso' => $this->Peso,
            'capa_piel' => $capadepiel,


        ]);

        $this->limpiarmodalhistorial();
        $this->emit('cerrarmodalhistorial');

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
            'ConstanteVitalFcDeMascota', 'ConstanteVitalTemperaturaDeMascota', 'CapaDePielDeMascota', 'NroDeHistorialDeMascota', 'AnamensisDeMascota', 'Precio'
        ]);
        $this->resetValidation();
        #$this->resetPage();
    }
   //------------------------------------------------------- TODO MOLQUI ------------------------------------------------------------------------------------------------------------------------------------------------------
   public $conta = 1;
   //-------------------------------
   public $registro_completo, $id_masco, $operationss, $descripcion, $cirugia_id, $costocirugia, $asa;
   // todo para crear cirugias -------------------------------------------------------------------------
   public function validartodocirugi()
   {
       return [
           'descripcion' => 'required', 'costocirugia' => 'required|numeric', 'asa' => 'required'
       ];
   }
   public function limpiarmodalcirugia()
   {
       $this->reset(['descripcion', 'costocirugia', 'asa']);
       $this->emit("cerrarmodalcirugia");
   }
   public function GuardarCirugia()
   {
       $this->operationss = "nuevo";
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
       ]);
   }
   public function crearcirugias($mas_id)
   {
       //$this->emit("alert","hola miky".$mas_id);
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
       $this->reset(['id_masco', 'cirugia_id', 'registro_completo', 'costocirugia']);
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
   public $Hora, $FC, $FR, $tem, $MM, $TLLC, $SOPO2, $num;
   public function limpiarmodaldatoscirugia()
   {
       $this->reset(['FC', 'FR', 'tem', 'MM', 'TLLC', 'SOPO2', 'num', 'operation']);
       $this->resetValidation();
   }
   public function validartododatoscirugi()
   {
       return [
           'FC' => 'required', 'FR' => 'required', 'tem' => 'required',
           'MM' => 'required'
       ];
   }
   public function GuardarDatosCirugia($nu, $id_ciru)
   {
       $this->cirugia_id = $id_ciru;
       $this->num = $nu;
       $this->operationss = "datos";
       $this->validate();
       $this->guardardatosBDdatoscirugia();
       // $this->emit("alert", "CIRUGIA CREADA");
       $this->limpiarmodaldatoscirugia();
   }
   public function guardardatosBDdatoscirugia()
   {
       CirugiasDatos::create([
           'cirugia_id' =>  $this->cirugia_id,
           'hora' =>  date('H:i:s'), 'FC' =>  $this->FC, 'FR' =>  $this->FR,
           'Tem' =>  $this->tem, 'MM' =>  $this->MM, 'TLLC' =>  $this->TLLC,
           'sopo2' =>  $this->SOPO2, 'total' =>  $this->num
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
   public  $medicamento, $mg, $ml, $via, $observaciones, $bandera = true;

   public function validartodoprecirugi()
   {
       return [
           'medicamento' => 'required', 'mg' => 'required', 'ml' => 'required', 'via' => 'required'
       ];
   }
   public function limpiarmodalprecirugia()
   {
       $this->reset(['medicamento', 'mg', 'ml', 'via', 'observaciones', 'operation']);
       $this->resetValidation();
   }
   public function GuardarpreOperatorio($nu, $id_ciru)
   {
       $this->cirugia_id = $id_ciru;
       $this->num = $nu;
       $this->operationss = "datosprecirugia";
       $this->validate();
       $this->guardardatosBDpreoperacion();
       $this->emit("alert", "preoperatorio creado");
       $this->limpiarmodalprecirugia();
   }
   public function guardardatosBDpreoperacion()
   {
       CirugiasPre::create([
           'cirugia_id' =>  $this->cirugia_id, 'detalle' =>  $this->medicamento,
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

   //-------------------------------------------------- todo milqui farmacias ----------------------------------
   //-------------------------------------todo farmacia -----------------------------------------------
   public $id_masfarma, $Searchproductof, $bloque = false, $registro_produf, $totalprecio = 0;
   public function crearfarmacias($id_masco)
   {
       $this->id_masfarma = $id_masco;
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
               $this->lista[] = [
                   'id' => $id_produ,
                   'nombre' => $registro_produf->nombre, 'precio' => $registro_produf->precio,
                   'preciom' => 0, 'tuni' => $registro_produf->unidad_de_medida,
                   'cantidad' => 1, 'stock' => $registro_produf->stock, 'total' => 0, 'estado' => 0
               ];
               //$this->emit("abrirmodalcarro");
           }
       }
       $this->reset(['Searchproductof']);
   }
   public function editarcarroventa($index)
   {
       $this->lista[$index]['estado'] = 0;
   }
   public function eliminarcarro($index)
   {
       unset($this->lista[$index]); // Eliminar el elemento del array en el índice proporcionado
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
   
   #GRAGMENTO DE CODIGO PARA CREAR UN NUEVO  ESTUDIO 
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
       } else {
           $id_cli = $this->id_masfarma;
           $totalPrecio = array_sum(array_column($this->lista, 'total'));
           $venta = Ventas::create([
               'cliente_id'   =>  $id_cli,
               'usuario_id' => Auth::user()->id,
               'descripcion' => "todo en buen estado",
               'total' =>  $totalPrecio
           ]);
           if ($venta) {
               foreach ($this->lista as $producto) {
                   VentasProductos::create([
                       'producto_id' =>  $producto['id'],
                       'id_venta' =>  $venta->id,
                       'descripcion' => "todo en buen estado",
                       'cantidad' => $producto['cantidad'],
                       //'precio' => $registro->preciom,
                       'precio' => $producto['preciom'],
                       'estado' => 'activo'
                   ]);
                   $this->btncalularstok($producto['id']);
               }
               $this->limpiarmodalbusquedaf();
               $this->emit("alert", "Productos vendidos con éxito");
               $this->emit("cerrarmodalfarmaciaf");
           } else {
               $this->emit('alerterror', 'Error al realizar la venta' );
           }
       }
   } 

   #funcion para sacar el total del dia
   public $ClienteParaDia=0,$MascotaeParaDia;
   public function SacarTotalDia( $cliente)
   {
       $this->ClienteParaDia = $cliente;
     
       $this->emit('AbrirModalPreciosTotal');
   }

    //----------------------------------------------------------------------------------------------------
    public function render()
    {
        $registro_completoprodu = $this->registro_produf;
        $registro_completof = Mascotas::find($this->id_masfarma);
        $productosfar = Productos::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->Searchproductof . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(2);
        $cirugiass = Cirugias::where('id_mascota', $this->id_masco)->where('estado', "activo")->get();
        $datoscirugiaspre = CirugiasDatos::where('total', 1)->where('estado', "activo")->get();
        $cirugiapreope = CirugiasPre::where('tipo', 1)->where('estado', "activo")->get();
        $datoscirugiaspre2 = CirugiasDatos::where('total', 2)->where('estado', "activo")->get();
        $cirugiapreope2 = CirugiasPre::where('tipo', 2)->where('estado', "activo")->get();
        $datoscirugiaspre3 = CirugiasDatos::where('total', 3)->where('estado', "activo")->get();
        $cirugiapreope3 = CirugiasPre::where('tipo', 3)->where('estado', "activo")->get();

        $clientes = Clientes::find($this->mascotaid);

        $VacunasPorMascota = Vacunas::where('mascota_id', $this->MascotaVacunas)->where('estado', 'ACTIVO')->paginate(3, ['*'], 'vacunas_page');
        $DesparacitacionPorMascota = Desparacitaciones::where('mascota_id', $this->MascotaVacunas)->where('estado', 'ACTIVO')->paginate(3, ['*'], 'desparacitacion_page');
        $especies = Especies::where('estado', '<>', 'eliminado')->get();
        $razas = Razas::where('estado', '<>', 'eliminado')->get();
        $colores = ColoresMascotas::where('estado', '<>', 'eliminado')->get();
        $mascotas = Mascotas::where('cliente_id', $this->ClienteMascota)->where('estado', '<>', 'eliminado')->paginate(4, ['*'], 'mascotas_page');
        $doctores = User::where('estado', 1)->get();
        $productos = Productos::where('estado', 'activo')->get();

        #datos para precios
       $AtencionDiaHistorial=[];
       if ($this->ClienteParaDia) {
        $cliente_id=$this->ClienteParaDia;
        $AtencionDiaHistorial = Historias_clinico::where('estado', '<>', 'eliminado')
        ->whereHas('historial_clinico_mascotas.mascotas_clientes', function ($query) use ($cliente_id) {
            $query->where('id', $cliente_id);
        })
        ->whereDate('created_at', Carbon::today())
        ->get();
       }
       $AtencionDiaVacunas=[];
       if ($this->ClienteParaDia) {
        $cliente_id=$this->ClienteParaDia;
        $AtencionDiaVacunas = Vacunas::where('estado', '<>', 'eliminado')
        ->whereHas('vacuna_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
            $query->where('id', $cliente_id);
        })
        ->whereDate('created_at', Carbon::today())
        ->get();
       }
       $AtencionDiaDesparacitaciones=[];
       if ($this->ClienteParaDia) {
        $cliente_id=$this->ClienteParaDia;
        $AtencionDiaDesparacitaciones = Desparacitaciones::where('estado', '<>', 'eliminado')
        ->whereHas('desparacitaciones_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
            $query->where('id', $cliente_id);
        })
        ->whereDate('created_at', Carbon::today())
        ->get();
       }
       $AtencionDiaCitugias=[];
       if ($this->ClienteParaDia) {
        $cliente_id=$this->ClienteParaDia;
        $AtencionDiaCitugias = Cirugias::where('estado', '<>', 'eliminado')
        ->whereHas('cirugia_mascota.mascotas_clientes', function ($query) use ($cliente_id) {
            $query->where('id', $cliente_id);
        })
        ->whereDate('created_at', Carbon::today())
        ->get();
       }
       $AtencionFarmacia=[];
       if ($this->ClienteParaDia) {
        $cliente_id=$this->ClienteParaDia;
        $AtencionFarmacia = Ventas::where('estado', '<>', 'eliminado')
        ->whereHas('mascota_ventas.mascotas_clientes', function ($query) use ($cliente_id) {
            $query->where('id', $cliente_id);
        })
        ->whereDate('created_at', Carbon::today())
        ->get();
       } 
        
        // $AtencionDiaVacunas =
            // $AtencionDiaDesparacitaciones =
            // $AtencionDiaCitugias =
            // $AtencionFarmacia =
            $estudios_complemetarios = EstudiosComplementarios::where('estado', 'activo')->get();
        return view('livewire.modulos-v.clientes-unico-index', compact(
            'clientes',
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
            'cirugiapreope3','AtencionFarmacia',
            'registro_completof','AtencionDiaCitugias',
            'productosfar','AtencionDiaVacunas','AtencionDiaDesparacitaciones',
            'registro_completoprodu','AtencionDiaHistorial'

        ));
    }
}
