<script src="{{ asset('js/tailwindCss3.4.17') }}"></script>
	<script defer src="{{ asset('js/cdn.alpine.js') }}"></script>

<style>
@keyframes zoomIn {
  from {
    transform: scale(1);
  }
  to {
    transform: scale(1.2);
  }
}

.slider-zoom {
  /* Base class for zoom animation */
}

/* Typing Animation Styles */
@keyframes blink-caret {
  from, to { border-color: transparent; }
  50% { border-color: white; }
}

.typing {
  border-right: 2px solid white;
  animation: blink-caret 0.75s step-end infinite;
}

.typing::after {
  content: '';
}
</style>

@php
    $slider = \App\Slider::orderby('id', 'DESC')->limit(5)->get();
    $slideCount = $slider->count();
@endphp

<script>
function sliderData() {
    return {
        activeSlide: 1,
        slideCount: {{ $slideCount }},
        typedText: '',
        typingIndex: 0,
        currentTitle: '{{ $slider->first()->title ?? "Welcome to IPAO" }}',
        typingSpeed: 100, // milliseconds per character
        typingTimeout: null,

        init() {
            this.startTyping();
            // Auto slide change
            setInterval(() => {
                this.activeSlide = this.activeSlide < this.slideCount ? this.activeSlide + 1 : 1;
                this.resetTyping();
            }, 5000);
        },

        resetTyping() {
            clearTimeout(this.typingTimeout);
            this.typedText = '';
            this.typingIndex = 0;
            // Get current slide title
            @foreach($slider as $index => $item)
                if (this.activeSlide === {{ $index + 1 }}) {
                    this.currentTitle = '{{ $item->title ?? "Welcome to IPAO" }}';
                }
            @endforeach
            this.startTyping();
        },

        startTyping() {
            if (this.typingIndex < this.currentTitle.length) {
                this.typedText += this.currentTitle.charAt(this.typingIndex);
                this.typingIndex++;
                this.typingTimeout = setTimeout(() => this.startTyping(), this.typingSpeed);
            }
        }
    }
}
</script>

<div class="">
  <div class="container mx-auto px-4 my-2">
    <div x-data="sliderData()" class="overflow-hidden relative rounded-lg">
      
      <!-- Slider -->
      <div class="whitespace-nowrap transition-transform duration-500 ease-in-out"
           :style="'transform: translateX(-' + (activeSlide - 1) * 100 + '%)'"
           x-init="setInterval(() => { activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1 }, 5000)">
           
        @foreach($slider as $item)
          <div class="inline-block w-full relative">
            <img src="{{ asset('uploads/sliders/'.$item->image) }}" alt="{{ $item->title }}" class="w-screen h-[20vh] lg:h-[80vh] object-cover slider-zoom" x-bind:style="activeSlide === {{ $loop->index + 1 }} ? 'animation: zoomIn 5s ease-in-out; animation-fill-mode: forwards' : 'animation: none'" />
            <!-- Slide Title Overlay -->
            <div class="absolute bottom-0 h-full w-full left-0 right-0 p-6 lg:p-8 flex justify-center items-end">
              <div class="max-w-4xl">
                <h2 class="text-2xl lg:text-4xl font-bold text-white mb-2 drop-shadow-lg"
                    x-show="activeSlide === {{ $loop->index + 1 }}"
                    x-text="typedText"
                    :class="{ 'typing': typingIndex < currentTitle.length }"
                    x-transition>
                </h2>
                @if(isset($item->description) && $item->description)
                <p class="text-lg lg:text-xl text-gray-200 drop-shadow-md max-w-2xl">
                  {{ Str::limit($item->description, 120) }}
                </p>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Prev/Next Arrows -->
      <div class="absolute inset-0 flex items-center justify-between px-4">
        <!-- Previous Button -->
        <button
            @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : slideCount; resetTyping();"
            class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center bg-black/40 hover:bg-black/60 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50"
            aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 lg:h-7 lg:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        
        <!-- Next Button -->
        <button
            @click="activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1; resetTyping();"
            class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center bg-black/40 hover:bg-black/60 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50"
            aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 lg:h-7 lg:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
      </div>

      <!-- Dots Navigation -->
      <div class="absolute bottom-0 left-0 right-0 flex justify-center space-x-2 p-4">
        <template x-for="slideIndex in slideCount" :key="slideIndex">
          <button @click="activeSlide = slideIndex; resetTyping();"
                  class="h-2 w-2 rounded-full"
                  :class="{'bg-orange-500': activeSlide === slideIndex, 'bg-white/50': activeSlide !== slideIndex}">
          </button>
        </template>
      </div>
      <a href="{{ route('donate.show') }}" class="absolute bottom-5 right-5 px-6 py-1.5 rounded bg-green-600 text-white hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg">Donate Now</a>
    </div>
  </div>
</div>
