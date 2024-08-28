@extends('layouts.admin_principal')

@section('body')
    


<div class="card xl:col-span-2">
    <div class="card-body flex flex-col p-6">
      <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
        <div class="flex-1">
          <div class="card-title text-slate-900 dark:text-white">CREACION MODELO DE CERTIFICADO</div>
        </div>
      </header>
      <div class="card-text h-full ">
        <form class="space-y-4" action="{{ route('modelo_certificado.store') }}" method="POST"  data-parsley-validate>
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">NOMBRE DEL CERTIFICADO:</label>
                  <input type="text" id="nombre_certificado" name="nombre_certificado" class="form-control" placeholder="Full Name">
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">AREA:</label>
                  <input type="text" id="nombre_area_certificado" name="nombre_area_certificado" class="form-control" placeholder="Full Name">
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">CARRERA:</label>
                  <input type="text" id="nombre_carrera_certificado" name="nombre_carrera_certificado" class="form-control" placeholder="Full Name">
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">DEPARTAMENTO:</label>
                  <input type="text" id="nombre_departamento_certificado" name="nombre_departamento_certificado" class="form-control" placeholder="Full Name">
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO PRINCIPAL CUERPO DE CERTIFICADO:</label>
                  <textarea id="texto1_cuerpo_certificado" name="texto1_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO 1 DEL CERTIFICADO:</label>
                  <textarea id="texto2_cuerpo_certificado" name="texto2_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO 2 DEL CERTIFICADO:</label>
                  <textarea id="texto3_cuerpo_certificado" name="texto3_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO 3 DEL CERTIFICADO:</label>
                  <textarea id="texto4_cuerpo_certificado" name="texto4_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO 4 DEL CERTIFICADO:</label>
                  <textarea id="texto5_cuerpo_certificado" name="texto5_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO 5 DEL CERTIFICADO:</label>
                  <textarea id="texto6_cuerpo_certificado" name="texto6_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">TEXTO 6 DEL CERTIFICADO:</label>
                  <textarea id="texto7_cuerpo_certificado" name="texto7_cuerpo_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">CARGO DE LA AUTORIDAD COORDINADOR:</label>
                  <textarea id="cargo_autoridad1_certificado" name="cargo_autoridad1_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">CARGO DE LA AUTORIDAD DIRECTOR:</label>
                  <textarea id="cargo_autoridad2_certificado" name="cargo_autoridad2_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
                <div class="input-area relative">
                  <label for="largeInput" class="form-label">CARGO DE LA AUTORIDAD VICERRECTOR:</label>
                  <textarea id="cargo_autoridad3_certificado" name="cargo_autoridad3_certificado" class="form-control" placeholder="Text Area"></textarea>
                </div>
               
                <div class="input-area relative">
                    <label for="largeInput" class="form-label">ANCHO BORDE DEL CERTIFICADO:</label>
                    <input type="number"  id="ancho_certificado" name="ancho_certificado"class="form-control" placeholder="ingrese" pattern="[0-9]">
                  </div>
                  
                  <div class="input-area relative">
                    <label for="largeInput" class="form-label">ALTO BORDE DEL CERTIFICADO:</label>
                    <input type="number"   id="alto_certificado" name="alto_certificado" class="form-control" placeholder="ingrese" pattern="[0-9]">
                  </div>
                 
                  <div class="input-area relative">
                    <label for="largeInput" class="form-label">PIE DE PAGINA DEL CERTIFICADO:</label>
                    <textarea id="pie_de_pagina_certificado" name="pie_de_pagina_certificado" class="form-control" placeholder="Text Area"></textarea>
                  </div>

                
                <div class="input-area">
                  <label for="select" class="form-label">TIPO CERTIFICADO</label>
                  <select id="tipo_certificados_id" name="tipo_certificados_id" class="form-control">

                    <option  class="dark:bg-slate-700">Elegir.....</option>

                    @foreach ($tipos as $tipo)
                        
                 
                    <option value="{{ $tipo->tipo_certificados_id }}" class="dark:bg-slate-700">{{ $tipo->nombre_tipo_certificado }}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div>
          
          
         <button class="btn inline-flex justify-center btn-dark">GUARDAR</button>
         <a href="{{ route('modelo_certificado.index') }}" class="btn inline-flex justify-center btn-dark">CANCELAR</a> 
        </form>
      </div>
    </div>
  </div>









@endsection