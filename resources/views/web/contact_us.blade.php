@extends('layouts.web.master')

@section('content')
@push('head')
<title>{{ env("APP_NAME") }} | Contact Us</title>
<meta name="description" content="">
@endpush
<section class="py-8 bg-gray-100">
    <nav aria-label="breadcrumb" class="w-full lg:max-w-7xl mx-auto px-4">
      <ol class="flex items-center space-x-2 !text-xl lg:!text-sm text-gray-600">
        <li><a href="#" class="hover:text-blue-600 transition-colors">Home</a></li>
        <li class="flex items-center">
            <svg class="w-5 h-5 lg:w-4 lg:h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-900 font-medium">Contact Us</span>
        </li>
      </ol>
    </nav>
</section>
<div class="w-full lg:max-w-7xl mx-auto px-4 py-8 font-sans">
    @include('layouts.admin.errors')
    <div class="flex flex-wrap -mx-4 mb-8">
        <div class="w-full lg:w-1/2 px-4">
            <div class="bg-white shadow-md">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h3 class="!text-3xl lg:!text-xl font-semibold">Contact Us</h3>
                </div>
                <div class="p-6">
                    @php
                        $setting = \App\Helpers\Website::setting();
                    @endphp
                    <div class="space-y-4">
                        <div>
                            <h6 class="!text-2xl lg:!text-lg font-bold text-gray-800">Bangladesh Apparel General Manager Association</h6>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-700 !text-lg lg:!text-base">@if($setting) {{ $setting->address_1 }} @endif</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-700 !text-lg lg:!text-base">Mobile: @if($setting) {{ $setting->mobile }} @if($setting->mobile_2) | {{ $setting->mobile_2 }} @endif @endif</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-700 !text-lg lg:!text-base">Email: @if($setting) {{ $setting->email }} @if($setting->email_2) | {{ $setting->email_2 }} @endif @endif</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-orange-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-1.657 0-3-4.03-3-9s1.343-9 3-9m0 9c1.657 0 3 4.03 3 9s-1.343 9-3 9"></path>
                            </svg>
                            <span class="text-gray-700 !text-lg lg:!text-base">Website: @if($setting) {{ $setting->domain_name }} @endif</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 px-4">
            <div class="bg-white shadow-md">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h3 class="!text-3xl lg:!text-xl font-semibold">Quick Contact</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('contactMail') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block !text-lg lg:!text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" required="" placeholder="Please Enter your name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent !text-lg lg:!text-base">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block !text-lg lg:!text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" required="" placeholder="Please Enter your email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent !text-lg lg:!text-base">
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="block !text-lg lg:!text-sm font-medium text-gray-700 mb-2">Subject *</label>
                            <input type="text" required="" placeholder="Subject" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent !text-lg lg:!text-base">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block !text-lg lg:!text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea name="message" rows="4" required placeholder="Message" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition-colors duration-200 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                <span>Send</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-8 mt-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($setting)
                <iframe src="{{ $setting->map }}" height="400" class="w-full border-0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            @endif
        </div>
    </div>
</div>
@endsection

    @include('layouts.web.header')
    <!--End Main Header -->

   	<!--Contact Info Section-->
    <section class="py-12 bg-gray-50">
    	<div class="max-w-7xl mx-auto px-2">
        	<div class="grid grid-cols-1 lg:grid-cols-3 gap-3">

            	<!--Info Block-->
					@php
						$setting = \App\Helpers\Website::setting();
					@endphp
                	<div class="text-center bg-white rounded-lg shadow-md border p-4 hover:shadow-md transition-shadow duration-200">
                    	<div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        	<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="!text-2xl lg:!text-sm text-gray-700 font-medium">@if($setting) {{ $setting->address_1 }} @endif</div>
                    </div>

                <!--Info Block-->
                	<div class="text-center bg-white rounded-lg shadow-md border p-4 hover:shadow-md transition-shadow duration-200">
                    	<div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        	<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="!text-2xl lg:!text-sm text-gray-700 font-medium">@if($setting) {{ $setting->mobile }} @endif</div>
                    </div>

                <!--Info Block-->
                	<div class="text-center bg-white rounded-lg shadow-md border p-4 hover:shadow-md transition-shadow duration-200">
                    	<div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-3">
                        	<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="!text-2xl lg:!text-sm text-gray-700 font-medium">@if($setting) {{ $setting->email }} @if($setting->email_2) <br>{{ $setting->email_2 }} @endif @endif</div>
                    </div>

            </div>
        </div>
    </section>
    <!--End Contact Info Section-->

    <!-- Contact Info Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!--Form Column-->
                <div>
                    <div>
                        <h2 class="!text-5xl lg:!text-3xl font-bold text-gray-800 mb-8 leading-tight">Quick Contact</h2>

                        <!-- Contact Form -->
                        <div>
                        <form method="post" action="{{ route('contactMail') }}" id="contact-form">
                            @csrf
                            <div class="space-y-6">

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent !text-2xl lg:!text-base" name="name" placeholder="Your Full Name" required>
                                    </div>

                                    <div>
                                        <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent !text-2xl lg:!text-base" id="email" name="email" placeholder="Email Address" required>
                                    </div>
                                </div>

                                <div>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent !text-2xl lg:!text-base" name="subject" placeholder="Subject" required>
                                </div>

                                <div>
                                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-vertical !text-2xl lg:!text-base" id="message" name="message" rows="5" placeholder="Your Message"></textarea>
                                </div>

                                <div>
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-4 lg:py-3 px-8 lg:px-6 rounded-lg transition-colors duration-200 !text-2xl lg:!text-base">SEND DATA</button>
                                </div>

                            </div>
                        </form>

                        </div>
                        <!--End Contact Form -->

                    </div>
                </div>

                <!--Map-->
                <div>
                    <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d456.0901944176876!2d90.39890220122487!3d23.864019332568063!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c42402a44b91%3A0x399bbfb10caa2b9c!2s11%20Road-2%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1623594865575!5m2!1sen!2sbd" width="100%" height="400" class="border-0 w-full" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Contact Info Section -->

    

    	
	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
