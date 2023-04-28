<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faqList()
    {
        $faqs = Faq::get();
        return view('backend.faq.manage_faq', [
            'faqs' => $faqs,
        ]);
    }

    public function faqAdd()
    {
        $data=[];
        return view('backend.faq.add_faq',$data);
    }

    public function faqSave(Request $request)
    {
 
         $request->validate([
            'faq_question' => 'required',
            'faq_answare' => 'required',
        ]);
         
        $des = $request['faq_answare'];
        if($des == null){
            $des = '';
        }
     
        $faq = new Faq();
        $faq->faq_question = $request->faq_question;
        $faq->faq_answare = $des;
        $faq->save();
        return redirect('admin/faq/list')->with('success', 'Successfully faq Save');
    }

    public function faqEdit($id)
    {
        $data=[];
        $data['faq'] = Faq::find($id);
        return view('backend.faq.edit_faq', $data);
    }

    public function faqUpdate(Request $request)
    {
   

   
        $request->validate([
            'faq_question' => 'required',
            'faq_answare' => 'required',
        ]);
         
        $des = $request['faq_answare'];

        if($des == null){
            $des = '';
        }
        $faq = Faq::find($request['id']);
        $faq->faq_question = $request['faq_question'];
        $faq->faq_answare = $des;
        $faq->save();

        return redirect('admin/faq/list')->with('success', 'Successfully faq Updated');
    }

    public function faqDelete($id)
    {
        Faq::find($id)->delete();
        return redirect('admin/faq/list')->with('success', 'Successfully faq Deleted');
    }
}
