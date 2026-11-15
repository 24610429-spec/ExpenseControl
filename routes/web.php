<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GastoWebController;
use App\Http\Controllers\CategoriaWebController;
use App\Http\Controllers\EstadisticaController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('gastos', GastoWebController::class)
    ->except(['show']);

Route::resource('categorias', CategoriaWebController::class)
    ->except(['show']);

    Route::get('/estadisticas', [EstadisticaController::class, 'index'])
    ->name('estadisticas.index');
