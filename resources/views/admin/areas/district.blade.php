@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Area</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">District</li>
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
                           <h4 class="card-title">Images</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.area.district.store') }}" method="post">
                              @csrf

                              <div class="form-group">
                                 <label for="">District Name</label>
                                 <input type="text" required="" name="district_name" class="form-control">
                              </div>
                              <div class="form-group">
                                 <button class="btn btn-success">Submit</button>
                              </div>
                           </form>
                        </div>
                     </div>

                  </div>

                  <div class="col-lg-4">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">All Districts</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>SL</th>
                                    <th>District Name</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($districts as $district)
                                 @php
                                    @$sl++; 
                                 @endphp
                                 <tr>
                                    <td style="width: 5%;">{{ $sl }}</td>
                                    <td>{{ $district->district_name }}</td>
                                    <td>
                                       <div class="btn-group">
                                          <a data-toggle="modal" data-target="#editModal" class="btn btn-warning btn-sm rounded-0" onclick="edit({{ $district->id }})" href="javascript:void(0)">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.area.district.delete',$district->id) }}" method="post">
                                             @csrf
                                             @method("DELETE")
                                             <button class="btn btn-danger rounded-0" onclick="return confirm('Are You sure ?')">
                                                <i class="fa fa-trash"></i>
                                             </button>
                                          </form>
                                         </div>
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>

<div class="modal" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit District</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="ajax_data">
        



      </div>
     
    </div>
  </div>
</div>  
<script>
   function edit(district_id){
      var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
        document.getElementById("ajax_data").innerHTML = this.responseText;
       }
     };
     xhttp.open("GET", "{{ route('dashboard.area.district.ajaxDistrict') }}?district="+district_id, true);
     xhttp.send();
   }
</script>
@endsection