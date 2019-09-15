<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    //

    public function index()
    {
        $sliders = DB::table('tbl_slider')
                 ->where('publication_status', 1)
                 ->get();
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
    	return view('pages.front.home', compact('sliders', 'categories', 'manufactures', 'featured_products'));
    }

    public function category_product($id)
    {
        $sliders = null;
        $categories = DB::table('tbl_categories')
                    ->where('publication_status', 1)
                    ->get();
        $manufactures = DB::table('tbl_manufacture')
                    ->where('publication_status', 1)
                    ->get();
        $category = DB::table('tbl_categories')
                ->where('category_id', $id)
                ->where('publication_status', 1)
                ->first();
        $products = DB::table('tbl_products')
                          ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
                          ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                          ->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacture.manufacture_name')
                          ->where('tbl_products.publication_status', 1)
                          ->where('tbl_categories.category_id', $id)
                          ->orderBy('product_id', 'desc')
                          ->limit(18)
                          ->get();
        //dd($category);

        return view('pages.front.category', compact('sliders', 'categories', 'manufactures','category', 'products'));
    }

    public function manufacture_product($id)
    {
        $sliders = null;
        $categories = DB::table('tbl_categories')
                    ->where('publication_status', 1)
                    ->get();
        $manufactures = DB::table('tbl_manufacture')
                    ->where('publication_status', 1)
                    ->get();
        $manufacture = DB::table('tbl_manufacture')
                ->where('manufacture_id', $id)
                ->where('publication_status', 1)
                ->first();
        $products = DB::table('tbl_products')
                          ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
                          ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                          ->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacture.manufacture_name')
                          ->where('tbl_products.publication_status', 1)
                          ->where('tbl_manufacture.manufacture_id', $id)
                          ->orderBy('product_id', 'desc')
                          ->limit(18)
                          ->get();
        //dd($category);

        return view('pages.front.manufacture', compact('sliders', 'categories', 'manufactures','manufacture', 'products'));
    }
    
}
