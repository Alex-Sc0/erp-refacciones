<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP Refacciones</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <ul class="navbar-nav align-items-center flex-grow-1" style="max-width: 600px;">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <span class="nav-link font-weight-bold mr-3">ERP Refacciones</span>
        </li>

        <li class="nav-item flex-grow-1">
            <form action="{{ route('refacciones.buscar') }}" method="GET" class="m-0">
                <div class="input-group input-group-sm">
                    <input type="text" name="query" class="form-control" placeholder="Buscar refacción en todo el ERP..." value="{{ request('query') }}" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        @auth
        <li class="nav-item mr-3">
            <span class="text-muted">
                Usuario: <strong>{{ Auth::user()->name }}</strong>
            </span>
        </li>
        @endauth

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Cerrar sesión
                </button>
            </form>
        </li>
    </ul>
</nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 flex-column">
        
        <div style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; box-sizing: border-box; border-bottom: 1px solid #374151;">
            <img src="data:image/png;base64,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" " 
                 alt="Logo Glass" 
                 style="max-width: 85%; height: auto; display: block; object-fit: contain;">
        </div>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/refacciones" class="nav-link">
                            <i class="nav-icon bi bi-box-seam"></i>
                            <p>Inventario General</p>
                        </a>
                    </li>

                    <li class="nav-header">LÍNEAS DE PRODUCCIÓN</li>

                    <li class="nav-item"><a href="/lineas/11" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Línea 11</p></a></li>
                    <li class="nav-item"><a href="/lineas/12" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Línea 12</p></a></li>
                    <li class="nav-item"><a href="/lineas/13" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Línea 13</p></a></li>
                    <li class="nav-item"><a href="/lineas/14" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Línea 14</p></a></li>
                    <li class="nav-item"><a href="/lineas/15" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Línea 15</p></a></li>
                    <li class="nav-item"><a href="/lineas/16" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Línea 16</p></a></li> 
                    
                    <li class="nav-item"><a href="/Etiquetadoras" class="nav-link"><i class="nav-icon bi bi-gear"></i><p>Etiquetadoras</p></a></li> 
                    <li class="nav-item"><a href="/movimientos" class="nav-link"><i class="nav-icon bi bi-arrow-left-right"></i><p>Movimientos</p></a></li>

                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>