<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatPrivateController extends Controller
{
    public function index(){
    	return view('chatuser');
    }
}
