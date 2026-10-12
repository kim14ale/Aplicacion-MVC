<?php

namespace App\Services;

use App\Models\Regla;
use App\Models\Venta;

class CalculadorComisiones
{
    public function calcular(string $fechaInicio, string $fechaFin): array
    {
        $reglas = Regla::orderByDesc('umbral_monto')->get();

        $ventas = Venta::with('vendedor:id,nombre')
            ->whereBetween('fecha_venta', [$fechaInicio, $fechaFin])
            ->get();

        $resultados = [];

        foreach ($ventas as $venta) {
            $regla = $reglas->first(
                fn (Regla $regla) => $regla->umbral_monto <= $venta->monto
            );

            $id = $venta->vendedor_id;
            $resultados[$id] ??= [
                'vendedor_id' => $id,
                'nombre' => $venta->vendedor->nombre,
                'comision_total' => 0,
            ];

            $porcentaje = $regla?->porcentaje ?? 0;
            $resultados[$id]['comision_total'] += round($venta->monto * $porcentaje, 2);
        }

        return array_values($resultados);
    }
}
