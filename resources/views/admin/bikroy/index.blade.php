@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Bikroy</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Bikroy Posts</li>
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
                           <h4 class="card-title">Blogs</h4>
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
                                 @foreach($bikrois as $bikroy)
                                 @php
                                    @$sl++;
                                 @endphp
                                 <tr>
                                    <td style="width: 5%;">{{ $sl }}</td>
                                    <td>{{ $bikroy->title }}</td>
                                    <td>@if($bikroy->status == 1) <span class="text-success">Published</span> @else <span class="text-danger">Pending</span> @endif</td>
                                    <td>
                                       <div class="btn-group">
                                          <a class="btn btn-warning btn-sm rounded-0" href="{{ route('dashboard.bikroy.edit',$bikroy->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.bikroy.destroy',$bikroy->id) }}" method="post" >
                                             @csrf
                                             @method("DELETE")
                                             <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm rounded-0">
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
                                    <th colspan="4">{{ $bikrois->links() }}</th>
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