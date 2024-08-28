
<div>
    @push('style-custom.css')
        <!-- hide arrow input:number -->
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input#nota_final {
            -moz-appearance: textfield;
        }
    </style>
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">MIGRAR</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Migrar</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- ------------ inicio contenedor principal ------------ -->
	<div class="row">

        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    <!-- ============== inicio header selects ============= -->
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="gestion" class="form-label">Gestión</label>
                            <select id="gestion" class="form-select" wire:model="gestion" wire:change="on_change_gestion">
                                <option value="">Seleccione</option>
                                @foreach ($gestiones as $gestion)
                                    <option value="{{ $gestion->id_gestion }}">{{ $gestion->nombre_gestion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            @if($statusPeriodo)
                            <label for="periodo" class="form-label">Periodo</label>
                            <select id="periodo" class="form-select" wire:model="periodo" wire:change="on_change_periodo">
                                <option value="">Seleccione</option>
                                @foreach ($periodos as $perio)
                                    <option value="{{ $perio->periodo }}">{{ $perio->periodo }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>

                        <div class="col-md-5">
                            @if($statusTipoConvocatoria)
                            <label for="tipo_convocatoria" class="form-label">Nombre Convocatoria - Modalidad - Sede</label>
                            <select id="tipo_convocatoria" class="form-select" wire:model="tipo_convocatoria" wire:change="on_change_tipo_convocatoria">
                                <option value="">Seleccione</option>
                                @foreach($convocatorias as $convocatory)
                                    <option value="{{$convocatory->id_siadi_convocatoria. ';'. $convocatory->sede}}">{{$convocatory->nombre_convocatoria}} .:: {{$convocatory->modalidad->nombre_convocatoria_estudiante}} {{ $convocatory->id_modalidad_curso==1? '('.$convocatory->convocatoria_costo->tipo_costo.')': '' }} .:: {{$convocatory->siadi_sede->sede_upea->nombre}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-md-3">
                            @if($this->statusAsignatura)
                                <label for="tipo_asignatura" class="form-label">Asignatura</label>
                                <select id="tipo_asignatura" class="form-select" wire:model="tipo_asignatura" wire:change="">
                                    <option value="">Seleccione</option>
                                    @php $anterior_id_idioma = ''; @endphp
                                    @foreach($asignaturas as $asignatura_select)
                                        @if($asignatura_select->estado_asignatura !== 'ELIMINAR' && $anterior_id_idioma !== $asignatura_select->idioma->id_idioma)
                                            <option value="{{$asignatura_select->idioma->id_idioma}}">{{$asignatura_select->idioma->nombre_idioma}}</option>
                                            @php $anterior_id_idioma = $asignatura_select->idioma->id_idioma; @endphp
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>

                    </div>
                    <!-- =============== fin header selects ============= -->

                    <br>
                    
                    <!-- ============== inicio content ============= -->
                    <div class="row g-3">
                        
                        @if($statusTipoConvocatoria==true && $tipo_convocatoria !== "")
                            @if(count($asignaturas)>0)
                                @php
                                    $estilo_paralelo = [
                                        "Mañana" => ["icono" => "bxs-sun", "color" => "text-primary"],
                                        "Tarde" => ["icono" => "bxs-sun", "color" => "text-warning"],
                                        "Noche" => ["icono" => "bxs-moon", "color" => ""],
                                        "Sin turno" => ["icono" => "bxs-minus-circle", "color" => "text-danger"],
                                    ]; 
                                    $contador = 1;
                                @endphp
                                @foreach($asignaturas as $asignatura)
                                    @if( ($tipo_asignatura=="") || ($tipo_asignatura!=="" && $asignatura->id_idioma==$tipo_asignatura) )
                                        <div class="col-xl-3 col-sm-6 col-12"> 
                                            <div class="card bg-soft-secondary ">
                                                <div class="card-title text-center bg-primary bg-gradient text-white">
                                                    <div class="float-start  bg-danger">{{str_pad($contador++, 2, "0", STR_PAD_LEFT)}}</div>
                                                    <h3>{{$asignatura->idioma->nombre_idioma}} {{$asignatura->nivel_idioma->descripcion_nivel_idioma}} {{$asignatura->nivel_idioma->nombre_nivel_idioma}}</h3>
                                                </div>
                                                <div class="card-content bg-light">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="align-self-center">
                                                                <h3>Paralelos</h3>
                                                                    @php $contador_estudiantes = 0; @endphp
                                                                    @foreach($asignatura->siadi_asignatura_planificar as $planificar_asing)
                                                                        @if($planificar_asing->id_siadi_convocatoria==$id_convocatoria && $planificar_asing->estado_planificar_asignartura!=='ELIMINADO')
                                                                            <i class="bx fs-4 {{$estilo_paralelo[$planificar_asing->turno_paralelo]['icono']}} {{$estilo_paralelo[$planificar_asing->turno_paralelo]['color']}}" title="Turno: {{$planificar_asing->turno_paralelo}}"></i> Paralelo {{$planificar_asing->siadi_paralelo->nombre_paralelo}} <br>
                                                                            @foreach($planificar_asing->inscripcipciones as $ins)
                                                                                @if($planificar_asing->id_planificar_asignatura == $ins->id_planificar_asignatura && $ins->estado_inscripcion!=='ELIMINAR')
                                                                                    @php $contador_estudiantes++; @endphp
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                            </div>
                                                            <div class="text-right">
                                                                <h3><i class="bx bxs-user text-primary fs-3"></i> {{$contador_estudiantes}}</h3>
                                                                <span>Estudiantes <br> Inscritos</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @can('migrar.show')
                                                <div class="card-footer bg-white d-flex justify-content-evenly border border-top-0 border-soft-info">
                                                    <button class="btn btn-outline-primary waves-effect waves-light font-weight-bold" wire:click="show_asignatura({{$asignatura->id_siadi_asignatura}})">VERIFICAR ESTUDIANTE</button>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else 
                                <p>No hay Registros</p>
                            @endif
                        @endif
                    </div>
                    <!-- =============== fin content ============== -->
                </div>
                <!-- -------- end card-body ----------- -->

                <!-- *********************** modales ***************** -->
                
                <!-- ***************** inicio modal buscar_persona ************* -->
                @can('migrar.show')
                <div wire:ignore.self id="verificarInscripcionCI" class="modal fade" tabindex="-1" role="dialog"
                     aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-xl"> <!-- modal-lg -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    @php
                                        $modalidad = null;
                                        if(!is_null($this->asignatura_actual)){
                                            foreach($this->asignatura_actual->siadi_asignatura_planificar as $asign){
                                                if($asign->id_siadi_convocatoria == $this->id_convocatoria){
                                                    $modalidad = $asign->siadi_convocatoria;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    <h5 class="modal-title mt-0" >
										VERIFICAR INSCRIPCIÓN {{ is_null($this->asignatura_actual)? '': 
											'.:: '. $this->asignatura_actual->idioma->nombre_idioma .' '. $this->asignatura_actual->nivel_idioma->descripcion_nivel_idioma .' '.  $this->asignatura_actual->nivel_idioma->nombre_nivel_idioma}}
										@if(!is_null($this->asignatura_actual) && !is_null($modalidad))
                                            .:: {{$modalidad->modalidad->nombre_convocatoria_estudiante}} {{$modalidad->id_modalidad_curso==1? ' ('. $modalidad->convocatoria_costo->tipo_costo .')': ''}}
                                        @endif
									</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        wire:click="close_asignatura"></button>
                                </div>
                                <div class="modal-body">
                                    @if( !is_null($this->asignatura_actual) )
                                        @can('migrar.create')
                                        <div class="row">
                                            <div class="mb-3 col-lg-1 d-flex align-items-center justifify-content-center">
                                                <label class="d-block form-label" for="ci_buscar">CI: </label>
                                            </div>
                                            <div class="mb-3 col-lg-4">
                                                <input type="text" id="ci_buscar"  wire:model="ci_buscar" maxlength="15"
                                                    class="form-control" value="{{$ci_buscar}}" />
                                                @error('ci_buscar') 
                                                    <span class="error">{{ $message }}</span> 
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-lg-7">
                                                
                                                @if(is_null($estudiante_buscar_existe_local) && strlen($ci_buscar)>=3)
                                                    <button type="button" class="btn btn-outline-primary" wire:click="mostrar_form_registrar_persona">Registrar</button>
                                                @elseif(strlen($ci_buscar)>=3 && !is_null($estudiante_buscar_existe_local))
                                                    <h5 class="text-success">DATOS PERSONA</h5> 
                                                    <i class="bx bxs-user-detail"></i> <b>CI<span class="text-danger">:</span></b> {{$estudiante_buscar_existe_local->ci_persona. ' '. $estudiante_buscar_existe_local->expedido_persona }} </br>
                                                    <i class="bx bxs-user"></i> <b>Nombre Completo<span class="text-danger">:</span></b> {{$estudiante_buscar_existe_local->paterno_persona .' '. $estudiante_buscar_existe_local->materno_persona .' '. $estudiante_buscar_existe_local->nombres_persona}} </br>
                                                    <i class="bx bxs-calendar-plus"></i> <b>Fecha Nacimiento<span class="text-danger">:</span></b> {{\Carbon\Carbon::parse($estudiante_buscar_existe_local->fecha_nacimiento_persona)->locale('es')->isoFormat('DD \d\e MMMM \d\e YYYY')}} <br>
                                                    <i class="bx bxs-map-alt"></i> <b>País<span class="text-danger">:</span></b> {{$estudiante_buscar_existe_local->pais->nombre_siadi_pais}}
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @if(strlen($ci_buscar)>=3)
                                            <div>
                                                @if(!is_null($estudiante_buscar_esta_inscrito))
                                                    <span class="text-success">El estudiante se encuentra registrado</span>
                                                @else
                                                    <span class="text-danger">El estudiante no está registrado en la asignatura</span> <br>
                                                    @if(!is_null($estudiante_buscar_existe_local) && strlen($ci_buscar)>=3)
                                                        @php 
                                                            $id_asignatura = null; 
                                                            $id_nivel_asignatura = null; 
                                                        @endphp

                                                        <div class="table-responsive">
                                                            <table class="table mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Periodo</th>
                                                                        <th>Asignatura</th>
                                                                        <th>Paralelo</th>
                                                                        <th>Modalidad</th>
                                                                        <th>Observación</th>
                                                                        <th>Nota Final</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                	@php $segundo_estado = false; $gestion_s_estado = ''; @endphp
                                                                    @foreach($estudiante_buscar_existe_local->persona_inscrita as $inscrito_otro_similar)
                                                                        @if($inscrito_otro_similar->planificar_asignatura->siadi_asignatura->id_idioma==$asignatura_actual->id_idioma && $inscrito_otro_similar->planificar_asignatura->siadi_asignatura->id_nivel_idioma==$asignatura_actual->id_nivel_idioma
                                                                                && $inscrito_otro_similar->estado_inscripcion!=='ELIMINADO' && $inscrito_otro_similar->planificar_asignatura->estado_planificar_asignartura!=='ELIMINADO' && $inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->estado_convocatoria!=='ELIMINADO')
                                                                            <tr>
                                                                                <th scope="row">{{$inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->periodo}}-{{$inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion}}</th>
                                                                                <td>{{$inscrito_otro_similar->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma}} {{$inscrito_otro_similar->planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma}} {{$inscrito_otro_similar->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma}}</td>
                                                                                <td>{{$inscrito_otro_similar->planificar_asignatura->siadi_paralelo->nombre_paralelo}}</td>
                                                                                <td>{{$inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->modalidad->nombre_convocatoria_estudiante}} {{($inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->id_modalidad_curso==1)? '('.$inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->convocatoria_costo->tipo_costo. ')': ''}}</td>
                                                                                <td>{{$inscrito_otro_similar->notas->observaciones_detalle}} </td>
                                                                                <td>{{$inscrito_otro_similar->notas->final_nota}} </td>
                                                                            </tr>
                                                                            
                                                                            @if($inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->id_modalidad_curso == $modalidad->id_modalidad_curso)
                                                                            	@php $segundo_estado = true;
                                                                           		$gestion_s_estado = $inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->periodo .'/'. $inscrito_otro_similar->planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion;
																				@endphp
                                                                            @endif 
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endif
                                        @endcan

                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h3 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Información de la Asignatura
                                                    </button>
                                                </h3>
                                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionDataAsignatura">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <b>Paralelo</b>
                                                            </div>
                                                            <div class="col-7 text-center"><b>Cupos</b></div>
                                                        </div>
                                                        @foreach($asignatura_actual->siadi_asignatura_planificar as $planificar_actual_asignatura)
                                                            @if($planificar_actual_asignatura->id_siadi_convocatoria==$id_convocatoria && $planificar_actual_asignatura->estado_planificar_asignartura!=='ELIMINADO')
                                                                <div class="row">
                                                                    <div class="col-2 border-2 border-bottom d-flex align-items-center justify-content-center">
                                                                        <b class="d-block">{{$planificar_actual_asignatura->siadi_paralelo->nombre_paralelo}}</b>
                                                                    </div>
                                                                    <div class="col-7 border-2 border-bottom">
                                                                        @php $contador_estudiantes_asignatura = 0; @endphp
                                                                        @foreach($planificar_actual_asignatura->inscripcipciones as $inscrip_estudiante)
                                                                            @if($planificar_actual_asignatura->id_planificar_asignatura == $inscrip_estudiante->id_planificar_asignatura && $inscrip_estudiante->estado_inscripcion!=='ELIMINADO')
                                                                                @php $contador_estudiantes_asignatura++; @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        @php $porcentaje_plan_asign = $planificar_actual_asignatura->cupo_maximo_paralelo!==0?
                                                                            round( ($contador_estudiantes_asignatura / $planificar_actual_asignatura->cupo_maximo_paralelo)*100, 2, PHP_ROUND_HALF_EVEN)
                                                                            : $contador_estudiantes_asignatura*100; 
                                                                        @endphp
                                                                        <span class="text-white bg-success rounded-2 small">{{$contador_estudiantes_asignatura}}/{{$planificar_actual_asignatura->cupo_maximo_paralelo}}</span> estudiantes inscritos
                                                                        <div class="progress mb-4 bg-soft-secondary" style="height: 15px;">
                                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$porcentaje_plan_asign?>%" aria-valuenow="{{$porcentaje_plan_asign}}" aria-valuemin="0" aria-valuemax="100">{{$porcentaje_plan_asign}}%</div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    @can('migrar.create')
                                                                    <div class="col-3 border-2 border-bottom">
                                                                        @if($planificar_actual_asignatura->cupo_maximo_paralelo!==0 && !is_null($estudiante_buscar_existe_local) && is_null($estudiante_buscar_esta_inscrito) && $segundo_estado == false)
                                                                            <button type="button" class="btn btn-outline-success" wire:click="mostrar_form_inscribir({{$planificar_actual_asignatura->id_planificar_asignatura}})">{{$contador_estudiantes_asignatura < $planificar_actual_asignatura->cupo_maximo_paralelo? 'Inscribir': 'Forzar inscripción'}}</button>
                                                                        @else 
                                                                            @php 
                                                                                $texto = 'No disponible';
                                                                                if (strlen($ci_buscar)>=3){
                                                                                    if( is_null($estudiante_buscar_existe_local) ) {
                                                                                        $texto = 'No existe estudiante';
                                                                                    } else if( !is_null($estudiante_buscar_esta_inscrito) ) {
                                                                                        foreach($estudiante_buscar_esta_inscrito->persona_inscrita as $persona_inscripcion){
                                                                                            if($persona_inscripcion->estado_inscripcion!=='ELIMINADO' && $persona_inscripcion->id_planificar_asignatura==$planificar_actual_asignatura->id_planificar_asignatura){
                                                                                                $texto = "Inscrito";
                                                                                                break;
                                                                                            }
                                                                                        }
                                                                                    } else if($segundo_estado == true){
                                                                                        $texto = 'Registrado '. $gestion_s_estado;
                                                                                    }
                                                                                }
                                                                                
                                                                            @endphp
                                                                            <div class="btn {{$texto=='Inscrito'? 'btn-dark': 'btn-secondary'}}">{{$texto}}</div>
                                                                        @endif
                                                                    </div>
                                                                    @endcan
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                        wire:click="close_asignatura">CANCELAR</button>
                                </div>
                            </div> <!-- end modal-content -->
                            
                        </div>
                </div>
                @endcan
                <!-- ***************** fin modal buscar_persona ************* -->


                <!-- ***************** inicio modal registrar estudiante ************* -->
                @canany(['personas.inscribir', 'personas.edit'])
                <div wire:ignore.self id="agregarPersona" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabelTitle" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content modal-lg">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabelTitle">AGREGAR PERSONA</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    wire:click="close_agregar_persona"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label">CI:</label> <br>
                                            {{-- <input type="text" class="form-control @if($errors->has('ci')) border-danger @endif" wire:model="ci" disabled> --}}
                                            <label for="form-control @if($errors->has('ci')) border-danger @endif">{{ $ci }}</label>
                                            @error('ci')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="expedido">EXPEDIDO:</label>
                                            <select class="form-select @if($errors->has('expedido')) border-danger @endif" wire:model="expedido" id="expedido">
                                                <option value="">Seleccione</option>
                                                @foreach($expedido_data as $exped)
                                                    <option value="{{$exped}}">{{$exped}}</option>
                                                @endforeach
                                            </select>
                                            <!-- <input type="text" class="form-control" wire:model=""> -->
                                            @error('expedido')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--
                                    <div class="col-md-3">
                                        <div class="mb-6">
                                            <label class="form-label" for="tipo_documento">TIPO DOCUMENTO:</label>
                                            <select class="form-select @if($errors->has('tipo_documento')) border-danger @endif" wire:model="tipo_documento" id="tipo_documento">
                                                <option value="">Seleccione</option>
                                                @foreach($tipo_documento_data as $tip_doc)
                                                    <option value="{{$tip_doc}}">{{$tip_doc}}</option>
                                                @endforeach
                                            </select>
                                            <!-- <input type="text" class="form-control" wire:model=""> -->
                                            @error('tipo_documento')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    --}}

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="estado_civil">ESTADO CIVIL:</label>
                                            <select class="form-select @if($errors->has('estado_civil')) border-danger @endif" wire:model="estado_civil" id="estado_civil">
                                                <option value="">Seleccione</option>
                                                @foreach($estados_civiles as $estado_civ)
                                                    <option value="{{$estado_civ}}">{{$estado_civ}}</option>
                                                @endforeach
                                            </select>
                                            <!-- <input type="text" class="form-control " wire:model="" id=""> -->
                                            @error('estado_civil')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="nombre">NOMBRE:</label>
                                            <input type="text" class="form-control @if($errors->has('nombre')) border-danger @endif" wire:model="nombre" id="nombre">
                                            @error('nombre')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="paterno">PATERNO:</label>
                                            <input type="text" class="form-control @if($errors->has('paterno')) border-danger @endif" wire:model="paterno" id="paterno">
                                            @error('paterno')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="materno">MATERNO:</label>
                                            <input type="text" class="form-control @if($errors->has('materno')) border-danger @endif" wire:model="materno" id="materno">
                                            @error('materno')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="pais">PAÍS:</label>
                                            
                                            <select class="form-select @if($errors->has('pais')) border-danger @endif" wire:model="pais" id="pais">        	
												<option value="">Seleccione país</option>
												@foreach($paises as $pais_value)
													<option value="{{$pais_value->id_siadi_pais}}">{{$pais_value->nombre_siadi_pais}}</option>
												@endforeach
                                            </select>
                                            @error('pais')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="genero">GÉNERO:</label>
                                            <select class="form-select @if($errors->has('genero')) border-danger @endif" wire:model="genero" id="genero">
                                                <option value="">Seleccione</option>
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
                                            <label class="form-label" for="fecha_nacimiento">FECHA DE NACIMIENTO:</label>
                                            <input type="date" class="form-control @if($errors->has('fecha_nacimiento')) border-danger @endif" wire:model="fecha_nacimiento" id="fecha_nacimiento" required pattern="\d{4}-\d{2}-\d{2}">
                                            @error('fecha_nacimiento')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="profesion">PROFESIÓN:</label>
                                            <input type="text" class="form-control @if($errors->has('profesion')) border-danger @endif" wire:model="profesion" id="profesion">
                                            @error('profesion')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="direccion">DIRECCIÓN:</label>
                                            <input type="text" class="form-control @if($errors->has('direccion')) border-danger @endif" wire:model="direccion" id="direccion">
                                            @error('direccion')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="telefono">TELÉFONO:</label>
                                            <input type="text" class="form-control @if($errors->has('telefono')) border-danger @endif" wire:model="telefono" id="telefono">
                                            @error('telefono')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="celular">CELULAR:</label>
                                            <input type="text" class="form-control @if($errors->has('celular')) border-danger @endif" wire:model="celular" id="celular">
                                            @error('celular')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="email">EMAIL:</label>
                                            <input type="text" class="form-control @if($errors->has('email')) border-danger @endif" wire:model="email" id="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-6">
                                            <label class="form-label" for="tipo_estudiante">TIPO ESTUDIANTE:</label>
                                            <select wire:model="tipo_estudiante" class="form-select @if($errors->has('tipo_estudiante')) border-danger @endif" id="tipo_estudiante">
                                                <option value=''>Seleccionar ...</option>
                                                @foreach ($tipo_estudiante2 as $tipo_e)
                                                    <option value="{{ $tipo_e->id_tipo_estudiante }}">
                                                        {{ $tipo_e->nombre_tipo_estudiante }}</option>
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
                                <button type="button" class="btn btn-danger waves-effect" 
                                        wire:click="close_agregar_persona">CANCELAR</button> <!-- data-bs-dismiss="modal" -->
                                <button class="btn btn-primary waves-effect waves-light"
                                    wire:click="guardar_persona_migracion">GUARDAR PERSONA</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- END = modal-dialog modal-lg -->
                </div>
                @endcanany
                <!-- ****************** fin modal registra estudiante ************** -->


                <!-- ***************** inicio modal registrar inscripcion migracion ************* -->
                <div wire:ignore.self id="agregarInscripcionMigracion" class="modal" data-easein="expandIn" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabelTitle" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content modal-lg">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" >INSCRIPCION MIGRACION</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    wire:click="close_form_inscribir"></button>
                            </div>
                            <div class="modal-body">
                                @if(!is_null($dataPlanificarAsignaturaForm) && !is_null($estudiante_buscar_existe_local) && strlen($ci_buscar)>=3)
                                    <div class="row bg-soft-secondary rounded-1">
                                        <div class="mb-1 col-md-12"><h5 class="text-center text-primary pt-1">DATOS INSCRIPCIÓN</h5></div>
                                        <div class="mb-3 col-md-5">
                                            <label class="form-label" >ESTUDIANTE</label>
                                            <label class="form-control">{{$estudiante_buscar_existe_local->paterno_persona .' '. $estudiante_buscar_existe_local->materno_persona .' '. $estudiante_buscar_existe_local->nombres_persona}} ({{$estudiante_buscar_existe_local->ci_persona. ' '. $estudiante_buscar_existe_local->expedido_persona }})</label>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label" >ASIGNATURA</label>
                                            <label class="form-control">{{$dataPlanificarAsignaturaForm->siadi_asignatura->idioma->nombre_idioma}} {{$dataPlanificarAsignaturaForm->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma}} {{$dataPlanificarAsignaturaForm->siadi_asignatura->nivel_idioma->nombre_nivel_idioma}}</label>
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" >OBSERVACION</label>
                                            <label class="form-control">MIGRACION</label>
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" for="fecha_inscripcion">FECHA DE INSCRIPCIÓN</label>
                                            <input type="date" class="form-control @error('fecha_inscripcion') border-danger @enderror" id="fecha_inscripcion" wire:model="fecha_inscripcion" value="{{$fecha_inscripcion}}" required pattern="\d{4}-\d{2}-\d{2}">
                                            @error('fecha_inscripcion')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" for="tipo_pago">TIPO DE PAGO</label>
                                            <select id="tipo_pago" class="form-select  @error('tipo_pago') border-danger @enderror" wire:model="tipo_pago">
                                                <option value="">Seleccionar</option>
                                                @foreach($tipos_de_deposito as $depositos){
                                                    <option value="{{$depositos}}">{{$depositos}}</option>
                                                }
                                                @endforeach
                                            </select>
                                            @error('tipo_pago')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" for="monto_deposito">MONTO DE DEPÓSITO</label>
                                            <input type="number" class="form-control @error('monto_deposito') border-danger @enderror" id="monto_deposito" wire:model="monto_deposito" value="{{$monto_deposito}}">
                                            @error('monto_deposito')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            @if($statusNroDeposito)
                                                <label class="form-label" for="nro_deposito">NRO. DE DEPÓSITO</label>
                                                <input type="number" class="form-control @error('nro_deposito') border-danger @enderror" id="nro_deposito" wire:model="nro_deposito">
                                                @error('nro_deposito')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row ">
                                        <div class="mb-1 col-md-12"><h5 class="text-center text-primary pt-1">NOTAS</h5></div>
                                        <div class="mb-4 col-md-3">
                                            <label class="form-label" for="nota_final">NOTA FINAL</label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <span class="input-group-btn input-group-prepend">
                                                    <button class="btn btn-primary bootstrap-touchspin-down" type="button" wire:click="menos" >-</button>
                                                </span>
                                                <input type="number" value="{{$nota_final}}" id="nota_final" class="form-control @if($errors->has('nota_final')) border-danger @endif" maxlength="3" wire:model="nota_final"
                                                    min="0" max="100" > <!-- actualiza_value_sum -->
                                                <span class="input-group-btn input-group-append">
                                                    <button class="btn btn-primary bootstrap-touchspin-up" type="button" wire:click="mas" >+</button>
                                                </span>
                                            </div>
                                            @error('nota_final')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" >OBSERVACION</label>
                                            @if(!$errors->has('nota_final')) 
                                                @php 
                                                    $class_nota = "";
                                                    if(!is_null($class_nota)){
                                                        if($nota_observacion == "APROBADO"){
                                                            $class_nota = "bg-soft-success";
                                                        } else if($nota_observacion == "REPROBADO"){
                                                            $class_nota = "bg-soft-warning";
                                                        } else if($nota_observacion == "NO SE PRESENTO"){
                                                            $class_nota = "bg-soft-danger";
                                                        }
                                                    }
                                                @endphp
                                                <label class="form-control {{$class_nota}} fw-bold" >{{$nota_observacion}}</label>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" for="nro_folio">NRO. DE FOLIO</label>
                                            <input type="text" class="form-control @if($errors->has('nro_folio')) border-danger @endif" wire:model="nro_folio" value="{{$nro_folio}}" id="nro_folio">
                                            @error('nro_folio')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label" for="nro_carpeta_nota">NRO. DE LIBRO</label>
                                            <input type="text" class="form-control @if($errors->has('nro_carpeta_nota')) border-danger @endif" wire:model="nro_carpeta_nota" value="{{$nro_carpeta_nota}}" id="nro_carpeta_nota">
                                            @error('nro_carpeta_nota')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @else 
                                    <p>NO DATA FROUND</p>
                                @endif
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" 
                                        wire:click="close_form_inscribir">CANCELAR</button> <!-- data-bs-dismiss="modal" -->
                                <button class="btn btn-primary waves-effect waves-light"
                                    wire:click="guardar_form_inscribir">GUARDAR INSCRIPCIÓN</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- END = modal-dialog modal-lg -->
                </div>
                <!-- ******************* fin modal registrar inscripcion migracion ************** -->

                <!-- ********************* fin modales *************** -->
            </div>
        </div>
    </div>
	<!-- --------------- fin contenedor principal ------------ -->

    @push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
        
            Livewire.on('showModalVerificarInscripcion', ()=> {
                $('#verificarInscripcionCI').modal('show');
            });
            Livewire.on('closeModalVerificarInscripcion', ()=> {
                $('#verificarInscripcionCI').modal('hide');
            });


            Livewire.on('showModalAgregarPersona', ()=> {
                $('#agregarPersona').modal('show');
            });
            Livewire.on('closeModalAgregarPersona', ()=> {
                $('#agregarPersona').modal('hide');
            });

            Livewire.on('showModalAgregarInscripcionMigracion', ()=> {
                $('#agregarInscripcionMigracion').modal('show');
            });
            Livewire.on('closeModalAgregarInscripcionMigracion', ()=> {
                $('#agregarInscripcionMigracion').modal('hide');
            });
            

            Livewire.on('mostrar', (mensaje)=> {
                console.log(mensaje);
            });

            Livewire.on('alertCreateUser', function(message) {
                Swal.fire({
                    title: 'Guardado con exito!',
                    icon: 'success',
                    html: message,
                })
            });
        });
    </script>
    @endpush
</div>
