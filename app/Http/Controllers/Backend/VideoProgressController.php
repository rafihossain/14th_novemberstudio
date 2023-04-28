<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Payment;
use App\Models\Videoprogress;
use Illuminate\Http\Request;

class VideoProgressController extends Controller
{
      public function videoprogress()
    {
        $videoprogresss = Videoprogress::with('getusers')->get();
        return view('backend.videoprogress.videoprogress', [
        'videoprogresss' => $videoprogresss,
        ]);
    }
    public function videoprogressedit($id)
    {
        $videoprogress = Videoprogress::with('getusers')->find($id);
        return view('backend.videoprogress.editvideoprogress', [
        'videoprogress' => $videoprogress,
        ]);
    }
    public function videoprogressUpdate(Request $request)
    {
        $videoprogress = Videoprogress::where('id',$request->videoprogress_id)->first();
        $videoprogress->higlight_song_status = $request->higlight_song_status;
        $videoprogress->higlight_song_links = $request->higlight_song_links;
        $videoprogress->higlight_song_note = $request->higlight_song_note;
        
        $videoprogress->lg_ver_song_status = $request->lg_ver_song_status;
        $videoprogress->lg_ver_song_links = $request->lg_ver_song_links;
        $videoprogress->lg_ver_song_note = $request->lg_ver_song_note;
        $videoprogress->ph_for_usp_cove_status = $request->ph_for_usp_cove_status;
        $videoprogress->ph_for_usp_cove_links = $request->ph_for_usp_cove_links;
        $videoprogress->ph_for_usp_cove_note = $request->ph_for_usp_cove_note;
        $videoprogress->vid_progress_status = $request->vid_progress_status;
        $videoprogress->vid_progress_note = $request->vid_progress_note;
        
        $videoprogress->balance_status = $request->balance_status;
        $videoprogress->balance_date = $request->balance_date; 
        $videoprogress->expected_date = $request->expected_date;
        $videoprogress->correction_request = $request->correction_request; 
        $videoprogress->correction_note = $request->correction_note;
        
        $videoprogress->save();
//\Session::flash('flash_message','Application has been successfully submitted.');
    return redirect(route('backend.videoprogress-edit', ['id' => $request->videoprogress_id]));
    }
}
