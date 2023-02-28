<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter_Anime extends Model
{
    use HasFactory;


    protected $fillable=[
        'id',
        'name',
        'date',
        'anime_id'
     ];



     public function anime() {
        return $this->hasOne(Anime::class);
       
    }

}
