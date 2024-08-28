@extends('layouts.admin_principal')

@section('body')
    @livewire('administracion-modulos.planificar-asignatura-show', ['asignatura' => $asignatura])

@endsection