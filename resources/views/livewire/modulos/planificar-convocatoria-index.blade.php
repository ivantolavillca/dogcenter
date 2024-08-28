

<div>

    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="page-title mb-0 font-size-18">PLANIFICAR CONVOCATORIA</h4>
  
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Inicio</a></li>
                      <li class="breadcrumb-item active">Planificar Convocatoria</li>
                  </ol>
              </div>
  
          </div>
      </div>
  </div>
  
  
  
  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
  
              <div class="mb-3 row">
               
               
                <div class="col-md-6">
                  @livewire('modulos.planificar-convocatoria-create')
                 
                  
                </div>
                <br>
                <br>
                <br>
                <div class="col-md-12">
  <div class="col-md-6">
    <input type="text" class="form-control col-md-6" wire:model="search" placeholder="Buscar...">
  </div>
        
  {{$search}}
  
                </div>
  
               
            </div>
       
  <br>
  
  @if ($planificarconvocatorias->count())
             
               
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
  
                        <thead>
                            <tr>
                              
                                <th>
                                    N°
                                  </th>
          
                                  <th>
                                   GESTION
                                  </th>
                                  <th>
                                    PERIODO
                                  </th>
                                  <th>
                                    PARA
                                  </th>
                                  <th>
                                    CONVOCATORIA
                                  </th>
                                  <th>
                                    SEDE
                                  </th>
                                  <th>
                                  FECHA DE INICIO
                                  </th>
                                  <th>
                                    FECHA FINAL
                                  </th>
                                  <th>
                                    ACCIÓN
                                  </th>
                              
                            </tr>
                        </thead>
                        <tbody >
                          @php
                          $cont=1;  
                    @endphp
                    @foreach ($planificarconvocatorias as $planificarconvocatoria)
                   
                        
               
                            <tr>
                              
                                  <th >
                                    @php
                                    echo $cont;  
                                    $cont++
                              @endphp
                                </th>
                                
                                <td>
                                    {{ $planificarconvocatoria->gestion->anio_siadi_gestion }}
                                </td>
                                <td>
                                    {{ $planificarconvocatoria->periodo_siadi_convocatoria }}
                                </td>
  <td>{{ $planificarconvocatoria->siadi_tipo_convocatoria->siadi_tipo_estudiante->tipo_siadi_tipo_estudiante }}</td>
  <td>{{ $planificarconvocatoria->siadi_tipo_convocatoria->siadi_convocatoria_estudiante->convocatoria_siadi_convocatoria_estudiante }}</td>
  <td>{{ $planificarconvocatoria->siadi_sedes->sede_nombre->direccion}} -  {{ $planificarconvocatoria->siadi_sedes->sede_nombre->nombre}}</td>
  <td>{{ $planificarconvocatoria->fecha_inicio_siadi_convocatoria}}</td>
                              
                                <td>
                                    {{ $planificarconvocatoria->fecha_fin_siadi_convocatoria}}
                                </td>
                                <td>
                                  <a href="{{route('asignatura_convocatoria',$planificarconvocatoria->id_siadi_convocatoria)}}" type="button"
                                  class="btn btn-outline-info waves-effect waves-light" style="border-radius: 50%">  <i class="bx bx-food-menu"></i></a>
                               {{-- @livewire('modulos.planificar-convocatoria-edit', ['id_convocatoria' => $planificarconvocatoria], key($planificarconvocatoria->id_siadi_convocatoria)) --}}
                               <button type="button" class="btn btn-outline-success waves-effect waves-light" style="border-radius: 50%" data-bs-toggle="modal" data-bs-target="#editar_convocatoria"  wire:click="editar_usuario({{ $planificarconvocatoria->id_siadi_convocatoria }})">
                                <i class="bx bx-pencil"></i>
                            </button>
                           
                           
                                  <button type="button"
                                  class="btn btn-outline-danger waves-effect waves-light" style="border-radius: 50%"   wire:click.prevent="$emit('deleteconvoca', {{ $planificarconvocatoria->id_siadi_convocatoria }})">  <i class="bx bx-trash"></i></button>
                                  
                                </td>
                             
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                   
                </div>
                <div class="d-flex justify-content-center">
               
                  {{ $planificarconvocatorias->links() }}
                </div>
              
            </div>
            @else
                  <div class="px-5 py-3 border-gray-200  text-sm">
                      <strong>No hay Registros</strong>
                  </div>
              @endif
        </div>
    


    <div wire:ignore.self data-bs-backdrop="static" id="editar_convocatoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title mt-0" id="myModalLabel"> CONVOCATORIA
                    
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close" wire:click="cancelarEditar"></button>
              </div>
              <div class="modal-body">
                 <div class="row">
                 
                  <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label" >GESTION:</label>
                          <select wire:model="gestion2" class="form-select" aria-label="Default select example" >
                              
                              <option selected disabled>Elegir...</option>
                              @foreach ($gestiones as $gestion)
                                  <option value="{{ $gestion->id_siadi_gestion }}">
                                      {{ $gestion->anio_siadi_gestion }}
                                  </option>
                              @endforeach
                              
                              
                          </select>
                          @error('gestion2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label" >PERIODO:</label>
                          <select wire:model="periodo2" class="form-select" aria-label="Default select example" >
                              <option selected>Elegir...</option>
                              <option value="I">I</option>
                              <option value="II">II</option>
                             
                              
                              
                          </select>
                          @error('periodo2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
              </div>
                  <div class="col-md-12">
                      <div class="mb-12">
                          <label class="form-label" for="validationCustom03">PARA O TIPO DE ESTUDIANTE:</label>
                          <select wire:model="tipo_estudiante2" class="form-select" aria-label="Default select example" >
                              <option selected>Elegir...</option>
                              @foreach ($tipo_estudiantes as $tipo_estudiante)
                              <option value="{{ $tipo_estudiante->id_siadi_tipo_estudiante }}"> {{ $tipo_estudiante->tipo_siadi_tipo_estudiante }}</option>
                              
                              @endforeach
                              
                              
                          </select>
                          @error('tipo_estudiante2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                 
                  <div class="col-md-12">
                      <div class="mb-12">
                          <label class="form-label">CONVOCATORIA:</label>
                          <select wire:model="convocatoria2" class="form-select" aria-label="Default select example" >
                              <option>Elegir...</option>
                              @foreach ($listar_tipo_convocatorias2 as $listar_tipo_convocatoria2)
                              <option value="{{ $listar_tipo_convocatoria2->id_siadi_tipo_convocatoria }}"> {{ $listar_tipo_convocatoria2->siadi_convocatoria_estudiante->convocatoria_siadi_convocatoria_estudiante }} </option>
                              
                              @endforeach
                              
                              
                          </select>
                          @error('convocatoria2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="mb-12">
                          <label class="form-label">SEDE:</label>
                          <select wire:model="sede2" class="form-select" aria-label="Default select example" >
                              <option>Elegir...</option>
                              @foreach ($siadi_sedes as $siadi_sede)
                              <option value="{{ $siadi_sede->sede_id }}">{{ $siadi_sede->sede_nombre->direccion }} - {{ $siadi_sede->sede_nombre->nombre }} </option>
                              
                              @endforeach
                              
                              
                          </select>
                          @error('sede2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                 
             
                  <div class="row">
                      <div class="col-md-6">
                          <div class="mb-3">
                              <label class="form-label" >COSTO EN BS:</label>
                              <input type="text" class="form-control" @if ($listaDeposito2)
                                  
                              value="{{$listaDeposito2->siadi_costos->costo_siadi_costo}}"@endif disabled style=" background-color: #ECB088; color: #000000; ">
                                  @error('costo') <span class="text-danger">{{ $message }}</span> @enderror
                                  
                          </div>
                          
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">N° DE CUENTA:</label>
                            <input type="text" class="form-control" 
                                 disabled  style=" background-color: #ECB088; color: #000000; "@if ($listaDeposito2)
                                  
                                 value="{{$listaDeposito2->siadi_costos->siadi_depositos->numero_siadi_deposito}}"@endif>
                                 @error('cuenta') <span class="text-danger">{{ $message }}</span> @enderror
                                 
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label" >BANCO:</label>
                          <input type="text" class="form-control" 
                          disabled  style=" background-color: #ECB088; color: #000000; "@if ($listaDeposito2)
                                  
                          value="{{$listaDeposito2->siadi_costos->siadi_depositos->banco_siadi_deposito}}"@endif>
                          @error('banco') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="mb-3">
                          <label class="form-label">TIPO DE DOCUMENTO:</label>
                          <select wire:model="documento2" class="form-select" aria-label="Default select example" >
                              <option >Elegir...</option>
                              @foreach ($siadi_documentos as $siadi_documento)
                              <option value="{{ $siadi_documento->id_siadi_documento }}"> {{ $siadi_documento->tipo_siadi_documento }} - {{ $siadi_documento->color_siadi_documento }}</option>
                              
                              @endforeach
                              
                              
                          </select>
                          @error('documento2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
  
                  </div>
                  <div class="col-md-12">
                      <div class="mb-6">
                          <label class="form-label">DESCRIPCION DE LA CONVOCATORIA:</label>
                          <textarea wire:model="descripcion2"  class="form-control"  ></textarea>
                          @error('descripcion2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="mb-6">
                          <label class="form-label" >OBSERVACION DE LA CONVOCATORIA:</label>
                          <textarea wire:model="observacion2"class="form-control"  ></textarea>
                          @error('observacion2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                 
                  <div class="col-md-12">
                      <div class="mb-6">
                          <label class="form-label" >FECHA DE INICIO</label>
                          <input wire:model="fecha_inicio2" type="date"class="form-control">
                          @error('fecha_inicio2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="mb-6">
                          <label class="form-label" >FECHA FINAL</label>
                          <input wire:model="fecha_final2" type="date"class="form-control">
                          @error('fecha_final2') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                  </div>
                  
              </div>
              <div class="modal-footer d-flex justify-content-center">
                  <button  type="button" class="btn btn-danger waves-effect"
                    
                  data-bs-dismiss="modal" wire:click="cancelarEditar"
                 >CANCELAR</button>
               <button 
              class="btn btn-primary waves-effect waves-light" wire:click="guardarEditadoConvocatoria">GUARDAR DATOS</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
      
  </div>




  <div wire:ignore.self id="agregarconvocatoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title mt-0" id="myModalLabel">AGREAGAR CONVOCATORIA
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
                        <option >Elegir...</option>
                        @foreach ($gestiones as $gestion)
                        <option value="{{ $gestion->id_siadi_gestion }}"> {{ $gestion->anio_siadi_gestion }} </option>
                        
                        @endforeach
                        
                        
                    </select>
                    @error('gestion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" >PERIODO:</label>
                    <select wire:model="periodo" class="form-select" aria-label="Default select example" >
                        <option >Elegir...</option>
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
                        <option >Elegir...</option>
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
                    <label class="form-label">DESCRIPCION DE LA CONVOCATORIA:</label>
                    <textarea wire:model="descripcion"  class="form-control"  ></textarea>
                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-6">
                    <label class="form-label" >OBSERVACION DE LA CONVOCATORIA:</label>
                    <textarea wire:model="observacion"class="form-control"  ></textarea>
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
            <button  wire:click="guardar" 
           class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
        </div>
       
    </div>
    <!-- /.modal-content -->
</div>


</div>

@push('navi-js')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('closeModalCreate', function () {
            $('#agregarconvocatoria').modal('hide');
        });
    });
</script>
@endpush
@push('navi-js')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('closeModalEdit', function () {
            $('#editar_convocatoria').modal('hide');
        });
    });
</script>
@endpush
 @push('navi-js')
     <script>
 
 livewire.on('deleteconvoca', id_siadi_convocatoria => {
      Swal.fire({
          title: 'Esta seguro/segura ?',
          text: "¡No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Sí, bórralo!'
      }).then((result) => {
      if (result.isConfirmed) {

          // livewire.emitTo('servidor-index', 'delete', ServidorId);
          livewire.emit('delete', id_siadi_convocatoria);

          Swal.fire(
              'Eliminado!',
              'Su Registro ha sido eliminado..',
              'Exitosamente'
          )
      }
      })
  });
     </script>

 @endpush