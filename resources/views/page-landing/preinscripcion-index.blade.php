@extends('layouts.home-front')

@section('body-page')
<div class="breadcumb-wrapper " data-bg-src="{{asset('assets/landing-page/assets/img/fondo1.jpg')}}">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">PREINSCRIPCION</h1>
                <p class="breadcumb-text">-------</p>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{route('inicio.index')}}">Homes</a></li>
                        <li>Pre Inscripción</li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!--==============================
    About Area
==============================-->
    {{-- <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="title-area text-md-center mb-4 mb-lg-5">
                <div class="sec-icon"><span class="vs-circle"></span></div>
                <span class="sec-subtitle">ENVIRONMENT DESIGNED TO INSPIRE</span>
                <h2 class="sec-title h1"> Undergraduate and Graduate Students Pursue their Academic goals</h2>
            </div>
            <div class="row gx-60">
                <div class="col-xl-6 mb-4 mb-lg-0">
                    <h3 class="h4 mb-3 mb-lg-4 pb-lg-2">About Academic</h3>
                    <p>Ducamb welcomed every pain avoided but in certain circumstances owi to the claims of igation that off business it will frequently occu the obliga ns of business it will frequently ofcurs that pleasures. Certain circumstan owing to claims duty oour free hours when our power of choice is notpre Ducamb welcomed every pain avoided.</p>
                    <p>Ducamb welcomed every pain avoided but in certa in circumstances owi to the claims of igation that off business it will frequently.</p>
                </div>
                <div class="col-xl-6">
                    <h3 class="h4 mb-3 mb-lg-4 pb-lg-2">Academic Resources</h3>
                    <div class="row gx-3 pt-2">
                        <div class="col-md-6">
                            <div class="vs-list list-style3">
                                <ul>
                                    <li><a href="academic-program.html">Undergraduate Admissions</a></li>
                                    <li><a href="academic-program.html">Academic Calendar</a></li>
                                    <li><a href="academic-program.html">Campus Offices and Services</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="vs-list list-style3">
                                <ul>
                                    <li><a href="academic-program.html">Graduate Admissions</a></li>
                                    <li><a href="academic-program.html">Research Courses</a></li>
                                    <li><a href="team.html">Meet with an Advisor</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-relative overflow-hidden rounded-20 mt-5">
                <img src="assets/img/about/academic-1.jpg" alt="blog video">
                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn popup-video position-center"><i class="fas fa-play"></i></a>
            </div>
        </div>
    </section> --}}

    <br>    
    <br>    
    <br>    
    <br>    
    <section class=" space-extra-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-center justify-content-xl-between flex-row-reverse">
                <div class="col-xl-5 col-xxl-auto wow fadeInUp" data-wow-delay="0.3s">
                    <div class="img-box1">
                        <div class="vs-circle">
                            <div class="mega-hover">
                                <img src="{{asset('assets/landing-page/assets/img/upealogo.gif')}}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-xxl text-center text-xl-start">
                    <div class="form-style1">

                        <h2 class="form-title h1">REGISTRO DE PRE INSCRIPCIÓN</h2>
                     
                       <div>
                       
                    
                        <div class="form-group col-12">
                            <div class="form-inner">
                                <div class="form-group col-auto">
                                    <div class="form-group col-12">
                                        <div class="form-inner">
                                            
                                           
                                            @livewire('landig-page.preinscripcion-index')

                                            <!-- dfdsfg -->

                                        </div>
                                    </div>
                                    
                                </div>
                    
                               
                            </div>
                        </div>
                    </div>
           
                    
                   
                     
                   
                   
                </div>
            </div>
        </div>
    </section><!--==============================
      Programm Area
  ==============================-->
   
    
@endsection