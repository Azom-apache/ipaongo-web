@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Profiles</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Profiles</li>
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
                           <h4 class="card-title">All Profiles</h4>
                        </div>
                        <div class="card-body">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <input placeholder="Enter Mobile, Name,Email Student Id" type="text" id="string" class="form-control">
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <button id="findProfile" class="btn btn-success">Search</button>
                                 </div>
                              </div>
                           </div>
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                     <th>Student ID</th>
                                    <th>Mobile</th>
                                    <th>Short description</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="dataTable">
                                 @foreach($profiles as $profile)
                                 
                                 <tr>
                                    <td style="width: 5%;">{{ $loop->iteration}}</td>
                                    <td>{{ $profile->name }}</td>
                                    <td>{{ $profile->username }}</td>
                                    <td>{{ $profile->mobile }}</td>
                                    <td>
                                       @if($profile->department)
                                          {{ $profile->department->department_name }}
                                       @endif
                                       @if($profile->district)
                                          - {{ $profile->district->district_name }}
                                       @endif
                                       @if($profile->area)
                                          - {{ $profile->area->area }}
                                       @endif
                                    </td>
                                    <td>
                                       
                                       <div class="btn-group">
                                          <a class="btn btn-warning" href="{{ route('dashboard.profiles.edit',$profile->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.profiles.destroy',$profile->id) }}" method="post">
                                             @csrf
                                             @method("DELETE")
                                             <button class="btn btn-danger" onclick="return confirm('Are You Sure ?')">
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
@push("js")
   <script>
      $("#findProfile").click(function(){
         var string =   $("#string").val();
         $.ajax({
            url: "{{ route('dashboard.profile.findProfile') }}?string="+string, 
            success: function(result){
               console.log(result);             
                $("#dataTable").html(result);
              }
         });  
      });
   </script>
@endpush
@endsection