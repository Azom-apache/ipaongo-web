
    @include('layouts.web.header')
    <!--End Main Header -->

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Enhanced hover effects */
        .group:hover .lower-content {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.02) 0%, rgba(147, 51, 234, 0.02) 100%);
        }
    </style>

	<div class="w-full lg:max-w-7xl mx-auto px-4 mb-4">
		<div class="flex flex-wrap">
			<div class="w-full my-8">
				<h3 style="margin:10px 0;" class="news-header text-center text-gray-900 uppercase !text-5xl lg:!text-4xl font-bold tracking-wide relative py-6 lg:py-3">Bulletin</h3>
				<div class="flex items-center justify-center space-x-2">
					<div class="w-8 h-0.5 bg-blue-500 rounded"></div>
					<div class="w-2 h-2 bg-purple-500 rounded-full"></div>
					<div class="w-8 h-0.5 bg-pink-500 rounded"></div>
				</div>
			</div>
			@foreach($bulletin AS $item)
            <div class="w-1/2 lg:w-1/3 px-2 mb-4 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                <div class="news-block">
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 hover:shadow-2xl hover:border-blue-200 hover:-translate-y-1 transition-all duration-300 overflow-hidden group cursor-pointer">
                        <div class="image-box overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-500/20 via-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 z-10"></div>
                            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 z-20">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-lg">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
							<a href="{{route('news.single',[$item->id, $item->slug])}}" class="block">
								<img src="images/news/{{ $item->image }}" alt="" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
							</a>
                        </div>
                        <div class="lower-content p-4">
                            <h3 class="!text-2xl lg:!text-base font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-700 transition-colors duration-300 leading-tight">
								<a href="{{route('news.single',[$item->id, $item->slug])}}" class="hover:text-blue-600">{{ $item->title }}</a>
							</h3>
                            <div class="flex items-center justify-between">
                                <a class="read-more inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white !text-lg lg:!text-sm font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-md hover:shadow-lg" href="{{route('news.single',[$item->id, $item->slug])}}">
                                    <span>Read More</span>
                                    <svg class="w-3.5 h-3.5 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <div class="!text-base lg:!text-xs text-blue-600 font-semibold bg-blue-50 px-2 py-1 rounded-full">
                                    Bulletin
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			@endforeach
		</div>
	</div>


	<!--<div class="container">-->
	<!--	<h2 class="text-center mt-5" style="margin: 20px;">Bulletin	</h2>-->
	<!--	<div class="row allmember">-->
	<!--		@foreach($bulletin AS $item)-->
	<!--		<div class="col-lg-3">-->
	<!--			<div class="member">-->
	<!--				<img src="{{asset('/uploads/profiles/'.$item->image)}}" class="img-responsive" />-->
	<!--			</div>-->
	<!--			<div class="blog-title text-center text-uppercase" style="height:80px">-->
	<!--				<p>{{$item->name}}</p>-->
	<!--				<h6>Mobile : {{$item->mobile}}</h6>-->
	<!--				<h6>Factory :{{$item->present_company}}</h6>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--		@endforeach-->
	<!--	</div>-->
	<!--</div> -->

	<!-- End Video Section -->

	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
