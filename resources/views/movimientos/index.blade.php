@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Movimientos de Inventario</h3>
    </div>

    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif

        <form action="{{ route('movimientos.store') }}" method="POST">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <label class="font-weight-bold">Línea</label>
                        <select name="linea" id="linea_select" class="form-control" required>
                            <option value="">Seleccione</option>
                            @foreach(['Línea 11', 'Línea 12', 'Línea 13', 'Línea 14', 'Línea 15', 'Línea 16', 'Etiquetadoras'] as $opcionLinea)
                                <option value="{{ $opcionLinea }}" {{ (isset($lineaSeleccionada) && $lineaSeleccionada == $opcionLinea) ? 'selected' : '' }}>
                                    {{ $opcionLinea }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="font-weight-bold">Refacción</label>
                        <select name="refaccion_id" id="refaccion_select" class="form-control" required>
                            <option value="">Seleccione</option>
                            @foreach($refacciones as $refaccion)
                                <option value="{{ $refaccion->id }}" 
                                        data-linea="{{ $refaccion->linea }}"
                                        {{ (isset($refaccionSeleccionadaId) && $refaccionSeleccionadaId == $refaccion->id) ? 'selected' : '' }}>
                                    {{ $refaccion->codigo }} - {{ $refaccion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <label class="font-weight-bold">Tipo</label>
                        <select name="tipo" class="form-control" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <label class="font-weight-bold">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-check-circle mr-1"></i> Registrar</button>
                </div>
            </div>
        </form>

        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover m-0">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 7%">ID</th>
                        <th>Refacción</th>
                        <th style="width: 12%">Tipo</th>
                        <th style="width: 12%">Línea</th>
                        <th style="width: 12%">Cantidad</th>
                        <th>Fecha</th>
                        <th style="width: 12%" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movimientos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->id }}</td>
                        <td class="font-weight-bold text-dark">
                            {{ $movimiento->refaccion ? ($movimiento->refaccion->codigo . ' - ' . $movimiento->refaccion->nombre) : 'Refacción eliminada' }}
                        </td>
                        <td>
                            <span class="badge badge-{{ $movimiento->tipo == 'entrada' ? 'success' : 'danger' }} p-2 w-100">{{ ucfirst($movimiento->tipo) }}</span>
                        </td>
                        <td class="text-secondary font-weight-bold">{{ $movimiento->linea ?? 'N/A' }}</td>
                        <td><span class="text-{{ $movimiento->tipo == 'entrada' ? 'success' : 'danger' }} font-weight-bold">{{ $movimiento->tipo == 'entrada' ? '+' : '-' }}{{ $movimiento->cantidad }}</span></td>
                        <td>{{ $movimiento->created_at ?? 'Sin fecha' }}</td>
                        <td class="text-center align-middle">
                            <form action="{{ route('movimientos.destroy', $movimiento->id) }}" method="POST" onsubmit="return confirm('¿Seguro? Esta acción NO revierte el stock.');" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger shadow-sm"><i class="bi bi-trash"></i> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('linea_select').addEventListener('change', function() {
    var lineaSeleccionada = this.value;
    var refaccionSelect = document.getElementById('refaccion_select');
    var opciones = refaccionSelect.options;

    for (var i = 0; i < opciones.length; i++) {
        var lineaRefaccion = opciones[i].getAttribute('data-linea');
        if (opciones[i].value === "" || lineaRefaccion === lineaSeleccionada) {
            opciones[i].style.display = "block";
        } else {
            opciones[i].style.display = "none";
        }
    }
    refaccionSelect.value = "";
});
</script>
@endsection