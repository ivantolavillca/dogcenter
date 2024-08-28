<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">PERSONAS REGISTRADAS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Personas</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self id="inscribirestudiantemodal" class="modal fade" tabindex="-1" role="dialog"
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
                                            <thead>
                                                <tr>
                                                    <th>IDIOMA</th>
                                                    <th>NIVEL</th>
                                                    <th>PARALELO</th>
                                                    <th>SELECTOR</th>

                                                    <th>ANULAR</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($materias_preinscritas as $materiass)
                                                    <tr>
                                                        <td>{{ $materiass->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                        </td>
                                                        <td> {{ $materiass->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                        </td>
                                                        <td> {{ $materiass->planificar_asignatura->siadi_paralelo->nombre_paralelo }}
                                                            {{ $materiass->planificar_asignatura->turno_paralelo }}
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
                                                                        data-on-label="Si" data-off-label="No"></label>
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
                                                <label for="" class="form-label">NRO DE FOLIO:</label>
                                                <input type="text" wire:model="nro_folio" class="form-control">
                                                @error('nro_folio')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label">NRO CARPETA</label>
                                                <input type="text" wire:model="nro_carperta" class="form-control">
                                                @error('nro_carperta')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                        DATOS</button>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Administracion</h4>
                    <p class="card-title-desc">Administracion de estudiantes <code>-</code>.</p>

                    <div class="mb-3 row">
                        <div class="col-md-6 p-3">
                            <button class="btn btn-success"  wire:click="agregar_persona">AGREGAR PERSONA</button> {{-- data-bs-toggle="modal" data-bs-target="#crearpersona" --}}
                        </div>

                        <div class="col-md-6 p-3">
                            <div class="input-group">
                                <input type="text" class="form-control" wire:model="search" placeholder="Buscador por C.I.">
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                    <br>

                    @if ($personas->count())
                        <div class="table-responsive">
                            <table  id="datatable" class="table table-bordered dt-responsive nowrap mb-100" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            NOMBRE COMPLETO
                                        </th>
                                        <th>
                                            CI
                                        </th>

                                        {{-- <th>
                                            ESTADO CIVL
                                        </th>
                                        <th>
                                            PAIS
                                        </th>
                                        <th>
                                            GENERO
                                        </th>
                                        <th>
                                            FECHA NACIMIENTO
                                        </th>
                                        <th>
                                            PROFESION
                                        </th>
                                        <th>
                                            DIRECCION
                                        </th> --}}
                                        
                                        <th>
                                            TELÉFONO
                                        </th>
                                        <th>
                                            CELULAR
                                        </th>


                                        <th>
                                            EMAIL
                                        </th>

                                        <th>
                                            ACCION
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($personas as $persona)
                                        <tr>

                                            <th>
                                                @php
                                                    echo $cont;
                                                    $cont++;
                                                @endphp
                                            </th>

                                            <td>
                                                {{ $persona->nombres_persona }} {{ $persona->paterno_persona }}
                                                {{ $persona->materno_persona }}
                                            </td>

                                            <td>
                                                {{ $persona->ci_persona }} {{ $persona->expedido_persona }}
                                            </td>
                                            {{-- <td>
                                                {{ $persona->estado_civil_persona }}
                                            </td>
                                            <td>
                                                {{ $persona->pais_persona }}
                                            </td>
                                            <td>
                                                {{ $persona->genero_persona }}
                                            </td>

                                            <td>
                                                {{ $persona->fecha_nacimiento_persona }}
                                            </td>
                                            <td>
                                                {{ $persona->profesion_persona }}
                                            </td>
                                            <td>
                                                {{ $persona->direccion_persona }}
                                            </td> --}} 
                                            <td>
                                                {{ $persona->telefono_persona }}
                                            </td>
                                            <td>
                                                {{ $persona->celular_persona }}
                                            </td>
                                            <td>
                                                {{ $persona->email_persona }}
                                            </td>


                                            <td>
                                            

                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Acciones <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                
                                                    <a wire:click="verhistorial({{ $persona->id_siadi_persona }})" class="dropdown-item " href="javascript:void(0)">HISTORIAL</a>
                                                    <a wire:click="imprimir_record({{ $persona->id_siadi_persona }})" class="dropdown-item " href="javascript:void(0)">RECORD ACADEMICO</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a wire:click="inscribirestudiante({{ $persona->id_siadi_persona }})" class="dropdown-item" href="javascript:void(0)">INSCRIBIR</a>
                                                    <a href="{{route('imprimir_boleta',$persona->id_siadi_persona )}}" class="dropdown-item" >BOLETA DE INSCRIPCIÓN</a>
                                                    @php
                                                        # verifica que al menos una asignatura este aprobada, para poder mostrar
                                                        $estado_certificado_notas = false;
                                                        if (count($persona->persona_inscrita) > 0) {
                                                            foreach ($persona->persona_inscrita as $inds) {
                                                                if ($inds->notas->final_nota >= 51) {
                                                                    $estado_certificado_notas = true;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($estado_certificado_notas)
                                                        <a href="{{ route('reporte_pdf_certificado_notas', ['id_persona' => $persona->id_siadi_persona]) }}" target="_blank" class="dropdown-item">CERTIFICADO DE NOTAS</a>
                                                    @endif
                                                    <a href="{{ route('formulariopreinscripcion', $persona->id_siadi_persona) }}" target="_blank" class="dropdown-item" href="javascript:void(0)">FORMULARIO DE PREINCRIPCION</a>

                                                    @foreach ($persona->persona_inscrita as $insc)
                                                        @if ($insc->notas && $insc->notas->certificados && $insc->notas->certificados->certificado_id != null)
                                                            @php
                                                                $formato_impresion = 'formato1';
                                                                $carga_horaria = true;
                                                            @endphp
                                                                <a target="_blank" class="dropdown-item" href="{{ route('impresion_certificado', ['id_certificado' => $insc->notas->certificados->certificado_id,'formato_impresion' => $formato_impresion,'carga_horaria' => $carga_horaria,]) }}">
                                                                IMPRIMIR CERTIFICADO
                                                                {{ $insc->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                                {{ $insc->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                            </a>
                                                        @endif
                                                    @endforeach                                                                                                
                                                    <div class="dropdown-divider"></div>
                                                    <a wire:click="editar_persona({{ $persona->id_siadi_persona }})" class="dropdown-item" href="javascript:void(0)">EDITAR PERSONA</a>
                                                </div>
                                            </div>


                                                
                                                {{-- 
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light"
                                                        style="border-radius: 50%"
                                                        wire:click="editar_persona({{ $persona->id_siadi_persona }})">
                                                        <i class="bx bx-pencil"></i>
                                                    </button> --}}



                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center">

                            {{ $personas->links() }}
                        </div>

                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>



            <div wire:ignore.self data-bs-backdrop="static" id="editarpersona" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"> EDITAR PERSONA

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelarEditar"></button>
                        </div>
                        <div class="modal-body">





                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">CI:</label>
                                        <input type="text" class="form-control" wire:model="ci_edit">
                                        @error('ci_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">EXPEDIDO:</label>
                                        <select class="form-select @error('expedido_edit') border-danger @enderror" wire:model="expedido_edit">
                                            <option value="">Elegir...</option>
                                            @foreach ($EXPEDIDO_DATA as $expedi)
                                                <option value="{{ $expedi }}">{{ $expedi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('expedido_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">ESTADO CIVIL:</label>
                                        <select class="form-select @error('estado_civil_edit') border-danger @enderror" wire:model="estado_civil_edit">
                                            <option value="">Elegir...</option>
                                            @foreach ($ESTADOS_CIVILES as $est_civ)
                                                <option value="{{ $est_civ }}">{{ $est_civ }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('estado_civil_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">NOMBRE:</label>
                                        <input type="text" class="form-control" wire:model="nombre_edit">
                                        @error('nombre_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label  @error('paterno_edit') border-danger @enderror">PATERNO:</label>
                                        <input type="text" class="form-control" wire:model="paterno_edit">
                                        @error('paterno_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">MATERNO:</label>
                                        <input type="text" class="form-control @error('materno_edit') border-danger @enderror" wire:model="materno_edit">
                                        @error('materno_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">PAÍS:</label>
                                        <select class="form-select @error('pais_edit') border-danger @enderror" wire:model="pais_edit">
                                            <option value="">Elegir...</option>
                                            @foreach ($paises as $pa)
                                                <option value="{{ $pa->id_siadi_pais }}">{{ $pa->nombre_siadi_pais }}
                                                </option>
                                            @endforeach

                                        </select>
                                        {{-- <input type="text" class="form-control" wire:model="pais_edit"> --}}
                                        @error('pais_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">GÉNERO:</label>

                                        <select class="form-select @error('genero_edit') border-danger @enderror" wire:model="genero_edit">
                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>
                                        </select>
                                        @error('genero_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">FECHA DE NACIMIENTO:</label>
                                        <input type="date" class="form-control @error('fecha_nacimiento_edit') border-danger @enderror"
                                            wire:model="fecha_nacimiento_edit">
                                        @error('fecha_nacimiento_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">PROFESIÓN:</label>
                                        <input type="text" class="form-control @error('profesion_edit') border-danger @enderror" wire:model="profesion_edit">
                                        @error('profesion_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">DIRECCIÓN:</label>
                                        <input type="text" class="form-control" wire:model="direccion_edit">
                                        @error('direccion_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">TELÉFONO:</label>
                                        <input type="text" class="form-control" wire:model="telefono_edit">
                                        @error('telefono_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">CELULAR:</label>
                                        <input type="text" class="form-control" wire:model="celular_edit">
                                        @error('celular_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">EMAIL:</label>
                                        <input type="text" class="form-control" wire:model="email_edit">
                                        @error('email_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">TIPO ESTUDIANTE:</label>
                                        <select wire:model="tipo_estudiante_edit" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($tipo_estudiante2 as $tipo_e)
                                                <option value="{{ $tipo_e->id_tipo_estudiante }}">
                                                    {{ $tipo_e->nombre_tipo_estudiante }}</option>
                                            @endforeach






                                        </select>
                                        @error('tipo_estudiante_edit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>



                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect"
                                data-bs-dismiss="modal">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardareditarapersona">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>

        @if ($inscripciones->count())
            <div wire:ignore.self data-bs-backdrop="static" id="historialpersona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"> HISTORIAL ACADEMICO </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                 
                                    <div class="table-responsive">
                                        <table class=" table table-hover mb-0">

                                            <thead>
                                                <tr>
                                                    <th>GESTION | SEDE</th>
                                                    <th>PARALELO - TURNO</th>
                                                    <th>ASGINATURA</th>
                                                    <th>TIPO</th>
                                                    <th>NOTA FINAL</th>
                                                    <th>OBS</th>
                                                    <th>ESTADO</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inscripciones as $insc)
                                                    <tr>

                                                        <td align="center">
                                                        @if ($insc->planificar_asignatura->siadi_convocatoria->nro_libro)
                                                            <span class="badge bg-secondary" style="font-size:12px;"><b>Libro:{{$insc->planificar_asignatura->siadi_convocatoria->nro_libro}}</b></span><hr class="p-0 mt-0 mb-0">
                                                        @endif
                                                            <span class="badge bg-info">{{$insc->planificar_asignatura->siadi_convocatoria->periodo}}/{{$insc->planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion}}
                                                            {{$insc->planificar_asignatura->siadi_convocatoria->siadi_sede->sede_upea->nombre}}</br>
                                                            <span class="badge bg-success">{{$insc->planificar_asignatura->siadi_convocatoria->siadi_sede->direccion}}</span></span>
                                                        </td>
                                                        <td> 
                                                            <strong>{{$insc->planificar_asignatura->siadi_paralelo->nombre_paralelo}} - {{$insc->planificar_asignatura->turno_paralelo}}</strong>
                                                        </td>
                                                        <td> 
                                                        <span class="badge bg-success">{{ $insc->planificar_asignatura->siadi_asignatura->idioma->sigla_codigo_idioma }}</br><span class="badge bg-info" style="font-size:11px;">{{ $insc->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }} {{ $insc->planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }} {{ $insc->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}</span></span>
                                                        </td>
                                                        <td> {{ $insc->planificar_asignatura->siadi_asignatura->idioma->tipo_idioma  }} </td>
                                                        <td > 
                                                            
                                                            @if ($editingNotaId === $insc->id_inscripcion)
                                                                <input wire:model="editedNota" type="text" class="form-control">
                                                                @error('editedNota')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            @elseif(!is_null($nota_baja_actual) && $operation === 'dar_baja' && $nota_baja_actual->id_nota==$insc->notas->id_nota)
                                                                <span title="Nota Anterior">{{$insc->notas->final_nota}}</span>
                                                                <hr>
                                                                <span class="text-info" title="Nueva Nota Final"><b>{{$nota_final_baja}}</b></span> <br>
                                                            @else
                                                                {{$insc->notas->final_nota}}
                                                            @endif
                                                        </td>
                                                        <td align="center"style="max-width: 200px;" > 
                                                            @if ($insc->notas->observaciones_detalle === 'APROBADO' || $insc->notas->observaciones_detalle === 'REPROBADO' || $insc->notas->observaciones_detalle === 'NO SE PRESENTÓ')
                                                                <span class="badge {{$insc->notas->observacion_nota === 'APROBADO' ? 'bg-success' : 'bg-danger'}}">{{$insc->notas->observacion_nota}}</span> 
                                     
                                                            @elseif($insc->notas->observacion_nota=='BAJA')
                                                                {{-- <span class="badge {{$insc->notas->observacion_nota === 'APROBADO' ? 'bg-success' : 'bg-danger'}}">{{$insc->notas->observacion_nota}}</span>  --}}
                                                                <span class="badge bg-secondary text-white" title="Observación">{{$insc->notas->observacion_nota}}</span>  <br>
                                                                <span class="badge bg-secondary d-block text-wrap text-break" title="Detalles"><small>{{$insc->notas->observaciones_detalle}}</small></span> 
                                                            @else
                                                            	<span class="badge bg-info text-white" title="Observación">{{$insc->notas->observacion_nota}}</span> <br>
                                                            	<span class="badge bg-info d-block text-wrap text-break" title="Detalles"><small>{{$insc->notas->observaciones_detalle}}</small></span> 
                                                            @endif

                                                            {{--@if ($editingNotaId === $insc->id_inscripcion)
                                                                <input wire:model="editedNotaObs" type="text" class="form-control">
                                                                @error('editedNota')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            @else--}}
                                                            @if(!is_null($nota_baja_actual) && $operation === 'dar_baja' && $nota_baja_actual->id_nota==$insc->notas->id_nota)
                                                                <input wire:model="observaciones_detalle_baja" value="{{$observaciones_detalle_baja}}" type="text" class="form-control border-info @error('observaciones_detalle_baja') border-danger @enderror">
                                                                <span class="text-info" title="Nueva Observación nota"><b>{{$observacion_nota_baja}}</b></span>
                                                                <ul>
                                                                    @error('nota_final_baja')
                                                                        <li><span class="text-danger">{{ $message }}</span></li>
                                                                    @enderror
                                                                    @error('observacion_nota_baja')
                                                                        <li><span class="text-danger">{{ $message }}</span></li>
                                                                    @enderror
                                                                    @error('observaciones_detalle_baja')
                                                                        <li><span class="text-danger">{{ $message }}</span></li>
                                                                    @enderror
                                                                </ul>
                                                            @endif
                                                            
                                                        </td>
                                                        <td> {{$insc->estado_inscripcion}}</td>
                                                        <td width="200px">
                                                        @if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->name == 'Kardex') 
                                                            @if ($editingNotaId === $insc->id_inscripcion)
                                                                <button
                                                                    wire:click="guardar_editar_nota({{ $insc->notas->id_nota }})" title="Guardar nota"
                                                                    class="btn btn-success"><i class="far fa-save"></i></button>
                                                                <button
                                                                    wire:click="cancelar_edit_nota" title="Cancelar"
                                                                    class="btn btn-danger"><i class="bx bx-reset"></i></button>
                                                            @elseif(!is_null($nota_baja_actual) && $operation === 'dar_baja' && $nota_baja_actual->id_nota==$insc->notas->id_nota)
                                                                <button
                                                                    wire:click="guardar_baja" title="Guardar Baja"
                                                                    class="btn btn-success"><i class="far fa-save"></i></button>
                                                                <button
                                                                    wire:click="cancelar_baja" title="Cancelar"
                                                                    class="btn btn-danger"><i class="bx bx-reset"></i></button>
                                                            @else
                                                            <div class="btn-group row" role="group">
                                                                <div class="col-md-12">
                                                                    <button wire:click="startEditingNota({{$insc->notas->id_nota}})" class="btn btn-info btn-sm btn-block mb-2" title="EDITAR NOTA">
                                                                        <i class="fas fa-edit"></i> EDITAR NOTA
                                                                    </button>
                                                                    <button wire:click="anularinscripcion({{$insc->id_inscripcion}})" class="btn btn-danger btn-sm btn-block mb-2" title="ANULAR INSCRIPCION">
                                                                        <i class="far fa-times-circle"></i> ANULAR INSCRIPCION
                                                                    </button>
                                                                    <button wire:click="editar_asignatura({{$insc->id_inscripcion}})" class="btn btn-warning btn-sm btn-block mb-2" title="EDITAR INSCRIPCION">
                                                                        <i class="far fa-times-circle"></i> EDITAR INSCRIPCION
                                                                    </button>
                                                                    @if($insc->notas->observacion_nota!=='BAJA' && $insc->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma ==='1.1')
                                                                    	<button wire:click="inicia_baja_nota({{$insc->notas->id_nota}})" class="btn btn-danger btn-sm btn-block " title="DAR DE BAJA">
                                                                        	<i class="far fa-times-circle"></i> DAR DE BAJA
                                                                    	</button>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            @endif
                                                        @else
                                                        <span class="badge bg-danger text-white" title="Observación">No se permiten cambios <br> a la fecha </span>
                                                        @endif
                                                         
                                                         </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                
                            </div>

                        </div>


                            @if ($asignaturaid)
                           <div class="row">
                                <label class="form-label">ASIGNATURAS DISPONIBLES</label>
                                <select class="form-select" wire:model="asignatura_edite">
                                    <option value="">Elegir...</option>
                                    @foreach ($asignaturas_validas as $asig)
                                        <option value="{{$asig->id_planificar_asignatura }}"> IDIOMA:  {{$asig->nombre_idioma  }}  {{$asig->nombre_nivel_idioma}} -  PARALELO: {{$asig->nombre_paralelo  }} - TURNO: {{$asig->turno_paralelo  }} - MODALIDAD: {{$asig->nombre_convocatoria_estudiante  }} </option>
                                    @endforeach
                                </select>
                                <div class="text-center">
                                    <button class="btn btn-success" wire:click="editar_inscripcion_asignatura"> EDITAR</button>
                                    <button class="btn btn-danger" wire:click="cancelareditarinsc">CANCELAR</button>
                                </div>
                            </div>     
                            @endif
                    
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" wire:click="cancelar_edit_nota"
                                    data-bs-dismiss="modal">CERRAR</button>

                            </div>
                    </div>
                        <!-- /.modal-content -->
                </div>
                    <!-- /.modal-dialog -->

            </div>

@else
                                    
                                    
            <div wire:ignore.self data-bs-backdrop="static" id="historialpersona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-lg-12">
                                                        <div class="alert alert-danger" role="alert">
                                                            <h4 class="alert-heading">Nota!</h4>
                                                            <p>El estudiante no cuenta con un historial academico.</p>
                                                            <hr>
                                                            <p class="mb-0">Verifique bien los datos del estudiante.</p>
                                                          </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
@endif


            <div wire:ignore.self data-bs-backdrop="static" id="crearpersona" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR PERSONA
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">CI:</label>
                                        <input type="text" class="form-control @error('ci') border-danger @enderror" wire:model="ci">
                                        @error('ci')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">EXPEDIDO:</label>
                                        <select class="form-select @error('expedido') border-danger @enderror" wire:model="expedido">
                                            <option value="">Elegir...</option>
                                            @foreach ($EXPEDIDO_DATA as $expedi)
                                                <option value="{{ $expedi }}">{{ $expedi }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('expedido')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">ESTADO CIVIL:</label>
                                        <select class="form-select @error('estado_civil') border-danger @enderror" wire:model="estado_civil">
                                            <option value="">Elegir...</option>
                                            @foreach ($ESTADOS_CIVILES as $est_civ)
                                                <option value="{{ $est_civ }}">{{ $est_civ }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('estado_civil')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">NOMBRE:</label>
                                        <input type="text" class="form-control @error('nombre') border-danger @enderror" wire:model="nombre">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">PATERNO:</label>
                                        <input type="text" class="form-control @error('paterno') border-danger  @enderror" wire:model="paterno">
                                        @error('paterno')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">MATERNO:</label>
                                        <input type="text" class="form-control @error('materno') border-danger @enderror" wire:model="materno">
                                        @error('materno')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">PAÍS:</label>
                                        <select class="form-select @error('pais') border-danger @enderror" wire:model="pais">
                                            <option value="">Elegir...</option>
                                            @foreach ($paises as $pa)
                                                <option value="{{ $pa->id_siadi_pais }}">{{ $pa->nombre_siadi_pais }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('pais')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">GÉNERO:</label>

                                        <select class="form-select @error('genero') border-danger @enderror" wire:model="genero">
                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>
                                        </select>
                                        @error('genero')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">FECHA DE NACIMIENTO:</label>
                                        <input type="date" class="form-control @error('fecha_nacimiento') border-danger @enderror" wire:model="fecha_nacimiento">
                                        @error('fecha_nacimiento')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">PROFESIÓN:</label>
                                        <input type="text" class="form-control @error('profesion') border-danger @enderror" wire:model="profesion">
                                        @error('profesion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">DIRECCIÓN:</label>
                                        <input type="text" class="form-control @error('direccion') border-danger @enderror" wire:model="direccion">
                                        @error('direccion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">TELÉFONO:</label>
                                        <input type="text" class="form-control @error('telefono') border-danger @enderror" wire:model="telefono">
                                        @error('telefono')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">CELULAR:</label>
                                        <input type="text" class="form-control @error('celular') border-danger @enderror" wire:model="celular">
                                        @error('celular')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">EMAIL:</label>
                                        <input type="text" class="form-control @error('email') border-danger @enderror" wire:model="email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-6">
                                        <label class="form-label">TIPO ESTUDIANTE:</label>
                                        <select wire:model="tipo_estudiante" class="form-select @error('tipo_estudiante') border-danger @enderror"
                                            aria-label="Default select example">
                                            <option value="">Elegir...</option>
                                            @foreach ($tipo_estudiante2 as $tipo_est)
                                                <option value="{{ $tipo_est->id_tipo_estudiante }}">
                                                    {{ $tipo_est->nombre_tipo_estudiante }}</option>
                                            @endforeach
                                        </select>
                                        @error('tipo_estudiante')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>



                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar">CANCELAR</button>
                            <button wire:click="guardarpersonanueva"
                                class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

        </div>

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('abrirnodaleditarpersona', function() {
                        $('#editarpersona').modal('show');
                    });
                });
                document.addEventListener('livewire:load', function() {
                    Livewire.on('cerrarmodaldeeditar', function() {
                        $('#editarpersona').modal('hide');
                    });
                });
                document.addEventListener('livewire:load', function() {
                     Livewire.on('abrimodaldeguardarpersona', function() {
                        $('#crearpersona').modal('show');
                    });
                    Livewire.on('cerrarmodaldeguardarpersona', function() {
                        $('#crearpersona').modal('hide');
                    });
                });
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
                    Livewire.on('abrirmodalpersonahistorial', function() {
                        $('#historialpersona').modal('show');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalEdit', function() {
                        $('#editaridioma').modal('hide');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                livewire.on('deleteconvoca', id_siadi_convocatoria => {
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

                            // livewire.emitTo('servidor-index', 'delete', ServidorId);
                            livewire.emit('delete', id_siadi_convocatoria);

                            Swal.fire(
                                'Eliminado!',
                                'Su Registro ha sido eliminado..',
                                'Exitosamente'
                            )
                        }
                    })
                });
            </script>
        @endpush
