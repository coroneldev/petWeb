<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mascotas;
use Illuminate\Http\Request;


class MascotaController extends Controller
{
    // Obtener todas las mascotas
    public function index()
    {
        return response()->json(Mascotas::all(), 200);
    }
    // Buscar mascota por ID
    public function show($id)
    {
        $mascota = Mascotas::find($id);

        if (!$mascota) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        return response()->json($mascota, 200);
    }

    // Registrar una nueva mascota SIN validaciones
    public function store(Request $request)
    {
        try {
            $mascota = Mascotas::create($request->all());

            return response()->json([
                'message' => 'Mascota registrada correctamente',
                'mascota' => $mascota
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar la mascota',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function registro_codigo(Request $request)
    {
        try {
            // Contar todas las mascotas existentes
            $conteo = Mascotas::count() + 1;

            // Formatear con ceros a la izquierda, 4 dígitos
            $numero = str_pad($conteo, 4, '0', STR_PAD_LEFT);

            // Armar el código (sin fecha)
            $codigo = "MASC-{$numero}";

            // Crear registro con código generado
            $mascota = Mascotas::create(array_merge(
                $request->all(),
                ['codigo' => $codigo]
            ));

            return response()->json([
                'message' => 'Mascota registrada correctamente',
                'mascota' => $mascota
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar la mascota',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function buscarPorCodigo($codigo)
    {
        $mascota = Mascotas::where('codigo', $codigo)->first();

        if (!$mascota) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        return response()->json($mascota, 200);
    }
}
