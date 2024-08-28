<div>
    
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">REPORTES DE ATENCION A LA MASCOTA {{$id_mascg}} </h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">Reporte de Atencion</li>
                    </ol>
                </div>
            </div>
            @include('livewire.modal-reporteatencion.modalGeneral')
            <hr>
            <div class="row align-items-center">
                <div class="col-md-2">
                    <button class="btn btn-danger mr-2" wire:click="LimpiarFechas">
                        <i class="bx bx-exit"></i> LIMPIAR FECHAS
                    </button>
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control" wire:model="fecha1" placeholder="Fecha 1" {{ $lim ? 'enabled' : 'disabled' }}>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <input type="date" class="form-control" wire:model="fecha2" placeholder="Fecha 2" {{ $lim2 ? 'enabled' : 'disabled' }}>
                </div>
            </div>
            <h3>REPORTE DE CONSULTAS</h1>
            @if ($consultas->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultas as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->motivo_atencion }}</td>
                            <td>{{ $per->precio }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                                <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},1)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                                <button class="btn btn-warning mr-2" wire:click="reporteunitratamiento1({{$per->id}},1)">
                                    <i class="bx bxs-show"> TRATAMIENTOS</i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral2')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $consultas->links() }}
            </div>

            <h3>REPORTE DE RECONSULTAS</h3>
            @if ($reconsultas->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reconsultas as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->motivo_atencion }}</td>
                            <td>{{ $per->precio }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                                <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},2)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                                <button class="btn btn-success mr-2" wire:click="reporteunitratamiento1({{$per->id}},2)">
                                    <i class="bx bxs-show">  TRATAMIENTOS</i>
                                </button>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral3')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $reconsultas->links() }}
            </div>

            <h3>REPORTE DE ESTUDIOS COMPLEMENTARIOS</h3>
            @if ($estudios->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudios as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->historial_estudio->nombre }}</td>
                            <td>{{ $per->precio }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                                <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},3)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral4')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $estudios->links() }}
            </div>

            <h3>REPORTE DE CIRUGIAS</h1>
            @if ($cirugias->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cirugias as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->descripcion }}</td>
                            <td>{{ $per->total }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                            <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},4)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral5')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $cirugias->links() }}
            </div>

            <h3>REPORTE DE VACUNAS</h3>
            @if ($vacunas->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacunas as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->vacuna_aplicada }}</td>
                            <td>{{ $per->precio }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                            <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},5)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral6')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $vacunas->links() }}
            </div>

            <h3>REPORTE DE DESPARASITACIONES</h3>
            @if ($desparasitaciones->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($desparasitaciones as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->precio }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                            <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},6)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral7')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $desparasitaciones->links() }}
            </div>

            <h3>REPORTE DE FARMACIAS</h3>
            @if ($farmacias->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Unidad de Medida</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($farmacias as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->farmacia_id }}</td>
                            <td>{{ $per->unidad }}</td>
                            <td>{{ intval($per->cantidad) }}</td>
                            <td>{{  number_format($per->precio, 2, '.', '')}}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                            <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},7)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral8')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $farmacias->links() }}
            </div>

            <h3>REPORTE DE INTERNACIONES</h3>
            @if ($internaciones->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($internaciones as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->intenacion_usuario->name }}</td>
                            <td>{{ $per->precio }}</td>
                            <td>{{ $per->created_at }}</td>
                            <td>
                            <button class="btn btn-primary mr-2" wire:click="reporteunicoregistro({{$per->id}},8)">
                                    <i class="bx bxs-show"> <i class="fas fa-print"> IMPRIMIR FACTURA</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('livewire.modal-reporteatencion.modalGeneral9')
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $internaciones->links() }}
            </div>

        </div>
    </div>
    @include('livewire.modal-tratamientos.modaltratamiento')
</div>

@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalatencion', function() {
            $('#modalatencion').modal('hide');
        });
        Livewire.on('abrirmodalatencion', function() {
            $('#modalatencion').modal('show');
        });
        Livewire.on('openNewTab', function(data) {
            window.open(data.url, '_blank');
        });
        Livewire.on('abrirmodaltratamiento', function() {
            $('#modaltratamiento').modal('show');
        });
        Livewire.on('cerrarmodaltratamiento', function() {
            $('#modaltratamiento').modal('hide');
        });

    });

    livewire.on('borrarproducto', id_producto => {
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
                livewire.emit('Eliminarproducto', id_producto);
                Swal.fire(
                    'Eliminado!',
                    'La especie ha sido eliminado..',
                    'Exitosamente'
                )
            } else {
                Swal.fire({
                    title: 'Su registro de especie esta seguro...',
                    icon: 'info',
                })
            }
        })
    });
</script>
<script>
    Livewire.on('openNewTab', function(data) {
        window.open(data.url, '_blank');
    });
</script>
@endpush