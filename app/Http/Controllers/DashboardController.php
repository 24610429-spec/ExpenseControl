<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGastos = Gasto::sum('cantidad');

        $cantidadGastos = Gasto::count();

        $cantidadCategorias = Categoria::count();

        $ultimosGastos = Gasto::with('categoria')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalGastos',
            'cantidadGastos',
            'cantidadCategorias',
            'ultimosGastos'
        ));
    }
}
