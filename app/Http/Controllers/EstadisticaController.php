<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstadisticaController extends Controller
{
    public function index()
    {
        // Total general de gastos
        $totalGastos = Gasto::sum('cantidad');

        // Gastos agrupados por categoría
        $gastosPorCategoria = Categoria::leftJoin(
                'gastos',
                'categorias.id',
                '=',
                'gastos.categoria_id'
            )
            ->select(
                'categorias.nombre',
                DB::raw('COALESCE(SUM(gastos.cantidad), 0) as total')
            )
            ->groupBy('categorias.id', 'categorias.nombre')
            ->get();

        // Gastos de los últimos seis meses
        $gastosPorMes = Gasto::select(
                DB::raw("DATE_FORMAT(fecha, '%Y-%m') as mes"),
                DB::raw('SUM(cantidad) as total')
            )
            ->where('fecha', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return view('estadisticas.index', compact(
            'totalGastos',
            'gastosPorCategoria',
            'gastosPorMes'
        ));
    }
}
