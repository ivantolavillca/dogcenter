<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE MASCOTAS</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Mascotas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <div class="mb-3 row">
            <div class="">
                <hr>

                <div class="row g-3">
                    <div class="col-md-6">
                        <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modalcrearespecie">
                            <i class="bx bxs-plus-circle"></i> AGREGAR ESPECIE
                        </button>
                    </div>
                    <div class="col-md-1"> <!-- mt-2 para ajustar la margen superior -->
                        <a href="{{ route('mascotas') }}" class="btn btn-dark col-md-12 text-white text-uppercase d-flex align-items-center justify-content-end">
                            <i class="bx bx-arrow-back me-2"></i>
                            Atrás
                        </a>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <label for="gestiones" class="form-label">Buscar Especie: </label>
                    <input type="text" class="form-control" wire:model="searchEspecie">
                </div>
                <hr>
                @if ($especies->count() > 0)
                <div class="row g-3 col-md-12">
                    @foreach ($especies as $especie)
                    <div class="col-md-6">
                        <div class="card radius-10 border-start border-1 border-5 border-info " style="border-width: 1px 1px 1px 7px;">
                            <div class="card-header">
                                <div class="float-start bg-info text-white m-0 p-1"><b>N {{$especie->id}}</b></div>
                                <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                    ESPECIE
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center row g-3">
                                    <ul class="list-group col-md-7 border-2">
                                        <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                            <div>
                                                <i class="fs-6 bx bxs-home"></i> <b> NOMBRE DE LA ESPECIE</b> <br>
                                                <span class="d-block text-center text-secondary">
                                                    <b>{{ $especie->nombre }} </b>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-0 text-secondary">ESTADO</p>
                                                @if($especie->estado=='activo')
                                                <button class="btn btn-sm btn-success" wire:click="CambiarEstadoespecie({{$especie->id}})">
                                                    ACTIVO
                                                </button>
                                                @elseif($especie->estado=='inactivo')
                                                <button class="btn btn-sm btn-danger" wire:click="CambiarEstadoespecie({{$especie->id}})">
                                                    INACTIVO
                                                </button>
                                                @endif
                                            </div>
                                            <div class="col-md-6 border-start border-0 border-2">
                                                <p class="mb-0 text-secondary">ACCIÓN</p>
                                                <button class="btn btn-danger" wire:click.prevent="$emit('borrarespecie', {{ $especie->id }})"><i class="bx bxs-trash"></i></button>
                                                <button class="btn btn-warning" wire:click="editarespeciemas({{$especie->id}})"><i class="bx bx-pencil"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-12 ">
                                            <p class="mb-0 text-secondary">FECHA DE CREACIÓN</p>
                                            <h6 class="my-1"><i class="bx "></i>
                                                {{ $especie->created_at }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach
                </div>

                @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
                @endif
                <div class="d-flex justify-content-center">
                    {{ $especies->links() }}
                </div>
            </div>


        </div>
    </div>
    @include('livewire.modal-mascota.modalcrearespecie')
    @include('livewire.modal-mascota.modaleditarespecie')
</div>
@push('navi-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalcrearespecie', function() {
            $('#modalcrearespecie').modal('hide');
        });
        Livewire.on('abrirmodaleditarespecie', function() {
            $('#modaleditarespecie').modal('show');
        });
        Livewire.on('cerrarmodaleditaespecie', function() {
            $('#modaleditarespecie').modal('hide');
        });

    });

    livewire.on('borrarespecie', id_especie => {
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
                livewire.emit('eliminarespecie', id_especie);
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