@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Refacción</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('refacciones.update', $refaccion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Código</label>
                            <input type="text" name="codigo" class="form-control" value="{{ $refaccion->codigo }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $refaccion->nombre }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" value="{{ $refaccion->cantidad }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold">Línea</label>
                            <select name="linea" class="form-control" required>
                                @foreach(['Línea 11', 'Línea 12', 'Línea 13', 'Línea 14', 'Línea 15', 'Línea 16', 'Etiquetadoras'] as $opcion)
                                    <option value="{{ $opcion }}" {{ $refaccion->linea == $opcion ? 'selected' : '' }}>
                                        {{ $opcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('refacciones.index') }}" class="btn btn-secondary">Regresar</a>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection