<div wire:ignore.self id="modalcirugiapre" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                @if($registro_completo )
                <h5 class="modal-title">BIENVENIDOS A CIRUGÍAS DE LA MASCOTA {{$registro_completo->nombre }} Id: {{$registro_completo->id }} </h5>
                @endif
            </div>
            <div class="modal-body">
                <div class="row">
                    @if ( $cirugiass->count() > 0)
                    @foreach ($cirugiass as $cirugia)
                    <div class="accordion" id="listadias-{{$cirugia->id}}" wire:ignore.self>
                        <div class="accordion-item" wire:ignore.self>
                            <h2 class="accordion-header" id="heading-{{$cirugia->id}}">
                                <button class="accordion-button collapsed text-white rounded-3" style="background-color: #082338;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$cirugia->id}}" aria-expanded="false" aria-controls="collapse-{{$cirugia->id}}" wire:ignore.self>
                                    <span class="me-2">
                                        <i class="bi bi-arrow-down"></i> <!-- Ícono para cuando el acordeón está colapsado -->
                                        <i class="bi bi-arrow-up"></i> <!-- Ícono para cuando el acordeón está expandido -->
                                    </span>
                                    <span class="tex-info rounded p-2" style="color: #27ef30;">
                                        CIRUGIA #{{ $conta++ }}
                                    </span>
                                </button>


                            </h2>
                            <div id="collapse-{{$cirugia->id}}" class="accordion-collapse collapse " aria-labelledby="heading-{{$cirugia->id}}" data-bs-parent="#listadias-{{$cirugia->id}}" wire:ignore.self>

                                <div class="accordion-body">
                                    <fieldset class="border border-primary p-2 ">
                                        <div class="accordion" id="listadias11" wire:ignore.self>
                                            <div class="accordion-item" wire:ignore.self>
                                                <h2 class="accordion-header" id="listadias_header11">
                                                    <button class="accordion-button collapsed p-0 mb-0" style="background-color: #082338;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse"  wire:click="limpiartortododatoscirugiaf">
                                                        <p class="tex-info bg-success text-white p-2 mb-2 rounded">DATOS PRE-OPERATORIO</p>
                                                    </button>
                                                </h2>
                                                <div class="accordion-collapse collapse" id="collapse11" aria-labelledby="listadias_header11" data-bs-parent="#listadias11" wire:ignore.self>

                                                    <fieldset class="border border-primary p-2">
                                                        <legend class="float-none w-auto text-primary">DATOS GENERALES DE LA CIRUGIA</legend>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Hora</label>
                                                                            <div class="input-group">
                                                                                <input wire:model="horaActual" type="text" class="form-control form-control-sm" disabled style="color: rgb(19, 9, 101)">
                                                                                <button wire:click="obtenerHora" class="btn btn-primary btn-sm">Obtener Hora</button>
                                                                            </div>
                                                                            @error('horaActual')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">FC</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="FC">
                                                                            @error('FC')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">FR</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="FR">
                                                                            @error('FR')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Tº</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="tem">
                                                                            @error('tem')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">MM</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="MM">
                                                                            @error('MM')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">TLLC</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="TLLC">
                                                                            @error('TLLC')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">SOPO2</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="SOPO2">
                                                                            @error('SOPO2')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mt-4">
                                                                            <button class="btn btn-success" wire:click="GuardarDatosCirugia(1, {{ $cirugia->id }})">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    @if (count($datoscirugiaspre) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-hover table-bordered border-primary">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>HORA</th>
                                                                    <th>FC</th>
                                                                    <th>FR</th>
                                                                    <th>Tº</th>
                                                                    <th>MM</th>
                                                                    <th>TLLC</th>
                                                                    <th>SOPO2</th>
                                                                    <th>ELIMINAR</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($datoscirugiaspre as $datos )
                                                                @if($datos->cirugia_id==$cirugia->id)
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
                                                                        <button class="btn btn-danger" wire:click="BorrarDatosCirugia( {{ $datos->id }})"><i class="bx bxs-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                                    </div>
                                                    @endif

                                                    <hr>

                                                    <fieldset class="border border-primary p-2">
                                                        <legend class="float-none w-auto text-primary">DATOS PRE-OPERATORIO </legend>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Hora</label>
                                                                            <div class="input-group">
                                                                                <input wire:model="horaActual2" type="text" class="form-control form-control-sm" disabled style="color: rgb(19, 9, 101)">
                                                                                <button wire:click="obtenerHora2" class="btn btn-primary btn-sm">Obtener Hora</button>
                                                                            </div>
                                                                            @error('horaActual2')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Medicamento</label>
                                                                            <select class="form-control form-control-sm" wire:model="medicamento">
                                                                                <option value="">selecciones un valor</option>
                                                                                <optgroup label="Pre-anestesico">
                                                                                    <option value="xilacina">xilacina</option>
                                                                                    <option value="diazepam">diazepam</option>
                                                                                    <option value="midazolam">midazolam</option>
                                                                                    <option value="ketamina">ketamina</option>
                                                                                    <option value="propofol">propofol</option>
                                                                                </optgroup>
                                                                                <optgroup label="Analgesia">
                                                                                    <option value="tramodol">tramodol</option>
                                                                                    <option value="ketoprofeno">ketoprofeno</option>
                                                                                    <option value="meloxicam">meloxicam</option>
                                                                                    <!-- Agrega más medicamentos de categoría B según sea necesario -->
                                                                                </optgroup>
                                                                                <option value="Otros">Otros</option>
                                                                            </select>
                                                                            @if($medicamento == 'Otros')
                                                                            <input type="text" class="form-control form-control-sm mt-2" wire:model.defer="medicamento" placeholder="Especificar otro medicamento">
                                                                            @endif
                                                                            @error('medicamento')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">mg</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="mg">
                                                                            @error('mg')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">ml</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="ml">
                                                                            @error('ml')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">via</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="via">
                                                                            @error('via')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">observaciones</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="observaciones">
                                                                            @error('observaciones')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mt-4">
                                                                            <button class="btn btn-success" wire:click="GuardarpreOperatorio(1, {{ $cirugia->id }})">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    @if (count($cirugiapreope) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-hover table-bordered border-primary">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Hora </th>
                                                                    <th>Detalle</th>
                                                                    <th>mg</th>
                                                                    <th>ml</th>
                                                                    <th>via</th>
                                                                    <th>observaciones</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cirugiapreope as $datos )
                                                                @if($datos->cirugia_id==$cirugia->id)
                                                                <tr>
                                                                    <td>{{ $datos->id }}</td>
                                                                    <td>{{ $datos->hora }}</td>
                                                                    <td>{{ $datos->detalle }}</td>
                                                                    <td>{{ $datos->mg }}</td>
                                                                    <td>{{ $datos->ml }}</td>
                                                                    <td>{{ $datos->via }}</td>
                                                                    <td>{{ $datos->observaciones }}</td>
                                                                    <td>
                                                                        <button class="btn btn-danger" wire:click="BorrarpreCirugia( {{ $datos->id }})"><i class="bx bxs-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                                    </div>
                                                    @endif




                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="accordion" id="listadias22" wire:ignore.self>
                                            <div class="accordion-item" wire:ignore.self>
                                                <h2 class="accordion-header" id="listadias_header">
                                                    <button class="accordion-button collapsed p-0 mb-0" style="background-color: #082338;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse" wire:ignore.self wire:click="limpiartortododatoscirugiaf">
                                                        <p class="tex-info bg-warning text-white p-2 mb-2 rounded">DATOS TRANS-OPERATORIO</p>
                                                    </button>
                                                </h2>
                                                <div class="accordion-collapse collapse" id="collapse22" aria-labelledby="listadias_header" data-bs-parent="#listadias22" wire:ignore.self>

                                                    <fieldset class="border border-primary p-2">
                                                        <legend class="float-none w-auto text-primary">DATOS GENERALES DE LA CIRUGIA</legend>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Hora</label>
                                                                            <div class="input-group">
                                                                                <input wire:model="horaActual" type="text" class="form-control form-control-sm" disabled style="color: rgb(19, 9, 101)">
                                                                                <button wire:click="obtenerHora" class="btn btn-primary btn-sm">Obtener Hora</button>
                                                                            </div>
                                                                            @error('horaActual')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">FC</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="FC">
                                                                            @error('FC')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">FR</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="FR">
                                                                            @error('FR')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Tº</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="tem">
                                                                            @error('tem')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">MM</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="MM">
                                                                            @error('MM')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">TLLC</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="TLLC">
                                                                            @error('TLLC')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">SOPO2</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="SOPO2">
                                                                            @error('SOPO2')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mt-4">
                                                                            <button class="btn btn-success" wire:click="GuardarDatosCirugia(2, {{ $cirugia->id }})">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    @if (count($datoscirugiaspre2) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-hover table-bordered border-primary">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>HORA</th>
                                                                    <th>FC</th>
                                                                    <th>FR</th>
                                                                    <th>Tº</th>
                                                                    <th>MM</th>
                                                                    <th>TLLC</th>
                                                                    <th>SOPO2</th>
                                                                    <th>ELIMINAR</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($datoscirugiaspre2 as $datos )
                                                                @if($datos->cirugia_id==$cirugia->id)
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
                                                                        <button class="btn btn-danger" wire:click="BorrarDatosCirugia( {{ $datos->id }})"><i class="bx bxs-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                                    </div>
                                                    @endif

                                                    <hr>

                                                    <fieldset class="border border-primary p-2">
                                                        <legend class="float-none w-auto text-primary">DATOS PRE-OPERATORIO </legend>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Hora</label>
                                                                            <div class="input-group">
                                                                                <input wire:model="horaActual2" type="text" class="form-control form-control-sm" disabled style="color: rgb(19, 9, 101)">
                                                                                <button wire:click="obtenerHora2" class="btn btn-primary btn-sm">Obtener Hora</button>
                                                                            </div>
                                                                            @error('horaActual2')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Medicamento</label>
                                                                            <select class="form-control form-control-sm" wire:model="medicamento">
                                                                                <option value="">selecciones un valor</option>
                                                                                <optgroup label="Pre-anestesico">
                                                                                    <option value="xilacina">xilacina</option>
                                                                                    <option value="diazepam">diazepam</option>
                                                                                    <option value="midazolam">midazolam</option>
                                                                                    <option value="ketamina">ketamina</option>
                                                                                    <option value="propofol">propofol</option>
                                                                                </optgroup>
                                                                                <optgroup label="Analgesia">
                                                                                    <option value="tramodol">tramodol</option>
                                                                                    <option value="ketoprofeno">ketoprofeno</option>
                                                                                    <option value="meloxicam">meloxicam</option>
                                                                                    <!-- Agrega más medicamentos de categoría B según sea necesario -->
                                                                                </optgroup>
                                                                                <option value="Otros">Otros</option>
                                                                            </select>
                                                                            @if($medicamento == 'Otros')
                                                                            <input type="text" class="form-control form-control-sm mt-2" wire:model.defer="medicamento" placeholder="Especificar otro medicamento">
                                                                            @endif
                                                                            @error('medicamento')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">mg</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="mg">
                                                                            @error('mg')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">ml</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="ml">
                                                                            @error('ml')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">via</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="via">
                                                                            @error('via')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">observaciones</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="observaciones">
                                                                            @error('observaciones')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mt-4">
                                                                            <button class="btn btn-success" wire:click="GuardarpreOperatorio(2, {{ $cirugia->id }})">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    @if (count($cirugiapreope2) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-hover table-bordered border-primary">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Hora </th>
                                                                    <th>Detalle</th>
                                                                    <th>mg</th>
                                                                    <th>ml</th>
                                                                    <th>via</th>
                                                                    <th>observaciones</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cirugiapreope2 as $datos )
                                                                @if($datos->cirugia_id==$cirugia->id)
                                                                <tr>
                                                                    <td>{{ $datos->id }}</td>
                                                                    <td>{{ $datos->hora }}</td>
                                                                    <td>{{ $datos->detalle }}</td>
                                                                    <td>{{ $datos->mg }}</td>
                                                                    <td>{{ $datos->ml }}</td>
                                                                    <td>{{ $datos->via }}</td>
                                                                    <td>{{ $datos->observaciones }}</td>
                                                                    <td>
                                                                        <button class="btn btn-danger" wire:click="BorrarpreCirugia( {{ $datos->id }})"><i class="bx bxs-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                                    </div>
                                                    @endif




                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="accordion" id="listadias33" wire:ignore.self>
                                            <div class="accordion-item" wire:ignore.self>
                                                <h2 class="accordion-header" id="listadias_header">
                                                    <button class="accordion-button collapsed p-0 mb-0" style="background-color: #082338;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse33" aria-expanded="false" aria-controls="collapse" wire:ignore.self wire:click="limpiartortododatoscirugiaf">
                                                        <p class="tex-info bg-info text-white p-2 mb-2 rounded">DATOS POST-OPERATORIO</p>
                                                    </button>
                                                </h2>
                                                <div class="accordion-collapse collapse" id="collapse33" aria-labelledby="listadias_header" data-bs-parent="#listadias33" wire:ignore.self>

                                                    <fieldset class="border border-primary p-2">
                                                        <legend class="float-none w-auto text-primary">DATOS GENERALES DE LA CIRUGIA</legend>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Hora</label>
                                                                            <div class="input-group">
                                                                                <input wire:model="horaActual" type="text" class="form-control form-control-sm" disabled style="color: rgb(19, 9, 101)">
                                                                                <button wire:click="obtenerHora" class="btn btn-primary btn-sm">Obtener Hora</button>
                                                                            </div>
                                                                            @error('horaActual')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">FC</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="FC">
                                                                            @error('FC')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">FR</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="FR">
                                                                            @error('FR')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Tº</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="tem">
                                                                            @error('tem')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">MM</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="MM">
                                                                            @error('MM')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">TLLC</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="TLLC">
                                                                            @error('TLLC')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">SOPO2</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="SOPO2">
                                                                            @error('SOPO2')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mt-4">
                                                                            <button class="btn btn-success" wire:click="GuardarDatosCirugia(3, {{ $cirugia->id }})">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    @if (count($datoscirugiaspre3) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-hover table-bordered border-primary">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>HORA</th>
                                                                    <th>FC</th>
                                                                    <th>FR</th>
                                                                    <th>Tº</th>
                                                                    <th>MM</th>
                                                                    <th>TLLC</th>
                                                                    <th>SOPO2</th>
                                                                    <th>ELIMINAR</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($datoscirugiaspre3 as $datos )
                                                                @if($datos->cirugia_id==$cirugia->id)
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
                                                                        <button class="btn btn-danger" wire:click="BorrarDatosCirugia( {{ $datos->id }})"><i class="bx bxs-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                                    </div>
                                                    @endif

                                                    <hr>

                                                    <fieldset class="border border-primary p-2">
                                                        <legend class="float-none w-auto text-primary">DATOS PRE-OPERATORIO </legend>
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Hora</label>
                                                                            <div class="input-group">
                                                                                <input wire:model="horaActual2" type="text" class="form-control form-control-sm" disabled style="color: rgb(19, 9, 101)">
                                                                                <button wire:click="obtenerHora2" class="btn btn-primary btn-sm">Obtener Hora</button>
                                                                            </div>
                                                                            @error('horaActual2')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Medicamento</label>
                                                                            <select class="form-control form-control-sm" wire:model="medicamento">
                                                                                <option value="">selecciones un valor</option>
                                                                                <optgroup label="Pre-anestesico">
                                                                                    <option value="xilacina">xilacina</option>
                                                                                    <option value="diazepam">diazepam</option>
                                                                                    <option value="midazolam">midazolam</option>
                                                                                    <option value="ketamina">ketamina</option>
                                                                                    <option value="propofol">propofol</option>
                                                                                </optgroup>
                                                                                <optgroup label="Analgesia">
                                                                                    <option value="tramodol">tramodol</option>
                                                                                    <option value="ketoprofeno">ketoprofeno</option>
                                                                                    <option value="meloxicam">meloxicam</option>
                                                                                    <!-- Agrega más medicamentos de categoría B según sea necesario -->
                                                                                </optgroup>
                                                                                <option value="Otros">Otros</option>
                                                                            </select>
                                                                            @if($medicamento == 'Otros')
                                                                            <input type="text" class="form-control form-control-sm mt-2" wire:model.defer="medicamento" placeholder="Especificar otro medicamento">
                                                                            @endif
                                                                            @error('medicamento')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">mg</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="mg">
                                                                            @error('mg')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">ml</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="ml">
                                                                            @error('ml')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">via</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="via">
                                                                            @error('via')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label">observaciones</label>
                                                                            <input type="text" class="form-control form-control-sm" wire:model="observaciones">
                                                                            @error('observaciones')
                                                                            <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mt-4">
                                                                            <button class="btn btn-success" wire:click="GuardarpreOperatorio(3, {{ $cirugia->id }})">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    @if (count($cirugiapreope3) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table class="table table-hover table-bordered border-primary">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Hora </th>
                                                                    <th>Detalle</th>
                                                                    <th>mg</th>
                                                                    <th>ml</th>
                                                                    <th>via</th>
                                                                    <th>observaciones</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cirugiapreope3 as $datos )
                                                                @if($datos->cirugia_id==$cirugia->id)
                                                                <tr>
                                                                    <td>{{ $datos->id }}</td>
                                                                    <td>{{ $datos->hora }}</td>
                                                                    <td>{{ $datos->detalle }}</td>
                                                                    <td>{{ $datos->mg }}</td>
                                                                    <td>{{ $datos->ml }}</td>
                                                                    <td>{{ $datos->via }}</td>
                                                                    <td>{{ $datos->observaciones }}</td>
                                                                    <td>
                                                                        <button class="btn btn-danger" wire:click="BorrarpreCirugia( {{ $datos->id }})"><i class="bx bxs-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                            </div>
                        </div><br>
                    </div>

                    @endforeach
                    @else
                    <div class="px-5 py-3 border-gray-200  text-sm">
                        <strong>No hay Registros</strong>
                    </div>
                    @endif

                </div>
            </div>

            <div class="modal-footer">
                <button wire:click="CerrarModalPrincipal" type="button" class="btn btn-danger">Cerrar</button>
                <button wire:click="Crearcirugiamascota" type="button" class="btn btn-primary">Crear cirugía para la mascota</button>
            </div>
        </div>
    </div>
</div>