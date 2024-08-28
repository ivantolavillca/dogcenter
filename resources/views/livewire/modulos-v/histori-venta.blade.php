<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">PRODUCTO # {{ $idpro }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-12 mt-3">
            <label for="gestiones" class="form-label">Buscar Ventas: </label>
            <input type="text" class="form-control" wire:model="searchcompra">
        </div>
    </div>
    @if ($ventas->count() > 0)
    <div class="table-responsive">
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">PRODUCTO</th>
                    <th scope="col">CLIENTE </th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">ACCIONES</th>
                    <th scope="col">Fecha de Creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $prod)
                <tr>
                    <td>{{ $prod->id }}</td>
                    <td>{{ $prod->produc_ventas->nombre }}</td>
                    @if(isset($prod->cliente_ventas->nombre))
                        <td>{{ $prod->cliente_ventas->nombre }}</td>
                    @else
                        <td>Sin datos del cliente</td>
                    @endif
                    <td>{{ $prod->descripcion }}</td>
                    <td>{{ $prod->cantidad }}</td>
                    <td>{{ $prod->precio }}</td>
                    <td>
                    <button class="btn btn-danger" wire:click.prevent="$emit('borrarhisto', {{ $prod->id }})"><i class="bx bxs-trash"></i></button>
                    <button class="btn btn-warning" wire:click="editarhistory({{$prod->id}})"><i class="bx bx-pencil"></i></button>
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

    livewire.on('borrarhisto', id_historial => {
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
                livewire.emit('EliminarVentaHistorial', id_historial);
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