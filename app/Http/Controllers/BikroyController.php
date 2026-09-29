<?php

namespace App\Http\Controllers;

use App\Bikroy;
use Auth;
use Illuminate\Http\Request;
use Image;
class BikroyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $bikrois = Bikroy::latest()->paginate(20);
        return view('admin.bikroy.index',compact('bikrois'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bikroy.create');
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
            "title" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg,gif",
            "description" => "required"            
        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/buy_sale'), $image);  
            $img = Image::read(public_path('uploads/buy_sale/'.$image))->resize(1280,500);
            $img->save();      

        }
        Bikroy::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'user_id' => Auth::id(),
            'status' => 1
        ]);

        return back()->with('success','<div class="alert alert-success"> Bikroy Added Successfully </div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bikroy  $bikroy
     * @return \Illuminate\Http\Response
     */
    public function show(Bikroy $bikroy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bikroy  $bikroy
     * @return \Illuminate\Http\Response
     */
    public function edit(Bikroy $bikroy)
    {
        return view('admin.bikroy.edit',compact('bikroy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bikroy  $bikroy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bikroy $bikroy)
    {
        $data = $request->validate([
            "title" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "required",
            'old_image' => 'nullable' ,
            "status" => "required"    
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/buy_sale'), $image);  
            $img = Image::read(public_path('uploads/buy_sale/'.$image))->resize(1280,500);
            $img->save();      

        }
        $bikroy->update([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'user_id' => Auth::id(),
            'status' => isset($data['status']) ? $data['status']:0,
        ]);

        return back()->with('success','<div class="alert alert-success"> Bikroy Post Updated Successfully </div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bikroy  $bikroy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bikroy $bikroy)
    {
        $bikroy->delete();
         return back()->with('success','<div class="alert alert-success">Bikroy Post Deleted</div>');
    }
}
