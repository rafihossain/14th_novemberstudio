<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';
    
    public function package_category(){
        return $this->belongsTo(PackageCategory::class, 'package_category_id', 'id');
    }

    // public function category(){
    //     return $this->belongsTo(CinemaCategory::class, 'cinema_category_id', 'id');
    // }
}
