@include('layouts.web.header')

<section class="py-12 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="!text-5xl lg:!text-3xl !font-bold text-gray-900 mb-3 leading-tight">Background of the Organization</h1>
            <p class="!text-2xl lg:!text-base text-gray-600 max-w-2xl mx-auto leading-snug">Understanding IPAO's mission, values, and impact since 1996</p>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shrink-0">
                            <i class="fas fa-building text-blue-600 !text-3xl lg:!text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h2 class="!text-4xl lg:!text-2xl !font-bold text-gray-900 mb-3 leading-tight">Who We Are</h2>
                        <p class="!text-2xl lg:!text-base text-gray-700 leading-relaxed">
                            <strong class="text-blue-600">IPAO</strong> is a registered, non-profit development organization based in Bangladesh, dedicated to restoring dignity and improving the quality of life for underserved communities. Since <strong class="text-blue-600">1996</strong>, we've been a driving force behind impactful, people-centered solutions that address the root causes of poverty, with a strong commitment to environmental sustainability and community resilience.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="!text-4xl lg:!text-2xl !font-bold text-gray-900 mb-2 text-center leading-tight">What We Stand For</h2>
                <p class="!text-2xl lg:!text-base text-gray-600 text-center mb-6 leading-snug">At the heart of IPAO's mission are three flagship pillars</p>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-5 border border-blue-200">
                        <div class="flex items-center mb-3 gap-3">
                            <div class="w-12 h-12 lg:w-10 lg:h-10 bg-blue-500 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-tint text-white text-2xl lg:text-base"></i>
                            </div>
                            <h3 class="!text-3xl lg:!text-lg !font-bold text-blue-800 leading-tight min-w-0">WASH</h3>
                        </div>
                        <p class="!text-xl lg:!text-sm text-gray-700 mb-3">Water, Sanitation & Hygiene</p>
                        <ul class="!text-lg lg:!text-xs text-gray-600 space-y-2 leading-snug">
                            <li>• Deep tube wells & solar pumps</li>
                            <li>• Disabled-friendly sanitation</li>
                            <li>• Hygiene education programs</li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-5 border border-green-200">
                        <div class="flex items-center mb-3 gap-3">
                            <div class="w-12 h-12 lg:w-10 lg:h-10 bg-green-500 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-utensils text-white text-2xl lg:text-base"></i>
                            </div>
                            <h3 class="!text-3xl lg:!text-lg !font-bold text-green-800 leading-tight min-w-0">Food Security</h3>
                        </div>
                        <p class="!text-xl lg:!text-sm text-gray-700 mb-3">Nutritional Support & Aid</p>
                        <ul class="!text-lg lg:!text-xs text-gray-600 space-y-2 leading-snug">
                            <li>• Emergency food distribution</li>
                            <li>• Nutrition for vulnerable groups</li>
                            <li>• Long-term food planning</li>
                        </ul>
                    </div>

                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-5 border border-orange-200">
                        <div class="flex items-center mb-3 gap-3">
                            <div class="w-12 h-12 lg:w-10 lg:h-10 bg-orange-500 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fas fa-seedling text-white text-2xl lg:text-base"></i>
                            </div>
                            <h3 class="!text-3xl lg:!text-lg !font-bold text-orange-800 leading-tight min-w-0">Smart Agriculture</h3>
                        </div>
                        <p class="!text-xl lg:!text-sm text-gray-700 mb-3">Sustainable Livelihoods</p>
                        <ul class="!text-lg lg:!text-xs text-gray-600 space-y-2 leading-snug">
                            <li>• Organic farming techniques</li>
                            <li>• Solar-powered irrigation</li>
                            <li>• Climate-resilient seeds</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="!text-4xl lg:!text-2xl !font-bold text-gray-900 mb-2 text-center leading-tight">Our Broader Impact</h2>
                <p class="!text-xl lg:!text-sm text-gray-600 text-center mb-4 leading-snug">Beyond our core pillars, we address community needs in:</p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors">
                        <i class="fas fa-graduation-cap text-blue-500 !text-3xl lg:!text-lg mb-2"></i>
                        <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 mb-1 leading-tight">Education</h4>
                        <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Literacy & skills</p>
                    </div>

                    <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                        <i class="fas fa-wheelchair text-green-500 !text-3xl lg:!text-lg mb-2"></i>
                        <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 mb-1 leading-tight">Disability</h4>
                        <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Inclusion & support</p>
                    </div>

                    <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-purple-50 transition-colors">
                        <i class="fas fa-venus text-purple-500 !text-3xl lg:!text-lg mb-2"></i>
                        <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 mb-1 leading-tight">Women</h4>
                        <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Empowerment</p>
                    </div>

                    <div class="text-center p-3 bg-gray-50 rounded-lg hover:bg-yellow-50 transition-colors">
                        <i class="fas fa-solar-panel text-yellow-500 !text-3xl lg:!text-lg mb-2"></i>
                        <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 mb-1 leading-tight">Renewable</h4>
                        <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Solar energy</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="!text-4xl lg:!text-2xl !font-bold text-gray-900 mb-2 text-center leading-tight">Our Values</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg min-w-0">
                        <div class="w-12 h-12 lg:w-10 lg:h-10 bg-blue-500 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-balance-scale text-white text-lg lg:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 leading-tight">Equity</h4>
                            <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Fairness for all</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg min-w-0">
                        <div class="w-12 h-12 lg:w-10 lg:h-10 bg-green-500 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-leaf text-white text-lg lg:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 leading-tight">Sustainability</h4>
                            <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Eco-friendly solutions</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-red-50 rounded-lg min-w-0">
                        <div class="w-12 h-12 lg:w-10 lg:h-10 bg-red-500 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-heart text-white text-lg lg:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 leading-tight">Compassion</h4>
                            <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Empathy in action</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-lg min-w-0">
                        <div class="w-12 h-12 lg:w-10 lg:h-10 bg-purple-500 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-shield-alt text-white text-lg lg:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 leading-tight">Integrity</h4>
                            <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Ethical stewardship</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-orange-50 rounded-lg min-w-0">
                        <div class="w-12 h-12 lg:w-10 lg:h-10 bg-orange-500 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-lightbulb text-white text-lg lg:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 leading-tight">Innovation</h4>
                            <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Smart solutions</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-indigo-50 rounded-lg min-w-0">
                        <div class="w-12 h-12 lg:w-10 lg:h-10 bg-indigo-500 rounded-full flex items-center justify-center shrink-0">
                            <i class="fas fa-users text-white text-lg lg:text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <h4 class="!text-xl lg:!text-sm !font-semibold text-gray-800 leading-tight">Community</h4>
                            <p class="!text-lg lg:!text-xs text-gray-600 leading-snug">Together we thrive</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-600 to-purple-700 rounded-xl p-6 text-white text-center">
                <div class="max-w-3xl mx-auto">
                    <h3 class="!text-4xl lg:!text-2xl !font-bold mb-3 leading-tight">IPAO isn't just a name—it's a movement.</h3>
                    <p class="text-blue-100 mb-4 !text-xl lg:!text-base leading-relaxed">
                        A movement that believes the seeds of change lie within the people.
                    </p>
                    <p class="!text-2xl lg:!text-xl !font-semibold leading-snug">
                        Together, we're turning scarcity into sustainability, and crisis into opportunity—one village, one family, one future at a time.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.web.footer')
