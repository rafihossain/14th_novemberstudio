<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cinema;
use App\Models\CinemaCategory;
use App\Models\Type;
use Image;
use File;
use Illuminate\Support\Str;

class CinemaController extends Controller
{
    //cinema categorycinema
    public function manageCategory(){
        $cinemaCategories = CinemaCategory::all();
   
        return view('backend.cinema.category.manage_category', [
            'cinemaCategories' => $cinemaCategories
        ]);
    }
    public function addCategory(){
        return view('backend.cinema.category.add_category');
    }

    protected function categoryInfoValidate($request){
        $request->validate([
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'category_name' => 'required',
        ]);
    }

    protected function categoryInfoValidateUpdate($request){
        $request->validate([
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'category_name' => 'required',
            'category_slug' => 'required|regex:/^[a-z-0-9S*]+$/',
        ]);
    }

    protected function categoryNewInfoValidateUpdate($request){
        $request->validate([
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'category_name' => 'required',
            'category_slug' => 'required|unique:cinema_categories,category_slug|regex:/^[a-z-0-9S*]+$/',
        ]);
    }

    public function saveCategory(Request $request){
        $this->categoryInfoValidate($request);
        $categorySlug = Str::slug($request->category_name);
        
        $imageUrl = $this->cinemaCategoryImageUpload($request);
        $iconUrl = $this->cinemaCategoryIconUpload($request);

        $slugCheck = CinemaCategory::where('category_slug', 'like', '%'.$categorySlug.'%')->get();
        $slugValue = '';
        if(count($slugCheck) > 0){
              $slugValue = $categorySlug.'-'.count($slugCheck);
        }else{
            $slugValue = $categorySlug;
        }

        $cinemaCategory = new CinemaCategory;
        $cinemaCategory->meta_title = $request->meta_title;
        $cinemaCategory->meta_keywords = $request->meta_keywords;
        $cinemaCategory->meta_description = $request->meta_description;
        $cinemaCategory->category_name = $request->category_name;
        $cinemaCategory->category_slug = $slugValue;
        $cinemaCategory->category_description = $request->category_description;
        $cinemaCategory->image = $imageUrl;
        $cinemaCategory->icon = $iconUrl;
        
        $cinemaCategory->save();
        return redirect()->route('backend.manage-category')->with('success', 'Category has been added successfully !!');
    }
    public function editCategory($id){
        $editCategory = cinemaCategory::find($id);
        return view('backend.cinema.category.edit_category',[
            'editCategory' => $editCategory
        ]);
    }
    public function updateCategory(Request $request){
          
        $cinemaCategory = CinemaCategory::find($request->id);
        if($cinemaCategory->category_slug == $request->category_slug){
            $this->categoryInfoValidateUpdate($request);
        }else{
            $this->categoryNewInfoValidateUpdate($request);
        }
     
        

        
        $cinemaCategory = CinemaCategory::find($request->id);
        $cinemaCategory->meta_title = $request->meta_title;
        $cinemaCategory->meta_keywords = $request->meta_keywords;
        $cinemaCategory->meta_description = $request->meta_description;
        $cinemaCategory->category_name = $request->category_name;
        $cinemaCategory->category_slug = $request->category_slug;
        $cinemaCategory->category_description = $request->category_description;
        
        $imageUrl = $this->cinemaCategoryImageUpload($request);
        if($imageUrl != null){
         $cinemaCategory->image = $imageUrl;
        }
    
        $iconUrl = $this->cinemaCategoryIconUpload($request); 
        if($iconUrl != null){
        $cinemaCategory->icon = $iconUrl;
        }

        $cinemaCategory->save();

        return redirect()->route('backend.manage-category')->with('success', 'Category has been update successfully !!');
    }
    public function deleteCategory($id){
        CinemaCategory::where('id', $id)->delete();
        return redirect()->route('backend.manage-category')->with('success', 'Category has been deleted successfully !!');
    }



    //cinema section
    protected function cinemaInfoValidate($request){
        $request->validate([
        'cinema_title' => 'required',
        'meta_title' => 'required',
        'meta_keywords' => 'required',
        'meta_description' => 'required',
        'cinema_category_id' => 'required',
        'cinema_link' => 'required',
            //'cinema_image' => 'required|dimensions:width=1070,height=723'
        ]);
    }
    protected function cinemaInfoValidateUpdate($request){
        $request->validate([
            'cinema_title' => 'required',
            'cinema_slug' => 'required|regex:/^[a-z-0-9S*]+$/',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'cinema_category_id' => 'required',
            'cinema_link' => 'required',
            //'cinema_image' => 'required|dimensions:width=1070,height=723'
        ]);
    }
    protected function cinemaInfoNewValidateUpdate($request){
        $request->validate([
            'cinema_title' => 'required',
            'cinema_slug' => 'required|unique:cinemas,cinema_slug|regex:/^[a-z-0-9S*]+$/',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'cinema_category_id' => 'required',
            //'cinema_image' => 'required|dimensions:width=1070,height=723'
        ]);
    }

