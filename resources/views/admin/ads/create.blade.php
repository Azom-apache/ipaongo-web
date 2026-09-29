@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Manage Ad</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ads</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-4">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Ads</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.ads.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group">
                                 <label for="">Type</label><br>
                                 <label><input checked type="radio" onchange="changeField(this.value)" name="type" value="1"> Image </label>
                                 <label><input type="radio" onchange="changeField(this.value)" name="type" value="2"> Code </label>
                              </div>

                              <div class="form-group">
                                 <label for="">Area</label>
                                 <input type="text" name="area" class="form-control">
                              </div>

                              <div id="ad" class="form-group">
                                 <label>Image</label><br>
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
    <script>
       function changeField(fieldValue){
         alert(fieldValue)
         if(fieldValue == 1){
            document.getElementById('ad').innerHTML='<label>Image</label><input type="file" name="image">';
         }else{
             document.getElementById('ad').innerHTML='<label>Code</label><textarea class="form-control" name="code"></textarea>';
         }

       }
    </script> 
@endsection