<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;

class SuperAdminController extends Controller
{
    //
    public function index()
    {
    	$this->AdminAuthCheck();
    	return view('pages.back.dashboard');
    }

    public function logout()
    {
    	//Session::put('admin_id', null);
    	//Session::put('admin_name', null);

    	Session::flush();
    	
    	return Redirect::to( route('login') );
    }

    public function AdminAuthCheck()
    {
    	$admin_id = Session::get('admin_id');
    	if ($admin_id) {
    		return;
    	} else{
    		return redirect(route('login'))->send();
    	}
    }

}
