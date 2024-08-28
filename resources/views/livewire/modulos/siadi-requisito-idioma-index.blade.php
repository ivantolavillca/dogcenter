<div>



  <div>

    <div class="row">
      <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="page-title mb-0 font-size-18">ASIGNAR ASIGNATURA</h4>
  
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{route('admin.home.index')}}">Inicio</a></li>
                      <li class="breadcrumb-item active"><a href="{{route('planificar_convocatoria.index')}}">Planificar Convocaroria</a></li>
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
                  <button  class="btn btn-outline-primary waves-effect waves-light col-md-6 " data-bs-toggle="modal" data-bs-target="#agregarusuario"> <i class="bx bxs-plus-circle">AGREGAR</i></button>
                 
                  
                </div>
                <br>
                <br>
                <br>
                <div class="col-md-12">
  <div class="col-md-6">
    <input type="text" class="form-control col-md-6" wire:model="search" placeholder="Buscar...">
  </div>
                  
  
                </div>
  
               
            </div>
       
  <br>
  
  @if ($siadi_requisito_idiomas->count())
             
               
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
  
                        <thead>
                            <tr>
                              
                          <th >
                            N°
                          </th>
  
                          <th >
                            CONVOCATORIA 
                          </th>
  
                        
  
                          <th>
                            DESCRIPCION
                          </th>
  
                          <th >
                            ASIGNATURA
                          </th>
  
                          <th>
                           IDIOMA
                          </th>
  
                          <th >
                            ACCIÓN
                          </th>
                              
                            </tr>
                        </thead>
                        <tbody >
                          @php
                          $cont=1;  
                    @endphp
                    @foreach ($siadi_requisito_idiomas as $siadi_requisito_idioma)
                   
                        
               
                            <tr>
                                <th>    @php
                                  echo $cont;
                                  $cont++
                                  @endphp
                                  </th>
                                  <td >
                                    {{ $siadi_requisito_idioma->siadiconvocatoria->tipo_convocatoria_sede_id_id_gestion_periodo }}
                                </td>
                                
                                <td>
                                  {{ $siadi_requisito_idioma->siadiconvocatoria->texto_descripcion_siadi_convocatoria }}
                                </td>
                                <td>
                                  {{ $siadi_requisito_idioma->siadi_asignatura->sigla_codigo_siadi_idioma }}   
                                </td>
                                
                              
                                <td>
                                  {{ $siadi_requisito_idioma->siadi_asignatura->siadiidioma->idioma_siadi_idioma }} - {{$siadi_requisito_idioma->siadi_asignatura->siadinivelidioma->nivel_siadi_nivel_idioma}}
                                </td>
                                <td>
                                  <button type="button"
                                  class="btn btn-outline-danger waves-effect waves-light" style="border-radius: 50%"  wire:click.prevent="$emit('requisitodelete', {{ $siadi_requisito_idioma->id_siadi_requisito_idioma }})">  <i class="bx bx-trash"></i></button>
                                 
  
                                </td>
                             
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                   
                </div>
                <div class="d-flex justify-content-center">
               
                  {{ $siadi_requisito_idiomas->links() }}
                </div>
              
            </div>
            @else
                  <div class="px-5 py-3 border-gray-200  text-sm">
                      <strong>No hay Registros</strong>
                  </div>
              @endif
        </div>

  
  
 
  
  
  



  
  <div wire:ignore.self  id="agregarusuario" class="modal fade" tabindex="-1" role="dialog"
                                          aria-labelledby="myModalLabel" aria-hidden="false" data-bs-backdrop="static">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR IDIOMA
                                                      </h5>
                                                      
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                          aria-label="Close" wire:click="cancelar"></button>
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
                                                                      @foreach ($siadi_asignatura2->take(ceil($siadi_asignatura2->count() / 2)) as $index => $siadi_asignatur)
                                                                          <div class="form-check form-switch">
                                                                              <input class="form-check-input" type="checkbox" id="idioma_{{ $index }}" wire:model="idioma.{{ $index }}" value="{{ $siadi_asignatur->id_siadi_asignatura }}">
                                                                              <label class="form-check-label" for="idioma_{{ $index }}">
                                                                                  {{ $siadi_asignatur->siadiidioma->idioma_siadi_idioma }} - {{ $siadi_asignatur->siadinivelidioma->nivel_siadi_nivel_idioma }}
                                                                              </label>
                                                                          </div>
                                                                      @endforeach
                                                                  </div>
                                                                  <div class="col-md-6">
                                                                      @foreach ($siadi_asignatura2->slice(ceil($siadi_asignatura2->count() / 2)) as $index => $siadi_asignatur)
                                                                          <div class="form-check form-switch">
                                                                              <input class="form-check-input" type="checkbox" id="idioma_{{ $index + ceil($siadi_asignatura2->count() / 2) }}" wire:model="idioma.{{ $index + ceil($siadi_asignatura2->count() / 2) }}" value="{{ $siadi_asignatur->id_siadi_asignatura }}">
                                                                              <label class="form-check-label" for="idioma_{{ $index + ceil($siadi_asignatura2->count() / 2) }}">
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
                                                           wire:click="cancelar">CANCELAR</button>
                                                        <button  wire:click="guardarRequisitoIdioma" 
                                                       class="btn btn-primary waves-effect waves-light">GUARDAR DATOS</button>
                                                    </div>
                                                
                                                    
                                                  </div>
                                                 
                                              </div>
                                              <!-- /.modal-content -->
                                          </div>
                                          <!-- /.modal-dialog -->


                                      
                                  


</div>
  

@push('navi-js')
<script>
  document.addEventListener('livewire:load', function () {
      Livewire.on('closeModal', function () {
          $('#agregarusuario').modal('hide');
      });
  });
</script>  
<script>
  livewire.on('requisitodelete', id_siadi_requisito_idioma => {
               Swal.fire({
                   title: 'Esta seguro/a ?',
                   text: "¡No podrás revertir esto!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#09B3F2',      //#3085d6
                   cancelButtonColor: '#d33',
                   confirmButtonText: '¡Sí, bórralo!',
                   cancelButtonText: 'Cancelar',
               }).then((result) => {
               if (result.isConfirmed) {
                   livewire.emit('delete', id_siadi_requisito_idioma);

                   Swal.fire(
                       'Eliminado!',
                       'Su Registro ha sido eliminado..',
                       'Exitosamente'
                   )
               }else if (result.dismiss === Swal.DismissReason.cancel) {
                  }
               })
           });
     </script>

@endpush

 
 

   
              