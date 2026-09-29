@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Gallery</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">All gallery photo</li>
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
                           <h4 class="card-title">Guallery</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>Sl</th>
									<th> Title </th>
                                    <th>image</th>
                                   
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($gallerys AS $gallery)

                                 <tr>
                                    <td style="width: 5%;"></td>
									<td>{{$gallery->title}}</td>
                                    <td><img src="{{ asset('uploads/project/'.$gallery->image) }}" width="25%" /></td>
                                   
                                    <td>
                                       <div class="btn-group">
								
										  <a class="btn btn-warning btn-sm rounded-0" href="{{ route('dashboard.galleries.edit',$gallery->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
										
										  
                                          <form action="{{ route('dashboard.galleries.destroy',$gallery->id) }}" method="post" >
                                             @csrf
                                             @method("DELETE")
                                             <button onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm rounded-0">
                                                <i class="fa fa-trash"></i>
                                             </button>
                                          </form>
										  
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                              <tfoot>
                                 <tr>
								 <th colspan="4">{{ $gallerys->links() }}</th>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
     
@endsection