@extends('layouts.admin_principal')

@section('body')
    @if($data=='x')
    @livewire('modulos-v.clientes-index', ['id_cliuni' => $id_cliuni])
    @else
    @endif
    
   
@endsection