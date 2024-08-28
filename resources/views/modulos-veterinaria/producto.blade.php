@extends('layouts.admin_principal')
@section('body')
    @if($estado=='com1')
    @livewire('modulos-v.producto-index')
    @elseif($estado=='com2')
    @livewire('modulos-v.histori-compra', ['idpro' => $id])
    @else
    @livewire('modulos-v.histori-venta', ['idpro' => $id])
    @endif
@endsection
