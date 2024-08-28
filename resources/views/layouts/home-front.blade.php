<!DOCTYPE html>
<html lang="zxx">

<head>
    
    @if($institucion)
    <title>{{ $institucion->nombre }} </title>
    @else
    <title>dogcenter</title>
    @endif
  
    <!-- /SEO Ultimate -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta charset="utf-8">
    @if($institucion)
    <link rel="apple-touch-icon" sizes="57x57" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ $institucion->url_logo }}">
    <link rel="apple-touch-icon" sizes="180x180" href={{ $institucion->url_logo }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ $institucion->url_logo }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $institucion->url_logo }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ $institucion->url_logo }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $institucion->url_logo }}">
    @endif

    <link rel="manifest" href="{{ asset('assets/apprista/assets/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('assets/apprista/assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/apprista/assets/js/bootstrap.min.js') }}">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link href="{{ asset('assets/apprista/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/apprista/assets/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    @livewireScripts

</head>

<body>
    <!--Header  -->
    @if($institucion)
    <div class="banner_outer" style="background-image: url('{{ $institucion->img1 }}');">
    @else
    <div class="banner_outer">
    @endif
        <header>
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">
                    @if($institucion)
                        <figure class="mb-0"><img src="{{ $institucion->url_logo }}" alt=""
                                class="img-fluid">
                        </figure>
                    @endif
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">INICIO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Finicio') }}">TIKETS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('publicaciones2')}}">PUBLICACIONES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">CONTACTOS</a>
                            </li>
                            {{-- <li class="nav-item">
                            <a class="nav-link" href="./about.html">About</a>
                        </li> --}}
                            <li class="nav-item">
                                <a class="nav-link try_free_btn" href="{{ route('login') }}">ACCEDER</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Banner -->
        <section class="banner-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="banner_content" data-aos="fade-down">
                        @if($institucion)
                            <h1>
                            
                                <b class="text-success"
                                    style="color: blue;background: -webkit-linear-gradient(left, blue, #333); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); ">{{ $institucion->nombre }}
                                </b>
                            
                            </h1>
                            <h2 class="text-white"
                                style="color: rgb(17, 106, 64);background: -webkit-linear-gradient(left, rgb(13, 122, 72), #333); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); ">
                                {{ $institucion->titulo }} </h2>
                            <p class="text-white"><b>{{ $institucion->subtitulo }}</b></p>
                            <span>Visitanos en :</span>
                            <div class="image_wrapper">
                                <a href="{{ $institucion->url_facebook }}"
                                    class="btn btn-outline-dark waves-effect waves-light">
                                    <i class="fab fa-facebook-f" style="font-size: 24px;"></i>
                                </a>
                                <a href="{{ $institucion->url_twitter }}"
                                    class="btn btn-outline-dark waves-effect waves-light">
                                    <i class="fab fa-twitter" style="font-size: 24px;"></i>
                                </a>
                                <a href="{{ $institucion->url_instagram }}"
                                    class="btn btn-outline-dark waves-effect waves-light">
                                    <i class="fab fa-instagram" style="font-size: 24px;"></i>
                                </a>
                                <a href="{{ $institucion->url_youtube }}"
                                    class="btn btn-outline-dark waves-effect waves-light">
                                    <i class="fab fa-youtube" style="font-size: 24px;"></i>
                                </a>

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="banner_wrapper2">
                            <figure class="mb-0 bannerphoneback">
                                <img src="{{ asset('assets/apprista/assets/images/bannerphoneback-image1.png') }}"
                                    alt="">
                            </figure>
                            {{-- <figure class="mb-0 bannerphone2">
                                <img class="img-fluid" src="{{ $institucion->url_logo }}" alt="">
                            </figure> --}}
                            <figure class="mb-0 bannerphone-circleicon">
                                <img src="{{ asset('assets/apprista/assets/images/bannerphone-circleicon.png') }}"
                                    alt="">
                            </figure>
                            <figure class="mb-0 bannerphone-circle">
                                <img class="img-fluid"
                                    src="{{ asset('assets/apprista/assets/images/bannerphone-circle.png') }}"
                                    alt="">
                            </figure>
                            {{-- <figure class="mb-0 bannerphone1">
                                <img src="{{ $institucion->url_logo }}" alt="logo">
                            </figure> --}}
                        </div>
                    </div>
                </div>
                <figure class="mb-0 bannersidecircle1" data-aos="fade-left">
                    <img src="{{ asset('assets/apprista/assets/images/banner-sidecircle1.png') }}" alt="">
                </figure>
                <figure class="mb-0 bannersidecircle2" data-aos="fade-left">
                    <img src="{{ asset('assets/apprista/assets/images/banner-sidecircle2.png') }}" alt="">
                </figure>
            </div>
        </section>

    </div>


    <!-- Partner -->
    @yield('body-page')
    <!-- Footer -->

    <section class="footer-section">
        <div class="container">
            <div class="middle-portion">
                {{-- <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="icons">
                            <a href="./index.html">
                                <figure class="footer-logo">
                                    <img src="./assets/images/footer-logo.png" alt="">
                                </figure>
                            </a>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12 d-lg-block d-none">
                        <div class="services">
                            <h3 class="heading">Services</h3>
                            <ul class="list-unstyled mb-0">
                                <li><a href="./index.html#statistics"
                                        class=" text text-decoration-none">Statistics</a></li>
                                <li><a href="./index.html#basic-feature" class=" text text-decoration-none">Basic
                                        Features</a></li>
                                <li><a href="./features.html#about-app" class=" text text-decoration-none">About
                                        App</a></li>
                                <li><a href="./pricing.html" class=" text text-decoration-none">Pricing</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-sm-block">
                        <div class="links">
                            <h3 class="heading">Quick Links</h3>
                            <ul class="list-unstyled mb-0">
                                <li><a href="./faq.html" class=" text text-decoration-none">FAQs</a></li>
                                <li><a href="./index.html" class=" text text-decoration-none">Home</a></li>
                                <li><a href="./features.html" class=" text text-decoration-none"> Features</a></li>
                                <li><a href="./contact.html" class=" text text-decoration-none">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-md-block d-none">
                        <div class="aboutus">
                            <h3 class="heading">About Us</h3>
                            <ul class="list-unstyled mb-0">
                                <li><a href="./about.html" class=" text text-decoration-none">About Us</a></li>
                                <li><a href="./about.html#our-team" class=" text text-decoration-none">Our Team</a>
                                </li>
                                <li><a href="./pricing.html#pricing-plan" class=" text text-decoration-none">Pricing
                                        Plans</a></li>
                                <li><a href="./index.html#get-app" class=" text text-decoration-none">Get the App</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="footer-lower">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <p class="mb-0 text-size-18">© 2024 NV SOFT. Todos los derechos reservados</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-md-block d-none">
                        <p class="mb-0 term text-size-18">By Ivan T.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('assets/apprista/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/video_link.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/video.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/counter.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/animation_links.js') }}"></script>
    <script src="{{ asset('assets/apprista/assets/js/animation.js') }}"></script>
</body>

</html>
