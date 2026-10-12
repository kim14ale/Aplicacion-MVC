<?php

namespace Database\Seeders;

use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentasTableSeeder extends Seeder
{
    public function run()
    {
        $ventas = [
            ['vendedor_id' => 1, 'fecha_venta' => '2025-06-02', 'monto' => 650],
            ['vendedor_id' => 1, 'fecha_venta' => '2025-06-15', 'monto' => 850],
            ['vendedor_id' => 2, 'fecha_venta' => '2025-06-05', 'monto' => 500],
            ['vendedor_id' => 2, 'fecha_venta' => '2025-06-20', 'monto' => 1200],
            ['vendedor_id' => 3, 'fecha_venta' => '2025-06-10', 'monto' => 300],
            ['vendedor_id' => 4, 'fecha_venta' => '2025-06-12', 'monto' => 900],
            ['vendedor_id' => 4, 'fecha_venta' => '2025-05-28', 'monto' => 700],

            // Agosto de 2026
            ['vendedor_id' => 1, 'fecha_venta' => '2026-08-05', 'monto' => 480],
            ['vendedor_id' => 2, 'fecha_venta' => '2026-08-12', 'monto' => 720],
            ['vendedor_id' => 3, 'fecha_venta' => '2026-08-19', 'monto' => 1050],
            ['vendedor_id' => 4, 'fecha_venta' => '2026-08-27', 'monto' => 880],

            // Septiembre de 2026
            ['vendedor_id' => 1, 'fecha_venta' => '2026-09-03', 'monto' => 620],
            ['vendedor_id' => 2, 'fecha_venta' => '2026-09-11', 'monto' => 940],
            ['vendedor_id' => 3, 'fecha_venta' => '2026-09-18', 'monto' => 1300],
            ['vendedor_id' => 4, 'fecha_venta' => '2026-09-26', 'monto' => 560],

            // Octubre de 2026
            ['vendedor_id' => 1, 'fecha_venta' => '2026-10-02', 'monto' => 780],
            ['vendedor_id' => 2, 'fecha_venta' => '2026-10-05', 'monto' => 1100],
            ['vendedor_id' => 3, 'fecha_venta' => '2026-10-08', 'monto' => 450],
            ['vendedor_id' => 4, 'fecha_venta' => '2026-10-11', 'monto' => 990],
        ];

        foreach ($ventas as $venta) {
            Venta::firstOrCreate($venta);
        }
    }
}
