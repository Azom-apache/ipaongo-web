@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Login</title>
<meta name="description" content="">
@endpush
<section class="page-title">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Login</li>
	  </ol>
	</nav>
</section>
<div class="page-content">
	<div class="row d-flex justify-content-center mb-4">
		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-header">
					<h3>Password Reset</h3>
				</div>
				<div class="card-body">
					<form id="verifyStudent" action="{{ route('setNewPassword') }}" method="post" >
						@csrf
						<input type="hidden" name="mail" value="@if(isset($email)){{$email}}@else{{$email}}@endif" />
						@include('layouts.admin.errors')
						<div class="form-group">
							<label>New Password</label>
							<input type="password" required="" name="password" class="form-control" placeholder="Set password">
						</div>
						
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" required="" name="confirmed" class="form-control" placeholder="Set confirm password">
						</div>
						
						<div class="form-group">
							<button class="btn btn-success">Submit</button>
						</label>
						</div>
						<div class='form-group'>
						    New Member ? Please click to <a class='text-success' href='/member/registration'>Register</a> here 
						</div>
						<div class='form-group'>
						    Want To Login? <a class='text-success' href='/member/login'>Click</a> here 
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection