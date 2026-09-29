@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Departments</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Departments</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-4">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">
                                 Edit Department
                           </h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.departments.update',$department->id) }}" method="post">
                              @csrf
                              @method("PATCH")
                              <div class="form-group">
                                 <label for="">Department Name</label>
                                 <input type="text" value="{{ $department->department_name }}" required="" name="department_name" class="form-control">
                              </div>
                              <div class="form-group">
                                 <button class="btn btn-success">Submit</button>
                              </div>
                           </form>
                        </div>
                     </div>

                  </div>

                
               </div>
            </div>
         </div>
     
@endsection