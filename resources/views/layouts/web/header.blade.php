@php
    $setting = \App\Helpers\Website::setting();
    $social = \App\Setting::first();
@endphp

<!-- Loading Spinner -->
<div id="loading-spinner" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    z-index: 50;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.3s ease-out;
    opacity: 1;">
    <div style="
        display: flex;
        flex-direction: column;
        align-items: center;">
        <img src="{{ $setting?->logo ? asset('uploads/setting/'.$setting->logo) : asset('images/logo1.png') }}"
             alt="Logo"
             style="
                width: 152px;
                height: auto;
                max-width: 240px;
                animation: pulse 2s infinite;
             ">
        <p style="
            margin-top: 1rem;
            color: #4B5563;
            font-weight: 500;
            font-size: 1rem;">Loading...</p>
    </div>
</div>

<header class="w-full sticky top-0 z-50" id="main-header" x-data="{}" x-cloak>

    <style>
        .skiptranslate span { display: none !important; }

        /* Loading Spinner Styles */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.05);
            }
        }

        /* Logo Hover Animation */
        .logo-container {
            position: relative;
        }

        .logo-zoom {
            transition: opacity 0.3s ease, visibility 0.3s ease;
            background-color: white;
            border-radius: 50%;
            z-index: 99;
            transform-origin: left top;
        }

        @keyframes logoZoomPulse {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(5);
            }
        }

        .logo-container:hover .logo-zoom {
            opacity: 1 !important;
            visibility: visible !important;
            animation: logoZoomPulse 1.5s ease-in-out;
        }

        /* Mobile menu styles */
        .open-mobile {
            left: 0 !important;
        }

        /* Hide Google Translate unwanted text */
        *:not(script):not(style) {
            /* Hide any element that contains "দ্বারা পরিচালিত" */
        }

        /* More specific CSS approach */
        .goog-te-banner-frame,
        .goog-te-ftab-frame,
        .goog-te-balloon-frame {
            display: none !important;
        }

        /* Hide elements containing the specific Bengali text */
        [class*="goog-te"]::after,
        [id*="goog-te"]::after {
            content: "";
            display: block;
        }
        /* Google injects a raw "Powered by " text node (no tag) — zero font on gadget hides it; restore on select */
        .goog-te-gadget {
            font-size: 0 !important;
            line-height: 0 !important;
        }
        .goog-te-combo {
            font-size: 14px !important;
            line-height: normal !important;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid rgba(255,255,255,.35);
            background: rgba(255,255,255,.15);
            color: #fff;
            outline: none;
        }
        .goog-te-combo option {
            color: #111;
        }

        /* Alpine.js x-cloak */
        [x-cloak] {
            display: none !important;
        }

        /* Mobile menu - force hidden by default */
        @media (max-width: 1023px) {
            nav ul.absolute.lg\\:static {
                transform: translateX(-1200px) !important;
                opacity: 0 !important;
                pointer-events: none !important;
                visibility: hidden !important;
            }
            nav ul.absolute.lg\\:static.open-mobile {
                transform: translateX(0) !important;
                opacity: 1 !important;
                pointer-events: auto !important;
                visibility: visible !important;
            }

            /* Ensure mobile button is touchable */
            nav button.lg\\:hidden {
                min-height: 44px !important;
                min-width: 44px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                -webkit-tap-highlight-color: transparent !important;
            }
        }
        #google_translate_element div div select {
            width: 120px !important;
        }
    </style>
    <!-- ================= TOP BAR (LIKE IMAGE 1) ================= -->
    <div
        id="top-bar"
        class="bg-gradient-to-r from-white to-[#00ccff]"
        >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 sm:py-6 lg:py-3">
            <div class="grid grid-cols-12 items-center gap-6 sm:gap-6 lg:gap-4">

                <div class="flex justify-between items-start gap-3 col-span-12 lg:col-span-6 lg:items-center lg:gap-2">
                    <!-- Left: logo + name -->
                    <div class="flex items-center gap-3 sm:gap-4 min-w-0 flex-1 lg:flex-initial lg:min-w-0 lg:gap-3">
                        <a href="{{ route('index') }}" class="shrink-0 logo-container">
                            <img
                                src="{{ $setting?->logo ? asset('uploads/setting/'.$setting->logo) : asset('images/logo1.png') }}"
                                class="h-20 w-auto sm:h-24 lg:h-14"
                                alt="IPAO Logo"
                            >
                            <img
                                src="{{ $setting?->logo ? asset('uploads/setting/'.$setting->logo) : asset('images/logo1.png') }}"
                                class="logo-zoom absolute top-0 left-0 w-20 sm:w-24 lg:w-14 h-auto opacity-0 invisible pointer-events-none"
                                alt="IPAO Logo Animated"
                            >
                        </a>
    
                        <div class="text-blue-900 min-w-0 flex-1 lg:flex-initial">
                            <div class="font-bold tracking-wide text-2xl sm:text-3xl lg:text-lg leading-[1.15] sm:leading-tight">
                                ILLITERACY AND POVERTY ALLEVIATION
                            </div>
                            <div class="font-bold tracking-wide text-2xl sm:text-3xl lg:text-lg leading-[1.15] sm:leading-tight">
                                ASSISTANCE ORGANIZATION (IPAO)
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end shrink-0 lg:hidden pt-1">
                        <div id="google_translate_element_mobile" class="origin-top-right scale-[1.18] sm:scale-110"></div>
                    </div>

                </div>

                <!-- Middle: social icons -->
                <div class="col-span-12 lg:col-span-3 flex flex-wrap justify-center items-center gap-5 sm:gap-5 py-2 sm:py-2 lg:py-0 lg:flex-nowrap lg:justify-center lg:gap-3 text-xl text-blue-900">
                    <a target="_blank" href="{{ $social->facebook ?? '#' }}" class="hover:opacity-80 inline-flex p-2 -m-2 min-w-[48px] min-h-[48px] items-center justify-center lg:p-0 lg:m-0 lg:min-w-0 lg:min-h-0" aria-label="Facebook">
                        <img src="{{ asset('/images/social-media/facebook-square.webp') }}" alt="" class="h-12 w-auto sm:h-11 lg:h-6">
                    </a>
                    <a target="_blank" href="{{ $social->youtube ?? '#' }}" class="hover:opacity-80 inline-flex p-2 -m-2 min-w-[48px] min-h-[48px] items-center justify-center lg:p-0 lg:m-0 lg:min-w-0 lg:min-h-0" aria-label="YouTube">
                        <img src="{{ asset('/images/social-media/youtube-square.webp') }}" alt="" class="h-12 w-auto sm:h-11 lg:h-6">
                    </a>
                    <a target="_blank" href="{{ $social->linkedin ?? '#' }}" class="hover:opacity-80 inline-flex p-2 -m-2 min-w-[48px] min-h-[48px] items-center justify-center lg:p-0 lg:m-0 lg:min-w-0 lg:min-h-0" aria-label="LinkedIn">
                        <img src="{{ asset('/images/social-media/linkedIn-square.webp') }}" alt="" class="h-12 w-auto sm:h-11 lg:h-6">
                    </a>
                    <a target="_blank" href="{{ $social->twitter ?? '#' }}" class="hover:opacity-80 bg-white inline-flex p-2 -m-2 rounded-md min-w-[48px] min-h-[48px] items-center justify-center lg:p-0 lg:m-0 lg:rounded-none lg:min-w-0 lg:min-h-0" aria-label="Twitter">
                        <img src="{{ asset('/images/social-media/twitter-square.png') }}" alt="" class="h-12 w-auto sm:h-11 lg:h-6">
                    </a>
                    <a target="_blank" href="{{ $social->instagram ?? '#' }}" class="hover:opacity-80 inline-flex p-2 -m-2 min-w-[48px] min-h-[48px] items-center justify-center lg:p-0 lg:m-0 lg:min-w-0 lg:min-h-0" aria-label="Instagram">
                        <img src="{{ asset('/images/social-media/instagram-square.png') }}" alt="" class="h-12 w-auto sm:h-11 lg:h-6">
                    </a>
                </div>

                <!-- Right: reg + email -->
                <div class="col-span-12 lg:col-span-3 text-blue-900 text-center lg:text-right text-xl sm:text-2xl lg:text-sm font-semibold leading-snug space-y-1.5">
                    <div>Charity Reg No : 1528</div>
                    <div>Email: info@ipaongo.org</div>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= NAVBAR ROW (BLUE) ================= -->
    <nav
        id="main-nav"
        class="w-full bg-sky-500 overflow-visible hidden lg:block"
        >
        <div class="max-w-7xl mx-auto px-2">
            <div class="flex justify-between gap-4 relative">

                <!-- Left: (Sticky) small logo -->
                <a href="{{ route('index') }}" id="sticky-logo" class="flex items-center gap-2 py-3 block lg:hidden">
                    <img
                        src="{{ $setting?->logo ? asset('uploads/setting/'.$setting->logo) : asset('images/logo1.png') }}"
                        class="h-[4.5rem] w-auto sm:h-24"
                        alt="IPAO"
                    >
                </a>

                <!-- Mobile toggle -->
                <button id="mobile-menu-toggle" class="lg:hidden text-white text-3xl touch-manipulation">
                    ☰
                </button>

                <!-- Center: Menu -->
                <ul
                    id="mobile-menu"
                    class="absolute lg:static bg-white shadow-lg lg:shadow-none top-full left-0 lg:bg-transparent lg:px-0 w-full lg:w-auto z-50 lg:flex lg:items-center lg:justify-center lg:flex-1 gap-[18px] text-white font-semibold text-sm transition-all duration-300 space-y-4 lg:space-y-0 -left-[1200px] lg:left-auto"
                    >
                    <li><a class="hover:underline text-black lg:text-white" href="{{ route('index') }}">HOME</a></li>

                    <li class="relative group h-full flex items-center py-5">
                        <a class="hover:underline text-black lg:text-white flex items-center gap-1" href="javascript:void(0)">
                            PROJECTS <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                        </a>
                        <div class="hidden group-hover:block absolute left-0 top-full w-screen max-h-96 overflow-y-auto">
                            <ul class="bg-gradient-to-b from-white via-white to-gray-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-gray-200/60 w-96 z-50 p-3">

                                @php
                                    $gparent = \App\Project::where('parent', 0)->where('menu',1)->where('order','!=',0)->orderBy('order','asc')->get();
                                @endphp

                                @foreach($gparent as $item)
                                @php
                                    $parents = \App\Project::where('parent', $item->id)->where('menu',1)->get();
                                    $isLastFive = $loop->index >= $loop->count - 6;
                                @endphp

                                <li class="relative group/sub">
                                    <a href="{{ route('project',[$item->id, $item->slug]) }}"
                                       class="block px-5 py-1 text-xs md:text-sm hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700 text-gray-800 flex items-center justify-between whitespace-nowrap rounded-md">

                                        {{ $item->title }}

                                        @if($parents->count())
                                        <span class="ml-3 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                        </span>
                                        @endif
                                    </a>

                                    @if(!$loop->last)
                                        <div class="border-b border-gray-100 my-1 mx-2"></div>
                                    @endif

                                    @if($parents->count())
                                    <ul class="hidden group-hover/sub:block absolute left-full {{ $isLastFive ? 'bottom-0' : 'top-0' }} bg-white rounded-xl shadow-xl min-w-64 z-50 p-2">

                                        @foreach($parents as $parent)
                                        @php
                                            $childs = \App\Project::where('parent', $parent->id)->where('menu',1)->get();
                                        @endphp

                                        <li class="relative group/child">
                                            <a href="{{ route('project',[$parent->id, $parent->slug]) }}"
                                               class="text-gray-800 block px-4 py-2 hover:bg-indigo-50 flex items-center justify-between whitespace-nowrap rounded-md text-xs md:text-sm">

                                                {{ $parent->title }}

                                                @if($childs->count())
                                                <span class="ml-3 text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                                                </span>
                                                @endif
                                            </a>

                                            @if($childs->count())
                                            <ul class="hidden group-hover/child:block absolute left-full {{ $isLastFive ? 'bottom-0' : 'top-0' }} bg-white rounded-xl shadow-xl min-w-64 z-50 p-2">

                                                @foreach($childs as $child)
                                                <li>
                                                    <a href="{{ route('project',[$child->id, $child->slug]) }}"
                                                       class="block text-gray-800 px-4 py-2 text-xs md:text-sm hover:bg-purple-50 whitespace-nowrap rounded-md">
                                                        {{ $child->title }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif

                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif

                                </li>
                                @endforeach
                            </ul>
                        </div>
                            
                    </li>

                    <li class="relative group h-full flex items-center">
                        <a class="hover:underline text-black lg:text-white flex items-center gap-1" href="javascript:void(0)">
                            ABOUT US <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                        </a>
                        <ul class="hidden group-hover:block absolute left-0 top-full bg-gradient-to-b from-white via-white to-teal-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-teal-200/60 min-w-64 z-50 p-3 max-h-[400px] overflow-y-auto scroll-smooth transform transition-all duration-300 ease-out opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 before:absolute before:inset-0 before:bg-gradient-to-br before:from-transparent before:via-transparent before:to-teal-100/30 before:rounded-2xl before:pointer-events-none">
                            <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-700 whitespace-nowrap rounded-md transition-all duration-200" href="{{ route('chairman.message') }}">Chairman's Message</a></li>
                            <div class="border-b border-teal-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-700 whitespace-nowrap rounded-md transition-all duration-200" href="{{ route('background.organization') }}">Background of the Organization</a></li>
                            <div class="border-b border-teal-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-700 whitespace-nowrap rounded-md transition-all duration-200" href="{{ route('vision.mission') }}">Mission & Vision</a></li>
                            <div class="border-b border-teal-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-700 whitespace-nowrap rounded-md transition-all duration-200" href="{{ route('goals.objectives') }}">Goals & Objectives</a></li>
                            <div class="border-b border-teal-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-teal-50 hover:to-cyan-50 hover:text-teal-700 whitespace-nowrap rounded-md transition-all duration-200" href="{{ route('careers') }}">Careers</a></li>
                            {{-- @php $subabout = \App\Page::whereIn('id', [4,5,6,7,9])->get(); @endphp
                            @foreach($subabout as $item)
                                <li>
                                    <a class="block text-black px-4 py-2 hover:bg-gray-100 whitespace-nowrap" href="{{ route('page', [$item->id, $item->slug]) }}">
                                        {{ $item->title }}
                                    </a>
                                </li>
                            @endforeach --}}
                            <li><a class="block text-black px-4 py-2 hover:bg-gray-100" href="{{ route('all.member') }}">Who We Are</a></li>
                        </ul>
                    </li>

                    <li class="relative group h-full flex items-center">
                        <a class="hover:underline text-black lg:text-white flex items-center gap-1" href="javascript:void(0)">
                            MEDIA <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                        </a>
                        <ul class="hidden group-hover:block absolute left-0 top-full bg-gradient-to-b from-white via-white to-emerald-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-emerald-200/60 min-w-64 z-50 p-3 max-h-[400px] overflow-y-auto scroll-smooth transform transition-all duration-300 ease-out opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 before:absolute before:inset-0 before:bg-gradient-to-br before:from-transparent before:via-transparent before:to-emerald-100/30 before:rounded-2xl before:pointer-events-none">
                            <li><a class="block text-gray-800 px-5 py-2 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 whitespace-nowrap rounded-md text-xs md:text-sm transition-all duration-200" href="{{ route('media.coverage') }}">Media Coverage</a></li>
                            <div class="border-b border-emerald-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 whitespace-nowrap rounded-md text-xs md:text-sm transition-all duration-200" href="{{ route('news') }}">News and Event</a></li>
                            <div class="border-b border-emerald-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 whitespace-nowrap rounded-md text-xs md:text-sm transition-all duration-200" href="{{ route('bulletin.show') }}">Bulletin</a></li>
                            <div class="border-b border-emerald-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 whitespace-nowrap rounded-md text-xs md:text-sm transition-all duration-200" href="{{ route('gallery') }}">Photo Gallery</a></li>
                            <div class="border-b border-emerald-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 hover:text-emerald-700 whitespace-nowrap rounded-md text-xs md:text-sm transition-all duration-200" href="{{ route('show.video') }}">Video Gallery</a></li>
                        </ul>
                    </li>

                    <li><a class="hover:underline text-black lg:text-white" href="{{ route('page', [8,'network']) }}">ACTIVITIES</a></li>
                    <li><a class="hover:underline text-black lg:text-white" href="{{ route('contactUs') }}">CONTACT US</a></li>
                    <li><a class="hover:underline text-black lg:text-white" href="https://ipaongo.org/webmail" target="_blank">WEBMAIL</a></li>
                    <div class="lg:hidden flex items-center gap-3 py-3">
                        <div class="relative group">
                            <a href="#" class="px-4 py-2 rounded-full bg-red-500 text-white text-xs font-bold hover:opacity-90 flex items-center gap-1">
                                BLOOD <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                            </a>
                            <ul class="hidden group-hover:block absolute left-0 top-full bg-gradient-to-b from-white via-white to-red-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-red-200/60 min-w-64 z-50 p-3 max-h-[400px] overflow-y-auto scroll-smooth transform transition-all duration-300 ease-out opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 before:absolute before:inset-0 before:bg-gradient-to-br before:from-transparent before:via-transparent before:to-red-100/30 before:rounded-2xl before:pointer-events-none">
                                <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 hover:text-red-700 whitespace-nowrap rounded-md transition-all duration-200" href="#">Donate blood</a></li>
                                <div class="border-b border-red-100 my-1 mx-2"></div>
                                <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 hover:text-red-700 whitespace-nowrap rounded-md transition-all duration-200" href="#">Take blood</a></li>
                                <div class="border-b border-red-100 my-1 mx-2"></div>
                            </ul>
                        </div>
                        <div class="relative group">
                            <a href="#" class="px-4 py-2 rounded-full bg-orange-500 text-white text-xs font-bold hover:opacity-90 flex items-center gap-1">
                                GET INVOLVED <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                            </a>
                            <ul class="hidden group-hover:block absolute left-0 top-full bg-gradient-to-b from-white via-white to-orange-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-orange-200/60 min-w-64 z-50 p-3 max-h-[400px] overflow-y-auto scroll-smooth transform transition-all duration-300 ease-out opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 before:absolute before:inset-0 before:bg-gradient-to-br before:from-transparent before:via-transparent before:to-orange-100/30 before:rounded-2xl before:pointer-events-none">
                                <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 whitespace-nowrap rounded-md transition-all duration-200" href="#">Be a volunteer</a></li>
                                <div class="border-b border-orange-100 my-1 mx-2"></div>
                                <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 whitespace-nowrap rounded-md transition-all duration-200" href="{{ route('volunteer.login') }}">Volunteer and login</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('donate.show') }}"
                           class="px-4 py-2 rounded-full bg-green-600 text-white text-xs font-bold hover:opacity-90">
                            DONATE NOW
                        </a>
    
                        <div class="ml-3 flex flex-col items-start">
                                <div id="google_translate_element_mobile_menu"></div>
                        </div>
                    </div>
                </ul>

                <!-- Right: CTA buttons + translate -->
                <div class="hidden lg:flex items-center gap-3 p-2 lg:p-0">
                    <div class="relative group py-5">
                        <a href="#" class="px-4 py-2 rounded-full bg-red-500 text-white text-xs font-bold hover:opacity-90 flex items-center gap-1">
                            BLOOD <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                        </a>
                        <ul class="hidden group-hover:block absolute left-0 top-[66px] bg-gradient-to-b from-white via-white to-red-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-red-200/60 min-w-64 z-50 p-3 max-h-[400px] overflow-y-auto scroll-smooth transform transition-all duration-300 ease-out opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 before:absolute before:inset-0 before:bg-gradient-to-br before:from-transparent before:via-transparent before:to-red-100/30 before:rounded-2xl before:pointer-events-none">
                            <li><a class="block text-gray-800 px-5 py-2 text-xs md:text-sm hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 hover:text-red-700 whitespace-nowrap text-sm rounded-md transition-all duration-200" href="{{ route('blood.doner') }}">Donate blood</a></li>
                            <div class="border-b border-red-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 py-2 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 hover:text-red-700 whitespace-nowrap text-sm rounded-md transition-all duration-200" href="{{ route('blood.doner.list') }}">Take blood</a></li>
                        </ul>
                    </div>
                    <div class="relative group py-5">
                        <a href="#" class="px-4 py-2 rounded-full bg-orange-500 text-white text-xs font-bold hover:opacity-90 flex items-center gap-1">
                            GET INVOLVED <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg></span>
                        </a>
                        <ul class="hidden group-hover:block absolute left-0 top-[66px] bg-gradient-to-b from-white via-white to-orange-50/80 backdrop-blur-md text-gray-900 rounded-2xl shadow-2xl shadow-black/25 border border-orange-200/60 min-w-64 z-50 p-3 max-h-[400px] overflow-y-auto scroll-smooth transform transition-all duration-300 ease-out opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 before:absolute before:inset-0 before:bg-gradient-to-br before:from-transparent before:via-transparent before:to-orange-100/30 before:rounded-2xl before:pointer-events-none">
                            <li><a class="block text-gray-800 px-5 text-xs md:text-sm py-2 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 whitespace-nowrap text-sm rounded-md transition-all duration-200" href="{{ route('volunteer_register') }}">Be a volunteer</a></li>
                            <div class="border-b border-orange-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 text-xs md:text-sm py-2 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 whitespace-nowrap text-sm rounded-md transition-all duration-200" href="{{ route('blood.volunteer.list') }}">Volunteer</a></li>
                            <div class="border-b border-orange-100 my-1 mx-2"></div>
                            <li><a class="block text-gray-800 px-5 text-xs md:text-sm py-2 hover:bg-gradient-to-r hover:from-orange-50 hover:to-amber-50 hover:text-orange-700 whitespace-nowrap text-sm rounded-md transition-all duration-200" href="{{ route('volunteer.login') }}">login</a></li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-center">
                        <a href="{{ route('donate.show') }}"
                        class="px-4 py-2 rounded-full bg-green-600 text-white text-xs font-bold hover:opacity-90">
                            DONATE NOW
                        </a>

                    </div>

                    <!-- Google translate -->
                    <div class="ml-3 flex flex-col items-start">
                            <div id="google_translate_element"></div>
                    </div>
                </div>

            </div>

            <!-- Mobile: CTA + translate (Alpine scope local to this block) -->
            <div x-cloak x-data="{ open: false }" x-show="open" class="lg:hidden">
                <div class="hidden lg:flex flex-wrap gap-2">
                    <a href="{{ route('gallery') }}" class="px-4 py-2 rounded-full bg-red-500 text-white text-xs font-bold">BLOOD</a>
                    <a href="{{ route('gallery') }}" class="px-4 py-2 rounded-full bg-orange-500 text-white text-xs font-bold">GET INVOLVED</a>
                    <a href="{{ route('donate.show') }}" class="px-4 py-2 rounded-full bg-green-600 text-white text-xs font-bold">DONATE NOW</a>
                </div>

                <div class="mt-3 hidden lg:block">
                    <div id="google_translate_element_mobile"></div>
                    <div class="text-white/90 text-[11px] font-medium mt-1">Translate ভাষা পরিবর্তন</div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        window.mobileOnlyNavData = function () {
            return {
                openProjects: false,
                openAbout: false,
                openMedia: false,
                openBlood: false,
                openInvolved: false,
                categoryOpen: null,
                subOpen: null,
            };
        };
    </script>

    <!-- ================= MOBILE MENU (Mobile Only) ================= -->
    <nav id="mobile-only-nav" class="lg:hidden w-full bg-white shadow-lg border-t border-gray-200" x-data="mobileOnlyNavData()">
        <!-- Mobile Menu Toggle Button -->
        <div class="flex justify-between items-center px-6 py-6 text-4xl border-b border-gray-200">
            <button id="mobile-nav-toggle" class="text-gray-800 touch-manipulation">
                ☰
            </button>
            <span class="text-gray-800 font-semibold text-2xl">Menu</span>
        </div>
        <div id="mobile-nav-content" class="w-full mx-auto px-6 py-8">
            <!-- Mobile Menu Content -->
            <div class="space-y-5">
                <!-- Main Navigation Links -->
                <div class="space-y-3 max-h-[calc(100vh-600px)] overflow-y-auto">
                    <a href="{{ route('index') }}" class="block w-full text-3xl text-left px-6 py-4 text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        HOME
                    </a>

                    <!-- Projects Section -->
                    <div class="space-y-3">
                        <button type="button" id="mobile-projects-toggle" class="flex items-center justify-between text-3xl w-full px-6 py-4 text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200" x-on:click.stop="openProjects = !openProjects">
                            <span>PROJECTS</span>
                            <span class="text-lg shrink-0 transition-transform duration-200" :class="{ 'rotate-90': openProjects }"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                        </button>
                        <div id="mobile-projects-menu" class="text-2xl ml-4 space-y-2" x-show="openProjects" x-transition x-cloak style="display: none;">
                            @php
                                $gparent = \App\Project::where('parent', 0)->where('menu',1)->where('order','!=',0)->orderBy('order','asc')->get();
                            @endphp
                            @foreach($gparent as $item)
                            @php
                                $parents = \App\Project::where('parent', $item->id)->where('menu',1)->get();
                            @endphp

                            <!-- Main Project Category -->
                            <div class="space-y-1">
                                @if($parents->count())
                                <button type="button" class="mobile-project-category-toggle flex items-center justify-between w-full px-5 py-3 text-left text-2xl text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200"
                                        x-on:click.stop="categoryOpen = categoryOpen === {{ $item->id }} ? null : {{ $item->id }}">
                                    <span>{{ $item->title }}</span>
                                    <span class="text-xl shrink-0 category-icon transition-transform duration-200" :class="{ 'rotate-90': categoryOpen === {{ $item->id }} }"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                                </button>
                                <div class="mobile-project-sub-{{ $item->id }} ml-3 space-y-1" x-show="categoryOpen === {{ $item->id }}" x-transition x-cloak style="display: none;">
                                    @foreach($parents as $parent)
                                    @php
                                        $childs = \App\Project::where('parent', $parent->id)->where('menu',1)->get();
                                    @endphp

                                    @if($childs->count())
                                    <div class="space-y-1">
                                        <button type="button" class="mobile-project-sub-toggle flex items-center justify-between w-full px-5 py-3 text-left text-2xl text-gray-500 hover:text-gray-900 hover:bg-gray-300 rounded-md transition-colors duration-200"
                                                x-on:click.stop="subOpen = subOpen === {{ $parent->id }} ? null : {{ $parent->id }}">
                                            <span>{{ $parent->title }}</span>
                                            <span class="text-xl shrink-0 sub-icon transition-transform duration-200" :class="{ 'rotate-90': subOpen === {{ $parent->id }} }"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                                        </button>
                                        <div class="mobile-project-child-{{ $parent->id }} ml-3 space-y-1" x-show="subOpen === {{ $parent->id }}" x-transition x-cloak style="display: none;">
                                            @foreach($childs as $child)
                                            <a href="{{ route('project',[$child->id, $child->slug]) }}" class="block px-5 py-3 text-2xl text-gray-400 hover:text-gray-900 hover:bg-gray-300 rounded-md transition-colors duration-200">
                                                {{ $child->title }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                    <a href="{{ route('project',[$parent->id, $parent->slug]) }}" class="block px-5 py-3 text-2xl text-gray-500 hover:text-gray-900 hover:bg-gray-300 rounded-md transition-colors duration-200">
                                        {{ $parent->title }}
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                                @else
                                <a href="{{ route('project',[$item->id, $item->slug]) }}" class="block px-5 py-3 text-2xl text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">
                                    {{ $item->title }}
                                </a>
                                @endif
                            </div>

                            @if(!$loop->last)
                            <div class="border-b border-gray-300 my-2"></div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="space-y-3">
                        <button type="button" id="mobile-about-toggle" class="flex items-center justify-between text-3xl w-full px-6 py-4 text-left text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200" x-on:click.stop="openAbout = !openAbout">
                            <span>ABOUT US</span>
                            <span class="text-lg shrink-0 transition-transform duration-200" :class="{ 'rotate-90': openAbout }"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                        </button>
                        <div id="mobile-about-menu" class="ml-4 space-y-2 text-2xl" x-show="openAbout" x-transition x-cloak style="display: none;">
                            <a href="{{ route('chairman.message') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Chairman's Message</a>
                            <a href="{{ route('background.organization') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Background of the Organization</a>
                            <a href="{{ route('vision.mission') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Mission & Vision</a>
                            <a href="{{ route('goals.objectives') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Goals & Objectives</a>
                            <a href="{{ route('careers') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Careers</a>
                        </div>
                    </div>

                    <!-- Media Section -->
                    <div class="space-y-3">
                        <button type="button" id="mobile-media-toggle" class="flex items-center justify-between w-full px-6 py-4 text-left text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200 text-3xl" x-on:click.stop="openMedia = !openMedia">
                            <span>MEDIA</span>
                            <span class="text-lg shrink-0 transition-transform duration-200" :class="{ 'rotate-90': openMedia }"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                        </button>
                        <div id="mobile-media-menu" class="ml-4 space-y-2 text-2xl" x-show="openMedia" x-transition x-cloak style="display: none;">
                            <a href="{{ route('media.coverage') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Media Coverage</a>
                            <a href="{{ route('news') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">News and Event</a>
                            <a href="{{ route('bulletin.show') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Bulletin</a>
                            <a href="{{ route('gallery') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Photo Gallery</a>
                            <a href="{{ route('show.video') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Video Gallery</a>
                        </div>
                    </div>

                    <!-- Other Links -->
                    <a href="{{ route('page', [8,'network']) }}" class="block w-full text-3xl text-left px-6 py-4 text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        ACTIVITIES
                    </a>

                    <a href="{{ route('contactUs') }}" class="block w-full text-3xl text-left px-6 py-4 text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        CONTACT US
                    </a>

                    <a href="https://ipaongo.org/webmail" target="_blank" class="block w-full text-3xl text-left px-6 py-4 text-gray-800 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        WEBMAIL
                    </a>
                </div>

                <!-- CTA Buttons Section -->
                <div class="border-t border-gray-300 pt-6 space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <!-- BLOOD Section -->
                        <div class="space-y-3">
                            <button type="button" id="mobile-blood-toggle" class="flex items-center justify-between text-3xl w-full px-6 py-4 text-left text-red-700 font-semibold bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200" x-on:click.stop="openBlood = !openBlood">
                                <span>🩸 BLOOD</span>
                                <span class="text-lg shrink-0 transition-transform duration-200" :class="{ 'rotate-90': openBlood }"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                            </button>
                            <div id="mobile-blood-menu" class="ml-4 space-y-2 text-2xl" x-show="openBlood" x-transition x-cloak style="display: none;">
                                <a href="{{ route('blood.doner') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Donate blood</a>
                                <a href="{{ route('blood.doner.list') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Take blood</a>
                            </div>
                        </div>

                        <!-- GET INVOLVED Section -->
                        <div class="space-y-3">
                            <button type="button" id="mobile-get-involved-toggle" class="flex items-center justify-between text-3xl w-full px-6 py-4 text-left text-white font-semibold bg-orange-500 rounded-lg hover:bg-orange-600 transition-colors duration-200" x-on:click.stop="openInvolved = !openInvolved">
                                <span>🤝 GET INVOLVED</span>
                                <span class="text-lg shrink-0 transition-transform duration-200" :class="{ 'rotate-90': openInvolved }"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg></span>
                            </button>
                            <div id="mobile-get-involved-menu" class="ml-4 space-y-2 text-2xl" x-show="openInvolved" x-transition x-cloak style="display: none;">
                                <a href="{{ route('volunteer_register') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Be a volunteer</a>
                                <a href="{{ route('blood.volunteer.list') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Volunteer</a>
                                <a href="{{ route('volunteer.login') }}" class="block px-5 py-3 text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md transition-colors duration-200">Login</a>
                            </div>
                        </div>

                        <!-- DONATE NOW Button -->
                        <a href="{{ route('donate.show') }}" class="block w-full text-center text-3xl px-6 py-4 text-white font-bold bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                            💚 DONATE NOW
                        </a>
                    </div>
                </div>

                
            </div>
        </div>
    </nav>

    <!-- Google Translate script -->
    
    <script type="text/javascript">

        function hideUnwantedText() {
            const targetText = " দ্বারা পরিচালিত";

            // Method 1: Tree walker for text nodes
            const walker = document.createTreeWalker(
                document.body,
                NodeFilter.SHOW_TEXT,
                null,
                false
            );

            let node;
            while ((node = walker.nextNode())) {
                if (node.nodeValue && node.nodeValue.includes(targetText)) {
                    node.nodeValue = node.nodeValue.replace(targetText, '');
                }
            }

            // Method 2: CSS approach - hide any element containing this text
            const allElements = document.querySelectorAll('*');
            allElements.forEach(element => {
                if (element.textContent && element.textContent.includes(targetText)) {
                    // Hide the parent element that contains this text
                    let parent = element;
                    while (parent && parent !== document.body) {
                        if (parent.textContent.includes(targetText)) {
                            parent.style.display = 'none';
                            break;
                        }
                        parent = parent.parentElement;
                    }
                }
            });

            // Method 3: MutationObserver for dynamically added content
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    mutation.addedNodes.forEach((node) => {
                        if (node.nodeType === Node.TEXT_NODE && node.nodeValue && node.nodeValue.includes(targetText)) {
                            node.nodeValue = node.nodeValue.replace(targetText, '');
                        } else if (node.nodeType === Node.ELEMENT_NODE) {
                            // Check if the added element contains the text
                            if (node.textContent && node.textContent.includes(targetText)) {
                                node.style.display = 'none';
                            }
                        }
                    });
                });
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }

        // Google Translate initialization - make it globally available
        window.googleTranslateElementInit = function() {
            try {
                // Initialize main desktop translate element
                if (document.getElementById('google_translate_element')) {
                    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                }

                // Initialize mobile translate element if it exists
                if (document.getElementById('google_translate_element_mobile')) {
                    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element_mobile');
                }

                // Initialize mobile menu translate element if it exists
                if (document.getElementById('google_translate_element_mobile_menu')) {
                    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element_mobile_menu');
                }

                // Hide the unwanted text after Google Translate loads
                setTimeout(() => {
                    hideUnwantedText();
                    console.log('Google Translate initialized successfully');
                }, 1000);
            } catch (error) {
                console.error('Google Translate initialization failed:', error);
            }
        };
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async defer></script>
    <script>
        // Configure Tailwind before loading
        window.tailwind = {
          config: {
            theme: {
              screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
              },
              extend: {
                colors: {
                  clifford: '#da373d',
                }
              }
            }
          }
        };
      </script>
    <script src="{{ asset('js/tailwindCss3.4.17') }}"></script>
    <script defer src="{{ asset('js/cdn.alpine.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hide loading spinner when page is ready
        window.addEventListener('load', hideSpinner);

        setTimeout(hideSpinner, 8000); // emergency fallback

        function hideSpinner() {
            const spinner = document.getElementById('loading-spinner');
            if (!spinner || spinner.dataset.hidden) return;

            spinner.dataset.hidden = "true";
            spinner.style.opacity = '0';

            setTimeout(() => {
                spinner.style.display = 'none';
            }, 300);
        }


        // Mobile menu fallback - works on all routes for mobile
        document.addEventListener('DOMContentLoaded', function() {
            const isMobile = window.innerWidth < 1024;

            console.log('Mobile menu init - isMobile:', isMobile, 'route:', window.location.pathname);

            if (isMobile) {
                const mobileButton = document.querySelector('button.lg\\:hidden');
                const mobileMenu = document.querySelector('ul.absolute.lg\\:static');

                if (mobileButton && mobileMenu) {
                    // Override the button's click behavior for mobile
                    const originalHandler = mobileButton.onclick;
                    let menuOpen = false;

                    // Handle both click and touch events for mobile
                    function toggleMenu(e) {
                        if (e) {
                            e.preventDefault();
                            e.stopPropagation();
                        }

                        menuOpen = !menuOpen;

                        if (menuOpen) {
                            mobileMenu.classList.add('open-mobile');
                            mobileMenu.style.transform = 'translateX(0)';
                            mobileMenu.style.opacity = '1';
                            mobileMenu.style.pointerEvents = 'auto';
                            mobileMenu.style.visibility = 'visible';
                        } else {
                            mobileMenu.classList.remove('open-mobile');
                            mobileMenu.style.transform = 'translateX(-1200px)';
                            mobileMenu.style.opacity = '0';
                            mobileMenu.style.pointerEvents = 'none';
                            mobileMenu.style.visibility = 'hidden';
                        }

                        console.log('Mobile menu toggled to:', menuOpen);
                    }

                    // Add both click and touch events
                    mobileButton.addEventListener('click', toggleMenu);
                    mobileButton.addEventListener('touchend', function(e) {
                        e.preventDefault();
                        toggleMenu();
                    });

                    // Close menu when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!mobileButton.contains(e.target) && !mobileMenu.contains(e.target) && menuOpen) {
                            menuOpen = false;
                            mobileMenu.classList.remove('open-mobile');
                            mobileMenu.style.transform = 'translateX(-1200px)';
                            mobileMenu.style.opacity = '0';
                            mobileMenu.style.pointerEvents = 'none';
                            mobileMenu.style.visibility = 'hidden';
                            console.log('Mobile menu closed by outside click');
                        }
                    });

                    // Ensure menu starts closed on ALL routes
                    setTimeout(() => {
                        mobileMenu.classList.remove('open-mobile');
                        mobileMenu.style.transform = 'translateX(-1200px)';
                        mobileMenu.style.opacity = '0';
                        mobileMenu.style.pointerEvents = 'none';
                        mobileMenu.style.visibility = 'hidden';
                        console.log('Mobile menu forced closed on:', window.location.pathname);
                    }, 100);

                    console.log('Mobile menu fallback initialized for:', window.location.pathname);
                }
            }
        });

        // Mobile Menu Toggle with Vanilla JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            let isMenuOpen = false;

            function toggleMobileMenu() {
                isMenuOpen = !isMenuOpen;

                if (isMenuOpen) {
                    mobileMenu.classList.remove('-left-[1200px]');
                    mobileMenu.classList.add('left-0', 'open-mobile');
                } else {
                    mobileMenu.classList.remove('left-0', 'open-mobile');
                    mobileMenu.classList.add('-left-[1200px]');
                }
            }

            // Toggle menu on button click
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                toggleMobileMenu();
            });

            // Close menu when clicking on menu items (mobile)
            const mobileMenuLinks = mobileMenu.querySelectorAll('a:not([href="javascript:void(0)"])');
            mobileMenuLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024 && isMenuOpen) {
                        toggleMobileMenu();
                    }
                });
            });

            // Close menu when clicking outside (on mobile)
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 1024) { // Only on mobile
                    if (!mobileMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                        if (isMenuOpen) {
                            toggleMobileMenu();
                        }
                    }
                }
            });

            // Close menu on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024 && isMenuOpen) {
                    toggleMobileMenu();
                }
            });

                // Handle mobile dropdowns - convert group hover to click for mobile
                if (window.innerWidth < 1024) {
                    // Projects dropdown
                    const projectsLink = mobileMenu.querySelector('a[href="javascript:void(0)"]');
                    if (projectsLink) {
                        const projectsDropdown = projectsLink.parentElement.querySelector('ul');
                        if (projectsDropdown) {
                            projectsLink.addEventListener('click', function(e) {
                                e.preventDefault();
                                projectsDropdown.classList.toggle('hidden');
                            });
                        }
                    }

                    // BLOOD dropdown
                    const bloodDropdowns = mobileMenu.querySelectorAll('div.relative.group');
                    bloodDropdowns.forEach(function(dropdown) {
                        const link = dropdown.querySelector('a');
                        const menu = dropdown.querySelector('ul');

                        if (link && menu) {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();
                                menu.classList.toggle('hidden');
                            });
                        }
                    });
                }

                /* Mobile-only submenus: Alpine.js on #mobile-only-nav (mobileOnlyNavData) */
        });

        // Mobile Navigation Toggle (for mobile-only-nav)
        document.addEventListener('DOMContentLoaded', function() {
            const mobileNavToggle = document.getElementById('mobile-nav-toggle');
            const mobileNavContent = document.getElementById('mobile-nav-content');
            let isMobileNavOpen = false;

            if (mobileNavToggle && mobileNavContent) {
                // Initially hide the mobile nav content
                mobileNavContent.style.display = 'none';

                function toggleMobileNav() {
                    isMobileNavOpen = !isMobileNavOpen;

                    if (isMobileNavOpen) {
                        mobileNavContent.style.display = 'block';
                        mobileNavToggle.textContent = '✕'; // Change to X when open
                    } else {
                        mobileNavContent.style.display = 'none';
                        mobileNavToggle.textContent = '☰'; // Change back to hamburger when closed
                    }
                }

                // Toggle nav on button click
                mobileNavToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMobileNav();
                });

                // Close nav when clicking on nav links (mobile)
                const mobileNavLinks = mobileNavContent.querySelectorAll('a:not([href="javascript:void(0)"])');
                mobileNavLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 1024 && isMobileNavOpen) {
                            toggleMobileNav();
                        }
                    });
                });

                const mobileOnlyNavEl = document.getElementById('mobile-only-nav');
                document.addEventListener('click', function(e) {
                    if (window.innerWidth < 1024 && isMobileNavOpen && mobileOnlyNavEl) {
                        const t = e.target;
                        if (!t || !t.closest || !t.closest('#mobile-only-nav')) {
                            toggleMobileNav();
                        }
                    }
                });
            }
        });
    </script>
</header>
