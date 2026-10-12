<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComisionesTest extends TestCase
{
    use RefreshDatabase;

    public function test_calcula_las_comisiones_de_un_rango(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->postJson('/comisiones', [
            'fecha_inicio' => '2025-06-01',
            'fecha_fin' => '2025-06-30',
        ]);

        $response->assertOk()
            ->assertJsonFragment([
                'nombre' => 'Melanie Jacome',
                'comision_total' => 220,
            ]);
    }

    public function test_rechaza_un_rango_invalido(): void
    {
        $response = $this->postJson('/comisiones', [
            'fecha_inicio' => '2025-06-30',
            'fecha_fin' => '2025-06-01',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('fecha_fin');
    }
}
