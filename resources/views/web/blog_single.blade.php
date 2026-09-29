
    @include('layouts.web.header')
    <!--End Main Header -->
	
    <!--Events Grid Section-->
    	<div class="container">

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
    	<div class="auto-container">
        	<div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<div class="event-single">
						<div class="inner-box">
                        	<div class="image wow fadeIn">
                            	<img src="{{ asset('images/blog/'.$blog->image)}}" alt="" />
                                <div class="post-date">{{ $blog->created_at->format('F d, Y')}}</div>
                            </div>
                            <div class="lower-content">
                                <h2>{{$blog->title}}</h2>
                                <div class="text">
                                    <p>{{$blog->title}}</p>
                                    <p>{!! $blog->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Related Events-->
            <section class="related-events">

                <div class="inner-container">
                    <h2>Blog </h2>
                    <div class="row clearfix">
					
					@foreach($moreBlogs AS $item)
                        <div class="event-block-three col-md-6 col-sm-12 col-xs-12 wow fadeIn">
                            <div class="inner-box">
                                <div class="image-box">
                                    <span class="date"> {{ $item->created_at->format('F d, Y')}} </span>
                                    <div class="image"><a href="{{route('blog.single',[$item->id, urlencode($item->title)])}}">
									<img src="{{ asset('images/blog/'.$item->image)}}" alt=""></a></div>
                                </div>
                                <div class="content-box">
                                <h4><a href="{{route('blog.single',[$item->id, urlencode($item->title)])}}">{{$item->title}}</a>
                                </h4>
                                <div class="text"></div>
                                    <div class="link-box"><a href="{{route('blog.single',[$item->id, urlencode($item->title)])}}" class="theme-btn btn-style-seven">Read More</a></div>
                                </div>
                            </div>
                        </div>
					@endforeach
                    </div>
                </div>

            </section>
            <!--End Related Events-->

        </div>
    </div>
    <!--End Sidebar Page Container-->

    

    	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
