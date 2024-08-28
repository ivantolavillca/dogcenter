<div wire:ignore.self id="modalcirugiapre" data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-hidden="false">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">VER VACUNAS</h5>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="listadias" wire:ignore.self>
                        <div class="accordion-item" wire:ignore.self>
                            <h2 class="accordion-header" id="listadias">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne" wire:ignore.self>
                                  CONTROL DE VACUNAS
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="listadias"
                                data-bs-parent="#listadias" wire:ignore.self>
                                <div class="accordion-body">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="float-none w-auto text-primary">DATOS DE LA NUEVA VACUNA
                                        </legend>
                                        <div class="row text-center">
                                            <div class="col-3">
                                                <label class="form-label">Fecha</label>

                                                @php
                                                    $fecha_actual = date('Y-m-d');
                                                @endphp
                                                <input type="date" class="form-control"
                                                    value="{{ $fecha_actual }}" disabled
                                                    style="color: rgb(19, 9, 101)">


                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">Edad</label>
                                                <input type="text" class="form-control"
                                                    wire:model="EdadEnVacunas">
                                                @error('EdadEnVacunas')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-5">
                                                <label class="form-label">Vacuna aplicada</label>
                                                <input type="text" class="form-control"
                                                    wire:model="VacunaAplicada">
                                                @error('VacunaAplicada')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">Proxima Fecha</label>
                                                <input type="date" class="form-control"
                                                    wire:model="ProximaFecha">
                                                @error('ProximaFecha')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Veterinario</label>
                                                <select name="" id="" wire:model="Veterinario"
                                                    class="form-select">
                                                    <option value="">[ELEGIR UNA OPCIÓN]</option>
                                                    @foreach ($doctores as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}
                                                            {{ $doctor->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('Veterinario')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2 mt-4">
                                                <button class="btn btn-success" wire:click=GuardaVacuna>+</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @if (count($datoscirugiaspre) > 0)
                                    <div class="table-responsive mt-4">
                                        <table class="table table-hover table-bordered border-primary">
                                            <thead>
                                                <tr>
                                                    <th>FECHA</th>
                                                    <th>EDAD</th>
                                                    <th>VACUNA APLICADA</th>
                                                    <th>PROXIMA FECHA</th>
                                                    <th>VETERINARIO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($datoscirugiaspre as $datos)
                                                    <tr>
                                                        <td>{{ $datos->id }}</td>
                                                        <td>{{ $datos->hora }}</td>
                                                        <td>{{ $datos->FC }}</td>
                                                        <td>{{ $datos->FR }}</td>
                                                        <td>{{ $datos->Tem }}</td>
                                                        <td>{{ $datos->MM }}</td>
                                                        <td>{{ $datos->TLLC }}</td>
                                                        <td>{{ $datos->sopo2 }}</td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                wire:click.prevent="$emit('BorrarVacula', {{ $vacunas->datos }})"><i
                                                                    class="bx bxs-trash"></i></button>
            
            
                                                        </td>
            
            
                                                    </tr>
                                                @endforeach
            
                                            </tbody>
                                        </table>
                                        <div class="row text-center">
                                            {{ $datoscirugiaspre->links() }}
                                        </div>
            
                                    </div>
                                @else
                                    <div class="row">
                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>

                
                    <div class="accordion mt-4" id="listadias" wire:ignore.self>
                        <div class="accordion-item" wire:ignore.self>
                            <h2 class="accordion-header" id="listadias">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#DOS" aria-expanded="false"
                                    aria-controls="DOS" wire:ignore.self>
                                    CONTROL DE DESPARASITACIONES
                                </button>
                            </h2>
                            <div id="DOS" class="accordion-collapse collapse " aria-labelledby="listadias"
                                data-bs-parent="#listadias" wire:ignore.self>
                                <div class="accordion-body">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="float-none w-auto text-primary">DATOS DE LA DESPARACITACIÓN
                                        </legend>
                                        <div class="row text-center">
                                            <div class="col-3">
                                                <label class="form-label">Fecha</label>

                                                @php
                                                    $fecha_actual = date('Y-m-d');
                                                @endphp
                                                <input type="date" class="form-control"
                                                    value="{{ $fecha_actual }}" disabled
                                                    style="color: rgb(19, 9, 101)">


                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Edad</label>
                                                <input type="text" class="form-control"
                                                    wire:model="EdadEnDesparacitacion">
                                                @error('EdadEnDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Peso</label>
                                                <input type="text" class="form-control"
                                                    wire:model="PesoEnDesparacitacion">
                                                @error('PesoEnDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label class="form-label">Producto /Dosis</label>
                                       
                                                    <select name="" id="" wire:model="Producto"
                                                    class="form-select">
                                                    <option value="">[ELEGIR UNA OPCIÓN]</option>
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('Producto')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label">Proxima Fecha</label>
                                                <input type="date" class="form-control"
                                                    wire:model="ProximaFechaDesparacitacion">
                                                @error('ProximaFechaDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Veterinario</label>
                                                <select name="" id="" wire:model="VeterinarioDesparacitacion"
                                                    class="form-select">
                                                    <option value="">[ELEGIR UNA OPCIÓN]</option>
                                                    @foreach ($doctores as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('VeterinarioDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-2 mt-4">
                                                <button class="btn btn-success" wire:click="GuardaDesparacitacion">+</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                @if (count($DesparacitacionPorMascota) > 0)
                                <div class="table-responsive mt-4">
                                    <table class="table table-hover table-bordered border-primary">
                                        <thead>
                                            <tr>
                                                <th>FECHA</th>
                                                <th>EDAD</th>
                                                <th>PESO</th>
                                                <th>PRODUCTO</th>
                                                <th>PROXIMA FECHA</th>
                                                <th>VETERINARIO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($DesparacitacionPorMascota as $desparacitacion)
                                                <tr>
                                                    <td>{{ $desparacitacion->fecha }}</td>
                                                    <td>{{ $desparacitacion->edad }}</td>
                                                    <td>{{ $desparacitacion->peso }}</td>
                                                    <td>{{ $desparacitacion->desparacitaciones_producto->nombre }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($desparacitacion->proxima_fecha)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ $desparacitacion->desparacitaciones_veterinario->name }}</td>
                                                    <td>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="$emit('BorrarDesparacitacion', {{ $desparacitacion->id }})"><i
                                                                class="bx bxs-trash"></i></button>
        
                                                    </td>
        
                                                </tr>
                                            @endforeach
        
                                        </tbody>
                                    </table>
                                    <div class="row text-center">
                                        {{ $DesparacitacionPorMascota->links() }}
                                    </div>
        
                                </div>
                            @else
                                <div class="row">
                                    <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO DE
                                        DESPARACITACIÓN</span>
                                </div>
                            @endif
                            </div>
                        </div>


                    </div>

                 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="CancelarVacunas">Cancelar</button>
                </div>
            </div>
        </div>
    </div>