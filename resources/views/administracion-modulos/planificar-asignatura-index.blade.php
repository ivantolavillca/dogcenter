@extends('layouts.admin_principal')

@section('body')
@livewire('administracion-modulos.planificar-asignatura-index', ['id_convocatoria' => isset($id_convocatoria) ?$id_convocatoria: null])

  

@endsection