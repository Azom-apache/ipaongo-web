@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Sliders</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Image</li>
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
                           <h4 class="card-title">Add Slider Image</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.sliders.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label for="">Title :</label>
                                 <input type="text"  name="title" class="form-control">
                              </div>
                              
                            <div class="form-group">
                                 <label for="">Title 2 :</label>
                                 <input type="text"  name="title_two" class="form-control">
                            </div>
                            <div class="form-group">
                                 <label for=""> Description :</label>
                                 <input type="text"  name="caption" class="form-control">
                            </div>
                              
                              <div class="form-group">
                                 <label>Image <small>(1024px X 550px)</small></label><br>
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