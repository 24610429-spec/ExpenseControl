<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaWebController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::withCount('gastos')
            ->latest()
            ->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    // Mostrar formulario para crear categoría
    public function create()
    {
        return view('categorias.create');
    }

    // Guardar nueva categoría
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string'
        ]);

        Categoria::create($datos);

        return redirect('/categorias')
            ->with('success', 'Categoría registrada correctamente.');
    }

    // Mostrar formulario para editar categoría
    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    // Actualizar categoría
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
            'descripcion' => 'nullable|string'
        ]);

        $categoria->update($datos);

        return redirect('/categorias')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar categoría
    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);

        // Evitar eliminar categorías que tienen gastos asociados
        if ($categoria->gastos()->exists()) {
            return redirect('/categorias')
                ->with('error', 'No puedes eliminar una categoría que tiene gastos registrados.');
        }

        $categoria->delete();

        return redirect('/categorias')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
