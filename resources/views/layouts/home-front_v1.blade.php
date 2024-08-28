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
                        <a ><img src="{{ $intitucion->intitucion_url_logo }}" class="image"></a> {{-- href="/" --}}
                    </div>
                    <nav id="main-nav" class="main-nav">
                        @include('layouts.slider-home-front')
                    </nav><!-- /#main-nav -->
                    <a href="#" data-toggle="modal" data-target="#loginmodal" class="tf-button btn btn-danger">
                        ACCEDERrrr
                    </a>

                    <div class="mobile-button"><span></span></div><!-- /.mobile-button -->
                </div>
            </div>
        </header>


        @yield('body-page')



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
                                Contáctenos
                            </h5>
                            <ul class="widget-link contact">
                                <li>
                                    <p>Dirección</p>
                                    <a href="https://maps.app.goo.gl/5s8vvUNf8veQLmAx8" target="_blank">Complejo Avenida Villa Bolivar B, 591</a>
                                </li>
                                @if(!is_null($intitucion->intitucion_url_telefono) && $intitucion->intitucion_url_telefono!=="")
                                <li>
                                    <p>Teléfono</p>
                                    <a href="tel:{{ $intitucion->intitucion_url_telefono }}">+591 {{ $intitucion->intitucion_url_telefono }}</a>
                                </li>
                                <li>
                                    <p>Desarrollo</p>
                                    <button type="button" data-toggle="modal" data-target="#modalAboutMe" class="btn text-white btn-acerca">Acerca de</button>
                                </li>
                                @endif
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
                        {{--
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
                        --}}

                        <div class="widget support">
                            <h5 class="widget-title">
                                Donde nos ubicamos
                            </h5>
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2291.2517277807237!2d-68.19391145775339!3d-16.49131636124462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915ede3378ea9d6d%3A0x26cac4a2caefcb29!2sUniversidad%20P%C3%BAblica%20de%20El%20Alto!5e0!3m2!1ses-419!2sbo!4v1621251915667!5m2!1ses-419!2sbo" frameborder="0" width="400" height="300" style="border:0;"></iframe> -->
                                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d239.10556576068632!2d-68.19374580202849!3d-16.49127533395923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTbCsDI5JzI4LjciUyA2OMKwMTEnMzguMSJX!5e0!3m2!1ses-419!2sbo!4v1701450406882!5m2!1ses-419!2sbo"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        {{--
                        <div class="widget link">
                            <h5 class="widget-title">
                                Desarrollo
                            </h5>
                            <ul class="widget-link">
                                <li>
                                    <button type="button" data-toggle="modal" data-target="#modalAboutMe" class=" btn text-white ">Acerca de</button>
                                </li>
                            </ul>
                        </div>--}}

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
                        	@if(!is_null($intitucion->intitucion_url_facebook) && $intitucion->intitucion_url_facebook!=="")
                            <li>
                                <a href="{{ $intitucion->intitucion_url_facebook }}" target="_blank" title="Facebook">
                                    <svg width="13" height="22" viewBox="0 0 13 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.20381 22V11.9655H11.5706L12.0757 8.05372H8.20381V5.55662C8.20381 4.42442 8.51692 3.65284 10.1423 3.65284L12.212 3.65199V0.153153C11.8541 0.10664 10.6255 0 9.19548 0C6.20942 0 4.16511 1.82266 4.16511 5.1692V8.05372H0.788086V11.9655H4.16511V22H8.20381Z"
                                            fill="#798DA3" />
                                    </svg>
                                </a>
                            </li>
                            @endif
                            @if(!is_null($intitucion->intitucion_url_telefono) && $intitucion->intitucion_url_telefono!=="")
                            <li>
                                <a href="https://wa.me/+591{{ $intitucion->intitucion_url_telefono }}" target="_blank" title="WhatsApp">
                           	 	<svg width="18" height="18" fill="none" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink">
										<path d="M373.295,307.064c-6.37,-3.188 -37.687,-18.596 -43.526,-20.724c-5.838,-2.126 -10.084,-3.187 -14.331,3.188c-4.246,6.376 -16.454,20.725 -20.17,24.976c-3.715,4.251 -7.431,4.785 -13.8,1.594c-6.37,-3.187 -26.895,-9.913 -51.225,-31.616c-18.935,-16.89 -31.72,-37.749 -35.435,-44.126c-3.716,-6.377 -0.397,-9.824 2.792,-13c2.867,-2.854 6.371,-7.44 9.555,-11.16c3.186,-3.718 4.247,-6.377 6.37,-10.626c2.123,-4.252 1.062,-7.971 -0.532,-11.159c-1.591,-3.188 -14.33,-34.542 -19.638,-47.298c-5.171,-12.419 -10.422,-10.737 -14.332,-10.934c-3.711,-0.184 -7.963,-0.223 -12.208,-0.223c-4.246,0 -11.148,1.594 -16.987,7.969c-5.838,6.377 -22.293,21.789 -22.293,53.14c0,31.355 22.824,61.642 26.009,65.894c3.185,4.252 44.916,68.59 108.816,96.181c15.196,6.564 27.062,10.483 36.312,13.418c15.259,4.849 29.145,4.165 40.121,2.524c12.238,-1.827 37.686,-15.408 42.995,-30.286c5.307,-14.882 5.307,-27.635 3.715,-30.292c-1.592,-2.657 -5.838,-4.251 -12.208,-7.44m-116.224,158.693l-0.086,0c-38.022,-0.015 -75.313,-10.23 -107.845,-29.535l-7.738,-4.592l-80.194,21.037l21.405,-78.19l-5.037,-8.017c-21.211,-33.735 -32.414,-72.726 -32.397,-112.763c0.047,-116.825 95.1,-211.87 211.976,-211.87c56.595,0.019 109.795,22.088 149.801,62.139c40.005,40.05 62.023,93.286 62.001,149.902c-0.048,116.834 -95.1,211.889 -211.886,211.889m180.332,-392.224c-48.131,-48.186 -112.138,-74.735 -180.335,-74.763c-140.514,0 -254.875,114.354 -254.932,254.911c-0.018,44.932 11.72,88.786 34.03,127.448l-36.166,132.102l135.141,-35.45c37.236,20.31 79.159,31.015 121.826,31.029l0.105,0c140.499,0 254.87,-114.366 254.928,-254.925c0.026,-68.117 -26.467,-132.166 -74.597,-180.352" 
											fill="#798DA3"/>
									</svg>
                                </a>
                            </li>
                            @endif
                            @if(!is_null($intitucion->intitucion_url_twitter) && $intitucion->intitucion_url_twitter!=="")
                            <li>
                                <a href="{{ $intitucion->intitucion_url_twitter }}" target="_blank" title="Twiter">
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
                            @endif
                            @if(!is_null($intitucion->intitucion_url_youtube) && $intitucion->intitucion_url_youtube!=="")
                            <li>
                                <a href="{{ $intitucion->intitucion_url_youtube }}" target="_blank" title="You Tube">
                                    <svg width="18" height="18" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512"  xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink">
										<path d="M501.303,132.765c-5.887,-22.03 -23.235,-39.377 -45.265,-45.265c-39.932,-10.7 -200.038,-10.7 -200.038,-10.7c0,0 -160.107,0 -200.039,10.7c-22.026,5.888 -39.377,23.235 -45.264,45.265c-10.697,39.928 -10.697,123.238 -10.697,123.238c0,0 0,83.308 10.697,123.232c5.887,22.03 23.238,39.382 45.264,45.269c39.932,10.696 200.039,10.696 200.039,10.696c0,0 160.106,0 200.038,-10.696c22.03,-5.887 39.378,-23.239 45.265,-45.269c10.696,-39.924 10.696,-123.232 10.696,-123.232c0,0 0,-83.31 -10.696,-123.238Zm-296.506,200.039l0,-153.603l133.019,76.802l-133.019,76.801Z" 
											style="fill-rule:nonzero;" fill="#798DA3"/>
									</svg>
                                </a>
                            </li>
                            @endif
                            @if(!is_null($intitucion->intitucion_url_instagram) && $intitucion->intitucion_url_instagram!=="")
                            <li>
                                <a href="{{ $intitucion->intitucion_url_instagram }}" target="_blank" title="Instagram">
                                    <svg width="18" height="18" fill="none" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.6683 4.78509C13.6683 4.90669 13.6443 5.02711 13.5978 5.13945C13.5513 5.2518 13.483 5.35388 13.3971 5.43987C13.3111 5.52586 13.209 5.59406 13.0966 5.6406C12.9843 5.68714 12.8639 5.71109 12.7423 5.71109C12.6207 5.71109 12.5003 5.68714 12.3879 5.6406C12.2756 5.59406 12.1735 5.52586 12.0875 5.43987C12.0015 5.35388 11.9333 5.2518 11.8868 5.13945C11.8402 5.02711 11.8163 4.90669 11.8163 4.78509C11.8163 4.5395 11.9138 4.30397 12.0875 4.13031C12.2612 3.95665 12.4967 3.85909 12.7423 3.85909C12.9879 3.85909 13.2234 3.95665 13.3971 4.13031C13.5707 4.30397 13.6683 4.5395 13.6683 4.78509ZM16.6083 8.96509V8.97709L16.5553 12.3331C16.5418 13.5434 16.055 14.7004 15.1992 15.5563C14.3435 16.4123 13.1866 16.8993 11.9763 16.9131L8.60828 16.9651H8.59628L5.24028 16.9121C4.02995 16.8986 2.87299 16.4118 2.01702 15.5561C1.16104 14.7003 0.674051 13.5434 0.660276 12.3331L0.608276 8.96509V8.95309L0.661276 5.59709C0.674786 4.38676 1.16152 3.2298 2.01731 2.37383C2.8731 1.51785 4.02995 1.03086 5.24028 1.01709L8.60828 0.965088H8.62028L11.9763 1.01809C13.1866 1.0316 14.3436 1.51833 15.1995 2.37412C16.0555 3.22991 16.5425 4.38676 16.5563 5.59709L16.6083 8.96509ZM15.1183 8.96509L15.0663 5.62009C15.0569 4.79737 14.7259 4.01099 14.1442 3.4292C13.5624 2.84742 12.776 2.51644 11.9533 2.50709L8.60828 2.45509L5.26328 2.50709C4.44056 2.51644 3.65418 2.84742 3.07239 3.4292C2.49061 4.01099 2.15963 4.79737 2.15028 5.62009L2.09828 8.96509L2.15028 12.3101C2.15963 13.1328 2.49061 13.9192 3.07239 14.501C3.65418 15.0828 4.44056 15.4137 5.26328 15.4231L8.60828 15.4751L11.9533 15.4231C12.776 15.4137 13.5624 15.0828 14.1442 14.501C14.7259 13.9192 15.0569 13.1328 15.0663 12.3101L15.1183 8.96509ZM12.7163 8.96509C12.7163 10.0546 12.2835 11.0995 11.5131 11.8699C10.7427 12.6403 9.69779 13.0731 8.60828 13.0731C7.51877 13.0731 6.47388 12.6403 5.70348 11.8699C4.93308 11.0995 4.50028 10.0546 4.50028 8.96509C4.50028 7.87558 4.93308 6.83069 5.70348 6.06029C6.47388 5.28989 7.51877 4.85709 8.60828 4.85709C9.69779 4.85709 10.7427 5.28989 11.5131 6.06029C12.2835 6.83069 12.7163 7.87558 12.7163 8.96509ZM11.2263 8.96509C11.2263 8.27075 10.9505 7.60485 10.4595 7.11388C9.96851 6.62291 9.30261 6.34709 8.60828 6.34709C7.91394 6.34709 7.24804 6.62291 6.75707 7.11388C6.2661 7.60485 5.99028 8.27075 5.99028 8.96509C5.99028 9.65942 6.2661 10.3253 6.75707 10.8163C7.24804 11.3073 7.91394 11.5831 8.60828 11.5831C9.30261 11.5831 9.96851 11.3073 10.4595 10.8163C10.9505 10.3253 11.2263 9.65942 11.2263 8.96509Z" 
											fill="#798DA3"/>
									</svg>
                                </a>
                            </li>
                            @endif
                    		@if(!is_null($intitucion->intitucion_url_tiktok) && $intitucion->intitucion_url_tiktok!=="")
                            <li>
                                <a href="{{ $intitucion->intitucion_url_tiktok }}" target="_blank" title="Tik Tok">
                                    <svg width="18" height="18" fill="none" version="1.0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 838 588" style="enable-background:new 0 0 838 588;" xml:space="preserve">
										<g>
											<path d="M643.3,166.4c-29.2,0-56.2-9.7-77.8-26c-24.8-18.7-42.7-46.2-49-77.8c-1.6-7.8-2.4-15.9-2.5-24.2h-83.5v228.1l-0.1,124.9
												c0,33.4-21.8,61.7-51.9,71.7c-8.8,2.9-18.2,4.3-28,3.7c-12.6-0.7-24.3-4.5-34.6-10.6c-21.8-13-36.5-36.6-36.9-63.7
												c-0.6-42.2,33.5-76.7,75.7-76.7c8.3,0,16.3,1.4,23.8,3.8v-62.3V235c-7.9-1.2-15.9-1.8-24.1-1.8c-46.2,0-89.4,19.2-120.3,53.8
												c-23.3,26.1-37.3,59.5-39.5,94.5c-2.8,45.9,14,89.6,46.6,121.8c4.8,4.7,9.8,9.1,15.1,13.2c27.9,21.5,62.1,33.2,98.1,33.2
												c8.1,0,16.2-0.6,24.1-1.8c33.6-5,64.6-20.4,89.1-44.6c30.1-29.7,46.7-69.2,46.9-111.2l-0.4-186.6c14.3,11.1,30,20.2,46.9,27.3
												c26.2,11.1,54,16.6,82.5,16.6v-60.6v-22.5C643.6,166.4,643.3,166.4,643.3,166.4L643.3,166.4z"
												fill="#798DA3"/>
										</g>
									</svg>
                                </a>
                            </li>
                            @endif
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
