@extends('layouts.admin_principal')
@section('body')
    @if($data=="a")
    @livewire('modulos-v.cirujia-trans')
    @elseif($data=="b")
    @livewire('modulos-v.cirujia-trans', ['id_cli' => $id_cli]) 
    @else
    @livewire('modulos-v.cirujia-trans') 
    @endif
@endsection