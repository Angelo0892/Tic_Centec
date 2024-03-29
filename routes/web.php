<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LagoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ContactanosController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Rutas de la web
|--------------------------------------------------------------------------
|
| Aqui es donde se registran las rutas de la web para tu aplicación.
|
*/

Route::get('/', function () {
    return view('Clientes.inicio');
});


//Grupo para el login
Route::controller(loginController::class)->group(function(){
   // Route::get('/login/acceso', 'acceso')->name('login.acceso');//cambio de carpeta login 24/02/24
    //Route::get('/login', 'acceso')->name('login.acceso');    
});

Route::controller(InicioController::class)->group(function(){
     Route::get('/inicio', 'inicio')->name('inicio.inicio');
     Route::get('/nosotros', 'nosotros')->name('nosotros.nosotros');
     Route::get('/servicios', 'servicios')->name('servicios.servicios');
     Route::get('/articulos', 'articulos')->name('articulos.articulos');
     Route::get('/contactanos', 'contactanos')->name('contactanos.contactanos');
     Route::get('/artiordenadores', 'artiordenadores')->name('artiordenadores.artiordenadores');
     Route::get('/ConsultoriaSistemas', 'ConsultoriaSistemas')->name('ConsultoriaSistemas.ConsultoriaSistemas');
     Route::get('/MantenimientoCorrectivoyPreventivo', 'MantenimientoCorrectivoyPreventivo')->name('MantenimientoCorrectivoyPreventivo.MantenimientoCorrectivoyPreventivo');
     Route::get('/DisenoPaginasWeb', 'DisenoPaginasWeb')->name('DisenoPaginasWeb.DisenoPaginasWeb');
     Route::get('/RedesEstructuradas', 'RedesEstructuradas')->name('RedesEstructuradas.RedesEstructuradas');
     Route::get('/GestionyCalidad', 'GestionyCalidad')->name('GestionyCalidad.GestionyCalidad');
 });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
