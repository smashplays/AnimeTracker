<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChapters extends Model
{
    use HasFactory;

 protected $fillable=[
    'user_id',
    'anime_chapter_id',
    'watched'
 ];


 public function user() {
    return $this->belongsTo(User::class);
   
}

public function chapter() {
    return $this->belongsTo(Chapter_Anime::class);
   
}
}
