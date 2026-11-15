
@extends('layouts.app')

@section('titulo', 'Editar gasto - ExpenseControl')

@section('contenido')

<div class="mb-4">
    <h3 class="fw-bold">Editar gasto</h3>
    <p class="text-secondary">Modifica la información del gasto seleccionado.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ url('/gastos/' . $gasto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Concepto</label>
                    <input type="text"
                           name="concepto"
                           class="form-control"
                           value="{{ old('concepto', $gasto->concepto) }}"
                           required>
                    @error('concepto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Cantidad ($)</label>
                    <input type="number"
                           name="cantidad"
                           class="form-control"
                           step="0.01"
                           min="0.01"
                           value="{{ old('cantidad', $gasto->cantidad) }}"
                           required>
                    @error('cantidad')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha</label>
                    <input type="date"
                           name="fecha"
                           class="form-control"
                           value="{{ old('fecha', $gasto->fecha->format('Y-m-d')) }}"
                           required>
                    @error('fecha')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-select" required>
                        <option value="">Selecciona una categoría</option>

                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ old('categoria_id', $gasto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion"
                              class="form-control"
                              rows="4">{{ old('descripcion', $gasto->descripcion) }}</textarea>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-2"></i>Guardar cambios
                </button>

                <a href="{{ url('/gastos') }}" class="btn btn-light">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
