@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Manage Ad</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ads</li>
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
                           <h4 class="card-title">Ads</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>SL</th>
                                    <th>Area</th>
                                    <th>Image</th>
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
                                    <td>{{ str_replace('_', ' ', ucfirst($ad->area)) }}</td>
                                    <td>
                                       @if($ad->ad_type == 1)
                                         <img src="{{ asset('uploads/ads/'.$ad->image) }}" class="img-fluid">
                                       @else
                                         <pre>
                                            {{ $ad->code }}
                                         </pre>
                                       @endif


                                    </td>
                                    <td>
                                       <a href="{{ route('dashboard.ads.edit',$ad->id) }}" class="btn btn-warning btn-sm">
                                          <i class="fa fa-edit"></i>
                                       </a>
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