
    @include('layouts.web.header')
    <!--End Main Header -->

    <style>
        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-slide-in-bottom {
            animation: slideInFromBottom 0.8s ease-out forwards;
            opacity: 0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Media coverage specific hover effects */
        .media-coverage:hover .lower-content {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.02) 0%, rgba(168, 85, 247, 0.02) 100%);
        }
    </style>

	<div class="w-full lg:max-w-7xl mx-auto px-4 mb-4">
		<div class="flex flex-wrap">
			<div class="w-full mb-8">
				<h3 style="margin:10px 0;" class="news-header text-center text-gray-900 uppercase !text-5xl lg:!text-4xl font-bold tracking-wide relative py-6 lg:py-3">MEDIA COVERAGE</h3>
				<div class="flex items-center justify-center space-x-2">
					<div class="w-8 h-0.5 bg-blue-500 rounded"></div>
					<div class="w-2 h-2 bg-purple-500 rounded-full"></div>
					<div class="w-8 h-0.5 bg-pink-500 rounded"></div>
				</div>
			</div>

			@foreach($medias as $media)
            <div class="w-full lg:w-1/3 px-3 mb-6 animate-slide-in-bottom" style="animation-delay: {{ $loop->index * 0.15 }}s">
                <div class="news-block">
                    <div class="inner-box media-coverage bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-2xl hover:border-green-200 hover:-translate-y-2 transition-all duration-500 overflow-hidden group cursor-pointer">
                        <div class="image-box overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 via-purple-500/15 to-blue-500/10 opacity-0 group-hover:opacity-100 transition-all duration-600 z-10"></div>
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-400 z-20 transform translate-x-2 group-hover:translate-x-0">
                                <div class="bg-white/95 backdrop-blur-sm rounded-full p-2.5 shadow-xl border border-white/20">
                                    <svg class="w-5 h-5 text-green-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute bottom-4 left-4 opacity-0 group-hover:opacity-100 transition-all duration-400 z-20 transform -translate-y-2 group-hover:translate-y-0">
                                <div class="bg-black/70 backdrop-blur-sm text-white px-3 py-1 rounded-full !text-base lg:!text-sm font-medium">
                                    Media Coverage
                                </div>
                            </div>
							<a href="{{route('news.single', [$media->id, $media->slug])}}" class="block">
								<img src="images/news/{{ $media->image }}" alt="" class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
							</a>
                        </div>
                        <div class="lower-content p-6">
                            <h3 class="!text-2xl lg:!text-xl font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-green-700 transition-colors duration-300 leading-tight transform group-hover:translate-x-1">
								<a href="{{route('news.single', [$media->id, $media->slug])}}" class="hover:text-green-600">{{ $media->title }}</a>
							</h3>
                            <div class="flex items-center justify-between">
                                <a class="read-more inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-lg hover:from-green-600 hover:to-emerald-700 transform hover:scale-105 hover:-translate-y-0.5 transition-all duration-300 shadow-lg hover:shadow-xl group-hover:shadow-2xl !text-lg lg:!text-base" href="{{route('news.single', [$media->id, $media->slug])}}">
                                    <span>Watch Now</span>
                                    <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.586a1 1 0 01.707.293l.707.707A1 1 0 0012.414 11H15m-3 7.5A9.5 9.5 0 1121.5 12 9.5 9.5 0 0112 2.5z"></path>
                                    </svg>
                                </a>
                                <div class="!text-base lg:!text-sm text-green-600 font-bold bg-green-50 px-3 py-1 rounded-full border border-green-200 transform group-hover:scale-110 transition-all duration-300">
                                    Featured
                                </div>
                            </div>
							<!-- <a class="read-more" href="{{route('news',[$media->id, $media->slug])}}" class="theme-btn btn-style-one">READ MORE</a> -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
		
		</div>
	</div>


	<!-- <div class="container">
		<h2 class="text-center mt-5" style="margin: 20px;">
			MEDIA COVERAGE
		</h2>
		<div class="row allmember">
			@foreach($medias AS $item)
			<div class="col-lg-3">
				<div class="member">
					<img src="{{asset('/uploads/profiles/'.$item->image)}}" class="img-responsive" />
				</div>
				<div class="blog-title text-center text-uppercase" style="height:80px">
					<p>{{$item->name}}</p>
					<h6>Mobile : {{$item->mobile}}</h6>
					<h6>Factory :{{$item->present_company}}</h6>
				</div>
			</div>
			@endforeach
		</div>
	</div> -->

	<!-- End Video Section -->

	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
