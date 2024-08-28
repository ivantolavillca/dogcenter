@push('navi-css-front')
    <style>
        :root {
            --tamanio-borde: 0px;
            --y-move-vertical: 0px;
        }
        .card-certificado {
            background: #1e2835;
        }

        .certificado-contenedor {
            position: relative;
            width: calc(280px + var(--tamanio-borde) * 2); /* 220 */
            height: calc(356px + var(--tamanio-borde) * 2); /* 280 */
            box-sizing:border-box;
            border: solid black var(--tamanio-borde);
            user-select: none;

            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 5px;

            transform: scale(1);
            margin-bottom: 10px;
        }
        .certificado-contenedor > img {
            display: block;
            width: 100%;
        }

        .certificado-contenedor span {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            padding: 0px 1px;
            text-align: center;
            color: #000;
            background: rgba(0, 139, 139, .0);
        }

        .certificado-contenedor.formato1 .codigo,
        .certificado-contenedor.formato4 .codigo,
        .certificado-contenedor.formato3 .codigo {
            top: calc(61.5px + var(--y-move-vertical) );
            left: 221px;
            width: 42px;
        }
        .certificado-contenedor.formato2 .codigo{
            top: calc(59px + var(--y-move-vertical) );
            left: 223.5px;
            width: 41.5px;
        }
        
        .certificado-contenedor.formato1 .ci,
        .certificado-contenedor.formato4 .ci,
        .certificado-contenedor.formato3 .ci {
            top: calc(115px + var(--y-move-vertical) );
            left: 215.5px;
            width: 48px;
        }
        .certificado-contenedor.formato2 .ci {
            top: calc(115.5px + var(--y-move-vertical) );
            left: 220px;
            width: 45px;
        } 

        .certificado-contenedor.formato1 .nombre_persona,
        .certificado-contenedor.formato4 .nombre_persona,
        .certificado-contenedor.formato3 .nombre_persona {
            top: calc(139.5px + var(--y-move-vertical));
            left: 48.5px;
            width: 218.5px;
            font-size: 9px;
        }
        .certificado-contenedor.formato2 .nombre_persona {
            top: calc(146px + var(--y-move-vertical) );
            left: 49.5px;
            width: 209.5px;
            font-size: 9px;
        }

        .certificado-contenedor.formato1 .idioma,
        .certificado-contenedor.formato4 .idioma,
        .certificado-contenedor.formato3 .idioma {
            top: calc(169px + var(--y-move-vertical) );
            left: 48.5px;
            width: 218.5px;
            font-size: 8px;
        }
        .certificado-contenedor.formato2 .idioma {
            top: calc(175px + var(--y-move-vertical));
            left: 49.5px;
            width: 209.5px;
            font-size: 8px;
        }

        .certificado-contenedor.formato1 .modalidad,
        .certificado-contenedor.formato4 .modalidad,
        .certificado-contenedor.formato3 .modalidad {
            top: calc(182px + var(--y-move-vertical) );
            left: 101px;
            width: 166px;
        }
        .certificado-contenedor.formato2 .modalidad {
            top: calc(189.75px + var(--y-move-vertical) ); 
            left: 101.5px;
            width: 157.5px;
        }

        .certificado-contenedor.formato1 .gestion,
        .certificado-contenedor.formato4 .gestion,
        .certificado-contenedor.formato3 .gestion {
            top: calc(192.5px + var(--y-move-vertical) );
            left: 125.5px;
            width: 141.5px;
        }
        .certificado-contenedor.formato2 .gestion {
            top: calc(204px + var(--y-move-vertical) );
            left: 126px;
            width: 133px;
        }

        .certificado-contenedor.formato1 .carga-horaria,
        .certificado-contenedor.formato4 .carga-horaria,
        .certificado-contenedor.formato3 .carga-horaria {
            top: calc(204px + var(--y-move-vertical) );
            left: 145px;
            width: 122px;
        }

        .certificado-contenedor.formato2 .carga-horaria{
            top: calc(180.5px + var(--y-move-vertical) );
            left: 157.5px;
            width: 46.5px;
            text-align: left;
            background: rgba(255, 0, 0, 0);
            display: none;
        }
        .certificado-contenedor.formato2 .carga-horaria:before {
            content: 'con ';
        }

        .certificado-contenedor.formato1 .fecha-dia,
        .certificado-contenedor.formato4 .fecha-dia,
        .certificado-contenedor.formato3 .fecha-dia {
            left: 152.5px;
            width: 14px;
        }
        .certificado-contenedor.formato2 .fecha-dia {
            left: 152px;
            width: 19px;
        }

        .certificado-contenedor.formato1 .fecha-mes,
        .certificado-contenedor.formato4 .fecha-mes,
        .certificado-contenedor.formato3 .fecha-mes {
            left: 173.5px;
            width: 52px;
        }
        .certificado-contenedor.formato2 .fecha-mes {
            left: 178px;
            width: 53px;
        }

        .certificado-contenedor.formato1 .fecha-anio,
        .certificado-contenedor.formato4 .fecha-anio,
        .certificado-contenedor.formato3 .fecha-anio {
            left: 241px;
            width: 18px;
            text-align: left;
        }
        .certificado-contenedor.formato2 .fecha-anio {
            left: 244.5px;
            width: 17.5px;
            text-align: left;
        }

        .certificado-contenedor.formato1 .fecha-dia,
        .certificado-contenedor.formato1 .fecha-mes,
        .certificado-contenedor.formato1 .fecha-anio,
        .certificado-contenedor.formato4 .fecha-dia,
        .certificado-contenedor.formato4 .fecha-mes,
        .certificado-contenedor.formato4 .fecha-anio {
            top: calc(247.25px + var(--y-move-vertical) ); /* 199.25px; */
        }
        .certificado-contenedor.formato2 .fecha-dia,
        .certificado-contenedor.formato2 .fecha-mes,
        .certificado-contenedor.formato2 .fecha-anio {
            top: calc(243.75px + var(--y-move-vertical) );
        }
        .certificado-contenedor.formato3 .fecha-dia,
        .certificado-contenedor.formato3 .fecha-mes,
        .certificado-contenedor.formato3 .fecha-anio {
            top: calc(257.25px + var(--y-move-vertical) ); /* 207.25px; */
        }

        .certificado-contenedor .qr {
            background: #fff;
            padding: 2px;
        }

        .certificado-contenedor.formato2 .qr,
        .certificado-contenedor.formato1 .qr,
        .certificado-contenedor.formato4 .qr {
            top: calc(305px + var(--y-move-vertical) );
            left: 60px;
        }
        .certificado-contenedor.formato3 .qr {
            top: calc(40.5px + var(--y-move-vertical) );
            left: 230px;
        }

        @media only screen and (min-width: 640px){
            .certificado-contenedor {
                margin-top: 210px;
                transform: scale(2); /* 1.25 */
                border-color: red;
                margin-bottom: 220px;
            }
        }
        @media only screen and (min-width: 768px){
            .certificado-contenedor {
                margin-top: 280px;
                transform: scale(2.5);
                border-color: yellow;
                margin-bottom: 290px;
            }
        }
        @media only screen and (min-width: 1024px){
            .certificado-contenedor {
                margin-top: 380px;
                transform: scale(3);
                border-color: darkred;
                margin-bottom: 390px;
            }
        } /* 1280px */
    
    </style>
