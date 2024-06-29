<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ruta panel-index

Route::view('/panel', 'panel.index')->name('panel');


//login

Route::view('/login', 'auth.login')->name('login');

/*Route::get('/login', function () {
    return view('auth.login');
});*/

//tramites
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