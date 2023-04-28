<?php

namespace App\Traits;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Service;
use App\Models\Section;
use Illuminate\Support\Str;
use App\Models\Testimonial;
use App\Models\UserContact;
use App\Models\ContactModel;
use App\Models\ServiceCategory;
use App\Models\Faq;
use App\Models\PageModel;
use App\Models\Package;
use App\Models\ContactInformation;
use App\Models\CinemaCategory;

trait PageComponentTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function PageComponentSection($pageModel) {
        $bannerlist = [];
        $section_message = [];
        $faqs = '';
        $faq = '';
        $sectionType = '';
        $addon ='';
        $cinemas = [];
        $pageSections = $pageModel->page_section;
        $faqs= [];
        $sectionType = [];
        $packages = [];
        $packagelist = '';
        $testimonials = '';
        $ourteam = '';
        $equipment = '';
        $workwith = '';
        $contactus = '';
        
        foreach($pageSections as $pageSection){
            $section = Section::where('section_name', $pageSection->section)->get()->first();
            
                if(isset($section)){
                    $sectionType[] = $section->section_type;
                if($section->section_type == 'banner'){
                    $bannerlist = json_decode($section->section_value);
                }else if($section->section_type == 'section_message'){
                    $section_message[] = json_decode($section->section_value);
                }else if($section->section_type == 'addon'){
                    $addon = json_decode($section->section_value);
                }else if($section->section_type == 'faq'){
                    $faq = json_decode($section->section_value);
                    $count = $faq->number_of_faq;
                    $faqs = Faq::take($count)->get();
                }else if($section->section_type == 'cinema'){
                    $cinema = json_decode($section->section_value);
                    $count = $cinema->number_of_cinema;
                    $cinemas= CinemaCategory::limit($count)->orderBy('id','ASC')->get();
                }else if($section->section_type == 'package'){
                    $packagelist = json_decode($section->section_value);
                    // dd($packagelist);
                    $packages= Package::limit(3)->orderBy('id','DESC')->get();
                }else if($section->section_type == 'home_testimonial'){
                    $testimonial = json_decode($section->section_value);
                    $count = $testimonial->testimonial_no;
                    $testimonials= Testimonial::limit($count)->orderBy('id','DESC')->get();
                }else if($section->section_type == 'about_our_team'){
                    $ourteam = json_decode($section->section_value);
                }else if($section->section_type == 'about_equipment'){
                    $equipment = json_decode($section->section_value);
                }else if($section->section_type == 'about_workwith'){
                    $workwith = json_decode($section->section_value);
                }else if($section->section_type == 'contact_us'){
                    $contactus = json_decode($section->section_value);
                }
            }

        }
        return [
            'section_message' => $section_message,
            'bannerlist' => $bannerlist,
            'addon'   =>$addon,
            'faqs'=>$faqs,
            'cinemas'=>$cinemas,
            'packages'=>$packages,
            'packagelist'=>$packagelist,
            'testimonials'=>$testimonials,
            'ourteam'=>$ourteam,
            'equipment'=>$equipment,
            'workwith'=>$workwith,
            'contactus'=>$contactus,
        ];



    }

}