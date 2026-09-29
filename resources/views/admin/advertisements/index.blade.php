@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Advertisement</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Ad</a></li>
            <li class="breadcrumb-item active" aria-current="page">View all</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Advertisements</h4>
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
                        @foreach($ads as $ad)
                        @php
                            @$sl++;
                        @endphp
                        <tr>
                           <td style="width: 5%;">{{ $sl }}</td>
                           <td>{{ $ad->title }}</td>
                           <td>
                              @if($ad->status == 1)
                                 <a href="javascript:void(0)" class="btn btn-success">Posted</a>
                              @else
                                 <a href="javascript:void(0)" class="btn btn-danger">Pending</a>
                              @endif
                           </td>
                           <td>
                              <div class="btn-group">
                                 <a class="btn btn-warning btn-sm" href="{{ route('dashboard.advertisements.edit',$ad->id) }}">
                                 <i class="fa fa-edit"></i>
                                 </a>
                              <form action="{{ route('dashboard.advertisements.destroy',$ad->id) }}" method="post">
                                 @csrf
                                 @method("DELETE")
                                 <button class="btn btn-danger btn-sm" onclick="return confrim('Are You Sure ?')"><i class='fa fa-trash'></i></button>

                              </form>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
     
@endsection