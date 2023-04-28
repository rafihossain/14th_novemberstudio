<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory;
    protected $table = "pages";
    protected $fillable = ['page_name','page_title','page_url','meta_title','meta_key_word','meta_description','country'];

    public function page_section(){
        return $this->hasMany(PageSectionModel::class,'page_id','id');
    }
}

