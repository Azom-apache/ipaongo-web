<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::orderBy('district_name','ASC')->get();
        return view('admin.areas.district',compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "district_name" => "required",
        ]);

        District::create([
            "district_name" => isset($data['district_name']) ? $data['district_name']:null,
        ]);

       return back()->with('success','<div class="alert alert-success">District Added successfully</div>');
    }

    public function ajaxDistrict(){
        $district_id =  $_GET['district'];
        $district = District::findOrFail($district_id);
        return view('admin.areas.edit_district',compact('district'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
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
    public function update(Request $request, District $district)
    {
        $data = $request->validate([
            "district_name" => "required",
        ]);

        $district->update([
            "district_name" => isset($data['district_name']) ? $data['district_name']:null,
        ]);

       return back()->with('success','<div class="alert alert-success">District Updated successfully</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        return back()->with('success','<div class="alert alert-success">District Deleted successfully</div>'); 
    }
}
