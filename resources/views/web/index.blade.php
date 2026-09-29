@extends('layouts.web.master')
@section('content')
@push('head')
	<title>Primeasia</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@endpush

<style>
    .welocome-header h4 {
    font-size: 34px;
    font-weight: bold !important;
}

.manage_photo{
    margin: 5px;
}
</style>
<!-- trimmed: full page content copied from =index.blade.php -->
@include('web._index_content')
@endsection
    <!-- Main Header-->
    @include('layouts.web.header')
    <!--End Main Header -->
    <!--Main Slider-->
	@include('layouts.web.slider')
	<!--End Main Slider-->
<div class="bresking-section bg-[#02CCFF] text-white pt-5 pb-4 px-4 sm:pt-4 sm:pb-3 sm:px-5 lg:pt-2.5 lg:pb-2 lg:px-2">
    <div class="">
        <div class="row">
            <!--<div class="col-md-1"></div>-->
            <div class="col-md-12">
                <div class="row">
                    <!--<div class="col-md-2">-->
                    <!--    <p class="breaking-news" style="margin-bottom:-10px; color: #fff;"><b>Breaking News:</b> &nbsp;</p>-->
                    <!--</div>-->
                    <div class="col-md-10 py-2 sm:py-0">
        				@php
        				$breakingnews = \App\News::where('type', 'breakingNews')->get();
        				@endphp
                        <marquee
                            behavior="scroll"
                            direction="left"
                            onmouseover="this.stop();"
                            onmouseout="this.start();"
                            class="block w-full mb-3 sm:mb-2 lg:mb-1.5 py-4 px-3 sm:py-3 sm:px-4 lg:py-1.5 lg:px-2 text-[#020255] text-4xl sm:text-3xl lg:text-lg font-extrabold leading-tight sm:leading-snug tracking-tight"
                        >@foreach($breakingnews AS $item) {{$item->title}} | @endforeach</marquee>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-1"></div>-->
        </div>
    </div>
</div>


@php
    $accentSchemes = config('tailwind_theme.accent_schemes');
