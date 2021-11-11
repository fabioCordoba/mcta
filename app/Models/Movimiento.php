<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cuenta_id',
        'monto',
        'descripcion',
        'tipo',
        'estado',
    ];

    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cuenta()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_id');
    }
}
