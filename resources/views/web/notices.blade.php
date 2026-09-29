@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Notices</title>
<meta name="description" content="">
@endpush
<section class="page-title">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Notices</li>
	  </ol>
	</nav>
</section>
<div class="page-content mb-5">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-title text-center">
				<h1>Notices</h1>
			</div>
			<div class="page-description">
				<div class="row">
					@foreach($notices as $notice)
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-4">
							<div class="blog-item">
								<a href="{{ route('notice',[$notice->id,Str::slug($notice->title)]) }}">
									<div class="blog-image d-none">
										<img class="img-fluid" alt="{{ env("APP_NAME")."  ".$notice->title }}" src="{{ asset('uploads/jobs/'.$notice->image) }}">
									</div>
									<div class="blog-title text-center text-uppercase">
										<h4>{{ $notice->title }}</h4>
									</div>
								</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection