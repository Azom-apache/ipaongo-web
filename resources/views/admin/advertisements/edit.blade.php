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
                           <h4 class="card-title">Edit new</h4>
                        </div>
                        <div class="card-body">
                           <form enctype="multipart/form-data" action="{{ route('dashboard.advertisements.update',$advertisement->id) }}" method="post">
                              @method("PATCH")
                              @csrf
                              
                              <div class="form-group">
                                 <label for="">Title</label>
                                 <input type="text" required="" value="{{ $advertisement->title }}" name="title" class="form-control">
                              </div>

                              <div class="form-group">
                                 <label for="">Image</label><br>
                                 <input type="file"  name="image">
                                 <input type="hidden" value="{{ $advertisement->image }}" name="old_image">
                              </div>

                              <div class="form-group">
                                 <label for="">Status</label><br>
                                 <label><input type="radio" value="1" name="status" @if($advertisement->status == 1) checked @else @endif > Post</label>
                                 <label><input type="radio" value="0" name="status" @if($advertisement->status == 0) checked @else @endif > Pending</label>
                              </div>

                              <div class="form-group">
                                 <label for="">Description</label>
                                 <textarea name="description" id="description" required="">{{ $advertisement->description }}</textarea>
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