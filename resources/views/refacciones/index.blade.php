@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Inventario de Refacciones</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('refacciones.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-4">
                    <label>Código</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="col-md-2">
    <label>Cantidad</label>
    <input type="number" name="cantidad" class="form-control" required>
</div>

<div class="col-md-2">
    <label>Línea</label>

    <select name="linea" class="form-control">
        <option value="">Seleccionar</option>
        <option value="Línea 11">Línea 11</option>
        <option value="Línea 12">Línea 12</option>
        <option value="Línea 13">Línea 13</option>
        <option value="Línea 14">Línea 14</option>
        <option value="Línea 15">Línea 15</option>
        <option value="Línea 16">Línea 16</option>
        <option value="Etiquetadoras">Etiquetadoras</option>
    </select>
</div>

                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block">
                        Guardar
                    </button>
                </div>

            </div>

        </form>

        <hr>

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Línea</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($refacciones as $refaccion)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $refaccion->codigo }}</td>
                    <td>{{ $refaccion->nombre }}</td>
                    <td>{{ $refaccion->linea }}</td>
                    <td>{{ $refaccion->cantidad }}</td>

                    <td>

   
@if((int)$refaccion->cantidad <= (int)$refaccion->stock_minimo)
        <span class="badge badge-danger">
            Stock Bajo
        </span>

    @else

        <span class="badge badge-success">
            Disponible
        </span>

    @endif

</td>

                    <td>

                        <a href="{{ route('refacciones.edit', $refaccion->id) }}"
                           class="btn btn-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('refacciones.destroy', $refaccion->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Deseas eliminar esta refacción?')">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection