<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Loads the index page
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index')->name('home');
//All the authenticated pages
Auth::routes();
//Use the login controller instead of the auth version
Route::post('/login/custom', [
	'uses' => 'LoginController@login',
	'as' => 'login.custom'
]);
//Redirects the user to the apprioprate page according to their role
Route::group(['middleware' => 'auth'], function(){
	// Route::get('/home', function(){
	// 	return view('home');
	// })->name('home');
	Route::get('/dashboard', function(){
		return view('dashboard');
	})->name('dashboard');
});

//All the routes for the Admin
Route::group(['middleware' => ['auth', 'admin']], function(){
	Route::get('/pending', 'DashboardController@pending')->name('pending');//loads the pending requests
	Route::get('/requests', 'DashboardController@requests')->name('requests');//loads all the requests by all the users
	Route::get('animals/index','AnimalController@index')->name('display_animal');//loads all the animals in the database
	Route::resource('animals', 'AnimalController');//all routes for the pets, including adding pets, editing pets, deleting pets and viewing a pet
	Route::post('/pending/{adoption}/{animal}', ['as' => 'review', 'uses' => 'DashboardController@review']);//adds the updated request to the database
	Route::get('/user/{username}', 'UserController@show')->name('user');//displays the details of the owner.
});
//All the routes for a public user
Route::group(['middleware' => ['auth', 'user']], function(){
	Route::view('/my-adoptions','myAdoptions')->name('myAdoptions');
	// Route::get('/home', 'HomeController@index')->name('home');//home page of the user
	Route::get('/requestmade','HomeController@requested')->name('display_request');//displays the request confirmation page
	Route::get('/availablepets', 'HomeController@pets')->name('available_pets');//displays all the available pets
	Route::get('/adoption_requests/{animal}', 'AdoptionRequestController@create');//loads page of pet details so the user can confirm their request
	Route::put('adoption_requests/{animal}', 'AdoptionRequestController@update');//adds request to the database
	Route::patch('adoption_requests/{animal}', 'AdoptionRequestController@update');//adds request to the database
	Route::get('/allrequests', 'HomeController@allrequest')->name('all_requests');//displays all the requests made by the user.
	Route::get('home/{user}/edituser', 'HomeController@edit');//displays form so user can edit some of their personal details
	Route::put('home/{user}', 'HomeController@update');//edit some of their personal details
	Route::patch('home/{user}', 'HomeController@update');//edit some of their personal details
});
