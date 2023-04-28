<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Image;
use File;
use Illuminate\Support\Str;
use App\Models\PackageCategory;
//package
class PackageController extends Controller
{
    //package categorypackage
    public function packageList(){
        $packages = Package::with('package_category')->get();
        return view('backend.package.manage_package', [
            'packages' => $packages
        ]);
    }
    
    public function packageAdd(){
        $package_categories = PackageCategory::get();

        return view('backend.package.add_package', [
            'package_categories' => $package_categories
        ]);
    }

    protected function packageInfoValidate($request){
        $request->validate([
            'package_category_id' => 'required',
            'package_name' => 'required',
            'package_description' => 'required',
            'package_image'=> 'required',
        ]);
    }

    // protected function categoryInfoValidateUpdate($request){
    //     $request->validate([
    //         'meta_title' => 'required',
    //         'meta_keywords' => 'required',
    //         'meta_description' => 'required',
    //         'category_name' => 'required',
    //         'category_slug' => 'required|regex:/^[a-z-0-9S*]+$/',
    //     ]);
    // }

    // protected function categoryNewInfoValidateUpdate($request){
    //     $request->validate([
    //         'meta_title' => 'required',
    //         'meta_keywords' => 'required',
    //         'meta_description' => 'required',
    //         'category_name' => 'required',
    //         'category_slug' => 'required|unique:package_categories,category_slug|regex:/^[a-z-0-9S*]+$/',
    //     ]);
    // }

    public function packageSave(Request $request){
        $this->packageInfoValidate($request);
        $imageUrl = $this->packageImageUpload($request);
        $packageCategory = new Package;
        $packageCategory->package_name = $request->package_name;
        $packageCategory->package_description = $request->package_description;
        $packageCategory->package_category_id = $request->package_category_id;
        $packageCategory->image = $imageUrl;
        $packageCategory->save();
        return redirect()->route('backend.package-list')->with('success', 'Category has been added successfully !!');
     }
     
    protected function packageImageUpload($request){
         $cinemaImage = $request->file('package_image');

        $image = Image::make($cinemaImage);
        $fileType = $cinemaImage->getClientOriginalExtension();
        $imageName = 'package_'.time().'_'.rand(10000, 999999).'.'.$fileType;
        $directory = 'admin/image/package';
        $imageUrl = $directory.$imageName;
        $image->save($imageUrl);
        
        $thumbnail = $directory."/".$imageName;
        // $image->resize(null, 200, function($constraint) {
        //     $constraint->aspectRatio();
        // });
        $image->resize(370,250);
        $image->save($thumbnail);

        return $thumbnail; 
    }
     
     
     
    public function packageEdit($id){
        $editPackage = Package::find($id);
        $package_categories = PackageCategory::get();
        return view('backend.package.edit_package',[
            'editpackage' => $editPackage,
            'package_categories' => $package_categories
        ]);
    }
    public function packageUpdate(Request $request){
    $package = Package::find($request->id);

    
    if(isset($request->package_image)){
       $imageUrl = $this->packageImageUpload($request);  

        $package->image = $imageUrl;
    }
 
   // $packageCategory = Package::find($request->id);
    $package->package_name = $request->package_name;
    $package->package_category_id = $request->package_category_id;
    $package->package_description = $request->package_description;
    $package->save();
 return redirect()->route('backend.package-list')->with('success', 'Category has been update successfully !!');
    }
    public function packageDelete($id){
        Package::where('id', $id)->delete();
        return redirect()->route('backend.package-list')->with('success', 'Category has been deleted successfully !!');
    }



    // public function unpublishedpackage($id){
    //     $package = package::find($id);
    //     $package->package_status = 2;
    //     $package->save();

    //     return redirect()->route('backend.manage-package')->with('success', 'package has been successfully unpublished !!');
    // }
    // public function publishedpackage($id){
    //     $package = package::find($id);
    //     $package->package_status = 1;
    //     $package->save();

    //     return redirect()->route('backend.manage-package')->with('success', 'package has been successfully published !!');
    // }

}
