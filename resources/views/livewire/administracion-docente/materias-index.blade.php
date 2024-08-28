<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">MATERIAS DOCENTE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Docente materias</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body" x-data="{ showButton: false }">

                    @if (count($materiasdocente) > 0)
                        <h2 class="text-center">MATERIAS</h2>
                        <div class="row">
                            @foreach ($materiasdocente as $materia)
                                @php
                                    $con = 0; 
                                    $color = ""; 
                                    $inscritos = 0;
                                    foreach($materia->inscripcipciones as $tmInc){
                                        if($tmInc->estado_inscripcion!=='ELIMINAR'){
                                            $inscritos++;
                                        }
                                    }
                                    $color = ($con++)%2==0? 'primary': 'info'; 
                                @endphp
                                <div class="col-md-6">
                                    <div class="card radius-10 border-start border-1 border-5 border-{{$color}}" style="border-width: 1px 1px 1px 7px;">
                                        <div class="card-header">
                                            <div class="float-start bg-{{$color}} text-white m-0 p-1"><b>{{ $con }}</b></div>
                                            <h4 class="my-0 text-{{$color}} text-center"><i class="mdi mdi-check-all me-3"></i> 
                                                {{ $materia->siadi_asignatura->idioma->nombre_idioma }}
                                                {{ $materia->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                                {{ $materia->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                {{-- {{ $materia->siadi_paralelo->nombre_paralelo }} --}}
                                            </h4>
                                            <span class="d-block text-center text-secondary">
                                                {{ $materia->siadi_convocatoria->modalidad->nombre_convocatoria_estudiante }}
                                                {{ $materia->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 1 ? '(' . $materia->siadi_convocatoria->convocatoria_costo->tipo_costo . ')' : '' }}
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center row g-3">
                                                <ul class="list-group col-md-7 border-2">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-home"></i> <b> SEDE</b> <br>
                                                            <span>{{$materia->siadi_convocatoria->siadi_sede->sede_upea->nombre}}</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-map-alt"></i> <b>DIRECCIÓN</b> <br>
                                                            <span>{{$materia->siadi_convocatoria->siadi_sede->direccion}}</span>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                                        <div>
                                                            <i class="fs-6 bx bxs-user-detail"></i> <b>DOCENTE</b> <br>
                                                            @php $estado_rhcc = ( !is_null($materia->resolucion_rhcc) && $materia->resolucion_rhcc!=="") @endphp
                                                            @if(is_null($materia->id_asignacion_docente))
                                                                <span class="text-danger">Sin docente asignado</span>
                                                                @if($materia->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2)
                                                                    @if($estado_rhcc)
                                                                        <p class="mt-0 pt-0 text-secondary " title="resolución RHCC"><small>{{$materia->resolucion_rhcc}}</small></p>
                                                                    @else 
                                                                        <p class="mt-0 pt-0 text-danger " title="resolución RHCC"><small>Sin resolución RHCC</small></p>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @php $estado_nom = ( !is_null($materia->siadi_nombramiento) && $materia->siadi_persona_asignada_docente->id == $materia->siadi_nombramiento->id_persona) @endphp
                                                                <span><!-- <i class="bx bxs-user-detail"></i> --> @if($estado_nom) <span title="Grado nombramiento">{{$materia->siadi_nombramiento->grado_nombramiento}}</span> @endif {{ $materia->siadi_persona_asignada_docente->nombre .' '.$materia->siadi_persona_asignada_docente->paterno .' '. $materia->siadi_persona_asignada_docente->materno }} </span>
                                                                @if($materia->siadi_convocatoria->modalidad->id_convocartoria_estudiante == 2)
                                                                    
                                                                    @if($estado_rhcc)
                                                                        <p class="mt-0 pt-0 text-secondary " title="resolución RHCC"><small>{{$materia->resolucion_rhcc}}</small></p>
                                                                    @else 
                                                                        <p class="mt-0 pt-0 text-danger " title="resolución RHCC"><small>Sin resolución RHCC</small></p>
                                                                    @endif
                                                                @else
                                                                    @if($estado_nom)
                                                                        <p class="mt-0 pt-0 text-secondary " title="nombramiento docente"><small>{{$materia->siadi_nombramiento->item_nombramiento}}</small></p>
                                                                    @else 
                                                                        <p class="mt-0 pt-0 text-danger " title="nombramiento docente"><small>Sin Nombramineto asignado</small></p>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </li>
                                                    
                                                </ul>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-0 text-secondary">Paralelo</p>
                                                            <h4 class="my-1 mt-0 text-{{$color}} {{strlen($materia->siadi_paralelo->nombre_paralelo)>=8? 'fs-6': ''}}">{{ $materia->siadi_paralelo->nombre_paralelo }}</h4>
                                                        </div>
                                                        <div class="col-md-6 border-start border-0 border-2">
                                                            <p class="mb-0 text-secondary">Gestión</p>
                                                            <h4 class="my-1 mt-0 text-{{$color}}">{{ $materia->siadi_convocatoria->periodo }}-{{ $materia->siadi_convocatoria->gestion->nombre_gestion }}</h4>
                                                        </div>
                                                    </div>
                                                    <hr class="border-1 mt-0">
                                                    <p class="mb-0 text-secondary">Turno: {{$materia->hora_clases_inicio}}-{{$materia->hora_clases_fin}}</p>
                                                    <h4 class="my-1 text-{{$color}}"> {{ $materia->turno_paralelo }}</h4>
                                                    <hr class="border-1 mt-0">
                                                    <p class="mb-0 text-secondary">Total Inscritos</p>
                                                    <h4 class="my-1 text-{{$color}}"><i class="bx bxs-user-check "></i> {{$inscritos}}</h4>
                                                    <hr class="border-1 mt-0">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-evenly">
                                            <div>
                                                @if ($materia->estado_docente == '1') {{-- PARA QUE PUEDA LISTAR MATERIA --}}
                                                    <a type="button" class="btn btn-{{$color}} waves-effect waves-light"
                                                    target="_blank" href="{{ route('docente.materias.show', ['id_planificar_asignatura' => $materia->id_planificar_asignatura ]) }}" >
                                                    <i class=" bx bx-list-ul fs-6"></i> Listar Estudiantes
                                                    </a>
                                                @else
                                                    <div class="text-center"><strong class="text-danger">ASIGNATURA CERRADA</strong></div>
                                                @endif
                                                @if ($inscritos > 0)
                                                    <a type="button" class="btn btn-success waves-effect waves-light"
                                                    target="_blank" href="{{ route('reporte_planificar_asignatura_csv', ['id_planificar_asignatura' => base64_encode(str_pad($materia->id_planificar_asignatura, 15, '0', STR_PAD_LEFT)) ]) }}" >
                                                    <i class=" bx bxs-file text-white fs-4"></i> CSV Lista CSV
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center"><strong class="text-danger">SIN ASIGNATURA</strong></div>
                    @endif





                </div>
            </div>
        </div>
    </div>
</div>

@push('navi-js')
    <script>
        // Escuchar el evento para actualizar la nota y observación en tiempo real
        Livewire.on('notaActualizada', (id) => {
            const notaSpan = document.getElementById(`nota-${id}`);
            const observacionSpan = document.getElementById(`observacion-${id}`);
            const newValue = @this.get(`notaFinal.${id}`);

            notaSpan.textContent = newValue;
            observacionSpan.textContent = (newValue >= 51) ? 'APROBADO' : 'REPROBADO';
        });
    </script>
@endpush
</div>
