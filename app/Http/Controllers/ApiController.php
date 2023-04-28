<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\Videoprogress;
use App\Models\Event;
use App\Models\Payment;
use App\Models\User;
use App\Models\Message;
use App\Models\Announcement;
use App\Models\Package;
use App\Models\Cinema;
use App\Models\ContactInformation;
use App\Models\CinemaCategory;
use App\Lib\PusherFactory;
use DB;

class ApiController extends Controller
{
  
 public function texttest(Request $request){
    return  response()->json([
    'name' => 'Abigail',
    'state' => 'CA',
]);
 }  
 
 public function loginUser(Request $request){
    $email ='rishi@gmail.com';
    $password = 'r1234567';
//echo 
    
 //  mail("someone@example.com","My subject",));
    
   // die();
   $data = file_get_contents("php://input");
   $result = json_decode($data); 

   
     // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
     //   $txt = json_encode(all());
     //   fwrite($myfile, $txt);
     //   $txt = "Minnie Mouse\n";
      //  fwrite($myfile, $txt);
     //   fclose($myfile); 
    

    $user = User::where('email',$result->email)->first();
   
   
    $data = [];
    if(!$user || !Hash::check($result->password, $user->password)){
    $data = ['status'=>500,'user'=>$request->all()];
    } else { 
    $data = ['status'=>200,'user'=>$user];
    }
    return  response()->json($data);   
 }
 public function getMessage($id){
     
       $count = Message::where(function($query) use ($id) {
            $query->where('sender_id', $id)->where('reciver_id', 1);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', 1)->where('reciver_id', $id);
        })->orderBy('created_at', 'ASC')->count();
        
    $getdata = $count - 10;
    $messages = Message::where(function($query) use ($id) {
            $query->where('sender_id',$id)->where('reciver_id', 1);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', 1)->where('reciver_id', $id);
        })->orderBy('created_at', 'ASC')->with('user')->skip($getdata)->take(10)->get();
       return  response()->json($messages);          
 }
 
 public function postMessage(Request $request){
   
    $uifo =  User::find($request->userid);
    $aifo =  User::find(1);
   
    $newms = new Message();
    $newms->sender_id = $request->userid;
    $newms->message = $request->message;
    $newms->reciver_id = 1;
    $newms->is_seen = 0;
    $newms->save();
    
    $newms->dateTimeStr = date("Y-m-dTH:i", strtotime($newms->created_at->toDateTimeString()));
    
    $newms->dateHumanReadable = $newms->created_at->diffForHumans();
    
    $newms->sender_name = $uifo->name;
    
    $newms->sender_id = $request->userid;
    
    $newms->name = $aifo->name;
    
    $newms->reciver_name = $aifo->name;
    $newms->user = $uifo;
    PusherFactory::make()->trigger($uifo->chanel, 'send', ['data' => $newms]);
    $data = ['status'=>200,'msg'=>'ok'];
    return  response()->json($data);   
 }
 
 public function getevents($id){
    $info = Event::where('user_id',$id)->get();
    return  response()->json($info);
 }
  public function getuserinfo($id){
   $info = Videoprogress::where('user_id',$id)->first();
    return  response()->json($info);   
 }
   public function getglobal($id){
    $data = [];   
    $data['video_progress'] = Videoprogress::where('user_id',$id)->first();
    $data['payment'] = Payment::where('user_id',$id)->first();
    $data['events'] = Event::where('user_id',$id)->get();
    $data['announcements'] = Announcement::where('user_id',$id)
    ->orderBy('created_at', 'desc')
    ->take(3)
    ->get();
    return  response()->json($data);   
 }
   
    public function getpayment($id){
    $info = Payment::where('user_id',$id)->first();
    return  response()->json($info);       
   }
   
   public function getPackage(){
     $list['single'] = Package::where('package_category_id',1)->get()->toArray();
     $list['multiple'] = Package::where('package_category_id',2)->get()->toArray();
     $list['addon'] = Package::where('package_category_id',3)->get()->toArray();
    return  response()->json($list); 
   }
   
   public function saveContact(Request $request){
       // dd($request->all());
       $data = file_get_contents("php://input");
       $result = json_decode($data);

     $cc =  new ContactInformation();
     $cc->name = $request->name;
     $cc->email =$request->email;
     $cc->phone = $request->phone;
     $cc->date_location = $request->date_location;
     $cc->choose_type_other = $request->choose_type;

     if($request->choose_package == 1){
       $cc->single_day_packages = 1;
     }else{
       $cc->single_day_packages = 0;
       }
     if($request->choose_package == 2){
       $cc->multi_day_packages = 1;
     }else{
       $cc->multi_day_packages = 0;
       }
     
    
     $cc->how_did_you_hear = $request->ans;
     $cc->message_description =$request->msg;
    
    $cc->save();

    $data = ['status'=>200, 'msg'=>'Saved you informations and thanks for rech.'];
    return  response()->json($data); 
   }
  public function getAllInstrafeed(){
    $access_token = 'IGQVJXMFJGY2ZASRUdib3lHTnlaVmhGNVY4VXY4WkllT18xQVlOWGhOV2dQcjZAsa29DSjU5QVZAFUUQzeXg2SjRpLTliLWc4dnlTQmYwQmFQVHhIUXE0ai02c1VZAUXZAnYWhLQ29jR2VqazZAYd05pNlRFcQZDZD';
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
   public function getCinema(){
    $cats = CinemaCategory::select('id','category_name')->get();
    $cinemas = [];
    foreach($cats as $cat){
        $newarrar = [];
        $newarrar['cname'] = $cat->category_name;
      	$newarrar['items'] =  Cinema::where('cinema_category_id',$cat->id)->with('type')->take(5)->orderBy('id','desc')->get()->toArray(); 
   
      
      if(count($newarrar['items']) > 0){
        if($cat->category_name == 'Current Project'){
         $instraffed = $this->getAllInstrafeed();
          if(count($instraffed) > 0){
            $newarrar = [];
            $newarrar['cname'] = 'Current Project';
            $newarrar['items'] = $instraffed;
          }
        }
        $cinemas[] = $newarrar; 
      }

    }
    // $instraffed = $this->getAllInstrafeed();
   //  if(count($instraffed) > 0){
    //   $newarrar = [];
   //    $newarrar['cname'] = 'Instrgram Feed';
   //    $newarrar['items'] = $instraffed;
   //    $cinemas[] = $newarrar; 
   //  }

    return  response()->json($cinemas);      
   }
    
}