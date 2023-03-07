<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeUser extends Model
{
    use HasFactory;


    protected $fillable=[
        'user_id',
        'anime_id',
     ];

     public function user() {
        return $this->belongsTo(User::class);
       
    }
    public function anime() {
        return $this->belongsTo(Anime::class,'anime_id','mal_id');
       
    }



    
    
    
}
