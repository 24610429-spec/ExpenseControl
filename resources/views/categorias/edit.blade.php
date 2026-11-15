
@extends('layouts.app')

@section('titulo', 'Editar categoría')

@section('contenido')

<div class="mb-4">
    <a href="{{ url('/categorias') }}" class="text-decoration-none">
        <i class="bi bi-arrow-left"></i> Volver a categorías
    </a>

    <h3 class="fw-bold mt-3">Editar categoría</h3>
    <p class="text-muted">Modifica la información de la categoría.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ url('/categorias/' . $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre de la categoría</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="{{ old('nombre', $categoria->nombre) }}"
                       required>

                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion"
                          class="form-control"
                          rows="4">{{ old('descripcion', $categoria->descripcion) }}</textarea>

                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Guardar cambios
            </button>

            <a href="{{ url('/categorias') }}" class="btn btn-light">
                Cancelar
            </a>
        </form>

    </div>
</div>

@endsection
