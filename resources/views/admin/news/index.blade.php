@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">News</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"> News</li>
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
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($news as $project)
                                 @php
                                    @$sl++;
                                 @endphp
                                 <tr>
                                    <td style="width: 5%;">{{ $sl }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{$project->type}}</td>
                                    <td>@if($project->status == 1) <span class="text-success">Published</span> @else <span class="text-danger">Pending</span> @endif</td>
                                    <td>
                                       <div class="btn-group">
                                          <a class="btn btn-warning btn-sm rounded-0" href="{{ route('dashboard.news.edit',$project->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.news.destroy',$project->id) }}" method="post" >
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
                                    <th colspan="4">{{ $news->links() }}</th>
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