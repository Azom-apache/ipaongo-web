@extends('layouts.profiles.master')
@section('content')
@push('css')
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
	  <div id="content" class="p-4 p-md-5">
	  @include('layouts.profiles.nav')
	  	@include('layouts.admin.errors')
	  	<div class="row">
	  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  			<div class="card">
	  				<div class="card-header">
	  					<h4> Edit Job </h4>
	  				</div>
	  				<div class="card-body">
	  					<form enctype="multipart/form-data" action="{{ route('profile.jobs.update',$job->id) }}" method="post">
	  						@csrf
	  						@method("PATCH")
	  						<div class="form-group">
	  							<label> Job Title </label>
	  							<input type="text" value="{{ $job->title }}" required name="title" class="form-control">
	  						</div>
	  						<div class="form-group">
	  							<label for="">Image</label>
	  							<input type="file" name="image" class="form-control">
	  							<input type="hidden" value="{{ $job->image }}" name="old_image">
	  						</div>
	  						<div class="form-group">
	  							<label for="">Description</label>
	  							<textarea name="description" required id="description" class="form-control">{{ $job->description }}</textarea>
	  						</div>
	  						<div class="form-group">
	  							<button class="btn btn-success">Update</button>
	  						</div>
	  					</form>
	  				</div>
	  			</div>	  			
	  		</div>
	  	</div>

      </div>
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
	$(document).ready(function() {
	  $('#description').summernote();
	});
</script>
@endpush			
@endsection