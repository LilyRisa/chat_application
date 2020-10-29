<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Validator;
use App\Models\User;

class HomeController extends Controller
{

	public function getHome(){
		if (Auth::check()) {
    		return view('homepage');
		}else{
			return redirect()->route('login');
		}
		
	}
	public function login(){
		if (Auth::check()) {
    		return redirect()->route('home');
		}else{
			return view('login');
		}
	}
	public function postLogin(Request $request){
		$rules = array(
			'email' => 'required|email', // make sure the email is an actual email
      		'password' => 'required'
		);
		$validator = Validator::make($request->all(), $rules);
		if($validator->fails()){
			return response()->json(['status' => 403, 'messenges' => 'login fail' ]);
		}else{
			if (Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')))){
            	return response()->json(['status' => 200 ]);
            }else {        
                return response()->json(['status' => 403, 'messenges' => "Wrong Credentials" ]);
            }
		}

	}
	public function postRegister(Request $request){
		try {
			$user = new User();
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->description = $request->input('des');
			$user->password = Hash::make($request->input('password'));
			$user->gender = 2;
			$user->avatar = 'https://www.alliancerehabmed.com/wp-content/uploads/icon-avatar-default.png';
			$user->save();
			return response()->json(['status' => 200 ]);
		} catch (QueryException $e) {
			return response()->json(['status' => 500, 'messenges' => $e ]);
		}

		
	}
	public function logout(){
		Auth::logout();
		return redirect()->route('login');
	}
    
}
