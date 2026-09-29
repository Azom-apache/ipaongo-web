@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | {{ $bikroy->title }}</title>
<meta name="description" content="">
@endpush
<section class="page-title">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ route('buySales') }}">Advertisements</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $bikroy->title }}</li>
	  </ol>
	</nav>
</section>
<div class="page-content mb-5">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-title text-center">
				<h1>{{ $bikroy->title }}</h1>
			</div>
			<div class="page-description">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="blog-image">
							<img class="img-fluid" src="{{ asset('uploads/buy_sale/'.$bikroy->image) }}">
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
							{!! $bikroy->description !!}
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
				
			</div>
		</div>
	</div>
</div>
@push('js')
	<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d63b7bbd8f61d0012dc7a43&product=inline-share-share-buttons' async='async'></script>
@endpush
@endsection