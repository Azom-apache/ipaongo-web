@extends('layouts.profiles.master')
@section('content')
      <div id="content" class="p-4 p-md-5">
        @include('layouts.profiles.nav')
        @include('layouts.admin.errors')

      </div>
		
@endsection
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

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    {{--<div class="preloader"></div>--}}

    <!-- Main Header-->
    @include('layouts.web.header')
    <!--End Main Header -->
		
	<!-- Video Section -->
	<section class="video-section">
		<div class="auto-container" style="width:70%">
			<div class="sec-title">
					 <h2 class="text-center">{{__('Registration')}}</h2>
			</div>
			<div class="row clearfix">
				<!-- Content Column -->
				<div class="content-column pull-right col-md-12 col-sm-12 col-xs-12">
					<div class="inner-column">
						<div class="sec-title">
	<form class="form-horizontal" method="post" action="{{route('studentStore')}}" style="height: auto !important;">
			@include('layouts.admin.errors')
            @csrf
            <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">Name:</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input value="{{old('name')}}" type="text" name="name" class="name form-control" id="name" placeholder="Full Name*" required="">
                </div>
              </div>
            </div>
			<div class="row">
				<div class="col-sm-6" style="padding-right:20px">
					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Batch No:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <input value="{{old('batch')}}" type="text" name="batch" class="name form-control"  placeholder="Batch No*" required="">
						</div>
					  </div>
					</div>


					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Company:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <input value="{{old('company')}}" type="text" name="company" class="company form-control" id="company" placeholder="Company Name (if any)">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Position:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <select name="position" class="form-control">
							<option value="position">Position</option>
							<option value="Director">Director</option>
							<option value="proprietor">Proprietor</option>
							<option value="Founder &amp; CEO">Founder &amp; CEO</option>
							<option value="Manager">Manager</option>
							<option value="employee">Employee</option>
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Business Area:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <select name="business_area" class="form-control">
							  <option value="position">Business Area</option>
							  <option value="Software">Software</option>
							  <option value="IT">IT</option>
							  <option value="E-commerce">E-commerce</option>
							  <option value="Electronics">Electronics</option>
							  <option value="Garments">Garments</option>
							  <option value="Others">Others</option>
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">No Of Employee:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('no_of_employee')}}" type="text" name="no_of_employee" class="company form-control" id="employes" placeholder="No. Of Employes">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Blood group:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<select name="blood_grp" class="form-control">
								<option value="position">Blood group</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
							</select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Blood Doner?:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <select name="blood_donor" class="form-control">
							  <option value="position">Blood Doner?</option>
							  <option value="1">Yes</option>
							  <option value="0">No</option>
						  </select>
						</div>
					  </div>
					</div>



					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Gender:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <select name="gender" class="form-control">
							  <option value="position">Gender</option>
							  <option value="Male">Male</option>
							  <option value="Female">Female</option>
							  <option value="Others">Others</option>
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Birth Date:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('birth_date')}}" name="birth_date" id="datepicker" placeholder="birth:YYYY-MM-DD" class="textbox-n form-control" type="text" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">About You:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<textarea class="form-control" name="about_you" id="" cols="30" rows="5" placeholder="About You">{{old('about_you')}}</textarea>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">About Business:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<textarea class="form-control" name="about_business" id="" cols="30" rows="5" placeholder="About Your Business(If have any Business)">{{old('about_business')}}</textarea>
						</div>
					  </div>
					</div>
				</div>
				<div class="col-sm-6" style="padding-left:20px">
					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Address:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('address')}}" type="text" name="address" class="address form-control" id="address" placeholder="Address" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">District:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('district')}}" type="text" name="district" class="district form-control" id="district" placeholder="District" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Country:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('country')}}" type="text" name="country" class="country form-control" id="country" placeholder="Country" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Nationality:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('nationality')}}" type="text" name="nationality" class="moblie form-control"  placeholder="Nationality">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Moble Number:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('mobile')}}" type="text" name="mobile" class="moblie form-control"  placeholder="Phone Number" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Facebook Profile Link:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{old('fb_link')}}" type="text" name="fb_link" class="facebook form-control" id="facebook" placeholder="Facebook Profile Link">
						</div>
					  </div>
					</div>



					<div class="form-group">
					  <label for="email" class="cols-sm-2 control-label">Email:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
						  <input value="{{old('email')}}" type="email" name="email" id="your_email" class="input-text form-control" required="" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="Your Email*">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="password" class="cols-sm-2 control-label">Password:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-lock fa-lg " aria-hidden="true"></i></span>
						  <input type="password" name="password" class="Pwd form-control" id="Pwd" placeholder="Password" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="username" class="cols-sm-2 control-label">Responsibilities:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-users fa" aria-hidden="true"></i></span>
						  <select name="responsibilities" class="form-control">
							  <option value="Member">Member</option>
							  <option value="Core Volunteer">Core Volunteer</option>
							  <option value="District Ambassador">District Ambassador</option>
							  <option value="Campus Ambassador">Campus Ambassador</option>
							  <option value="Country Ambassador">Country Ambassador</option>
							  <option value="Community Volunteer">Community Volunteer</option>
							  <option value="Web Team Member">Web Team Member</option>
							  <option value="Moderator">Moderator</option>
							  
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="password" class="cols-sm-2 control-label">want to be Volunteer?:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-lock fa-lg " aria-hidden="true"></i></span>
						  <select name="volunteer" class="form-control">
							  <option value="position">want to be Volunteer?</option>
							  <option value="">Already Volunteer</option>
							  <option value="1">Yes</option>
							  <option value="0">No</option>
						  </select>
						</div>
					  </div>
					</div>

				  
					<div class="form-group">
					  <label for="confirm" class="cols-sm-2 control-label">Entrepreneur/Businessman?:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
						  <select name="entrepreneur" class="form-control">
							<option value="position">Entrepreneur/Businessman?</option>
							  <option value="1">Yes</option>
							  <option value="0">No</option>
						  </select>
						</div>
					  </div>
					</div>
				</div>
			</div>
					<div class="form-group ">
					  <button type="submit" name="submit" class="btn btn-success btn-lg btn-block login-button">Registration</button>
					</div>
					<div class="login-register">
						<a href="login.php">Already have an account?</a>
					</div>
          </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Video Section -->
	
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