<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;
use App\AdoptionRequest;
use App\User;

/*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the display of the different pages the     | public user can to.
    |
    */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        return view('/home',array('user'=>$user));
    }



    /**
     * Show the a confirmation of the request made by the user.
     *
     */
    public function requested(){
        return view('requestmade');
    }

    /**
     * Show all the requests made by this user.
     *
     */
    public function allrequest(){
        $adoptionsQuery = AdoptionRequest::all();
        $username = \Auth::user()->username;
        return view('adoption_requests.requestsmade', array('username'=>$username, 'adoptions'=>$adoptionsQuery));
    }

    /**
     * Show the available pets that can be adopted.
     * The user can also filter the pets shown by type.
     */
    public function pets(){
        if(request()->has('type') && request()->type != ''){
            $animalsQuery = Animals::where('type', request('type'))->paginate(5)->appends('type', request('type'));
        } else{
            $animalsQuery = Animals::paginate(10);
        }
        
        $username = \Auth::user()->username;
        $adoptionsQuery = AdoptionRequest::all();
        return view('adoption_requests.availablepets', array('animals'=>$animalsQuery,'username'=>$username, 'adoptions'=>$adoptionsQuery));
    }

    /**
     * Updates certain details of the user.
     *
     */
    public function update(Request $request, $id){
        $users = User::find($id);
        $this->validate(request(),[
            'firstName' => 'required',
            'lastName' => 'required',
            'address' => 'required',
            'postcode' => 'required',
        ]);
        $users->firstName = $request->input('firstName');
        $users->lastName = $request->input('lastName');
        $users->address = $request->input('address');
        $users->postcode = $request->input('postcode');
        $users->save();
        return redirect('home')->with('success', 'User details have been updated');
    }

    /**
     * Show the screen with the certain user current details, which can be updated.
     *
     */
    public function edit($id){
        $users = User::find($id);
        return view('edituser', compact('users'));
    }

}
