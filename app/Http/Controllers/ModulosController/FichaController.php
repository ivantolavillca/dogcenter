<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    public function index()
    {
        $dato="a";
        return view(
            'modulos-veterinaria.fichas',compact('dato')
        ); 
    }
    public function reporteatencion()
    {
        $dato="b";
        return view(
            'modulos-veterinaria.fichas',compact('dato')
        ); 
    }
    public function reporcostosmascota($id)
    {
        $dato="c";
        return view(
            'modulos-veterinaria.fichas',compact('dato','id')
        ); 
    }
}
