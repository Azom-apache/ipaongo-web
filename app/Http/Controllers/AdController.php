<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use Image;
class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::latest()->paginate(20);
        return view('admin.ads.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.create');
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
            "type" => "required",
            "area" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "code" => "nullable"
        ]);
        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $data['area'].'_ads_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/ads'), $image);  
        }

        Ad::create([
            "image" => $image,
            'code'  => isset($data['code']) ? $data['code']:null,
            'area'  => isset($data['area']) ? $data['area']:null,
            'ad_type'  => isset($data['type']) ? $data['type']:null,
        ]);

      return back()->with('success','Add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('admin.ads.edit',compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
         $data = $request->validate([
            "type" => "required",
            "area" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "code" => "nullable",
            "old_image" => "nullable"
        ]);
        
        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $data['area'].'_ads_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/ads'), $image);  
        }

        $ad->update([
            "image" => $image,
            'code'  => isset($data['code']) ? $data['code']:null,
            'area'  => isset($data['area']) ? $data['area']:null,
            'ad_type'  => isset($data['type']) ? $data['type']:null,
        ]);

      return back()->with('success','<div class="alert alert-success"> Add Updated successfully </div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }
}
