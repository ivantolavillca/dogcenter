<div>
    <div wire:ignore.self id="editaruser"data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">EDITAR USUARIO
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelarEditar"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NOMBRE COMPLETO:</label>
                                <input type="text" class="form-control" wire:model="nombre2">
                                @error('nombre2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03">ROLES:</label>
                                <select wire:model="role2" class="form-select" aria-label="Default select example">
                                    <option>Elegir...</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach


                                </select>
                                @error('role2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom03">EMAIL:</label>
                                <input type="email" class="form-control" wire:model="email2">
                                @error('email2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cancelarEditar">CANCELAR</button>
                        <button wire:click="guardarEditarUsuario" type="submit"
                            class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->


    </div>
    <div wire:ignore.self id="resetpassword"data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">RESET PASSWORD
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelarEditar"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NOMBRE COMPLETO:</label>
                                <input type="text" class="form-control" wire:model="nombreCompleto" disabled
                                    style="color:black">


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">PASSWORD:
                                </label>
                                <input type="text" class="form-control" wire:model="PasswordEdit"
                                    style="color:black">
                                @error('PasswordEdit')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>



                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cancelarResetPassword">CANCELAR</button>
                        <button wire:click="guardarResetPassword" type="submit"
                            class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->


    </div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACION DE USUARIOS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
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
                            @livewire('admin.user-create')


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

                    @if ($users->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            NOMBRE COMPLETO
                                        </th>




                                        <th>
                                            ROL
                                        </th>

                                        <th>
                                            CORREO
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
                                    @foreach ($users as $user)
                                        <tr>
                                            <th> @php
                                                echo $cont;
                                            @endphp
                                            </th>
                                            <td>
                                                {{ $user->name }}
                                            </td>

                                            <td>
                                                {{ $user->roles[0]->name }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>


                                            <td>
                                                @if ($user->estado == 1)
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light"
                                                        wire:click="cambiarEstado({{ $user->id }})">ACTIVO</button>
                                                @elseif ($user->estado == 0)
                                                    <button type="button"
                                                        class="btn btn-outline-warning waves-effect waves-light"
                                                        wire:click="cambiarEstado({{ $user->id }})">INACTIVO</button>
                                                @endif

                                            </td>
                                            <td>

                                                <button type="button"
                                                    class="btn btn-outline-success waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click="editar_usuario({{ $user->id }})"> <i
                                                        class="bx bx-pencil"></i></button>
                                                <button type="button"
                                                    class="btn btn-outline-danger waves-effect waves-light"
                                                    style="border-radius: 50%"data-bs-toggle="modal"
                                                    data-bs-target="#resetpassword"
                                                    wire:click="resetPassword({{ $user->id }})"> <i
                                                        class="bx bxs-key"></i></button>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">

                            {{ $users->links() }}
                        </div>

                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>
        </div>




    </div>
</div>
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('closeModalEdit', function() {
                $('#editaruser').modal('hide');
            });
            Livewire.on('AbrirModalEdit', function() {
                $('#editaruser').modal('show');
            });
        });
        document.addEventListener('livewire:load', function() {
            Livewire.on('cerrarmodaleditpassword', function() {
                $('#resetpassword').modal('hide');
            });
        });
    </script>
@endpush
