<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    //

    public function index()
    {
    	return view('admin.login');
    }

    public function dashboard(Request $request)
    {
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('tbl_admin')
    			->where('admin_email', $admin_email)
    			->where('admin_password', $admin_password)
    			->first();
    		if ($result) {
    			session_start();
    			Session::put('admin_id', $result->admin_id);
    			Session::put('admin_name', $result->admin_name);

    			return Redirect::to( route('dashboard') );

    		}
    		else {
    			Session::put('message', 'Email or Password Invalid.');

    			return Redirect::to( route('login') );
    		}


    	//return view('pages.back.dashboard');
    }

    public function show_dashboard()
    {
    	return view('pages.back.dashboard');
    }
}
