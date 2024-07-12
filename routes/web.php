<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tramiteController;
use App\Http\Controllers\personaController;
use App\Http\Controllers\derivacioneController;
use App\Http\Controllers\revisioneController;
use App\Http\Controllers\areaController;
use App\Http\Controllers\trabajadoreController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\logoutController;


Route::get('/', function () {
    return view('welcome');
})->name('index');

//ruta panel-index
Route::get('/panel',[homeController::class,'index'])->name('panel');



//login

Route::get('/login', [loginController::class,'index'])->name('login');
Route::post('/login', [loginController::class,'login']);
Route::get('/logout',[logoutController::class,'logout'])->name('logout');
/*Route::get('/login', function () {
    return view('auth.login');
});*/

//controladores
Route::resource('tramites', tramiteController::class);
Route::resource('personas', personaController::class);
Route::get('derivaciones/create/{tramite}', [derivacioneController::class, 'create'])->name('derivaciones.create');
Route::resource('derivaciones', derivacioneController::class)->except(['create']);
Route::get('revisiones/create/{tramite}', [revisioneController::class, 'create'])->name('revisiones.create');
Route::resource('revisiones',revisioneController::class)->except(['create']);;
Route::get('areas/{area_id}/trabajadores', [DerivacioneController::class, 'getTrabajadoresByArea']);
Route::resource('areas', areaController::class);
//Route::resource('users', userController::class);
Route::resource('trabajadores', trabajadoreController::class);
//tramites pdf
Route::get('tramites/{id}/ver-pdf', [tramiteController::class, 'verPdf'])->name('tramites.ver-pdf');
Route::get('derivaciones/{id}/ver-pdf', [derivacioneController::class, 'verPdf'])->name('derivaciones.ver-pdf');
Route::get('revisiones/{id}/ver-pdf', [revisioneController::class, 'verPdf'])->name('revisiones.ver-pdf');
// ver pdf en modal
Route::get('pdf/{filename}', [tramiteController::class, 'verPdfmod'])->name('pdf.view');




//Route::view('/envio', 'tramite.envio')->name('envio');
Route::view('/seguimiento','tramite.show')->name('seguimiento');

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