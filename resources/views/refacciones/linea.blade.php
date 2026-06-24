@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Inventario Línea {{ $numero }}
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                     <th>Linea</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
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

                        @if($refaccion->cantidad <= $refaccion->stock_minimo)

                            <span class="badge badge-danger">
                                Stock Bajo
                            </span>

                        @else

                            <span class="badge badge-success">
                                Disponible
                            </span>

                        @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection