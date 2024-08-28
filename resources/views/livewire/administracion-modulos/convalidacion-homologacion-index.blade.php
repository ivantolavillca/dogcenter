<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">CONVALIDACIÓN - HOMOLOGACIÓN</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Convalidación Homologación</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <br>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input type="text" class="form-control col-md-6" wire:model="search"
                                    placeholder="Buscador por C.I.:">
                            </div>
                        </div>
                    </div>
                    <br>
                    {{-- <pre>
                        {{ print_r($materias) }}
                    </pre> --}}
                    @if (count($lista) > 0)
                        <div class="row">
                            {{-- <div id="preloader-ch mb-5">
                                <div id="status">
                                    <div class="spinner-chase">
                                        <div class="chase-dot"></div>
                                        <div class="chase-dot"></div>
                                        <div class="chase-dot"></div>
                                        <div class="chase-dot"></div>
                                        <div class="chase-dot"></div>
                                        <div class="chase-dot"></div>
                                    </div>
                                </div>
                            </div> --}}
                            @foreach ($materias as $materia)
                                <div class="col-6 card border border-dark px-4 py-3">
                                    <h3 class="text-center"><b>.:: {{ $materia['nombre'] }} ::.</b></h3>
                                    <p class="my-0">
                                        <b>CI: </b>{{ $materia['ci'] }} {{ $materia['expedido'] }}
                                    </p>
                                    <p class="my-0">
                                        <b>Nombres:</b>
                                        {{ $materia['paterno'] }}
                                        {{ $materia['materno'] }}
                                        {{ $materia['nombres'] }}
                                    </p>
                                    <hr>
                                    <h4 class="mt-0 mb-3 text-center fw-bold">
                                        - NIVELES -
                                    </h4>
                                    <div class="row">
                                        <p class="my-0 col-4">
                                            <b>Basico: </b>
                                        </p>
                                        <p class="col-6">
                                            <b>Nivel 1.1
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ $materia['1.1'] != 0 ? $materia['1.1'] . ' pts' : 'No se presentó' }}
                                            <br>
                                            <b>Nivel 1.2
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ $materia['1.2'] != 0 ? $materia['1.2'] . ' pts' : 'No se presentó' }}
                                            <br>
                                            <b>Promedio
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ ($materia['1.1'] + $materia['1.2']) / 2 . ' pts' }}
                                            <br>
                                            <b>Detalle
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>
                                            @if ($materia['1.1'] == 0 && $materia['1.2'] == 0)
                                                <span class="badge bg-info">No se presentó</span>
                                            @else
                                                <span
                                                    class="badge bg-{{ ($materia['1.1'] + $materia['1.2']) / 2 > 50 ? 'success' : 'danger' }}">{{ ($materia['1.1'] + $materia['1.2']) / 2 > 50 ? 'Aprobado' : 'Reprobado' }}</span>
                                            @endif
                                        </p>
                                        <!-- <p class="col-md-2 col-mb-2">
                                            <small class="d-block badge mb-2 bg-success" ></small>
                                            <small class="d-block badge bg-success">kkHomologado</small>
                                        </p> -->

                                        <p class="my-0 col-4">
                                            <b>Intermedio: </b>
                                        </p>
                                        <p class="col-6">
                                            <b>Nivel 2.1
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ $materia['2.1'] != 0 ? $materia['2.1'] . ' pts' : 'No se presentó' }}
                                            <br>
                                            <b>Nivel 2.2
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ $materia['2.2'] != 0 ? $materia['2.2'] . ' pts' : 'No se presentó' }}
                                            <br>
                                            <b>Promedio
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ ($materia['2.1'] + $materia['2.2']) / 2 . ' pts' }}
                                            <br>
                                            <b>Detalle
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>
                                            @if ($materia['2.1'] == 0 && $materia['2.2'] == 0)
                                                <span class="badge bg-info">No se presentó</span>
                                            @else
                                                <span
                                                    class="badge bg-{{ ($materia['2.1'] + $materia['2.2']) / 2 > 50 ? 'success' : 'danger' }}">{{ ($materia['2.1'] + $materia['2.2']) / 2 > 50 ? 'Aprobado' : 'Reprobado' }}</span>
                                            @endif
                                        </p>


                                        <p class="my-0 col-4">
                                            <b>Superior: </b>
                                        </p>
                                        <p class="col-8">
                                            <b>Nivel 3.1
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ $materia['3.1'] != 0 ? $materia['3.1'] . ' pts' : 'No se presentó' }}
                                            <br>
                                            <b>Nivel 3.2
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ $materia['3.2'] != 0 ? $materia['3.2'] . ' pts' : 'No se presentó' }}
                                            <br>
                                            <b>Promedio
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>{{ ($materia['3.1'] + $materia['3.2']) / 2 . ' pts' }}
                                            <br>
                                            <b>Detalle
                                                <i class="mdi mdi-arrow-right"></i>
                                            </b>
                                            @if ($materia['3.1'] == 0 && $materia['3.2'] == 0)
                                                <span class="badge bg-info">No se presentó</span>
                                            @else
                                                <span
                                                    class="badge bg-{{ ($materia['3.1'] + $materia['3.2']) / 2 > 50 ? 'success' : 'danger' }}">{{ ($materia['3.1'] + $materia['3.2']) / 2 > 50 ? 'Aprobado' : 'Reprobado' }}</span>
                                            @endif
                                        </p>
                                        <p>
                                            <button class="btn btn-warning"
                                                wire:click="verificarConvalidacion({{ json_encode($materia) }})">Verificar
                                                convalidacion</button>
                                            <button class="btn btn-success"
                                                wire:click="verificarHomologacion({{ json_encode($materia) }})">Verificar
                                                homologacion</button>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center">No hay registros</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self id="convalidarEstudiante" class="modal fade modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">CONVALIDAR ESTUDIANTE .:: NIVEL {{ $titulo_nivel }}
                        IDIOMA {{ $titulo_idioma }} ::.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Asignaturas disponibles para convalidación:</label>
                                <select wire:model="id_planificar_asignatura" class="form-select @error('id_planificar_asignatura') border-danger @enderror"
                                    wire:change="getCosto">
                                    <option value="">Elegir...</option>
                                    @foreach ($asignaturas_conv as $asignatura)
                                        @if ($asignatura->descripcion_nivel_idioma == $titulo_nivel && $asignatura->nombre_idioma == $titulo_idioma)
                                            <option value="{{ $asignatura->id_planificar_asignatura }}">
                                                {{ $asignatura->nombre_idioma }} - Nivel
                                                {{ $asignatura->nombre_nivel_idioma }}
                                                ({{ $asignatura->descripcion_nivel_idioma }})
                                                ::
                                                {{ $asignatura->nombre_convocatoria }} {{--  --}}
                                                .::
                                                {{ $asignatura->periodo_gestion }}
                                                .:: 
                                                {{$asignatura->nombre_convocatoria_estudiante}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_planificar_asignatura')
                                    <span class="text-danger">{{ $message }}</span> <br>
                                @enderror
                                <span class="text-info">asignatura .:: nombre convocatoria .:: gestión .:: modalidad convocatoria</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">TIPO DE PAGO:</label>
                                <select wire:model="tipo_pago_inscripcion" class="form-select @error('tipo_pago_inscripcion') border-danger @enderror">
                                    <option value="">Elegir...</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Depósito">Depósito</option>
                                </select>
                                @error('tipo_pago_inscripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">FECHA DE INSCRIPCIÓN:</label>
                                <input type="date" wire:model="fecha_inscripcion" class="form-control @error('fecha_inscripcion') border-danger @enderror">
                                @error('fecha_inscripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">MONTO DE DEPÓSITO:</label>
                                <input type="text" wire:model="monto_deposito" class="form-control @error('monto_deposito') border-danger @enderror">
                                @error('monto_deposito')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($tipo_pago_inscripcion == 'Depósito')
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NÚMERO DE DEPÓSITO:</label>
                                    <input type="text" wire:model="nro_deposito" class="form-control @error('nro_deposito') border-danger @enderror">
                                    @error('nro_deposito')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <b class="text-center">
                                DETALLES DE LA NOTA
                            </b>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nota promedio nivel {{ $titulo_nivel }}:</label>
                                <input type="text" wire:model="promedio" class="form-control" readonly>
                                </select>
                                @error('promedio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nro. Folio:</label>
                                <input type="text" wire:model="nro_folio_nota" class="form-control @error('nro_folio_nota') border-danger @enderror">
                                </select>
                                @error('nro_folio_nota')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nro. Carpeta:</label>
                                <input type="text" wire:model="nro_carpeta_nota" class="form-control @error('nro_carpeta_nota') border-danger @enderror">
                                </select>
                                @error('nro_carpeta_nota')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="cancelar">CANCELAR</button>
                    <button wire:click="convalidarEstudianteAsignatura"
                        class="btn btn-success waves-effect waves-light">CONVALIDAR</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <div wire:ignore.self id="homologarEstudiante" class="modal fade modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">HOMOLOGAR ESTUDIANTE .:: NIVEL {{ $titulo_nivel }}
                        IDIOMA {{ $titulo_idioma }} ::.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Asignaturas disponibles para homologacion:</label>
                                <select wire:model="id_planificar_asignatura" class="form-select"
                                    wire:change="getCosto">
                                    <option>Elegir...</option>
                                    @foreach ($asignaturas_hom as $asignatura)
                                        @if ($asignatura->descripcion_nivel_idioma == $titulo_nivel && $asignatura->nombre_idioma == $titulo_idioma)
                                            <option value="{{ $asignatura->id_planificar_asignatura }}">
                                                {{ $asignatura->nombre_idioma }} - Nivel
                                                {{ $asignatura->nombre_nivel_idioma }}
                                                ({{ $asignatura->descripcion_nivel_idioma }})
                                                ::
                                                {{ $asignatura->nombre_convocatoria }}
                                                ({{ $asignatura->nombre_convocatoria_estudiante }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_planificar_asignatura')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo de Pago:</label>
                                <select wire:model="tipo_pago_inscripcion" class="form-select">
                                    <option>Elegir...</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Depósito">Depósito</option>
                                </select>
                                @error('tipo_pago_inscripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fecha de la Inscripcion:</label>
                                <input type="date" wire:model="fecha_inscripcion" class="form-control">
                                </select>
                                @error('fecha_inscripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Monto de Deposito:</label>
                                <input type="text" wire:model="monto_deposito" class="form-control">
                                </select>
                                @error('monto_deposito')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($tipo_pago_inscripcion == 'Depósito')
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Numero del deposito:</label>
                                    <input type="text" wire:model="nro_deposito" class="form-control">
                                    </select>
                                    @error('nro_deposito')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <b class="text-center">
                                DETALLES DE LA NOTA
                            </b>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nota promedio nivel {{ $titulo_nivel }}:</label>
                                <input type="text" wire:model="promedio" class="form-control" readonly>
                                </select>
                                @error('promedio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nro. Folio:</label>
                                <input type="text" wire:model="nro_folio_nota" class="form-control">
                                </select>
                                @error('nro_folio_nota')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nro. Carpeta:</label>
                                <input type="text" wire:model="nro_carpeta_nota" class="form-control">
                                </select>
                                @error('nro_carpeta_nota')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="cancelar">CANCELAR</button>
                    <button wire:click="homologarEstudianteAsignatura"
                        class="btn btn-success waves-effect waves-light">CONVALIDAR</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>


{{-- @push('navi-js')
    <script>
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
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirmodalinscpp', function() {
                $('#modalinscrip').modal('show');
            });
        });
    </script>
@endpush --}}

@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('closeModalConvalidacion', function() {
                $('#convalidarEstudiante').modal('hide');
            });
        });
    </script>
@endpush
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('closeModalHomologacion', function() {
                $('#homologarEstudiante').modal('hide');
            });
        });
    </script>
@endpush
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openModalConvalidacion', function() {
                $('#convalidarEstudiante').modal('show');
            });
        });
    </script>
@endpush
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openModalHomologacion', function() {
                $('#homologarEstudiante').modal('show');
            });
        });
    </script>
@endpush
