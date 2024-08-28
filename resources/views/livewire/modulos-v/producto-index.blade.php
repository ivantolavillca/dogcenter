<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">ADMINISTRACIÓN DE PRODUCTOS</h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">Productos</li>
                    </ol>

                </div>

            </div>
            <div class="mb-3 row">
                <!-- Columna para Agregar Especie y su búsqueda -->
                <div class="col-md-6">
                    <hr>
                    <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#idmodalproducto">
                        <i class="bx bxs-plus-circle"></i> AGREGAR PRODUCTOS
                    </button>
                    <div class="row">
                        <div class="col-md-6">
                            @if($objv === null || (is_array($objv) && count($objv) === 0))
                            <p>No hay carros de compras</p>
                            @else

                                @if($estadocompraventa=='compra')
                                <button class="btn btn-primary col-12 mt-3" data-bs-toggle="modal" wire:click="mostrarcarro">
                                    Mostrar carro de compras
                                    <span class="badge bg-danger">
                                        <i class="bx bx-cart"></i>
                                        <span class="text-white">{{ count($objv) }}</span>
                                    </span>
                                </button>
                                @else
                                <button class="btn btn-success col-12 mt-3" data-bs-toggle="modal" wire:click="mostrarcarro">
                                    Mostrar carro de ventas
                                    <span class="badge bg-danger">
                                        <i class="bx bx-cart"></i>
                                        <span class="text-white">{{ count($objv) }}</span>
                                    </span>
                                </button>
                                @endif

                            @endif
                        </div>
                        
                    </div>

                    <div class="col-12 mt-3">
                        <label for="gestiones" class="form-label">Buscar producto: </label>
                        <input type="text" class="form-control" wire:model="searchProducto">
                    </div>
                </div>

            </div>


            @if ($productos->count() > 0)
            <div class="row g-3 col-md-12">
                @foreach ($productos as $produ)
                <div class="col-md-6">
                    <div class="card radius-10 border-start border-1 border-5 border-info " style="border-width: 1px 1px 1px 7px;">
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4 class="my-0 text-info text-center">
                                <i class="bx bx-male"></i> PRODUCTO <span class="mx-5">
                                    @if($produ->estado=='activo')
                                        @if($estadocompraventa=="")
                                        <button class="btn btn-primary" wire:click="btnCarros({{ $produ->id }}, '{{ $produ->nombre }}')">
                                            <i class="bx bx-cart"></i> Agregar una Compra
                                        </button>
                                        <button class="btn btn-success" wire:click="btnCarrosventa({{ $produ->id }}, '{{ $produ->nombre }}')">
                                            <i class="bx bx-cart"></i> Agregar una Venta
                                        </button>
                                        @elseif($estadocompraventa=='compra')
                                        <button class="btn btn-primary" wire:click="btnCarros({{ $produ->id }}, '{{ $produ->nombre }}')">
                                            <i class="bx bx-cart"></i> Agregar una Compra
                                        </button>
                                        @else
                                        <button class="btn btn-success" wire:click="btnCarrosventa({{ $produ->id }}, '{{ $produ->nombre }}')">
                                            <i class="bx bx-cart"></i> Agregar una Venta
                                        </button>
                                        @endif
                                    @endif
                            </h4>

                            <div class="float-end bg-info text-white m-0 p-1"><b>Nº {{ $produ->id }}</b></div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center row g-3">
                                <ul class="list-group col-md-7 border-2">
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home text-info"></i> <b class="text-info "> NOMBRE DEL PRODUCTO</b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $produ->nombre }} </b>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home text-info"></i> <b class="text-info "> DESCRIPCION DEL PRODUCTO</b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $produ->descripcion }} </b>
                                            </span>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home text-info"></i> <b class="text-info ">CANTIDAD INICIAL DEL PRODUCTO</b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $produ->cantidad_inicial }} </b>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home text-info"></i> <b class="text-info "> STOCK DEL PRODUCTO</b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $produ->stock }} </b>
                                            </span>
                                        </div>
                                        @if($produ->estado=='activo')
                                        <button class="btn btn-sm btn-success" wire:click="btncalularstok({{$produ->id}})">
                                            CALCULAR STOCK
                                        </button>
                                        @elseif($produ->estado=='inactivo')
                                        <button class="btn btn-sm btn-success" wire:click="btncalularstok({{$produ->id}})" disabled>
                                            CALCULAR STOCK
                                        </button>
                                        @endif
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home text-info"></i> <b class="text-info ">
                                                <label class="form-label text-info">PRECIO DEL PRODUCTO POR
                                                    @if($produ->unidad_de_medida == 'ml')
                                                    MILILITROS
                                                    @elseif($produ->unidad_de_medida == 'frascom')
                                                    FRASCO COMPRIMIDO
                                                    @else
                                                    UNIDAD
                                                    @endif
                                                    <span class="text-danger">*</span>

                                                </label>
                                            </b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $produ->precio }} </b>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="col-md-5">
                                    <div class="row">

                                        <div>
                                            <i class="fs-6 bx bxs-home text-info"></i> <b class="text-info ">IMAGEN DEL PRODUCTO</b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <img src="{{ $produ->imagen }}" alt="Imagen del Producto" class="img-fluid">
                                            </span>
                                        </div>


                                        <div class="col-md-6">
                                            <p class="mb-0 text-secondary">ESTADO</p>
                                            @if($produ->estado=='activo')
                                            <button class="btn btn-sm btn-success" wire:click="CambiarEstado({{$produ->id}})">
                                                ACTIVO
                                            </button>
                                            @elseif($produ->estado=='inactivo')
                                            <button class="btn btn-sm btn-danger" wire:click="CambiarEstado({{$produ->id}})">
                                                INACTIVO
                                            </button>
                                            @endif

                                        </div>
                                        <div class="col-md-6 border-start border-0 border-2">
                                            <p class="mb-0 text-secondary">ACCIÓN</p>
                                            @if($produ->estado=='activo')
                                            <button class="btn btn-danger" wire:click.prevent="$emit('borrarproducto', {{ $produ->id }})"><i class="bx bxs-trash"></i></button>
                                            <button class="btn btn-warning" wire:click="editarproducto({{$produ->id}})"><i class="bx bx-pencil"></i></button>
                                            @elseif($produ->estado=='inactivo')
                                            <button class="btn btn-danger" wire:click.prevent="$emit('borrarproducto', {{ $produ->id }})" disabled><i class="bx bxs-trash"></i></button>
                                            <button class="btn btn-warning" wire:click="editarproducto({{$produ->id}})" disabled><i class="bx bx-pencil"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 ">
                                        <p class="mb-0 text-secondary">FECHA DE CREACIÓN</p>
                                        <h6 class="my-1"><i class="bx "></i>
                                            {{ $produ->created_at }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @else
            <div class="px-5 py-3 border-gray-200  text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $productos->links() }}
            </div>

            @include('livewire.modal-productos.modalproducto')
            @include('livewire.modal-camara.modalcamara')
            @include('livewire.modal-carros.modalcarro')
            @include('livewire.modal-lupa.modallupa')
        </div>
    </div>

</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalproducto', function() {
            $('#idmodalproducto').modal('hide');
        });
        Livewire.on('abrirmodalproducto', function() {
            $('#idmodalproducto').modal('show');
        });
        Livewire.on('IDmodlupacerrar', function() {
            $('#IDmodlupa').modal('hide');
        });
        Livewire.on('abrirlupaID', function() {
            $('#IDmodlupa').modal('show');
        });
        Livewire.on('cerrarlupaID', function() {
            $('#IDmodlupa').modal('hide');
        });
        Livewire.on('abrirmodalcarro', function() {
            $('#modalcarroBD').modal('show');
        });
        Livewire.on('cerrarmodalcarro', function() {
            $('#modalcarroBD').modal('hide');
        });
        Livewire.on('abrirmodalproducto2', function(ruta) {
            $('#idmodalproducto').modal('show');
            $('#imagenProductoModal').attr('src', ruta);
        });

        Livewire.on('cerrarmodalcamara', function() {
            $('#capturarImagenModal').modal('hide');
        });

    });

    livewire.on('borrarproducto', id_producto => {
        Swal.fire({
            title: 'Esta seguro/segura ?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                livewire.emit('Eliminarproducto', id_producto);
                Swal.fire(
                    'Eliminado!',
                    'La especie ha sido eliminado..',
                    'Exitosamente'
                )
            } else {
                Swal.fire({
                    title: 'Su registro de especie esta seguro...',
                    icon: 'info',
                })
            }
        })
    });

    Livewire.on('mensas', function() {
        Swal.fire({
            title: 'Esta seguro/segura ?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                livewire.emit('Eliminarproducto');
                Swal.fire(
                    'Eliminado!',
                    'La especie ha sido eliminado..',
                    'Exitosamente'
                )
            } else {
                Swal.fire({
                    title: 'Su registro de especie esta seguro...',
                    icon: 'info',
                })
            }
        })
    });
