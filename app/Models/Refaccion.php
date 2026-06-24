<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
    protected $table = 'refacciones';

    protected $fillable = [
        'codigo',
        'nombre',
        'cantidad',
        'stock_minimo',
        'linea',

    ];

    public $timestamps = false;

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}