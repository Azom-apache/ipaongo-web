@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | {{ $advertisement->title }}</title>
<meta name="description" content="">
@endpush
<section class="page-title">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('advertisements') }}">I need Job</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $advertisement->title }}</li>
	  </ol>
	</nav>
</section>
<div class="page-content mb-5">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-title text-center">
				<h1>{{ $advertisement->title }}</h1>
			</div>
			<div class="page-description">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="blog-image">
							<img class="img-fluid" src="{{ asset('uploads/advertisements/'.$advertisement->image) }}">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="w-100 p-2">
							@php
								$ads = \App\Ad::where('area','advertisement_view_top')->first();
							@endphp
							@if($ads)
								@if($ads->ad_type == 1)
								<img class="img-fluid" alt="{{ env('APP_NAME') }}" src="{{ asset('uploads/ads/'.$ads->image) }}">
								@else
									{!! $ads->code !!}
								@endif
							@endif
						</div>
						<div class="blog-social mt-3">
							<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
						</div>
						<div class="blog-description mt-5">
							{!! $advertisement->description !!}
						</div>
						<div class="w-100 p-2">
							@php
								$ads = \App\Ad::where('area','advertisement_view_bottom')->first();
							@endphp
							@if($ads)
								@if($ads->ad_type == 1)
								<img class="img-fluid" alt="{{ env('APP_NAME') }}" src="{{ asset('uploads/ads/'.$ads->image) }}">
								@else
									{!! $ads->code !!}
								@endif
							@endif
						</div>
					</div>
				</div>
				<div class="row mt-5">
					@foreach($advertisements as $item)
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-4">
							<div class="blog-item">
								<a href="{{ route('advertisement',[$item->id,Str::slug($item->title)]) }}">
									<div class="blog-image">
										<img class="img-fluid" alt="{{ env("APP_NAME")."  ".$item->title }}" src="{{ asset('uploads/advertisements/'.$item->image) }}">
									</div>
									<div class="blog-title text-center text-uppercase">
										<h4>{{ $item->title }}</h4>
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
@push('js')
	<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d63b7bbd8f61d0012dc7a43&product=inline-share-share-buttons' async='async'></script>
@endpush
@endsection