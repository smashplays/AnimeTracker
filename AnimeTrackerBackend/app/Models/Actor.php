<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'age',
        'image'
    ];

    protected $hidden = [];

    public function microphone(){
        return $this->hasOne(Microphone::class);
    }

    public function characters(){
        return $this->hasMany(Character::class);
    }
}
