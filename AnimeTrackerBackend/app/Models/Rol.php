<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'descripcion'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];



    public function usuarios()
    {

        return $this->hasMany(User::class);
        
    }
}
