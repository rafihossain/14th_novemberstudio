<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Service;
use Image;
use File;
use DB;

class SectionController extends Controller
{
    /*=============================================================
                    Section Validation
    ===============================================================*/
    protected function bannerInfoValidate($request)
    {
        $request->validate([
            'banner_title' => 'required',
            'banner_content' => 'required',
            'banner_link' => 'required',
            // 'banner_image' => 'required',
        ]);
    }

    public function sectionmessageInfoValidate($request)
    {
        $request->validate([
            'section_name' => 'required',
            'section_description' => 'required',
            'section_link' => 'required',
            // 'banner_image' => 'required',
        ]);
    }

    public function addonInfoValidate($request)
    {
        $request->validate([
            'addon_hedding' => 'required',
            'addon_description' => 'required',
            'addon_link' => 'required',
            // 'banner_image' => 'required',
        ]);
    }

    //About us-------------------------------------------
    protected function about_us_Validate($request)
    {
        $request->validate([
            'about_us_title' => 'required',
            'about_us_sub_title' => 'required',
            //'about_us_image' => 'required|dimensions:width=1200,height=800',
            'trusted' => 'required'
        ]);
    }
    //Skilll----------------------------------------
    protected function skill_Validate($request)
    {
        $request->validate([
            'student' => 'required',
            'global_office' => 'required',
            'visa' => 'required',
            'scholarship' => 'required'
        ]);
    }
    //Faq
    protected function faqInfoValidate($request)
    {
        $request->validate([
            'faq_title' => 'required',
            'number_of_faq' => 'required'
        ]);
    }
    //Faq
    protected function cinemaInfoValidate($request)
    {
        $request->validate([
            'cinema_title' => 'required',
            'number_of_cinema' => 'required'
        ]);
    }

    //Faq
    protected function packageInfoValidate($request)
    {
        $request->validate([
            'single_day_packages' => 'required',
            'multi_day_packages' => 'required'
        ]);
    }

    //Testimonial
    protected function home_testimonial_Validate($request)
    {
        $request->validate([
            'testimonial_title' => 'required',
            'testimonial_sub_title' => 'required',
            'testimonial_no' => 'required'
        ]);
    }
    
    //Our team
    protected function about_our_team_validate($request)
    {
        $request->validate([
            'team_title' => 'required',
            'team_description' => 'required',
        ]);
    }
    //Equipment
    protected function about_equipment_validate($request)
    {
        $request->validate([
            'equipment_title' => 'required',
            'equipment_description' => 'required',
        ]);
    }
    //Workwith
    protected function about_workwith_validate($request)
    {
        $request->validate([
            'workwith_title' => 'required',
            'workwith_description' => 'required',
        ]);
    }

    /*=============================================================
                    Section Image Upload
    ===============================================================*/

    //About image
    protected function home_about_image($request)
    {
        $about_us_image = $request->file('about_us_image');

        $image = Image::make($about_us_image);
        $fileType = $about_us_image->getClientOriginalExtension();
        $imageName = 'about_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/home_about/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnail = $directory . "thumbnail/" . $imageName;
        $image->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnail);

