<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MascotaController;
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\VacunaController;


Route::get('/', function () {
    return response()->json(['message' => 'Backend Corriendo !!!']);
});

Route::get('/clientes', [ClienteController::class, 'index']);        // Listar todas
Route::get('/mascotas', [MascotaController::class, 'index']);        // Listar todas
Route::get('/vacunas', [VacunaController::class, 'index']);        // Listar todas
Route::get('/citas', [CitaController::class, 'index']);        // No tiene desarrollado las citas
