<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'genre',
        'chapters',
        'status',
        'start_date',
        'end_date',
        'image',
        'trailer'
    ];

   
    public function users() {
        return $this->hasMany(Anime_User::class); 
    }


    public function chapters() {
        return $this->hasMany(Chapter_Anime::class);
    }

  
    
}
