<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo4 extends Model
{
    use HasFactory;

    protected $fillable = [
        'sede',

    ];

    protected $hidden = [

        'create_at',
        'update_at'
    ];
}
