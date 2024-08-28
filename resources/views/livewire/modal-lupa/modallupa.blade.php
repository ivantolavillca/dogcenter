<div wire:ignore.self id="IDmodlupa" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm"> <!-- Cambiado a modal-sm -->
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <div class="modal-header">
                <div class="row">
                    <div class="text-center text-info h5"> BUSCAR CLIENTE</div>
                </div>
            </div>
            <div class="m-0">
                <div class="input-group">
                    <input type="text" wire:model="SearchCliente" class="form-control" placeholder="BUSCAR POR CI" aria-label="Recipient's username">
                    <button type="button" class="btn btn-danger" wire:click="limpiarmodalbusqueda" ><i class="bx bx-x"></i></button>
                </div>
                <br>
                @foreach ($clientes as $cli)
                    <div class="input-group">
                    <label class="form-control">{{ "Nom: ".$cli->nombre . " Ci: " . $cli->ci }}</label>
                    <div class="input-group-append">
                        <button class="btn btn-success" wire:click="CargarDatosNombreCi({{$cli->id}})"><i class="bx bx-plus"></i></button>
                    </div>
                </div>
                @endforeach
                 
            </div>
          
               
        </div>
    </div>
</div>
