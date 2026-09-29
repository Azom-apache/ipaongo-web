@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Registration</title>
<meta name="description" content="">
@endpush
<section class="page-title">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registration</li>
      </ol>
    </nav>
</section>
<div class="page-content mb-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card rounded-0">
                <div class="card-header rounded-0">
                    <h3>Sign Up</h3>
                </div>
                <div class="card-body" style="background: #c8c6c6;">
                    <form class="registration" action="{{ route('studentStore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('layouts.admin.errors')
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Profession</label>
                                    <select id="district_id" name="district_id" required class="form-control">
                                        <option value="" disabled="" selected="">Please select</option>
                                        @foreach($districts as $district)
                                        <option @if($district->id == old('district_id')) selected  @endif value="{{ $district->id }}">{{ $district->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email_address" value="{{old('email_address')}}" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Father's Name</label>
                                    <input type="text" name="fathers_name" value="{{old('fathers_name')}}" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Present Address</label>
                                    <textarea name="present_address" value="{{old('present_address')}}" class="form-control">{{old('present_address')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Company Name ( Present ) </label>
                                    <input type="text" name="present_company" value="{{old('present_company')}}" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">National ID (Optional)</label>
                                    <input type="text" name="nid" value="{{old('nid')}}" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Date of Birth</label>
                                    <input type="date" name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name',Session::get('student_name')) }}" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile</label>
                                    <input type="" name="mobile" value="{{old('mobile')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Mother's Name</label>
                                    <input type="text" name="mothers_name" value="{{old('mothers_name')}}" class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Permanent Address</label>
                                    <textarea name="permanent_address" class="form-control">{{old('permanent_address')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Company Name ( Previous ) </label>
                                    <input type="text" name="previous_company" value="{{old('previous_company')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Passport ( Optional )</label>
                                    <input type="text" name="passport" class="form-control" required="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
							  <option value="Dedicated Volunteer">Dedicated Volunteer</option>
							  <option value="Area Volunter">Area Volunter</option>
							  <option value="Districs Ambasador">Districs Ambasador</option>
							  <option value="Campus">Campus</option>
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
					<div class="form-group">
					  <label for="file" class="cols-sm-2 control-label">File:</label>
					  <div class="cols-sm-10">
						<div class="input-group">
						  <span class="input-group-addon iconbk"><i class="fa fa-file fa-lg " aria-hidden="true"></i></span>
						  <input type="file" name="image" class="form-control" id="Pwd" placeholder="file" />
						</div>
					  </div>
					</div>
				</div>
			</div>
					<div class="form-group ">
					  <button type="submit" name="submit" class="btn btn-success btn-lg btn-block login-button">Registration</button>
					</div>
					<div class="login-register">
						<a href="{{route('studentLogin')}}">Already have an account?</a>
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
