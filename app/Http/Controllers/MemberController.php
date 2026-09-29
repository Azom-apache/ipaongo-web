<?php

namespace App\Http\Controllers;

use App\Member;
use App\Profile;
use Image;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('position','ASC')->get();
        return view('admin.members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.members.create');
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
            "email" => "nullable",
            "mobile" => "nullable",
            "facebook" => "nullable",
            "designation" => "required",
            "bio_graphy" => "required",
            "address"  => "nullable",
            "image" => "required|image|mimes:jpg,png,jpeg,gif"

        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/members'), $image);
            $img = Image::read(public_path('uploads/members/'.$image))->resize(350,450);
            $img->save();
        }

        $position = Member::count() + 1;
        Member::create([
            "name" => isset($data['name']) ? $data['name']:null,
            "email" => isset($data['email']) ? $data['email']:null,
            "mobile" => isset($data['mobile']) ? $data['mobile']:null,
            "facebook" => isset($data['facebook']) ? $data['facebook']:null,
            "designation" => isset($data['designation']) ? $data['designation']:null,
            "bio_graphy" => isset($data['bio_graphy']) ? $data['bio_graphy']:null,
            "address" => isset($data['address']) ? $data['address']:null,
            "image" => $image,
            'position' => $position
        ]);
        return back()->with('success',' Member Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            "name" => "required",
            "mobile" => "nullable",
            "email" => "nullable",
            "facebook" => "nullable",
            "designation" => "required",
            "bio_graphy" => "required",
            "address"  => "nullable",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "old_image" => "nullable"
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/members'), $image);
            $img = Image::read(public_path('uploads/members/'.$image))->resize(350,450);
            $img->save();

        }


        $member->update([
            "name" => isset($data['name']) ? $data['name']:null,
            "designation" => isset($data['designation']) ? $data['designation']:null,
            "bio_graphy" => isset($data['bio_graphy']) ? $data['bio_graphy']:null,
            "mobile" => isset($data['mobile']) ? $data['mobile']:null,
            "email" => isset($data['email']) ? $data['email']:null,
            "facebook" => isset($data['facebook']) ? $data['facebook']:null,
            "image" => $image
        ]);

        return back()->with('success','<div class="alert alert-success"> Member Updated </div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($member)
    {
        $profile = Member::where('id', $member)->first();
        $profile->delete();
        return back()->with('success', 'Successfully DELETE Member');
    }
}
