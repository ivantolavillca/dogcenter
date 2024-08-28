<div>



    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">CONTENIDO PRINCIPAL </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Contenido Principal</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        {{-- <label for="estilo_asignaturas" class="d-block mb-0 user-select-none">Listado Grid</label>
                            <input type="checkbox" id="estilo_asignaturas" switch="bool" {{$estilo_asignaturas==true? "checked": ""}} wire:model="estilo_asignaturas">
                            <label class="form-label" for="estilo_asignaturas" data-on-label="Si" data-off-label="No"></label>  --}}
                    </div>




                    <div class="row g-3 col-md-12">

                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label for="projectname" class="form-label">NOMBRE DE LA INSTITUCION:</label>
                                <input type="text"class="form-control" wire:model="nombre">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">TITULO DE LA INSTITUCION:</label>
                                <input type="text"class="form-control" wire:model="titulo">
                                @error('titulo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">SUBTITULO DE LA INSTITUCION:</label>
                                <input type="text"class="form-control" wire:model="subtitulo">
                                @error('subtitulo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="project-overview" class="form-label">MISION</label>
                                <textarea class="form-control" id="project-overview" rows="5" wire:model="mision"></textarea>
                                @error('mision')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="project-overview" class="form-label">VISION</label>
                                <textarea class="form-control" id="project-overview" rows="5" wire:model="vision"></textarea>
                                @error('vision')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="project-overview" class="form-label">HISTORIA</label>
                                <textarea class="form-control" id="project-overview" rows="5" wire:model="historia"></textarea>
                                @error('historia')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="mb-3">
                                <label for="projectname" class="form-label">URL INSTAGRAM:</label>
                                <input type="text"class="form-control" wire:model="instagram">
                                @error('instagram')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">URL TIKTOK:</label>
                                <input type="text"class="form-control" wire:model="tiktok">
                                @error('tiktok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="projectname" class="form-label">URL FACEBOOK:</label>
                                <input type="text"class="form-control" wire:model="facebook">
                                @error('facebook')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">URL YOUTUBE:</label>
                                <input type="text"class="form-control" wire:model="youtube">
                                @error('youtube')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">URL TWITTER:</label>
                                <input type="text"class="form-control" wire:model="twitter">
                                @error('twitter')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">URL TELEFONO:</label>
                                <input type="text"class="form-control" wire:model="telefono">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">DIRECCIÓN:</label>
                                <input type="text"class="form-control" wire:model="direccion">
                                @error('direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">UBICACION MAPS:</label>
                                <input type="text"class="form-control" wire:model="ubicacion_maps">
                                @error('ubicacion_maps')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

 
                        </div> <!-- end col-->
                       
                        <div class="col-xl-6 border-start  border-5">
                            <hr class="border-start  border-5">
                            <div class="mb-3">
                                <label for="projectname" class="form-label">IMAGEN ACTUAL LOGO:</label>
                                <div class="tab-pane active show" id="product-1-item">
                                    <img src="{{ $logo }}" alt=""
                                        class="img-fluid mx-auto d-block rounded"
                                        style="width: 200px; height: 200px;">
                                </div>
                            </div>
                            <div class="mb-3">

                                <input type="file"class="form-control" wire:model="logo2"
                                    accept=".jpg, .jpeg, .png, .gif">
                                @error('logo2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 " wire:loading wire:target="logo2">
                                <span>Cargando imagen...</span>
                            </div>

                            <!-- Vista previa de la imagen -->
                            @if ($logo2)
                                <div class="mb-3">

                                    <label class="form-label">Vista Previa:</label>
                                    <br>
                                    <center><img src="{{ $logo2->temporaryUrl() }}" alt="Vista Previa de la Imagen"
                                            class="img-thumbnail" style="width: 200px; height: 200px;"> </center>



                                </div>
                            @endif
<hr class="border-start  border-5">
                            <div class="mb-3">
                                <label for="projectname" class="form-label">IMAGEN ACTUAL BANNER 1:</label>
                                <div class="tab-pane active show" id="product-1-item">
                                    <img src="{{ $banner1 }}" alt=""
                                        class="img-fluid mx-auto d-block rounded"
                                        style="width: 200px; height: 200px;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">IMAGEN BANNER 1:</label>
                                <input type="file"class="form-control" wire:model="banner1_2"
                                    accept=".jpg, .jpeg, .png, .gif">
                                @error('banner1_2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 " wire:loading wire:target="banner1_2">
                                <span>Cargando imagen...</span>
                            </div>

                            <!-- Vista previa de la imagen -->
                            @if ($banner1_2)
                                <div class="mb-3">

                                    <label class="form-label">Vista Previa:</label>
                                    <br>
                                    <center><img src="{{ $banner1_2->temporaryUrl() }}"
                                            alt="Vista Previa de la Imagen" class="img-thumbnail"
                                            style="width: 200px; height: 200px;"> </center>



                                </div>
                            @endif
                            <hr class="border-start  border-5">
                            <div class="mb-3">
                                <label for="projectname" class="form-label">IMAGEN ACTUAL BANNER2:</label>
                                <div class="tab-pane active show" id="product-1-item">
                                    <img src="{{ $banner2 }}" alt=""
                                        class="img-fluid mx-auto d-block rounded"
                                        style="width: 200px; height: 200px;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="projectname" class="form-label">IMAGEN BANNER 2:</label>
                                <input type="file"class="form-control" wire:model="banner2_2"
                                    accept=".jpg, .jpeg, .png, .gif">
                                @error('banner2_2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 " wire:loading wire:target="banner2_2">
                                <span>Cargando imagen...</span>
                            </div>

                            <!-- Vista previa de la imagen -->
                            @if ($banner2_2)
                                <div class="mb-3">

                                    <label class="form-label">Vista Previa:</label>
                                    <br>
                                    <center><img src="{{ $banner2_2->temporaryUrl() }}"
                                            alt="Vista Previa de la Imagen" class="img-thumbnail"
                                            style="width: 200px; height: 200px;"> </center>



                                </div>
                            @endif
                            <hr class="border-start  border-5">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1"
                                wire:click="guardarinstitucion"><i class="fe-check-circle me-1"></i> GUARDAR Y
                                EDITAR</button>

                        </div>
                    </div>

                </div>

            </div>






            {{-- MODAL VER MASCOTAS  --}}



        </div>
        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('cerrarmodalcrearcliente', function() {
                        $('#modalcrearcliente').modal('hide');
                    });
                    Livewire.on('abrirmodaleditarcliente', function() {
                        $('#modaleditarcliente').modal('show');
                    });
                    Livewire.on('AbrirModalCrearMascota', function() {
                        $('#modalcrearmascota').modal('show');
                    });
                    Livewire.on('cerrarModarCrearMascota', function() {
                        $('#modalcrearmascota').modal('hide');
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

                            // livewire.emitTo('servidor-index', 'delete', ServidorId);
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
