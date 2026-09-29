@extends('layouts.admin.master')
@section('content')
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
                           <h4 class="card-title">Images</h4>
                        </div>
                        <div class="card-body">
                           
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
     
@endsection