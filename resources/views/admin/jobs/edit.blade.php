@extends('layouts.admin.master')
@section('content')
@push('css')
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
   @push('page_info')
      <h5 class="mb-0">Blank-Page</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blank-Page</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Add Job</h4>
                        </div>
                        <div class="card-body">
                           <form enctype="multipart/form-data" action="{{ route('dashboard.jobs.update',$job->id) }}" method="post">
                                 @csrf
                                 @method("PATCH")
                                 <div class="form-group">
                                    <label> Job Title </label>
                                    <input type="text" value="{{ $job->title }}" required name="title" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <label for="">Image</label><br>
                                    <input type="file" name="image">
                                    <input type="hidden" value="{{ $job->image }}" name="old_image">
                                 </div>
                                 <div class="form-group">
                                    <label for=""> Status </label><br>
                                   <label><input @if($job->status == 1 ) checked @endif type="radio" value="1" name="status" > Posted </label>
                                   <label><input @if($job->status == 0 ) checked @endif type="radio" value="0" name="status" > Pending </label>
                                 </div>
                                 <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" required id="description" class="form-control">{{ $job->description }}</textarea>
                                 </div>
                                 <div class="form-group">
                                    <button class="btn btn-success">Update</button>
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