<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">NIVEL IDIOMA</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Nivel Idioma</li>
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
                                data-bs-toggle="modal" data-bs-target="#agregaridioma"> <i
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

                    @if ($nivel_idiomas->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            NIVEL IDIOMA
                                        </th>
                                        <th>
                                            OBSERVACION
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
                                    @foreach ($nivel_idiomas as $nivel_idioma)
                                        <tr>

                                            <th>
                                                @php
                                                    echo $cont;
                                                    $cont++;
                                                @endphp
                                            </th>

                                            <td>
                                                {{ $nivel_idioma->nombre_nivel_idioma }}
                                            </td>
                                            <td>
                                                {{ $nivel_idioma->descripcion_nivel_idioma }}
                                            </td>

                                            <td>


                                                <button type="button"
                                                    class="btn btn-outline-success waves-effect waves-light"
                                                    style="border-radius: 50%" data-bs-toggle="modal"
                                                    data-bs-target="#editaridioma"
                                                    wire:click="editar_idioma({{ $nivel_idioma->id_nivel_idioma }})">
                                                    <i class="bx bx-pencil"></i>
                                                </button>


                                                <button type="button"
                                                    class="btn btn-outline-danger waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click.prevent="$emit('deleteconvoca', {{ $nivel_idioma->id_nivel_idioma }})">
                                                    <i class="bx bx-trash"></i></button>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">

                            {{ $nivel_idiomas->links() }}
                        </div>

                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>



            <div wire:ignore.self data-bs-backdrop="static" id="editaridioma" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"> EDITAR NIVEL IDIOMA

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelarEditar"></button>
                        </div>
                        <div class="modal-body">






                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">NIVEL IDIOMA:</label>
                                    <input type="text" class="form-control" wire:model="nombre_idioma2">
                                    @error('nombre_idioma2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">OBSERVACION:</label>
                                    <textarea class="form-control" wire:model="descripcion_idioma2"></textarea>
                                    @error('descripcion_idioma2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>



                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelarEditar">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardarEditadoidioma">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>




            <div wire:ignore.self id="agregaridioma" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR NIVEL IDIOMA
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelar"></button>
                        </div>
                        <div class="modal-body">


                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">NIVEL IDIOMA:</label>
                                    <input type="text" class="form-control" wire:model="nombre_idioma">
                                    @error('nombre_idioma')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">OBSERVACION:</label>
                                    <textarea class="form-control" wire:model="descripcion_idioma"></textarea>
                                    @error('descripcion_idioma')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>




                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar">CANCELAR</button>
                            <button wire:click="guardar_idioma"
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
                        $('#agregaridioma').modal('hide');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalEdit', function() {
                        $('#editaridioma').modal('hide');
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
