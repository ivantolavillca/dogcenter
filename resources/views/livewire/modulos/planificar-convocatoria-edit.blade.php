


    

<div wire:ignore.self data-bs-backdrop="static" id="editar_convocatoria_{{ $convocatoria_actual->id_siadi_convocatoria }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel"> CONVOCATORIA
                  
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
               
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" >GESTION:</label>
                        <select wire:model="gestion" class="form-select" aria-label="Default select example" >
                            
                            <option selected disabled>Elegir...</option>
                            @foreach ($gestiones as $gestion)
                                <option value="{{ $gestion->id_siadi_gestion }}">
                                    {{ $gestion->anio_siadi_gestion }}
                                </option>
                            @endforeach
                            
                            
                        </select>
                        @error('gestion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" >PERIODO:</label>
                        <select wire:model="periodo" class="form-select" aria-label="Default select example" >
                            <option selected>Elegir...</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                           
                            
                            
                        </select>
                        @error('periodo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
                <div class="col-md-12">
                    <div class="mb-12">
                        <label class="form-label" for="validationCustom03">PARA O TIPO DE ESTUDIANTE:</label>
                        <select wire:model="tipo_estudiante" class="form-select" aria-label="Default select example" >
                            <option selected>Elegir...</option>
                            @foreach ($tipo_estudiantes as $tipo_estudiante)
                            <option value="{{ $tipo_estudiante->id_siadi_tipo_estudiante }}"> {{ $tipo_estudiante->tipo_siadi_tipo_estudiante }}</option>
                            
                            @endforeach
                            
                            
                        </select>
                        @error('tipo_estudiante') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
               
                <div class="col-md-12">
                    <div class="mb-12">
                        <label class="form-label">CONVOCATORIA:</label>
                        <select wire:model="convocatoria" class="form-select" aria-label="Default select example" >
                            <option>Elegir...</option>
                            @foreach ($listar_tipo_convocatorias as $listar_tipo_convocatoria)
                            <option value="{{ $listar_tipo_convocatoria->id_siadi_tipo_convocatoria }}"> {{ $listar_tipo_convocatoria->siadi_convocatoria_estudiante->convocatoria_siadi_convocatoria_estudiante }} </option>
                            
                            @endforeach
                            
                            
                        </select>
                        @error('convocatoria') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-12">
                        <label class="form-label">SEDE:</label>
                        <select wire:model="sede" class="form-select" aria-label="Default select example" >
                            <option>Elegir...</option>
                            @foreach ($siadi_sedes as $siadi_sede)
                            <option value="{{ $siadi_sede->sede_id }}">{{ $siadi_sede->sede_nombre->direccion }} - {{ $siadi_sede->sede_nombre->nombre }} </option>
                            
                            @endforeach
                            
                            
                        </select>
                        @error('sede') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
               
           
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" >COSTO EN BS:</label>
                            <input type="text" class="form-control" @if ($listaDeposito)
                                
                            value="{{$listaDeposito->siadi_costos->costo_siadi_costo}}"@endif disabled style=" background-color: #ECB088; color: #000000; ">
                                @error('costo') <span class="text-danger">{{ $message }}</span> @enderror
                                
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label">N° DE CUENTA:</label>
                          <input type="text" class="form-control" 
                               disabled  style=" background-color: #ECB088; color: #000000; "@if ($listaDeposito)
                                
                               value="{{$listaDeposito->siadi_costos->siadi_depositos->numero_siadi_deposito}}"@endif>
                               @error('cuenta') <span class="text-danger">{{ $message }}</span> @enderror
                               
                      </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" >BANCO:</label>
                        <input type="text" class="form-control" 
                        disabled  style=" background-color: #ECB088; color: #000000; "@if ($listaDeposito)
                                
                        value="{{$listaDeposito->siadi_costos->siadi_depositos->banco_siadi_deposito}}"@endif>
                        @error('banco') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">TIPO DE DOCUMENTO:</label>
                        <select wire:model="documento" class="form-select" aria-label="Default select example" >
                            <option >Elegir...</option>
                            @foreach ($siadi_documentos as $siadi_documento)
                            <option value="{{ $siadi_documento->id_siadi_documento }}"> {{ $siadi_documento->tipo_siadi_documento }} - {{ $siadi_documento->color_siadi_documento }}</option>
                            
                            @endforeach
                            
                            
                        </select>
                        @error('documento') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                </div>
                <div class="col-md-12">
                    <div class="mb-6">
                        <label class="form-label">DESCRIPCIONssssssss DE LA CONVOCATORIA:</label>
                        <textarea wire:model="descripcion"  class="form-control"  > {{$descripcion}}</textarea>
                        @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-6">
                        <label class="form-label" >OBSERVACION DE LA CONVOCATORIA:</label>
                        <textarea wire:model="observacion"class="form-control"  >{{$observacion}}</textarea>
                        @error('observacion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
               
                <div class="col-md-12">
                    <div class="mb-6">
                        <label class="form-label" >FECHA DE INICIO</label>
                        <input wire:model="fecha_inicio" type="date"class="form-control">
                        @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-6">
                        <label class="form-label" >FECHA FINAL</label>
                        <input wire:model="fecha_final" type="date"class="form-control">
                        @error('fecha_final') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button  type="button" class="btn btn-danger waves-effect"
                  
                data-bs-dismiss="modal"
               >CANCELAR</button>
             <button 
            class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    
</div>

@push('javas')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('closeModal', function () {
            $('#agregarconvocatoria').modal('hide');
        });
    });
</script>  
@endpush
