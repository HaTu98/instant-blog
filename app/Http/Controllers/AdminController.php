<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class AdminController extends Controller
{
    public function index() {
    	$slug = Sentinel::getUser()->roles()->first()->slug;
    	if($slug == 'admin') {
    		return view('Admin.index');
    	} else {
    		return redirect()->back();
    	}
    }
}