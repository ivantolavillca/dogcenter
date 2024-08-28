<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">INTITUCION</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active"> Institución</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-widgets py-3">

                        <div class="text-center">
                            <div class="">
                                <img src="{{ asset('assets/dashboard/assets/images/upea2.png') }}" alt=""
                                    class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                </div>
                            </div>

                            <div class="mt-3 ">
                                <a class="text-reset fw-medium font-size-16">DATOS DE LA INTTITUCIÓN</a>
                                <p class="text-body mt-1 mb-1">DPTO. IDIOMAS</p>


                            </div><br> <br>
                            {{-- <div class="text-center">

                                    <h3>DATOS PERSONALES</h3>
                                </div> --}}
                            <div class="row mt-4 border border-start-0 border-end-0 p-3">
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="nombre" class="form-label">NOMBRE DE LA INSTITUCIÓN:</label>
                                        <input type="text" class="form-control @error('nombre') border-danger @enderror" wire:model="nombre" id="nombre">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="titulo" class="form-label">TITULO O DETALLE DE LA
                                            INSTITUCIÓN</label>
                                        <input type="text" class="form-control @error('titulo') border-danger @enderror" wire:model="titulo" id="titulo">
                                        @error('titulo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="sub_titulo" class="form-label">OTRA CARACTERISTICA</label>
                                        <input type="text" class="form-control @error('sub_titulo') border-danger @enderror" wire:model="sub_titulo" id="sub_titulo">
                                        @error('sub_titulo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="mision" class="form-label">MISIÓN</label>
                                        <textarea wire:model="mision" class="form-control @error('mision') border-danger @enderror" id="mision"></textarea>
                                        @error('mision')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="vision" class="form-label">VISIÓN</label>
                                        <textarea wire:model="vision" class="form-control @error('vision') border-danger @enderror" id="vision"></textarea>
                                        @error('vision')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="historia" class="form-label">HISTORIA</label>
                                        <textarea wire:model="historia"class="form-control @error('historia') border-danger @enderror" id="historia"></textarea>
                                        @error('historia')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="instagram" class="form-label">URL INSTAGRAM:</label>
                                        <input type="text" class="form-control @error('instagram') border-danger @enderror" wire:model="instagram" id="instagram">
                                        @error('instagram')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="tiktok" class="form-label">URL TIKTOK</label>
                                        <input type="text" class="form-control @error('tiktok') border-danger @enderror" wire:model="tiktok" id="tiktok">
                                        @error('tiktok')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="facebook" class="form-label">URL FACEBOOK</label>
                                        <input type="text" class="form-control @error('facebook') border-danger @enderror" wire:model="facebook" id="facebook">
                                        @error('facebook')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="youtube" class="form-label">URL YOUTUBE</label>
                                        <input type="text" class="form-control @error('youtube') border-danger @enderror"wire:model="youtube" id="youtube">
                                        @error('youtube')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="twitter" class="form-label">URL TWITTER</label>
                                        <input type="text" class="form-control @error('twitter') border-danger @enderror"wire:model="twitter" id="twitter">
                                        @error('twitter')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="telefono" class="form-label">TELEFONO - CELULAR</label>
                                        <input type="text" class="form-control @error('telefono') border-danger @enderror"wire:model="telefono" id="telefono">
                                        @error('telefono')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="logo_imagen_agregar" class="form-label">LOGO <small>Escala 1:1</small></label>
                                        <input type="file" accept=".jpg,.png" id="logo_imagen_agregar"
                                            class="form-control @error('logo_imagen_agregar') border-danger @enderror" wire:model="logo_imagen_agregar" >
                                        <img src="{{ $logo }}" style="width: 200px; height: 200px;">
                                        @error('logo_imagen_agregar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                    <div class="mb-3 " wire:loading wire:target="logo_imagen_agregar">
                                        <span>Cargando imagen...</span>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    @if ($logo_imagen_agregar)
                                        <div class="mb-3">

                                            <label class="form-label">Vista Previa:</label>
                                            <br>
                                            <center><img src="{{ $logo_imagen_agregar->temporaryUrl() }}"
                                                    alt="Vista Previa de la Imagen" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;"> </center>



                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="banner_uno" class="form-label">BANNER 1 <small>(1920px)<span class="text-primary">x</span>(1500px) </small></label>
                                        <input type="file"accept=".jpg,.png"
                                            class="form-control @error('banner_uno') border-danger @enderror"wire:model="banner_uno" id="banner_uno">
                                        <img src="{{ $banner1 }}" style="width: 200px; height: 200px;">
                                        @error('banner_uno')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                    <div class="mb-3 " wire:loading wire:target="banner_uno">
                                        <span>Cargando imagen...</span>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    @if ($banner_uno)
                                        <div class="mb-3">

                                            <label class="form-label">Vista Previa:</label>
                                            <br>
                                            <center><img src="{{ $banner_uno->temporaryUrl() }}"
                                                    alt="Vista Previa de la Imagen" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;"> </center>



                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="banner_dos" class="form-label">BANNER 2 <small>(558px)<span class="text-primary">x</span>(558px)</small></label>
                                        <input type="file"accept=".jpg,.png"
                                            class="form-control @error('banner_dos') border-danger @enderror" wire:model="banner_dos" id="banner_dos">
                                        <img src="{{ $banner2 }}" style="width: 200px; height: 200px;">
                                        @error('banner_dos')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                    <div class="mb-3 " wire:loading wire:target="banner_dos">
                                        <span>Cargando imagen...</span>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    @if ($banner_dos)
                                        <div class="mb-3">

                                            <label class="form-label">Vista Previa:</label>
                                            <br>
                                            <center><img src="{{ $banner_dos->temporaryUrl() }}"
                                                    alt="Vista Previa de la Imagen" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;"> </center>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="rector_nombre" class="form-label">RECTOR <small>(400px)<span class="text-primary">x</span>(600px)</small></label>
                                        <input type="text" class="form-control  @error('rector_nombre') border-danger @enderror" wire:model="rector_nombre" id="rector_nombre">
                                        @error('rector_nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <img src="{{ $rector_imagen }}" style="width: 200px; height: 200px;" for="rector_imagen_agregar">
                                        <input type="file" accept=".jpg,.png"class="form-control @error('rector_imagen_agregar') border-danger @enderror"
                                            wire:model="rector_imagen_agregar">
                                        @error('rector_imagen_agregar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                    <div class="mb-3 " wire:loading wire:target="rector_imagen_agregar">
                                        <span>Cargando imagen...</span>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    @if ($rector_imagen_agregar)
                                        <div class="mb-3">

                                            <label class="form-label">Vista Previa:</label>
                                            <br>
                                            <center><img src="{{ $rector_imagen_agregar->temporaryUrl() }}"
                                                    alt="Vista Previa de la Imagen" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;"> </center>



                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="vicerector_nombre" class="form-label">VICERECTOR <small>(400px)<span class="text-primary">x</span>(600px)</small></label>
                                        <input type="text" class="form-control @error('vicerector_nombre') border-danger @enderror"wire:model="vicerector_nombre" id="vicerector_nombre">
                                        @error('vicerector_nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img src="{{ $vicerector_imagen }}" style="width: 200px; height: 200px;">
                                        <input type="file"accept=".jpg,.png"
                                            class="form-control @error('vicerector_imagen_agregar') border-danger @enderror" wire:model="vicerector_imagen_agregar">
                                        @error('vicerector_imagen_agregar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                    <div class="mb-3 " wire:loading wire:target="vicerector_imagen_agregar">
                                        <span>Cargando imagen...</span>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    @if ($vicerector_imagen_agregar)
                                        <div class="mb-3">

                                            <label class="form-label">Vista Previa:</label>
                                            <br>
                                            <center><img src="{{ $vicerector_imagen_agregar->temporaryUrl() }}"
                                                    alt="Vista Previa de la Imagen" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;"> </center>



                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        <label for="jefe_nombre" class="form-label">JEFE DEL DPTO. IDIOMAS <small>(400px)<span class="text-primary">x</span>(600px)</small></label>
                                        <input type="text" class="form-control @error('jefe_nombre') border-danger @enderror" wire:model="jefe_nombre" id="jefe_nombre">
                                        @error('jefe_nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img src="{{ $jefe_imagen }}"style="width: 200px; height: 200px;">
                                        <input type="file"accept=".jpg,.png"
                                            class="form-control @error('jefe_imagen_agregar') border-danger @enderror" wire:model="jefe_imagen_agregar">
                                   
                                        @error('jefe_imagen_agregar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </h6>
                                    <div class="mb-3 " wire:loading wire:target="jefe_imagen_agregar">
                                        <span>Cargando imagen...</span>
                                    </div>

                                    <!-- Vista previa de la imagen -->
                                    @if ($jefe_imagen_agregar)
                                        <div class="mb-3">

                                            <label class="form-label">Vista Previa:</label>
                                            <br>
                                            <center><img src="{{ $jefe_imagen_agregar->temporaryUrl() }}"
                                                    alt="Vista Previa de la Imagen" class="img-thumbnail"
                                                    style="width: 200px; height: 200px;"> </center>



                                        </div>
                                    @endif
                                </div>



                            </div>
                            <div class="text-center">
                                <button class="btn btn-success" wire:click.prevent="$emit('updatedatos')">EDITAR DATOS
                                </button>

                            </div>
                            <div class="mt-4">

                                <ui class="list-inline social-source-list">
                                    <li class="list-inline-item">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle">
                                                <i class="mdi mdi-facebook"></i>
                                            </span>
                                        </div>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </span>
                                        </div>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-danger">
                                                <i class="mdi mdi-google-plus"></i>
                                            </span>
                                        </div>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-pink">
                                                <i class="mdi mdi-instagram"></i>
                                            </span>
                                        </div>
                                    </li>
                                </ui>

                            </div>
                        </div>

                    </div>
                </div>
            </div>




        </div>




    </div>
    @push('navi-js')
        <script>
            livewire.on('updatedatos', () => {
                Swal.fire({
                    title: '¿Está seguro/a de actualizar sus datos de la institucion?',
                    text: '¡No podrá revertir esto!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, editar datos!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emit('updateinstitucion');

                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                            'Datos seguros',
                            'Sus datos personales están seguros.',
                            'info'
                        );
                    }
                });
            });
        </script>
    @endpush
</div>
