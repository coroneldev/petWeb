<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacunas;

class VacunaController extends Controller
{
    // Obtener todas las Vacunas
    public function index()
    {
        return response()->json(Vacunas::all(), 200);
    }
}
