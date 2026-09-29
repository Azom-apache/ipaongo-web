@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Advertisements</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add new</li>
         </ul>
      </nav>
   @endpush
@push('css')
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Add new</h4>
                        </div>
                        <div class="card-body">
                           <form enctype="multipart/form-data" action="{{ route('dashboard.advertisements.store') }}" method="post">
                              @csrf
                              <div class="form-group">
                                 <label for="">Title</label>
                                 <input type="text" required="" name="title" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="">Image</label><br>
                                 <input type="file" required="" name="image">
                              </div>
                              <div class="form-group">
                                 <label for="">Description</label>
                                 <textarea name="description" id="description" required=""></textarea>
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
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
   $(document).ready(function() {
     $('#description').summernote();
   });
</script>
@endpush         
@endsection