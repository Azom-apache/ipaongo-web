@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Import</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Import Daka</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')               
               <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Import Student ID</h4>
                        </div>
                        <div class="card-body">
                           <form enctype="multipart/form-data" action="{{ route('dashboard.import.store') }}" method="post">
                              @csrf
                              <div class="form-group">
                                 <label for="">Excel file</label>
                                 <input type="file" name="student_id">
                              </div>
                              <div class="form-group">
                                 <button class="btn btn-success" type="submit">Submit</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Import Student ID</h4>
                        </div>
                        <div class="card-body">
                            <form action='{{ route('dashboard.import.store') }}' method='post'>
                                @csrf
                                <div class='form-group'>
                                    <label>ID Number</label>
                                    <input type='text' class='form-control' required name='id'>
                                </div>
                                 <div class='form-group'>
                                    <label>Name</label>
                                    <input type='text' class='form-control' required name='name'>
                                </div>
                                 <div class='form-group'>
                                    <button class='btn btn-success'>Submit</button>
                                </div>
                            </form>    
                        </div>
                    </div>
               </div>
            </div>
         </div>
     
@endsection