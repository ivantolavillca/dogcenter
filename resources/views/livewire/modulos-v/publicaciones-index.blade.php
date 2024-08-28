@push('style-custom.css')
    <style>
        .popup {
            cursor: pointer;
        }
    </style>
@endpush
<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">PUBLICACIONES</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Publicaciones</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary waves-effect waves-light col-md-6 "
                                wire:click="crear_publicacion">
                                <i class="bx bxs-plus-circle">AGREGAR</i></button> {{-- data-bs-toggle="modal" data-bs-target="#crearpublicacion" --}}
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-6" wire:model="search"
                                    placeholder="Buscar...">
                            </div>
                        </div>
                    </div>
                    <div class="card-deck-wrapper">
                        <div class="row g-3"> {{-- card-group gap-4 --}}
                            @foreach ($publicaciones as $pu)
                                <div class="card mb-4 col-md-4">
                                    <div class="card-title text-center bg-success bg-gradient text-white">
                                        <div class="float-end bg-white text-secondary m-0 p-1 border border-1 border-success"
                                            title="Modificado por"><b>DC</b></div>
                                        <h2 style="color: black">{{ $pu->tipo }}</h2>
                                    </div>

                                    <div class="ratio ratio-16x9">
                                        @if ($pu->tipo == 'Horario')
                                            <iframe src="{{ $pu->publicaciones_imagen_url }}" frameborder="0"></iframe>
                                        @elseif($pu->publicaciones_tipo == 'Video')
                                            <div class="mb-3 col-lg-12 ratio ratio-16x9">
                                                <iframe type="text/html" class=""
                                                    src="https://www.youtube.com/embed/{{ $pu->imagen_url }}?disablekb=1&modestbranding=1"
                                                    frameborder="0" allowfullscreen>
                                                </iframe> {{-- M7lc1UVf-VE --}}
                                            </div>
                                        @else
                                            {{-- comunicado - convocatoria --}}
                                            <img class="card-img-top img-fluid " src="{{ $pu->imagen }}"
                                                alt="Image {{ $pu->titulo }}">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">{{ $pu->titulo }}</h4>
                                        <p class="card-text">{{ $pu->descripcion }}.</p>
                                        <p class="card-text text-center">
                                            {{-- <small class="text-muted">Last updated 3 mins ago</small> --}}
                                            <button type="button" title="Editar"
                                                class="btn btn-outline-success waves-effect waves-light"
                                                style="border-radius: 50%"
                                                wire:click="editar_publicacion({{ $pu->id }})">
                                                <i class="bx bx-pencil"></i>
                                            </button>

                                            <button type="button" title="Eliminar"
                                                class="btn btn-outline-danger waves-effect waves-light"
                                                style="border-radius: 50%"
                                                wire:click.prevent="$emit('deletepublicacion', {{ $pu->id }})">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $publicaciones->links() }}
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    {{-- ***************inicio de modales ************ --}}
    <div wire:ignore.self data-bs-backdrop="static" id="crearpublicacion" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">
                        @if ($idpublicacionactual)
                        EDITAR PUBLICACIÓN
                        @else
                        CREAR PUBLICACIÓN
                        @endif
                      
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3 col-lg-12  ">
                        <label class="form-label" for="tipopublicacion">TIPO DE PUBLICACIÓN:</label>

                        <select class="form-select @error('tipopublicacion') border-danger @enderror"
                            wire:model="tipopublicacion" id="tipopublicacion">
                            <option value="">Elegir...</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('tipopublicacion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-12">
                        <label class="form-label" for="titulo">TITULO PUBLICACIÓN:</label>
                        <input type="text" class="form-control @error('titulo') border-danger @enderror"
                            wire:model="titulo" id="titulo">
                        @error('titulo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-12">
                        <label class="form-label" for="descripcion">DESCRIPCIÓN PUBLICACIÓN: </label>
                        <textarea id="descripcion" cols="30" rows="8"
                            class="form-control @error('descripcion') border-danger @enderror" wire:model="descripcion"></textarea>
                        @error('descripcion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @if (
                        $tipopublicacion == 'COMUNICADOS' ||
                            $tipopublicacion == 'EVENTOS' ||
                            $tipopublicacion == 'PROMOCIÓN' ||
                            $tipopublicacion == 'CAMPAÑA')
                        <div class="mb-3 col-lg-12">
                            <label class="form-label">IMAGEN:
                                @if (
                                    $tipopublicacion == 'COMUNICADOS' ||
                                        $tipopublicacion == 'EVENTOS' ||
                                        $tipopublicacion == 'PROMOCIÓN' ||
                                        $tipopublicacion == 'CAMPAÑA')
                                    <span class="text-secondary">resolución recomendada en px (<span
                                            title="Ancho">{{ $CONVOCATORIA_PX_ANCHO }}</span>x<span
                                            title="Alto">{{ $CONVOCATORIA_PX_ALTO }}</span>)</span>
                                @endif
                                @if ($tipopublicacion == 'Comunicados')
                                    <span class="text-secondary">resolución recomendada en px (<span
                                            title="Ancho">{{ $COMUNICADO_PX_ANCHO }}</span>x<span
                                            title="Alto">{{ $COMUNICADO_PX_ALTO }}</span>)</span>
                                @endif

                                @if ($tipopublicacion == 'Convocatoria' || $tipopublicacion == 'Comunicados')
                                    <br><small class="text-info">Si la imagen es mayor se redimensionara a la
                                        resolución recomendada.</small>
                                @endif
                            </label>
                            <input type="file" class="form-control @error('imagen') border-danger @enderror"
                                wire:model="imagen" accept=".jpg, .jpeg, .png">
                            @error('imagen')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12" wire:loading wire:target="imagen">
                            <span>Cargando imagen...</span>
                        </div>
                        @if ($imagen)
                            <div class="mb-3 col-lg-12">
                                <label class="form-label">Vista Previa:</label>
                                <br>
                                <center><img src="{{ $imagen->temporaryUrl() }}" alt="Vista Previa de la Imagen"
                                        class="img-thumbnail" style="width: 300px; height: 300px;"> </center>
                            </div>
                        @endif
                    @endif
                  

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="cancelar">CANCELAR</button>
                        @if ($idpublicacionactual)
                        <button class="btn btn-primary waves-effect waves-light" wire:click="guardar_editar_publicacion">EDITAR
                            DATOS</button>
                        @else
                        <button class="btn btn-primary waves-effect waves-light" wire:click="guardar_publicacion">GUARDAR
                            DATOS</button>
                        @endif
                   
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div wire:ignore.self data-bs-backdrop="static" id="editarpublicacion" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">
                        EDITAR PUBLICACIÓN
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancereditar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3 col-lg-12  ">
                        <label class="form-label">TIPO DE PUBLICACIÓN:</label>

                        <input type="text" class="form-control @error('tipopublicacion') border-danger @enderror"
                            wire:model="tipo_publicacion_edit" disabled style="color: black">
                        @error('tipopublicacion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-12">
                        <label class="form-label">TITULO PUBLICACIÓN:</label>
                        <input type="text" class="form-control @error('titulo_edit') border-danger @enderror"
                            wire:model="titulo_edit">
                        @error('titulo_edit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 col-lg-12">
                        <label class="form-label">DESCRIPCIÓN PUBLICACIÓN: </label>
                        <textarea name="" id="" cols="30" rows="10"
                            class="form-control @error('descripcion_edit') border-danger @enderror" wire:model="descripcion_edit"></textarea>

                        @error('descripcion_edit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($tipo_publicacion_edit == 'Comunicados' || $tipo_publicacion_edit == 'Convocatoria')
                        <label class="form-label">IMAGEN ACTUAL:</label>
                        <br>
                        <center><img src="{{ $imagen_edit }}" alt="Vista Previa de la Imagen" class="img-thumbnail"
                                style="width: 300px; height: 300px;"> </center>
                        <div class="mb-3 col-lg-12">
                            <label class="form-label">IMAGEN:
                                @if ($tipo_publicacion_edit == 'Convocatoria')
                                    <span class="text-secondary">resolución recomendada en px (<span
                                            title="Ancho">{{ $CONVOCATORIA_PX_ANCHO }}</span>x<span
                                            title="Alto">{{ $CONVOCATORIA_PX_ALTO }}</span>)</span>
                                @endif
                                @if ($tipo_publicacion_edit == 'Comunicados')
                                    <span class="text-secondary">resolución recomendada en px (<span
                                            title="Ancho">{{ $COMUNICADO_PX_ANCHO }}</span>x<span
                                            title="Alto">{{ $COMUNICADO_PX_ALTO }}</span>)</span>
                                @endif
                                @if ($tipo_publicacion_edit == 'Convocatoria' || $tipo_publicacion_edit == 'Comunicados')
                                    <br><small class="text-info">Si la imagen es mayor se redimensionara a la
                                        resolución recomendada.</small>
                                @endif
                            </label>
                            <input type="file"
                                class="form-control @error('imagen_edit_nuevo') border-danger @enderror"
                                wire:model="imagen_edit_nuevo" accept=".jpg, .jpeg, .png,.pdf">
                            @error('imagen_edit_nuevo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-12" wire:loading wire:target="imagen_edit_nuevo">
                            <span>Cargando imagen...</span>
                        </div>
                        @if ($imagen_edit_nuevo)
                            <div class="mb-3 col-lg-12">

                                <label class="form-label">Vista Previa:</label>
                                <br>
                                <center><img src="{{ $imagen_edit_nuevo->temporaryUrl() }}"
                                        alt="Vista Previa de la Imagen" class="img-thumbnail"
                                        style="width: 300px; height: 300px;"> </center>
                            </div>
                        @endif


                    @endif

                    @if ($tipo_publicacion_edit == 'Horario')
                        <div class="mb-3 col-lg-12">
                            <label class="form-label">PDF ACTUAL:</label>
                            <br>
                            <center><iframe src="{{ $imagen_edit }}" alt="Vista Previa de la Imagen"
                                    class="img-thumbnail"></iframe></center>
                            <label class="form-label">NUEVO PDF:</label>
                            <input type="file" class="form-control" wire:model="imagen_edit_nuevo"
                                accept=".pdf">
                            @error('imagen_edit_nuevo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif($tipo_publicacion_edit == 'Convocatoria')
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="fecha_inicio_convocatoria_edit">FECHA INICIO DE
                                INSCRIPCIONES CONVOCATORIA</label>
                            <input type="date"
                                class="form-control @error('fecha_inicio_convocatoria_edit') border-danger @enderror"
                                wire:model="fecha_inicio_convocatoria_edit" id="fecha_inicio_convocatoria_edit">
                            @error('fecha_inicio_convocatoria_edit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="fecha_fin_convocatoria_edit">CIERRE DE INSCRIPCIONES
                                CONVOCATORIA:</label>
                            <input type="date"
                                class="form-control @error('fecha_fin_convocatoria_edit') border-danger @enderror"
                                wire:model="fecha_fin_convocatoria_edit" id="fecha_fin_convocatoria_edit">
                            @error('fecha_fin_convocatoria_edit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @elseif($tipo_publicacion_edit == 'Video')
                        <div class="mb-3 col-lg-12">
                            <label for="url_video_edit">ID URL VIDEO YOUTUBE</label>
                            <input type="text"
                                class="form-control @error('url_video_edit') border-danger @enderror"
                                wire:model="url_video_edit" id="url_video_edit">
                            @error('url_video_edit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (!is_null($url_video_edit) && strlen($url_video_edit) >= 3)
                            <div class="mb-3 col-lg-12 ratio ratio-16x9">
                                <iframe type="text/html" class=""
                                    src="https://www.youtube.com/embed/{{ $url_video_edit }}?disablekb=1&modestbranding=1"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                        @endif
                        <p><a target="_blank"
                                href="https://soporte.easypromosapp.com/hc/es/articles/360043822672-V%C3%ADdeo-C%C3%B3mo-obtener-el-ID-de-un-v%C3%ADdeo-de-YouTube"
                                class="text-info">¿Cómo obtener id de un video?</a></p>
                    @endif

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="cancereditar">CANCELAR</button>
                    <button class="btn btn-primary waves-effect waves-light"
                        wire:click="guardar_editar_publicacion">GUARDAR
                        DATOS</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ****************** fin de modales ************ --}}
    @push('navi-js')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('abrirmodalcrearpublicacion', function() {
                    $('#crearpublicacion').modal('show');
                });
                Livewire.on('cerrarmodalcrearpublicacion', function() {
                    $('#crearpublicacion').modal('hide');
                });
            });
        </script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('abrirmodaleditarpublicacion', function() {
                    $('#editarpublicacion').modal('show');
                });
                Livewire.on('cerrarmodaleditarpublicacion', function() {
                    $('#editarpublicacion').modal('hide');
                });
            });
            document.addEventListener('livewire:load', function() {
                Livewire.on('cerrarmodaleditarpublicacion', function() {
                    $('#editarpublicacion').modal('hide');
                });
            });
        </script>
        <script>
            livewire.on('deletepublicacion', id_publicacion => {
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
                        livewire.emit('delete', id_publicacion);

                        Swal.fire(
                            'Eliminado!',
                            'Su Registro ha sido eliminado..',
                            'Exitosamente'
                        )
                    }
                })
            });
        </script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('Mostrar', function(message) {
                    console.log(message);
                });
            });
        </script>
    @endpush
</div>
