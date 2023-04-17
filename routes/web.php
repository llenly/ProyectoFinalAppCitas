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


//rutas para servicios 

// Auth::routes();

 Route::get('/servicios', [App\Http\Controllers\ServiciosController::class, 'index']);

 Route::get('/servicios/create', [App\Http\Controllers\ServiciosController::class, 'create']);

 Route::get('/servicios/{servicios}/edit', [App\Http\Controllers\ServiciosController::class, 'edit']);

 Route::post('/servicios', [App\Http\Controllers\ServiciosController::class, 'sendData']);

 Route::put('/servicios/{servicios}', [App\Http\Controllers\ServiciosController::class, 'update']);

 Route::delete('/servicios/{servicios}', [App\Http\Controllers\ServiciosController::class, 'destroy']);


 //RUTAS PARA LOS PERSONAL TRAINER

 Route::resource('personalTrainers', 'App\Http\Controllers\PersonalTrainerController');

//ruta para clientes
 Route::resource('clientes', 'App\Http\Controllers\ClientesController');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
