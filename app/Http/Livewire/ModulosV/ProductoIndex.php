<?php
namespace App\Http\Livewire\ModulosV;
use Livewire\WithPagination;
use App\Models\Modulos\Productos;
use App\Models\Modulos\VentasProductos;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Modulos\Clientes;
use App\Models\Modulos\Proveedor;
use App\Models\Modulos\Ventas;
use App\Models\Modulos\Compras;
use App\Models\Modulos\ComprasProductos;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductoIndex extends Stock
{
    
    //protected $crudProducto;
    use WithFileUploads;
    public $uni_medida;
    public $estadocompraventa="";
    protected $paginationTheme = 'bootstrap';
    public $imagenCapturada;

    public $a = false;
    public $b = false;
    public $bloque = false;
    public $imagenBinaria;
    public $nombreImagen;
    public $rutaImagen;
    public $rutaImagenfinal;
    public $SearchCliente;
    protected $listeners = [
        'Eliminarproducto', 'imagenCapturada'
    ];
   
    public $facingMode = 'user'; // Valor predeterminado para la cámara frontal
    public function cambiarCamarat()
    {
        $this->facingMode = 'environment';
        $this->emit('refreshCamara', $this->facingMode);
    }

    public function cambiarCamarad()
    {
        $this->facingMode = 'user';
        $this->emit('refreshCamara', $this->facingMode);
    }

    use WithPagination;
    public $operation;
    public $searchProducto;
    public $totalCantidad;
    public $cantidadProducto;
    public $stock;

    // inicializar variables de los modales 
    public $productoID;
    public $Nombreproducto;
    public $Descripcionproducto;
    public $Imagenproducto;
    public $campoImagenHabilitado = false;

    public $datosCargados;
    public $Cantidadproducto;
    #public $Stockproducto;
    public $Precioproducto;

    public $lista;
    public $canti;
    public $Idclien;
    public $NombreCliente;
    
    public function mount()
    {
        $this->lista = [];
    }
    protected $messages = [
       /*  'lista.*.preciom.required' => 'El precio es obligatorio.',
        'lista.*.cantidad.required' => 'La cantidad es obligatoria.',
        'lista.*.cantidad.numeric' => 'La cantidad debe ser un número.', */
        'SearchCliente' => 'El campo Cliente o Proveedor es obligatorio',
        // Agrega más mensajes personalizados según sea necesario
    ];
    public function mostrarcarro()
    {
        $this->emit("abrirmodalcarro");
    }
    public function verificarStock($index)
    {
        $cantidadIngresada = $this->lista[$index]['cantidad'];
        $stockDisponible = $this->lista[$index]['stock'];
    
        if ($cantidadIngresada > $stockDisponible) {
            $this->emit('alerterror', 'La cantidad ingresada supera el stock disponible.');
        }
    }
    
    public function btnCarros($id, $nombreProducto)
    {
        $this->estadocompraventa="compra";
        $registro = Productos::find($id);
        if ($registro->stock < 1) {
            $this->emit("alerterror", "Error: Stock Vacío");
        } else {
            // Busca si el producto ya está en la lista
            $index = array_search($id, array_column($this->lista, 'id'));

            if ($index !== false) {

                $this->emit("alerterror", "Error: El producto ya existe");
            } else {
                // Si el producto no está en la lista, lo agrega con cantidad 1
                $this->lista[] = ['id' => $id, 'nombre' => $nombreProducto, 'precio'=>$registro->precio, 'preciom' => 0, 'tuni'=>$registro->unidad_de_medida, 'cantidad' => 1,'stock'=>$registro->stock,'total'=>0,'estado'=>0];
                //$this->emit("abrirmodalcarro");
            }
        }
    }
    public function btnCarrosventa($id, $nombreProducto)
    {
        $this->estadocompraventa="venta";
        $registro = Productos::find($id);
        if ($registro->stock < 1) {
            $this->emit("alerterror", "Error: Stock Vacío");
        } else {
            // Busca si el producto ya está en la lista
            $index = array_search($id, array_column($this->lista, 'id'));
            if ($index !== false) {
                $this->emit("alerterror", "Error: El producto ya existe");
            } else {
                // Si el producto no está en la lista, lo agrega con cantidad 1
                $this->lista[] = ['id' => $id, 'nombre' => $nombreProducto, 'precio'=>$registro->precio, 'preciom' => 0, 'tuni'=>$registro->unidad_de_medida, 'cantidad' => 1,'stock'=>$registro->stock,'total'=>0,'estado'=>0];
                //$this->emit("abrirmodalcarro");
            }
        }
    }
    public function cancelarventa()
    {
        $this->lista = []; // Limpiar el arreglo, dejándolo vacío
        $this->reset(['SearchCliente']);
        $this->bloque = false;
        $this->estadocompraventa="";
    }
    public function validarcarroventa($index)
    {
        $cantidadIngresada = $this->lista[$index]['cantidad'];
        $stockDisponible = $this->lista[$index]['stock'];
        
        $preciom=$this->lista[$index]['preciom'];
        if ($cantidadIngresada > $stockDisponible && $this->estadocompraventa=="venta") {
            $this->emit('alerterror', 'La cantidad ingresada supera el stock disponible.');
        }
        elseif ($cantidadIngresada < 1 && $this->estadocompraventa=="compra")
        {
            $this->emit('alerterror', 'La cantidad ingresada tiene que ser mayor a 1');
        }
       elseif ($preciom<1) {
            $this->emit('alerterror', 'El precio tiene que ser mayor a 1 ');
        } else {
            $this->lista[$index]['estado']=1;
            $this->lista[$index]['total'] = $this->lista[$index]['cantidad'] * $this->lista[$index]['preciom'];
        }
    }
    public function editarcarroventa($index)
    {
            $this->lista[$index]['estado']=0;
    }
    public function editarcarrocompra($index)
    {
        unset($this->lista[$index]); // Eliminar el elemento del array en el índice proporcionado
        $this->limipiarcarroyotros();
    }
    public function eliminarcarro($index)
    {
        unset($this->lista[$index]); // Eliminar el elemento del array en el índice proporcionado
        $this->limipiarcarroyotros();
    }
    public function buscarCeroEstadocompra()
    {
        return in_array(0, array_column($this->lista, 'estado'));
    }

    public function vendercarro()
    {
        $this->operation = "carrovalidar";
        $this->validate();
    
        $datoscliente = "sin datos";
        $hayCero = $this->buscarCeroEstadocompra();
    
        if ($hayCero) {
            $this->emit('alerterror', 'Falta Validar Ventas');
            return;
        }
    
        $id_cli = $this->Idclien ?? null;
        $totalPrecio = array_sum(array_column($this->lista, 'total'));
    
        DB::beginTransaction();
    
        try {
            $venta = Ventas::create([
                'cliente_id'   =>  $id_cli,
                'usuario_id' =>Auth::user()->id,
                'descripcion' => $this->SearchCliente,
                'total' =>  $totalPrecio,
            ]);
    
            foreach ($this->lista as $producto) {
                //$registro = Productos::find($producto['id']);
                VentasProductos::create([
                    'producto_id' =>  $producto['id'],
                    'id_venta' =>  $venta->id,
                    'descripcion' => $this->SearchCliente,
                    'cantidad' => $producto['cantidad'],
                    //'precio' => $registro->preciom,
                    'precio' =>$producto['preciom'],
                    'estado' => 'activo',
                ]);
                $this->btncalularstok($producto['id']);
            }
    
            DB::commit();
    
            $this->cancelarventa();
            $this->reset(['Idclien']);
            $this->emit("alert", "Productos vendidos con éxito");
            $this->emit("cerrarmodalcarro");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('alerterror', 'Error al realizar la venta');
        }
    }
    public function comprarcarro()
    {
        $this->operation = "carrovalidar";
        $this->validate();
    
        $datoscliente = "sin datos";
        $hayCero = $this->buscarCeroEstadocompra();
    
        if ($hayCero) {
            $this->emit('alerterror', 'Falta Validar Ventas');
            return;
        }
    
        $id_cli = $this->Idclien ?? null;
        $totalPrecio = array_sum(array_column($this->lista, 'total'));
    
        DB::beginTransaction();
    
        try {
            $compra = Compras::create([
                'proveedor_id'   =>  $id_cli,
                'usuario_id' =>Auth::user()->id,
                'descripcion' => $this->SearchCliente,
                'total' =>  $totalPrecio,
            ]);
    
            foreach ($this->lista as $producto) {
                //$registro = Productos::find($producto['id']);
                ComprasProductos::create([
                    'id_compra' =>  $compra->id,
                    'producto_id' =>  $producto['id'],
                    'descripcion' => $this->SearchCliente,
                    'cantidad_inicial' => $producto['cantidad'],
                    //'precio' => $registro->preciom,
                    'precio' =>$producto['preciom'],
                    'estado' => 'activo',
                ]);
                $this->btncalularstok($producto['id']);
            }
    
            DB::commit();
    
            $this->cancelarventa();
            $this->reset(['Idclien']);
            $this->emit("alert", "Productos vendidos con éxito");
            $this->emit("cerrarmodalcarro");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('alerterror', 'Error al realizar la venta');
        }
    }
    public function CargarDatosNombreCi($id)
    {
        $this->Idclien=$id;
        if($this->estadocompraventa=="venta")
        {
            $this->SearchCliente = Clientes::find($id)->nombre . " " . Clientes::find($id)->apellidos;
            $this->bloque = true;
        }else{
            $this->SearchCliente = Proveedor::find($id)->nombre . " " . Proveedor::find($id)->apellidos;
            $this->bloque = true;
        }
    }
   
    public function limpiarmodalbusqueda()
    {
        $this->reset(['SearchCliente','Idclien', 'NombreCliente']);
        
        $this->bloque = false;
    }
    public function limipiarcarroyotros()
    {
        $this->reset(['Idclien', 'NombreCliente']);
    }

    public function rules()
    {
        if ($this->operation === 'producNuevo') {
            return $this->rulesproductos();
        } elseif ($this->operation === 'producNuevo2') {
            return $this->rulesproductos2();
        } elseif ($this->operation === 'producEditar') {
            return $this->rulesproductos();
        } elseif ($this->operation === 'producEditar2') {
            return $this->rulesproductos2();
        }
        elseif ($this->operation === 'carrovalidar') {
            return $this->rulesmodalcarro();
        }
        return array_merge($this->rulesproductos());
    }
    public function rulesmodalcarro()
    {
        return [
            'SearchCliente' => 'required|string|max:125',
        ];
    }
    public function rulesproductos()
    {
        return [
            'Nombreproducto' => 'required|string|max:125',
            'Imagenproducto' => 'required',
            'Descripcionproducto' => 'required|string|max:125',
            'Cantidadproducto' =>  [
                'required',
                'numeric',
                'regex:/^\d{1,10}(\.\d{1,2})?$/', // Máximo 10 dígitos, con opción de hasta 2 decimales
            ],
            'Precioproducto' => [
                'required',
                'numeric',
                'regex:/^\d{1,10}(\.\d{1,2})?$/', // Máximo 10 dígitos, con opción de hasta 2 decimales
            ],

        ];
    }
    public function rulesproductos2()
    {
        return [
            'Nombreproducto' => 'required|string|max:125',
            'Descripcionproducto' => 'required|string|max:125',
            'Cantidadproducto' =>  [
                'required',
                'numeric',
                'regex:/^\d{1,10}(\.\d{1,2})?$/', // Máximo 10 dígitos, con opción de hasta 2 decimales
            ],
            'Precioproducto' => [
                'required',
                'numeric',
                'regex:/^\d{1,10}(\.\d{1,2})?$/', // Máximo 10 dígitos, con opción de hasta 2 decimales
            ],

        ];
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

    public function limpiarproducto()
    {
        if ($this->rutaImagen !== null) {
            Storage::delete($this->rutaImagen);
        }
        $this->reset(['uni_medida', 'productoID', 'Nombreproducto', 'Descripcionproducto', 'Imagenproducto', 'Cantidadproducto', 'Precioproducto', 'rutaImagenfinal', 'rutaImagen', 'a', 'b']);
        $this->resetValidation();
        $this->Imagenproducto = null; // Limpiar el campo de archivo
        $this->campoImagenHabilitado = false;
        // eliminar imagen de capturas 

    }
    public function limpiarproducto2()
    {
        $this->reset(['uni_medida', 'productoID', 'Nombreproducto', 'Descripcionproducto', 'Imagenproducto', 'Cantidadproducto', 'Precioproducto', 'rutaImagenfinal', 'a', 'b']);
        $this->resetValidation();
        $this->Imagenproducto = null; // Limpiar el campo de archivo
        $this->campoImagenHabilitado = false;
    }

    public function Guardarprodcuto()
    {
        $this->Guardarbdproducto();
        $this->limpiarproducto();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalproducto');
    }
    public function Guardarbdproducto()
    {
        // Asignamos un valor a la variable operation
        $this->operation = 'producNuevo';
        $this->validate();

        $archivo = $this->Imagenproducto;
        $nombreArchivo = uniqid('Imagenproducto') . '.' . $archivo->getClientOriginalExtension();
        // Guardar el archivo en el almacenamiento
        $rutaArchivo = $archivo->storeAs('public/productos', $nombreArchivo);
        Productos::create([
            'nombre' => $this->Nombreproducto,
            'descripcion' => $this->Descripcionproducto,
            //'imagen' => asset('storage/productos/' . $nombreArchivo),
            // 'imagen' => url('storage/productos/' . $nombreArchivo),
            'imagen' => asset('storage/productos/' . $nombreArchivo),

            'cantidad_inicial' => $this->Cantidadproducto,
            'stock' => $this->Cantidadproducto,
            'precio' => $this->Precioproducto,
            'unidad_de_medida' => $this->uni_medida,
            'estado' => 'activo',
        ]);
    }


    public function editarproducto($id)
    {

        $producto = Productos::findOrFail($id);
        // Asignar los valores del producto a las propiedades del componente
        $this->productoID = $producto->id;
        $this->Nombreproducto = $producto->nombre;
        $this->Descripcionproducto = $producto->descripcion;
        $this->Imagenproducto = $producto->imagen;
        $this->Cantidadproducto = $producto->cantidad_inicial;
        $this->Precioproducto = $producto->precio;
        $this->rutaImagenfinal = $producto->imagen;

        // Emitir un evento para abrir el modal de edición
        $this->emit('abrirmodalproducto');
    }

    public function btnEditarprodcuto()
    {
        // asignamoes un valor a la variable operation
        $this->operation = 'producEditar';
        $this->validate();
        // Buscar el producto a editar
        $producto = Productos::find($this->productoID);
        // Verificar si se cargó una nueva imagen
        if ($this->Imagenproducto != $producto->imagen) {

            $urlImagenAnterior = parse_url($producto->imagen, PHP_URL_PATH);
            $rutaImagenAnterior = str_replace('storage', 'public', $urlImagenAnterior);
            if (Storage::exists($rutaImagenAnterior)) {
                Storage::delete($rutaImagenAnterior);
            }
            // Se cargó una nueva imagen, actualizar la imagen del producto
            $nombreArchivo = uniqid('Imagenproducto') . '.' . $this->Imagenproducto->getClientOriginalExtension();
            $rutaArchivo = $this->Imagenproducto->storeAs('public/productos', $nombreArchivo);
            $producto->imagen = url('storage/productos/' . $nombreArchivo);
        }
        // Actualizar los demás campos del producto
        $producto->nombre = $this->Nombreproducto;
        $producto->descripcion = $this->Descripcionproducto;
        $producto->cantidad_inicial = $this->Cantidadproducto;
        $producto->stock = $this->Cantidadproducto; // Actualizas 'stock' también?
        $producto->precio = $this->Precioproducto;
        $producto->save();
        $this->btncalularstok($this->productoID);
        // Limpiar los campos del formulario
        $this->limpiarproducto();
        // Emitir un evento para mostrar una alerta y cerrar el modal
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalproducto');
    }
    public function btnEditarprodcuto2()
    {
        // asignamoes un valor a la variable operation
        $this->operation = 'producEditar2';
        $this->validate();
        $producto = Productos::find($this->productoID);
        // Verificar si se cargó una nueva imagen
        $urlImagenAnterior = parse_url($producto->imagen, PHP_URL_PATH);
        $rutaImagenAnterior = str_replace('storage', 'public', $urlImagenAnterior);
        if (Storage::exists($rutaImagenAnterior)) {
            Storage::delete($rutaImagenAnterior);
        }
        $producto = Productos::find($this->productoID);
        // Actualizar los demás campos del producto
        $producto->imagen = $this->rutaImagenfinal;
        $producto->nombre = $this->Nombreproducto;
        $producto->descripcion = $this->Descripcionproducto;
        $producto->cantidad_inicial = $this->Cantidadproducto;
        $producto->stock = $this->Cantidadproducto; // Actualizas 'stock' también?
        $producto->precio = $this->Precioproducto;
        $producto->save();
        $this->btncalularstok($this->productoID);
        // Limpiar los campos del formulario
        $this->limpiarproducto2();
        // Emitir un evento para mostrar una alerta y cerrar el modal
        $this->emit('alert', 'REGISTRO EDITADO');
        $this->emit('cerrarmodalproducto');
    }

    public function btncalularstok($id)
    {
        //$crudProducto = new CrudProducto("hola ESTAMOS PASANDO DELSDE EL ADMIN");
        // Llamar a un método de CrudProducto
        //$mensaje = $crudProducto->devuelve_saludo();
        $produ = Productos::find($id);
        $this->stock = $this->obtenerStock($id);
        $produ->update([
            'stock' => $this->stock,
        ]);
        //$this->emit("alert",$mensaje);
    }
    public function Eliminarproducto($id)
    {
        $produc = Productos::find($id);
        if ($produc) {
            $produc->estado = 'eliminado';
            $produc->save();
        }
    }


    public function CambiarEstado($id)
    {
        $produ = Productos::find($id);
        if ($produ->estado == 'activo') {
            $produ->estado = 'inactivo';
            $produ->save();
            $this->emit('alert', 'Cuenta desactivada');
        } elseif ($produ->estado == 'inactivo') {
            $produ->estado = 'activo';
            $produ->save();
            $this->emit('alert', 'Cuenta activa');
        }
    }
    public function capturarImagen()
    {
        $this->emit('abrirmodalcamara');
    }
    public function limpiarcamara()
    {

        //$this->limpiarproducto();
        $this->emit('cerrarmodalcamara');
        $this->campoImagenHabilitado = false;
        $this->emit('abrirmodalproducto');
    }

    public function imagenCapturada($imagenBase64)
    {
        $this->emit('alert', "esta tomada la foto");
        $this->imagenBinaria = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));
        $this->nombreImagen = uniqid('imagen') . '.jpg';
        $this->rutaImagen = 'public/productos/' . $this->nombreImagen;
        Storage::put($this->rutaImagen, $this->imagenBinaria);
        $urlImagenAnterior = parse_url($this->rutaImagen, PHP_URL_PATH);
        $rutaImagenAnterior = str_replace('public', 'storage', $this->rutaImagen);
        $this->rutaImagenfinal = url($rutaImagenAnterior);
        //dd($this->rutaImagenfinal);
        $this->campoImagenHabilitado = true;
        $this->a = true;
        $this->b = true;
        $this->emit('abrirmodalproducto');
    }
    public function Guardarprodcuto2()
    {
        // Asignamos un valor a la variable operation
        $this->operation = 'producNuevo2';
        $this->validate();
        Productos::create([
            'nombre' => $this->Nombreproducto,
            'descripcion' => $this->Descripcionproducto,
            'imagen' => $this->rutaImagenfinal,
            //'imagen' => asset('storage/productos/' . $this->nombreImagen),
            'cantidad_inicial' => $this->Cantidadproducto,
            'stock' => $this->Cantidadproducto,
            'precio' => $this->Precioproducto,
            'unidad_de_medida' => $this->uni_medida,
            'estado' => 'activo',
        ]);
        $this->campoImagenHabilitado = false;
        $this->limpiarproducto2();
        $this->emit('alert', 'Nuevo Registro Guardado');
        $this->emit('cerrarmodalproducto');
    }

    public function render()
    {
        $objv = $this->lista;
        $clientes = Clientes::where('estado', '=', 'activo')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchCliente . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('ci', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        $proveedores = Proveedor::where('estado', '=', 'activo')
            ->where(function ($query) {
                $searchTerm = '%' . $this->SearchCliente . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('ci', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(3);
        $productos = Productos::where('estado', '<>', 'eliminado')
            ->where(function ($query) {
                $searchTerm = '%' . $this->searchProducto . '%';
                $query->orWhere('nombre', 'LIKE', $searchTerm);
                $query->orWhere('descripcion', 'LIKE', $searchTerm);
            })
            ->orderBy('id', 'desc')
            ->paginate(6);
        return view('livewire.modulos-v.producto-index', compact('productos', 'objv', 'clientes','proveedores'));
    }
    public function updatingSearchProducto()
    {
        $this->resetPage();
    }
}
