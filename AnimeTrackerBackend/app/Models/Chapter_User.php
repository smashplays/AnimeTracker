<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter_User extends Model
{
    use HasFactory;

 protected $fillable=[
    'id',
    'user_id',
    'chapter_id',
    'watched'
 ];


 public function user() {
    return $this->belongsTo(User::class);
   
}

public function chapter() {
    return $this->belongsTo(Chapter_Anime::class);
   
}
}
