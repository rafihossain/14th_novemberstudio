<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSectionModel extends Model
{
    use HasFactory;
    protected $table = "page_sections";
    protected $fillable = ['page_id','column_width','section'];
}
