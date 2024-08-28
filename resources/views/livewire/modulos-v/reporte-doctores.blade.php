<div>



    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">REPORTES <span class="text-danger">
                    </span></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>

                        <li class="breadcrumb-item active">Reportes</li>
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


                        <div class="col-12 row">
                            <div class="col-12 col-md-6 ">
                                <label for="gestiones" class="form-label">Buscar: </label>
                                <input type="text" class="form-control" wire:model="search">

                            </div>





                        </div>
                        <div class="row mt-5">
                            <div class="table-reponsive">

                                <table class="table table-hover table-bordered">
                                    <thead style="background: #191654;">
                                        <tr>
                                            <th class="text-dark">#</th>
                                            <th>USUARIO</th>
                                            <th>CARGO</th>
                                            <th>ACCIÓNES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->roles[0]->name }}</td>
                                                <td>
                                                    <button class=" btn btn-outline-primary"
                                                        wire:click="VerAtenciones({{ $user->id }})">VER ATENCIONES
                                                        REALIZADAS</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $usuarios->links() }}
                            </div>


                        </div>



                    </div>

                </div>

            </div>



        </div>
    </div>

    <div wire:ignore.self id="veratenciones" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-hidden="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TRABAJOS REALIZADOS</h5>
                </div>
                <div class="modal-body"  wire:ignore.self>
                    {{-- <div class="text-center">
                        CONSULTAS, RECONSULTAS Y ESTUDIOS COMPLEMENTARIOS
                        <br>
                    </div> --}}
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="form-label">Fecha inicio</label>
                            <input type="date" class="form-control" wire:model="AnioInicio">
                        </div>

                        <div class="col-4">
                            <label for="" class="form-label">Fecha inicio</label>
                            <input type="date" class="form-control" wire:model="AnioFinal">
                        </div>
                        <div class="col-4 mt-4 ">

                            <button class="btn btn-info" wire:click="ResetFecha">Resetear fechas</button>
                        </div>

                        {{-- <div class="col-4">
                            <label for="" class="form-label">Año</label>
                            <select class="form-select" wire:model="Anio">
                                <option value="">seleccione</option>
                                <option value="2024">2024</option>
                            </select>
                        </div> --}}

                    </div>
                    <div class="row mt-5">
                        <div class="table-responsive">
                            <table class="table table-bordered border-success">
                                <thead>
                                    <tr>
                                        <td>TOTAL CONSULTAS - RECONSULTAS - ESTUDIOS COMPLEMENTARIOS</td>
                                        <td>TOTAL VACUNAS</td>
                                        <td>TOTAL DESPARACITACIONES</td>
                                        <td>TOTAL CIRUGIAS</td>
                                        <td>FARMACIA</td>
                                        <td>SUMATORIA TOTAL</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $totalHistoriasClinico }} Bs.</td>
                                        <td>{{ $totalVacunas }} Bs.</td>
                                        <td>{{ $totalDesparacitaciones }} Bs.</td>
                                       
                                        <td>{{ $totalCirugias }} Bs.</td>
                                        <td></td>
                                        <td>{{ $total }} Bs.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row mt-5" wire:ignore.self>

                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist"wire:ignore.self>
                            <li class="nav-item " >
                                <a class="nav-link active" data-bs-toggle="tab" href="#estudio_consultas"
                                    role="tab" wire:ignore.self>
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">CONSULTAS - RECONSULTAS - ESTUDIO
                                        COMPLEMENTARIO</span>
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" data-bs-toggle="tab" href="#vacunas" role="tab" wire:ignore.self>
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">VACUNAS</span>
                                </a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" data-bs-toggle="tab" href="#desparacitaciones" role="tab" wire:ignore.self>
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">DESPARACITACIONES</span>
                                </a>
                            </li>
                            <li class="nav-item "  >
                                <a class="nav-link" data-bs-toggle="tab" href="#cirugias" role="tab" wire:ignore.self>
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">CIRUGIA</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content p-3 text-muted" wire:ignore.self>
                        <div class="tab-pane active" id="estudio_consultas" role="tabpanel" wire:ignore.self>

                            <div class="table-responsive mt-3">

                                <table class="table table-hover table-bordered border-primary">

                                    <thead
                                        style="background: #0575E6; background: -webkit-linear-gradient(to right, #021B79, #0575E6); background: linear-gradient(to right, #021B79, #0575E6);">
                                        <tr>
                                            <th>#</th>
                                            <th>MASCOTA ATENDIDA</th>
                                            <th>TRABAJO REALIZADO</th>
                                            <th>FECHA</th>
                                            <th>PRECIO COBRADO</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($UsuarioHistorialClinico as $usuario)
                                            <tr>
                                                <td>{{ $usuario->id }}</td>
                                                <td>{{ $usuario->historial_clinico_mascotas->nombre }}</td>
                                                <td>{{ $usuario->hitorialtipohistorial->nombre }}</td>
                                                <td>{{ $usuario->created_at }}</td>
                                                <td>{{ $usuario->precio }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div>
                                    {{ $UsuarioHistorialClinico->links() }}
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="vacunas" role="tabpanel" wire:ignore.self>
                            <div class="table-responsive mt-3">

                                <table class="table table-hover table-bordered border-primary">

                                    <thead
                                        style="background: #0575E6; background: -webkit-linear-gradient(to right, #021B79, #0575E6); background: linear-gradient(to right, #021B79, #0575E6);">
                                        <tr>
                                            <th>#</th>
                                            <th>MASCOTA ATENDIDA</th>
                                            <th>TRABAJO REALIZADO</th>
                                            <th>FECHA</th>
                                            <th>PRECIO COBRADO</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($UsuarioVacunas as $usuarioV)
                                            <tr>
                                                <td>{{ $usuarioV->id }}</td>
                                                <td>{{ $usuarioV->vacuna_mascota->nombre }}</td>
                                                <td>{{ $usuarioV->vacuna_aplicada }}</td>
                                                <td>{{ $usuarioV->created_at }}</td>
                                                <td>{{ $usuarioV->precio }}</td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div>
                                    {{ $UsuarioVacunas->links() }}
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="desparacitaciones" role="tabpanel" wire:ignore.self>
                            <div class="table-responsive mt-3">

                                <table class="table table-hover table-bordered border-primary">

                                    <thead
                                        style="background: #0575E6; background: -webkit-linear-gradient(to right, #021B79, #0575E6); background: linear-gradient(to right, #021B79, #0575E6);">
                                        <tr>
                                            <th>#</th>
                                            <th>MASCOTA ATENDIDA</th>
                                            <th>TRABAJO REALIZADO</th>
                                            <th>FECHA</th>
                                            <th>PRECIO COBRADO</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($UsuarioDesparacitaciones as $usuarioD)
                                            <tr>
                                                <td>{{ $usuarioD->id }}</td>
                                                <td>{{ $usuarioD->desparacitaciones_mascota->nombre }}</td>
                                                <td>{{ $usuarioD->desparacitaciones_producto->nombre }}</td>
                                                <td>{{ $usuarioD->created_at }}</td>
                                                <td>{{ $usuarioD->precio }}</td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div>
                                    {{ $UsuarioDesparacitaciones->links() }}
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="cirugias" role="tabpanel" wire:ignore.self>
                            <div class="table-responsive mt-3">

                                <table class="table table-hover table-bordered border-primary">

                                    <thead
                                        style="background: #0575E6; background: -webkit-linear-gradient(to right, #021B79, #0575E6); background: linear-gradient(to right, #021B79, #0575E6);">
                                        <tr>
                                            <th>#</th>
                                            <th>MASCOTA ATENDIDA</th>
                                            <th>TRABAJO REALIZADO</th>
                                            <th>FECHA</th>
                                            <th>PRECIO COBRADO</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($UsuarioCirugias as $usuarios)
                                            <tr>
                                                <td>{{ $usuarios->id }}</td>
                                                <td>{{ $usuarios->cirugia_mascota->nombre }}</td>
                                                <td>CIRUGIA</td>
                                                <td>{{ $usuarios->created_at }}</td>
                                                <td>{{ $usuarios->total }}</td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div>
                                    {{ $UsuarioCirugias->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Tab panes -->



                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="Cerrar">Salir</button>


                </div>
            </div>
        </div>
    </div>
</div>
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {

            Livewire.on('cerrarmodalveratenciones', function() {
                $('#veratenciones').modal('hide');
            });
            Livewire.on('abrirmodalveratenciones', function() {
                $('#veratenciones').modal('show');
            });
        });
    </script>
@endpush
