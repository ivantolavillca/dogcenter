<div wire:ignore.self id="capturarImagenModal" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="capturarImagenModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="capturarImagenModalLabel">Capturar Imagen</h5>
            </div>
            <div class="modal-body">
                <!-- Contenedor de la vista previa de la cámara -->
                <div class="border border-primary rounded   embed-responsive embed-responsive-16by9">
                    <video width="100%" height="auto" id="cameraFeed" autoplay></video>
                </div>
                <hr>
                <div class="text-center">
                    <button type="button" class="btn btn-warning mr-2" wire:click="cambiarCamarat">Trasera</button>
                    <button type="button" class="btn btn-success" wire:click="cambiarCamarad">Frontal</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="limpiarcamara">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="$emit('capturarBtn1')" >Capturar</button>
            </div>
        </div>
    </div>
</div>