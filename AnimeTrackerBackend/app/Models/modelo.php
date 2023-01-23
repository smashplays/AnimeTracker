<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo extends Model
{
    use HasFactory;

    protected $table = "alumnos";

    protected $fillable = [
        'nombre',
        'telefono',
        'edad',
        'contraseña',
        'email',
        'sexo',
    ];

    protected $hidden = [
        'contraseña',
        'create_at',
        'update_at'
    ];
    public $timestamps = false;
}
