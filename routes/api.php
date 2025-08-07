<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MascotaController;
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\VacunaController;


Route::get('/', function () {
    return response()->json(['message' => 'Backend Corriendo !!!']);
});

Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/mascotas', [MascotaController::class, 'index']);
Route::get('/mascotas/{id}', [MascotaController::class, 'show']);
Route::post('/mascotas', [MascotaController::class, 'store']);
Route::post('/mascotas/codigo', [MascotaController::class, 'registro_codigo']);
Route::get('/mascotas/codigo/{codigo}', [MascotaController::class, 'buscarPorCodigo']);
Route::get('/vacunas', [VacunaController::class, 'index']);
Route::get('/citas', [CitaController::class, 'index']);        // No tiene desarrollado las citas
