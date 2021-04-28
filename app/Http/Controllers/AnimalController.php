<?php

namespace App\Http\Controllers;

use App\AdoptionRequest;
use App\Animals;
use App\File;
use App\User;
use Gate;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

/*
    |--------------------------------------------------------------------------
    | Animal Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the display and editing of the animal model
    |
    */
class AnimalController extends Controller
{
    /**
     * Shows all the animals in the table, and will only show the pets the admin wants to.
     *
     */
    public function index(){
        if(request()->has('type') && request()->type != ''){
            $animals = Animals::where('type', request('type'))->paginate(10)->appends('type', request('type'));
        } else{
            $animals = Animals::paginate(10);
        }
        $users = User::all();
        $adoptions = AdoptionRequest::all();
    	return view('animals.index', compact('animals', 'users', 'adoptions'));
    }
    /**
     * Shows the page that allows the admin to add a new pet to the table that is available.
     *
     */
    public function create(){
    	return view('animals.create');
    }
    /**
     * Adds the new pet to the table as long as the form as been correctly filled out.
     *
     */
    public function store(Request $request){
    	$animal = $this->validate(request(), [
    		'name' => 'required',
    		'dob' => 'required',
            'type' => 'required',
    	]);
    	
    	$animal = new Animals;
    	$animal->name = $request->input('name');
    	$animal->dob = $request->input('dob');
    	$animal->description = $request->input('description');
    	$animal->created_at = now();
    	$animal->image = '';
        $animal->type = $request->input('type');
    	$animal->save();

        if (!is_null($request->images)) {
            foreach($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path('/images'), $name);
                \App\File::create([
                    'file' => '/images/'.$name,
                    'animal_id' => $animal->id
                  ]);
            }
         }
    	return back()->with('success', 'Animal has been added');
    }
    /**
     * Shows the details of a specific pet.
     *
     */
    public function show($id){
    	$animals = Animals::find($id);
    	return view('animals.show', compact('animals'));
    }
    /**
     * Deletes a pet from the database.
     *
     */
    public function destroy($id){
    	$animal = Animals::find($id);
    	$animal->delete();
        $adoption = AdoptionRequest::where('animalId', '=', $id);
        $adoption->delete();
    	return redirect('animals')->with('success', 'Animal has been deleted');
    }
    /**
     * Updates the details of the pet, with the new details supplied by the admin.
     *
     */
    public function update(Request $request, $id){
    	$animals = Animals::find($id);
    	$this->validate(request(),[
    		'name' => 'required',
    		'dob' => 'required',
    	]);

    	$animals->name = $request->input('name');
    	$animals->dob = $request->input('dob');
    	$animals->description = $request->input('description');
    	$animals->availability = $request->input('availability');
    	
    	$animals->availability = $request->input('availability');
    	$animals->save();

         if (!is_null($request->images)) {
            $animals->files()->delete();
            foreach($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path('/images'), $name);
                File::create([
                    'file' => '/images/'.$name,
                    'animal_id' => $animals->id
                  ]);
            }
         }
         
    	return redirect('animals')->with('success', 'Animal has been updated');
    }
    /**
     * Shows form allowing the admin to change the details of the pet.
     *
     */
    public function edit($id){
    	$animals = Animals::find($id);
    	return view('animals.edit', compact('animals'));
    }
}
