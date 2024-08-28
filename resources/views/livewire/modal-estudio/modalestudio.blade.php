<div wire:ignore.self id="modalestudios" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel" aria-hidden="false">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="modal-title">ESTUDIOS COMPLEMENTARIOS

            </h5>

        </div>
        <div class="modal-body">
            <div class="row">
                @if ($estudiosComplementarios->count() > 0)
                    @foreach ($estudiosComplementarios as $estudios)
                        <div class="accordion" id="listadias-{{ $estudios->id }}" wire:ignore.self>
                            <div class="accordion-item" wire:ignore.self>
                                <h2 class="accordion-header" id="heading-{{ $estudios->id }}">
                                    <button class="accordion-button collapsed text-white rounded-3"
                                        style="background-color: #082338;" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $estudios->id }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $estudios->id }}" wire:ignore.self>
                                        <span class="me-2">
                                            <i class="bi bi-arrow-down"></i>
                                            <!-- Ícono para cuando el acordeón está colapsado -->
                                            <i class="bi bi-arrow-up"></i>
                                            <!-- Ícono para cuando el acordeón está expandido -->
                                        </span>
                                        <span class="tex-info rounded p-2" style="color: #27ef30;">
                                            @if ($estudios->estudio_complementario_id)
                                                {{ $estudios->historial_estudio->nombre }}
                                            @else
                                                ESTUDIO
                                            @endif EN FECHA - {{ $estudios->created_at }}
                                        </span>
                                    </button>


                                </h2>
                                <div id="collapse-{{ $estudios->id }}" class="accordion-collapse collapse "
                                    aria-labelledby="heading-{{ $estudios->id }}"
                                    data-bs-parent="#listadias-{{ $estudios->id }}" wire:ignore.self>
                                    <div class="container">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-success d-inline mr-2">DUEÑO:</p>
                                                <p class="text-info d-inline">
                                                    {{ $estudios->historial_clinico_mascotas->mascotas_clientes->nombre }}
                                                    {{ $estudios->historial_clinico_mascotas->mascotas_clientes->apellidos }}
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-success d-inline mr-2">MASCOTA:</p>
                                                <p class="text-info d-inline">
                                                    {{ $estudios->historial_clinico_mascotas->nombre }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 ">
                                                <p class="text-success d-inline mr-2">COSTO TOTAL: </p>
                                                <p class="text-info d-inline">
                                                    Bs. {{ $estudios->precio }}
                                                </p>
                                            </div>

                                        </div>
                                        <div class="row  mt-4">


                                            <div class="col-md-6">
                                                <button class="btn btn-danger"
                                                    wire:click.prevent="$emit('borrar_estudios', {{ $estudios->id }})"><i
                                                        class="bx bxs-trash"> ELIMINAR
                                                        ESTUDIO</i></button>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label"> Ingresar costo
                                                    total de estudios</label>
                                                <div class="col-md-6">

                                                    <input type="number" class="form-control"
                                                        wire:model="CostoInternacion">
                                                    @error('CostoInternacion')
                                                        <div class="text-danger">
                                                           Ingrese un valor valido por favor...
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mt-2 text-center">
                                                    <button class="btn btn-success"
                                                        wire:click="NuevoCostoEstudio({{ $estudios->id }})"><i
                                                            class="bx bxs-save"> </i></button>
                                                </div>

                                            </div>
                                           <div class="col-md-6">
                                                <label for="" class="form-label"> Ingresar 
                                                  el tipo de estudio realizado</label>
                                                   <select name="" id="" class="form-select"  wire:model="TipoDeEstudioComplementario">
                                                       <option value="">[ SELECCIONE UNA OPCIÓN]</option>
                                                       @foreach ($estudios_complemetarios as $estudio)
                                                       <option value="{{$estudio->id}}">{{$estudio->nombre}}</option>
                                                           
                                                       @endforeach
                                                   </select>

                                               

                                                    @error('TipoDeEstudioComplementario')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                   <button class="btn btn-success"
                                                        wire:click="IngresarTipoEstudio({{ $estudios->id }})"><i
                                                            class="bx bxs-save"> </i></button>
                                              

                                            </div>
                                        </div>
                                        <fieldset class="float-none w-auto border border-primary p-3 mb-3">
                                            <legend class="text-primary">SUBIR IMAGEN
                                            </legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="form-label">
                                                        DESEA SUBIR UNA IMAGEN RESPECTO AL ESTUDIO
                                                        ?<span class="text-danger">*</span>
                                                    </label>
                                                    @if ($rutaImagenfinalHistorial)
                                                        <div class="col-md-12 text-center">
                                                            <label class="form-label">IMAGEN
                                                                CAPTURADA
                                                            </label>
                                                            <br>
                                                            <img src="{{ $rutaImagenfinalHistorial }}"
                                                                alt="Imagen del mascota" class="img-fluid">
                                                            <div class="text-center">
                                                                <button type="button" class="btn btn-danger mr-2"
                                                                    wire:click="eliminarfotoEstudio">Desea
                                                                    tomar otra foto ?</button>
                                                                <button class="btn btn-success"
                                                                    wire:click="GuardarImagenEstudio( {{ $estudios->id }})">+Agregar
                                                                    la imagen al Estudio</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">


                                                            <button type="button" class="btn btn-outline-primary"
                                                                wire:click="TomarCapturaEstudio">Sacar
                                                                Captura
                                                            </button>

                                                        </div>
                                                    @endif

                                                </div>

                                            </div>
                                        </fieldset>

                                        <div class="container">
                                            @if (count($estudios->fotosestudio) > 0)
                                                <div class="row col-md-12">

                                                    @foreach ($estudios->fotosestudio as $index => $datos)
                                                        <div class="col-md-6">
                                                            <div class="card radius-10 border-start border-1 border-5 border-success "
                                                                style="border-width: 1px 1px 1px 7px;">
                                                                <div class="card-header">
                                                                    <div
                                                                        class="float-start bg-success text-white m-0 p-1">
                                                                        <b>N
                                                                            {{ $index + 1 }}
                                                                        </b>
                                                                    </div>
                                                                    {{-- <h4
                                                                                        class="my-0 text-success text-center">
                                                                                        <i class="fas fa-cat"></i>
                                                                                        {{ $datos->nombre }}
                                                                                    </h4> --}}

                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="d-flex align-items-center row g-3">
                                                                        <ul class="list-group col-md-12 border-2">
                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">

                                                                                <div>
                                                                                    <img src="{{ $datos->imagen }}"
                                                                                        alt="datos"
                                                                                        class="img-fluid">
                                                                                </div>
                                                                            </li>

                                                                            <li
                                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                                <div>
                                                                                    <i
                                                                                        class="fs-6 fas fa-date"></i>
                                                                                    <b>FECHA DE CREACION</b>
                                                                                    <br>
                                                                                    <span>
                                                                                        {{ $datos->created_at }}</span>
                                                                                </div>
                                                                                <div>
                                                                                    <i class="mdi mdi-user"></i>
                                                                                    <b>CREADO POR:</b>
                                                                                    <br>
                                                                                    <span>
                                                                                        DR.
                                                                                        {{ $datos->user->name }}</span>
                                                                                </div>

                                                                            </li>
                                                                            {{-- <li
                                                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                                                <div>
                                                                                                    @php
                                                                                                        $datosactivosdehistoria = false;
                                                                                                        foreach (
                                                                                                            $datos->datoss_historial_clinico
                                                                                                            as $hist
                                                                                                        ) {
                                                                                                            if (
                                                                                                                $hist->estado ==
                                                                                                                'activo'
                                                                                                            ) {
                                                                                                                $datosactivosdehistoria = true;
                                                                                                            }
                                                                                                        }
                                                                                                    @endphp
                                                                                                    <a class="btn btn-success btn-rounded waves-effect waves-light btn-sm"
                                                                                                        href="{{ route('mascotashistorial', $mascota->id) }}">VER
                                                                                                        HISTORIAL</a>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <button
                                                                                                        class="btn btn-info btn-sm"
                                                                                                        wire:click="editarmascota({{ $mascota->id }})"><i
                                                                                                            class="fas fa-pencil-alt"></i></button>
                                                                                                    <button
                                                                                                        class="btn btn-danger btn-sm"
                                                                                                        wire:click.prevent="$emit('borrarmascota', {{ $mascota->id }})"><i
                                                                                                            class="fas fa-trash-alt"></i></button>
                                                                                                </div>

                                                                                            </li> --}}
                                                                        </ul>


                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            @else
                                                <div class="alert alert-warning" role="alert">
                                                    AUN
                                                    NO SE TIENE NINGUN REGISTRO</div>
                                            @endif
                                        </div>
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
            <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Cerrar</button>
            <button wire:click="CrearEstudiocomple" type="button" class="btn btn-primary">Crear
                estudio o examen complementario</button>
        </div>
    </div>
</div>
