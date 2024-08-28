<div wire:ignore.self id="Idmodalficha" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5  border-primary">
            <div class="modal-header">
                @if ($Idficha)
                <div class="row">
                    <div class="text-center text-info h5"> EDITAR FICHAS</div>
                </div>
                @else
                <div class="row">
                    <div class="text-center text-info h5"> REGISTRAR FICHAS</div>
                </div>
                @endif
            </div>
            <div class="modal-body">
                <div class="row">

                    <input type="hidden" wire:model="Idficha">
                    <input type="hidden" wire:model="Id_Cliente">
                    <input type="hidden" wire:model="Id_user">
                    <div class="row">


                        <div class="row">
                            @if($a)
                            <div class="col-md-6">
                                <label class="form-label">{{"Nombre: ". $NombreCliente}}</label>
                                <br>
                                <label class="form-label">{{"Id: ". $Id_Cliente}}</label>
                            </div>
                            @else
                            <div class="col-md-6">
                                <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                                <div class="input-group" data-bs-backdrop="static">
                                    <input type="text" class="form-control" wire:model="NombreCliente" placeholder="Ej. Juan M">
                                    <div>
                                        <button type="button" class="btn btn-primary" wire:click="abrirmodallupa">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('NombreCliente')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                     
                            @if($b)
                            <div class="col-md-6">
                                <label class="form-label">{{"Des.: ". $Nombredoctor}}</label>
                                <br>
                                <label class="form-label">{{"Id: ". $Id_user}}</label>
                            </div>
                            @else
                            <div class="col-md-6">
                                <label class="form-label">NOMBRE DEL DOCTOR <span class="text-danger">*</span></label>
                                <div class="input-group" data-bs-backdrop="static">
                                    <input type="text" class="form-control" wire:model="Nombredoctor" placeholder="Ej. Radiografia">
                                    <div>
                                        <button type="button" class="btn btn-primary" wire:click="abrirmodallupa2">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>

                                    </div>
                                </div>
                                @error('Nombredoctor')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @endif
                      
                       
                            
                        </div>
                        <h1></h1>

                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect mr-2" data-bs-dismiss="modal" wire:click="limpiarmodal">CANCELAR</button>
                        @if ($Idficha)
                        <button wire:click="EditarDatosProveedor" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>
                        @else
                        <button wire:click="GuardarFIchas" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>