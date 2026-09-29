<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Area;
class AreaController extends Controller
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
        $districts = District::all();
        $arieas = Area::with('district')->get();
        return view('admin.areas.area',compact('districts','arieas'));
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
            "area" => "required",
            "district_id" => "required",
        ]);

        Area::create([
            "area" => isset($data['area']) ? $data['area']:null,
            "district_id" =>isset($data['district_id']) ? $data['district_id']:null
        ]); 

       return back()->with('success','Area Added successfully');
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
    public function edit()
    {
        $area = Area::findOrfail($_GET['area']);
        $districts = District::all();
        return view('admin.areas.edit_area',compact('area','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $data = $request->validate([
            "area" => "required",
            "district_id" => "required",
        ]);

        $area->update([
            "area" => isset($data['area']) ? $data['area']:null,
            "district_id" =>isset($data['district_id']) ? $data['district_id']:null
        ]); 

       return back()->with('success','<div class="alert alert-success"> Area Update successfully </div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return back()->with('success','<div class="alert alert-success"> Area Delete successfully </div>'); 
    }
}
