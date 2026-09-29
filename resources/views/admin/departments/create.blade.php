@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Departments</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Departments</li>
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
                           <h4 class="card-title">
                                 Add Department
                           </h4>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('dashboard.departments.store') }}" method="post">
                              @csrf
                              <div class="form-group">
                                 <label for="">Department Name</label>
                                 <input type="text" required="" name="department_name" class="form-control">
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
                           <h4 class="card-title">Departments</h4>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>Sl</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($departments as $department)
                                 @php
                                    @$sl++;
                                 @endphp
                                 <tr>
                                    <td style="width: 5%;">{{ $sl }}</td>
                                    <td>{{ $department->department_name }}</td>
                                    <td>
                                       <div class="btn-group">
                                          <a class="btn btn-warning btn-sm rounded-0" href="{{ route('dashboard.departments.edit',$department->id) }}">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                          <form method="post" action="{{ route('dashboard.departments.destroy',$department->id) }}">
                                             @csrf                                           
                                             @method("DELETE")
                                             <button class="btn btn-danger rounded-0" onclick="return confirm('Are You sure >')"><i class="fa fa-trash"></i></button>
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
     
@endsection