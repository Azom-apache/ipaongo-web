<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Image;
use Auth;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advertisement::latest()->paginate(20);
        return view('admin.advertisements.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisements.create');
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
            request()->image->move(public_path('uploads/advertisements'), $image);  
                

        }
        Advertisement::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'user_id' => Auth::id(),
            'status' => 1
        ]);

        return back()->with('success',' Advertisement Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisements.edit',compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $data = $request->validate([
            "title" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "nullable",
            "old_image" => "nullable",
            'status' => "required"           
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/advertisements'), $image);  
               

        }
        $advertisement->update([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'user_id' => Auth::id(),
            'status' => isset($data['status']) ? $data['status']:0
        ]);

        return back()->with('success','Advertisement Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return back()->with('success','Advertisement Updated Delete');
    }
}
