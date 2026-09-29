<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="IQlNkHu9nvTU8jtJVcSJhFHhhUQfmiCoA2KWacYQ">

<title>{{config('app.name')}}</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="{{asset('plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="{{asset('plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/responsive.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://uddokta.tripleoneair.com/js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    {{--<div class="preloader"></div>--}}

    <!-- Main Header-->
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
                            	<img src="{{ asset('images/news/'.$training->image)}}" alt="" />
                                <div class="post-date">{{ $training->created_at->format('F d, Y')}}</div>
                            </div>
                            <div class="lower-content">
                                <h2>{{$training->title}}</h2>
                                <div class="text">
                                    <p>{{$training->title}}</p>
                                    <p>{!! $training->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Related Events-->
            <section class="related-events">

                <div class="inner-container">
                    <h2> Training </h2>
                    <div class="row clearfix">
					
					@foreach($trainings AS $item)
                        <div class="event-block-three col-md-6 col-sm-12 col-xs-12 wow fadeIn">
                            <div class="inner-box">
                                <div class="image-box">
                                    <span class="date"> {{ $item->created_at->format('F d, Y')}} </span>
                                    <div class="image"><a href="{{route('blog.single',[$item->id, urlencode($item->title)])}}">
									<img src="{{ asset('images/news/'.$item->image)}}" alt=""></a></div>
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
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Revolution Slider-->
<script src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('js/main-slider-script.js')}}"></script>
<!--End Revolution Slider-->
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.js')}}"></script>
<script src="{{asset('js/owl.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/knob.js')}}"></script>
<script src="{{asset('js/appear.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>