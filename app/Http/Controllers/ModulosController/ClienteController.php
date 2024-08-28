<?php

namespace App\Http\Controllers\ModulosController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    
    public function ClienteUnico($id)
    {
    
        return view(
            'modulos-veterinaria.clientes-unico',compact('id')
        ); 
    }
    public function ClienteUnico2($id_cliuni)
    {
       // dd($id_cliuni);
        $data="x";
        return view(
            'modulos-veterinaria.clientes-unico',compact('id_cliuni','data')
        ); 
    }
    public function index()
    {
        $data = "a";
        return view(
            'modulos-veterinaria.clientes',compact('data')
        ); 
    }
    public function recepcion()
    {
        return view(
            'modulos-veterinaria.clientes-recepcion'
        ); 
    }
    public function cirugiasindex($idm)
    {
     
        $data = "b";
        return view(
            'modulos-veterinaria.clientes',compact('data','idm')
        ); 
    }

   
}
