<?php

namespace App\Http\Controllers;

use App\Helpers\Website;
use App\Page;
use App\Blog;
use App\Department;
use App\District;
use App\Upazila;
use App\Area;
use App\Profile;
use App\Gallery;
use App\Job;
use App\Notice;
use App\User;
use App\Project;
use App\Advertisement;
use App\BloodDoner;
use App\Member;
use App\News;
use App\Video;
use App\Donation;
use DGvai\SSLCommerz\SSLCommerz;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Route;
use Image;
use Session;
use App\Bikroy;
use App\Import;
use Carbon\Carbon;
use DB;

use Illuminate\Support\Str;

class WebsiteController extends Controller
{
    public function index()
    {
        //return 'HOme';
        // \Artisan::call('storage:link');
        // \Artisan::call('view:clear');
        // \Artisan::call('route:clear');
        // \Artisan::call('cache:clear');
        // \Artisan::call('config:clear');
        // die();
        // 	$gparent = \App\Project::where('parent', 0)->where('order','!=',0)->orderBy('order','asc')->get();
        // 	$news = \App\News::orderBy('id','desc')->limit('21')->get();
        $image = \App\Slider::orderby('id', 'DESC')->get();
        //$categories = \App\Category::where('level', 1)->get();
        //$latestProducts = \App\Product::latest()->get();
        //$events = \App\Offer::latest()->get();

        $notice = \App\News::where('type', 'notice')->latest()->skip(1)->take(4)->get();
        $latestnews = \App\News::latest()->take(1)->first();
        return view('web.index', compact('image', 'notice', 'latestnews'));
    }

