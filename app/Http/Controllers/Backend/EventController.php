<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function eventList()
    {
        $events = Event::with('getusers')->get();
        return view('backend.events.events', [
            'events' => $events,
        ]);
    }

    public function eventAdd()
    {
        $data=[];
        $data['users'] = User::select('id','name')->get()->toArray();
        return view('backend.events.addevent',$data);
    }

    public function eventSave(Request $request)
    {
       
        
        $request->validate([
          'title' => 'required',
          'user_id' => 'required',
          'date_time' => 'required',
          'start_time'=>'required',
          'end_time'=>'required',
          'event_hour'=>'required',
        ]);
       
        $time_in_12_hour_format  = date("g:i A", strtotime($request->start_time)) .' - '.date("g:i A", strtotime($request->end_time));
        $event = new Event();
        $event->event_title = $request->title;
        $event->user_id = $request->user_id;
        $event->event_date = $request->date_time;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->time_events = $time_in_12_hour_format;
        $event->event_hour = $request->event_hour;
        $event->count_video = $request->video_graphers;
        $event->locations = $request->location;
        $event->notes = $request->special_notes;
        $event->save();

        return redirect('admin/event/list')->with('success', 'Successfully Event Save');
    }

    public function eventEdit($id)
    {
        $data=[];
        $data['users'] = User::select('id','name')->get()->toArray();
        $data['event'] = Event::with('getusers')->find($id);
        return view('backend.events.editevent', $data);
    }

    public function eventUpdate(Request $request)
    {
        $request->validate([
          'title' => 'required',
          'user_id' => 'required',
          'date_time' => 'required',
          'start_time'=>'required',
          'end_time'=>'required',
          'event_hour'=>'required',
        ]);
        $time_in_12_hour_format  = date("g:i A", strtotime($request->start_time)) .' - '.date("g:i A", strtotime($request->end_time));
        $event = Event::find($request->event_id);
        $event->event_title = $request->title;
        $event->user_id = $request->user_id;
        $event->event_date = $request->date_time;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->time_events = $time_in_12_hour_format;
        $event->event_hour = $request->event_hour;
        $event->count_video = $request->video_graphers;
        $event->locations = $request->location;
        $event->notes = $request->special_notes;
        $event->save();

        return redirect('admin/event/list')->with('success', 'Successfully Event Updated');
    }

    public function eventDelete($id)
    {
        Event::find($id)->delete();
        return redirect('admin/event/list')->with('success', 'Successfully Event Deleted');
    }
}
