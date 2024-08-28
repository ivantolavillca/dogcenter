    <div wire:ignore.self id="modalproveedor" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                    @if (true)
                    <div class="row">
                        <div class="text-center text-info h5"> EDITAR PROVEEDORES</div>
                    </div>
                    @else
                    <div class="row">
                        <div class="text-center text-info h5"> REGISTRAR PROVEEDORES</div>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" wire:model="Idcasosenfermedad">

                        <div class="row">
                            <div class="col">
                                <label class="form-label">NOMBRE DEL CLIENTE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="NombreCliente" placeholder="Ej. radiografia">
                                @error('NombreCliente')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">NOMBRE DEL CLIENTE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="Nombre" placeholder="Ej. radiografia">
                                @error('Nombre')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col">
                            <label class="form-label">CASO DE ENFERDAD <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="CasoEnfermedad" placeholder="Ej. radiografia">
                            @error('CasoEnfermedad')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <h1></h1>
                        <div class="modal-footer d-flex ">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalprove">CANCELAR</button>
                            @if (true)
                            <button wire:click="EditarDatosProveedor" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>
                            @else
                            <button wire:click="GuardarProveedo" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                            @endif
                              
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>