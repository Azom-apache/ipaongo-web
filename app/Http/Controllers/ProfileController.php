<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Department;
use App\BloodDoner;
use App\District;
use App\Area;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::latest()->paginate(50);
        return view('admin.profiles.index',compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $districts  = District::all();
        return view('admin.profiles.edit',compact('profile','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
          $data = $request->validate([
            "name" => "required",
            "batch" => "required",
            "department_id" => "required",
            "company" => "required",
            "present_address" => "required",
            "permanent_address" => "required",
            "district_id" => "required",
            "area_id" => "required",
            "mobile" => "required",
            "blood_group" => "nullable",
            "education" => "nullable",
            "email" => "nullable|unique:profiles,username,".$profile->id,
            "password" => "nullable",
            "job_history" => "nullable",
            "image" => "nullable|image:jpg,png,jpeg,gif",
            'designation' => 'nullable',
            "institute_name" => "nullable",
            'email_address' => "nullable",
            "old_image" => "nullable",
           

        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'profile_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/profiles'), $image);  
            $img = Image::read(public_path('uploads/profiles/'.$image))->resize(360,360);
            $img->save();      

        }
        if(isset($data['password'])){
            $attr = [
                "name" => $data['name'],
                "batch" => $data['batch'],
                "department_id" => $data['department_id'],
                "company" => $data['company'],
                "present_address" => $data['present_address'],
                "permanent_address" => $data['permanent_address'],
                "district_id" => $data['district_id'],
                "area_id" => $data['area_id'],
                "mobile" => $data['mobile'],
                "blood_group" => $data['blood_group'],
                "education" => $data['education'],
                "username" => $data['email'],
                "password" => Hash::make($data['password']),
                "job_history" => isset($data['job_history']) ? $data['job_history']:null,
                'image' => $image,
                "designation" => isset($data['designation']) ? $data['designation']:null,
                'import_id' => isset($data['username']) ? $data['username']:null,
                "institute_name" => isset($data['institute_name']) ? $data['institute_name']:null,
                'email' => isset($data['email_address']) ? $data['email_address']:null
            ];

        }else{
            $attr = [
               
                "name" => $data['name'],
                "batch" => $data['batch'],
                "department_id" => $data['department_id'],
                "company" => $data['company'],
                "present_address" => $data['present_address'],
                "permanent_address" => $data['permanent_address'],
                "district_id" => $data['district_id'],
                "area_id" => $data['area_id'],
                "mobile" => $data['mobile'],
                "blood_group" => $data['blood_group'],
                "education" => $data['education'],
                "username" => $data['email'],
                "job_history" => isset($data['job_history']) ? $data['job_history']:null,
                'image' => $image,
                "designation" => isset($data['designation']) ? $data['designation']:null,
                'import_id' => isset($data['username']) ? $data['username']:null,
                "institute_name" => isset($data['institute_name']) ? $data['institute_name']:null,
                'email' => isset($data['email_address']) ? $data['email_address']:null
            ];
        }

        $profile->update($attr);
        return back()->with('success','<div class="alert alert-success"> Profile Updated successfully </div>');

    }

    public function findProfile(Request $request){
        $string = isset($_GET['string']) ? $_GET['string']:null;
        $profiles = Profile::where('name',$string.'%')->orWhere('mobile',$string)->orWhere('username',$string)->get();
        return view('admin.profiles.ajax',compact('profiles'));

    }
    
    public function exportCsv(Request $request)
    {
 
        $fileName = 'donor.csv';
        $tasks = BloodDoner::orderBy('id','asc')->get();
        
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
        
            $columns = array('Name', 'Mobile', 'Blood Group', 'Division', 'District', 'Upazila', 'Address','Member Type','Gender','Date of Birth');
        
            $callback = function() use($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
        
                foreach ($tasks as $task) {
                    $row['Name']  = $task->name;
                    $row['Mobile']    = $task->mobile;
                    $row['Email']    = $task->email;
                    $row['Blood Group']    = $task->blood_group;
                    $row['Division']  = $task->division;
                    $row['District']  = $task->district;
                    $row['Upazila']  = $task->upazila;
                    $row['Address']  = $task->address;
                    $row['Member Type']  = $task->member_type;
                    $row['Gender']  = $task->gender;
                    $row['Date of Birth']  = $task->dob;
        
                    fputcsv($file, array($row['Name'], $row['Mobile'], $row['Blood Group'], $row['Division'], $row['District'], $row['Upazila'], $row['Address'], $row['Member Type'], $row['Gender'], $row['Date of Birth']));
                }
        
                fclose($file);
            };
        
            return response()->stream($callback, 200, $headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return back()->with('success','<div class="alert alert-success"> Profile Deleted successfully </div>');
    }
}
