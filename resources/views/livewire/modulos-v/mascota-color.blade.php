<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE COLORES</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">COLORES DE MASCOTAS</li>
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
                        <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modalcrearraza">
                            <i class="bx bxs-plus-circle"></i> AGREGAR COLOR
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
                    <label for="gestiones" class="form-label">Buscar Color: </label>
                    <input type="text" class="form-control" wire:model="searchRaza">
                </div>
                <hr>
                @if ($razas->count() > 0)

                <div class="row g-3 col-md-12">

                    @foreach ($razas as $raza)
                    <div class="col-md-6">
                        <div class="card radius-10 border-start border-1 border-5 border-info " style="border-width: 1px 1px 1px 7px;">
                            <div class="card-header">
                                <div class="float-start bg-info text-white m-0 p-1"><b>N {{$raza->id}}</b></div>
                                <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                    COLOR
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center row g-3">
                                    <ul class="list-group col-md-7 border-2">
                                        <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                            <div>
                                                <i class="fs-6 bx bxs-home"></i> <b> NOMBRE DEL COLOR</b> <br>
                                                <span class="d-block text-center text-secondary">
                                                    <b>{{ $raza->nombre }} </b>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="mb-0 text-secondary">ESTADO</p>
                                                @if($raza->estado=='activo')
                                                <button class="btn btn-sm btn-success" wire:click="CambiarEstadoraza({{$raza->id}})">
                                                    ACTIVO
                                                </button>
                                                @elseif($raza->estado=='inactivo')
                                                <button class="btn btn-sm btn-danger" wire:click="CambiarEstadoraza({{$raza->id}})">
                                                    INACTIVO
                                                </button>
                                                @endif
                                                <div>
                                                    @if (session()->has('alertaaa'))
                                                    <div class="alert alert-success">
                                                        {{ session('alert') }}
                                                    </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-md-6 border-start border-0 border-2">
                                                <p class="mb-0 text-secondary">ACCIÓN</p>
                                                <button class="btn btn-danger" wire:click.prevent="$emit('borrarraza', {{ $raza->id }})"><i class="bx bxs-trash"></i></button>
                                                <button class="btn btn-warning" wire:click="editarazasmas({{$raza->id}})"><i class="bx bx-pencil"></i></button>

                                            </div>

                                        </div>
                                        <hr>
                                        <div class="col-md-12 ">
                                            <p class="mb-0 text-secondary">FECHA DE CREACIÓN</p>
                                            <h6 class="my-1"><i class="bx "></i>

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
                    {{ $razas->links() }}
                </div>
            </div>

        </div>
    </div>
    @include('livewire.modal-mascota.modalcrearraza')
</div>
@push('navi-js')
<script>
    document.addEventListener('livewire:load', function() {

        Livewire.on('cerrarmodalcrearraza', function() {
            $('#modalcrearraza').modal('hide');
        });
        Livewire.on('abrirmodaleditarraza', function() {
            $('#modalcrearraza').modal('show');
        });
    });

    livewire.on('borrarraza', id_raza => {
        Swal.fire({
            title: 'Esta seguro/segura ?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!'
        }).then((result2) => {
            if (result2.isConfirmed) {
                // livewire.emitTo('servidor-index', 'delete', ServidorId);
                livewire.emit('eliminarraza', id_raza);
                Swal.fire(
                    'Eliminado!',
                    'El Color ha sido eliminado..',
                    'Exitosamente'
                )
            } else {
                Swal.fire({
                    title: 'Su registro de raza esta seguro...',
                    icon: 'info',
                })
            }
        })
    });
</script>
@endpush