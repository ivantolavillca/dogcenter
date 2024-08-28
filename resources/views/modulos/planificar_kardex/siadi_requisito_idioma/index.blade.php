@extends('layouts.admin_principal')




@section('body')

    @livewire('modulos.siadi-requisito-idioma-index', ['id_siadi_convocatoria' => $id_siadi_convocatoria])

  

@endsection