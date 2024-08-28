    
<!-- acerca del desarrollo -->
    <div class="modal fade" id="modalAboutMe" data-bs-backdrop="static" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered modal-xl " role="document" >
            <div class="modal-content ">
                <div class="close icon" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/risebothtml/assets/images/backgroup/bg_close.png') }}" alt="">
                </div>
                <div class="header-popup">
                    <h5>DESARRROLLO -SI@DI - Depto. de Idiomas</h5>
                    <div class="spacing"></div>
                </div>
                <div class="modal-body ">
                    <!-- inicio about -->
                    <div class="row "  > <!-- overflow-hidden -->
                        <div class="col-md-2 row-list-menu" >
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link mb-2 active" id="v-pill-v03-tab" data-bs-toggle="pill"
                                    href="#v-pill-v03" role="tab" aria-controls="v-pill-v03"
                                    aria-selected="true">Versión 3.0</a>
                                <a class="nav-link mb-2" id="v-pill-v02-tab" data-bs-toggle="pill"
                                    href="#v-pill-v02" role="tab" aria-controls="v-pill-v02"
                                    aria-selected="false">Versión 2.0</a>
                                <a class="nav-link mb-2" id="v-pill-v01-tab" data-bs-toggle="pill"
                                    href="#v-pill-v01" role="tab" aria-controls="v-pill-v01"
                                    aria-selected="false">Versión 1.0</a>
                            </div>
                            <div class="p-3">
                                <a href="https://sie.upea.bo/" class="pulse-effect" target="_blank" >
                                    <div class="circle"></div>
                                    <div class="circle"></div>
                                    <div class="circle"></div>
                                    <div class="circle"></div>
                                    <div>
                                        <img class="img-fluid" src="https://sie.upea.bo//uploads/logo/logo_sie.png" />
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-10 overflow-auto row-list-devs">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pill-v03" role="tabpanel"
                                    aria-labelledby="v-pill-v03-tab">
                                    <!-- inicio 03 -->
                                    <div class="prodect-content">
                                        <h4 class="heading mb10">System Update 2023</h4>
                                        
                                        <div class="image mb30">
                                            <img class="boder-20" src="{{ asset('assets/front_images/about-me/version03/web_3ra_version.jpg') }}" alt="ff">
                                        </div>
                                        <!-- <div class="box">
                                            <h4 class="heading mb10">1. Características del proyecto</h4>
                                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                            <p>Nulla sed ex in magna ullamcorper lacinia. Maecenas maximus sagittis tellus, ac hendrerit ex. Maecenas ut bibendum ex, at luctus velit. Vestibulum sit amet neque odio. Suspendisse nisl odio, accumsan at ante at, ultrices mollis augue. Morbi id lorem elementum, interdum velit eu, pellentesque felis. Morbi tincidunt ultrices felis sed vulputate. Etiam non nisl congue, ultricies augue eget, tristique enim.</p>
                                            <ul>
                                                <li>
                                                    <span>Praesent fringilla, purus quis congue rutrum, tortor ligula egestas justo, eu venenatis erat tellus ut risus. Nam elit magna, facilisis nec iaculis id</span>
                                                </li>
                                                <li>
                                                    <span>Fusce id erat rutrum, dignissim diam eget, finibus odio. Aenean porta lacus suscipit urna luctus luctus.</span>
                                                </li>
                                            </ul>
                                        </div> -->
                                    
                                        <div class="spacing"></div>
                                        <div class="box">
                                            <h4 class="heading mb10">Equipo de Desarrollo</h4>
                                            <div class="team-box-style2">
                                                <div class="image">
                                                    <img src="{{ asset('assets/front_images/about-me/user_default.png') }}" alt=""> {{-- assets/front_images/about-me/version03/dev_navi.jpg --}}
                                                </div>
                                                <div class="content">
                                                    <h6 class="name">Ivan Tola Villca</h6>
                                                    <p class="position">Desarrollador</p>
                                                    <p>Mi amplia trayectoria me permite liderar y engranar equipos multifuncionales para lograr los objetivos y mejorar los resultados de la empresa a corto plazo.</p>
                                                </div>
                                            </div>
                                            <div class="team-box-style2">
                                                <div class="image">
                                                    <img src="{{ asset('assets/front_images/about-me/version03/dev_gary.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <h6 class="name">Gary Limbert Apaza Mamani</h6>
                                                    <p class="position">Desarrollador</p>
                                                    <p>Disfruto trabajando en equipo, compartiendo información con mis colegas y colaborando con otras áreas de la empresa para lograr los objetivos de la organización.</p>
                                                </div>
                                            </div>
                                            <div class="team-box-style2">
                                                <div class="image">
                                                    <img src="{{ asset('assets/front_images/about-me/version03/dev_freddy.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <h6 class="name">Freddy Mamani Valencia</h6>
                                                    <p class="position">Desarrollador</p>
                                                    <p>Mi objetivo es formar parte de un equipo de profesionales comprometidos capaces de entregar lo mejor de sí para ofrecer las mejores soluciones para la empresa.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin 03 -->
                                </div>
                                <div class="tab-pane fade" id="v-pill-v02" role="tabpanel"
                                    aria-labelledby="v-pill-v02-tab">
                                    <!-- inicio 02 -->
                                    <div class="prodect-content">
                                        <h4 class="heading mb10">System Update 2021</h4>
                                        
                                        <div class="image mb30">
                                            <img class="boder-20" src="{{ asset('assets/front_images/about-me/version02/web_2da_version.jpg') }}" alt="ff">
                                        </div>
                                        <!-- <div class="box">
                                            <h4 class="heading mb10">1. Características del proyecto</h4>
                                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                            <p>Nulla sed ex in magna ullamcorper lacinia. Maecenas maximus sagittis tellus, ac hendrerit ex. Maecenas ut bibendum ex, at luctus velit. Vestibulum sit amet neque odio. Suspendisse nisl odio, accumsan at ante at, ultrices mollis augue. Morbi id lorem elementum, interdum velit eu, pellentesque felis. Morbi tincidunt ultrices felis sed vulputate. Etiam non nisl congue, ultricies augue eget, tristique enim.</p>
                                            <ul>
                                                <li>
                                                    <span>Praesent fringilla, purus quis congue rutrum, tortor ligula egestas justo, eu venenatis erat tellus ut risus. Nam elit magna, facilisis nec iaculis id</span>
                                                </li>
                                                <li>
                                                    <span>Fusce id erat rutrum, dignissim diam eget, finibus odio. Aenean porta lacus suscipit urna luctus luctus.</span>
                                                </li>
                                            </ul>
                                        </div> -->
                                    
                                        <div class="spacing"></div>
                                        <div class="box">
                                            <h4 class="heading mb10">Equipo de Desarrollo</h4>
                                            <div class="team-box-style2">
                                                <div class="image">
                                                    <img src="{{ asset('assets/front_images/about-me/version02/jhulian.png') }}" alt="Ing. Julian">
                                                </div>
                                                <div class="content">
                                                    <h6 class="name">Dany Julian Zenteno T.</h6>
                                                    <p class="position">Desarrollador</p>
                                                    <p>Poseo habilidad para identificar problemas, evaluar opciones y generar soluciones acordes a la realidad y necesidades del sector.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin 02 -->
                                </div>
                                <div class="tab-pane fade" id="v-pill-v01" role="tabpanel"
                                    aria-labelledby="v-pill-v01-tab">
                                    <!-- inicio 01 -->
                                    <div class="prodect-content">
                                        <h4 class="heading mb10">System Development 2016</h4>
                                        
                                        <div class="image mb30">
                                            <img class="boder-20" src="{{ asset('assets/front_images/about-me/version01/web_1ra_version.jpg') }}" alt="ff">
                                        </div>
                                        <!-- <div class="box">
                                            <h4 class="heading mb10">1. Características del proyecto</h4>
                                            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                            <p>Nulla sed ex in magna ullamcorper lacinia. Maecenas maximus sagittis tellus, ac hendrerit ex. Maecenas ut bibendum ex, at luctus velit. Vestibulum sit amet neque odio. Suspendisse nisl odio, accumsan at ante at, ultrices mollis augue. Morbi id lorem elementum, interdum velit eu, pellentesque felis. Morbi tincidunt ultrices felis sed vulputate. Etiam non nisl congue, ultricies augue eget, tristique enim.</p>
                                            <ul>
                                                <li>
                                                    <span>Praesent fringilla, purus quis congue rutrum, tortor ligula egestas justo, eu venenatis erat tellus ut risus. Nam elit magna, facilisis nec iaculis id</span>
                                                </li>
                                                <li>
                                                    <span>Fusce id erat rutrum, dignissim diam eget, finibus odio. Aenean porta lacus suscipit urna luctus luctus.</span>
                                                </li>
                                            </ul>
                                        </div> -->
                                    
                                        <div class="spacing"></div>
                                        <div class="box">
                                            <h4 class="heading mb10">Equipo de Desarrollo</h4>
                                            <div class="team-box-style2">
                                                <div class="image">
                                                    <img src="{{ asset('assets/front_images/about-me/version01/edwin.png') }}" alt="Ing. Edwin">
                                                </div>
                                                <div class="content">
                                                    <h6 class="name">Edwin Mamani Viscarra</h6>
                                                    <p class="position">Desarrollador</p>
                                                    <p>Enfocado en el éxito profesional, siempre me esfuerzo por mantener altos estándares de honestidad y responsabilidad tanto en mi trabajo individual como en la colaboración con mi equipo.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin 01 -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- fin about -->
                </div>

            </div>
        </div>
    </div>
    <!-- fin desarrollo -->
    @push('navi-js-front')
    <script>
        $(document).ready(function(){
            $("#v-pills-tab a").click(function(e){
                e.preventDefault();
                $(this).tab("show");
            });
        });
    </script>
    @endpush