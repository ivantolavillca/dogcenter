<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE IMAGENOLOGIAS</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">imagenologias</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <!-- Columna para Agregar Especie y su búsqueda -->

        <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modalcrearimagenologia">
            <i class="bx bxs-plus-circle"></i> AGREGAR IMAGENOLOGIAS
        </button>

        <div class="col-12 mt-3">
            <label for="gestiones" class="form-label">Buscar imagenologias: </label>
            <input type="text" class="form-control" wire:model="searchimagen">
        </div>
        <br>

        @if ($tiposimagenes->count() > 0)
        <div class="table-responsive">
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre de la Imagen</th>
                        <th scope="col">Estado del Registro</th>
                        <th scope="col">Acción</th>
                        <th scope="col">Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tiposimagenes as $imagen)
                    <tr>
                        <td>{{ $imagen->id }}</td>
                        <td>{{ $imagen->nombre }}</td>
                        <td>
                            <button class="btn btn-sm btn-success"> activo/inactivo</button>
                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click.prevent="$emit('borratiposimagen', {{ $imagen->id }})">
                                <i class="bx bxs-trash"></i>
                            </button>
                            <button class="btn btn-warning" wire:click="editartiposimagen({{$imagen->id}})">
                                <i class="bx bx-pencil"></i>
                            </button>
                        </td>
                        <td>{{ $imagen->created_at }}</td>
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
            {{ $tiposimagenes->links() }}
        </div>
    </div>
    @include('livewire.modal-imagenologia.modalcrearimagenologia')
</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalImagenologia', function() {
            $('#modalcrearimagenologia').modal('hide');
        });
        Livewire.on('abrirmodalcreaimg', function() {
            $('#modalcrearimagenologia').modal('show');
        });
    });

    livewire.on('borratiposimagen', id_tipoimgen => {
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
                livewire.emit('eliminarespecie', id_tipoimgen);
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