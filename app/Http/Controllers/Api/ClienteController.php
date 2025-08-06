<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;

class ClienteController extends Controller
{
    // Obtener todas las clientes
    public function index()
    {
        return response()->json(Clientes::all(), 200);
    }
}
