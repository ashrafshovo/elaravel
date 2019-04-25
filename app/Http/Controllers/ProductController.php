<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = DB::table('tbl_products')->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = DB::table('tbl_categories')
                    ->get();
        $manufactures  = DB::table('tbl_manufacture')
                    ->get();

        return view('admin.product.create', compact('categories', 'manufactures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate( $request, [
            'product_name' => 'required|string',
            'category_id' => 'required',
            'manufacture_id' => 'required',
            'product_short_description' => 'required',
            'product_long_description' => 'required',
            'product_price' => 'required',
            'product_color' => 'required'
        ]);



        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        
        $image = $request->file('product_image');
        $slug = str_slug($request->product_name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $ext = $image->getClientOriginalExtension();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$ext;

            if (!file_exists('uploads/product')) {
                mkdir('uploads/product', 0777, true);
            }
            $image->move('uploads/product', $imageName);
        } else {
            $imageName = '';
        }

        $data['product_image'] = $imageName;
    
    /*
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    */

        DB::table('tbl_products')->insert($data);

        return redirect( route('product.index') )->with('successMsg', 'Product successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
