<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animals;
use App\AdoptionRequest;

/*
    |--------------------------------------------------------------------------
    | Dashboard Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the user reviewing and approving all the adoption
    | requests made by the various user
    |
    */
class DashboardController extends Controller
{
    /**
     * Shows all the requests that need to be approved to the user.
     *
     */
    public function pending(){
    	$adoptionsQuery = AdoptionRequest::all();
    	return view('admin.pending', array('adoptions' => $adoptionsQuery));
    }
    /**
     * Shows all the requests made by all users.
     *
     */
    public function requests(){
    	$adoptionsQuery = AdoptionRequest::all();
    	return view('admin.requests', array('adoptions' => $adoptionsQuery));
    }
    /**
     * Updates the status of the request in the data base for a specific pet.
     *
     */
    public function review(Request $request, $id, $animalId){
    	$adoptions = AdoptionRequest::find($id);
    	$adoptions->accepted = $request->input('accepted');
    	$adoptions->save();

    	if($adoptions->accepted == 'Approved'){
    		$animal = Animals::where('id', '=', $animalId)->first();
    		$animal->availability = 'Unavailable';
    		$animal->save();

	    	$other = AdoptionRequest::where("animalId", '=', $animalId)->where('accepted', '=', 'Pending')->get();
	    	foreach ($other as $record) {
	    		$record->accepted = 'Rejected';
	    		$record->save();
	    	}
	    }

    	return back()->with('success', 'Adoption Request has been updated');
    }
}
