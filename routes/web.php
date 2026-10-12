<?php

use App\Http\Controllers\ComisionController;
use Illuminate\Support\Facades\Route;

// Ruta raíz (opcional, puedes eliminarla si no la usas)
Route::get('/', function () {
    return redirect()->route('comisiones.index');
});

// Rutas del MiniCore
Route::get('/comisiones', [ComisionController::class, 'index'])
    ->name('comisiones.index');

Route::post('/comisiones', [ComisionController::class, 'calcular'])
    ->name('comisiones.calcular');