@endpush
<div class="card card-certificado">
    <div class="card-body">

        <h2 class="card-title text-center">VERIFICAR CERTIFICADO</h2>
        <div class="row g-3">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <label class="mb-1" for="codigoCertificado">Código de Certificado</label>
                <input type="text" class="form-control" maxlength="10"
                    id="codigoCertificado" wire:model="search_codigo" placeholder="Ej: R0001/2023" />
                    <br>
                @error('search_codigo') <span class="error">{{ $message }}</span> @enderror
            </div>

            
            <div class="col-md-3">
                <label class="mb-1" for="ciCertificado">C.I. sin extesión</label>
                <input type="text" class="form-control" maxlength="12" minlength="4"
                    id="ciCertificado" wire:model="search_ci" placeholder="Ej: 786734" {{$status_ci==true? '': 'disabled'}} />
                    <br>
                    @error('search_ci') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            @if($status_fecha) <!-- $status_fecha -->
            <div class="col-md-3">
                <label class="form-label" for="fecha_2">Fecha:</label>
                <input type="date" class="form-control" id="fecha_2" wire:model="search_fecha_certificado" value="{{$search_fecha_certificado}}" required pattern="\d{4}-\d{2}-\d{2}">
                @error('search_fecha_certificado') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            @endif
        </div>

        <hr>

        @if(strlen($search_codigo)==10 && strlen($search_ci)>0)
            @if(is_null($certificado))
                <p>No existe Certificado</p>
            @else
            @php #$certificado->plantilla = 'n_certificado_1_3.jpg'; $certificado->formato = 'formato1'; 
                $formato = '';
                $plantilla = '';
                try {
                    $formatos_tmp = include( app_path('ArraysData/formatos_data_array.php') );
                    $formato = $formatos_tmp[$certificado->numero_siadi_certificado]['formato'];
                    $plantilla = $formatos_tmp[$certificado->numero_siadi_certificado]['recurso'];
                }catch(\Exception $e){
                    # error
                }
            @endphp
                

                <div class="d-flex justify-content-center">
                    <div class="certificado-contenedor {{ $formato }}">
                        <img src="{{ asset('cert/'.$plantilla) }}" 
                            alt="Certificado {{$certificado->codigo_siadi_certificado}}">
                        <span class="codigo">N° {{$certificado->codigo_siadi_certificado}}</span>
                        <span class="ci">{{$certificado->ci}}</span>

                        <span class="nombre_persona">{{$certificado->nombres_persona}}</span>
                        <span class="idioma">{{$certificado->idioma}}</span>

                        <span class="modalidad">{{$certificado->modalidad}}</span>
                        <span class="gestion">{{$certificado->gestion}}</span>
                        <span class="carga-horaria">{{$certificado->carga_horaria}}</span>
                        <span class="fecha-dia">{{ \Carbon\Carbon::parse($certificado->fecha)->isoFormat('DD')}}</span>
                        <span class="fecha-mes">{{ utf8_decode(strtoupper(\Carbon\Carbon::parse($certificado->fecha)->locale('es')->isoFormat('MMMM'))) }}</span>
                        <span class="fecha-anio">{{ \Carbon\Carbon::parse($certificado->fecha)->isoFormat('YY')}}</span>

                        <span class="qr">{!!QrCode::size(20)->generate($certificado->codigo_qr) !!}</span>
                    </div>
                </div>
            @endif
        @else 
        	@if($status_fecha)
        		<p>Ingrese el <b class="text-white">código</b> superior de su certificado, <b class="text-white">ci</b> sin extensión y la <b class="text-white">fecha</b>.</p>
            	<img src="{{ asset('assets/front_images/ejemplos_certificados/ejemplo_certificado_reimpresion.jpg') }}" class="img-fluid" alt="certificado reimpresión de muestra">
        	@else
            	<p>Ingrese el (yu)<b class="text-white">código</b> superior de su certificado y su <b class="text-white">ci</b> sin extensión</p>
            	<img src="{{ asset('assets/front_images/ejemplos_certificados/ejemplo_certificado.jpg') }}" class="img-fluid" alt="certificado de muestra">
            @endif
        @endif
        
    </div>
</div>

@push('navi-js-front')
    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form advanced verificar -->
    <script>
        !(function (i) {
            "use strict";
            function a() {}
            (a.prototype.init = function () {
                // i({}),
                i("input#ciCertificado").maxlength({ alwaysShow: !0, warningClass: "badge bg-success", limitReachedClass: "badge bg-danger", separator: "/", validate: !0 }),
                i("input#codigoCertificado").maxlength({ alwaysShow: !0, warningClass: "badge bg-warning", limitReachedClass: "badge bg-success", separator: " de ", preText: "Debes introducir ", postText: " carácteres", validate: !0 });
            }),
                (i.AdvancedForm = new a()),
                (i.AdvancedForm.Constructor = a);
        })(window.jQuery),
            (function () {
                "use strict";
                window.jQuery.AdvancedForm.init();
        })();
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            
            Livewire.on("mos", ($cad)=> {
                console.log($cad);
            });
        });
    </script>
@endpush

