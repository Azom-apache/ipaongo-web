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
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">All Comittee Members</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                     <th>Web Position</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($comittees as $comittee)
                                 @php
                                    @$sl++;
                                 @endphp
                                 <tr>
                                    <td>{{ $sl }}</td>
                                    <td style="width: 10%; text-align: center;"><img src="{{ asset('uploads/comittees/'.$comittee->image) }}" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                                    <td>{{ $comittee->name }}</td>
                                    <td>{{ $comittee->designation }}</td>
                                    <td>{{ $comittee->position }}</td>
                                    <td>
                                       <div class="btn-group">
                                          <a href="{{ route('dashboard.comittees.edit',$comittee->id) }}" class="btn btn-warning btn-sm rounded-0">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.comittees.delete_comittee',$comittee->id) }}" method="post">
                                             @csrf
                                             @method('PUT')
                                             <button type="submit" class="btn btn-danger btn-sm rounded-0" onclick="return confirm('Are You  Sure ? ')">
                                                <i class="fa fa-trash"></i>
                                             </button>
                                          </form>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                           <div class="paginations">{{$comittees->links()}}</div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
     
@endsection