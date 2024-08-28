<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">ADMINISTRACIÓN DE PROVEEDORES </h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">Proveedores</li>
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
                        <label for="gestiones" class="form-label">Buscar prveedor: </label>
                        <input type="text" class="form-control" wire:model="searchProvedor">
                    </div>
                </div>
            </div>

            @if ($proveedores->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del Proveedor</th>
                            <th scope="col">ci del Proveedor</th>
                            <th scope="col">celular del Proveedor</th>
                            <th scope="col">correo del Proveedor</th>
                            <th scope="col">NIT</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">ACCIONES</th>
                            <th scope="col">Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $pro)
                        <tr>
                            <td>{{ $pro->id }}</td>
                            <td>{{ $pro->nombre }}</td>
                            <td>{{ $pro->ci }}</td>
                            <td>{{ $pro->celular }}</td>
                            <td>{{ $pro->correo }}</td>
                            <td>{{ $pro->NIT }}</td>
                            <td>
                                @if($pro->estado=='activo')
                                <button class="btn btn-sm btn-success" wire:click="CambiarEstado({{$pro->id}})">
                                    ACTIVO
                                </button>
                                @elseif($pro->estado=='inactivo')
                                <button class="btn btn-sm btn-danger" wire:click="CambiarEstado({{$pro->id}})">
                                    INACTIVO
                                </button>
                                @endif
                            </td>
                            <td>
                                @if($pro->estado=='activo')
                                <button class="btn btn-danger" wire:click.prevent="$emit('borrarproveedor', {{ $pro->id }})"><i class="bx bxs-trash"></i></button>
                                <button class="btn btn-warning" wire:click="editarprovedor({{$pro->id}})"><i class="bx bx-pencil"></i></button>
                                @elseif($pro->estado=='inactivo')
                                <P>EL USARIO ESTA SIN ACCIONES</P>
                                @endif

                            </td>

                            <td>{{ $pro->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                {{ $proveedores->links() }}
            </div>

        </div>
    </div>
    @include('livewire.modal-proveedor.modalproveedor')
</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalproveedor', function() {
            $('#modalproveedor').modal('hide');
        });
        Livewire.on('abrirmodalprovedor', function() {
            $('#modalproveedor').modal('show');
        });
    });

    livewire.on('borrarproveedor', id_prove => {
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
                livewire.emit('EliminarProvedor', id_prove);
                Swal.fire(
                    'Eliminado!',
                    'El proveedor ha sido eliminado..',
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
@endpush