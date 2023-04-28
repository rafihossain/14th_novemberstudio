<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $table = 'cinemas';

    public function category(){
        return $this->belongsTo(CinemaCategory::class, 'cinema_category_id', 'id');
    }
     public function type(){
        return $this->belongsTo(Type::class, 'type', 'id');
    }
}
