<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denuncia extends Model
{
    use HasFactory;
    
    protected $table = 'denuncias';

    protected $fillable = [
        'dni',
        'fecha',
        'tipo',
        'direccion',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'estado' => 'integer',
    ];

}
