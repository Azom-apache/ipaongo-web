<div class="page-wrapper">
    @include('layouts.web.header')

    <style>
        @keyframes bounceInUp {
            0% {
                opacity: 0;
                transform: translateY(60px) scale(0.9);
            }
            60% {
                opacity: 1;
                transform: translateY(-10px) scale(1.02);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-bounce-in-up {
            animation: bounceInUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
            opacity: 0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* News specific hover effects */
        .news-card:hover .p-6 {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.02) 0%, rgba(245, 158, 11, 0.02) 100%);
        }
    </style>

    	<div class="w-full lg:max-w-7xl mx-auto px-4">
            <div class="w-full my-8">
				<h3 style="margin:10px 0;" class="news-header text-center text-gray-900 uppercase !text-5xl lg:!text-4xl font-bold tracking-wide relative">News and Event</h3>
				<div class="flex items-center justify-center space-x-2">
					<div class="w-8 h-0.5 bg-blue-500 rounded"></div>
					<div class="w-2 h-2 bg-purple-500 rounded-full"></div>
					<div class="w-8 h-0.5 bg-pink-500 rounded"></div>
				</div>
			</div>
        	<div class="flex flex-wrap">
				@foreach($news AS $item)
			    <div class="w-1/2 lg:w-1/3 px-3 mb-6 animate-bounce-in-up transition-all duration-300" style="animation-delay: {{ $loop->index * 0.2 }}s">
                    <div class="news-card bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-2xl hover:border-orange-200 hover:-translate-y-3 transition-all duration-500 overflow-hidden group cursor-pointer">
                        <div class="image-box relative overflow-hidden">
                            <div class="absolute top-4 left-4 z-20 transform group-hover:scale-110 transition-all duration-300">
                                <span class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-3 py-1.5 rounded-full !text-base lg:!text-sm font-bold shadow-lg flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $item->created_at->format('M d, Y')}}
                                </span>
                            </div>
                            {{-- <div class="absolute inset-0 bg-gradient-to-br from-red-500/25 via-orange-500/20 to-yellow-500/15 opacity-0 group-hover:opacity-100 transition-all duration-600 z-10"></div> --}}
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-400 z-20 transform translate-x-3 group-hover:translate-x-0">
                                <div class="bg-white/95 backdrop-blur-sm rounded-full p-2.5 shadow-xl border border-white/20 animate-pulse">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2m-2 4l-3.5-3.5M15 14l3.5-3.5"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute bottom-4 left-4 opacity-0 group-hover:opacity-100 transition-all duration-400 z-20 transform -translate-y-3 group-hover:translate-y-0">
                                <div class="bg-black/80 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-sm font-semibold flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Breaking News
                                </div>
                            </div>
                            <a href="{{route('news.single', [$item->id, $item->slug])}}" class="block">
                                <img src="{{ asset('images/news/'.$item->image)}}" alt="{{$item->title}}" class="w-full h-72 object-cover group-hover:scale-115 transition-transform duration-700 ease-out">
                            </a>
                        </div>
                        <div class="p-6">
                            <h4 class="!text-2xl lg:!text-lg font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-red-700 transition-colors duration-300 leading-tight transform group-hover:translate-x-1">
                                <a href="{{route('news.single', [$item->id, $item->slug])}}" class="hover:text-red-600">{{ Str::limit($item->title, 50) }}</a>
                            </h4>
                            <div class="flex items-center justify-between">
                                <a href="{{route('news.single', [$item->id, $item->slug])}}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-500 to-orange-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-orange-700 transform hover:scale-105 hover:-translate-y-0.5 transition-all duration-300 shadow-lg hover:shadow-xl group-hover:shadow-2xl !text-lg lg:!text-base">
                                    <span>Read More</span>
                                    <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                                <div class="!text-base lg:!text-sm text-red-600 font-bold bg-red-50 px-3 py-1.5 rounded-full border border-red-200 transform group-hover:scale-110 transition-all duration-300">
                                    Latest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				@endforeach
				<div class="w-full mt-8 flex justify-center">{{ $news->links() }}</div>
			</div>
        </div>    
    </div>
@include('layouts.web.footer')

