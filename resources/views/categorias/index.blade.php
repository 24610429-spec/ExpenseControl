
@extends('layouts.app')

@section('titulo', 'Mis categorías')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Mis categorías</h3>
        <p class="text-muted">Administra las categorías de tus gastos.</p>
    </div>

    <a href="{{ url('/categorias/create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nueva categoría
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Gastos registrados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td class="fw-semibold">
                                {{ $categoria->nombre }}
                            </td>
                            <td>
                                {{ $categoria->descripcion ?: 'Sin descripción' }}
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $categoria->gastos_count }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ url('/categorias/' . $categoria->id . '/edit') }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ url('/categorias/' . $categoria->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Deseas eliminar esta categoría?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Todavía no hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categorias->links() }}
    </div>
</div>

@endsection
