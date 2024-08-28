    <div wire:ignore.self id="modalcrearespecie" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">

                    <div class="row">
                        <div class="text-center text-info h5"> REGISTRAR ESPECIE</div>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">NOMBRE DE LA ESPECIE <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="NombreEspecie" placeholder="Ej. Canina">
                            @error('NombreEspecie')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalespecie">CANCELAR</button>
                        <button wire:click="GuardarEspecie" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>