<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;

class SuperAdminController extends Controller
{
    //
    public function logout()
    {
    	//Session::put('admin_id', null);
    	//Session::put('admin_name', null);

    	Session::flush();
    	
    	return Redirect::to( route('login') );
    }
}
