<div wire:ignore.self id="IDmodlupa2" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-sm"> <!-- Cambiado a modal-sm -->
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <div class="modal-header">
                <div class="row">
                    <div class="text-center text-info h5"> BUSCAR DOCTORES</div>
                </div>
            </div>
            <div class="m-0">
                <div class="input-group">
                    <input type="text" wire:model="SearchCasos" class="form-control" placeholder="BUSCAR POR CI" aria-label="Recipient's username">
                    <button type="button" class="btn btn-danger" wire:click="limpiarmodalbusqueda2" ><i class="bx bx-x"></i></button>
                </div>
                <br>
                @foreach ($users as $caso)
                    <div class="input-group">
                    <label class="form-control">{{ "Id: ".$caso->id . " Des.: " . $caso->name }}</label>
                    <div class="input-group-append">
                        <button class="btn btn-success" wire:click="CargarDatosNombreCi2({{$caso->id}})"><i class="bx bx-plus"></i></button>
                    </div>
                </div>
                @endforeach
                 
            </div>
          
               
        </div>
    </div>
</div>
