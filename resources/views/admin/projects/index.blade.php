@extends('layouts.admin.master')
@section('css_atik')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endsection
@section('content')
   @push('page_info')
      <h5 class="mb-0">Projects</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Projects</li>
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
                           <h4 class="card-title">Projects</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered" id="table_id">
                              <thead>
                                 <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Budget</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($projects as $project)
                                 @php
                                    @$sl++;
                                 @endphp
                                 <tr>
                                    <td style="width: 5%;">{{ $sl }}</td>
                                    @if($project->parent==0)
                                    <td><b>{{ $project->title }}</b></td>
                                    @else
                                    <td>{{ $project->title }}</td>
                                    @endif
                                    <td>{{ $project->price }}</td>
                                    <td>{{ $project->order }}</td>
                                    <td>@if($project->status == 1) <span class="text-success">Published</span> @else <span class="text-danger">Pending</span> @endif</td>
                                    <td>
                                       <div class="btn-group">
                                          <a class="btn btn-warning btn-sm rounded-0" href="{{ route('dashboard.projects.edit',$project->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.projects.destroy',$project->id) }}" method="post" >
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
                         
                           </table>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
     
@endsection
@section('js_atik')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
@endsection