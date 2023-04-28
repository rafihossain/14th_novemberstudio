<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\TimeZone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Events\Backend\UserCreated;
use App\Models\AmmendmentImage;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Image;
use File;
use DB;
use App\Models\Payment;
use App\Models\Videoprogress;
use App\Models\Event;
use App\Models\Announcement;


// use Illuminate\Support\Facades\DB;

class UserManageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:editor_permission');
        $this->module_name = 'users';
    }

    protected function userValidate($request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'avatar' => 'required'
        ]);
    }

    protected function userupdateValidate($request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
    }

    protected function userupdatenewValidate($request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
    }

    protected function userContractPaperUpload($request)
    {
        $contractPaper = $request->file('contract_paper');
        $fileType = $contractPaper->getClientOriginalExtension();
        $imageName = 'contract_paper_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
        $directory = 'images/contract_paper/';
        $imageUrl = $directory . $imageName;
        $contractPaper->move($directory, $imageName);

        return $imageUrl;
    }
    protected function userAmmendmentUpload($request, $userId)
    {

        $ammendmentImages = $request->file('ammendment');
        if ($request->hasFile('ammendment')) {

            foreach ($ammendmentImages as $key => $image) {
                $fileType = $image->getClientOriginalExtension();
                $imageName = 'ammendment_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
                $directory = 'images/ammendment/';
                $imageUrl = $directory . $imageName;
                $image->move($directory, $imageName);
                $fileName[$key] = $imageUrl;

                $ammendmentImage = new AmmendmentImage();
                $ammendmentImage->name = $imageUrl;
                $ammendmentImage->user_id = $userId;
                $ammendmentImage->save();
            }

        }
    }
    
    // protected function updateUserAmmendmentUpload($request, $ammendmentId, $userId)
    // {
    //     $ammendmentImages = $request->file('ammendment');
    //     if ($request->hasFile('ammendment')) {

    //         $fileName = [];
    //         foreach ($ammendmentImages as $key => $image) {
    //             $fileType = $image->getClientOriginalExtension();
    //             $imageName = 'ammendment_' . time() . '_' . rand(10000, 999999) . '.' . $fileType;
    //             $directory = 'images/ammendment/';
    //             $imageUrl = $directory . $imageName;
    //             $image->move($directory, $imageName);
    //             $fileName[$key] = $imageUrl;
    //         }
    //         $imageId = explode(',',$ammendmentId);
    //         $arrayValues = array_values($fileName);

    //         for($i=0; $i<count($arrayValues); $i++){

    //             $ammendmentImage = AmmendmentImage::find($imageId[$i]);
    //             $ammendmentImage->name = $arrayValues[$i];
    //             $ammendmentImage->user_id = $userId;
    //             $ammendmentImage->save();
    //         }

    //     }
    // }

    public function manageUsers()
    {
        $manageUsers = User::with('role')->get();
        // dd($manageUsers);

        $roles = Role::get();
        return view('backend.users.users-list', [
            'manageUsers' => $manageUsers,
            'roles' => $roles,
        ]);
    }

    public function createUsers()
    {
        $roles = Role::get();

        return view('backend.users.users-create', [
            'roles' => $roles,
        ]);
    }

 protected function userImageUpload($request){
        $avatarImage = $request->file('avatar');

        $image = Image::make($avatarImage);
        $fileType = $avatarImage->getClientOriginalExtension();
        $imageName = 'user_'.time().'_'.rand(10000, 999999).'.'.$fileType;
        $directory = 'images/user/';
        $imageUrl = $directory.$imageName;
       // $image->save($imageUrl);
        
       // $thumbnail = $directory."thumbnail/".$imageName;
        // $image->resize(null, 200, function($constraint) {
        //     $constraint->aspectRatio();
        // });
        $image->resize(400,400);
        $image->save($imageUrl);

        return $imageUrl;
    }

        public function getUpdateChanel($length = 10){
             $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
       
        return $randomString;
        }

    public function saveUsers(Request $req)
    {
       
        //For Validation--------------
        $this->userValidate($req);
//chanel
        $newchanel = $this->getUpdateChanel();
        $check = User::where('chanel',$newchanel)->first();
        if(!$check){
          $newchanel = $this->getUpdateChanel();   
        }
 
        $module_name = $this->module_name;
        $module_name_singular = Str::singular($module_name);

        $user = $req->except('_token', 'roles', 'permissions', 'password_confirmation');
        $imageUrl = $this->userImageUpload($req);
      
        
        $user = new User();
        $user->name = $req->username;
        $user->email = $req->email;
        $user->user_role = $req->role;
        $user->password = Hash::make($req->password);
        $user->main_password = $req->main_password;
        $user->avatar = $imageUrl;
        $user->chanel = $newchanel; 
     
        if ($req->file('contract_paper')) {
            $contractPaper = $this->userContractPaperUpload($req);
            $user->contract_paper = $contractPaper;
        }
        // dd($user);
        $user->save();

        if ($req->file('ammendment')) {
            $this->userAmmendmentUpload($req, $user->id);
        }


        if ($req->role == 3) {
            $roles = Role::select('name')->where('id', 8)->get()->toArray();
            $permissions = Permission::select('name')->whereIn('id', [1, 40])->get()->toArray();
        } else {
            $roles = Role::select('name')->where('id', 7)->get()->toArray();
            $permissions = Permission::select('name')->whereIn('id', [1, 39])->get()->toArray();
        }

        $permission = array();
        $role = array();
        foreach ($roles as $getrole) {
            $role[] = $getrole['name'];
        }

        foreach ($permissions as $getper) {
            $permission[] = $getper['name'];
        }

        $module_name_singular = Str::singular('user');

        if (isset($roles)) {
            $$module_name_singular->syncRoles($roles);
        } else {
            $roles = [];
            $$module_name_singular->syncRoles($roles);
        }

        // Sync Permissions
        if (isset($permissions)) {
            $$module_name_singular->syncPermissions($permissions);
        } else {
            $permissions = [];
            $$module_name_singular->syncPermissions($permissions);
        }

        // Username
        $id = $$module_name_singular->id;
        $username = config('app.initial_username') + $id;
        $$module_name_singular->username = $username;
        $$module_name_singular->save();

        event(new UserCreated($$module_name_singular));
        
   
        
        
        $vprogress =  new Videoprogress();
        $vprogress->user_id = $id;
        $vprogress->higlight_song_status = 2;
        $vprogress->higlight_song_links = '';
        $vprogress->lg_ver_song_status = 2;
        $vprogress->lg_ver_song_links = '';
        $vprogress->lg_ver_song_note = '';
        $vprogress->ph_for_usp_cove_status = 2;
        $vprogress->ph_for_usp_cove_links = '';
        $vprogress->ph_for_usp_cove_note = '';
        $vprogress->vid_progress_status = 0;
        $vprogress->balance_status =0;
        $vprogress->balance_date = '';
        $vprogress->expected_date = '';
        $vprogress->save();
        
        $payment =  new Payment();
        $payment->user_id = $id;
        $payment->deposit_amount = 0;
        $payment->due_balance = 0;
        $payment->next_payment = 0;
        $payment->next_paymet_amount = 0;
        $payment->expected_delivery = 0;
        $payment->notes = '';
        $payment->status = 0;
        $payment->save();
        
        
        return response()->json(['success' => 'Successfully Inserted']);
    }

    public function all_users()
    {
        $user = User::whereIn('user_type', [2, 3, 4])->get()->toArray();
        return view('backend.users.all_users', compact('user'));
    }

    public function editUsers($id)
    {
        $roles = Role::get();
        $user = User::with('role', 'ammendment_image')->find($id);
        $videoprogress = Videoprogress::where('user_id',$id)->get();
        $payments = Payment::where('user_id',$id)->get();
        $events = Event::where('user_id',$id)->get();
        $announcements = Announcement::where('user_id',$id)->with('getusers')->get();
        return view('backend.users.users-edit', [
            'user' => $user,
            'roles' => $roles,
            'videoprogresss'=>$videoprogress,
            'payments'=>$payments,
            'events'=>$events,
            'announcements'=>$announcements
        ]);
    }

    protected function userInformationUpdate($req, $user, $cpImageUrl = null, $ammendmentUrl = null)
    {
        $user->username = $req->username;
        $user->email = $req->email;
        $user->user_role = $req->role;

        if ($cpImageUrl != '') {
            $user->contract_paper = $cpImageUrl;
        }
        if ($ammendmentUrl != '') {
            $user->ammendment = $ammendmentUrl;
        }
      if($req->password){
        $user->main_password = $req->password;
        $user->password = Hash::make($req->password);
      }
 		
        $user->save();
    }

    public function updateUsers(Request $req)
    {
    // echo "<pre>"; print_r($req->all()); die();

        $user_id = $req->id;
        $password = $req->password;
        $re_password = $req->password_confirmation;

      // 'password' => 'required|string|min:8|confirmed',
      if($req->password){
        $req->validate([
          'current_password' => 'required',
          'password' => 'required|string|min:8|confirmed',
        ]);
      }
        $user = User::find($user_id);
        if ($user->email == $req->email) {
            $this->userupdateValidate($req);
        } else {
            $this->userupdatenewValidate($req);
        }

        if (($password != '') && ($re_password != '')) {
            if ($password == $re_password) {

                $av = $req->file('avatar');
                if($av){
                    $imageUrl = $this->userImageUpload($req);
                    User::where('id',$user_id)->update(['avatar'=>$imageUrl]);
                }

                $contract_paper = $req->file('contract_paper');
                if ($contract_paper) {
                    $cpImageUrl = $this->userContractPaperUpload($req);
                    $this->userInformationUpdate($req, $user, $cpImageUrl, $ammendmentUrl=null);
                } else {
                    $this->userInformationUpdate($req, $user);
                }
                $ammendment = $req->file('ammendment');
                if ($ammendment) {
                    $ammendmentUrl = $this->userAmmendmentUpload($req, $user_id);
                    $this->userInformationUpdate($req, $user, $cpImageUrl=null, $ammendmentUrl);
                } else {
                    $this->userInformationUpdate($req, $user);
                }
                return redirect('admin/users/list')->with('success', 'Successfully Updated');
            } else {
                return redirect('admin/users/edit/' . $user_id)->with('do_not_match', 'Password did not match');
            }
        } else {

            // dd(22);

            $contract_paper = $req->file('contract_paper');
            if ($contract_paper) {
                $cpImageUrl = $this->userContractPaperUpload($req);
                $this->userInformationUpdate($req, $user, $cpImageUrl, $ammendmentUrl=null);
            } else {
                $this->userInformationUpdate($req, $user);
            }
            $ammendment = $req->file('ammendment');
            if ($ammendment) {
                $ammendmentUrl = $this->userAmmendmentUpload($req, $user_id);
                $this->userInformationUpdate($req, $user, $cpImageUrl=null, $ammendmentUrl);
            } else {
                $this->userInformationUpdate($req, $user);
            }

            return redirect('admin/users/list')->with('success', 'Successfully Updated');
        }
    }

    public function deleteUsers($id)
    {
        $user = User::find($id);
        $img = 'images/contract_paper/';
        $imgOne = 'images/ammendment/thumbnail';
      
        if (isset($user->contract_paper)) {
            if (File::exists($img . $user->contract_paper)) {
              
                unlink($img . $user->contract_paper);
            }
        }
        if (isset($user->ammendment)) {
            if (File::exists($img . $user->ammendment)) {
                unlink($img . $user->ammendment);
            }
        }

      DB::table('users')->where('id', $id)->delete();
      Payment::where('user_id', $id)->delete();
      Videoprogress::where('user_id', $id)->delete();
      Event::where('user_id', $id)->delete();
      Announcement::where('user_id', $id)->delete();      
        return redirect()->back()->with('success', 'Successfully Deleted');
    }

    public function deleteAmmendment(Request $request)
    {
        $ammendmentImage = AmmendmentImage::find($request->delete_id)->delete();
        echo $ammendmentImage;
    }

    public function usersdetails($id)
    {
        $user = User::with('clients', 'office', 'role')->find($id)->toArray();
        // echo "<pre>";
        // print_r($user);die();
        return view('backend.teams.users.usersdetails', compact('user'));
    }

    public function user_datetime($id)
    {
        $user = User::with('clients', 'office', 'role')->find($id)->toArray();
        $timezone = TimeZone::get()->toArray();
        return view('backend.teams.users.usersdate_time', compact('user', 'timezone'));
    }

    public function user_timezone_save(Request $req, $id)
    {
        $req->validate([
            'user_timezone' => 'required',
        ]);

        $data['user_timezone'] = $req->user_timezone;
        User::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Successfully updated');
    }
}
