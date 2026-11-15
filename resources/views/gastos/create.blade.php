
@extends('layouts.app')

@section('titulo', 'Nuevo gasto - ExpenseControl')

@section('contenido')

<div class="mb-4">
    <h3 class="fw-bold">Registrar nuevo gasto</h3>
    <p class="text-secondary">Completa los datos del gasto que deseas registrar.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ url('/gastos') }}" method="POST">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Concepto</label>
                    <input type="text"
                           name="concepto"
                           class="form-control"
                           value="{{ old('concepto') }}"
                           placeholder="Ej. Compra de despensa"
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
                           value="{{ old('cantidad') }}"
                           placeholder="Ej. 350.00"
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
                           value="{{ old('fecha', date('Y-m-d')) }}"
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
                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
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
                              rows="4"
                              placeholder="Detalles adicionales del gasto">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-2"></i>Guardar gasto
                </button>

                <a href="{{ url('/gastos') }}" class="btn btn-light">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
