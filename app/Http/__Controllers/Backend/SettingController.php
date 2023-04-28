<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
      public function index()
    {
    $social_link = Setting::where('group_name', 'social_link')->get();
    return view('backend.settings.settings', compact('social_link'));
    }
     protected function social_link_Validate($request)
    {
        $validated = $request->validate([
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'vimeo' => 'required|url',
            'instagram' => 'required|url',
            'linkedin' => 'required|url',
            'youtube' => 'required|url'
        ]);
    }


    public function social_link_update(Request $req)
    {
        $this->social_link_Validate($req);

        $social_link = $req->input();

        if (empty($social_link['social_link_publish'])) {
            $social_link['social_link_publish'] = 'no';
        }

        // echo '<pre>';
        // print_r($social);
        // die();
        foreach ($social_link as $key => $socials) {;

            $builder = Setting::where('group_name', 'social_link')->where('settings_name', $key)->update(['settings_value' => $socials]);
        }

        return redirect()->back()->with('success', 'Successfully Updated');
    }
    
    public function editGeneral()
    {
        $general_settings = DB::table('settings')->where('group_name', 'general_settings')->get()->toArray();
        //dd($general_settings);
        
        return view('backend.settings.general-setting', [
            'general_settings' => $general_settings,
        ]);
    }
    
    protected function fotter_logo_ImageUpload($request)
    {
        $footer_logo = $request->file('footer_logo');
        //dd($footer_logo);
        
        $image = Image::make($footer_logo);
        $fileType = $footer_logo->getClientOriginalExtension();
        $imageName = 'footer_logo_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/general_settings/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }
    
    public function updateGeneral(Request $request)
    {
        //dd($_POST);
        
        $generalsettings = $request->input();
        
        if($request->footer_logo){
            $generalsettings['footer_logo']=$this->fotter_logo_ImageUpload($request);
        }else{
            $generalsettings['footer_logo']=$request->old_footer_logo; 
        }
        
        
        foreach ($generalsettings as $key => $generalsetting){
            $builder = DB::table('settings')
            ->where('group_name', 'general_settings')
            ->where('settings_name', $key)
            ->update(['settings_value' => $generalsetting]);
        }

        return redirect()->back()->with('success', 'Successfully Updated');
    }
    
}