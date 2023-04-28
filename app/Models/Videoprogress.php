<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videoprogress extends Model
{
    use HasFactory;
    protected $table = "video_progress";

     public function getusers(){
         return $this->belongsTo(User::class, 'user_id', 'id'); 
     }
}
