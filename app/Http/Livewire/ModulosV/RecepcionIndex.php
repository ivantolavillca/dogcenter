<?php

namespace App\Http\Livewire\ModulosV;

use App\Events\FichaStatusUpdated;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\ColoresMascotas;
use App\Models\Modulos\Especies;
use App\Models\Modulos\Fichas;
use App\Models\Modulos\Mascotas;
use App\Models\Modulos\Razas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RecepcionIndex extends Component
{
    public $CiDelCliente, $ExpedidoDelCliente, $CorreoDelCliente, $NombreDelCliente, $ApellidoDelCliente, $CodigoDelCliente, $TelefonoDelCliente, $DomicilioDelCliente ;
    public $idclienteanterior,$idmascotaanterior,$CodigoAnterior,$NuevaEspecie, $NuevoColor, $NuevaRaza, $NombreMascota, $EspecieMascota, $ColorMascota, $RazaMascota, $SexoMascota, $EsterilizadoMascota = 0, $EdadMascota ;
    protected $listeners = ['fichaActualizadanueva','imagenCapturada'];
    public function fichaActualizada22()
    {
        // aciones a realizar 
    }
    public function updatedCiDelCliente()
    {

        if ($this->CiDelCliente == '') {
            $this->CodigoDelCliente = '';
        } else {
            $this->CodigoDelCliente = 'DGC-' . $this->CiDelCliente;
        }
    }
    public $operation;



    public function rules()
    {
        if ($this->operation === 'crearcliente') {
            return $this->rulesCrearcliente();
        } elseif ($this->operation === 'nombrederaza') {
            return $this->rulesEditarRaza();
        } elseif ($this->operation === 'CrearEspecie') {
            return $this->rulesCrearEspecie();
        } elseif ($this->operation === 'CrearRaza') {
            return $this->rulesCrearRaza();
        } elseif ($this->operation === 'CrearColor') {
            return $this->rulesCrearColor();
        }

        return array_merge($this->rulesCrearColor(), $this->rulesCrearColor(), $this->rulesCrearEspecie(), $this->rulesCrearcliente(), $this->rulesEditarRaza());
    }


    private function rulesCrearcliente()
    {
        return [
            'CiDelCliente' => 'required|string|max:12|unique:clientes,ci',
            'ExpedidoDelCliente' => 'required',
            'CorreoDelCliente' => 'required|email|max:55',
            'NombreDelCliente' => 'required|string|max:20',
            'ApellidoDelCliente' => 'required|string|max:40',
            'CodigoDelCliente' => 'required|string|max:21',
            'TelefonoDelCliente' => 'required|string|max:10',
            'DomicilioDelCliente' => 'required|string|max:200',
            'NombreMascota' => 'required|string|max:55',
            'EspecieMascota' => 'required|not_in:CrearEspecie',
            'RazaMascota' => 'required|not_in:CrearRaza',
            'SexoMascota' => 'required|string',
            'EsterilizadoMascota' => 'required',
            'EdadMascota' => 'required|string|max:254',
            'ColorMascota' => 'required|not_in:CrearColor',
            
        ];
    }
    private function rulesEditarRaza()
    {
        return [
            'CiDelCliente' => 'required|string|max:125',
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
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function RegistrarCliente()
    {
        $this->operation = "crearcliente";
        $this->validate();
        $cliente = Clientes::create([
            'ci' => $this->CiDelCliente,
            'expedido' => $this->ExpedidoDelCliente,
            'codigo' => $this->CodigoDelCliente,
            'nombre' => $this->NombreDelCliente,
            'apellidos' => $this->ApellidoDelCliente,
            'telefono' => $this->TelefonoDelCliente,
            'domicilio' => $this->DomicilioDelCliente,
            'correo' => $this->CorreoDelCliente,
        ]);
        if ($this->EsterilizadoMascota == 1) {
            $mascotaesterilizadoa = 'SI';
        } elseif ($this->EsterilizadoMascota == 0) {
            $mascotaesterilizadoa = 'NO';
        }
        $mascota = Mascotas::create([
            'nombre' => $this->NombreMascota,
            'especie_id' => $this->EspecieMascota,
            'raza_id' => $this->RazaMascota,
            'sexo' => $this->SexoMascota,
            'esterilizado' => $mascotaesterilizadoa,
            'edad_mascota' => $this->EdadMascota,
            'cliente_id' => $cliente->id,
            'color_id' => $this->ColorMascota,
            'imagen' => $this->rutaImagenfinal,

            'estado' => 'activo',
        ]);
        $this->emit('alert', 'DATOS DE USUARIO Y MASCOTA REGISTRADOS CON ÉXITO - ' . $cliente->codigo);
        $this->reset(
            'CiDelCliente',
            'ExpedidoDelCliente',
            'NombreDelCliente',
            'CodigoDelCliente',
            'ApellidoDelCliente',
            'TelefonoDelCliente',
            'DomicilioDelCliente',
            'CorreoDelCliente',
            'EsterilizadoMascota',
            'NombreMascota',
            'EspecieMascota',
            'RazaMascota',
            'SexoMascota',
            'EdadMascota',
            'ColorMascota',
            'rutaImagenfinal',
        );
        $this->idclienteanterior=$cliente->id;
        $this->idmascotaanterior=$mascota->id;
        $this->CodigoAnterior=$cliente->codigo;
    }
    public function PonerEnColaACliente()
    {

        $this->guardardatosBD();
        $this->emit("alert", "FICHA CREADA");
        $this->emit("playSound");
        $fichaSta = new FichaStatusUpdated();
        event($fichaSta);
        $this->reset('idclienteanterior','CodigoAnterior');
    }
    public function ultima()
    {
        
        $fechaActual = Carbon::now('America/La_Paz')->toDateString();
      
        $ultimaNumeracion = Fichas::whereDate('created_at', $fechaActual)->max('numeracion');
   
        return $ultimaNumeracion ? $ultimaNumeracion + 1 : 1;
    }

 
    public function guardardatosBD()
    {
        if ($this->idclienteanterior) {
            Fichas::create([
                'id_cliente' =>  $this->idmascotaanterior,
                'id_usuario ' =>  Auth::user()->id,
             
                'numeracion' =>  $this->ultima(),
                'estado' => 'activo',
            ]);
        
        } else {
            Fichas::create([
                'numeracion' => $this->ultima(),
                'estado' => 'activo',

            ]);
        }
    }
    public $a = false;
    public $b = false;
    public $c = false;

    public $imagenBinaria;
    public $nombreImagen;
    public $rutaImagen,$PrecioVacuna=0.00,$PrecioDesparacitacion=0.00;
    public   $rutaImagenfinal, $campoImagenHabilitado;
      public $facingMode = 'sin';

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
          $imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
          $nombreImagen = uniqid('imagen') . '.jpg';
          $rutaImagen = 'public/imagen_mascotas/' . $nombreImagen;
          Storage::put($rutaImagen, $imagenBinaria);
          $urlImagenAnterior = parse_url($rutaImagen, PHP_URL_PATH);
          $rutaImagenAnterior = str_replace('public', 'storage', $rutaImagen);
          $this->rutaImagenfinal = '/'.$rutaImagenAnterior ;
          //dd($this->rutaImagenfinal);
        //   $this->campoImagenHabilitado = true;
        //   $this->a = true;
        //   $this->b = true;
          
      }
      public function eliminarfoto(){
        $this->rutaImagenfinal=null;
        $this->emit('refreshCamara', $this->facingMode);
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
    public function render()
    {
        $especies = Especies::where('estado', '<>', 'eliminado')->orderBy('nombre','asc')->get();
        $razas = Razas::where('estado', '<>', 'eliminado')->orderBy('nombre','asc')->get();
        $colores = ColoresMascotas::where('estado', '<>', 'eliminado')->orderBy('nombre','asc')->get();
        return view('livewire.modulos-v.recepcion-index', compact('especies', 'razas', 'colores'));
    }
}
