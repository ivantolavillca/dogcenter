@extends('layouts.home-front')
@section('body-page')
    <!-- About Us -->
    <section class="aboutus-section overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="aboutus_content">
                        <h4>DETALLES</h4>
                        <h2 class="mb-0 ">Atención hasta en FERIADOS</h2>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="aboutus_text" data-aos="fade-left">
                        <p class="mb-0 ">Aprovecha tu feriado para traer a tu mascotita 🐶🐱 a su control veterinario 🥰
                            Recuerda que la salud de tu mascota es muy importante y por eso nosotros nunca cerramos 😉
                            atendemos las 24 Horas y los 7 días de la semana ❤️
                            DOG CENTER</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features -->
    <section class="basic-feature" id="basic-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="feature_wrapperleft">
                        <figure class="mb-0 feature-circle">
                            <img class="img-fluid" src="{{ $institucion->url_logo }}" alt="">
                        </figure>
                        <figure class="mb-0 featurephoneback">
                            <img src="{{ $institucion->url_logo }}" alt="">
                        </figure>
                        <figure class="mb-0 featurephone">
                            <img class="img-fluid" src="{{ $institucion->url_logo }}" alt="">
                        </figure>
                        <figure class="mb-0 featurephone-over">
                            <img class="img-fluid" src="{{ $institucion->url_logo }}" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="feature_wrapperright">
                        <div class="feature_content">
                            <h4>NUESTROS SERVICIOS</h4>
                            <h2>CONTAMOS CON :</h2>
                        </div>
                        <div class="feature_lowercontent" data-aos="fade-up">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>- RAYOS X</h6>
                                            <p class="text-size-18 mb-0">Diagnóstico por imágenes para identificar problemas
                                                de salud en mascotas.</p>
                                        </div>
                                    </div>
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>- ECOGRAFÍA</h6>
                                            <p class="text-size-18 mb-0">Imágenes en tiempo real para diagnosticar embarazos
                                                y evaluar órganos internos.</p>
                                        </div>
                                    </div>
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>-LABORATORIO</h6>
                                            <p class="text-size-18 mb-0">Análisis de sangre, orina y otros fluidos para
                                                diagnosticar enfermedades.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>-TRAUMATOLOGÍA</h6>
                                            <p class="text-size-18 mb-0">Tratamiento de lesiones traumáticas en animales.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>-CIRUGÍAS</h6>
                                            <p class="text-size-18 mb-0">Procedimientos quirúrgicos para tratar diversas
                                                condiciones médicas.</p>
                                        </div>
                                    </div>
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>-CONSULTAS</h6>
                                            <p class="text-size-18 mb-0">Sesiones con veterinarios para discutir problemas
                                                de salud de mascotas.</p>
                                        </div>
                                    </div>
                                    <div class="feature-design">
                                        <div class="feature-box">

                                            <h6>-VACUNAS</h6>
                                            <p class="text-size-18 mb-0">Inmunización preventiva para proteger a las
                                                mascotas contra enfermedades.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- offer-video -->
    <div class="offer-videosection">
        <div class="container">
            <div class="row position-relative">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="position-relative">
                        <a class="popup-vimeo" href="https://www.youtube.com/watch?v=-NVHn19CnDY">
                            <figure class="mb-0 vediosession">
                                <img class="thumb img-fluid" style="cursor: pointer"
                                    src="{{ asset('assets/apprista/assets/images/image-videosession.png') }}"
                                    alt="">
                            </figure>
                        </a>
                    </div>
                </div>
                <figure class="mb-0 image-sidecircle">
                    <img class="img-fluid" src="{{ asset('assets/apprista/assets/images/image-sidecircle.png') }}"
                        alt="">
                </figure>
            </div>
        </div>
    </div>
    <!-- offers -->
    <section class="offer-section">
        <div class="container">
            <figure class="mb-0 offer-sidelayer">
                <img src="./assets/images/offer-sidelayer.png" alt="">
            </figure>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="offer_content" data-aos="fade-down">
                        <h4 class="text-white">Consejos para el cuidado de mascotas</h4>
                        <h2 class="text-white">¡Una app totalmente personalizada para ti!</h2>
                        <p class="text-white">Descubre cómo puedes mantener a tus mascotas felices y saludables con estos
                            simples consejos:</p>
                        <p class="text-white">- Proporciona una dieta balanceada y agua fresca diariamente.<br>
                            - Brinda ejercicio regular y tiempo de juego.<br>
                            - Programa visitas regulares al veterinario para chequeos de salud.<br>
                            - Mantén al día las vacunas y tratamientos contra parásitos.<br>
                            - Proporciona un ambiente limpio y seguro en el hogar.<br>
                            - Proporciona amor, atención y afecto diariamente.</p>
                        <div class="offer-imagewrapper">
                            <a class="image_apple" href="https://www.apple.com/app-store/">
                                <figure class="mb-0 offer-apple">
                                    <img class="img-fluid" src="./assets/images/bannerapple-img1.png" alt="">
                                </figure>
                            </a>
                            <a class="image_google" href="https://play.google.com/store/games">
                                <figure class="mb-0 offer-google">
                                    <img class="img-fluid" src="./assets/images/bannergoogle-img2.png" alt="">
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <!-- Ease of Search -->
    <section class="search-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="search_content" data-aos="fade-up">
                        <figure class="search-icon">
                            <img src="./assets/images/search-icon.png" alt="" class="img-fluid">
                        </figure>
                        <h2>Ease Of Search</h2>
                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                            max me placeat facere possimus omnis.</p>
                        <p class="p-text">Assumenda est, omnis dolor repellendus temoriu autem quibusdam et aut officiis
                            repudiandae sint molestiae non recusandae. </p>
                        <div class="search-button">
                            <a class="try_free_btn" href="./contact.html">Try For Free</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="search_wrapper">
                        <figure class="mb-0 search-sidecircle">
                            <img class="img-fluid" src="./assets/images/search-sidecircle.png" alt="">
                        </figure>
                        <figure class="mb-0 search-phoneback">
                            <img src="./assets/images/search-phoneback.png" alt="">
                        </figure>
                        <figure class="mb-0 search-phone1">
                            <img class="img-fluid" src="./assets/images/search-phone1.png" alt="">
                        </figure>
                        <figure class="mb-0 search-phone2">
                            <img class="img-fluid" src="./assets/images/search-phone2.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <!-- Manage -->
            <div class="manage-section">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-md-1 order-2">
                        <div class="manage_wrapper">
                            <figure class="mb-0 manage-sidecircle">
                                <img class="img-fluid" src="./assets/images/manage-sidecircle.png" alt="">
                            </figure>
                            <figure class="mb-0 manage-phoneback">
                                <img src="./assets/images/manage-phoneback.png" alt="">
                            </figure>
                            <figure class="mb-0 manage-phone2">
                                <img class="img-fluid" src="./assets/images/manage-phone2.png" alt="">
                            </figure>
                            <figure class="mb-0 manage-phone1">
                                <img class="img-fluid" src="./assets/images/manage-phone1.png" alt="">
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-md-2 order-1">
                        <div class="manage_content" data-aos="fade-up">
                            <figure class="search-icon manage-icon">
                                <img src="./assets/images/manage-icon.png" alt="" class="img-fluid">
                            </figure>
                            <h2>Manage Your Ad’s</h2>
                            <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id
                                quod max me placeat facere possimus omnis.</p>
                            <p class="p-text">Assumenda est, omnis dolor repellendus temoriu autem quibusdam et aut
                                officiis repudiandae sint molestiae non recusandae. </p>
                            <div class="manage-button">
                                <a class="try_free_btn" href="./contact.html">Try For Free</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- statistics -->
    <section class="statistics-section" id="statistics">
        <div class="container">
            <figure class="mb-0 statistics-sidelayer">
                <img src="./assets/images/statistics-sidelayer.png" alt="">
            </figure>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="statistics_content">
                        <h4 class="text-white">App Information</h4>
                        <h2 class="text-white">Explore Our Statistics</h2>
                        <p class="text-white">Repellendus temporibus autem quibusdam et aut officiis debitis aut rerum
                            necessitatibus saepe eveniet voluptates repudiandae sint et molestiae non recusandae.</p>
                    </div>
                </div>
            </div>
            <div class="statistics-value" data-aos="fade-down">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="number1">
                            <span class="value1 counter">1430</span>
                            <sup class="mb-0 plus">+</sup>
                            <span class="text1">Clients</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="number1">
                            <span class="value1 counter">2430</span>
                            <sup class="mb-0 plus">+</sup>
                            <span class="text1 text2">Beneficiaries</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="number1">
                            <span class="value1 counter">1810</span>
                            <sup class="mb-0 plus">+</sup>
                            <span class="mb-0 text1 text3">Reviews</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                        <div class="number1 number4">
                            <span class="value1 counter">10253</span>
                            <sup class="mb-0 plus">+</sup>
                            <span class="mb-0 text1 text4">Downloads</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Plan -->
    <section class="price-section">
        <div class="container">
            <figure class="mb-0 price-circle">
                <img class="img-fluid" src="./assets/images/price-circle.png" alt="">
            </figure>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="price_heading">
                        <h4>What We Offer</h4>
                        <h2>Choose Your Pricing Plan</h2>
                    </div>
                </div>
            </div>
            <div class="price-block">
                <div class="row" data-aos="fade-up">
                    <figure class="mb-0 price-sidecircle">
                        <img class="img-fluid" src="./assets/images/price-sidecircle.png" alt="">
                    </figure>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-md-0 mb-4">
                        <div class="price_content hover1">
                            <div class="icon-size1">
                                <figure class="mb-0 price-basicicon">
                                    <img src="./assets/images/price-basicicon.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                            <h5 class="mb-0">Basic</h5>
                            <span class="text1">$4.99/mo</span>
                            <ul class="list-unstyled mb-0">
                                <li class="text-size-18">Free Consultation</li>
                                <li class="text-size-18">2GB Storage</li>
                                <li class="text-size-18">2 Free Download Images</li>
                                <li class="text-size-18">Monthly Reports</li>
                                <li class="for-space text-size-18">24/7 Full Support</li>
                            </ul>
                            <div class="price-button">
                                <a class="get_started basic" href="./pricing.html">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-md-0 mb-4">
                        <div class="price_content price_content1 hover2">
                            <div class="icon-size1 icon-size2">
                                <figure class="mb-0  price-premiumicon">
                                    <img src="./assets/images/price-premiumicon.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                            <h5 class="mb-0">Premium</h5>
                            <span class="text1 text2">$9.99/mo</span>
                            <ul class="list-unstyled mb-0">
                                <li class="text-size-18">Free Consultation</li>
                                <li class="text-size-18">2GB Storage</li>
                                <li class="text-size-18">2 Free Download Images</li>
                                <li class="text-size-18">Monthly Reports</li>
                                <li class="for-space text-size-18">24/7 Full Support</li>
                            </ul>
                            <div class="price-button">
                                <a class="get_started premium" href="./pricing.html">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="price_content price_content2 hover3">
                            <div class="icon-size1 icon-size3">
                                <figure class="mb-0  price-businessicon">
                                    <img src="./assets/images/price-businessicon.png" alt="" class="img-fluid">
                                </figure>
                            </div>
                            <h5 class="mb-0">Business</h5>
                            <span class="text1 text3">$19.99/mo</span>
                            <ul class="list-unstyled mb-0">
                                <li class="text-size-18">Free Consultation</li>
                                <li class="text-size-18">2GB Storage</li>
                                <li class="text-size-18">2 Free Download Images</li>
                                <li class="text-size-18">Monthly Reports</li>
                                <li class="for-space text-size-18">24/7 Full Support</li>
                            </ul>
                            <div class="price-button">
                                <a class="get_started business" href="./pricing.html">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ's -->
    <section class="accordian-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="accordian_content">
                        <h4>Ask Something?</h4>
                        <h2>Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>
            <div class="row position-relative" data-aos="fade-up">
                <div class="col-lg-1 col-md-1 col-sm-1 d-lg-block d-none"></div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="accordian-section-inner position-relative">
                        <div class="accordian-inner">
                            <div id="accordion1">
                                <div class="accordion-card">
                                    <div class="card-header" id="headingOne">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <h6>Maiores alias conseuatur aut peruerendis?</h6>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                                        <div class="card-body">
                                            <p class="pp text-left mb-0 p-0">Incidunt ut labore et dolore magnam aliquam
                                                quaerat voluptatem ut enim ad minima veniam, quis nostrum exercitationem
                                                ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                                                consequatur accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                quae ab illo inventore veritatis et quasi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingTwo">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h6>Dolor renellendus temporibus autem zuibusdam?</h6>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                                        <div class="card-body">
                                            <p class="pp text-left mb-0 p-0">Incidunt ut labore et dolore magnam aliquam
                                                quaerat voluptatem ut enim ad minima veniam, quis nostrum exercitationem
                                                ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                                                consequatur accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                quae ab illo inventore veritatis et quasi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingThree">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            <h6>Officia deserunt mollitia animi est laborum?</h6>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
                                        <div class="card-body">
                                            <p class="pp text-left mb-0 p-0">Incidunt ut labore et dolore magnam aliquam
                                                quaerat voluptatem ut enim ad minima veniam, quis nostrum exercitationem
                                                ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                                                consequatur accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                quae ab illo inventore veritatis et quasi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-card">
                                    <div class="card-header" id="headingFour">
                                        <a href="#" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            <h6>Reiciendis voluptatibus maiores alias consequatur?</h6>
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour">
                                        <div class="card-body">
                                            <p class="pp text-left mb-0 p-0">Incidunt ut labore et dolore magnam aliquam
                                                quaerat voluptatem ut enim ad minima veniam, quis nostrum exercitationem
                                                ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                                                consequatur accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                                                quae ab illo inventore veritatis et quasi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 d-lg-block d-none"></div>
                <figure class="mb-0 faq_shape">
                    <img src="./assets/images/faq_icon.png" alt="" class="img-fluid">
                </figure>
            </div>
        </div>
    </section>
    <!-- Available -->
    <section class="available-section" id="get-app">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                    <div class="available_content">
                        <h2 class="text-white">Apps available For all Devices</h2>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliuaenim minim veniam exercitationem. </p>
                        <div class="available-imagewrapper">
                            <a class="image_apple" href="https://www.apple.com/app-store/">
                                <figure class="mb-0 available-apple">
                                    <img class="img-fluid" src="./assets/images/bannerapple-img1.png" alt="">
                                </figure>
                            </a>
                            <a class="image_google" href="https://play.google.com/store/games">
                                <figure class="mb-0 available-google">
                                    <img class="img-fluid" src="./assets/images/bannergoogle-img2.png" alt="">
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="available_wrapper">
                        <figure class="mb-0 available-phone1">
                            <img class="img-fluid" src="./assets/images/available-phone1.png" alt="">
                        </figure>
                        <figure class="mb-0 available-phone3">
                            <img src="./assets/images/available-phone3.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <figure class="mb-0 available-phone2">
                <img class="img-fluid" src="./assets/images/available-phone2.png" alt="">
            </figure>
            <figure class="mb-0 available-sidelayer">
                <img src="./assets/images/available-sidelayer.png" alt="">
            </figure>
        </div>
    </section> --}}
@endsection
