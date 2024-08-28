    <div wire:ignore id="modalcirugiapre" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                    @if (true)
                    <div class="row">
                        <div class="text-center text-info h5"> REGISTRAR CIRUGIA PRE-OPERATORIA</div>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" wire:model="Idprovedor">
                            <label class="form-label">NOMBRE DEL DUEÑO DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completo)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completo->mascot_clie->nombre }}
                            </p>
                            @endif
                            <hr>
                        </div>
                        <div class="col-md-6">

                            <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completo)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completo->nombre }}
                            </p>
                            @endif
                            <hr>

                        </div>
                    </div>
                    <hr>
                   


                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodal">CANCELAR</button>
                        <button wire:click="GuardarCirugia" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>

                    </div>
                </div>
            </div>
        </div>
    </div>