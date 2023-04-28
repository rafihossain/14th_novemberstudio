<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PageModel;
use App\Models\PageSectionModel;
use App\Models\Service;
use App\Models\Section;
use App\Traits\PageComponentTrait;
use App\Models\Cinema;
use App\Models\Package;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\ContactInformation;
use App\Models\CinemaCategory;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use App\Models\PageImage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContractMail;

class FrontendController extends Controller
{
      use PageComponentTrait;
    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function newest(){
      return view('welcome');
    }
      public function meta($data)
      {
        return PageModel::where('page_type', $data)->first(); 
      
      }
    public function index()
    {
        $pageModel = PageModel::with('page_section')->where('page_type', 'home')->first();
        $page = $this->PageComponentSection($pageModel);
        $page['body_class'] = 'body_class';
        $page['header_class']='home';
        $page['meta']=$this->meta('home');
  // dd($page['meta']);
        $page['social_link']=Setting::where('group_name', 'social_link')->get();
     
        return view('frontend.index', $page);
       // return view('frontend.index', compact('body_class'));
    }

    public function saveContactInfo(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_location' => 'required',
        ]);
        
        $contactinfo =  new ContactInformation();
        $contactinfo->name = $request->name;
        $contactinfo->email =$request->email;
        $contactinfo->phone = $request->phone;
        $contactinfo->date_location = $request->date_location;

        if($request->choose_type == 3){
            $contactinfo->choose_type_other = $request->choose_type_other;
        }
        if($request->choose_package == 1){
            $contactinfo->single_day_packages = $request->single_day_packages;
        }
        if($request->choose_package == 2){
            $contactinfo->multi_day_packages = $request->multi_day_packages;
        }

        $contactinfo->how_did_you_hear = $request->how_did_you_hear;
        $contactinfo->message_description =$request->message_description;
        $contactinfo->save();
        
        
        $generalSetting = Setting::where('group_name', 'general_settings')->get();
        $mail = $generalSetting[2]->settings_value;
        
        // Mail::to('afiqur.rssoftware@gmail.com')->send(new ContractMail());
        // dd("Email is Sent.");
        
        return redirect('/')->with('success', 'contact  Saved');
    }
    
    
    /**
     * About Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
       // $pageModel = PageModel::with('page_section')->where('page_type', 'about_the_company')->first();
       // $page = $this->PageComponentSection($pageModel);
     
       $pageModel = PageModel::with('page_section')->where('page_type', 'about_the_company')->first();
        $page = $this->PageComponentSection($pageModel);
        //$page['cinemas'] = CinemaCategory::limit(3)->get();
        //$page['packages']  = Package::limit(3)->get();
        $page['body_class'] = 'body_class';
        $page['header_class']='about';
        $page['social_link']=Setting::where('group_name', 'social_link')->get();
        $page['about_image']= PageImage::where('page_id', 2)->first();
        $page['meta']=$this->meta('about_the_company'); 
      	
      	//dd($page);
        
      	return view('frontend.about', $page);
    }

    public function package(Request $request)
    {
         
        $pageModel = PageModel::with('page_section')->where('page_type', 'package')->first();
        $page = $this->PageComponentSection($pageModel);
        $page['body_class'] = 'body_class';
        $page['header_class']='package';
        $page['packages']= Package::all();
        
        $page['isactive'] = $request->id;
        $page['package_categories'] = PackageCategory::get();
        $page['meta']=$this->meta('package');
        $page['social_link']=Setting::where('group_name', 'social_link')->get();
        $page['package_image']= PageImage::where('page_id', 5)->first();
        
        return view('frontend.package', $page);
    }
    
    public function cinema(Request $request)
    {
       
        $pageModel = PageModel::with('page_section')->where('page_type', 'cinema')->first();
        $page = $this->PageComponentSection($pageModel);
        $page['categorys'] = CinemaCategory::select('id','category_name','category_slug')->get()->toArray();    
        $page['social_link']=Setting::where('group_name', 'social_link')->get();
        $page['body_class'] = 'body_class';
        $page['header_class']='cinema';
        $page['isactive'] = $request->id;
        $page['portfolio_image']= PageImage::where('page_id', 4)->first();
         $page['meta']=$this->meta('cinema'); 
        return view('frontend.cinema', $page);
    }
    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        $body_class = '';

        return view('frontend.privacy', compact('body_class'));
    }
    
    public function contatus()
    {
      
       $pageModel = PageModel::with('page_section')->where('page_type', 'contact')->first();
        $page = $this->PageComponentSection($pageModel);
        $page['body_class'] = 'body_class';
        $page['header_class']='contact';
        $page['social_link']=Setting::where('group_name', 'social_link')->get();
        $page['meta']=$this->meta('contact'); 
        $page['general_setting'] = Setting::where('group_name', 'general_settings')->get();
        $page['contactus_image']= PageImage::where('page_id', 7)->first();
        
        //dd($page['general_setting']);
        
        return view('frontend.contact', $page);
    }

    public function faq()
    {
       
        $pageModel = PageModel::with('page_section')->where('page_type', 'faq')->first();
        $page = $this->PageComponentSection($pageModel);
  
        $page['body_class'] = 'body_class';
        $page['header_class']='faq';
        $page['social_link']=Setting::where('group_name', 'social_link')->get();
        $page['faq_image']= PageImage::where('page_id', 6)->first();
        $page['meta']=$this->meta('faq'); 
        return view('frontend.faq', $page);
    }

   public function getAllInstrafeed(){
    $access_token = 'IGQVJXZAURHMlc5X3ZAtZAGM4T3ZAZAcC1uS0VwMHhoUGFRZAXRLT0QtVHp0WVlPeHVFNGwzeGRacTA5ZAkY5ZAUI5ZAGpBLUYycWlaTFczWXVnZA1ZA2aGdrX0NWZADhlLTEwN2FUUDBrNzg5TTZAWbFVjSk80TXpKcQZDZD';
    $client = new Client([
    'base_uri' => 'https://graph.instagram.com/',
    ]);
    $response = $client->request('GET', 'me/media', [
    'query' => [
        'fields' => 'id,caption,media_type,media_url,thumbnail_url',
        'access_token' => $access_token,
    ]
    ]);
    $instraFeed = json_decode($response->getBody(), true);    
    return $instraFeed['data'];
    }

    public function getcinema(Request $request){
        $newdata = 0;
        if($request->pageno > 1){
           $newdata = (10 * ($request->pageno - 1));
        }
        $instraffed = [];
        if($request->type == 1 && $request->pageno == 1){
            $instraffed = $this->getAllInstrafeed();
        }
        // echo count($instraffed);die();


        $totalnumber = Cinema::where('cinema_category_id',$request->type)->count();
        if(count($instraffed) > 0){
            $totalnumber = $totalnumber +  count($instraffed);  
        }

        $totalnumber = ceil($totalnumber / 15);
          $pages = [];
          for($i = 0; $i< $totalnumber; $i++){
           $pages[] = $i+1;  
          }
  
        $cenemas = Cinema::where('cinema_category_id',$request->type)->with('category')->offset($newdata)->take(15)->get()->toArray();
        if(count($instraffed) > 0){
            $cenemas  =  array_merge($instraffed,$cenemas);
        }

        $html = '';
        if(count($cenemas) > 0){
            foreach($cenemas as $cenema){
            if(isset($cenema['media_type']) && $cenema['media_type'] == 'IMAGE'){
                $html .= '  <div class="col-md-4"> <div class="cinema_item"> <div class="cinema_item_content"> <a href="javascript:void(0)" class="cinema_item_title">'.$cenema['caption'].'</a> </div> <div class="cinema_item_image"> <a href="javascript:void(0)"> <img src="'.$cenema['media_url'].'" class="img-fluid" alt="cattegory image"/> </a> </div> </div> </div>';     
           
            }elseif(isset($cenema['media_type']) && $cenema['media_type'] == 'VIDEO'){

                // $html .= '<div class="col-md-4 mb-4"> <div class="cinema_item"> <a class="open_modal_and_play_video" href="javascript:void(0)" title="'.$cenema['caption'].'" data-video-id="'.$cenema['media_url'].'"> <div class="video_lightbox_anchor_image"> <img src="'.$cenema['thumbnail_url'].'" class="img-fluid" alt=""> <div class="cinema_item_content"> <h1>'.$cenema['caption'].'</h1> </div> </div> </a> </div> </div>';  
                $html .= '<div class="col-md-4 mb-4"> <div class="cinema_item"> <a class="open_modal_and_play_video" href="javascript:void(0)" title="'.$cenema['caption'].'" data-video-url="'.$cenema['media_url'].'"> <div class="video_lightbox_anchor_image"> <img src="'.$cenema['thumbnail_url'].'" class="img-fluid" alt=""> <div class="cinema_item_content"> <h1>'.$cenema['caption'].'</h1> </div> </div> </a> </div> </div>'; 
                
            }else{
                $html .= '<div class="col-md-4 mb-4"> <div class="cinema_item"> <a class="js-modal-btn" href="javascript:void(0)" title="'.$cenema['cinema_title'].'" data-video-id="'.str_replace('https://player.vimeo.com/video/','',$cenema['cinema_link']).'"> <div class="video_lightbox_anchor_image"> <img src="'.$cenema['cinema_image'].'" class="img-fluid" alt=""> <div class="cinema_item_content"> <h1>'.$cenema['cinema_title'].'</h1> <h4>'.$cenema['cinema_description'].'</h4> </div> </div> </a> </div> </div>';     
            }           
           
            }     
        }else{
             $html .= '<div class="col-md-12 mb-12"><h3>Sorry, No cinema here..</h3></div>';
        }
        
        $alldata = ['pages'=>$pages,'html'=>$html];
        echo json_encode($alldata);
    }
    

   
    
    public function getpackage(Request $request)
    {
        $packages = Package::where('package_category_id', $request->cat_id)->get();
        $html = '';
        if (count($packages) > 0) {
            foreach ($packages as $package) {
                $html .='<div class="col-md-4 mb-4"><div class="ourpackage_item"><div class="ourpackage_item_content  mt-4 mb-4"><h3>'.$package->package_name.'</h3><div class="ourpackage_item_des">'.$package->package_description.'</div></div></div></div>';
            }
        } else {
            $html .= '<div class="col-md-12 mb-12"><h3>Sorry, No cinema here..</h3></div>';
        }
        echo json_encode($html);
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        $body_class = '';

        return view('frontend.terms', compact('body_class'));
    }
}
