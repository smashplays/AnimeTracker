<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'age',
        'image'
    ];

    protected $hidden = [];

    public function actor(){
        return $this->belongsTo(Actor::class);
    }
}
