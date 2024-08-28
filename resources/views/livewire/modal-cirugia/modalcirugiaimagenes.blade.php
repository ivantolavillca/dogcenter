<div wire:ignore.self id="modalcirugiaimagen" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <div class="modal-header">
                @if (true)
                    <div class="row">
                        <div class="text-center text-info h5"> Imagenes de Cirugias </div>
                    </div>
                @endif
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Gallery -->
                    <div class="row" style="height: 300px; overflow-y: auto;">
                        @if ($registrosciruimg)
                            @foreach ($registrosciruimg as $imagen)
                                <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                                    <div class="position-relative">
                                        @if (Str::endsWith($imagen->url, '.pdf'))
                                            <p>Archivo PDF</p>
                                        @else
                                            <img src="{{ $imagen->url }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $imagen->descripcion }}" style="height: 150px;" />
                                        @endif
                                        <div class="position-absolute top-50 start-50 translate-middle">
                                            <button class="btn btn-danger" wire:click="BorrarImagen_cirugia({{ $imagen->id }})"><i class="bx bxs-trash"></i></button>
                                            <a href="{{ $imagen->url }}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Gallery -->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="CerrarImagenesCirugias">CANCELAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
