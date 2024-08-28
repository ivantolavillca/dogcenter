<div>


{{-- 
    <section class="cta-bg-section bg_cover pt-100 pb-50 p-r z-1"
        style="background-image: url({{ asset('assets/landing-page2/assets/images/bg/cta-bg-1.jpg') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <!--======  CTA Content Box  ======-->
                    <div class="cta-content-box text-white mb-50 wow fadeInLeft">
                        <div class="section-title mb-20">
                            <span class="sub-title"><i class="flaticon-plant"></i></span>
                            <h2>SI@DI</h2>
                        </div>
                        <p class="mb-35">REALIZA LA PREINSCRIPCION</p>
                        <a href="" class="main-btn golden-btn" data-bs-toggle="modal"
                            data-bs-target="#preinscripcion">PREINSCRIBIRSE</a>
                        @livewire('landig-page.validation-user-index')
                    </div>
                </div>
                <div class="col-lg-7">
                    <!--======  CTA Image Box  ======-->
                    <div class="cta-image-box mb-50 wow fadeInRight">
                        <img src="{{ asset('assets/landing-page2/assets/images/gallery/cta-1.jpg') }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade " wire:ignore.self id="validationasdsad" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">VALIDAR USUARIO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label"> C.I.:</label>
                            <input class="form-control" type="password" placeholder="Ingrese su cedula de identidad"
                                wire:model="ci3">
                            @error('ci3')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    <button type="button" class="btn btn-danger" wire:click="validar_user">ENVIAR</button>
                </div>
            </div>
        </div>
    </div>
   
    <div class="modal fade " wire:ignore.self id="preinscripcion" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">PRE - INSCRIPCIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label"> C.I.:</label>
                            <input class="form-control" type="password" placeholder="Ingrese su cedula de identidad"
                                wire:model="ci">
                            @error('ci')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <label class="form-label"> FECHA DE NACIMIENTO:</label>
                            <input class="form-control" type="date" wire:model="fecha_nac">
                            @error('fecha_nac')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    <button type="button" class="btn btn-danger"
                        wire:click="validar_existencia_persona">ENVIAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="login_persona_existente" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">INGRESAR AL SISTEMAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-2">
                                <div class="p-2">
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-4">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('status'))
                                        <div class="alert alert-success mb-4">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="username">{{ __('Email') }}</label>
                                            <x-input id="email" class="form-control" type="email"
                                                name="email" :value="old('email')" required autofocus
                                                autocomplete="username" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="userpassword">{{ __('Password') }}</label>
                                            <x-input id="password" class="form-control" type="password"
                                                name="password" required autocomplete="current-password" />
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customControlInline"
                                                name="remember" />
                                            <label class="form-check-label"
                                                for="customControlInline">{{ __('Remember me') }}</label>
                                        </div>

                                        <div class="mt-3">
                                            <x-button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">{{ __('Log In') }}</x-button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted"><i
                                                        class="mdi mdi-lock me-1"></i>
                                                    {{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade  modal-custom"wire:ignore.self id="registro_persona" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">REGISTRO PREINSCRIPCION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">C.I.:</label>
                                <input type="text" class="form-control " wire:model="ci">
                                @error('ci')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">EXPEDIDO:</label>
                                <input type="text" class="form-control " wire:model="expedido">
                                @error('expedido')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">NOMBRE:</label>
                                <input type="text" class="form-control " wire:model="nombre">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PATERNO:</label>
                                <input type="text" class="form-control" wire:model="paterno">
                                @error('paterno')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">MATERNO:</label>
                                <input type="text" class="form-control " wire:model="materno">
                                @error('materno')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">ESTADO CIVIL:</label> <br>
                                <select class="form-select form-control" wire:model="estado_civil">
                                    <option>Elegir...</option>
                                    <option value="SOLTERO">SOLTERO</option>
                                    <option value="CASADO">CASADO</option>
                                    <option value="VIUDO">VIUDO</option>
                                    <option value="DIVORCIADO">DIVORCIADO</option>
                                </select>
                                <br>
                                @error('estado_civil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">TELEFONO:</label>
                                <input type="text" class="form-control " wire:model="telefono">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">CELULAR:</label>
                                <input type="text" class="form-control " wire:model="celular">
                                @error('celular')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">FECHA NACIMIENTO:</label>
                                <input type="date" class="form-control " placeholder="" wire:model="fecha_nac">
                                @error('fecha_nac')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PROFESION:</label>
                                <input type="text" class="form-control " placeholder="" wire:model="profesion">
                                @error('profesion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PAIS:</label>
                                <input type="text" class="form-control " wire:model="pais">
                                @error('pais')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">GENERO:</label>
                                <br>
                                <select class="form-select form-control" wire:model="genero_persona">
                                    <option>Elegir...</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select>
                                <br>
                                @error('genero_persona')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">DIRECCION - UBICACION:</label>
                                <input type="text" class="form-control " placeholder="" wire:model="direccion">
                                @error('direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">EMAIL:</label>
                                <input type="email" class="form-control " wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">TIPO PAGO:</label>

                                <br>
                                <select class="form-select form-control" wire:model="tipo_pago">
                                    <option>Elegir...</option>
                                    <option value="Efectivo">EFECTIVO</option>
                                    <option value="Depósito">DEPOSITO</option>
                                </select>
                                <br>
                                @error('tipo_pago')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">TIPO DE ESTUDIANTE:</label>

                                <br>
                                <select class="form-select form-control" wire:model="tipo_estudiante">
                                    <option>Elegir...</option>
                                    @foreach ($tipo_estudiantes as $tip)
                                        <option value="{{ $tip->id_tipo_estudiante }}">
                                            {{ $tip->nombre_tipo_estudiante }}</option>
                                    @endforeach


                                </select>
                                <br>
                                @error('tipo_pago')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <center>
                        <h4> TOMAS MATERIAS</h4>
                    </center>
                    <div class="row">

                        <br>




                        <div class="col-lg-12">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>IDIOMA</th>

                                        <th>TURNO</th>
                                    </tr>
                                </thead>



                                <tbody>
                                    @php
                                        $idiomasUnicos = []; // Crear un conjunto para almacenar idiomas únicos
                                    @endphp

                                    @foreach ($idiomas_activos as $idioma)
                                        @foreach ($idioma->asignatura_idiom as $as)
                                            @foreach ($as->siadi_asignatura_planificar as $dasd)
                                                @if ($dasd->estado_planificar_asignartura == 'ACTIVO' && $dasd->siadi_asignatura->nivel_idioma->nombre_nivel_idioma == '1.1')
                                                    @php
                                                        $nombreIdioma = $idioma->nombre_idioma;
                                                        $idIdioma = $idioma->id; // ID del idioma
                                                    @endphp

      
                                                    @if (!in_array($nombreIdioma, $idiomasUnicos))
                                                       
                                                        @php
                                                            $idiomasUnicos[] = $nombreIdioma;
                                                        @endphp

                                                       
                                                        @php
                                                            $planificarAsignaturas = [];
                                                            foreach ($idioma->asignatura_idiom as $asignatura) {
                                                                foreach ($asignatura->siadi_asignatura_planificar as $planificar) {
                                                                    if ($planificar->estado_planificar_asignartura == 'ACTIVO' && $planificar->siadi_asignatura->nivel_idioma->nombre_nivel_idioma == '1.1') {
                                                                        $planificarAsignaturas[] = $planificar->id_planificar_asignatura;
                                                                    }
                                                                }
                                                            }
                                                        @endphp

                                                        <tr>
                                                            <td>{{ $nombreIdioma }} 1.1</td>

                                                            <td>
                                                                <select class="form-control"
                                                                    wire:model="selectedAsignaturas.{{ $nombreIdioma }}">
                                                                    <option value="">.::SELECCIONAR::.</option>
                                                                   
                                                                    @foreach ($planificarAsignaturas as $idasignatura)
                                                                        @php
                                                                            $siadiplanificarasignatura = App\Models\AdministracionModulos\SiadiPlanificarAsignatura::find($idasignatura);
                                                                        @endphp

                                                                        <option
                                                                            value="{{ $siadiplanificarasignatura->id_planificar_asignatura }}">
                                                                            {{ $siadiplanificarasignatura->siadi_paralelo->nombre_paralelo }}
                                                                            -
                                                                            {{ $siadiplanificarasignatura->turno_paralelo }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('selectedAsignaturas')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>



                            </table>

                        </div>


                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                    <button type="button" class="btn btn-primary" wire:click="guardar_persona">GUARDAR</button>
                </div>

            </div>
        </div>
    </div> 
--}}

    <!-- Modal registro persona -->
    


    <div class="modal fade" id="loginModal" wire:ignore.self tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="box-shadow: 10px 10px 2px rgb(5 218 195);">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Departamento de Idiomas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="mb-3 d-md-none">
                        <div class="col-md-12" align="center">
                            <img src="assetso/img/depto.png" class="img-fluid" width="200" height="200" alt="Imagen de ejemplo">
                        </div>
                    </div>


                    <!-- Sección de la imagen -->
                    <div class="col-md-6" align="center">
                        <img src="assetso/img/ci.jpg" class="img-fluid" alt="Imagen de ejemplo">
                    </div>
                    <!-- Sección del formulario de inicio de sesión -->
                    <div class="col-md-6">
                        <form wire:submit.prevent="validar_ci_user">
                        <div class="mb-3 d-none d-md-block">
                            <div class="col-md-12" align="center">
                                <img src="assetso/img/depto.png" class="img-fluid" width="200" height="200" alt="Imagen de ejemplo">
                            </div>
                        </div>

                            {{-- @if($validacionClic) --}}
                            <div class=" @error('CiIngreso')alert alert-danger @enderror mb-4">
                            @error('CiIngreso')
                            
                                <ul class="mb-0">
                                    <li>{{ $message }}</li>
                                </ul>
                            
                            @enderror
                            </div>
                            {{-- @endif --}}
                            <div class="mb-3 mt-0" align="center">
                                <label for="password" class="tp-section-title__pre p-relative text-uppercase">
                                    <i class="fa-regular fa-arrow-right-long"></i>
                                        <span class="title-pre-color">Nro de carnet de identidad</span>
                                    <i class="fa-regular fa-arrow-left-long"></i>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control ci-popovers" id="ciInput" placeholder="CI... sin expedido" wire:model="CiIngreso" data-bs-toggle="popover" data-bs-content="<div align='center'><span class='tp-section-title__pre p-relative' style='margin-bottom: 0px; font-size: 12px;'><span class='text-uppercase'>Solo el N.º carnet</span><br><span class='title-pre-color'>Ej: 123456789</span></span><br><span class='tp-section-title__pre p-relative' style='margin-bottom: 0px; font-size: 12px;'><span class='text-uppercase'>N</span>ota: <span class='title-pre-color'>Carnet sin expedido</span></span></div>" autocomplete="off">
                                </div>
                                <div id="ciError" class="text-danger"></div>
                            </div>
                            <div align="center">
                            <button type="submit" class="tp-btn-2" style="padding: 10px 100px;">Validar CI</button>
                               <!-- <a href="javascript:void(0)" class="tp-btn-2" style="padding: 10px 100px;" wire:click="validar_ci_user">Validar CI</a> -->
                            </div>
                        </form>
                        <div class="row">
                           <div class="col-xl-12">
                              <div class="tp-offer-all-btn text-center mt-50">
                                 <p><i class="fa-regular fa-arrow-right-long"></i> Otros <a href="javascript:void(0)">Ejemplos</a> <i class="fa-regular fa-arrow-left-long"></i></p>
                              </div>
                           </div>
                        </div>
                        <div>
                           <span class="tp-section-title__pre p-relative text-uppercase" style="margin-bottom: 0px;">Extranjeros: <span class="title-pre-color">E-123456789</span></span>
                           <span class="tp-section-title__pre p-relative text-uppercase" style="margin-bottom: 0px;">Duplicados: <span class="title-pre-color">123456789-1M</span></span>
                        </div>
                    </div>
                </div>
               <div class="modal-footer">
                  <div class="col-md-12" align="center">
                            <p class="text-danger mt-0 p-0 pb-0">Nota: <span class="text-black"><small>No es necesario incluir la extensión del departamento.</small></span></p>
                  </div>
               </div>
            </div>
        </div>
    </div>

    <!-- Primer modal ingreso -->
    
    <!-- Preinscripcion -->
    <div class="modal fade popup" id="modaltomarasignatura" wire:ignore.self tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="close icon" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/risebothtml/assets/images/backgroup/bg_close.png') }}" alt="">
                </div>
                <div class="header-popup">
                    <h5>SI@DI - Depto. de Idiomas</h5>
                    <div class="desc">
                        Nota. Puede realizar la preinscripción de dos idiomas
                    </div>
                </div>

                <div class="modal-body text-center">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-labe"> TIPO DE PAGO</label>
                            <select wire:model="tipopago" class="form-select">
                                <option selected>Elegir...</option>
                                <option value="Depósito">Depósito</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                            @error('tipopago')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($tipopago == 'Depósito')
                            <div class="col-md-6">
                                <label for="" class="form-labe"> NRO DE DEPOSITO</label>
                                <input type="number" class="form-control"
                                    placeholder="Ingrese el numero de deposito" wire:model="numero_deposito">
                            </div>
                            @error('numero_deposito')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif
                        @if ($tipopago == 'Depósito')
                            <div class="col-md-6">
                                <label for="" class="form-labe"> MONTO DEPOSITO</label>
                                <input type="number" class="form-control" placeholder="Ingrese el monto de deposito"
                                    wire:model="monto">
                            </div>
                            @error('monto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif
                        @if ($tipopago == 'Depósito')
                            <div class="col-md-6">
                                <label for="" class="form-labe"> FECHA DEPOSITO</label>
                                <input type="date" class="form-control" placeholder="Ingrese el monto de deposito"
                                    wire:model="fecha_deposito">
                            </div>
                            @error('fecha_deposito')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif

                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>IDIOMA</th>
                                    <th>ASIGNATURA</th>
                                    <th>PRE INSCRIPCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>


                                @php
                                    $idiomasAgrupados = [];
                                @endphp

                                @foreach ($materiashablilitadas as $asignatura)
                                    @php
                                        $idioma = $asignatura->nombre_idioma;

                                    @endphp


                                    @if (!array_key_exists($idioma, $idiomasAgrupados))
                                        @php
                                            $idiomasAgrupados[$idioma] = [];
                                        @endphp
                                    @endif

                                    @php

                                        $idiomasAgrupados[$idioma][] = $asignatura;
                                    @endphp
                                @endforeach


                                @foreach ($idiomasAgrupados as $idioma => $asignaturasDelMismoIdioma)
                                    <tr>
                                        <td>{{ $idioma }}</td>
                                        <td>
                                            <select class="form-select"
                                                wire:model="idasignatura.{{ $idioma }}">
                                                <option value="">Elegir...</option>
                                                @foreach ($asignaturasDelMismoIdioma as $asignatura)
                                                    <option value="{{ $asignatura->id_planificar_asignatura }}">
                                                        {{-- {{ $asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                        {{ $asignatura->siadi_asignatura->nombre_asignatura }} -
                                                        {{ $asignatura->siadi_paralelo->nombre_paralelo }} - --}}

                                                        {{ $asignatura->turno_paralelo }}
                                                        {{ $asignatura->nombre_paralelo }}
                                                        {{ $asignatura->nombre_nivel_idioma }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @if (isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '')
                                            @php
                                            $asignaturaact=DB::selectOne("SELECT * FROM `siadi_planificar_asignaturas` WHERE`id_planificar_asignatura`=:asignatura",['asignatura'=> isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '']);
                                           $cupos=DB::selectOne("SELECT COUNT(*)AS cantidaddeprerosnasinscritas FROM `siadi_pre_inscripcions` WHERE `id_planificar_asignatura`=:asignatura",['asignatura'=> isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '']);
                                          $cuposdisponibles=$asignaturaact->cupo_maximo_paralelo-$cupos->cantidaddeprerosnasinscritas;
                                          
                                          @endphp
                                           @if ($cuposdisponibles==0)
                                            
                                                  MATERIA SIN CUPOS
                                              @else
                                                  
                                             <button class="btn btn-success"
                                                    wire:click="guardarasignaturas(  {{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }})">
                                                    PREINSCRIBIR - CUPOS DISPONIBLES {{$cuposdisponibles}}

                                                </button>
                                           @endif
                                                
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>



                        </table>
                       @if (count($materiaspreinsciptas)>0)
                             <div class="text-center">
                            <a class="btn btn-info" href="{{route('formulariopreinscripcionnuevo',$id_persona_guardado)}}">IMPRIMIR FORMULARIO DE PRE-INCRIPCIÓN</a>
                        </div>
                       @endif
                      
                    </div>
                </div>

            </div>
        </div>
    </div>


    

    <div class="modal fade" id="login_persona_existente" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="box-shadow: 10px 10px 2px rgb(5 218 195);">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Departamento de Idiomas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
               <div class="modal-body row">
                    
                  <div class="col-md-6 ">
                        <div class="mb-3">
                           <div class="col-md-12" align="center">
                              <img src="assetso/img/depto.png" class="img-fluid" width="200" height="200" alt="Imagen de ejemplo">
                           </div>
                        </div>
                        <div class="mb-3" align="center">
                            <label for="email" style="margin-bottom: 0px;" class="tp-section-title__pre p-relative text-uppercase mb-0">
                                <span class="title-pre-color">Ingresar Correo Electrónico</span>
                            </label>
                            
                            <!-- <input type="email" class="form-control" id="email" name="email" :value="old('email')" placeholder="1234567@upea.bo" title="Nota: carnet no debe tener expedido."> -->
                            <input type="email" class="form-control email-popovers" id="email" name="email" placeholder="1234567@upea.bo" title="Nota: carnet no debe tener expedido." data-bs-toggle="popover" data-bs-content="<span class='tp-section-title__pre p-relative' style='margin-bottom: 0px; font-size: 12px;'><span class='text-uppercase'>N.º</span> carnet@upea.bo: <span class='title-pre-color'>123456789@upea.bo</span></span><br><span class='tp-section-title__pre p-relative' style='margin-bottom: 0px; font-size: 12px;'><span class='text-uppercase'>N</span>ota: <span class='title-pre-color'>Carnet sin expedido</span></span>" autocomplete="off" data-bs-html="true" data-bs-trigger="hover focus" value="{{ $email }}">

                        </div>

                        <div class="mb-3" align="center">
                            <label for="password" style="margin-bottom: 0px;" class="tp-section-title__pre p-relative text-uppercase mb-0"><span class="title-pre-color">Contraseña <b style="color:black">Año-Mes-Dia</b></span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ej. 1996-12-21" autocomplete="off" >
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <!-- <div class="position-absolute" style="right: 5px; bottom: 10px;">
                                <input class="form-check-input d-none" type="checkbox" value="" id="botonLog">
                                <label class="form-check-label" for="botonLog">
                                    <i class="fa fa-eye-slash" aria-hidden="true" id="iconoLog"></i>
                                </label>
                            </div> -->
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                id="customControlInline" name="remember" />
                            <label class="form-check-label"
                                for="customControlInline">{{ __('Remember me') }}</label>
                        </div>
                        <!-- <div class="mt-4 text-center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted"><i
                                        class="mdi mdi-lock me-1"></i>
                                    {{ __('Forgot your password?') }}</a>
                            @endif
                        </div> -->
                  </div>
                  <div class="col-md-6 d-none d-md-block" align="center">
                     <img src="assetso/img/gamer.gif" class="img-fluid" width="300" height="300" alt="Imagen de ejemplo">
                  </div>
                </div>
                <div class="modal-footer">
                    <!-- <button class="tp-btn-3" style="padding: 10px 100px;" data-bs-dismiss="modal">Cancelar</button> -->
                    <button type="submit" class="tp-btn-2" style="padding: 10px 100px;" onclick="submitForm()">Ingresar</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    

    <div class="modal fade " id="registro_persona" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content" style="box-shadow: 10px 10px 2px rgb(5 218 195);">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">SI@DI - Depto. de Idiomas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="spacing"></div>
                </div>
                <div class="modal-body text-center">
                  <div class="col-md-12">
                        Complete los campos para su registro, una vez llenado debera realizar su preinscripciones
                    </div>
                    <div class="row">
                    <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">C.I.: </label>
                                <label class="form-control">{{$ci}}</label>
                                {{--<input type="text" class="form-control " wire:model="ci" disabled>--}}
                                @error('ci')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="expedido">EXPEDIDO:</label>
                                <select class="form-select @error('expedido') border-danger @enderror" wire:model="expedido" id="expedido">
                                    <option value="">Elegir...</option>
                                    @foreach ($EXPEDIDO_DATA as $expedi)
                                        <option value="{{ $expedi }}">{{ $expedi }}</option>
                                    @endforeach
                                </select>
                                @error('expedido')
                                    <span class="text-danger" for="expedido">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{--
                        <div class="col-lg-4 col-md-4">
                            <label for="tipo_documento" class="form-label">TIPO DOCUMENTO:</label>
                            <div class="col-lg-12 col-md-12 mb-3">
                                <select class="form-select @if($errors->has('tipo_documento')) is-invalid @endif" wire:model="tipo_documento" id="tipo_documento">
                                    <option value="">Seleccione</option>
                                    @foreach($tipo_documento_data as $tip_doc)
                                        <option value="{{ $tip_doc }}">{{ $tip_doc }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_documento')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        --}}




                        <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">NOMBRE:</label>
                                        <input type="text" class="form-control " wire:model="nombre">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PATERNO:</label>
                                <input type="text" class="form-control " wire:model="paterno">
                                @error('paterno')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">MATERNO:</label>
                                <input type="text" class="form-control " wire:model="materno">
                                @error('materno')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">ESTADO CIVIL:</label> <br>
                                <select class="form-select form-control" wire:model="estado_civil">
                                    <option value="">Elegir...</option>
                                    @foreach ($ESTADOS_CIVILES as $est_civ)
                                        <option value="{{ $est_civ }}">{{ $est_civ }}</option>
                                    @endforeach
                                </select>
                                <br>
                                @error('estado_civil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">TELEFONO:</label>
                                <input type="number" class="form-control " wire:model="telefono">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">CELULAR:</label>
                                <input type="number" class="form-control " wire:model="celular">
                                @error('celular')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">FECHA NACIMIENTO:</label>
                                <input type="date" class="form-control " placeholder="" wire:model="fecha_nac">
                                @error('fecha_nac')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PROFESION:</label>
                                <input type="text" class="form-control " placeholder="" wire:model="profesion">
                                @error('profesion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PAIS:</label>
                                <div class="mb-12">
                                <select class="form-select"wire:model="pais">
                                    <option value="">Elegir...</option>
                                    @foreach ($paises as $pa)
                                         <option value="{{$pa->id_siadi_pais }}">{{$pa->nombre_siadi_pais}}</option>
                                    @endforeach
                                   
                                </select>
                                {{-- <input type="text" class="form-control " wire:model="pais"> --}}
                                @error('pais')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">GENERO:</label>
                                <br>
                                <select class="form-select form-control" wire:model="genero_persona">
                                    <option>Elegir...</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select>
                                <br>
                                @error('genero_persona')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">DIRECCION - UBICACION:</label>
                                <input type="text" class="form-control " placeholder="" wire:model="direccion">
                                @error('direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">EMAIL:</label>
                                <label class="form-control ">{{$email}}</label>
                                <input type="email" class="form-control " wire:model="email" value="{{$email}}" hidden>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">TIPO DE ESTUDIANTE:</label>

                                <br>
                                <select class="js-example-basic-single js-states form-control" wire:model="tipo_estudiante">
                                    <option>Elegir...</option>
                                    @foreach ($tipo_estudiantes as $tip)
                                        <option value="{{ $tip->id_tipo_estudiante }}">
                                            {{ $tip->nombre_tipo_estudiante }}</option>
                                    @endforeach


                                </select>
                                <br>
                                @error('tipo_pago')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <!-- <div class="text-center"> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            <button type="button" class="btn btn-primary" wire:click="guardar_persona">GUARDAR</button>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="tp-btn-3" style="padding: 10px 100px;" data-bs-dismiss="modal" wire:click="cancelar">Cancelar</button>
                    <button class="tp-btn-2" style="padding: 10px 100px;" wire:click="guardar_persona">Guardar</button>
                </div>

            </div>
        </div>
    </div>


    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializePopover('.email-popovers');
        initializePopover('.ci-popovers');
    });

    function initializePopover(selector) {
        var popover = new bootstrap.Popover(document.querySelector(selector), {
            html: true
        });

        document.querySelector(selector).addEventListener('click', function () {
            popover.show();
        });
    }
</script>
<script>
    function submitForm() {
        // Deshabilita el botón para evitar múltiples clics
        document.getElementById('loginForm').submit();
        document.querySelector('#login_persona_existente button[type="submit"]').disabled = true;
    }
</script>


@push('navi-js-front')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('closeModalCreate', function() {
                $('#registro_persona').modal('hide');
            });
        });
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirmodaltomarasignaturas', function() {
                $('#modaltomarasignatura').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('cerrarvalidacionperosna', function() {
                $('#loginModal').modal('hide');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirlogin', function() {
                $('#login_persona_existente').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('registropersonapreinscripcion', function() {
                $('#registro_persona').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirmodaltomarmateria', function() {
                $('#tomarmateria').modal('show');
            });
        });
    </script>



    <!-- <script>
        document.addEventListener('livewire:load', function() {
            const botonCheck = document.querySelector('#botonLog');
            const icono = document.querySelector('#iconoLog');
            const inputPassword = document.querySelector('#password');
            botonCheck.addEventListener('click', ()=>{
                if(botonCheck.checked){
                    icono.classList.remove('fa-eye-slash');
                    icono.classList.remove('fa-eye');
                    icono.classList.add('fa-eye');
                    inputPassword.type = "password";
                } else {
                    icono.classList.remove('fa-eye');
                    icono.classList.remove('fa-eye-slash');
                    icono.classList.add('fa-eye-slash');
                    inputPassword.type = "text";
                }
            });
        });
    </script> -->
@endpush
