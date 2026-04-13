<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\TipoActividadController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\FacultadController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('areas',      AreaController::class)->except(['show']);
Route::resource('componentes', ComponenteController::class)->except(['show']);
Route::resource('lineas',         LineaController::class)->except(['show']);
Route::resource('tipo-actividad', TipoActividadController::class)->except(['show']);

Route::resource('sedes',     SedeController::class)->except(['show']);
Route::resource('facultades', FacultadController::class)->except(['show'])
    ->parameters(['facultades' => 'facultad']);
