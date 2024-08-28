<div>





    <!-- Button trigger modal -->


    <!-- Modal -->

    <input type="text" placeholder="Ingresa tu Cédula de Identidad" wire:model="ci">


    <button class="icon-btn" wire:click="ValidarPersonaRegistrada"><i class="fal fa-search"></i></button>
    @error('ci')
        <span class="text-danger">{{ $message }}</span>
    @enderror





    <div wire:ignore.self class="modal fade" id="crear_persona" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">FORMULARIO DE PREINSCRIPCION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">C.I.:</label>
                                <input type="text" class="form-control form-control-small" wire:model="ci">
                                @error('ci')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">EXPEDIDO:</label>
                                <input type="text" class="form-control form-control-small" wire:model="expedido">
                                @error('expedido')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">NOMBRE:</label>
                                <input type="text" class="form-control form-control-small" wire:model="nombre">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PATERNO:</label>
                                <input type="text" class="form-control form-control-small" wire:model="paterno">
                                @error('paterno')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">MATERNO:</label>
                                <input type="text" class="form-control form-control-small" wire:model="materno">
                                @error('materno')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">ESTADO CIVIL:</label>
                                <select class="form-control"wire:model="estado_civil">
                                    <option>Elegir...</option>
                                    <option value="SOLTERO">SOLTERO</option>
                                    <option value="CASADO">CASADO</option>
                                    <option value="VIUDO">VIUDO</option>
                                    <option value="DIVORCIADO">DIVORCIADO</option>
                                </select>

                                @error('estado_civil')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">TELEFONO:</label>
                                <input type="text" class="form-control form-control-small" wire:model="telefono">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">CELULAR:</label>
                                <input type="text" class="form-control form-control-small" wire:model="celular">
                                @error('celular')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">FECHA NACIMIENTO:</label>
                                <input type="date" class="form-control form-control-small" placeholder=""
                                    wire:model="fecha_nac">
                                @error('fecha_nac')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PROFESION:</label>
                                <input type="text" class="form-control form-control-small" placeholder=""
                                    wire:model="profesion">
                                @error('profesion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">PAIS:</label>
                                <input type="text" class="form-control form-control-small" wire:model="pais">
                                @error('pais')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label class="form-label">GENERO:</label>
                                <select class="form-control" wire:model="genero_persona">
                                    <option>Elegir...</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>
                                </select>
                                @error('genero_persona')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">DIRECCION - UBICACION:</label>
                                <input type="text" class="form-control form-control-small" placeholder=""
                                    wire:model="direccion">
                                @error('direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">EMAIL:</label>
                                <input type="email" class="form-control form-control-small" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        wire:click="cancelar">CANCELAR</button>
                    <button type="button" class="btn btn-primary" wire:click="guardar_persona">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="tomarmateria" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">TOMAR MATERIAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">


@foreach ($persona_inscrita as $inscripcion)
{{$inscripcion->id_inscripcion}}
    
{{-- <p> {{ $inscripcion['id_inscripcion'] }}</p> --}}
@endforeach


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" wire:click="guardar_persona">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>


</div>
@push('navi-js-front')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('closeModalCreate', function() {
                $('#crear_persona').modal('hide');
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirmodaldepreinscripcion', function() {
                $('#crear_persona').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('abrirmodaltomarmateria', function() {
                $('#tomarmateria').modal('show');
            });
        });
    </script>
@endpush
