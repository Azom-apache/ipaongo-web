<?php

namespace App\Http\Controllers;

use App\Slider;
use Image;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(20);
        return view('admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.sliders.create');
        
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
            "image" => "required|image|mimes:jpg,png,jpeg,gif",
            "title" => "nullable|max:100",
            "title_two" => "nullable|max:100",
            "caption" => "nullable",
        ]);
        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'slider_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/sliders'), $image);  
            $img = Image::read(public_path('uploads/sliders/'.$image));
            $img->save();      
        }
        Slider::create([
            "caption" => isset($data['caption']) ? $data['caption']:null,
            "title" => isset($data['title']) ? $data['title']:null,
            "title_two" => isset($data['title_two']) ? $data['title_two']:null,
            "image" => $image
        ]);
        return back()->with('success','Slider Image added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
       $slider = Slider::where('id',$slider->id)->first();
        
        return view('admin.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
        ]);
        $image = $slider->image;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'slider_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/sliders'), $image);  
            $img = Image::read(public_path('uploads/sliders/'.$image));
            $img->save();
        }
		
        Slider::where('id',$slider->id)->update([
			"title"=> $request->title,
			"title_two"=> $request->title_two,
			"caption"=> $request->caption,
			"image" => $image,
			"title" => $request->title,
        ]);
        return back()->with('success',' Slider  Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if(!empty($slider->image)){
            if(file_exists(public_path('uploads/sliders/'.$slider->image))){
                unlink(public_path('uploads/sliders/'.$slider->image));
            }
        }
        $slider->delete();
        return back()->with('success',' Slider Image deleted');
    }
}
