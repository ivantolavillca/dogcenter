<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @livewireScripts
    <style>
        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <header>

        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="{{ route('inicio-dash.index') }}" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="me-2">
                        <path d="M4 9s-1 2 0 2h16s1-2 0-2" />
                        <path d="M9 12s-1 2 0 2h6s1-2 0-2" />
                        <path d="M7 15v4h10v-4" />
                        <circle cx="10.5" cy="8.5" r="1.5" />
                        <circle cx="13.5" cy="8.5" r="1.5" />
                    </svg>

                    <strong>INICIO</strong>
                </a>
            </div>
        </div>
    </header>
    <div class=" bg-dark " style="height: 90vh; overflow-y: auto;">
        @livewire('modulos-v.atencion-ficha')
    </div>



    <script src="{{ asset('assets/alertas/sweetalert2.all.min.js') }}"></script>
    
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('alert', function(message) {
                Swal.fire(
                    'Guardado con exito!',
                    message,
                    'success'
                )
            })
        });
    </script>
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


</body>

</html>