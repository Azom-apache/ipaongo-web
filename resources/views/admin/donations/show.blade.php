@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Donation Details</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.donations.index') }}">Donations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ul>
        </nav>
    @endpush
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Donation Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Donor Information</h6>
                                    <p><strong>Name:</strong> {{ $donation->donor_name }}</p>
                                    <p><strong>Email:</strong> {{ $donation->email }}</p>
                                    <p><strong>Contact:</strong> {{ $donation->contact }}</p>
                                    <p><strong>Address:</strong> {{ $donation->address }}</p>
                                    <p><strong>Country:</strong> {{ $donation->country }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Donation Details</h6>
                                    <p><strong>Project:</strong> {{ $donation->project_name }}</p>
                                    @if ($donation->subcat_name && $donation->subcat_name != 'Nullable')
                                        <p><strong>Sub Category:</strong> {{ $donation->subcat_name }}</p>
                                    @endif
                                    @if ($donation->subsubcat_name && $donation->subsubcat_name != 'Nullable')
                                        <p><strong>Sub Sub Category:</strong> {{ $donation->subsubcat_name }}</p>
                                    @endif
                                    @if ($donation->budget)
                                        <p><strong>Budget (BDT):</strong> {{ number_format($donation->budget, 2) }}</p>
                                    @endif
                                    @if ($donation->quantity)
                                        <p><strong>Quantity:</strong> {{ $donation->quantity }}</p>
                                    @endif
                                    @if ($donation->usd)
                                        <p><strong>Amount (USD):</strong> {{ number_format($donation->usd, 2) }}</p>
                                    @endif
                                    <p><strong>Donation Date:</strong> {{ $donation->donated_at->format('d M Y, H:i') }}
                                    </p>
                                    <p><strong>Payment Status:</strong> {{ $donation->payment_status ? ucfirst($donation->payment_status) : 'Recorded' }}</p>
                                    @if ($donation->tran_id)
                                        <p><strong>Transaction ID:</strong> {{ $donation->tran_id }}</p>
                                    @endif
                                    @if ($donation->paid_amount)
                                        <p><strong>Paid Amount:</strong> {{ number_format($donation->paid_amount, 2) }} {{ $donation->payment_currency }}</p>
                                    @endif
                                    @if ($donation->bank_tran_id)
                                        <p><strong>Bank Transaction ID:</strong> {{ $donation->bank_tran_id }}</p>
                                    @endif
                                    @if ($donation->card_type)
                                        <p><strong>Card / Channel:</strong> {{ $donation->card_type }}</p>
                                    @endif
                                    @if ($donation->card_issuer)
                                        <p><strong>Issuer:</strong> {{ $donation->card_issuer }}</p>
                                    @endif
                                    @if ($donation->val_id)
                                        <p><strong>Validation ID:</strong> {{ $donation->val_id }}</p>
                                    @endif
                                    @if ($donation->paid_at)
                                        <p><strong>Paid At:</strong> {{ $donation->paid_at->format('d M Y, H:i') }}</p>
                                    @endif
                                    @if ($donation->payment_message)
                                        <p><strong>Gateway Message:</strong> {{ $donation->payment_message }}</p>
                                    @endif
                                </div>
                            </div>

                            @if ($donation->image)
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6>Attachment</h6>
                                        <img src="{{ asset('images/' . $donation->image) }}" alt="Donation Image"
                                            class="img-fluid" style="max-width: 300px;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Actions</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('dashboard.admin.donations.index') }}"
                                class="btn btn-primary btn-block mb-2">
                                <i class="fa fa-arrow-left"></i> Back to Donations
                            </a>
                            <form action="{{ route('dashboard.admin.donations.destroy', $donation->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this donation?')"
                                    class="btn btn-danger btn-block">
                                    <i class="fa fa-trash"></i> Delete Donation
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
