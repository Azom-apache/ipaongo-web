@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Comittees</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Comittee</li>
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
                           <h4 class="card-title">Update Comittee Member</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.comittees.update',$comittee->id) }}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method("PATCH")
                              <div class="form-group">
                                 <label for="">Comittee Member Name</label>
                                 <input type="text" value="{{ $comittee->name }}" required="" name="name" class="form-control">
                              </div>
                              
                              <div class="form-group">
                                 <label>Factory Name</label>
                                 <input type="text" name="factory" value="{{ $comittee->factory }}" class="form-control" required="">
                              </div>
                              
                              <div class="form-group">
                                 <label>Organizal Designation</label>
                                 <input type="text" name="designation" value="{{ $comittee->designation }}" class="form-control" required="">
                              </div>
                              
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" name="mobile" class="form-control" value="{{ $comittee->mobile }}" required="">
                              </div>
                              
                              <div class="form-group">
                                 <label for="">Image</label><br>
                                 <input type="file" name="image">
                                 <input type="hidden" name="old_image" value="{{ $comittee->image }}">
                              </div>
                              <div class="form-group">
                                 <label for="">Comittee Position</label>
                                 <input class="form-control" type="number" name="position" value="{{ $comittee->position }}">
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