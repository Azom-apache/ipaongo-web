@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Student Id Verification</title>
<meta name="description" content="">
@endpush
<section class="page-title">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Student Id verification</li>
	  </ol>
	</nav>
</section>
<div class="page-content">
	<div class="row d-flex justify-content-center mb-4">
		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header">
					<h3>Verify Your student Id</h3>
				</div>
				<div class="card-body">
					<form id="verifyStudent" action="{{ route('veriftStudent') }}" method="post" >
						@csrf
						<div class="form-group">
							<label>Student ID</label>
							<input type="text" required="" name="student_id" class="form-control" placeholder="Enter You Student ID">
							<span id="error" class="text-danger d-none"> Student not Found </span>
						</div>
						<div class="form-group">
							<button class="btn btn-success">Submit</button>
						</label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@push('js')
	<script>
		$("#verifyStudent").submit(function(e) {
		    e.preventDefault(); 
		    var form = $(this);
		    var url = form.attr('action');		    
		    $.ajax({
		           type: "POST",
		           url: url,
		           data: form.serialize(), 
		           success: function(data)
		           {
		           	console.log(data);
		              if(data == 1){
		              	$("#error").addClass('d-none');
		              	window.location.replace("{{ route('studentRegistration') }}");
		              }else{
		              	$("#error").removeClass('d-none');
		              }
		           }
		         });
		    
		});
	</script>
	
@endpush
@endsection