<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class GastoWebController extends Controller
{
    // Mostrar todos los gastos
    public function index()
    {
        $gastos = Gasto::with('categoria')
            ->latest()
            ->paginate(10);

        return view('gastos.index', compact('gastos'));
    }

    // Mostrar formulario para registrar un gasto
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('gastos.create', compact('categorias'));
    }

    // Guardar un nuevo gasto
    public function store(Request $request)
    {
        $datos = $request->validate([
            'concepto' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Gasto::create($datos);

        return redirect('/gastos')
            ->with('success', 'Gasto registrado correctamente.');
    }

    // Mostrar formulario para editar un gasto
    public function edit(string $id)
    {
        $gasto = Gasto::findOrFail($id);
        $categorias = Categoria::orderBy('nombre')->get();

        return view('gastos.edit', compact('gasto', 'categorias'));
    }

    // Actualizar un gasto
    public function update(Request $request, string $id)
    {
        $gasto = Gasto::findOrFail($id);

        $datos = $request->validate([
            'concepto' => 'required|string|max:255',
            'cantidad' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $gasto->update($datos);

        return redirect('/gastos')
            ->with('success', 'Gasto actualizado correctamente.');
    }

    // Eliminar un gasto
    public function destroy(string $id)
    {
        $gasto = Gasto::findOrFail($id);

        $gasto->delete();

        return redirect('/gastos')
            ->with('success', 'Gasto eliminado correctamente.');
    }
}
