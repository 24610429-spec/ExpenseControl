

@extends('layouts.app')

@section('titulo', 'Mis gastos - ExpenseControl')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold">Mis gastos</h3>
        <p class="text-secondary mb-0">
            Consulta y administra todos tus gastos registrados.
        </p>
    </div>

    <a href="{{ url('/gastos/create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i>
        Nuevo gasto
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Concepto</th>
                        <th>Categoría</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($gastos as $gasto)
                        <tr>
                            <td>{{ $gasto->id }}</td>

                            <td class="fw-semibold">
                                {{ $gasto->concepto }}
                            </td>

                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $gasto->categoria->nombre ?? 'Sin categoría' }}
                                </span>
                            </td>

                            <td>
                                {{ $gasto->fecha->format('d/m/Y') }}
                            </td>

                            <td class="fw-bold text-success">
                                ${{ number_format($gasto->cantidad, 2) }}
                            </td>

                            <td>
                                <div class="d-flex gap-2">

                                    <!-- Botón editar -->
                                    <a href="{{ url('/gastos/' . $gasto->id . '/edit') }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Botón eliminar -->
                                    <form action="{{ url('/gastos/' . $gasto->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este gasto?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-secondary">
                                <i class="bi bi-receipt fs-1 d-block mb-3"></i>
                                Todavía no tienes gastos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="mt-3">
            {{ $gastos->links() }}
        </div>

    </div>
</div>

@endsection
