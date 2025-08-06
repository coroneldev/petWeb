<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Citas;

class CitaController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'El módulo de citas aún está en desarrollo.'
        ], 200);
    }
}
