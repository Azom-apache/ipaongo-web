@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Pages</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
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
                           <h4 class="card-title">Edit Page</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.pages.update',$page->id) }}" method="post" enctype="multipart/form-data" > 
                              @csrf
                              @method("PATCH")
                              
                              <div class="form-group">
                                 <label>Page Title</label>
                                 <input value="{{ $page->title }}" type="text" required="" class="form-control" name="page_title">
                              </div>

                              <div class="form-group">
                                 <label>Page Content</label>
                                 <textarea name="content" id="" class="form-control summernote" required="">{{ $page->content }}</textarea>
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
        placeholder: 'Page Content',
        tabsize: 2,
        height: 100
      });
    </script>
   @endpush

@endsection