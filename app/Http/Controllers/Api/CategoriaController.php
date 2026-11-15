<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    // Consultar todas las categorías
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Categoria::all()
        ], 200);
    }

    // Registrar una categoría
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string'
        ]);

        $categoria = Categoria::create($datos);

        return response()->json([
            'success' => true,
            'mensaje' => 'Categoría registrada correctamente',
            'data' => $categoria
        ], 201);
    }

    // Consultar una categoría
    public function show(string $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $categoria
        ], 200);
    }

    // Actualizar una categoría
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categorias', 'nombre')->ignore($categoria->id)
            ],
            'descripcion' => 'nullable|string'
        ]);

        $categoria->update($datos);

        return response()->json([
            'success' => true,
            'mensaje' => 'Categoría actualizada correctamente',
            'data' => $categoria
        ], 200);
    }

    // Eliminar una categoría
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        if ($categoria->gastos()->exists()) {
            return response()->json([
                'success' => false,
                'mensaje' => 'No se puede eliminar porque tiene gastos registrados'
            ], 409);
        }

        $categoria->delete();

        return response()->json([
            'success' => true,
            'mensaje' => 'Categoría eliminada correctamente'
        ], 200);
    }
}
