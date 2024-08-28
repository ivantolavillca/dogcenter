@extends('layouts.admin_principal')
@section('body')
    @if($dato=="a")
    @livewire('modulos-v.fincha-index')
    @elseif($dato=="b")
    @livewire('modulos-v.reportes-atencion') 
    @else
    @livewire('modulos-v.reporte-diario', ['id_mascg' => $id]) 
    @endif
@endsection