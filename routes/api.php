
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\GastoController;

// Rutas de categorías
Route::apiResource('categorias', CategoriaController::class);

// Rutas de gastos
Route::apiResource('gastos', GastoController::class);
