    <div wire:ignore.self id="modaltiposhistoriales" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                       @if($Idtipohistorial)  
                        <div class="row">
                            <div class="text-center text-info h5"> EDITAR TIPOS DE HISTORIALES</div>
                        </div>                         
                        @else
                        <div class="row">
                            <div class="text-center text-info h5"> REGISTRAR TIPOS DE HISTORIALES</div>
                        </div> 
                        @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div>
                            <input type="hidden" wire:model="Idtipohistorial">
                      
                            <label class="form-label">NOMBRE DEL HISTORIAL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model.live="Nombretipohistorial" placeholder="Ej. radiografia">
                            @error('Nombretipohistorial')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiartipohistorial">CANCELAR</button>
                        @if($Idtipohistorial)  
                        <button wire:click="EditarTipodeHistorial" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>                              
                        @else
                        <button wire:click="GuardarHistorial" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>