<div>

   
    <div wire:ignore.self id="agregaRol"data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">CREAR ROL
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">NOMBRE:</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="row">
                            @foreach ($permissions->chunk(ceil($permissions->count() / 3)) as $chunk)
                                <div class="col-md-4">

                                    @foreach ($chunk as $permission)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <label class="me-2" for="{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ $permission->id }}" wire:model="selectedPermissions"
                                                    switch="success" value="{{ $permission->name }}" />
                                                <label class="form-check-label" for="{{ $permission->id }}"
                                                    data-on-label="Yes" data-off-label="No"></label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cancelar">CANCELAR</button>
                        <button wire:click="guardarRol" type="submit"
                            class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->


    </div>
    @push('navi-js')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('closeModal', function() {
                    $('#agregaRol').modal('hide');
                });
            });
        </script>
    @endpush
   
    
  
    <div wire:ignore.self id="eritaarroles"data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">EDITAR ROL
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelarEditar"></button>
                </div>
                <div class="modal-body ">


                    <div class="row">

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">NOMBRE:</label>
                                <input type="text" class="form-control" wire:model="name2">
                                @error('name2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                         
                            @foreach ($permissions2->chunk(ceil($permissions2->count() / 3)) as $chunk)
                                <div class="col-md-4">
                                    @foreach ($chunk as $permission)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">{{ $permission->name }}</div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ $permission->id }}" wire:model="selectedPermissions2"
                                                   value="{{ $permission->name }}" />
                                                <label class="form-check-label" for="{{ $permission->id }}"
                                                    data-on-label="Yes" data-off-label="No"></label>
                                                {{-- <a class="badge rounded-pill badge-soft-primary font-size-12" href="{{route('documentacion.index')}}#{{ $permission->name }}" target="_blank">Ayuda <i class="bx bx-help-circle"></i></a> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                    </div>


                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cancelarEditar">CANCELAR</button>
                        <button wire:click="guardarEditarRol" type="submit"
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
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACION DE ROLES</h4>

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
                            
                            <button class="btn btn-outline-primary waves-effect waves-light col-md-6 "
                                data-bs-toggle="modal" data-bs-target="#agregaRol"> <i
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

                    @if ($roles->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            ID
                                        </th>

                                        <th>
                                            NOMBRE
                                        </th>



                                        <th>
                                            PERMISOS
                                        </th>



                                        <th>
                                            ACCIÓNES
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($roles as $rol)
                                        <tr>
                                            <th>
                                                {{ $rol->id }}
                                            </th>
                                            <td>
                                                {{ $rol->name }}
                                            </td>

                                            <td>
                                                @foreach ($rol->permissions as $p)
                                                    <span
                                                        class="btn btn-outline-secondary waves-effect">{{ $p->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                               
                                                <button type="button"
                                                    class="btn btn-outline-success waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click="editar_rol({{ $rol->id }})"> <i
                                                        class="bx bx-pencil"></i></button>
                                               
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">

                            {{ $roles->links() }}
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
                $('#eritaarroles').modal('hide');
            });
        });
        document.addEventListener('livewire:load', function() {
            Livewire.on('editroles', function() {
                $('#eritaarroles').modal('show');
            });
        });
    </script>
@endpush
