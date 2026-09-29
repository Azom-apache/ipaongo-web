<?php

namespace App\Http\Controllers;

use App\Setting;
use Image;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index',compact('setting'));
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
        $data = $request->validate([
            "site_title" => "nullable",            
            "domain_name" => "nullable",  

            "address_1" => "required",            
            "address_2" => "nullable",            
            "email" => "required",            
            "contact_email" => "nullable",            
            "mobile" => "required",            
            "mobile_2" => "nullable",            
            "map" => "nullable", 

            "facebook" => "required",            
            "youtube" => "required",            
            "twitter" => "required",            
            "linkedin" => "required", 
            "instagram" => "required", 

            "logo" => "nullable|image|mimes:jpg,png,jpeg,gif",            
            "old_logo" => "nullable",            
            "favicon" => "nullable|image|mimes:jpg,png,jpeg,gif|ico",   
             "old_favicon" => "nullable",   

             "welcome_title" => "nullable",
             "welcome_message" => "nullable",
             
             "successfull_project" => "required",
             "people_impact" => "required",
             "money_donate" => "required",
             "total_volunteer" => "required",
             "food" => "required",
             "cloth" => "required",
             "other" => "required"        
                      
        ]);
        $logo = isset($data['old_logo']) ? $data['old_logo']:null;
        if($request->hasFile('logo')){
           $file = $request->file('logo');
           $logo = 'logo'.time().'.'.$file->getClientOriginalExtension();
           request()->logo->move(public_path('uploads/setting'), $logo);  
           $img = Image::read(public_path('uploads/setting/'.$logo));
           $img->save();              
        }

        $favicon = isset($data['old_favicon']) ? $data['old_favicon']:null;
        if($request->hasFile('favicon')){
           $file = $request->file('favicon');
           $favicon = 'favicon'.time().'.'.$file->getClientOriginalExtension();
           request()->favicon->move(public_path('uploads/setting'), $favicon);  
           $img = Image::read(public_path('uploads/setting/'.$favicon));
           $img->save();              
        }
        
        

        $setting  =  Setting::where('id',1)->first();
        if($setting ){
            $setting->update([
                "site_title" => isset($data['site_title']) ? $data['site_title']:null,
                "domain_name" => isset($data['domain_name']) ? $data['domain_name']:null,
                "address_1" => isset($data['address_1']) ? $data['address_1']:null,
                "address_2" => isset($data['address_2']) ? $data['address_2']:null,
                "mobile" => isset($data['mobile']) ? $data['mobile']:null,
                "mobile_2" => isset($data['mobile_2']) ? $data['mobile_2']:null,
                "email" => isset($data['email']) ? $data['email']:null,
                "contact_mail" => isset($data['contact_email']) ? $data['contact_email']:null,
                "facebook" => isset($data['facebook']) ? $data['facebook']:null,
                "youtube" => isset($data['youtube']) ? $data['youtube']:null,
                "twitter" => isset($data['twitter']) ? $data['twitter']:null,
                "linkedin" => isset($data['linkedin']) ? $data['linkedin']:null,
                "instagram" => isset($data['instagram']) ? $data['instagram']:null,
                "map" => isset($data['map']) ? $data['map']:null,
                "logo" => $logo,
                "favicon" => $favicon,
                'welcome_message' => isset($data['welcome_message']) ? $data['welcome_message']:null,
                'welcome_title' => isset($data['welcome_title']) ? $data['welcome_title']:null,
                
                'successfull_project' => isset($data['successfull_project']) ? $data['successfull_project']:null,
                'people_impact' => isset($data['people_impact']) ? $data['people_impact']:null,
                'money_donate' => isset($data['money_donate']) ? $data['money_donate']:null,
                'total_volunteer' => isset($data['total_volunteer']) ? $data['total_volunteer']:null,
                'food' => isset($data['food']) ? $data['food']:null,
                'cloth' => isset($data['cloth']) ? $data['cloth']:null,
                'other' => isset($data['other']) ? $data['other']:null
            ]);
            return back()->with('success','Setting Information Updated');
        }else{
            Setting::create([
                "site_title" => isset($data['site_title']) ? $data['site_title']:null,
                "domain_name" => isset($data['domain_name']) ? $data['domain_name']:null,
                "address_1" => isset($data['address_1']) ? $data['address_1']:null,
                "address_2" => isset($data['address_2']) ? $data['address_2']:null,
                "mobile" => isset($data['mobile']) ? $data['mobile']:null,
                "mobile_2" => isset($data['mobile_2']) ? $data['mobile_2']:null,
                "email" => isset($data['email']) ? $data['email']:null,
                "contact_mail" => isset($data['contact_email']) ? $data['contact_email']:null,
                "facebook" => isset($data['facebook']) ? $data['facebook']:null,
                "youtube" => isset($data['youtube']) ? $data['youtube']:null,
                "twitter" => isset($data['twitter']) ? $data['twitter']:null,
                "linkedin" => isset($data['linkedin']) ? $data['linkedin']:null,
                "instagram" => isset($data['instagram']) ? $data['instagram']:null,
                "map" => isset($data['map']) ? $data['map']:null,
                "logo" => $logo,
                "favicon" => $favicon,
                'welcome_message' => isset($data['welcome_message']) ? $data['welcome_message']:null,
                'welcome_title' => isset($data['welcome_title']) ? $data['welcome_title']:null,
                'successfull_project' => isset($data['successfull_project']) ? $data['successfull_project']:null,
                'people_impact' => isset($data['people_impact']) ? $data['people_impact']:null,
                'money_donate' => isset($data['money_donate']) ? $data['money_donate']:null,
                'total_volunteer' => isset($data['total_volunteer']) ? $data['total_volunteer']:null,
                'food' => isset($data['food']) ? $data['food']:null,
                'cloth' => isset($data['cloth']) ? $data['cloth']:null,
                'other' => isset($data['other']) ? $data['other']:null
            ]);
            return back()->with('success','Setting Information Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
