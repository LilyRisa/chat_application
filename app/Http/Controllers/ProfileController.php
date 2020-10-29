<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\User;

class ProfileController extends Controller
{
    public function HomeProfile(){
    	$user = User::find(Auth::user()->id);
    	//dd($user->name);
    	return view('Profile',['user' => $user]);
    }
    public function description(Request $request){
    	try{
    		$user = User::find(Auth::user()->id);
	    	$user->description = $request->input('des');
	    	$user->save();
	    	return response()->json(['status' => 200, 'value' => $request->input('des')]);
    	}catch(QueryException $e){
    		return response()->json(['status' => 500]);
    	}
    	
    }
    public function gender(Request $request){
    	try{
    		$user = User::find(Auth::user()->id);
	    	$user->gender = (int)$request->input('gender');
	    	$user->save();
	    	return response()->json(['status' => 200, 'value' => $request->input('gender')]);
    	}catch(QueryException $e){
    		return response()->json(['status' => 500, 'error' => $e]);
    	}
    }
    public function avatar(Request $request){
    	try{
    		$user = User::find(Auth::user()->id);
	    	$user->avatar = $request->input('avatar');
	    	$user->save();
	    	return response()->json(['status' => 200, 'value' => $request->input('avatar')]);
    	}catch(QueryException $e){
    		return response()->json(['status' => 500, 'error' => $e]);
    	}
    }
}
