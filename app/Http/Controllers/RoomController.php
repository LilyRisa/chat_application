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
        $user = User::find(Auth::user()->id);
    	return view('roomchat',['user' => $user]);
    }
     public function fetchMessages()
    {
        $data = PublicMessenger::with('user')->get();
        foreach ($data as $i => $value) {
            $data[$i]->created_at = Carbon::parse($value->created_at)->format('d-m-Y H:i');
        }
      return $data;

    }
    public function sendMessage(Request $request)
    {
      $user = Auth::user();

      $message = $user->messages()->create([
        'message' => $request->input('message')
      ]);

      broadcast(new Demo($request->input('message')))->toOthers();

      return ['status' => 'Message Sent!', 'data' => $message];
    }
}
