<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">TESORERIA</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Tesoreria</li>
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



                    @if (!empty($this->search) && $personasInscritas->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            NOMBRE ESTUDIANTE
                                        </th>
                                        <th>
                                            TIPO ESTIANTE
                                        </th>

                                        <th>
                                            MATERIAS INSCRITAS
                                        </th>
                                        <th>
                                            ACCIÓNES
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($personasInscritas as $inscripcion)
                                        <tr>

                                            <th>
                                                @php
                                                    echo $cont;
                                                    $cont++;
                                                @endphp
                                            </th>


                                            <td>
                                                {{ $inscripcion->nombres_persona }}
                                                {{ $inscripcion->paterno_persona }}
                                                {{ $inscripcion->materno_persona }}

                                            </td>
                                            <td>
                                                {{ $inscripcion->ci_persona }}
                                            </td>
                                            <td>
                                                {{ $inscripcion->tipo_estudiante->nombre_tipo_estudiante }}
                                            </td>

                                            <td>





                                            </td>
                                            <td>


                                                <button type="button"
                                                    class="btn btn-outline-primary waves-effect waves-light"
                                                    wire:click="inscribir({{ $inscripcion->id_siadi_persona }})">
                                                    VERIFICAR TIPO DE PAGO
                                                </button>



                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @else
                        <div class="px-5 py-3 border-gray-200  text-sm">
                            <strong>Nota. Debe realizar la busqueda por la Cedúla de Identidad del Estudiante</strong>
                        </div>
                    @endif
                </div>
                <div wire:ignore.self id="modalinscrip" class="modal fade" tabindex="-1" role="dialog"
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

                                    <br>
                                    <div class="col-md-12">
                                        <div class="mb-12">
                                            <div class="row">
                                                <div class="text-center">
                                                    <h4> REVISÍON DE PREINSCRIPCIONES</h4>
                                                </div>





                                            </div>
                                            <center>.::ASIGNATURAS PRE-INSCRITAS::. </center>
                                            @if ($personaunica)
                                                {{ $personaunica->ci_persona }}
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>IDIOMA</th>
                                                                <th>ASIGNATURA</th>
                                                                <th>N° DE DEPOSITO</th>
                                                                <th>FECHA DE DEPOSITO</th>
                                                                <th>MONTO DE DEPOSITO</th>
                                                                <th>OBSERVACIÓN</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                            @foreach ($MateriasPreinscritas as $inscp)
                                                                <tr>
                                                                    <td>
                                                                        {{ $inscp->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $inscp->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                                        {{ $inscp->planificar_asignatura->siadi_paralelo->nombre_paralelo }}
                                                                        {{ $inscp->planificar_asignatura->turno_paralelo }}

                                                                    </td>
                                                                    <td>
                                                                        {{ $inscp->nro_deposito }}
                                                                    
                                                                    </td>
                                                                     <td>
                                                                        {{ $inscp->fecha_inscripcion }}
                                                                    
                                                                    </td>
                                                                    <td>
                                                                        {{ $inscp->monto_deposito }} Bs.
                                                                    
                                                                    </td>
                                                                   
                                                                    <td>
                                                                        @if ($inscp->observacion_inscripcion == 'SIN OBSERVACION')
                                                                            <button class="btn btn-info"
                                                                                wire:click="observar({{ $inscp->id_pre_inscripcion }})">OBSERVAR
                                                                                PREINSCRIPCIÓN</button>
                                                                        @elseif ($inscp->observacion_inscripcion == 'OBSERVADO')
                                                                            <button class="btn btn-success"
                                                                                wire:click="quitarobservacion({{ $inscp->id_pre_inscripcion }})">QUITAR
                                                                                OBSERVACION</button>
                                                                        @elseif ($inscp->observacion_inscripcion == 'INSCRITO')
                                                                            MATERIA INSCRITA
                                                                        @endif


                                                                    </td>

                                                                </tr>
                                                            @endforeach


                                                        </tbody>

                                                    </table>

                                                </div>

                                                <br>


                                            @endif




                                        </div>


                                    </div>



                                </div>





                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect"
                                    data-bs-dismiss="modal">SALIR</button>

                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>



                {{-- <div class="row">
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
                                    placeholder="Buscar...">

                            </div>



                        </div>


                    </div>

                    <br>



                    @if ($personasInscritas->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            NOMBRE ESTUDIANTE
                                        </th>
                                        <th>
                                            TIPO ESTIANTE
                                        </th>

                                        <th>
                                            MATERIAS INSCRITAS
                                        </th>
                                        <th>
                                            ACCIÓNES
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($personasInscritas as $inscripcion)
                                        <tr>

                                            <th>
                                                @php
                                                    echo $cont;
                                                    $cont++;
                                                @endphp
                                            </th>


                                            <td>
                                                {{ $inscripcion->nombres_persona }}
                                                {{ $inscripcion->paterno_persona }}
                                                {{ $inscripcion->materno_persona }}

                                            </td>
                                            <td>
                                                {{ $inscripcion->ci_persona }}
                                            </td>
                                            <td>
                                                {{ $inscripcion->tipo_estudiante->nombre_tipo_estudiante }}
                                            </td>

                                            <td>





                                            </td>
                                            <td>


                                                <button type="button"
                                                    class="btn btn-outline-primary waves-effect waves-light"
                                                    wire:click="inscribir({{ $inscripcion->id_siadi_persona }})">
                                                    EDITAR - INSCRIBIR
                                                </button>



                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">

                            {{ $personasInscritas->links() }}
                        </div>
                    @else
                        <div class="px-5 py-3 border-gray-200  text-sm">
                            <strong>No hay Registros</strong>
                        </div>
                    @endif
                </div>
                <div wire:ignore.self id="modalinscrip" class="modal fade" tabindex="-1" role="dialog"
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

                                            <center>.::ASIGNATURAS INSCRITAS::. </center>
                                            @if ($personaunica)
                                                {{ $personaunica->ci_persona }}
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>materia</th>
                                                                <th>asignatura</th>
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
                                                                    <td>

                                                                        <button class="btn btn-danger"
                                                                            x-on:click="mostrarEdicion = true"
                                                                            wire:click="editarasig({{ $inscp->id_inscripcion }})">Editar</button>
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">PERSONA</label>
                                                            askhkshdkadhak
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">ASIGNATURA{{ $asignaturaid }}
                                                                {{ $asignaturaGuardar }}</label>
                                                            <select class="form-select" wire:model="asignaturaGuardar">

                                                                @foreach ($asignaturas_validas as $asinaturasval)
                                                                    <option
                                                                        value="{{ $asinaturasval->id_planificar_asignatura }}">
                                                                        {{ $asinaturasval->siadi_asignatura->idioma->nombre_idioma }}
                                                                        {{ $asinaturasval->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                                        PARALELO:
                                                                        {{ $asinaturasval->siadi_paralelo->nombre_paralelo }}
                                                                        {{ $asinaturasval->turno_paralelo }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="text-center">
                                                        <button class="btn btn-success"
                                                            wire:click="guardareditarinscripcion"
                                                            x-on:click="mostrarEdicion = false"> GUARDAR</button>
                                                        <button class="btn btn-danger"
                                                            x-on:click="mostrarEdicion = false"> CANCELAR</button>
                                                    </div>

                                                </div>
                                                <br>
                                                <br>
                                                <br>

                                            @endif
                                            <center>.::ASIGNATURAS PREINSCRINCRITAS::. </center>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>IDIOMA</th>
                                                            <th>NIVEL</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach ($materiaAtomar as $nivel)
                                                        <tr>
                                                            <td>{{ $nivel[0]->siadi_asignatura->idioma->nombre_idioma }}
                                                            </td>
                                                            <td>
                                                                <select class="form-select"
                                                                    wire:model="materiasSeleccionadas.{{ $nivel[0]->siadi_asignatura->idioma->nombre_idioma }}">
                                                                    <option selected value="">Elegir...</option>
                                                                    @foreach ($nivel as $materia)
                                                                        <option
                                                                            value="{{ $materia->id_planificar_asignatura }}">
                                                                            {{ $materia->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                                            {{ $materia->siadi_paralelo->nombre_paralelo }}
                                                                            {{ $materia->turno_paralelo }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>

                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                                @error('materiasSeleccionadas')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror @error('idpersona')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @error('tipo_pago')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @error('numero_folio')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @error('numero_carpeta')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <div class="text-center">
                                                    <label for="" class="form-label"> TIPO DE PAGO</label>
                                                    <select name="" id="" class="form-select"
                                                        wire:model="tipo_pago">
                                                        <option value="">Elegir...</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Depósito">Depósito</option>
                                                    </select>

                                                    <label for="" class="form-label">NRO FOLIO</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="numero_folio">
                                                    <label for="" class="form-label">NRO CARPETA</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="numero_carpeta">
                                                </div>
                                            </div>

                                        </div>


                                    </div>



                                </div>





                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="cancelar">CANCELAR</button>
                                <button wire:click="guardarinscripcionnuevo"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR
                                    DATOS</button>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div> --}}

            </div>
            @push('navi-js')
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
            @endpush
