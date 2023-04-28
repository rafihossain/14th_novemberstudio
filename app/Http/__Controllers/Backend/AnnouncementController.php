<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function announcementList()
    {
        $announcements = Announcement::with('getusers')->get();
        return view('backend.announcement.announcement', [
            'announcements' => $announcements,
        ]);
    }

    public function announcementAdd()
    {
        $data=[];
        $data['users'] = User::select('id','name')->get()->toArray();
        return view('backend.announcement.addannouncement',$data);
    }

    public function announcementSave(Request $request)
    {
       
        
        $request->validate([
            'title' => 'required',
            'an_date' => 'required',
        ]);
     
        $des = $request->description;
        if($des == null){
            $des = '';
        }
     
        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->user_id = $request->user_id;
        $announcement->an_date = $request->an_date;
        $announcement->description = $des;
        $announcement->save();
        return redirect('admin/announcement/list')->with('success', 'Successfully announcement Save');
    }

    public function announcementEdit($id)
    {
        $data=[];
        $data['users'] = User::select('id','name')->get()->toArray();
        $data['announcement'] = Announcement::with('getusers')->find($id);
        return view('backend.announcement.editannouncement', $data);
    }

    public function announcementUpdate(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'an_date' => 'required',
        ]);
         
        $des = $request['description'];
        if($des == null){
            $des = '';
        }
        $announcement = Announcement::find($request['announcement_id']);
        
        
        $announcement->title = $request['title'];
        $announcement->an_date = $request['an_date'];
        $announcement->description = $des;
        $announcement->save();

        return redirect('admin/announcement/list')->with('success', 'Successfully announcement Updated');
    }

    public function announcementDelete($id)
    {
        Announcement::find($id)->delete();
        return redirect('admin/announcement/list')->with('success', 'Successfully announcement Deleted');
    }
}
