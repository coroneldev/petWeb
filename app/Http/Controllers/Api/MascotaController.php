<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mascotas;

class MascotaController extends Controller
{
    // Obtener todas las mascotas
    public function index()
    {
        return response()->json(Mascotas::all(), 200);
    }

}
