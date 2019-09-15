<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

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
        $this->AdminAuthCheck();
        $products = DB::table('tbl_products')
                ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
                ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                ->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacture.manufacture_name')
                ->get();

    /*  
        echo "<pre>";
        print_r($products);
        echo "</pre>";
    */
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
        $this->AdminAuthCheck();
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
            'product_image' => 'required|image',
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

        Toastr::success('Product successfully added.', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect( route('product.index') )/*->with('successMsg', 'Product successfully added.')*/;
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
        $this->AdminAuthCheck();
        $product = DB::table('tbl_products')
                ->join('tbl_categories', 'tbl_products.category_id', '=', 'tbl_categories.category_id')
                ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                ->select('tbl_products.*', 'tbl_categories.category_name', 'tbl_manufacture.manufacture_name')
                ->where('product_id', $id)
                ->first();

        $categories = DB::table('tbl_categories')
                    ->get();

        $manufactures = DB::table('tbl_manufacture')
                    ->get();

        return view('admin.product.edit', compact('product', 'categories', 'manufactures'));
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

        $product = DB::table('tbl_products')
                ->where('product_id', $id)
                ->first();

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $ext = $image->getClientOriginalExtension();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$ext;

            if (!file_exists('uploads/product')) {
                mkdir('uploads/product', 0777, true);
            }
            if (file_exists('uploads/product/'.$product->product_image)) {
                unlink('uploads/product/'. $product->product_image);
            }
            $image->move('uploads/product', $imageName);
        } else {
            $imageName = $product->product_image;
        }

        $data['product_image'] = $imageName;
    
    /*
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    */

        DB::table('tbl_products')
            ->where('product_id', $id)
            ->update($data);

        Toastr::success('Product successfully updated.', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect( route('product.index') )/*->with('successMsg', 'Product successfully updated.')*/;
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

        $product = DB::table('tbl_products')
                ->where('product_id', $id)
                ->first();

        if (file_exists('uploads/product/'.$product->product_image)) {
            unlink('uploads/product/'.$product->product_image);
        }

        DB::table('tbl_products')
                ->where('product_id', $id)
                ->delete();

        Toastr::success('Product successfully deleted.', 'Success', ["positionClass" => "toast-top-right"]);
        
        return redirect(route('product.index'))/*->with('successMsg', 'Product deleted successfully.')*/;
    }

    /**
    * Change publication status on
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */
    public function publish($id)
    {
        DB::table('tbl_products')
                ->where('product_id', $id)
                ->update(['publication_status' => 1]);
        return redirect()->back()->with('successMsg', 'Product successfully published.');
    }

    /**
    * Change publication status off
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */

    public function unpublish($id)
    {
        DB::table('tbl_products')
                ->where('product_id', $id)
                ->update(['publication_status' => 0]);
        return redirect()->back()->with('successMsg', 'Product successfully unpublished.');
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
