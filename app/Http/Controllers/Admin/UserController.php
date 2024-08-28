<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\base_upea\tabla_persona;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    // function __construct()
    // {
    //      $this->middleware('can:usuario.index', ['only' => ['index']]);
        
    // }
    public function index()
    {
        return view('vista_administracion.admin_users.users_index');
    }
    public function ReportesDoctores ()
    {
        return view('modulos-veterinaria.reportes-doctores');
    }

   
}
