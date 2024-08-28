<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">PREINSCRIPCIONES</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">preinscripcion</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <form action="{{ route('inscripcion_anular.store') }}" method="post" id="formularioanular">
            @csrf
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#crearnuevapreinscripcion">AGREGAR PRE INSCRIPCIÓN</button>
                                    <a class="btn btn-warning" onclick="seleccionar_todo()"> (+) </a>
                                    <a class="btn btn-danger" onclick="dessleccionar_todo()"> (-) </a>

                                    <button class="btn btn-danger"id="eliminarPreInscripcion"
                                        id="eliminarPreInscripcion" onclick="enviarFormulario()">ANULAR PREINSCIPCIONES
                                    </button>
                                    @foreach ($preinscipcionesaular as $item)
                                        {{ $item }}
                                    @endforeach
                                    <input type="text" class="form-control col-md-6" wire:model="search"
                                        placeholder="Buscar...">
                                    @error('holaaa')
                                        {{ $message }}
                                    @enderror

                                </div>
                            </div>


                        </div>

                        <br>



                        @if ($personapreinscrita->count())


                            <div class="table-responsive">
                                <table class="table table-hover mb-0">

                                    <thead>
                                        <tr>

                                            <th>N°</th>
                                            <th>SELECCIÓN </th>
                                            <th>CI PERSONA</th>
                                            <th>NOMBRE ESTUDIANTE</th>
                                            <th>TIPO ESTIANTE</th>
                                            <th>ACCIÓNES</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                        @endphp
                                        @foreach ($personapreinscrita as $personapreinscrit)
                                            <tr>

                                                <td>
                                                    @php
                                                        echo $cont;
                                                        $cont++;
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        $dosDiasAtras = strtotime('-2 days');
                                                        foreach ($personapreinscrit->persona_preinscrita as $valuepre) {
                                                            $createdTimestamp = strtotime($valuepre->created_at);
                                                            $esMenorIgualDosDias = $createdTimestamp >= $dosDiasAtras;
                                                        }
                                                    @endphp
                                                    {{-- @if ($esMenorIgualDosDias == true) --}}
                                                    <input type="checkbox"
                                                        value="{{ $personapreinscrit->id_siadi_persona }}"
                                                        id="id_siadi_persona[]" name="id_siadi_persona[]"
                                                        autocomplete="off">


                                                    {{-- @else --}}
                                                    {{-- <input type="checkbox" class="btn-check"
                                            value="{{ (string) $personapreinscrit->id_siadi_persona }}"
                                            id="{{ $personapreinscrit->id_siadi_persona }}"
                                            autocomplete="off"
                                            wire:model="preinscipcionesaular.{{ $personapreinscrit->id_siadi_persona }}"
                                            {{ in_array((string) $personapreinscrit->id_siadi_persona, $preinscipcionesaular) ? 'checked' : '' }}
                                            >
                                            <label class="btn btn-outline-danger"
                                            for="{{ $personapreinscrit->id_siadi_persona }}">A</label> --}}
                                                    {{-- @endif --}}

                                                </td>
                                                <td>
                                                    {{ $personapreinscrit->ci_persona }}
                                                </td>

                                                <td>

                                                    {{ $personapreinscrit->paterno_persona }}
                                                    {{ $personapreinscrit->materno_persona }}
                                                    {{ $personapreinscrit->nombres_persona }}
                                                </td>
                                                <td>
                                                    {{ $personapreinscrit->tipo_estudiante->nombre_tipo_estudiante }}
                                                </td>


                                                <td>
                                                    {{-- @if ($insc->observacion_inscripcion == 'INSCRITO')
                                            <button type="button" class="btn btn-outline-success waves-effect waves-light">INSCRITO</button>
                                            @else --}}

                                                    <button type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light"
                                                        wire:click="inscribirestudiante({{ $personapreinscrit->id_siadi_persona }})">INSCRIBIR</button>

                                                    <button type="button"
                                                        class="btn btn-outline-danger waves-effect waves-light"
                                                        wire:click="inscribireditar({{ $personapreinscrit->id_siadi_persona }})">EDITAR
                                                        INSCRIPCIÓN</button>
                                                    {{-- @endif --}}
                                                    {{-- <a href="{{ route('imprimir_reporte_preinscripcion', $insc->id_pre_inscripcion) }}" type="button" class="btn btn-outline-danger waves-effect waves-light"> <i class="fa fa-print"></i>
                                            </a> --}}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="d-flex justify-content-center">

                                {{ $personapreinscrita->links() }}
                            </div>

                    </div>
                @else
                    <div class="px-5 py-3 border-gray-200  text-sm">
                        <strong>No hay Registros</strong>
                    </div>
                    @endif

                </div>
            </div>
        </form>

        {{-- INICIO PRUEBa --}}
        <div wire:ignore.self id="crearnuevapreinscripcion" class="modal fade bs-example-modal-xl" tabindex="-1"
        role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="cancelarpreinscripcion"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row justify-content-md-center">
                            <div class="col-md-8 text-center">
                                <h2>.::CREAR NUEVA PREINSCRIPCIÓN::.</h2>
                                <h3>.:: BUSCAR ESTUDIANTE::. </h3>

                                <div class="input-group mb-3">
                                    <input type="search" class="form-control" placeholder="Buscador por CI"
                                        wire:model="ciestudiante">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>`
                                </div>

                                @error('estudiantenoencontrado')
                                    <div class="alert alert-danger" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror

                                <br>

                                @if ($nombre_estudiante)
                                    <h2>{{ $nombre_estudiante }}</h2>
                                @endif
                            </div>
                        </div>

                        @if ($id_estudiante_encontrado)


                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>IDIOMA</th>
                                            <th>ASIGNATURA</th>
                                            <th>INSCRIPCIÓN POR ASIGNATURA</th>
                                            <th>NRO DE DEPÓSITO</th>
                                            <th>FECHA DE DEPOSITO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- ayamara: {{ $materiaActualAymara }} - ingles:
                                    {{ $materiaActualIngles }} asignaturassssssssssssssssssss --}}
                                        {{-- @foreach ($materiasaprobadas as $materias)
                                    {{ $materias->id_inscripcion }}
                                    @endforeach
                                    saadadsada --}}
                                        {{-- @foreach ($idiomasExcluidos as $item)
                                    {{ $item }}
                                    @endforeach --}}

                                        @foreach ($materiaAtomarhabilitadas as $asignaturas)
                                            @if (!empty($asignaturas) && count($asignaturas) > 0)
                                                @php
                                                    $idioma = $asignaturas[0]->nombre_idioma;
                                                @endphp
                                                <tr>

                                                    <td>{{ $idioma }}</td>
                                                    <td>
                                                        <select class="form-select"
                                                            wire:model="idasignatura.{{ $idioma }}">
                                                            <option value="">Elegir...</option>
                                                            @foreach ($asignaturas as $asignatura)
                                                                <option
                                                                    value="{{ $asignatura->id_planificar_asignatura }}">

                                                                    IDIOMA: {{ $asignatura->nombre_idioma }} /
                                                                    {{ $asignatura->nombre_nivel_idioma }} - PARALELO:
                                                                    {{ $asignatura->turno_paralelo }} /
                                                                    {{ $asignatura->nombre_paralelo }}

                                                                    - MODALIDAD:
                                                                    {{ $asignatura->nombre_convocatoria_estudiante }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>


                                                        @if (isset($nroDeposito[$idioma]) &&
                                                                $nroDeposito[$idioma] !== '' &&
                                                                isset($fechaDeposito[$idioma]) &&
                                                                isset($idasignatura[$idioma]) &&
                                                                $idasignatura[$idioma] !== '')
                                                            @php
                                                                $asignaturaact = DB::selectOne('SELECT * FROM `siadi_planificar_asignaturas` WHERE`id_planificar_asignatura`=:asignatura', ['asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '']);
                                                                $cupos = DB::selectOne('SELECT COUNT(*)AS cantidaddeprerosnasinscritas FROM `siadi_pre_inscripcions` WHERE `id_planificar_asignatura`=:asignatura', ['asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '']);
                                                                $cuposdisponibles = $asignaturaact->cupo_maximo_paralelo - $cupos->cantidaddeprerosnasinscritas;

                                                            @endphp

                                                            {{-- @if ($cuposdisponibles == 0)
                                    MATERIA SIN CUPOS
                                    @else --}}
                                                            @php

                                                                $existencia_de_preinscripcion = DB::select("SELECT * FROM siadi_pre_inscripcions WHERE id_siadi_persona=:persona AND id_planificar_asignatura=:asignatura AND estado_inscripcion ='ACTIVO' ;", [
                                                                    'asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '',
                                                                    'persona' => $id_estudiante_encontrado,
                                                                ]);
                                                            @endphp
                                                            @if ($existencia_de_preinscripcion)
                                                                <button class="btn btn-danger"
                                                                    wire:click="anular_preincripcion({{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }},{{ $id_estudiante_encontrado }})">CANCELAR
                                                                    PRE-INCRIPCIÓN</button>
                                                            @else
                                                                <button class="btn btn-success"
                                                                    wire:click="preinscibir({{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }}, {{ isset($nroDeposito[$idioma]) ? $nroDeposito[$idioma] : '' }},'{{ isset($fechaDeposito[$idioma]) ? $fechaDeposito[$idioma] : '' }}' )">
                                                                    PREINSCRIBIR - CUPOS DISPONIBLES
                                                                    {{ $cuposdisponibles }}
                                                                </button>
                                                            @endif
                                                            {{-- @endif --}}
                                                        @else
                                                            <span class="text-danger">-------</span>
                                                        @endif


                                                    </td>

                                                    <td>
                                                        @if (isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '')
                                                            <input type="number" class="form-control" required
                                                                wire:model="nroDeposito.{{ $idioma }}">
                                                            @error('nroDeposito.' . $idioma)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span>---------</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '')
                                                            <input type="date" class="form-control"required
                                                                wire:model="fechaDeposito.{{ $idioma }}">
                                                            @error('fechaDeposito.' . $idioma)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span>---------</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @php
                                            $idiomasAgrupados = [];
                                        @endphp

                                        @foreach ($OtrasAsignaturasHabilitadas as $asignatura)
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

                                                                IDIOMA: {{ $asignatura->nombre_idioma }} /
                                                                {{ $asignatura->nombre_nivel_idioma }} - PARALELO:
                                                                {{ $asignatura->turno_paralelo }} /
                                                                {{ $asignatura->nombre_paralelo }}

                                                                - MODALIDAD:
                                                                {{ $asignatura->nombre_convocatoria_estudiante }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    @if (isset($nroDeposito[$idioma]) &&
                                                            $nroDeposito[$idioma] !== '' &&
                                                            isset($fechaDeposito[$idioma]) &&
                                                            isset($idasignatura[$idioma]) &&
                                                            $idasignatura[$idioma] !== '')
                                                        @php
                                                            $asignaturaact = DB::selectOne('SELECT * FROM `siadi_planificar_asignaturas` WHERE`id_planificar_asignatura`=:asignatura', ['asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '']);
                                                            $cupos = DB::selectOne('SELECT COUNT(*)AS cantidaddeprerosnasinscritas FROM `siadi_pre_inscripcions` WHERE `id_planificar_asignatura`=:asignatura', ['asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '']);
                                                            $cuposdisponibles = $asignaturaact->cupo_maximo_paralelo - $cupos->cantidaddeprerosnasinscritas;

                                                        @endphp

                                                        {{-- @if ($cuposdisponibles == 0)
                        MATERIA SIN CUPOS
                        @else --}}
                                                        @php

                                                            $existencia_de_preinscripcion = DB::select("SELECT * FROM siadi_pre_inscripcions WHERE id_siadi_persona=:persona AND id_planificar_asignatura=:asignatura AND estado_inscripcion ='ACTIVO' ;", [
                                                                'asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '',
                                                                'persona' => $id_estudiante_encontrado,
                                                            ]);
                                                        @endphp
                                                        @if ($existencia_de_preinscripcion)
                                                            <button class="btn btn-danger"
                                                                wire:click="anular_preincripcion({{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }},{{ $id_estudiante_encontrado }})">CANCELAR
                                                                PRE-INCRIPCIÓN</button>
                                                        @else
                                                            <button class="btn btn-success"
                                                                wire:click="preinscibir({{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }}, {{ isset($nroDeposito[$idioma]) ? $nroDeposito[$idioma] : '' }},'{{ isset($fechaDeposito[$idioma]) ? $fechaDeposito[$idioma] : '' }}' )">
                                                                PREINSCRIBIR - CUPOS DISPONIBLES
                                                                {{ $cuposdisponibles }}
                                                            </button>
                                                        @endif
                                                    @else
                                                        <span class="text-danger">-------</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '')
                                                        <input type="number" class="form-control" required
                                                            wire:model="nroDeposito.{{ $idioma }}">
                                                        @error('nroDeposito.' . $idioma)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @else
                                                        <span>---------</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '')
                                                        <input type="date" class="form-control"required
                                                            wire:model="fechaDeposito.{{ $idioma }}">
                                                        @error('fechaDeposito.' . $idioma)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    @else
                                                        <span>---------</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                Nota. Realiza la busqueda del estudiante por su carnet de identidad para ver las materias
                                disponibles para su preinscripción.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>


                        @endif
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelarpreinscripcion">CANCELAR</button>
                            {{-- @if ($idasignatura)
                            <button wire:click="preinscribir_array"
                            class="btn btn-primary waves-effect waves-light">
                        PRE-INSCRIBIR ESTUDIANTE</button>
                        </div>
                        @endif --}}

                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>
        {{-- fin prueba --}}
    </div>
    <div wire:ignore.self id="editar_inscripcion" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">

                    <div class="row col-md-12" x-data="{ mostrarEdicion: false }">

                        <br>
                        <div class="col-md-12">
                            <div class="mb-12">

                                <center>
                                    <h3>.::ASIGNATURAS INSCRITAS::.</h3>
                                </center>
                                @if ($personaunica)
                                    <div class="text-center">
                                        <h4> NOMBRE: {{ $personaunica->nombres_persona }}
                                            {{ $personaunica->paterno_persona }} {{ $personaunica->materno_persona }}
                                            C.I.:{{ $personaunica->ci_persona }} </h4>
                                    </div>


                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>IDIOMA</th>
                                                    <th>DESCRIPCIÓN</th>
                                                    <th>NOTA FINAL</th>
                                                    <th>ESTADO</th>

                                                </tr>
                                            </thead>
                                            <tbody>



                                                @foreach ($personaunica->persona_inscrita as $inscp)
                                                    <tr>
                                                        <td>
                                                            {{ $inscp->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                        </td>
                                                        <td>
                                                            {{ $inscp->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                            {{ $inscp->planificar_asignatura->siadi_paralelo->nombre_paralelo }}
                                                            {{ $inscp->planificar_asignatura->turno_paralelo }}

                                                        </td>
                                                        <td>{{ $inscp->notas->final_nota }}</td>
                                                        <td>{{ $inscp->notas->observacion_nota }}</td>

                                                        <td>

                                                            <button class="btn btn-info"
                                                                x-on:click="mostrarEdicion = true"
                                                                wire:click="editarasig({{ $inscp->id_inscripcion }})">EDITAR</button>
                                                        </td>

                                                    </tr>
                                                @endforeach


                                            </tbody>

                                        </table>


                                    </div>
                                    <div class="row" x-show="mostrarEdicion">
                                        <div class="text-center">
                                            <h4>EDITAR INSCRIPCIÓN</h4>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <label class="form-label text-center">ASIGNATURA :
                                                    {{ $nombre_asignatura_edit }}
                                                </label>
                                                <select class="form-select" wire:model="asignaturaGuardar">

                                                    @foreach ($asignaturas_validas as $asinaturasval)
                                                        <option value="{{ $asinaturasval->id_planificar_asignatura }}">
                                                            {{ $asinaturasval->nombre_idioma }}
                                                            {{ $asinaturasval->nombre_nivel_idioma }}
                                                            PARALELO:
                                                            {{ $asinaturasval->nombre_paralelo }}
                                                            {{ $asinaturasval->turno_paralelo }}</option>
                                                    @endforeach

                                                </select>
                                                @error('asignaturaGuardar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="text-center">
                                            <button class="btn btn-success" wire:click="guardareditarinscripcion"
                                                x-on:click="mostrarEdicion = false"> GUARDAR</button>
                                            <button class="btn btn-danger" x-on:click="mostrarEdicion = false">
                                                CANCELAR</button>
                                        </div>

                                    </div>
                                    <br>
                                    <br>
                                    <br>

                                @endif


                            </div>


                        </div>

                        <div class="text-center"> <button type="button" class="btn btn-danger waves-effect"
                                data-bs-dismiss="modal" x-on:click="mostrarEdicion = false">CANCELAR</button></div>

                    </div>





                </div>





            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <div wire:ignore.self id="inscribirestudiantemodal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">

                    <div class="row col-md-12">
                        <center>
                            <h2>
                                .::FORMULARIO DE INSCRIPCION::.
                            </h2>
                            <h3>.::ESTUDIANTE::. : </h3>
                            <br>
                            <h2>{{ $estudiante }} </h2>
                        </center>
                        <br>
                        <div class="col-md-12">
                            <div class="mb-12">

                                @if ($materias_preinscritas->count())
                                    <center>.::ASIGNATURAS PREINSCRINCRITAS::.</center>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead
                                                style="background: #56ab2f;  background: -webkit-linear-gradient(to right, #a8e063, #56ab2f); background: linear-gradient(to right, #a8e063, #56ab2f); ">
                                                <tr>
                                                    <th>GESTIÓN</th>
                                                    <th>SEDE</th>
                                                    <th>PARALELO / TURNO</th>
                                                    <th>CURSO</th>
                                                    <th>ASIGNATURA</th>
                                                    <th>SIGLA</th>
                                                    <th>MODALIDAD</th>
                                                    <th>MATERIAS A INSCRIBIR</th>

                                                    <th>ANULAR</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($materias_preinscritas as $materiass)
                                                    <tr class="table-success">
                                                        <td>{{ $materiass->planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion }}/
                                                            {{ $materiass->planificar_asignatura->siadi_convocatoria->periodo }}
                                                        </td>
                                                        <td> {{ $materiass->planificar_asignatura->siadi_convocatoria->siadi_sede->sede_upea->nombre }}
                                                        </td>
                                                        <td>
                                                            {{ $materiass->planificar_asignatura->siadi_paralelo->nombre_paralelo }}
                                                            <span class="text-uppercase">[{{ $materiass->planificar_asignatura->turno_paralelo }}]<span>

                                                        </td>
                                                        <td> {{ $materiass->planificar_asignatura->siadi_convocatoria->siadi_sede->direccion }}
                                                        </td>
                                                        <td> {{ $materiass->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                            {{ $materiass->planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                                            {{ $materiass->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                        </td>
                                                        <td> {{ $materiass->planificar_asignatura->siadi_asignatura->idioma->sigla_codigo_idioma }}
                                                        </td>
                                                        <td>
                                                            {{ $materiass->planificar_asignatura->siadi_convocatoria->modalidad->nombre_convocatoria_estudiante }}
                                                            {{ $materiass->planificar_asignatura->siadi_convocatoria->nro_libro }}
                                                        </td>

                                                        <td>
                                                            @if ($materiass->observacion_inscripcion == 'INSCRITO')
                                                                ESTUDIANTE INSCRITO
                                                            @elseif ($materiass->observacion_inscripcion == 'OBSERVADO')
                                                                PREINSCRIPCIÓN CON OBSERVACIÓN
                                                            @else
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="{{ $materiass->id_pre_inscripcion }}"
                                                                        wire:model="asignaturas" switch="success"
                                                                        value="{{ $materiass->id_pre_inscripcion }}"
                                                                        checked />
                                                                    <label class="form-check-label"
                                                                        for="{{ $materiass->id_pre_inscripcion }}"
                                                                        data-on-label="Si"
                                                                        data-off-label="No"></label>
                                                                </div>
                                                                @error('asignaturas')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($materiass->observacion_inscripcion == 'INSCRITO')
                                                                ESTUDIANTE INSCRITO
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-outline-warning waves-effect waves-light"
                                                                    wire:click="anular_preinscripcion({{ $materiass->id_pre_inscripcion }})">ANULAR</button>
                                                            @endif

                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div class="row col-md-12">
                                            <div class="col-md-6">
                                                {{-- <label for="" class="form-label">NRO DE FOLIO:</label>
                                                <input type="text" wire:model="nro_folio" class="form-control">
                                                @error('nro_folio')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror --}}
                                            </div>

                                        </div>
                                    </div>
                                @else
                                    SIN MATERIAS PREINSCRITAS
                                @endif
                            </div>


                        </div>



                    </div>





                </div>

                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="cancelar">CANCELAR</button>
                    <button wire:click="guardar_inscripcion_estudiante"
                        class="btn btn-primary waves-effect waves-light">GUARDAR
                        INSCRIPCION</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('abrimodalinscripcion', function() {
                        $('#inscribirestudiantemodal').modal('show');
                    });
                    Livewire.on('abrimodaleditarinscripcion', function() {
                        $('#editar_inscripcion').modal('show');
                    });
                    Livewire.on('cerrarmodalinscripcion', function() {
                        $('#inscribirestudiantemodal').modal('hide');
                    });
                    Livewire.on('cerrarmodalinscripcion', function() {
                        $('#inscribirestudiantemodal').modal('hide');
                    });
                });

                function seleccionar_todo() {
                    //Seleccionar todos
                    $("input:checkbox").prop('checked', true);
                    $("input[type=checkbox]").prop('checked', true);
                }

                function dessleccionar_todo() {
                    //Deseleccionar todos
                    $("input:checkbox").prop('checked', false);
                    $("input[type=checkbox]").prop('checked', false);
                }


                livewire.on('inscribirestudiante', id_preinscripcion => {
                    Swal.fire({
                        title: 'Esta seguro de inscribir al Estudiante?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, inscribir a las materias!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            // livewire.emitTo('servidor-index', 'delete', ServidorId);
                            livewire.emit('inscripbir', id_preinscripcion);


                        }
                    })
                });

                function enviarFormulario() {
                    // Obtener el formulario por su ID
                    var formulario = document.getElementById('formularioanular');

                    // Enviar el formulario
                    if (formulario) {
                        formulario.submit();
                    }
                }
            </script>
        @endpush
