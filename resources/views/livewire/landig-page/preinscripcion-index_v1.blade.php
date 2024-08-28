<div>


    {{-- <section class="cta-bg-section bg_cover pt-100 pb-50 p-r z-1"
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
    </div> --}}

    <!-- Modal registro persona -->
    <div class="modal fade popup" id="registro_persona" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
            <div class="modal-content">
                <div class="close icon" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/risebothtml/assets/images/backgroup/bg_close.png') }}" alt="">
                </div>
                <div class="header-popup">
                    <h5>SI@DI - Depto. de Idiomas</h5>

                    <div class="desc">
                        Complete los campos para su registro, una vez llenado debera realizar su preinscripciones
                    </div>
                    <div class="spacing"></div>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">C.I.: </label>

                                <input type="text" class="form-control " wire:model="ci" disabled>
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
                            <label class="form-label" for="tipo_documento">TIPO DOCUMENTO:</label>
                            <select class="form-select @if($errors->has('tipo_documento')) border-danger @endif" wire:model="tipo_documento" id="tipo_documento">
                                <option value="">Seleccione</option>
                                @foreach($tipo_documento_data as $tip_doc)
                                    <option value="{{$tip_doc}}">{{$tip_doc}}</option>
                                @endforeach
                            </select>
                            @error('tipo_documento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                        <div class="text-center"> <button type="button" class="btn btn-secondary"
                                data-dismiss="modal" aria-label="Close">CANCELAR</button>
                            <button type="button" class="btn btn-primary"
                                wire:click="guardar_persona">GUARDAR</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Primer modal ingreso -->
    <div class="modal fade popup" id="loginmodal" wire:ignore.self tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="close icon" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/risebothtml/assets/images/backgroup/bg_close.png') }}" alt="">
                </div>
                <div class="header-popup">
                    <h5>SI@DI - Depto. de Idiomasx</h5>
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    @error('CiIngreso')
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">

                                <li>{{ $message }}</li>

                            </ul>
                        </div>
                    @enderror
                    {{-- @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                    <div class="desc">
                        Ingrese el Nro  C.I.
                    </div>
                    <div class="spacing"></div>
                </div>
                <style>

                </style>
                <div class="modal-body text-center">
                    <div class="connect-wallet">
                        <input type="text" class="form-control" placeholder="CI... sin expedido"
                            wire:model="CiIngreso">
                    </div>
                    <br>
                    <button class="btn btn-primary tf-button  " wire:click="validar_ci_user">INGRESAR</button>
                </div>

            </div>
        </div>
    </div>
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


    <div class="modal fade popup" id="login_persona_existente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="close icon" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/risebothtml/assets/images/backgroup/bg_close.png') }}" alt="">
                </div>
                <div class="header-popup">

                    <h5>SI@DI - Depto. de Idiomaos</h5>
                    <div class="desc">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-2">
                                    <div class="p-2">

                                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="mb-3">
                                                <label class="form-label"
                                                    for="email">{{ __('Ingresar Correo Electronico Ej. idioma@upea.bo') }}</label>
                                                <x-input id="email" class="form-control" type="email"
                                                    name="email" :value="old('email')" required autofocus
                                                    autocomplete="username" aria-placeholder="Ej. idiomas@upea.bo" />
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <label class="form-label"
                                                    for="password">{{ __('Ingrear su contraseña Ej. 1994-12-21') }}</label>
                                                <x-input id="password" class="form-control" type="password"
                                                    name="password" required autocomplete="current-password"
                                                    aria-placeholder="Ej. 1996-12-21" />
                                                <div class="position-absolute" style="right: 5px; bottom: 10px;">
                                                    <input class="form-check-input d-none" type="checkbox" value="" id="botonLog">
                                                    <label class="form-check-label" for="botonLog">
                                                        <i class="fa fa-eye-slash" aria-hidden="true" id="iconoLog"></i>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="customControlInline" name="remember" />
                                                <label class="form-check-label"
                                                    for="customControlInline">{{ __('Remember me') }}</label>
                                            </div>

                                            <div class="mt-3">
                                                <x-button class="btn btn-primary w-100 waves-effect waves-light"
                                                    type="submit">{{ __('INGRESAR') }}</x-button>
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
                    <div class="spacing"></div>
                </div>


            </div>
        </div>
    </div>
</div>
@push('navi-js-front')
    preinscripcion
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
                $('#loginmodal').modal('hide');
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
    <script>
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
    </script>
@endpush
