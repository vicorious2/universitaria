<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FiltroCursoController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\TipoRecursoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ClaseController;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logoutUser', [LoginController::class, 'logoutUser']);
    Route::post('inscribirCurso', [FiltroCursoController::class, 'registerInCourse']);
    Route::get('listaCursosInscritos/{idUsuario}', [FiltroCursoController::class, 'getAllCourseRegister']);
    Route::get('listaClases/{idCurso}', [FiltroCursoController::class, 'getAllClassCourse']);
    Route::get('primeraClase/{idCurso}', [FiltroCursoController::class, 'getfirstClassCourse']);
    Route::get('actualClase/{idCurso}/{idClase}', [FiltroCursoController::class, 'getClassCourse']);
});

Route::post('loginUser', [LoginController::class, 'loginUser']);
Route::get('tipoUsuario', [TipoUsuarioController::class, 'getAllTypeUser']);


Route::get('nuevosCursos', [FiltroCursoController::class, 'getNewCourse']);
Route::get('filtroCursos', [FiltroCursoController::class, 'getFilterCourse']);
Route::get('listaCursos', [FiltroCursoController::class, 'getAllCourse']);

Route::get('listarFacultades', [FacultadController::class, 'getAllFacultas']);

Route::get('listarEstados', [EstadoController::class, 'getAllEstados']);

Route::get('listarTiposRecurso', [TipoRecursoController::class, 'getAllTipoRecurso']);

Route::get('listarNiveles', [NivelController::class, 'getAllNiveles']);

Route::get('listarCategorias', [CategoriaController::class, 'getAllCategorias']);

Route::post('crearCurso', [CursoController::class, 'crearCurso']);

Route::get('getAllCursos', [CursoController::class, 'getAllCursos']);

Route::post('crearClase', [ClaseController::class, 'crearClase']);

Route::get('listarClases', [ClaseController::class, 'getAllClases']);

Route::post('crearRecurso', [RecursoController::class, 'crearRecurso']);




