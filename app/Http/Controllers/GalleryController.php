<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Image;
use DB;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $gallerys = Gallery::paginate(20);
      return view('admin.gallery.index',compact('gallerys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.create');
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
// 			"parent" => "required",
            "title" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg,gif",
        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('images/gallery'), $image);
            $img = Image::read(public_path('images/gallery/'.$image))->resize(1280,500);
            $img->save();
            ######################################################
            $uploadPath = public_path('images/gallery/');
            //$file = $image;
            //$photo_jpeg = time() . '.' .$file->getClientOriginalExtension();
            //$file->move($uploadPath,$photo_jpeg);
            \File::copy($uploadPath.$image,public_path('uploads/project/').$image);
            ######################################################
        }
		$slug = $this->seo_friendly_url($data['title']);
        Gallery::create([
 			//"parent"=> $data['parent'],
            "parent"=> isset($request->parent) ? $request->parent:0,
			"image" => $image,
			"title" => isset($data['title']) ? $data['title']:null,
			"slug" => $slug
        ]);
        return back()->with('success',' Gallery Image Added Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $gallery = Gallery::where('id',$gallery->id)->first();
        
        return view('admin.gallery.edit',compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "old_image" => "nullable"
        ]);
        $image = $gallery->image;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/project/'), $image);
            $img = Image::read(public_path('uploads/project/'.$image))->resize(1280,500);
            $img->save();
        }
		
        Gallery::where('id',$gallery->id)->update([
			"parent"=> isset($request->parent) ? $request->parent :0,
			"image" => $image,
			"title" => $request->title,
        ]);
        return back()->with('success',' Gallery Image Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
       $gallery->delete();
	   return back()->with('info', 'Successfully DELETE Gallery Image');
    }
	
	public function seo_friendly_url($string){
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
    }
    public function gallery_update(Request $request)
    {
        echo $request->id;
    }
}
