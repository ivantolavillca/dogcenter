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
<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">CERTIFICADOS PROVISIONALES</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Buscar Certificado Provisional</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="position-relative">
                        <div class="position-absolute top-0 start-0">
                            <div class="col-md-12">
                                <input type="text" class="form-control" wire:model="search"
                                    wire:keydown="clear_filter()" placeholder="Ingrese CI" value="{{ $search }}">
                            </div>
                        </div>
                        @if ($status)
                            <div class="position-absolute top-0 end-0">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" wire:model="filter" placeholder="Filtrar"
                                        value="{{ $filter }}">
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="card-body">
                    <br>
                    @if (count($estudiantes_prov) > 0)
                        <hr>
                        
                        <div class="row g-3">
                            <div class="col-md-11">
                                <i class="bx bxs-user"></i> <b>Nombre completo:</b>
                                {{ $estudiantes_prov[0]->nombres_persona }} <br>
                                <i class="bx bxs-user-detail"></i> <b>Cédula de Identidad:</b> {{ $estudiantes_prov[0]->ci }}
                            </div>
                            {{-- @if(count($certificado_notas)>0)
                                <div class="col-md-12 row">
                                    @foreach ($certificado_notas as $cert_nota)
                                        <a class="col-md-3 m-2 btn btn-outline-danger waves-effect waves-light" href="{{ route('reporte_pdf_certificado_prov_notas', ['id_nota' => $cert_nota->id_nota]) }}" target="_blank">
                                            <i class="bx bxs-file-pdf fs-5"></i> CERTIFICADO NOTAS <br> <b>{{$cert_nota->nombre_idioma}}</b> 
                                        </a>
                                    @endforeach
                                </div>
                            @endif --}}
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>GESTIÓN</th>
                                        <th>MATERIA</th>
                                        <th>TIPO</th>
                                        <th>NOTA FINAL</th>
                                        <th>ESTADO</th>
                                        <th>FECHA CERTIFICADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($estudiantes_prov as $estudiante)
                                        <tr>
                                            <th>{{ $cont++ }}</th>
                                            <td>{{ $estudiante->gestion }}</td>
                                            <td>{{ $estudiante->idioma }}</td>
                                            <td>{{ $estudiante->modalidad }}</td>
                                            <td>{{ $estudiante->final_nota }} {{-- ({{ $estudiante->es_tgn}})  --}}</td>
                                            <td>{{ $estudiante->observacion_nota }}</td>
                                            <td>{{ $estudiante->fecha_siadi_certificado }}</td>
                                            <td>
                                                @if($estudiante->id_convocartoria_estudiante!==3 && $estudiante->id_convocartoria_estudiante!==6 && $estudiante->id_convocartoria_estudiante!==7 && $estudiante->id_convocartoria_estudiante!==8 && $estudiante->final_nota >= 51)
                                                    @if($estudiante->es_tgn=='SI')
                                                        @if(is_null($estudiante->id_certificado_notas) || $estudiante->id_certificado_notas == '')
                                                            @can('certificado_provisional.create')
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    wire:click="abrir_form_create({{ $estudiante->id_inscrip_cert_notas }})" >
                                                                    <i class="bx bxs-file-plus fs-5"></i> <b>Generar Certificado De Notas</b></button>
                                                            @endcan
                                                        @else
                                                            @canany(['certificado_provisional.show', 'certificado_provisional.print'])
                                                                <button type="button"
                                                                    class="btn btn-outline-info d-flex justify-content-center align-self-center"
                                                                    wire:click="mostrar_certificado_provisional({{ $estudiante->id_certificado_notas }})">
                                                                    <b>Imprimir Certificado de Notas PDF</b> <i
                                                                        class="bx bxs-file-pdf fs-3"></i></button>
                                                            @endcanany
                                                        @endif
                                                    @else 
                                                        @if ($estudiante->id_certificado_provisional == '')
                                                            @can('certificado_provisional.create')
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    wire:click="abrir_form_create({{ $estudiante->id_inscripcion }})" >
                                                                    <i class="bx bxs-file-plus fs-5"></i> <b>Generar Certificado Provisional</b></button>
                                                            @endcan
                                                        @else
                                                            @canany(['certificado_provisional.show', 'certificado_provisional.print'])
                                                                <button type="button"
                                                                    class="btn btn-outline-info d-flex justify-content-center align-self-center"
                                                                    wire:click="mostrar_certificado_provisional({{ $estudiante->id_certificado_provisional }})">
                                                                    <!-- data-bs-toggle="modal" data-bs-target="#imprimirCertificado" -->
                                                                    <b>Imprimir Provisional PDF</b> <i
                                                                        class="bx bxs-file-pdf fs-3"></i></button>
                                                            @endcanany
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $estudiantes_prov->links() }}
                            </div>
                        </div>
                    @endif


                    <br><br>

                    <!-- ----------- inicio modales --------------- -->
                    @can('certificado_provisional.create')
                        <!-- ********** inicio modal 01 ********* -->
                        <div wire:ignore.self id="generarCertificadoProvisional" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myModalLabel">GENERAR CERTIFICADO PROVISIONAL
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                            wire:click="cancelar"></button>
                                    </div>
                                    <div class="modal-body ">
                                        @if (!is_null($datos_certificado_gen))
                                            <div class="col-md-12">
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Códigos:</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="nro_disponible_prov">Números Disponibles:</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select
                                                            class="form-select @error('nro_disponible_prov') border-danger @enderror"
                                                            id="nro_disponible_prov" wire:model="nro_disponible_prov" wire:change="actualizaNroDisponibleProv">
                                                            <option value="">Elegir...</option>
                                                            @foreach ($numeros_disponibles as $dispon)
                                                                <option value="{{ $dispon }}">{{ $dispon }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8 text-danger"> @error('nro_disponible_prov')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row g-3">
                                                    <div class="col-md-2">
                                                        <label for="inicial_prov" class="form-label">Inicial</label>
                                                        <input type="text"
                                                            class="form-control @error('inicial_prov') border-danger @enderror"
                                                            id="inicial_prov" wire:model="inicial_prov"
                                                            value="{{ $inicial_prov }}" maxlength="1">
                                                        @error('inicial_prov')
                                                            <div class="error">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label>-</label>
                                                        <label class="form-control">-</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="nro_prov" class="form-label ">Número</label>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend">
                                                                <button class="btn btn-primary bootstrap-touchspin-down" type="button" wire:click="menos_nro_prov" {{$boton_estado? 'enabled': 'disabled'}} >-</button>
                                                            </span>
                                                            <input type="number"
                                                                class="form-control @error('nro_prov') border-danger @enderror"
                                                                id="nro_prov" wire:model="nro_prov" value="{{ $nro_prov }}" {{-- actualizaNroProv --}}
                                                                    {{$boton_estado? 'enabled': 'disabled'}}
                                                                min="{{ $nroMin }}" max="{{ $nroMax }}">
                                                            <span class="input-group-btn input-group-append">
                                                                <button class="btn btn-primary bootstrap-touchspin-up" type="button" wire:click="mas_nro_prov" {{$boton_estado? 'enabled': 'disabled'}} >+</button>
                                                            </span>
                                                        </div>
                                                        
                                                        @error('nro_prov')
                                                            <span class="text-danger fs-6">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label>/</label>
                                                        <span class="input-group-text">/</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="anio_prov" class="form-label">Año</label>
                                                        <select id="inputState"
                                                            class="form-select  @error('anio_prov') border-danger @enderror"
                                                            wire:model="anio_prov" wire:change="actualizaAnioProv"> 
                                                            <option value="">Elegir...</option>
                                                            @foreach ($gestiones as $gestion)
                                                                <option value="{{ $gestion->nombre_gestion }}">
                                                                    {{ $gestion->nombre_gestion }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('anio_prov')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <br>
                                            <div class="acordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header bg-soft-danger p-1 rounded-1">
                                                        <button class="accordion-button" type="button"
                                                            id="btn-collapseOne" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            <b>DATOS </b>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <!-- show -->
                                                        <div class="accordion-body">
                                                            @php $datos_tmp = json_decode($datos_certificado_gen, false); @endphp
                                                            <span><i class="bx bxs-user-detail"></i> <b>CI:</b>
                                                                {{ $datos_tmp->ci }} </span> <br>
                                                            <span><i
                                                                    class="{{ $datos_tmp->genero_persona == 'F' ? 'bx bx-female' : 'bx bx-male' }}"></i>
                                                                <b>Nombre:</b> </span> {{ $datos_tmp->nombres_persona }}
                                                            <br>
                                                            <span><i class="bx bxs-book"></i> <b>Idioma:</b>
                                                                {{ $datos_tmp->idioma }} </span> <br>
                                                            <span><i class="bx bxs-bookmark"></i> <b>Modalidad:</b>
                                                                {{ $datos_tmp->modalidad }} </span> <br>
                                                            <span><i class="bx bxs-calendar-check"> </i> <b>Gestion:</b>
                                                                {{ $datos_tmp->periodo_gestion }}</span> <br>
                                                            <span><i class="bx bxs-time"></i><b>Carga Horaria:</b>
                                                                {{ $datos_tmp->carga_horaria }}</span>
                                                            
                                                            {{-- <div class="bg-primary text-white">
                                                                {{$this->datos_certificado_gen}}
                                                            </div> --}}
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-danger waves-effect"
                                                    data-bs-dismiss="modal" wire:click="cancelar"><i
                                                        class="bx bx-window-close"></i> CANCELAR</button>
                                                <button wire:click="guardar_certificado_provisional"
                                                    class="btn btn-primary waves-effect waves-light"> <i
                                                        class="bx bxs-save"></i> GUARDAR DATOS</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                    @endcan
                    <!-- ************ fin modal 01 ********** -->
                

                    <!-- ************ inicio modal 02 **************** -->
                    @canany(['certificado_provisional.show', 'certificado_provisional.print'])
                        <div wire:ignore.self id="imprimirCertificadoProvisional" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myModalLabel">IMPRIMIR CERTIFICADO 
                                            @if(!is_null($dataImpresion))
                                                {{ $dataImpresion['es_tgn']=="SI"? "DE NOTAS": "PROVISIONAL" }}
                                            @endif
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                            wire:click="cancelar_impresion"></button>
                                    </div>
                                    @if(!is_null($dataImpresion))
                                        <div class="modal-body">
                                            <div class="acordion" id="accordionPrintCertificado">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header bg-soft-info p-1 rounded-1">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-target="#collapseTwo" data-bs-toggle="collapse"
                                                            aria-expanded="true" aria-controls="collapseTwo">
                                                            <b>DATOS CERTIFICADO </b> <i class="bx bxs-down-arrow"></i>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionPrintCertificado"> <!-- show -->
                                                        <div class="accordion-body">
                                                            <i class="bx bxs-lock-alt"></i> <span><b>Codigo</b>
                                                                {{ $dataImpresion['codigo_certificado_provisional'] }}</span> <br>
                                                            <i class="bx bxs-user-detail"></i> <span><b>CI:</b>
                                                                {{ $dataImpresion['ci'] }}</span> <br>
                                                            <i class="bx bxs-user"></i> <span><b>Nombre:</b>
                                                                {{ $dataImpresion['nombres_persona'] }}</span> <br>
                                                            <i class="bx bxs-book"></i> <span><b>Idioma:</b>
                                                                {{ $dataImpresion['idioma'] }}</span> <br>
                                                            <i class="bx bxs-bookmark"></i> <span><b>Modalidad:</b>
                                                                {{ $dataImpresion['modalidad'] }}</span> <br>
                                                            <i class="bx bxs-time-five"></i> <span><b>Carga Horaria</b>
                                                                {{ $dataImpresion['carga_horaria'] }}</span> <br>
                                                            <i class="bx bxs-calendar-check"></i><span><b>Gestion:</b>
                                                                {{ $dataImpresion['periodo_gestion'] }}</span> <br>
                                                            <i class="bx bxs-book-content"></i> <span><b>Nota Final:</b>
                                                                {{ $dataImpresion['final_nota'] }}</span> <br>
                                                            <i class="bx bxs-archive"></i><span><b>Nro Folio:</b>
                                                                {{ $dataImpresion['nro_folio_nota'] }}</span> <br>
                                                            <i class="bx bx-book"></i> <span><b>Materia:</b>
                                                                {{ $dataImpresion['materia'] }}</span> 
                                                            {{-- {{json_encode($dataImpresion)}} --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <hr>
                                            @can('certificado_provisional.print')
                                                <div class="col-md-12">
                                                    {{-- <div class="row g-3">
                                                        <div class="col-md-5">
                                                            <label class="form-label" for="codigo_migra">Código migración:</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-label @error('codigo_migra') border-danger @enderror" id="codigo_migra"
                                                                wire:model="codigo_migra" />
                                                            @error('codigo_migra')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}

                                                    <div class="row g-3">
                                                        <div class="col-md-5">
                                                            <label class="form-label" for="fechaImpresion">Fecha de Impresión </label>
                                                        </div>
                                                        <div class="col-md-5">
                                                    
                                                            <input type="date"
                                                                class="form-control @error('fechaImpresion') border-danger @enderror"
                                                                id="fechaImpresion" wire:model="fechaImpresion"
                                                                value="{{ $fechaImpresion }}" required pattern="\d{4}-\d{2}-\d{2}">
                                                            @error('fechaImpresion')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            @endcan

                                        </div>
                                    @endif

                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                            wire:click="cancelar_impresion">CANCELAR</button>
                                        @if(!is_null($dataImpresion))
                                        @can('certificado_provisional.print')
                                            <button wire:click="imprimir"
                                                class="btn btn-primary waves-effect waves-light">IMPRIMIR</button>
                                        @endcan
                                        @endif
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                    @endcanany
                    <!-- ************* fin modal 02 ****************** -->

                    <!-- ------------ fin modales ---------------- -->

                </div>
            </div>
        </div>
    </div>
</div>


@push('navi-js')

    <script>
        document.addEventListener('livewire:load', function() {

            Livewire.on('showModalCreateCertProv', () => {
                $('#generarCertificadoProvisional').modal('show');
            });
            Livewire.on('closeModalCreateCertProv', () => {
                $('#generarCertificadoProvisional').modal('hide');
            });

            Livewire.on('showLoaderAgregarCerticados', () => {
                $('#loaderAgregarCertificados').removeClass('d-none');
            });
            Livewire.on('hideLoaderAgregarCerticados', () => {
                $('#loaderAgregarCertificados').addClass('d-none');
            });


            Livewire.on('showModalImprimirCertificadoProv', () => {
                $('#imprimirCertificadoProvisional').modal('show');
            });
            Livewire.on('closeModalImprimirCertificadoProv', () => {
                $('#imprimirCertificadoProvisional').modal('hide');
            });

            Livewire.on('Mostrar', ($cadena) => {
                console.log($cadena);
            });

            Livewire.on('abrirNuevaPestania', (url) => {
                window.open(url, '_blank');
            });

        });
    </script>

    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script>
        $('#inicial_prov').maxlength({
            alwaysShow: !0,
            warningClass: "badge bg-danger",
            limitReachedClass: "badge bg-success"
        });
    </script>
@endpush

