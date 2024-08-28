<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">ADMINISTRACIÓN DE CIRUGIAS </h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">Cirugias</li>
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('clientes') }}">Clientes</a></li>
                    </ol>
                </div>
            </div>
            <div class="mb-3 row">
                <!-- Columna para Agregar Especie y su búsqueda -->

                <div class="col-md-6">
                    <hr>
                    <button class="btn btn-info col-md-12" wire:click="cargardatoscirugia">
                        <i class="bx bxs-plus-circle"></i> CREAR CIRUGIA PARA "{{ $registro_completo->nombre}}"
                    </button>
                    <hr>
                    <div class="col-12 mt-3">
                        <label for="gestiones" class="form-label">Buscar prveedor: </label>
                        <input type="text" class="form-control" wire:model="search">
                    </div>
                </div>
            </div>

            @if ($cirugias->count() > 0)

            <div class="row g-3 col-md-12">

                @foreach ($cirugias as $ciru)
                <div class="col-md-6">
                    <div class="card radius-10 border-start border-1 border-5 border-info " style="border-width: 1px 1px 1px 7px;">
                        <div class="card-header">
                            <div class="float-start bg-info text-white m-0 p-1"><b>N {{$ciru->id}}</b></div>
                            <h4 class="my-0 text-info text-center"><i class="bx bx-male"></i>
                                CIRUGIA Nº {{$conta++}}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center row g-3">
                                <ul class="list-group col-md-7 border-2">
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home "></i> <b class="text-info"> NOMBRE DEL DUEÑO </b> <br>
                                            <span class="d-block text-center text-secondary ">
                                                <b>{{ $ciru->cirugia_mascota->mascot_clie->nombre }} </b>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home"></i> <b> CELULAR </b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $ciru->cirugia_mascota->mascot_clie->telefono }} </b>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home"></i> <b> DIRECCION </b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $ciru->cirugia_mascota->mascot_clie->domicilio  }} </b>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home"></i> <b> NOMBRE DEL PACIENTE </b> <br>
                                            <span class="d-block text-center text-secondary">
                                                <b>{{ $ciru->cirugia_mascota->nombre }} </b>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary">
                                        <div>
                                            <i class="fs-6 bx bxs-home"></i> <b class="text-info"> ESPECIE: </b> <b>{{ $ciru->cirugia_mascota->mascotas_especies->nombre }} </b> <br>
                                            <i class="fs-6 bx bxs-home"></i> <b class="text-info"> RAZA: </b> <b>{{ $ciru->cirugia_mascota->mascotas_razas->nombre }} </b> <br>
                                            <i class="fs-6 bx bxs-home"></i> <b class="text-info"> SEXO: </b> <b>{{ $ciru->cirugia_mascota->sexo }} </b> <br>
                                            <i class="fs-6 bx bxs-home"></i> <b class="text-info"> PESO: </b> <b>{{ $ciru->cirugia_mascota->peso }} </b> <br>
                                            <i class="fs-6 bx bxs-home"></i> <b class="text-info"> EDAD: </b> <b>{{ $ciru->cirugia_mascota->edad_mascota }} </b> <br>
                                        </div>
                                    </li>
                                </ul>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div>
                                            <i class="fs-6 bx bxs-home"></i> <b class="text-info"> DESCRIPCION DE LA CIRUGIA</b> <br>
                                            {{ $ciru->descripcion }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <p class="mb-0 text-secondary">ESTADO</p>
                                            @if($ciru->estado=='activo')
                                            <button class="btn btn-sm btn-success" wire:click="CambiarEstadoraza({{ $ciru->id }})">
                                                ACTIVO
                                            </button>
                                            @elseif($ciru->estado=='inactivo')
                                            <button class="btn btn-sm btn-danger" wire:click="CambiarEstadoraza({{ $ciru->id }})">
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
                                            <button class="btn btn-danger" wire:click.prevent="$emit('borrarraza', {{  $ciru->id  }})"><i class="bx bxs-trash"></i></button>
                                            <button class="btn btn-warning" wire:click="editarazasmas({{ $ciru->id }})"><i class="bx bx-pencil"></i></button>

                                        </div>

                                    </div>
                                    <hr>
                                    <div class="col-md-12 ">
                                        <p class="mb-0 text-secondary">FECHA DE CREACIÓN</p>
                                        <h6 class="my-1"><i class="bx "></i>
                                            {{$ciru->created_at}}
                                        </h6>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 ">
                                        <div class="col-md-12">
                                            <p class="mb-0 text-secondary text-info">ACCIONES DE CIRUGIA</p>
                                        </div>
                                        <div wire:ignore>
                                                <livewire:modulos-v.cirujia-pre :ciruId="$ciru->id" :id_mascota="$id_mascota" />
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <button class="btn btn-sm btn-primary" wire:click="CambiarEstadoraza({{ $ciru->id }})">TRANS-OPERATORIO</button>

                                        </div>

                                        <div class="col-md-8 mb-2">
                                            <button class="btn btn-sm btn-warning" wire:click="CambiarEstadoraza({{ $ciru->id }})">POST-OPERATORIOIVO</button>
                                        </div>

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
                {{ $cirugias->links() }}
            </div>

        </div>
    </div>
    @include('livewire.modal-cirugia.modalcirugiapre')
</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalcirugia', function() {
            $('#modalcirugia').modal('hide');
        });
        Livewire.on('abrirmodalcirugia', function() {
            $('#modalcirugia').modal('show');
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