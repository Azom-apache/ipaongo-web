@include('layouts.web.header')

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="!text-5xl lg:!text-3xl !font-bold text-gray-900 mb-2 leading-tight">Goals & Objectives</h1>
            <p class="!text-2xl lg:!text-base text-gray-600 leading-snug">Our commitment to sustainable development</p>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-4 gap-3">
                    <div class="w-12 h-12 lg:w-10 lg:h-10 bg-green-500 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 lg:w-5 lg:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h2 class="!text-4xl lg:!text-xl !font-bold text-green-600 leading-tight min-w-0">Our Goals</h2>
                </div>

                <div class="text-gray-700 leading-relaxed mb-4">
                    <p class="mb-4 !text-2xl lg:!text-base">
                        At IPAO, our overarching goal is to alleviate poverty and empower communities through sustainable, inclusive, and locally driven solutions. We strive to ensure every person—regardless of their background—has access to clean water, nutritious food, and sustainable livelihoods rooted in climate resilience and human dignity.
                    </p>
                    <p class="!text-2xl lg:!text-sm !font-medium text-gray-800 mb-4">Specifically, we aim to —</p>
                </div>

                <ul class="space-y-3 !text-xl lg:!text-sm text-gray-700 leading-snug">
                    <li class="flex items-start gap-2">
                        <span class="inline-block w-2 h-2 lg:w-1.5 lg:h-1.5 bg-green-500 rounded-full mt-2 lg:mt-1.5 shrink-0"></span>
                        <span>Strengthen access to essential services such as water, sanitation, hygiene, and food for vulnerable populations.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="inline-block w-2 h-2 lg:w-1.5 lg:h-1.5 bg-green-500 rounded-full mt-2 lg:mt-1.5 shrink-0"></span>
                        <span>Promote smart, climate-resilient agriculture to boost food production, income, and environmental sustainability.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="inline-block w-2 h-2 lg:w-1.5 lg:h-1.5 bg-green-500 rounded-full mt-2 lg:mt-1.5 shrink-0"></span>
                        <span>Empower communities through knowledge, training, and innovation, enabling them to become self-reliant and future-ready.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="inline-block w-2 h-2 lg:w-1.5 lg:h-1.5 bg-green-500 rounded-full mt-2 lg:mt-1.5 shrink-0"></span>
                        <span>Enhance dignity and inclusion, especially for women, children, the elderly, and people with disabilities.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="inline-block w-2 h-2 lg:w-1.5 lg:h-1.5 bg-green-500 rounded-full mt-2 lg:mt-1.5 shrink-0"></span>
                        <span>Build community resilience to climate change and natural disasters through localized, adaptive development practices.</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center mb-6 gap-3">
                    <div class="w-12 h-12 lg:w-10 lg:h-10 bg-blue-500 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 lg:w-5 lg:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="!text-4xl lg:!text-xl !font-bold text-blue-600 leading-tight min-w-0">Our Objectives</h2>
                </div>

                <div class="mb-6">
                    <h3 class="!text-2xl lg:!text-base !font-semibold text-blue-700 mb-3 flex items-center gap-2 leading-tight">
                        <span class="w-2.5 h-2.5 lg:w-2 lg:h-2 bg-blue-500 rounded-full shrink-0"></span>
                        WASH (Water, Sanitation, and Hygiene)
                    </h3>
                    <ul class="space-y-2 !text-lg lg:!text-sm text-gray-700 ml-1 lg:ml-4 leading-snug">
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Provide access to safe and sustainable water sources through tube wells, rainwater harvesting, and solar water pumps.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Construct and rehabilitate sanitation facilities, particularly for women, children, and people with disabilities.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-blue-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Promote hygiene education and behavior change to reduce waterborne diseases and improve public health.</span>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h3 class="!text-2xl lg:!text-base !font-semibold text-orange-700 mb-3 flex items-center gap-2 leading-tight">
                        <span class="w-2.5 h-2.5 lg:w-2 lg:h-2 bg-orange-500 rounded-full shrink-0"></span>
                        Food Aid & Nutrition
                    </h3>
                    <ul class="space-y-2 !text-lg lg:!text-sm text-gray-700 ml-1 lg:ml-4 leading-snug">
                        <li class="flex items-start gap-2">
                            <span class="text-orange-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Distribute emergency food and nutrition support during crises such as floods, droughts, and pandemics.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-orange-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Develop sustainable food systems to reduce hunger and malnutrition in rural and underserved communities.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-orange-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Support local food production through seed distribution, backyard gardening, and nutrition education.</span>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h3 class="!text-2xl lg:!text-base !font-semibold text-green-700 mb-3 flex items-center gap-2 leading-tight">
                        <span class="w-2.5 h-2.5 lg:w-2 lg:h-2 bg-green-500 rounded-full shrink-0"></span>
                        Smart Agriculture & Livelihoods
                    </h3>
                    <ul class="space-y-2 !text-lg lg:!text-sm text-gray-700 ml-1 lg:ml-4 leading-snug">
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Promote sustainable farming techniques, including tricho-compost, hydroponics, organic pest control, and smart irrigation.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Facilitate training, inputs, and tools for smallholder farmers to increase productivity and income.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Build market linkages and value chains for rural entrepreneurs and agricultural producers.</span>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h3 class="!text-2xl lg:!text-base !font-semibold text-purple-700 mb-3 flex items-center gap-2 leading-tight">
                        <span class="w-2.5 h-2.5 lg:w-2 lg:h-2 bg-purple-500 rounded-full shrink-0"></span>
                        Disability Inclusion and Community Well-being
                    </h3>
                    <ul class="space-y-2 !text-lg lg:!text-sm text-gray-700 ml-1 lg:ml-4 leading-snug">
                        <li class="flex items-start gap-2">
                            <span class="text-purple-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Ensure inclusive infrastructure such as accessible toilets, ramps, and mobility support for persons with disabilities.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-purple-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Document and respond to individual cases of vulnerability with compassion and practical solutions.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-purple-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Foster mental and physical well-being through dignity-driven services and social support.</span>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h3 class="!text-2xl lg:!text-base !font-semibold text-indigo-700 mb-3 flex items-center gap-2 leading-tight">
                        <span class="w-2.5 h-2.5 lg:w-2 lg:h-2 bg-indigo-500 rounded-full shrink-0"></span>
                        Education and Awareness
                    </h3>
                    <ul class="space-y-2 !text-lg lg:!text-sm text-gray-700 ml-1 lg:ml-4 leading-snug">
                        <li class="flex items-start gap-2">
                            <span class="text-indigo-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Provide informal education opportunities, life skills training, and capacity-building for youth and marginalized groups.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-indigo-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Raise awareness on environmental protection, water conservation, and sustainable living.</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="!text-2xl lg:!text-base !font-semibold text-teal-700 mb-3 flex items-center gap-2 leading-tight">
                        <span class="w-2.5 h-2.5 lg:w-2 lg:h-2 bg-teal-500 rounded-full shrink-0"></span>
                        Innovation and Environmental Sustainability
                    </h3>
                    <ul class="space-y-2 !text-lg lg:!text-sm text-gray-700 ml-1 lg:ml-4 leading-snug">
                        <li class="flex items-start gap-2">
                            <span class="text-teal-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Integrate renewable energy solutions like solar power into IPAO projects and operations.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-teal-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Promote eco-friendly practices and green technologies in all development efforts.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-teal-500 !text-lg lg:!text-xs shrink-0">•</span>
                            <span>Encourage community-led environmental stewardship to protect natural resources for future generations.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-center mb-4 gap-3 flex-wrap">
                    <div class="w-12 h-12 lg:w-10 lg:h-10 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 lg:w-5 lg:h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="!text-4xl lg:!text-xl !font-bold text-gray-900 leading-tight text-center">Our Commitment</h3>
                </div>

                <div class="text-center">
                    <blockquote class="!text-xl lg:!text-sm text-gray-700 leading-relaxed italic mb-4">
                        "At IPAO, our goals are not just statements—they are commitments."
                    </blockquote>
                    <p class="!text-2xl lg:!text-base !font-semibold text-blue-600 mb-6 leading-snug">
                        Commitments to the people we serve, the planet we share, and the future we are building—together.
                    </p>

                    <div class="flex justify-center gap-6 lg:gap-4 flex-wrap">
                        <div class="text-center">
                            <div class="w-12 h-12 lg:w-8 lg:h-8 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-7 h-7 lg:w-4 lg:h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="!text-lg lg:!text-xs !font-medium text-gray-600">People</p>
                        </div>

                        <div class="text-center">
                            <div class="w-12 h-12 lg:w-8 lg:h-8 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-7 h-7 lg:w-4 lg:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="!text-lg lg:!text-xs !font-medium text-gray-600">Planet</p>
                        </div>

                        <div class="text-center">
                            <div class="w-12 h-12 lg:w-8 lg:h-8 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-7 h-7 lg:w-4 lg:h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="!text-lg lg:!text-xs !font-medium text-gray-600">Future</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.web.footer')
