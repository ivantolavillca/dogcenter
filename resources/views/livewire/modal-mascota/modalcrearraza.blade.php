<div wire:ignore.self id="modalcrearraza" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5  border-primary">
            <div class="modal-header">

                <div class="row">
                    <div class="text-center text-info h5"> REGISTRAR DATOS</div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">

                    <label class="form-label">NOMBRE <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" wire:model="NombreRaza" placeholder="Ej. nombre de lo que registraras">
                    @error('NombreRaza')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalraza">CANCELAR</button>
                    @if($razaId)
                    <button wire:click="btnEditarDatos" type="button" class="btn btn-primary waves-effect waves-light">EDITAR DATOS</button>
                    @else
                    <button wire:click="GuardarRaza" type="button" class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>