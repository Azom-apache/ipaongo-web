<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return "Cleared";
});

Auth::routes();
Route::get('/donor_pas_change/{id}', 'WebsiteController@donor_pas_change')->name('donor_pas_change');
Route::post('/donor_pass_post', 'WebsiteController@donor_pass_post')->name('donor_pass_post');
Route::get('/donor_edit_profile/{id}', 'WebsiteController@donor_edit_profile')->name('donor_edit_profile');
Route::post('/donor_edit_post', 'WebsiteController@donor_edit_post')->name('donor_edit_post');
Auth::routes(['register' => false]);
Route::get('/', 'WebsiteController@index')->name('index');
Route::get('/contact-us', 'WebsiteController@contactUs')->name('contactUs');
Route::get('/about-us', 'WebsiteController@about_us')->name('about');

Route::get('/page/{page}/{slug}', 'WebsiteController@page')->name('page');
Route::get('/project/{project}/{slug}', 'WebsiteController@project')->name('project');
Route::get('/blood/doner', 'WebsiteController@blood_doner')->name('blood.doner');
Route::get('/volunteer/register', 'WebsiteController@volunteer_register')->name('volunteer_register');
Route::get('/volunteer/login', 'WebsiteController@volunteer_login')->name('volunteer.login');
Route::post('/volunteer/login', 'WebsiteController@volunteer_login_post')->name('volunteer.login.post');
Route::get('/volunteer/dashboard', 'WebsiteController@volunteer_dashboard')->name('volunteer.dashboard')->middleware('volunteer');
Route::post('/volunteer/logout', 'WebsiteController@volunteer_logout')->name('volunteer.logout');
Route::post('/blood/doner/store', 'WebsiteController@blood_store')->name('blood.donate.store');
Route::get('blood', 'WebsiteController@blood_doner_list')->name('blood.doner.list');
Route::get('volunteer', 'WebsiteController@blood_volunteer_list')->name('blood.volunteer.list');
Route::get('donate', 'WebsiteController@donate')->name('donate.show');

Route::get('/blogs', 'WebsiteController@blogs')->name('blogs');
Route::get('/blog/{blog}/{slug}', 'WebsiteController@blog')->name('blog.single');
Route::get('gallery', 'WebsiteController@gallery')->name('gallery');
Route::get('/project/gallery/{id}/{slug}', 'WebsiteController@project_gallery')->name('project.gellery');
Route::get('/gallery/image/{filename}', 'WebsiteController@gallery_image')->name('gallery.image');

// Redirect direct image access to gallery viewer
Route::get('/images/gallery/{filename}', function ($filename) {
    return redirect()->route('gallery.image', ['filename' => $filename]);
});
Route::post('donate/send', 'WebsiteController@donate_send')->name('donate.send');

Route::post('payment/success', 'PaymentController@success')->name('payment.success');
Route::post('payment/failure', 'PaymentController@failure')->name('payment.failure');
Route::post('payment/cancel', 'PaymentController@cancel')->name('payment.cancel');
Route::post('payment/ipn', 'PaymentController@ipn')->name('payment.ipn');
Route::get('payment/receipt/{tranId}', 'PaymentController@receipt')->name('payment.receipt');



Route::get('/jobs', 'WebsiteController@jobs')->name('jobs');
Route::get('/job/{job}/{slug}', 'WebsiteController@job')->name('job');

Route::get('/notices', 'WebsiteController@notices')->name('notices');
Route::get('/notice/{notice}/{slug}', 'WebsiteController@notice')->name('notice');

Route::get('notice-board/{news}', 'WebsiteController@newsshow')->name('news.show');
Route::get('notice-board', 'WebsiteController@newsindex')->name('news.index');

Route::get('news-and-event', 'WebsiteController@news_all')->name('news');
Route::get('news/{news}/{slug}', 'WebsiteController@news')->name('news.single');

Route::get('/contact-us', 'WebsiteController@contactUs')->name('contactUs');
Route::post('/contact', 'WebsiteController@contactMeil')->name('contactMail');


