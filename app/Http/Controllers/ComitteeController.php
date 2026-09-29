<?php

namespace App\Http\Controllers;

use App\Comittee;
use Image;
use Illuminate\Http\Request;

class ComitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $comittees = Comittee::orderBy('created_at','DESC')
            ->orderBy('position','ASC')
            ->paginate(15);
        return view('admin.comittees.index',compact('comittees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.comittees.create');
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
            "name" => "required",
            "comittee_type" => "required",
            "factory" => "required",
            "email" => "nullable",
            "mobile" => "nullable",
            "designation" => "required",
            "bio_graphy" => "nullable",
            "address"  => "nullable",
            "image" => "required|image|mimes:jpg,png,jpeg,gif"

        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/comittees'), $image);  
            $img = Image::read(public_path('uploads/comittees/'.$image))->resize(350,450);
            $img->save();   
        }

        $position = Comittee::count() + 1;
        Comittee::create([
            "name" => isset($data['name']) ? $data['name']:null,            
            "factory" => isset($data['factory']) ? $data['factory']:null,           
            "comittee_type" => isset($data['comittee_type']) ? $data['comittee_type']:null,            
            "email" => isset($data['email']) ? $data['email']:null,            
            "mobile" => isset($data['mobile']) ? $data['mobile']:null,            
            "designation" => isset($data['designation']) ? $data['designation']:null,            
            "bio_graphy" => isset($data['bio_graphy']) ? $data['bio_graphy']:null,            
            "address" => isset($data['address']) ? $data['address']:null,            
            "image" => $image,
            'position' => $position   
        ]);

        return back()->with('success','Comittee Added ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comittee  $comittee
     * @return \Illuminate\Http\Response
     */
    public function show(Comittee $comittee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comittee  $comittee
     * @return \Illuminate\Http\Response
     */
    public function edit(Comittee $comittee)
    {
        return view('admin.comittees.edit',compact('comittee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comittee  $comittee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comittee $comittee)
    {
       
        $data = $request->validate([
            "name" => "required",
            "email" => "nullable",
            "factory" => "nullable",
            "mobile" => "nullable",
            "designation" => "required",
            "bio_graphy" => "nullable",
            "address"  => "nullable",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "old_image" => "nullable",
            "position" => "required"

        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/comittees'), $image);  
            $img = Image::read(public_path('uploads/comittees/'.$image))->resize(350,450);
            $img->save();      

        }

        
        $comittee->update([
            "name" => isset($data['name']) ? $data['name']:null,            
            "factory" => isset($data['factory']) ? $data['factory']:null,            
            "email" => isset($data['email']) ? $data['email']:null,            
            "mobile" => isset($data['mobile']) ? $data['mobile']:null,            
            "designation" => isset($data['designation']) ? $data['designation']:null,            
            "bio_graphy" => isset($data['bio_graphy']) ? $data['bio_graphy']:null,            
            "address" => isset($data['address']) ? $data['address']:null,            
            "image" => $image,
            'position' => isset($data['position']) ? $data['position']:null   
        ]);

        return back()->with('success','<div class="alert alert-success"> Comittee Updated </div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comittee  $comittee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comittee $comittee)
    {
        // dd($comittee);
           $comittee->delete();
           return back()->with('success','<div class="alert alert-success"> Comittee Deleted </div>');
    }
    
    public function getAdvisors()
    {
        $comittees = Comittee::where('comittee_type',2)->orderBy('position','ASC')->paginate(15);
        return view('admin.comittees.advisors',compact('comittees'));
    }
    
    public function getAllExecutives()
    {
       $comittees = Comittee::where('comittee_type',1)->orderBy('position','ASC')->paginate(15);
        return view('web.executive',compact('comittees'));
    }
    
    public function getAllAdvisors()
    {
        $comittees = Comittee::where('comittee_type',2)->orderBy('position','ASC')->paginate(15);
        return view('web.advisor',compact('comittees'));
    }
}
