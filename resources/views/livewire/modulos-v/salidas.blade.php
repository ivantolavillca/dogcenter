<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">LISTA DE VENTAS DE PRODUCTOS</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Productos</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-12 mt-3">
                    <label for="gestiones" class="form-label">Buscar producto: </label>
                    <input type="text" class="form-control" wire:model="searchProducto">
                </div>
            </div>

            <div class="mb-3 row">
                <a href="" class="btn btn-success mr-2">
                    <i class="bx bxs-printer"> Generar Reporte por fecha </i>
                </a>
            </div>
            @if ($Ventas->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del Cliente</th>
                            <th scope="col">Nombre de la mascota</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Total de Venta</th>
                            <th scope="col">Fecha de Venta</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">Historial de Ventas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Ventas as $ven)
                        <tr>
                            <td>{{ $ven->id }}</td>
                            <td>{{ $ven->mascota_ventas->mascot_clie->nombre}}</td>
                            <td>{{ $ven->mascota_ventas->nombre }}</td>
                            <td>{{ $ven->descripcion }}</td>
                            <!--       <td>
                        <button class="btn btn-info col-md-12" wire:click="abrirModalCompra({{$ven->id}})">
                            <i class="bx bxs-plus-circle"></i> REALIZAR VENTA
                        </button>
                    </td> -->
                            <td>{{ $ven->total }} Bs </td>
                            <td>
                                {{ $ven->created_at }}
                            </td>
                            <td>{{ $ven->estado }}</td>
                            <td>
                                <button class="btn btn-success mr-2" wire:click="openModalVentas({{$ven->id}})">
                                    <i class="bx bxs-show"><i class="bx bx-cart"></i></i>
                                </button>
                                <a href="{{ route('imprimirVentas', ['idm' => $ven->id, 'es' => 2]) }}" class="btn btn-primary" target="_blank">
                                    <i class="bx bxs-printer"></i>
                                </a>
                            </td>
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


        </div>
        <div class="d-flex justify-content-center">
            {{ $Ventas->links() }}
        </div>
    </div>
    @include('livewire.modal-ventas.modalventa')
</div>

@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalventas', function() {
            $('#modalventa').modal('hide');
        });
        Livewire.on('abrirmodalventas', function() {
            $('#modalventa').modal('show');
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
@endpush