        return $imageName;
    }
    //Banner multiple image
    protected function bannerImageUpload($request)
    {
        $bannerImages = $request->file('banner_image');

        if ($request->hasFile('banner_image')) {
            // echo 11; die();

            $fileName = [];
            foreach ($bannerImages as $image) {
                $fileType = $image->getClientOriginalExtension();
                $imageName = 'banner_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
                $directory = 'admin/image/section/banner/';
                $imageUrl = $directory . $imageName;
                $image->move($directory, $imageName);
                $fileName[] = $imageUrl;
            }

            return $fileName;
        }
    }
    protected function bannerImage_update_Upload($request)
    {
        $bannerImages = $request->file('banner_image');


        if ($request->hasFile('banner_image')) {

            $fileName = [];
            foreach ($bannerImages as $key => $image) {
                $fileType = $image->getClientOriginalExtension();
                $imageName = 'banner_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
                $directory = 'admin/image/section/banner/';
                $imageUrl = $directory . $imageName;
                $image->move($directory, $imageName);
                $fileName[$key] = $imageUrl;
            }

            return $fileName;
        }
    }
    //Faq image
    protected function faqImageUpload($request)
    {
        $faqImage = $request->file('faq_image');

        $image = Image::make($faqImage);
        $fileType = $faqImage->getClientOriginalExtension();
        $imageName = 'faq_image_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/faq-image/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnail = $directory . "thumbnail/" . $imageName;
        $image->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnail);

        return $imageName;
    }

    protected function ourteam_image($request)
    {
        $team_photo = $request->file('team_photo');

        $image = Image::make($team_photo);
        $fileType = $team_photo->getClientOriginalExtension();
        $imageName = 'team_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/team/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        // $thumbnail = $directory . "thumbnail/" . $imageName;
        // $image->resize(null, 200, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        // $image->save($thumbnail);

        return $imageName;
    }
    protected function equipment_image($request)
    {
        $equipment_photo = $request->file('equipment_photo');

        $image = Image::make($equipment_photo);
        $fileType = $equipment_photo->getClientOriginalExtension();
        $imageName = 'equipment_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/equipment/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }
    protected function workwith_image($request)
    {
        $workwith_photo = $request->file('workwith_photo');

        $image = Image::make($workwith_photo);
        $fileType = $workwith_photo->getClientOriginalExtension();
        $imageName = 'workwith_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/workwith/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }
    protected function contact_image($request)
    {
        $contactus_photo = $request->file('contactus_photo');

        $image = Image::make($contactus_photo);
        $fileType = $contactus_photo->getClientOriginalExtension();
        $imageName = 'contactus_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/contactus/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        return $imageName;
    }
    protected function about_vision_image($request)
    {
        $vision_image = $request->file('vision_image');

        $image = Image::make($vision_image);
        $fileType = $vision_image->getClientOriginalExtension();
        $imageName = 'vision_image_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'admin/image/section/vision_image/';
        $imageUrl = $directory . $imageName;
        $image->save($imageUrl);

        $thumbnail = $directory . "thumbnail/" . $imageName;
        $image->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($thumbnail);

        return $imageName;
    }

    /*=============================================================
                    Section Basic Info Save
    ===============================================================*/

    //Banner info
    protected function bannerBasicInfoSave($request)
    {
        $section = new Section;
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;

        $banner_content = $request->banner_content;
        $banner_link = $request->banner_link;

        $banner_data = [];
        foreach ($request->banner_title as $key => $banners_titles) {
            $banner_data[$key]['banner_title'] = $banners_titles;
            $banner_data[$key]['banner_content'] = $banner_content[$key];
            $banner_data[$key]['banner_link'] = $banner_link[$key];
        }
        $section->section_value = json_encode($banner_data);
        $section->save();
    }

    protected function sectionmessageInfoSave($request)
    {

        $data['section_message_name'] = $request->section_message_name;
        $data['section_description'] = $request->section_description;
        $data['section_link'] = $request->section_link;

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }
    protected function addonInfoSave($request)
    {

        $data['addon_hedding'] = $request->addon_hedding;
        $data['addon_description'] = $request->addon_description;
        $data['addon_link'] = $request->addon_link;

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }


    //Faq info
    protected function sectionFaqBasicInfoSave($request)
    {
        $section = new Section;
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $sectionvalue = [
            'faq_title' => $request->faq_title,
            'number_of_faq' => $request->number_of_faq,
        ];
        $section->section_value = json_encode($sectionvalue);
        $section->save();
    }

    protected function sectionCinemaBasicInfoSave($request)
    {
        $section = new Section;
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $sectionvalue = [
            'cinema_title' => $request->cinema_title,
            'number_of_cinema' => $request->number_of_cinema,
        ];
        $section->section_value = json_encode($sectionvalue);
        $section->save();
    }

    protected function sectionpackageBasicInfoSave($request)
    {
        
        $section = new Section;
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $sectionvalue = [
            'single_day_packages' => $request->single_day_packages,
            'multi_day_packages' => $request->multi_day_packages,
        ];
        // dd($sectionvalue);
        // dd(json_encode($sectionvalue));
        $section->section_value = json_encode($sectionvalue);
        $section->save();
    }

    //About us info
    protected function sectionAboutUsBasicInfoSave($request)
    {
        $data['title'] = $request->about_us_title;
        $data['sub_title'] = $request->about_us_sub_title;
        $data['trusted'] = $request->trusted;
        $data['description'] = $request->about_description;
        $data['about_image'] = $this->home_about_image($request);

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    //Testimonial info
    protected function sectionTestimonialBasicInfoSave($request)
    {
        $data['testimonial_title'] = $request->testimonial_title;
        $data['testimonial_sub_title'] = $request->testimonial_sub_title;
        $data['testimonial_no'] = $request->testimonial_no;

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }
    
    
    //Our team
    protected function sectionOurTeamBasicInfoSave($request, $image_url = null)
    {
        $data['team_title'] = $request->team_title;
        $data['team_description'] = $request->team_description;

        if ($image_url) {
            $data['team_image'] = $image_url;
        } else {
            $data['team_video_url'] = $request->team_video;
        }

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }
    //Equipment
    protected function sectionEquipmentBasicInfoSave($request, $image_url = null)
    {
        $data['equipment_title'] = $request->equipment_title;
        $data['equipment_description'] = $request->equipment_description;

        if ($image_url) {
            $data['equipment_photo'] = $image_url;
        } else {
            $data['equipment_video'] = $request->equipment_video;
        }

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }
    //Workwith
    protected function sectionWorkwithBasicInfoSave($request, $image_url = null)
    {
        $data['workwith_title'] = $request->workwith_title;
        $data['workwith_description'] = $request->workwith_description;

        if ($image_url) {
            $data['workwith_photo'] = $image_url;
        } else {
            $data['workwith_video'] = $request->workwith_video;
        }

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }
    //ContactUs
    protected function sectionContactUsBasicInfoSave($request, $image_url = null)
    {
        // $data['workwith_title'] = $request->workwith_title;
        // $data['workwith_description'] = $request->workwith_description;

        if ($image_url) {
            $data['contactus_photo'] = $image_url;
        } else {
            $data['contactus_video'] = $request->contactus_video;
        }

        $section = new Section();
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    /*=============================================================
                    Start Main Code
    ===============================================================*/
    public function manageSection()
    {
        $section = Section::get()->toArray();
        return view('backend.section.manage_section', compact('section'));
    }
    public function addSection()
    {
        return view('backend.section.add_section');
    }
    public function saveSection(Request $request)
    {
        $input = $request->all();


        if ($input['section_type'] == 'banner') {
            $this->bannerInfoValidate($request);
            $this->bannerBasicInfoSave($request);
        } else if ($input['section_type'] == 'section_message') {
            $this->sectionmessageInfoValidate($request);
            $this->sectionmessageInfoSave($request);
        } else if ($input['section_type'] == 'addon') {
            $this->addonInfoValidate($request);
            $this->addonInfoSave($request);
        } else if ($input['section_type'] == 'faq') {
            $this->faqInfoValidate($request);
            $this->sectionFaqBasicInfoSave($request);
        } else if ($input['section_type'] == 'cinema') {
            $this->cinemaInfoValidate($request);
            $this->sectionCinemaBasicInfoSave($request);
        } else if ($input['section_type'] == 'package') {
            $this->packageInfoValidate($request);
            $this->sectionpackageBasicInfoSave($request);
        } else if ($input['section_type'] == 'home_aboutus') {
            $this->about_us_Validate($request);
            $this->sectionAboutUsBasicInfoSave($request);
        } else if ($input['section_type'] == 'skills') {
            $this->skill_Validate($request);
            $this->sectionSkillsBasicInfoSave($request);
        } else if ($input['section_type'] == 'home_testimonial') {
            $this->home_testimonial_Validate($request);
            $this->sectionTestimonialBasicInfoSave($request);
        } else if ($input['section_type'] == 'home_service') {
            $this->home_service_Validate($request);
            $this->sectionHomeServiceBasicInfoSave($request);
        } else if ($input['section_type'] == 'home_blog') {
            $this->home_blog_Validate($request);
            $this->sectionHomeBlogBasicInfoSave($request);
        } else if ($input['section_type'] == 'home_partner') {
            $this->home_partner_Validate($request);
            $this->sectionHomePartnerBasicInfoSave($request);
        } else if ($input['section_type'] == 'home_current_scholarship') {
            $this->home_current_scholarship_Validate($request);
            $this->sectionHomeCurrentScholarshipBasicInfoSave($request);
        } else if ($input['section_type'] == 'about_the_company') {
            $this->about_the_company_Validate($request);
            $this->sectionAboutTheCompanyBasicInfoSave($request);
        } else if ($input['section_type'] == 'about_director_message') {
            $this->about_director_message_Validate($request);
            $this->sectionDirectorMessageBasicInfoSave($request);
        } else if ($input['section_type'] == 'about_our_team') {
            $this->about_our_team_validate($request);

            if ($request->file('team_photo')) {
                $image_url = $this->ourteam_image($request);
                $this->sectionOurTeamBasicInfoSave($request, $image_url);
            } else {
                $this->sectionOurTeamBasicInfoSave($request);
            }
        } else if ($input['section_type'] == 'about_equipment') {
            $this->about_equipment_validate($request);

            if ($request->file('equipment_photo')) {
                $image_url = $this->equipment_image($request);
                $this->sectionEquipmentBasicInfoSave($request, $image_url);
            } else {
                $this->sectionEquipmentBasicInfoSave($request);
            }
        } else if ($input['section_type'] == 'about_workwith') {
            $this->about_workwith_validate($request);

            if ($request->file('workwith_photo')) {
                $image_url = $this->workwith_image($request);
                $this->sectionWorkwithBasicInfoSave($request, $image_url);
            } else {
                $this->sectionWorkwithBasicInfoSave($request);
            }
        } else if ($input['section_type'] == 'contact_us') {
            if ($request->file('contactus_photo')) {
                $image_url = $this->contact_image($request);
                $this->sectionContactUsBasicInfoSave($request, $image_url);
            } else {
                $this->sectionContactUsBasicInfoSave($request);
            }
        } else if ($input['section_type'] == 'carrer_section') {
            $request->validate([
                'carrer_description' => 'required',
            ]);

            $section = new Section;
            $section->section_name = $request->section_name;
            $section->section_type = $request->section_type;
            $section->section_value = $request->carrer_description;
            $section->save();
        } else if ($input['section_type'] == 'franchise_section') {
            $request->validate([
                'franchise_description' => 'required',
            ]);

            $section = new Section;
            $section->section_name = $request->section_name;
            $section->section_type = $request->section_type;
            $section->section_value = $request->franchise_description;
            $section->save();
        } else if ($input['section_type'] == 'scholarship_section') {
            $request->validate([
                'scholarship_description' => 'required',
            ]);

            $section = new Section;
            $section->section_name = $request->section_name;
            $section->section_type = $request->section_type;
            $section->section_value = $request->scholarship_description;
            $section->save();
        }

        return redirect()->route('backend.manage-section')->with('success', 'Section has been added successfully !!');
    }


    /*================================================================
                            Edit Section Start 
    ================================================================*/

    public function editSection($id)
    {
        $one_section = Section::find($id)->toArray();
        // echo '<pre>';
        // print_r($one_section);
        // die();
        return view('backend.section.edit_section', compact('one_section'));
    }
    //home about us Info--------------------
    protected function home_about_us_update($request, $imageUrl)
    {

        $banner_section = Section::find($request->section_id);
        $banner_section->section_name = $request->section_name;
        $banner_section->section_type = $request->section_type;

        $data['title'] = $request->about_us_title;
        $data['sub_title'] = $request->about_us_sub_title;
        $data['trusted'] = $request->trusted;
        $data['description'] = $request->about_description;
        $data['about_image'] = $imageUrl;

        $banner_section->section_value = json_encode($data);


        $banner_section->save();
    }

    //Skills info
    protected function sectionSkillsBasicInfoUpdate($request)
    {

        $data['student'] = $request->student;
        $data['global_office'] = $request->global_office;
        $data['visa'] = $request->visa;
        $data['scholarship'] = $request->scholarship;

        $section = Section::find($request->section_id);
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    //Testimonial info update--------------
    protected function sectionTestimonialBasicInfoUpdate($request)
    {
        $data['testimonial_title'] = $request->testimonial_title;
        $data['testimonial_sub_title'] = $request->testimonial_sub_title;
        $data['testimonial_no'] = $request->testimonial_no;

        $section = Section::find($request->section_id);
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    //Faq info update------------------
    protected function sectionFaqBasicInfoUpdate($request)
    {
        $section = Section::find($request->section_id);
        
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $sectionvalue = [
            'faq_title' => $request->faq_title,
            'number_of_faq' => $request->number_of_faq,
        ];
        $section->section_value = json_encode($sectionvalue);
        $section->save();
    }

    //Our team Update---------------
    protected function sectionOurTeamBasicInfoUpdate($request, $image_url = null)
    {
        $section = Section::find($request->section_id);
        $oldInfo = json_decode($section->section_value);
      
        $data['team_title'] = $request->team_title;
        $data['team_description'] = $request->team_description;

        if ($image_url) {
            $data['team_image'] = $image_url;
        }
        if($request->team_video){
            $data['team_video_url'] = $request->team_video;
        }
      
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    protected function sectionEquipmentBasicInfoUpdate($request, $image_url=null)
    {
        $section = Section::find($request->section_id);

        $data['equipment_title'] = $request->equipment_title;
        $data['equipment_description'] = $request->equipment_description;

        if ($image_url) {
            $data['equipment_photo'] = $image_url;
        }
        if($request->equipment_video){
            $data['equipment_video'] = $request->equipment_video;
        }

        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    //Workwith
    protected function sectionWorkwithBasicInfoUpdate($request, $image_url = null)
    {
        $section = Section::find($request->section_id);
        $oldInfo = json_decode($section->section_value);
        $data['workwith_title'] = $request->workwith_title;
        $data['workwith_description'] = $request->workwith_description;

        if ($image_url) {
        $data['workwith_photo'] = $image_url;
         } else {
            if (isset($oldInfo->team_image)) {
                $data['team_image'] = $oldInfo->team_image;
             }
        }
        
        if($request->workwith_video){
            $data['workwith_video'] = $request->workwith_video;
        }else{
            if (isset($oldInfo->workwith_video)) {
                $data['workwith_video'] = $oldInfo->workwith_video;
            }  
        }
        
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }

    //ContactUs
    protected function sectionContactUsBasicInfoUpdate($request, $image_url = null)
    {
        $section = Section::find($request->section_id);

        if ($image_url) {
            $data['contactus_photo'] = $image_url;
        }
        if($request->contactus_video){
            $data['contactus_video'] = $request->contactus_video;
        }

        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $section->section_value = json_encode($data);
        $section->save();
    }
    //Package
    protected function sectionPackageBasicInfoUpdate($request)
    {
        $section = Section::find($request->section_id);
        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $sectionvalue = [
            'single_day_packages' => $request->single_day_packages,
            'multi_day_packages' => $request->multi_day_packages,
        ];
        $section->section_value = json_encode($sectionvalue);
        $section->save();
    }

    protected function sectionCinemaBasicInfoUpdate($request)
    {
        $section = Section::find($request->section_id);

        $section->section_name = $request->section_name;
        $section->section_type = $request->section_type;
        $sectionvalue = [
            'cinema_title' => $request->cinema_title,
            'number_of_cinema' => $request->number_of_cinema,
        ];
        $section->section_value = json_encode($sectionvalue);
        $section->save();
    }

    public function updateSection(Request $req)
    {
        $input = $req->all();
        if ($input['section_type'] == 'banner') {

            // $req->validate([
            //     'banner_title' => 'required',
            //     'banner_content' => 'required',
            //     'banner_link' => 'required',
            // ]);
            $banner_content = $req->banner_content;
            $banner_link = $req->banner_link;

            $banner_data = [];
            foreach ($req->banner_title as $key => $banners_titles) {
                $banner_data[$key]['banner_title'] = $banners_titles;
                $banner_data[$key]['banner_content'] = $banner_content[$key];
                $banner_data[$key]['banner_link'] = $banner_link[$key];
            }

            $section = Section::find($req->section_id);
            $section->section_name = $req->section_name;
            $section->section_type = $req->section_type;
            $section->section_value = json_encode($banner_data);
            $section->save();
        } else if ($input['section_type'] == 'addon') {
            $data['addon_hedding'] = $req->addon_hedding;
            $data['addon_description'] = $req->addon_description;
            $data['addon_link'] = $req->addon_link;

            $section = Section::find($req->section_id);
            $section->section_name = $req->section_name;
            $section->section_type = $req->section_type;
            $section->section_value = json_encode($data);
            $section->save();
        } else if ($input['section_type'] == 'section_message') {
            $data['section_message_name'] = $req->section_message_name;
            $data['section_description'] = $req->section_description;
            $data['section_link'] = $req->section_link;

            $section = Section::find($req->section_id);
            $section->section_name = $req->section_name;
            $section->section_type = $req->section_type;
            $section->section_value = json_encode($data);
            $section->save();
        } else if ($input['section_type'] == 'home_aboutus') {


            if ($req->about_us_image) {

                $this->about_us_Validate($req);

                if (File::exists('admin/image/section/home_about/' . $req->old_about_image)) {
                    unlink('admin/image/section/home_about/' . $req->old_about_image);
                }
                if (File::exists('admin/image/section/home_about/thumbnail/' . $req->old_about_image)) {
                    unlink('admin/image/section/home_about/thumbnail/' . $req->old_about_image);
                }

                $imageUrl = $this->home_about_image($req);
                $this->home_about_us_update($req, $imageUrl);
            } else {

                $req->validate([
                    'about_us_title' => 'required',
                    'about_us_sub_title' => 'required',
                    'trusted' => 'required'
                ]);

                $imageUrl = $req->old_about_image;

                $this->home_about_us_update($req, $imageUrl);
            }
        } else if ($input['section_type'] == 'skills') {
            $this->skill_Validate($req);
            $this->sectionSkillsBasicInfoUpdate($req);
        } else if ($input['section_type'] == 'faq') {
            $this->faqInfoValidate($req);
            $this->sectionFaqBasicInfoUpdate($req);
        } else if ($input['section_type'] == 'cinema') {
            $this->cinemaInfoValidate($req);
            $this->sectionCinemaBasicInfoUpdate($req);
        } else if ($input['section_type'] == 'home_testimonial') {
            $this->home_testimonial_Validate($req);
            $this->sectionTestimonialBasicInfoUpdate($req);
        } else if ($input['section_type'] == 'about_our_team') {
            $this->about_our_team_validate($req);

            if ($req->file('team_photo')) {
                $image_url = $this->ourteam_image($req);
                $this->sectionOurTeamBasicInfoUpdate($req, $image_url);
            } else {
                $this->sectionOurTeamBasicInfoUpdate($req);
            }
        } else if ($input['section_type'] == 'carrer_section') {
            $req->validate([
                'carrer_description' => 'required',
            ]);

            $section = Section::find($req->section_id);
            $section->section_name = $req->section_name;
            $section->section_type = $req->section_type;
            $section->section_value = $req->carrer_description;
            $section->save();
        } else if ($input['section_type'] == 'franchise_section') {
            $req->validate([
                'franchise_description' => 'required',
            ]);

            $section = Section::find($req->section_id);
            $section->section_name = $req->section_name;
            $section->section_type = $req->section_type;
            $section->section_value = $req->franchise_description;
            $section->save();
        } else if ($input['section_type'] == 'scholarship_section') {
            $req->validate([
                'scholarship_description' => 'required',
            ]);

            $section = Section::find($req->section_id);;
            $section->section_name = $req->section_name;
            $section->section_type = $req->section_type;
            $section->section_value = $req->scholarship_description;
            $section->save();
        } else if ($input['section_type'] == 'about_equipment') {
            $this->about_equipment_validate($req);
            if ($req->file('equipment_photo')) {
                $image_url = $this->equipment_image($req);
                $this->sectionEquipmentBasicInfoUpdate($req, $image_url);
            } else {
                $this->sectionEquipmentBasicInfoUpdate($req);
            }
        } else if ($input['section_type'] == 'about_workwith') {
            $this->about_workwith_validate($req);
            if ($req->file('workwith_photo')) {
                $image_url = $this->workwith_image($req);
                $this->sectionWorkwithBasicInfoUpdate($req, $image_url);
            } else {
                $this->sectionWorkwithBasicInfoUpdate($req);
            }
        } else if ($input['section_type'] == 'contact_us') {
            if ($req->file('contactus_photo')) {
                $image_url = $this->contact_image($req);
                $this->sectionContactUsBasicInfoUpdate($req, $image_url);
            } else {
                $this->sectionContactUsBasicInfoUpdate($req);
            }
        } else if ($input['section_type'] == 'package') {
            $this->sectionPackageBasicInfoUpdate($req);
        }

        return redirect()->route('backend.manage-section')->with('success', 'Section has been update successfully !!');
    }

    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();
        return redirect()->route('backend.manage-section')->with('success', 'Section has been delete successfully !!');
    }
}
