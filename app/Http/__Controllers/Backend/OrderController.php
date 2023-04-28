<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){
        // dd('hi');
        $contactinfos = ContactInformation::get();
        return view('backend.order.order-list', [
            'contactinfos' => $contactinfos
        ]);
    }
    public function orderDelete($id){
        ContactInformation::where('id', $id)->delete();
        return redirect()->route('backend.order-list')->with('success', 'Contact us has been deleted successfully !!');
    }
}
