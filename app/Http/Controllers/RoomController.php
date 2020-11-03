<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;
use App\Events\Demo;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PublicMessenger;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
   
    public function index(){
        $mess = PublicMessenger::with('user')->get()->toArray();
        $mess = count($mess);
        $user = User::find(Auth::user()->id);

    	return view('roomchat',['user' => $user, 'count_mess' => $mess]);
    }
     public function fetchMessages()
    {
        $data = PublicMessenger::with('user')->get()->toArray();
          foreach ($data as &$value) {
            if($value['type_mess'] == 'image'){
              $value['message'] = '<img src="'.$value['message'].'" style="width:150px;height:150px;object-fit:cover"/>';
            }
            if($value['type_mess'] == 'file'){
              $value['message'] = 'file was inject!';
            }
            $value['created_at'] = Carbon::parse($value['created_at'])->format('H:i (d-m-Y) ');

          }

      return $data;
        //dd($dat);

    }
    public function sendMessage(Request $request)
    {
      $user = Auth::user();
      //dd($request->input('data'));
      if($request->input('data') != null || $request->input('data') != ''){
        $message = $user->messages()->create([
          'message' => $request->input('data'),
          'type_mess' => $request->input('type'),

        ])->id;
        broadcast(new MyEvent($user,null,$message))->toOthers();
      }else{
        $message = $user->messages()->create([
          'message' => $request->input('message'),
          'type_mess' => 'txt',
        ]);
        broadcast(new MyEvent($user,$message,0))->toOthers();
      }
      return ['status' => 'Message Sent!', 'data' => $message];
    }
    public function getFile($id){
      $mess = PublicMessenger::find($id);
      $user = User::find($mess->user_id);
      if($mess['type_mess'] == 'image'){
              $mess['message'] = '<img src="'.$mess['message'].'" style="width:100px;height:100px;object-fit:cover"/>';
            }
      if($mess['type_mess'] == 'file'){
        $mess['message'] = 'file was inject!';
      }
      $mess['created_at'] = Carbon::parse($mess['created_at'])->format('H:i');
      $mess = (object) $mess;
      return ['message' => $mess , 'user' => $user];

    }
}
