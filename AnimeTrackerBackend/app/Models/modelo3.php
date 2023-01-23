<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'informacion',
        'URL_img',

    ];

    protected $hidden = [

        'create_at',
        'update_at'
    ];
}
