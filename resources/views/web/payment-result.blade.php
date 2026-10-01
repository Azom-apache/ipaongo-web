@include('layouts.web.header')

<section class="py-16 bg-gray-50 min-h-[60vh]">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            @if ($status === 'success')
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600 text-3xl">✓</div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Payment Successful</h1>
            @elseif ($status === 'cancelled')
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-yellow-100 text-yellow-700 text-3xl">!</div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Payment Cancelled</h1>
            @else
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-red-600 text-3xl">×</div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Payment Failed</h1>
            @endif

            <p class="text-gray-600 mb-6">{{ $message }}</p>

            @if ($donation)
                <dl class="text-left bg-gray-50 rounded-lg border border-gray-200 divide-y divide-gray-200 mb-6">
                    <div class="flex justify-between gap-4 px-4 py-3">
                        <dt class="text-sm text-gray-500">Donor</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $donation->donor_name }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 px-4 py-3">
                        <dt class="text-sm text-gray-500">Project</dt>
                        <dd class="text-sm font-medium text-gray-900 text-right">{{ $donation->project_name }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 px-4 py-3">
                        <dt class="text-sm text-gray-500">Amount</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ number_format($donation->paid_amount ?: $donation->budget, 2) }} {{ $donation->payment_currency ?: 'BDT' }}</dd>
                    </div>
                    <div class="flex justify-between gap-4 px-4 py-3">
                        <dt class="text-sm text-gray-500">Transaction ID</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ $donation->tran_id }}</dd>
                    </div>
                    @if ($donation->bank_tran_id)
                        <div class="flex justify-between gap-4 px-4 py-3">
                            <dt class="text-sm text-gray-500">Bank Transaction ID</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $donation->bank_tran_id }}</dd>
                        </div>
                    @endif
                    @if ($donation->card_type)
                        <div class="flex justify-between gap-4 px-4 py-3">
                            <dt class="text-sm text-gray-500">Payment Method</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $donation->card_type }}</dd>
                        </div>
                    @endif
                    <div class="flex justify-between gap-4 px-4 py-3">
                        <dt class="text-sm text-gray-500">Status</dt>
                        <dd class="text-sm font-medium text-gray-900 capitalize">{{ $donation->payment_status }}</dd>
                    </div>
                </dl>
            @endif

            <a href="{{ route('donate.show') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md">
                Back to Donate
            </a>
        </div>
    </div>
</section>

@include('layouts.web.footer')