    protected function cinemaCategoryImageUpload($request){
        
         $cinemaImage = $request->file('image');
    if($cinemaImage != null){
        $image = Image::make($cinemaImage);
        $fileType = $cinemaImage->getClientOriginalExtension();
        $imageName = 'cinema_'.time().'_'.rand(10000, 999999).'.'.$fileType;
        $directory = 'admin/image/cinemacategory';
        $imageUrl = $directory.$imageName;
        $image->save($imageUrl);
        
        $thumbnail = $directory."/".$imageName;
        // $image->resize(null, 200, function($constraint) {
        //     $constraint->aspectRatio();
        // });
        $image->resize(452,472);
        $image->save($thumbnail);

        return $thumbnail; 
}else{
    return null;
}
    }
    
        protected function cinemaCategoryIconUpload($request){
         $cinemaImage = $request->file('icon');
if($cinemaImage != null){
        $image = Image::make($cinemaImage);
        $fileType = $cinemaImage->getClientOriginalExtension();
        $imageName = 'cinema_'.time().'_'.rand(10000, 999999).'.'.$fileType;
        $directory = 'admin/image/cinemacategory';
        $imageUrl = $directory.$imageName;
        $image->save($imageUrl);
        
        $thumbnail = $directory."/".$imageName;
        // $image->resize(null, 200, function($constraint) {
        //     $constraint->aspectRatio();
        // });
        //$image->resize(54,64);
        $image->save($thumbnail);

        return $thumbnail; 
}else{
  return null;  
}
    }
    
    
    protected function cinemaImageUpload($request){
        $cinemaImage = $request->file('cinema_image');

        $image = Image::make($cinemaImage);
        $fileType = $cinemaImage->getClientOriginalExtension();
        $imageName = 'cinema_'.time().'_'.rand(10000, 999999).'.'.$fileType;
        $directory = 'admin/image/cinema/';
        $imageUrl = $directory.$imageName;
        $image->save($imageUrl);
        
        $thumbnail = $directory."thumbnail/".$imageName;
        // $image->resize(null, 200, function($constraint) {
        //     $constraint->aspectRatio();
        // });
        $image->resize(570,490);
        $image->save($thumbnail);

        return $thumbnail;
    }

    protected function cinemaBasicInfoSave($request, $imageUrl=null){
        $cinemaSlug = Str::slug($request->cinema_title);
    
        $slugCheck = Cinema::where('cinema_slug', 'like', '%'.$cinemaSlug.'%')->get();
        $slugValue = '';
        if(count($slugCheck) > 0){
              $slugValue = $cinemaSlug.'_'.count($slugCheck);
        }else{
            $slugValue = $cinemaSlug;
        }
      
    
        $cinema = new Cinema;
        $cinema->meta_title = $request->meta_title;
        $cinema->meta_keywords = $request->meta_keywords;
        $cinema->meta_description = $request->meta_description;
        $cinema->cinema_title = $request->cinema_title;
        
        if(isset($request->related_post) && $request->related_post != ''){
            $relatedPost = implode(',', $request->related_post);
            $cinema->related_post = $relatedPost;
        }
        $cinema->show_in_app = (isset($request->show_in_app)?$request->show_in_app:0);
        $cinema->cinema_category_id = $request->cinema_category_id;
        //$cinema->cinema_description = $request->cinema_description;
        $cinema->cinema_slug = $slugValue;
        $cinema->cinema_image = $imageUrl;
        $cinema->cinema_link = $request->cinema_link;
        if(isset($request->cinema_status)){
            $cinema->cinema_status = 1;
        }else{
            $cinema->cinema_status = 2;
        }
        $cinema->save();
    }

    protected function cinemaBasicInfoUpdate($request, $cinema, $imageUrl=null){
        
        $cinema->cinema_title = $request->cinema_title;
        if(isset($request->related_post) && $request->related_post != ''){
            $relatedPost = implode(',', $request->related_post);
            $cinema->related_post = $relatedPost;
        }
        $cinema->meta_title = $request->meta_title;
        $cinema->meta_keywords = $request->meta_keywords;
        $cinema->meta_description = $request->meta_description;
        $cinema->cinema_category_id = $request->cinema_category_id;
        //$cinema->cinema_description = $request->cinema_description;
        $cinema->cinema_slug = $request->cinema_slug;
        $cinema->cinema_link = $request->cinema_link;
         $cinema->show_in_app = (isset($request->show_in_app)?$request->show_in_app:0);
        if($imageUrl){
            $cinema->cinema_image = $imageUrl;
        }
        if(isset($request->cinema_status)){
            $cinema->cinema_status = 1;
        }else{
            $cinema->cinema_status = 2;
        }
        $cinema->save();
    }

