<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    //

    public function index()
    {
    	$categories = DB::table('tbl_categories')
    				->where('publication_status', 1)
    				->get();
    	$manufactures = DB::table('tbl_manufacture')
    				->where('publication_status', 1)
    				->get();
        $featured_products = DB::table('tbl_products')
                          ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
                          ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                          ->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacture.manufacture_name')
                          ->where('tbl_products.publication_status', 1)
                          ->orderBy('product_id', 'desc')
                          ->limit(9)
                          ->get();
    	return view('pages.front.home', compact('categories', 'manufactures', 'featured_products'));
    }
    
}
