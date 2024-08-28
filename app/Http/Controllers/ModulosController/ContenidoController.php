<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function index(){
        return view('modulos-veterinaria.contenido-principal');
    } 
    public function index2(){
        return view('modulos-veterinaria.publicaciones');
    } 
}
