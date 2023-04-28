<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Lib\PusherFactory;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */
    public function getLoadLatestMessages(Request $request)
    {
        if(!$request->user_id) {
            return;
        }
   

        $count = Message::where(function($query) use ($request) {
            $query->where('sender_id', Auth::user()->id)->where('reciver_id', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('sender_id', $request->user_id)->where('reciver_id', Auth::user()->id);
        })->orderBy('created_at', 'ASC')->count();
        
        $getdata = $count - 10;
        
     $messages = Message::where(function($query) use ($request) {
            $query->where('sender_id', Auth::user()->id)->where('reciver_id', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('sender_id', $request->user_id)->where('reciver_id', Auth::user()->id);
        })->orderBy('created_at', 'ASC')->with('user')->skip($getdata)->take(10)->get();
             

        $return = [];
        foreach ($messages as $message) {
                          //  return view('backend.faq.add_faq',$data);
            $return[] = view('backend.message.message-line')->with('message', $message)->render();
        }


        return response()->json(['state' => 1, 'messages' => $return]);
    }
    
    public function postSendMessage(Request $request)
    {
        if(!$request->to_user || !$request->message) {
            return;
        }
        $uifo =  User::find($request->to_user);
        $message = new Message();

        $message->sender_id = Auth::user()->id;

        $message->reciver_id = $request->to_user;

        $message->message = $request->message;

        $message->save();


        // prepare some data to send with the response
        $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));

        $message->dateHumanReadable = $message->created_at->diffForHumans();

        $message->sender_name = $message->user->name;

        $message->sender_id = Auth::user()->id;

        $message->name = $message->user->name;

        $message->reciver_name = $request->to_user;

        PusherFactory::make()->trigger($uifo->chanel, 'send', ['data' => $message]);

        return response()->json(['state' => 1, 'data' => $message]);
    }
}