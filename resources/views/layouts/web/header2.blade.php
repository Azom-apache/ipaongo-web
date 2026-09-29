@php
    $setting = \App\Helpers\Website::setting();    
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bagma</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('head')


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('web/slick/slick/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('web/slick/slick/slick-theme.css')}}">
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="{{ asset('js/tailwindCss3.4.17') }}"></script>
	<script defer src="{{ asset('js/cdn.alpine.js') }}"></script>
	<script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              },
              screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
                }
            }
          }
        }
      </script>
<style>
    .btn:focus, .btn:active, button:focus, button:active {
    outline: none !important;
    box-shadow: none !important;
  }
  
  .thumb{
    margin-top: 15px;
    margin-bottom: 15px;
  }
  </style>
    
    
    @if($setting)
        <link rel="icon" href="{{asset('uploads/setting/'.$setting->favicon)}}" type="image/gif" sizes="16x16">
    @endif

</head>
<body>
    <header class="header">
        <div class="header-top">

        </div>
        <div class="header-middle" style="background:url('images/background.png')no-repeat; width: 100%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 cl-xs-12">
                        <div class="logo-section" style="margin-left:70px;">
                            <a href="{{ route('index') }}">
                                <div class="logo-img">
                                    <img src="{{ asset('uploads/setting/'.$setting->logo) }}" class="img-fluid">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 cl-xs-6 search-top">
                        <form method='get' action='{{route("search")}}' style="">
                            <div class="form-group">
                                <input type='text' name='keyword' class=' search rounded-0' placeholder='Enter Name, company, Mobile'>
                                <button class='btn btn-success rounded-0 top-search-font-icon'><i class='fa fa-search'></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 cl-xs-6 d-flex justify-content-center">
                        <div class="header-social" style="margin-left: -30%;">
                            <ul>
                                <li><a target="_blank" href="{{ $setting->facebook }}" class="facebook"><i class="fa fa-facebook-official"></i></a></li>
                                <li><a target="_blank" href="{{ $setting->youtube }}" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a target="_blank" href="{{ $setting->linkedin }}" class="linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                <li><a target="_blank" href="{{ $setting->twitter }}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="header-bottom">
            <nav class="navbar navbar-expand-lg navbar-light web-bg">
              
              <button style="background: #fff;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class=" navbar-collapse d-lg-flex justify-content-lg-center" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ route('index') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <div class="dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)">About Us</a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/about-us">About Bagma</a>
                        <a class="dropdown-item" href="/all-executives">Managing Comittee</a>
                        <a class="dropdown-item" href="/all-advisors">Advisor Comittee</a>
                        <a class="dropdown-item" href="/all-advisors">Constituation</a>
                        <a class="dropdown-item" href="{{ route('page',[3,Str::slug('Contributors')]) }}">Contributors</a>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item">
                    <div class="dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)">Members</a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/member/registration">Member Ragistration</a>
                        <a class="dropdown-item" href="{{ route('search') }}">All Members</a>
                      </div>
                    </div>
                  </li>

                   <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs') }}">News</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('jobs') }}">Career</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('contactUs') }}">Contact Us</a>
                  </li>

                   @if(Session::has('login_status'))
                  <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link">Dashboard</a>
                  </li>
                  @else
                  <li class="nav-item">
                    <a href="/member/registration" class="nav-link">Registration</a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('studentLogin') }}" class="nav-link">Login</a>
                  </li>
                  @endif
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('notices') }}">Notice</a>
                  </li>
                </ul>
              </div>
            </nav>
        </div>
    </header>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="IQlNkHu9nvTU8jtJVcSJhFHhhUQfmiCoA2KWacYQ">

<title>ILLITERACY AND POVERTY ALLEVIATION ASSISTANCE ORGANIZATION (IPAO)</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/responsive.css')}}" rel="stylesheet">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->

