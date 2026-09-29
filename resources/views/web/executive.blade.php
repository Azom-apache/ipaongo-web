@extends('layouts.web.master')
@section('content')
@push('head')
	<title>BAGMA | About Us</title>
@endpush



	<!-- <div class="margin-man"></div> -->
	@php
		$setting = \App\Setting::first();
	@endphp
	@if($setting)
		
	@endif

    <section class="managing_body">
    	<div class="managing_body_title">
             <h2 style="text-align: center;padding: 2%">Our Executive Members</h2> 
    	</div>
    	<div class="managing_body_content row">
				      
                        
                        @if(count($comittees)>0)
                        
                            @foreach($comittees as $comittee)
                           
                            <div class="col-md-3 manage_photo_div">
        					    <div class="manage_photo" style="width: 300px;height: 300px"><img style="width: 100%; height: 300px;" src="{{ asset('uploads/comittees/'.$comittee->image) }}">
            					 </div>
            					    
        					    <div class="my-4">
        					        <h3 class="manage_photo">{{ $comittee->name ?? ''}}</h3>
        					        <h5 class="manage_photo"><b>{{ $comittee->designation ?? ''}}</b></h5>
        					    </div>
        					</div>
                            
                            @endforeach
    				    
        				@else 
        				
        				<div class="col-md-12"><span class="text-center">NO DATA FOUND!</span></div>
        				
        				@endif

    	</div>
    </section>
@push('js')
	<script src="{{ asset('web/slick/slick/slick.js')}}"></script>
	<script>
		$(".regular").slick({
        dots: true,
	        infinite: true,
	        slidesToShow: 5,
	        slidesToScroll: 5,
	        autoplay:true,
			  autoplaySpeed:1500,
			  arrows:true,
			  prevArrow:'<button type="button" class="slick-prev"></button>',
			  nextArrow:'<button type="button" class="slick-next"></button>',
			  centerMode:true,
			  responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			      slidesToShow: 2,
			      centerMode: false, /* set centerMode to false to show complete slide instead of 3 */
			      slidesToScroll: 2
			      }
			    }
			   ]
	      });
	</script>
@endpush
@endsection