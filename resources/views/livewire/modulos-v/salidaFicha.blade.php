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
    @if ($productos->count() > 0)
    <div class="table-responsive">
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre del Producto</th>
                    <th scope="col">Descripcion del producto</th>
                    <th scope="col">COMPRAS</th>
                    <th scope="col">HISTORIAL</th>
                    <th scope="col">Fecha de Creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $prod)
                <tr>
                    <td>{{ $prod->id }}</td>
                    <td>{{ $prod->nombre }}</td>
                    <td>{{ $prod->descripcion }}</td>
                    <td>
                        <button class="btn btn-info col-md-12" wire:click="abrirModalCompra({{$prod->id}})">
                            <i class="bx bxs-plus-circle"></i> REALIZAR VENTA
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('productos3', $prod->id) }}" class="btn btn-warning">
                            <i class="bx bx-pencil"></i> MOSTRAR HISTORIAL
                        </a>
                    </td>

                    <td>{{ $prod->created_at }}</td>
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

    @include('livewire.modal-ventas.modalventa')
    </div>
    </div>
</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalcompra', function() {
            $('#modalcompra').modal('hide');
        });
        Livewire.on('abrirmodalcompra', function() {
            $('#modalcompra').modal('show');
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