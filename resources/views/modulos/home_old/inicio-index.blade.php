@extends('modulos.home_old.home-front')

@section('body-page-old')
    <section class="page-title">
        <div class="icon_bg">
            <img src="./assets/images/backgroup/bg_inner_slider.png" alt="">
        </div>
        <div class="swiper-container slider-main">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slider-st1">
                        <div class="overlay">
                            <img src="{{ $intitucion->intitucion_url_banner1 }}" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-slider">
                                        <div class="content-box">
                                            <h1 class="title"
                                                style=" color: #084cca;
                                                         text-shadow: rgba(226, 226, 13, 0.788)2px 5px 4px;   font-size: 80px;">
                                                {{ $intitucion->intitucion_titulo }}</h1>
                                            <p
                                                class="sub-title" style=" color: #4b87f7;
                                                                 text-shadow: #084cca 2px 5px 4px;   font-size: 40px;">
                                                {{ $intitucion->intitucion_subtitulo }}</p>
                                            <div class="wrap-btn">
                                                <a href="https://www.upea.bo/" class="tf-button style2" style=" background-color:rgb(255, 166, 0) ">
                                                  UPEA
                                                </a>
                                            </div>
                                        </div>
                                         <div class="image">
                                            <img class="img_main" src="{{ $intitucion->intitucion_url_banner2 }}"
                                                alt="">
                                            <div class="icon icon1">
                                                <img src="./assets//images//slider/icon_1.png" alt="">
                                            </div>
                                            <div class="icon icon2">
                                                <img src="./assets//images//slider/icon_2.png" alt="">
                                            </div>
                                            <div class="icon icon3">
                                                <img src="./assets//images//slider/icon_3.png" alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slider-st1">
                        <div class="overlay">
                            <img src="{{ $intitucion->intitucion_url_banner1 }}" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-slider">
                                        <div class="content-box">
                                            <h1 class="title"style=" color: rgb(240, 41, 15);
                                                                 text-shadow: rgba(0, 0, 0, 0.5) 2px 10px 4px;">
                                                {{ $intitucion->intitucion_titulo }}</h1>
                                            <p
                                                class="sub-title"style=" color: rgb(47, 13, 128);
                                                                 text-shadow: rgba(0, 0, 0, 0.5) 2px 5px 4px;   font-size: 40px;">
                                                {{ $intitucion->intitucion_subtitulo }}</p>
                                            <div class="wrap-btn">
                                                <a href="https://www.upea.bo/" class="tf-button style2">
                                                  UPEA
                                                </a>
                                            </div>
                                        </div>
                                        <div>
                                            @include('modulos.home_guest.idiomas_mundo_three')
                                        </div>
                                        {{--<div class="image">
                                            <img class="img_main" src="{{ $intitucion->intitucion_url_banner2 }}""
                                                alt="">
                                            <div class="icon icon1">
                                                <img src="./assets//images//slider/icon_1.png" alt="">
                                            </div>
                                            <div class="icon icon2">
                                                <img src="./assets//images//slider/icon_2.png" alt="">
                                            </div>
                                            <div class="icon icon3">
                                                <img src="./assets//images//slider/icon_3.png" alt="">
                                            </div>                                        
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="btn-next-main"><i class="far fa-angle-right"></i></div>
            <div class="btn-prev-main"><i class="far fa-angle-left"></i></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>



    {{-- <section class="page-title">
        <div class="icon_bg">
            <img src="./assets/images/backgroup/bg_inner_slider.png" alt="">
        </div>
        <div class="swiper-container slider-main">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slider-st1">
                        <div class="overlay">
                            <img src="./assets/images//backgroup/bg-slider.png" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-slider">
                                        <div class="content-box">
                                            <h1 class="title">Enter the gateway of Blockchain Gaming</h1>
                                            <p class="sub-title">Visually and spatially connecting games in a seamless
                                                metaverse experience</p>
                                            <div class="wrap-btn">
                                                <a href="project-list.html" class="tf-button style2">
                                                    EXPLORE IGO
                                                </a>
                                            </div>
                                        </div>
                                        <div class="image">
                                            <img class="img_main" src="assets/images/slider/Furore.png" alt="">
                                            <div class="icon icon1">
                                                <img src="./assets//images//slider/icon_1.png" alt="">
                                            </div>
                                            <div class="icon icon2">
                                                <img src="./assets//images//slider/icon_2.png" alt="">
                                            </div>
                                            <div class="icon icon3">
                                                <img src="./assets//images//slider/icon_3.png" alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slider-st1">
                        <div class="overlay">
                            <img src="./assets/images//backgroup/bg-slider.png" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-slider">
                                        <div class="content-box">
                                            <h1 class="title">Enter the gateway of Blockchain Gaming</h1>
                                            <p class="sub-title">Visually and spatially connecting games in a seamless
                                                metaverse experience</p>
                                            <div class="wrap-btn">
                                                <a href="#" class="tf-button style2">
                                                    EXPLORE IGO
                                                </a>
                                            </div>
                                        </div>
                                        <div class="image">
                                            <img class="img_main" src="assets/images/slider/Furore.png" alt="">
                                            <div class="icon icon1">
                                                <img src="./assets//images//slider/icon_1.png" alt="">
                                            </div>
                                            <div class="icon icon2">
                                                <img src="./assets//images//slider/icon_2.png" alt="">
                                            </div>
                                            <div class="icon icon3">
                                                <img src="./assets//images//slider/icon_3.png" alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="btn-next-main"><i class="far fa-angle-right"></i></div>
            <div class="btn-prev-main"><i class="far fa-angle-left"></i></div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}

    @include('modulos.home_guest.estadistica_highchart')


    <section class="tf-section tf_team">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tf-title mb40" data-aos="fade-up" data-aos-duration="800">
                        <h2 class="title">
                            Nuestras Autoridades
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="team-box-wrapper">
                        <div class="content col-md-3">
                            <div class="img-box  text-center" data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">

                                <div class="image">
                                    <img src="{{ $intitucion->intitucion_rector }}">
                                </div>
                                <div class="content">
                                    <h5 class="name"><a href="team-details.html">{{ $intitucion->rector_nombre }}</a></h5>
                                    <p class="position text-center">RECTOR <br>UNIVERSIDAD PÚBLICA DE EL ALTO</p>
                                    <ul class="social">
                                        <li>
                                            <a href="https://www.facebook.com/carloscondorit/" target="blank">
                                                <svg width="13" height="22" viewBox="0 0 13 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.20381 22V11.9655H11.5706L12.0757 8.05372H8.20381V5.55662C8.20381 4.42442 8.51692 3.65284 10.1423 3.65284L12.212 3.65199V0.153153C11.8541 0.10664 10.6255 0 9.19548 0C6.20942 0 4.16511 1.82266 4.16511 5.1692V8.05372H0.788086V11.9655H4.16511V22H8.20381Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/rectorcondori" target="blank">
                                                <svg width="23" height="18" viewBox="0 0 23 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M22.5 2.17863C21.6819 2.5375 20.8101 2.77537 19.9012 2.89087C20.8363 2.33262 21.5499 1.45537 21.8854 0.398C21.0136 0.91775 20.0511 1.28488 19.0254 1.48975C18.1976 0.608375 17.0179 0.0625 15.7309 0.0625C13.2339 0.0625 11.2236 2.08925 11.2236 4.57388C11.2236 4.93138 11.2539 5.27512 11.3281 5.60237C7.5785 5.4195 4.26063 3.62238 2.03175 0.88475C1.64262 1.55988 1.41438 2.33262 1.41438 3.1645C1.41438 4.7265 2.21875 6.11112 3.41775 6.91275C2.69313 6.899 1.98225 6.68862 1.38 6.35725C1.38 6.371 1.38 6.38888 1.38 6.40675C1.38 8.5985 2.94337 10.419 4.9935 10.8384C4.62637 10.9388 4.22625 10.9869 3.811 10.9869C3.52225 10.9869 3.23075 10.9704 2.95712 10.9099C3.5415 12.696 5.19975 14.0091 7.1715 14.0518C5.637 15.2521 3.68863 15.9754 1.57938 15.9754C1.2095 15.9754 0.85475 15.9589 0.5 15.9135C2.49787 17.2019 4.86562 17.9375 7.419 17.9375C15.7185 17.9375 20.256 11.0625 20.256 5.10325C20.256 4.90387 20.2491 4.71138 20.2395 4.52025C21.1346 3.885 21.8867 3.09162 22.5 2.17863Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a href="#">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.3003 17.8V11.354C18.3003 8.18599 17.6183 5.76599 13.9223 5.76599C12.1403 5.76599 10.9523 6.73399 10.4683 7.65799H10.4243V6.05199H6.92627V17.8H10.5783V11.97C10.5783 10.43 10.8643 8.95599 12.7563 8.95599C14.6263 8.95599 14.6483 10.694 14.6483 12.058V17.778H18.3003V17.8Z"
                                                        fill="#798DA3" />
                                                    <path d="M0.986328 6.052H4.63833V17.8H0.986328V6.052Z"
                                                        fill="#798DA3" />
                                                    <path
                                                        d="M2.8122 0.200012C1.6462 0.200012 0.700195 1.14601 0.700195 2.31201C0.700195 3.47801 1.6462 4.44601 2.8122 4.44601C3.9782 4.44601 4.9242 3.47801 4.9242 2.31201C4.9242 1.14601 3.9782 0.200012 2.8122 0.200012Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="content col-md-3">
                            <div class="img-box text-center " data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">

                                <div class="image">
                                    <img src="{{ $intitucion->intitucion_vicerector }}">
                                </div>
                                <div class="content">
                                    <h5 class="name"><a href="team-details.html">{{ $intitucion->vicerector_nombre }}</a>
                                    </h5>
                                    <p class="position text-center">VICERECTOR <br>UNIVERSIDAD PÚBLICA DE EL ALTO</p>
                                    <ul class="social">
                                        <li>
                                            <a href="https://www.facebook.com/efrain.chambi.vicerretor" target="blank">
                                                <svg width="13" height="22" viewBox="0 0 13 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.20381 22V11.9655H11.5706L12.0757 8.05372H8.20381V5.55662C8.20381 4.42442 8.51692 3.65284 10.1423 3.65284L12.212 3.65199V0.153153C11.8541 0.10664 10.6255 0 9.19548 0C6.20942 0 4.16511 1.82266 4.16511 5.1692V8.05372H0.788086V11.9655H4.16511V22H8.20381Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a href="https://twitter.com/rectorcondori" target="blank">
                                                <svg width="23" height="18" viewBox="0 0 23 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M22.5 2.17863C21.6819 2.5375 20.8101 2.77537 19.9012 2.89087C20.8363 2.33262 21.5499 1.45537 21.8854 0.398C21.0136 0.91775 20.0511 1.28488 19.0254 1.48975C18.1976 0.608375 17.0179 0.0625 15.7309 0.0625C13.2339 0.0625 11.2236 2.08925 11.2236 4.57388C11.2236 4.93138 11.2539 5.27512 11.3281 5.60237C7.5785 5.4195 4.26063 3.62238 2.03175 0.88475C1.64262 1.55988 1.41438 2.33262 1.41438 3.1645C1.41438 4.7265 2.21875 6.11112 3.41775 6.91275C2.69313 6.899 1.98225 6.68862 1.38 6.35725C1.38 6.371 1.38 6.38888 1.38 6.40675C1.38 8.5985 2.94337 10.419 4.9935 10.8384C4.62637 10.9388 4.22625 10.9869 3.811 10.9869C3.52225 10.9869 3.23075 10.9704 2.95712 10.9099C3.5415 12.696 5.19975 14.0091 7.1715 14.0518C5.637 15.2521 3.68863 15.9754 1.57938 15.9754C1.2095 15.9754 0.85475 15.9589 0.5 15.9135C2.49787 17.2019 4.86562 17.9375 7.419 17.9375C15.7185 17.9375 20.256 11.0625 20.256 5.10325C20.256 4.90387 20.2491 4.71138 20.2395 4.52025C21.1346 3.885 21.8867 3.09162 22.5 2.17863Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.3003 17.8V11.354C18.3003 8.18599 17.6183 5.76599 13.9223 5.76599C12.1403 5.76599 10.9523 6.73399 10.4683 7.65799H10.4243V6.05199H6.92627V17.8H10.5783V11.97C10.5783 10.43 10.8643 8.95599 12.7563 8.95599C14.6263 8.95599 14.6483 10.694 14.6483 12.058V17.778H18.3003V17.8Z"
                                                        fill="#798DA3" />
                                                    <path d="M0.986328 6.052H4.63833V17.8H0.986328V6.052Z"
                                                        fill="#798DA3" />
                                                    <path
                                                        d="M2.8122 0.200012C1.6462 0.200012 0.700195 1.14601 0.700195 2.31201C0.700195 3.47801 1.6462 4.44601 2.8122 4.44601C3.9782 4.44601 4.9242 3.47801 4.9242 2.31201C4.9242 1.14601 3.9782 0.200012 2.8122 0.200012Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="content col-md-3">
                            <div class="img-box text-center " data-aos="fade-up" data-aos-delay="500" data-aos-duration="800">

                                <div class="image">
                                    <img src="{{ $intitucion->intitucion_jefe }}">
                                </div>
                                <div class="content">
                                    <h5 class="name"><a href="team-details.html">{{ $intitucion->jefe_nombre }}</a>
                                    </h5>
                                    <p class="position text-center">COORDINADORA DEPARTAMENTO IDIOMAS <br>CARRERA LINGÜÍSTICA E IDIOMAS</p>
                                    <ul class="social">
                                        {{-- <li>
                                            <a href="https://www.facebook.com/carloscondorit/" target="blank">
                                                <svg width="13" height="22" viewBox="0 0 13 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.20381 22V11.9655H11.5706L12.0757 8.05372H8.20381V5.55662C8.20381 4.42442 8.51692 3.65284 10.1423 3.65284L12.212 3.65199V0.153153C11.8541 0.10664 10.6255 0 9.19548 0C6.20942 0 4.16511 1.82266 4.16511 5.1692V8.05372H0.788086V11.9655H4.16511V22H8.20381Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li> --}}
                                        {{-- <li>
                                            <a href="https://twitter.com/rectorcondori" target="blank">
                                                <svg width="23" height="18" viewBox="0 0 23 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M22.5 2.17863C21.6819 2.5375 20.8101 2.77537 19.9012 2.89087C20.8363 2.33262 21.5499 1.45537 21.8854 0.398C21.0136 0.91775 20.0511 1.28488 19.0254 1.48975C18.1976 0.608375 17.0179 0.0625 15.7309 0.0625C13.2339 0.0625 11.2236 2.08925 11.2236 4.57388C11.2236 4.93138 11.2539 5.27512 11.3281 5.60237C7.5785 5.4195 4.26063 3.62238 2.03175 0.88475C1.64262 1.55988 1.41438 2.33262 1.41438 3.1645C1.41438 4.7265 2.21875 6.11112 3.41775 6.91275C2.69313 6.899 1.98225 6.68862 1.38 6.35725C1.38 6.371 1.38 6.38888 1.38 6.40675C1.38 8.5985 2.94337 10.419 4.9935 10.8384C4.62637 10.9388 4.22625 10.9869 3.811 10.9869C3.52225 10.9869 3.23075 10.9704 2.95712 10.9099C3.5415 12.696 5.19975 14.0091 7.1715 14.0518C5.637 15.2521 3.68863 15.9754 1.57938 15.9754C1.2095 15.9754 0.85475 15.9589 0.5 15.9135C2.49787 17.2019 4.86562 17.9375 7.419 17.9375C15.7185 17.9375 20.256 11.0625 20.256 5.10325C20.256 4.90387 20.2491 4.71138 20.2395 4.52025C21.1346 3.885 21.8867 3.09162 22.5 2.17863Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.3003 17.8V11.354C18.3003 8.18599 17.6183 5.76599 13.9223 5.76599C12.1403 5.76599 10.9523 6.73399 10.4683 7.65799H10.4243V6.05199H6.92627V17.8H10.5783V11.97C10.5783 10.43 10.8643 8.95599 12.7563 8.95599C14.6263 8.95599 14.6483 10.694 14.6483 12.058V17.778H18.3003V17.8Z"
                                                        fill="#798DA3" />
                                                    <path d="M0.986328 6.052H4.63833V17.8H0.986328V6.052Z"
                                                        fill="#798DA3" />
                                                    <path
                                                        d="M2.8122 0.200012C1.6462 0.200012 0.700195 1.14601 0.700195 2.31201C0.700195 3.47801 1.6462 4.44601 2.8122 4.44601C3.9782 4.44601 4.9242 3.47801 4.9242 2.31201C4.9242 1.14601 3.9782 0.200012 2.8122 0.200012Z"
                                                        fill="#798DA3" />
                                                </svg>
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>

                        </div>
                      

                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="tf-section project">
        <div class="container w_1280">
            <div class="row">
                <div class="col-md-12">
                    <div class="tf-title mb20" data-aos="fade-up" data-aos-duration="800">
                        <h2 class="title">
                            CONTENIDOS
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="flat-tabs" data-aos="fade-up" data-aos-duration="1000">
                        <ul class="menu-tab">
                            <li class="active"><span>COMUNICADOS</span></li>
                            <li><span>CONVOCATORIAS</span></li>
                            <li><span>HORARIOS</span></li>
                        </ul>

                        @php $fecha = \Carbon\Carbon::now(); @endphp
                        <div class="content-tab">
                            <!-- COMUNICADOS -->
                            <div class="content-inner" id="comunicados">
                                <div class="container_inner">
                                    <div class="swiper-container slider-3" data-aos="fade-in" data-aos-duration="1000">
                                        <div class="swiper-wrapper mt40">
                                            @php $contador = 0; @endphp
                                            <div class="content-inner project-box-style6_wrapper">
                                                @foreach ($publicaciones as $publicacion)
                                                    @if ($publicacion->publicaciones_estado == 'ACTIVO' && $publicacion->publicaciones_tipo == 'Comunicados')
                                                        @php $contador++; @endphp
                                                        <div class="project-box-style6">
                                                            <span class="boder"></span>
                                                            <div class="img-box">
                                                                <div class="image">
                                                                    <img src="{{ $publicacion->publicaciones_imagen_url }}"
                                                                        alt="{{ $publicacion->publicaciones_titulo }}"
                                                                        width="100%">
                                                                </div>
                                                                <div class="content">
                                                                    <div class="img-box">
                                                                        <div class="image_inner">
                                                                            <img class="mask"
                                                                                src="{{ asset('assets/front_images/comunicado.png') }}"
                                                                                alt="">
                                                                            <div class="shape">
                                                                                <img src="{{ asset('assets/front_images/comunicado.png') }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="content-inner">
                                                                            <h5 class="heading">
                                                                                <a>{{ mb_strtoupper($publicacion->publicaciones_titulo) }}</a>
                                                                            </h5>
                                                                            <p class="desc">
                                                                                {{ $publicacion->publicaciones_descripcion }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="content-bottom">
                                                                        <ul>
                                                                            <li>
                                                                                <p class="text">Fecha Actual</p>
                                                                                <p class="price">{{ $fecha->locale('es')->isoFormat('dddd\, D \d\e MMMM \d\e YYYY') }}</p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @if ($contador == 0)
                                                <p class="text-center"> NO HAY COMUNICADOS</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="next_slider-3 next_slider"><svg width="18" height="16"
                                            viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 8H16.5M16.5 8L9.75 1.25M16.5 8L9.75 14.75" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="prev_slider-3 prev_slider"><svg width="18" height="16"
                                            viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 8H1.5M1.5 8L8.25 1.25M1.5 8L8.25 14.75" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- CONVOCATORIAS -->
                            <div class="content-inner" id="convocatorias">
                                <div class="container_inner">
                                    <div class="swiper-container slider-4" data-aos="fade-in" data-aos-duration="1000">
                                        <div class="swiper-wrapper">
                                            @php $contador = 0; @endphp
                                            @foreach ($publicaciones as $publicacion)
                                                @if ($publicacion->publicaciones_estado == 'ACTIVO' && $publicacion->publicaciones_tipo == 'Convocatoria')
                                                    @php $contador++; @endphp
                                                    <div class="swiper-slide">
                                                        <div class="project-box-style4">
                                                            <div class="image">
                                                                <div class="img_inner">
                                                                    <img src="{{ asset('assets/front_images/convocatoria.png') }}"
                                                                        alt="comunicado">
                                                                    <img class="shape"
                                                                        src="{{ asset('assets/front_images/convocatoria.png') }}"
                                                                        alt="comunicado">
                                                                </div>
                                                                <div class="label">{{ $contador }}</div>
                                                            </div>
                                                            <div class="content">
                                                                <h5 class="heading">
                                                                    <a>{{ mb_strtoupper($publicacion->publicaciones_titulo) }}</a>
                                                                </h5>
                                                                <p class="desc">
                                                                    {{ $publicacion->publicaciones_descripcion }}</p>

                                                                <div class="card bg-transparent border-0">
                                                                    <img src="{{ $publicacion->publicaciones_imagen_url }}"
                                                                        class="card-img-top" alt="..."
                                                                        width="100%">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="content content-100">
                                                                <div class="card-body">
                                                                    <ul>
                                                                        <!-- <li>
                                                                            <p class="text">Fecha Actual</p>
                                                                            <p class="price">{{ $fecha }}</p>
                                                                        </li> -->
                                                                        <li>
                                                                            <p class="text">Fecha Inicio </p>
                                                                            <p class="price">{{ \Carbon\Carbon::parse($publicacion->fecha_inicio)->locale('es')->isoFormat('D \d\e MMMM \d\e YYYY') }}</p>
                                                                        </li>
                                                                        <li>
                                                                            <p class="text">Fecha Fin</p>
                                                                            <p class="price">{{ \Carbon\Carbon::parse($publicacion->fecha_fin)->locale('es')->isoFormat('D \d\e MMMM \d\e YYYY') }}</p>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="content-wrapper">
                                                                        <div class="content_inner aos-init aos-animate" data-aos="fade-left" data-aos-duration="1200"> <!-- fade-left -->
                                                                            <div class="wrapper">
                                                                                @if($fecha >= \Carbon\Carbon::parse($publicacion->fecha_inicio .' 00:00:00') && $fecha <= \Carbon\Carbon::parse($publicacion->fecha_fin .' 23:59:59') )
                                                                                <h6 class="featured_title">Cierre de Inscripciones en</h6>
                                                                                <div class="featured-countdown">
                                                                                    <span class="slogan"></span>
                                                                                    <span class="js-countdown" data-timer="{{\Carbon\Carbon::parse($publicacion->fecha_fin .' 23:59:59')->diffInSeconds($fecha)}}"> <!-- 1865550 --> {{--  --}}
                                                                                        {{-- <div aria-hidden="true" class="countdown__timer">
                                                                                            <span class="countdown__item">
                                                                                                <span class="countdown__value countdown__value--0 js-countdown__value--0">21</span>
                                                                                            </span><span class="countdown__item">
                                                                                            <span class="countdown__value countdown__value--1 js-countdown__value--1">14</span>
                                                                                        </span>
                                                                                        <span class="countdown__item">
                                                                                            <span class="countdown__value countdown__value--2 js-countdown__value--2">06</span></span>
                                                                                            <span class="countdown__item">
                                                                                                <span class="countdown__value countdown__value--3 js-countdown__value--3">40</span>
                                                                                            </span>
                                                                                        </div> --}}
                                                                                    </span>
                                                                                    <ul class="desc">
                                                                                        <li>Días</li>
                                                                                        <li>Horas</li>
                                                                                        <li>Minutos</li>
                                                                                        <li>Segundos</li>
                                                                                    </ul>
                                                                                </div>
                                                                                @else
                                                                                    <h6 class="featured_title">Las inscripciones no están disponibles</h6>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="content-wrapper">
                                                                        <div class="content_inner aos-init aos-animate" data-aos="fade-left" data-aos-duration="1200"> <!-- fade-left -->
                                                                            <div class="wrapper">
                                                                                <h6 class="featured_title">Prueba </h6>
                                                                                <div class="featured-countdown">
                                                                                    <span class="slogan"></span>
                                                                                    <span class="js-countdown" data-timer="3610"> <!-- 1865550 --> 
                                                                                       
                                                                                    </span>
                                                                                    <ul class="desc">
                                                                                        <li>Días</li>
                                                                                        <li>Horas</li>
                                                                                        <li>Minutos</li>
                                                                                        <li>Segundos</li>
                                                                                    </ul>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach
                                            @if ($contador == 0)
                                                <p class="text-center">NO HAY CONVOCATORIAS</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="next_slider-4 next_slider"><svg width="18" height="16"
                                            viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 8H16.5M16.5 8L9.75 1.25M16.5 8L9.75 14.75" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="prev_slider-4 prev_slider"><svg width="18" height="16"
                                            viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 8H1.5M1.5 8L8.25 1.25M1.5 8L8.25 14.75" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- HORARIOS -->
                            <div class="content-inner" id="horarios">
                                <div class="container_inner">
                                    <div class="swiper-container slider-5" data-aos="fade-in" data-aos-duration="1000">
                                        <div class="swiper-wrapper">
                                            <div class="row pb-5">
                                                @php $contador = 0; @endphp
                                                @foreach ($publicaciones as $publicacion)
                                                    @if ($publicacion->publicaciones_estado == 'ACTIVO' && $publicacion->publicaciones_tipo == 'Horario')
                                                        @php $contador++; @endphp
                                                        <div class="grid-box-style2 aos-init aos-animate"
                                                            data-aos="fade-up" data-aos-duration="800">
                                                            <div class="image d-flex flex-row-reverse">
                                                                <img src="{{ asset('assets/front_images/horario.png') }}"
                                                                    alt="horario" class="d-block" width="50%">
                                                            </div>
                                                            <div class="content">
                                                                <!-- <a href="" class="tag">IGOs</a> -->
                                                                <h5 class="title">
                                                                    <a>{{ mb_strtoupper($publicacion->publicaciones_titulo) }}</a>
                                                                </h5>
                                                                <p>{{ $publicacion->publicaciones_descripcion }}</p>
                                                            </div>
                                                            <a href="{{ $publicacion->publicaciones_imagen_url }}"
                                                                class="tf-button style1"
                                                                download="{{ $publicacion->publicaciones_titulo }}">
                                                                DESCARGAR
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if ($contador == 0)
                                                    <p class="text-center">NO HAY HORARIOS</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="next_slider-5 next_slider"><svg width="18" height="16"
                                            viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 8H16.5M16.5 8L9.75 1.25M16.5 8L9.75 14.75" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="prev_slider-5 prev_slider"><svg width="18" height="16"
                                            viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5 8H1.5M1.5 8L8.25 1.25M1.5 8L8.25 14.75" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
