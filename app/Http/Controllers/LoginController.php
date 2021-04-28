<?php

namespace App\Http\Controllers;
use AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
class LoginController extends Controller
{
    /**
     * Shows correct view according to who has logged in.
     *
     */
    public function login(Request $request){
    	
    	if(Auth::attempt([
    		'username' => $request->username,
    		'password' => $request->password
    	])){
    		$user = User::where('username', $request->username)->first();
    		if($user->is_admin()){
    			return redirect()->route('pending');
    		}
    		return redirect()->route('available_pets');
    	}

	    return redirect()->back();
    }
}
