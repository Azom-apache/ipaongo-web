@extends('layouts.profiles.master')
@section('content')
	  <div id="content" class="p-4 p-md-5">
	      @include('layouts.profiles.nav')
	  	@include('layouts.admin.errors')
	  	<div class="row">
	  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  			<div class="card">
	  				<div class="card-header">
	  					Update Profile
	  				</div>
	  				<div class="card-body">
	  				<form action="{{ route('profile.updateProfile',$profile->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method("PATCH")
						@include('layouts.admin.errors')
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<!-- <div class="form-group">
									<label for="">Student ID</label>
									<input type="text"  value="{{ $profile->username }}" class="form-control" disabled="">
								</div> -->
							
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" name="name" value="{{ $profile->name }}" class="form-control" required="">
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="email" name="email_address" value="" class="form-control" value="{{ $profile->email }}" required="">
								</div>

								<div class="form-group">
									<label for="">Father's Name</label>
									<input type="text" name="fathers_name" value="{{ $profile->fathers_name }}" class="form-control" required="">
								</div>

								<div class="form-group">
									<label for="">Marrital Status</label>
									<!-- <select class="form-control" name="marrital_status" >
										<option value="" > Please Select</option>
										<option @if($profile->marrital_status == "married") selected @endif value="married">Married</option>
										<option @if($profile->marrital_status == "single") selected @endif value="single">Single</option>
									</select> -->
									<input type="text" name="marrital_status" value="{{ $profile->marrital_status }}" class="form-control" required="">
								</div>
								<div class="form-group">
									<label for="">Family Member</label>
									<input type="text" name="family_member" value="{{ $profile->family_member }}" class="form-control" required="">
								</div>
								
							
								<!-- <div class="form-group">
									<label for="">Batch</label>
									<input type="text" name="batch" value="{{ $profile->username }}" class="form-control" required="">
								</div> -->

								<div class="form-group">
									<label for="">National ID</label>
									<input type="" value="{{ $profile->nid }}" name="nid" class="form-control">
								</div>

								<div class="form-group">
									<label for="">Passport</label>
									<input type="" value="{{ $profile->passport }}" name="passport" class="form-control">
								</div>

								<div class="form-group d-none">
									<label for="">Institute Name</label>
									<input type="text" name="institute_name" value="{{ old('institute_name') }}" class="form-control">
								</div>

								<!-- <div class="form-group">
									<label for="">Department</label>
									<select name="department_id" id="" class="form-control" required="">
										<option value="" selected="" disabled="">Please Select</option>
										@foreach(\App\Department::all() as $department)
										<option @if($profile->department_id == $department->id) selected @endif value="{{ $department->id }}">{{ $department->department_name }}</option>
										@endforeach
									</select>
								</div> -->
								<div class="form-group">
									<label for="">Future Plan</label>
									<textarea name="future_plan" v class="form-control">{{ $profile->future_plan }}</textarea>
									
								</div>
                                

								<div class="form-group">
									<label for="">Company (Present ) </label>
									<input type="text" name="company" value="{{ $profile->present_company }}" class="form-control" required="">
								</div>

								<div class="form-group">
									<label for="">Permanent Address</label>
									<textarea name="permanent_address" class="form-control">{{ $profile->permanent_address }}</textarea>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="">Designation</label>
									<select id="district_id" name="district_id" required class="form-control">
										<option value="" disabled="" selected="">Please select</option>
										@foreach($districts as $district)
										<option @if($district->id == $profile->district_id) selected  @endif value="{{ $district->id }}">{{ $district->district_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="">Date of Birth</label>
									<input type="date" value="{{ $profile->date_of_birth }}" name="date_of_birth" class="form-control">
								</div>
								<!-- <div class="form-group">
									<label for="">Area</label>
									<select name="area_id" id="areaOptions" class="form-control">
										@php
											$area = \App\Area::where('id',$profile->area_id)->first();	
										@endphp
										@if($area)
										<option value="{{ $area->id }}">{{ $area->area }}</option>
										@else
										<option value="">Please District First</option>
										@endif

									</select>
								</div> -->
								<div class="form-group">
									<label for="">Mobile</label>
									<input type="" value="{{ $profile->mobile }}" name="mobile" class="form-control">
								</div>
								    <div class="form-group">
									<label for="">Mother's Name</label>
									<input type="text" name="mothers_name" value="{{ $profile->mothers_name }}" class="form-control" required="">
								</div>
								<div class="form-group">
									<label for="">Blood Group</label>
									<select class="form-control" name="blood_group" >
										<option value="" > Please Select</option>
										<option @if($profile->blood_group == "A+") selected @endif value="A+">A+</option>
										<option @if($profile->blood_group == "B+") selected @endif value="B+">B+</option>
										<option @if($profile->blood_group == "O+") selected @endif value="O+">O+</option>
										<option @if($profile->blood_group == "AB+") selected @endif value="AB+">AB+</option>
										<option @if($profile->blood_group == "A-") selected @endif value="A-">A-</option>
										<option @if($profile->blood_group == "B-") selected @endif value="B-">B-</option>
										<option @if($profile->blood_group == "O-") selected @endif value="O-">O-</option>
										<option @if($profile->blood_group == "AB-") selected @endif value="AB-">AB-</option>
									</select>
								</div>
								<div class="form-group d-none">
									<label for="">Education</label>
									<textarea name="education" class="form-control">{{ $profile->education }}</textarea>
								</div>
								<div class="form-group">
									<label for="">First starting date ( with Factory Name )</label>
									<textarea name="job_history"  class="form-control">{{ $profile->job_history }}</textarea>
								</div>
								
								<div class="form-group">
									<label for="">Company Name ( Present ) </label>
									<input type="text" name="present_company" value="{{ $profile->present_company }}" class="form-control" required="">
								</div>
								
								<div class="form-group">
									<label for="">Company (Previous ) </label>
									<input type="text" name="previous_company" value="{{ $profile->previous_company }}" class="form-control" required="">
								</div>
								
								<div class="form-group">
									<label for="">Years of Experience</label>
									<input type="text" name="batch" value="{{ $profile->batch }}" class="form-control" required="">
								</div>

								<div class="form-group">
									<label for="">Religion</label>
									<input type="text" name="religion" value="{{ $profile->religion }}" class="form-control" required="">
								</div>

								<div class="form-group">
									<label for="">Present Address</label>
									<textarea name="present_address" v class="form-control">{{ $profile->present_address }}</textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="">Username (Student ID)</label>
									<input type="text" readonly value="{{ $profile->username }}" required="" name="email" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Image</label>
									<input type="file"   name="image" class="form-control">
									<input type="hidden" name="old_image" value="{{ $profile->image }}">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="">Password</label>
									<input type="password"   name="password" min="8" class="form-control">
								</div>
								<h3>Nominee</h3>
    							<div class="form-group">
    								<label for="">Name </label>
    								<input type="text" value="{{ $profile->nominee_name }}" required="" name="nominee_name" class="form-control">
    							</div>
    							<div class="form-group">
    								<label for="">Relation </label>
    								<input type="text" value="{{ $profile->nominee_relation }}" required="" name="nominee_relation" class="form-control">
    							</div>
    							<div class="form-group">
    								<label for="">Contact </label>
    								<input type="text" value="{{ $profile->nominee_contact }}" required="" name="nominee_contact" class="form-control">
    							</div>
							</div>
							
							
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button class="btn btn-success">Register</button>
							</div>
						</div>
					</form>



	  				</div>
	  			</div>

	  		</div>
	  	</div>
      </div>

@push('js')
	<script>
		$('#district_id').change(function(){
			var district = $("#district_id").val();
			$.ajax({
				url: "{{ route('ajaxArea') }}?id="+district, 
				success: function(result){
					console.log(result);				   
				    $("#areaOptions").html(result);
				  }
			});			
		});
	</script>
@endpush

@endsection