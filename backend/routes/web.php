<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClaseController;

Route::get('/', function () {
    return view('layouts.master',['home' => 'ok']);
})->name('login');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('tipoUsuario', 'TipoUsuarioController');
    Route::resource('tipoDoc', 'TipoDocController');
    Route::resource('estado', 'EstadoController');
    Route::resource('facultad', 'FacultadController');
    Route::resource('tipoRecurso', 'TipoRecursoController');
    Route::resource('nivel', 'NivelController');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('usuario', 'UsuarioController');
    Route::resource('curso', 'CursoController');
    Route::resource('clase', 'ClaseController');
    Route::get('/getAllClassByCourse/{id_curso}', [ClaseController::class, 'getAllClassByCourse'])->name('getAllClassByCourse');
    Route::post('/changeOrderClassByCourse', [ClaseController::class, 'changeOrderClassByCourse'])->name('changeOrderClassByCourse');
    Route::post('/resetPass/{id}/{documento}', [UsuarioController::class, 'resetPass'])->name('resetPass');
    Route::get('/getResourceForIdClass/{id_clase}', [RecursoController::class, 'getResourceForIdClass'])->name('getResourceForIdClass');
    Route::get('/getResourceDownload/{id_recurso}', [RecursoController::class, 'getResourceDownload'])->name('getResourceDownload');

});

Route::post('loginAdmin', [LoginController::class, 'loginAdmin']);
Route::post('logoutAdmin', [LoginController::class, 'logoutAdmin']);