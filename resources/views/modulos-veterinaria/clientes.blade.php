@extends('layouts.admin_principal')

@section('body')
    @if($data=="a")
    @livewire('modulos-v.clientes-index')
    @else
    @livewire('modulos-v.cirujia-index', ['id_mascota' => $idm])
    @endif
@endsection