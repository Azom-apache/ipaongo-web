@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | I need Job</title>
<meta name="description" content="">
@endpush
<section class="page-title">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">I need Job</li>
	  </ol>
	</nav>
</section>
<div class="page-content mb-5">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-title text-center">
				<h1>I need Job</h1>
			</div>
			<div class="page-description">
				<div class="row">
					@foreach($advertisements as $advertisement)
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-4">
							<div class="blog-item">
								<a href="{{ route('advertisement',[$advertisement->id,Str::slug($advertisement->title)]) }}">
									<div class="blog-image">
										<img class="img-fluid" alt="{{ env("APP_NAME")."  ".$advertisement->title }}" src="{{ asset('uploads/advertisements/'.$advertisement->image) }}">
									</div>
									<div class="blog-title text-center text-uppercase">
										<h4>{{ $advertisement->title }}</h4>
									</div>
								</a>
							</div>
						</div>
					@endforeach
				</div>
				<div class="row">
					<div class="col-lg-12 d-flex justify-content-center">
						{{ $advertisements->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection