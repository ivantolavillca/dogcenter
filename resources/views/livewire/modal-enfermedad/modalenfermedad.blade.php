    <div wire:ignore.self id="modalenfermedad" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                    @if ($Idcasosenfermedad)
                    <div class="row">
                        <div class="text-center text-info h5"> EDITAR CASO DE ATENCION</div>
                    </div>
                    @else
                    <div class="row">
                        <div class="text-center text-info h5"> REGISTRAR CASO DE ATENCION</div>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" wire:model="Idcasosenfermedad">
                       
                        <div class="col">
                            <label class="form-label">CASO DE ATENCION <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="CasoEnfermedad" placeholder="Ej. radiografia">
                            @error('CasoEnfermedad')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <h1></h1>
                        <div class="modal-footer d-flex ">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalcaso">CANCELAR</button>
                            @if ($Idcasosenfermedad)
                            <button wire:click="EditarDatosCasos" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>
                            @else
                            <button wire:click="GuardarCasos" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                            @endif
                              
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>