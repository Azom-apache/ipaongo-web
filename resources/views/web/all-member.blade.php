
    @include('layouts.web.header')
    <!--End Main Header -->



	<div class="w-full lg:max-w-7xl mx-auto px-4 py-12" id="all-members">
		<div class="text-center mb-16">
			<h2 class="text-gray-900 uppercase text-3xl lg:text-4xl font-bold tracking-wide relative inline-block">
				@if(Request::route()->getName()=='all.member')
				Who We Are
				@elseif(Request::route()->getName()=='dedicated.volunteer')
				Dedicated Volunteer
				@elseif(Request::route()->getName()=='area.volunter')
				Area Volunteer
				@elseif(Request::route()->getName()=='districs.ambasador')
				District Ambassador
				@else
				Campus
				@endif
				<!-- Minimalist underline -->
				<div class="flex items-center justify-center mt-4 space-x-2">
					<div class="w-8 h-0.5 bg-blue-500 rounded"></div>
					<div class="w-2 h-2 bg-purple-500 rounded-full"></div>
					<div class="w-8 h-0.5 bg-pink-500 rounded"></div>
				</div>
			</h2>
		</div>
		
		
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
		    @foreach($members AS $item)
				<div class="group relative">
					<!-- Colorful background overlay -->
					<div class="absolute inset-0 bg-gradient-to-br from-blue-400/10 via-purple-400/10 to-pink-400/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>

					<div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-500 overflow-hidden transform hover:-translate-y-1 hover:scale-[1.01] relative z-10">

						<!-- Profile Image -->
						<div class="relative overflow-hidden">
							<div class="bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
								<img
									src="{{asset('/uploads/members/'.$item->image)}}"
									alt="{{$item->name}}"
									class="w-full h-full object-contain rounded-xl transition-transform duration-700 group-hover:scale-105"
								/>
							</div>
							<!-- Subtle overlay on hover -->
							<div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
						</div>

						<!-- Content -->
						<div class="p-5 lg:p-4 space-y-3 lg:space-y-2">

							<!-- Name -->
							<div class="text-center">
								<h3 class="text-lg lg:text-base font-semibold text-gray-900 group-hover:text-blue-900 transition-colors duration-300 leading-tight">
									{{$item->name}}
								</h3>
							</div>

							<!-- Designation -->
							<div class="text-center">
								<p class="text-sm lg:text-xs font-medium text-gray-600 uppercase tracking-wide leading-tight">
									{{$item->designation}}
								</p>
							</div>

							<!-- Bio (if short) -->
							@if($item->bio_graphy && strlen($item->bio_graphy) < 100)
							<div class="text-center">
								<p class="text-xs lg:text-[0.65rem] text-gray-500 leading-relaxed line-clamp-2 group-hover:text-gray-700 transition-colors duration-300">
									{{$item->bio_graphy}}
								</p>
							</div>
							@endif

							<!-- Social Links -->
							<div class="flex justify-center items-center space-x-3 lg:space-x-2 pt-3 lg:pt-2 border-t border-gray-50">
								@if($item->mobile)
								<a
									href="tel:{{$item->mobile}}"
									class="w-9 h-9 lg:w-7 lg:h-7 bg-gray-50 hover:bg-blue-50 rounded-full flex items-center justify-center text-gray-600 hover:text-blue-600 transition-all duration-300 transform hover:scale-110 group/link"
									title="Call {{$item->name}}"
								>
									<svg class="w-4 h-4 lg:w-3 lg:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
									</svg>
								</a>
								@endif

								@if($item->email)
								<a
									href="mailto:{{$item->email}}"
									class="w-9 h-9 lg:w-7 lg:h-7 bg-gray-50 hover:bg-blue-50 rounded-full flex items-center justify-center text-gray-600 hover:text-blue-600 transition-all duration-300 transform hover:scale-110 group/link"
									title="Email {{$item->name}}"
								>
									<svg class="w-4 h-4 lg:w-3 lg:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
									</svg>
								</a>
								@endif
							</div>
						</div>

						<!-- Animated bottom border -->
						<div class="h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
					</div>
				</div>
			@endforeach
		</div>
	</div>	

	<!-- End Video Section -->

	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')

<style>
/* Minimalist card animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Compact staggered entrance animation */
.group:nth-child(1) { animation: fadeInUp 0.4s ease-out 0.05s both; }
.group:nth-child(2) { animation: fadeInUp 0.4s ease-out 0.1s both; }
.group:nth-child(3) { animation: fadeInUp 0.4s ease-out 0.15s both; }
.group:nth-child(4) { animation: fadeInUp 0.4s ease-out 0.2s both; }
.group:nth-child(5) { animation: fadeInUp 0.4s ease-out 0.25s both; }
.group:nth-child(6) { animation: fadeInUp 0.4s ease-out 0.3s both; }
.group:nth-child(7) { animation: fadeInUp 0.4s ease-out 0.35s both; }
.group:nth-child(8) { animation: fadeInUp 0.4s ease-out 0.4s both; }

/* Subtle hover glow effect */
.group:hover .bg-white {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 0 20px rgba(59, 130, 246, 0.1);
}

/* Smooth image transitions */
.group img {
    filter: grayscale(0) contrast(1);
    transition: all 0.5s ease;
}

.group:hover img {
    filter: grayscale(0) contrast(1.05) saturate(1.1);
}

/* Icon hover effects */
.group/link:hover {
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Text truncation for bio */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-3.xl\\:grid-cols-4 {
        gap: 1.5rem;
    }

    .group:hover {
        transform: none; /* Disable lift on mobile for better UX */
    }
}

/* Focus states for accessibility */
.group:focus-within {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
    border-radius: 1rem;
}

/* Loading state (if needed) */
@keyframes shimmer {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}

.loading-shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200px 100%;
    animation: shimmer 1.5s infinite;
}
</style>
