@extends('layouts.admin_principal')

@section('body')
    


<div class="card xl:col-span-2">
    <div class="card-body flex flex-col p-6">
      <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
        <div class="flex-1">
          <div class="card-title text-slate-900 dark:text-white">CREACION DE TIPOS DE CERTIFICADO</div>
        </div>
      </header>
      <div class="card-text h-full ">
        <form class="space-y-4" action="{{ route('tipo_certificado.store') }}" method="POST"  data-parsley-validate>
            @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <div class="input-area relative">
              <label for="largeInput" class="form-label">NOMBRE DEL TIPO DE CERTIFICADO</label>
              <input name="nombre_tipo_certificado"  id="nombre_tipo_certificado" type="text" class="form-control" placeholder="Ingresar Datos......">
            </div>
           
          </div>
          
         <button class="btn inline-flex justify-center btn-dark">GUARDAR</button>
         <a href="{{ route('tipo_certificado.index') }}" class="btn inline-flex justify-center btn-dark">CANCELAR</a> 
        </form>
      </div>
    </div>
  </div>









@endsection