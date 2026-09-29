
    @include('layouts.web.header')
    <!--End Main Header -->
<div class="w-full lg:max-w-7xl mx-auto px-4">
		<div class="text-center my-5">
			<h2 class="text-gray-900 uppercase !text-5xl lg:!text-4xl font-bold tracking-wide relative inline-block py-6 lg:py-3">
				Video Gallery
				<!-- Modern gradient underline -->
				{{-- <span class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-full"></span> --}}
				<!-- Decorative elements -->
				<div class="flex items-center justify-center mt-4 space-x-2">
					<div class="w-8 h-0.5 bg-blue-500 rounded"></div>
					<div class="w-2 h-2 bg-purple-500 rounded-full"></div>
					<div class="w-8 h-0.5 bg-pink-500 rounded"></div>
				</div>
			</h2>
		</div>
			<div class="flex flex-wrap">
				@foreach($videos AS $item)
                <div class='w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 px-3 mb-8'>
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-500 overflow-hidden group cursor-pointer transform hover:-translate-y-2 hover:scale-[1.02] border border-gray-100 hover:border-blue-200">

                        <!-- Video Container with Enhanced Animations -->
                        <div class="video-container aspect-video bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center overflow-hidden relative">

                            <!-- Background Pattern -->
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 via-purple-900/20 to-pink-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            <!-- Video Content -->
                            <div class="relative z-10 w-full h-full group-hover:scale-105 transition-transform duration-700 iframe-parent">
                                {!! $item->description !!}
                            </div>

                            <!-- Play Button Overlay -->
                            {{-- <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-20">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-4 shadow-2xl shadow-black/50 transform scale-75 group-hover:scale-100 transition-all duration-300">
                                    <svg class="w-8 h-8 text-gray-900 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div> --}}

                            <!-- Hover Effect Border -->
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/20 via-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
                        </div>

                        <!-- Content Section with Animations -->
                        <div class='p-6 text-left relative overflow-hidden'>
                            <!-- Animated Background -->
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>

                            <!-- Title with Animation -->
                            <h4 class='text-gray-800 font-bold !text-2xl lg:!text-base truncate mb-3 group-hover:text-blue-700 transition-all duration-300 transform group-hover:translate-x-1 relative z-10 leading-tight'>
                                {{$item->title}}
                            </h4>

                            <!-- Watch Button with Enhanced Animation -->
                            <div class="flex items-center justify-between relative z-10">
                                <div class="flex items-center !text-lg lg:!text-sm font-semibold text-gray-600 group-hover:text-blue-600 transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Watch Video
                                </div>

                                <!-- Animated Arrow -->
                                <div class="transform group-hover:translate-x-2 group-hover:scale-110 transition-all duration-300">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Animated Bottom Border -->
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-500"></div>
                        </div>

                        <!-- Floating Elements Animation -->
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-500 delay-200"></div>
                        <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-500 delay-300"></div>
                    </div>
                </div>
				@endforeach
				<div class="w-full mt-12 flex justify-center">
					<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-4">
						{{$videos->links()}}
					</div>
				</div>
			</div> <!-- row / end -->
			
	
	
</div>
	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')

<style>
.iframe-parent iframe {
    width: 100% !important;
    height: 100% !important;
}
/* Custom animations for video cards */
.video-container iframe {
    transition: all 0.5s ease;
}

/* Pulse animation for play button */
@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
    }
    50% {
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.8), 0 0 40px rgba(147, 51, 234, 0.6);
    }
}

/* Apply pulse to play button on hover */
.group:hover .backdrop-blur-sm {
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Smooth scroll for pagination */
.overflow-y-auto {
    scroll-behavior: smooth;
}

/* Enhanced hover effects */
.group:hover .video-container {
    filter: brightness(1.1) contrast(1.05);
}

/* Floating elements animation */
@keyframes float {
    0%, 100% { transform: translateY(0px) scale(1); }
    50% { transform: translateY(-5px) scale(1.1); }
}

.group:hover .absolute {
    animation: float 3s ease-in-out infinite;
}

/* Gradient text animation */
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.group:hover h4 {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899);
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Card entrance animation */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Staggered animation for cards */
.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4 {
    animation: slideInUp 0.6s ease-out forwards;
}

.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4:nth-child(1) { animation-delay: 0.1s; }
.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4:nth-child(2) { animation-delay: 0.2s; }
.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4:nth-child(3) { animation-delay: 0.3s; }
.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4:nth-child(4) { animation-delay: 0.4s; }
.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4:nth-child(5) { animation-delay: 0.5s; }
.w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4:nth-child(6) { animation-delay: 0.6s; }

/* Responsive adjustments */
@media (max-width: 640px) {
    .w-full.sm\\:w-1\\/2.lg\\:w-1\\/3.xl\\:w-1\\/4 {
        margin-bottom: 1.5rem;
    }
}

/* Loading state animation */
@keyframes shimmer {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}

.video-loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200px 100%;
    animation: shimmer 1.5s infinite;
}
</style>

<script>
$(document).ready(function(){
  
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
</script>
<script>
    $("a#gallery").fancybox();
</script>
