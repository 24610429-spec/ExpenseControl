
@extends('layouts.app')

@section('titulo', 'Dashboard - ExpenseControl')

@section('contenido')

<div class="mb-4">
    <h3 class="fw-bold">¡Bienvenido a ExpenseControl!</h3>
    <p class="text-secondary">
        Aquí puedes consultar y administrar tus gastos personales.
    </p>
</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <span class="text-secondary">Total de gastos</span>
                <i class="bi bi-wallet2 fs-4 text-success"></i>
            </div>

            <h3 class="fw-bold mt-3">
                ${{ number_format($totalGastos, 2) }}
            </h3>

            <small class="text-secondary">
                Dinero registrado en gastos
            </small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <span class="text-secondary">Número de gastos</span>
                <i class="bi bi-receipt fs-4 text-primary"></i>
            </div>

            <h3 class="fw-bold mt-3">
                {{ $cantidadGastos }}
            </h3>

            <small class="text-secondary">
                Registros realizados
            </small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-3">
            <div class="d-flex justify-content-between">
                <span class="text-secondary">Categorías</span>
                <i class="bi bi-tags fs-4 text-warning"></i>
            </div>

            <h3 class="fw-bold mt-3">
                {{ $cantidadCategorias }}
            </h3>

            <small class="text-secondary">
                Categorías registradas
            </small>
        </div>
    </div>

</div>

<div class="card border-0 shadow-sm mt-4 p-4">

    <h5 class="fw-bold mb-3">Últimos gastos registrados</h5>

    <div class="table-responsive">
        <table class="table align-middle">

            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                </tr>
            </thead>

            <tbody>
                @forelse($ultimosGastos as $gasto)
                    <tr>
                        <td>{{ $gasto->concepto }}</td>

                        <td>
                            {{ $gasto->categoria->nombre ?? 'Sin categoría' }}
                        </td>

                        <td>
                            {{ $gasto->fecha->format('d/m/Y') }}
                        </td>

                        <td class="fw-bold">
                            ${{ number_format($gasto->cantidad, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-secondary py-4">
                            Todavía no hay gastos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection
