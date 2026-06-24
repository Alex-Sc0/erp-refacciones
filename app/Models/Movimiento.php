<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';

    protected $fillable = [
        'refaccion_id',
        'tipo',
        'cantidad',
        'linea',
    ];

    public function refaccion()
    {
        return $this->belongsTo(Refaccion::class);
    }
}