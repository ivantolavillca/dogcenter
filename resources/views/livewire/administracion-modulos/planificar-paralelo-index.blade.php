<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ASIGNACION DE DOCENTE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Asignacion</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" x-data="{ open: false }" x-init="$wire.on('cerrarFragmento', () => {
                    open = false;
                })">
                    <div class="mb-3 row">

                        <div x-show="open">
                            <center>
                                <h3>.:: BUSCAR DOCENTE::. </h3>

                            </center>
                            <br>
                            <center>
                                <h3>.:: {{ $asignatura }}::. </h3>

                            </center>


                            <br>
                            <label for="" class="form-label"> </label>
                            <input type="text" class="form-control" placeholder="Ingrese el CI del Docente..."
                                wire:model="cidocente">

                            @error('buscarextraviado')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if ($nombre_docente)
                                <br>
                                <center>
                                    <h4>{{ $nombre_docente }}</h4>
                                </center>
                            @endif
                            <br>
                            <center>
                                <button x-on:click="open = false" wire:click="cancelar_asignacion"
                                    class="btn btn-danger">CANCELAR</button>
                                <button wire:click="guardar_asignacion" class="btn btn-success">ASIGNAR</button>
                            </center>

                            <br>
                            <center>
                                ----------------------------------------------------------------------------------------------------------------------------------
                            </center>
                            <br>
                            <br>
                        </div>

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

                    @if ($planificar_asignaturas->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead>
                                    <tr>

                                        <th>
                                            N°
                                        </th>

                                        <th>
                                            GESTIÓN
                                        </th>
                                      
                                        <th>
                                            NOMBRE ASIGNATURA
                                        </th>
                                        <th>
                                            PARALELO
                                        </th>
                                        <th>
                                            NOMBRE CONVOCATORIA
                                        </th>
                                        <th>
                                            NOMBRE DOCENTE
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
                                    @foreach ($planificar_asignaturas as $planificar_asignatura)
                                        <tr>

                                            <th>
                                                @php
                                                    echo $cont;
                                                    $cont++;
                                                @endphp
                                            </th>
<td>
        {{ $planificar_asignatura->siadi_convocatoria->gestion->nombre_gestion }}  -  {{ $planificar_asignatura->siadi_convocatoria->periodo }}
</td>
                                            <td>
                                                {{ $planificar_asignatura->siadi_asignatura->sigla_asignatura }}
                                            </td>
                                            <td>

                                                {{ $planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                {{ $planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                {{ $planificar_asignatura->siadi_paralelo->nombre_paralelo }}
                                                {{ $planificar_asignatura->turno_paralelo }}
                                            </td>
                                            <td>
                                                {{ $planificar_asignatura->siadi_convocatoria->nombre_convocatoria }}
                                            </td>
                                            <td>
                                                @if (is_null($planificar_asignatura->id_asignacion_docente))
                                                    DOCENTE NO ASIGNADO
                                                @else
                                                    {{ $planificar_asignatura->siadi_persona_asignada_docente->nombre }}
                                                    {{ $planificar_asignatura->siadi_persona_asignada_docente->paterno }}
                                                    {{ $planificar_asignatura->siadi_persona_asignada_docente->materno }}
                                                @endif

                                            </td>



                                            <td>


                                                <button type="button"
                                                    class="btn btn-outline-warning waves-effect waves-light"
                                                    title="ASIGNAR DOCENTE A ASIGNATURA"
                                                    wire:click="asignar_docente({{ $planificar_asignatura->id_planificar_asignatura }})"
                                                    x-on:click="open = true">
                                                    ASIGNAR DICENTE
                                                    <i class="fas fa-user-cog"></i>
                                                </button>

                                                @if ($planificar_asignatura->estado_docente==1)
                                                    <button class="btn btn-info" title=" DESACTIVAR NOTAS" wire:click="notasdocente({{ $planificar_asignatura->id_planificar_asignatura }})">DESACTIVAR EDICIÓN DE NOTAS</button>
                                                @else
                                                     <button class="btn btn-info"title=" ACTIVAR NOTAS" wire:click="notasdocente({{ $planificar_asignatura->id_planificar_asignatura }})">ACTIVAR EDICIÓN DE NOTAS</button>
                                                @endif



                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
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


            {{-- 
            <div wire:ignore.self data-bs-backdrop="static" id="editar_plan_paralelo" class="modal fade" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">EDITAR PLANIFICACAR PARALELO

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelarEditar"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">ASIGNATURA:</label>
                                    <select class="form-control" wire:model="id_planificar_asignatura">
                                        <option>Elegir...</option>
                                        @foreach ($planificar_asignaturas as $plan)
                                            <option value="{{ $plan->id_planificar_asignatura }}">
                                                {{ $plan->nombre_idioma }}
                                                {{ $plan->nombre_nivel_idioma }}&nbsp;&nbsp;::&nbsp;&nbsp;
                                                {{ $plan->nombre_planificar_asignatura }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_planificar_asignatura')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">PARALELO:</label>
                                    <select class="form-control" wire:model="id_paralelo">
                                        <option>Elegir...</option>
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
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">TURNO:</label>
                                    <select class="form-control" wire:model="turno">
                                        <option>Elegir...</option>
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                    @error('turno')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label">CUPO MINIMO:</label>
                                    <input type="text" class="form-control" wire:model="cupo_minimo">
                                    @error('cupo_minimo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label">CUPO MAXIMO::</label>
                                    <input type="text" class="form-control" wire:model="cupo_maximo">
                                    @error('cupo_maximo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>




                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelarEditar">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardarEditadoidioma">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>




            <div wire:ignore.self id="agregar_planParalelo" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR PARALELO
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelar"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">ASIGNATURA:</label>
                                    <select class="form-control" wire:model="id_planificar_asignatura">
                                        <option>Elegir...</option>
                                        @foreach ($planificar_asignaturas as $plan)
                                            <option value="{{ $plan->id_planificar_asignatura }}">
                                                {{ $plan->nombre_idioma }}
                                                {{ $plan->nombre_nivel_idioma }}&nbsp;&nbsp;::&nbsp;&nbsp;
                                                {{ $plan->nombre_planificar_asignatura }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_planificar_asignatura')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">PARALELO:</label>
                                    <select class="form-control" wire:model="id_paralelo">
                                        <option>Elegir...</option>
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
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">TURNO:</label>
                                    <select class="form-control" wire:model="turno">
                                        <option>Elegir...</option>
                                        <option value="Mañana">Mañana</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noche">Noche</option>
                                    </select>
                                    @error('turno')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label">CUPO MINIMO:</label>
                                    <input type="text" class="form-control" wire:model="cupo_minimo">
                                    @error('cupo_minimo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-6">
                                    <label class="form-label">CUPO MAXIMO::</label>
                                    <input type="text" class="form-control" wire:model="cupo_maximo">
                                    @error('cupo_maximo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>




                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar">CANCELAR</button>
                            <button wire:click="guardar_planParalelo"
                                class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
            </div> --}}

        </div>

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalCreate', function() {
                        $('#agregar_planParalelo').modal('hide');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalEdit', function() {
                        $('#editar_plan_paralelo').modal('hide');
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
