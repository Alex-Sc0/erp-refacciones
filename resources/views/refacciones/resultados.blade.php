@extends('layouts.admin') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <div class="card card-outline card-primary shadow">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-search mr-2"></i> 
                        Resultados de búsqueda para: <strong>"{{ $termino }}"</strong>
                    </h3>
                </div>
                
                <div class="card-body">
                    @if($resultados->isEmpty())
                        <div class="alert alert-warning text-center m-0">
                            <i class="bi bi-exclamation-triangle-fill mr-2"></i> 
                            No se encontraron refacciones que coincidan con tu búsqueda. Intentelo de nuevo.
                        </div>
                    @else
                       <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover m-0">
        <thead class="thead-dark">
            <tr>
                <th style="width: 15%">Código</th>
                <th>Nombre de la Refacción</th>
                <th>Línea</th>
                <th>Cantidad / Stock</th>
                <th style="width: 15%" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $refaccion)
                <tr>
                    <td>
                        <span class="badge badge-secondary font-weight-bold p-2 w-100">
                            {{ $refaccion->codigo }}
                        </span>
                    </td>
                    <td class="align-middle font-weight-bold text-dark">
                        {{ $refaccion->nombre }}
                    </td>
                    
                    <td class="align-middle font-weight-bold text-secondary">
                        @if($refaccion->linea)
                            {{ $refaccion->linea}}
                            
                            {{-- 
                              NOTA: Si usas una relación de Eloquent (ej. un modelo Linea), 
                              puedes cambiarlo por: {{ $refaccion->linea->nombre ?? 'N/A' }} 
                            --}}
                        @else
                            <span class="text-muted font-weight-normal">No asignada</span>
                        @endif
                    </td>

                    <td class="align-middle">
                        <span class="badge {{ $refaccion->cantidad > 0 ? 'badge-success' : 'badge-danger' }} p-2">
                            {{ $refaccion->cantidad }} pzas
                        </span>
                    </td>
                   <td class="text-center align-middle">
                  <a href="/refacciones/{{ $refaccion->id }}/edit" class="btn btn-sm btn-info shadow-smmr-1">
                   <i class="bi bi-pencil-square"></i> Editar
                    </a>

                   <a href="/movimientos?refaccion_id={{ $refaccion->id }}" class="btn btn-sm btn-success shadow-sm">
                     <i class="bi bi-arrow-left-right"></i> Movimiento
                  </a>
                  </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

                        <div class="mt-4 d-flex justify-content-center">
                            {{ $resultados->appends(['query' => $termino])->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection