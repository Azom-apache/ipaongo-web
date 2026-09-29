
@include('layouts.web.header')
<div class="w-full lg:max-w-7xl mx-auto px-4">
    <div class="flex flex-wrap">
        <div class="w-full">
            <div class="page-title text-center text-gray-900 mt-12 mb-8">
                <h2 class="text-gray-900 uppercase text-3xl lg:text-4xl font-bold tracking-wide relative inline-block">
                    {{ $page->title }}
                    <div class="flex items-center justify-center mt-2 space-x-2">
                        <div class="w-12 h-0.5 bg-blue-500 rounded"></div>
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <div class="w-12 h-0.5 bg-pink-500 rounded"></div>
                    </div>
                </h2>
            </div>
            <div class="page-description mt-6 prose max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
<style>
	.page-description div center table tbody tr td {
		padding: 10px;
		border: 1px solid #ccc;
	}
	.page-description div center table {
		width: 100% !important;
	}
	.page-description div center h1:first-of-type {
		padding-top: 15px;
	}
    .page-description table tbody tr td {
        padding: 10px;
    }
</style>

@include('layouts.web.footer')
