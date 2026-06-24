<?php

namespace App\Http\Controllers;

use App\Models\Refaccion;
use Illuminate\Http\Request;

class RefaccionController extends Controller
{
    public function index()
{
    $refacciones = Refaccion::orderBy('codigo', 'asc')->get();
    return view('refacciones.index', compact('refacciones'));
}

public function store(Request $request)
{
    
    $refaccion = new Refaccion();

    $refaccion->codigo = $request->codigo;
    $refaccion->nombre = $request->nombre;
    $refaccion->cantidad = $request->cantidad;
    $refaccion->linea = $request->linea;
    $refaccion->stock_minimo = 5;
    $refaccion->save();


    return redirect()->route('refacciones.index');
}

    public function show(string $id)
    {
        //
    }

public function línea($numero)
{
  $refacciones = Refaccion::where('linea', 'Línea ' . $numero)
                             ->orderBy('codigo', 'asc')
                             ->get();
    return view('refacciones.linea', compact(
    'refacciones',
    'numero'));
}
public function Etiquetadoras()
{ 
    $refacciones = Refaccion::where('linea', 'Etiquetadoras')
                             ->orderBy('codigo', 'asc') // Orden agregada
                             ->get();

    return view('refacciones.Etiquetadoras', compact(
        'refacciones'
    ));
}
   public function edit(string $id)
{
    $refaccion = Refaccion::findOrFail($id);

    return view('refacciones.edit', compact('refaccion'));
}

    public function update(Request $request, string $id)
{
    $refaccion = Refaccion::findOrFail($id);
    $refacciones = Refaccion::orderBy('codigo', 'asc')->get();

    $refaccion->update([
        'codigo' => $request->codigo,
        'nombre' => $request->nombre,
        'cantidad' => $request->cantidad,
        'linea' => $request->linea,
    ]);

    return redirect()->route('refacciones.index');
}

    public function destroy(string $id)
{
    Refaccion::findOrFail($id)->delete();

    return redirect()->route('refacciones.index');
}
public function buscarGlobal(Request $request)
    {
    
        $termino = $request->input('query');

        
        $resultados = \App\Models\Refaccion::where('nombre', 'LIKE', "%{$termino}%")
            ->orWhere('codigo', 'LIKE', "%{$termino}%")
            ->paginate(15); 

        
        return view('refacciones.resultados', compact('resultados', 'termino'));
    }
}
