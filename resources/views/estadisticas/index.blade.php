
@extends('layouts.app')

@section('titulo', 'Estadísticas')

@section('contenido')

<div class="mb-4">
    <h3 class="fw-bold">Estadísticas</h3>
    <p class="text-muted">
        Analiza tus gastos y conoce cómo administras tu dinero.
    </p>
</div>

<!-- TARJETA TOTAL -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-2">Gasto acumulado</p>
                        <h3 class="fw-bold text-success">
                            ${{ number_format($totalGastos, 2) }}
                        </h3>
                    </div>
                    <div class="fs-1 text-success">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- GRAFICAS -->
<div class="row g-4">

    <!-- GASTOS POR CATEGORIA -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    Gastos por categoría
                </h5>

                <canvas id="graficaCategorias"></canvas>
            </div>
        </div>
    </div>

    <!-- GASTOS POR MES -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">
                    Gastos de los últimos seis meses
                </h5>

                <canvas id="graficaMeses"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // DATOS DE CATEGORÍAS
    const nombresCategorias = @json($gastosPorCategoria->pluck('nombre'));
    const totalesCategorias = @json($gastosPorCategoria->pluck('total'));

    new Chart(document.getElementById('graficaCategorias'), {
        type: 'doughnut',
        data: {
            labels: nombresCategorias,
            datasets: [{
                data: totalesCategorias,
                backgroundColor: [
                    '#39c69b',
                    '#4e79a7',
                    '#f28e2b',
                    '#e15759',
                    '#af7aa1',
                    '#76b7b2',
                    '#edc948'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // DATOS MENSUALES
    const meses = @json($gastosPorMes->pluck('mes'));
    const totalesMeses = @json($gastosPorMes->pluck('total'));

    new Chart(document.getElementById('graficaMeses'), {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Gastos ($)',
                data: totalesMeses,
                backgroundColor: '#39c69b',
                borderRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endpush