<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://uddokta.tripleoneair.com/js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">
	<header class="main-header">
			<!--Header Top-->
		{{--
			<div class="header-top">
				<div class="auto-container">
					<div class="inner-container clearfix">
						<div class="top-left">
							<ul class="contact-list clearfix">
								<li><a href="#">info@ipaongo.org</a></li>
								<li>+880 1874-041113 </li>
							</ul>
						</div>
						<div class="top-right clearfix">
							<div class="outer-box">
								<ul class="social-icon-one">
									<a href="https://www.facebook.com/ipaongobd" target="_new">
										<img src="{{asset('images/social1.png')}}" alt="" id="headerLogo">
									</a>
									<a href="#">
									    <img src="{{asset('images/social2.png')}}" alt="" id="headerLogo">
									</a>
								   <a href="#">
									    <img src="{{asset('images/social3.png')}}" alt="" id="headerLogo">
									</a>
									<a href="" target="_new">
									<img src="{{asset('images/social4.png')}}" alt="" id="headerLogo">
									</a>
									<a href="https://www.youtube.com/channel/UCQT-DZSbLzssHX3R5iRrGSg" target="_new">
									<img src="{{asset('images/social5.png')}}" alt="" id="headerLogo">
									</a>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			style="padding:0 30px;"
		--}}
		
			<!-- End Header Top -->
			<section id="navTopSection" class="banner hidden-xs" style="background: linear-gradient(to right, #ffffff 34%, #00ccff 100%); padding:5px 0;">
				<div class="bg-white container">
					<ul class="navigation clearfix">
						<li class="sticky-headerItem mr-3">
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<a href="{{route('index')}}"><img class="logo" src="{{asset('images/logo1.png')}}" id="sticky-headerLogo" alt="ipaongo logo" ></a>
									<!--<img class="organization-name" src="{{ asset('images/ipago-banner.png') }}" alt="ipaongo banner" />-->
									<div style="width:auto;float:right;font-size:20px;margin-top:8px;">
									    <h3 style="font-size:24px;color:#00008b;">ILLITERACY AND POVERTY ALLEVIATION</h3>
									    <h4 style="font-size:24px;color:#00008b;">ASSISTANCE ORGANIZATION (IPAO)</h3>
									</div>
									<div class="logo-show">
										<img src="{{asset('images/imgpsh_fullsize_anim.png')}}" />
									</div>
								</div>
								<div class="col-md-3 col-xs-12 social-mail mt-4">
									<div class="social">
									    @php
									        $social = \App\Setting::first();
									    @endphp
									   
										<a href="@if($social) {{ $social->facebook }} @endif"><i style="color:#0F90F2;" class="fa fa-facebook-square facebook-color" aria-hidden="true"></i></a>
										<a href="@if($social) {{$social->youtube}} @endif"><i style="color:#FF0000;" class="fa fa-youtube-square youtube-color" aria-hidden="true"></i></a>
										<a href="@if($social) {{$social->linkedin}} @endif"><i style="color:#0077B5;" class="fa fa-linkedin-square linkdin" aria-hidden="true"></i></a>
										<a href="@if($social) {{$social->twitter}} @endif"><i style="color:#1A91DA;" class="fa fa-twitter-square twitter" aria-hidden="true"></i></a>
										<a href="@if($social) {{$social->instagram}} @endif"><i style="color:#EC4B52;" class="fa fa-instagram instagram" aria-hidden="true"></i></a>
										
									</div>
								</div>
								<div class="col-md-3 col-xs-12 social-mail" style="margin-top:8px;">
									
									<div class="reg-no">
										<p class="text-right">{{__('Charity Reg No : 1528')}}</p>
										<p class="reg">Email: {{__('info@ipaongo.org')}}</p>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</section>
			
			<!--Header-Upper-->
			<div class="header-upper">
				<div class="auto-container ">
					<div class="nav-outer clearfix" >
						<!-- Main Menu -->
						<div class="container">
						<nav class="main-menu">
							<div class="navbar-header">
								<a class="responsive-logo" href="{{route('index')}}">
									<img src="{{asset('images/logo1.png')}}" alt="Uddokter Golpo" id="sticky-headerLogo">
									<!--<img class="organization-name" src="{{ asset('images/ipago-banner.png') }}" alt="ipaongo banner" />-->
									<div style="width:auto;float:right;font-size:20px;margin-top:18px;">
									    <h6 style="font-size:11px;color:#00008b; line-height:10px; font-weight:400;">ILLITERACY AND POVERTY ALLEVIATION</h6>
									    <h6 style="font-size:11px;color:#00008b; line-height:10px; font-weight:400;">ASSISTANCE ORGANIZATION (IPAO)</h6>
									</div>
								</a>
								<!-- Toggle Button -->
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<div class="navbar-collapse collapse clearfix">
								<ul class="navigation clearfix">
									{{--
									<li class="sticky-headerItem mr-3">
										<a href="{{route('index')}}">
											<img src="{{asset('images/logo1.png')}}" alt="Uddokter Golpo" id="sticky-headerLogo">
										</a>
									</li>
									--}}
									<li class="@if(Request::route()->getName()=='index') current @endif" style="margin-top:12px"><a href="{{route('index')}}">Home</a></li>
									<li class="dropdown" style="margin-top: 12px;"><a href="#">Projects</a>
										<ul>
											@php
												$gparent = \App\Project::where('parent', 0)->where('menu',1)->where('order','!=',0)->orderBy('order','asc')->get();
											@endphp
											@foreach($gparent AS $item)
											<li class="dropdown" style="margin-top:0px"><a class="goto" href="{{route('project',[$item->id, $item->slug])}}">{{$item->title}}</a>
												@php
													$parents = \App\Project::where('parent', $item->id)->where('menu',1)->get();
												@endphp
												@if(count($parents)>0)
													<ul>
													@foreach($parents AS $parent)
														<li><a href="{{route('project',[$parent->id, $parent->slug])}}">{{$parent->title}}</a>
														@php
															$childs = \App\Project::where('parent', $parent->id)->where('menu',1)->get();
														@endphp
															@if(count($childs)>0)
																<ul>
																	@foreach($childs AS $child)
																	<li><a href="{{route('project',[$child->id, $child->slug])}}">{{$child->title}}</a></li>
																	@endforeach
																</ul>
															@endif
														</li>
													@endforeach
													</ul>
												@endif
											</li>
											@endforeach
										</ul>
									</li>
									<li class="dropdown @if(Request::route()->getName()=='about') current @endif" style="margin-top:12px"><a href="#"> About Us </a>
										<ul>
											@php
												$subabout = \App\Page::whereIn('id', [4,5,6,7,9])->get();
											@endphp
											@foreach($subabout AS $item)
											<li><a href="{{route('page', [$item->id, $item->slug])}}">{{$item->title}}</a></li>
											@endforeach
											<li class=""><a href="{{route('all.member')}}"> Who We Are </a></li>
										</ul>
									</li>
									<li class="dropdown " style="margin-top:12px"><a href="#">Media</a>
										<ul>
											<li class=""><a href="{{route('media.coverage')}}"> Media Coverage </a></li>
											<li class=""><a href="{{route('news')}}"> News and Event </a></li>
											<li class=""><a href="{{route('bulletin.show')}}"> Bulletin </a></li>
											<li class=""><a href="{{route('gallery')}}"> Photo Galllery </a></li>
											<li class=""><a href="{{route('show.video')}}"> Video Gallery </a></li>
										</ul>
									</li>
									<li class="" style="margin-top: 12px;"><a href="{{route('page', [8,'network'])}}">Activities</a></li>
									<li class="@if(Request::route()->getName()=='contactUs') current @endif" style="margin-top:12px">
										<a href="{{route('contactUs')}}">Contact Us</a>
									</li>
									
									@if(Session::get('login_status')==1)
									<li class="@if(Request::route()->getName()=='profile.index') current @endif" style="margin-top:12px">
										<a href="{{route('profile.index')}}" ><span> Profile</span></a>
									</li>
									<li class="" style="margin-top:10px">
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
											<span> Logout</span>
										</a>
									</li>
									<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
									@else
									{{--
									<li class="@if(Request::route()->getName()=='studentRegistration') current @endif" style="margin-top:12px">
									<a href="{{route('studentRegistration')}}" ><span> Registration</span></a>
									</li>
									--}}
									<!--<li class="@if(Request::route()->getName()=='studentLogin') current @endif" style="margin-top:12px">-->
									<!--<a href="{{route('studentLogin')}}" ><span> Login</span></a>-->
									<!--</li>-->
									@endif

									
									
									<!--<li class="dropdown @if(Request::route()->getName()=='gallery') current @endif"><a class="blood" href="{{route('gallery')}}"> Donate Blood </a>-->
									<!--	<ul>-->
									<!--		<li><a href="{{route('blood.doner')}}">Be a Donor </a></li>-->
									<!--		<li><a href="{{ route('blood.doner.list')}}"> Donor List </a></li>-->
									<!--		<li><a href="{{ route('blood.volunteer.list')}}"> Volunteer </a></li>-->
									<!--	</ul>-->
									<!--</li>-->
									<li class="dropdown @if(Request::route()->getName()=='gallery') current @endif"><a class="blood" href="{{route('gallery')}}"> Blood </a>
										<ul>
											<li><a href="{{route('blood.doner')}}"> Donate Blood </a></li>
											<li><a href="{{ route('blood.doner.list')}}"> Take Blood </a></li>
											<li><a href="{{route('studentLogin')}}"> Login </a></li>
										</ul>
									</li>
									<li class="dropdown @if(Request::route()->getName()=='gallery') current @endif"><a class="volunteer" href="{{route('gallery')}}"> Get Involved </a>
										<ul>
											<li><a href="{{url('/volunteer/register')}}">Be a Volunteer </a></li>
											<li><a href="{{ route('blood.volunteer.list')}}"> Volunteer </a></li>
											<li><a href="{{route('studentLogin')}}"> Login </a></li>
										</ul>
									</li>
									<li class="@if(Request::route()->getName()=='show.video') current @endif"><a class="donate" href="{{route('donate.show')}}"> Donate Now </a></li>
									<li>
										<div style="width:0px;" id="google_translate_element"></div>

									<script type="text/javascript">
										function googleTranslateElementInit() {
											new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
										}
									</script>
									</li>
								</ul>
							</div>
						</nav>
						</div>
						<!-- Main Menu End-->

						<!-- Outer Box -->
						<!-- <div class="outer-box2">
							<a href="/donate" class="theme-btn btn-style-one"><span>Donate Us</span></a>
						</div> -->
					</div>
				</div>
			</div>
			<!--End Header Upper-->


			<!-- Sticky Header -->
			<div class="sticky-header">
				<!--<div class="container clearfix">-->
				<div>
					<!--Logo-->
					<!-- <div class="logo pull-left">
						<a href="/" title=""><img src="images/logo-small.png" alt="" title=""></a>
					</div> -->
					<!--Right Col-->
					<div class="">
						<!-- Main Menu -->
						<nav class="main-menu mx-auto">
							<div class="navbar-collapse collapse clearfix bg-gray-300">
								<ul class="navigation clearfix">
									<li class="sticky-headerItem mr-3">
										<a href="{{route('index')}}">
											<img src="{{asset('images/logo1.png')}}" alt="Uddokter Golpo" id="sticky-headerLogo">
										</a>
									</li>
									<li class="@if(Request::route()->getName()=='index') current @endif" style="margin-top:12px"><a href="{{route('index')}}">Home</a></li>

									<li class="dropdown" style="margin-top: 12px;"><a href="#">Projects</a>
										<ul>
											@php
												$gparent = \App\Project::where('parent', 0)->where('menu',1)->where('order','!=',0)->orderBy('order','asc')->get();
											@endphp
											@foreach($gparent AS $item)
											<li class="dropdown" style="margin-top:0px"><a href="{{route('project',[$item->id, $item->slug])}}">{{$item->title}}</a>
												@php
													$parents = \App\Project::where('parent', $item->id)->where('menu',1)->get();
												@endphp
												@if(count($parents)>0)
													<ul>
													@foreach($parents AS $parent)
														<li><a href="{{route('project',[$parent->id, $parent->slug])}}">{{$parent->title}}</a>
														@php
															$childs = \App\Project::where('parent', $parent->id)->where('menu', '1')->get();
														@endphp
															@if(count($childs)>0)
																<ul>
																	@foreach($childs AS $child)
																	<li><a href="{{route('project',[$child->id, $child->slug])}}">{{$child->title}}</a></li>
																	@endforeach
																</ul>
															@endif
														</li>
													@endforeach
													</ul>
												@endif
											</li>
											@endforeach
										</ul>
									</li>

									<li class="dropdown @if(Request::route()->getName()=='about') current @endif" style="margin-top:12px"><a href="{{route('about')}}"> About Us </a>
										<ul>
											@php
												$subabout = \App\Page::whereIn('id', [4,5,6,7])->get();
											@endphp
											@foreach($subabout AS $item)
											<li><a href="{{route('page', [$item->id, $item->slug])}}">{{$item->title}}</a></li>
											@endforeach
											<li class=""><a href="{{route('all.member')}}"> Who We Are </a></li>
										</ul>
									</li>
									<li class="dropdown " style="margin-top:12px"><a href="{{route('about')}}">Media</a>
										<ul>
											<li class=""><a href="{{route('all.member')}}"> Media Coverage </a></li>
											<li class=""><a href="{{route('news')}}"> News and Event </a></li>
											<li class=""><a href="{{route('area.volunter')}}"> Bulletin </a></li>
											<li class=""><a href="{{route('gallery')}}"> Photo Galllery </a></li>
											<li class=""><a href="{{route('show.video')}}"> Video Gallery </a></li>
										</ul>
									</li>
									<li class="" style="margin-top: 12px;"><a href="{{route('page', [8,'network'])}}">Activities</a></li>
									<li class="@if(Request::route()->getName()=='contactUs') current @endif" style="margin-top:12px">
										<a href="{{route('contactUs')}}">Contact Us</a>
									</li>

									@if(Session::get('login_status')==1)
									<li class="@if(Request::route()->getName()=='profile.index') current @endif" style="margin-top:12px">
									<a href="{{route('profile.index')}}" ><span> Profile</span></a>
									</li>
									<li class="" style="margin-top:12px">
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
											<span> Logout</span>
										</a>
									</li>
										<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									@else
									{{--
									<li class="@if(Request::route()->getName()=='studentRegistration') current @endif" style="margin-top:12px">
									<a href="{{route('studentRegistration')}}" ><span> Registration</span></a>
									</li>
									--}}
									<!--<li class="@if(Request::route()->getName()=='studentLogin') current @endif" style="margin-top:12px">-->
									<!--<a href="{{route('studentLogin')}}" ><span> Login</span></a>-->
									<!--</li>-->
									@endif

									
									<!--<li class="dropdown @if(Request::route()->getName()=='gallery') current @endif" style="margin-top:12px"><a class="blood" href="{{route('gallery')}}">Donate Blood</a>-->
									<!--	<ul>-->
									<!--		<li><a href="{{route('blood.doner')}}">Be a Donor </a></li>-->
									<!--		<li><a href="{{ route('blood.doner.list')}}"> Donor List </a></li>-->
									<!--		<li><a href="{{ route('blood.volunteer.list')}}"> Volunteer </a></li>-->
									<!--	</ul>-->
									<!--</li>-->
									<li class="dropdown @if(Request::route()->getName()=='gallery') current @endif" style="margin-top:12px; margin-right:15px; margin-left:15px"><a class="blood" href="{{route('gallery')}}"> Blood </a>
										<ul>
											<li><a href="{{route('blood.doner')}}"> Donate Blood </a></li>
											<li><a href="{{ route('blood.doner.list')}}"> Take Blood </a></li>
											<li><a href="{{route('studentLogin')}}"> Login </a></li>
										</ul>
									</li>
									<li class="dropdown @if(Request::route()->getName()=='gallery') current @endif" style="margin-top:6px; margin-right:15px;"><a class="volunteer" href="{{route('gallery')}}"> Get Involved </a>
										<ul>
											<li><a href="{{route('blood.doner')}}">Be a Volunteer </a></li>
											<li><a href="{{ route('blood.volunteer.list')}}"> Volunteer </a></li>
											<li><a href="{{route('studentLogin')}}"> Login </a></li>
										</ul>
									</li>
									<li class="@if(Request::route()->getName()=='show.video') current @endif" style="margin-top:12px"><a class="donate" href="{{route('donate.show')}}"> Donate Now</a></li>
								    <li style="margin-top:12px; text-transform: none !important;"><a style="color:#000;text-transform: none;" href="#">Email: info@ipaongo.org</a></li>	
								</ul>
							</div>
						</nav><!-- Main Menu End-->
					</div>
				</div>
			</div>
		</header>
	<!--Page Title-->
	@if(Request::route()->getName()!='index')
	{{--<section class="page-title" style="background-image:url({{asset('images/background/37.jpg')}});">
		<div class="auto-container">
			<div class="title-box">
			<h1>Our Organization</h1>
				<ul class="bread-crumb clearfix">
					<li><a href="{{route('index')}}">Home </a></li>
					<li>Our Organization</li>
				</ul>
			</div>
		</div>
	</section>--}}
	@endif
	<!--End Page Title-->