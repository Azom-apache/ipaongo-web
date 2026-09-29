
    @include('layouts.web.header')
    <!--End Main Header -->

    <style>
        @keyframes zoomInFade {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .animate-zoom-in-fade {
            animation: zoomInFade 0.6s ease-out forwards;
            opacity: 0;
        }

        /* Gallery specific hover effects */
        .gallery-card:hover .p-4 {
            background: linear-gradient(135deg, rgba(139, 69, 246, 0.03) 0%, rgba(59, 130, 246, 0.03) 100%);
        }
    </style>

<div class="w-full lg:max-w-7xl mx-auto px-4 mb-4">
    <div class="w-full my-8">
        <h3 style="margin:10px 0;" class="news-header text-center text-gray-900 uppercase !text-5xl lg:!text-4xl font-bold tracking-wide relative py-6 lg:py-3">Gallery</h3>
        <div class="flex items-center justify-center space-x-2">
            <div class="w-8 h-0.5 bg-blue-500 rounded"></div>
            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
            <div class="w-8 h-0.5 bg-pink-500 rounded"></div>
        </div>
    </div>
    <div class="flex flex-wrap">
        @foreach($gallery AS $item)
        <div class='w-1/2 sm:w-1/3 lg:w-1/3 lg:w-1/4 px-2 mb-4 animate-zoom-in-fade' style="animation-delay: {{ $loop->index * 0.1 }}s">
            <div class="gallery-card bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-2xl hover:border-purple-200 hover:-translate-y-2 transition-all duration-500 overflow-hidden group cursor-pointer h-full">
                <a href="{{ route('project.gellery',[$item->id,$item->slug]) }}" class="block">
                    @if(!file_exists(asset('uploads/project/'.$item->image)))
                    <div class="overflow-hidden relative">
                        {{-- <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 via-indigo-500/15 to-blue-500/10 opacity-0 group-hover:opacity-100 transition-all duration-600 z-10"></div> --}}
                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-400 z-20 transform scale-75 group-hover:scale-100">
                            <div class="bg-white/95 backdrop-blur-sm rounded-full p-2.5 shadow-xl border border-white/20">
                                <svg class="w-5 h-5 text-purple-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="absolute bottom-3 left-3 opacity-0 group-hover:opacity-100 transition-all duration-400 z-20 transform -translate-x-2 group-hover:translate-x-0">
                            <div class="bg-black/70 backdrop-blur-sm text-white px-3 py-1.5 rounded-full !text-lg lg:!text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                View Album
                            </div>
                        </div>
                        <img class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-700 ease-out" alt="img" src="{{asset('uploads/project/'.$item->image)}}" />
                    </div>
                    @endif
                    <div class='p-4 text-left'>
                        <h4 class='text-gray-700 font-bold !text-2xl lg:!text-lg mb-2 group-hover:text-purple-700 transition-colors duration-300 leading-tight transform group-hover:translate-x-1'>{{ $item->title }}</h4>
                        <div class="flex items-center justify-between">
                            <div class="!text-base lg:!text-sm text-purple-600 font-semibold bg-purple-50 px-3 py-1 rounded-full border border-purple-200 transform group-hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Gallery
                            </div>
                            <div class="text-xs text-gray-400 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                                Click to view →
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        <div class="w-full mt-8 flex justify-center">{{$gallery->links()}}</div>
    </div>
</div>
	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')

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
