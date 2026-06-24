<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Refaccion;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
 
   public function index(Request $request)
{
    $refaccionSeleccionadaId = $request->get('refaccion_id');
    $lineaSeleccionada = null;
    
    if ($refaccionSeleccionadaId) {
        $refaccionBusqueda = Refaccion::find($refaccionSeleccionadaId);
        if ($refaccionBusqueda) {
            
            $lineaSeleccionada = $refaccionBusqueda->linea; 
            
            if (is_numeric($lineaSeleccionada)) {
                $lineaSeleccionada = 'Línea ' . $lineaSeleccionada;
            }
        }
    }

    $refacciones = Refaccion::orderBy('codigo', 'asc')->get();
    
    $movimientos = Movimiento::with('refaccion')
        ->latest()
        ->get();

    return view('movimientos.index', compact(
        'refacciones',
        'movimientos',
        'refaccionSeleccionadaId',
        'lineaSeleccionada'
    ));
}
   public function store(Request $request)
{
    $refaccion = Refaccion::findOrFail($request->refaccion_id);

   if ($request->tipo == 'entrada') {

    $refaccion->cantidad += $request->cantidad;

} else {

    if ($request->cantidad > $refaccion->cantidad) {

        return redirect()
            ->back()
            ->with('error', 'No hay suficiente existencia para realizar la salida.');
    }

    $refaccion->cantidad -= $request->cantidad;
}

   $refaccion->save();

    Movimiento::create([
        'refaccion_id' => $request->refaccion_id,
        'tipo'         => $request->tipo,
        'cantidad'     => $request->cantidad,
        'linea'        => $request->linea,       
    ]);

    return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado correctamente.');
}
public function destroy($id)
{
    $movimiento = Movimiento::findOrFail($id);
    $refaccion = $movimiento->refaccion;

    

    // Eliminamos el registro del movimiento
    $movimiento->delete();

    return redirect()->route('movimientos.index')->with('success', 'Movimiento eliminado.');
}
}