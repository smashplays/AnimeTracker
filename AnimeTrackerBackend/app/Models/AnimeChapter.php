<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeChapter extends Model
{
    use HasFactory;


    protected $fillable=[
        'name',
        'aired',
        'anime_id'
     ];

     public function anime() {
        return $this->hasOne(Anime::class);
       
    }

    public function chapters(){
        return $this->hasMany(UserChapters::class);
    }
    

}
