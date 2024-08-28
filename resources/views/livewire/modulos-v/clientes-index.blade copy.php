<div>



    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓN DE CLIENTES </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

  

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="mb-3 row">
                        <br>
                        <div class="col-12 row">
                            <div class="col-12 col-md-6 ">
                                <label for="gestiones" class="form-label">Buscar cliente: </label>
                                <input type="search" class="form-control" wire:model="search"
                                    placeholder="ingrese un dato referente al cliente">
                            </div>
                        </div>
                    </div>


                    @if ($clientes->count() > 0)

                        <div class="row g-3 col-md-12">

                            @foreach ($clientes as $cliente)
                                <div class="col-md-6">
                                    <div class="card radius-10 border-start border-1 border-5 border-info "
                                        style="border-width: 1px 1px 1px 7px;">
                                        <div class="card-header">
                                            <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                    {{ $cliente->id }}</b></div>
                                            <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                {{ $cliente->codigo }}
                                            </h4>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $cliente->nombre }} {{ $cliente->apellidos }} </b>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center row g-3">
                                                <ul class="list-group col-md-7 border-2">
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-home"></i> <b> DOMICILIO</b> <br>
                                                            <span>{{ $cliente->domicilio }}</span><br>
                                                            <i class="fs-6 bx bxs-mail-send"></i> <b> CORREO
                                                                ELECTRÓNICO</b> <br>
                                                            <span>{{ $cliente->correo }}</span>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6  bx bx-phone"></i> <b>TELEFONO O CELULAR</b>
                                                            <br>
                                                            <span>{{ $cliente->telefono }}</span>
                                                        </div>
                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-wallet-alt"></i> <b>C.I.:</b> <br>
                                                            <span>{{ $cliente->ci }}</span>
                                                        </div>
                                                        <div>
                                                            <b>EXPEDIDO:</b> <br>
                                                            <span>{{ $cliente->expedido }}</span>
                                                        </div>

                                                    </li>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <div class="btn-group" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-success  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    CONSULTAS <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @foreach ($cliente->cliente_mascotas as $mascota)
                                                                        <button class="dropdown-item"
                                                                            wire:click="crearhistorial({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                        </button>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="btn-group mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-info  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    RECONSULTAS <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @foreach ($cliente->cliente_mascotas as $mascota)
                                                                        <button class="dropdown-item"
                                                                            wire:click="crearreconsulta({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                        </button>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-warning  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    VACUNAS <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @foreach ($cliente->cliente_mascotas as $mascota)
                                                                        <button class="dropdown-item"
                                                                            wire:click="VerVacunas({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                        </button>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-primary  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    EXAMENES COMPLEMENTARIOS <i
                                                                        class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @foreach ($cliente->cliente_mascotas as $mascota)
                                                                        <button
                                                                            class="dropdown-item"  wire:click="CrearEstudio({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                        </button>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-secondary  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    CIRUGIA <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @foreach ($cliente->cliente_mascotas as $mascota)
                                                                        <button
                                                                            class="dropdown-item">{{ $mascota->nombre }}
                                                                        </button>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-0 text-secondary">MASCOTAS</p>
                                                            @php
                                                                $tienedatosactivos = false;
                                                                foreach ($cliente->cliente_mascotas as $value) {
                                                                    if ($value->estado == 'activo') {
                                                                        $tienedatosactivos = true;
                                                                    }
                                                                }
                                                            @endphp

                                                            @if ($tienedatosactivos == 1)
                                                                <button class="btn btn-sm btn-success"
                                                                    wire:click="VerMascotas({{ $cliente->id }})">Ver
                                                                    Mascotas</button>
                                                            @else
                                                                <button class="btn btn-sm btn-warning"
                                                                    wire:click="crearmascota({{ $cliente->id }})">
                                                                    Crear Mascota
                                                                </button>
                                                            @endif

                                                        </div>
                                                        <div class="col-md-6 border-start border-0 border-2">
                                                            <p class="mb-0 text-secondary">ACCIÓN </p>
                                                            <button class="btn btn-danger"
                                                                wire:click.prevent="$emit('borrarcliente', {{ $cliente->id }})"><i
                                                                    class="bx bxs-trash"></i></button>
                                                            <button class="btn btn-warning"
                                                                wire:click="editarcliente({{ $cliente->id }})"><i
                                                                    class="bx bx-pencil"></i></button>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-12 ">
                                                        <p class="mb-0 text-secondary">FECHA DE CREACIÓN</p>
                                                        <h6 class="my-1"><i class="bx "></i>
                                                            {{ $cliente->created_at }}</h6>

                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $clientes->links() }}
                        </div>
                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>


            <div wire:ignore.self id="modalcrearcliente"data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content radius-10 border-start border-5  border-primary">
                        <div class="modal-header">

                            <div class="row">
                                <div class="text-center text-info h5"> CREAR CLIENTE</div>
                            </div>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="limpiarmodal"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">



                                <div class="col-md-6">
                                    <label class="form-label">C.I.: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="CiCliente"
                                        placeholder="Ej. 6443567">
                                    @error('CiCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Expecido de C.I. <span
                                            class="text-danger">*</span></label>
                                    <br>
                                    <select wire:ignore.self class="form-control" wire:model="ExpedidoCliente">
                                        <option value="">[Seleccione una opción]</option>
                                        <option value="LP">LP</option>
                                        <option value="OR">OR</option>
                                        <option value="CBBA">CBBA</option>
                                        <option value="CH">CH</option>
                                        <option value="PT">PT</option>
                                        <option value="SC">SC</option>
                                        <option value="BN">BN</option>
                                        <option value="TJ">TJ</option>
                                        <option value="PD">PD</option>
                                    </select>
                                    @error('ExpedidoCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo electrónico<span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" wire:model="Correo"
                                        placeholder="nuevocliente@gmail.com">
                                    @error('Correo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nombre del cliente <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="NombreCliente"
                                        placeholder="Ej. Juan">
                                    @error('NombreCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellidos del cliente <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="ApellidoCliente"
                                        placeholder="Ej. Perez Perez">
                                    @error('ApellidoCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Telefono del cliente <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model="TelefonoCliente"
                                        placeholder="Ej. 74324323">
                                    @error('TelefonoCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label class="form-label">Domicilio <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="DomicilioCliente"
                                        placeholder="Ej. Z/ xxxxx C/ xxxxxx N° xxxxx">



                                    @error('DomicilioCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="limpiarmodal">CANCELAR</button>
                                <button wire:click="GuardarCliente" type="submit"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR DATOS DE CLIENTE</button>
                            </div>


                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->


            </div>
            <div wire:ignore.self id="modaleditarcliente"data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content radius-10 border-start border-5  border-primary">
                        <div class="modal-header">

                            <div class="row">
                                <div class="text-center text-info h5"> EDITAR CLIENTE</div>
                            </div>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="limpiarmodalEditar"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Cedula de identidad</label>
                                    <input type="number" class="form-control" wire:model="CiClienteEdit">
                                    @error('CiClienteEdit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Expedido</label>

                                    <select class="form-control select2" wire:model="ExpedidoClienteEdit">
                                        <option value="">[Seleccione una opción]</option>
                                        <option value="LP">LP</option>
                                        <option value="OR">OR</option>
                                        <option value="CBBA">CBBA</option>
                                        <option value="CH">CH</option>
                                        <option value="PT">PT</option>
                                        <option value="SC">SC</option>
                                        <option value="BN">BN</option>
                                        <option value="TJ">TJ</option>
                                        <option value="PD">PD</option>
                                    </select>
                                    @error('ExpedidoClienteEdit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" wire:model="NombreClienteEdit">
                                    @error('NombreClienteEdit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo Electronico</label>
                                    <input type="text" class="form-control" wire:model="EditarCorreo">
                                    @error('EditarCorreo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" class="form-control" wire:model="ApellidoClienteEdit">
                                    @error('ApellidoClienteEdit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Telefono</label>
                                    <input type="number" class="form-control" wire:model="TelefonoClienteEdit">
                                    @error('TelefonoClienteEdit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">DOMICILIO DE CLIENTE</label>
                                    <input type="text" class="form-control" wire:model="DomicilioClienteEdit">
                                    @error('DomicilioCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="limpiarmodalEditar">CANCELAR</button>
                                <button wire:click="GuardarClienteEditado" type="submit"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                            </div>


                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->


            </div>
            <div wire:ignore.self id="modalcrearmascota"data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content radius-10 border-start border-5  border-primary">
                        <div class="modal-header">

                            <div class="row">
                                <div class="text-center text-info h5">
                                    @if ($idmascotaedit)
                                        EDITAR MASCOTA
                                    @else
                                        CREAR MASCOTA
                                    @endif
                                </div>
                            </div>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="limpiarModalCrearMascota"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="text-center text-info">
                                    <h1>{{ $NombreCompletoDeCliente }}</h1>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                    <label class="form-label">NOMBRE DE LA MASCOTA</label>
                                    <input type="text" class="form-control" wire:model="NombreMascota"
                                        placeholder="Ej. Fresita">
                                    @error('NombreMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ESPECIE MASCOTA</label>

                                    <select class="form-select" wire:model="EspecieMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        <option value="CrearEspecie">Desea crear nueva especie? </option>
                                        @foreach ($especies as $especie)
                                            <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                                        @endforeach

                                    </select>

                                    @error('EspecieMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    @if ($EspecieMascota == 'CrearEspecie')
                                        <br>
                                        <label class="form-label">Ingrese el nombre de la especie *</label>
                                        <input type="text" wire:model="NuevaEspecie" class="form-control"
                                            placeholder="Ej. Felino">
                                        @error('NuevaEspecie')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center"> <button class="btn btn-success"
                                                wire:click="CrearEspecie" title="GUARDAR ESPECIE"><i
                                                    class="mdi mdi-content-save-alert-outline"></i></button>
                                            <button class="btn btn-danger" wire:click="CancelarCrearEspecie"
                                                title="CANCELAR"><i class="mdi mdi-file-cancel-outline"></i></button>
                                        </div>
                                    @endif

                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">RAZA MASCOTA</label>

                                    <select class="form-select" wire:model="RazaMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        <option value="CrearRaza">Desea crear nueva raza? </option>
                                        @foreach ($razas as $raza)
                                            <option value="{{ $raza->id }}">{{ $raza->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('RazaMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($RazaMascota == 'CrearRaza')
                                        <br>
                                        <label class="form-label">Ingrese el nombre de la raza *</label>
                                        <input type="text" wire:model="NuevaRaza" class="form-control"
                                            placeholder="Ej. chapi">
                                        @error('NuevaRaza')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center"> <button class="btn btn-success"
                                                wire:click="CrearRaza"><i
                                                    class="mdi mdi-content-save-alert-outline"></i></button>
                                            <button class="btn btn-danger" wire:click="CancelarCrearRaza"><i
                                                    class="mdi mdi-file-cancel-outline"></i></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">SEXO MASCOTA</label>
                                    <select class="form-select" wire:model="SexoMascota">
                                        <option value="">[ Seleccione una opción ]</option>

                                        <option value="M">MACHO</option>
                                        <option value="H">HEMBRA</option>

                                    </select>
                                    @error('SexoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">EDAD APROXIMADA DE LA MASCOTA</label>
                                    <input type="text" class="form-control" wire:model="EdadMascota">
                                    @error('EdadMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">COLOR DE LA MASCOTA</label>
                                    <select class="form-select" wire:model="ColorMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        <option value="CrearColor">Desea crear un nuevo color de mascota? </option>
                                        @foreach ($colores as $color)
                                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                        @endforeach


                                    </select>
                                    @error('ColorMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @if ($ColorMascota == 'CrearColor')
                                        <br>
                                        <label class="form-label">Ingrese el nombre de la raza *</label>
                                        <input type="text" wire:model="NuevoColor" class="form-control"
                                            placeholder="Ej. Blanco">
                                        @error('NuevoColor')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="text-center"> <button class="btn btn-success"
                                                wire:click="CrearColor"><i
                                                    class="mdi mdi-content-save-alert-outline"></i></button>
                                            <button class="btn btn-danger" wire:click="CancelarCreaColor"><i
                                                    class="mdi mdi-file-cancel-outline"></i></button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">LA MASCOTA ESTA ESTERILIZADA?</label>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="Checkesterilizacion"
                                            wire:model="EsterilizadoMascota" switch="success" />
                                        <label class="form-check-label" for="Checkesterilizacion" data-on-label="SI"
                                            data-off-label="NO">

                                        </label>
                                    </div>
                                    @error('EsterilizadoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="limpiarModalCrearMascota">CANCELAR</button>
                                @if ($idmascotaedit)
                                    <button wire:click="GuardarEditarMascota" type="submit"
                                        class="btn btn-primary waves-effect waves-light">GUARDAR DATOS EDITADOS DE
                                        {{ strtoupper($NombreMascota) }}</button>
                                @else
                                    <button wire:click="GuardarMascota" type="submit"
                                        class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                                @endif
                            </div>


                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->


            </div>
            <dasddasd wire:ignore.self id="modaleditarmascota"data-bs-backdrop="static" class="modal fade"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content radius-10 border-start border-5  border-primary">
                        <div class="modal-header">

                            <div class="row">
                                <div class="text-center text-info h5"> EDITAR MASCOTA</div>
                            </div>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="limpiarModalCrearMascota"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="text-center text-info">
                                    <h1>{{ $NombreCompletoDeCliente }}</h1>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                    <label class="form-label">NOMBRE DE LA MASCOTA</label>
                                    <input type="text" class="form-control" wire:model="NombreMascota"
                                        placeholder="Ej. Fresita">
                                    @error('NombreMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ESPECIE MASCOTA</label>

                                    <select class="form-select" wire:model="EspecieMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        @foreach ($especies as $especie)
                                            <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('EspecieMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">RAZA MASCOTA</label>

                                    <select class="form-select" wire:model="RazaMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        @foreach ($razas as $raza)
                                            <option value="{{ $raza->id }}">{{ $raza->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('RazaMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">SEXO MASCOTA</label>
                                    <select class="form-select" wire:model="SexoMascota">
                                        <option value="">[ Seleccione una opción ]</option>

                                        <option value="M">MACHO</option>
                                        <option value="H">HEMBRA</option>

                                    </select>
                                    @error('SexoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">LA MASCOTA ESTA ESTERILIZADA?</label>


                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="Checkesterilizacion"
                                            wire:model="EsterilizadoMascota" switch="success" />
                                        <label class="form-check-label" for="Checkesterilizacion" data-on-label="SI"
                                            data-off-label="NO">

                                        </label>
                                    </div>
                                    @error('EsterilizadoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">EDAD APROXIMADA DE LA MASCOTA</label>
                                    <input type="text" class="form-control" wire:model="EdadMascota">
                                    @error('EdadMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">COLOR DE LA MASCOTA</label>
                                    <select class="form-select" wire:model="ColorMascota">
                                        <option value="">[ Seleccione una opción ]</option>
                                        @foreach ($colores as $color)
                                            <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                                        @endforeach


                                    </select>
                                    @error('ColorMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">PESO DE LA MASCOTA</label>
                                    <input type="number" class="form-control" wire:model="PesoMascota">
                                    @error('PesoMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="limpiarModalEditarMascota">CANCELAR</button>
                                <button wire:click="GuardarEditarMascota" type="submit"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                            </div>


                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->


            </dasddasd>
            {{-- MODAL VER MASCOTAS  --}}

            <div wire:ignore.self id="modalvermascotas"data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content radius-10 border-start border-5  border-primary">
                        <div class="modal-header">



                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="limpiarModalCrearMascota"></button>
                        </div>
                        <div class="modal-body">
                            @if ($verhistorial == 'listadomascotas')
                                <div class="row">
                                    <div class="text-center">
                                        <h4>LISTADO DE MASCOTAS DE LA/EL USUARIO : {{ $NombreCompletoDeCliente }}</h4>
                                    </div>

                                    <div class="container">
                                        @if (count($mascotas) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead
                                                        style="background: #005AA7;  background: -webkit-linear-gradient(to right, #FFFDE4, #005AA7); background: linear-gradient(to right, #FFFDE4, #005AA7);">
                                                        <tr>
                                                            <th class="text-dark">ID</th>
                                                            <th class="text-dark">DATOS DE LA MASCOTA</th>
                                                            <th class="text-dark">CARACTERISTICAS</th>
                                                            <th class="text-dark">EDAD</th>
                                                            <th class="text-dark">HISTORIAL CLINICO</th>
                                                            <th class="text-dark">ACCIONES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mascotas as $mascota)
                                                            <tr>
                                                                <td>{{ $mascota->id }}</td>
                                                                <td>
                                                                    <span class="text-primary"><i
                                                                            class="fas fa-crow"></i>
                                                                        Nombre:</span><b><u>{{ $mascota->nombre }}</u></b>
                                                                    <br>
                                                                    <span class="text-primary"><i
                                                                            class="fas fa-feather"></i>Especie:</span>
                                                                    {{ $mascota->mascotas_especies->nombre }}
                                                                    <br>
                                                                    <span class="text-primary"><i
                                                                            class="fab fa-first-order-alt"></i>Raza:</span>
                                                                    {{ $mascota->mascotas_razas->nombre }}
                                                                    <br>
                                                                </td>
                                                                <td>
                                                                    <span class="text-info"> Sexo: </span>
                                                                    @if ($mascota->sexo == 'H')
                                                                        <span>Hembra</span>
                                                                    @elseif($mascota->sexo == 'M')
                                                                        <span>Macho</span>
                                                                    @endif
                                                                    <br>
                                                                    <span class="text-info"> Color: </span>
                                                                    {{ $mascota->mascotas_colores->nombre }}
                                                                    <br>

                                                                    <span class="text-info"> Esterilizado: </span>
                                                                    {{ $mascota->esterilizado }}
                                                                    <br>
                                                                </td>
                                                                <td>
                                                                    {{ $mascota->edad_mascota }}

                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $datosactivosdehistoria = false;
                                                                        foreach (
                                                                            $mascota->mascotas_historial_clinico
                                                                            as $hist
                                                                        ) {
                                                                            if ($hist->estado == 'activo') {
                                                                                $datosactivosdehistoria = true;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <a class="btn btn-success btn-rounded waves-effect waves-light btn-sm"
                                                                        href="{{ route('mascotashistorial', $mascota->id) }}">VER
                                                                        HISTORIAL</a>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-info btn-sm"
                                                                        wire:click="editarmascota({{ $mascota->id }})"><i
                                                                            class="fas fa-pencil-alt"></i></button>
                                                                    <button class="btn btn-danger btn-sm"
                                                                        wire:click.prevent="$emit('borrarmascota', {{ $mascota->id }})"><i
                                                                            class="fas fa-trash-alt"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $mascotas->links() }}
                                            </div>
                                        @else
                                            <div class="alert alert-warning" role="alert">No se tiene ningun
                                                registro de Mascotas, ingrese un registro de Mascota</div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="modal-footer d-flex justify-content-center">
                                @if ($verhistorial == 'listadomascotas')
                                    <button type="button" class="btn btn-danger waves-effect btn-sm"
                                        data-bs-dismiss="modal"
                                        wire:click="limpiarModalCrearMascota">CANCELAR</button>
                                @elseif($verhistorial == 'listadohistorial')
                                    <button type="button" class="btn btn-danger waves-effect btn-sm"
                                        wire:click="CerrarHistorialClinico">Retroceder</button>
                                @endif

                                <button wire:click="AgregarMascotaDesdeModalDeMascotas" type="submit"
                                    class="btn btn-primary waves-effect waves-light  btn-sm">AGREGAR MASCOTA</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="modalcrearhistorial"data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">

                    <div class="row">
                        <div class="text-center text-info h5">
                            @if ($historial_id_selected)
                                EDITAR
                            @else
                                CREAR
                            @endif

                            @if ($tipo_historial == 'historial_clinico')
                                {{ $nombreTipohistorial }}
                            @elseif($tipo_historial == 'estudio_complementario')
                                ESTUDIO COMPLEMENTARIO
                            @elseif($tipo_historial == 'internacion')
                                INTERNACIÓN
                            @elseif($tipo_historial == 'eutanacia')
                                EUTANACIA
                            @elseif($tipo_historial == 'ficha_clinica')
                                FICHA CLINICA DE CIRUGIA
                            @elseif($tipo_historial == 'recomendaciones_operatorias')
                                RECOMENDACIONES OPERATORIAS
                            @elseif($tipo_historial == 'concentimiento_informado')
                                CONCENTIMIENTO INFORMADO
                            @elseif($tipo_historial == 'autorizacion_de_sedacion')
                                AUTORIZACIÓN DE SEDACIÓN
                            @endif
                        </div>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="limpiarModalCrearMascota"></button>
                </div>
                <div class="modal-body">
                    @if ($tipo_historial == 'historial_clinico')
                        <div class="row">
                            <div class="text-center text-info">
                                <h1></h1>
                            </div>
                            <hr>


                            <div class="col-md-12">
                                <label class="form-label">Motivo de atención:</label>

                                <div style="position: relative;">
                                    <textarea class="form-control" id="contenedor-motivo-consulta" wire:model="MotivoDeAtencion"
                                        placeholder="Ingrese el motivo de atención....."></textarea>

                                    <button
                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);"
                                        class="btn btn-primary" wire:click="comenzarReconocimientoMotivoDeAtencion"><i
                                            class="fas fa-microphone"></i></button>
                                </div>

                                @error('MotivoDeAtencion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Anamensis:</label>

                                <div style="position: relative;">
                                    <textarea class="form-control" id="contenedor-anamensis" wire:model="AnamensisDeMascota"
                                        placeholder="Ingrese una descripción de la mascota...."></textarea>

                                    <button
                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);"
                                        class="btn btn-primary" wire:click="comenzarReconocimientoAnamensis"><i
                                            class="fas fa-microphone"></i></button>
                                </div>

                                @error('AnamensisDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Especie:</label>
                                <input type="text" class="form-control" wire:model="Especie"style="color: #005AA7"
                                    disabled placeholder="Ingrese el tiempo de llenado capilar">
                                @error('Especie')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Raza:</label>
                                <input type="text" class="form-control" wire:model="Raza"style="color: #005AA7"
                                    disabled placeholder="Ingrese el tiempo de llenado capilar">
                                @error('Raza')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sexo:</label>
                                <input type="text" class="form-control" wire:model="Sexo"
                                    style="color: #005AA7"disabled placeholder="Ingrese el tiempo de llenado capilar">
                                @error('Sexo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Edad:</label>
                                <input type="text" class="form-control" wire:model="Edad" disabled
                                    style="color: #005AA7" placeholder="Ingrese el tiempo de llenado capilar">
                                @error('Edad')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tllc:</label>
                                <input type="text" class="form-control" wire:model="TllcMascota" maxlength="5"
                                    placeholder="Ingrese el tiempo de llenado capilar">
                                @error('TllcMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Actitud:</label>
                                <select class="form-select" wire:model="ActitudDeMascota">
                                    <option value="" selected>[Seleccione una opción]</option>
                                    <option value="Rabioso">Jugueton@</option>
                                    <option value="Amigable">Amigable</option>
                                    <option value="Cautelosa">Cautelosa</option>
                                    <option value="Protectora">Protectora</option>
                                    <option value="Sumisa">Sumisa</option>
                                    <option value="Independiente">Independiente</option>
                                    <option value="Curios@">Curios@</option>
                                    <option value="Reservada">Reservada</option>
                                    <option value="Alegre">Alegre</option>
                                    <option value="Agresiva">Agresiva</option>
                                    <option value="otros">Otra opción</option>
                                </select>
                                @error('ActitudDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($ActitudDeMascota === 'otros')
                                    <input type="text" class="form-control mt-2"
                                        placeholder="Ingrese otra opción de actitud de la mascota"
                                        wire:model="ActitudDeMascotaOtraOpcion">
                                    @error('ActitudDeMascotaOtraOpcion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif


                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Conducta:</label>
                                <select class="form-select" wire:model="ConductaDeMascota">
                                    <option value="" selected>[Seleccione una opción]</option>
                                    <option value="Sociable">Sociable</option>
                                    <option value="Carácter fuerte">Carácter fuerte</option>
                                    <option value="Miedoso">Miedoso</option>
                                    <option value="Tranquilo">Tranquilo</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Juguetón">Juguetón</option>
                                    <option value="Tímido">Tímido</option>
                                    <option value="Asustadizo">Asustadizo</option>
                                    <option value="Agresivo">Agresivo</option>
                                    <option value="Amigable">Amigable</option>

                                    <option value="otros">Otra opción</option>
                                </select>
                                @error('ConductaDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($ConductaDeMascota === 'otros')
                                    <input type="text" class="form-control mt-2" placeholder="Ingrese otra opción"
                                        wire:model="OtraOpcionConductaDeMascota">
                                    @error('OtraOpcionConductaDeMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Estado nutricional: </label>
                                <select class="form-select" wire:model="EstadoNutricionalDeMascota">
                                    <option value="" selected>[Seleccione una opción]</option>
                                    <option value="Bajo peso">Bajo peso</option>
                                    <option value="Peso ideal">Peso ideal</option>
                                    <option value="Sobrepeso">Sobrepeso</option>
                                    <option value="Obesidad">Obesidad</option>
                                    <option value="Delgado">Delgado</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Sobrealimentado">Sobrealimentado</option>
                                    <option value="Desnutrido">Desnutrido</option>
                                    <option value="Sobrealimentado">Sobrealimentado</option>
                                    <option value="Enfermedad / Tratamiento">Enfermedad / Tratamiento</option>
                                    <option value="Cachorro / Crecimiento">Cachorro / Crecimiento</option>
                                    <option value="otros">Otra opción</option>
                                </select>
                                @error('EstadoNutricionalDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($EstadoNutricionalDeMascota === 'otros')
                                    <input type="text" class="form-control mt-2" placeholder="Ingrese otra opción"
                                        wire:model="EstadoNutricionalDeMascotaOtraOpcion">
                                    @error('EstadoNutricionalDeMascotaOtraOpcion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>
                            <div class="col-md-3">
                                <label class="form-label">MM :</label>
                                <input type="text" class="form-control" wire:model="MmDeMascota" maxlength="5">
                                @error('MmDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Constante vital FC :</label>
                                <input type="text" class="form-control" wire:model="ConstanteVitalFcDeMascota"
                                    placeholder="Frecuencia cardiaca (pul o lat/min)
                            (ppm/lpm)"
                                    maxlength="10">
                                @error('ConstanteVitalFcDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Constante vital FR :</label>
                                <input type="text" class="form-control" wire:model="ConstanteVitalFrDeMascota"
                                    placeholder="Frecuencia respiratoria (resp/min)(rpm)" maxlength="10">
                                @error('ConstanteVitalFrDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Constante vital T° :</label>
                                <input type="text" class="form-control"
                                    wire:model="ConstanteVitalTemperaturaDeMascota"
                                    placeholder="Temperatura corporal (ºC)" maxlength="5">
                                @error('ConstanteVitalTemperaturaDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PAST :</label>
                                <input type="text" class="form-control" wire:model="Past" maxlength="5">
                                @error('Past')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PAD :</label>
                                <input type="text" class="form-control" wire:model="Pad" placeholder=" "
                                    maxlength="10">
                                @error('Pad')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PAM:</label>
                                <input type="text" class="form-control" wire:model="Pam" placeholder=""
                                    maxlength="10">
                                @error('Pam')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PULSO :</label>
                                <input type="text" class="form-control" wire:model="PulsoDeLaMascota"
                                    placeholder="" maxlength="5">
                                @error('PulsoDeLaMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">DHT:</label>
                                <input type="text" class="form-control" wire:model="Dht" placeholder=""
                                    maxlength="10">
                                @error('Dht')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PESO :</label>
                                <input type="text" class="form-control" wire:model="Peso"
                                    placeholder="Inserte un valor en kg." maxlength="5">
                                @error('Peso')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Capa de piel :</label>
                                <select class="form-select" wire:model="CapaDePielDeMascota">
                                    <option value="" selected>[Seleccione una opción]</option>
                                    <option value="Brillante">Brillante</option>
                                    <option value="Áspero">Áspero</option>
                                    <option value="Suave">Suave</option>
                                    <option value="Esponjoso">Esponjoso</option>
                                    <option value="Opaco">Opaco</option>
                                    <option value="Rizado">Rizado</option>
                                    <option value="Lacio">Lacio</option>
                                    <option value="Densa">Densa</option>
                                    <option value="Irregular">Irregular</option>
                                    <option value="Descamación">Descamación</option>
                                    <option value="otros">Otra opción</option>
                                </select>
                                @error('CapaDePielDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($CapaDePielDeMascota == 'otros')
                                    <input type="text" class="form-control mt-2"
                                        wire:model="OtraCapaDePielDeMascota" placeholder="Ingrese otra opción">
                                    @error('OtraCapaDePielDeMascota')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Precio de la consulta:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio de la consulta">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @elseif($tipo_historial == 'estudio_complementario')
                        <div class="row">



                            <div class="col-md-4">

                                <label class="form-label">Tipo de Estudio Complementario</label>
                                <select class="form-select" wire:model="TipoDeEstudioComplementario">
                                    <option value="" selected>[Seleccione una opcion]</option>
                                    @foreach ($estudios_complemetarios as $estudios)
                                        <option value="{{ $estudios->id }}">{{ $estudios->nombre }}</option>
                                    @endforeach


                                </select>
                                @error('TipoDeEstudioComplementario')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            @if ($historial_id_selected)


                                <div class="col-md-6">
                                    <label for="" class="form-label"> IMAGEN ACTUAL</label>
                                    @if ($archivo_anterior)
                                        @if (str_ends_with($archivo_anterior, '.pdf'))
                                            <embed src="{{ asset($archivo_anterior) }}" type="application/pdf"
                                                width="100%" height="600px">
                                        @else
                                            <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                alt="Vista previa" width="300" height="200">
                                        @endif
                                    @endif
                                </div>
                            @endif

                            <div class="col-md-{{ $historial_id_selected ? '12' : '4' }}">
                                <label class="form-label">Ingrese una
                                    {{ $historial_id_selected ? 'nueva' : '' }} imagen o pdf</label>
                                <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>
                                    <option value="pdf">Subir un Archivo Pdf</option>
                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Precio del Estudio Realizado:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                @if ($SeleccionTipoDeArchivo != '')
                                    <hr>
                                    @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                                desea
                                                añadir al historial de estudio complementario</label>
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <label class="form-label"> Debe seleccionar el archivo imagen que
                                                desea
                                                añadir al historial de estudio complementario <span
                                                    class="text-danger">Tamaño: 20 X 30 Pixeles</span></label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf"@elseif($SeleccionTipoDeArchivo == 'imagen')  accept=".jpg,.png,.jpeg" @endif
                                            wire:model="ArchivoDelEstudio">

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2" role="status">
                                                </div>
                                            </div>
                                            @if ($SeleccionTipoDeArchivo == 'imagen')
                                                <div class="mb-3 col-md-12 text-center" wire:loading
                                                    wire:target="ArchivoDelEstudio">
                                                    <div class="spinner-border avatar-lg text-primary m-2"
                                                        role="status">
                                                    </div>
                                                </div>
                                                @if ($ArchivoDelEstudio)
                                                    <div class="text-center">
                                                        <img src="{{ $ArchivoDelEstudio->temporaryUrl() }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
                                                    </div>
                                                @endif
                                            @endif

                                        @endif
                                        @error('ArchivoDelEstudio')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="limpiarbotonpro">
                                                        REMOVER IMAGEN
                                                    </button>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#capturarImagenModal">
                                                    Capturar Imagen Nueva
                                                </button>
                                            @endif

                                            <!-- Mostrar la imagen capturada en un span -->
                                            @if ($rutaImagenfinal)
                                                <span class="d-block text-center text-secondary">
                                                    <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                                        class="img-fluid">
                                                </span>
                                            @else
                                                <div class="text-center">
                                                    <h1>SIN IMAGEN CAPTURADA </h1>
                                                </div>
                                            @endif

                                        </div>


                                    @endif
                                @endif
                            </div>
                        </div>
                    @elseif($tipo_historial == 'internacion')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Peso Internación</label>
                                <input type="number" class="form-control" wire:model="PesoIntenacion"
                                    placeholder="Ingrese el peso de la mascota...">

                                @error('PesoIntenacion')
                                    <span class="error" style="display: block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha Ingreso Internación</label>
                                <input type="date" class="form-control" wire:model="FechaIngresoInternacion">

                                @error('FechaIngresoInternacion')
                                    <span class="error" style="display: block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Precio de Internación:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    @elseif($tipo_historial == 'eutanacia')
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label"><span class="text-primary"> Fecha en que se realizo
                                        la eutanacia.</span></label>
                                <input type="date" class="form-control" wire:model="FechaDeEutanacia">
                                @error('FechaDeEutanacia')
                                    <span class="error" style="display: block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Precio de Ficha Clinica:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"><span class="text-primary"> Cual es la razón por el
                                        cual se decidio realizar la eutanacia? <br> Describa...</span></label>
                                <textarea class="form-control" wire:model="RazonDeEutanacia"></textarea>
                                @error('RazonDeEutanacia')
                                    <span class="error" style="display: block">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($historial_id_selected)


                                <div class="col-md-6">
                                    <label for="" class="form-label"> IMAGEN ACTUAL</label>
                                    @if ($archivo_anterior)
                                        @if (str_ends_with($archivo_anterior, '.pdf'))
                                            <embed src="{{ asset($archivo_anterior) }}" type="application/pdf"
                                                width="100%" height="600px">
                                        @else
                                            <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                alt="Vista previa" width="300" height="200">
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-{{ $historial_id_selected ? '6' : '6' }}">
                                <label class="form-label">TIPO DE ARCHIVO</label>
                                <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>
                                    <option value="pdf">Subir un Archivo Pdf</option>
                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="col-md-12">
                                @if ($SeleccionTipoDeArchivo != '')
                                    <hr>
                                    @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                                desea
                                                añadir al historial de estudio complementario</label>
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <label class="form-label"> Debe seleccionar el archivo imagen que
                                                desea
                                                añadir al historial de estudio complementario <span
                                                    class="text-danger">Tamaño: 20 X 30 Pixeles</span></label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf"@elseif($SeleccionTipoDeArchivo == 'imagen')  accept=".jpg,.png,.jpeg" @endif
                                            wire:model="ArchivoDelEstudio">

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2" role="status">
                                                </div>
                                            </div>
                                            @if ($SeleccionTipoDeArchivo == 'imagen')
                                                <div class="mb-3 col-md-12 text-center" wire:loading
                                                    wire:target="ArchivoDelEstudio">
                                                    <div class="spinner-border avatar-lg text-primary m-2"
                                                        role="status">
                                                    </div>
                                                </div>
                                                @if ($ArchivoDelEstudio)
                                                    <div class="text-center">
                                                        <img src="{{ $ArchivoDelEstudio->temporaryUrl() }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
                                                    </div>
                                                @endif
                                            @endif

                                        @endif
                                        @error('ArchivoDelEstudio')
                                            <div class="te  xt-danger">{{ $message }}</div>
                                        @enderror
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="limpiarbotonpro">
                                                        REMOVER IMAGEN
                                                    </button>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#capturarImagenModal">
                                                    Capturar Imagen Nueva
                                                </button>
                                            @endif

                                            <!-- Mostrar la imagen capturada en un span -->
                                            @if ($rutaImagenfinal)
                                                <span class="d-block text-center text-secondary">
                                                    <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                                        class="img-fluid">
                                                </span>
                                            @else
                                                <div class="text-center">
                                                    <h1>SIN IMAGEN CAPTURADA </h1>
                                                </div>
                                            @endif
                                            @error('errorsacarfoto')
                                                <div class="te  xt-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    @endif
                                @endif
                            </div>

                        </div>
                    @elseif($tipo_historial == 'ficha_clinica')
                        <div class="row">
                            @if ($historial_id_selected)


                                <div class="col-md-6">
                                    <label for="" class="form-label"> IMAGEN ACTUAL</label>
                                    @if ($archivo_anterior)
                                        @if (str_ends_with($archivo_anterior, '.pdf'))
                                            <embed src="{{ asset($archivo_anterior) }}" type="application/pdf"
                                                width="100%" height="600px">
                                        @else
                                            <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                alt="Vista previa" width="300" height="200">
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-{{ $historial_id_selected ? '6' : '6' }}">
                                <label class="form-label">TIPO DE ARCHIVO</label>
                                <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>
                                    <option value="pdf">Subir un Archivo Pdf</option>
                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Precio de Ficha Clinica:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                @if ($SeleccionTipoDeArchivo != '')
                                    <hr>
                                    @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                                desea
                                                añadir al historial de estudio complementario</label>
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <label class="form-label"> Debe seleccionar el archivo imagen que
                                                desea
                                                añadir al historial de estudio complementario <span
                                                    class="text-danger">Tamaño: 20 X 30 Pixeles</span></label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf"@elseif($SeleccionTipoDeArchivo == 'imagen')  accept=".jpg,.png,.jpeg" @endif
                                            wire:model="ArchivoDelEstudio">

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2"
                                                    role="status">
                                                </div>
                                            </div>
                                            @if ($SeleccionTipoDeArchivo == 'imagen')
                                                <div class="mb-3 col-md-12 text-center" wire:loading
                                                    wire:target="ArchivoDelEstudio">
                                                    <div class="spinner-border avatar-lg text-primary m-2"
                                                        role="status">
                                                    </div>
                                                </div>
                                                @if ($ArchivoDelEstudio)
                                                    <div class="text-center">
                                                        <img src="{{ $ArchivoDelEstudio->temporaryUrl() }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
                                                    </div>
                                                @endif
                                            @endif

                                        @endif
                                        @error('ArchivoDelEstudio')
                                            <div class="te  xt-danger">{{ $message }}</div>
                                        @enderror
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="limpiarbotonpro">
                                                        REMOVER IMAGEN
                                                    </button>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#capturarImagenModal">
                                                    Capturar Imagen Nueva
                                                </button>
                                            @endif

                                            <!-- Mostrar la imagen capturada en un span -->
                                            @if ($rutaImagenfinal)
                                                <span class="d-block text-center text-secondary">
                                                    <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                                        class="img-fluid">
                                                </span>
                                            @else
                                                <div class="text-center">
                                                    <h1>SIN IMAGEN CAPTURADA </h1>
                                                </div>
                                            @endif
                                            @error('errorsacarfoto')
                                                <div class="te  xt-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    @endif
                                @endif
                            </div>
                        </div>
                    @elseif($tipo_historial == 'recomendaciones_operatorias')
                        <div class="row">
                            @if ($historial_id_selected)


                                <div class="col-md-6">
                                    <label for="" class="form-label"> IMAGEN ACTUAL</label>
                                    @if ($archivo_anterior)
                                        @if (str_ends_with($archivo_anterior, '.pdf'))
                                            <embed src="{{ asset($archivo_anterior) }}" type="application/pdf"
                                                width="100%" height="600px">
                                        @else
                                            <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                alt="Vista previa" width="300" height="200">
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-{{ $historial_id_selected ? '6' : '6' }}">
                                <label class="form-label">TIPO DE ARCHIVO</label>
                                <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>
                                    <option value="pdf">Subir un Archivo Pdf</option>
                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Precio de Recomendaciones Operatorias:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                @if ($SeleccionTipoDeArchivo != '')
                                    <hr>
                                    @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                                desea
                                                añadir al historial de estudio complementario</label>
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <label class="form-label"> Debe seleccionar el archivo imagen que
                                                desea
                                                añadir al historial de estudio complementario <span
                                                    class="text-danger">Tamaño: 20 X 30 Pixeles</span></label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf"@elseif($SeleccionTipoDeArchivo == 'imagen')  accept=".jpg,.png,.jpeg" @endif
                                            wire:model="ArchivoDelEstudio">

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2"
                                                    role="status">
                                                </div>
                                            </div>
                                            @if ($SeleccionTipoDeArchivo == 'imagen')
                                                <div class="mb-3 col-md-12 text-center" wire:loading
                                                    wire:target="ArchivoDelEstudio">
                                                    <div class="spinner-border avatar-lg text-primary m-2"
                                                        role="status"></div>
                                                </div>
                                                @if ($ArchivoDelEstudio)
                                                    <div class="text-center">
                                                        <img src="{{ $ArchivoDelEstudio->temporaryUrl() }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
                                                    </div>
                                                @endif
                                            @endif

                                        @endif
                                        @error('ArchivoDelEstudio')
                                            <div class="te  xt-danger">{{ $message }}</div>
                                        @enderror
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="limpiarbotonpro">
                                                        REMOVER IMAGEN
                                                    </button>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#capturarImagenModal">
                                                    Capturar Imagen Nueva
                                                </button>
                                            @endif

                                            <!-- Mostrar la imagen capturada en un span -->
                                            @if ($rutaImagenfinal)
                                                <span class="d-block text-center text-secondary">
                                                    <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                                        class="img-fluid">
                                                </span>
                                            @else
                                                <div class="text-center">
                                                    <h1>SIN IMAGEN CAPTURADA </h1>
                                                </div>
                                            @endif
                                            @error('errorsacarfoto')
                                                <div class="te  xt-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    @endif
                                @endif
                            </div>
                        </div>
                    @elseif($tipo_historial == 'concentimiento_informado')
                        <div class="row">
                            @if ($historial_id_selected)


                                <div class="col-md-6">
                                    <label for="" class="form-label"> IMAGEN ACTUAL</label>
                                    @if ($archivo_anterior)
                                        @if (str_ends_with($archivo_anterior, '.pdf'))
                                            <embed src="{{ asset($archivo_anterior) }}" type="application/pdf"
                                                width="100%" height="600px">
                                        @else
                                            <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                alt="Vista previa" width="300" height="200">
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-{{ $historial_id_selected ? '6' : '6' }}">
                                <label class="form-label">TIPO DE ARCHIVO</label>
                                <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>
                                    <option value="pdf">Subir un Archivo Pdf</option>
                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Precio del Concentimiento Informado:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                @if ($SeleccionTipoDeArchivo != '')
                                    <hr>
                                    @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                                desea
                                                añadir al historial de estudio complementario</label>
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <label class="form-label"> Debe seleccionar el archivo imagen que
                                                desea
                                                añadir al historial de estudio complementario <span
                                                    class="text-danger">Tamaño: 20 X 30 Pixeles</span></label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf"@elseif($SeleccionTipoDeArchivo == 'imagen')  accept=".jpg,.png,.jpeg" @endif
                                            wire:model="ArchivoDelEstudio">

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2"
                                                    role="status">
                                                </div>
                                            </div>
                                            @if ($SeleccionTipoDeArchivo == 'imagen')
                                                <div class="mb-3 col-md-12 text-center" wire:loading
                                                    wire:target="ArchivoDelEstudio">
                                                    <div class="spinner-border avatar-lg text-primary m-2"
                                                        role="status"></div>
                                                </div>
                                                @if ($ArchivoDelEstudio)
                                                    <div class="text-center">
                                                        <img src="{{ $ArchivoDelEstudio->temporaryUrl() }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
                                                    </div>
                                                @endif
                                            @endif

                                        @endif
                                        @error('ArchivoDelEstudio')
                                            <div class="te  xt-danger">{{ $message }}</div>
                                        @enderror
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="limpiarbotonpro">
                                                        REMOVER IMAGEN
                                                    </button>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#capturarImagenModal">
                                                    Capturar Imagen Nueva
                                                </button>
                                            @endif

                                            <!-- Mostrar la imagen capturada en un span -->
                                            @if ($rutaImagenfinal)
                                                <span class="d-block text-center text-secondary">
                                                    <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                                        class="img-fluid">
                                                </span>
                                            @else
                                                <div class="text-center">
                                                    <h1>SIN IMAGEN CAPTURADA </h1>
                                                </div>
                                            @endif
                                            @error('errorsacarfoto')
                                                <div class="te  xt-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    @endif
                                @endif
                            </div>
                        </div>
                    @elseif($tipo_historial == 'autorizacion_de_sedacion')
                        <div class="row">
                            @if ($historial_id_selected)


                                <div class="col-md-6">
                                    <label for="" class="form-label"> IMAGEN ACTUAL</label>
                                    @if ($archivo_anterior)
                                        @if (str_ends_with($archivo_anterior, '.pdf'))
                                            <embed src="{{ asset($archivo_anterior) }}" type="application/pdf"
                                                width="100%" height="600px">
                                        @else
                                            <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                alt="Vista previa" width="300" height="200">
                                        @endif
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-{{ $historial_id_selected ? '6' : '6' }}">
                                <label class="form-label">TIPO DE ARCHIVO</label>
                                <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>
                                    <option value="pdf">Subir un Archivo Pdf</option>
                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Precio de la Autorización de Sedación:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                @if ($SeleccionTipoDeArchivo != '')
                                    <hr>
                                    @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                                desea
                                                añadir al historial de estudio complementario</label>
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <label class="form-label"> Debe seleccionar el archivo imagen que
                                                desea
                                                añadir al historial de estudio complementario <span
                                                    class="text-danger">Tamaño: 20 X 30 Pixeles</span></label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf"@elseif($SeleccionTipoDeArchivo == 'imagen')  accept=".jpg,.png,.jpeg" @endif
                                            wire:model="ArchivoDelEstudio">

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2"
                                                    role="status">
                                                </div>
                                            </div>
                                            @if ($SeleccionTipoDeArchivo == 'imagen')
                                                <div class="mb-3 col-md-12 text-center" wire:loading
                                                    wire:target="ArchivoDelEstudio">
                                                    <div class="spinner-border avatar-lg text-primary m-2"
                                                        role="status"></div>
                                                </div>
                                                @if ($ArchivoDelEstudio)
                                                    <div class="text-center">
                                                        <img src="{{ $ArchivoDelEstudio->temporaryUrl() }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
                                                    </div>
                                                @endif
                                            @endif

                                        @endif
                                        @error('ArchivoDelEstudio')
                                            <div class="te  xt-danger">{{ $message }}</div>
                                        @enderror
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="limpiarbotonpro">
                                                        REMOVER IMAGEN
                                                    </button>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#capturarImagenModal">
                                                    Capturar Imagen Nueva
                                                </button>
                                            @endif

                                            <!-- Mostrar la imagen capturada en un span -->
                                            @if ($rutaImagenfinal)
                                                <span class="d-block text-center text-secondary">
                                                    <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto"
                                                        class="img-fluid">
                                                </span>
                                            @else
                                                <div class="text-center">
                                                    <h1>SIN IMAGEN CAPTURADA </h1>
                                                </div>
                                            @endif
                                            @error('errorsacarfoto')
                                                <div class="te  xt-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif


                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="limpiarmodalhistorial">CANCELAR</button>
                        @if ($tipo_historial == 'historial_clinico')
                            @if ($historial_id_selected)
                                <button wire:click="guardareditarhistorial" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR CONSULTA</button>
                            @else
                                <button wire:click="guardarhistorialclinico" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR CONSULTA</button>
                            @endif
                        @elseif($tipo_historial == 'estudio_complementario')
                            @if ($historial_id_selected)
                                <button wire:click="GuardarEditarEstudioComplementario" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR ESTUDIO
                                    COMPLEMENTARIO</button>
                            @else
                                <button wire:click="GuardarEstudioComplementario" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR ESTUDIO
                                    COMPLEMENTARIO</button>
                            @endif
                        @elseif($tipo_historial == 'internacion')
                            @if ($historial_id_selected)
                                <button wire:click="GuardarEditarInternacion" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR
                                    INTERNACIÓN</button>
                            @else
                                <button wire:click="GuardarInternacion" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR
                                    INTERNACIÓN</button>
                            @endif
                        @elseif($tipo_historial == 'eutanacia')
                            @if ($historial_id_selected)
                                <button wire:click="guardareditarhistorialclinico" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR EUTANACIA</button>
                            @else
                                <button wire:click="guardarhistorialclinicoeutanacia" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR EUTANACIA</button>
                            @endif
                        @elseif($tipo_historial == 'ficha_clinica')
                            @if ($historial_id_selected)
                                <button wire:click="guardareditarhistorialclinicofichaclinica" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR FICHA
                                    CLINICA</button>
                            @else
                                <button wire:click="guardarhistorialclinicofichaclinica" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR FICHA
                                    CLINICA</button>
                            @endif
                        @elseif($tipo_historial == 'recomendaciones_operatorias')
                            @if ($historial_id_selected)
                                <button wire:click="guardareditarrecomendacionesoperatorias" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR RECOMENDACIONES
                                    OPERATORIAS</button>
                            @else
                                <button wire:click="guardarrecomendacionesoperatorias" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR RECOMENDACIONES
                                    OPERATORIAS</button>
                            @endif
                        @elseif($tipo_historial == 'concentimiento_informado')
                            @if ($historial_id_selected)
                                <button wire:click="guardareditarconcentimientoinformado" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR CONCENTIMIENTO
                                    INFORMADO</button>
                            @else
                                <button wire:click="guardarconcentimientoinformado" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR CONCENTIMIENTO
                                    INFORMADO</button>
                            @endif
                        @elseif($tipo_historial == 'autorizacion_de_sedacion')
                            @if ($historial_id_selected)
                                <button wire:click="guardareditarautorizaciondesedacion" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR AUTORIZACION DE
                                    SEDACION</button>
                            @else
                                <button wire:click="guardarautorizaciondesedacion" type="button"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR AUTORIZACION DE
                                    SEDACION</button>
                            @endif

                        @endif


                    </div>


                </div>

            </div>

        </div>



    </div>
    <div wire:ignore.self id="VerVacunas" data-bs-backdrop="static" class="modal fade" tabindex="-1"
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
                                    @if (count($VacunasPorMascota) > 0)
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
                                                @foreach ($VacunasPorMascota as $vacunas)
                                                    <tr>
                                                        <td>{{ $vacunas->fecha }}</td>
                                                        <td>{{ $vacunas->edad }}</td>
                                                        <td>{{ $vacunas->vacuna_aplicada }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($vacunas->proxima_fecha)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ $vacunas->vacuna_veterinario->name }}</td>
                                                        <td>
                                                            <button class="btn btn-danger"
                                                                wire:click.prevent="$emit('BorrarVacula', {{ $vacunas->id }})"><i
                                                                    class="bx bxs-trash"></i></button>
            
            
                                                        </td>
            
            
                                                    </tr>
                                                @endforeach
            
                                            </tbody>
                                        </table>
                                        <div class="row text-center">
                                            {{ $VacunasPorMascota->links() }}
                                        </div>
            
                                    </div>
                                @else
                                    <div class="row">
                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO DE
                                            VACUNA</span>
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
    <div wire:ignore.self id="capturarImagenModal" data-bs-backdrop="static" class="modal fade"
    tabindex="-1" role="dialog" aria-labelledby="capturarImagenModalLabel" aria-hidden="false">
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
                    <button type="button" class="btn btn-warning mr-2"
                        wire:click="cambiarCamarat">Trasera</button>
                    <button type="button" class="btn btn-success"
                        wire:click="cambiarCamarad">Frontal</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    wire:click="limpiarcamara">Cancelar</button>
                <button type="button" class="btn btn-primary" id="capturarBtn">Capturar</button>
            </div>
        </div>
    </div>
</div>
</div>


@push('navi-js')
    <script src="{{ asset('JSNAVI/clientes.js') }}"></script>
@endpush
