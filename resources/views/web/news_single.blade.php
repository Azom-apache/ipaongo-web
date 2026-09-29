    @include('layouts.web.header')
    	<div class="w-full lg:max-w-7xl mx-auto">

    <div class="sidebar-page-container">
    	<div class="w-full lg:max-w-7xl mx-auto">
        	<div class="flex flex-wrap">
                <!--Content Side-->
                <div class="w-full">
                	<div class="event-single">
						<div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        	<div class="p-8">
								<div class="flex flex-wrap">
									<div class="w-full">
										<div class="image wow fadeIn mb-6">
											<img src="{{ asset('images/news/'.$news->image)}}" alt="" class="w-full max-w-md h-auto mx-auto rounded-lg shadow-md" />
										</div>
										<h1 class="text-center text-3xl font-bold text-gray-900 mb-6 leading-tight">{{$news->title}}</h1>
										<div class="text prose max-w-none text-gray-700 leading-relaxed">
											{!! $news->description !!}
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <section class="related-events mt-12">

                <div class="w-full lg:max-w-7xl mx-auto">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center"> Latest News </h2>
                    <div class="flex flex-wrap">

					@foreach($items AS $item)
                        <div class="w-1/2 lg:w-1/3 px-3 mb-6 wow fadeIn">
                            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                                <div class="image-box relative overflow-hidden">
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">{{ $item->created_at->format('M d, Y')}}</span>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                                    <a href="{{route('news.single', [$item->id, $item->slug])}}" class="block">
                                        <img src="{{ asset('images/news/'.$item->image)}}" alt="" class="w-full h-72 object-cover group-hover:scale-105 transition-transform duration-500">
                                    </a>
                                </div>
                                <div class="p-6">
                                    <h4 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                        <a href="{{route('news.single', [$item->id, $item->slug])}}" class="hover:underline">{{ Str::limit($item->title, 50) }}</a>
                                    </h4>
                                    <div class="flex items-center justify-between">
                                        <a href="{{route('news.single', [$item->id, $item->slug])}}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-200 group-hover:shadow-md">
                                            <span>Read More</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </a>
                                        <div class="text-sm text-gray-500 font-medium">
                                            News
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					@endforeach
                    </div>
                </div>

            </section>
        </div>
    </div>

    


</div>
@include('layouts.web.footer')
