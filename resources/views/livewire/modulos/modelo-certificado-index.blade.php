










<div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">




     
      <div class="mb-5">
        <ul class="m-0 p-0 list-none">
          <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
            <a href="index.html">
              <iconify-icon icon="heroicons-outline:home"></iconify-icon>
              <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
            </a>
          </li>
          <li class="inline-block relative text-sm text-primary-500 font-Inter ">
            Table
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
          </li>
          <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
            Basic-Table</li>
        </ul>
      </div>
    


      <div class=" space-y-5">
        <div class="card">
          <header class=" card-header noborder">
            <h4 class="card-title">Advanced Table
            </h4>
          </header>
          <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6 dashcode-data-table">
              <span class=" col-span-8  hidden"></span>
              <span class="  col-span-4 hidden"></span>
              <div class="inline-block min-w-full align-middle">
                
                    <label><input type="search" class="" placeholder="Buscar...." wire:model="search">
                    <a href="{{ route('modelo_certificado.create') }}">
                        <button class="btn inline-flex justify-center btn-outline-primary" ><iconify-icon icon="heroicons:user-plus"></iconify-icon></button>
                    </a>
                    </label>
                
                     
                    
                       
                  
                    
                      
                 
                   
                    @if ($mcertificado->count())
                <div class="overflow-hidden ">
                    
                  <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" >
                    <thead class=" border-t border-slate-100 dark:border-slate-800">
                      <tr>

                        <th scope="col" class=" table-th ">
                          N°
                        </th>

                        <th scope="col" class=" table-th ">
                          NOMBRE DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          AREA
                        </th>
                        <th scope="col" class=" table-th ">
                          CARRERA
                        </th>
                        <th scope="col" class=" table-th ">
                          DEPARTAMENTO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO PRINCIPAL CUERPO DE CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO 1 DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO 2 DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO 3 DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO 4 DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO 5 DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TEXTO 6 DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          CARGO DE LA AUTORIDAD COORDINADOR
                        </th>
                        <th scope="col" class=" table-th ">
                          CARGO DE LA AUTORIDAD DIRECTOR
                        </th>
                        <th scope="col" class=" table-th ">
                          CARGO DE LA AUTORIDAD VICERRECTOR
                        </th>
                        <th scope="col" class=" table-th ">
                          ANCHO BORDE DEL CERTIFICADO
                        </th> 
                        <th scope="col" class=" table-th ">
                          ALTO BORDE DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          PIE DE PAGINA DEL CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          TIPO CERTIFICADO
                        </th>
                        <th scope="col" class=" table-th ">
                          ACCION
                        </th>
                        
                        

                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">

                        @php
                        $cont=0;  
                  @endphp
                  @foreach ($mcertificado as $mc)
                   

                      <tr>
                        <td class="table-td">
                            {{ $mc->modelo_certificados_id }}
                        </td>
                        <td class="table-td ">
                          {{ $mc->nombre_certificado }}  
                        </td>
                        <td class="table-td">
                          {{ $mc->nombre_area_certificado }}
                        </td>
                        <td class="table-td ">
                          {{ $mc->nombre_carrera_certificado }}
                        </td>
                        <td class="table-td">
                          {{ $mc->nombre_departamento_certificado }}
                        </td>
                        <td class="table-td ">
                          {{ $mc->texto1_cuerpo_certificado }}
                        </td>
                        <td class="table-td">
                          {{ $mc->texto2_cuerpo_certificado }}
                        </td>
                        <td class="table-td ">
                          {{ $mc->texto3_cuerpo_certificado }}
                        </td>
                        <td class="table-td">
                          {{ $mc->texto4_cuerpo_certificado }} 
                        </td>
                        <td class="table-td ">
                          {{ $mc->texto5_cuerpo_certificado }} 
                        </td>
                        <td class="table-td">
                          {{ $mc->texto6_cuerpo_certificado }} 
                        </td>
                        <td class="table-td ">
                          {{ $mc->texto7_cuerpo_certificado }} 
                        </td>
                        <td class="table-td">
                          {{ $mc->cargo_autoridad1_certificado }} 
                        </td>
                        <td class="table-td ">
                          {{ $mc->cargo_autoridad2_certificado }} 
                        </td>
                        <td class="table-td">
                          {{ $mc->cargo_autoridad3_certificado }}  
                        </td>
                        <td class="table-td ">
                          {{ $mc->ancho_certificado }} 
                        </td>
                        <td class="table-td">
                          {{ $mc->alto_certificado }}  
                        </td>
                        <td class="table-td">
                          {{ $mc->pie_de_pagina_certificado }} 
                        </td>
                        <td class="table-td ">
                          {{ $mc->tipocertificado->nombre_tipo_certificado }} 
                        </td>
                        
                        <td class="table-td ">
                          <div>
                            <div class="relative">
                              <div class="dropdown relative">
                                <button class="text-xl text-center block w-full " type="button" id="tableDropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  <iconify-icon icon="heroicons-outline:dots-vertical"></iconify-icon>
                                </button>
                                <ul class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                  <li>
                                    <a href="{{ route('modelo_certificado.edit', $mc->tipo_certificados_id)}}" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600  dark:hover:text-white">
                                      EDITAR</a>
                                  </li>
                                  <li>
                                    <a href="#"  wire:click.prevent="$emit('deletetipocertificado', {{ $mc->tipo_certificados_id }})" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                      ELIMINAR</a>
                                  </li>
                                  <li>
                                    <a href="{{ route('generarpdf',) }}"   class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                      REPORTE PDF</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>

                     
                      @endforeach
                     

                    </tbody>
                    
                  </table>
                  <br>
                  <br>
                 
                    <div
                            class="px-5 py-5   flex flex-col xs:flex-row items-center xs:justify-between">
                            <div class="inline-flex mt-2 xs:mt-0">
                                {{ $mcertificado->links() }}
                            </div>
                        </div>
                  
                </div>
                @else
                <div class="px-5 py-3 border-gray-200  text-sm">
                    <strong>No hay Registros</strong>
                </div>
            @endif

              </div>
             
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </div>









      @section('script')
         


      <script>
   livewire.on('deletetipocertificado', tipo_formulario_id => {
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
                    livewire.emit('delete', tipo_formulario_id);

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
      @endsection
      
      </div>
      

</div>


