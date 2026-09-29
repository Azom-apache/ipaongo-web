@include('layouts.web.header')


<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Newspaper-style Article -->
        <article class="bg-white shadow-lg rounded-lg p-8 lg:p-12 font-serif leading-relaxed">
            <!-- Header -->
            <header class="mb-8">
                <h1 class="text-6xl sm:text-7xl lg:text-6xl font-bold text-gray-900 mb-4 text-center leading-tight">Chairman's Message</h1>
                <div class="w-32 h-1 bg-blue-600 mx-auto mb-6"></div>
                <p class="text-center text-gray-600 italic text-2xl sm:text-3xl lg:text-2xl px-2">Words of wisdom and vision from our esteemed Chairman</p>
            </header>

            <!-- Article Body -->
            <div class="clearfix">
                <!-- Chairman's Image -->
                <div class="md:float-left md:w-72 md:mr-8 md:mb-5 w-full max-w-xs mx-auto mb-5 border-2 border-gray-200 p-2.5 bg-white shadow-md">
                    <img src="{{ asset('img/chairman.png') }}" alt="Chairman's Image">
                    <div class="text-center text-lg sm:text-xl text-gray-500 mt-2 italic leading-snug">
                        Chairman<br>
                        <span class="text-base sm:text-lg block mt-1">Illiteracy and Poverty Alleviation Assistance Organization (IPAO)</span>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="text-2xl sm:text-3xl lg:text-2xl text-gray-700 text-justify leading-relaxed">
                    

                    <p class="mb-5 text-xl font-medium mb-6">
                        I am pleased to introduce you in briefing about the Illiteracy and Poverty Alleviation Assistance Organization (IPAO) is a Humanitarian Charitable Organization since 1996 to work for people and their life. To make life better for the most needy and disadvantaged people and our multiple projects enhance towards making this vision in a reality.
                    </p>

                    <p class="mb-5 text-xl">
                        IPAO serves humanity without discrimination of race, religion, class, color, ethnicity and creed under the Illiteracy and Poverty Alleviation Assistance Organization (IPAO)'s stable and visionary leadership, we have been able to achieve a consensus on our mission and objectives which will greatly enhance the positive outcomes of IPAO's efforts moving forward.
                    </p>

                    <p class="mb-5 text-xl">
                        Our Organization has helped large number of the real needy people including less privileged people - the poor, the disable, widows and orphans by providing needs and materials such as Food aid, Emergency relief, Medical aid, disable care, Livelihood grants, Agriculture Tools and raw materials, implements for fishing, water & sanitation facilities, sheltering the homeless, education support, clothing, Sewing machines and sponsorship programs) by the grace of Almighty Allah, we have also extended our help to war and natural disaster victims during the past years. Establishment of IPAO's home for the poor and needy children is yet another milestone.
                    </p>

                    <p class="mb-5 text-xl">
                        I would like to express my thanks to everyone involved in bringing IPAO to the position that it is today, including our generous donors, the dedicated staff and hard working volunteers, all of whom are the driving force behind the charity. Your support has been monumental in benefiting people who depend on you for their survival.
                    </p>

                    <p class="mb-5 text-xl">
                        IPAO presents numerous humanitarian opportunities for you to help make a better life. If you wish to help us, contact our team to see how you can be involved and how your support can make a lasting difference to the people who desperately need your help.
                    </p>

                    <p class="mb-5 text-xl">
                        I would express my heartfelt gratitude for those who helped us in financially resourcing and donating aids for the needy and the poor.
                    </p>

                    <div class="text-right mt-10 pt-5 border-t border-gray-200">
                        <p class="text-2xl sm:text-3xl lg:text-2xl font-semibold my-1">Sincerely,</p>
                        <p class="text-3xl sm:text-4xl lg:text-3xl font-bold text-blue-600 mt-2 my-1">Chairman</p>
                        <div class="my-3">
                            <img src="{{ asset('img/signature.jpeg') }}" alt="Chairman Signature" class="h-16 w-auto inline-block max-w-full object-contain">
                        </div>
                        <p class="text-gray-600 my-1 text-xl sm:text-2xl lg:text-xl">Illiteracy and Poverty Alleviation Assistance Organization (IPAO)</p>
                    </div>
                </div>
            </div>
            <div class="clear-both"></div>
        </article>
    </div>
</section>

@include('layouts.web.footer')
