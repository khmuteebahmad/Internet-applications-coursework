<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Animals;
use App\AdoptionRequest;

/*
    |--------------------------------------------------------------------------
    | AdoptionRequest Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the user making a request and adding it to the table
    |
    */
class AdoptionRequestController extends Controller
{

    /**
     * Show the form containing the details of the adoption request
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($id)
    {
        $animals = Animals::find($id);
        $adopt = new AdoptionRequest;
        $adopt->animalId = $animals->id;
        $adopt->petname = $animals->name;
        $adopt->username = Auth()->user()->username;
        $adopt->save();
        return redirect('requestmade')->with('success', 'Request has been made');
        return view('adoption_requests.edit', compact('animals'));
    }
    /**
     * Adds the adoptions request to the database.
     *
     */
    public function update(Request $request, $id){
        $animals = Animals::find($id);
        $this->validate(request(),[
            'id' => 'required',
            'petname' => 'required',
            'username' => 'required',
        ]);
        $adopt = new AdoptionRequest;
        $adopt->animalId = $request->input('id');
        $adopt->petname = $request->input('petname');
        $adopt->username = $request->input('username');
        $adopt->created_at = now();
        $adopt->save();
        return redirect('requestmade')->with('success', 'Request has been made');
    }
}
