<div>
   
    

    <button  class="btn btn-outline-primary waves-effect waves-light col-md-6 " data-bs-toggle="modal" data-bs-target="#agregarusuario"> <i class="bx bxs-plus-circle">AGREGAR</i></button>
    <div wire:ignore.self  id="agregarusuario" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="false">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR IDIOMA
                                                        </h5>
                                                        
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                     
                                                        <div class="row">
                                                            
                                                            
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-12">
                                                                <label class="form-label" for="validationCustom03">IDIOMAS:</label>
                                                                {{-- <select wire:model="idioma" class="form-select" aria-label="Default select example" multiple>
                                                                    
                                                                    @foreach ($siadi_asignatura as $siadi_asignatur)
                                                                    <option value="{{ $siadi_asignatur->id_siadi_asignatura }}"> {{ $siadi_asignatur->siadiidioma->idioma_siadi_idioma }} -
                                                                        {{ $siadi_asignatur->siadinivelidioma->nivel_siadi_nivel_idioma }}</option>
                                                                    
                                                                    @endforeach
                                                                    
                                                                    
                                                                </select>
                                                                @error('idioma') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        @foreach ($siadi_asignatura->take(ceil($siadi_asignatura->count() / 2)) as $index => $siadi_asignatur)
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" id="idioma_{{ $index }}" wire:model="idioma.{{ $index }}" value="{{ $siadi_asignatur->id_siadi_asignatura }}">
                                                                                <label class="form-check-label" for="idioma_{{ $index }}">
                                                                                    {{ $siadi_asignatur->siadiidioma->idioma_siadi_idioma }} - {{ $siadi_asignatur->siadinivelidioma->nivel_siadi_nivel_idioma }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @foreach ($siadi_asignatura->slice(ceil($siadi_asignatura->count() / 2)) as $index => $siadi_asignatur)
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input" type="checkbox" id="idioma_{{ $index + ceil($siadi_asignatura->count() / 2) }}" wire:model="idioma.{{ $index + ceil($siadi_asignatura->count() / 2) }}" value="{{ $siadi_asignatur->id_siadi_asignatura }}">
                                                                                <label class="form-check-label" for="idioma_{{ $index + ceil($siadi_asignatura->count() / 2) }}">
                                                                                    {{ $siadi_asignatur->siadiidioma->idioma_siadi_idioma }} - {{ $siadi_asignatur->siadinivelidioma->nivel_siadi_nivel_idioma }}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

@error('idioma') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                        <div class="modal-footer d-flex justify-content-center">
                                                          <button  type="button" class="btn btn-secondary waves-effect"
                                                            
                                                             data-bs-dismiss="modal"
                                                           >CANCELAR</button>
                                                          <button  wire:click="guardarRequisitoIdioma" type="submit"
                                                         class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                                                      </div>
                                                  
                                                      
                                                    </div>
                                                   
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->


                                        </div>
                                        @section('scribd')
                                        <script>
                                            document.addEventListener('livewire:load', function () {
                                                Livewire.on('closeModal', function () {
                                                    $('#agregarusuario').modal('hide');
                                                });
                                            });
                                        </script>                                            
                                        @endsection




</div>
