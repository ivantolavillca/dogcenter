<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalidasController extends Controller
{
    public function index()
    {
       
        return view(
            'modulos-veterinaria.salidas'
        ); 
    }

}
