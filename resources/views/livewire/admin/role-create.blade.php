<div>
    <button class="btn btn-outline-primary waves-effect waves-light col-md-6 " data-bs-toggle="modal"
        data-bs-target="#agregaRol"> <i class="bx bxs-plus-circle">AGREGAR</i></button>
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
                                                <div class="me-2">{{ $permission->name }}</div>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="{{ $permission->id }}" wire:model="selectedPermissions({{$permission->id}})"
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

</div>