Route::get('/ajax/area', 'WebsiteController@ajaxAreas')->name('ajaxArea');

Route::get('/district/list', 'WebsiteController@district_list')->name('districts.list');

Route::get('/verify/student-id', 'WebsiteController@verifyStudentId')->name('studentVerify');
Route::post('/verify/student', 'WebsiteController@verifyStudent')->name('veriftStudent');
Route::get('registration', 'WebsiteController@studentRegistration')->name('studentRegistration');


Route::get('member-login', 'WebsiteController@studentLogin')->name('studentLogin');
Route::post('/student/try-login', 'WebsiteController@login')->name('stdLogin');

//password reset
Route::get('/password-reset-link', 'WebsiteController@stdPassResetEmailLink')->name('stdPassResetEmailLink');
Route::post('/student/password-reset', 'WebsiteController@stdPassResetEmail')->name('stdPassResetEmail');
Route::post('/member/send-email', 'WebsiteController@sendResetEmail ')->name('sendResetEmail ');
Route::get('/{param}/member/reset-password', 'WebsiteController@member_reset_password')->name('memberResetPassword');
Route::post('set-new-pass', 'WebsiteController@set_new_password')->name('setNewPassword');
Route::get('/profile/{profile}/show', 'WebsiteController@profileShow')->name('profileShow');

Route::get('/i-need-job', 'WebsiteController@advertisements')->name('advertisements');
Route::get('/i-need-job/{advertisement}/{slug}', 'WebsiteController@advertisement')->name('advertisement');

//Route::get('/gallery','WebsiteController@gallery')->name('buySales');

Route::get('/buy-sale/{bikroy}/{slug}', 'WebsiteController@buySale')->name('buySale');


Route::get('all-advisors', 'ComitteeController@getAllAdvisors')->name('comittees.getallAdvisors');

Route::get('all-executives', 'ComitteeController@getAllExecutives')->name('comittees.getAllExecutives');

Route::get('/subcategory/donate', 'WebsiteController@subcategory')->name('subcategory.donate');

// Route::get('/home', function(){
// 	return redirect()->route('dashboard.index');
// })->name('home');

