<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoPasadosController extends Controller
{
    public function index()
    {
        $data = "a";
        return view(
            'modulos-veterinaria.historialespasados',compact('data')
        ); 
    }
    public function index2($id_cli)
    {
        $data = "b";
        return view(
            'modulos-veterinaria.historialespasados',compact('data','id_cli')
        ); 
    }
}
