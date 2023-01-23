<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'genero',
        'capitulos',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'URL_imagen'
    ];

    protected $hidden = [

        'create_at',
        'update_at'
    ];
}
