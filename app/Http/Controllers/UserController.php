<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

/*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller displays the information about pet owners
    |
    */
class UserController extends Controller
{
    /**
     * Gets the username of the owner and shows all their details.
     *
     */
    public function show($username){
    	$user = User::where('username', '=', $username)->first();
    	return view('animals.owner', compact('user'));
    }
}
