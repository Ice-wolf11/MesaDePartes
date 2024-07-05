<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tramiteController;
use App\Http\Controllers\personaController;
use App\Http\Controllers\derivacioneController;
use App\Http\Controllers\areaController;
use App\Http\Controllers\trabajadoreController;
Route::get('/', function () {
    return view('welcome');
})->name('index');

//ruta panel-index

Route::view('/panel', 'panel.index')->name('panel');


//login

Route::view('/login', 'auth.login')->name('login');

/*Route::get('/login', function () {
    return view('auth.login');
});*/

//controladores
Route::resource('tramites', tramiteController::class);
Route::resource('personas', personaController::class);
Route::resource('derivaciones', derivacioneController::class);
Route::resource('areas', areaController::class);
Route::resource('users', userController::class);
Route::resource('trabajadores', trabajadoreController::class);
//tramites
Route::get('tramites/{id}/ver-pdf', [tramiteController::class, 'verPdf'])->name('tramites.ver-pdf');


Route::view('/envio', 'tramite.envio')->name('envio');
Route::view('/seguimiento','tramite.seguimiento')->name('seguimiento');

//errores
Route::get('/401', function () {
    return view('pages.401');
});
Route::get('/404', function () {
    return view('pages.404');
});
Route::get('/500', function () {
    return view('pages.500');
});