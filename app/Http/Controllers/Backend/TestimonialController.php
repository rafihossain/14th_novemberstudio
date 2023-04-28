<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    protected function testimonialInfoValidateSave($request){
        $request->validate([
            'user_name' => 'required',
            'user_comment' => 'required',
        ]);
    }
    protected function testimonialInfoValidateUpdate($request){
        $request->validate([
            'user_name' => 'required',
            'user_comment' => 'required',
        ]);
    }
    // protected function testimonialImageUpload($request){
    //     $userImage = $request->file('user_image');

    //     $image = Image::make($userImage);
    //     $fileType = $userImage->getClientOriginalExtension();
    //     $imageName = 'testimonial_'.time().'_'.rand(10000, 999999).'.'.$fileType;
    //     $directory = 'admin/image/testimonial/';
    //     $imageUrl = $directory.$imageName;
    //     $image->save($imageUrl);
        
    //     $thumbnail = $directory."thumbnail/".$imageName;
    //     $image->resize(null, 200, function($constraint) {
    //         $constraint->aspectRatio();
    //     });
    //     $image->save($thumbnail);

    //     return $thumbnail;
    // }
    
    //  protected function testimonialVideoUpload($request){
    //     $uservideo = $request->file('user_video');
    //     $name=Str::random(20);
    //     $ext=strtolower($uservideo->getClientOriginalExtension());
    //     $image_full_name='testimonial_video_'.$name.'.'.$ext;
    //     $upload_path='admin/image/testimonial/';
    //     $success=$uservideo->move($upload_path,$image_full_name);

    //     return $image_full_name;
    // }
    
    protected function testimonialBasicInfoSave($request){

        $testimonial = new Testimonial;
        $testimonial->user_name = $request->user_name;
      	$testimonial->user_designation = $request->user_designation;
        $testimonial->user_comment = $request->user_comment;
        $testimonial->save();
    }
    
    protected function testimonialBasicInfoUpdate($request, $testimonial)
    {
        $testimonial->user_name = $request->user_name;
      	$testimonial->user_designation = $request->user_designation;
        $testimonial->user_comment = $request->user_comment;
        $testimonial->save();
    }
    
    public function addTestimonial(){
        return view('backend.testimonial.add_testimonial');
    }
    public function manageTestimonial(){
        $testimonials = Testimonial::get();
        return view('backend.testimonial.manage_testimonial',[
            'testimonials' => $testimonials
        ]);
    }
    public function saveTestimonial(Request $request){
        
        // dd($_POST);

        $this->testimonialInfoValidateSave($request);
        // $imageUrl = $this->testimonialImageUpload($request);
        //$videoUrl = $this->testimonialVideoUpload($request);
        $this->testimonialBasicInfoSave($request);

        return redirect()->route('backend.manage-testimonial')->with('success', 'Testimonial has been added successfully !!');
    }
    public function editTestimonial($id){
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial',[
            'testimonial' => $testimonial
        ]);
    }
    public function updateTestimonial(Request $request){
        $this->testimonialInfoValidateUpdate($request);
        // $userImage = $request->file('user_image');
        $testimonial = Testimonial::find($request->id);
        $this->testimonialBasicInfoUpdate($request, $testimonial);
        return redirect()->route('backend.manage-testimonial')->with('success', 'Testimonial has been updated successfully !!');
    }
    public function deleteTestimonial($id){
        Testimonial::where('id', $id)->delete();
        return redirect()->route('backend.manage-testimonial')->with('success', 'Testimonial has been deleted successfully !!');
    }
}
