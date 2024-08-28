<div wire:ignore.self id="modalreporteantiguo" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="false">

    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5  border-primary">
            <div class="modal-header">
                <div class="row">
                    <div class="text-center text-info h5"> HISTORIALES QUE TIENE</div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <label for="gestiones" class="form-label">Buscar historial </label>
                <input type="text" class="form-control" wire:model="search2">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">

                        <label class="form-label">NOMBRE DEL DUEÑO<span class="text-danger">*</span></label>
                        @if ($registro_completoh)
                            <p>{{ $registro_completoh->mascot_clie->nombre }}</p>
                        @endif
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                        @if ($registro_completoh)
                            <p>{{ $registro_completoh->nombre }}</p>
                        @endif
                        <hr>
                    </div>


                </div>




                <div class="modal-header">
                    @if (true)
                        <div class="row">
                            <div class="text-center text-info h5"> Imagenes de Historiales Antiguos </div>
                        </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Gallery -->
                        <div class="row" style="height: 300px; overflow-y: auto;">
                            @if ($historiales)
                                @foreach ($historiales as $imagen)
                                    <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                                        <div class="position-relative">
                                            @if (Str::endsWith($imagen->url, '.pdf'))
                                                <p>Archivo PDF</p>
                                            @else
                                                <img src="{{ $imagen->urlimagen }}" class="w-100 shadow-1-strong rounded mb-4" alt="{{ $imagen->descripcion }}" style="height: 150px;" />
                                            @endif
                                            <div class="position-absolute top-50 start-50 translate-middle">
                                                <button type="button" class="btn btn-danger waves-effect" 
                                    wire:click.prevent="$emit('elimnarhistorialanti', {{ $imagen->id }})"><i class="bx bxs-trash"></i></button>

                                                
                                                <a href="{{ $imagen->urlimagen }}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-center">
                                    {{ $historiales->links() }}
                                </div>
                                @else
                               
                                <div class="px-5 py-3 border-gray-200 text-sm">
                                    <strong>No hay Registros</strong>
                                </div>
                            @endif
                        </div>
                        <!-- Gallery -->
                    
                    </div>
                </div>



                <hr>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="limpiarmodalHistorialreporte">SALIR</button>

                </div>
            </div>

        </div>
    </div>
</div>
