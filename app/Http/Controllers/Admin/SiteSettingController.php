<?php

namespace App\Http\Controllers\Admin;

use App\SiteSetting;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settingCount = DB::table('site_settings')->count();

        if(!$settingCount ){
            return view('admin.setting.create');
        }

        $setting = DB::table('site_settings')->first();


        return view('admin.setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settingCount = DB::table('site_settings')->count();

        if($settingCount){
            return view('admin.setting.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settingCount = DB::table('site_settings')->count();

        if($settingCount){
            return view('admin.setting.create');
        }

        $data = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'tagline' => 'required|max:2000',
            'keywords' => 'nullable|max:10000',
            'description' => 'nullable|max:10000',
            'email' => 'required|email|max:255',
            'mobile' => 'required|max:15',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100',
        ]);

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            // $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';
            $ModifiedFileNameWithExtension = 'logo'.'.'.$fileExtension;

            $image = Image::read($file->getRealPath());

            $save_path=public_path('img/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            // ->encode('jpg', 100)
            $image->save($pathWithFileName);
        }


        $setting = SiteSetting::create([
            'title' => $data['title'],
            'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : null,
            'tagline' => isset($data['tagline']) ? $data['tagline'] : null,
            'logo' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : 'No_Logo.png',
            'keywords' => isset($data['keywords']) ? $data['keywords'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'email' => isset($data['email']) ? $data['email'] : null,
            'mobile' => isset($data['mobile']) ? $data['mobile'] : null,
            'addedby_id' => \Auth::id(),
            'editedby_id' => \Auth::id(),
        ]);

        return redirect()->route('admin.setting.index')->with('success','You have successfully updated your site setting.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'tagline' => 'required|max:2000',
            'keywords' => 'nullable|max:10000',
            'description' => 'nullable|max:10000',
            'email' => 'required|email|max:255',
            'mobile' => 'required|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:100',
        ]);

        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            // $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';
            $ModifiedFileNameWithExtension = 'logo'.'.'.$fileExtension;

            $image = Image::read($file->getRealPath());

            $save_path=public_path('img/');

            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            // ->encode('jpg', 100)
            $image->save($pathWithFileName);
        }


        $setting = SiteSetting::first();

        $setting = tap($setting)->update([
            'title' => $data['title'],
            'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : null,
            'tagline' => isset($data['tagline']) ? $data['tagline'] : null,
            'logo' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : $setting->logo,
            'keywords' => isset($data['keywords']) ? $data['keywords'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'email' => isset($data['email']) ? $data['email'] : null,
            'mobile' => isset($data['mobile']) ? $data['mobile'] : null,
            'addedby_id' => \Auth::id(),
            'editedby_id' => \Auth::id(),
        ]);

        return redirect()->route('admin.setting.index')->with('success','You have successfully updated your site setting.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $siteSetting)
    {
        //
    }
}
