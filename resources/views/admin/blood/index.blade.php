@extends('layouts.admin.master')
@section('content')
    @push('page_info')
        <h5 class="mb-0">Blood Donors</h5>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blood Donors</li>
            </ul>
        </nav>
    @endpush

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @include('layouts.admin.errors')

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="display:inline;" class="card-title">Blood Donors</h4>
                            <div style="float:right;">
                                <a href="{{ route('dashboard.blood.task') }}" class="btn btn-success mr-2">Export CSV</a>
                                <button class="btn btn-primary" type="button" data-toggle="collapse"
                                    data-target="#searchForm" aria-expanded="false">
                                    <i class="fa fa-search"></i> Search & Filter
                                </button>
                            </div>
                        </div>

                        <div class="collapse" id="searchForm">
                            <div class="card-body border-top">
                                <form method="GET" action="{{ route('dashboard.blood.index') }}" class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Search by name" value="{{ request('name') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="blood_group" class="form-control">
                                            <option value="">All Blood Groups</option>
                                            <option value="A+" {{ request('blood_group') == 'A+' ? 'selected' : '' }}>A+
                                            </option>
                                            <option value="A-" {{ request('blood_group') == 'A-' ? 'selected' : '' }}>A-
                                            </option>
                                            <option value="B+" {{ request('blood_group') == 'B+' ? 'selected' : '' }}>B+
                                            </option>
                                            <option value="B-" {{ request('blood_group') == 'B-' ? 'selected' : '' }}>B-
                                            </option>
                                            <option value="AB+" {{ request('blood_group') == 'AB+' ? 'selected' : '' }}>
                                                AB+</option>
                                            <option value="AB-" {{ request('blood_group') == 'AB-' ? 'selected' : '' }}>
                                                AB-</option>
                                            <option value="O+" {{ request('blood_group') == 'O+' ? 'selected' : '' }}>
                                                O+</option>
                                            <option value="O-" {{ request('blood_group') == 'O-' ? 'selected' : '' }}>
                                                O-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="member_type" class="form-control">
                                            <option value="">All Types</option>
                                            <option value="donor"
                                                {{ request('member_type') == 'donor' ? 'selected' : '' }}>Donor</option>
                                            <option value="volunteer"
                                                {{ request('member_type') == 'volunteer' ? 'selected' : '' }}>Volunteer
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="district" class="form-control"
                                            placeholder="Search by district" value="{{ request('district') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Blood Group</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl = 0; @endphp
                                    @foreach ($donors as $member)
                                        @php $sl++; @endphp
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td style="width: 8%; text-align: center;">
                                                @if ($member->image)
                                                    <img src="{{ asset('uploads/project/' . $member->image) }}"
                                                        style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;"
                                                        alt="Profile">
                                                @else
                                                    <div
                                                        style="width: 50px; height: 50px; border-radius: 50%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-weight: bold;">
                                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $member->name }}</strong>
                                                @if ($member->gender)
                                                    <br><small class="text-muted">{{ $member->gender }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">{{ $member->blood_group }}</span>
                                            </td>
                                            <td>{{ $member->mobile }}</td>
                                            <td>{{ $member->email }}</td>
                                            <td>
                                                @if ($member->district && $member->upazila)
                                                    {{ $member->district }}, {{ $member->upazila }}
                                                @elseif($member->district)
                                                    {{ $member->district }}
                                                @else
                                                    N/A
                                                @endif
                                                @if ($member->division)
                                                    <br><small class="text-muted">{{ $member->division }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($member->member_type == 'donor')
                                                    <span class="badge badge-success">Donor</span>
                                                @elseif($member->member_type == 'volunteer')
                                                    <span class="badge badge-info">Volunteer</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $member->member_type }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-info btn-sm" title="View Details"
                                                        data-toggle="modal" data-target="#donorModal{{ $member->id }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('dashboard.blood.destroy', $member->id) }}"
                                                        method="post" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this donor?')"
                                                            title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Donor Details Modal -->
                                        <div class="modal fade" id="donorModal{{ $member->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="donorModalLabel{{ $member->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="donorModalLabel{{ $member->id }}">
                                                            Donor Details - {{ $member->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4 text-center">
                                                                @if ($member->image)
                                                                    <img src="{{ asset('uploads/project/' . $member->image) }}"
                                                                        class="img-fluid rounded-circle mb-3"
                                                                        style="max-width: 150px;" alt="Profile">
                                                                @else
                                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                                                        style="width: 150px; height: 150px;">
                                                                        <span
                                                                            style="font-size: 3rem; color: #6c757d; font-weight: bold;">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4>{{ $member->name }}</h4>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p><strong>Blood Group:</strong> <span
                                                                                class="badge badge-danger">{{ $member->blood_group }}</span>
                                                                        </p>
                                                                        <p><strong>Mobile:</strong> {{ $member->mobile }}
                                                                        </p>
                                                                        <p><strong>Email:</strong> {{ $member->email }}</p>
                                                                        <p><strong>Type:</strong>
                                                                            @if ($member->member_type == 'donor')
                                                                                <span
                                                                                    class="badge badge-success">Donor</span>
                                                                            @elseif($member->member_type == 'volunteer')
                                                                                <span
                                                                                    class="badge badge-info">Volunteer</span>
                                                                            @else
                                                                                {{ $member->member_type }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p><strong>Gender:</strong>
                                                                            {{ $member->gender ?: 'N/A' }}</p>
                                                                        <p><strong>Date of Birth:</strong>
                                                                            {{ $member->dob ?: 'N/A' }}</p>
                                                                        <p><strong>Education:</strong>
                                                                            {{ $member->edu_qual ?: 'N/A' }}</p>
                                                                        <p><strong>Address:</strong>
                                                                            {{ $member->address ?: 'N/A' }}</p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p><strong>Division:</strong><br>{{ $member->division ?: 'N/A' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <p><strong>District:</strong><br>{{ $member->district ?: 'N/A' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <p><strong>Upazila:</strong><br>{{ $member->upazila ?: 'N/A' }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($donors->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $donors->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
