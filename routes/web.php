<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// RUTAS PARA MIDDLEWAREADMIN
//este admin viene del archivo kernel 

Route::middleware(['auth','admin'])->group(function (){


//RUTA PARA ESPECIALIDADES

    
//rutas para servicios 

 Route::get('/servicios', [App\Http\Controllers\admin\ServiciosController::class, 'index']);

 Route::get('/servicios/create', [App\Http\Controllers\admin\ServiciosController::class, 'create']);

 Route::get('/servicios/{servicios}/edit', [App\Http\Controllers\admin\ServiciosController::class, 'edit']);

 Route::post('/servicios', [App\Http\Controllers\admin\ServiciosController::class, 'sendData']);

 Route::put('/servicios/{servicios}', [App\Http\Controllers\admin\ServiciosController::class, 'update']);

 Route::delete('/servicios/{servicios}', [App\Http\Controllers\admin\ServiciosController::class, 'destroy']);


 //RUTAS PARA LOS PERSONAL TRAINER

 Route::resource('personalTrainers', 'App\Http\Controllers\admin\PersonalTrainerController');

//RUTAS PARA CLIENTES
 Route::resource('clientes', 'App\Http\Controllers\admin\ClientesController');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});


// creardo rol para los personal trainer vean su pagina y el horario con su controllador y su vista
Route::middleware(['auth','persontrain'])->group(function (){

    Route::get('/horiario', [App\Http\Controllers\persontrain\HorarioController::class, 'edit']);

    Route::post('/horiario', [App\Http\Controllers\persontrain\HorarioController::class, 'store']);
});