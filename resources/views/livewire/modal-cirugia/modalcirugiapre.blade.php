<div wire:ignore.self id="modalcirugiapre" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                @if ($registro_completo)
                    <h5 class="modal-title">CIRUGÍAS </h5>
                @endif
                @if ($registroCompletodetodomascota)
                    <div class="row">
                        <div>
                            <label class="form-label text-info"><strong>Nombre del cliente:</strong></label> <label
                                class="form-label">{{ $registroCompletodetodomascota->mascot_clie->nombre }}
                                {{ $registroCompletodetodomascota->mascot_clie->apellidos }}</label>
                        </div>
                        <div>
                            <label class="form-label text-info"><strong>Código del Cliente:</strong></label> <label
                                class="form-label">{{ $registroCompletodetodomascota->mascot_clie->codigo }}</label>
                        </div>
                        <div>
                            <label class="form-label text-info"><strong>Nombre de la mascota:</strong></label> <label
                                class="form-label">{{ $registroCompletodetodomascota->nombre }}</label>
                        </div>
                    </div>
                @endif

            </div>

            <div class="modal-body">
                <div class="row">
                    @if ($cirugiass->count() > 0)
                        @foreach ($cirugiass as $cirugia)
                            <div class="accordion" id="listadias-{{ $cirugia->id }}" wire:ignore.self>
                                <div class="accordion-item" wire:ignore.self>
                                    <h2 class="accordion-header" id="heading-{{ $cirugia->id }}">
                                        <button class="accordion-button collapsed text-white rounded-3"
                                            style="background-color: #082338;" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $cirugia->id }}" aria-expanded="false"
                                            aria-controls="collapse-{{ $cirugia->id }}" wire:ignore.self>
                                            <span class="me-2">
                                                <i class="bi bi-arrow-down"></i>
                                                <!-- Ícono para cuando el acordeón está colapsado -->
                                                <i class="bi bi-arrow-up"></i>
                                                <!-- Ícono para cuando el acordeón está expandido -->
                                            </span>
                                            <span class="tex-info rounded p-2" style="color: #27ef30;">
                                                CIRUGIA #{{ $conta++ }}
                                            </span>
                                        </button>
                                    </h2>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button wire:click="GuardarCirugiaEditarAbrir({{ $cirugia->id }})" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS</button>
                                        <button class="btn btn-sm btn-danger" wire:click.prevent="$emit('BorrarCirugias', {{ $cirugia->id }})"><i class="bx bxs-trash">ELIMINAR CIRUGIA</i></button>
                                    </div>
                                    <div id="collapse-{{ $cirugia->id }}" class="accordion-collapse collapse "
                                        aria-labelledby="heading-{{ $cirugia->id }}"
                                        data-bs-parent="#listadias-{{ $cirugia->id }}" wire:ignore.self>
                                        <div class="container">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-success d-inline mr-2">Dueño:</p>
                                                    <p class="text-info d-inline">
                                                        {{ $cirugia->cirugia_mascota->mascot_clie->nombre }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-success d-inline mr-2">mascota:</p>
                                                    <p class="text-info d-inline">
                                                        {{ $cirugia->cirugia_mascota->nombre }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-success d-inline mr-2">costo: </p>
                                                    <p class="text-info d-inline"> {{ $cirugia->total }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-success d-inline mr-2">Peso: </p>
                                                    @if( $cirugia->peso )
                                                    <p class="text-info d-inline"> {{ $cirugia->peso }}</p>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-success d-inline mr-2">descripcion: </p>
                                                    <p class="text-info d-inline">{{ $cirugia->descripcion }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-success d-inline mr-2">asa: </p>
                                                    <p class="text-info d-inline"> {{ $cirugia->asa }}</p>
                                                </div>
                                            </div>

                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label">SUBIR PDF o IMAGEN</label>
                                                    <div>
                                                        @if (session()->has('success'))
                                                            <div>{{ session('success') }}</div>
                                                        @endif
                                                        <input type="file" wire:model="archivosPdfciru" multiple>
                                                        @error('archivosPdfciru')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="d-flex">
                                                        <div class="mr-2 ml-2">
                                                            <button class="btn btn-danger"
                                                                wire:click="LimpiarDatosimagenescirugia">Limpiar</button>
                                                        </div>
                                                        <div class="ml-2">
                                                            <button type="button" class="btn btn-primary"
                                                                wire:click="GuardarTareaPDF({{ $cirugia->id }})">Guardar</button>
                                                        </div>
                                                        <div class="ml-2">
                                                            <button type="button" class="btn btn-info"
                                                                wire:click="VerImagenesCirugias({{ $cirugia->id }})">Ver</button>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>

                                        </div>

                                        <div class="accordion-body">
                                            <fieldset class="border border-primary p-2 ">
                                                <div class="accordion" id="listadias11" wire:ignore.self>
                                                    <div class="accordion-item" wire:ignore.self>
                                                        <h2 class="accordion-header" id="listadias_header11">
                                                            <button class="accordion-button collapsed p-0 mb-0"
                                                                style="background-color: #082338;" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse11"
                                                                aria-expanded="false" aria-controls="collapse"
                                                                wire:click="limpiartortododatoscirugiaf">
                                                                <p
                                                                    class="tex-info bg-success text-white p-2 mb-2 rounded">
                                                                    DATOS PRE-OPERATORIO</p>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapse11"
                                                            aria-labelledby="listadias_header11"
                                                            data-bs-parent="#listadias11" wire:ignore.self>

                                                            <fieldset class="border border-primary p-2">
                                                                <fieldset
                                                                    class="float-none w-auto border border-primary p-3 mb-3">
                                                                    <legend class="text-primary">DATOS GENERALES DE LA
                                                                        CIRUGÍA</legend>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="FC"
                                                                                    class="col-sm-3 col-form-label">FC</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="FC"
                                                                                        wire:model="FC">
                                                                                    @error('FC')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="FR"
                                                                                    class="col-sm-3 col-form-label">FR</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="FR"
                                                                                        wire:model="FR">
                                                                                    @error('FR')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="tem"
                                                                                    class="col-sm-3 col-form-label">Tº</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="tem"
                                                                                        wire:model="tem">
                                                                                    @error('tem')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="Valoracion"
                                                                                    class="col-sm-3 col-form-label">VALORACION</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="Valoracion"
                                                                                        wire:model="Valoracion">
                                                                                    @error('Valoracion')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <label for="MM"
                                                                                    class="col-sm-3 col-form-label">MM</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="MM"
                                                                                        wire:model="MM">
                                                                                    @error('MM')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="TLLC"
                                                                                    class="col-sm-3 col-form-label">TLLC</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="TLLC"
                                                                                        wire:model="TLLC">
                                                                                    @error('TLLC')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="SOPO2"
                                                                                    class="col-sm-3 col-form-label">SOPO2</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="SOPO2"
                                                                                        wire:model="SOPO2">
                                                                                    @error('SOPO2')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row mt-4">
                                                                                <div class="col-sm-9 offset-sm-3">
                                                                                    <button class="btn btn-success"
                                                                                        wire:click="GuardarDatosCirugia(1, {{ $cirugia->id }})">+
                                                                                        Agregar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                            </fieldset>
                                                            @if (count($datoscirugiaspre) > 0)
                                                                <div class="table-responsive mt-4">
                                                                    <table
                                                                        class="table table-hover table-bordered border-primary">
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
                                                                                <th>Valoracion</th>
                                                                                <th>ELIMINAR</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datoscirugiaspre as $datos)
                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}</td>
                                                                                        <td>{{ $datos->hora }}</td>
                                                                                        <td>{{ $datos->FC }}</td>
                                                                                        <td>{{ $datos->FR }}</td>
                                                                                        <td>{{ $datos->Tem }}</td>
                                                                                        <td>{{ $datos->MM }}</td>
                                                                                        <td>{{ $datos->TLLC }}</td>
                                                                                        <td>{{ $datos->sopo2 }}</td>
                                                                                        <td>{{ $datos->valoracion }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click="BorrarDatosCirugia( {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <span class="alert alert-success text-center">AUN
                                                                        NO SE TIENE NINGUN REGISTRO</span>
                                                                </div>
                                                            @endif

                                                            <hr>

                                                            <fieldset class="border border-primary p-2">
                                                                <legend class="text-primary">DATOS PRE-OPERATORIO
                                                                </legend>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="medicamento"
                                                                                class="col-sm-4 col-form-label">Medicamento</label>
                                                                            <div class="col-sm-8">
                                                                                <select class="form-control"
                                                                                    id="medicamento"
                                                                                    wire:model="medicamento">
                                                                                    <option value="">Seleccione
                                                                                        un medicamento</option>
                                                                                    <optgroup label="Pre-anestesico">
                                                                                        <option value="xilacina">
                                                                                            xilacina</option>
                                                                                        <option value="diazepam">
                                                                                            diazepam</option>
                                                                                        <option value="midazolam">
                                                                                            midazolam</option>
                                                                                        <option value="ketamina">
                                                                                            ketamina</option>
                                                                                        <option value="propofol">
                                                                                            propofol</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="Analgesia">
                                                                                        <option value="tramodol">
                                                                                            tramodol</option>
                                                                                        <option value="ketoprofeno">
                                                                                            ketoprofeno</option>
                                                                                        <option value="meloxicam">
                                                                                            meloxicam</option>
                                                                                    </optgroup>
                                                                                    <option value="Otros">Otros
                                                                                    </option>
                                                                                </select>
                                                                                @if ($medicamento == 'Otros')
                                                                                    <input type="text"
                                                                                        class="form-control mt-2"
                                                                                        wire:model="medicamento2"
                                                                                        placeholder="Especificar otro medicamento">
                                                                                @endif
                                                                                @error('medicamento')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="mg"
                                                                                class="col-sm-4 col-form-label">mg</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="mg" wire:model="mg">
                                                                                @error('mg')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="ml"
                                                                                class="col-sm-4 col-form-label">ml</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="ml" wire:model="ml">
                                                                                @error('ml')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="via"
                                                                                class="col-sm-4 col-form-label">Vía</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="via" wire:model="via">
                                                                                @error('via')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="observaciones"
                                                                                class="col-sm-4 col-form-label">Observaciones</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="observaciones"
                                                                                    wire:model="observaciones">
                                                                                @error('observaciones')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-8 offset-sm-4">
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarpreOperatorio(1, {{ $cirugia->id }})">+Agregar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            @if (count($cirugiapreope) > 0)
                                                                <div class="table-responsive mt-4">
                                                                    <table
                                                                        class="table table-hover table-bordered border-primary">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Hora </th>
                                                                                <th>Medicamento</th>
                                                                                <th>mg</th>
                                                                                <th>ml</th>
                                                                                <th>via</th>
                                                                                <th>observaciones</th>
                                                                                <th>Eliminar</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($cirugiapreope as $datos)
                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}</td>
                                                                                        <td>{{ $datos->hora }}</td>
                                                                                        <td>{{ $datos->detalle }}</td>
                                                                                        <td>{{ $datos->mg }}</td>
                                                                                        <td>{{ $datos->ml }}</td>
                                                                                        <td>{{ $datos->via }}</td>
                                                                                        <td>{{ $datos->observaciones }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click="BorrarpreCirugia( {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <span class="alert alert-success text-center">AUN
                                                                        NO SE TIENE NINGUN REGISTRO</span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="accordion" id="listadias22" wire:ignore.self>
                                                    <div class="accordion-item" wire:ignore.self>
                                                        <h2 class="accordion-header" id="listadias_header">
                                                            <button class="accordion-button collapsed p-0 mb-0"
                                                                style="background-color: #082338;" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse22"
                                                                aria-expanded="false" aria-controls="collapse"
                                                                wire:ignore.self
                                                                wire:click="limpiartortododatoscirugiaf">
                                                                <p
                                                                    class="tex-info bg-warning text-white p-2 mb-2 rounded">
                                                                    DATOS TRANS-OPERATORIO</p>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapse22"
                                                            aria-labelledby="listadias_header"
                                                            data-bs-parent="#listadias22" wire:ignore.self>

                                                            <fieldset
                                                                class="float-none w-auto border border-primary p-3 mb-3">
                                                                <legend class="text-primary">DATOS GENERALES DE LA
                                                                    CIRUGÍA</legend>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="FC"
                                                                                class="col-sm-3 col-form-label">FC</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="FC" wire:model="FC">
                                                                                @error('FC')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="FR"
                                                                                class="col-sm-3 col-form-label">FR</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="FR" wire:model="FR">
                                                                                @error('FR')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="tem"
                                                                                class="col-sm-3 col-form-label">Tº</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="tem" wire:model="tem">
                                                                                @error('tem')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Valoracion"
                                                                                class="col-sm-3 col-form-label">VALORACION</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="Valoracion"
                                                                                    wire:model="Valoracion">
                                                                                @error('Valoracion')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="MM"
                                                                                class="col-sm-3 col-form-label">MM</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="MM" wire:model="MM">
                                                                                @error('MM')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="TLLC"
                                                                                class="col-sm-3 col-form-label">TLLC</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="TLLC" wire:model="TLLC">
                                                                                @error('TLLC')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="SOPO2"
                                                                                class="col-sm-3 col-form-label">SOPO2</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="SOPO2" wire:model="SOPO2">
                                                                                @error('SOPO2')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-9 offset-sm-3">
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarDatosCirugia(2, {{ $cirugia->id }})">+Agregar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            @if (count($datoscirugiaspre2) > 0)
                                                                <div class="table-responsive mt-4">
                                                                    <table
                                                                        class="table table-hover table-bordered border-primary">
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
                                                                                <th>Valoracion</th>
                                                                                <th>ELIMINAR</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datoscirugiaspre2 as $datos)
                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}</td>
                                                                                        <td>{{ $datos->hora }}</td>
                                                                                        <td>{{ $datos->FC }}</td>
                                                                                        <td>{{ $datos->FR }}</td>
                                                                                        <td>{{ $datos->Tem }}</td>
                                                                                        <td>{{ $datos->MM }}</td>
                                                                                        <td>{{ $datos->TLLC }}</td>
                                                                                        <td>{{ $datos->sopo2 }}</td>
                                                                                        <td>{{ $datos->valoracion }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click="BorrarDatosCirugia( {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <span class="alert alert-success text-center">AUN
                                                                        NO SE TIENE NINGUN REGISTRO</span>
                                                                </div>
                                                            @endif

                                                            <hr>
                                                            <fieldset class="border border-primary p-2">
                                                                <legend class="text-primary">DATOS TRANS-OPERATORIO
                                                                </legend>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="medicamento"
                                                                                class="col-sm-4 col-form-label">Medicamento</label>
                                                                            <div class="col-sm-8">
                                                                                <select class="form-control"
                                                                                    id="medicamento"
                                                                                    wire:model="medicamento">
                                                                                    <option value="">Seleccione
                                                                                        un medicamento</option>
                                                                                    <optgroup label="Pre-anestesico">
                                                                                        <option value="xilacina">
                                                                                            xilacina</option>
                                                                                        <option value="diazepam">
                                                                                            diazepam</option>
                                                                                        <option value="midazolam">
                                                                                            midazolam</option>
                                                                                        <option value="ketamina">
                                                                                            ketamina</option>
                                                                                        <option value="propofol">
                                                                                            propofol</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="Analgesia">
                                                                                        <option value="tramodol">
                                                                                            tramodol</option>
                                                                                        <option value="ketoprofeno">
                                                                                            ketoprofeno</option>
                                                                                        <option value="meloxicam">
                                                                                            meloxicam</option>
                                                                                    </optgroup>
                                                                                    <option value="Otros">Otros
                                                                                    </option>
                                                                                </select>
                                                                                @if ($medicamento == 'Otros')
                                                                                    <input type="text"
                                                                                        class="form-control mt-2"
                                                                                        wire:model="medicamento2"
                                                                                        placeholder="Especificar otro medicamento">
                                                                                @endif
                                                                                @error('medicamento')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="mg"
                                                                                class="col-sm-4 col-form-label">mg</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="mg" wire:model="mg">
                                                                                @error('mg')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="ml"
                                                                                class="col-sm-4 col-form-label">ml</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="ml" wire:model="ml">
                                                                                @error('ml')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="via"
                                                                                class="col-sm-4 col-form-label">Vía</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="via" wire:model="via">
                                                                                @error('via')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="observaciones"
                                                                                class="col-sm-4 col-form-label">Observaciones</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="observaciones"
                                                                                    wire:model="observaciones">
                                                                                @error('observaciones')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-8 offset-sm-4">
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarpreOperatorio(2, {{ $cirugia->id }})">+Agregar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            @if (count($cirugiapreope2) > 0)
                                                                <div class="table-responsive mt-4">
                                                                    <table
                                                                        class="table table-hover table-bordered border-primary">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Hora </th>
                                                                                <th>Medicamento</th>
                                                                                <th>mg</th>
                                                                                <th>ml</th>
                                                                                <th>via</th>
                                                                                <th>observaciones</th>
                                                                                <th>Eliminar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($cirugiapreope2 as $datos)
                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}</td>
                                                                                        <td>{{ $datos->hora }}</td>
                                                                                        <td>{{ $datos->detalle }}</td>
                                                                                        <td>{{ $datos->mg }}</td>
                                                                                        <td>{{ $datos->ml }}</td>
                                                                                        <td>{{ $datos->via }}</td>
                                                                                        <td>{{ $datos->observaciones }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click="BorrarpreCirugia( {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <span class="alert alert-success text-center">AUN
                                                                        NO SE TIENE NINGUN REGISTRO</span>
                                                                </div>
                                                            @endif




                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="accordion" id="listadias33" wire:ignore.self>
                                                    <div class="accordion-item" wire:ignore.self>
                                                        <h2 class="accordion-header" id="listadias_header">
                                                            <button class="accordion-button collapsed p-0 mb-0"
                                                                style="background-color: #082338;" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse33"
                                                                aria-expanded="false" aria-controls="collapse"
                                                                wire:ignore.self
                                                                wire:click="limpiartortododatoscirugiaf">
                                                                <p
                                                                    class="tex-info bg-info text-white p-2 mb-2 rounded">
                                                                    DATOS POST-OPERATORIO</p>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse" id="collapse33"
                                                            aria-labelledby="listadias_header"
                                                            data-bs-parent="#listadias33" wire:ignore.self>

                                                            <fieldset
                                                                class="float-none w-auto border border-primary p-3 mb-3">
                                                                <legend class="text-primary">DATOS GENERALES DE LA
                                                                    CIRUGÍA</legend>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="FC"
                                                                                class="col-sm-3 col-form-label">FC</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="FC" wire:model="FC">
                                                                                @error('FC')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="FR"
                                                                                class="col-sm-3 col-form-label">FR</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="FR" wire:model="FR">
                                                                                @error('FR')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="tem"
                                                                                class="col-sm-3 col-form-label">Tº</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="tem" wire:model="tem">
                                                                                @error('tem')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="Valoracion"
                                                                                class="col-sm-3 col-form-label">VALORACION</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="Valoracion"
                                                                                    wire:model="Valoracion">
                                                                                @error('Valoracion')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="MM"
                                                                                class="col-sm-3 col-form-label">MM</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="MM" wire:model="MM">
                                                                                @error('MM')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="TLLC"
                                                                                class="col-sm-3 col-form-label">TLLC</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="TLLC" wire:model="TLLC">
                                                                                @error('TLLC')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="SOPO2"
                                                                                class="col-sm-3 col-form-label">SOPO2</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="SOPO2" wire:model="SOPO2">
                                                                                @error('SOPO2')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-9 offset-sm-3">
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarDatosCirugia(3, {{ $cirugia->id }})">+Agregar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            @if (count($datoscirugiaspre3) > 0)
                                                                <div class="table-responsive mt-4">
                                                                    <table
                                                                        class="table table-hover table-bordered border-primary">
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
                                                                                <th>Valoracion</th>
                                                                                <th>ELIMINAR</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($datoscirugiaspre3 as $datos)
                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}</td>
                                                                                        <td>{{ $datos->hora }}</td>
                                                                                        <td>{{ $datos->FC }}</td>
                                                                                        <td>{{ $datos->FR }}</td>
                                                                                        <td>{{ $datos->Tem }}</td>
                                                                                        <td>{{ $datos->MM }}</td>
                                                                                        <td>{{ $datos->TLLC }}</td>
                                                                                        <td>{{ $datos->sopo2 }}</td>
                                                                                        <td>{{ $datos->valoracion }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click="BorrarDatosCirugia( {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <span class="alert alert-success text-center">AUN
                                                                        NO SE TIENE NINGUN REGISTRO</span>
                                                                </div>
                                                            @endif

                                                            <hr>

                                                            <fieldset class="border border-primary p-2">
                                                                <legend class="text-primary">DATOS POST-OPERATORIO
                                                                </legend>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="medicamento"
                                                                                class="col-sm-4 col-form-label">Medicamento</label>
                                                                            <div class="col-sm-8">
                                                                                <select class="form-control"
                                                                                    id="medicamento"
                                                                                    wire:model="medicamento">
                                                                                    <option value="">Seleccione
                                                                                        un medicamento</option>
                                                                                    <optgroup label="Pre-anestesico">
                                                                                        <option value="xilacina">
                                                                                            xilacina</option>
                                                                                        <option value="diazepam">
                                                                                            diazepam</option>
                                                                                        <option value="midazolam">
                                                                                            midazolam</option>
                                                                                        <option value="ketamina">
                                                                                            ketamina</option>
                                                                                        <option value="propofol">
                                                                                            propofol</option>
                                                                                    </optgroup>
                                                                                    <optgroup label="Analgesia">
                                                                                        <option value="tramodol">
                                                                                            tramodol</option>
                                                                                        <option value="ketoprofeno">
                                                                                            ketoprofeno</option>
                                                                                        <option value="meloxicam">
                                                                                            meloxicam</option>
                                                                                    </optgroup>
                                                                                    <option value="Otros">Otros
                                                                                    </option>
                                                                                </select>
                                                                                @if ($medicamento == 'Otros')
                                                                                    <input type="text"
                                                                                        class="form-control mt-2"
                                                                                        wire:model="medicamento2"
                                                                                        placeholder="Especificar otro medicamento">
                                                                                @endif
                                                                                @error('medicamento')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="mg"
                                                                                class="col-sm-4 col-form-label">mg</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="mg" wire:model="mg">
                                                                                @error('mg')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="ml"
                                                                                class="col-sm-4 col-form-label">ml</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="ml" wire:model="ml">
                                                                                @error('ml')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            <label for="via"
                                                                                class="col-sm-4 col-form-label">Vía</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="via" wire:model="via">
                                                                                @error('via')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="observaciones"
                                                                                class="col-sm-4 col-form-label">Observaciones</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="observaciones"
                                                                                    wire:model="observaciones">
                                                                                @error('observaciones')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-8 offset-sm-4">
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarpreOperatorio(3, {{ $cirugia->id }})">+Agregar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>

                                                            @if (count($cirugiapreope3) > 0)
                                                                <div class="table-responsive mt-4">
                                                                    <table
                                                                        class="table table-hover table-bordered border-primary">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ID</th>
                                                                                <th>Hora </th>
                                                                                <th>Medicamento</th>
                                                                                <th>mg</th>
                                                                                <th>ml</th>
                                                                                <th>via</th>
                                                                                <th>observaciones</th>
                                                                                <th>Eliminar</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($cirugiapreope3 as $datos)
                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}</td>
                                                                                        <td>{{ $datos->hora }}</td>
                                                                                        <td>{{ $datos->detalle }}</td>
                                                                                        <td>{{ $datos->mg }}</td>
                                                                                        <td>{{ $datos->ml }}</td>
                                                                                        <td>{{ $datos->via }}</td>
                                                                                        <td>{{ $datos->observaciones }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click="BorrarpreCirugia( {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <span class="alert alert-success text-center">AUN
                                                                        NO SE TIENE NINGUN REGISTRO</span>
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
                <button wire:click="Crearcirugiamascota" type="button" class="btn btn-primary">Crear cirugía para la
                    mascota</button>
            </div>
        </div>
    </div>
</div>
