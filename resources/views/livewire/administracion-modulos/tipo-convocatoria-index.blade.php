<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">TIPO CONVOCATORIA</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Tipo Convocatoria</li>
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
                                data-bs-toggle="modal" data-bs-target="#agregartipo_convocatoria"> <i
                                    class="bx bxs-plus-circle">AGREGAR</i></button>


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

                    <br>

                    @if ($tipo_convocatorias->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            TIPO ESTUDIANTE
                                        </th>
                                        <th>
                                            CONVOCATORIA ESTUDIANTE
                                        </th>
                                        <th>
                                            COSTO
                                        </th>
                                        <th>
                                            ESTADO
                                        </th>
                                        <th>
                                            ACCIÓN
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($tipo_convocatorias as $tipo_convocatoria)
                                        <tr>

                                            <th>
                                                @php
                                                    echo $cont;
                                                    $cont++;
                                                @endphp
                                            </th>

                                            <td>
                                                {{ $tipo_convocatoria->tipo_estudiante->nombre_tipo_estudiante }}
                                            </td>

                                            <td>
                                                {{ $tipo_convocatoria->convocatoria_estudiante->nombre_convocatoria_estudiante }}
                                            </td>

                                            <td>
                                            	<b>{{ $tipo_convocatoria->costo->tipo_costo }} </b> -
                                                {{ $tipo_convocatoria->costo->deposito }} -
                                                {{ $tipo_convocatoria->costo->costo_siado_costo }}
                                            </td>
                                            <td>

                                                @if ($tipo_convocatoria->estado_tipo_convocatoria == 'ACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light"
                                                        wire:click="cambiar_estado_tipo_convocatoria({{ $tipo_convocatoria->id_tipo_convocatoria }})">
                                                        ACTIVO
                                                    </button>
                                                @elseif ($tipo_convocatoria->estado_tipo_convocatoria == 'INACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-danger waves-effect waves-light"
                                                        wire:click="cambiar_estado_tipo_convocatoria({{ $tipo_convocatoria->id_tipo_convocatoria }})">
                                                        INACTIVO</button>
                                                @endif
                                            </td>
                                            <td>


                                                <button type="button"
                                                    class="btn btn-outline-success waves-effect waves-light"
                                                    style="border-radius: 50%" data-bs-toggle="modal"
                                                    data-bs-target="#editartipo_convocatoria"
                                                    wire:click="editar_tipo_convocatoria({{ $tipo_convocatoria->id_tipo_convocatoria }})">
                                                    <i class="bx bx-pencil"></i>
                                                </button>


                                                <button type="button"
                                                    class="btn btn-outline-danger waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click.prevent="$emit('deleteconvoca', {{ $tipo_convocatoria->id_tipo_convocatoria }})">
                                                    <i class="bx bx-trash"></i></button>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">

                            {{ $tipo_convocatorias->links() }}
                        </div>

                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>



            <div wire:ignore.self data-bs-backdrop="static" id="editartipo_convocatoria" class="modal fade"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"> EDITAR tipo_convocatoria

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelarEditar"></button>
                        </div>
                        <div class="modal-body">




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">TIPO ESTUDIANTE:</label>
                                        <select wire:model="tipo_estudiantee2" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($tipo_estudiantes as $tipo_estudiante)
                                                <option value="{{ $tipo_estudiante->id_tipo_estudiante }}">
                                                    {{ $tipo_estudiante->nombre_tipo_estudiante }}</option>
                                            @endforeach


                                        </select>

                                        @error('tipo_estudiantee2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CONVOCATORIA ESTUDIANTE:</label>
                                        <select wire:model="convocatoria_estudiante2" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($convocatoria_estudiantes as $convocatoria_estudiante)
                                                <option
                                                    value="{{ $convocatoria_estudiante->id_convocartoria_estudiante }}">
                                                    {{ $convocatoria_estudiante->nombre_convocatoria_estudiante }}
                                                </option>
                                            @endforeach


                                        </select>
                                        @error('convocatoria_estudiante2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">COSTO:</label>
                                    <select wire:model="costo2" class="form-select" aria-label="Default select example">
                                        <option>Elegir...</option>
                                        @foreach ($costos as $costo)
                                            <option value="{{ $costo->id_costo }}"> {{ $costo->tipo_costo }} - 
												{{ $costo->deposito }} -
                                                {{ $costo->costo_siado_costo }}</option>
                                        @endforeach


                                    </select>
                                    @error('costo2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelarEditar">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardarEditadotipo_convocatoria">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>




            <div wire:ignore.self id="agregartipo_convocatoria" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR tipo_convocatoria
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelar"></button>
                        </div>
                        <div class="modal-body">




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">TIPO ESTUDIANTE:</label>
                                        <select wire:model="tipo_estudiante" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($tipo_estudiantes as $tipo_estudiante)
                                                <option value="{{ $tipo_estudiante->id_tipo_estudiante }}">
                                                    {{ $tipo_estudiante->nombre_tipo_estudiante }}</option>
                                            @endforeach


                                        </select>
                                        @error('tipo_estudiante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">CONVOCATORIA ESTUDIANTE:</label>
                                        <select wire:model="convocatoria_estudiante" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($convocatoria_estudiantes as $convocatoria_estudiante)
                                                <option
                                                    value="{{ $convocatoria_estudiante->id_convocartoria_estudiante }}">
                                                    {{ $convocatoria_estudiante->nombre_convocatoria_estudiante }}
                                                </option>
                                            @endforeach


                                        </select>
                                        @error('convocatoria_estudiante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">COSTO:</label>
                                    <select wire:model="costo" class="form-select"
                                        aria-label="Default select example">
                                        <option>Elegir...</option>
                                        @foreach ($costos as $costo)
                                            <option value="{{ $costo->id_costo }}"> <b>{{ $costo->tipo_costo }}</b> -
												{{ $costo->deposito }} -
                                                {{ $costo->costo_siado_costo }}</option>
                                        @endforeach


                                    </select>
                                    @error('costo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar">CANCELAR</button>
                            <button wire:click="guardar_tipo_convocatoria"
                                class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

        </div>

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalCreate', function() {
                        $('#agregartipo_convocatoria').modal('hide');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalEdit', function() {
                        $('#editartipo_convocatoria').modal('hide');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                livewire.on('deleteconvoca', id_siadi_convocatoria => {
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
                                'Su Registro ha sido eliminado..',
                                'Exitosamente'
                            )
                        }
                    })
                });
            </script>
        @endpush
