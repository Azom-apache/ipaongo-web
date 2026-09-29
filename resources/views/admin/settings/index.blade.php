@extends('layouts.admin.master')
@section('content')
   @push('page_info')
      <h5 class="mb-0">Settings</h5>
      <nav aria-label="breadcrumb">
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Setting</li>
         </ul>
      </nav>
   @endpush
     
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               @include('layouts.admin.errors')
               
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="card-header">
                          <h5 class="card-title">Setting</h5>
                       </div>
                       <div class="card-body">
                           <form action="{{ route('dashboard.settings.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              {{--
                              <fieldset class="border p-3">
                                 <legend>Website Information</legend>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Website Title</label>
                                          <input value="@if($setting) {{ $setting->site_title }} @endif" type="text" required="" name="site_title" class="form-control">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Domain Name</label>
                                          <input value="@if($setting) {{ $setting->domain_name }} @endif" type="text" required="" name="domain_name" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                              </fieldset> 
                              --}}
                               <fieldset class="border p-3">
                                 <legend>Contact Information</legend>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Address </label>
                                          <input type="text" value="@if($setting) {{ $setting->address_1 }} @endif" class="form-control" name="address_1">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Alternative Address</label>
                                          <input type="text" value="@if($setting) {{ $setting->address_2 }} @endif" class="form-control" name="address_2">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Email</label>
                                          <input value="@if($setting) {{ $setting->email }} @endif" type="email" class="form-control" name="email">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Contact Us Email</label>
                                          <input value="@if($setting) {{ $setting->contact_email }} @endif" type="text" class="form-control" name="contact_email">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Mobile</label>
                                          <input value="@if($setting) {{ $setting->mobile }} @endif" type="text" class="form-control" name="mobile">
                                       </div>
                                    </div>  
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Alternative Mobile</label>
                                          <input value="@if($setting) {{ $setting->mobile_2 }} @endif" type="text" class="form-control" name="mobile_2">
                                       </div>
                                    </div>  
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Map (Url)</label>
                                          <input value="@if($setting) {{ $setting->map }} @endif" type="text" class="form-control" name="map">
                                       </div>
                                    </div>                                    
                                 </div>
                              </fieldset>
                             <fieldset class="border p-3">
                                 <legend>Social Links</legend>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Facebook</label>
                                       <input value="@if($setting) {{ $setting->facebook }} @endif" type="text" required="" name="facebook" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Youtube</label>
                                       <input value="@if($setting) {{ $setting->youtube }} @endif" type="text" required="" name="youtube" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Twitter</label>
                                       <input value="@if($setting) {{ $setting->twitter }} @endif" type="text" required="" name="twitter" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Linkedin</label>
                                       <input value="@if($setting) {{ $setting->linkedin }} @endif" type="text" required="" name="linkedin" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Instagram</label>
                                       <input value="@if($setting) {{ $setting->instagram }} @endif" type="text" required="" name="instagram" class="form-control">
                                    </div>
                                 </div>
                              </fieldset>
                             <fieldset class="border p-3">
                                 <legend>Project, Food, Cloth, Other</legend>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Successfull Project</label>
                                       <input value="@if($setting) {{ $setting->successfull_project }} @endif" type="text" required="" name="successfull_project" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">People Impact</label>
                                       <input value="@if($setting) {{ $setting->people_impact }} @endif" type="text" required="" name="people_impact" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Money Donate</label>
                                       <input value="@if($setting) {{ $setting->money_donate }} @endif" type="text" required="" name="money_donate" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Total Volunteer</label>
                                       <input value="@if($setting) {{ $setting->total_volunteer }} @endif" type="text" required="" name="total_volunteer" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Food</label>
                                       <input value="@if($setting) {{ $setting->food }} @endif" type="text" required="" name="food" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Cloth</label>
                                       <input value="@if($setting) {{ $setting->cloth }} @endif" type="text" required="" name="cloth" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                       <label for="">Other</label>
                                       <input value="@if($setting) {{ $setting->other }} @endif" type="text" required="" name="other" class="form-control">
                                    </div>
                                 </div>
                              </fieldset>
                              
                               <fieldset class="border p-3">
                                 <legend>Logo & Favicon</legend>
                                 <div class="row">
                                    <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Logo</label><br>
                                          <input type="file" name="logo" >
                                          <input type="hidden" name="old_logo" value="@if($setting) {{ $setting->logo }} @endif">
                                       </div>
                                    </div>
                                    <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Favicon</label><br>
                                          <input type="file" name="favicon" >
                                          <input type="hidden" name="old_favicon" value="@if($setting) {{ $setting->favicon }} @endif" >
                                       </div>
                                    </div>
                                 </div>
                              </fieldset>
                              
                               <fieldset class="border p-3">
                                 <legend>Home Page Welcome Message</legend>
                                  <div class="row">
                                    <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Welcome Message Title</label>
                                          <input type="text" class="form-control" name="welcome_title" @if($setting) value="{{ $setting->welcome_title }}" @endif>
                                       </div>
                                    </div>
                                    <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                                       <div class="form-group">
                                          <label for="">Welcome Message Title</label>
                                          <textarea name="welcome_message" class="form-control">@if($setting){{ $setting->welcome_message }} @endif</textarea>
                                       </div>
                                    </div>
                              </fieldset>
                             
                              <div class="row mt-4">
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                       <button class="btn btn-success btn-lg">Submit</button>
                                    </div>
                                 </div>
                              </div>

                           </form>
                       </div>
                    </div>
                  </div>
               </div>
            </div>
         </div>

     
@endsection