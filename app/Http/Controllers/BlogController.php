<?php

namespace App\Http\Controllers;

use App\Blog;
use Image;
use Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $blogs = Blog::latest()->paginate(15);
        return view('admin.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
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
            "status" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg,gif",
            "description" => "required"            
        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/blogs'), $image);  
            $img = Image::read(public_path('uploads/blogs/'.$image))->resize(1280,500);
            $img->save();      

        }
        Blog::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "status" => isset($data['status']) ? $data['status']:null,
            "status" => isset($data['status']) ? $data['status']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'user_id' => Auth::id()
        ]);

        return back()->with('success','Blog Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            "title" => "required",
            "status" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "required",
            "old_image" => "nullable"      
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/blogs'), $image);  
            $img = Image::read(public_path('uploads/blogs/'.$image))->resize(1280,500);
            $img->save();      

        }
        $blog->update([
            "title" => isset($data['title']) ? $data['title']:null,
            "status" => isset($data['status']) ? $data['status']:null,
            "status" => isset($data['status']) ? $data['status']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard.blogs.index')->with('success',' Blog Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if(!empty($blog->image) && $blog->imager != null ){
            if(file_exists(public_path('uplodas/blogs/'.$blog->image))){
                unlink(public_path('uploads/blogs/'.$blog->image));
            }
        }
        $blog->delete();
        return redirect()->route('dashboard.blogs.index')->with('success','Blog Post Deleted Successfully');
    }
}
