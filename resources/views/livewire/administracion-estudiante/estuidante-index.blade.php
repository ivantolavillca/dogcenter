<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓN ESTUDIANTE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active"> Estudiante</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (count($materias_preinscritas) > 0)
                        <div class="text-center">
                            <h3>MATERIAS PRE - INSCRITAS</h3>

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>ASIGNATURA PRE - INSCRITA</td>
                                        <td>NRO DE DEPÓSITO</td>
                                        <td>FECHA DE DEPÓSITO</td>
                                        <td> CANCELAR PRE - INSCRIPCIÓN</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materias_preinscritas as $pre)
                                        @if ($pre->planificar_asignatura->estado_planificar_asignartura == 'ACTIVO')
                                            <tr>
                                                <th>
                                                    {{ $pre->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                    {{ $pre->planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                                    {{ $pre->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}

                                                    {{ $pre->planificar_asignatura->siadi_paralelo->nombre_paralelo }} -
                                                    {{ $pre->planificar_asignatura->turno_paralelo }}
                                                </th>
                                                <th>
                                                    {{ $pre->nro_deposito }}
                                                </th>
                                                <th>{{ $pre->fecha_inscripcion }}</th>
                                                <th>
                                                    @if($pre->observacion_inscripcion!=='INSCRITO')
                                                    <button class="btn btn-danger"
                                                        wire:click="cancelar_preinscripcion({{ $pre->id_pre_inscripcion }})">CANCELAR
                                                        PRE INSCRIPCIÓN</button>
                                                    @else
                                                        <b>INSCRITO</b>
                                                    @endif

                                                </th>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif


                    {{-- @php
                        $asignaturas_habilitadas = DB::select("
                    SELECT * FROM `siadi_planificar_asignaturas` AS spa INNER JOIN siadi_convocatorias AS sc ON spa.id_siadi_convocatoria= sc.id_siadi_convocatoria INNER JOIN siadi_tipo_convocatorias AS stc ON sc.id_tipo_convocatoria=stc.id_tipo_convocatoria INNER JOIN siadi_convocartoria_estudiantes AS sce ON stc.id_convocartoria_estudiante= sce.id_convocartoria_estudiante WHERE `estado_planificar_asignartura`='ACTIVO'AND sce.nombre_convocatoria_estudiante NOT LIKE '%HOMOL%'AND sce.nombre_convocatoria_estudiante NOT LIKE '%CONV%';
                        ");
                    @endphp
                    @if ($asignaturas_habilitadas) --}}
                        <div class="text-center">
                            <h4>PREINSCRIPCIÓN</h4>
                        </div>


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th>IDIOMA </th>
                                        <th>ASIGNATURA</th>
                                        <th>NRO DE DEPÓSITO</th>
                                        <th>FECHA DE DEPÓSITO</th>
                                        <th>TOMAR ASIGNATURA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- ayamara: {{ $materiaActualAymara }} - ingles:
                            {{ $materiaActualIngles }} asignaturassssssssssssssssssss
                            @foreach ($materiasaprobadas as $materias)
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

                                                        @if ($cuposdisponibles == 0)
                                                            MATERIA SIN CUPOS
                                                        @else
                                                            @php
                                                                $persona = Auth::user();
                                                                $existencia_de_preinscripcion = DB::select("SELECT * FROM siadi_pre_inscripcions WHERE id_siadi_persona=:persona AND id_planificar_asignatura=:asignatura AND estado_inscripcion ='ACTIVO' ;", [
                                                                    'asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '',
                                                                    'persona' => $persona->id_persona_siadi,
                                                                ]);
                                                            @endphp
                                                            @if ($existencia_de_preinscripcion)
                                                                <button class="btn btn-danger"
                                                                    wire:click="anular_preincripcion({{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }},{{ Auth::user()->id_persona_siadi }})">CANCELAR 
                                                                    PRE-INCRIPCIÓN</button>
                                                            @else
                                                                <button class="btn btn-success"
                                                                    wire:click="preinscibir(  {{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }},{{ Auth::user()->id_persona_siadi }},{{ isset($nroDeposito[$idioma]) ? $nroDeposito[$idioma] : '' }},'{{ isset($fechaDeposito[$idioma]) ? $fechaDeposito[$idioma] : '' }}' )">
                                                                    PREINSCRIBIR - CUPOS DISPONIBLES
                                                                    {{ $cuposdisponibles }}

                                                                </button>
                                                            @endif
                                                        @endif
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

                                                    @if ($cuposdisponibles == 0)
                                                        MATERIA SIN CUPOS
                                                    @else
                                                        @php
                                                            $persona = Auth::user();
                                                            $existencia_de_preinscripcion = DB::select("SELECT * FROM siadi_pre_inscripcions WHERE id_siadi_persona=:persona AND id_planificar_asignatura=:asignatura AND estado_inscripcion ='ACTIVO' ;", [
                                                                'asignatura' => isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '',
                                                                'persona' => $persona->id_persona_siadi,
                                                            ]);
                                                        @endphp
                                                        @if ($existencia_de_preinscripcion)
                                                            <button class="btn btn-danger"
                                                                wire:click="anular_preincripcion({{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }},{{ Auth::user()->id_persona_siadi }})">CANCELAR 
                                                                PRE-INCRIPCIÓN</button>
                                                        @else
                                                            <button class="btn btn-success"
                                                                wire:click="preinscibir(  {{ isset($idasignatura[$idioma]) ? $idasignatura[$idioma] : '' }},{{ Auth::user()->id_persona_siadi }},{{ isset($nroDeposito[$idioma]) ? $nroDeposito[$idioma] : '' }},'{{ isset($fechaDeposito[$idioma]) ? $fechaDeposito[$idioma] : '' }}' )">
                                                                PREINSCRIBIR - CUPOS DISPONIBLES
                                                                {{ $cuposdisponibles }}

                                                            </button>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>

                        @php

                            $listaAsignaturaInscrito = DB::select(
                                "SELECT *
                                FROM siadi_pre_inscripcions
                                    WHERE id_siadi_persona = :user
                                AND estado_inscripcion = 'ACTIVO'
                         AND created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH);",
                                ['user' => Auth::user()->id_persona_siadi],
                            );
                        @endphp
                        @if (count($listaAsignaturaInscrito) > 0)
                            <div class="text-center"> <a class="btn btn-info"
                                    href="{{ route('form_cert_preinscip', $persona_auth->id_persona_siadi) }}">IMPRIMIR
                                    FORMULARIO DE PRE-INCRIPCIÓN</a> </div>
                        @endif

                    {{-- @endif --}}




                </div>

                <hr>
                <h3 class="text-center">Materias Disponibles({{ count($materias_prueba) }})</h3>
                <ul>
                    @foreach ($materias_prueba as $listado)
                        <li>{{ $listado->nombre_idioma . ' ' . $listado->nombre_nivel_idioma }}
                            <b>{{ $listado->nombre_convocatoria_estudiante . ' - ' . $listado->tipo_costo }}</b></li>
                    @endforeach
                </ul>
                <hr>
                <h3 class="text-center">Materias Aprobadas ({{ count($mat_aprobados) }})</h3>
                <ul>
                    @foreach ($mat_aprobados as $listado)
                        <li>{{ $listado->materia_ap }} <b>{{ $listado->modalidad }}</b></li>
                    @endforeach
                </ul>
                <h3 class="text-center">Materias Posibles ({{ count($mat_inscribir) }})</h3>
                <ul>
                    @foreach ($mat_inscribir as $listado)
                        <li>{{ $listado->nombre_idioma . ' ' . $listado->nombre_nivel_idioma }}
                            <b>{{ $listado->nombre_convocatoria_estudiante . ' - ' . $listado->tipo_costo }}</b></li>
                    @endforeach
                </ul>

                <h3 class="text-center">Materias Inscribir ({{ count($mat_segundo) }})</h3>
                <ul>
                    @foreach ($mat_segundo as $listado)
                        {{-- <li>{{ $listado->nombre_idioma . ' ' . $listado->ultimo_nivel }}</li> --}}
                        <li>{{ json_encode($listado) }}</li>
                    @endforeach
                </ul>

                <hr>
                @if(count($inscripciones)>0)
                    <div class="text-center">
                        <h4>PREINSCRIPCIÓN 2DO</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th>IDIOMA</th>
                                    <th>NIVEL</th>
                                    <th>PARALELO - TURNO - PARALELO</th>
                                    <th>NRO DE DEPÓSITO</th>
                                    <th>FECHA DE DEPÓSITO</th>
                                    <th>TOMAR ASIGNATURA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripciones as $asignatura_tomar)
                                    <tr>
                                        <td>{{$asignatura_tomar->sigla_codigo_idioma}} <b>{{$asignatura_tomar->nombre_idioma}}</b></td>
                                        <td>{{$asignatura_tomar->descripcion_nivel_idioma}} <b>{{$asignatura_tomar->nombre_nivel_idioma}}</b></td> 
                                        <td>{{--$asignatura_tomar->nombre_paralelo}} - {{$asignatura_tomar->turno_paralelo}}
                                            @if($asignatura_tomar->turno_paralelo!=="Sin Turno")
                                                ({{$asignatura_tomar->hora_clases_inicio .' - '. $asignatura_tomar->hora_clases_fin}})
                                            @endif
                                            .:: {{$asignatura_tomar->modalidad--}}
                                            <select class="form-select" wire:model="">
                                                <option value="">Elegir...</option>
                                                @foreach($asignatura_tomar->paralelos_habilitados as $materia)
                                                    <option value="">{{$materia->nombre_paralelo}} <b>{{$materia->nombre_nivel_idioma}}</b> / {{$materia->nombre_idioma .' '. $materia->nombre_nivel_idioma}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>dfsd</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('Mostrar', ($cadena) => {
                console.log($cadena);
            });
        });
    </script>
@endpush
