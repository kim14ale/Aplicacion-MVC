<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regla extends Model
{
    protected $fillable = ['porcentaje', 'umbral_monto'];

    protected function casts(): array
    {
        return [
            'porcentaje' => 'decimal:4',
            'umbral_monto' => 'decimal:2',
        ];
    }
}
