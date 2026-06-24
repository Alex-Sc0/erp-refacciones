<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefaccionController;
use App\Http\Controllers\MovimientoController; // Importado correctamente aquí arriba
use App\Models\Refaccion;
use Illuminate\Support\Facades\Route;

// Redirección inicial
Route::redirect('/', '/dashboard');

// Dashboard
Route::get('/dashboard', function () {
    $totalRefacciones = Refaccion::count();
    $totalPiezas = Refaccion::sum('cantidad');

    return view('dashboard', compact(
        'totalRefacciones',
        'totalPiezas'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// Todas las rutas protegidas por autenticación agrupadas correctamente
Route::middleware('auth')->group(function () {
    
    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Catálogo de Refacciones y Búsqueda
    Route::resource('refacciones', RefaccionController::class);
    Route::get('/buscar-refacciones', [RefaccionController::class, 'buscarGlobal'])->name('refacciones.buscar');
    
    // Líneas de Producción
    Route::get('/lineas/{numero}', [RefaccionController::class, 'línea']);
    Route::get('/Etiquetadoras', [RefaccionController::class, 'Etiquetadoras']);

    // Movimientos de Inventario (Index, Guardar y Eliminar)
    Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
    Route::post('/movimientos', [MovimientoController::class, 'store'])->name('movimientos.store');
    Route::delete('/movimientos/{id}', [MovimientoController::class, 'destroy'])->name('movimientos.destroy');

});

// Autenticación de Laravel Breeze / Jetstream
require __DIR__.'/auth.php';
