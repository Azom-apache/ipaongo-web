@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">News</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add News</li>
         </ul>
      </nav>
   @endpush
   @push('css')     
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <style>
           .modal-backdrop {
                position: unset;
                top: 0;
                left: 0;
                z-index: 1040;
                width: 100vw;
                height: 100vh;
                background-color: #000;
            }
        </style>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Create News</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.news.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label>News Title</label>
                                 <input type="text" required="" name="title" class="form-control">
                              </div>
							  <div class="form-group">
                                 <label>Type</label>
								<select class="form-control" name="type">
									<option value="">Type</option>
									<option value="News">News</option>
									<option value="newslater">News Later</option>
									<option value="media"> Media </option>
									<option value="bulletin"> Bulletin </option>
									<option value="breakingNews"> Breaking News </option>
								</select>
                              </div>
                              <div class="form-group">
                                 <label>Image</label><br>
                                 <input type="file" name="image">
                              </div>
                              <div class="form-group">
                                 <label>News Status</label><br>
                                 <input type="radio" required="" name="status" value="1" checked> Published &nbsp &nbsp
                                 <input type="radio" required="" value="0" name="status"> &nbsp Save as draft
                              </div>
                             <div class="form-group">
                              <label for="">Short Desc</label>
                              <textarea name="excerpt" class="form-control"></textarea>
                            </div>
                              <div class="form-group">
                                 <label for="">Description</label>
                                 <textarea name="description" class="form-control summernote"></textarea>
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
   $('.summernote').summernote({
     placeholder: 'Blog Description',
     tabsize: 2,
     height: 100
   });
 </script>
@endpush 
@endsection