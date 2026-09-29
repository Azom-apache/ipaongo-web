@php
    $setting = \App\Helpers\Website::setting();
@endphp

<footer class="bg-[#55CCF6] text-white">

    <!-- ================= MAIN FOOTER ================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 sm:gap-12 lg:gap-14">

            <!-- About Us -->
            <div>
                <h3 class="text-2xl sm:text-3xl lg:text-xl font-bold mb-5 leading-tight relative inline-block">
                    About Us
                    <span class="block w-10 lg:w-9 h-1 lg:h-0.5 bg-white/90 mt-2.5 rounded-full"></span>
                </h3>

                <ul class="space-y-3 lg:space-y-2 text-lg sm:text-xl lg:text-base font-medium leading-snug">
                    @php
                        $aboutPages = \App\Page::whereIn('id',[4,5,6,7,9])->get();
                    @endphp
                    @foreach($aboutPages as $page)
                        <li>
                            <a href="{{ route('page',[$page->id,$page->slug]) }}" class="hover:underline">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                    <li><a href="{{ route('jobs') }}" class="hover:underline">Career</a></li>
                </ul>
            </div>

            <!-- Our Work -->
            <div>
                <h3 class="text-2xl sm:text-3xl lg:text-xl font-bold mb-5 leading-tight relative inline-block">
                    Our Work
                    <span class="block w-10 lg:w-9 h-1 lg:h-0.5 bg-white/90 mt-2.5 rounded-full"></span>
                </h3>

                <ul class="space-y-3 lg:space-y-2 text-lg sm:text-xl lg:text-base font-medium leading-snug">
                    @php
                        $projects = \App\Project::where('parent',0)
                                    ->where('menu',1)
                                    ->where('order','!=',0)
                                    ->orderBy('order','asc')
                                    ->take(8)
                                    ->get();
                    @endphp
                    @foreach($projects as $project)
                        <li>
                            <a href="{{ route('project',[$project->id,$project->slug]) }}" class="hover:underline">
                                {{ $project->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Get Involved -->
            <div>
                <h3 class="text-2xl sm:text-3xl lg:text-xl font-bold mb-5 leading-tight relative inline-block">
                    Get Involved
                    <span class="block w-10 lg:w-9 h-1 lg:h-0.5 bg-white/90 mt-2.5 rounded-full"></span>
                </h3>

                <ul class="space-y-3 lg:space-y-2 text-lg sm:text-xl lg:text-base font-medium leading-snug">
                    <li><a href="{{ route('blood.doner') }}" class="hover:underline">Donate Blood</a></li>
                    <li><a href="{{ route('blood.doner.list') }}" class="hover:underline">Take Blood</a></li>
                    <li><a href="{{ route('volunteer_register') }}" class="hover:underline">Be a Volunteer</a></li>
                    <li><a href="{{ route('blood.volunteer.list') }}" class="hover:underline">Volunteer</a></li>
                </ul>
            </div>

            <!-- Media -->
            <div>
                <h3 class="text-2xl sm:text-3xl lg:text-xl font-bold mb-5 leading-tight relative inline-block">
                    Media
                    <span class="block w-10 lg:w-9 h-1 lg:h-0.5 bg-white/90 mt-2.5 rounded-full"></span>
                </h3>

                <ul class="space-y-3 lg:space-y-2 text-lg sm:text-xl lg:text-base font-medium leading-snug">
                    <li><a href="{{ route('media.coverage') }}" class="hover:underline">Media Coverage</a></li>
                    <li><a href="{{ route('news') }}" class="hover:underline">News and Event</a></li>
                    <li><a href="{{ route('bulletin.show') }}" class="hover:underline">Bulletin</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:underline">Photo Gallery</a></li>
                    <li><a href="{{ route('show.video') }}" class="hover:underline">Video Gallery</a></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- ================= ADDRESS STRIP ================= -->
    <div class="border-t border-white/30 py-5 lg:py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-wrap justify-center items-center gap-4 sm:gap-6 text-base sm:text-lg lg:text-sm font-medium text-center leading-snug">
            <span class="flex items-center justify-center gap-2.5">
                <i class="fa fa-map-marker text-lg lg:text-base shrink-0" aria-hidden="true"></i>
                {{ $setting->address_1 }}
            </span>
            <span class="flex items-center justify-center gap-2.5">
                <i class="fa fa-phone text-lg lg:text-base shrink-0" aria-hidden="true"></i>
                {{ $setting->mobile }}
            </span>
            <span class="flex items-center justify-center gap-2.5">
                <i class="fa fa-envelope text-lg lg:text-base shrink-0" aria-hidden="true"></i>
                {{ $setting->email }}
            </span>
        </div>
    </div>

    <!-- ================= COPYRIGHT ================= -->
    <div class="border-t border-white/30 py-5 lg:py-4 text-center text-base sm:text-lg lg:text-sm font-medium">
        © {{ date('Y') }} All rights reserved by ipaongo
    </div>

    <!-- ================= BACK TO TOP ================= -->
    <button
        onclick="window.scrollTo({top:0, behavior:'smooth'})"
        class="fixed bottom-6 right-6 sm:bottom-8 sm:right-8 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white p-5 sm:p-4 rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ease-in-out opacity-80 hover:opacity-100 z-50 group"
        aria-label="Back to top"
        title="Back to top"
    >
        <svg
            class="w-6 h-6 sm:w-5 sm:h-5 transform group-hover:-translate-y-1 transition-transform duration-300"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 10l7-7m0 0l7 7m-7-7v18"
            ></path>
        </svg>
    </button>

</footer>
