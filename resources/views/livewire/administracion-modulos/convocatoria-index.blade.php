<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">planificar convocatorias</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">planificarconvocatorias</li>
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

                        <div class="col-md-6">
                            <button class="btn btn-outline-primary waves-effect waves-light col-md-6 "
                                data-bs-toggle="modal" data-bs-target="#agregarplanificarconvocatoria" wire:click="abrir_form_create"> <i
                                    class="bx bxs-plus-circle">AGREGAR</i></button>


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

                    @if ($planificarconvocatorias->count())


                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            N°
                                        </th>
                                        <th>
                                            NOMBRE CONVOCATORIA
                                        </th>
                                        <th>
                                            GESTION CONVOCATORIA
                                        </th>
                                        <th>
                                            PERIODO CONVOCATORIA
                                        </th>
                                        <th>
                                            MODALIDAD CURSO
                                        </th>
                                        <th>
                                            COSTO CONVOCATORIA - COSTO-CURSO
                                        </th>
                                        <th>
                                            SEDE CONVOCATORIA
                                        </th>
                                        <th>
                                            DESCRIPCION CONVOCATORIA
                                        </th>
                                        <th>
                                            FECHA INICIO CONVOCATORIA
                                        </th>
                                        <th>
                                            FECHA FIN CONVOCATORIA
                                        </th>
                                        <th>
                                            ESTADO CONVOCATORIA
                                        </th>
                                        <th>
                                            ACCIÓN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($planificarconvocatorias as $planificarconvocatoria)
                                        <tr>
                                            <th>
                                                {{ $cont }}
                                            </th>
                                            <td>
                                                {{ $planificarconvocatoria->nombre_convocatoria }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->gestion->nombre_gestion }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->periodo }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->modalidad->nombre_convocatoria_estudiante }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->monto_convocatoria }} -
                                                {{ $planificarconvocatoria->convocatoria_costo->costo_siado_costo }}
                                                {{ $planificarconvocatoria->convocatoria_costo->deposito }}
                                                {{ $planificarconvocatoria->convocatoria_costo->tipo_costo }}

                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->siadi_sede->direccion }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->descripcion_convocatoria }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->fecha_inicio }}
                                            </td>
                                            <td>
                                                {{ $planificarconvocatoria->fecha_fin }}
                                            </td>
                                            <td>
                                                @if ($planificarconvocatoria->estado_convocatoria == 'ACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light"
                                                        wire:click="cambiar_estado_convocatoria({{ $planificarconvocatoria->id_siadi_convocatoria }})">
                                                        ACTIVO
                                                    </button>
                                                @elseif ($planificarconvocatoria->estado_convocatoria == 'INACTIVO')
                                                    <button type="button"
                                                        class="btn btn-outline-danger waves-effect waves-light"
                                                        wire:click="cambiar_estado_convocatoria({{ $planificarconvocatoria->id_siadi_convocatoria }})">
                                                        INACTIVO</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a type="button" title="Mostrar"
                                                    class="btn btn-outline-info waves-effect waves-light"
                                                    style="border-radius: 50%" target="_blank"
                                                    href="{{route('convocatoria.show', ['id_convocatoria' => $planificarconvocatoria->id_siadi_convocatoria]) }}">
                                                    <i class="bx bx-show-alt"></i>
                                                </a>
                                                <button type="button" title="Editar"
                                                    class="btn btn-outline-warning waves-effect waves-light"
                                                    style="border-radius: 50%" data-bs-toggle="modal"
                                                    data-bs-target="#editarplanificarconvocatoria"
                                                    wire:click="editar_planificarconvocatoria({{ $planificarconvocatoria->id_siadi_convocatoria }})">
                                                    <i class="bx bx-pencil"></i>
                                                </button>
                                                <button type="button" title="Eliminar"
                                                    class="btn btn-outline-danger waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click.prevent="$emit('deleteconvoca', {{ $planificarconvocatoria->id_siadi_convocatoria }})">
                                                    <i class="bx bx-trash"></i></button>
                                                
                                                <button type="button" title="Estados"
                                                    class="btn btn-outline-info waves-effect waves-light"
                                                    style="border-radius: 50%"
                                                    wire:click="form_asignaturas({{ $planificarconvocatoria->id_siadi_convocatoria }})">
                                                    <i class="bx bx-user"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @php
                                        $cont++;
                                    @endphp
                                </tbody>
                            </table>

                        </div>
                        <div class="d-flex justify-content-center">

                            {{ $planificarconvocatorias->links() }}
                        </div>

                </div>
            @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
            </div>



            <div wire:ignore.self data-bs-backdrop="static" id="editarplanificarconvocatoria" class="modal fade modal-lg"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel"> EDITAR PLANIFICAR CONVOCATORIA
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelarEditar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">NOMBRE CONVOCATORIA:</label>
                                    <input type="text" class="form-control" wire:model="nombre_convocatoria2">
                                    @error('nombre_convocatoria2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-6">
                                    <label class="form-label">DESCRIPCION:</label>
                                    <textarea class="form-control" wire:model="descripcion_convocatoria2"></textarea>
                                    @error('descripcion_convocatoria2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">GESTION:</label>
                                        <select wire:model="id_gestion2" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($gestiones as $gestion)
                                                <option value="{{ $gestion->id_gestion }}">
                                                    {{ $gestion->nombre_gestion }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_gestion2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">PERIODO:</label>
                                        <select wire:model="periodo2" class="form-select">
                                            <option>Elegir...</option>

                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                        @error('periodo2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">MODALIDAD CONVOCATORIA:</label>
                                        <select wire:model="modalidad_edit" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($modalidades as $modalidad)
                                                <option value="{{ $modalidad->id_convocartoria_estudiante }}">
                                                    {{ $modalidad->nombre_convocatoria_estudiante }}
                                                </option>
                                            @endforeach


                                        </select>
                                        @error('id_tipo_convocatoria2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">COSTO CONVOCATORIA:</label>
                                        <select wire:model="costo_edit" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($costos as $costo)
                                                <option value="{{ $costo->id_costo }}">{{ $costo->deposito }} -
                                                    {{ $costo->costo_siado_costo }} - {{ $costo->tipo_costo }}
                                                </option>
                                            @endforeach


                                        </select>
                                        @error('id_tipo_convocatoria2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">MONTO CONVOCATORIA:</label>

                                        <input type="number" class="form-control" wire:model="monto_edit">
                                      
                                        @error('id_tipo_convocatoria2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">SEDE:</label>
                                        <select wire:model="sede2" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($sedes as $sede)
                                                <option value="{{ $sede->id_siadi_sede }}"> {{ $sede->direccion }}
                                                </option>
                                            @endforeach


                                        </select>
                                        @error('sede2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">FECHA INICIO:</label>
                                        <input type="date" class="form-control" wire:model="fecha_inicio2">
                                        @error('fecha_inicio2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">FECHA FIN:</label>
                                        <input type="date" class="form-control" wire:model="fecha_fin2">
                                        @error('fecha_fin2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelarEditar">CANCELAR</button>
                            <button class="btn btn-primary waves-effect waves-light"
                                wire:click="guardarEditadoplanificarconvocatoria">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>

            <div wire:ignore.self id="agregarplanificarconvocatoria" class="modal fade modal-lg" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">NUEVA PLANIFICACION :: CONVOCATORIA
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">NOMBRE CONVOCATORIA:</label>
                                    <input type="text" class="form-control" wire:model="nombre_convocatoria">
                                    @error('nombre_convocatoria')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">GESTION:</label>
                                        <select wire:model="id_gestion" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($gestiones as $gestion)
                                                <option value="{{ $gestion->id_gestion }}">
                                                    {{ $gestion->nombre_gestion }}</option>
                                            @endforeach


                                        </select>
                                        @error('id_gestion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">PERIODO:</label>
                                        <select wire:model="periodo" class="form-select">
                                            <option>Elegir...</option>

                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>




                                        </select>
                                        @error('periodo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                               
                                {{-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">TIPO CONVOCATORIA:</label>
                                        <select wire:model="id_tipo_convocatoria" class="form-select"
                                            aria-label="Default select example" wire:change="resetAsignaturas">
                                            <option>Elegir...</option>
                                            @foreach ($siadi_tipo_convocatorias as $siadi_tipo_convocatoria)
                                                <option value="{{ $siadi_tipo_convocatoria->id_tipo_convocatoria }}">
                                                    {{ $siadi_tipo_convocatoria->tipo_estudiante->nombre_tipo_estudiante }}
                                                    -
                                                    {{ $siadi_tipo_convocatoria->convocatoria_estudiante->nombre_convocatoria_estudiante }}
                                                    <b>({{ $siadi_tipo_convocatoria->costo->tipo_costo }})</b>
                                                    - {{ $siadi_tipo_convocatoria->costo->costo_siado_costo }}bs.
                                                    -
                                                    {{ $siadi_tipo_convocatoria->costo->observacion_costo }}
                                                </option>
                                                @php
                                                    if (strstr($siadi_tipo_convocatoria->convocatoria_estudiante->nombre_convocatoria_estudiante, 'CONVALIDA') != false || strstr($siadi_tipo_convocatoria->convocatoria_estudiante->nombre_convocatoria_estudiante, 'HOMOLOGA') != false) {
                                                        array_push($conv_hom_a, $siadi_tipo_convocatoria->id_tipo_convocatoria);
                                                    }
                                                @endphp
                                            @endforeach
                                            @php
                                                foreach ($conv_hom_a as $cha) {
                                                    if ($id_tipo_convocatoria == $cha) {
                                                        $conv_hom = true;
                                                    }
                                                }
                                            @endphp
                                        </select>
                                        @error('id_tipo_convocatoria')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">MODALIDAD CONVOCATORIA:</label>
                                        <select wire:model="id_modalidad_curso" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($modalidades as $modalidad)
                                                <option value="{{ $modalidad->id_convocartoria_estudiante }}">
                                                    {{ $modalidad->nombre_convocatoria_estudiante }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_modalidad_curso')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">COSTO CONVOCATORIA:</label>
                                        <select wire:model="costoconvocatoria" class="form-select">
                                            <option>Elegir...</option>
                                            @foreach ($costos as $costo)
                                                <option value="{{ $costo->id_costo }}">{{ $costo->deposito }} -
                                                    {{ $costo->costo_siado_costo }} - {{ $costo->tipo_costo }}
                                                </option>
                                            @endforeach




                                        </select>
                                        @error('costoconvocatoria')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">MONTO CONVOCATORIA:</label>
                                        <input type="number"wire:model="monto_convocatoria" class="form-control">

                                        @error('monto_convocatoria')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">SEDE:</label>
                                        <select wire:model="sede" class="form-select"
                                            aria-label="Default select example">
                                            <option>Elegir...</option>
                                            @foreach ($sedes as $sede)
                                                <option value="{{ $sede->id_siadi_sede }}"> {{ $sede->direccion }}
                                                </option>
                                            @endforeach


                                        </select>
                                        @error('sede')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">DESCRIPCION:</label>
                                        <textarea class="form-control" wire:model="descripcion_convocatoria"></textarea>

                                        @error('descripcion_convocatoria')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">FECHA INICIO:</label>
                                        <input type="date" class="form-control" wire:model="fecha_inicio">
                                        @error('fecha_inicio')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="form-label">FECHA FIN:</label>
                                        <input type="date" class="form-control" wire:model="fecha_fin">
                                        @error('fecha_fin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if ($id_modalidad_curso)
                                <div class="row" id="lista_asignaturas">
                                    <div class="col-md-12 row asignaturas_idiomas" id="idas_{{ $cont_asignaturas }}">
                                        <div class="col-md-10">
                                            <label class="form-label">IDIOMA:</label>
                                            <select class="form-control"
                                                wire:model="asignaturas.{{ $cont_asignaturas }}.idioma">
                                                <option value="">Elegir...</option>
                                                @foreach ($idiomas as $idioma)
                                                    <option value="{{ $idioma->nombre_idioma }}">
                                                        {{ $idioma->nombre_idioma }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('asignaturas')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            @if (!empty($asignaturas[$cont_asignaturas]['idioma']))
                                                @php
                                                    $cont_niv = 0;
                                                    if (!empty($asignaturas[$cont_asignaturas]['nivel'])) {
                                                        foreach ($asignaturas[$cont_asignaturas]['nivel'] as $value) {
                                                            $cont_niv = $cont_niv + $value;
                                                        }
                                                    }
                                                @endphp
                                                @if ($cont_niv > 0)
                                                    <button class="btn btn-success mt-3" wire:click="addAsignatura">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                        {{-- <pre>
                                            {{ print_r($asignaturas) }}
                                        </pre> --}}
                                        <div class="col-md-12 row">
                                            @if (sizeof($asignaturas) > $cont_asignaturas)
                                                @foreach ($planificar as $plan)
                                                    @if ($plan->nombre_idioma == $asignaturas[$cont_asignaturas]['idioma'])
                                                        @if (
                                                            !$conv_hom ||
                                                                ($plan->nombre_nivel_idioma != '1.1' &&
                                                                    $plan->nombre_nivel_idioma != '2.1' &&
                                                                    $plan->nombre_nivel_idioma != '3.1'))
                                                            <div class="col-md-12 row mt-3">
                                                                <div
                                                                    class="col-md-2 form-group d-flex justify-content-center align-items-center">
                                                                    <label
                                                                        class="form-check-label">{{ $plan->nombre_nivel_idioma }}</label>
                                                                    &nbsp;
                                                                    <input type="checkbox" class="form-check-input"
                                                                        style="width: 30px;height:30px;border:1px solid var(--bs-body-color)"
                                                                        wire:model="asignaturas.{{ $cont_asignaturas }}.nivel.{{ $plan->id_siadi_asignatura }}">

                                                                </div>
                                                                <div class="col-md-10 row">
                                                                    @if (!empty($asignaturas[$cont_asignaturas]['nivel'][$plan->id_siadi_asignatura]))
                                                                        @foreach ($paralelos as $paralelo)
                                                                            @if (!$conv_hom)
                                                                                @if (strlen($paralelo->nombre_paralelo) <= 2)
                                                                                    <div class="col-md-3"
                                                                                        style="border:1px solid var(--bs-modal-color)">
                                                                                        <label
                                                                                            class="form-check-label">{{ $paralelo->nombre_paralelo }}</label>
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input"
                                                                                            style="width: 30px;height:30px;border:1px solid var(--bs-body-color)"
                                                                                            wire:model="asignaturas.{{ $cont_asignaturas }}.paralelos.{{ $plan->id_siadi_asignatura }}.{{ $paralelo->id_paralelo }}">
                                                                                        <br>
                                                                                        <br>
                                                                                        <select class="form-select"
                                                                                            wire:model="asignaturas.{{ $cont_asignaturas }}.paralelos.{{ $plan->id_siadi_asignatura }}.{{ $paralelo->id_paralelo }}">
                                                                                            <option value="Mañana">
                                                                                                Mañana
                                                                                            </option>
                                                                                            <option value="Tarde"
                                                                                                selected>
                                                                                                Tarde
                                                                                            </option>
                                                                                            <option value="Noche">
                                                                                                Noche
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                @if (strlen($paralelo->nombre_paralelo) > 2)
                                                                                    <div class="col-md-4">
                                                                                        <label
                                                                                            class="form-check-label fw-bold">{{ $paralelo->nombre_paralelo }}</label>
                                                                                        <input type="checkbox"
                                                                                            class="form-check-input"
                                                                                            style="width: 30px;height:30px;border:1px solid var(--bs-body-color)"
                                                                                            wire:model="asignaturas.{{ $cont_asignaturas }}.paralelos.{{ $plan->id_siadi_asignatura }}.{{ $paralelo->id_paralelo }}">
                                                                                        <br>
                                                                                        <br>
                                                                                        <select class="form-select"
                                                                                            wire:model="asignaturas.{{ $cont_asignaturas }}.paralelos.{{ $plan->id_siadi_asignatura }}.{{ $paralelo->id_paralelo }}">
                                                                                            <option value="Mañana">
                                                                                                Mañana
                                                                                            </option>
                                                                                            <option value="Tarde"
                                                                                                selected>
                                                                                                Tarde
                                                                                            </option>
                                                                                            <option value="Noche">
                                                                                                Noche
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <br>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="col-md-6"></div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            @endif

                            @if (!empty($asignaturas))
                                <div>
                                    <table class="table table-bordered mt-3">
                                        <tr>
                                            <th>Idioma</th>
                                            <th>Niveles</th>
                                            <th></th>
                                        </tr>
                                        @for ($i = 0; $i < $cont_asignaturas; $i++)
                                            @if (!empty($asignaturas[$i]))
                                                <tr>
                                                    <td>{{ $asignaturas[$i]['idioma'] }}</td>
                                                    <td>
                                                        @foreach ($asignaturas[$i]['nivel'] as $key => $niv)
                                                            @if ($asignaturas[$i]['nivel'][$key])
                                                                <span
                                                                    class="badge bg-dark">{{ $niveles[$key] }}</span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td><button class="btn btn-sm btn-danger"
                                                            wire:click.prevent="eliminarAsignatura({{ $i }})"><i
                                                                class="fa fa-trash"></i></button></td>
                                                </tr>
                                            @endif
                                        @endfor
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                wire:click="cancelar">CANCELAR</button>
                            <button wire:click="guardar_planificarconvocatoria"
                                class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

            <!-- listado rapido asignaturas inicio -->
            <div wire:ignore.self id="estadosPlanificarConvocatoria" class="modal fade modal-lg" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content ">
                        <div class="modal-header" style="flex-wrap: wrap;">
                            <h5 class="modal-title mt-0" id="myModalLabel">
                                CONVOCATORIA .:: 
                                @if(!is_null($convocatoria_asignaturas) && $operation=="edit_status_asignaturas") 
                                    <span title="Nombre Convocatoria"> {{$convocatoria_asignaturas->nombre_convocatoria}}</span> 
                                    .::
                                    <span title="Periodo - Gestión">{{$convocatoria_asignaturas->periodo}}/{{$convocatoria_asignaturas->gestion->nombre_gestion}}</span> 
                                @endif
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                wire:click="cancelar_estados">
                            </button>
                            @if(!is_null($convocatoria_asignaturas) && $operation=="edit_status_asignaturas" && count($asignaturas_estados)>0)
                                <div class="row g-3" style="flex-basis: 100%">
                                    <div class="col-md-4 col-mb-3">
                                        <label class="form-label" for="convoc_asignaturas_estados_estados">ESTADO PLANIFICAR ASIGNATURA</label>
                                        <input type="checkbox" id="convoc_asignaturas_estados_estados" switch="bool" {{$convoc_asignaturas_estados_estados==true? 'checked': ''}} wire:model="convoc_asignaturas_estados_estados">
                                        @error('convoc_asignaturas_estados_estados')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="form-label" for="convoc_asignaturas_estados_estados" data-on-label="SI" data-off-label="NO" ></label> <br>
                                        <button type="button" class="btn btn-{{$convoc_asignaturas_estados_estados?'success': 'danger'}} waves-effect waves-light" title="Cambia el estado" wire:click="cambiar_estados_todo"><i class="fs-3 bx bx-checkbox{{$convoc_asignaturas_estados_estados?'-checked': ''}}"></i> ASIGNAR ESTADO ACTUAL</button>
                                    </div>
                                    <div class="col-md-4 col-mb-3">
                                        <label class="form-label" for="convoc_asignaturas_estados_docentes">ESTADO DOCENTE</label>
                                        <input type="checkbox" id="convoc_asignaturas_estados_docentes" switch="bool" {{$convoc_asignaturas_estados_docentes==true? 'checked': ''}} wire:model="convoc_asignaturas_estados_docentes">
                                        @error('convoc_asignaturas_estados_docentes')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label class="form-label" for="convoc_asignaturas_estados_docentes" data-on-label="SI" data-off-label="NO" ></label> <br>
                                        <button type="button" class="btn btn-{{$convoc_asignaturas_estados_docentes?'success': 'danger'}} waves-effect waves-light" title="Cambia el estado" wire:click="cambiar_estado_docente_todo"><i class="fs-3 bx bx-checkbox{{$convoc_asignaturas_estados_estados?'-checked': ''}}"></i> ASIGNAR ESTADO ACTUAL</button>
                                    </div>
                                    <div class="col-md-4 col-mb-3">
                                        <label class="form-label" for="convoc_asignaturas_fechas_limite">FECHA LÍMITE</label>
                                        <input type="date" class="form-control" id="convoc_asignaturas_fechas_limite" wire:model="convoc_asignaturas_fechas_limite">
                                        @error('convoc_asignaturas_fechas_limite')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <button type="button" class="btn btn-primary waves-effect waves-light" title="Cambiar fecha límite" wire:click="cambiar_fecha_limite_todo"><i class="fs-3 bx bx-calendar"></i> ASIGNAR FECHA ACTUAL</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if(!is_null($convocatoria_asignaturas) && $operation=="edit_status_asignaturas" && count($asignaturas_estados)>0)
                            <div class="modal-body">
                                @if(count($asignaturas_estados)>0)
                                    <div class="row g-3">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>NRO</th>
                                                        <th>ASIGNATURA</th>
                                                        <th>NIVEL</th>
                                                        <th>PARALELO</th>
                                                        <th>ESTADO</th>
                                                        <th>ESTADO <br> DOCENTE</th>
                                                        <th>FECHA LÍMITE <br> SUBIR NOTA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $nro = 1; @endphp
                                                    @foreach ($asignaturas_estados as $index => $asign_e)
                                                        <tr>
                                                            <td>{{$nro}}</td>
                                                            <td>{{$asign_e['nombre_idioma']}}</td>
                                                            <td>{{$asign_e['nivel']}}</td>
                                                            <td>{{$asign_e['nombre_paralelo']}}</td>
                                                            <td>
                                                                {{--$asignaturas_estados_estados[$index]--}}
                                                                <input type="checkbox" id="asignaturas_estados_estados{{$index}}" switch="bool" {{$asignaturas_estados_estados[$index]? "checked": ""}} wire:model="asignaturas_estados_estados.{{$index}}">
                                                                <label class="form-label" for="asignaturas_estados_estados{{$index}}" data-on-label="" data-off-label="" ></label> <br>
                                                                <label class="form-label text-{{$asignaturas_estados_estados[$index]? 'success': 'danger'}}" for="asignaturas_estados_estados{{$index}}">{{$asignaturas_estados_estados[$index]=='ACTIVO'? "ACTIVO": "INACTIVO"}}</label>
                                                            </td>
                                                            <td>
                                                                {{--$asignaturas_estados_estados_docentes[$index]--}}
                                                                <input type="checkbox" id="asignaturas_estados_estados_docentes{{$index}}" switch="bool" {{$asignaturas_estados_estados_docentes[$index]==true? "checked": ""}} wire:model="asignaturas_estados_estados_docentes.{{$index}}">
                                                                <label class="form-label" for="asignaturas_estados_estados_docentes{{$index}}" data-on-label="SI" data-off-label="NO" ></label>
                                                            </td>
                                                            <td>
                                                                {{--$asignaturas_estados_fechas_limites[$index]--}}
                                                                <input type="date" class="form-control" id="asignaturas_estados_fechas_limites{{$index}}" wire:model="asignaturas_estados_fechas_limites.{{$index}}">
                                                                @error("asignaturas_estados_fechas_limites.". $index)
                                                                    <span class="text-danger fs-6">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning waves-effect waves-light" title="Restaurar datos de fila {{$nro}}" wire:click="restaurar_fila({{$index}})"><i class="bx bx-reset"></i></button>
                                                            </td>
                                                        </tr>
                                                        @php $nro++; @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                @endif
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                                    wire:click="cancelar_estados">CANCELAR</button>
                                <button wire:click="guardar_estados_asignaturas"
                                    class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                            </div>
                        @else
                            <div class="modal-body">
                                <p class="text-center"><b>No hay asignaturas planificadas</b></p>
                            </div>
                        @endif
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
            <!-- listado rapido asignaturas fin -->
        </div>

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalCreate', function() {
                        $('#agregarplanificarconvocatoria').modal('hide');
                    });
                });
            </script>
        @endpush
        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalEdit', function() {
                        $('#editarplanificarconvocatoria').modal('hide');
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

        @push('navi-js')
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('closeModalStatusConvocatory', function() {
                        $('#estadosPlanificarConvocatoria').modal('hide');
                    });
                    Livewire.on('openModalStatusConvocatory', function() {
                        $('#estadosPlanificarConvocatoria').modal('show');
                    });

                    Livewire.on('Mostrar', function(mess) {
                        console.log(mess);
                    });
                });
            </script>
        @endpush
