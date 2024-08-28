<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">RECEPCIÓN </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Recepción</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">


                        <div class="col-12 text-center">
                            <h3 class="text-primary"> CREAR NUEVO CLIENTE</h3>
                        </div>


                        <fieldset class="border border-primary p-2">
                            <legend class="float-none w-auto text-primary">DATOS DEL CLIENTE</legend>

                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="form-label"> <i class="fas fa-address-card"></i>Cédula de
                                        identidad<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="CiDelCliente"
                                        placeholder="Ej. 6443567" maxlength="12">
                                    @error('CiDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4  mt-3">
                                    <label class="form-label"> <i class="fas fa-address-card"></i> Expecido de C.I.
                                        <span class="text-danger">*</span></label>
                                    <br>
                                    <select wire:ignore.self class="form-select" wire:model="ExpedidoDelCliente">
                                        <option value="">[Seleccione una opción]</option>
                                        <option value="LP">LP</option>
                                        <option value="OR">OR</option>
                                        <option value="CBBA">CBBA</option>
                                        <option value="CH">CH</option>
                                        <option value="PT">PT</option>
                                        <option value="SC">SC</option>
                                        <option value="BN">BN</option>
                                        <option value="TJ">TJ</option>
                                        <option value="PD">PD</option>
                                    </select>
                                    @error('ExpedidoDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4  mt-3">
                                    <label class="form-label"><i class="fas fa-mail-bulk"></i> Correo electrónico<span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" wire:model="CorreoDelCliente"
                                        placeholder="nuevocliente@gmail.com">
                                    @error('CorreoDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4  mt-3">
                                    <label class="form-label"> <i class="fas fa-user-check"></i> Nombre del cliente
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="NombreDelCliente"
                                        placeholder="Ej. Juan">
                                    @error('NombreDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4  mt-3">
                                    <label class="form-label"> <i class="fas fa-user-check"></i> Apellidos del cliente
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="ApellidoDelCliente"
                                        placeholder="Ej. Perez Perez">
                                    @error('ApellidoDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4  mt-3">
                                    <label class="form-label"> <i class="fas fa-code"></i> Código del cliente <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="CodigoDelCliente"
                                        placeholder="DGC-________" disabled style="color: rgb(255, 0, 0)">
                                    @error('CodigoDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4  mt-3">
                                    <label class="form-label"><i class="fas fa-phone"></i> Telefono del cliente <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model="TelefonoDelCliente"
                                        placeholder="Ej. 74324323" maxlength="10">
                                    @error('TelefonoDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-8  mt-3">
                                    <label class="form-label"><i class="fas fa-house-damage"></i> Domicilio <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="DomicilioDelCliente"
                                        placeholder="Ej. Z/ xxxxx C/ xxxxxx N° xxxxx">
                                    @error('DomicilioDelCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-primary p-2 mt-3">
                            <legend class="float-none w-auto text-primary">DATOS DE LA MASCOTA</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">NOMBRE DE LA MASCOTA</label>
                                    <input type="text" class="form-control" wire:model="NombreMascota"
                                        placeholder="Ej. Fresita">
                                    @error('NombreMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ESPECIE MASCOTA</label>

                                    <select class="form-select" wire:model="EspecieMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        <option value="CrearEspecie">Desea crear nueva especie? </option>
                                        @foreach ($especies as $especie)
                                            <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                                        @endforeach

                                    </select>

                                    @error('EspecieMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    @if ($EspecieMascota == 'CrearEspecie')
                                        <br>
                                        <label class="form-label">Ingrese el nombre de la especie *</label>
                                        <input type="text" wire:model="NuevaEspecie" class="form-control"
                                            placeholder="Ej. Felino">
                                        @error('NuevaEspecie')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center"> <button class="btn btn-success"
                                                wire:click="CrearEspecie" title="GUARDAR ESPECIE"><i
                                                    class="mdi mdi-content-save-alert-outline"></i></button>
                                            <button class="btn btn-danger" wire:click="CancelarCrearEspecie"
                                                title="CANCELAR"><i class="mdi mdi-file-cancel-outline"></i></button>
                                        </div>
                                    @endif

                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">RAZA MASCOTA</label>

                                    <select class="form-select" wire:model="RazaMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        <option value="CrearRaza">Desea crear nueva raza? </option>
                                        @foreach ($razas as $raza)
                                            <option value="{{ $raza->id }}">{{ $raza->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('RazaMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($RazaMascota == 'CrearRaza')
                                        <br>
                                        <label class="form-label">Ingrese el nombre de la raza *</label>
                                        <input type="text" wire:model="NuevaRaza" class="form-control"
                                            placeholder="Ej. chapi">
                                        @error('NuevaRaza')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center"> <button class="btn btn-success"
                                                wire:click="CrearRaza"><i
                                                    class="mdi mdi-content-save-alert-outline"></i></button>
                                            <button class="btn btn-danger" wire:click="CancelarCrearRaza"><i
                                                    class="mdi mdi-file-cancel-outline"></i></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">SEXO MASCOTA</label>
                                    <select class="form-select" wire:model="SexoMascota">
                                        <option value="">[ Seleccione una opción ]</option>

                                        <option value="M">MACHO</option>
                                        <option value="H">HEMBRA</option>

                                    </select>
                                    @error('SexoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">EDAD APROXIMADA DE LA MASCOTA</label>
                                    <input type="text" class="form-control" wire:model="EdadMascota">
                                    @error('EdadMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">COLOR DE LA MASCOTA</label>
                                    <select class="form-select" wire:model="ColorMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        <option value="CrearColor">Desea crear un nuevo color de mascota? </option>
                                        @foreach ($colores as $color)
                                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                        @endforeach


                                    </select>
                                    @error('ColorMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($ColorMascota == 'CrearColor')
                                        <br>
                                        <label class="form-label">Ingrese el color de la mascota *</label>
                                        <input type="text" wire:model="NuevoColor" class="form-control"
                                            placeholder="Ej. Blanco">
                                        @error('NuevoColor')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center"> <button class="btn btn-success"
                                                wire:click="CrearColor"><i
                                                    class="mdi mdi-content-save-alert-outline"></i></button>
                                            <button class="btn btn-danger" wire:click="CancelarCreaColor"><i
                                                    class="mdi mdi-file-cancel-outline"></i></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">LA MASCOTA ESTA ESTERILIZADA?</label>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="Checkesterilizacion"
                                            wire:model="EsterilizadoMascota" switch="success" />
                                        <label class="form-check-label" for="Checkesterilizacion" data-on-label="SI"
                                            data-off-label="NO">

                                        </label>
                                    </div>
                                    @error('EsterilizadoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if ($rutaImagenfinal)
                                    <div class="col-md-6">
                                        <label class="form-label">FOTO DE MASCOTA</label>
                                        <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                            class="img-fluid">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success mr-2"
                                                wire:click="eliminarfoto">DESEA TOMAR OTRA FOTO ?</button>

                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label class="form-label">FOTO DE MASCOTA</label>
                                        <div
                                            class="border border-primary rounded   embed-responsive embed-responsive-16by9">
                                            <video width="100%" height="auto" id="cameraFeed" autoplay></video>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-warning mr-2"
                                                wire:click="cambiarCamarat">Usar camara trasera</button>
                                            <button type="button" class="btn btn-outline-success"
                                                wire:click="cambiarCamarad">Usar camara Frontal</button>
                                            @if (!($facingMode == 'sin'))
                                                <button type="button" class="btn btn-outline-primary"
                                                    id="capturarBtn">Tomar Captura</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </fieldset>

                        <div class="text-center justify-content-center mt-3">
                            <button class="btn btn-outline-success btn-lg"
                                wire:click="RegistrarCliente">REGISTRAR</button>
                            <button class="btn btn-outline-info btn-lg" wire:click="PonerEnColaACliente"
                                @if (!$CodigoAnterior) disabled @endif> PONER EN COLA @if ($CodigoAnterior)
                                    A {{ $CodigoAnterior }}
                                @endif
                            </button>
                            <a href="{{ route('clientes') }}"class="btn btn-outline-primary btn-lg">IR AL CLIENTE</a>
                        </div>

                    </div>


                </div>

            </div>


        </div>
    </div>
</div>
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {


            Livewire.on('refreshCamara', function(facingMode) {

                const cameraFeed = document.getElementById('cameraFeed');
                let stream;
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
                document.getElementById('capturarBtn').addEventListener('click', function() {

                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    const width = cameraFeed.videoWidth;
                    const height = cameraFeed.videoHeight;
                    canvas.width = width;
                    canvas.height = height;
                    context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);
                    const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                    const src = cv.matFromImageData(imageData);
                    const dst = new cv.Mat();
                    cv.GaussianBlur(src, dst, {
                        width: 0,
                        height: 0
                    }, 3);
                    cv.addWeighted(src, 1.5, dst, -0.5, 0, dst);
                    const outputImageData = new ImageData(
                        new Uint8ClampedArray(dst.data),
                        dst.cols,
                        dst.rows
                    );
                    context.putImageData(outputImageData, 0, 0);
                    const processedImageData = canvas.toDataURL('image/jpeg', 1.0);
                    Livewire.emit('imagenCapturada', processedImageData);
                    // $('#capturarImagenModal').modal('hide');
                    stopStream();
                });

                function stopStream() {
                    if (stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });

                    }
                }
            });




            Livewire.on('cerrarmodalcrearclientee', function() {
                $('#modalcrearcliente').modal('hide');
            });
            Livewire.on('abrirmodaleditarcliente', function() {
                $('#modaleditarcliente').modal('show');
            });
            Livewire.on('cerrarmodaleditarcliente', function() {
                $('#modaleditarcliente').modal('hide');
            });
            Livewire.on('AbrirModalCrearMascota', function() {
                $('#modalcrearmascota').modal('show');
            });
            Livewire.on('cerrarModarCrearMascota', function() {
                $('#modalcrearmascota').modal('hide');
            });
            Livewire.on('abrirmodaleditarmascota', function() {
                $('#modaleditarmascota').modal('show');
            });
            Livewire.on('cerrarmodaleditarmascota', function() {
                $('#modaleditarmascota').modal('hide');
            });
            Livewire.on('AbrirModalVerMascotas', function() {
                $('#modalvermascotas').modal('show');
            });
            Livewire.on('CerrarModalVerMascotas', function() {
                $('#modalvermascotas').modal('hide');
            });

        });
        livewire.on('borrarcliente', id_cliente => {
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
                    livewire.emit('eliminarcliente', id_cliente);
                    Swal.fire(
                        'Eliminado!',
                        'El cliente ha sido eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su registro de cliente esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });
        livewire.on('borrarmascota', id_mascota => {
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
                    livewire.emit('EliminarMascota', id_mascota);
                    Swal.fire(
                        'Eliminado!',
                        'El cliente ha sido eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su registro de Mascota esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });
    </script>
@endpush
