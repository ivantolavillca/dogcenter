<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">REPORTES DE ATENCION A CLIENTES </h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">Reporte de Atencion</li>
                    </ol>
                </div>
            </div>
            <div class="mb-3 row">
                <!-- Columna para Agregar Especie y su búsqueda -->

                <div class="col-md-6">
                    <hr>
                    <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modalproveedor">
                        <i class="bx bxs-plus-circle"></i> AGREGAR PROVEEDOR
                    </button>
                    <hr>
                    <div class="col-12 mt-3">
                        <label for="gestiones" class="form-label">Buscar Personal: </label>
                        <input type="text" class="form-control" wire:model="search">
                    </div>
                </div>
            </div>

            @if ($Personales->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del Trabajador</th>
                            <th scope="col">Correo del Trabajador</th>
                            <th scope="col">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Personales as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->name }}</td>
                            <td>{{ $per->email }}</td>
                            <td>
                                <button class="btn btn-primary mr-2" wire:click="openModalVentas({{$per->id}})">
                                    <i class="bx bxs-show"> <i class="fas fa-print">  Gernerar Reporte</i></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $Personales->links() }}
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif


        </div>
    </div>
    @include('livewire.modal-reporteatencion.modalreporte')
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
        Livewire.on('openNewTab', function (data) {
            window.open(data.url, '_blank');
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
        Livewire.on('openNewTab', function (data) {
            window.open(data.url, '_blank');
        });
    </script>
@endpush