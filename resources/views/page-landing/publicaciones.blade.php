@extends('layouts.home-front')
@section('body-page')
    <section class="pricing-section" id="pricing-plan">
        <div class="container">
            <figure class="mb-0 price-circle">
                <img class="img-fluid" src="./assets/images/price-circle.png" alt="">
            </figure>
            <div class="row position-relative">
                @foreach ($publicacioness as $pub)
                    {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="pricing-box">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="pricing_content hover1">
                                        <div class="icon-size1">
                                            <figure class="mb-0 price-basicicon">
                                                <img src="./assets/images/price-basicicon.png" alt=""
                                                    class="img-fluid">
                                            </figure>
                                        </div>
                                        <h5 class="mb-0"> {{ $pub->titulo }}</h5>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                                    <ul class="list-unstyled mb-0 content1">
                                        <li class="text-size-18">Free Consultation</li>
                                        <li class="text-size-18">2GB Storage</li>
                                        <li class="text-size-18">2 Free Download Images</li>
                                    </ul>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                    <div>
                                        <span class="text1 content3">$4.99/mo</span>
                                        <div class="price-button">
                                            <a class="get_started basic" href="./pricing.html">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="pricing-box pricing-box2" data-aos="fade-up">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div
                                        class="pricing_content    @if ($pub->tipo == 'COMUNICADOS') hover1
                                        @elseif($pub->tipo == 'EVENTOS')
                                        hover2
                                        @elseif($pub->tipo == 'PROMOCIÓN')
                                        hover3
                                        @elseif($pub->tipo == 'CAMPAÑA')
                                        hover1 @endif ">

                                        <div class="icon-size2 icon-size3">
                                            <figure class="mb-0 price-businessicon">
                                                <img src="{{ $pub->imagen }}" alt="imagen-publicacion" class="img-fluid">
                                            </figure>
                                        </div>
                                        <h5 class="mb-0">{{ $pub->titulo }}</h5>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-6 col-12 text-center">
                                    <div class="price-button">
                                        <a class="get_started @if ($pub->tipo == 'COMUNICADOS') business
                                        @elseif($pub->tipo == 'EVENTOS')
                                        premium
                                        @elseif($pub->tipo == 'PROMOCIÓN')
                                        basic
                                        @elseif($pub->tipo == 'CAMPAÑA')
                                        business @endif " href="#">{{ $pub->tipo }}</a>
                                    </div>
                                    <h3>{{ $pub->descripcion }}</h3>
                                </div>

                                {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                     <span class="text1 text3 content1 content3">$9.99/mo</span> 

                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach


                {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="pricing-box pricing-box3" data-aos="fade-up">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                <div class="pricing_content hover2">
                                    <div class="icon-size1 icon-size2">
                                        <figure class="mb-0 price-premiumicon">
                                            <img src="./assets/images/price-premiumicon.png" alt=""
                                                class="img-fluid">
                                        </figure>
                                    </div>
                                    <h5 class="mb-0">Premium</h5>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                <ul class="list-unstyled mb-0 content1">
                                    <li class="dot2 text-size-18">Free Consultation</li>
                                    <li class="dot2 text-size-18">2GB Storage</li>
                                    <li class="dot2 text-size-18">2 Free Download Images</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                <ul class="list-unstyled mb-0 content1 content2">
                                    <li class="dot2 text-size-18">Free Consultation</li>
                                    <li class="dot2 text-size-18">2GB Storage</li>
                                    <li class="dot2 text-size-18">2 Free Download Images</li>
                                </ul>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                <div>
                                    <span class="text1 text2 content1 content3 value">$19.99/mo</span>
                                    <div class="price-button">
                                        <a class="get_started premium" href="./pricing.html">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div> 
            <div class="row text-center d-flex justify-content-center">
                {{ $publicacioness->links() }}
                </div>
        </div>
    </section>
@endsection
