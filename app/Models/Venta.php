<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['vendedor_id', 'fecha_venta', 'monto'];

    protected function casts(): array
    {
        return [
            'fecha_venta' => 'date',
            'monto' => 'decimal:2',
        ];
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
}
