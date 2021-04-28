<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
    |--------------------------------------------------------------------------
    | Pages Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles displaying the homepage
    |
    */
class PagesController extends Controller
{
	/**
	 * Displays the index-homepage
	 */
    public function index(){
    	return view('pages.index');
    }
}
