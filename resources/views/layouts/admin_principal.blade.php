<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>DOG CENTER - VETERINARIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistema Si@di" name="description" />
    <meta content="ITV" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('naviassets/logo.jpeg') }}">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('assets/dashboard/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
      <link href="{{ asset('assets/dashboard/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('assets/dashboard/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
      <link href="{{ asset('assets/dashboard/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/alertas/sweetalert2.min.css') }}">
    <link href="{{ asset('assets/dashboard/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


    @stack('style-custom.css')

    @livewireStyles
    @livewireScripts
    @vite(['resources/js/app.js'])
</head>

<body data-layout="detached" data-topbar="colored">

    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">


            @include('layouts.header')
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div class="h-100">

                    <div class="user-wid text-center py-4">
                        <div class="user-img">
                            @if ( Auth::user()->profile_photo_path)
                            <img src="{{ Auth::user()->profile_photo_path }}" alt="" class="avatar-md mx-auto rounded-circle">
                            @else
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="" class="avatar-md mx-auto rounded-circle">
                            @endif

                        </div>

                        <div class="mt-3">

                            <a class="text-reset fw-medium font-size-16"> {{ Auth::user()->name }}
                                {{ Auth::user()->paterno }} {{ Auth::user()->materno }}</a>
                            <p class="text-muted mt-1 mb-0 font-size-13"> {{ Auth::user()->roles[0]->name }} </p>

                        </div>
                    </div>

                    <!--- Sidemenu -->
                    @include('layouts.slider')
                    <!-- Sidebar -->
                </div>
            </div>
            <div class="main-content">
                <div class="page-content">

                    @yield('body')

                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © By Dev. Ivan T. - <a href="https://www.gcod.dev/" target="_blank" style="color:var(--bs-footer-color)">Javi</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    NV SOFT
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body rightbar">
            <div class="right-bar">
                <div data-simplebar class="h-100">
                    <div class="rightbar-title px-3 py-4">
                        <a href="javascript:void(0);" class="right-bar-toggle float-end" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="mdi mdi-close noti-icon"></i>
                        </a>
                        <h5 class="m-0">Configuracion Tema</h5>
                    </div>

                    <!-- Settings -->
                    <hr class="mt-0" />
                    <h6 class="text-center mb-0">Temas</h6>

                    <div class="p-4">
                        <div class="mb-2">
                            <img src="{{ asset('assets/dashboard/assets/images/layouts/layout-1.jpg') }}" class="img-fluid img-thumbnail" alt="">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch"  />
                            <label class="form-check-label" for="light-mode-switch">Modo Ligero</label>
                        </div>

                        <div class="mb-2">
                            <img src="{{ asset('assets/dashboard/assets/images/layouts/layout-2.jpg') }}" class="img-fluid img-thumbnail" alt="">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch" checked/>
                            <label class="form-check-label" for="dark-mode-switch">Modo Oscuro</label>
                        </div>

                        <div class="mb-2">
                            <img src="{{ asset('assets/dashboard/assets/images/layouts/layout-3.jpg') }}" class="img-fluid img-thumbnail" alt="">
                        </div>
                        <div class="form-check form-switch mb-5">
                            <input type="checkbox" class="form-check-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                            <label class="form-check-label" for="rtl-mode-switch">Modo RTL</label>
                        </div>

                    </div>

                </div>
                <!-- end slimscroll-menu-->
            </div>
        </div>

    </div>


    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/dashboard/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- apexcharts -->
     <script src="{{ asset('assets/dashboard/assets/libs/apexcharts/apexcharts.min.js') }}"></script> 
    <script src="{{ asset('assets/libs/apexcharts-bundle/dist/apexcharts.min.js') }}"></script>

    <script async src="https://docs.opencv.org/4.9.0/opencv.js"></script>
    {{-- <script src="{{ asset('assets/dashboard/assets/js/pages/dashboard.init.js')}}"></script>
    --}}
    <script src="{{ asset('assets/dashboard/assets/libs/select2/js/select2.min.js')}}"></script>

    <script src="{{ asset('assets/dashboard/assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/alertas/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

<!-- form advanced init -->
<script src="{{ asset('assets/dashboard/assets/js/pages/form-advanced.init.js')}}"></script>
 <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('alert', function(message) {
                Swal.fire(
                    'Guardado con exito!',
                    message,
                    'success'
                )
            })
            Livewire.on('alerterror', function(message) {
                Swal.fire({
                    title: '¡Error!',
                    text: message,
                    icon: 'error',
                    customClass: {
                        icon: 'fa-3x' // Clase de Font Awesome para el tamaño del icono (por ejemplo, 'fa-3x' para 3 veces el tamaño normal)
                    }
                });
            });
            Livewire.on('errorvalidate', function(message) {
                Swal.fire(
                    'Error!',
                    message,
                    'error'
                )
            })
            Livewire.on('vacio', function(message) {
                Swal.fire(
                    'Asignatura vacio',
                    message,
                    'error'
                )
            })
            Livewire.on('alerta_gary', function(title, message, tipo) {
                Swal.fire(
                    title,
                    message,
                    tipo
                )
            })

            livewire.on('deshabilitarRuedasMouse', (lista_class) => {
                const inputsNotas = document.querySelectorAll(lista_class);
                inputsNotas.forEach(function(input) {
                    input.addEventListener('wheel', function(e) {
                        e.preventDefault();
                    });
                });
            });
        });
    </script>
    @stack('navi-js')
    @stack('molqui-js')
</body>

</html>
