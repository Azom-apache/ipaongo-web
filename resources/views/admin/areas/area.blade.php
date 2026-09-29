@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Area</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Area</li>
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
                           <h4 class="card-title">Area</h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.area.store') }}" method="post">
                              @csrf
                              <div class="form-group">
                                 <label for="">Area</label>
                                 <input type="text" required="" name="area" class="form-control">
                              </div>
                              <div class="form-group">
                                 <label for="">District</label>
                                 <select name="district_id" required id="" class="form-control">
                                    <option value="" disabled="" selected=""> Select District </option>
                                    @foreach($districts as $district)
                                       <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="form-group">
                                 <button class="btn btn-success">
                                    Submit
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>

                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Area</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th style="width: 5%">Sl</th>
                                    <th>Area</th>
                                    <th>District</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($arieas as  $area)
                                 @php
                                    @$sl++;
                                 @endphp
                                 <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $area->area }}</td>
                                    <td>{{ $area->district->district_name }}</td>
                                    <td>
                                       <div class="btn-group">
                                          <a data-toggle="modal" data-target="#editModal" href="javascript:void(0)" onclick="edit({{ $area->id }})" class="btn btn-warning btn-sm rounded-0">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form action="{{ route('dashboard.area.destroy',$area->id) }}" method="post">
                                             @csrf
                                             @method("DELETE")
                                             <button class="btn btn-danger btn-sm rounded-0" type="submit" onclick="return confirm('Are You sure ?')">
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
        <h5 class="modal-title">Edit Area</h5>
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
      function edit(area_id){
          var xhttp = new XMLHttpRequest();
           xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
              document.getElementById("ajax_data").innerHTML = this.responseText;
             }
           };
           xhttp.open("GET", "{{ route('dashboard.area.edit') }}?area="+area_id, true);
           xhttp.send();
      }
   </script>
@endsection