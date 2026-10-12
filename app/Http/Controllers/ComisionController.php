<?php

namespace App\Http\Controllers;

use App\Models\Regla;
use App\Models\Vendedor;
use App\Services\CalculadorComisiones;
use Illuminate\Http\Request;

class ComisionController extends Controller
{
    /**
     * Muestra el formulario, lista de vendedores y reglas.
     */
    public function index()
    {
        $vendedores = Vendedor::select('id', 'nombre', 'email')->get();
        $reglas = Regla::orderBy('umbral_monto')->get();

        return view('comisiones.index', compact('vendedores', 'reglas'));
    }

    /**
     * Procesa el filtro por fechas, calcula comisiones
     * y vuelve a mostrar todo (incluyendo reglas).
     */
    public function calcular(Request $request, CalculadorComisiones $calculador)
    {
        $data = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        return response()->json([
            'resultados' => $calculador->calcular($data['fecha_inicio'], $data['fecha_fin']),
            'fecha_inicio' => $data['fecha_inicio'],
            'fecha_fin' => $data['fecha_fin'],
        ]);
    }
}
