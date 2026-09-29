<?php

namespace App\Http\Controllers;

use App\Notice;
use Image;
use Auth;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::latest()->paginate(20);
        return view('admin.notice.index',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notice.create');
        //
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
            'title' => "required",
            'image' => "required|image|mimes:jpg,png,jpeg,gif",
            'description' => "required"
        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'notice_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/notice'), $image);  
            $img = Image::read(public_path('uploads/notice/'.$image))->resize(1280,500);
            $img->save();   
        }

        $job = Notice::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "image" => $image,
            "description" => isset($data['description']) ? $data['description']:null,
            "status" => 1,
            "verify_by" => Auth::id()
        ]);

        return back()->with('success','<div class="alert alert-success">Notice Added Successfull</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {   
        return view('admin.notice.edit',compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        
        $data = $request->validate([
            'title' => "required",
            'image' => "nullable|image|mimes:jpg,png,jpeg,gif",
            'description' => "required",
            "old_image" => "nullable",
            "status" => "required"
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'job_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/notice'), $image);  
            $img = Image::read(public_path('uploads/notice/'.$image))->resize(1280,500);
            $img->save();   
        }

        $job->update([
            "title" => isset($data['title']) ? $data['title']:null,
            "image" => $image,
            "description" => isset($data['description']) ? $data['description']:null,
            "status" => isset($data['status']) ? $data['status']:0,
            "verify_by" => Auth::id()
        ]);

        return back()->with('success','<div class="alert alert-success">Updated</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {   
        $notice->delete();
        return back()->with('success','<div class="alert alert-danger">Notice Removed</div>');
    }
}
