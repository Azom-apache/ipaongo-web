@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Donations</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Donations</li>
            </ul>
        </nav>
    @endpush
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Donor Name</th>
                                        <th>Email</th>
                                        <th>Project</th>
                                        <th>Amount (BDT)</th>
                                        <th>Amount (USD)</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl = 0; @endphp
                                    @foreach ($donations as $donation)
                                        @php $sl++; @endphp
                                        <tr>
                                            <td style="width: 5%;">{{ $sl }}</td>
                                            <td>{{ $donation->donor_name }}</td>
                                            <td>{{ $donation->email }}</td>
                                            <td>{{ $donation->project_name }}</td>
                                            <td>{{ $donation->budget ? number_format($donation->budget, 2) : 'N/A' }}</td>
                                            <td>{{ $donation->usd ? number_format($donation->usd, 2) : 'N/A' }}</td>
                                            <td>{{ $donation->payment_status ? ucfirst($donation->payment_status) : 'Recorded' }}</td>
                                            <td>{{ $donation->donated_at->format('d M Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-info btn-sm rounded-0"
                                                        href="{{ route('dashboard.admin.donations.show', $donation->id) }}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                    <form
                                                        action="{{ route('dashboard.admin.donations.destroy', $donation->id) }}"
                                                        method="post" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            onclick="return confirm('Are you sure you want to delete this donation?')"
                                                            class="btn btn-danger btn-sm rounded-0">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="9">{{ $donations->links() }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
