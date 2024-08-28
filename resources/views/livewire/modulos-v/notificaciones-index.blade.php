<div>
    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="mdi mdi-bell-outline"></i>
        <span class="badge rounded-pill bg-danger ">{{ count($fichas) }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0"> Notificaciones </h6>
                </div>

            </div>
        </div>

        <div data-simplebar>
            @foreach ($fichas as $ficha)
                <a wire:click="reporteunicoregistro({{ $ficha->ficha_mascota->mascot_clie->id }},{{ $ficha->id }})"
                    class="text-reset notification-item">
                    <div class="d-flex align-items-start">
                        <div class="avatar-xs me-3">
                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                <i class="bx bx-user"></i>
                            </span>
                        </div>
                        <div class="flex-1">
                            <h6 class="mt-0 mb-1">
                                Datos Generales
                            </h6>
                            <p class="mb-1">Cliente: {{ $ficha->ficha_mascota->mascot_clie->nombre }}
                                {{ $ficha->ficha_mascota->mascot_clie->apellidos }}</p>
                            <p class="mb-1">Mascota: {{ $ficha->ficha_mascota->nombre }}</p>
                            @if ($ficha->id_usuario)
                                <p class="mb-1 text-success">Doctor: {{ $ficha->ficha_usuario->name }}</p>
                            @endif
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">EN ESPERA - N° {{ $ficha->numeracion }}</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                    {{ $ficha->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary" wire:click="AtenderFicha({{ $ficha->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="eliminarnotificacion({{ $ficha->id }})">
                            <i class="bx bxs-trash"></i>
                        </button>

                        @if ($ficha->estado == 'activo')
                            <button class="btn btn-sm btn-success"
                                wire:click="llamarnotificacion({{ $ficha->id }})">
                                <i class="bx bxs-phone"></i>
                            </button>
                            @else($ficha->estado=='llamar')
                            <button class="btn btn-sm btn-danger" wire:click="CortarFicha({{ $ficha->id }})">
                                <i class="bx bxs-phone"> ¡Cortar llamda? </i>
                            </button>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>


        <div class="p-2 border-top d-grid">
            <a class="btn btn-sm btn-link font-size-14 " href="{{ route('fichas') }}">
                <i class="mdi mdi-arrow-right-circle me-1"></i>VER TODAS ...
            </a>
        </div>
    </div>
</div>
@push('navi-js')
    <script>
        document.addEventListener('livewire:load', function() {


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
                        livewire.emit('eliminarnotificacion', id_registro);
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

            Livewire.on('openNewTabssunic', function(data) {
                window.open(data.url, '_self');
            });

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
