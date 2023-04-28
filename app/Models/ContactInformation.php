<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;
    protected $table = 'contact_informations';

    // public function category(){
    //     return $this->belongsTo(CinemaCategory::class, 'cinema_category_id', 'id');
    // }
}