    public function donate_send(Request $request)
    {
        $request->validate([
            'project' => 'required|exists:projects,id',
            'subcat' => 'nullable|exists:projects,id',
            'subsubcat' => 'nullable|exists:projects,id',
            'budget' => 'required|numeric|min:10',
            'quantity' => 'required|integer|min:1',
            'usd' => 'required|numeric|min:0',
            'donor' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'country' => 'required|string|max:255',
            'mail' => 'required|email|max:255',
            'contact' => 'required|string|max:30',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120',
        ]);

        if (! config('sslcommerz.store.id') || ! config('sslcommerz.store.password')) {
            return back()->withInput()->with('error', 'SSLCommerz store credentials are not configured.');
        }

        $project = Project::findOrFail($request->project);
        $subcat = $request->filled('subcat') ? Project::find($request->subcat) : null;
        $subsubcat = $request->filled('subsubcat') ? Project::find($request->subsubcat) : null;

        $file = $request->file('image');
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), '_').'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images'), $fileName);

        $amount = number_format((float) $request->budget, 2, '.', '');
        $tranId = 'IPA'.now()->format('ymdHis').strtoupper(Str::random(4));

        $donation = Donation::create([
            'project_id' => $project->id,
            'subcat_id' => $subcat->id ?? null,
            'subsubcat_id' => $subsubcat->id ?? null,
            'project_name' => $project->title,
            'subcat_name' => $subcat->title ?? 'Nullable',
            'subsubcat_name' => $subsubcat->title ?? 'Nullable',
            'budget' => $amount,
            'quantity' => $request->quantity,
            'usd' => $request->usd,
            'donor_name' => $request->donor,
            'address' => $request->address,
            'country' => $request->country,
            'email' => $request->mail,
            'contact' => $request->contact,
            'image' => $fileName,
            'tran_id' => $tranId,
            'payment_status' => 'pending',
            'payment_currency' => config('sslcommerz.store.currency', 'BDT'),
            'donated_at' => now(),
        ]);

        try {
            $sslc = new SSLCommerz();
            $response = $sslc->amount($amount)
                ->trxid($tranId)
                ->product(Str::limit($project->title, 120, ''), 'Donation')
                ->customer($request->donor, $request->mail, $request->contact, $request->address, 'Dhaka', null, '1000', $request->country)
                ->setExtras((string) $donation->id)
                ->make_payment();
        } catch (\Throwable $exception) {
            Log::error('SSLCommerz init failed: '.$exception->getMessage(), ['donation_id' => $donation->id]);
            $donation->update([
                'payment_status' => 'failed',
                'payment_message' => 'Unable to start SSLCommerz payment.',
            ]);

            return back()->withInput()->with('error', 'Unable to start SSLCommerz payment. Please try again.');
        }

        if ($response instanceof RedirectResponse) {
            return $response;
        }

        $reason = is_string($response) && $response !== '' ? $response : 'Unable to start SSLCommerz payment.';
        $donation->update([
            'payment_status' => 'failed',
            'payment_message' => $reason,
        ]);

        return back()->withInput()->with('error', $reason);
    }

    public function donate_quick(Request $request)
    {
        $request->validate([
            'project' => 'required|exists:projects,id',
            'contact' => 'required|string|max:255',
            'budget' => 'required|numeric|min:10',
        ]);

        if (! config('sslcommerz.store.id') || ! config('sslcommerz.store.password')) {
            return back()->withInput()->with('error', 'SSLCommerz store credentials are not configured.');
        }

        $contact = trim($request->contact);
        $isEmail = filter_var($contact, FILTER_VALIDATE_EMAIL);
        $project = Project::findOrFail($request->project);
        $amount = number_format((float) $request->budget, 2, '.', '');
        $tranId = 'IPA'.now()->format('ymdHis').strtoupper(Str::random(4));
        $email = $isEmail ? $contact : 'noreply@ipaongo.org';
        $phone = $isEmail ? '01700000000' : $contact;

        $donation = Donation::create([
            'project_id' => $project->id,
            'project_name' => $project->title,
            'subcat_name' => 'Nullable',
            'subsubcat_name' => 'Nullable',
            'budget' => $amount,
            'quantity' => 1,
            'usd' => 0,
            'donor_name' => 'Online Donor',
            'address' => 'Bangladesh',
            'country' => 'Bangladesh',
            'email' => $email,
            'contact' => $phone,
            'tran_id' => $tranId,
            'payment_status' => 'pending',
            'payment_currency' => config('sslcommerz.store.currency', 'BDT'),
            'donated_at' => now(),
        ]);

        try {
            $sslc = new SSLCommerz();
            $response = $sslc->amount($amount)
                ->trxid($tranId)
                ->product(Str::limit($project->title, 120, ''), 'Donation')
                ->customer('Online Donor', $email, $phone, 'Bangladesh', 'Dhaka', null, '1000', 'Bangladesh')
                ->setExtras((string) $donation->id)
                ->make_payment();
        } catch (\Throwable $exception) {
            Log::error('SSLCommerz quick init failed: '.$exception->getMessage(), ['donation_id' => $donation->id]);
            $donation->update([
                'payment_status' => 'failed',
                'payment_message' => 'Unable to start SSLCommerz payment.',
            ]);

            return back()->withInput()->with('error', 'Unable to start SSLCommerz payment. Please try again.');
        }

        if ($response instanceof RedirectResponse) {
            return $response;
        }

        $reason = is_string($response) && $response !== '' ? $response : 'Unable to start SSLCommerz payment.';
        $donation->update([
            'payment_status' => 'failed',
            'payment_message' => $reason,
        ]);

        return back()->withInput()->with('error', $reason);
    }

    public function video()
    {
        $video = Video::latest()->paginate(12);
        return view('web.video', ['videos' => $video]);
    }

    public function trainings()
    {
        $trainings = News::latest()->where('type', 'training')->paginate(15);
        return view('web.traning', compact('trainings'));
    }

    public function training($training, $slug)
    {
        $training = News::where('type', 'training')->where('id', $training)->first();
        $trainings = \App\News::where('type', 'training')->latest()->skip(1)->take(4)->get();
        return view('web.training_single', compact('training', 'trainings'));
    }

    public function newsindex()
    {
        $latestnews = \App\News::latest()->where('type', '=', 'News')->get();
        return view('web.notice', compact('latestnews'));
    }

    public function newsshow(News $news)
    {
        $latestnews = \App\News::latest()->get();
        return view('web.news', compact('news', 'latestnews'));
    }

    public function page(Page $page, $slug)
    {
        return view('web.page', compact('page'));
    }

    public function seo_friendly_url($string)
    {
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
        return strtolower(trim($string, '-'));
    }

    public function project(Project $project, $slug)
    {
        $page = $project;

        return view('web.project', compact('page'));
    }

    public function blood_doner()
    {
        $districts = Area::all();
        return view('web.blood-doner-form', compact('districts'));
    }
    public function volunteer_register()
    {
        $districts = Area::all();
        return view('web.volunteer_register-form', compact('districts'));
    }

    public function volunteer_login()
    {
        return view('web.volunteer_login');
    }

    public function volunteer_login_post(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $volunteer = \App\BloodDoner::where('email', $request->email)
            ->where('member_type', 'volunteer')
            ->first();

        if ($volunteer && \Hash::check($request->password, $volunteer->password)) {
            \Session::put('volunteer', $volunteer);
            return redirect()->route('volunteer.dashboard');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function volunteer_dashboard()
    {
        $volunteer = \Session::get('volunteer');
        $totalVolunteers = \App\BloodDoner::where('member_type', 'volunteer')->count();
        $totalDonors = \App\BloodDoner::where('member_type', 'donor')->count();

        return view('web.volunteer_dashboard', compact('volunteer', 'totalVolunteers', 'totalDonors'));
    }

    public function volunteer_logout()
    {
        \Session::forget('volunteer');
        return redirect()->route('volunteer.login')->with('success', 'Logged out successfully');
    }

    public function blood_store(Request $request)
    {
        //dd($request);
        $data = $request->validate([
            "membertype" => "required",
            "name" => "required|max:50",
            "mobile" => "required|max:20|unique:blood_doners",
            "email" => "required|max:50",
            "blood_group" => "required",
            "division" => "required",
            "district" => "required",
            "upazila" => "required",
            "gender" => "nullable",
            "dob" => "nullable",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "password" => "required",
            'edu_qual' => 'required',
            'address' => 'required',
        ]);
        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = 'project_' . time() . '.' . $file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/project'), $image);
            $img = Image::read(public_path('uploads/project/' . $image))->resize(1280, 500);
            $img->save();
        }
        $div = array('Division', 'Chattagram', 'Rajshahi', 'Khulna', 'Barisal', 'Sylhet', 'Dhaka', 'Rangpur', 'Mymensingh');
        $division = $div[$data['division']];
        $district = District::where('id', $data['district'])->first();
        $upazila = Upazila::where('id', $data['upazila'])->first();
        BloodDoner::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'blood_group' => $data['blood_group'],
            'division' => $division,
            'district' => $district->name,
            'upazila' => $upazila->name,
            'member_type' => $data['membertype'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'image' => $image,
            'password' => Hash::make($request->password),
            'edu_qual' => $data['edu_qual'],
            'address' => $data['address'],
        ]);
        return back()->with('success', 'Member Created Successfully ');
    }


    public function blood_doner_list()
    {
        if (isset($_GET['name']) && $_GET['name'] != "") {
            $name = $_GET['name'];
            $bloods = BloodDoner::orWhere('name', $name)->orWhere('mobile', $name)->orWhere('blood_group', $name)->orWhere('division', $name)->orWhere('district', $name)->orWhere('upazila', $name)->paginate(20);
        } else {
            $bloods = BloodDoner::Where('member_type', 'donor')->paginate(20);
        }

        return view('web.all-doner', compact('bloods'));
    }
    public function blood_volunteer_list()
    {
        if (isset($_GET['name']) && $_GET['name'] != "") {
            $name = $_GET['name'];
            $volunteer = BloodDoner::orWhere('name', $name)->orWhere('mobile', $name)->orWhere('blood_group', $name)->orWhere('division', $name)->orWhere('district', $name)->orWhere('upazila', $name)->paginate(20);
        } else {
            $volunteer = BloodDoner::Where('member_type', 'volunteer')->paginate(40);
        }

        return view('web.all-volunteer', compact('volunteer'));
    }

    public function donate()
    {
        return view('web.donate-form');
    }

    public function about_us()
    {
        return view('web.about_us');
    }

    public function blogs()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(10);
        return view('web.blogs', compact('blogs'));
    }

    public function blog($blog, $slug)
    {
        $blog = Blog::where('id', $blog)->first();
        $moreBlogs = Blog::where('status', 1)->where('id', '!=', $blog->id)->latest()->take(4)->get();
        return view('web.blog_single', compact('blog', 'moreBlogs'));
    }

    public function gallery()
    {
        $gallery = Gallery::where('parent', 0)->latest()->paginate(20);
        return view('web.gallery', compact('gallery'));
    }

    public function project_gallery($id, $slug)
    {
        $gallery = Gallery::where('parent', $id)->latest()->paginate(20);
        return view('web.project-gallery', compact('gallery'));
    }

    public function gallery_image($filename)
    {
        // Check if file exists
        $imagePath = public_path('images/gallery/' . $filename);
        if (!file_exists($imagePath)) {
            abort(404, 'Image not found');
        }

        $imageUrl = asset('images/gallery/' . $filename);
        return view('web.gallery-image', compact('filename', 'imageUrl'));
    }


    public function contactUs()
    {
        return view('web.contact_us');
    }

    public function contactMeil(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required",
            "subject" => "required",
            "message" => "required"
        ]);

        Mail::to('ks.azim@yahoo.com')->send(new  \App\Mail\ContactUs($data));
        return $data;
    }

    public function verifyStudentId()
    {
        return view('web.verify_student');
    }


    public function verifyStudent(Request $request)
    {
        $data = $request->validate([
            "student_id" => "required"
        ]);
        $haveStudent = Import::where('student_code', $data['student_id'])->first();
        if ($haveStudent) {
            Session::put('student_code', $haveStudent['student_code']);
            Session::put('student_name', $haveStudent['student_name']);
            return 1;
        } else {
            return 0;
        }
    }

    public function memberRegistration()
    {
        $districts = District::all();
        return view('web.registration', compact('districts'));
    }


    public function studentRegistration()
    {
        $districts = District::all();
        return view('web.registration', compact('districts'));
    }



    public function ajaxAreas()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $id = intval($id);
        $areas = Area::where('district_id', $id)->get();
        $html = "<option value=''> Please Select Area </option>";
        foreach ($areas as $area) {
            $html .= "<option value='{$area->id}'>{$area->area}</option>";
        }
        return $html;
    }

    public function studentStore(Request $request)
    {
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
            "mobile" => "required|string|max:55|unique:profiles,mobile",
            "fb_link" => "required|string|max:55",
            "email" => "required|string|max:55|email|unique:profiles,email",
            "password" => "required|string|min:8",
            "responsibilities" => "required|string",
            "volunteer" => "required|string",
            "entrepreneur" => "required|string",
            "image" => "nullable",
        ]);


        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/profiles'), $image);
            $img = Image::read(public_path('uploads/profiles/' . $image))->resize(360, 360);
            $img->save();
        }

        Profile::create([
            "name" => $data['name'],
            "batch" => $data['batch'],
            "company" => $data['company'],
            "position" => $data['position'],
            "business_area" => $data['business_area'],
            "no_of_employee" => $data['no_of_employee'],
            "blood_group" => $data['blood_grp'],
            "blood_donor" => $data['blood_donor'],
            "gender" => $data['gender'],
            "birth_date" => $data['birth_date'],
            "about_you" => $data['about_you'],
            "about_business" => $data['about_business'],
            "address" => $data['address'],
            "district" => $data['district'],
            "country" => $data['country'],
            "nationality" => $data['nationality'],
            "mobile" => $data['mobile'],
            "fb_link" => $data['fb_link'],
            "email" => $data['email'],
            "password" => Hash::make($data['password']),
            "responsibilities" => $data['responsibilities'],
            "volunteer" => $data['volunteer'],
            "entrepreneur" => $data['entrepreneur'],
            "image" => $image
        ]);

        // //############ SMS ############################
        //   $url = "http://sms.uttarainfotech.com/smsapi";
        //   $data = [
        //     "api_key" => "C20008186040b023441b03.50501576",
        //     "type" => "text",
        //     "contacts" => $data['mobile'],
        //     "senderid" => "8809612440903",
        //     "msg" => "Bagma",
        //     // "username"=> "C2000818",
        //     // "password"=> "8gmWxyjfaQ",
        //   ];
        //   $ch = curl_init();
        //   curl_setopt($ch, CURLOPT_URL, $url);
        //   curl_setopt($ch, CURLOPT_POST, 1);
        //   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //   $response = curl_exec($ch);
        //   curl_close($ch);
        //   //return $response;
        // //############ SMS ##################################
        // Session::forget('student_code');
        // Session::forget('student_name');
        return back()->with('success', ' Registration Successfull');
    }

    public function profiles()
    {
        $districts = District::all();
        $profiles = Profile::latest()->paginate(24);
        return view('web.profiles', compact('profiles', 'districts'));
    }

    public function studentLogin()
    {
        return view('web.student_login');
    }


    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "required",
            "password"   => "required"
        ]);
        $person = BloodDoner::where('email', $request->email)->exists();
        if ($person == 1) {
            $password_get = $request->password;
            $person_data = BloodDoner::where('email', $request->email)->first();
            $db_pass = $person_data->password;

            if (Hash::check($password_get, $db_pass)) {
                $person_info = BloodDoner::where('email', $request->email)->first();
                return view('web.donor_profile', compact('person_info'));
            } else {
                return back()->with('error', 'Password Id is Wrong!');
            }
        } else {
            return back()->with('error', 'Email Id is Wrong!');
        }

        // dd($request->all());

        // $student = Profile::where('email',$data['user_name'])->first();
        // if($student){
        //   if(Hash::check($data['password'],$student->password)){
        //         Session::put('id',$student->id);
        //         Session::put("name",$student->name);
        //         Session::put('email',$student->email);
        //         Session::put('login_status',1);
        //         return redirect()->route('profile.index');
        //   }else{
        //       return back()->with('error','<div class="alert alert-danger"> Username or Password not match </div>');
        //   }
        // }else{
        //     return back()->with('success','<div class="alert alert-danger"> Student Not Found </div>');
        // }
        // return back()->with('success','<div class="alert alert-danger"> Student Not Found </div>');
    }

    //password reset

    public function stdPassResetEmailLink()
    {
        return view('web.student_password_reset_link');
    }

    public function stdPassResetEmail(Request $request)
    {

        $data = $request->validate([
            'email_address' => 'required|email',
        ]);

        $profile = Profile::where('email', '=', $data['email_address'])->first();
        if (empty($profile)) {

            return back()->with('message', 'This ' . $data['email_address'] . ' E-mail is not Registared Mail!');
        }

        $token = Str::random(8);
        //$string = str_random(5);
        $num = random_int(5, 6);

        $insert = DB::table('profiles')
            ->where('email', $data['email_address'])
            ->update([
                'password' => Hash::make($token . $num)

            ]);
        ////////////////////////////////////////////////////////////////////////////////////////////////

        $domain = 'bagma.net';
        $to = $data['email_address'] . ", Password Reset link";
        $subject = "Password Reset link";

        $message = '
                    <div class="container">
                         <div class="row justify-content-center">
                             <div class="col-md-8">
                                 <div class="card">
                                     <div class="card-header">Verify Your Email Address</div>
                                       <div class="card-body">
                                             <div class="alert alert-success" role="alert">'
            . __('Your Password is:')
            . '</div>' . $token . $num . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= "From:Password Reset link<no-replay@$domain>" . "\r\n";
        $mail = mail($to, $subject, $message, $headers);

        ////////////////////////////////////////////////////////////////////////////////////////////////

        // $mail = Mail::send('customAuth.verify', ['token' => $token], function($message) use($request){
        //     $message->to($request->email_address);
        //     $message->subject('Reset Password Notification');
        // });

        return back()->with('message', 'Please check your mail!');
    }

    public function member_reset_password($param)
    {
        $date = date('Y-m-d h');
        $reset = DB::table('password_resets')->where('token', $param)->where('created_at', 'LIKE', '%' . $date . '%')->first();
        $email = $reset->email;
        if ($reset) {
            return view('web.password_reset', ['email' => $email]);
        }
    }

    public function set_new_password(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'password' => 'min:6|required_with:confirmed|same:confirmed'
        ]);
        $profile = Profile::where('email', $request->mail)->first();
        $profile->password = Hash::make($request->password);
        $profile->save();
        return redirect()->to('student-login');
    }

    public function sendResetEmail($email, $token)
    {

        $user = DB::table('profiles')->where('email', $email)->select('name', 'email')->first();

        //$link = config('base_url') . 'member/password/reset/' . $token . '?email=' . urlencode($user->email);

        try {

            $mail = Mail::send('aaaa', ['token' => $token], function ($message) use ($request) {
                $message->to($email);
                $message->subject('Reset Password Notification');
            });



            return back()->with('message', 'We have e-mailed your password reset link!');
        } catch (\Exception $e) {
            return false;
        }
    }
    public function notices()
    {
        $notices = Notice::where('status', 1)->latest()->paginate(12);
        return view('web.notices', compact('notices'));
    }

    public function news($news, $slug)
    {

        $news = News::where('id', $news)->first();
        $items = News::where('type', 'News')->latest()->take(4)->get();
        return view('web.news_single', compact('news', 'items'));
    }

    public function news_all()
    {
        // $news = News::latest()->where('type', 'News')->paginate(10);
        $news = News::where('type', 'News')->latest()->take(10)->paginate(10);

        return view('web.news', compact('news'));
    }

    public function notice($notice, $slug)
    {
        $notice = News::where('type', 'notice')->where('id', $notice)->first();
        $items = News::where('type', 'notice')->latest()->take(4)->get();
        return view('web.notice_single', compact('notice', 'items'));
    }

    public function jobs()
    {
        $jobs = Job::where('status', 1)->latest()->paginate(12);
        return view('web.jobs', compact('jobs'));
    }

    public function job(Job $job)
    {
        $items = Job::where('id', '!=', $job->id)->where('status', 1)->latest()->take(4);
        return view('web.job_single', compact('job', 'items'));
    }


    public function advertisements()
    {
        $advertisements = Advertisement::latest()->paginate(20);
        return view('web.advertisements', compact('advertisements'));
    }

    public function advertisement(Advertisement $advertisement)
    {
        $advertisements = Advertisement::where('id', '!=', $advertisement->id)->take(4)->get();
        return view('web.advertisement_single', compact('advertisement', 'advertisements'));
    }


    public function profileShow(Profile $profile)
    {
        $department = Department::where('id', $profile->department_id)->first();
        $districts = District::where('id', $profile->district_id)->first();
        // $district = District::select('districts.district_name')
        // ->join('profiles', 'profiles.district_id', '=', 'districts.id')
        // ->where('profiles.id', $profile)->get();
        $area = Department::where('id', $profile->area_id)->first();
        return view('web.profile_show', compact('profile', 'department', 'districts', 'area'));
    }

    /**
     * User Logout Form
     */
    public function logout()
    {
        Session::forget('login_status');
        Session::forget('id');
        Session::forget('username');
        return  redirect()->route('index');
    }


    public function filter()
    {
        $name = isset($_GET['name']) ? $_GET['name'] : null;
        $institute = isset($_GET['education']) ? $_GET['education'] : null;
        //$batch = isset($_GET['batch']) ? $_GET['batch']:null;
        //$department = isset($_GET['department']) ? $_GET['department']:null;
        $district = isset($_GET['district']) ? $_GET['district'] : null;
        //$area = isset($_GET['area']) ? $_GET['area']:null;
        $blood_group = isset($_GET['blood_group']) ? $_GET['blood_group'] : null;
        $mobile = isset($_GET['mobile']) ? $_GET['mobile'] : null;
        $present_company = isset($_GET['present_company']) ? $_GET['present_company'] : null;

        $pro = new Profile();
        if ($name != null) {
            $pro = $pro->where('name', 'LIKE', $name . "%");
        }
        if ($institute != null) {
            $pro = $pro->where('education', '=', $institute);
        }

        // if($batch != null){
        //      $pro = $pro->where('batch','=',$batch);
        // }

        // if($department != null){
        //      $pro = $pro->where('department_id','=',$department);
        // }

        if ($district != null) {
            $pro = $pro->where('district_id', '=', $district);
        }

        // if($area != null){
        //      $pro = $pro->where('area_id','=',$area);
        // }

        if ($blood_group != null) {
            $pro = $pro->where('blood_group', '=', $blood_group);
        }

        if ($present_company != null) {
            $pro = $pro->where('present_company', '=', $present_company);
        }

        if ($mobile != null) {
            $profiles = Profile::where('mobile', $mobile)->get();
            return view('web.filter', compact('profiles'));
        }

        $profiles = $pro->get();
        return view('web.filter', compact('profiles'));
    }


    public function search()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;

        $profiles = Profile::where('name', 'LIKE', '%' . $keyword . "%")->orWhere('mobile', $keyword)->orWhere('username', $keyword)->orWhere('present_company', 'like', '%' . $keyword . '%')->get();
        return view('web.search', compact('profiles'));
    }

    public function all_member()
    {
        if (Route::currentRouteName() == 'dedicated.volunteer') {
            $members = Profile::latest()->where('responsibilities', 'Dedicated Volunteer')->paginate(20);
        } elseif (Route::currentRouteName() == 'area.volunter') {
            $members = Profile::latest()->where('responsibilities', 'Area Volunter')->paginate(20);
        } elseif (Route::currentRouteName() == 'districs.ambasador') {
            $members = Profile::latest()->where('responsibilities', 'Districs Ambasador')->paginate(20);
        } elseif (Route::currentRouteName() == 'campus') {
            $members = Profile::latest()->where('responsibilities', 'Campus')->paginate(20);
        } else {
            // $members = Member::latest()->paginate(20);
            $members = Member::orderBy('position', 'ASC')->get();
        }
        return view('web.all-member', compact('members'));
    }

    public function media_coverage()
    {

        // $medias = News::where('type', 'media')->latest()->paginate(20);
        $medias = News::where('type', 'media')->latest()->take(10)->get();

        return view('web.media-coverage', compact('medias'));
    }

    public function bulletin()
    {

        // $bulletin = News::where('type', 'bulletin')->latest()->paginate(20);
        $bulletin = News::where('type', 'bulletin')->latest()->take(10)->get();
        // dd($bulletin);die();

        return view('web.bullet-in', compact('bulletin'));
    }



    public function buySales()
    {
        $buy_sales = Bikroy::latest()->paginate(20);
        return view('web.buy_sales', compact('buy_sales'));
    }

    public function buySale(Bikroy $bikroy)
    {
        return view('web.buy_sale_single', compact('bikroy'));
    }

    public function subcategory()
    {
        if (!empty($_GET['id'])) {
            $project = Project::where('parent', $_GET['id'])->get();
            return response()->json($project);
        }
        if (!empty($_GET['subcat'])) {
            $project = Project::where('parent', $_GET['subcat'])->get();
            return response()->json($project);

            //             echo '<label>Sub Sub Project</label>
            //                 <select id="ProjectSubCategory"  class="form-control">
            //                     <option value=""> --Sub Sub Project-- </option>';
            //                     foreach($project AS $item){
            //                     echo '<option value="'.$item->id.'">'.$item->title.'</option>';
            //                     }
            // 			echo '</select>';
        }

        if (!empty($_GET['price'])) {
            $project = Project::where('id', $_GET['price'])->first();
            echo $project->price;
        }
    }

    public function district_list()
    {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $district = District::where('division_id', $id)->get();
            return response()->json($district);
        }

        if (!empty($_GET['district'])) {
            $district = $_GET['district'];
            $upazila = Upazila::where('district_id', $district)->get();
            return response()->json($upazila);
        }


        //         if(!empty($request->id)){
        //             $project = Project::where('parent', $request->id)->get();
        //             return response()->json($project);
        //         }
        //         if(!empty($request->subcat)){
        //             $project = Project::where('parent', $request->subcat)->get();
        //             echo '<label>Sub Sub Project</label>
        //                 <select  class="form-control">
        //                     <option value=""> --Sub Sub Project-- </option>';
        //                     foreach($project AS $item){
        //                     echo '<option value="'.$item->id.'">'.$item->title.'</option>';
        //                     }
        // 			echo '</select>';
        //         }
    }

    public function donor_pas_change($id)
    {
        $person_info = BloodDoner::find($id);
        return view('web.donor_cng_pass', compact('person_info'));
    }

    public function donor_pass_post(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);
        $person = BloodDoner::where('id', $request->id)->first();
        $db_pass = $person->password;
        $old_pass = $request->oldpassword;
        $new_pass = $request->newpassword;
        $confirm_pass = $request->password_confirmation;

        if (Hash::check($old_pass, $db_pass)) {

            if ($new_pass === $confirm_pass) {
                BloodDoner::find($request->id)->update([
                    'password' => Hash::make($request->newpassword)
                ]);
                // echo "success";
                return back()->with('success', 'Password Change Successfully');
            } else {
                return back()->with('error', 'new password and confirm password not matched ');
            }
        } else {
            return back()->with('error', 'Password Doesn not match ');
        }
    }

    public function donor_edit_profile($id)
    {
        $person_info = BloodDoner::find($id);
        return view('web.donor_edit_profile', compact('person_info'));
    }

    public function donor_edit_post(Request $request)
    {
        $aboutId = $request->id;
        $aboutData = BloodDoner::find($aboutId);
        if ($request->hasFile('image')) {
            $image_path = public_path("/uploads/project/" . $aboutData->image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $aboutImage = $request->file('image');
            $imgName = $aboutImage->getClientOriginalName();
            $destinationPath = public_path('/uploads/project/');
            $aboutImage->move($destinationPath, $imgName);
        } else {
            $imgName = $aboutData->image;
        }

        $aboutData->member_type = $request->membertype;
        $aboutData->name = $request->name;
        $aboutData->mobile = $request->mobile;
        $aboutData->division = $request->division;
        $aboutData->district = $request->district;
        $aboutData->upazila = $request->upazila;
        $aboutData->blood_group = $request->blood_group;
        $aboutData->email = $request->email;
        $aboutData->gender = $request->gender;
        $aboutData->dob = $request->dob;
        $aboutData->image = $imgName;
        $aboutData->save();
        return back()->with('success', 'Profile Update Successfully');
    }

    public function chairmanMessage()
    {
        return view('web.chairman-message');
    }

    public function backgroundOrganization()
    {
        return view('web.background-organization');
    }

    public function visionMission()
    {
        return view('web.vision-mission');
    }

    public function goalsObjectives()
    {
        return view('web.goals-objectives');
    }

    public function careers()
    {
        return view('web.careers');
    }
}
