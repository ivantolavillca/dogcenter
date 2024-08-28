<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE ESTUDIOS COMPLEMENTARIOS</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">ESTUDIOS COMPLEMENTARIOS</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="card">
            <!-- Columna para Agregar Especie y su búsqueda -->
            <hr>
            <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modalestudiocomplementario">
                <i class="bx bxs-plus-circle"></i> AGREGAR ESTUDIOS COMPLEMENTARIOS
            </button>

            <div class="col-12 mt-3">
                <label for="gestiones" class="form-label">Buscar Estudios complementarios: </label>
                <input type="text" class="form-control" wire:model="searchEstudio">
            </div>
            <br>


            @if ($Estudiocomp->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del estudio complementario </th>
                            <th scope="col">Descripcion del estudio complementario</th>
                            <th scope="col">Estado del registro</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Estudiocomp as $estucomple)
                        <tr>
                            <td>{{ $estucomple->id }}</td>
                            <td>{{ $estucomple->nombre }}</td>
                            <td>{{ $estucomple->descripcion }}</td>


                            <td>
                                @if($estucomple->estado=='activo')
                                <button class="btn btn-sm btn-success" wire:click="CambiarEstado({{$estucomple->id}})">
                                    ACTIVO
                                </button>
                                @elseif($estucomple->estado=='inactivo')
                                <button class="btn btn-sm btn-danger" wire:click="CambiarEstado({{$estucomple->id}})">
                                    INACTIVO
                                </button>
                                @endif
                            </td>
                            <td>
                                @if($estucomple->estado=='activo')
                                <button class="btn btn-danger" wire:click.prevent="$emit('borrarEstudicomple', {{ $estucomple->id }})">
                                    <i class="bx bxs-trash"></i>
                                </button>
                                <button class="btn btn-warning" wire:click="EditarEstudioComplee({{$estucomple->id}})">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                @elseif($estucomple->estado=='inactivo')
                                <p>Sin acciones</p>
                                @endif

                            </td>
                            <td>{{ $estucomple->created_at }}</td>
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
                {{ $Estudiocomp->links() }}
            </div>

            @include('livewire.modal-estudiocomplemetario.modalestudiocomplementario')
        </div>

    </div>



</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalEstudioComple', function() {
            $('#modalestudiocomplementario').modal('hide');
        });
        Livewire.on('abrirmodalEstudio', function() {
            $('#modalestudiocomplementario').modal('show');
        });
    });

    livewire.on('borrarEstudicomple', id_estudio => {
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
                livewire.emit('Eliminarestudiocomple', id_estudio);
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