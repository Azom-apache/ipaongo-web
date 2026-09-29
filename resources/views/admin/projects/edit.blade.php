@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Projects</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit project</li>
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
                           <h4 class="card-title">Edit project Post</h4>
                        </div>
                        <div class="card-body">
                               <form action="{{ route('dashboard.projects.update',$project->id) }}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  @method("PATCH")
                                @php
                                    //$parent = \App\Project::where('id', $project->parent)->first();

                                    //$data = \App\Project::where('parent', $parent->parent)->get();
                                    
                                    //$subproject = \App\Project::where('')->get();
                                @endphp
                            {{--
                                <div class="form-group" id="ResultShow">
                                    <label>Sub Project</label>
                                    <select name="subcat" id="SubCategory" class="form-control">
                                        <option value="">-- Select Project --</option>
                                        @foreach($data AS $item)
                                        <option @if($item->id==$project->parent) SELECTED  @endif value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group" id="SubSubCategory">
                                    <label> Sub Sub Project </label>
                                    <select  class="form-control">
                                        <option value=""> --Sub Sub Project-- </option>
                                        <option selected value="{{$project->id}}">{{$project->title}}</option>
                                    </select>
                                </div>
                            --}}
                              
                              {{--
							  <div class="form-group">
                                <label>Parent Category</label>
								<select name="parent" class="form-control">
									<option value="0">Parent</option>
									@php
										$gparent = \App\Project::where('status', 1)->where('parent', 0)->get();
									@endphp
									@foreach($gparent AS $item)
										<option @if($item->id==$project->parent) SELECTED @endif value="{{$item->id}}">{{$item->title}}</option>
										<optgroup label="{{$item->title}}">
										@php
											$parents = \App\Project::where('parent', $item->id)->get();
										@endphp
											@foreach($parents AS $parent)
											<option @if($parent->id==$project->parent) {{'SELECTED'}} @endif value="{{$parent->id}}">-{{$parent->title}}</option>
											@endforeach
										</optgroup>
									@endforeach
								</select>
                              </div>
                              --}}
                              <div class="form-group">
                                 <label>Project Title</label>
                                 <input type="text" required="" value="{{ $project->title }}" name="title" class="form-control">
                              </div>
                            <div class="form-group">
                                 <label>Project Price</label>
                                 <input type="text"  value="{{ $project->price }}" name="price" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label>Image</label><br>
                                 <img src="{{asset('uploads/project/'.$project->image)}}" width="50%" />
                                 <input type="file"  name="image">
                                 <input type="hidden" name="old_image" value="{{ $project->image }}">
                              </div>
                              <div class="form-group">
                                 <label>Project Status</label><br>
                                 <input type="radio"  @if($project->status == 1) checked @endif  name="status" value="1" checked> Published &nbsp &nbsp
                                 <input type="radio"  @if($project->status == 0) checked @endif  value="0" name="status"> &nbsp Save as draft
                              </div>
                              <div class="form-group">
                                 <label> Side Ber Visiblity </label><br>
                                 <label>
                                    <input type="radio"  @if($project->sideber_visible=='yes') checked @endif name="sideber" value="yes"> Yes
                                 </label>
                                 <label>
                                    <input type="radio"  @if($project->sideber_visible=='no') checked @endif name="sideber"  value="no" > No
                                 </label>
                              </div>
                              
                              <div class="form-group">
                                 <input type="checkbox" id="gallery" name="gallery" />
                                 <label for="gallery">Gallery</label>
                                </div>
                              <div class="form-group">
                                 <label for=""> Short Desc </label>
                                  <textarea name="short_desc" class="form-control">{{ $project->short_desc }}</textarea>
                              </div>
                              <div class="form-group">
                                    <label for="">Is it Go Menu?</label>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" name="menu" id="inlineCheckbox1" value="1" {{$project->menu == 1 ? 'checked':''}}>
                                      <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" name="menu" id="inlineCheckbox2" value="0" {{$project->menu == 0 ? 'checked':''}}>
                                      <label class="form-check-label" for="inlineCheckbox2">No</label>
                                    </div>
                                </div>
                              <div class="form-group">
                                 <label for="">Description</label>
                                 <textarea name="description" class="form-control summernote">{{ $project->description }}</textarea>
                              </div>
                              <div class="form-group">
                                 <label for="">Order</label>
                                 <input type="number" name="order" value="{{ $project->order }}" class="form-control">
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