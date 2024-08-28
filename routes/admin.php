<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ModulosController\ClienteController;
use App\Http\Controllers\ModulosController\ProveedorController;
use App\Http\Controllers\ModulosController\MascotaController;
use App\Http\Controllers\ModulosController\EstudiosComplementariosController;
use App\Http\Controllers\ModulosController\TiposHistorialController;
use App\Http\Controllers\ModulosController\ProductoController;
use App\Http\Controllers\ModulosController\EntradasController;
use App\Http\Controllers\ModulosController\SalidasController;
use App\Http\Controllers\ModulosController\FichaController;
use App\Http\Controllers\ModulosController\CasosEnfermedades;
use App\Http\Controllers\FichaPDFController;
use App\Http\Controllers\VentaPDFController;
use App\Http\Controllers\ModulosController\HistoPasadosController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModulosController\ContenidoController;


Route::resource('dashboard', HomeController::class)->names('admin.home');

Route::resource('permission', PermissionController::class)->names('permisos'); ///->middleware('permission:role.index');
// Route::resource('user', UserController::class)->names('usuarios');

// Route::resource('role', RoleController::class)->names('roles');

Route::get('role', [RoleController::class, 'index'])->name('roles.index');
Route::get('user', [UserController::class, 'index'])->name('usuarios.index');
Route::get('reportes-doctores', [UserController::class, 'ReportesDoctores'])->name('ReportesDoctores');
Route::get('cliente-unico/{id}', [ClienteController::class, 'ClienteUnico'])->name('ClienteUnico');
Route::get('mascotas', [MascotaController::class, 'index'])->name('mascotas');
Route::get('cliente-unico2/{id}', [ClienteController::class, 'ClienteUnico2'])->name('ClienteUnico2');
Route::get('mascotasraza', [MascotaController::class, 'index2'])->name('mascotasraza');
Route::get('mascotasespecie', [MascotaController::class, 'index3'])->name('mascotasespecie');
Route::get('mascotascolor', [MascotaController::class, 'index4'])->name('mascotascolor');
Route::get('tiposhistorias', [TiposHistorialController::class, 'index'])->name('tiposhistorias');
Route::get('estudiocomplementarios', [EstudiosComplementariosController::class, 'index'])->name('estudiocomplementarios');
Route::get('clientes-recepción', [ClienteController::class, 'recepcion'])->name('recepcion');
Route::get('clientes', [ClienteController::class, 'index'])->name('clientes');
Route::get('contenido-principal', [ContenidoController::class, 'index'])->name('contenido-principal');
Route::get('publicaciones', [ContenidoController::class, 'index2'])->name('publicaciones');
Route::get('proveedores', [ProveedorController::class, 'index'])->name('proveedores');
Route::get('productos', [ProductoController::class, 'index'])->name('productos');
Route::get('productos2/{id}', [ProductoController::class, 'index2'])->name('productos2');
Route::get('productos3/{id}', [ProductoController::class, 'index3'])->name('productos3');
Route::get('entradas', [EntradasController::class, 'index'])->name('entradas');
Route::get('salidas', [SalidasController::class, 'index'])->name('salidas');
Route::get('fichas', [FichaController::class, 'index'])->name('fichas');
Route::get('imprimirfichas/{id}', [FichaPDFController::class, 'generarPDF'])->name('imprimirfichas');

Route::get('enfermedades', [CasosEnfermedades::class, 'index'])->name('enfermedades');
Route::get('mascotas-historial/{mascota}', [MascotaController::class, 'mascotasindex'])->name('mascotashistorial');
Route::get('derivacion/{mascota}', [MascotaController::class, 'derivacion'])->name('derivar');
Route::get('reporte-estudio-complementario/{hitorial}', [TiposHistorialController::class, 'reporte_estudio_complementario'])->name('reporte_estudio_complementario');
Route::get('farmacia', [ProductoController::class, 'index'])->name('farmacia');
Route::get('imprimirVentas/{idm}/{es}', [VentaPDFController::class, 'generarPDFVentas'])->name('imprimirVentas'); 
Route::get('reportesatencion', [FichaController::class, 'reporteatencion'])->name('reportesatencion'); 
Route::get('imprimiratendidos/{f1}/{f2}/{id_u}', [VentaPDFController::class, 'generarPDFAnteciones'])->name('imprimiratendidos'); 
Route::get('cirugias/{idm}', [ClienteController::class, 'cirugiasindex'])->name('cirugias'); 
Route::get('historialesp', [HistoPasadosController::class, 'index'])->name('historialesp');
Route::get('imprimirHistorialesp/{f1}', [VentaPDFController::class, 'generarPDFHistoriap'])->name('imprimirHistorialesp'); 
Route::get('reportediario/{id}', [FichaController::class, 'reporcostosmascota'])->name('reportediario'); 
Route::get('imprimircosotosgeneral/{f1}/{f2}/{id_u}', [VentaPDFController::class, 'generarPDFCostosGeneral'])->name('imprimircosotosgeneral'); 
Route::get('imprimircosotoindividual/{f1}/{f2}/{id_u}/{es}', [VentaPDFController::class, 'generarPDFCostosIndividual'])->name('imprimircosotoindividual'); 
Route::get('imprimircosotounregistro/{id_m}/{id}/{es}', [VentaPDFController::class, 'generarPDFCostosunregistro'])->name('imprimircosotounregistro'); 
Route::get('historialespx/{id}', [HistoPasadosController::class, 'index2'])->name('historialespx');