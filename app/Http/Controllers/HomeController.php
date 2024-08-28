<?php

namespace App\Http\Controllers;

use App\Models\ContenidoPrincipal;
use App\Models\Publicaciones;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    public function __construct() {
       $this->boot();
    }
    protected $paginationTheme = 'bootstrap';
    public function index()
    {
        return view('layouts.index');
    }
    public function index_dash()
    {
        $institucion = ContenidoPrincipal::find(1);
        return view('page-landing.inicio-index', compact('institucion'));
    }
    public function publicaciones()
    {
        $institucion = ContenidoPrincipal::find(1);
        $publicacioness = Publicaciones::where('estado', 'activo')->orderBy('created_at','desc')->paginate(10);
        return view('page-landing.publicaciones', compact('publicacioness','institucion'));
    }
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
