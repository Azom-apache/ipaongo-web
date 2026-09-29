@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Jobs</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Jobs</li>
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
                           <h4 class="card-title">Jobs</h4>
                        </div>
                        <div class="card-body">
                              <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Sl</th>
                           <th>Title</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($jobs as $job)
                        @php
                           @$sl++;
                        @endphp
                        <tr>
                           <td style="width: 5%;">{{ $sl }}</td>
                           <td>{{ $job->title }}</td>
                           <td>@if($job->status == 1) <a href="javascript:void(0)" class="btn btn-success">Posted</a> @else <a href="javascript:void(0)" class="btn btn-danger">Pending</a> @endif</td>
                           <td>
                              <div class="btn-group">
                                 <a href="{{ route('dashboard.jobs.edit',$job->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                 </a>
                                 <form action="{{ route('dashboard.jobs.destroy',$job->id) }}" method="post" >
                                    @method("DELETE")
                                    @csrf
                                    <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                 </form>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="4">{{ $jobs->links() }}</td>
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