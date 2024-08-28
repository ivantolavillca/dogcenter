<div class="col-lg-10">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">VERIFICAR CERTIFICADO</h4>
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
                @php # $certificado->plantilla = 'o_certificado_2_6.jpg'; $certificado->formato = 'formato2'; @endphp
                    

                    <div class="d-flex justify-content-center">
                        <div class="certificado-contenedor {{ $certificado->formato }}">
                            <img src="{{ asset('cert/'.$certificado->plantilla) }}" 
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
                <p>Ingrese el N° superior de su certificado </p>
                <img src="img-fluid" alt="Imagen de codigo de muestra">
            @endif
            
        </div>
    </div>
</div>
<script src="{{ asset('assets/dashboard/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

<script src="{{ asset('assets/dashboard/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<!-- form advanced init -->
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
