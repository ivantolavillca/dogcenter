<div>
    <div class="row">
        <div class="col-lg-12 text-center mb-4">
            <hr>
        </div>
    </div>
    @if ($fichas->count() > 0)
    <div class="row">
        @foreach ($fichas as $ficha)
        <div class="col mb-4">
            <div class="card ficha-clinica" style="background: #0c1d2a; border: 4px solid #7CFC00; border-radius: 30px;">
                <div class="card-body text-center">
                    <div class="position-relative fade-in" style="top: -50px;">
                        @if($ficha->estado == 'activo')
                        <div class="bg-danger rounded-circle d-flex justify-content-center align-items-center mx-auto mb-4" style="width: 200px; height: 200px;">
                            <span class="text-white display-3" style="color: #7CFC00; font-size: 10rem;">{{$ficha->numeracion}}</span>
                        </div>
                        @elseif($ficha->estado == 'llamar')
                        <div class="bg-success rounded-circle d-flex justify-content-center align-items-center mx-auto mb-4" style="width: 200px; height: 200px; animation: blink 1s infinite;">
                            <span class="text-white display-3" style="color: #7CFC00; font-size: 10rem;">{{$ficha->numeracion}}</span>
                        </div>
                        @endif
                        <h5 class="mt-4 mb-3 text-white">Atención General</h5>
                        <ul class="list-unstyled mb-4">
                            <li class="fs-5" style="color: #7CFC00;">Ficha Nº {{$ficha->numeracion}}</li>
                        </ul>
                        @if($ficha->estado == 'activo')
                        <button type="button" class="btn btn-danger btn-lg" wire:loading.attr="disabled">
                            <span class="visually">Esperando...</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </span>
                        </button>
                        @elseif($ficha->estado == 'llamar')
                        <button class="btn btn-success btn-lg" wire:loading.attr="disabled">
                            <div wire:loading>
                                <i class="bi bi-telephone-inbound" style="font-size: 1rem; animation: pulse 1s infinite;"></i>
                                <span class="visually" style="font-size: 1rem;">Llamada...</span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </span>
                            </div>
                        </button>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <strong>No hay Registros</strong>
            </div>
        </div>
    </div>
    @endif
</div>