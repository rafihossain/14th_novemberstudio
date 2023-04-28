<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentlist()
    {
        $payments = Payment::with('getusers')->get();
        return view('backend.payment.payment', [
        'payments' => $payments,
        ]);
    }
    public function paymentedit($id)
    {
        $payment = Payment::with('getusers')->find($id);
        return view('backend.payment.editpayment', [
        'payment' => $payment,
        ]);
    }
    public function paymentUpdate(Request $request)
    {
        $payment = Payment::where('id',$request->payment_id)->first();
        $payment->deposit_amount = $request->deposit_amount;
        $payment->advance_amount = $request->advance_amount;
        $payment->next_paymet_amount = $request->next_paymet_amount;
        $payment->due_balance = ($request->deposit_amount - $request->advance_amount);
        $payment->next_payment = $request->next_payment;
        $payment->expected_delivery = $request->expected_delivery;
        $payment->notes = $request->notes;
        $payment->status = $request->status;
        
        if($payment->status == 1){
        $payment->advance_amount = $request->deposit_amount;
        $payment->due_balance = 0;
        $payment->next_paymet_amount=0;
        $payment->next_payment ='';
        }

        
        
        
        $payment->save();
//\Session::flash('flash_message','Application has been successfully submitted.');
    return redirect(route('backend.payment-edit', ['id' => $request->payment_id]));
    }
    

    // public function eventAdd()
    // {
    //     $data=[];
    //     $data['users'] = User::select('id','first_name','last_name','username')->get()->toArray();
    //     return view('backend.events.addevent',$data);
    // }

    // public function eventSave(Request $request)
    // {
       
        
    //     $request->validate([
    //         'title' => 'required',
    //         'date_time' => 'required',
    //     ]);
        
    //     $event = new Event();
    //     $event->event_title = $request->title;
    //     $event->user_id = $request->user_id;
    //     $event->event_date = $request->date_time;
    //     $event->count_video = $request->video_graphers;
    //     $event->locations = $request->location;
    //     $event->notes = $request->special_notes;
    //     $event->save();

    //     return redirect('admin/event/list')->with('success', 'Successfully Event Save');
    // }

    // public function eventEdit($id)
    // {
    //     $data=[];
    //     $data['users'] = User::select('id','first_name','last_name','username')->get()->toArray();
    //     $data['event'] = Event::with('getusers')->find($id);
    //     return view('backend.events.editevent', $data);
    // }

    // public function eventUpdate(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'date_time' => 'required',
    //     ]);
    //     $event = Event::find($request->event_id);
    //     $event->event_title = $request->title;
    //     $event->user_id = $request->user_id;
    //     $event->event_date = $request->date_time;
    //     $event->count_video = $request->video_graphers;
    //     $event->locations = $request->location;
    //     $event->notes = $request->special_notes;
    //     $event->save();

    //     return redirect('admin/event/list')->with('success', 'Successfully Event Updated');
    // }

    // public function eventDelete($id)
    // {
    //     Event::find($id)->delete();
    //     return redirect('admin/event/list')->with('success', 'Successfully Event Deleted');
    // }
}
