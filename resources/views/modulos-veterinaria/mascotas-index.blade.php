@extends('layouts.admin_principal')
@section('body')

    @livewire('modulos-v.mascotas-historial', ['mascota' => $mascota])
@endsection