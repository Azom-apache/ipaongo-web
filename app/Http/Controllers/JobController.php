<?php

namespace App\Http\Controllers;

use App\Job;
use Image;
use Auth;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::latest()->paginate(20);
        return view('admin.jobs.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
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
            $image = 'job_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/jobs'), $image);  
            $img = Image::read(public_path('uploads/jobs/'.$image))->resize(1280,500);
            $img->save();   
        }

        $job = Job::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "image" => $image,
            "description" => isset($data['description']) ? $data['description']:null,
            "status" => 1,
            "verify_by" => Auth::id()
        ]);

        return back()->with('success','<div class="alert alert-success">Job Added Successfull</div>');
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
        return view('admin.jobs.edit',compact('job'));
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
            request()->image->move(public_path('uploads/jobs'), $image);  
            $img = Image::read(public_path('uploads/jobs/'.$image))->resize(1280,500);
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
    public function destroy(Job $job)
    {   
        $job->delete();
        return back()->with('success','<div class="alert alert-danger">Job Removed</div>');
    }
}
