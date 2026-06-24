@extends('layouts.admin')

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalRefacciones }}</h3>
<p>Refacciones Registradas</p>
            </div>
            <div class="icon">
                <i class="bi bi-tools"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalPiezas }}</h3>
<p>Piezas en Inventario</p>
            </div>
            <div class="icon">
                <i class="bi bi-box-arrow-in-down"></i>
            </div>
        </div>
    </div>

    

</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">ERP Refacciones</h3>
    </div>

    <div class="card-body">
        Bienvenido al sistema ERP de control de inventario.
    </div>
</div>

@endsection