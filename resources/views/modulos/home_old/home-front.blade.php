<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI@DI</title>
    <link rel="stylesheet" href="{{ asset('assets/risebothtml/app/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/risebothtml/app/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/risebothtml/app/dist/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/risebothtml/assets/font/font-awesome.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ $intitucion->intitucion_url_logo }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/risebothtml/assets/images/favicon.png') }}">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/risebothtml/app/dist/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/risebothtml/assets/font/risebot.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/alertas/sweetalert2.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('navi-css-front')
    @livewireStyles
    @livewireScripts
</head>

<body class="header-fixed main home1 counter-scroll">
    <!-- preloade -->
    <div class="preloader">
        <div class="clear-loading loading-effect-2">
            <span></span>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <!-- Header -->
        <header id="header_main" class="header"
            style="background: #56CCF2;  /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #56CCF2, #0b51ac);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #56CCF2, #0b51ac); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


">
            <div class="container">
                <div id="site-header-inner">
                    <div >
                        <a href="/"><img src="{{ $intitucion->intitucion_url_logo }}" class="image"></a>
                    </div>
                    <nav id="main-nav" class="main-nav">
                        @include('modulos.home_old.slider-home-front')
                    </nav><!-- /#main-nav -->
                    <a href="#" data-toggle="modal" data-target="#loginmodal" class="tf-button btn btn-danger">
                        ACCEDER
                    </a>

                    <div class="mobile-button"><span></span></div><!-- /.mobile-button -->
                </div>
            </div>
        </header>


        @yield('body-page-old')



        <footer id="footer">
            <div class="footer-main">
                <div class="container">
                    <div class="row">
                        <div class="footer-logo d-flex justify-content-center flex-column">
                            <div class="logo_footer w-50" style="margin-left: auto; margin-right: auto;">
                                <img src="{{ $intitucion->intitucion_url_banner2 }}" alt="logo siadi" width="100%"
                                    class="">
                            </div>
                            <p class="text-center"> {{ $intitucion->intitucion_nombre }}</p>
                        </div>
                        <div class="widget">
                            <h5 class="widget-title">
                                Contactenos
                            </h5>
                            <ul class="widget-link contact">
                                <li>
                                    <p>Dirección</p>
                                    <a href="#">Complejo Avenida Villa Bolivar B, 591</a>
                                </li>
                                <li>
                                    <p>Teléfono</p>
                                    <a href="#">+591 74002216</a>
                                </li>
                                {{-- <li class="email">
                                    <p>Email</p>
                                    <a href="#">risebot@support.com</a>
                                </li> --}}
                            </ul>
                        </div>

                        {{-- 
                        <!-- revisar -->
                        <div class="widget support">
                            <h5 class="widget-title">
                                Support
                            </h5>
                            <ul class="widget-link">
                                <li>
                                    <a href="connect-wallet.html">Connect Wallet</a>
                                </li>
                                <li>
                                    <a href="forget-password.html">Forget Password</a>
                                </li>
                                <li>
                                    <a href="faq.html">FAQs</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                        --}}
                        <div class="widget link">
                            <h5 class="widget-title">
                                Enlaces Rápidos
                            </h5>
                            <ul class="widget-link">
                                <li>
                                    <a href="/">Inicio</a>
                                </li>
                                <li>
                                    <a href="{{ route('verificar.index') }}">Verificar Certificado</a>
                                </li>
                                <li>
                                    <a href="https://www.upea.bo/" target="_blank">UPEA</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget link">
                            <h5 class="widget-title">
                                Desarrollo
                            </h5>
                            <ul class="widget-link">
                                <li>
                                    <button type="button" data-toggle="modal" data-target="#modalAboutMe" class=" btn text-white ">Acerca de</button>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <!-- <div class="Copyright text-center">Departamento de Idiomas - Universidad Pública de El Alto</div> -->

                    <div class="wrap-fx">
                        <div class="Copyright">
                            Departamento de Idiomas - Universidad Pública de El Alto <!-- <a
                                href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> -->
                        </div>
                        <ul class="social">
                            <li>
                                <a href="{{ $intitucion->intitucion_url_facebook }}" target="blank">
                                    <svg width="13" height="22" viewBox="0 0 13 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.20381 22V11.9655H11.5706L12.0757 8.05372H8.20381V5.55662C8.20381 4.42442 8.51692 3.65284 10.1423 3.65284L12.212 3.65199V0.153153C11.8541 0.10664 10.6255 0 9.19548 0C6.20942 0 4.16511 1.82266 4.16511 5.1692V8.05372H0.788086V11.9655H4.16511V22H8.20381Z"
                                            fill="#798DA3" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $intitucion->intitucion_url_twitter }}" target="blank">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_157_2529)">
                                            <path
                                                d="M18 3.41887C17.3306 3.7125 16.6174 3.90712 15.8737 4.00162C16.6388 3.54487 17.2226 2.82712 17.4971 1.962C16.7839 2.38725 15.9964 2.68763 15.1571 2.85525C14.4799 2.13413 13.5146 1.6875 12.4616 1.6875C10.4186 1.6875 8.77387 3.34575 8.77387 5.37863C8.77387 5.67113 8.79862 5.95237 8.85938 6.22012C5.7915 6.0705 3.07687 4.60013 1.25325 2.36025C0.934875 2.91263 0.748125 3.54488 0.748125 4.2255C0.748125 5.5035 1.40625 6.63637 2.38725 7.29225C1.79437 7.281 1.21275 7.10888 0.72 6.83775C0.72 6.849 0.72 6.86363 0.72 6.87825C0.72 8.6715 1.99912 10.161 3.6765 10.5041C3.37612 10.5863 3.04875 10.6256 2.709 10.6256C2.47275 10.6256 2.23425 10.6121 2.01038 10.5626C2.4885 12.024 3.84525 13.0984 5.4585 13.1332C4.203 14.1154 2.60888 14.7071 0.883125 14.7071C0.5805 14.7071 0.29025 14.6936 0 14.6565C1.63462 15.7106 3.57188 16.3125 5.661 16.3125C12.4515 16.3125 16.164 10.6875 16.164 5.81175C16.164 5.64862 16.1584 5.49113 16.1505 5.33475C16.8829 4.815 17.4982 4.16587 18 3.41887Z"
                                                fill="#798DA3" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_157_2529">
                                                <rect width="18" height="18" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </a>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.4377 0H13.2325L6.98535 10.9429L11.0106 18H15.2159L11.1906 10.9429L17.4377 0Z"
                                            fill="#798DA3" />
                                        <path
                                            d="M5.24588 3.375H1.28138L3.57525 7.41488L0.5625 12.375H4.527L7.53975 7.41488L5.24588 3.375Z"
                                            fill="#798DA3" />
                                    </svg>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9 0.199951C6.684 0.199951 4.8 2.08395 4.8 4.39995V11.6C4.8 11.93 4.5312 12.2 4.2 12.2C3.8688 12.2 3.6 11.93 3.6 11.6V8.59995H0V11.6C0 13.916 1.884 15.8 4.2 15.8C6.516 15.8 8.4 13.916 8.4 11.6V4.39995C8.4 4.06875 8.6688 3.79995 9 3.79995C9.3312 3.79995 9.6 4.06875 9.6 4.39995V6.67875L11.4 7.87875L13.2 6.67875V4.39995C13.2 2.08395 11.316 0.199951 9 0.199951Z"
                                            fill="#798DA3" />
                                        <path
                                            d="M14.4001 8.59989V11.5999C14.4001 11.9299 14.1301 12.1999 13.8001 12.1999C13.4701 12.1999 13.2001 11.9299 13.2001 11.5999V8.12109L11.7325 9.09909C11.6317 9.16629 11.5165 9.19989 11.4001 9.19989C11.2837 9.19989 11.1685 9.16629 11.0677 9.09909L9.6001 8.12109V11.5999C9.6001 13.9159 11.4841 15.7999 13.8001 15.7999C16.1161 15.7999 18.0001 13.9159 18.0001 11.5999V8.59989H14.4001Z"
                                            fill="#798DA3" />
                                    </svg>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.3836 5.00756C10.3836 3.73634 10.8716 3.0748 11.5606 3.0748C12.2169 3.0748 12.654 3.6686 12.654 4.87208C12.654 5.5569 12.472 6.30736 12.3376 6.75085C12.3386 6.75191 12.9917 7.90035 14.7784 7.54788C15.1573 6.69899 15.3637 5.59924 15.3637 4.63498C15.3637 2.04068 14.0512 0.531311 11.6464 0.531311C9.17275 0.531311 7.72689 2.44819 7.72689 4.97475C7.72689 7.47802 8.88803 9.62776 10.8017 10.6068C9.9973 12.2295 8.9727 13.6595 7.90471 14.737C5.96772 12.3745 4.21596 9.22449 3.4962 3.07586H0.63623C1.9572 13.3165 5.89363 16.5766 6.9341 17.2032C7.5226 17.5599 8.03067 17.543 8.56837 17.2371C9.41302 16.7523 11.9512 14.195 13.3569 11.1985C13.9464 11.1964 14.6556 11.1287 15.3627 10.9667V8.95034C14.9297 9.0509 14.5117 9.09535 14.1348 9.09535C12.0147 9.09535 10.3836 7.60292 10.3836 5.00756Z"
                                            fill="#798DA3" />
                                    </svg>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.2235 4.99088C15.0649 4.938 14.9119 4.88737 14.7656 4.839C13.6451 4.47337 12.9701 4.25175 12.9701 3.34612C12.9701 2.6115 13.5157 2.07937 14.2673 2.07937C14.8433 2.07937 15.273 2.328 15.6578 2.88825C15.6938 2.94 15.7624 2.95913 15.8175 2.92875L16.9481 2.32912C16.9785 2.31337 17.0021 2.28525 17.0111 2.25037C17.0201 2.2155 17.0168 2.1795 17.001 2.148C16.3946 1.02975 15.5216 0.486375 14.3302 0.486375C12.5179 0.486375 11.3456 1.626 11.3456 3.38888C11.3456 5.19112 12.4796 5.92125 14.5699 6.63562C15.7804 7.05525 16.317 7.27687 16.317 8.17237C16.317 9.17925 15.4429 9.90263 14.2504 9.85987C13.0005 9.816 12.6225 9.12862 12.1466 8.00138C11.3411 6.09225 10.4242 3.86475 10.4164 3.84338C9.49725 1.63838 7.67362 0.375 5.4135 0.375C2.42887 0.375 0 2.89838 0 6.00113C0 9.10163 2.42887 11.625 5.4135 11.625C7.04137 11.625 8.568 10.8757 9.60075 9.56737C9.63 9.52912 9.63788 9.47738 9.61875 9.43237L8.937 7.79663C8.91787 7.75163 8.874 7.72013 8.82562 7.71788C8.77612 7.71563 8.73225 7.74375 8.70975 7.78762C8.06513 9.06675 6.80175 9.861 5.4135 9.861C3.36487 9.861 1.69875 8.12962 1.69875 6C1.69875 3.87037 3.36487 2.139 5.4135 2.139C6.90525 2.139 8.271 3.05813 8.81437 4.43062L10.503 8.43L10.6976 8.87887C11.4604 10.725 12.582 11.553 14.3381 11.5598C16.4261 11.5598 18 10.122 18 8.21625C18 6.30488 16.9819 5.58713 15.2235 4.99088Z"
                                            fill="#798DA3" />
                                    </svg>

                                </a>
                            </li> -->
                        </ul>
                    </div>

                </div>

            </div>
        </footer>
        @include('modulos.home_guest.acerca_desarrollo')
        @livewire('landig-page.preinscripcion-index')

        
    </div>
    <a id="scroll-top"></a>

    <script src="{{ asset('assets/risebothtml/app/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/risebothtml/app/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/risebothtml/app/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/risebothtml/app/app_home.js') }}"></script> <!-- 'assets/risebothtml/app/js/app.js' -->
    <script src="{{ asset('assets/risebothtml/app/js/jquery.easing.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/risebothtml/app/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/risebothtml/app/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/risebothtml/app/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/risebothtml/app/js/count-down.js') }}"></script>
    <script src="{{ asset('assets/risebothtml/app/js/countto.js') }}"></script>
    {{-- <script src="{{ asset('assets/risebothtml/app/js/chart.js') }}"></script> --}}
    <script src="{{ asset('assets/alertas/sweetalert2.all.min.js') }}"></script>
    <script>
        Livewire.on('alert', function(message) {
            Swal.fire(
                'Guardado con exito!',
                message,
                'success'
            )
        })
        Livewire.on('error', function(message) {
            Swal.fire(
                'Error!',
                message,
                'error'
            )
        })
        Livewire.on('errorvalidate', function(message) {
            Swal.fire(
                'Error!',
                message,
                'error'
            )
        })
    </script>
    @stack('navi-js-front')
</body>

</html>
