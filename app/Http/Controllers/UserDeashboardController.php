<?php

namespace App\Http\Controllers;
use App\Profile;
use App\Job;
use App\Blog;
use App\Gallery;
use Session;
use Image;
use App\Bikroy;
use App\Advertisement;
use App\Department;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDeashboardController extends Controller
{
	public function __construct(){
		$this->middleware('profile');
	}
    public function index(){
        $id = Session::get('id');
        $profile = Profile::where('id', $id)->first();
    	return view('web.profiles', compact('profile'));
    }

    //Jobs
    public function jobCreate(){

    	return view('profile.create_job');
    }

    public function jobStore(Request $request){
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
    		"status" => 0,
    		"profile_id" => Session::get('id')
    	]);

    	return back()->with('success','<div class="alert alert-success">Job Added Successfull</div>');
    }

    public function myJobs(){
    	$jobs = Job::where('profile_id',Session::get('id'))->paginate(15);
    	return view('profile.jobs',compact('jobs'));
    }

    public function editJob(Job $job){
    	return view('profile.edit_job',compact('job'));
    }

    public function jobUpdate(Request $request, Job $job){
    	$data = $request->validate([
    		'title' => "required",
    		'image' => "nullable|image|mimes:jpg,png,jpeg,gif",
    		'description' => "required",
    		"old_image" => "nullable"
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
    		"status" => 0,
    		"profile_id" => Session::get('id')
    	]);

    	return redirect()->route('profile.jobs.index')->with('success','<div class="alert alert-success">Updated</div>');
    }

    public function jobDelete(Job $job){
    	$job->delete();
    	return redirect()->route('profile.jobs.index')->with('success','<div class="alert alert-success">Job Deleted</div>');
    }


    public function blogCreate(){
    	return view('profile.create_blog');
    }

    public function blogStore(Request $request){
    	$data = $request->validate([
            "title" => "required",
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
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Blog Post Added Successfully </div>');
    }

     public function myBlogs(){
    	$blogs = Blog::where('profile_id',Session::get('id'))->paginate(15);
    	return view('profile.blogs',compact('blogs'));
    }

     public function editBlog(Blog $blog){
    	return view('profile.edit_blog',compact('blog'));
     }

     public function blogUpdate(Request $request, Blog $blog){
    	$data = $request->validate([
            "title" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "required",
            'old_image' => 'nullable'
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
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Blog Post Updated Successfully </div>');
    }


    public function blogDelete(Blog $blog){
    	$blog->delete();
    	return redirect()->route('profile.blogs.index')->with('success','<div class="alert alert-success">Blog Post Deleted</div>');
    }
    // Video
    public function videoCreate(){
    	return view('profile.create_video');
    }

    public function videoStore(Request $request){
    	$data = $request->validate([
            "title" => "required",
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
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Blog Post Added Successfully </div>');
    }

     public function myVideo(){
    	$blogs = Blog::where('profile_id',Session::get('id'))->paginate(15);
    	return view('profile.blogs',compact('blogs'));
    }

    public function videoDelete(Blog $blog){
    	$blog->delete();
    	return redirect()->route('profile.blogs.index')->with('success','<div class="alert alert-success">Blog Post Deleted</div>');
    }


    //Image Gallery

    public function imageCreate(){
        return view('profile.create_blog');
    }


    public function imageStore(Request $request){
        $data = $request->validate([
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

        }
        Gallery::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "img_file" => $image,
        ]);

        return back()->with('success','<div class="alert alert-success"> Gallery Image Added Successfully </div>');
    }

     public function myimages(){
        $blogs = Blog::where('profile_id',Session::get('id'))->paginate(15);
        return view('profile.gallery',compact('gallery'));
    }

     public function editimage(Blog $blog){
        return view('profile.edit_blog',compact('blog'));
     }

     public function imageUpdate(Request $request, Blog $blog){
        $data = $request->validate([
            "title" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "required",
            'old_image' => 'nullable'
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
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Blog Post Updated Successfully </div>');
    }


    public function imageDelete(Image $Image){
        $blog->delete();
        return redirect()->route('profile.gallery.index')->with('success','<div class="alert alert-success">Blog Post Deleted</div>');
    }


    //Image Gallery Ends


    public function createAds(){
        return view('profile.ads_create');
    }

    public function advertisements(){
        $ads = Advertisement::latest()->paginate(20);
        return view('profile.advertisements',compact('ads'));
    }


    public function storeAds(Request $request){
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
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);
        return back()->with('success','<div class="alert alert-success"> Advertisement Added Successfully </div>');

    }

    public function editAds(Advertisement $advertisement ){
        return view('profile.ads_edit',compact('advertisement'));
    }

    public function updateAds(Request $request, Advertisement $advertisement){
        $data = $request->validate([
            "title" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "nullable",
            "old_image" => "nullable"
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/advertisements'), $image);
            $img = Image::read(public_path('uploads/advertisements/'.$image))->resize(1280,500);
            $img->save();

        }
        $advertisement->update([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Advertisement Updated Successfully </div>');
    }

    public function destroyAds(Advertisement $advertisement){
        $advertisement->delete();
        return back()->with('success',"<div class='alert alert-success'>Advertisement Deleted</div>");
    }



    public function buySaleIndex(){
        $bikroys = Bikroy::latest()->paginate(20);
        return view('profile.bikroys',compact('bikroys'));
    }




    public function buySaleCreate(){

        return view('profile.add_bikroy');
    }


    public function buySaleStore(Request $request){
         $data = $request->validate([
            "title" => "required",
            "image" => "required|image|mimes:jpg,png,jpeg,gif",
            "description" => "required"
        ]);

        $image = null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/buy_sale'), $image);
            $img = Image::read(public_path('uploads/buy_sale/'.$image))->resize(1280,500);
            $img->save();

        }
        Bikroy::create([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Bikroy Added Successfully </div>');

    }

    public function buySaleEdit(Bikroy $bikroy){

         return view('profile.edit_bikroy',compact('bikroy'));
    }

    public function buySaleUpdate(Request $request , Bikroy $bikroy){
        $data = $request->validate([
            "title" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "description" => "required",
            'old_image' => 'nullable'
        ]);

        $image = isset($data['old_image']) ? $data['old_image']:null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/buy_sale'), $image);
            $img = Image::read(public_path('uploads/buy_sale/'.$image))->resize(1280,500);
            $img->save();

        }
        $bikroy->update([
            "title" => isset($data['title']) ? $data['title']:null,
            "description" => isset($data['description']) ? $data['description']:null,
            "image" => $image,
            'profile_id' => Session::get('id'),
            'status' => 0
        ]);

        return back()->with('success','<div class="alert alert-success"> Bikroy Post Updated Successfully </div>');

    }

    public function buySaleDelete(Bikroy $bikroy){
        $bikroy->delete();
        return back()->with('success','<div class="alert alert-success"> Bikroy Post Updated Successfully </div>');
    }

    public function myProfile(){
       $profile = Profile::findOrFail(Session::get('id'));
       $districts = District::all();
       return view('profile.my_profile',compact('profile','districts'));
    }

    public function profileUpdate(Request $request, Profile  $profile){
        //dd($request);
        $data = $request->validate([
            "name" => "required|string|max:55",
            "batch" => "required|string|max:55",
            "company" => "required|string|max:55",
            "position" => "required|string|max:55",
            "business_area" => "required|string|max:55",
            "no_of_employee" => "required|string|max:55",
            "blood_grp" => "required|string|max:55",
            "blood_donor" => "required|string|max:55",
            "gender" => "required|string|max:55",
            "birth_date" => "required|string|max:55",
            "about_you" => "required|string|max:55",
            "about_business" => "required|string|max:55",
            "address" => "required|string|max:55",
            "district" => "required|string|max:55",
            "country" => "required|string|max:55",
            "nationality" => "required|string|max:55",
            //"mobile" => "required|string|max:55|unique:profiles,mobile",
            "fb_link" => "required|string|max:55",
            "password" => "nullable|string|min:8",
            "responsibilities" => "nullable|string",
            "volunteer" => "required|string",
            "entrepreneur" => "required|string",
            "image" => "nullable",
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
                "company"=> $data['company'],
                "position"=> $data['position'],
                "business_area"=> $data['business_area'],
                "no_of_employee"=> $data['no_of_employee'],
                "blood_group"=> $data['blood_grp'],
                "blood_donor"=> $data['blood_donor'],
                "gender"=> $data['gender'],
                "birth_date"=> $data['birth_date'],
                "about_you"=> $data['about_you'],
                "about_business"=> $data['about_business'],
                "address"=> $data['address'],
                "district"=> $data['district'],
                "country"=> $data['country'],
                "nationality"=> $data['nationality'],
                "mobile"=> $data['mobile'],
                "fb_link"=> $data['fb_link'],
                "password"=> Hash::make($data['password']),
                "volunteer"=> $data['volunteer'],
                "entrepreneur"=> $data['entrepreneur'],
                "image"=> $image
            ];

        }else{
            $attr = [
                "name" => $data['name'],
                "batch" => $data['batch'],
                "company"=> $data['company'],
                "position"=> $data['position'],
                "business_area"=> $data['business_area'],
                "no_of_employee"=> $data['no_of_employee'],
                "blood_group"=> $data['blood_grp'],
                "blood_donor"=> $data['blood_donor'],
                "gender"=> $data['gender'],
                "birth_date"=> $data['birth_date'],
                "about_you"=> $data['about_you'],
                "about_business"=> $data['about_business'],
                "address"=> $data['address'],
                "district"=> $data['district'],
                "country"=> $data['country'],
                "nationality"=> $data['nationality'],
                "fb_link"=> $data['fb_link'],
                "volunteer"=> $data['volunteer'],
                "entrepreneur"=> $data['entrepreneur'],
                "image"=> $image
            ];
        }
        $profile->update($attr);
        return back()->with('success','<div class="alert alert-success"> Profile Updated successfully </div>');

    }

}
