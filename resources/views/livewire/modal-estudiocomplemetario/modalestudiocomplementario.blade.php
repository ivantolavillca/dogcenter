    <div wire:ignore.self id="modalestudiocomplementario" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                       @if ($estudiocompleID)  
                        <div class="row">
                            <div class="text-center text-info h5"> EDITAR ESTUDIO COMPLEMENTARIOS</div>
                        </div>                         
                        @else
                        <div class="row">
                            <div class="text-center text-info h5"> REGISTRAR ESTUDIO COMPLEMENTARIOS</div>
                        </div> 
                        @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div>
                            <input type="hidden" wire:model="estudiocompleID">
                      
                            <label class="form-label">NOMBRE DEL ESTUDIO COMPLEMENTARIO <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="Nombreestudiocomple" placeholder="Ej. radiografia">
                            @error('Nombreestudiocomple')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                            <label class="form-label">DESCRIPCION DEL ESTUDIO COMPLEMENTARIO <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="Descriestudiocomple" placeholder="Ej. radiografia">
                            @error('Descriestudiocomple')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalEstu">CANCELAR</button>
                        @if ($estudiocompleID)  
                        <button wire:click="EditarEstudioComple" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>                              
                        @else
                        <button wire:click="GuardarEstudioComple" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>