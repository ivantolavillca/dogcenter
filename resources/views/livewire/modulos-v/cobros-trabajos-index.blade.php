<div>
    <div class="row">
        <div class="col-md-6">
            <fieldset class=" float-none w-auto border border-primary p-3 mb-3">
                <legend class="text-primary">
                    BUSCAR DOCTOR
                </legend>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Doctor
                            <span class="text-danger">*</span></label>
                        <select wire:model="Doctor" class="form-select">
                            <option value="">[SELECCIONE UNA OPCIÓN]</option>
                            @foreach ($personas as $per)
                                <option value="{{ $per->id }}">{{ $per->name }}</option>
                            @endforeach
                        </select>
                        @error('RazonGasto')
                            <div class="text-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-4">
                    <label class="form-label">Precio de Gasto
                        <span class="text-danger">*</span></label>
                    <input class="form-control" wire:model="PrecioGasto"
                        type="number" placeholder="En Bs.">
                    @error('PrecioGasto')
                        <div class="text-danger">
                            {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4 mt-4">
                    <div class="col-sm-8 offset-sm-4">
                        <button class="btn btn-success"
                            wire:click="guardardescuento">+Agregar</button>
                    </div>
                </div> --}}
                </div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset class=" float-none w-auto border border-primary p-3 mb-3">
                <legend class="text-primary">
                    FILTRAR POR FECHA
                </legend>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Fecha inicio
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" wire:model="AnioInicio">

                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fecha fin
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" wire:model="AnioFinal">

                    </div>
                    {{-- <div class="col-md-4">
                    <label class="form-label">Precio de Gasto
                        <span class="text-danger">*</span></label>
                    <input class="form-control" wire:model="PrecioGasto"
                        type="number" placeholder="En Bs.">
                    @error('PrecioGasto')
                        <div class="text-danger">
                            {{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4 mt-4">
                    <div class="col-sm-8 offset-sm-4">
                        <button class="btn btn-success"
                            wire:click="guardardescuento">+Agregar</button>
                    </div>
                </div> --}}
                </div>
            </fieldset>
        </div>
    </div>
    @if ($doctorseleccionado)
        <div class="row">
            <div class="alert alert-info text-center"> TRABAJOS REALIZADOS POR EL DR.
                {{ strtoupper($doctorseleccionado->name) }}</div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        {{-- 
                <h4 class="card-title">Vertical Nav Tabs</h4>
                <p class="card-title-desc">Example of Vertical nav tabs</p> --}}

                        <div class="row">
                            <div class="col-md-2">
                                <div class="nav flex-column nav-pills"  id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link mb-2 active" id="v-pills-consultas-tab" data-bs-toggle="pill"
                                        href="#v-pills-consultas" role="tab" aria-controls="v-pills-consultas"
                                        aria-selected="true"  wire:ignore.self>CONSULTA Y RECONSULTAS</a>
                                    <a class="nav-link mb-2" id="v-pills-vacunas-tab" data-bs-toggle="pill"
                                        href="#v-pills-vacunas" role="tab" aria-controls="v-pills-vacunas"
                                        aria-selected="false"  wire:ignore.self>VACUNAS</a>
                                    <a class="nav-link mb-2" id="v-pills-desparacitacion-tab" data-bs-toggle="pill"
                                        href="#v-pills-desparacitacion" role="tab"
                                        aria-controls="v-pills-desparacitacion"
                                        aria-selected="false"  wire:ignore.self>DESPARACITACIONES</a>
                                    <a class="nav-link" id="v-pills-examenes-tab" data-bs-toggle="pill"
                                        href="#v-pills-examenes" role="tab" aria-controls="v-pills-examenes"
                                        aria-selected="false"  wire:ignore.self>EXAMENES COMPLEMENTARIOS</a>
                                    <a class="nav-link" id="v-pills-cirugias-tab" data-bs-toggle="pill"
                                        href="#v-pills-cirugias" role="tab" aria-controls="v-pills-cirugias"
                                        aria-selected="false"  wire:ignore.self>CIRUGIAS</a>
                                    <a class="nav-link" id="v-pills-farmacia-tab" data-bs-toggle="pill"
                                        href="#v-pills-farmacia" role="tab" aria-controls="v-pills-farmacia"
                                        aria-selected="false"  wire:ignore.self>FARMACIA</a>
                                    <a class="nav-link" id="v-pills-internacion-tab" data-bs-toggle="pill"
                                        href="#v-pills-internacion" role="tab" aria-controls="v-pills-internacion"
                                        aria-selected="false"  wire:ignore.self>INTERNACIONES</a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent" >
                                    <div class="tab-pane fade show active" id="v-pills-consultas"  wire:ignore.self  role="tabpanel"
                                        aria-labelledby="v-pills-consultas-tab">
                                        <div class="text-center">
                                            <span class="h4">Consultas y Reconsultas realizadas por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioHistorialClinico) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>TRABAJO REALIZADO</th>
                                                            <th> CLIENTE ATENDIDO</th>


                                                            <th> PRECIOS</th>
                                                            <th>FECHA DE ATENCION</th>
                                                            <th> TRATAMIENTOS </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioHistorialClinico as $con)
                                                            <tr>
                                                                <td>
                                                                    @if ($con->tipo_historial_id == 1)
                                                                        CONSULTA
                                                                    @elseif($con->tipo_historial_id == 10)
                                                                        RECONSULTA
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    CLIENTE:
                                                                    {{ strtoupper($con->historial_clinico_mascotas->mascotas_clientes->nombre) }}
                                                                    {{ strtoupper($con->historial_clinico_mascotas->mascotas_clientes->apellidos) }}
                                                                    <br>
                                                                    MASCOTA:
                                                                    {{ $con->historial_clinico_mascotas->nombre }}
                                                                </td>

                                                                <td> Bs. {{ $con->precio }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($con->created_at)->isoFormat('LL') }}
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-outline-info"
                                                                        wire:click="VerTratamientos({{ $con->id }})">
                                                                        VER TRATAMIENTOS</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioHistorialClinico->links() }}
                                            </div>
                                        @else
                                            <span> SIN ATENCIONES REALIZADAS</span>
                                        @endif

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-vacunas"  wire:ignore.self role="tabpanel"
                                        aria-labelledby="v-pills-vacunas-tab">
                                        <div class="text-center">
                                            <span class="h4">Vacunas realizadas por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioVacunas) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>VACUNA</th>
                                                            <th> CLIENTE ATENDIDO</th>
                                                            <th> PRECIO DEL TRABAJO</th>
                                                            <th>FECHA DE ATENCION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioVacunas as $vacu)
                                                            <tr>
                                                                <td>{{ $vacu->vacuna_aplicada }}</td>
                                                                <td>
                                                                    CLIENTE:
                                                                    {{ strtoupper($vacu->vacuna_mascota->mascotas_clientes->nombre) }}
                                                                    {{ strtoupper($vacu->vacuna_mascota->mascotas_clientes->apellidos) }}
                                                                    <br>
                                                                    MASCOTA:
                                                                    {{ $vacu->vacuna_mascota->nombre }}

                                                                </td>
                                                                <td>Bs. {{ $vacu->precio }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($vacu->created_at)->isoFormat('LL') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioVacunas->links() }}
                                            </div>
                                        @else
                                            SIN VACUNAS
                                        @endif

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-desparacitacion"  wire:ignore.self role="tabpanel"
                                        aria-labelledby="v-pills-desparacitacion-tab">
                                        <div class="text-center">
                                            <span class="h4">Desparacitaciones realizadas por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioDesparacitaciones) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>PRODUCTO </th>
                                                            <th> CLIENTE ATENDIDO</th>
                                                            <th> PRECIO DEL TRABAJO</th>
                                                            <th>FECHA DE ATENCION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioDesparacitaciones as $des)
                                                            <tr>
                                                                <td>{{ $des->id_producto2 }}</td>
                                                                <td>
                                                                    CLIENTE:
                                                                    {{ strtoupper($des->desparacitaciones_mascota->mascotas_clientes->nombre) }}
                                                                    {{ strtoupper($des->desparacitaciones_mascota->mascotas_clientes->apellidos) }}
                                                                    <br>
                                                                    MASCOTA:
                                                                    {{ $des->desparacitaciones_mascota->nombre }}

                                                                </td>
                                                                <td>Bs. {{ $des->precio }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($des->created_at)->isoFormat('LL') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioDesparacitaciones->links() }}
                                            </div>
                                        @else
                                            SIN DESPAARACITACIONES
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-examenes"  wire:ignore.self role="tabpanel"
                                        aria-labelledby="v-pills-examenes-tab">
                                        <div class="text-center">
                                            <span class="h4">Examenes complementarios realizados por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioEstudio) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>TRABAJO REALIZADO</th>
                                                            <th> CLIENTE ATENDIDO</th>


                                                            <th> PRECIOS</th>
                                                            <th>FECHA DE ATENCION</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioEstudio as $est)
                                                            <tr>
                                                                <td>
                                                                  ESTUDIO COMPLEMENTARIO - {{$est->historial_estudio->nombre}}
                                                                </td>
                                                                <td>
                                                                    CLIENTE:
                                                                    {{ strtoupper($est->historial_clinico_mascotas->mascotas_clientes->nombre) }}
                                                                    {{ strtoupper($est->historial_clinico_mascotas->mascotas_clientes->apellidos) }}
                                                                    <br>
                                                                    MASCOTA:
                                                                    {{ $est->historial_clinico_mascotas->nombre }}
                                                                </td>

                                                                <td> Bs. {{ $est->precio }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($est->created_at)->isoFormat('LL') }}
                                                                </td>
                                                              
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioEstudio->links() }}
                                            </div>
                                        @else
                                            <span> SIN EXAMENES</span>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-cirugias"  wire:ignore.self role="tabpanel"
                                        aria-labelledby="v-pills-cirugias-tab">
                                        <div class="text-center">
                                            <span class="h4">Cirugias realizadas por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioCirugias) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>DESCRIPCIÓN DE CIRUGIA </th>
                                                            <th> CLIENTE ATENDIDO</th>
                                                            <th> PRECIO DEL TRABAJO</th>
                                                            <th>FECHA DE ATENCION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioCirugias as $cir)
                                                            <tr>
                                                                <td>{{ $cir->descripcion }}</td>
                                                                <td>

                                                                    CLIENTE:
                                                                    {{ strtoupper($cir->cirugia_mascota->mascotas_clientes->nombre) }}
                                                                    {{ strtoupper($cir->cirugia_mascota->mascotas_clientes->apellidos) }}
                                                                    <br>
                                                                    MASCOTA:
                                                                    {{ $cir->cirugia_mascota->nombre }}

                                                                </td>
                                                                <td>Bs. {{ $cir->total }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($cir->created_at)->isoFormat('LL') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioCirugias->links() }}
                                            </div>
                                        @else
                                            SIN CIRUGIAS
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-farmacia"  wire:ignore.self role="tabpanel"
                                        aria-labelledby="v-pills-farmacia-tab">
                                        <div class="text-center">
                                            <span class="h4">Ventas realizadas en Farmacia por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioFarmacia) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>PRODUCTO VENDIDO </th>
                                                            <th> CLIENTE ATENDIDO</th>
                                                            <th> PRECIO DE LA VENTA</th>
                                                            <th>FECHA DE VENTA</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioFarmacia as $far)
                                                            <tr>
                                                                <td>

                                                                    @if ($far->productos_famaciaven)
                                                                        {{ $far->productos_famaciaven->nombre }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($far->farmacia_mascota)
                                                                        CLIENTE:

                                                                        {{ strtoupper($far->farmacia_mascota->mascotas_clientes->nombre) }}
                                                                        {{ strtoupper($far->farmacia_mascota->mascotas_clientes->apellidos) }}
                                                                        <br>
                                                                        MASCOTA:
                                                                        {{ $far->farmacia_mascota->nombre }}
                                                                    @endif


                                                                </td>
                                                                <td>Bs. {{ $far->precio }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($far->created_at)->isoFormat('LL') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioFarmacia->links() }}
                                            </div>
                                        @else
                                            SIN VENTAS REALIZADAS
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-internacion"  wire:ignore.self role="tabpanel"
                                        aria-labelledby="v-pills-internacion-tab">
                                        <div class="text-center">
                                            <span class="h4">Internaciones realizadas por el Dr.
                                                {{ strtoupper($doctorseleccionado->name) }}</span>
                                        </div>
                                        <hr class="border border-2">
                                        @if (count($UsuarioInternacion) > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>MEDICAMENTOS Y COMENTARIOS </th>
                                                            <th> CLIENTE ATENDIDO</th>
                                                            <th> PRECIO DE LA ITNERNACIÓN</th>
                                                            <th>FECHA DE INTERNACIÓN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($UsuarioInternacion as $int)
                                                            <tr>
                                                                <td>
                                                                    @foreach ($int->internacion_comentarios as $com)
                                                                        {{$com->comentario}}
                                                                    @endforeach
                                                                   @foreach ($int->internacion_medicamentos as $medi)
                                                                       {{$medi->Medicamento}} <br>
                                                                   @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($int->internacion_mascota)
                                                                        CLIENTE:

                                                                        {{ strtoupper($int->internacion_mascota->mascotas_clientes->nombre) }}
                                                                        {{ strtoupper($int->internacion_mascota->mascotas_clientes->apellidos) }}
                                                                        <br>
                                                                        MASCOTA:
                                                                        {{ $int->internacion_mascota->nombre }}
                                                                    @endif


                                                                </td>
                                                                <td>Bs. {{ $int->precio }}</td>
                                                                <td> {{ \Carbon\Carbon::parse($int->created_at)->isoFormat('LL') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                {{ $UsuarioInternacion->links() }}
                                            </div>
                                        @else
                                            SIN INTERNACIONES
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    @else
        <div class="row">
            <div class="alert alert-info text-center">--- SELECCIONE UN DOCTOR POR FAVOR -----</div>
        </div>
    @endif
    <div wire:ignore.self id="vertratamientos" data-bs-backdrop="static" class="modal fade" tabindex="-1"
        role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TRABAJOS REALIZADOS</h5>
                </div>
                <div class="modal-body" wire:ignore.self>

                    @if (count($tratamientos) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ENCARGADO DEL TRATAMIENTO</th>
                                        <th> MEDICAMENTOS ADMINISTRADOS</th>


                                        <th> PRECIO DEL TRATAMIENTO</th>
                                        <th>FECHA DE ATENCION</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tratamientos as $tra)
                                        <tr>
                                            <td>
                                                {{ $tra->tratamiento_doctor->name }}
                                            </td>
                                            <td>
                                                @if (count($tra->tratamiento_medicamentos) > 0)
                                                    @foreach ($tra->tratamiento_medicamentos as $med)
                                                        {{ $med->Medicamento }} <br>
                                                    @endforeach
                                                @else
                                                    SIN MEDICAMENTOS ADMINISTRADOS
                                                @endif

                                            </td>

                                            <td> Bs. {{ $tra->precio }}</td>
                                            <td> {{ \Carbon\Carbon::parse($tra->created_at)->isoFormat('LL') }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <span> SIN TRATAMIENTOS</span>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>


                </div>
            </div>
        </div>
    </div>

    @push('navi-js')
        <script>
            document.addEventListener('livewire:load', function() {

                Livewire.on('cerrarmodalveratenciones', function() {
                    $('#vertratamientos').modal('hide');
                });
                Livewire.on('abrirmodaltratamiento', function() {
                    $('#vertratamientos').modal('show');
                });
            });
        </script>
    @endpush
</div>
