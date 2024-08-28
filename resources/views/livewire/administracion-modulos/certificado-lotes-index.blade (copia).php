<div>
    @push('style-custom.css')
        <!-- hide arrow input:number -->
        <style type="text/css">
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
    @endpush

	<div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓN CERTIFICADOS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Administración Certificados</li>
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
                        <label for="tipo_convocatoria" class="form-label">Sede - Tipo Convocatoria</label>
                        <select id="tipo_convocatoria" class="form-select" wire:model="tipo_convocatoria" wire:change="on_change_tipo_convocatoria">
                            <option value="">Seleccione</option>
                            @foreach($convocatorias as $convocatory)
                                <option value="{{$convocatory->id_tipo_convocatoria. ';'. $convocatory->sede}}">{{$convocatory->convocatoria}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="col-md-3">
                        @if($statusAsignatura)
                        <label for="asignatura" class="form-label">Asignatura</label>
                        <select id="asignatura" class="form-select" wire:model="asignatura">
                            <option value="">Seleccione</option>
                            @foreach($asignaturas as $asigna)
                                <option value="{{$asigna->id_siadi_asignatura}}">{{$asigna->asignatura}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>


                <br>
                @if($this->asignatura=="" && $this->statusAsignatura)
                    <p>Se muestran Todas las materias agrupados por paralelos</p>
                    <ul>
                        @if(count($asignaturas_all)>0)
                        <div class="row column-gap-3 row-gap-3 justify-content-around">
                            
                            <div class="col-md-5 border border-2 border-secondary rounded">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$asignaturas_all[0]->materia}} <br>
                                        <small> {{$asignaturas_all[0]->modalidad}} </small></h5>
                                    
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{$asignaturas_all[0]->sigla_asignatura}} <br> {{$asignaturas_all[0]->paralelo}}
                                            <span class="badge bg-{{$asignaturas_all[0]->con_certificados>0 && $asignaturas_all[0]->con_certificados==$asignaturas_all[0]->inscritos_con_nota? 'success': 'warning'}} rounded-pill">{{$asignaturas_all[0]->con_certificados}} , {{$asignaturas_all[0]->inscritos_con_nota}}</span>
                                        </li>
                                        @php 
                                            $actualPlanAsign = $asignaturas_all[0]->id_siadi_asignatura;
                                            $sumaConCertificados = $asignaturas_all[0]->con_certificados;
                                            $sumaConNota = $asignaturas_all[0]->inscritos_con_nota;
                                            $i = 0;
                                        @endphp
                                        @for($i=1; $i<count($asignaturas_all); $i++) 
                                            @if($actualPlanAsign!==$asignaturas_all[$i]->id_siadi_asignatura)
                                                        </ul>
                                                    </div>
                                                    <div class="card-footer d-flex justify-content-evenly">
                                                        @if($sumaConCertificados!==$sumaConNota && $sumaConNota>0)
                                                            <button type="button" class="btn btn-danger waves-effect" 
                                                                wire:click="mostrar_form_generar_lote({{$actualPlanAsign}})">GENERAR PDFs</button> <!-- data-bs-toggle="modal" data-bs-target="#agregarCertificadosLote" -->
                                                        @endif
                                                        @if($sumaConCertificados!==0)
                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light" wire:click="pdf_lote({{$actualPlanAsign}})">IMPRIMIR PDF</button>
                                                        @endif
                                                    </div>
                                                </div>

                                                @php 
                                                    $actualPlanAsign = $asignaturas_all[$i]->id_siadi_asignatura;
                                                    $sumaConCertificados = $asignaturas_all[$i]->con_certificados;
                                                    $sumaConNota = $asignaturas_all[$i]->inscritos_con_nota
                                                @endphp
                                                
                                                <div class="col-md-5 border border-2 border-secondary rounded">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-center">{{$asignaturas_all[$i]->materia}} <br>
                                                        <small>{{$asignaturas_all[$i]->modalidad}}</small></h5>
                                                        <ul class="list-group">
                                            @else
                                                @php 
                                                    $sumaConCertificados += $asignaturas_all[$i]->con_certificados;
                                                    $sumaConNota += $asignaturas_all[$i]->inscritos_con_nota
                                                @endphp          
                                            @endif
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{$asignaturas_all[$i]->sigla_asignatura}} <br> {{$asignaturas_all[$i]->paralelo}}
                                                <span class="badge bg-{{$asignaturas_all[$i]->con_certificados>0 && $asignaturas_all[$i]->con_certificados==$asignaturas_all[$i]->inscritos_con_nota? 'success': 'warning'}} rounded-pill">{{$asignaturas_all[$i]->con_certificados}} , {{$asignaturas_all[$i]->inscritos_con_nota}}</span>
                                            </li>
                                        @endfor
                                        <!-- cerrar todo -->
                                    </ul>
                                </div>
                                <div class="card-footer d-flex justify-content-evenly">
                                    @if($sumaConCertificados!==$sumaConNota && $sumaConNota>0)
                                        <button type="button" class="btn btn-danger waves-effect" 
                                            wire:click="mostrar_form_generar_lote({{$actualPlanAsign}})">GENERAR PDFs</button> <!-- data-bs-toggle="modal" data-bs-target="#agregarCertificadosLote" -->
                                    @endif
                                    @if($sumaConCertificados!==0)
                                    <button type="button"
                                        class="btn btn-primary waves-effect waves-light" wire:click="pdf_lote({{$actualPlanAsign}})">IMPRIMIR PDF</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        
                    </ul>

                @elseif($this->asignatura!=="" && $this->statusAsignatura)
                    @if(count($asignaturas_all)>0)
                        <h2 class="text-center"> {{$asignaturas_all[0]->materia}} </h2>
                        <div class="row column-gap-3 row-gap-3 justify-content-around">
                            @foreach($asignaturas_all as $asign)
                                <div class="col-md-5 border border-2 border-primary rounded">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{$asign->materia}} <br> {{$asign->paralelo}} </h5>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Inscritos
                                                <span class="badge bg-{{$asign->con_certificados>0 && $asign->con_certificados==$asign->inscritos_con_nota? 'success': 'warning'}} rounded-pill">{{$asign->con_certificados}} , {{$asign->inscritos_con_nota}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer d-flex justify-content-evenly">
                                        @if($asign->con_certificados!==$asign->inscritos_con_nota && $asign->inscritos_con_nota>0)
                                            <button type="button" class="btn btn-danger waves-effect" 
                                                wire:click="mostrar_form_generar_lote({{$asign->id_siadi_asignatura}}, {{$asign->id_planificar_asignatura}})"> GENERAR PDFs </button> <!-- data-bs-toggle="modal" data-bs-target="#agregarCertificadosLote" -->
                                        @endif
                                        @if($asign->con_certificados!==0)
                                        <button type="button"
                                            class="btn btn-primary waves-effect waves-light" wire:click="pdf_lote({{$asign->id_planificar_asignatura}}, {{true}})">IMPRIMIR PDF</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif


                <!-- =================== INI MODALES 01 PDF POR LOTES ================= -->
                <div wire:ignore.self id="agregarCertificadosLote" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">CERTIFICADOS POR LOTES
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    wire:click="cancelarGenLote"></button>
                            </div>
                            <div class="modal-body">

                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Codigos:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="nro_disponible_2">Números Disponibles:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-select @error('nro_disponible_2') border-danger @enderror" id="nro_disponible_2" wire:model="nro_disponible_2" wire:change="actualizar_rango_nro_2">
                                                <option value="">Elegir...</option>
                                                @foreach ($numeros_disponibles as $dispon)
                                                    <option value="{{ $dispon }}">{{ $dispon}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4"></div>
                                        @error('nro_disponible_2')
                                            <div class="col-md-8 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <label for="inicial_2" class="form-label">Inicial</label>
                                            <input type="text" class="form-control @error('inicial_2') border-danger @enderror" id="inicial_2" wire:model="inicial_2" value="{{$inicial_2}}" maxlength="1">
                                            @error('inicial_2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @php
                                        $boton_estado = !($errors->has('nro_disponible_2') || $statusNro_2==false);
                                        @endphp
                                        <div class="col-md-4">
                                            <label for="nro_2" class="form-label">Número</label>
                                            
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <span class="input-group-btn input-group-prepend">
                                                    <button class="btn btn-primary bootstrap-touchspin-down" type="button" wire:click="menos" {{$boton_estado? 'enabled': 'disabled'}} >-</button>
                                                </span>
                                                <input type="number" value="{{$nro_2}}" id="nro_2" class="form-control @error('nro_2') border-danger @enderror" wire:model="nro_2" maxlength="4"
                                                    min="{{$nroMin_2}}" max="{{$nroMax_2}}" {{$boton_estado? 'enabled': 'disabled'}} > <!-- actualiza_value_sum -->
                                                <span class="input-group-btn input-group-append">
                                                    <button class="btn btn-primary bootstrap-touchspin-up" type="button" wire:click="mas" {{$boton_estado? 'enabled': 'disabled'}} >+</button>
                                                </span>
                                            </div>
                                            @error('nro_2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            
                                        </div>

                                        <div class="col-md-1">
                                            <label>/</label>
                                            <span class="input-group-text">/</span>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="anio_2" class="form-label">Año</label>
                                            <select id="inputState" class="form-select @error('anio_2') border-danger @enderror" wire:model="anio_2" wire:change="actualiza_anio_2">
                                                <option value="">Elegir...</option>
                                                @foreach ($gestiones as $gestion)
                                                    <option value="{{ $gestion->nombre_gestion }}">{{ $gestion->nombre_gestion}}</option>
                                                @endforeach
                                            </select>
                                            @error('anio_2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-4 mb-6">
                                        <label class="form-label" for="nro_libro_nota">Número de Libro:</label>
                                        <input type="text" class="form-control @error('nro_libro_nota') border-danger @enderror" id="nro_libro_nota" wire:model="nro_libro_nota" value="{{$nro_libro_nota}}">
                                        @error('nro_libro_nota')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    <div class="col-md-8 mb-6">
                                        <label class="form-label" for="fecha_2">Fecha:</label>
                                        <input type="date" class="form-control" id="fecha_2" wire:model="fecha_2" value="{{$fecha_2}}" required pattern="\d{4}-\d{2}-\d{2}">
                                        @error('fecha_2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    @if($nro_2!=='' && !$errors->has('nro_disponible_2') && !$errors->has('nro_2'))
                                        <p><b>Desde:</b> {{$inicial_2}}{{str_pad($nro_2, 4, '0', STR_PAD_LEFT)}}/{{$anio_2}} <br>
                                        <b>Hasta:</b> {{$inicial_2}}{{str_pad(($this->nro_2 + $this->contador_generar_certificados -1), 4, '0', STR_PAD_LEFT)}}/{{$anio_2}}</p> <!-- $sum_nro_dispon_max -->
                                    @endif
                                    @if(count($mis_datos)>0)
                                        <p class="text-center"><b>{{$mis_datos[0]["modalidad"]}}</b></p>
                                        @foreach($mis_datos as $datos)
                                            <span><b>{{$datos["materia"]}} {{$datos["paralelo"]}}: </b> {{$datos["sin_certificados"]==1? "1 nota sin certificado": $datos["sin_certificados"]. " notas sin certificados"}} </span> <br>
                                        @endforeach
                                    @endif
                                    
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                        wire:click="cancelarGenLote">CANCELAR</button>
                                    <button wire:click="guardar_certificados_lote()"
                                        class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                                        
                                </div>
                            </div>
                        </div>
                        
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- =================== FIN MODALES 01 PDF POR LOTES ================= -->


                <!-- =================== INI MODALES 02 IMPRIMIR POR LOTES ================= -->
                <div wire:ignore.self id="imprimirCertificadosLote" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myModalLabel">IMPRIMIR LOTE</h5>
                                <button type="button" class="btn-close" 
                                    wire:click="cancelar_pdf_lote"></button>
                            </div>
                            <div class="modal-body">
                                @if(count($certificado_lote)>0 && $this->operation=='imprimir_pdf_lote')
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h3 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    {{$certificado_lote[0]["materia"] .' '.$certificado_lote[0]["modalidad"]}}
                                                </button>
                                            </h3>
                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionDataAsignatura">
                                                <div class="accordion-body">
                                                    <i class="fs-5 bx bxs-user-check"></i> <b>Estudiantes:</b> {{count($certificado_lote)}} <br>
                                                    <i class="fs-5 bx bxs-time-five"></i> <b>Carga Horaria</b>: {{$certificado_lote[0]["carga_horaria"]}}<br>
                                                    <i class="fs-5 bx bxs-archive"></i> <b>Nro Libro</b>: {{$certificado_lote[0]["nro_folio_nota"]}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row g-3">
                                        <div class="col-md-5 mb-6">
                                            <label class="form-label" for="formato_lote">Formato de Impresión:</label>
                                            <select id="formato_lote" class="form-select @error('formato_lote') border-danger @enderror" wire:model="formato_lote">
                                                <option value="">Seleccione</option>
                                                <option value="formato1">Formato1</option>
                                                <option value="formato2">Formato2</option>
                                                <option value="formato3">Formato3</option>
                                                <option value="formato4">Formato4</option>
                                            </select>
                                            @error('formato_lote')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        <div class="col-md-7 mb-6">
                                            <label class="form-label" for="fecha_lote">Fecha:</label>
                                            <input type="date" class="form-control  @error('fecha_lote') border-danger @enderror" id="fecha_lote" wire:model="fecha_lote" value="{{$fecha_lote}}" required pattern="\d{4}-\d{2}-\d{2}">
                                            @error('fecha_lote')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="cancelar_pdf_lote">CANCELAR</button>
                                @if(count($certificado_lote)>0 && $this->operation=='imprimir_pdf_lote')
                                    <button wire:click="imprimir_pdf_lote"
                                        class="btn btn-primary waves-effect waves-light">IMPRIMIR</button>
                                @endif
                            </div>
                        </div>
                        
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- =================== fin MODALES 02 IMPRIMIR POR LOTES ================= -->

            </div>
        </div>
    </div>
	<!-- --------------- fin contenedor principal ------------ -->

    @push('navi-js')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('closeModalCreateLote', ()=> {
                    $('#agregarCertificadosLote').modal('hide');
                });
                Livewire.on('showModalCreateLote', ()=> {
                    $('#agregarCertificadosLote').modal('show');
                });

                Livewire.on('closeModalImprimir', ()=> {
                    $('#imprimirCertificadosLote').modal('hide');
                });
                Livewire.on('showModalImprimir', ()=> {
                    $('#imprimirCertificadosLote').modal('show');
                });

                Livewire.on('Mostrar', ($cadena)=> {
                    console.log($cadena);
                });

            });
        </script>

    @endpush
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script>
        $('#inicial_2').maxlength({
            alwaysShow: !0, warningClass: "badge bg-danger", limitReachedClass: "badge bg-success"
        });
        $('#nro_2').maxlength({
            alwaysShow: !0, warningClass: "badge bg-success", limitReachedClass: "badge bg-danger"
        });
    </script>

</div>