    public function managecinema(){
        $cinemas = Cinema::with('category')->get();
        $cinemaCategories = CinemaCategory::get();

        return view('backend.cinema.manage_cinema',[
            'cinemas' => $cinemas,
            'cinemaCategories' => $cinemaCategories,
        ]);
    }
    public function addcinema(){
        $cinemaCategories = CinemaCategory::all();
         $types = Type::all();
        $cinemas = Cinema::get();
        return view('backend.cinema.add_cinema',[
            'cinemaCategories' => $cinemaCategories,
            'cinemas' => $cinemas,
            'types'=>$types
        ]);
    }
    public function savecinema(Request $request){
        
        
        $this->cinemaInfoValidate($request);
        $imageUrl = $this->cinemaImageUpload($request);
        $this->cinemaBasicInfoSave($request, $imageUrl);
        return redirect()->route('backend.manage-cinema')->with('success', 'cinema has been added successfully !!');
    }
    public function viewcinema($id){
        $cinema = Cinema::with('category')->find($id);
        return view('backend.cinema.view_cinema',[
            'cinema' => $cinema,
        ]);
    }
    public function editcinema($id){
        $cinema = Cinema::with('category')->find($id);
       $types = Type::all();
        $postId = explode(',',$cinema->related_post);
        
        $relatedPost = [];
        if($cinema->related_post != ''){
            for($i=0; $i < count($postId); $i++){
                $relatedPost[] = Cinema::select('id','cinema_title')->where('id', $postId[$i])->get()->first();
            }
        }
        
        
        $cinemas = Cinema::get();
        $cinemaCategories = CinemaCategory::all();

        return view('backend.cinema.edit_cinema',[
            'cinema' => $cinema,
            'cinemas' => $cinemas, 'types'=>$types,
            'relatedPost' => $relatedPost,
            'cinemaCategories' => $cinemaCategories
        ]);
    }
    public function updatecinema(Request $request){

        $cinema = Cinema::find($request->id);
        if($cinema->cinema_slug == $request->cinema_slug){
            $this->cinemaInfoValidateUpdate($request);
        }else{
            $this->cinemaInfoNewValidateUpdate($request);
        }

        $cinemaImage = $request->file('cinema_image');
        $cinema = Cinema::find($request->id);
        $cinema_image_new=explode('/',$cinema->cinema_image);
        
        if($cinemaImage){
            if (File::exists($cinema->cinema_image)) {
                unlink($cinema->cinema_image);
            }
            if (File::exists('admin/image/cinema/'.$cinema_image_new[4]))
            {
                unlink('admin/image/cinema/'.$cinema_image_new[4]);
            }
            $imageUrl = $this->cinemaImageUpload($request);
            $this->cinemaBasicInfoUpdate($request, $cinema, $imageUrl);
        }else{
            $this->cinemaBasicInfoUpdate($request, $cinema);
        }
        return redirect()->route('backend.manage-cinema')->with('success', 'cinema has been updated successfully !!');
    }
    public function deletecinema($id){
        Cinema::where('id', $id)->delete();
        return redirect()->route('backend.manage-cinema')->with('success', 'cinema has been deleted successfully !!');
    }

    public function unpublishedcinema($id){
        $cinema = Cinema::find($id);
        $cinema->cinema_status = 2;
        $cinema->save();

        return redirect()->route('backend.manage-cinema')->with('success', 'cinema has been successfully unpublished !!');
    }
    public function publishedcinema($id){
        $cinema = Cinema::find($id);
        $cinema->cinema_status = 1;
        $cinema->save();
        return redirect()->route('backend.manage-cinema')->with('success', 'cinema has been successfully published !!');
    }
    
    public function addType(){
         return view('backend.cinema.type.add_type');
    }
    
    public function manageType(){
       $types = Type::get()->toArray();
        return view('backend.cinema.type.manage_type',[
            'types' => $types
        ]);  
    }
    
    public function saveType(Request $request){
        $request->validate([
        'type_name' => 'required'
        ]);
        $ty = new Type();
        $ty->type_name = $request->type_name;
        $ty->save();
        return redirect()->route('backend.manage-type')->with('success', 'Type has been successfully published !!');  
    }
    
    public function editType($id){
          $type = Type::find($id);
        return view('backend.cinema.type.edit_type',[
            'type' => $type,
        ]);
    }
    
    public function updateType(Request $request){
         $request->validate([
        'type_name' => 'required'
        ]);
        $type = Type::find($request->id);
        $type->type_name = $request->type_name;
        $type->save();
        return redirect()->route('backend.manage-type')->with('success', 'Type has been updted successfully!!');   
    }
    
    public function deleteType($id){
        Type::find($id)->delete();
         return redirect()->route('backend.manage-type')->with('success', 'Type has been Delete!!');   
    }

}