@endphp
<!-- News Update Section Start Here-->
<section class="newsupdate mb-8">
	<div class="w-full lg:max-w-7xl mx-auto px-2">
		<h4 class="text-center font-bold my-14 text-6xl sm:text-5xl lg:text-4xl py-4 leading-tight">UPDATE NEWS</h4>
		<div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
			@php
			$update = \App\News::where('type', 'news')->latest()->limit('4')->get();
			@endphp
			@foreach($update AS $item)
			@php
				$c = $accentSchemes[$loop->index % count($accentSchemes)];
			@endphp
			<div class="">
                <div class="h-full bg-white rounded-xl group {{ $c['hover_bg'] }} shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border {{ $c['border'] }} {{ $c['hover_border'] }} hover:-translate-y-1">
                    <div class="relative h-72 overflow-hidden">
                        <a href="{{ route('news.single', [$item->id, $item->slug]) }}" class="block h-full">
                            <img 
                                src="images/news/{{ $item->image }}" 
                                alt="{{ $item->title }}"
                                class="w-full h-72 object-cover transition-transform duration-500 hover:scale-105"
                                loading="lazy"
                            >
                        </a>
                    </div>
                    <div class="p-4">
                        <h3 class="text-4xl sm:text-3xl lg:text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-white {{ $c['title_hover'] }} transition-colors duration-300">
                            <a href="{{ route('news.single', [$item->id, $item->slug]) }}" class="hover:underline text-inherit group-hover:text-white">
                                {{ $item->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-lg sm:text-base lg:text-sm mb-4 line-clamp-2 leading-snug group-hover:text-white">
                            {{ Str::limit($item->excerpt, 100) }}
                        </p>
                        <div class="flex justify-between items-center gap-2">
                            <a
                                href="{{ route('news.single', [$item->id, $item->slug]) }}"
                                class="px-4 py-2.5 lg:px-3 lg:py-1.5 text-base lg:text-sm font-medium border rounded-full {{ $c['read_more'] }} transition-all duration-300 text-center"
                            >
                                Read More
                            </a>
                            <a 
                                href="{{ route('donate.show') }}" 
                                class="px-4 py-2.5 lg:px-3 lg:py-1.5 text-base lg:text-sm font-medium text-white rounded-full {{ $c['donate'] }} transition-all duration-300 shadow-sm hover:shadow-md text-center shrink-0"
                            >
                                Donate Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			@endforeach
		</div>
	</div>
</section>
<!-- News Update Section End Here-->



<!--End What We Do -->

<!-- Event Section -->
<section class="event-section">
    <div class="title-box" style="background-image: url({{asset('images/background/2.jpg')}});">
        <div class="auto-container">
            <div class="sec-title light text-center py-20 lg:py-20">
                <h2 class="text-6xl lg:text-3xl lg:text-4xl font-bold text-white">OUR PROJECTS</h2>
            </div>
        </div>
    </div>

    <div class="w-full lg:max-w-7xl mx-auto px-2 mt-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Projects Grid -->
            <div class="w-full lg:w-2/3">
                <div class="grid grid-cols-2 gap-10">
                    @php
                    $event = \App\Project::where('parent', 0)
                        ->where('order','!=',0)
                        ->orderBy('order','asc')
                        ->take(12)
                        ->get();
                    @endphp
                    
                    @foreach($event as $item)
                    @php
                        $c = $accentSchemes[$loop->index % count($accentSchemes)];
                    @endphp
                    <div class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                        <div class="relative overflow-hidden h-48">
                            <img 
                                src="{{asset('uploads/project/'.$item->image)}}" 
                                alt="{{$item->title}}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <a href="{{route('project', [$item->id, $item->slug])}}" 
                                   class="text-white font-medium hover:text-yellow-300 transition-colors">
                                    View Details →
                                </a>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col {{ $c['project_card_body'] }}">
                            <h3 class="text-4xl sm:text-3xl lg:text-lg font-bold text-gray-800 mb-3 leading-tight line-clamp-2 group-hover:text-white {{ $c['title_hover'] }} transition-colors duration-300">
                                <a href="{{route('project', [$item->id, $item->slug])}}" 
                                   class="hover:underline text-inherit group-hover:text-white transition-colors">
                                    {{$item->title}}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-xl sm:text-lg lg:text-base mb-4 line-clamp-3 flex-grow leading-snug group-hover:text-white">
                                {{ Str::limit($item->short_desc, 115) }}
                            </p>
                            <div class="flex justify-between items-center gap-2 mt-auto pt-4 border-t border-gray-100 group-hover:border-white/20">
                                <a href="{{route('project', [$item->id, $item->slug])}}" 
                                   class="px-5 py-3 lg:px-4 lg:py-2.5 text-lg lg:text-base font-medium border rounded-full {{ $c['read_more'] }} transition-all duration-300 text-center">
                                    Read More
                                </a>
                                <a href="{{route('donate.show')}}" 
                                   class="px-5 py-3 lg:px-4 lg:py-2.5 text-lg lg:text-base font-medium text-white rounded-full {{ $c['donate'] }} transition-all duration-300 shadow-sm hover:shadow-md text-center shrink-0">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-6">
                    <div class="{{ $accentSchemes[0]['sidebar_header'] }} text-white px-6 py-5 lg:py-4">
                        <h3 class="text-4xl sm:text-3xl lg:text-2xl font-bold leading-tight">Latest Updates</h3>
                    </div>
                    <div class="p-5 sm:p-6 lg:p-4 space-y-5 max-h-[800px] overflow-y-auto">
                        @php
                        $gparent = \App\Project::orderBy('id','desc')->take(21)->get();
                        @endphp
                        
                        @foreach($gparent as $item)
                        @php
                            $c = $accentSchemes[$loop->index % count($accentSchemes)];
                        @endphp
                        <a href="{{ route('project', [$item->id, $item->slug]) }}" 
                           class="group flex items-start gap-5 p-5 lg:p-4 rounded-xl transition-colors border {{ $c['sidebar_row'] }}">
                            <div class="flex-shrink-0 w-28 h-28 lg:w-24 lg:h-24 rounded-xl overflow-hidden">
                                <img 
                                    src="{{ asset('uploads/project/'.$item->image) }}" 
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                >
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-xl sm:text-2xl lg:text-base font-medium text-gray-800 leading-snug transition-colors line-clamp-2 {{ $c['sidebar_title'] }}">
                                    {{ $item->title }}
                                </h4>
                                <span class="inline-block mt-2.5 lg:mt-1.5 text-lg lg:text-sm font-medium group-hover:underline {{ $c['sidebar_link'] }}">
                                    Read More →
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="px-6 py-5 lg:py-4 bg-gray-50 text-center">
                        <a href="#" class="text-xl lg:text-lg font-medium hover:underline {{ $accentSchemes[0]['gallery_view_link'] }}">
                            View All Updates
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Event Section -->

<!-- News Section -->
<section class="pb-16 pt-20 bg-gradient-to-b from-white to-gray-50">
    <div class="w-full lg:max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-20">
            <h2 class="text-6xl sm:text-5xl lg:text-4xl font-bold text-gray-800 mb-3 leading-tight">OUR GALLERY</h2>
            <div class="w-32 lg:w-28 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-10">
            <div class="w-full lg:w-1/3 grid grid-cols-2 gap-6 sm:gap-8">
                @php
                    $notice = \App\Gallery::where('parent', 0)->orderby('id', 'ASC')->limit(3)->get();
                @endphp
                @foreach($notice as $event)
                @php
                    $c = $accentSchemes[$loop->index % count($accentSchemes)];
                @endphp
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 transform">
                    <div class="relative overflow-hidden">
                        <a href="{{route('project.gellery',[$event->id, $event->slug])}}" class="block">
                            <img src="uploads/project/{{ $event->image }}"
                                 alt="{{ $event->title }}"
                                 class="w-full h-60 sm:h-56 lg:h-52 object-cover border-4 {{ $c['gallery_image_border'] }} transition-transform duration-300 hover:scale-105">
                        </a>
                    </div>
                    <div class="p-6 sm:p-7 lg:p-5">
                        <h4 class="text-2xl sm:text-3xl lg:text-lg font-medium text-gray-800 leading-snug line-clamp-2 {{ $c['title_hover'] }} transition-colors duration-300">
                            <a href="{{route('project.gellery', [$event->id, $event->slug])}}" class="text-inherit">
                                {{ Str::limit($event->title, 20)}}
                            </a>
                        </h4>
                        <div class="flex items-center text-gray-500 mt-3 lg:mt-2 mb-4 lg:mb-3">
                            <span class="date text-xl lg:text-base">{{ $event->created_at->toFormattedDateString()}}</span>
                        </div>
                        <a href="{{route('project.gellery', [$event->id, $event->slug])}}"
                           class="inline-flex items-center text-xl lg:text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all duration-300 font-medium transition-colors duration-300">
                            VIEW
                            <i class="fa fa-arrow-right ml-2.5 text-lg lg:text-base" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            @php
                $gallery = \App\Gallery::where('parent', 0)->orderby('id', 'ASC')->limit(1)->first();
            @endphp
            @if($gallery)
            <div class="w-full lg:w-2/3">
                <div class="h-full min-h-[280px] sm:min-h-[360px] lg:min-h-[420px] rounded-2xl overflow-hidden shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300 transform">
                    <a href="{{route('project.gellery',[$gallery->id, $gallery->slug])}}" class="block h-full min-h-[280px] sm:min-h-[360px] lg:min-h-[420px]">
                        <div class="relative h-full min-h-[280px] sm:min-h-[360px] lg:min-h-[420px] overflow-hidden">
                            <img src="uploads/project/{{ $gallery->image }}"
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-full min-h-[280px] sm:min-h-[360px] lg:min-h-[420px] object-cover transition-transform duration-300 hover:scale-105">
                        </div>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!--End News Section -->

<!-- Statistics Section -->
<div class="py-16 lg:py-24 bg-gradient-to-br from-gray-400 via-black to-gray-400 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
        <div class="text-center mb-14 lg:mb-20">
            <h2 class="text-5xl sm:text-6xl lg:text-5xl font-bold text-white mb-4 leading-tight tracking-tight">
                Our Impact
            </h2>
            <div class="w-40 lg:w-36 h-2 bg-gradient-to-r from-blue-400 to-purple-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-9 lg:gap-10">

            @php
                $setting = \App\Setting::first();
            @endphp

            <!-- Successful Projects -->
            <div class="wow fadeInUp group h-full">
                <div class="count-box bg-white/10 backdrop-blur-xl rounded-2xl lg:rounded-3xl p-7 sm:p-8 lg:p-10 border border-white/20 hover:border-white/30 hover:scale-105 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/25 relative overflow-hidden h-full">
                    <!-- Card Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10">
                        <div class="flex justify-center mb-5 sm:mb-6 lg:mb-8">
                            <div class="p-6 sm:p-7 lg:p-8 bg-gradient-to-br from-blue-400 via-cyan-500 to-purple-600 rounded-full shadow-xl shadow-blue-500/50">
                                <svg class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="text-center">
                            <span
                                class="count-text text-7xl sm:text-6xl lg:text-6xl font-bold text-white block mb-3 lg:mb-4 transition-all duration-300 group-hover:text-blue-300"
                                data-speed="3000"
                                data-stop="@if($setting) {{ $setting->successfull_project }} @endif">
                            </span>

                            <span class="text-lg sm:text-xl lg:text-base uppercase tracking-widest text-gray-300 group-hover:text-white transition-colors duration-300">
                                Successful Projects
                            </span>
                        </div>
                    </div>

                    <!-- Hover Effect Border -->
                    <div class="absolute inset-0 rounded-2xl lg:rounded-3xl bg-gradient-to-r from-blue-400 to-purple-600 opacity-0 group-hover:opacity-20 transition-opacity duration-500 -z-10"></div>
                </div>
            </div>

            <!-- People Impacted -->
            <div class="wow fadeInUp group h-full" data-wow-delay="400ms">
                <div class="count-box bg-white/10 backdrop-blur-xl rounded-2xl lg:rounded-3xl p-7 sm:p-8 lg:p-10 border border-white/20 hover:border-white/30 hover:scale-105 transition-all duration-500 hover:shadow-2xl hover:shadow-green-500/25 relative overflow-hidden h-full">
                    <!-- Card Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-600/10 to-emerald-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10">
                        <div class="flex justify-center mb-5 sm:mb-6 lg:mb-8">
                            <div class="p-6 sm:p-7 lg:p-8 bg-gradient-to-br from-green-400 via-emerald-500 to-teal-600 rounded-full shadow-xl shadow-green-500/50">
                                <svg class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="text-center">
                            <span
                                class="count-text text-7xl sm:text-6xl lg:text-6xl font-bold text-white block mb-3 lg:mb-4 transition-all duration-300 group-hover:text-green-300"
                                data-speed="3000"
                                data-stop="@if($setting) {{ $setting->people_impact }} @endif">
                            </span>

                            <span class="text-lg sm:text-xl lg:text-base uppercase tracking-widest text-gray-300 group-hover:text-white transition-colors duration-300">
                                People Impacted
                            </span>
                        </div>
                    </div>

                    <!-- Hover Effect Border -->
                    <div class="absolute inset-0 rounded-2xl lg:rounded-3xl bg-gradient-to-r from-green-400 to-emerald-600 opacity-0 group-hover:opacity-20 transition-opacity duration-500 -z-10"></div>
                </div>
            </div>

            <!-- Total Volunteers -->
            <div class="wow fadeInUp group h-full" data-wow-delay="1200ms">
                <div class="count-box bg-white/10 backdrop-blur-xl rounded-2xl lg:rounded-3xl p-7 sm:p-8 lg:p-10 border border-white/20 hover:border-white/30 hover:scale-105 transition-all duration-500 hover:shadow-2xl hover:shadow-purple-500/25 relative overflow-hidden h-full">
                    <!-- Card Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-pink-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10">
                        <div class="flex justify-center mb-5 sm:mb-6 lg:mb-8">
                            <div class="p-6 sm:p-7 lg:p-8 bg-gradient-to-br from-purple-400 via-pink-500 to-rose-600 rounded-full shadow-xl shadow-purple-500/50">
                                <svg class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="text-center">
                            <span
                                class="count-text text-7xl sm:text-6xl lg:text-6xl font-bold text-white block mb-3 lg:mb-4 transition-all duration-300 group-hover:text-purple-300"
                                data-speed="3000"
                                data-stop="@if($setting) {{ $setting->total_volunteer }} @endif">
                            </span>

                            <span class="text-lg sm:text-xl lg:text-base uppercase tracking-widest text-gray-300 group-hover:text-white transition-colors duration-300">
                                Total Volunteers
                            </span>
                        </div>
                    </div>

                    <!-- Hover Effect Border -->
                    <div class="absolute inset-0 rounded-2xl lg:rounded-3xl bg-gradient-to-r from-purple-400 to-pink-600 opacity-0 group-hover:opacity-20 transition-opacity duration-500 -z-10"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Statistics Section -->

<!-- Services Section -->
<section class="py-16 lg:py-24 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-20 left-10 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="w-full lg:max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <!-- Content Column -->
            <div class="order-2 lg:order-1">
                <div class="space-y-8 sm:space-y-9 lg:space-y-7">
                    <div class="inline-block">
                        <span class="bg-blue-500/20 text-blue-300 text-lg sm:text-xl lg:text-base font-semibold uppercase tracking-widest px-6 py-3 lg:px-5 lg:py-2.5 rounded-full border border-blue-400/30">
                            Our Mission
                        </span>
                    </div>

                    <h2 class="text-7xl sm:text-6xl lg:text-5xl font-bold text-white leading-[1.08] tracking-tight">
                        Helping Elderly People Find Their
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                            Family & Home
                        </span>
                    </h2>

                    <p class="text-gray-300 text-xl sm:text-2xl lg:text-lg leading-relaxed">
                        Our job is to unite the neglected, helpless, unaccompanied elderly people of the society and bring them under the family by providing them with basic necessities like food, shelter, medical care and entertainment.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-5 sm:gap-6 pt-5 lg:pt-4">
                        <a href="{{ route('donate.show') }}"
                           class="bg-gradient-to-r text-xl sm:text-2xl lg:text-lg text-center from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold px-10 py-5 lg:px-8 lg:py-3.5 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            Donate Now
                        </a>
                        {{-- <a href="#"
                           class="border-2 text-xl sm:text-2xl lg:text-lg text-center border-blue-400/50 text-blue-300 hover:bg-blue-400/10 font-semibold px-10 py-5 lg:px-8 lg:py-3.5 rounded-full transition-all duration-300">
                            Learn More
                        </a> --}}
                    </div>
                </div>
            </div>

            <!-- Progress Column -->
            <div class="order-1 lg:order-2">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 lg:gap-10">

                    <!-- Food Service -->
                    <div class="group">
                        <div class="bg-white/10 h-full backdrop-blur-xl rounded-2xl lg:rounded-3xl p-7 sm:p-8 lg:p-6 border border-white/20 hover:border-blue-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/20 text-center">
                            <div class="relative mb-5 lg:mb-4">
                                <div class="w-28 h-28 lg:w-24 lg:h-24 mx-auto relative">
                                    <!-- Outer rotating ring -->
                                    <div class="absolute inset-0 rounded-full border-4 border-blue-500/30 animate-spin"
                                         style="animation-duration: 3s;"></div>

                                    <!-- Inner pulsing circle -->
                                    <div class="absolute inset-2 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center animate-pulse">
                                        <!-- Food icon representation -->
                                        <div class="relative">
                                            <!-- Plate -->
                                            <div class="w-8 h-6 bg-white/20 rounded-full relative">
                                                <!-- Food elements -->
                                                <div class="absolute -top-1 left-1 w-2 h-2 bg-orange-400 rounded-full animate-bounce"
                                                     style="animation-delay: 0s; animation-duration: 2s;"></div>
                                                <div class="absolute -top-1 right-1 w-1.5 h-1.5 bg-green-400 rounded-full animate-bounce"
                                                     style="animation-delay: 0.5s; animation-duration: 2s;"></div>
                                                <div class="absolute -top-0.5 left-2 w-1 h-1 bg-red-400 rounded-full animate-bounce"
                                                     style="animation-delay: 1s; animation-duration: 2s;"></div>
                                            </div>
                                            <!-- Steam lines -->
                                            <div class="absolute -top-2 left-1 w-0.5 h-2 bg-white/60 rounded-full animate-pulse"
                                                 style="animation-delay: 0.2s;"></div>
                                            <div class="absolute -top-2 right-1 w-0.5 h-1.5 bg-white/60 rounded-full animate-pulse"
                                                 style="animation-delay: 0.7s;"></div>
                                        </div>
                                    </div>

                                    <!-- Number overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-2xl sm:text-3xl lg:text-xl font-bold text-white drop-shadow-lg">
                                            @if($setting) {{ $setting->food }} @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-white font-semibold text-lg sm:text-xl lg:text-sm uppercase tracking-wide mb-2">Food</h3>
                            <p class="text-gray-400 text-base sm:text-lg lg:text-sm leading-snug">Nutritious meals for elderly care</p>
                        </div>
                    </div>

                    <!-- Water Wells Service -->
                    <div class="group">
                        <div class="bg-white/10 h-full backdrop-blur-xl rounded-2xl lg:rounded-3xl p-7 sm:p-8 lg:p-6 border border-white/20 hover:border-green-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20 text-center">
                            <div class="relative mb-5 lg:mb-4">
                                <div class="w-28 h-28 lg:w-24 lg:h-24 mx-auto relative">
                                    <!-- Outer flowing water ring -->
                                    <div class="absolute inset-0 rounded-full border-4 border-green-500/30 overflow-hidden">
                                        <div class="absolute inset-0 rounded-full border-2 border-green-400 animate-spin"
                                             style="animation-duration: 4s; clip-path: polygon(0 50%, 100% 50%, 100% 100%, 0 100%);"></div>
                                    </div>

                                    <!-- Inner water well design -->
                                    <div class="absolute inset-2 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                        <div class="relative w-8 h-8">
                                            <!-- Well structure -->
                                            <div class="absolute inset-0 border-2 border-white/30 rounded-sm">
                                                <!-- Well walls -->
                                                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-1 h-2 bg-white/40 rounded-t"></div>
                                                <!-- Water level -->
                                                <div class="absolute bottom-0 left-0 right-0 h-2 bg-blue-400/60 rounded-b-sm animate-pulse"></div>
                                                <!-- Water ripples -->
                                                <div class="absolute bottom-1 left-1 w-1 h-0.5 bg-white/60 rounded-full animate-ping"
                                                     style="animation-delay: 0s; animation-duration: 2s;"></div>
                                                <div class="absolute bottom-0.5 right-1 w-0.5 h-0.5 bg-white/60 rounded-full animate-ping"
                                                     style="animation-delay: 0.5s; animation-duration: 2s;"></div>
                                            </div>
                                            <!-- Water drops falling -->
                                            <div class="absolute -top-1 left-2 w-1 h-1 bg-blue-300 rounded-full animate-bounce"
                                                 style="animation-delay: 0s; animation-duration: 1.5s;"></div>
                                            <div class="absolute -top-1 right-2 w-0.5 h-0.5 bg-blue-300 rounded-full animate-bounce"
                                                 style="animation-delay: 0.7s; animation-duration: 1.5s;"></div>
                                        </div>
                                    </div>

                                    <!-- Number overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-2xl sm:text-3xl lg:text-xl font-bold text-white drop-shadow-lg">
                                            @if($setting) {{ $setting->cloth }} @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-white font-semibold text-lg sm:text-xl lg:text-sm uppercase tracking-wide mb-2">Water Wells</h3>
                            <p class="text-gray-400 text-base sm:text-lg lg:text-sm leading-snug">Clean water access projects</p>
                        </div>
                    </div>

                    <!-- Other Services -->
                    <div class="group">
                        <div class="bg-white/10 h-full backdrop-blur-xl rounded-2xl p-6 border border-white/20 hover:border-purple-400/50 transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20 text-center">
                            <div class="relative mb-4">
                                <div class="w-24 h-24 mx-auto relative">
                                    <!-- Outer floating elements ring -->
                                    <div class="absolute inset-0 rounded-full border-4 border-purple-500/30">
                                        <!-- Floating musical notes -->
                                        <div class="absolute -top-1 left-1/4 text-purple-300 text-xs animate-bounce"
                                             style="animation-delay: 0s; animation-duration: 2.5s;">♪</div>
                                        <div class="absolute -top-1 right-1/4 text-purple-300 text-xs animate-bounce"
                                             style="animation-delay: 0.8s; animation-duration: 2.5s;">♫</div>
                                        <div class="absolute -bottom-1 left-1/3 text-purple-300 text-xs animate-bounce"
                                             style="animation-delay: 1.5s; animation-duration: 2.5s;">♪</div>
                                    </div>

                                    <!-- Inner medical & entertainment design -->
                                    <div class="absolute inset-2 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                                        <div class="relative w-8 h-8">
                                            <!-- Medical cross -->
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="relative">
                                                    <!-- Cross vertical line -->
                                                    <div class="w-1 h-6 bg-white/80 rounded-full absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                                                    <!-- Cross horizontal line -->
                                                    <div class="h-1 w-4 bg-white/80 rounded-full absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                                                    <!-- Heart symbol for care -->
                                                    <div class="absolute -top-1 left-1/2 transform -translate-x-1/2 text-red-300 text-xs animate-pulse">♥</div>
                                                </div>
                                            </div>
                                            <!-- Entertainment sparkles -->
                                            <div class="absolute top-0 right-0 w-1 h-1 bg-yellow-300 rounded-full animate-ping"
                                                 style="animation-delay: 0.3s;"></div>
                                            <div class="absolute bottom-0 left-0 w-0.5 h-0.5 bg-yellow-300 rounded-full animate-ping"
                                                 style="animation-delay: 1.1s;"></div>
                                            <div class="absolute top-1/2 right-1 w-0.5 h-0.5 bg-yellow-300 rounded-full animate-ping"
                                                 style="animation-delay: 0.7s;"></div>
                                        </div>
                                    </div>

                                    <!-- Number overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-2xl sm:text-3xl lg:text-xl font-bold text-white drop-shadow-lg">
                                            @if($setting) {{ $setting->other }} @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-white font-semibold text-sm uppercase tracking-wide mb-2">Other</h3>
                            <p class="text-gray-400 text-xs">Medical & entertainment support</p>
                        </div>
                    </div>

                </div>

                <!-- Stats Summary -->
                <div class="mt-10 p-7 sm:p-8 lg:p-6 bg-white/5 backdrop-blur-xl rounded-2xl lg:rounded-3xl border border-white/10">
                    <div class="text-center">
                        <h3 class="text-white font-bold text-2xl sm:text-3xl lg:text-xl mb-3">Total Impact</h3>
                        <div class="flex justify-center items-center space-x-6">
                            <div class="text-center">
                                <div class="text-4xl sm:text-5xl lg:text-3xl font-bold text-blue-400">
                                    <span class="count-text" data-stop="@if($setting) {{ $setting->food + $setting->cloth + $setting->other }} @endif" data-speed="2500"></span>+
                                </div>
                                <div class="text-gray-400 text-base sm:text-lg lg:text-sm mt-1">Services Provided</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Services Section -->

<!-- Testimonial Section -->



<!--End Testimonial Section -->

<!-- News & Media Section -->
<section class="py-16 lg:py-24 bg-gray-50">
    <div class="w-full lg:max-w-7xl mx-auto px-4 sm:px-6">
        @php
            $media = \App\News::where('type', 'media')->latest()->limit('1')->first();
            $newslater = \App\News::where('type', 'newslater')->latest()->limit('1')->first();
            $video = \App\Video::latest()->limit('1')->first();
            $nAcc = count($accentSchemes);
            $cMedia = $accentSchemes[0 % $nAcc];
            $cNewsletter = $accentSchemes[1 % $nAcc];
            $cVideo = $accentSchemes[2 % $nAcc];
            $cMediaSection = $accentSchemes[0 % $nAcc];
        @endphp

        <!-- Section Header -->
        <div class="text-center mb-14 lg:mb-20">
            <h2 class="text-6xl sm:text-5xl lg:text-4xl font-bold text-gray-800 mb-3 leading-tight transition-colors duration-200 {{ $cMediaSection['title_hover'] }}">
                Latest Updates & Media
            </h2>
            <div class="w-32 lg:w-28 h-1.5 {{ $cMediaSection['section_underline'] }} mx-auto rounded-full transition-transform duration-300 origin-center hover:scale-x-150"></div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-10 items-start">
            <!-- Media Coverage Card -->
            @if($media)
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden h-full flex flex-col {{ $cMedia['media_card_hover'] }}">
                <!-- Image Section -->
                <div class="relative h-64 sm:h-72 lg:h-80 overflow-hidden">
                    <img
                        src="{{ asset('images/news/' . $media->image) }}"
                        alt="{{ $media->title }}"
                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                        loading="lazy"
                    >
                    <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                        <span class="{{ $cMedia['accent_badge'] }} text-white text-sm lg:text-xs font-semibold px-4 py-1.5 lg:px-3 lg:py-1 rounded-full">
                            Media Coverage
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-5 sm:p-6 lg:p-6 flex-1 flex flex-col">
                    <h3 class="text-xl sm:text-2xl lg:text-lg font-semibold text-gray-800 mb-2 leading-tight line-clamp-2 transition-colors duration-200 {{ $cMedia['title_hover'] }}">
                        <a href="{{ route('media.coverage') }}" class="text-inherit hover:underline">
                            {{ $media->title }}
                        </a>
                    </h3>

                    <a href="{{ route('media.coverage') }}"
                       class="inline-flex text-base sm:text-lg lg:text-base items-center font-medium mt-auto pt-2 transition-colors duration-200 {{ $cMedia['gallery_view_link'] }}">
                        <span>Read More</span>
                        <svg class="w-5 h-5 lg:w-4 lg:h-4 ml-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endif
            <!-- Newsletter Card -->
            @if($newslater)
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden h-full flex flex-col {{ $cNewsletter['media_card_hover'] }}">
                <!-- Image Section -->
                <div class="relative h-64 sm:h-72 lg:h-80 overflow-hidden">
                    <img
                        src="{{ asset('images/news/' . $newslater->image) }}"
                        alt="{{ $newslater->title }}"
                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                        loading="lazy"
                    >
                    <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                        <span class="{{ $cNewsletter['accent_badge'] }} text-white text-sm lg:text-xs font-semibold px-4 py-1.5 lg:px-3 lg:py-1 rounded-full">
                            Newsletter
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-5 sm:p-6 lg:p-6 flex-1 flex flex-col">
                    <h3 class="text-xl sm:text-2xl lg:text-lg font-semibold text-gray-800 mb-2 leading-tight line-clamp-2 transition-colors duration-200 {{ $cNewsletter['title_hover'] }}">
                        <a href="{{ route('bulletin.show') }}" class="text-inherit hover:underline">
                            {{ $newslater->title }}
                        </a>
                    </h3>

                    <a href="{{ route('bulletin.show') }}"
                       class="inline-flex text-base sm:text-lg lg:text-base items-center font-medium mt-auto pt-2 transition-colors duration-200 {{ $cNewsletter['gallery_view_link'] }}">
                        <span>Read More</span>
                        <svg class="w-5 h-5 lg:w-4 lg:h-4 ml-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endif
            <!-- Video Gallery Card -->
            @if($video)
            <div class="bg-white rounded-xl lg:rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden h-full flex flex-col {{ $cVideo['media_card_hover'] }}">
                <!-- Video Section -->
                <div class="relative bg-gray-100 flex items-center justify-center min-h-[200px] sm:min-h-[240px] lg:min-h-[280px]">
                    <div class="text-center w-full">
                        <div class="bg-white rounded-lg shadow-sm max-w-full iframe-container">
                            {!! $video->description !!}
                        </div>
                        {{-- <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center mx-auto">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div> --}}
                    </div>

                    <div class="absolute top-3 left-3 sm:top-4 sm:left-4 z-10">
                        <span class="{{ $cVideo['accent_badge'] }} text-white text-sm lg:text-xs font-semibold px-4 py-1.5 lg:px-3 lg:py-1 rounded-full">
                            Video Gallery
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-5 sm:p-6 lg:p-6 flex-1 flex flex-col">
                    <h3 class="text-xl sm:text-2xl lg:text-lg font-semibold text-gray-800 mb-2 leading-tight line-clamp-2">
                        <a href="{{ route('show.video', [$video->id, $video->slug]) }}" class="text-inherit transition-colors duration-200 hover:underline {{ $cVideo['title_hover'] }}">
                            {{ $video->title }}
                        </a>
                    </h3>

                    <a href="{{ route('show.video', [$video->id, $video->slug]) }}"
                       class="inline-flex text-base sm:text-lg lg:text-base items-center font-medium mt-auto pt-2 transition-colors duration-200 {{ $cVideo['gallery_view_link'] }}">
                        <span>Watch Video</span>
                        <svg class="w-5 h-5 lg:w-4 lg:h-4 ml-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endif
			
        </div>

        <!-- View All Button -->
        <div class="text-center mt-10 lg:mt-12">
            <a href="#"
               class="inline-flex items-center justify-center text-white font-semibold px-8 py-4 lg:px-7 lg:py-3 rounded-full text-lg lg:text-base transition-colors duration-200 shadow-md hover:shadow-lg {{ $cMediaSection['donate'] }}">
                <span>View All Updates</span>
                <svg class="w-5 h-5 lg:w-4 lg:h-4 ml-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

    </div>
</section>

<!-- End News & Media Section -->

<style>
    .iframe-container iframe {
        width: 100% !important;
    }
</style>
    <!-- FOOTER SECTION -->
	@include('layouts.web.footer')


