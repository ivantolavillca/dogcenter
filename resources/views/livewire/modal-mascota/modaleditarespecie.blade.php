<div wire:ignore.self id="modaleditarespecie" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm"> <!-- Cambiado de modal-lg a modal-sm -->
        <div class="modal-content radius-10 border-start border-5  border-primary">
            <div class="modal-header">
                <div class="row">
                    <div class="text-center text-info h5"> EDITAR ESPECIE</div>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" wire:model="especieId">
                <div class="row">
                    <label class="form-label">NOMBRE DE CLIENTE</label>
                    <input type="text" class="form-control" wire:model="NombreEspecieEdit">
                    @error('NombreEspecieEdit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalEditar">CANCELAR</button>
                    <button wire:click="GuardarEspecieEditado" type="button" class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

