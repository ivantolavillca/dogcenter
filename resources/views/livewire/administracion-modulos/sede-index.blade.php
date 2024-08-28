<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">SEDE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Sede</li>
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
                            <button class="btn btn-outline-primary waves-effect waves-light col-md-6" wire:click="show_form_create"> <i class="bx bxs-plus-circle">AGREGAR</i></button>
                        </div>
                        <br><br><br>
                        <div class="col-md-12">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control col-md-6" wire:model="search"
                                        placeholder="Buscar por Dirección">
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <div class="btn-group me-1 mt-2">
                                        <button type="button" class="btn btn-info">Cambiar Sede - Convocatoria</button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" wire:click="sede_direccion">Principal - <b>DIRECCIÓN</b></a>
                                            <a class="dropdown-item" wire:click="sede_nombre_sede_upea">Principal - <b>NOMBRE SEDE UPEA</b></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    @if($sedes->count())
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>DIRECCIÓN</th>
                                        <th>SEDE UPEA</th>
                                        <th>DIRECCIÓN UPEA</th>
                                        <th>ESTADO</th>
                                        <th>ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($sedes as $sede)
                                        <tr>
                                            <th>{{$cont++}}</th>
                                            <td>
                                                {{ $sede->direccion }}
                                            </td>
                                            <td>
                                                {{ $sede->sede_upea->nombre }}
                                            </td>
                                            <td>
                                            {{ $sede->sede_upea->direccion }}
                                            </td>
                                            <td>
                                                @if ($sede->estado_siadi_sede == 'ACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light"
                                                        wire:click="cambiar_estado_idioma({{ $sede->id_siadi_sede }})">
                                                        ACTIVO
                                                    </button>
                                                @elseif ($sede->estado_siadi_sede == 'INACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-danger waves-effect waves-light"
                                                        wire:click="cambiar_estado_idioma({{ $sede->id_siadi_sede}})">
                                                        INACTIVO</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($sede->estado_siadi_sede == 'ACTIVO')
                                                <button type="button" title="Editar"
                                                    class="btn btn-outline-success waves-effect waves-light"
                                                    style="border-radius: 50%" 
                                                    wire:click="show_form_edit({{ $sede->id_siadi_sede }})">
                                                    <i class="bx bx-pencil"></i>
                                                </button>
                                                @endif

                                                <button type="button" title="Eliminar"
                                                    class="btn btn-outline-danger waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click.prevent="$emit('deleteSede', {{ $sede->id_siadi_sede  }})">
                                                    <i class="bx bx-trash"></i></button>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $sedes->links() }}
                        </div>
                    @else
                        <div class="px-5 py-3 border-gray-200  text-sm">
                            <strong>No hay Registros</strong>
                        </div>
                    @endif
                </div>
            </div>


            <!-- ============================= INICIO MODALES ====================== -->

            <!-- ************* inicio modal 01 *************** -->
            <div wire:ignore.self id="agregarSede" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR SEDE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="close_form_create"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="direccion_siadi" class="form-label">Dirección</label>
                                    <input type="text" class="form-control @error('direccion_siadi') border-danger @enderror" id="direccion_siadi" wire:model="direccion_siadi" value="{{$direccion_siadi}}" maxlength="150">
                                    @error('direccion_siadi')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12">
                                    <label for="id_sede_upea" class="form-label">Sede U.P.E.A.</label>
                                    <select id="id_sede_upea" class="form-select  @error('id_sede_upea') border-danger @enderror" wire:model="id_sede_upea">
                                        <option value="">Elegir...</option>
                                        @foreach($sedes_upea as $sede_upea_lab)
                                            <option value="{{$sede_upea_lab->id}}">{{$sede_upea_lab->nombre}}   .::   {{$sede_upea_lab->direccion}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_sede_upea')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="close_form_create">CANCELAR</button>
                            <button wire:click="guardar_sede"
                                class="btn btn-primary waves-effect waves-light">AGREGAR</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- ************** fin modal 01 ***************** -->


            <!-- ************* inicio modal 02 *************** -->
            <div wire:ignore.self id="editarSede" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">EDITAR SEDE</h5>
                            <button type="button" class="btn-close" {{-- data-bs-dismiss="modal" aria-label="Close" --}}
                                wire:click="close_form_edit"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="edit_direccion_siadi" class="form-label">Dirección</label>
                                    <input type="text" class="form-control @error('edit_direccion_siadi') border-danger @enderror" id="edit_direccion_siadi" wire:model="edit_direccion_siadi" value="{{$edit_direccion_siadi}}" maxlength="150">
                                    @error('edit_direccion_siadi')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12">
                                    <label for="edit_id_sede_upea" class="form-label">Sede U.P.E.A.</label>
                                    <select id="edit_id_sede_upea" class="form-select  @error('edit_id_sede_upea') border-danger @enderror" wire:model="edit_id_sede_upea">
                                        <option value="">Elegir...</option>
                                        @foreach($sedes_upea as $sede_upea_lab)
                                            <option value="{{$sede_upea_lab->id}}">{{$sede_upea_lab->nombre}}   .::   {{$sede_upea_lab->direccion}}</option>
                                        @endforeach
                                    </select>
                                    @error('edit_id_sede_upea')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" {{-- data-bs-dismiss="modal" --}}
                                wire:click="close_form_edit">CANCELAR</button>
                            @if($estadoBoton)
                            <button wire:click="actualizar_sede"
                                class="btn btn-primary waves-effect waves-light">ACTUALIZAR</button>
                            @endif
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- ************** fin modal 02 ***************** -->

            <!-- ============================== FIN MODALES ======================== -->



            {{--<div wire:ignore.self data-bs-backdrop="static" id="editaridioma" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"> CONVOCATORIA

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelarEditar"></button>
                        </div>
                        <div class="modal-body">






                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">IDIOMA:</label>
                                    <select class="form-select" wire:model="idioma2">
                                        <option>Elegir...</option>
                                        @foreach ($idiomas as $idioma)
                                            <option value="{{ $idioma->id_idioma }}">{{ $idioma->nombre_idioma }} -
                                                {{ $idioma->sigla_codigo_idioma }}</option>
                                        @endforeach

                                    </select>
                                    @error('idioma2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">NIVEL IDIOMA:</label>
                                    <select wire:model="nivel_idioma2" class="form-select">
                                        <option>Elegir...</option>

                                        @foreach ($nivelidiomas as $nivelidioma)
                                            <option value="{{ $nivelidioma->id_nivel_idioma }}">
                                                {{ $nivelidioma->nombre_nivel_idioma }} -
                                                {{ $nivelidioma->descripcion_nivel_idioma }}</option>
                                        @endforeach





                                    </select>
                                    @error('nivel_idioma2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">SIGLA ASIGNATURA:</label>
                                    <input type="text" class="form-control" wire:model="sigla_asignatura2">
                                    @error('sigla_asignatura2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>


                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelarEditar">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardarEditadoAsignatura">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>--}}


        </div>

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {

                    Livewire.on('showModalCreate', function() {
                        $('#agregarSede').modal('show');
                    });
                    Livewire.on('closeModalCreate', function() {
                        $('#agregarSede').modal('hide');
                    });

                    Livewire.on('showModalEdit', function() {
                        $('#editarSede').modal('show');
                    });
                    Livewire.on('closeModalEdit', function() {
                        $('#editarSede').modal('hide');
                    });

                    Livewire.on('Mostrar', function(mesa){
                        console.log(mesa);
                    });

                });
                
            </script>
        @endpush
        @push('navi-js')
            <script>
                livewire.on('deleteSede', id_siadi_convocatoria => {
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
                            livewire.emit('delete', id_siadi_convocatoria);

                            Swal.fire(
                                'Eliminado!',
                                'Su Sede ha sido eliminado..',
                                'Exitosamente'
                            )
                        }
                    })
                });
            </script>
        @endpush

        @push('navi-js')
        <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script>
            $('#direccion_siadi').maxlength({
                alwaysShow: !0, warningClass: "badge bg-success", limitReachedClass: "badge bg-danger"
            });
            $('#edit_direccion_siadi').maxlength({
                alwaysShow: !0, warningClass: "badge bg-success", limitReachedClass: "badge bg-danger"
            });
        </script>
        @endpush
