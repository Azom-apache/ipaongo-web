@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Blogs</title>
<meta name="description" content="">
@endpush
<section class="page-title">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
      </ol>
    </nav>
</section>
<div class="page-content mb-5">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title text-center">
                <h1>Blogs</h1>
            </div>
            <div class="page-description">
                <div class="row">
                    @foreach($blogs as $blog)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-4">
                            <div class="blog-item">
                                <a href="{{ route('blog',[$blog->id,Str::slug($blog->title)]) }}">
                                    <div class="blog-image">
                                        <img class="img-fluid" alt="{{ env("APP_NAME")."  ".$blog->title }}" src="{{ asset('uploads/blogs/'.$blog->image) }}">
                                    </div>
                                    <div class="blog-title text-center text-uppercase">
                                        <h4>{{ $blog->title }}</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    @include('layouts.web.header')
    <!--End Main Header -->
	
    <!--Events Grid Section-->
    	<div class="container">
			<h2 class="text-center" style="margin: 20px;">Blogs</h2>
        	<div class="row clearfix">
				@foreach($blogs AS $item)
			    <div class="event-block-five col-md-6 col-sm-12 col-xs-12 wow fadeIn">
                    <div class="inner-box">
                        <div class="image-box">
                            <span class="date">{{ $item->created_at->format('F d, Y')}}</span>
                            <div class="image"><img src="{{ asset('uploads/blogs/'.$item->image)}}" alt="{{$item->title}}">
                            </div>
                        </div>
                        <div class="lower-box">
                            <div class="content-box">
                            <h4><a href="{{route('blog.single',[$item->id, urlencode($item->title)])}}">{{$item->title}}</a>
                            </h4>
                                <div class="text">{{$item->title}}</div>
                                <div class="link-box"><a href="{{route('blog.single',[$item->id, $item->title])}}" class="theme-btn btn-style-five">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
				@endforeach
				
				<div class="col-md-12">{{ $blogs->links() }}</div>
			</div>
        </div>

    <!--End Event List View Section-->

    

	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
