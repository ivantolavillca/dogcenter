<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">ADMINISTRACIÓN DE ENFERMEDADES </h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">CASOS DE ATENCION</li>
                    </ol>
                </div>
            </div>
            <div class="mb-3 row">
                <!-- Columna para Agregar Especie y su búsqueda -->

                <div class="col-md-6">
                    <hr>
                    <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modalenfermedad">
                        <i class="bx bxs-plus-circle"></i> AGREGAR CASO 
                    </button>
                    <hr>
                    <div class="col-12 mt-3">
                        <label for="gestiones" class="form-label">Buscar caso: </label>
                        <input type="text" class="form-control" wire:model="searchCaso">
                    </div>
                </div>
            </div>

            @if ($atenciones->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descripcionr</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">ACCIONES</th>
                            <th scope="col">Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($atenciones as $aten)
                        <tr>
                            <td>{{ $aten->id }}</td>
                            <td>{{ $aten->descripcion }}</td>
                            <td>
                                @if($aten->estado=='activo')
                                <button class="btn btn-sm btn-success" wire:click="CambiarEstado({{$aten->id}})">
                                    ACTIVO
                                </button>
                                @elseif($aten->estado=='inactivo')
                                <button class="btn btn-sm btn-danger" wire:click="CambiarEstado({{$aten->id}})">
                                    INACTIVO
                                </button>
                                @endif
                            </td>
                            <td>
                                @if($aten->estado=='activo')
                                <button class="btn btn-danger" wire:click.prevent="$emit('borrardatos', {{ $aten->id }})"><i class="bx bxs-trash"></i></button>
                                <button class="btn btn-warning" wire:click="editarDatos({{$aten->id}})"><i class="bx bx-pencil"></i></button>
                                @elseif($aten->estado=='inactivo')
                                <P>EL USARIO ESTA SIN ACCIONES</P>
                                @endif

                            </td>

                            <td>{{ $aten->created_at }}</td>
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
    </div>
    @include('livewire.modal-enfermedad.modalenfermedad')
</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalenfermedad', function() {
            $('#modalenfermedad').modal('hide');
        });
        Livewire.on('abrirmodalenfermedad', function() {
            $('#modalenfermedad').modal('show');
        });
    });

    livewire.on('borrardatos', id_registro => {
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
                livewire.emit('EliminarCasosAtencion', id_registro);
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