<div>
    <button class="btn btn-outline-primary waves-effect waves-light col-md-6 " data-bs-toggle="modal"
        data-bs-target="#agregarusuario"> <i class="bx bxs-plus-circle">AGREGAR</i></button>
        <div wire:ignore.self id="agregarusuario"data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content radius-10 border-start border-5  border-primary">
                    <div class="modal-header">
                        
                        <div class="row"><div class="text-center text-info h5"> AGREGAR USUARIO  </div></div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                    
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">NOMBRE  COMPLETO:</label>
                                    <input type="text" class="form-control" wire:model="nombre">
                                    @error('nombre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        
                        
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">ROLES:</label>
                                    <select wire:model="role" class="form-select" aria-label="Default select example">
                                        <option>Elegir...</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                        @endforeach
        
        
                                    </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">EMAIL:</label>
                                    <input type="email" class="form-control" wire:model="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom04">PASSWORD</label>
                                    <input type="text" class="form-control" wire:model="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar">CANCELAR</button>
                            <button wire:click="guardarUsuario" type="submit"
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
                    $('#agregarusuario').modal('hide');
                });
            });
        </script>
    @endpush

</div>
