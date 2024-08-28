@extends('layouts.admin_principal')

@section('body')
    @livewire('administracion-docente.materias-show', ['asignatura' => $asignatura])
@endsection