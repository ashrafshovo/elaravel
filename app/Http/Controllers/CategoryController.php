<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = DB::table('tbl_categories')->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
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
            'category_name' => 'required|string',
            'category_description' => 'required'
        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;
    
    /*
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    */

        DB::table('tbl_categories')->insert($data);

        return redirect( route('category.index') )->with('successMsg', 'Category successfully added.');
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
        $category = DB::table('tbl_categories')
    			->where('category_id', $id)
    			->first();
        return view('admin.category.edit', compact('category'));
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
        //echo $id;

        $this->validate( $request, [
            'category_name' => 'required|string',
            'category_description' => 'required'
        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        
        //print_r($data);
        DB::table('tbl_categories')
                ->where('category_id', $id)
                ->update($data);
        return redirect(route('category.index'))->with('successMsg', 'Category updated successfully.');
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
        DB::table('tbl_categories')
                ->where('category_id', $id)
                ->delete();
        return redirect(route('category.index'))->with('successMsg', 'Category deleted successfully.');
    }

    /**
    * Change publication status on
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */
    public function publish($id)
    {
    	DB::table('tbl_categories')
    			->where('category_id', $id)
    			->update(['publication_status' => 1]);
    	return redirect()->back()->with('successMsg', 'Category successfully published.');;
    }

    /**
    * Change publication status off
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */

    public function unpublish($id)
    {
    	DB::table('tbl_categories')
    			->where('category_id', $id)
    			->update(['publication_status' => 0]);
    	return redirect()->back()->with('successMsg', 'Category successfully unpublished.');;
    }
}
