@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Profiles</title>
<meta name="description" content="">
@endpush
<section class="page-title">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profiles</li>
      </ol>
    </nav>
</section>
<div class="page-content mb-5">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title text-center">
                <h1>Profiles</h1>
            </div>
            <div class="page-description">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h3>Filter Profile</h3>
                                    </div>
                                    <div class="card-body">
                                    <div class="form-group">
                                        <label for="">By Name</label>
                                        <input type="text" id="name"  name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">By Mobile</label>
                                        <input type="text" id="mobile"  name="mobile" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Company</label>
                                        <input type="text" id="company"  name="company" class="form-control">
                                    </div>
                                    <div class="form-group d-none">
                                        <label for="">Institute Name</label>
                                        <input type="text" id="institute" name="institute_name" value="" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                            <label for="">Department</label>
                                            <select name="" id="department" class="form-control">
                                                <option value="">Please Select</option>
                                                @php
                                                    $filters = \App\Department::get();    
                                                @endphp
                                                @foreach($filters as $filter)
                                                <option value="{{ $filter->id }}" >
                                                    {{ $filter->department_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Batch</label>
                                        <input type="text" id="batch" class="form-control">
                                    </div>
                                        

                                    <div class="form-group">
                                        <label for="">District</label>
                                        <select name="" id="district" class="form-control">
                                            <option value="">Select District</option>
                                            @php
                                                $districts =\App\District::get();
                                            @endphp
                                            @foreach($districts as $district)
                                             <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label for="">Area</label>
                                            <select name="" id="area" class="form-control">
                                                <option value="">Select area</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bloog group</label>
                                            <select name="" id="blood_group" class="form-control">
                                                <option  value="" > Please Select</option>
                                                <option  value="A+">A+</option>
                                                <option  value="B+">B+</option>
                                                <option  value="O+">O+</option>
                                                <option  value="AB+">AB+</option>
                                                <option  value="A-">A-</option>
                                                <option  value="B-">B-</option>
                                                <option  value="O-">O-</option>
                                                <option  value="AB-">AB-</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button onclick="filter()" class="btn btn-success">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="row" id="showProfiles">
                                    @foreach($profiles as $profile)
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-4">
                                            <div class="blog-item">
                                                <a href="{{ route('profileShow',$profile->id) }}">
                                                    <div class="blog-image">
                                                        <img style="max-height: 300px; width: 100%" class="img-fluid" alt="{{ env("APP_NAME")."  ".$profile->name }}" src="{{ asset('uploads/profiles/'.$profile->image) }}">
                                                    </div>
                                                    <div class="blog-title text-center text-uppercase">
                                                        <h4>{{ $profile->name }}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        {{ $profiles->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        $('#district').change(function(){
            var district = $("#district").val();
            $.ajax({
                url: "{{ route('ajaxArea') }}?id="+district, 
                success: function(result){

                    console.log(result);
                   
                    $("#area").html(result);


                  }
            });         
        });
    </script>
    <script>
    function filter(){
        var name = document.getElementById('name').value;
        var institute = document.getElementById('institute').value;
        var batch = document.getElementById('batch').value;
        var department = document.getElementById('department').value;
        var district = document.getElementById('district').value;
        var area = document.getElementById('area').value;
        var blood_group = document.getElementById('blood_group').value;
        var mobile = document.getElementById('mobile').value;
        var company = document.getElementById('company').value;

        var url = "name="+name+"&institute="+institute+"&batch="+batch+"&department="+department+"&district="+district+"&area="+area+"&blood_group="+blood_group+"&mobile="+mobile+"&company"+company;
        console.log(url);
        document.getElementById('showProfiles').innerHTML="<img class='img-fluid' src='/loading.gif' >";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                setTimeout('', 5000);
                document.getElementById('showProfiles').innerHTML=this.responseText;
                console.log(this.responseText);
            }
        };
        xhttp.open("GET", "{{ route('filter') }}?"+url, true);
        xhttp.send();

        
    }
</script>
@endpush
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
		<form class="form-horizontal" method="post" action="{{route('updateProfile', $profile->id)}}" style="height: auto !important;" enctype="multipart/form-data">
			@include('layouts.admin.errors')
            @csrf
			@method("PATCH")
            <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">Name:</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input value="{{$profile->name}}" type="text" name="name" class="name form-control" id="name" placeholder="Full Name*" required="">
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
						  <input value="{{$profile->batch}}" type="text" name="batch" class="name form-control"  placeholder="Batch No*" required="">
						</div>
					  </div>
					</div>


					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Company:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <input value="{{$profile->company}}" type="text" name="company" class="company form-control" id="company" placeholder="Company Name (if any)">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Position:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
						  <select name="position" class="form-control">
							<option >Position</option>
							<option @if($profile->position=='Director') SELECTED @endif value="Director">Director</option>
							<option @if($profile->position=='proprietor') SELECTED @endif value="proprietor">Proprietor</option>
							<option @if($profile->position=='Founder and CEO') SELECTED @endif value="Founder and CEO">Founder and CEO</option>
							<option @if($profile->position=='Manager') SELECTED @endif value="Manager">Manager</option>
							<option @if($profile->position=='employee') SELECTED @endif value="employee">Employee</option>
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
							  <option >Business Area</option>
							  <option @if($profile->business_area=='Software') SELECTED @endif value="Software">Software</option>
							  <option @if($profile->business_area=='IT') SELECTED @endif value="IT">IT</option>
							  <option @if($profile->business_area=='E-commerce') SELECTED @endif value="E-commerce">E-commerce</option>
							  <option @if($profile->business_area=='Electronics') SELECTED @endif value="Electronics">Electronics</option>
							  <option @if($profile->business_area=='Garments') SELECTED @endif value="Garments">Garments</option>
							  <option @if($profile->business_area=='Others') SELECTED @endif value="Others">Others</option>
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">No Of Employee:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->no_of_employee}}" type="text" name="no_of_employee" class="company form-control" id="employes" placeholder="No. Of Employes">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Blood group:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<select name="blood_grp" class="form-control">
								<option >Blood group</option>
								<option @if($profile->blood_group=='A+') SELECTED @endif value="A+">A+</option>
								<option @if($profile->blood_group=='A-') SELECTED @endif value="A-">A-</option>
								<option @if($profile->blood_group=='B+') SELECTED @endif value="B+">B+</option>
								<option @if($profile->blood_group=='B-') SELECTED @endif value="B-">B-</option>
								<option @if($profile->blood_group=='O+') SELECTED @endif value="O+">O+</option>
								<option @if($profile->blood_group=='O-') SELECTED @endif value="O-">O-</option>
								<option @if($profile->blood_group=='AB+') SELECTED @endif value="AB+">AB+</option>
								<option @if($profile->blood_group=='AB-') SELECTED @endif value="AB-">AB-</option>
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
							  <option >Blood Doner?</option>
							  <option @if($profile->blood_donor=='1') SELECTED @endif value="1">Yes</option>
							  <option @if($profile->blood_donor=='0') SELECTED @endif value="0">No</option>
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
							  <option >Gender</option>
							  <option @if($profile->gender=='Male') SELECTED @endif value="Male">Male</option>
							  <option @if($profile->gender=='Female') SELECTED @endif value="Female">Female</option>
							  <option @if($profile->gender=='Others') SELECTED @endif value="Others">Others</option>
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Birth Date:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->birth_date}}" name="birth_date" id="datepicker" placeholder="birth:YYYY-MM-DD" class="textbox-n form-control" type="text" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">About You:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<textarea class="form-control" name="about_you" id="" cols="30" rows="5" placeholder="About You">{{$profile->about_you}}</textarea>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">About Business:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<textarea class="form-control" name="about_business" id="" cols="30" rows="5" placeholder="About Your Business(If have any Business)">{{ $profile->about_business }}</textarea>
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
							<input value="{{$profile->address}}" type="text" name="address" class="address form-control" id="address" placeholder="Address" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">District:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->district}}" type="text" name="district" class="district form-control" id="district" placeholder="District" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Country:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->country}}" type="text" name="country" class="country form-control" id="country" placeholder="Country" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Nationality:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->nationality}}" type="text" name="nationality" class="moblie form-control"  placeholder="Nationality">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Moble Number:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->mobile}}" type="text" readonly class="moblie form-control"  placeholder="Phone Number" required="">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="name" class="cols-sm-2 control-label">Facebook Profile Link:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input value="{{$profile->fb_link}}" type="text" name="fb_link" class="facebook form-control" id="facebook" placeholder="Facebook Profile Link">
						</div>
					  </div>
					</div>



					<div class="form-group">
					  <label for="email" class="cols-sm-2 control-label">Email:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
						  <input value="{{$profile->email}}" readonly type="email" id="your_email" class="input-text form-control" required="" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="Your Email*">
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="password" class="cols-sm-2 control-label">Password:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-lock fa-lg " aria-hidden="true"></i></span>
						  <input type="password" name="password" class="Pwd form-control" id="Pwd" placeholder="Password" />
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="username" class="cols-sm-2 control-label">Responsibilities:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-users fa" aria-hidden="true"></i></span>
						  {{ $profile->responsibilities }}
						  {{-- 						  <select name="responsibilities" class="form-control">
							  <option @if($profile->responsibilities=='Member') SELECTED @endif value="Member">Member</option>
							  <option @if($profile->responsibilities=='District Ambassador') SELECTED @endif value="Core Volunteer">Core Volunteer</option>
							  <option @if($profile->responsibilities=='District Ambassador') SELECTED @endif value="District Ambassador">District Ambassador</option>
							  <option @if($profile->responsibilities=='Campus Ambassador') SELECTED @endif value="Campus Ambassador">Campus Ambassador</option>
							  <option @if($profile->responsibilities=='Country Ambassador') SELECTED @endif value="Country Ambassador">Country Ambassador</option>
							  <option @if($profile->responsibilities=='Community Volunteer') SELECTED @endif value="Community Volunteer">Community Volunteer</option>
							  <option @if($profile->responsibilities=='Web Team Member') SELECTED @endif value="Web Team Member">Web Team Member</option>
							  <option @if($profile->responsibilities=='Moderator') SELECTED @endif value="Moderator">Moderator</option>
						  </select> --}}
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="password" class="cols-sm-2 control-label">want to be Volunteer?:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class=" fa-lg " aria-hidden="true"></i></span>
						  <select name="volunteer" class="form-control">
							  <option >want to be Volunteer?</option>
							  <option value="">Already Volunteer</option>
							  <option @if($profile->volunteer=='1') SELECTED @endif value="1">Yes</option>
							  <option @if($profile->volunteer=='0') SELECTED @endif value="0">No</option>
						  </select>
						</div>
					  </div>
					</div>


					<div class="form-group">
					  <label for="confirm" class="cols-sm-2 control-label">Entrepreneur/Businessman?:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class=" fa-lg" aria-hidden="true"></i></span>
						  <select name="entrepreneur" class="form-control">
							<option >Entrepreneur/Businessman?</option>
							<option @if($profile->entrepreneur=='1') SELECTED @endif value="1">Yes</option>
							<option @if($profile->entrepreneur=='0') SELECTED @endif value="0">No</option>
						  </select>
						</div>
					  </div>
					</div>

					<div class="form-group">
					  <label for="file" class="cols-sm-2 control-label">File:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-file fa-lg " aria-hidden="true"></i></span>
						  <input type="file" name="image" class="form-control" id="Pwd" placeholder="file" />
						</div>
					  </div>
					  @if(!empty($profile->image))
					  <img src="{{asset('uploads/profiles/'.$profile->image)}}" width="35%" />
					  @endif
					</div>
				</div>
			</div>
			<div class="form-group ">
			  <button type="submit" name="submit" class="btn btn-success btn-lg btn-block login-button">Update</button>
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