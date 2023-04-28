<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";


     public function getusers(){
         return $this->belongsTo(User::class, 'user_id', 'id'); 
     }

    // public function PartnerBranch()
    // {
    //     return $this->belongsTo(PartnerBranch::class, 'branch_id', 'id');
    // }

    // public function partner()
    // {
    //     return $this->belongsTo(Partner::class, 'partner_id', 'id');
    // }

    // public function partnerBranches()
    // {
    //     return $this->belongsTo(PartnerBranch::class, 'branch_id', 'id');
    // }

    // public function productType()
    // {
    //     return $this->belongsTo(ProductType::class, 'product_type', 'id');
    // }
}