Route::redirect('/home', '/dashboard');

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
        Route::resource('sliders', 'SliderController');

        //Blogs
        Route::resource('blogs', 'BlogController');

        Route::resource('videos', 'VideoeController');

        Route::resource('projects', 'ProjectsController');

        Route::post('/subcategory', 'ProjectsController@subcategory')->name('subcategory');

        Route::post('/project/data', 'ProjectsController@project_data')->name('project.data');


        //gallery
        //Route::get('gallery/create','UserDeashboardController@imageCreate')->name('gallery.create');
        Route::resource('galleries', 'GalleryController');
        //Members
        Route::resource('members', 'MemberController');

        Route::resource('blood', 'BloodController');

        Route::get('comittees/advisors', 'ComitteeController@getAdvisors')->name('comittees.getAdvisors');

        Route::resource('comittees', 'ComitteeController');

        Route::put('comittees/{comittee}/delete', 'ComitteeController@destroy')->name('comittees.delete_comittee');


        // 		dashboard.comittees.create

        //Jobs
        Route::resource('jobs', 'JobController');

        //notice
        Route::resource('notice', 'NoticeController');
        //Pages
        Route::resource('pages', 'PageController');

        //Advertisement
        Route::resource('advertisements', 'AdvertisementController');

        Route::resource('departments', 'DepartmentController');

        Route::resource('import', 'ImportController');

        Route::get('/profile/find', 'ProfileController@findProfile')->name('profile.findProfile');
        Route::get('/task', 'ProfileController@exportCsv')->name('blood.task');
        Route::resource('profiles', 'ProfileController');


        //Setting
        Route::resource('settings', 'SettingController');
        Route::resource('ads', 'AdController');
        Route::resource('bikroy', 'BikroyController');
        //District
        Route::get('/area/districts', 'DistrictController@create')->name('area.district.create');
        Route::post('/area/districts/store', 'DistrictController@store')->name('area.district.store');
        Route::patch('/area/districts/{district}/update', 'DistrictController@update')->name('area.district.update');
        Route::get('/area/aja/district', 'DistrictController@ajaxDistrict')->name('area.district.ajaxDistrict');
        Route::delete('/area/district/{district}/delete', 'DistrictController@destroy')->name('area.district.delete');

        //Area
        Route::get('area/area/create', 'AreaController@create')->name('area.create');
        Route::post('/area/area/store', 'AreaController@store')->name('area.store');
        Route::get('/area/edit', 'AreaController@edit')->name('area.edit');
        Route::patch('/area/{area}/update', "AreaController@update")->name('area.update');
        Route::delete('/area/{area}/delete', 'AreaController@destroy')->name('area.destroy');

        // News
        Route::get('news', 'NewsController@index')->name('news.index');
        Route::get('news/create', 'NewsController@create')->name('news.create');
        Route::post('news/store', 'NewsController@store')->name('news.store');
        Route::get('news/{news}/edit', 'NewsController@edit')->name('news.edit');
        Route::patch('news/{news}/update', 'NewsController@update')->name('news.update');
        Route::delete('/news/{news}/delete', 'NewsController@destroy')->name('news.destroy');

        //Notice
        // Route::get('notice/create','UserDeashboardController@noticeCreate')->name('notice.create');
        // Route::post('/notice/store','UserDeashboardController@noticeStore')->name('notice.store');
        // Route::get('/notice/','UserDeashboardController@myNotice')->name('notice.index');
        // Route::get('/notice/{job}/edit','UserDeashboardController@editNotice')->name('notice.edit');
        // Route::patch('/notice/{job}/update','UserDeashboardController@noticeUpdate')->name('notice.update');
        // Route::delete('/notice/{job}/destroy','UserDeashboardController@noticeDelete')->name('notice.destroy');

        // Donations
        Route::resource('donations', 'Admin\DonationController', ['as' => 'admin']);
    });
