<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtencionFichaControl extends Controller
{
    public function index2()
    {
        return view('page-landing.inicio-ficha');
    }
}
