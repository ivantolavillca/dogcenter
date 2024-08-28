<div>



    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓN DE MASCOTA : <span class="text-danger">
                        {{ $mascota_actual->nombre }}</span></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('clientes') }}">Clientes</a></li>
                        <li class="breadcrumb-item active">Mascotas</li>
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
                        {{-- <div class="text-center ">
                            <h2><b class="text-primary"><i class="fas fa-user"></i> CLIENTE:
                                    {{ $cliente_actual->nombre }}
                                    {{ $cliente_actual->apellidos }}<br><i class="fas fa-cat"></i>MASCOTA:
                                    {{ $mascota_actual->nombre }}</b></h2>
                        </div> --}}


                        {{-- @if ($historial_eutanacia)
                        @endif
                        <div class="text-center ">
                            <h2><b class="text-primary"><i class="fas fa-user"></i> CLIENTE:
                                    {{ $cliente_actual->nombre }}
                                    {{ $cliente_actual->apellidos }}<br><i class="fas fa-cat"></i>MASCOTA:
                                    {{ $mascota_actual->nombre }}</b></h2>
                        </div>
                        <div class="align-items-start">
                            <button class="btn btn-success" wire:click="crearhistorial"
                                @if ($historial_eutanacia) disabled @endif>
                                <i class="far fa-folder"></i> HISTORIAL CLINICO
                            </button>
                            <button class="btn btn-primary" wire:click="crearestudiocomplementario"
                                @if ($historial_eutanacia) disabled @endif>

                                <i class="fas fa-file-alt"></i> ESTUDIO COMPLEMENTARIO
                            </button>
                            <button class="btn btn-info" wire:click="crearinternacion"
                                @if ($historial_eutanacia) disabled @endif>

                                <i class="far fa-hospital"></i> INTERNACIÓN
                            </button>
                            <div class="btn-group" role="group">
                                <button id="botonesdeotros" type="button" class="btn btn-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    @if ($historial_eutanacia) disabled @endif>
                                    OTROS <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu " aria-labelledby="botonesdeotros">
                                    <button class="dropdown-item" wire:click="crearfichaclinica">AGREGAR FICHA CLINICA
                                        DE
                                        CIRUGIA</button>
                                    <button class="dropdown-item" wire:click="crearrecomendacionesoperatorias">AGREGAR
                                        RECOMENDACIÓNES
                                        OPERATORIAS</button>
                                    <button class="dropdown-item" wire:click="crearconcentimientoinformado">AGREGAR
                                        CONCENTIMIENTO
                                        INFORMADO</button>
                                    <button class="dropdown-item" wire:click="crearautorizaciondesedacion">AGREGAR
                                        AUTORIZACIÓN DE
                                        SEDACIÓN</button>
                                </div>
                            </div>


                            <a class="btn btn-warning" href="{{ route('derivar', $mascota) }}" target="_blank">

                                <i class="fas fa-shipping-fast"></i> DERIVACIÓN
                            </a>
                            <button class="btn btn-success"wire:click="creareutanacia"
                                @if ($historial_eutanacia) disabled @endif>
                                <i class="fas fa-window-close"></i> EUTANACIA
                            </button>
                            <a class="btn btn-danger  fas fa-arrow-left"href="{{ route('clientes') }}">
                                IR A CLIENTES
                            </a>
                        </div> --}}
                        <br>


                        <div class="col-12 row">
                            <div class="col-12 col-md-12 text-end">
                                {{-- <label for="gestiones" class="form-label">Buscar: </label>
                                <input type="text" class="form-control" wire:model="search"> --}}
                                <button wire:click="VerVacunas" class="btn btn-info">Ver Vacunas y
                                    Desparacitaciones</button>
                                <button wire:click="vercirugias" class="btn btn-info">Ver Cirugias</button>
                                {{-- <a class="btn btn-warning" href="{{ route('derivar', $mascota) }}" target="_blank">

                                    <i class="fas fa-shipping-fast"></i> DERIVACIÓN
                                </a> --}}
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        DERIVACIÓN <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('derivar', $mascota) }}" target="_blank">DERIVACIÓN Y ESTUDIOS CON TIPO IMAGEN</a>
                                        <span class="dropdown-item text-center text-primary">  DERIVAR ESTUDIOS EN PDF </span> 
                                       @foreach ($historiales as $historial)
                                           @if ($historial->tipo_historial_id == 2)
                                           @if (count($historial->fotosestudio) > 0)
                                           @php
                                               $showCarousel = true;
                                               foreach ($historial->fotosestudio as $imagen) {
                                                   if (str_ends_with($imagen->imagen, '.pdf')) {
                                                       $showCarousel = false;
                                                       break;
                                                   }
                                               }
                                           @endphp
                                           @if (!$showCarousel)
                                             
                                          
                                             
                                               @foreach ($historial->fotosestudio as $imagen)
                                                   {{-- <embed src="{{ $imagen->imagen }}"
                                                       type="application/pdf" width="100%"
                                                       height="600px" /> --}}
                                                       <a class="dropdown-item" href="{{ $imagen->imagen }}" target="_blank">{{strtoupper( $historial->historial_estudio->nombre )}} - {{ \Carbon\Carbon::parse($historial->created_at)->isoFormat('LL') }} </a>
                                               @endforeach
                                           @endif
                                       @else
                                       
                                       @endif
                                           @endif
                                       @endforeach
                                        
                                    </div>
                                </div>
                                <button wire:click="reporteunicoregistro({{ $mascota_actual->mascotas_clientes->id }})"
                                    class="btn btn-primary">Atrás</button>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <hr>
                            @if ($historial_eutanacia)
                                <div class="alert alert-info text-center">
                                    LA MASCOTA ACTUALMENTE SE ENCUENTRA CON EUTANACIA <br>
                                    {{ $historial_eutanacia->informe_de_eutanacia }} -
                                    {{ $historial_eutanacia->fecha_de_eutanacia }}
                                </div>
                            @endif

                        </div>
                        @if (count($historiales) > 0)
                            <div class="row col-md-12">

                                @foreach ($historiales as $historial)
                                    @if ($historial->tipo_historial_id == 1)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        CONSULTA DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }} </b>
                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        <ul class="list-group col-md-12 border-2">
                                                            <li
                                                                class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-notes-medical "></i> <b>
                                                                        MOTIVO DE ATENCIÓN</b> <br>
                                                                    <span
                                                                        class="text-success">{{ $historial->motivo_atencion }}</span>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-notes-medical "></i> <b>
                                                                        ANAMENSIS</b> <br>
                                                                    <span
                                                                        class="text-success">{{ $historial->anamensis }}</span>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-grin-beam "></i>
                                                                    <b>ESPECIE</b>
                                                                    <br>
                                                                    <span>{{ $historial->historial_clinico_mascotas->mascotas_especies->nombre }}</span>
                                                                </div>
                                                                <div> <b>RAZA</b> <br>
                                                                    {{ $historial->historial_clinico_mascotas->mascotas_razas->nombre }}
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-grin-beam "></i>
                                                                    <b>SEXO</b>
                                                                    <br>
                                                                    <span>{{ $historial->historial_clinico_mascotas->sexo }}</span>
                                                                </div>
                                                                <div> <b>EDAD</b> <br>
                                                                    {{ $historial->historial_clinico_mascotas->edad_mascota }}
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-grin-beam "></i>
                                                                    <b>ACTITUD</b>
                                                                    <br>
                                                                    <span>{{ $historial->actitud }}</span>
                                                                </div>
                                                                <div> <b>PRECIO</b> <br>
                                                                    $ {{ $historial->precio }} Bs.
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-hippo"></i> <b>TLLC:</b> <br>
                                                                    <span>{{ $historial->tllc }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CONDUCTA:</b> <br>
                                                                    <span>{{ $historial->conducta }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-mortar-pestle"></i> <b>ESTADO
                                                                        NUTRICIONAL:</b> <br>
                                                                    <span>{{ $historial->esta_nutricional }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>MM:</b> <br>
                                                                    <span>{{ $historial->mm }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fab fa-shopware"></i> <b>CONST V
                                                                        FC:</b> <br>
                                                                    <span>{{ $historial->const_v_fc }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CONST V FR:</b> <br>
                                                                    <span>{{ $historial->const_v_fr }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-temperature-high"></i>
                                                                    <b>CONST V
                                                                        TEMPERATURA:</b> <br>
                                                                    <span>{{ $historial->const_v_t }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CAPA DE PIEL:</b> <br>
                                                                    <span>{{ $historial->capa_piel }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>CONST V
                                                                        FC:</b> <br>
                                                                    <span>{{ $historial->const_v_fc }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CONST V FR:</b> <br>
                                                                    <span>{{ $historial->const_v_fr }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>PAST
                                                                        :</b> <br>
                                                                    <span>{{ $historial->Past }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>PAD:</b> <br>
                                                                    <span>{{ $historial->Pad }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>PAM
                                                                        :</b> <br>
                                                                    <span>{{ $historial->Pam }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>PULSO:</b> <br>
                                                                    <span>{{ $historial->Pulso }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>DHT
                                                                        :</b> <br>
                                                                    <span>{{ $historial->Dht }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>PESO:</b> <br>
                                                                    <span>{{ $historial->Peso }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i>
                                                                    <b>RECOMENDACION
                                                                        :</b> <br>
                                                                    <span>{{ $historial->recomendacion }}</span>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i>
                                                                    <b>DIAGNOSTICO
                                                                        :</b> <br>
                                                                    <span>{{ $historial->diagnostico }}</span>
                                                                </div>
                                                            </li>
                                                            <li class="justify-content-center">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            {{-- <p class="mb-0 text-secondary">REPORTE</p>



                                                                            <button class="btn btn-sm btn-success">
                                                                                IMPRIMIR REPORTE</button> --}}


                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 border-start border-0 border-2">
                                                                            <p class="mb-0 text-secondary">ACCIÓN </p>
                                                                            <button class="btn btn-danger"
                                                                                wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                                    class="bx bxs-trash"></i></button>
                                                                            <button class="btn btn-warning"
                                                                                wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                                    class="bx bx-pencil"></i></button>
                                                                            {{-- <button class="btn btn-warning"
                                                                                wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                                    class="bx bx-pencil"></i></button> --}}
                                                                            {{-- @php
                                                                                $estado_habilitado_new = false;

                                                                                foreach (
                                                                                    $historial->historial_tratamientos
                                                                                    as $valuee
                                                                                ) {
                                                                                    if ($valuee->estado == 'activo') {
                                                                                        $estado_habilitado_new = true;
                                                                                        break;
                                                                                    }
                                                                                }

                                                                            @endphp --}}
                                                                            {{-- @if ($estado_habilitado_new == true)
                                                                                <button class="btn btn-info"
                                                                                    wire:click="ver_tratamientos({{ $historial->id }})"><i
                                                                                        class="fas fa-list-ul"></i>
                                                                                    TRATAMIENTO </button>
                                                                            @else --}}
                                                                            <button class="btn btn-info"
                                                                                wire:click="VerTratamientos({{ $historial->id }})"><i
                                                                                    class="fas fa-list-ul"></i>
                                                                                TRATAMIENTO </button>
                                                                            {{-- @endif --}}


                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-xs-12">
                                                                            <div class="col-md-12">
                                                                                <p class="mb-0 text-secondary">FECHA DE
                                                                                    CREACIÓN</p>
                                                                                <h6 class="my-1"><i
                                                                                        class="bx "></i>{{ $historial->created_at }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-12">
                                                                            <div class="col-md-12">
                                                                                <p class="mb-0 text-secondary">DOCTOR
                                                                                    QUE ATENDIÓ AL PACIENTE</p>
                                                                                <h6 class="my-1"><i
                                                                                        class="bx "></i>{{ $historial->historial_user->name }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    @elseif ($historial->tipo_historial_id == 10)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        RECONSULTA DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }} </b>
                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        <ul class="list-group col-md-12 border-2">
                                                            <li
                                                                class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-notes-medical "></i> <b>
                                                                        MOTIVO DE ATENCIÓN</b> <br>
                                                                    <span
                                                                        class="text-success">{{ $historial->motivo_atencion }}</span>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-notes-medical "></i> <b>
                                                                        ANAMENSIS</b> <br>
                                                                    <span
                                                                        class="text-success">{{ $historial->anamensis }}</span>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-grin-beam "></i>
                                                                    <b>ESPECIE</b>
                                                                    <br>
                                                                    <span>{{ $historial->historial_clinico_mascotas->mascotas_especies->nombre }}</span>
                                                                </div>
                                                                <div> <b>RAZA</b> <br>
                                                                    {{ $historial->historial_clinico_mascotas->mascotas_razas->nombre }}
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-grin-beam "></i>
                                                                    <b>SEXO</b>
                                                                    <br>
                                                                    <span>{{ $historial->historial_clinico_mascotas->sexo }}</span>
                                                                </div>
                                                                <div> <b>EDAD</b> <br>
                                                                    {{ $historial->historial_clinico_mascotas->edad_mascota }}
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-grin-beam "></i>
                                                                    <b>ACTITUD</b>
                                                                    <br>
                                                                    <span>{{ $historial->actitud }}</span>
                                                                </div>
                                                                <div> <b>PRECIO</b> <br>
                                                                    $ {{ $historial->precio }} Bs.
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-hippo"></i> <b>TLLC:</b> <br>
                                                                    <span>{{ $historial->tllc }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CONDUCTA:</b> <br>
                                                                    <span>{{ $historial->conducta }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-mortar-pestle"></i> <b>ESTADO
                                                                        NUTRICIONAL:</b> <br>
                                                                    <span>{{ $historial->esta_nutricional }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>MM:</b> <br>
                                                                    <span>{{ $historial->mm }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fab fa-shopware"></i> <b>CONST V
                                                                        FC:</b> <br>
                                                                    <span>{{ $historial->const_v_fc }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CONST V FR:</b> <br>
                                                                    <span>{{ $historial->const_v_fr }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-temperature-high"></i>
                                                                    <b>CONST V
                                                                        TEMPERATURA:</b> <br>
                                                                    <span>{{ $historial->const_v_t }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CAPA DE PIEL:</b> <br>
                                                                    <span>{{ $historial->capa_piel }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>CONST V
                                                                        FC:</b> <br>
                                                                    <span>{{ $historial->const_v_fc }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>CONST V FR:</b> <br>
                                                                    <span>{{ $historial->const_v_fr }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>PAST
                                                                        :</b> <br>
                                                                    <span>{{ $historial->Past }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>PAD:</b> <br>
                                                                    <span>{{ $historial->Pad }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>PAM
                                                                        :</b> <br>
                                                                    <span>{{ $historial->Pam }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>PULSO:</b> <br>
                                                                    <span>{{ $historial->Pulso }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i> <b>DHT
                                                                        :</b> <br>
                                                                    <span>{{ $historial->Dht }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>PESO:</b> <br>
                                                                    <span>{{ $historial->Peso }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 bx bxs-wallet-alt"></i>
                                                                    <b>RECOMENDACION
                                                                        :</b> <br>
                                                                    <span>{{ $historial->recomendacion }}</span>
                                                                </div>
                                                            </li>
                                                            <li class="justify-content-center">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            {{-- <p class="mb-0 text-secondary">REPORTE</p>



                                                                        <button class="btn btn-sm btn-success">
                                                                            IMPRIMIR REPORTE</button> --}}


                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 border-start border-0 border-2">
                                                                            <p class="mb-0 text-secondary">ACCIÓN </p>
                                                                            <button class="btn btn-danger"
                                                                                wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                                    class="bx bxs-trash"></i></button>
                                                                            <button class="btn btn-warning"
                                                                                wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                                    class="bx bx-pencil"></i></button>
                                                                            {{-- <button class="btn btn-warning"
                                                                            wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                                class="bx bx-pencil"></i></button> --}}
                                                                            {{-- @php
                                                                            $estado_habilitado_new = false;

                                                                            foreach (
                                                                                $historial->historial_tratamientos
                                                                                as $valuee
                                                                            ) {
                                                                                if ($valuee->estado == 'activo') {
                                                                                    $estado_habilitado_new = true;
                                                                                    break;
                                                                                }
                                                                            }

                                                                        @endphp --}}
                                                                            {{-- @if ($estado_habilitado_new == true)
                                                                            <button class="btn btn-info"
                                                                                wire:click="ver_tratamientos({{ $historial->id }})"><i
                                                                                    class="fas fa-list-ul"></i>
                                                                                TRATAMIENTO </button>
                                                                        @else --}}
                                                                            <button class="btn btn-info"
                                                                                wire:click="VerTratamientos({{ $historial->id }})"><i
                                                                                    class="fas fa-list-ul"></i>
                                                                                TRATAMIENTO </button>
                                                                            {{-- @endif --}}


                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-md-12 ">
                                                                        <p class="mb-0 text-secondary">FECHA DE
                                                                            CREACIÓN
                                                                        </p>
                                                                        <h6 class="my-1"><i class="bx "></i>
                                                                            {{ $historial->created_at }}</h6>

                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        <div class="col-md-12">
                                                                            <p class="mb-0 text-secondary">DOCTOR
                                                                                QUE ATENDIÓ AL PACIENTE</p>
                                                                            <h6 class="my-1"><i
                                                                                    class="bx "></i>{{ $historial->historial_user->name }}
                                                                            </h6>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    @elseif($historial->tipo_historial_id == 2)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        HISTORIAL DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }} -

                                                        </b>
                                                        @if ($historial->historial_estudio)
                                                            {{ $historial->historial_estudio->nombre }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        @if (count($historial->fotosestudio) > 0)
                                                            @php
                                                                $showCarousel = true;
                                                                foreach ($historial->fotosestudio as $imagen) {
                                                                    if (str_ends_with($imagen->imagen, '.pdf')) {
                                                                        $showCarousel = false;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($showCarousel)
                                                                <div id="carucelfotosestudios{{ $historial->id }}"
                                                                    class="carousel slide carousel-fade"
                                                                    data-bs-ride="carousel">
                                                                    <ol class="carousel-indicators">
                                                                        @foreach ($historial->fotosestudio as $index => $imagen)
                                                                            <li data-bs-target="#carucelfotosestudios{{ $historial->id }}"
                                                                                data-bs-slide-to="{{ $index }}"
                                                                                class="@if ($loop->first) active @endif">
                                                                            </li>
                                                                        @endforeach


                                                                    </ol>
                                                                    <div class="carousel-inner">
                                                                        @foreach ($historial->fotosestudio as $index => $imagen)
                                                                            <div
                                                                                class="carousel-item @if ($loop->first) active @endif">
                                                                                <img class="d-block img-fluid"
                                                                                    src="{{ $imagen->imagen }}"
                                                                                    alt="First slide">
                                                                                <div
                                                                                    class="carousel-caption d-none d-md-block text-white-50">
                                                                                    {{-- <button class="btn btn-success"> <i
                                                                                            class="far fa-file-pdf"></i></button> --}}
                                                                                    <button class="btn btn-danger" title="ELIMINAR IMAGEN"
                                                                                        wire:click.prevent="$emit('borrarimagen', {{ $imagen->id }})">
                                                                                        <i
                                                                                            class="bx bxs-trash"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-center">

                                                                            </div>
                                                                        @endforeach



                                                                    </div>
                                                                    <a class="carousel-control-prev"
                                                                        href="#carucelfotosestudios{{ $historial->id }}"
                                                                        role="button" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon"
                                                                            aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </a>
                                                                    <a class="carousel-control-next"
                                                                        href="#carucelfotosestudios{{ $historial->id }}"
                                                                        role="button" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon"
                                                                            aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                @foreach ($historial->fotosestudio as $imagen)
                                                                    <embed src="{{ $imagen->imagen }}"
                                                                        type="application/pdf" width="100%"
                                                                        height="600px" />
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            @if ($historial->imagen_pdf_estudio_complementario)
                                                                @if (str_ends_with($historial->imagen_pdf_estudio_complementario, '.pdf'))
                                                                    <embed
                                                                        src="{{ asset($historial->imagen_pdf_estudio_complementario) }}"
                                                                        type="application/pdf" width="100%"
                                                                        height="600px">
                                                                @else
                                                                    <img src="{{ asset($historial->imagen_pdf_estudio_complementario) }}"
                                                                        alt="Estudio complementario">
                                                                @endif
                                                            @else
                                                                sin imagen
                                                            @endif
                                                        @endif



                                                    </div>
                                                    <ul class="list-group col-md-12 border-2">
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>COMENTARIO</b> <br>
                                                                <span>
                                                                    {{ $historial->comentario_estudio }}
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>PRECIO</b> <br>
                                                                <span>
                                                                    Bs. {{ $historial->precio }}
                                                                </span>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>ACCIONES</b> <br>
                                                                <hr class="border-start border">
                                                                {{-- <span class="text-danger">boton de editar en
                                                                    mantenimiento</span> --}}
                                                                <br>
                                                                <button class="btn btn-outline-danger" title="BORRAR ESTUDIO REALIZADO"
                                                                    wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                        class="bx bxs-trash"></i></button>

                                                                <button class="btn btn-outline-warning"
                                                                    wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                        class="bx bx-pencil"></i></button>
                                                                @if (count($historial->fotosestudio) > 0)
                                                                    @php
                                                                        $showCarousel = true;
                                                                        foreach ($historial->fotosestudio as $imagen) {
                                                                            if (
                                                                                str_ends_with($imagen->imagen, '.pdf')
                                                                            ) {
                                                                                $showCarousel = false;
                                                                                break;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if ($showCarousel)
                                                                        <a class="btn btn-outline-success"
                                                                            target="_blank"
                                                                            href="{{ route('reporte_estudio_complementario', $historial->id) }}">
                                                                            <i class="far fa-file-pdf"></i>
                                                                        </a>
                                                                    @else
                                                                        <a class="btn btn-outline-success"
                                                                            target="_blank"
                                                                            href="{{ $historial->fotosestudio[0]->imagen }}">
                                                                            <i class="far fa-file-pdf"></i>
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    @if (str_ends_with($historial->imagen_pdf_estudio_complementario, '.pdf'))
                                                                        <a class="btn btn-outline-success"
                                                                            target="_blank"
                                                                            href="{{ $historial->imagen_pdf_estudio_complementario }}">
                                                                            <i class="far fa-file-pdf"></i>
                                                                        </a>
                                                                    @else
                                                                        <a class="btn btn-outline-success"
                                                                            target="_blank"
                                                                            href="{{ route('reporte_estudio_complementario', $historial->id) }}">
                                                                            <i class="far fa-file-pdf"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif



                                                            </div>
                                                        </li>

                                                    </ul>
                                                    <div class="col-md-6 col-xs-12">
                                                        <div class="col-md-12">
                                                            <p class="mb-0 text-secondary">DOCTOR
                                                                QUE ATENDIÓ AL PACIENTE</p>
                                                            <h6 class="my-1"><i class="bx "></i>
                                                                @if ($historial->historial_user)
                                                                    {{ $historial->historial_user->name }}
                                                                @endif

                                                            </h6>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    @elseif($historial->tipo_historial_id == 3)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        HISTORIAL DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }} </b>
                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        <ul class="list-group col-md-12 border-2">


                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-hippo"></i> <b>PESO:</b> <br>
                                                                    <span>{{ $historial->peso_internacion }}</span>
                                                                </div>
                                                                <div>
                                                                    <b>FECHA DE INTERNACIÓN:</b> <br>
                                                                    <span>{{ $historial->fecha_ingreso_internacion }}</span>
                                                                </div>

                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                                <div>
                                                                    <i class="fs-6 fas fa-hippo"></i> <b>REPORTE:</b>
                                                                    <br>

                                                                    <button class="btn btn-sm btn-success">
                                                                        IMPRIMIR REPORTE</button>
                                                                </div>
                                                                <div>
                                                                    <b>ACCIÓN:</b> <br>
                                                                    <button class="btn btn-danger"
                                                                        wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                            class="bx bxs-trash"></i></button>
                                                                    <button class="btn btn-warning"
                                                                        wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                            class="bx bx-pencil"></i></button>
                                                                    @php
                                                                        $estado_habilitado = false;

                                                                        foreach (
                                                                            $historial->historial_tratamientos_internacion
                                                                            as $value
                                                                        ) {
                                                                            if ($value->estado == 'activo') {
                                                                                $estado_habilitado = true;
                                                                                break;
                                                                            }
                                                                        }

                                                                    @endphp
                                                                    @if ($estado_habilitado == true)
                                                                        <button class="btn btn-info"
                                                                            wire:click="ver_tratamientos_internacion({{ $historial->id }})"><i
                                                                                class="fas fa-list-ul"></i>
                                                                            TRATAMIENTO </button>
                                                                    @else
                                                                        <button class="btn btn-info"
                                                                            wire:click="crear_tratamiento_internacion({{ $historial->id }})"><i
                                                                                class="fas fa-list-ul"></i>CREAR
                                                                            TRATAMIENTO </button>
                                                                    @endif



                                                                </div>

                                                            </li>


                                                        </ul>

                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    @elseif($historial->tipo_historial_id == 4)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        HISTORIAL DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }}

                                                        </b>

                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        @if (str_ends_with($historial->imagen_pdf_ficha_clinica_cirugia, '.pdf'))
                                                            <embed
                                                                src="{{ asset($historial->imagen_pdf_ficha_clinica_cirugia) }}"
                                                                type="application/pdf" width="100%" height="600px">
                                                        @else
                                                            <img src="{{ asset($historial->imagen_pdf_ficha_clinica_cirugia) }}"
                                                                alt="Estudio complementario">
                                                        @endif


                                                    </div>
                                                    <ul class="list-group col-md-12 border-2">
                                                        <li
                                                            class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>ACCIONES</b> <br>
                                                                <hr class="border-start border">
                                                                <button class="btn btn-outline-danger"
                                                                    wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                        class="bx bxs-trash"></i></button>
                                                                <button class="btn btn-outline-warning"
                                                                    wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                        class="bx bx-pencil"></i></button>

                                                            </div>
                                                        </li>


                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    @elseif($historial->tipo_historial_id == 5)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        HISTORIAL DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }}

                                                        </b>

                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        @if (str_ends_with($historial->imagen_pdf_recomendaciones_operatorias, '.pdf'))
                                                            <embed
                                                                src="{{ asset($historial->imagen_pdf_recomendaciones_operatorias) }}"
                                                                type="application/pdf" width="100%" height="600px">
                                                        @else
                                                            <img src="{{ asset($historial->imagen_pdf_recomendaciones_operatorias) }}"
                                                                alt="Estudio complementario">
                                                        @endif


                                                    </div>
                                                    <ul class="list-group col-md-12 border-2">
                                                        <li
                                                            class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>ACCIONES</b> <br>
                                                                <hr class="border-start border">
                                                                <button class="btn btn-outline-danger"
                                                                    wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                        class="bx bxs-trash"></i></button>
                                                                <button class="btn btn-outline-warning"
                                                                    wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                        class="bx bx-pencil"></i></button>

                                                            </div>
                                                        </li>


                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    @elseif($historial->tipo_historial_id == 6)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        HISTORIAL DE {{ strtoupper($mascota_actual->nombre) }}

                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }}

                                                        </b>

                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        @if (str_ends_with($historial->imagen_pdf_concentimiento_infomado, '.pdf'))
                                                            <embed
                                                                src="{{ asset($historial->imagen_pdf_concentimiento_infomado) }}"
                                                                type="application/pdf" width="100%" height="600px">
                                                        @else
                                                            <img src="{{ asset($historial->imagen_pdf_concentimiento_infomado) }}"
                                                                alt="Estudio complementario">
                                                        @endif


                                                    </div>
                                                    <ul class="list-group col-md-12 border-2">
                                                        <li
                                                            class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>ACCIONES</b> <br>
                                                                <hr class="border-start border">
                                                                <button class="btn btn-outline-danger"
                                                                    wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                        class="bx bxs-trash"></i></button>
                                                                <button class="btn btn-outline-warning"
                                                                    wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                        class="bx bx-pencil"></i></button>
                                                                <button class="btn btn-sm btn-success">
                                                                    IMPRIMIR REPORTE</button>
                                                            </div>
                                                        </li>


                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    @elseif($historial->tipo_historial_id == 7)
                                        <div class="col-md-6">
                                            <div class="card radius-10 border-start border-1 border-5 border-info "
                                                style="border-width: 1px 1px 1px 7px;">
                                                <div class="card-header">
                                                    <div class="float-start bg-info text-white m-0 p-1"><b>N
                                                            {{ $historial->id }}</b></div>
                                                    <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                                        HISTORIAL DE {{ strtoupper($mascota_actual->nombre) }}
                                                    </h4>
                                                    <span class="d-block text-center text-secondary">
                                                        <b>{{ $historial->hitorialtipohistorial->nombre }}

                                                        </b>

                                                    </span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center row g-3">
                                                        @if (str_ends_with($historial->imagen_pdf_autorizacion_de_sedacion, '.pdf'))
                                                            <embed
                                                                src="{{ asset($historial->imagen_pdf_autorizacion_de_sedacion) }}"
                                                                type="application/pdf" width="100%" height="600px">
                                                        @else
                                                            <img src="{{ asset($historial->imagen_pdf_autorizacion_de_sedacion) }}"
                                                                alt="Estudio complementario">
                                                        @endif


                                                    </div>
                                                    <ul class="list-group col-md-12 border-2">
                                                        <li
                                                            class="list-group-item d-flex justify-content-center align-items-center text-secondary">
                                                            <div>
                                                                <i class="fas fa-asterisk"></i> <b>ACCIONES</b> <br>
                                                                <hr class="border-start border">
                                                                <button class="btn btn-outline-danger"
                                                                    wire:click.prevent="$emit('borrar_history', {{ $historial->id }})"><i
                                                                        class="bx bxs-trash"></i></button>
                                                                <button class="btn btn-outline-warning"
                                                                    wire:click="EditarHistorial({{ $historial->id }})"><i
                                                                        class="bx bx-pencil"></i></button>

                                                            </div>
                                                        </li>


                                                    </ul>

                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="row text-center">
                                {{ $historiales->links() }}
                            </div>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show text-center " role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>AUN NO SE TIENE NINGUN REGISTRO DE HISTORIAL!
                                <button class="btn btn-success" wire:click="reporteunicoregistro({{ $mascota_actual->mascotas_clientes->id }})">#
                                    CREAR HISTORIAL </button>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                                </button>
                            </div>
                        @endif

                        </hr>

                    </div>

                </div>

                <div wire:ignore.self id="modalcrearhistorial" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
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

                                                <button class="btn btn-primary"
                                                    wire:click="comenzarReconocimientoAnamensis"><i
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
                                            <input type="text" class="form-control" wire:model="Raza"
                                                style="color: #005AA7" disabled
                                                placeholder="Ingrese el tiempo de llenado capilar">
                                            @error('Raza')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Sexo:</label>
                                            <input type="text" class="form-control" wire:model="Sexo"
                                                style="color: #005AA7" disabled
                                                placeholder="Ingrese el tiempo de llenado capilar">
                                            @error('Sexo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Edad:</label>
                                            <input type="text" class="form-control" wire:model="Edad" disabled
                                                style="color: #005AA7"
                                                placeholder="Ingrese el tiempo de llenado capilar">
                                            @error('Edad')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Tllc:</label>
                                            <input type="text" class="form-control" wire:model="TllcMascota"
                                                maxlength="5" placeholder="Ingrese el tiempo de llenado capilar">
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
                                                <input type="text" class="form-control mt-2"
                                                    placeholder="Ingrese otra opción"
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
                                                <option value="Enfermedad / Tratamiento">Enfermedad / Tratamiento
                                                </option>
                                                <option value="Cachorro / Crecimiento">Cachorro / Crecimiento</option>
                                                <option value="otros">Otra opción</option>
                                            </select>
                                            @error('EstadoNutricionalDeMascota')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @if ($EstadoNutricionalDeMascota === 'otros')
                                                <input type="text" class="form-control mt-2"
                                                    placeholder="Ingrese otra opción"
                                                    wire:model="EstadoNutricionalDeMascotaOtraOpcion">
                                                @error('EstadoNutricionalDeMascotaOtraOpcion')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            @endif

                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">MM :</label>
                                            <input type="text" class="form-control" wire:model="MmDeMascota"
                                                maxlength="5">
                                            @error('MmDeMascota')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Constante vital FC :</label>
                                            <input type="text" class="form-control"
                                                wire:model="ConstanteVitalFcDeMascota"
                                                placeholder="Frecuencia cardiaca (pul o lat/min)
                            (ppm/lpm)"
                                                maxlength="10">
                                            @error('ConstanteVitalFcDeMascota')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Constante vital FR :</label>
                                            <input type="text" class="form-control"
                                                wire:model="ConstanteVitalFrDeMascota"
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
                                            <input type="text" class="form-control" wire:model="Past"
                                                maxlength="5">
                                            @error('Past')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">PAD :</label>
                                            <input type="text" class="form-control" wire:model="Pad"
                                                placeholder=" " maxlength="10">
                                            @error('Pad')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">PAM:</label>
                                            <input type="text" class="form-control" wire:model="Pam"
                                                placeholder="" maxlength="10">
                                            @error('Pam')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">PULSO :</label>
                                            <input type="text" class="form-control" wire:model="PulsoDeLaMascota"
                                                placeholder="" maxlength="10">
                                            @error('PulsoDeLaMascota')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">DHT:</label>
                                            <input type="text" class="form-control" wire:model="Dht"
                                                placeholder="" maxlength="10">
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
                                                    wire:model="OtraCapaDePielDeMascota"
                                                    placeholder="Ingrese otra opción">
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
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="alert" aria-label="Close">

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
                                                {{-- <option value="nuevo" selected style="color: #005AA7">DESEA CREAR UN
                                                    NUEVO TIPO
                                                    DE ESTUDIO?</option> --}}

                                                @foreach ($estudios_complemetarios as $estudios)
                                                    <option value="{{ $estudios->id }}">{{ $estudios->nombre }}
                                                    </option>
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



                                        <div class="col-md-4">
                                            <label class="form-label">Precio del Estudio Realizado:</label>
                                            <input type="number" class="form-control" wire:model="Precio"
                                                placeholder="Ingrese el precio del historial">
                                            @error('Precio')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-{{ $historial_id_selected ? '4' : '4' }}">
                                            <label class="form-label">Ingrese una
                                                {{ $historial_id_selected ? 'nueva ' : '' }} imagen </label>
                                            <select class="form-select" wire:model='SeleccionTipoDeArchivo' @if ($banseraEstudio==2) disabled @endif >
                                               
                                                <option value="">[Seleccione una opción]</option>
                                                @if ($banseraEstudio==2)  <option value="pdf">Subir un Archivo Pdf</option> @endif
                                               
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
                                                        <label class="form-label"> Debe seleccionar el archivo imagen
                                                            que
                                                            desea
                                                            añadir al estudio complementario <span
                                                                class="text-danger">Tamaño: 600 X 800
                                                                Pixeles</span></label>
                                                    @endif
                                                    @if ($SeleccionTipoDeArchivo == 'pdf')
                                                        <input type="file" class="form-control" accept=".pdf"
                                                            wire:model="ArchivoDelEstudio">
                                                    @elseif($SeleccionTipoDeArchivo == 'imagen')
                                                        <input type="file" class="form-control"
                                                            accept=".jpg,.png,.jpeg"
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
                                                    @error('ArchivoDelEstudio')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                                                    <div class="col-md-12">
                                                        <label class="form-label">IMAGEN DEL PRODUCTO <span
                                                                class="text-info">(capturar desde la
                                                                cámara)</span> <span
                                                                class="text-danger">*</span></label>

                                                        @if ($a == true)
                                                            <div class="text-center" wire:ignore.self>
                                                                <button class="btn btn-sm btn-danger"
                                                                    wire:click="limpiarbotonpro">
                                                                    REMOVER IMAGEN
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#capturarImagenModal">
                                                                Capturar Imagen Nueva
                                                            </button>
                                                        @endif

                                                        <!-- Mostrar la imagen capturada en un span -->
                                                        @if ($rutaImagenfinal)
                                                            <span class="d-block text-center text-secondary">
                                                                <img src="{{ $rutaImagenfinal }}"
                                                                    alt="Imagen del Producto" class="img-fluid">
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
                                        @if ($historial_id_selected)


                                            <div class="row">
                                                {{-- <label for="" class="form-label"> ARCHIVOS ACTUALES</label> --}}
                                                {{-- @if ($archivo_anterior)
                                                @if (str_ends_with($archivo_anterior, '.pdf'))
                                                    <embed src="{{ asset($archivo_anterior) }}"
                                                        type="application/pdf" width="100%" height="600px">
                                                @else
                                                    <img src="{{ asset($archivo_anterior) }}" class="img-fluid"
                                                        alt="Vista previa" width="300" height="200">
                                                @endif
                                            @endif --}}
                                                {{-- @foreach ($imagenesEstudio as $imagen)
                                                    <img src="{{ $imagen->imagen }}" alt="estudio"
                                                        class="img-fluid">
                                                @endforeach --}}
                                            </div>
                                        @endif
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
                                            <input type="date" class="form-control"
                                                wire:model="FechaIngresoInternacion">

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
                                            <label class="form-label"><span class="text-primary"> Fecha en que se
                                                    realizo
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
                                            <label class="form-label"><span class="text-primary"> Cual es la razón por
                                                    el
                                                    cual se decidio realizar la eutanacia? <br>
                                                    Describa...</span></label>
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
                                                        <embed src="{{ asset($archivo_anterior) }}"
                                                            type="application/pdf" width="100%" height="600px">
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
                                        <div class="col-md-12">
                                            @if ($SeleccionTipoDeArchivo != '')
                                                <hr>
                                                @if ($SeleccionTipoDeArchivo == 'pdf' or $SeleccionTipoDeArchivo == 'imagen')
                                                    @if ($SeleccionTipoDeArchivo == 'pdf')
                                                        <label class="form-label"> Debe seleccionar el archivo pdf que
                                                            desea
                                                            añadir al historial de estudio complementario</label>
                                                    @elseif($SeleccionTipoDeArchivo == 'imagen')
                                                        <label class="form-label"> Debe seleccionar el archivo imagen
                                                            que
                                                            desea
                                                            añadir al historial de estudio complementario <span
                                                                class="text-danger">Tamaño: 20 X 30
                                                                Pixeles</span></label>
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
                                                                        class="img-fluid" alt="Vista previa"
                                                                        width="300" height="200">
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
                                                                cámara)</span> <span
                                                                class="text-danger">*</span></label>

                                                        @if ($a == true)
                                                            <div class="text-center" wire:ignore.self>
                                                                <button class="btn btn-sm btn-danger"
                                                                    wire:click="limpiarbotonpro">
                                                                    REMOVER IMAGEN
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#capturarImagenModal">
                                                                Capturar Imagen Nueva
                                                            </button>
                                                        @endif

                                                        <!-- Mostrar la imagen capturada en un span -->
                                                        @if ($rutaImagenfinal)
                                                            <span class="d-block text-center text-secondary">
                                                                <img src="{{ $rutaImagenfinal }}"
                                                                    alt="Imagen del Producto" class="img-fluid">
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
                                                        <embed src="{{ asset($archivo_anterior) }}"
                                                            type="application/pdf" width="100%" height="600px">
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
                                                        <label class="form-label"> Debe seleccionar el archivo imagen
                                                            que
                                                            desea
                                                            añadir al historial de estudio complementario <span
                                                                class="text-danger">Tamaño: 20 X 30
                                                                Pixeles</span></label>
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
                                                                        class="img-fluid" alt="Vista previa"
                                                                        width="300" height="200">
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
                                                                cámara)</span> <span
                                                                class="text-danger">*</span></label>

                                                        @if ($a == true)
                                                            <div class="text-center" wire:ignore.self>
                                                                <button class="btn btn-sm btn-danger"
                                                                    wire:click="limpiarbotonpro">
                                                                    REMOVER IMAGEN
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#capturarImagenModal">
                                                                Capturar Imagen Nueva
                                                            </button>
                                                        @endif

                                                        <!-- Mostrar la imagen capturada en un span -->
                                                        @if ($rutaImagenfinal)
                                                            <span class="d-block text-center text-secondary">
                                                                <img src="{{ $rutaImagenfinal }}"
                                                                    alt="Imagen del Producto" class="img-fluid">
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
                                                        <embed src="{{ asset($archivo_anterior) }}"
                                                            type="application/pdf" width="100%" height="600px">
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
                                                        <label class="form-label"> Debe seleccionar el archivo imagen
                                                            que
                                                            desea
                                                            añadir al historial de estudio complementario <span
                                                                class="text-danger">Tamaño: 20 X 30
                                                                Pixeles</span></label>
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
                                                                        class="img-fluid" alt="Vista previa"
                                                                        width="300" height="200">
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
                                                                cámara)</span> <span
                                                                class="text-danger">*</span></label>

                                                        @if ($a == true)
                                                            <div class="text-center" wire:ignore.self>
                                                                <button class="btn btn-sm btn-danger"
                                                                    wire:click="limpiarbotonpro">
                                                                    REMOVER IMAGEN
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#capturarImagenModal">
                                                                Capturar Imagen Nueva
                                                            </button>
                                                        @endif

                                                        <!-- Mostrar la imagen capturada en un span -->
                                                        @if ($rutaImagenfinal)
                                                            <span class="d-block text-center text-secondary">
                                                                <img src="{{ $rutaImagenfinal }}"
                                                                    alt="Imagen del Producto" class="img-fluid">
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
                                                        <embed src="{{ asset($archivo_anterior) }}"
                                                            type="application/pdf" width="100%" height="600px">
                                                    @else
                                                        <img src="{{ asset($archivo_anterior) }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
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
                                                        <label class="form-label"> Debe seleccionar el archivo imagen
                                                            que
                                                            desea
                                                            añadir al historial de estudio complementario <span
                                                                class="text-danger">Tamaño: 20 X 30
                                                                Pixeles</span></label>
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
                                                                        class="img-fluid" alt="Vista previa"
                                                                        width="300" height="200">
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
                                                                cámara)</span> <span
                                                                class="text-danger">*</span></label>

                                                        @if ($a == true)
                                                            <div class="text-center" wire:ignore.self>
                                                                <button class="btn btn-sm btn-danger"
                                                                    wire:click="limpiarbotonpro">
                                                                    REMOVER IMAGEN
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#capturarImagenModal">
                                                                Capturar Imagen Nueva
                                                            </button>
                                                        @endif

                                                        <!-- Mostrar la imagen capturada en un span -->
                                                        @if ($rutaImagenfinal)
                                                            <span class="d-block text-center text-secondary">
                                                                <img src="{{ $rutaImagenfinal }}"
                                                                    alt="Imagen del Producto" class="img-fluid">
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
                                                        <embed src="{{ asset($archivo_anterior) }}"
                                                            type="application/pdf" width="100%" height="600px">
                                                    @else
                                                        <img src="{{ asset($archivo_anterior) }}"
                                                            class="img-fluid" alt="Vista previa" width="300"
                                                            height="200">
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
                                                        <label class="form-label"> Debe seleccionar el archivo imagen
                                                            que
                                                            desea
                                                            añadir al historial de estudio complementario <span
                                                                class="text-danger">Tamaño: 20 X 30
                                                                Pixeles</span></label>
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
                                                                        class="img-fluid" alt="Vista previa"
                                                                        width="300" height="200">
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
                                                                cámara)</span> <span
                                                                class="text-danger">*</span></label>

                                                        @if ($a == true)
                                                            <div class="text-center" wire:ignore.self>
                                                                <button class="btn btn-sm btn-danger"
                                                                    wire:click="limpiarbotonpro">
                                                                    REMOVER IMAGEN
                                                                </button>
                                                            </div>
                                                        @else
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#capturarImagenModal">
                                                                Capturar Imagen Nueva
                                                            </button>
                                                        @endif

                                                        <!-- Mostrar la imagen capturada en un span -->
                                                        @if ($rutaImagenfinal)
                                                            <span class="d-block text-center text-secondary">
                                                                <img src="{{ $rutaImagenfinal }}"
                                                                    alt="Imagen del Producto" class="img-fluid">
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
                                    <button type="button" class="btn btn-danger waves-effect"
                                        data-bs-dismiss="modal" wire:click="limpiarmodalhistorial">CANCELAR</button>
                                    @if ($tipo_historial == 'historial_clinico')
                                        @if ($historial_id_selected)
                                            <button wire:click="guardareditarhistorial" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                CONSULTA</button>
                                        @else
                                            <button wire:click="guardarhistorialclinico" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                CONSULTA</button>
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
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                EUTANACIA</button>
                                        @else
                                            <button wire:click="guardarhistorialclinicoeutanacia" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                EUTANACIA</button>
                                        @endif
                                    @elseif($tipo_historial == 'ficha_clinica')
                                        @if ($historial_id_selected)
                                            <button wire:click="guardareditarhistorialclinicofichaclinica"
                                                type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                FICHA
                                                CLINICA</button>
                                        @else
                                            <button wire:click="guardarhistorialclinicofichaclinica" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR FICHA
                                                CLINICA</button>
                                        @endif
                                    @elseif($tipo_historial == 'recomendaciones_operatorias')
                                        @if ($historial_id_selected)
                                            <button wire:click="guardareditarrecomendacionesoperatorias"
                                                type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                RECOMENDACIONES
                                                OPERATORIAS</button>
                                        @else
                                            <button wire:click="guardarrecomendacionesoperatorias" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                RECOMENDACIONES
                                                OPERATORIAS</button>
                                        @endif
                                    @elseif($tipo_historial == 'concentimiento_informado')
                                        @if ($historial_id_selected)
                                            <button wire:click="guardareditarconcentimientoinformado" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                CONCENTIMIENTO
                                                INFORMADO</button>
                                        @else
                                            <button wire:click="guardarconcentimientoinformado" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR
                                                CONCENTIMIENTO
                                                INFORMADO</button>
                                        @endif
                                    @elseif($tipo_historial == 'autorizacion_de_sedacion')
                                        @if ($historial_id_selected)
                                            <button wire:click="guardareditarautorizaciondesedacion" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR AUTORIZACION
                                                DE
                                                SEDACION</button>
                                        @else
                                            <button wire:click="guardarautorizaciondesedacion" type="button"
                                                class="btn btn-primary waves-effect waves-light">GUARDAR AUTORIZACION
                                                DE
                                                SEDACION</button>
                                        @endif

                                    @endif


                                </div>


                            </div>

                        </div>

                    </div>



                </div>

                {{-- <div wire:ignore.self id="idmodalproducto" data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content radius-10 border-start border-5  border-primary">
                        <div class="modal-header">

                            <div class="row">
                                <div class="text-center text-info h5"> REGISTRAR PRODUCTOS</div>
                            </div>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" wire:model="productoID">
                                <div class="col-md-6">
                                    <label class="form-label">NOMBRE DEL PRODUCTO <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model.live="Nombreproducto"
                                        placeholder="Ej. suero">
                                    @error('Nombreproducto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">DESCRIPCION DEL PRODUCTO <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model.live="Descripcionproducto"
                                        placeholder="Ej. sirve para la recuperacion">
                                    @error('Descripcionproducto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">IMAGEN DEL PRODUCTO subir <span
                                            class="text-danger">*</span></label>

                                    <input type="file" wire:model="Imagenproducto" accept=".pdf,.jpg,.png,.jpeg"
                                        @if ($campoImagenHabilitado) disabled @endif>
                                    <span class="d-block text-center text-secondary ">
                                        @if ($Imagenproducto)
                                            DATOS CARGADOS CON EXITO
                                            @php
                                                $a = true;
                                            @endphp
                                        @else
                                            SIN DATOS
                                        @endif
                                    </span>
                                    @error('Imagenproducto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">IMAGEN DEL PRODUCTO (capturar desde la cámara) <span
                                            class="text-danger">*</span></label>

                                        @if ($a == true)
                                            <div wire:ignore.self>
                                                <button class="btn btn-sm btn-danger" wire:click="limpiarbotonpro">
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
                                        <h1>SIN IMAGEN CAPTURADA </h1>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CANTIDAD INICIAL DEL PRODUCTO <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model.live="Cantidadproducto"
                                        placeholder="Ej. 10">
                                    @error('Cantidadproducto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">PRECIO PRODUCTO <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" wire:model.live="Precioproducto"
                                        placeholder="Ej. 25.50">
                                    @error('Precioproducto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <hr>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="limpiarproducto">CANCELAR</button>

                                    @if ($campoImagenHabilitado)
                                        <button wire:click="Guardarprodcuto2" type="button"
                                            class="btn btn-warning waves-effect waves-light">GUARDAR DATOS
                                            CAPTURA</button>
                                    @else
                                        <button wire:click="Guardarprodcuto" type="button"
                                            class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
                <div wire:ignore.self id="capturarImagenModal" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-labelledby="capturarImagenModalLabel"
                    aria-hidden="false">
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
                <div wire:ignore.self id="vertratamientos" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">VER TRATAMIENTOS REALIZADOS</h5>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tratamientos_usados as $tra)
                                                <tr>
                                                    <td>{{ $tra->id }}</td>
                                                    <td>{{ $tra->descripcion }}</td>
                                                    <td>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="$emit('borrar_tratamiento', {{ $tra->id }})"><i
                                                                class="bx bxs-trash"></i></button>
                                                        <button class="btn btn-warning"
                                                            wire:click="editartratamientohistorial({{ $tra->id }})"><i
                                                                class= "bx bx-pencil"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    q>Cancelar</button>
                                <button type="button" class="btn btn-primary"
                                    wire:click="creartratamiendonew">Crear
                                    Tratamiento</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div wire:ignore.self id="vertratamientos" data-bs-backdrop="static" class="modal fade" tabindex="-1"
                role="dialog" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">VER TRATAMIENTOS REALIZADOS</h5>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tratamientos_usados as $tra)
                                            <tr>
                                                <td>{{ $tra->id }}</td>
                                                <td>{{ $tra->descripcion }}</td>
                                                <td>
                                                    <button class="btn btn-danger"
                                                        wire:click.prevent="$emit('borrar_tratamiento', {{ $tra->id }})"><i
                                                            class="bx bxs-trash"></i></button>
                                                    <button class="btn btn-warning"
                                                        wire:click="editartratamientohistorial({{ $tra->id }})"><i
                                                            class= "bx bx-pencil"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" q
                                wire:click="cancelarmodaltramite">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="creartratamiendonew">Crear
                                Tratamiento</button>
                        </div>
                    </div>
                </div>
            </div> --}}
                <div wire:ignore.self id="creartratamiento" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    @if ($tratamientoid_select)
                                        EDITAR
                                    @else
                                        CREAR
                                    @endif TRATAMIENTO
                                </h5>
                            </div>
                            <div class="modal-body">
                                <div
                                    class="position-relative px-3 pb-3 pt-4 mt-3 mb-0 border border-gray-2 border-primary theme-options-set">
                                    <label
                                        class="py-1 px-2 fs-8 fw-bold text-uppercase text-spacing-2 bg-primary border border-gray-2 position-absolute rounded-2 options-label"
                                        style="top: -12px">DATOS DEL TRATAMIENTO</label>
                                    <div class="row g-2 theme-options-items font-family">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <label class="form-label">Medicamento
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control" wire:model="Medicamento"
                                                    type="text">
                                                @error('Medicamento')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Dosis en mg
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control" wire:model="DosisEnMg" type="number">
                                                @error('DosisEnMg')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Dosis en ml
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control" wire:model="DosisEnMl" type="number">
                                                @error('DosisEnMl')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label"> VIA
                                                    <span class="text-danger">*</span></label>

                                                <select class="form-select" wire:model="Via">
                                                    <option value="">[SELECCIONE UNA OPCIÓN]</option>
                                                    <option value="IV">IV</option>
                                                    <option value="IM">IM</option>
                                                    <option value="SC">SC</option>
                                                    <option value="VO">VO</option>
                                                </select>
                                                @error('Via')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label"> Hora
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" value="{{ date('H:i:s') }}"
                                                    class="form-control" placeholder="Hora actual" disabled
                                                    style="color: blue">

                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Precio del tratamiento
                                                    <span class="text-danger">*</span></label>
                                                <input class="form-control" wire:model="Precio" type="number">
                                                @error('Precio')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label"> Administrado
                                                    <span class="text-danger">*</span></label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="Administrado" wire:model="Administrado"
                                                        switch="success" />
                                                    <label class="form-check-label" for="Administrado"
                                                        data-on-label="SI" data-off-label="NO">

                                                    </label>
                                                </div>
                                                @error('Administrado')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    DESCRIPCIÓN DE TRATAMIENTO <span class="text-danger">*</span>
                                                </label>
                                                <div style="position: relative; display: inline-block; width: 100%;">
                                                    <textarea class="form-control" id="contenedor" wire:model="DescripcionTratamiento"
                                                        placeholder="Debe redactar la descripción del tratamiento...." style="width: 100%; padding-right: 40px;">
                                                </textarea>
                                                    @error('DescripcionTratamiento')
                                                        <div class="text-danger"> {{ $message }}</div>
                                                    @enderror
                                                    <button class="btn btn-primary"
                                                        wire:click="comenzarReconocimiento"
                                                        style="position: absolute; right: 10px; top: 10px;">
                                                        <i class="fas fa-microphone"></i>
                                                    </button>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="text-center"> <button type="button" class="btn btn-primary"
                                                wire:click="guardartratamiento">GUARDAR</button></div>
                                    </div>
                                </div>

                                @if ($tratamientos_usados)
                                    @if (count($tratamientos_usados) > 0)
                                        <div class="table-responsive mt-4">
                                            <table class="table table-bordered ">
                                                <thead>
                                                    <tr>
                                                        <th>MEDICAMENTO</th>
                                                        <th>DOSIS</th>
                                                        <th>DOSIS</th>
                                                        <th>VIA</th>
                                                        <th>HORA</th>
                                                        <th>ADMINISTRADO</th>
                                                        <th>DESCRIPCIÓN</th>
                                                        <th>PRECIO</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tratamientos_usados as $tratamiento)
                                                        <tr>
                                                            <td>{{ $tratamiento->Medicamento }}</td>
                                                            <td>{{ $tratamiento->dosis_mg }}</td>
                                                            <td>{{ $tratamiento->dosis_ml }}</td>
                                                            <td>{{ $tratamiento->via }}</td>
                                                            <td>{{ $tratamiento->hora }}</td>
                                                            <td>
                                                                {{ $tratamiento->administrado }}

                                                            </td>
                                                            <td>{{ $tratamiento->descripcion }}</td>
                                                            <td>{{ $tratamiento->precio }}</td>
                                                            <td> <button class="btn btn-danger"
                                                                    wire:click.prevent="$emit('borrar_tratamiento', {{ $tratamiento->id }})"><i
                                                                        class="bx bxs-trash"></i></button></td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="row mt-2">
                                            <div class="col-2"></div>
                                            <div class="col-8">
                                                <div class="alert alert-warning alert-dismissible fade show text-center "
                                                    role="alert">
                                                    <i class="mdi mdi-alert-outline me-2"></i>AUN NO SE TIENE NINGUN
                                                    REGISTRO DE HISTORIAL!

                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="alert" aria-label="Close">

                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-2"></div>
                                        </div>
                                    @endif
                                @endif



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    wire:click="limpiarmodaltratamientos">CANCELAR</button>


                            </div>
                        </div>
                    </div>
                </div>
                <div wire:ignore.self id="creartratamientointernacion" data-bs-backdrop="static"
                    class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    @if ($tratamientointernacion_id)
                                        EDITAR
                                    @else
                                        CREAR
                                    @endif
                                    TRATAMIENTO DE INTERNACIÓN
                                </h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            ENCARGADO :<span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" wire:model="encargado">
                                            <option value=""selected>Elegir una opción...</option>
                                            @foreach ($usuarios as $user)
                                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>


                                        @error('encargado')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            FECHA DE TRATAMIENTO :<span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control" wire:model="fecha">


                                        @error('fecha')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            DESCRIPCION DEL TRATAMIENTO :<span class="text-danger">*</span>
                                        </label>
                                        <textarea cols="20" rows="10" class="form-control"
                                            placeholder="Indique el tratamiento que se le realizo a la mascota..." wire:model="tratamiento"></textarea>


                                        @error('tratamiento')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            OBSERVACIONES DEL TRATAMIENTO :<span class="text-danger">*</span>
                                        </label>
                                        <textarea cols="20" rows="10" class="form-control"
                                            placeholder="Indique las observaciones con respecto al tratamiento realizado..." wire:model="observaciones"></textarea>


                                        @error('observaciones')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    wire:click="limpiarmodalcrear">CANCELAR</button>
                                @if ($tratamientointernacion_id)
                                    <button type="button" class="btn btn-primary"
                                        wire:click="guardareditartratamientointernacion">GUARDAR</button>
                                @else
                                    <button type="button" class="btn btn-primary"
                                        wire:click="guardartratamientointernacion">GUARDAR</button>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div wire:ignore.self id="vertratamientointernacion" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">VER TRATAMIENTOS DE INTERNACIÓN</h5>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ENCARGADO</th>
                                                <th>FECHA</th>
                                                <th>TRATAMIENTO</th>
                                                <th>OBSERVACIONES</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tratamientos_usados_internacion as $tratamiento)
                                                <tr>
                                                    <td>{{ $tratamiento->id }}</td>
                                                    <td>{{ $tratamiento->encargado }}</td>
                                                    <td>{{ $tratamiento->fecha }}</td>
                                                    <td>{{ $tratamiento->tratamiento }}</td>
                                                    <td>{{ $tratamiento->observaciones }}</td>

                                                    <td>
                                                        <button class="btn btn-danger"
                                                            wire:click.prevent="$emit('borrar_tratamiento_internacion', {{ $tratamiento->id }})"><i
                                                                class="bx bxs-trash"></i></button>
                                                        <button class="btn btn-warning"
                                                            wire:click="editartratamientointernacion({{ $tratamiento->id }})"><i
                                                                class= "bx bx-pencil"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    q>Cancelar</button>
                                <button type="button" class="btn btn-primary"
                                    wire:click="creartratamiendointernacionnew">Crear
                                    Tratamiento</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div wire:ignore.self id="modaltratamiento" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title">TRATAMIENTOS

                                </h5>

                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    @if ($tratamientos->count() > 0)
                                        @foreach ($tratamientos as $tratamiento)
                                            <div class="accordion" id="listadias-{{ $tratamiento->id }}"
                                                wire:ignore.self>
                                                <div class="accordion-item" wire:ignore.self>
                                                    <h2 class="accordion-header"
                                                        id="heading-{{ $tratamiento->id }}">
                                                        <button
                                                            class="accordion-button collapsed text-white rounded-3"
                                                            style="background-color: #082338;" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-{{ $tratamiento->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $tratamiento->id }}"
                                                            wire:ignore.self>
                                                            <span class="me-2">
                                                                <i class="bi bi-arrow-down"></i>
                                                                <!-- Ícono para cuando el acordeón está colapsado -->
                                                                <i class="bi bi-arrow-up"></i>
                                                                <!-- Ícono para cuando el acordeón está expandido -->
                                                            </span>
                                                            <span class="tex-info rounded p-2"
                                                                style="color: #27ef30;">
                                                                TRATAMIENTO EN FECHA - {{ $tratamiento->created_at }}
                                                            </span>
                                                        </button>


                                                    </h2>
                                                    <div id="collapse-{{ $tratamiento->id }}"
                                                        class="accordion-collapse collapse "
                                                        aria-labelledby="heading-{{ $tratamiento->id }}"
                                                        data-bs-parent="#listadias-{{ $tratamiento->id }}"
                                                        wire:ignore.self>
                                                        <div class="container">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">DUEÑO:</p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $tratamiento->tratamiento_historial_clinico->historial_clinico_mascotas->mascotas_clientes->nombre }}
                                                                    </p>
                                                                    <br>
                                                                    <p class="text-success d-inline mr-2">PESO DE LA
                                                                        MASCOTA: </p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $tratamiento->tratamiento_historial_clinico->Peso }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">MASCOTA:</p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $tratamiento->tratamiento_historial_clinico->historial_clinico_mascotas->nombre }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">COSTO: </p>
                                                                    <p class="text-info d-inline">
                                                                        Bs. {{ $tratamiento->precio }}
                                                                    </p>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 text-center">
                                                                    <button class="btn btn-danger"
                                                                        wire:click.prevent="$emit('borrar_tratamiento', {{ $tratamiento->id }})"><i
                                                                            class="bx bxs-trash"> ELIMINAR
                                                                            TRATAMIENTO</i></button>
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="accordion-body">
                                                            <fieldset class="border border-primary p-2 ">


                                                                <div class="accordion" id="listadias22"
                                                                    wire:ignore.self>
                                                                    <div class="accordion-item" wire:ignore.self>
                                                                        <h2 class="accordion-header"
                                                                            id="listadias_header">
                                                                            <button
                                                                                class="accordion-button collapsed p-0 mb-0"
                                                                                style="background-color: #082338;"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#collapse22"
                                                                                aria-expanded="true"
                                                                                aria-controls="collapse22"
                                                                                wire:ignore.self>
                                                                                <p
                                                                                    class="tex-info bg-warning text-white p-2 mb-2 rounded">
                                                                                    COMENTARIOS DE DOCTORES SOBRE EL
                                                                                    TRATAMIENTO</p>
                                                                            </button>
                                                                        </h2>
                                                                        <fieldset
                                                                        class="float-none w-auto border border-primary p-3 mb-3">
                                                                        <legend class="text-primary">
                                                                            COMENTARIOS
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
                                                                                    <textarea class="form-control" id="contenedor" wire:model="DescripcionTratamiento"
                                                                                        placeholder="Debe redactar la descripción del tratamiento...." style="width: 100%; padding-right: 40px;">
                                                                                </textarea>
                                                                                    @error('DescripcionTratamiento')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                    <button
                                                                                        class="btn btn-primary"
                                                                                        wire:click="comenzarReconocimiento"
                                                                                        style="position: absolute; right: 10px; top: 10px;">
                                                                                        <i
                                                                                            class="fas fa-microphone"></i>
                                                                                    </button>
                                                                                </div>

                                                                            </div>
                                                                            <div class="form-group row mt-4">
                                                                                <div
                                                                                    class="col-sm-12 offset-sm-4">

                                                                                    @if ($estadocomen)
                                                                                        <button
                                                                                            class="btn btn-success"
                                                                                            wire:click="GuardarComentarioTratamiento( {{ $tratamiento->id }})">+Agregar
                                                                                            comentario
                                                                                        </button>
                                                                                    @else
                                                                                        <button
                                                                                            class="btn btn-warning"
                                                                                            wire:click="EditarComentarioTratamiento">Editar
                                                                                            comentario
                                                                                        </button>
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    @if (count($tratamiento->tratamiento_comentarios) > 0)
                                                                        <div class="table-responsive mt-4">
                                                                            <table
                                                                                class="table table-hover table-bordered border-primary">
                                                                                <thead>
                                                                                    <tr>
                                                                                      
                                                                                        <th>FECHA </th>

                                                                                        <th>COMENTARIO</th>
                                                                                        <th>VETERINARIO</th>
                                                                                        <th>ACCIONES</th>


                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($tratamiento->tratamiento_comentarios as $datos)
                                                                                        <tr>
                                                                                          
                                                                                            <td>{{ $datos->created_at }}
                                                                                            </td>
                                                                                            <td>{{ $datos->comentario }}
                                                                                            </td>
                                                                                            <td> DR.
                                                                                                {{ $datos->user->name }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <button
                                                                                                    class="btn btn-danger"
                                                                                                    wire:click.prevent="$emit('borrartratamientodato', {{ $datos->id }})"><i
                                                                                                        class="bx bxs-trash"></i></button>

                                                                                                <button
                                                                                                    class="btn btn-warning"
                                                                                                    wire:click="editartratamientodato({{ $datos->id }})"><i
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
                                                                                NO SE TIENE NINGUN
                                                                                REGISTRO</span>
                                                                        </div>
                                                                    @endif

                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="accordion" id="listadias33"
                                                                    wire:ignore.self>
                                                                    <div class="accordion-item" wire:ignore.self>
                                                                        <h2 class="accordion-header"
                                                                            id="listadias_header">
                                                                            <button
                                                                                class="accordion-button collapsed p-0 mb-0"
                                                                                style="background-color: #082338;"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#collapse33"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapse"
                                                                                wire:ignore.self>
                                                                                <p
                                                                                    class="tex-info bg-info text-white p-2 mb-2 rounded">
                                                                                    MEDICAMENTOS ADMINISTADOS</p>
                                                                            </button>
                                                                        </h2>
                                                                        <div class="accordion-collapse collapse"
                                                                            id="collapse33"
                                                                            aria-labelledby="listadias_header"
                                                                            data-bs-parent="#listadias33"
                                                                            wire:ignore.self>

                                                                            <fieldset
                                                                                class="float-none w-auto border border-primary p-3 mb-3">
                                                                                <legend class="text-primary">
                                                                                    MEDICAMENTOS
                                                                                </legend>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <label
                                                                                            class="form-label">Medicamento
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input class="form-control"
                                                                                            wire:model="Medicamento"
                                                                                            type="text">
                                                                                        @error('Medicamento')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label
                                                                                            class="form-label">Dosis
                                                                                            en
                                                                                            mg
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input class="form-control"
                                                                                            wire:model="DosisEnMg"
                                                                                            type="number">
                                                                                        @error('DosisEnMg')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label
                                                                                            class="form-label">Dosis
                                                                                            en
                                                                                            ml
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input class="form-control"
                                                                                            wire:model="DosisEnMl"
                                                                                            type="number">
                                                                                        @error('DosisEnMl')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label
                                                                                            class="form-label">Dosis
                                                                                            en
                                                                                            comprimido
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input class="form-control"
                                                                                            wire:model="DosisComrpimido"
                                                                                            type="text">
                                                                                        @error('DosisComrpimido')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label class="form-label"> VIA
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <select class="form-select"
                                                                                            wire:model="Via">
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
                                                                                            <option value="NEBUL">
                                                                                                NEBUL
                                                                                            </option>
                                                                                            <option value="AMBUL">
                                                                                                AMBUL
                                                                                            </option>

                                                                                        </select>
                                                                                        @error('Via')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">
                                                                                            Hora
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input type="text"
                                                                                            value="{{ date('H:i:s') }}"
                                                                                            class="form-control"
                                                                                            placeholder="Hora actual"
                                                                                            disabled
                                                                                            style="color: blue">

                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">
                                                                                            Administrado
                                                                                            <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <div
                                                                                            class="form-check form-switch">
                                                                                            <input
                                                                                                class="form-check-input"
                                                                                                type="checkbox"
                                                                                                id="Administrado"
                                                                                                wire:model="Administrado"
                                                                                                switch="success" />
                                                                                            <label
                                                                                                class="form-check-label"
                                                                                                for="Administrado"
                                                                                                data-on-label="SI"
                                                                                                data-off-label="NO">

                                                                                            </label>
                                                                                        </div>
                                                                                        @error('Administrado')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group row mt-4">
                                                                                        <div
                                                                                            class="col-sm-8 offset-sm-4">
                                                                                            <button
                                                                                                class="btn btn-success"
                                                                                                wire:click="GuardarMedicamento( {{ $tratamiento->id }})">+Agregar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </fieldset>
                                                                            @if (count($tratamiento->tratamiento_medicamentos) > 0)
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
                                                                                                <th>DOSIS EN COM.</th>
                                                                                                <th>VIA</th>

                                                                                                <th>ADMINSTRADO</th>
                                                                                                <th>VETERINARIO</th>
                                                                                                <th>ELIMINAR</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @php
                                                                                                $total = 0; // Declaración de la variable total inicializada en 0
                                                                                            @endphp
                                                                                            @foreach ($tratamiento->tratamiento_medicamentos as $datos)
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
                                                                                                    <td>{{ $datos->comprimido }}
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
                                                                                                            wire:click.prevent="$emit('borrartratamientocuerpo', {{ $datos->id }})"><i
                                                                                                                class="bx bxs-trash"></i></button>
                                                                                                    </td>
                                                                                                    {{ $total = $datos->precio }}
                                                                                                </tr>
                                                                                            @endforeach

                                                                                            <td>COSTO TOTAL
                                                                                            </td>

                                                                                            <td>
                                                                                                {{ $total }}


                                                                                            </td>

                                                                                        </tbody>
                                                                                    </table>
                                                                                    <fieldset
                                                                                    class="float-none w-auto border border-primary p-3 mb-3">
                                                                                    <legend class="text-primary">
                                                                                        COSTO TOTAL
                                                                                    </legend>
                                                                                    <div class="row">
                                                                                        <div class="col-md-3">
                                                                                            @if ($total > 0)
                                                                                            
                                                                                           {{$total}} Bs.  <button
                                                                                           class="btn btn-danger"
                                                                                           wire:click="borrarcostototalmedicamento({{ $tratamiento->id }})"><i
                                                                                               class="bx bxs-trash"></i></button>
                                                                                            @else
                                                                                            <input
                                                                                            class="form-control"
                                                                                            wire:model="Medicamentototal"
                                                                                            type="text"
                                                                                           >
                                                                                           <button
                                                                                           class="btn btn-success"
                                                                                           wire:click="Guardarcostototalmedicamento({{ $tratamiento->id }})">+OK</button>
                                                                                             @endif
                                                                                           

                                                                                        @error('Medicamentototal')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                           
                                                                                       
                                                                                        </div>
                                                                                     
                                                                                   
    
                                          
                                                                                    </div>
                                                                                </fieldset>
                                                                                   
                                                                                </div>
                                                                            @else
                                                                                <div class="row">
                                                                                    <span
                                                                                        class="alert alert-success text-center">AUN
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
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
                                <button data-bs-dismiss="modal" type="button"
                                    class="btn btn-danger">Cerrar</button>
                                <button wire:click="CrearTratamiento" type="button" class="btn btn-primary">Crear
                                    tratamiento de mascota</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div wire:ignore.self id="VerVacunas" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-hidden="false">
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
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne" wire:ignore.self>
                                                CONTROL DE VACUNAS
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse "
                                            aria-labelledby="listadias" data-bs-parent="#listadias"
                                            wire:ignore.self>
                                            <div class="accordion-body">

                                                @if (count($VacunasPorMascota) > 0)
                                                    <div class="table-responsive mt-4">
                                                        <table
                                                            class="table table-hover table-bordered border-primary">
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
                                                                        <td>{{ $vacunas->vacuna_veterinario->name }}
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <button class="btn btn-outline-primary">ANAMENSIS</button> <br>
                                                                            {{ $vacunas->anamensis }} <br> <br>
                                                                            <button class="btn btn-outline-primary">RECOMENDACIÓN</button> <br>
                                                                            {{ $vacunas->recomendacion }}
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
                                                        <span class="alert alert-success text-center">AUN NO SE TIENE
                                                            NINGUN
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
                                                data-bs-toggle="collapse" data-bs-target="#DOS"
                                                aria-expanded="false" aria-controls="DOS" wire:ignore.self>
                                                CONTROL DE DESPARASITACIONES
                                            </button>
                                        </h2>
                                        <div id="DOS" class="accordion-collapse collapse "
                                            aria-labelledby="listadias" data-bs-parent="#listadias"
                                            wire:ignore.self>
                                            <div class="accordion-body">

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
                                                    <span class="alert alert-success text-center">AUN NO SE TIENE
                                                        NINGUN REGISTRO
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
                <div wire:ignore.self id="modalcirugiapre" data-bs-backdrop="static" class="modal fade"
                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title">CIRUGÍAS </h5>

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

                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    @php
                                        $conta = 0;
                                    @endphp
                                    @if ($cirugiass->count() > 0)
                                        @foreach ($cirugiass as $cirugia)
                                            <div class="accordion" id="listadias-{{ $cirugia->id }}"
                                                wire:ignore.self>
                                                <div class="accordion-item" wire:ignore.self>
                                                    <h2 class="accordion-header" id="heading-{{ $cirugia->id }}">
                                                        <button
                                                            class="accordion-button collapsed text-white rounded-3"
                                                            style="background-color: #082338;" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-{{ $cirugia->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-{{ $cirugia->id }}"
                                                            wire:ignore.self>
                                                            <span class="me-2">
                                                                <i class="bi bi-arrow-down"></i>
                                                                <!-- Ícono para cuando el acordeón está colapsado -->
                                                                <i class="bi bi-arrow-up"></i>
                                                                <!-- Ícono para cuando el acordeón está expandido -->
                                                            </span>
                                                            <span class="tex-info rounded p-2"
                                                                style="color: #27ef30;">
                                                                CIRUGIA #{{ $conta++ }}
                                                            </span>
                                                        </button>
                                                    </h2>

                                                    <div id="collapse-{{ $cirugia->id }}"
                                                        class="accordion-collapse collapse "
                                                        aria-labelledby="heading-{{ $cirugia->id }}"
                                                        data-bs-parent="#listadias-{{ $cirugia->id }}"
                                                        wire:ignore.self>
                                                        <div class="container">
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">Dueño:</p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $cirugia->cirugia_mascota->mascot_clie->nombre }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">mascota:</p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $cirugia->cirugia_mascota->nombre }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">costo: </p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $cirugia->total }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">Peso: </p>
                                                                    @if ($cirugia->peso)
                                                                        <p class="text-info d-inline">
                                                                            {{ $cirugia->peso }}</p>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">descripción:
                                                                    </p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $cirugia->descripcion }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-success d-inline mr-2">asa: </p>
                                                                    <p class="text-info d-inline">
                                                                        {{ $cirugia->asa }}</p>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="accordion-body">
                                                            <fieldset class="border border-primary p-2 ">
                                                                <div class="accordion" id="listadias11"
                                                                    wire:ignore.self>
                                                                    <div class="accordion-item" wire:ignore.self>
                                                                        <h2 class="accordion-header"
                                                                            id="listadias_header11">
                                                                            <button
                                                                                class="accordion-button collapsed p-0 mb-0"
                                                                                style="background-color: #082338;"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#collapse11"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapse"
                                                                               >
                                                                                <p
                                                                                    class="tex-info bg-success text-white p-2 mb-2 rounded">
                                                                                    DATOS PRE-OPERATORIO</p>
                                                                            </button>
                                                                        </h2>
                                                                        <div class="accordion-collapse collapse"
                                                                            id="collapse11"
                                                                            aria-labelledby="listadias_header11"
                                                                            data-bs-parent="#listadias11"
                                                                            wire:ignore.self>

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
                                                                                                
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($datoscirugiaspre as $datos)
                                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                                    <tr>
                                                                                                        <td>{{ $datos->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->hora }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->FC }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->FR }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->Tem }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->MM }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->TLLC }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->sopo2 }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->valoracion }}
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
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
                                                                                </div>
                                                                            @endif

                                                                            <hr>

                                                                           
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
                                                                                               

                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($cirugiapreope as $datos)
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
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                                <div class="accordion" id="listadias22"
                                                                    wire:ignore.self>
                                                                    <div class="accordion-item" wire:ignore.self>
                                                                        <h2 class="accordion-header"
                                                                            id="listadias_header">
                                                                            <button
                                                                                class="accordion-button collapsed p-0 mb-0"
                                                                                style="background-color: #082338;"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#collapse22"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapse"
                                                                                wire:ignore.self
                                                                               >
                                                                                <p
                                                                                    class="tex-info bg-warning text-white p-2 mb-2 rounded">
                                                                                    DATOS TRANS-OPERATORIO</p>
                                                                            </button>
                                                                        </h2>
                                                                        <div class="accordion-collapse collapse"
                                                                            id="collapse22"
                                                                            aria-labelledby="listadias_header"
                                                                            data-bs-parent="#listadias22"
                                                                            wire:ignore.self>

                                                                         
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
                                                                                               
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($datoscirugiaspre2 as $datos)
                                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                                    <tr>
                                                                                                        <td>{{ $datos->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->hora }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->FC }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->FR }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->Tem }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->MM }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->TLLC }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->sopo2 }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->valoracion }}
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
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
                                                                                </div>
                                                                            @endif

                                                                            <hr>
                                                                         
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
                                                                                               
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($cirugiapreope2 as $datos)
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
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
                                                                                </div>
                                                                            @endif




                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="accordion" id="listadias33"
                                                                    wire:ignore.self>
                                                                    <div class="accordion-item" wire:ignore.self>
                                                                        <h2 class="accordion-header"
                                                                            id="listadias_header">
                                                                            <button
                                                                                class="accordion-button collapsed p-0 mb-0"
                                                                                style="background-color: #082338;"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#collapse33"
                                                                                aria-expanded="false"
                                                                                aria-controls="collapse"
                                                                                wire:ignore.self
                                                                                >
                                                                                <p
                                                                                    class="tex-info bg-info text-white p-2 mb-2 rounded">
                                                                                    DATOS POST-OPERATORIO</p>
                                                                            </button>
                                                                        </h2>
                                                                        <div class="accordion-collapse collapse"
                                                                            id="collapse33"
                                                                            aria-labelledby="listadias_header"
                                                                            data-bs-parent="#listadias33"
                                                                            wire:ignore.self>

                                                                        
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
                                                                                               
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($datoscirugiaspre3 as $datos)
                                                                                                @if ($datos->cirugia_id == $cirugia->id)
                                                                                                    <tr>
                                                                                                        <td>{{ $datos->id }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->hora }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->FC }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->FR }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->Tem }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->MM }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->TLLC }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->sopo2 }}
                                                                                                        </td>
                                                                                                        <td>{{ $datos->valoracion }}
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
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
                                                                                </div>
                                                                            @endif

                                                                            <hr>

                                                                        
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
                                                                                        NO SE TIENE NINGUN
                                                                                        REGISTRO</span>
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
                                <button  type="button"
                                    class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                               
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @push('navi-js')
                <script src="{{ asset('JSNAVI/historial.js') }}"></script>
                <script>
                    
                    livewire.on('borrarimagen', idimagen => {
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

           
            livewire.emit('eliminarimg', idimagen);

            Swal.fire(
                'Eliminado!',
                'El registro ha sido eliminado..',
                'Exitosamente'
            )
        } else {
            Swal.fire({
                title: 'No se elimino su registro',

                icon: 'info',

            })
        }
    })
});
                </script>
            @endpush
