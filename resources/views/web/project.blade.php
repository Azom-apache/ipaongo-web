
    @include('layouts.web.header')

	@php
		$accentSchemes = config('tailwind_theme.accent_schemes');
		$accentIndex = $page->id ?? 0;
		$c = $accentSchemes[$accentIndex % count($accentSchemes)];
	@endphp

	<section class="project-cat-section my-8 sm:my-12 lg:my-8">
		<div class="w-full lg:max-w-7xl mx-auto px-3 sm:px-4 lg:px-4">
			<div class="flex flex-wrap">
				<div class="@if($page->sideber_visible=='yes') w-full lg:w-2/3 min-w-0 px-0 sm:px-1 lg:pr-4 @else w-full min-w-0 px-0 sm:px-1 @endif">
					<div class="image wow fadeIn mb-6 sm:mb-8 lg:mb-6">
						@if(isset($page->image))
							<img class="project-view-image w-full h-64 sm:h-80 md:h-[26rem] lg:h-80 object-cover rounded-xl shadow-lg" src="{{ asset('uploads/project/'.$page->image) }}" alt="{{ $page->title }}" loading="lazy" />
						@endif
					</div>
					<div class="text-center mb-6 sm:mb-7 lg:mb-5">
						<h1 class="project_title text-7xl sm:text-6xl lg:text-3xl font-extrabold text-blue-600 leading-[1.08] tracking-tight px-1">{{ $page->title }}</h1>
					</div>
					<div class="w-full description-parent text-justify text-gray-700 text-5xl sm:text-4xl lg:text-base leading-relaxed [&_p]:mb-6 [&_p:last-child]:mb-0 [&_p]:text-5xl sm:[&_p]:text-4xl lg:[&_p]:text-base [&_p]:leading-relaxed [&_p]:text-gray-700 [&_li]:text-5xl sm:[&_li]:text-4xl lg:[&_li]:text-base [&_h2]:text-6xl sm:[&_h2]:text-5xl lg:[&_h2]:text-xl [&_h2]:font-bold [&_h2]:mt-8 lg:[&_h2]:mt-5 [&_h2]:mb-4 lg:[&_h2]:mb-3 [&_h3]:text-5xl sm:[&_h3]:text-4xl lg:[&_h3]:text-lg [&_h3]:font-bold [&_a]:text-blue-600 [&_a]:underline">
						<div class="mb-8 sm:mb-6 lg:mb-4">{!! $page->description !!}</div>
						<a class="donate inline-block text-center text-2xl sm:text-3xl lg:text-sm font-bold bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 lg:px-5 lg:py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 mt-4" href="{{route('donate.show')}}?id={{$page->id}}" style="color: white;">DONATE NOW</a>
					</div>
				</div>
				
			@if($page->sideber_visible=='yes')
				<div class="w-full lg:w-1/3 mt-10 lg:mt-0 lg:pl-4 min-w-0">
					@php
						$sub_project = \App\Project::where('parent', $page->id)->where('menu', 1)->get();
						$similar_project = \App\Project::where('parent', $page->parent)->where('id', '!=', $page->id)->where('menu', 1)->get();
						$sidebar_projects = $sub_project->isNotEmpty() ? $sub_project : $similar_project;
					@endphp

					<div class="mb-5 lg:mb-4">
						<div class="w-full sidebar-section border-b border-gray-200 pb-3 lg:pb-2">
							<h2 class="text-center text-4xl sm:text-5xl lg:text-xl font-bold text-gray-900 leading-tight">Projects</h2>
						</div>
					</div>

					@if($sidebar_projects->isNotEmpty())
						@foreach($sidebar_projects as $item)
						@php
							$itemAccent = $accentSchemes[$loop->index % count($accentSchemes)];
						@endphp
						<div class="group bg-white {{ $itemAccent['sidebar_row'] }} rounded-xl shadow-md mb-5 lg:mb-2 overflow-hidden border-2 transition-all duration-200">
							<div class="flex flex-col sm:flex-row sm:items-stretch sm:min-h-[8.5rem] sm:h-36 lg:h-20">
								<div class="w-full sm:w-[35%] shrink-0 p-3 lg:p-1.5">
									<img src="{{ asset('uploads/project/'.$item->image) }}" class="w-full h-44 sm:h-full sm:min-h-[6.5rem] lg:min-h-[2.75rem] object-cover rounded-lg lg:rounded-md" alt="{{ $item->title }}" loading="lazy">
								</div>
								<div class="w-full sm:w-[65%] min-w-0 p-4 pt-2 sm:pt-4 sm:p-5 lg:p-2 lg:py-2.5">
									<a class="{{ $itemAccent['sidebar_link'] }} font-semibold text-2xl sm:text-3xl lg:text-lg leading-snug line-clamp-4 sm:line-clamp-3 lg:line-clamp-2 hover:underline transition-colors duration-200" href="{{ route('project', [$item->id, $item->slug]) }}">{{ $item->title }}</a>
								</div>
							</div>
						</div>
						@endforeach
					@else
						<p class="text-center text-gray-500 text-2xl sm:text-3xl lg:text-sm font-medium leading-snug py-10 lg:py-6 px-2">No Similar Project Available</p>
					@endif
				</div>
			@endif

			</div>
		</div>
	</section>

@include('layouts.web.footer')
