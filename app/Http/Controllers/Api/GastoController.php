<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    // Consultar todos los gastos
    public function index()
    {
        $gastos = Gasto::with('categoria')->get();

        return response()->json([
            'success' => true,
            'data' => $gastos
        ], 200);
    }

    // Registrar un gasto
    public function store(Request $request)
    {
        $datos = $request->validate([
            'concepto' => 'required|string|max:255',
            'cantidad' => 'required|numeric|gt:0',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $gasto = Gasto::create($datos);

        return response()->json([
            'success' => true,
            'mensaje' => 'Gasto registrado correctamente',
            'data' => $gasto->load('categoria')
        ], 201);
    }

    // Consultar un gasto
    public function show(string $id)
    {
        $gasto = Gasto::with('categoria')->find($id);

        if (!$gasto) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Gasto no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gasto
        ], 200);
    }

    // Actualizar un gasto
    public function update(Request $request, string $id)
    {
        $gasto = Gasto::find($id);

        if (!$gasto) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Gasto no encontrado'
            ], 404);
        }

        $datos = $request->validate([
            'concepto' => 'required|string|max:255',
            'cantidad' => 'required|numeric|gt:0',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $gasto->update($datos);

        return response()->json([
            'success' => true,
            'mensaje' => 'Gasto actualizado correctamente',
            'data' => $gasto->load('categoria')
        ], 200);
    }

    // Eliminar un gasto
    public function destroy(string $id)
    {
        $gasto = Gasto::find($id);

        if (!$gasto) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Gasto no encontrado'
            ], 404);
        }

        $gasto->delete();

        return response()->json([
            'success' => true,
            'mensaje' => 'Gasto eliminado correctamente'
        ], 200);
    }
}
