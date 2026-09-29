
    @include('layouts.web.header')
    <!--End Main Header -->


	<div class="w-full lg:max-w-7xl mx-auto px-4">
		<h2 class="text-center text-2xl font-bold text-gray-900 uppercase" style="margin: 20px;">{{__('Blood Doner List')}}</h2>
		<div class="flex flex-wrap mb-8">
            <div class="w-full max-w-2xl mx-auto">
                <form action="?" method="get" class="bg-gray-50 p-6 rounded-lg shadow-md border">
                    <div class="flex flex-wrap items-end gap-4">
						<div class="flex-1 min-w-0">
							<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Search Blood Donors</label>
							<div class="relative">
								<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
									<i class="fa fa-search text-gray-400" aria-hidden="true"></i>
								</div>
								<input value="{{old('name')}}" type="text" name="name" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500" id="name" placeholder="Mobile, Name, Blood Group, Area" required="required">
							</div>
						</div>
						<div class="w-32">
							<button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
								SEARCH
							</button>
						</div>
                    </div>
		        </form>
            </div>
            <div class="w-full mt-8">
                <hr class="border-gray-300">
            </div>
			@foreach($bloods AS $item)
			<div class="w-full sm:w-1/2 lg:w-1/3 lg:w-1/4 px-1.5 mb-6">
				<div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group flex flex-col border border-red-100 h-full">
					<div class="p-4 flex-shrink-0">
						<div class="w-full h-48 lg:h-80 mb-4 overflow-hidden rounded-lg bg-red-50 flex items-center justify-center">
							@if($item->image != null)
							<img src="{{asset('/uploads/project/'.$item->image)}}" class="w-full h-full group-hover:scale-105 transition-transform duration-300" />
							@else
							<div class="text-red-300">
								<i class="fas fa-user-circle text-6xl"></i>
							</div>
							@endif
						</div>
					</div>
					<div class="px-4 pb-4 flex-1 flex flex-col justify-center">
						<div class="text-center">
							<h3 class="text-lg font-semibold text-gray-900 mb-2 uppercase">{{$item->name}}</h3>
							<div class="space-y-1 text-sm">
								<p class="text-blue-600 font-medium">{{__('Mobile :')}} {{$item->mobile}}</p>
								<p class="text-red-700 font-bold text-base">{{__('Blood Group :')}} {{$item->blood_group}}</p>
								<p class="text-gray-700">{{__('Area :')}} {{$item->division}}, {{$item->district}}, {{$item->upazila}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<!-- End Video Section -->

	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
