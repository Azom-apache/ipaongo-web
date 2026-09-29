@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Comittees</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Comittee</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-6">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Add Comittee Member</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.comittees.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label>Comittee Type</label>
                                <select name="comittee_type" class="form-control" id="comittee_type">
                                    <option value="" selected disable>SELECT AN OPTION</option>
                                    <option value="1">Executive</option>
                                    <option value="2">Advisor</option>
                                </select>
                              </div>
                              
                              <div class="form-group">
                                 <label for="">Comittee Member Name</label>
                                 <input type="text" required="" name="name" class="form-control">
                              </div>
                              
                              <div class="form-group">
                                 <label>Factory Name</label>
                                 <input type="text" name="factory" class="form-control" required="">
                              </div>
                              
                              <div class="form-group">
                                 <label>Organizal Designation</label>
                                 <input type="text" name="designation" class="form-control" required="">
                              </div>
                              
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" name="mobile" class="form-control" required="">
                              </div>
                              
                              <div class="form-group">
                                 <label for="">Image</label><br>
                                 <input type="file" name="image">
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