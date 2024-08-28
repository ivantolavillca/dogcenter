<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">PLANIFICAR ASIGNATURA</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Planificar Asignatura</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <label for="estilo_asignaturas" class="d-block mb-0 user-select-none">Listado Grid</label>
                        <input type="checkbox" id="estilo_asignaturas" switch="bool" {{$estilo_asignaturas==true? "checked": ""}} wire:model="estilo_asignaturas">
                        <label class="form-label" for="estilo_asignaturas" data-on-label="Si" data-off-label="No"></label> 
                    </div>
                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <button class="btn btn-outline-primary waves-effect waves-light col-md-6 " wire:click="agregar_asignatura">  {{-- data-bs-toggle="modal" data-bs-target="#agregarplanificar_asignatura" --}}
                                <i class="bx bxs-plus-circle">AGREGAR</i>
                            </button>
                        </div>
                        <br>

                        <div class="col-12 row">
                            <div class="col-12 col-md-2">
                                <label for="gestiones" class="form-label">GESTIÓN: </label>
                                <select name="gestiones" id="gestiones" class="form-select" wire:model="f_gestion">
                                    <option value="">Elegir...</option>
                                    @foreach ($gestiones as $gestion)
                                        <option value="{{ $gestion->id_gestion }}">
                                            {{ $gestion->nombre_gestion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if ($estado_periodo)
                                <div class="col-12 col-md-2">
                                    <label for="f_periodo" class="form-label">PERIODO: </label>
                                    <select name="f_periodo" id="f_periodo" class="form-select" wire:model="f_periodo">
                                        <option value="">Elegir...</option>
                                        @foreach ($periodos as $periodo)
                                            <option value="{{ $periodo->periodo }}">{{ $periodo->periodo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($estado_convocatoria_sede)
                                <div class="col-12 col-md-4">
                                    <label for="f_convocatoria_sede" class="form-label">CONVOCATORIA SEDE: </label>
                                    <select name="f_convocatoria_sede" id="f_convocatoria_sede" class="form-select" wire:model="f_convocatoria_sede">
                                        <option value="">Elegir...</option>
                                        @foreach ($convocatorias_sedes as $sede)
                                            <option value="{{ $sede->id_siadi_convocatoria }}">
                                                {{ $sede->modalidad->id_convocartoria_estudiante==1? $sede->modalidad->nombre_convocatoria_estudiante .' ('. $sede->convocatoria_costo->tipo_costo .')' : $sede->modalidad->nombre_convocatoria_estudiante }}
                                                {{ $sede->siadi_sede->direccion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($estado_f_idioma)
                                <div class="col-12 col-md-2">
                                    <label for="f_idioma" class="form-label">IDIOMA: </label>
                                    <select name="f_idioma" id="f_idioma" class="form-select" wire:model="f_idioma">
                                        <option value="">Elegir...</option>
                                        @foreach ($idiomas as $idioma)
                                            <option value="{{ $idioma->id_idioma }}">{{ $idioma->nombre_idioma }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($estado_f_nivel)
                                <div class="col-12 col-md-2">
                                    <label for="f_nivel" class="form-label">NIVEL: </label>
                                    <select name="f_nivel" id="f_nivel" class="form-select" wire:model="f_nivel">
                                        <option value="">Elegir...</option>
                                        @foreach ($niveles as $nivel)
                                            <option value="{{ $nivel->id_nivel_idioma }}">{{ $nivel->nombre_nivel_idioma }} {{ $nivel->descripcion_nivel_idioma }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                        </div>
                    </div>
                
                @if($planificar_asignaturas->count() > 0)
                    @if ($estado_f_idioma)
                        <h3 class="text-center"> <span title="Nombre Convocatoria">{{$planificar_asignaturas[0]->siadi_convocatoria->nombre_convocatoria}}</span> .:: <span title="Sede UPEA">{{$planificar_asignaturas[0]->siadi_convocatoria->siadi_sede->sede_upea->nombre}}</span> </h3>
                        <div class="row">
                        	<div class="col-md-4">
                            	<button class="btn btn-outline-info waves-effect waves-light col-md-6 " wire:click="subir_nota_limite_convocatoria({{$planificar_asignaturas[0]->siadi_convocatoria->id_siadi_convocatoria}})">  {{-- data-bs-toggle="modal" data-bs-target="#agregarplanificar_asignatura" --}}
                                	<i class="bx bxs-plus-details">Subir Notas por Convocatoria </i>
                            	</button>
                            </div>
                        </div>
                        <br>
                    @endif
                    @if($estilo_asignaturas==false)
                        <div class="table-responsive">   
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            N°
                                        </th>
                                        <th>
                                            PERIODO
                                        </th>
                                        <th>
                                            SEDE
                                        </th>
                                        <th>
                                            ASIGNATURA
                                        </th>
                                        <th>
                                            NIVEL
                                        </th>
                                        <th>
                                            PARALELO
                                        </th>
                                        <th>
                                            COSTO
                                        </th>
                                        <th>
                                            CARGA HORARIA
                                        </th>
                                        <th>
                                            FECHA
                                        </th>
                                        <th>
                                            ESTADO
                                        </th>
                                        <th>
                                            ACCIÓN
                                        </th>
                                        <th>
                                            REPORTES
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp

                                    @foreach ($planificar_asignaturas as $planificar_asignatura)
                                        <tr>
                                            <th>
                                                {{ $planificar_asignatura->id_planificar_asignatura }}
                                            </th>
                                            <td>
                                                {{ $planificar_asignatura->siadi_convocatoria->periodo }}/{{ $planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion }}
                                            </td>
                                            <td>
                                                {{ $planificar_asignatura->siadi_convocatoria->siadi_sede->direccion }} <br>
                                                <b>{{ $planificar_asignatura->siadi_convocatoria->siadi_sede->sede_upea->nombre }}</b>
                                            </td>

                                            <td>
                                                {{ $planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                            </td>
                                            <td>
                                                {{ $planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                            </td>

                                            <td>
                                                {{ $planificar_asignatura->siadi_paralelo->nombre_paralelo }}
                                            </td>
                                            <td>
                                                {{ $planificar_asignatura->siadi_convocatoria->monto_convocatoria }}
                                            </td>
                                            <td>
                                                {{ $planificar_asignatura->carga_horaria_planificar_asignartura }}
                                            </td>
                                            <td>
                                                <span title="Fecha inicio de clases" class="text-primary">{{ $planificar_asignatura->fecha_inicio }}</span> <br>
                                                <span title="Fecha fin de clases">{{ $planificar_asignatura->fecha_fin }}</span>
                                            </td>
                                            <td>
                                                @if ($planificar_asignatura->estado_planificar_asignartura == 'ACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light"
                                                        wire:click="cambiar_estado_planificar_asignatura({{ $planificar_asignatura->id_planificar_asignatura }})">
                                                        ACTIVO
                                                    </button>
                                                @elseif ($planificar_asignatura->estado_planificar_asignartura == 'INACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-danger waves-effect waves-light"
                                                        wire:click="cambiar_estado_planificar_asignatura({{ $planificar_asignatura->id_planificar_asignatura }})">
                                                        INACTIVO</button>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" title="Editar"
                                                    class="btn btn-outline-warning waves-effect waves-light" style="border-radius: 50%"
                                                    wire:click="editar_planificar_asignatura({{ $planificar_asignatura->id_planificar_asignatura }})"> {{--  data-bs-toggle="modal" data-bs-target="#editarplanificar_asignatura" --}}
                                                    <i class="bx bx-pencil"></i>
                                                </button>

                                                <button type="button" title="Eliminar"
                                                    class="btn btn-outline-danger waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click.prevent="$emit('deleteplanificar_asignatura', {{ $planificar_asignatura->id_planificar_asignatura }})">
                                                    <i class="bx bx-trash"></i></button>
                                            </td>
                                            <td>
                                                @if (count($planificar_asignatura->inscripcipciones) > 0)
                                                    @can('planificar_asignatura.acta_calificaciones')
                                                        <a class="btn btn-outline-danger waves-effect waves-light"
                                                            title="Acta de calificaciones" target="_blank"
                                                            href="{{ route('reporte_planificar_asignatura', ['id_planificar_asignatura' => base64_encode(str_pad($planificar_asignatura->id_planificar_asignatura, 15, '0', STR_PAD_LEFT))]) }}">
                                                            <i class="bx bxs-file-pdf text-danger fs-4"></i>
                                                        </a>
                                                    @endcan

                                                    <a class="btn btn-outline-success waves-effect waves-light"
                                                        title="Lista de Estudiantes CSV" target="_blank"
                                                        href="{{ route('reporte_planificar_asignatura_csv', ['id_planificar_asignatura' => base64_encode(str_pad($planificar_asignatura->id_planificar_asignatura, 15, '0', STR_PAD_LEFT))]) }}">
                                                        <i class="bx bxs-file text-success fs-4"></i>
                                                    </a>

                                                    @php
                                                        $estado_certificado = false;
                                                        foreach($planificar_asignatura->inscripcipciones as $inscrip){
                                                            # echo "<li>". $inscrip->notas->final_nota. " , ". $inscrip->notas->certificados ."</li>";
                                                            if(!is_null($inscrip->notas->certificados)){
                                                                $estado_certificado = true;
                                                                break;
                                                            }
                                                        }
                                                        
                                                        $estado_cert_provisional = false;
                                                        foreach($planificar_asignatura->inscripcipciones as $inscrip){
                                                            #echo "<li>". $inscrip->notas->final_nota. " , ". $inscrip->notas->certificados ."</li>";
                                                            if(!is_null($inscrip->notas->certificados_provisional)){
                                                                $estado_cert_provisional = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    @if($estado_certificado)
                                                        <a class="btn btn-outline-success waves-effect waves-light"
                                                            title="Certificados" target="_blank"
                                                            href="{{ route('certificado_asignatura', ['id_planificar_asgnatura' => $planificar_asignatura->id_planificar_asignatura]) }}"><i
                                                                class="bx bxs-file-pdf text-success fs-4"></i></a>
                                                    @endif
                                                @endif
                                                
                                                <a class="btn btn-outline-info waves-effect waves-light"
                                                    title="Lista" target="_blank"
                                                    href="{{ route('planificar_asignatura.show', ['id_planificar_asignatura' => $planificar_asignatura->id_planificar_asignatura]) }}"><i
                                                        class="bx bx-list-ul  fs-4"></i></a>
                                                {{-- <button class="btn btn-outline-success waves-effect waves-light"
                                                        style="border-radius: 50%"
                                                        wire:click.prevent="generarReporteXLS({{ $planificar_asignatura->id_planificar_asignatura }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-file-excel"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704z" />
                                                            <path
                                                                d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                                        </svg>
                                                    </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @else
                        <div class="row g-3 col-md-12">
                            @php 
                                $con = 0; 
                                $color = ""; 
                                $estilo_turno = [
                                    "Mañana" => ["icono" => "bxs-sun", "color" => "text-primary"],
                                    "Tarde" => ["icono" => "bxs-sun", "color" => "text-warning"],
                                    "Noche" => ["icono" => "bxs-moon", "color" => "text-secondary"],
                                    "Sin turno" => ["icono" => "bxs-minus-circle", "color" => "text-danger"],
                                ]; 
                            @endphp
                            @foreach ($planificar_asignaturas as $planificar_asignatura)
                                @php
                                    $inscritos = 0;
                                    foreach($planificar_asignatura->inscripcipciones as $tmInc){
                                        if($tmInc->estado_inscripcion!=='ELIMINAR'){
                                            $inscritos++;
                                        }
                                    }
                                    $color = ($con++)%2==0? 'success': 'info'; 
                                @endphp
                                <div class="col-md-6">
                                    <div class="card radius-10 border-start border-1 border-5 border-{{$color}} @if($id_planificar_asignatura==$planificar_asignatura->id_planificar_asignatura) bg-soft-info @endif" style="border-width: 1px 1px 1px 7px;">
                                        <div class="card-header">
                                            <div class="float-start bg-{{$color}} text-white m-0 p-1"><b>{{ $planificar_asignatura->id_planificar_asignatura }}</b></div>
                                            <h4 class="my-0 text-{{$color}} text-center"><i class="mdi mdi-check-all me-3"></i> 
                                                {{ $planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                {{ $planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                                {{ $planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                {{-- {{ $planificar_asignatura->siadi_paralelo->nombre_paralelo }} --}}
                                            </h4>
                                            <span class="d-block text-center text-secondary">
                                                {{ $planificar_asignatura->siadi_convocatoria->modalidad->nombre_convocatoria_estudiante }}
                                                {{ $planificar_asignatura->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 1 ? '(' . $planificar_asignatura->siadi_convocatoria->convocatoria_costo->tipo_costo . ')' : '' }}
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center row g-3">
                                                <ul class="list-group col-md-7 border-2">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-home"></i> <b> SEDE</b> <br>
                                                            <span>{{$planificar_asignatura->siadi_convocatoria->siadi_sede->sede_upea->nombre}}</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-map-alt"></i> <b>DIRECCIÓN</b> <br>
                                                            <span>{{$planificar_asignatura->siadi_convocatoria->siadi_sede->direccion}}</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <span><i class="fs-6 bx bxs-time-five"></i> <b>CARGA HORARIA</b> </span>
                                                        <span >{{ $planificar_asignatura->carga_horaria_planificar_asignartura }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <span><b>CUPO MÍNIMO</b> {{ $planificar_asignatura->cupo_minimo_paralelo }}</span>
                                                        <span><b>CUPO MÁXIMO</b> {{ $planificar_asignatura->cupo_maximo_paralelo }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <span ><b>INICIO DE CLASES:</b></span>
                                                        <span >{{ \Carbon\Carbon::parse($planificar_asignatura->fecha_inicio)->locale('es')->isoFormat('D-MMMM-YYYY') }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <span><b>FIN DE CLASES</b> </span>
                                                        <span >{{ \Carbon\Carbon::parse($planificar_asignatura->fecha_fin)->locale('es')->isoFormat('D-MMMM-YYYY') }}</span>
                                                    </li>
                                                </ul>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-0 text-secondary">Paralelo</p>
                                                            <h4 class="my-1 mt-0 text-{{$color}} {{strlen($planificar_asignatura->siadi_paralelo->nombre_paralelo)>=8? 'fs-6': ''}}">{{ $planificar_asignatura->siadi_paralelo->nombre_paralelo }}</h4>
                                                        </div>
                                                        <div class="col-md-6 border-start border-0 border-2">
                                                            <p class="mb-0 text-secondary">Gestión</p>
                                                            <h4 class="my-1 mt-0 text-{{$color}}">{{ $planificar_asignatura->siadi_convocatoria->periodo }}-{{ $planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion }}</h4>
                                                        </div>
                                                    </div>
                                                    <hr class="border-1 mt-0">
                                                    <p class="mb-0 text-secondary">Turno: {{$planificar_asignatura->hora_clases_inicio}}-{{$planificar_asignatura->hora_clases_fin}}</p>
                                                    <h4 class="my-1 text-{{$color}}"><i class="bx {{$estilo_turno[$planificar_asignatura->turno_paralelo]['icono']}} {{$estilo_turno[$planificar_asignatura->turno_paralelo]['color']}}"></i> {{ $planificar_asignatura->turno_paralelo }}</h4>
                                                    <hr class="border-1 mt-0">
                                                    <p class="mb-0 text-secondary">Costo ({{ $planificar_asignatura->siadi_convocatoria->convocatoria_costo->tipo_costo }})</p>
                                                    <h4 class="my-1 text-{{$color}}"><i class="bx bx-money"></i> {{ $planificar_asignatura->siadi_convocatoria->monto_convocatoria }} Bs.</h4>
                                                    <hr class="border-1 mt-0">
                                                    <p class="mb-0 text-secondary">Total Inscritos</p>
                                                    <h4 class="my-1 text-{{$color}}"><i class="bx bxs-user-check "></i> {{$inscritos}}</h4>
                                                    <hr class="border-1 mt-0">
                                                    @php $estado_rhcc = ( !is_null($planificar_asignatura->resolucion_rhcc) && $planificar_asignatura->resolucion_rhcc!=="") @endphp
                                                    @if(is_null($planificar_asignatura->id_asignacion_docente))
                                                        <p class="mb-0 text-danger">Sin docente asignado</p>
                                                        @if($planificar_asignatura->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2)
                                                            @if($estado_rhcc)
                                                                <p class="mt-0 pt-0 text-secondary " title="resolución RHCC"><small>{{$planificar_asignatura->resolucion_rhcc}}</small></p>
                                                            @else 
                                                                <p class="mt-0 pt-0 text-danger " title="resolución RHCC"><small>Sin resolución RHCC</small></p>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @php $estado_nom = ( !is_null($planificar_asignatura->siadi_nombramiento) && $planificar_asignatura->siadi_persona_asignada_docente->id == $planificar_asignatura->siadi_nombramiento->id_persona) @endphp
                                                        <p class="mb-0 text-secondary">Docente:</p>
                                                        <h6 class="my-1 text-{{$color}}"><!-- <i class="bx bxs-user-detail"></i> --> @if($estado_nom) <span class="text-secondary">{{$planificar_asignatura->siadi_nombramiento->grado_nombramiento}}</span> @endif {{ $planificar_asignatura->siadi_persona_asignada_docente->nombre .' '.$planificar_asignatura->siadi_persona_asignada_docente->paterno .' '. $planificar_asignatura->siadi_persona_asignada_docente->materno }} </h6>
                                                        @if($planificar_asignatura->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2)
                                                            
                                                            @if($estado_rhcc)
                                                                <p class="mt-0 pt-0 text-secondary " title="resolución RHCC"><small>{{$planificar_asignatura->resolucion_rhcc}}</small></p>
                                                            @else 
                                                                <p class="mt-0 pt-0 text-danger " title="resolución RHCC"><small>Sin resolución RHCC</small></p>
                                                            @endif
                                                        @else
                                                            @if($estado_nom)
                                                                <p class="mt-0 pt-0 text-secondary " title="nombramiento docente"><small>{{$planificar_asignatura->siadi_nombramiento->item_nombramiento}}</small></p>
                                                            @else 
                                                                <p class="mt-0 pt-0 text-danger " title="nombramiento docente"><small>Sin Nombramineto asignado</small></p>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                @php $porcentaje_plan_asign = $planificar_asignatura->cupo_maximo_paralelo!==0? round( ($inscritos / $planificar_asignatura->cupo_maximo_paralelo)*100, 2, PHP_ROUND_HALF_EVEN): 0; @endphp
                                                <span class="text-white bg-success rounded-2 small">{{$inscritos}}/{{$planificar_asignatura->cupo_maximo_paralelo}}</span> estudiantes inscritos
                                                <div class="progress mb-4 bg-soft-secondary" style="height: 15px;">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$porcentaje_plan_asign?>%" aria-valuenow="{{$porcentaje_plan_asign}}" aria-valuemin="0" aria-valuemax="100">{{$porcentaje_plan_asign}}%</div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-evenly">
                                                @php
                                                    $estado_certificado = false;
                                                    foreach($planificar_asignatura->inscripcipciones as $inscrip){
                                                        if(!is_null($inscrip->notas->certificados) && $inscrip->notas->final_nota>=51){
                                                            $estado_certificado = true;
                                                            break;
                                                        }
                                                    }
                                                    $estado_cert_provisional = false;
                                                    foreach($planificar_asignatura->inscripcipciones as $inscrip_pro){
                                                        if(!is_null($inscrip_pro->notas->certificados_provisional) && $inscrip_pro->notas->final_nota>=51){
                                                            $estado_cert_provisional = true;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <a class="btn btn-outline-info waves-effect waves-light @if($estado_cert_provisional) d-flex align-items-center @endif"
                                                    title="Lista" target="_blank"
                                                    href="{{ route('planificar_asignatura.show', ['id_planificar_asignatura' => $planificar_asignatura->id_planificar_asignatura]) }}">
                                                    <i class="@if($estado_cert_provisional) d-block @endif bx bx-list-ul fs-6"></i> LISTAR
                                                </a>
                                                @if ($inscritos > 0)
                                                    @can('planificar_asignatura.acta_calificaciones')
                                                        <a class="btn btn-outline-danger waves-effect waves-light"
                                                            title="Acta de calificaciones" target="_blank"
                                                            href="{{ route('reporte_planificar_asignatura', ['id_planificar_asignatura' => base64_encode(str_pad($planificar_asignatura->id_planificar_asignatura, 15, '0', STR_PAD_LEFT))]) }}">
                                                            <i class="@if($estado_cert_provisional) d-block @endif bx bxs-file-pdf fs-4"></i> ACTA 
                                                        </a> 
                                                    @endcan
                                                    @can('reporte_planificar_asignatura_excel')
                                                        <a class="btn btn-outline-success waves-effect waves-light"
                                                            title="Acta de EXCEL" target="_blank"
                                                            href="{{ route('reporte_planificar_asignatura_excel', ['id_planificar_asignatura' => base64_encode(str_pad($planificar_asignatura->id_planificar_asignatura, 15, '0', STR_PAD_LEFT))]) }}">
                                                            <i class="@if($estado_cert_provisional) d-block @endif fas fa-file-excel fs-5"></i> EXCEL 
                                                        </a>
                                                    @endcan
                                                    <a class="btn btn-outline-success waves-effect waves-light"
                                                        title="Lista de Estudiantes CSV" target="_blank"
                                                        href="{{ route('reporte_planificar_asignatura_csv', ['id_planificar_asignatura' => base64_encode(str_pad($planificar_asignatura->id_planificar_asignatura, 15, '0', STR_PAD_LEFT))]) }}">
                                                        <i class="@if($estado_cert_provisional) d-block @endif fas fa-file-csv fs-5"></i> CSV
                                                    </a>
                                                    @if($estado_certificado)
                                                        <a class="btn btn-outline-success waves-effect waves-light"
                                                            title="Certificados" target="_blank"
                                                            href="{{ route('certificado_asignatura', ['id_planificar_asgnatura' => $planificar_asignatura->id_planificar_asignatura]) }}"><i
                                                                class="@if($estado_cert_provisional) d-block @endif bx bxs-file-pdf  fs-4"></i> CERTIFICADOS
                                                        </a>
                                                    @endif
                                                    @if($estado_cert_provisional)
                                                        <a class="btn btn-outline-success waves-effect waves-light"
                                                            title="Certificados" target="_blank"
                                                            href="{{ route('certificado_provisional_plan_asignatura', ['id_planificar_asgnatura' => $planificar_asignatura->id_planificar_asignatura]) }}"><i
                                                                class="bx bxs-file-pdf fs-4"></i> CERTIFICADOS <br> PROVISIONALES
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                            {{-- <div class="bg-primary font-weight-bold text-white">
                                                {{json_encode($planificar_asignatura)}}
                                            </div> --}}
                                        </div>
                                        @if(Auth::user()->roles[0]->name == 'Admin')
                                        <div class="card-footer d-flex justify-content-evenly"> {{-- evenly --}}
                                            <button type="button" title="Editar"
                                                class="btn btn-outline-warning waves-effect waves-light rounded-circle" 
                                                wire:click="editar_planificar_asignatura({{ $planificar_asignatura }})"> {{-- data-bs-target="#editarplanificar_asignatura" data-bs-toggle="modal" --}}
                                                <i class="bx bx-pencil"></i>
                                            </button>

                                            <button type="button"
                                                class="btn btn-outline-{{$planificar_asignatura->estado_planificar_asignartura == 'ACTIVO'? 'success': 'danger'}} waves-effect waves-light"
                                                wire:click="cambiar_estado_planificar_asignatura({{ $planificar_asignatura->id_planificar_asignatura }})">
                                                {{$planificar_asignatura->estado_planificar_asignartura == 'ACTIVO'? 'ACTIVO': 'INACTIVO'}}
                                            </button>
                                            @php $fecha = \Carbon\Carbon::now(); $limite = (!is_null($planificar_asignatura->fecha_limite_subir_nota) && $planificar_asignatura->fecha_limite_subir_nota!=='')? \Carbon\Carbon::parse($planificar_asignatura->fecha_limite_subir_nota. ' 23:59:59'): '';@endphp
                                            <button type="button" class="btn btn-outline-{{$fecha <= $limite && $limite!=='' && $planificar_asignatura->estado_docente=='1'? 'success': 'danger'}} waves-effect waves-light"
                                                wire:click="subir_nota_limite({{ $planificar_asignatura->id_planificar_asignatura }})">
                                                {{$fecha <= $limite && $limite!=='' && $planificar_asignatura->estado_docente==1? 'SUBIR NOTAS HASTA: '. $planificar_asignatura->fecha_limite_subir_nota: 'EXPIRÓ SUBIDA DE NOTAS'}}
                                            </button>
                                            <div class="btn-group dropup">
                                                <button type="button" class="btn btn-outline-warning waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bxs-dashboard "></i> MAS ACCIONES
                                                </button>
                                                <ul class="dropdown-menu p-2 border border-1 border-warning">
                                                    <li><button class="btn btn-outline-primary waves-effect waves-light" wire:click="mostrar_form_asignar_docente({{$planificar_asignatura->id_planificar_asignatura}})">ASIGNACIÓN DOCENTE</button></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><button class="btn btn-outline-primary waves-effect waves-light" wire:click="mostrar_form_libro_nota({{$planificar_asignatura->id_planificar_asignatura}})">FOLIO, LIBRO DE ACTAS</button></li>
                                                    {{-- <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
                                                </ul>
                                            </div>

                                            <button type="button" title="Eliminar"
                                                class="btn btn-outline-danger waves-effect waves-light rounded-circle"
                                                wire:click.prevent="$emit('deleteplanificar_asignatura', {{ $planificar_asignatura->id_planificar_asignatura }})">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="d-flex justify-content-center">
                        {{ $planificar_asignaturas->links() }}
                    </div>
                </div>
                @else
                    <div class="px-5 py-3 border-gray-200  text-sm">
                        <strong>No hay Registros</strong>
                    </div>
                @endif
        </div>




        <div wire:ignore.self id="agregarplanificar_asignatura" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">{{$title_form}}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="convocatoria_estudiante">CONVOCATORIA :</label>
                                    <select wire:model="convocatoria_estudiante" class="form-select @error('convocatoria_estudiante') border-danger @enderror" id="convocatoria_estudiante">
                                        <option value="">Elegir...</option>
                                        @foreach ($convocatorias as $convocatoria)
                                            <option value="{{ $convocatoria->id_siadi_convocatoria }}">
                                                {{ $convocatoria->periodo }}/{{ $convocatoria->gestion->nombre_gestion }} .::
                                                {{ $convocatoria->nombre_convocatoria }} .::
                                                {{ $convocatoria->modalidad->nombre_convocatoria_estudiante }}
                                                {{ $convocatoria->modalidad->id_convocartoria_estudiante == 1 ? '(' . $convocatoria->convocatoria_costo->tipo_costo . ')' : '' }}
                                            </option>
                                        @endforeach


                                    </select>
                                    @error('convocatoria_estudiante')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="asignatura">ASIGNATURA:</label>
                                    <select wire:model="asignatura" class="form-select @error('asignatura') border-danger @enderror" id="asignatura">
                                        <option value="">Elegir...</option>
                                        @foreach ($asignaturas as $asignatura)
                                            <option value="{{ $asignatura->id_siadi_asignatura }}">
                                                {{ $asignatura->idioma->nombre_idioma }} -
                                                {{ $asignatura->idioma->tipo_idioma }}-
                                                {{ $asignatura->idioma->sigla_codigo_idioma }} -
                                                {{ $asignatura->nivel_idioma->nombre_nivel_idioma }}</option>
                                        @endforeach
                                    </select>

                                    @error('asignatura')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="id_paralelo">PARALELO :</label>
                                    <select wire:model="id_paralelo" class="form-select @error('id_paralelo') border-danger @enderror" id="id_paralelo" @if( $errors->has('convocatoria_estudiante') || $errors->has('asignatura') || $convocatoria_estudiante=="" || $asignatura="") disabled @endif>
                                        <option value="">Elegir...</option>
                                        @foreach ($paralelos as $paralelo)
                                            <option value="{{ $paralelo->id_paralelo }}">
                                                {{ $paralelo->nombre_paralelo }}
                                            </option>
                                        @endforeach


                                    </select>
                                    @error('id_paralelo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="turno_paralelo">TURNO PARALELO:</label>
                                    <select wire:model="turno_paralelo" class="form-select @error('turno_paralelo') border-danger @enderror" id="turno_paralelo">
                                        <option value="">Elegir...</option>
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                        <option value="Sin turno">Sin turno</option>
                                    </select>
                                    @error('turno_paralelo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="hora_inicio">HORARIO DE INICIO:</label>
                                    <input type="time" class="form-control @error('hora_inicio') border-danger @enderror" wire:model="hora_inicio" id="hora_inicio" @if($estado_horas==false) disabled @endif>
                                    @error('hora_inicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="hora_fin">HORARIO FIN:</label>
                                    <input type="time" class="form-control @error('hora_fin') border-danger @enderror" wire:model="hora_fin" id="hora_fin" @if($estado_horas==false) disabled @endif>
                                    @error('hora_fin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">CUPO MÍNIMO:</label>
                                    <input type="number" class="form-control @error('cupo_minimo') border-danger @enderror" wire:model="cupo_minimo">
                                    @error('cupo_minimo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">CUPO MÁXIMO:</label>
                                    <input type="number" class="form-control @error('cupo_maximo') border-danger @enderror" wire:model="cupo_maximo">
                                    @error('cupo_maximo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">CARGA HORARIA:</label>
                                    <input type="number" class="form-control @error('carga_horaria') border-danger @enderror" wire:model="carga_horaria"
                                        placeholder="Horas">
                                    @error('carga_horaria')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="fecha_inicio">FECHA DE INICIO CLASES:</label>
                                    <input type="date" class="form-control @error('fecha_inicio') border-danger @enderror" wire:model="fecha_inicio" id="fecha_inicio" pattern="\d{4}-\d{2}-\d{2}">
                                    @error('fecha_inicio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="fecha_fin">FECHA FIN CLASES:</label>
                                    <input type="date" class="form-control @error('fecha_fin') border-danger @enderror" wire:model="fecha_fin" id="fecha_fin" pattern="\d{4}-\d{2}-\d{2}">
                                    @error('fecha_fin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cancelar">CANCELAR</button>
                        <button wire:click="{{$action}}"
                            class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div wire:ignore.self data-bs-backdrop="static" id="editar_subir_nota_planificar_asignatura" class="modal fade"
            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel"> 
                            {{$titulo_aignatura}}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="cancelar_subir_nota"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label" for="fecha_limite_notas">FECHA LÍMITE PARA SUBIR NOTA :: DOCENTE</label>
                                    <input type="date" class="form-control @error('fecha_limite_notas') border-danger @enderror" wire:model="fecha_limite_notas" id="fecha_limite_notas" required pattern="\d{4}-\d{2}-\d{2}">
                                    @error('fecha_limite_notas')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="text-info">Establece límite de edición de notas hasta las 23:59:59</span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 ">
                            	<label class="form-label" for="estado_docente">Estado docente:</label>
                                {{-- </div> --}}
                                <div class="mb-3 ">
                                	<input type="checkbox" class="form-label" id="estado_docente"
                                    	wire:model="estado_docente" />
                                    @error('estado_docente')
                                    	<span class="text-danger">{{ $message }}</span>
                                    @enderror {{-- endif --}}
                                    
                                </div>
                                <span class="text-info">Permite listar estudiantes</span>
                        	</div>
                            @if($fecha_limite_notas!=="" && !is_null($fecha_limite_notas))
                                <div class="col-md-12">
                                    <p><b>HASTA: </b> {{ \Carbon\Carbon::parse($fecha_limite_notas)->locale('es')->isoFormat('dddd\, D \d\e MMMM \d\e YYYY') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cancelar_subir_nota">CANCELAR</button>
                        <button class="btn btn-primary waves-effect waves-light"
                            wire:click="guardar_subir_nota">GUARDAR DATOS</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div wire:ignore.self data-bs-backdrop="static" id="editar_subir_nota_plan_asignatura_convocatoria" class="modal fade"
            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        @if(!is_null($convocatoria_actual_subir_nota))
                            <h5 class="modal-title mt-0" id="myModalLabel"> {{$convocatoria_actual_subir_nota->nombre_convocatoria}}</h5>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="cancelar_subir_nota_convocatoria"></button>
                    </div>
                    @if(!is_null($convocatoria_actual_subir_nota))
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="fecha_limite_notas_conv">FECHA LÍMITE PARA SUBIR NOTAS </label>
                                    <input type="date" class="form-control @error('fecha_limite_notas_conv') border-danger @enderror" wire:model="fecha_limite_notas_conv" id="fecha_limite_notas_conv" required pattern="\d{4}-\d{2}-\d{2}">
                                    @error('fecha_limite_notas_conv')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror {{-- endif --}}
                                    <span class="text-info">Establece límite de edición de notas hasta las 23:59:59</span>
                                </div>
                                
                                <div class="col-md-5 mb-3">
                                    <label class="form-label" for="estado_docente_conv">Estado docente:</label>
                                    <input type="checkbox" class="form-label" id="estado_docente_conv"
                                        wire:model="estado_docente_conv" />
                                    @error('estado_docente_conv')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="text-info">Permite listar estudiantes</span>
                                </div>
                                @if($fecha_limite_notas_conv!=="" && !is_null($fecha_limite_notas_conv))
                                    <div class="col-md-12">
                                        <p><b>HASTA: </b> {{ \Carbon\Carbon::parse($fecha_limite_notas_conv)->locale('es')->isoFormat('dddd\, D \d\e MMMM \d\e YYYY') }}</p>
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar_subir_nota_convocatoria">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardar_subir_nota_convocatoria">GUARDAR DATOS</button>
                        </div>
                    @endif
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        {{-- ** inicio  modal carpeta: "libro de acta", folio: "nro de folio" --}}
        <div wire:ignore.self data-bs-backdrop="static" id="editar_libro_folio_plan_asignatura" class="modal fade"
            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        @if(!is_null($plan_asignatura_actual_folio_materia))
                            <h5 class="modal-title mt-0" id="myModalLabel"> 
                                {{$plan_asignatura_actual_folio_materia->siadi_asignatura->idioma->nombre_idioma }} 
                                {{ $plan_asignatura_actual_folio_materia->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                {{ $plan_asignatura_actual_folio_materia->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }} .::
                                {{ $plan_asignatura_actual_folio_materia->siadi_paralelo->nombre_paralelo }}
                            </h5>                    
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="cancelar_libro_nota"></button>
                    </div>
                    @if(!is_null($plan_asignatura_actual_folio_materia))
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="libro_notas_materia">Libro de Actas </label>
                                    <input type="text" class="form-control @error('libro_notas_materia') border-danger @enderror" wire:model="libro_notas_materia" id="libro_notas_materia" >
                                    @error('libro_notas_materia')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="nro_folio_materia">Número de Folio:</label>
                                    <input type="text" class="form-control @error('nro_folio_materia') border-danger @enderror" id="nro_folio_materia" wire:model="nro_folio_materia" />
                                    @error('nro_folio_materia')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar_libro_nota">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardar_folio_libro">GUARDAR DATOS</button>
                        </div>
                    @endif
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- ***** fin modal carpeta: "libro de acta", folio: "nro de folio" --}}

        {{-- ************************** inicio modal asignacion docente *********************************** --}}
        <div wire:ignore.self data-bs-backdrop="static" id="asignar_docente_asignatura" class="modal fade"
            tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        @if(!is_null($plan_asignatura_docente))
                            <h5 class="modal-title mt-0" id="myModalLabel"> 
                                {{ $plan_asignatura_docente->siadi_asignatura->idioma->nombre_idioma }} 
                                {{ $plan_asignatura_docente->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                {{ $plan_asignatura_docente->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }} .::
                                {{ $plan_asignatura_docente->siadi_paralelo->nombre_paralelo }} .::
                                {{ $plan_asignatura_docente->siadi_convocatoria->periodo }}-{{ $plan_asignatura_docente->siadi_convocatoria->gestion->nombre_gestion }}
                            </h5>                    
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="cancelar_asigna_docente"></button>
                    </div>
                    
                    @if(!is_null($plan_asignatura_docente))
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-3 mb-2">
                                    <label class="form-label" for="buscar_ci_docente">Buscar por CI: </label>           
                                </div>
                                <div class="col-md-5 mb-2">
                                    <input type="text" class="form-control @error('buscar_ci_docente') border-danger @enderror" wire:model="buscar_ci_docente" id="buscar_ci_docente" maxlength="14">
                                    @error('buscar_ci_docente')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-1">
                                    <button class="btn btn-success waves-effect waves-light" wire:click="buscar_por_ci_docente">BUSCAR</button>
                                    <button class="btn btn-danger waves-effect waves-light" wire:click="cancelar_ci_docente" title="cancelar busqueda"><i class="bx bx-window-close color-white"></i></button>
                                </div>
                                @if(strlen($buscar_ci_docente)>=3)
                                    @if(!is_null($docente_buscar_upea))
                                        <div class="col-md-12 row g-3 bg-soft-success rounded-2">
                                            <div class="col-md-6">
                                                <b>Nombre Completo</b> <br>
                                                <span><span title="Paterno">{{$docente_buscar_upea->paterno}}</span> <span title="Materno">{{$docente_buscar_upea->materno}}</span> <span class="text-secondary" title="Nombres">{{$docente_buscar_upea->nombre}}</span></span>
                                            </div>
                                            <div class="col-md-6">
                                                <b>Último nombramiento</b> <br>
                                                <span>{{$docente_buscar_upea->item_nombramiento}}</span> 
                                            </div>
                                            <div class="col-md-6 ">
                                                <b>CI: </b> <br>
                                                <span>{{$docente_buscar_upea->ci}} {{$docente_buscar_upea->expedido}}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <button class="btn btn-info waves-effect waves-light" wire:click="asignar_docente({{$docente_buscar_upea->id_persona}})">ASIGNAR</button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 bg-soft-danger rounded-2">No existe docente</div>
                                    @endif
                                @endif

                                <hr>
                                
                                <div class="col-md-6 mb-4">
                                    <label class="form-label @error('id_base_upea_docente') border-danger @enderror" for="id_base_upea_docente">Docente:</label>
                                    <input type="number" class="form-control  d-none" id="id_base_upea_docente" wire:model="id_base_upea_docente" />
                                    @error('id_base_upea_docente')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="data-docente">
                                        @if(is_null($id_base_upea_docente) || $id_base_upea_docente=="")
                                            <span class="text-danger">Sin docente asignado</span>
                                        @else 
                                            <span title="Nombres">{{$docente_tmp->paterno}} {{$docente_tmp->materno}} {{$docente_tmp->nombre}}</span> <br>
                                            <span title="C.I.">{{$docente_tmp->ci}} {{$docente_tmp->expedido}}</span>
                                        @endif
                                    </div>
                                </div>
                                @if($plan_asignatura_docente->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2)
                                	<div class="col-md-12 mb-4">
                                    	<label class="form-label" for="nro_resolucion_hcc_examen">Resolución RHCC:</label>
                                    	<input type="text" class="form-control @error('nro_resolucion_hcc_examen') border-danger @enderror" id="nro_resolucion_hcc_examen" wire:model="nro_resolucion_hcc_examen" >
                                    	@error('nro_resolucion_hcc_examen')
                                        	<span class="text-danger">{{ $message }}</span>
                                    	@enderror
                                	</div>
                                @else
                                <div class="col-md-6 mb-4">
                                    <label class="form-label" for="id_nombramiento_docente">Nombramiento:</label>
                                    <select class="form-select @error('id_nombramiento_docente') border-danger @enderror" id="id_nombramiento_docente" wire:model="id_nombramiento_docente" >
                                        <option value="">Seleccione..</option>
                                        @if(!is_null($nombramientos))
                                            @foreach($nombramientos as $nom)
                                                <option value="{{$nom['codex']}}">{{$nom['item_nombramiento']}} .:: {{$nom['tipo_categoria_rgs']}} .:: {{$nom['sede']}} .:: {{$nom['fecha_emision_nombramiento']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('id_nombramiento_docente')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                      		
                                </div>
                                @endif
                            </div>
                            
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar_asigna_docente">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardar_nombramiento_docente">GUARDAR DATOS</button>
                        </div>
                    @endif 
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- *************************** fin modal asignacion docente ************************************* --}}

    </div>

    @push('navi-js')
    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('openModalCreate', function() {
                    $('#agregarplanificar_asignatura').modal('show');
                });
                Livewire.on('closeModalCreate', function() {
                    $('#agregarplanificar_asignatura').modal('hide');
                });
            });

            document.addEventListener('livewire:load', function() {
                Livewire.on('openModalUploadNote', function() {
                    $('#editar_subir_nota_planificar_asignatura').modal('show');
                });
                Livewire.on('closeModalUploadNote', function() {
                    $('#editar_subir_nota_planificar_asignatura').modal('hide');
                });
            });

            document.addEventListener('livewire:load', function() {
                Livewire.on('openModalUploadNoteConvocatoria', function() {
                    $('#editar_subir_nota_plan_asignatura_convocatoria').modal('show');
                });
                Livewire.on('closeModalUploadNoteConvocatoria', function() {
                    $('#editar_subir_nota_plan_asignatura_convocatoria').modal('hide');
                });
            });

            document.addEventListener('livewire:load', function() {
                Livewire.on('openModalUpdateLibroFolioNotaAsignatura', function() {
                    $('#editar_libro_folio_plan_asignatura').modal('show');
                });
                Livewire.on('closeModalUpdateLibroFolioNotaAsignatura', function() {
                    $('#editar_libro_folio_plan_asignatura').modal('hide');
                });
            });
            
            document.addEventListener('livewire:load', function() {
                Livewire.on('openModalAsignTeacher', function() {
                    $('#asignar_docente_asignatura').modal('show');
                });
                Livewire.on('closeModalAsignTeacher', function() {
                    $('#asignar_docente_asignatura').modal('hide');
                });
                
                $('#buscar_ci_docente').maxlength({
                    alwaysShow: !0, warningClass: "badge bg-danger", limitReachedClass: "badge bg-success"
                });
            });
        </script>
    @endpush
    @push('navi-js')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('openModalEdit', function() {
                    $('#editarplanificar_asignatura').modal('show');
                });
                Livewire.on('closeModalEdit', function() {
                    $('#editarplanificar_asignatura').modal('hide');
                });

                Livewire.on('Mostrar', function(mesa) {
                    console.log(mesa);
                });
            });
        </script>
    @endpush
    @push('navi-js')
        <script>
            livewire.on('deleteplanificar_asignatura', id_planificar_asignatura => {
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
                        livewire.emit('delete', id_planificar_asignatura);

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
