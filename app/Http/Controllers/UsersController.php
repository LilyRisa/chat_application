<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
    	return view('search');
    }
    public function search(Request $request){
    	$key = $request->input('keywords');
    	if($key == null){
    		return response()->json([]);
    	}
    	$result = User::where('email',$key)->orWhere('name', 'like','%'.$key.'%')->get();
    	return response()->json($result);
    }
}
