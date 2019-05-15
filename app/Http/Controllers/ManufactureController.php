<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ManufactureController extends Controller
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
        $manufactures = DB::table('tbl_manufacture')->get();
        return view('admin.manufacture.index', compact('manufactures'));
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
        return view('admin.manufacture.create');
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
            'manufacture_name' => 'required|string',
            'manufacture_description' => 'required'
        ]);

        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;
    
    
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/
    

        DB::table('tbl_manufacture')->insert($data);

        return redirect( route('manufacture.index') )->with('successMsg', 'Manufacture successfully added.');
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
        $manufacture = DB::table('tbl_manufacture')
                ->where('manufacture_id', $id)
                ->first();
        return view('admin.manufacture.edit', compact('manufacture'));
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
            'manufacture_name' => 'required|string',
            'manufacture_description' => 'required'
        ]);

        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        
        //print_r($data);
        DB::table('tbl_manufacture')
                ->where('manufacture_id', $id)
                ->update($data);
        return redirect(route('manufacture.index'))->with('successMsg', 'Manufacture updated successfully.');
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
        DB::table('tbl_manufacture')
                ->where('manufacture_id', $id)
                ->delete();
        return redirect(route('manufacture.index'))->with('successMsg', 'Manufacture deleted successfully.');
    }

    /**
    * Change publication status on
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */
    public function publish($id)
    {
        DB::table('tbl_manufacture')
                ->where('manufacture_id', $id)
                ->update(['publication_status' => 1]);
        return redirect()->back()->with('successMsg', 'Manufacture successfully published.');
    }

    /**
    * Change publication status off
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */

    public function unpublish($id)
    {
        DB::table('tbl_manufacture')
                ->where('manufacture_id', $id)
                ->update(['publication_status' => 0]);
        return redirect()->back()->with('successMsg', 'Manufacture successfully unpublished.');
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
