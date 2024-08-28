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
                        @if ($caja)
                            @if (Auth::user()->id == $caja->encargado_id)


                                <div class="row">
                                    <div class="col-md-12 alert alert-success text-center">
                                        PUEDE REALIZAR SUS DESCUENTOS EN ESTE SECTOR DOCTOR
                                        {{ $caja->usuario->name }}

                                    </div>
                                    <div class="col-md-12">
                                        <fieldset class=" float-none w-auto border border-primary p-3 mb-3">
                                            <legend class="text-primary">
                                                AGREGAR GASTO
                                            </legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label">Razon del gasto
                                                        <span class="text-danger">*</span></label>
                                                    <input class="form-control" wire:model="RazonGasto" type="text"
                                                        placeholder="breve descripcion...">
                                                    @error('RazonGasto')
                                                        <div class="text-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Precio de Gasto
                                                        <span class="text-danger">*</span></label>
                                                    <input class="form-control" wire:model="PrecioGasto" type="number"
                                                        placeholder="En Bs.">
                                                    @error('PrecioGasto')
                                                        <div class="text-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4 mt-4">
                                                    <div class="col-sm-8 offset-sm-4">
                                                        <button class="btn btn-success"
                                                            wire:click="guardardescuento">+Agregar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                    </div>

                                </div>
                                <div class="col-md-12">
                                    @if (count($caja->cobros) > 0)
                                        <div class="table-responsive mt-5">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="bg-dark">
                                                        <th>ENCARGADO DEL COBRO</th>
                                                        <th>MOTIVO</th>
                                                        <th>CLIENTE</th>
                                                        <th>COSTO DEL COBRO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $sumacobro = 0;
                                                    @endphp
                                                    @foreach ($caja->cobros as $c)
                                                        <tr>
                                                            <td>{{ $c->usuario->name }}</td>
                                                            <td>{{ $c->motivo }}</td>
                                                            <td>{{ $c->cliente->nombre }}
                                                                {{ $c->cliente->apellidos }}</td>
                                                            <td>{{ $c->costo }} Bs.</td>
                                                        </tr>
                                                        @php
                                                            $sumacobro = $sumacobro + $c->costo;

                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>TOTAL</td>
                                                        <td>{{ $sumacobro }} Bs.</td>
                                                    </tr>
                                                    @if (count($caja->descuentos) > 0)
                                                        <tr class="bg-dark text-center">
                                                            <td></td>
                                                            <td>GASTOS</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="bg-dark">
                                                            <td>ENCARGADO</td>
                                                            <td>RAZON</td>

                                                            <td></td>
                                                            <td>MONTO DESCUENTO</td>
                                                        </tr>
                                                        @php
                                                            $sumagasto = 0;
                                                        @endphp
                                                        @foreach ($caja->descuentos as $d)
                                                            <tr>
                                                                <td>{{ $d->usuario->name }}</td>
                                                                <td>{{ $d->razon }}</td>


                                                                <td></td>
                                                                <td>{{ $d->costo }} Bs.</td>
                                                            </tr>
                                                            @php
                                                                $sumagasto = $sumagasto + $d->costo;

                                                            @endphp
                                                        @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>TOTAL</td>
                                                            <td>{{ $sumagasto }} Bs.</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-primary">TOTAL EN LA CAJA </td>
                                                            @php
                                                                $totalcaja = $sumacobro - $sumagasto;
                                                            @endphp
                                                            <td>
                                                                <b class="text-primary"> {{ $totalcaja }} Bs.
                                                                </b>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>

                                        </div>

                                    @endif

                                </div>



                            @endif
                        @endif
                        <div class="row">
                            <div class="col-md-6 ">
                                <label for="gestiones" class="form-label">Buscar cliente: </label>
                                <input type="search" class="form-control" wire:model="search"
                                    placeholder="ingrese un dato referente al cliente">



                            </div>
                            <div class="col-md-6 text-center">
                                @if ($caja)
                                    @error('cajaexistente')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        <br>
                                    @enderror


                                    <button class="btn btn-danger" wire:click.prevent="$emit('cerrarcaja')">Cerrar
                                        apertura de caja</button>
                                @else
                                    @error('cajaexistente')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        <br>
                                    @enderror
                                    <button class="btn btn-success" wire:click.prevent="$emit('crearcaja')">Crear
                                        apertura de caja</button>
                                @endif


                            </div>



                        </div>
                    </div>


                    @if ($clientes->count() > 0)

                        <div class="row g-3 col-md-12">

                            @foreach ($clientes as $cliente)
                                <div class="col-md-6">
                                    <div class="card radius-10 border-start border-1 border-5 border-info "
                                        style="border-width: 1px 1px 1px 7px;">
                                        @if ($cliente->estado2 == 'azul')
                                            <div class="card-header ">
                                                <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                        {{ $cliente->id }}</b></div>
                                                <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                    {{ $cliente->codigo }}
                                                </h4>
                                                <span class="d-block text-center text-secondary">
                                                    <b>{{ $cliente->nombre }} {{ $cliente->apellidos }} </b>
                                                </span>
                                            </div>
                                        @else
                                            <div class="card-header "
                                                style="background: linear-gradient(to right, #FFA500, #FF8C00);">
                                                <div class="float-start bg-darck text-white m-0 p-1"><b>N
                                                        {{ $cliente->id }}</b></div>
                                                <h4 class="my-0 text-darck text-center"><i class="bx bx-male"></i>
                                                    {{ $cliente->codigo }}
                                                </h4>
                                                <span class="d-block text-center text-secondary">
                                                    <b>{{ $cliente->nombre }} {{ $cliente->apellidos }} </b>
                                                </span>

                                            </div>
                                        @endif

                                        <div class="card-body">
                                            <div class="d-flex align-items-center row g-3">
                                                @if ($cliente->cliente_mascotas)
                                                    @foreach ($cliente->cliente_mascotas as $ms)
                                                        @foreach ($ms->mascotas_historial_eutanacia as $eutanacia)
                                                            <div class="text-center">
                                                                <span class="text-danger btn btn-outline-danger">
                                                                    <i class="fas fa-cat"></i>
                                                                    {{ $eutanacia->historial_clinico_mascotas->nombre }}
                                                                    <br>
                                                                    {{ $eutanacia->hitorialtipohistorial->nombre }} EN
                                                                    FECHA
                                                                    {{ \Carbon\Carbon::parse($eutanacia->created_at)->isoFormat('LL') }}
                                                                    <br>
                                                                    {{ $eutanacia->informe_de_eutanacia }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                @endif


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
                                                                        <button class="dropdown-item"
                                                                            wire:click="CrearEstudio({{ $mascota->id }})">{{ $mascota->nombre }}
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
                                                                    @if ($cliente)
                                                                        @foreach ($cliente->cliente_mascotas as $mascota)
                                                                            <button class="dropdown-item"
                                                                                wire:click="crearcirugias({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                            </button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                            </div>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-success  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    FARMACIA <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @if ($cliente)
                                                                        @foreach ($cliente->cliente_mascotas as $mascota)
                                                                            <button class="dropdown-item"
                                                                                wire:click="crearfarmacias({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                            </button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="btn-group mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-success dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    REPORTES <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @if ($cliente)
                                                                        @foreach ($cliente->cliente_mascotas as $mascota)
                                                                            <a href="{{ route('reportediario', ['id' => $mascota->id]) }}"
                                                                                class="dropdown-item">{{ $mascota->nombre }}</a>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="btn-group mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-success dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    INTERNACION <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @if ($cliente)
                                                                        @foreach ($cliente->cliente_mascotas as $mascota)
                                                                            <button
                                                                                wire:click="VerTInternacion({{ $mascota->id }})"
                                                                                class="dropdown-item">{{ $mascota->nombre }}</button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button class=" btn btn-outline-success"
                                                                    wire:click="SacarTotalDia({{ $cliente->id }})">TOTAL
                                                                    A PAGAR
                                                                    DEL DIA</button>
                                                            </div>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-info  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    PONER EN COLA <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @if ($cliente)
                                                                        @foreach ($cliente->cliente_mascotas as $mascota)
                                                                            <button class="dropdown-item"
                                                                                wire:click="fponer_cola({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                            </button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button id="btnGroupVerticalDrop1" type="button"
                                                                    class="btn btn-outline-primary  dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    EUTANACIA <i class="mdi mdi-chevron-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="btnGroupVerticalDrop1">
                                                                    @if ($cliente)
                                                                        @foreach ($cliente->cliente_mascotas as $mascota)
                                                                            <button class="dropdown-item"
                                                                                wire:click="CrearEutanacia({{ $mascota->id }})">{{ $mascota->nombre }}
                                                                            </button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="btn-group  mt-2" role="group">
                                                                <button type="button"
                                                                    class="btn btn-warning  dropdown-toggle"
                                                                    wire:click="HistorialAntiguo({{ $cliente->id }})">
                                                                    HISTORIAL ANTIGUOS
                                                                </button>
                                                            </div>


                                                        </div>
                                                    </li>

                                                </ul>

                                                <div class="col-md-5">
                                                    @if ($cliente->estado2 == 'azul')
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <p class="mb-0 text-secondary">CODIGO AZUL</p>
                                                                <button type="button" class="btn btn-sm "
                                                                    style="background: linear-gradient(45deg, #008080, #17a2b8); "></button>

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <p class="mb-0 text-secondary">CODIGO NARANJA</p>
                                                                <button type="button" class="btn btn-sm "
                                                                    style="background: linear-gradient(45deg, orange, #ff7f50);"></button>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <hr>
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
                                                            {{ $cliente->created_at }}
                                                        </h6>

                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center" wire:ignore.self>
                            {{ $clientes->links() }}
                        </div>
                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>


            <div wire:ignore.self id="modalcrearcliente" data-bs-backdrop="static" class="modal fade" tabindex="-1"
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
            <div wire:ignore.self id="modaleditarcliente" data-bs-backdrop="static" class="modal fade"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
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
                            <hr>
                            <div class="row btn btn-sm">
                                <p class="mb-0 text-secondary">ESTADO</p>
                                @if ($estado2 == 'azul')
                                    <button class="btn btn-sm"
                                        style="background: linear-gradient(45deg, #008080, #17a2b8); width: 200px;"
                                        wire:click="CambiarEstadoclientef">
                                        AZUL
                                    </button>
                                @elseif($estado2 == 'naranja')
                                    <button class="btn btn-sm "
                                        style="background: linear-gradient(45deg, orange, #ff7f50);width: 200px;"
                                        wire:click="CambiarEstadoclientef">
                                        NARANJA
                                    </button>
                                @endif
                                <div>
                                    @if (session()->has('alertaaa'))
                                        <div class="alert alert-success">
                                            {{ session('alert') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
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

                                    <select class="form-control " wire:model="ExpedidoClienteEdit">
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
            <div wire:ignore.self id="modalcrearmascota" data-bs-backdrop="static" class="modal fade" tabindex="-1"
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
                                @if ($rutaImagenfinalMascota)
                                    <div class="col-md-6">
                                        <label class="form-label">FOTO DE MASCOTA</label>
                                        <img src="{{ $rutaImagenfinalMascota }}" alt="Imagen del mascota"
                                            class="img-fluid">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success mr-2"
                                                wire:click="eliminarfoto">DESEA TOMAR OTRA FOTO ?</button>

                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label class="form-label">FOTO DE MASCOTA</label>
                                        <div
                                            class="border border-primary rounded   embed-responsive embed-responsive-16by9">
                                            <video width="100%" height="auto" id="CamaraMascota" autoplay></video>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-warning mr-2"
                                                wire:click="cambiarCamaratMascota">Usar camara trasera</button>
                                            <button type="button" class="btn btn-outline-success"
                                                wire:click="cambiarCamaradMascota">Usar camara Frontal</button>
                                            @if (!($facingModeMascota == 'sin'))
                                                <button type="button" class="btn btn-outline-primary"
                                                    id="capturarBtn">Tomar Captura</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif

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

            {{-- MODAL VER MASCOTAS  --}}

            <div wire:ignore.self id="modalvermascotas" data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-xl">
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
                                            <div class="row col-md-12">

                                                @foreach ($mascotas as $index => $mascota)
                                                    <div class="col-md-6">
                                                        <div class="card radius-10 border-start border-1 border-5 border-success "
                                                            style="border-width: 1px 1px 1px 7px;">
                                                            <div class="card-header">
                                                                <div class="float-start bg-success text-white m-0 p-1">
                                                                    <b>N
                                                                        {{ $index + 1 }} </b>
                                                                </div>
                                                                <h4 class="my-0 text-success text-center"><i
                                                                        class="fas fa-cat"></i>
                                                                    {{ $mascota->nombre }}
                                                                </h4>

                                                            </div>
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center row g-3">
                                                                    <ul class="list-group col-md-12 border-2">
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">

                                                                            <div>
                                                                                <img src="{{ $mascota->imagen }}"
                                                                                    alt="mascota" class="img-fluid">
                                                                            </div>
                                                                        </li>
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                            <div>
                                                                                {{-- <i class="fs-6 fas fa-spider"></i> --}}
                                                                                <i class="fas fa-feather"></i>
                                                                                <b>ESPECIE</b> <br>
                                                                                <span>
                                                                                    {{ $mascota->mascotas_especies->nombre }}</span>
                                                                            </div>
                                                                            <div>
                                                                                {{-- <i class="fab fa-suse"></i> <b>RAZA</b> --}}
                                                                                <i class="fab fa-first-order-alt"></i>
                                                                                <b>RAZA</b>
                                                                                <br>
                                                                                <span>
                                                                                    {{ $mascota->mascotas_razas->nombre }}</span>
                                                                            </div>
                                                                        </li>
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                            <div>
                                                                                <i class="fas fa-venus-mars"></i>
                                                                                <b>SEXO</b> <br>
                                                                                @if ($mascota->sexo == 'H')
                                                                                    <span>Hembra</span>
                                                                                @elseif($mascota->sexo == 'M')
                                                                                    <span>Macho</span>
                                                                                @endif

                                                                            </div>
                                                                            <div>
                                                                                <i class="fab fa-suse"></i>
                                                                                <b>COLOR</b> <br>
                                                                                <span>
                                                                                    {{ $mascota->mascotas_colores->nombre }}</span>
                                                                            </div>
                                                                        </li>
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                            <div>
                                                                                <i class="fs-6 fas fa-spider"></i>
                                                                                <b>ESTERILIZADO</b> <br>
                                                                                <span>
                                                                                    {{ $mascota->esterilizado }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <i
                                                                                    class="mdi mdi-language-haskell"></i>
                                                                                <b>EDAD:</b> <br>
                                                                                <span>
                                                                                    {{ $mascota->edad_mascota }}</span>
                                                                            </div>

                                                                        </li>
                                                                        <li
                                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                            <div>
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
                                                                            </div>
                                                                            <div>
                                                                                <button class="btn btn-info btn-sm"
                                                                                    wire:click="editarmascota({{ $mascota->id }})"><i
                                                                                        class="fas fa-pencil-alt"></i></button>
                                                                                <button class="btn btn-danger btn-sm"
                                                                                    wire:click.prevent="$emit('borrarmascota', {{ $mascota->id }})"><i
                                                                                        class="fas fa-trash-alt"></i></button>
                                                                            </div>

                                                                        </li>
                                                                    </ul>


                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        {{ $mascotas->links() }}
                                                    </div>
                                                </div>
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
    <div wire:ignore.self id="modalcrearhistorial" data-bs-backdrop="static" class="modal fade" tabindex="-1"
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
                            @if ($registroCompletodetodomascota)
                                <div class="row">
                                    <div>
                                        <label class="form-label text-info"><strong>Nombre del
                                                cliente:</strong></label> <label
                                            class="form-label">{{ $registroCompletodetodomascota->mascot_clie->nombre }}
                                            {{ $registroCompletodetodomascota->mascot_clie->apellidos }}</label>
                                    </div>
                                    <div>
                                        <label class="form-label text-info"><strong>Código del
                                                Cliente:</strong></label> <label
                                            class="form-label">{{ $registroCompletodetodomascota->mascot_clie->codigo }}</label>
                                    </div>
                                    <div>
                                        <label class="form-label text-info"><strong>Nombre de la
                                                mascota:</strong></label> <label
                                            class="form-label">{{ $registroCompletodetodomascota->nombre }}</label>
                                    </div>
                                </div>
                            @endif
                            <div class="text-center text-info">
                                <h1></h1>
                            </div>
                            <hr>


                            <div class="col-md-12">
                                <label class="form-label">Motivo de atención:</label>

                                <div>
                                    <textarea class="form-control" id="contenedor-motivo-consulta" wire:model="MotivoDeAtencion"
                                        placeholder="Ingrese el motivo de atención....."></textarea>

                                    <button class="btn btn-primary"
                                        wire:click="comenzarReconocimientoMotivoDeAtencion"><i
                                            class="fas fa-microphone"></i></button>
                                </div>

                                @error('MotivoDeAtencion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Anamensis:</label>

                                <div>
                                    <textarea class="form-control" id="contenedor-anamensis" wire:model="AnamensisDeMascota"
                                        placeholder="Ingrese una descripción de la mascota...."></textarea>

                                    <button class="btn btn-primary" wire:click="comenzarReconocimientoAnamensis"><i
                                            class="fas fa-microphone"></i></button>
                                </div>

                                @error('AnamensisDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Especie:</label>
                                <input type="text" class="form-control" wire:model="Especie"
                                    style="color: #005AA7" disabled
                                    placeholder="Ingrese el tiempo de llenado capilar">
                                @error('Especie')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Raza:</label>
                                <input type="text" class="form-control" wire:model="Raza" style="color: #005AA7"
                                    disabled placeholder="Ingrese el tiempo de llenado capilar">
                                @error('Raza')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sexo:</label>
                                <input type="text" class="form-control" wire:model="Sexo" style="color: #005AA7"
                                    disabled placeholder="Ingrese el tiempo de llenado capilar">
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
                                <input type="text" class="form-control" wire:model="MmDeMascota" maxlength="30">
                                @error('MmDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Constante vital FC :</label>
                                <input type="text" class="form-control" wire:model="ConstanteVitalFcDeMascota"
                                    placeholder="Frecuencia cardiaca (pul o lat/min)
                            (ppm/lpm)"
                                    maxlength="20">
                                @error('ConstanteVitalFcDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Constante vital FR :</label>
                                <input type="text" class="form-control" wire:model="ConstanteVitalFrDeMascota"
                                    placeholder="Frecuencia respiratoria (resp/min)(rpm)" maxlength="20">
                                @error('ConstanteVitalFrDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Constante vital T° :</label>
                                <input type="text" class="form-control"
                                    wire:model="ConstanteVitalTemperaturaDeMascota"
                                    placeholder="Temperatura corporal (ºC)" maxlength="20">
                                @error('ConstanteVitalTemperaturaDeMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PAST :</label>
                                <input type="text" class="form-control" wire:model="Past" maxlength="20">
                                @error('Past')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PAD :</label>
                                <input type="text" class="form-control" wire:model="Pad" placeholder=" "
                                    maxlength="20">
                                @error('Pad')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PAM:</label>
                                <input type="text" class="form-control" wire:model="Pam" placeholder=""
                                    maxlength="20">
                                @error('Pam')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PULSO :</label>
                                <input type="text" class="form-control" wire:model="PulsoDeLaMascota"
                                    placeholder="" maxlength="20">
                                @error('PulsoDeLaMascota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">DHT:</label>
                                <input type="text" class="form-control" wire:model="Dht" placeholder=""
                                    maxlength="20">
                                @error('Dht')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">PESO :</label>
                                <input type="text" class="form-control" wire:model="Peso"
                                    placeholder="Inserte un valor en kg." maxlength="20">
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
                            @if ($nombreTipohistorial == 'CONSULTA')
                                <div class="col-md-12">
                                    <label class="form-label">Diagnotico:</label>

                                    <div>
                                        <textarea class="form-control" id="contenedor-diagnostico" wire:model="Diagnosticoconsulta"
                                            placeholder="Ingrese una descripción de la mascota...."></textarea>

                                        <button class="btn btn-primary"
                                            wire:click="comenzarReconocimientoDiagnostico"><i
                                                class="fas fa-microphone"></i></button>
                                    </div>
                                    @error('Diagnosticoconsulta')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                @foreach ($consultasMascota as $cons)
                                    @if ($cons->diagnostico)
                                        <div class="col-md-12">
                                            <div class="alert alert-primary alert-dismissible fade show"
                                                role="alert">
                                                Diagnostico en fecha {{ $cons->updated_at }} : <br>
                                                {{ $cons->diagnostico }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close">

                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <div class="col-md-12">
                                <label class="form-label">Recomendaciones:</label>

                                <div>
                                    <textarea class="form-control" id="contenedor-recomendaciones" wire:model="Recomendacionconsulta"
                                        placeholder="Ingrese una descripción de la mascota...."></textarea>

                                    <button class="btn btn-primary"
                                        wire:click="comenzarReconocimientoRecomendacione"><i
                                            class="fas fa-microphone"></i></button>
                                </div>
                                @error('Recomendacionconsulta')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Precio de la consulta: </label>
                                <input type="text" class="form-control" wire:model="PrecioConsulta"
                                    placeholder="Ingrese el precio de la consulta">
                                @error('PrecioConsulta')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @elseif($tipo_historial == 'estudio_complementario')
                        <div class="row">
                            @if ($registroCompletodetodomascota)
                                <div>
                                    <label class="form-label text-info"><strong>Nombre del cliente:</strong></label>
                                    <label
                                        class="form-label">{{ $registroCompletodetodomascota->mascot_clie->nombre }}
                                        {{ $registroCompletodetodomascota->mascot_clie->apellidos }}</label>
                                </div>
                                <div>
                                    <label class="form-label text-info"><strong>Código del Cliente:</strong></label>
                                    <label
                                        class="form-label">{{ $registroCompletodetodomascota->mascot_clie->codigo }}</label>
                                </div>
                                <div>
                                    <label class="form-label text-info"><strong>Nombre de la mascota:</strong></label>
                                    <label class="form-label">{{ $registroCompletodetodomascota->nombre }}</label>
                                </div>
                            @endif



                            <div class="col-md-4">

                                <label class="form-label">Tipo de Estudio Complementario</label>
                                <select class="form-select" wire:model="TipoDeEstudioComplementario">
                                    <option value="" selected>[Seleccione una opcion]</option>
                                    <option value="nuevo" selected style="color: #005AA7">DESEA CREAR UN NUEVO TIPO
                                        DE ESTUDIO?</option>

                                    @foreach ($estudios_complemetarios as $estudios)
                                        <option value="{{ $estudios->id }}">{{ $estudios->nombre }}</option>
                                    @endforeach


                                </select>
                                @error('TipoDeEstudioComplementario')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($TipoDeEstudioComplementario == 'nuevo')
                                    <input type="text" wire:model="NuevoEstudio" class="form-control"
                                        placeholder="Ej. imagenologia" style="text-transform: uppercase;">
                                    @error('NuevoEstudio')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text-center"> <button class="btn btn-success"
                                            wire:click="CrearEstudioNuevo"><i
                                                class="mdi mdi-content-save-alert-outline"></i></button>
                                        <button class="btn btn-danger" wire:click="CancelarCreaEstudio"><i
                                                class="mdi mdi-file-cancel-outline"></i></button>
                                    </div>
                                @endif
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
                                <select class="form-select" wire:model='SeleccionTipoDeArchivo'>
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
                                <input type="text" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Comentario del estudio:</label>

                                <textarea cols="2" rows="10" class="form-control" wire:model="ComentarioEstudio"
                                    placeholder="Ingrese un breve comentario..."></textarea>
                                @error('ComentarioEstudio')
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
                                                    class="text-danger">Tamaño: 600 X 800 Pixeles</span></label>
                                        @endif
                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <input type="file" class="form-control" accept=".pdf"
                                                wire:model="ArchivoDelEstudio">
                                            @error('ArchivoDelEstudio')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        @elseif($SeleccionTipoDeArchivo == 'imagen')
                                            <input type="file" class="form-control" accept=".jpg,.png,.jpeg"
                                                wire:model="ArchivoDelEstudioImagenColeccion" multiple>
                                            @error('ArchivoDelEstudioImagenColeccion')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        @endif

                                        @if ($SeleccionTipoDeArchivo == 'pdf')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudio">
                                                <div class="spinner-border avatar-lg text-primary m-2"
                                                    role="status">
                                                </div>
                                            </div>
                                        @endif
                                        @if ($SeleccionTipoDeArchivo == 'imagen')
                                            <div class="mb-3 col-md-12 text-center" wire:loading
                                                wire:target="ArchivoDelEstudioImagenColeccion">
                                                <div class="spinner-border avatar-lg text-primary m-2"
                                                    role="status">
                                                </div>
                                            </div>
                                            @if ($ArchivoDelEstudioImagenColeccion)
                                                <div class="row">
                                                    @foreach ($ArchivoDelEstudioImagenColeccion as $img)
                                                        <div class="col-md-4">
                                                            <img src="{{ $img->temporaryUrl() }}"
                                                                class="img-fluid" alt="Vista previa"
                                                                width="300" height="auto">
                                                        </div>
                                                    @endforeach
                                                </div>


                                            @endif
                                        @endif
                                    @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                        <div class="col-md-12">
                                            <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                    class="text-info">(capturar desde la
                                                    cámara)</span> <span class="text-danger">*</span></label>

                                            @if ($a == true)
                                                <div class="text-center" wire:ignore.self>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="LimpiarCaptura">
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
                                <label class="form-label">Precio de la Eutanacia:</label>
                                <input type="number" class="form-control" wire:model="Precio"
                                    placeholder="Ingrese el precio del historial">
                                @error('Precio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label"><span class="text-primary"> Cual es la razón por el
                                        cual se decidio realizar la eutanacia? <br> </span></label>
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
                                <select class="form-select" wire:model='SeleccionTipoDeArchivo'>
                                    <option value="">[Seleccione una opción]</option>

                                    <option value="imagen">Subir una Imagen</option>
                                    <option value="usarcamara">Subir una imagen desde camara</option>
                                </select>
                                @error('errortipodedato')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('SeleccionTipoDeArchivo')
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
                                            <label class="form-label"> Debe seleccionar una imagen</label>
                                        @endif


                                        <input type="file" class="form-control"
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf" @elseif($SeleccionTipoDeArchivo == 'imagen') accept=".jpg,.png,.jpeg" @endif
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
                                                        wire:click="LimpiarCaptura">
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
                                <select class="form-select" wire:model='SeleccionTipoDeArchivo'>
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
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf" @elseif($SeleccionTipoDeArchivo == 'imagen') accept=".jpg,.png,.jpeg" @endif
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
                                                        wire:click="LimpiarCaptura">
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
                                <select class="form-select" wire:model='SeleccionTipoDeArchivo'>
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
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf" @elseif($SeleccionTipoDeArchivo == 'imagen') accept=".jpg,.png,.jpeg" @endif
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
                                                        wire:click="LimpiarCaptura">
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
                                <select class="form-select" wire:model='SeleccionTipoDeArchivo'>
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
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf" @elseif($SeleccionTipoDeArchivo == 'imagen') accept=".jpg,.png,.jpeg" @endif
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
                                                        wire:click="LimpiarCaptura">
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
                                <select class="form-select" wire:model='SeleccionTipoDeArchivo'>
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
                                            @if ($SeleccionTipoDeArchivo == 'pdf') accept=".pdf" @elseif($SeleccionTipoDeArchivo == 'imagen') accept=".jpg,.png,.jpeg" @endif
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
                                                        wire:click="LimpiarCaptura">
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
                                <button wire:click="GuardarEutanaciaNuevo" type="button"
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
                                        <legend class="float-none w-auto text-primary">DATOS DE LA VACUNA
                                        </legend>
                                        <div class="row text-center">
                                            <div class="col-md-3">
                                                <label class="form-label">Fecha</label>



                                                @if ($IdVacuna)
                                                    <input type="date" class="form-control"
                                                        wire:model="FechaVacuna"
                                                        placeholder="Ingrese la edad de la mascota">
                                                    @error('FechaVacuna')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    @php
                                                        $fecha_actual = date('Y-m-d');
                                                    @endphp
                                                    <input type="date" class="form-control"
                                                        value="{{ $fecha_actual }}" disabled
                                                        style="color: rgb(19, 9, 101) ">
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Edad</label>
                                                <input type="text" class="form-control"
                                                    wire:model="EdadEnVacunas"
                                                    placeholder="Ingrese la edad de la mascota">
                                                @error('EdadEnVacunas')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Vacuna aplicada</label>
                                                <input type="text" class="form-control"
                                                    wire:model="VacunaAplicada"
                                                    placeholder="Ingrese la vacuna aplicada">
                                                @error('VacunaAplicada')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Constante FC</label>
                                                <input type="text" class="form-control" wire:model="VacunaFC"
                                                    placeholder="Ingrese el registro de FC">
                                                @error('VacunaFC')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Constante FR</label>
                                                <input type="text" class="form-control" wire:model="VacunaFR"
                                                    placeholder="Ingrese  el registro de FR">
                                                @error('VacunaFR')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Constante T°</label>
                                                <input type="text" class="form-control" wire:model="VacunaT"
                                                    placeholder="Ingrese  el registro de T°">
                                                @error('VacunaT')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Constante TLLC</label>
                                                <input type="text" class="form-control" wire:model="VacunaTllc"
                                                    placeholder="Ingrese  el registro de TLLC">
                                                @error('VacunaTllc')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Constante PESO</label>
                                                <input type="text" class="form-control" wire:model="VacunaPeso"
                                                    placeholder="Ingrese  el registro de PESO">
                                                @error('VacunaPeso')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Constante MM</label>
                                                <input type="text" class="form-control" wire:model="VacunaMM"
                                                    placeholder="Ingrese  el registro de MM">
                                                @error('VacunaMM')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Anamensis</label>
                                                <textarea class="form-control" wire:model="VacunaAnamensis"></textarea>

                                                @error('VacunaAnamensis')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Recomendación</label>
                                                <textarea class="form-control"wire:model="VacunaRecomendacion"></textarea>

                                                @error('VacunaRecomendacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Proxima Fecha</label>
                                                <input type="date" class="form-control"
                                                    wire:model="ProximaFecha"placeholder="Ingrese la proxima fecha de atención">
                                                @error('ProximaFecha')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Precio</label>
                                                <input type="number" class="form-control"
                                                    wire:model="PrecioVacuna"placeholder="Precio de la vacuna">
                                                @error('PrecioVacuna')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Veterinario</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->name }}" disabled
                                                    style="color: #071d30">


                                            </div>

                                            <div class="col-md-1 mt-4">
                                                @if ($IdVacuna)
                                                    <button class="btn btn-success" title="GUARDAR VACUNA EDITADA"
                                                        wire:click=GuardaEditarVacuna><i
                                                            class="bx bx-pencil"></i></button>
                                                    <button class="btn btn-danger" title="CANCELAR Y SALIR"
                                                        wire:click=CancelarGuardaVacuna><i
                                                            class="bx bx-pencil"></i></button>
                                                @else
                                                    <button class="btn btn-success" wire:click=GuardaVacuna>+</button>
                                                @endif

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
                                                        <th>PRECIO DE LA VACUNA</th>
                                                        <th>CONSTANTES</th>
                                                        <th>PROXIMA FECHA</th>
                                                        <th>VETERINARIO</th>
                                                        <th>OTROS</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($VacunasPorMascota as $vacunas)
                                                        <tr>
                                                            <td>{{ $vacunas->fecha }}</td>
                                                            <td>{{ $vacunas->edad }}</td>
                                                            <td>{{ $vacunas->vacuna_aplicada }}</td>

                                                            <td>{{ $vacunas->precio }} Bs.</td>
                                                            <td>
                                                                <span class="text-primary"> FC :</span>
                                                                {{ $vacunas->FC }}
                                                                <br>
                                                                <span class="text-primary"> FR :</span>
                                                                {{ $vacunas->FR }}
                                                                <br>
                                                                <span class="text-primary"> T° :</span>
                                                                {{ $vacunas->T }}
                                                                <br>
                                                                <span class="text-primary"> TLLC :</span>
                                                                {{ $vacunas->TLLC }}
                                                                <br>
                                                                <span class="text-primary"> PESO :</span>
                                                                {{ $vacunas->PESO }}
                                                                <br>
                                                                <span class="text-primary"> MM :</span>
                                                                {{ $vacunas->MM }}
                                                                <br>

                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($vacunas->proxima_fecha)->format('d/m/Y') }}
                                                            </td>
                                                            <td>{{ $vacunas->vacuna_veterinario->name }}</td>
                                                            <td class="text-center">
                                                                <button
                                                                    class="btn btn-outline-primary">ANAMENSIS</button>
                                                                <br>
                                                                {{ $vacunas->anamensis }} <br> <br>
                                                                <button
                                                                    class="btn btn-outline-primary">RECOMENDACIÓN</button>
                                                                <br>
                                                                {{ $vacunas->recomendacion }}
                                                            </td>
                                                            <td>

                                                                <button class="btn btn-danger"
                                                                    wire:click.prevent="$emit('BorrarVacula', {{ $vacunas->id }})"><i
                                                                        class="bx bxs-trash"></i></button>
                                                                <button class="btn btn-warning"
                                                                    wire:click="EditarVacuna({{ $vacunas->id }})"><i
                                                                        class="bx bx-pencil"></i></button>


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
                                        <div class="row mt-4">
                                            <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN
                                                REGISTRO DE
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
                                            <div class="col-md-3">
                                                <label class="form-label">Fecha</label>

                                                @php
                                                    $fecha_actual = date('Y-m-d');
                                                @endphp
                                                <input type="date" class="form-control"
                                                    value="{{ $fecha_actual }}" disabled
                                                    style="color: rgb(19, 9, 101)">


                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Edad</label>
                                                <input type="text" class="form-control"
                                                    wire:model="EdadEnDesparacitacion"
                                                    placeholder="Ingrese la edad de la mascota">
                                                @error('EdadEnDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Peso</label>
                                                <input type="text" class="form-control"
                                                    wire:model="PesoEnDesparacitacion"placeholder="Ingrese la peso de la mascota">
                                                @error('PesoEnDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Producto /Dosis</label>
                                                <input type="text" class="form-control"
                                                    wire:model="ProductoDosis"placeholder="Ingrese la peso de la mascota">
                                                @error('ProductoDosis')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Proxima Fecha</label>
                                                <input type="date" class="form-control"
                                                    wire:model="ProximaFechaDesparacitacion">
                                                @error('ProximaFechaDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Precio</label>
                                                <input type="number" class="form-control"
                                                    wire:model="PrecioDesparacitacion"placeholder="Precio de la Desparacitación">
                                                @error('PrecioDesparacitacion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Veterinario</label>
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->name }}" disabled
                                                    style="color: #071d30">
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <button class="btn btn-success"
                                                    wire:click="GuardaDesparacitacion">+</button>
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
                                                    <th>PRECIO</th>
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
                                                        <td>{{ $desparacitacion->precio }}</td>

                                                        <td>{{ $desparacitacion->id_producto2 }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($desparacitacion->proxima_fecha)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ $desparacitacion->desparacitaciones_veterinario->name }}
                                                        </td>
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
                                        <span class="alert alert-success text-center">AUN NO SE TIENE NINGUN REGISTRO
                                            DE
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
    <div wire:ignore.self id="capturarImagenModal" data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="capturarImagenModalLabel" aria-hidden="false">
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
    <div wire:ignore.self id="atencionesdeldia" data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TRABAJOS REALIZADOS EN EL CLIENTE DEL DIA DE HOY</h5>

                </div>
                <div class="modal-body" wire:ignore.self>
                    <div class="table-responsive mt-3">

                        <table class="table table-hover table-bordered border-primary">

                            <thead
                                style="background: #0575E6; background: -webkit-linear-gradient(to right, #021B79, #0575E6); background: linear-gradient(to right, #021B79, #0575E6);">
                                <tr>


                                    <th>MASCOTA ATENDIDA</th>
                                    <th>TRABAJO REALIZADO</th>

                                    <th>PRECIO DEL TRABAJO</th>
                                    <th>PRECIO DE TRATAMIENTOS</th>
                                    <th>PRECIO TOTAL</th>


                                </tr>
                            </thead>
                            <tbody>
                                @if ($AtencionDiaHistorial)
                                    @foreach ($AtencionDiaHistorial as $atencion)
                                        <tr>


                                            <td>{{ $atencion->historial_clinico_mascotas->nombre }}</td>

                                            <td>
                                                @if ($atencion->tipo_historial_id == 2)
                                                    {{ $atencion->historial_estudio->nombre }}
                                                @else
                                                    {{ $atencion->hitorialtipohistorial->nombre }}
                                                @endif
                                            </td>
                                            <td>{{ $atencion->precio }} Bs.</td>
                                            @php
                                                $preciohitoriales = 0;
                                                foreach ($atencion->historial_tratamientos as $value2) {
                                                    if ($value2->estado == 'activo') {
                                                        $preciohitoriales = $preciohitoriales + $value2->precio;
                                                    }
                                                }

                                            @endphp
                                            <td>
                                                @if ($preciohitoriales != 0)
                                                    {{ $preciohitoriales }} Bs.
                                                @else
                                                    S/N
                                                @endif
                                            </td>
                                            <td>
                                                @if ($preciohitoriales != 0)
                                                    @php
                                                        $sumnatoria = $preciohitoriales + $atencion->precio;
                                                        echo $sumnatoria . 'Bs.';
                                                    @endphp
                                                @else
                                                    {{ $atencion->precio }} Bs.
                                                @endif

                                            </td>


                                        </tr>
                                    @endforeach

                                @endif
                                @if ($AtencionDiaVacunas)
                                    @foreach ($AtencionDiaVacunas as $vacuna)
                                        <tr>

                                            <td>{{ $vacuna->vacuna_mascota->nombre }}</td>

                                            <td> VACUNA APLICADA: {{ $vacuna->vacuna_aplicada }}</td>
                                            <td>{{ $vacuna->precio }} Bs.</td>
                                            <td> S/N</td>

                                            <td>{{ $vacuna->precio }} Bs.</td>




                                        </tr>
                                    @endforeach

                                @endif
                                @if ($AtencionDiaDesparacitaciones)
                                    @foreach ($AtencionDiaDesparacitaciones as $despar)
                                        <tr>

                                            <td>{{ $despar->desparacitaciones_mascota->nombre }}</td>

                                            <td> SE APLICO : {{ $despar->id_producto2 }}</td>
                                            <td>{{ $despar->precio }} Bs.</td>
                                            <td> S/N</td>

                                            <td>{{ $despar->precio }} Bs.</td>




                                        </tr>
                                    @endforeach

                                @endif
                                @if ($AtencionDiaCitugias)
                                    @foreach ($AtencionDiaCitugias as $cirugia)
                                        <tr>

                                            <td>{{ $cirugia->cirugia_mascota->nombre }}</td>

                                            <td> cirugia: {{ $cirugia->descripcion }}</td>
                                            <td>{{ $cirugia->total }} Bs.</td>
                                            <td> S/N</td>

                                            <td>{{ $cirugia->total }} Bs.</td>




                                        </tr>
                                    @endforeach

                                @endif
                                @if ($AtencionFarmacia)
                                    @foreach ($AtencionFarmacia as $farma)
                                        <tr>

                                            <td>{{ $farma->farmacia_mascota->nombre }}</td>

                                            <td> se realizo la venta de :
                                                {{ $farma->productos_famaciaven->nombre }}

                                                {{-- @foreach ($farma->productos_famaciaven as $producto)
                                                    {{ $producto->nombre }}
                                                @endforeach --}}
                                            </td>
                                            <td>{{ $farma->cantidad * $farma->precio }} Bs.</td>
                                            <td> S/N</td>

                                            <td>{{ $farma->cantidad * $farma->precio }} Bs.</td>




                                        </tr>
                                    @endforeach

                                @endif
                                @if ($AtencionInteracion)
                                    @foreach ($AtencionInteracion as $inter)
                                        <tr>

                                            <td>{{ $inter->internacion_mascota->nombre }}</td>

                                            <td> internacion en fecha y hora: {{ $inter->created_at }}</td>
                                            <td>{{ $inter->precio }} Bs.</td>
                                            <td> S/N</td>

                                            <td>{{ $inter->precio }} Bs.</td>




                                        </tr>
                                    @endforeach

                                @endif


                                @php
                                    $totalApagar = 0;
                                    if ($AtencionDiaHistorial) {
                                        foreach ($AtencionDiaHistorial as $precio) {
                                            $totalApagar = $totalApagar + $precio->precio;
                                            $preciohitoriales = 0;
                                            foreach ($precio->historial_tratamientos as $value2) {
                                                if ($value2->estado == 'activo') {
                                                    $preciohitoriales = $preciohitoriales + $value2->precio;
                                                }
                                            }
                                            if ($preciohitoriales != 0) {
                                                $totalApagar = $totalApagar + $preciohitoriales;
                                            }
                                        }
                                    }
                                    if ($AtencionDiaVacunas) {
                                        foreach ($AtencionDiaVacunas as $value4) {
                                            $totalApagar = $totalApagar + $value4->precio;
                                        }
                                    }
                                    if ($AtencionDiaDesparacitaciones) {
                                        foreach ($AtencionDiaDesparacitaciones as $value5) {
                                            $totalApagar = $totalApagar + $value5->precio;
                                        }
                                    }
                                    if ($AtencionDiaCitugias) {
                                        foreach ($AtencionDiaCitugias as $value6) {
                                            $totalApagar = $totalApagar + $value6->total;
                                        }
                                    }
                                    if ($AtencionFarmacia) {
                                        foreach ($AtencionFarmacia as $value7) {
                                            $totalApagar = $totalApagar + $value7->cantidad * $value7->precio;
                                        }
                                    }
                                    if ($AtencionInteracion) {
                                        foreach ($AtencionInteracion as $value8) {
                                            $totalApagar = $totalApagar + $value8->total;
                                        }
                                    }

                                @endphp
                                @if ($totalApagar)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> TOTAL: </td>
                                        <td>{{ $totalApagar }} Bs.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>



                    </div>
                    @if ($totalApagar)
                        <hr class="border border-primary border-4">

                        <div class="row">
                            @if ($caja)
                                <div class="col-md-12 alert alert-success text-center">
                                    CAJA DISPONIBLE A CARGO DE DR. {{ $caja->usuario->name }}

                                </div>
                                <div class="col-md-12 text-center ">
                                    <span class="text-success"><b>DESEA REGISTRAR EL PAGO DEL CLIENTE ?</b></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Monto de pago:</label>
                                    <input type="number" wire:model="MontoPago" class="form-control"
                                        placeholder="Ingrese el monto en Bs.">
                                    @error('MontoPago')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Tipo de pago:</label>
                                    <select wire:model="TipoPago" class="form-select">
                                        <option value="">[SELECCIONE UNA OPCIÓN]</option>
                                        <option value="QR">QR</option>
                                        <option value="EFECTIVO">EFECTIVO</option>
                                    </select>
                                    @error('TipoPago')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Motivo de pago:</label>
                                    <select wire:model="MotivoDePago" class="form-select">
                                        <option value="">[SELECCIONE UNA OPCIÓN]</option>
                                        <option value="ReConsulta">ReConsulta</option>
                                        <option value="Consulta">Consulta</option>
                                        <option value="Vacuna">Vacuna</option>
                                        <option value="Desparacitación">Desparacitación</option>
                                        <option value="Cirugía">Cirugía</option>
                                        <option value="Farmacia">Farmacia</option>
                                        <option value="Internación">Internación</option>
                                        <option value="Varios">Varios</option>
                                        @foreach ($estudios_complemetarios as $estudios)
                                            <option value="{{ $estudios->nombre }}">{{ $estudios->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('MotivoDePago')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-4">
                                    <button class="btn btn-success" wire:click="GuardarPago">
                                        GUARDAR
                                    </button>
                                </div>
                            @else
                                <div class="col-md-12 alert alert-danger text-center">
                                    NO SE TIENE UNA CAJA DISPONIBLE

                                </div>
                            @endif


                        </div>
                    @endif


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>


                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="modalinternacion" data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">INTERNACIONES

                    </h5>

                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($internaciones->count() > 0)
                            @foreach ($internaciones as $internacion)
                                <div class="accordion" id="listadias-{{ $internacion->id }}" wire:ignore.self>
                                    <div class="accordion-item" wire:ignore.self>
                                        <h2 class="accordion-header" id="heading-{{ $internacion->id }}">
                                            <button class="accordion-button collapsed text-white rounded-3"
                                                style="background-color: #082338;" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $internacion->id }}"
                                                aria-expanded="false"
                                                aria-controls="collapse-{{ $internacion->id }}" wire:ignore.self>
                                                <span class="me-2">
                                                    <i class="bi bi-arrow-down"></i>
                                                    <!-- Ícono para cuando el acordeón está colapsado -->
                                                    <i class="bi bi-arrow-up"></i>
                                                    <!-- Ícono para cuando el acordeón está expandido -->
                                                </span>
                                                <span class="tex-info rounded p-2" style="color: #27ef30;">
                                                    INTERNACION EN FECHA -
                                                    {{ \Carbon\Carbon::parse($internacion->created_at)->isoFormat('LL') }}
                                                </span>
                                            </button>


                                        </h2>
                                        <div id="collapse-{{ $internacion->id }}"
                                            class="accordion-collapse collapse "
                                            aria-labelledby="heading-{{ $internacion->id }}"
                                            data-bs-parent="#listadias-{{ $internacion->id }}" wire:ignore.self>
                                            <div class="container">
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6 border border-3 border-primary">
                                                        <p class="text-success d-inline mr-2">DUEÑO:</p>
                                                        <p class="text-info d-inline">
                                                            {{ $internacion->internacion_mascota->mascotas_clientes->nombre }}
                                                            {{ $internacion->internacion_mascota->mascotas_clientes->apellidos }}
                                                        </p>
                                                        <br>
                                                        <p class="text-success d-inline mr-2">MASCOTA:</p>
                                                        <p class="text-info d-inline">
                                                            {{ $internacion->internacion_mascota->nombre }}
                                                        </p>
                                                        <br>
                                                        <br>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="$emit('borrar_internacion', {{ $internacion->id }})"><i
                                                                class="bx bxs-trash"> ELIMINAR
                                                            </i></button>
                                                    </div>
                                                    <div class="col-md-6 border border-3 border-primary">
                                                        <p class="text-success d-inline mr-2">COSTO TOTAL: </p>
                                                        <p class="text-info d-inline">
                                                            Bs. {{ $internacion->precio }}
                                                        </p>
                                                        <br>
                                                        <label for="" class="form-label"> Ingresar costo
                                                            total de internación</label>
                                                        <div class="col-md-6">

                                                            <input type="number" class="form-control"
                                                                wire:model="CostoInternacion">
                                                            @error('CostoInternacion')
                                                                <div class="text-danger">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 mt-2 text-center">
                                                            <button class="btn btn-success"
                                                                wire:click="NuevoCosto({{ $internacion->id }})"><i
                                                                    class="bx bxs-save"> </i></button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 border border-3 border-primary">
                                                        <label for="" class="form-label  mt-2"> Ingrese las
                                                            imagenes que corresponden a la internación</label>
                                                        <input type="file" class="form-control"
                                                            accept=".jpg,.png,.jpeg" multiple
                                                            wire:model="ImagenesInternacion">
                                                        @error('ImagenesInternacion')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="text-center"> <button class="btn btn-success"
                                                                wire:click="GuardarImgenesInternacion({{ $internacion->id }})">
                                                                GUARDAR IMAGENES</button>
                                                            <button class="btn btn-warning"
                                                                wire:click="VerImagenenesInternacion({{ $internacion->id }})">
                                                                VER IMAGENES</button>
                                                        </div>

                                                    </div>

                                                </div>


                                            </div>

                                            <div class="accordion-body">
                                                <fieldset class="border border-primary p-2 ">


                                                    <div class="accordion" id="listadias22" wire:ignore.self>
                                                        <div class="accordion-item" wire:ignore.self>
                                                            <h2 class="accordion-header" id="listadias_header">
                                                                <button class="accordion-button collapsed p-0 mb-0"
                                                                    style="background-color: #082338;"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse22"
                                                                    aria-expanded="false" aria-controls="collapse"
                                                                    wire:ignore.self>
                                                                    <p
                                                                        class="tex-info bg-warning text-white p-2 mb-2 rounded">
                                                                        COMENTARIOS DE DOCTORES SOBRE LA
                                                                        INTERNACION</p>
                                                                </button>
                                                            </h2>
                                                            <div class="accordion-collapse collapse" id="collapse22"
                                                                aria-labelledby="listadias_header"
                                                                data-bs-parent="#listadias22" wire:ignore.self>

                                                                <fieldset
                                                                    class="float-none w-auto border border-primary p-3 mb-3">
                                                                    <legend class="text-primary">COMENTARIOS
                                                                    </legend>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">
                                                                                DESEA REALIZAR UN
                                                                                COMENTARIO?<span
                                                                                    class="text-danger">*</span>
                                                                            </label>
                                                                            <div
                                                                                style="position: relative; display: inline-block; width: 100%;">
                                                                                <textarea class="form-control" id="contenedor" wire:model="DescripcionInternacion"
                                                                                    placeholder="Debe redactar la descripción del internacion...." style="width: 100%; padding-right: 40px;">
                                                                                    </textarea>
                                                                                @error('DescripcionInternacion')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                                <button class="btn btn-primary"
                                                                                    wire:click="comenzarReconocimiento"
                                                                                    style="position: absolute; right: 10px; top: 10px;">
                                                                                    <i class="fas fa-microphone"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label for=""
                                                                                        class="form-label">Constante
                                                                                        FC</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        maxlength="45"
                                                                                        wire:model="CFC">
                                                                                    @error('CFC')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for=""
                                                                                        class="form-label">Constante
                                                                                        FR</label>
                                                                                    <input type="text"
                                                                                        class="form-control"maxlength="45"
                                                                                        wire:model="CFR">
                                                                                    @error('CFR')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for=""
                                                                                        class="form-label">Constante
                                                                                        TMM</label>
                                                                                    <input type="text"
                                                                                        class="form-control"maxlength="45"
                                                                                        wire:model="CTMM">
                                                                                    @error('CTMM')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for=""
                                                                                        class="form-label">Constante
                                                                                        TLMC</label>
                                                                                    <input type="text"
                                                                                        class="form-control"maxlength="45"
                                                                                        wire:model="CTLMC">
                                                                                    @error('CTLMC')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label for=""
                                                                                        class="form-label">Constante
                                                                                        PULSO</label>
                                                                                    <input type="text"
                                                                                        class="form-control"maxlength="45"
                                                                                        wire:model="CPulso">
                                                                                    @error('CPulso')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}</div>
                                                                                    @enderror
                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <div class="form-group row mt-4">
                                                                        <div class="col-sm-12 offset-sm-4">
                                                                            @if ($idinternacionupdate)
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarComentarioInternacionUpdate">Editar
                                                                                    comentario</button>
                                                                                <button class="btn btn-danger"
                                                                                    wire:click="CancelarUpdateInternacion">Cancelar
                                                                                </button>
                                                                            @else
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarComentarioInternacion( {{ $internacion->id }})">+Agregar
                                                                                    comentario</button>
                                                                            @endif

                                                                        </div>
                                                                    </div>

                                                                </fieldset>
                                                                @if (count($internacion->internacion_comentarios) > 0)
                                                                    <div class="table-responsive mt-4">
                                                                        <table
                                                                            class="table table-hover table-bordered border-primary">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID</th>
                                                                                    <th>FECHA </th>

                                                                                    <th>COMENTARIO</th>
                                                                                    <th>
                                                                                        CONSTANTES

                                                                                    </th>
                                                                                    <th>VETERINARIO</th>

                                                                                    <th>ACCIÓN</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($internacion->internacion_comentarios as $datos)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}
                                                                                        </td>
                                                                                        <td>{{ $datos->created_at }}
                                                                                        </td>
                                                                                        <td>{{ $datos->comentario }}
                                                                                        </td>
                                                                                        <td>
                                                                                            @if ($datos->fc)
                                                                                                <b
                                                                                                    class="text-primary">
                                                                                                    Constante FC:
                                                                                                </b>
                                                                                                {{ $datos->fc }}
                                                                                                <br>
                                                                                            @endif
                                                                                            @if ($datos->fr)
                                                                                                <b
                                                                                                    class="text-primary">
                                                                                                    Constante FR:
                                                                                                </b>
                                                                                                {{ $datos->fr }}
                                                                                                <br>
                                                                                            @endif
                                                                                            @if ($datos->tmm)
                                                                                                <b
                                                                                                    class="text-primary">
                                                                                                    Constante TMM:
                                                                                                </b>
                                                                                                {{ $datos->tmm }}
                                                                                                <br>
                                                                                            @endif
                                                                                            @if ($datos->tlmc)
                                                                                                <b
                                                                                                    class="text-primary">
                                                                                                    Constante TLMC:
                                                                                                </b>
                                                                                                {{ $datos->tlmc }}
                                                                                                <br>
                                                                                            @endif
                                                                                            @if ($datos->pulso)
                                                                                                <b
                                                                                                    class="text-primary">
                                                                                                    Constante PULSO:
                                                                                                </b>
                                                                                                {{ $datos->pulso }}
                                                                                                <br>
                                                                                            @endif



                                                                                        </td>
                                                                                        <td> DR.
                                                                                            {{ $datos->user->name }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click.prevent="$emit('borrarinternacion', {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                            <button
                                                                                                class="btn btn-warning"
                                                                                                wire:click="EditarInternacion({{ $datos->id }})"><i
                                                                                                    class="bx bx-pencil"></i></button>
                                                                                        </td>

                                                                                    </tr>
                                                                                @endforeach

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    <div class="row">
                                                                        <span
                                                                            class="alert alert-success text-center">AUN
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
                                                                    style="background-color: #082338;"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapse33"
                                                                    aria-expanded="false" aria-controls="collapse"
                                                                    wire:ignore.self>
                                                                    <p
                                                                        class="tex-info bg-info text-white p-2 mb-2 rounded">
                                                                        MEDICAMENTOS ADMINISTADOS</p>
                                                                </button>
                                                            </h2>
                                                            <div class="accordion-collapse collapse" id="collapse33"
                                                                aria-labelledby="listadias_header"
                                                                data-bs-parent="#listadias33" wire:ignore.self>

                                                                <fieldset
                                                                    class="float-none w-auto border border-primary p-3 mb-3">
                                                                    <legend class="text-primary">
                                                                        MEDICAMENTOS
                                                                    </legend>
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Medicamento
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control"
                                                                                wire:model="MedicamentoMascota"
                                                                                type="text">
                                                                            @error('MedicamentoMascota')
                                                                                <div class="text-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Dosis en
                                                                                mg
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control"
                                                                                wire:model="DosisEnMgMascota"
                                                                                type="number">
                                                                            @error('DosisEnMgMascota')
                                                                                <div class="text-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Dosis en
                                                                                ml
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input class="form-control"
                                                                                wire:model="DosisEnMlMascota"
                                                                                type="number">
                                                                            @error('DosisEnMlMascota')
                                                                                <div class="text-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="form-label"> VIA
                                                                                <span
                                                                                    class="text-danger">*</span></label>

                                                                            <select class="form-select"
                                                                                wire:model="ViaMascota">
                                                                                <option value="">
                                                                                    [SELECCIONE UNA OPCIÓN]
                                                                                </option>
                                                                                <option value="IV">IV
                                                                                </option>
                                                                                <option value="IM">IM
                                                                                </option>
                                                                                <option value="SC">SC
                                                                                </option>
                                                                                <option value="VO">VO
                                                                                </option>
                                                                                <option value="VT">VT
                                                                                </option>
                                                                                <option value="COM">COM
                                                                                </option>
                                                                                <option value="OFT">OFT
                                                                                </option>
                                                                                <option value="NEBUL">NEBUL
                                                                                </option>

                                                                            </select>
                                                                            @error('ViaMascota')
                                                                                <div class="text-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label"> Hora
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                value="{{ date('H:i:s') }}"
                                                                                class="form-control"
                                                                                placeholder="Hora actual" disabled
                                                                                style="color: blue">

                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <label class="form-label">
                                                                                Administrado
                                                                                <span
                                                                                    class="text-danger">*</span></label>
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="AdministradoMascota"
                                                                                    wire:model="AdministradoMascota"
                                                                                    switch="success" />
                                                                                <label class="form-check-label"
                                                                                    for="AdministradoMascota"
                                                                                    data-on-label="SI"
                                                                                    data-off-label="NO">

                                                                                </label>
                                                                            </div>
                                                                            @error('AdministradoMascota')
                                                                                <div class="text-danger">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group row mt-4">
                                                                            <div class="col-sm-8 offset-sm-4">
                                                                                <button class="btn btn-success"
                                                                                    wire:click="GuardarMedicamentoInternacion( {{ $internacion->id }})">+Agregar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                @if (count($internacion->internacion_medicamentos) > 0)
                                                                    <div class="table-responsive mt-4">
                                                                        <table
                                                                            class="table table-hover table-bordered border-primary">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID</th>
                                                                                    <th>MEDICAMENTO</th>
                                                                                    <th>HORA</th>
                                                                                    <th>DOSIS EN MG</th>
                                                                                    <th>DOSIS EN ML</th>

                                                                                    <th>VIA</th>

                                                                                    <th>ADMINSTRADO</th>
                                                                                    <th>VETERINARIO</th>
                                                                                    <th>-----</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($internacion->internacion_medicamentos as $datos)
                                                                                    <tr>
                                                                                        <td>{{ $datos->id }}
                                                                                        </td>
                                                                                        <td>{{ $datos->Medicamento }}
                                                                                        </td>
                                                                                        <td>{{ $datos->hora }}
                                                                                        </td>
                                                                                        <td>{{ $datos->dosis_mg }}
                                                                                        </td>
                                                                                        <td>{{ $datos->dosis_ml }}
                                                                                        </td>
                                                                                        <td>{{ $datos->via }}
                                                                                        </td>

                                                                                        <td>{{ $datos->administrado }}
                                                                                        </td>
                                                                                        <td> DR.
                                                                                            {{ $datos->user->name }}
                                                                                        </td>
                                                                                        <td>
                                                                                            <button
                                                                                                class="btn btn-danger"
                                                                                                wire:click.prevent="$emit('eliminarmedicamento', {{ $datos->id }})"><i
                                                                                                    class="bx bxs-trash"></i></button>
                                                                                        </td>

                                                                                    </tr>
                                                                                @endforeach

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    <div class="row">
                                                                        <span
                                                                            class="alert alert-success text-center">AUN
                                                                            NO SE TIENE NINGUN REGISTRO</span>
                                                                    </div>
                                                                @endif

                                                                <hr>



                                                                {{-- @if (count($cirugiapreope3) > 0)
                                                                        <div class="table-responsive mt-4">
                                                                            <table
                                                                                class="table table-hover table-bordered border-primary">
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
                                                                                    @foreach ($cirugiapreope3 as $datos)
                                                                                        @if ($datos->cirugia_id == $cirugia->id)
                                                                                            <tr>
                                                                                                <td>{{ $datos->id }}
                                                                                                </td>
                                                                                                <td>{{ $datos->hora }}
                                                                                                </td>
                                                                                                <td>{{ $datos->detalle }}
                                                                                                </td>
                                                                                                <td>{{ $datos->mg }}
                                                                                                </td>
                                                                                                <td>{{ $datos->ml }}
                                                                                                </td>
                                                                                                <td>{{ $datos->via }}
                                                                                                </td>
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
                                                                            <span
                                                                                class="alert alert-success text-center">AUN
                                                                                NO SE TIENE NINGUN REGISTRO</span>
                                                                        </div>
                                                                    @endif --}}
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
                    <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Cerrar</button>
                    <button wire:click="CrearInternacion" type="button" class="btn btn-primary">Crear
                        internacion de mascota</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="nuevomodaldecaptura" data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="capturarImagenModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="capturarImagenModalLabel">Capturar Imagen</h5>
                </div>
                <div class="modal-body">
                    <!-- Contenedor de la vista previa de la cámara -->
                    <div class="border border-primary rounded   embed-responsive embed-responsive-16by9">
                        <video width="100%" height="auto" id="cameraFeedStudio" autoplay></video>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-warning mr-2"
                            wire:click="cambiarCamaratEstudio">Trasera</button>
                        <button type="button" class="btn btn-success"
                            wire:click="cambiarCamaradEstudio">Frontal</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="capturarBtnEstudio">Capturar</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="modalimagenesinternacion" data-bs-backdrop="static" class="modal fade"
        tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">

                    <div class="row">
                        <div class="text-center text-info h5">

                            IMAGENES DE INTERNACIÓN

                        </div>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        @if (count($Imagenesinternacion)>0)
                        @foreach ($Imagenesinternacion as $img)
                        <div class="col-md-6">
                            <img src="{{$img->imagen}}" alt="imagen internacion" class="img-fluid">
                        </div>
                        @endforeach
                           
                        @else
                          <div class="alert alert-warning"> NO SE TIENE REGISTRO DE IMAGENES</div>
                        @endif

                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cerrarimagenesinternacion">CERRAR</button>

                    </div>


                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->


    </div>
    @include('livewire.modal-farmacia.modalfarmacia')
    @include('livewire.modal-cirugia.modalcirugiapre')
    @include('livewire.modal-cirugia.modalcirugia')
    @include('livewire.modal-cirugia.modalcirugiaimagenes')
    @include('livewire.modal-estudio.modalestudio')

</div>


@push('navi-js')
    <script src="{{ asset('JSNAVI/clientes.js') }}"></script>
    <script src="{{ asset('JSNAVI/cirugias.js') }}"></script>
    <script src="{{ asset('JSNAVI/farmacias.js') }}"></script>
    <script>
        document.addEventListener('livewire:load', function() {


            Livewire.on('abrirmodalimageninter', function() {
                $('#modalimagenesinternacion').modal('show');
            });
            Livewire.on('cerrarmodalimageninter', function() {
                $('#modalimagenesinternacion').modal('hide');
            });

        });
        livewire.on('borrarinternacion', id_dato => {
            Swal.fire({
                title: 'Esta seguro/segura ?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('borrarinternacionn', id_dato);
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su registro  esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });
        livewire.on('eliminarmedicamento', id_dato => {
            Swal.fire({
                title: 'Esta seguro/segura ?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('eliminarmedicamentoo', id_dato);
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su registro  esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });

        livewire.on('borrar_internacion', id_dato => {
            Swal.fire({
                title: 'Esta seguro/segura ?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('borrardatosinternacion', id_dato);
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su registro  esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });
        Livewire.on('crearcaja', function() {
            Swal.fire({
                title: '¿Está seguro/segura?',
                text: "¡Solo el encargado de turno puede hacer la apertura de caja!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, abrir caja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('crearcajanuevo');
                    // Swal.fire(
                    //     'Eliminado!',
                    //     'El registro ha sido eliminado.',
                    //     'success'cerrarcaja
                    // )
                } else {
                    // Swal.fire({
                    //     title: 'Su registro está seguro...',
                    //     icon: 'info',
                    // })
                }
            })
        });
        Livewire.on('cerrarcaja', function() {
            Swal.fire({
                title: '¿Está seguro/segura?',
                text: "¡Solo el encargado de turno puede hacer la apertura de caja!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, cerrar caja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('cerrarcajaanterior');
                    // Swal.fire(
                    //     'Eliminado!',
                    //     'El registro ha sido eliminado.',
                    //     'success'cerrarcaja
                    // )
                } else {
                    // Swal.fire({
                    //     title: 'Su registro está seguro...',
                    //     icon: 'info',
                    // })
                }
            })
        });
        document.addEventListener('livewire:load', function() {

            Livewire.on('ReconocerDiagnostico', function() {

                let recognition = new webkitSpeechRecognition();
                let caja = document.getElementById("contenedor-diagnostico");
                recognition.lang = 'es-ES';

                recognition.onresult = function(event) {
                    for (let result of event.results) {
                        let texto = result[0].transcript;
                        caja.value = texto;
                        Livewire.emit('resultadoReconocimientoDiagnostico', texto);
                    }
                };

                recognition.start();

            });



        });
        document.addEventListener('livewire:load', function() {

            Livewire.on('ReconocerRecomendaciones', function() {

                let recognition = new webkitSpeechRecognition();
                let caja = document.getElementById("contenedor-recomendaciones");
                recognition.lang = 'es-ES';

                recognition.onresult = function(event) {
                    for (let result of event.results) {
                        let texto = result[0].transcript;
                        caja.value = texto;
                        Livewire.emit('resultadoReconocimientoRecomendacione', texto);
                    }
                };

                recognition.start();

            });



        });
    </script>
@endpush
