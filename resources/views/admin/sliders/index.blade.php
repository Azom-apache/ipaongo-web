@extends('layouts.admin.master')
@section('content')
@push('page_info')
<h5 class="mb-0">Blank-Page</h5>
<nav aria-label="breadcrumb">
   <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Blank-Page</li>
   </ul>
</nav>
@endpush

<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Images</h4>
               </div>
               <div class="card-body">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Sl</th>
                           <th>Caption</th>
                           <th>Image</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($sliders as $slider)
                        @php
                           @$sl++;
                        @endphp
                        <tr>
                           <td style="width: 5%">{{ $sl }}</td>
                           <td>{{ $slider->caption }}</td>
                           <td><img src="{{ asset('uploads/sliders/'.$slider->image) }}" style="width: 250px; height: 90px"></td>
                           <td>
                              <div class="btn-group">
                                        <a class="btn btn-warning btn-sm rounded-0" href="{{ route('dashboard.sliders.edit',$slider->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                 <form action="{{ route('dashboard.sliders.destroy',$slider->id) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                 </form>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                     @if(!empty($sliders->links()))
                     <tfoot>
                        <tr>
                           <td colspan="4" class="text-center">
                              {{ $sliders->links() }}
                           </td>
                        </tr>
                     </tfoot>
                     @endif
                  </table>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</div>

@endsection