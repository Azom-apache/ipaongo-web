@if(count($profiles) > 0)

@foreach($profiles as $profile)
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-4">
		<div class="blog-item">
			<a href="{{ route('profileShow',$profile->id) }}">
				<div class="blog-image">
					<img style="max-height: 300px; width: 100%" class="img-fluid" alt="{{ env("APP_NAME")."  ".$profile->name }}" src="{{ asset('uploads/profiles/'.$profile->image) }}">
				</div>
				<div class="blog-title text-center text-uppercase">
					<h4>{{ $profile->name }}</h4>
				</div>
			</a>
		</div>
	</div>
@endforeach

@else
<div class="col-lg-12">
	<div class="alert alert-success p-5">
		No Profile Found
	</div>	
</div>

@endif