Route::get('my-profile', 'UserDeashboardController@index')->name('profile.index');
Route::patch('/my-profile/{profile}/update', 'UserDeashboardController@profileUpdate')->name('updateProfile');
Route::prefix('profile')
    ->name('profile.')
    ->middleware(['profile'])
    ->group(function () {
        //Route::get('/','UserDeashboardController@index')->name('profile.index');

        Route::get('/my-profile', 'UserDeashboardController@myProfile')->name('myProfile');
        //Route::patch('/my-profile/{profile}/update','UserDeashboardController@profileUpdate')->name('updateProfile');
        //jobs
        Route::get('jobs/create', 'UserDeashboardController@jobCreate')->name('jobs.create');
        Route::post('/jobs/store', 'UserDeashboardController@jobStore')->name('jobs.store');
        Route::get('/jobs/', 'UserDeashboardController@myJobs')->name('jobs.index');
        Route::get('/jobs/{job}/edit', 'UserDeashboardController@editJob')->name('jobs.edit');
        Route::patch('/jobs/{job}/update', 'UserDeashboardController@jobUpdate')->name('jobs.update');
        Route::delete('/jobs/{job}/destroy', 'UserDeashboardController@jobDelete')->name('jobs.destroy');





        Route::get('blogs/create', 'UserDeashboardController@blogCreate')->name('blogs.create');
        Route::post('/blogs/store', 'UserDeashboardController@blogStore')->name('blogs.store');
        Route::get('/blogs/', 'UserDeashboardController@myBlogs')->name('blogs.index');
        Route::get('/blogs/{blog}/edit', 'UserDeashboardController@editblog')->name('blogs.edit');
        Route::patch('/blogs/{blog}/update', 'UserDeashboardController@blogUpdate')->name('blogs.update');
        Route::delete('/blogs/{blog}/destroy', 'UserDeashboardController@blogDelete')->name('blogs.destroy');

        //Video
        Route::get('video/create', 'UserDeashboardController@videoCreate')->name('video.create');
        Route::post('/video/store', 'UserDeashboardController@videoStore')->name('video.store');
        Route::get('/videos/', 'UserDeashboardController@myVideo')->name('video.index');
        Route::delete('/video/{video}/destroy', 'UserDeashboardController@videoDelete')->name('video.destroy');

        //Route::get('gallery/create','UserDeashboardController@imageCreate')->name('gallery.create');
        Route::post('/gallery/store', 'UserDeashboardController@imageStore')->name('gallery.store');
        Route::get('/gallery/', 'UserDeashboardController@myimages')->name('gallery.index');
        Route::get('/gallery/{gallery}/edit', 'UserDeashboardController@editimage')->name('gallery.edit');
        Route::patch('/gallery/{gallery}/update', 'UserDeashboardController@imageUpdate')->name('gallery.update');
        Route::delete('/gallery/{gallery}/destroy', 'UserDeashboardController@imageDelete')->name('gallery.destroy');


        //Advertisement
        Route::get('/advertisements', 'UserDeashboardController@advertisements')->name('advertisement.index');
        Route::get('/advertisement/create', 'UserDeashboardController@createAds')->name('advertisement.create');
        Route::post('/advertisement/store', 'UserDeashboardController@storeAds')->name('advertisement.store');
        Route::get('/advertisement/{advertisement}/edit', 'UserDeashboardController@editAds')->name('advertisement.edit');
        Route::patch('/advertisement/{advertisement}/update', 'UserDeashboardController@updateAds')->name('advertisement.update');
        Route::delete('/advertisement/{advertisement}/destroy', 'UserDeashboardController@destroyAds')->name('advertisement.destroy');

        //BuySale
        Route::get('/buy-sale', 'UserDeashboardController@buySaleIndex')->name('bikroy.index');
        Route::get('/buy-sale/create', 'UserDeashboardController@buySaleCreate')->name('bikroy.create');
        Route::post('/buy-sale/store', 'UserDeashboardController@buySaleStore')->name('bikroy.store');
        Route::get('/buy-sale/{bikroy}/edit', 'UserDeashboardController@buySaleEdit')->name('bikroy.edit');
        Route::patch('/buy-sale/{bikroy}/update', 'UserDeashboardController@buySaleUpdate')->name('bikroy.update');
        Route::delete('/buy-sale/{bikroy}/delete', 'UserDeashboardController@buySaleDelete')->name('bikroy.delete');
    });

Route::get('/filter', 'WebsiteController@filter')->name('filter');

Route::post('/member/register', 'WebsiteController@studentStore')->name('studentStore');
Route::get('/profiles', 'WebsiteController@profiles')->name('profiles');
Route::post('/profile/logout', 'WebsiteController@logout')->name('profile.logout');

Route::get('/search', 'WebsiteController@search')->name('search');
Route::get('all-member', 'WebsiteController@all_member')->name('all.member');
Route::get('media-coverage', 'WebsiteController@media_coverage')->name('media.coverage');

Route::get('dedicated-volunteer', 'WebsiteController@all_member')->name('dedicated.volunteer');
Route::get('area-volunter', 'WebsiteController@all_member')->name('area.volunter');
Route::get('bulletin', 'WebsiteController@bulletin')->name('bulletin.show');

Route::get('districs-ambasador', 'WebsiteController@all_member')->name('districs.ambasador');
Route::get('campus', 'WebsiteController@all_member')->name('campus');




Route::get('video', 'WebsiteController@video')->name('show.video');
Route::get('trainings', 'WebsiteController@trainings')->name('show.training');
Route::get('training/{training}/{slug}', 'WebsiteController@training')->name('training.single');
Route::get('chairman-message', 'WebsiteController@chairmanMessage')->name('chairman.message');
Route::get('background-organization', 'WebsiteController@backgroundOrganization')->name('background.organization');
Route::get('vision-mission', 'WebsiteController@visionMission')->name('vision.mission');
Route::get('goals-objectives', 'WebsiteController@goalsObjectives')->name('goals.objectives');
Route::get('careers', 'WebsiteController@careers')->name('careers');
