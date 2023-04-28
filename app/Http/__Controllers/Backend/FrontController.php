<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Banner;
use Illuminate\Http\Request;

class FrontController extends Controller
{
      public function banner()
    {
    $banners = Banner::all();
    return view('backend.banner.banner', [
    'banners' => $banners,
    ]);
    }
    
    public function banneredit(){
        
    }
     public function bannerUpdate(){
        
    }
}