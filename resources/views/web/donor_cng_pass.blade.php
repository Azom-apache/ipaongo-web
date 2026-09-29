<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="IQlNkHu9nvTU8jtJVcSJhFHhhUQfmiCoA2KWacYQ">

<title>{{config('app.name')}}</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="{{asset('plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="{{asset('plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/responsive.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://uddokta.tripleoneair.com/js/respond.js"></script><![endif]-->
</head>
<style>
    .nav-item a{
        font-weight:bold;
        color:#fff;
        font-size:17px;
    }
</style>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    {{--<div class="preloader"></div>--}}

    <!-- Main Header-->
    @include('layouts.web.header')
	<section class="video-section">
		<div class="auto-container" style="width:70%">
			<div class="sec-title">
					 <h2 class="text-center">{{__('Welcome')}} {{$person_info->name}}</h2>
			</div>
			@include('layouts.admin.errors')
			<div class="row clearfix">
				<!-- Content Column -->
				<div class="content-column col-md-4 col-sm-12 col-xs-12">
					<ul class="nav flex-column" style="background-color:#02CCFF;">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('donor_edit_profile')}}/{{$person_info->id}}">Edit Your Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('donor_pas_change')}}/{{$person_info->id}}">Password Change</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" tabindex="-1" aria-disabled="true">Logout</a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                      </li>
                    </ul>
				</div>
				<div class="content-column col-md-8 col-sm-12 col-xs-12">
				    <h4>Change Your Password</h4><br>
				    <h5 class="text-danger">{!! Session::get('error') !!}</h5>
					<form id="verifyStudent" action="{{ url('donor_pass_post') }}" method="post" >
						@csrf
						<div class="form-group">
							<label>Old Password</label>
							<input type="password" required="" name="oldpassword" class="form-control">
							<input type="hidden" required="" name="id" class="form-control" value="{{$person_info->id}}">
							<!--@if(Session::get('error'))-->
							<!--	<span id="error" class="text-danger d-none"> Old Password Doesnot Match </span>-->
							<!--@endif-->
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" required="" name="newpassword" class="form-control">
							@error('password')
							<div class="alert alert-danger">
							    <strong>{{$message}}</strong>
							</div>
							@enderror
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" required="" name="password_confirmation" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">Submit</button>
						</label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Revolution Slider-->
<script src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('js/main-slider-script.js')}}"></script>
<!--End Revolution Slider-->
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.js')}}"></script>
<script src="{{asset('js/owl.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/knob.js')}}"></script>
<script src="{{asset('js/appear.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>