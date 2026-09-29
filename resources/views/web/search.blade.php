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
	    <li class="breadcrumb-item active" aria-current="page">Profiles Search</li>
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
									 <form class="registration">
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
										<input type="text" id="present_company"  name="present_company" class="form-control">
									</div>
									<div class="form-group d-none">
										<label for="">Education</label>
										<input type="text" id="education" name="education" value="" class="form-control" required="">
									</div>
									<!-- <div class="form-group">
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
									</div> -->
									<!-- <div class="form-group">
										<label for="">Batch</label>
										<input type="text" id="batch" class="form-control">
									</div> -->
										

									<div class="form-group">
										<label for="">Profession</label>
										<select name="" id="district" class="form-control">
											<option value="">Select Profession</option>
											@php
												$districts =\App\District::get();
											@endphp
											@foreach($districts as $district)
											 <option value="{{ $district->id }}">{{ $district->district_name }}</option>
											@endforeach
										</select>
									</div>
										<!-- <div class="form-group">
											<label for="">Area</label>
											<select name="" id="area" class="form-control">
												<option value="">Select area</option>
											</select>
										</div> -->
										<div class="form-group">
											<label for="">Bloog group</label>
											<select name="blood_group" id="blood_group" class="form-control">
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
									</form>
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<div class="row" id="showProfiles">
									@foreach($profiles as $profile)
										<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-4">
											<div class="blog-item">
												{{--<a href="{{ route('profileShow',$profile->id) }}">--}}
													<div class="blog-image">
														<img style="max-height: 300px; width: 100%" class="img-fluid" alt="{{ env("APP_NAME")."  ".$profile->name }}" src="{{ asset('uploads/profiles/'.$profile->image) }}">
													</div>
													<div class="blog-title text-center text-uppercase">
														<h4>{{ $profile->name }}</h4>
														<h6>Mobile : {{ $profile->mobile }}</h6>
														<h6>Factory : {{ $profile->present_company }}</h6>
													</div>
												{{--</a>--}}
											</div>
										</div>
									@endforeach
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
		var education = document.getElementById('education').value;
		//var batch = document.getElementById('batch').value;
		//var department = document.getElementById('department').value;
		var district = document.getElementById('district').value;
		//var area = document.getElementById('area').value;
		var blood_group = document.getElementById('blood_group').value;
		var mobile = document.getElementById('mobile').value;
		var present_company = document.getElementById('present_company').value;

		var url = "name="+name+"&education="+education+"&district="+district+"&blood_group="+blood_group+"&mobile="+mobile+"&present_company="+present_company;
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