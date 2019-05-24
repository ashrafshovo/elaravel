<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class SliderController extends Controller
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
        $sliders = DB::table('tbl_slider')->get();
        return view('admin.slider.index', compact('sliders'));
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
        return view('admin.slider.create');
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
            'slider_name' => 'required|string',
            'slider_image' => 'image|required',
            'slider_description' => 'required'
        ]);

        $data = array();
        $data['slider_title'] = $request->slider_name;
        
        $data['slider_description'] = $request->slider_description;
        
        $image = $request->file('slider_image');
        $slug = str_slug($request->slider_name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $ext = $image->getClientOriginalExtension();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$ext;

            if (!file_exists('uploads/slider')) {
                mkdir('uploads/slider', 0777, true);
            }
            $image->move('uploads/slider', $imageName);
        } else {
            $imageName = '';
        }

        $data['slider_image'] = $imageName;

        DB::table('tbl_slider')->insert($data);

        Toastr::success('Slider successfully added.', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect( route('slider.index') );
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
        $slider = DB::table('tbl_slider')
                ->where('slider_id', $id)
                ->first();

        return view('admin.slider.edit', compact('slider'));
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
            'slider_name' => 'required|string',
            'slider_description' => 'required'
        ]);

        $data = array();
        $data['slider_title'] = $request->slider_name;
        
        $data['slider_description'] = $request->slider_description;
        
        $image = $request->file('slider_image');
        $slug = str_slug($request->slider_name);

         $slider = DB::table('tbl_slider')
                ->where('slider_id', $id)
                ->first();

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $ext = $image->getClientOriginalExtension();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$ext;

            if (!file_exists('uploads/slider')) {
                mkdir('uploads/slider', 0777, true);
            }
            $image->move('uploads/slider', $imageName);
        } else {
            $imageName = $slider->slider_image;
        }

        $data['slider_image'] = $imageName;

        DB::table('tbl_slider')
            ->where('slider_id', $id)
            ->update($data);

        Toastr::success('Slider successfully updated.', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect( route('slider.index') );

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
        $slider = DB::table('tbl_slider')
                ->where('slider_id', $id)
                ->first();

        if (file_exists('uploads/slider/'.$slider->slider_image)) {
            unlink('uploads/slider/'.$slider->slider_image);
        }

        DB::table('tbl_slider')
                ->where('slider_id', $id)
                ->delete();

        Toastr::success('Slider successfully deleted.', 'Success', ["positionClass" => "toast-top-right"]);
        
        return redirect(route('slider.index'));
    }

    /**
    * Change publication status on
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */
    public function publish($id)
    {
        DB::table('tbl_slider')
                ->where('slider_id', $id)
                ->update(['publication_status' => 1]);
        Toastr::success('Slider successfully published.', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
    * Change publication status off
    *
    *@param int $id
    *@return \Illuminate\Http\Response
    */

    public function unpublish($id)
    {
        DB::table('tbl_slider')
                ->where('slider_id', $id)
                ->update(['publication_status' => 0]);
        Toastr::success('Slider successfully unpublished.', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
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
