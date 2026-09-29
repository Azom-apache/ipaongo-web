@include('layouts.web.header')

<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="!text-5xl lg:!text-3xl !font-bold text-gray-900 mb-2 leading-tight">Vision & Mission</h1>
            <p class="!text-2xl lg:!text-base text-gray-600 leading-snug">Our guiding principles</p>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-4 gap-3">
                    <div class="w-12 h-12 lg:w-10 lg:h-10 bg-blue-500 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 lg:w-5 lg:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h2 class="!text-4xl lg:!text-xl !font-bold text-blue-600 leading-tight min-w-0">Our Mission</h2>
                </div>
                <p class="!text-2xl lg:!text-base text-gray-700 leading-relaxed">
                    "To alleviate human suffering, encourage people to reach their destiny, support for well being, try to change their lives and serves all people regardless of race, religion and gender."
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-4 gap-3">
                    <div class="w-12 h-12 lg:w-10 lg:h-10 bg-purple-500 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 lg:w-5 lg:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM20 10a1 1 0 01-1 1h-1a1 1 0 100-2h1a1 1 0 011 1z"></path>
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 7a1 1 0 011-1 1 1 0 012 0v2h.5a1 1 0 01.707 1.707l-1 1A1 1 0 0110.5 12H9a1 1 0 010-2h.5V9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h2 class="!text-4xl lg:!text-xl !font-bold text-purple-600 leading-tight min-w-0">Our Vision</h2>
                </div>
                <p class="!text-2xl lg:!text-base text-gray-700 leading-relaxed">
                    "Offering a helping hand to people in need"
                </p>
            </div>
        </div>
    </div>
</section>

@include('layouts.web.footer')
