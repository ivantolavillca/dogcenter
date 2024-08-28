<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    protected $estado;
    public function index()
    {
        $estado='com1';
        return view(
            'modulos-veterinaria.producto',compact('estado')
        ); 
    }
    public function index2($id)
    {
        $estado='com2';
        return view(
            'modulos-veterinaria.producto',compact('estado','id')
        ); 
    }
    public function index3($id)
    {
        $estado='com3';
        return view(
            'modulos-veterinaria.producto',compact('estado','id')
        ); 
    }
}
