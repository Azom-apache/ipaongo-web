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
								
										<div class="page-title text-center">
											<h1>Profile of {{ $profile->name }}</h1>
										</div>
										<div class="page-description">
											<div class="row">
												
												<div class="col-lg-6 col-md-6 col-xs-12 col-xs-12">
													<table class="table table-bordered">
														<tbody>
															<tr class="bg-light">
																<td colspan="2" class="text-center"><b>Personal Information</b></td>
															</tr>
															<tr >
																<td style="width: 30%;">Name:</td>
																<td>{{ $profile->name }}</td>
															</tr>

															<tr >
																<td style="width: 30%;">Date of Birth:</td>
																<td>{{ $profile->date_of_birth }}</td>
															</tr>
															<tr >
																<td style="width: 30%;">Father's Name:</td>
																<td>{{ $profile->fathers_name }}</td>
															</tr>
															<tr >
																<td style="width: 30%;">Mother's Name:</td>
																<td>{{ $profile->mothers_name }}</td>
															</tr>
															<tr >
																<td style="width: 30%;">Marrital Status:</td>
																<td>{{ $profile->marrital_status }}</td>
															</tr>
															<tr >
																<td style="width: 30%;">Religion:</td>
																<td>{{ $profile->religion }}</td>
															</tr>
															
							                                
															@if($area)
															<tr>
																<td style="width: 30%;">Area:</td>
																<td>{{ $area->area_name }}</td>
															</tr>
															@endif

															<tr>
																<td style="width: 30%;">Present Address:</td>
																<td>{{ $profile->present_address }}</td>
															</tr>
															<tr>
																<td style="width: 30%;">Permanent Area:</td>
																<td>{{ $profile->permanent_address }}</td>
															</tr>
															<tr>
																<td style="width: 30%;">Blood Group:</td>
																<td>{{ $profile->blood_group }}</td>
															</tr>
															<tr>
																<td style="width: 30%;">Mobile:</td>
																<td>{{ $profile->mobile }}</td>
															</tr>
															<tr>
																<td style="width: 30%;">Email:</td>
																<td>{{ $profile->email }}</td>
															</tr>
															<tr>
																<td style="width: 30%;">National ID:</td>
																<td>{{ $profile->nid }}</td>
															</tr>
															<tr>
																<td style="width: 30%;">Passport:</td>
																<td>{{ $profile->passport }}</td>
															</tr>
														</tbody>
													</table>
													<table class="table table-bordered">
														<tr class="bg-light text-bold">
															<td class="text-center" colspan="2"><b>Education Informaion</b></td>
														</tr>
														<tr>
															<td style="width: 30%;"> Highest Education Qualification</td>
															<td>{{ $profile->education }}</td>
														</tr>
														@if($department)
														<tr>
															<td style="width: 30%;">Department</td>
															<td>{{ $department->department_name }}</td>
														</tr>
														@endif
																					
													</table>

													<table class="table table-bordered">
														<tr class="bg-light text-bold">
															<td class="text-center" colspan="2"><b>Professional Informaion</b></td>
														</tr>
														@if($district)
															<tr >
																<td style="width: 30%;">Profession:</td>
																<td>{{ $district->district_name }}</td>
															</tr>
														    @endif
														<tr>
															<td style="width: 30%;">Years of Experience</td>
															<td>{{ $profile->batch }}</td>
														</tr>
														<tr>
															<td style="width: 30%;">Present Company</td>
															<td>{{ $profile->present_company }}</td>
														</tr>
														<tr>
															<td style="width: 30%;">Previous Company</td>
															<td>{{ $profile->previous_company }}</td>
														</tr>

														<!-- 
														<tr>
															<td style="width: 30%;">Designation</td>
															<td>{{ $profile->designation }}</td>
														</tr>
														 -->
														 
														 <tr>
															<td style="width: 30%;">Job history</td>
															<td>{{ $profile->job_history }}</td>
														</tr>
														 
																		
													</table>

													<table class="table table-bordered">
														<tr class="bg-light text-bold">
															<td class="text-center" colspan="2"><b>About</b></td>
														</tr>
														<tr>
															<td style="width: 30%;">Future Plan</td>
															<td>{{ $profile->future_plan }}</td>
														</tr>
												    </table>		
												</div>
												<div class="col-md-6 col-md-3 col-sm-12 col-xs-12">
													<img class="img-fluid" src="{{ asset('uploads/profiles/'.$profile->image) }}" alt="{{ $profile->name }}">
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
		var company = document.getElementById('present_company').value;

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