</script>
<!-- Script en tu vista -->

<!-- <script async src="https://docs.opencv.org/4.5.4/opencv.js" onload="onOpenCvReady();" type="text/javascript"></script>
 -->

<script>
    document.addEventListener('livewire:load', function() {
        const cameraFeed = document.getElementById('cameraFeed');
        let stream;

        Livewire.on('refreshCamara', function(facingMode) {
            if (stream) {
                stream.getTracks().forEach(function(track) {
                    track.stop();
                });
            }

            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: facingMode
                    }
                })
                .then(function(newStream) {
                    stream = newStream;
                    cameraFeed.srcObject = stream;
                })
                .catch(function(error) {
                    console.error('Error al cambiar la cámara:', error);
                });
        });
        // todo para enviar al cotrolador 

        Livewire.on('capturarBtn1', function() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const width = cameraFeed.videoWidth;
            const height = cameraFeed.videoHeight;
            canvas.width = width;
            canvas.height = height;

            // Ajustar el enfoque
            context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

            // Obtener la imagen capturada
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            // Convertir la imagen a una matriz de píxeles OpenCV
            const src = cv.matFromImageData(imageData);

            // Aplicar un filtro de mejora de nitidez (unsharp mask)
            const dst = new cv.Mat();
            cv.GaussianBlur(src, dst, {
                width: 0,
                height: 0
            }, 3);
            cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);
            // Convertir la imagen de salida a un objeto de imagen
            const outputImageData = new ImageData(
                new Uint8ClampedArray(dst.data),
                dst.cols,
                dst.rows
            );

            // Renderizar la imagen de salida en el lienzo
            context.putImageData(outputImageData, 0, 0);

            // Obtener la imagen procesada
            const processedImageData = canvas.toDataURL('image/png', 1.0);

            // Enviar la imagen procesada al componente Livewire
            Livewire.emit('imagenCapturada', processedImageData);

            // Cerrar la modal
            $('#capturarImagenModal').modal('hide');

            // Liberar memoria
            src.delete();
            dst.delete();
        });

    });
</script>


@endpush