@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Gallery</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Gallery</li>
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
                           <h4 class="card-title">Edit Gallery Post</h4>
                        </div>
                        <div class="card-body">
                          {{-- <form action="{{ route('dashboard.blogs.update',$blog->id) }}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method("PATCH")
                              <div class="form-group">
                                 <label>Blog Title</label>
                                 <input type="text" required="" value="{{ $blog->title }}" name="title" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label>Image</label><br>
                                 <input type="file"  name="image">
                                 <input type="hidden" name="old_image" value="{{ $blog->image }}">
                              </div>
                              <div class="form-group">
                                 <label>Blog Status</label><br>
                                 <input type="radio" required="" @if($blog->status == 1) checked @endif  name="status" value="1" checked> Published &nbsp &nbsp
                                 <input type="radio" required="" @if($blog->status == 0) checked @endif  value="0" name="status"> &nbsp Save as draft
                              </div>
                              <div class="form-group">
                                 <label for="">Description</label>
                                 <textarea name="description" class="form-control summernote" required="">{{ $blog->description }}</textarea>
                              </div>
                              <div class="form-group">
                                 <button class="btn btn-success">Submit</button>
                              </div>
                           </form> --}}
                           <form action="{{ route('dashboard.galleries.update',$gallery->id) }}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method("PATCH") 
                              <div class="form-group">
                                 <label>Image</label><br>
                                 <input type="file" name="image" class="my-2">
                                 <img src="{{asset('images/gallery')}}/{{$gallery->image}}" alt="" width="100px;"/>
                              </div>
							  <div class="form-group">
							  	<select class="form-control" name="parent">
									<option value=""> Project </option>
									@php
										$event = \App\Gallery::where('parent', '0')->orderby('id', 'DESC')->get();
									@endphp
									@foreach($event AS $item)
										<option value="{{$item->id}}" {{$gallery->parent == $item->id?'selected':''}}> {{$item->title}} </option>
									@endforeach
								</select>
							  </div>
                              <div class="form-group">
                                 <label>Title</label><br>
                                 <input type="text" class="form-control"  name="title" value="{{$gallery->title}}">
                                 <input type="hidden" class="form-control" name="id" value="{{$gallery->id}}">
                              </div>
                              <div class="form-group">
                                 <label>Image Caption</label><br>
                                 <input type="radio" name="status" value="1" {{$gallery->status == 1?'checked':''}}> Published &nbsp &nbsp
                                 <input type="radio" value="0" name="status" {{$gallery->status == 0?'checked':''}}> &nbsp Save as draft
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-success">Submit</button>
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