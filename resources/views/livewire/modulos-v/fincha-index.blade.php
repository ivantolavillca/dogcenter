<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">ADMINISTRACIÓN DE FICHAS</h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info"
                                href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">CASOS DE ATENCIONES</li>
                    </ol>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <hr>
                    <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#Idmodalficha">
                        <i class="bx bxs-plus-circle"></i> CREAR FICHA
                    </button>
                    <hr>
                    <a href="{{ route('reportesatencion') }}" class="btn btn-warning col-md-12">
                        <i class="bx bxs-plus-circle"></i> GENERAR REPORTES DE ATENCION
                    </a>

                    <hr>
                    <div class="col-12 mt-3">
                        <label for="gestiones" class="form-label">Buscar ficha: </label>
                        <input type="text" class="form-control" wire:model="SearchFicha">
                    </div>
                </div>
            </div>

            @if ($fichas->count() > 0)

                <div class="row">
                    @foreach ($fichas as $ficha)
                        <div class="col-md-3 mb-4 ">
                            <div class="card mb-4 ficha-clinica"
                                style="border: 4px solid #28a745; border-radius: 30px;">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('imprimirfichas', ['id' => $ficha->id]) }}"
                                        class="btn btn-dark ficha-clinica rounded-pill" target="_blank">
                                        <i class="fas fa-print"></i> Imprimir
                                    </a>
                                </div>

                                <div class="card-body ">
                                    @if ($ficha->id_cliente)
                                        <h5 class="card-title">Cliente:{{ $ficha->nombre_cli }}</h5>
                                    @else
                                        <h5 class="card-title">SIN CLIENTE</h5>
                                    @endif

                                    @if ($ficha->id_usuario)
                                        <p class="card-text">Doctor: {{ $ficha->usuario }}</p>
                                    @else
                                        <p class="card-text">SIN USUARIO </p>
                                    @endif
                                    <div class="d-flex align-items-start">
                                        <div class="cuba mt-2 rounded-circle d-flex justify-content-center align-items-center"
                                            style="width: 120px; height: 120px; font-size: 36px; background-color: #218838; color: white;">
                                            Nº {{ $ficha->numeracion }}
                                        </div>
                                        <div class="d-flex justify-content-end">

                                            @if ($ficha->estado == 'activo')
                                                <div class="col-auto">
                                                    <button class="btn btn-success"
                                                        wire:click.prevent="$emit('llamar', {{ $ficha->id }})"> <i
                                                            class="bi bi-telephone-inbound"></i> LLAMAR</button>
                                                </div>
                                            @elseif($ficha->estado == 'llamar')
                                                <div class="col-auto">
                                                    <button class="btn btn-danger"
                                                        wire:click.prevent="$emit('llamar', {{ $ficha->id }})"> <i
                                                            class="bi bi-telephone-inbound"></i> COLGAR</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-center">
                                        <div class="col-auto">
                                            <button class="btn btn-success"
                                                wire:click.prevent="$emit('Atender', {{ $ficha->id }})">ATENDER</button>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-danger"
                                                wire:click.prevent="$emit('borrardatos', {{ $ficha->id }})"><i
                                                    class="bx bxs-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-3 border-gray-200 text-sm">
                    <strong>No hay Registros</strong>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-center">
            {{ $fichas->links() }}
        </div>
    </div>
    @include('livewire.modal-fichasC.modaldefichas')
    @include('livewire.modal-lupa.modallupa')
    @include('livewire.modal-lupa.modallupa2')
</div>

</div>
@push('molqui-js')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('AbrirmodalFicha', function() {
                $('#Idmodalficha').modal('show');
            });
            Livewire.on('cerrarmodalFicha', function() {
                $('#Idmodalficha').modal('hide');
            });
            Livewire.on('IDmodlupacerrar', function() {
                $('#IDmodlupa').modal('hide');
            });
            Livewire.on('abrirlupaID', function() {
                $('#IDmodlupa').modal('show');
            });
            Livewire.on('IDmodlupacerrar2', function() {
                $('#IDmodlupa2').modal('hide');
            });
            Livewire.on('abrirlupaID2', function() {
                $('#IDmodlupa2').modal('show');
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
                    livewire.emit('EliminarFicha', id_registro);
                    Swal.fire(
                        'Eliminado!',
                        'La ficha ha sido eliminado..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su ficha esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });

        livewire.on('Atender', id_registro => {
            Swal.fire({
                title: 'Esta seguro/segura ?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, Atender!'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('AtenderFicha', id_registro);
                    Swal.fire(
                        'Atendido!',
                        'Ficha Atendida..',
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Su ficha esta seguro...',
                        icon: 'info',
                    })
                }
            })
        });
        livewire.on('llamar', id_registro => {
            Swal.fire({
                title: 'Esta seguro/segura ?',
                text: "De Llamar ò Colgar!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡ Sí !'
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emit('LlamarFicha', id_registro);
                    Swal.fire(
                        'Exitosamente'
                    )
                } else {
                    Swal.fire({
                        title: 'Accion Cancelada',
                        icon: 'info',
                    })
                }
            })
        });
    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Tu script personalizado aquí
        var pusher = new Pusher('3bf7b75968a09e8cf22a', {
            cluster: 'sa1'
        });

        var channel = pusher.subscribe('ficha-channel');
        channel.bind('ficha-event', function(data) {
            window.livewire.emit('fichaActualizada');
        });
    </script>
@endpush
