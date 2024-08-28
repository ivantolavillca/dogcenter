<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SI@DI - UPEA</title>
    <meta name="author" content="Vecuro">
    <meta name="description" content="SISTEMA DE INSCRIPCIONES SIADI">



    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/landing-page/assets/img/logo_idiomas.png') }}" type="image/x-icon">

    <!--==============================
 Google Fonts
 ============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">


    <!--==============================
 All CSS File
 ============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/landing-page/assets/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets/landing-page/assets/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/landing-page/assets/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('assets/landing-page/assets/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/landing-page/assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{ asset('assets/alertas/sweetalert2.min.css') }}">
    @livewireStyles
    @livewireScripts
    <style>
        .form-control.form-control-small {
            max-width: 300px;
            height: 40px;
            /* Ajusta este valor según tus necesidades */
            font-size: 12px;
            /* Ajusta este valor según tus necesidades */
            padding: 4px 8px;
            /* Ajusta el espaciado interno (padding) según tus necesidades */
        }
    </style>

</head>


<body>


    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->



    <!--********************************
   Code Start From Here
 ******************************** -->




    <!--==============================
     Preloader
  ==============================-->
    <div class="preloader  ">
        <button class="vs-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <div class="loader"></div>
        </div>
    </div><!--==============================
    Mobile Menu
  ============================== -->
    <div class="vs-menu-wrapper">
        <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="{{ route('inicio.index') }}"><img
                        src="{{ asset('assets/landing-page/assets/img/logo_idiomas.png') }}" alt="siadi"></a>
            </div>
            <div class="vs-mobile-menu">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="index.html">Demos</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Demo Style 1</a></li>
                            <li><a href="index-2.html">Demo Style 2</a></li>
                            <li><a href="index-3.html">Demo Style 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="about.html">About Us</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="course.html">Courses</a>
                        <ul class="sub-menu">
                            <li><a href="course.html">Courses 1</a></li>
                            <li><a href="courses-2.html">Courses 2</a></li>
                            <li><a href="course-details.html">Courses Details 1</a></li>
                            <li><a href="course-details-2.html">Courses Details 2</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="blog.html">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="team.html">Our Tutors</a></li>
                            <li><a href="team-details.html">Tutor Details</a></li>
                            <li><a href="become-tutor.html">Become Tutor</a></li>
                            <li><a href="find-tutor.html">Find Tutor</a></li>
                            <li><a href="academic.html">Academic</a></li>
                            <li><a href="academic-program.html">Academic Program</a></li>
                            <li><a href="program-details.html">Program Details</a></li>
                            <li><a href="find-program.html">Find Program</a></li>
                            <li><a href="event-details.html">Event Details</a></li>
                            <li><a href="login-register.html">Login Register</a></li>
                            <li><a href="error.html">Error Page</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!--==============================
    Popup Search Box
    ============================== -->
    <div class="popup-search-box d-none d-lg-block  ">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" class="border-theme" placeholder="What are you looking for">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>
    <!--==============================
    Header Area
    ==============================-->
    <header class="vs-header header-layout1">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-between align-items-center gx-50">
                    <div class="col d-none d-xl-block">
                        <div class="header-links">
                            <ul>
                                <li><i class="fas fa-phone-alt"></i>Phone: <a href="+4402076897888">+44 (0) 207 689
                                        7888</a></li>
                                <li><i class="fas fa-envelope"></i>Email: <a
                                        href="mailto:info@company.co.uk">info@company.co.uk</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col col-xl-auto d-none d-md-block">
                        <a class="user-login" href="{{ route('login') }}"><i class="fas fa-user-circle"></i>
                            Login</a>
                    </div>
                    <div class="col-md-auto text-center">
                        <div class="header-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <div class="container position-relative z-index-common">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="vs-logo"> <a href="{{ route('inicio.index') }}"><img
                                        src="{{ asset('assets/landing-page/assets/img/logo_idiomas.png') }}"
                                        alt="logo"></a> </div>
                        </div>
                        <div class="col text-end text-xl-center">
                            <nav class="main-menu menu-style1 d-none d-lg-block">
                                <ul>
                                    <li class="menu-item-has-children"> <a href="index.html">Demos</a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Demo Style 1</a></li>
                                            <li><a href="index-2.html">Demo Style 2</a></li>
                                            <li><a href="index-3.html">Demo Style 3</a></li>
                                        </ul>
                                    </li>
                                    <li> <a href="about.html">About Us</a> </li>
                                    <li class="menu-item-has-children">
                                        <a href="course.html">Courses</a>
                                        <ul class="sub-menu">
                                            <li><a href="course.html">Courses 1</a></li>
                                            <li><a href="courses-2.html">Courses 2</a></li>
                                            <li><a href="course-details.html">Course Details 1</a></li>
                                            <li><a href="course-details-2.html">Course Details 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="blog.html">Tutor</a>
                                        <ul class="sub-menu">
                                            <li><a href="team.html">Our Tutors</a></li>
                                            <li><a href="team-details.html">Tutor Details</a></li>
                                            <li><a href="become-tutor.html">Become Tutor</a></li>
                                            <li><a href="find-tutor.html">Find Tutor</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children mega-menu-wrap"> <a href="#">Pages</a>
                                        <ul class="mega-menu">
                                            <li><a href="#">Pagelist 1</a>
                                                <ul>
                                                    <li><a href="index.html">Demo Style 1</a></li>
                                                    <li><a href="index-2.html">Demo Style 2</a></li>
                                                    <li><a href="index-3.html">Demo Style 3</a></li>
                                                    <li><a href="about.html">About Us</a></li>
                                                    <li><a href="contact.html">Contact Us</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Pagelist 2</a>
                                                <ul>
                                                    <li><a href="course.html">Courses 1</a></li>
                                                    <li><a href="courses-2.html">Courses 2</a></li>
                                                    <li><a href="course-details.html">Courses Details 1</a></li>
                                                    <li><a href="course-details-2.html">Courses Details 2</a></li>
                                                    <li><a href="event-details.html">Event Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Pagelist 3</a>
                                                <ul>
                                                    <li><a href="academic.html">Academic</a></li>
                                                    <li><a href="academic-program.html">Academic Program</a></li>
                                                    <li><a href="program-details.html">Program Details</a></li>
                                                    <li><a href="find-program.html">Find Program</a></li>
                                                    <li><a href="login-register.html">Login Register</a></li>
                                                    <li><a href="error.html">Error Page</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Pagelist 4</a>
                                                <ul>
                                                    <li><a href="team.html">Our Tutors</a></li>
                                                    <li><a href="team-details.html">Tutor Details</a></li>
                                                    <li><a href="become-tutor.html">Become Tutor</a></li>
                                                    <li><a href="find-tutor.html">Find Tutor</a></li>
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="blog-details.html">Blog Details</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </nav>
                            <button class="vs-menu-toggle d-inline-block d-lg-none"><i
                                    class="fal fa-bars"></i></button>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="header-btns">
                                <button type="button" class="searchBoxTggler"><i class="far fa-search"></i></button>
                                <a href="{{ route('preinscripcion.index') }}" class="vs-btn style4"><i
                                        class="fal fa-graduation-cap"></i> PREINSCRIPCIÓN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!--==============================
  Hero Area
  ==============================-->
    @yield('body-page')
    <!--==============================
    Footer Area
  ==============================-->
    <footer class="footer-wrapper footer-layout1">
        <div class="shape-mockup jump d-none d-xxxl-block" data-bottom="0%" data-left="-270px">
            <div class="vs-border-circle"></div>
        </div>

        <div class="copyright-wrap">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="text-center col-lg-auto">
                        <p class="copyright-text">By Navi <i class="fal fa-copyright"></i> 2023 <a
                                href="index.html">SIE</a> - Universidad Pública de El Alto </p>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <div class="social-style1">
                            <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
                            <a href="#"><i class="fab fa-twitter"></i>Twitter</a>
                            <a href="#"><i class="fab fa-linkedin-in"></i>Linked In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> <!-- Scroll To Top -->
    <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>

    <!--********************************
   Code End  Here
 ******************************** -->

    <!--==============================
        All Js File
    ============================== -->
    <!-- Jquery -->
    <script src="{{ asset('assets/landing-page/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('assets/landing-page/assets/js/slick.min.js') }}"></script>
    <!-- <script src="assets/js/app.min.js"></script> -->
    <!-- Bootstrap -->
    {{-- <script src="{{ asset('assets/landing-page/assets/js/bootstrap.min.js') }}"></script> --}}
    <!-- Wow.js Animation -->
    <script src="{{ asset('assets/landing-page/assets/js/wow.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('assets/landing-page/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Main Js File -->
    <script src="{{ asset('assets/landing-page/assets/js/main.js') }}"></script>
<script src="{{ asset('assets/alertas/sweetalert2.all.min.js') }}"></script>
    <script>
        Livewire.on('alert', function(message) {
            Swal.fire(
                'Guardado con exito!',
                message,
                'success'
            )
        })
    </script>
    @stack('navi-js-front')

</body>

</html>
