
    @include('layouts.web.header')
    <!--End Main Header -->
		
	<!-- Video Section -->
	<section class="video-section">
		<div class="auto-container" style="width:70%">
			@php
				$about = \App\Page::where('id', 1)->first();
			@endphp
			<div class="sec-title">
					 <h2 class="text-center">{{$about->title}}</h2>
					<!-- <h2 class="text-center">Our Story</h2> -->
			</div>
			<div class="row clearfix">
				<!-- Content Column -->
				<div class="content-column pull-right col-md-12 col-sm-12 col-xs-12">
					<div class="inner-column">
						<div class="sec-title">
							<!-- <h2>Welcome to Uddokter Golpo</h2>  -->
							<div class="text text-justify" style="line-height: 40px;">
							{!! $about->content !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Video Section -->
	
	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
