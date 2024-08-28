    <div wire:ignore.self id="modalproveedor" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                       @if ($Idprovedor)  
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
                        <div>
                            <input type="hidden" wire:model="Idprovedor">
                      
                            <label class="form-label">NOMBRE DEL PROVEEDOR <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="Nombreproveedor" placeholder="Ej. radiografia">
                            @error('Nombreproveedor')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                            <label class="form-label">CARNET DE IDENTIDAD <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="ci_pro" placeholder="Ej. radiografia">
                            @error('ci_pro')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                            <label class="form-label">CELULAR <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="celular_pro" placeholder="Ej. radiografia">
                            @error('celular_pro')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                          
                            <label class="form-label">CORREO ELECTRONICO<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" wire:model="correo_pro" placeholder="Ej. radiografia">
                            @error('correo_pro')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                            <label class="form-label">NIT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="Nit_pro" placeholder="Ej. radiografia">
                            @error('Nit_pro')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalprove">CANCELAR</button>
                        @if ($Idprovedor)  
                        <button wire:click="EditarDatosProveedor" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>                              
                        @else
                        <button wire:click="GuardarProveedo" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>