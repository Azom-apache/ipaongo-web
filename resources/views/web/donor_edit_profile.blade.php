<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="IQlNkHu9nvTU8jtJVcSJhFHhhUQfmiCoA2KWacYQ">

<title>{{config('app.name')}}</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="{{asset('plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="{{asset('plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/responsive.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://uddokta.tripleoneair.com/js/respond.js"></script><![endif]-->
</head>
<style>
    .nav-item a{
        font-weight:bold;
        color:#fff;
        font-size:17px;
    }
</style>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    {{--<div class="preloader"></div>--}}

    <!-- Main Header-->
    @include('layouts.web.header')
	<section class="video-section">
		<div class="auto-container" style="width:70%">
			<div class="sec-title">
					 <h2 class="text-center">{{__('Welcome')}} {{$person_info->name}}</h2>
			</div>
			@include('layouts.admin.errors')
			<div class="row clearfix">
				<!-- Content Column -->
				<div class="content-column col-md-4 col-sm-12 col-xs-12">
					<ul class="nav flex-column" style="background-color:#02CCFF;">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('donor_edit_profile')}}/{{$person_info->id}}">Edit Your Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{url('donor_pas_change')}}/{{$person_info->id}}">Password Change</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" tabindex="-1" aria-disabled="true">Logout</a>
                                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                      </li>
                    </ul>
				</div>
				<div class="content-column col-md-8 col-sm-12 col-xs-12">
				    <h4>Change Your Profile</h4><br>
				    <h5 class="text-danger">{!! Session::get('error') !!}</h5>
					<form class="form-horizontal" method="post" action="{{url('donor_edit_post')}}" style="height: auto !important;" enctype="multipart/form-data">
                		
                            @csrf
                            
                			<div class="row">
                				<div class="col-sm-6" style="padding-right:20px; padding-left:20px;">
                				    
                                    <div class="form-group">
                        				<label for="name" class="cols-sm-2 control-label">Member Type :</label>
                        				<div class="cols-sm-10">
                        					<div class="input-group">
                        					    <input type="hidden" name="id" value="{{$person_info->id}}"/>
                        						<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        						<select name="membertype" id="Member" required="required" class="form-control">
                        							<option value=" "> --Member Type-- </option>
                        							<option value="donor" {{$person_info->member_type=='donor'?'selected':''}}> Donor </option>
                        							<option value="volunteer" {{$person_info->member_type=='volunteer'?'selected':''}}> Volunteer </option>
                        						</select>
                        					</div>
                        				</div>
                        			</div>
                        			
                        			<div class="form-group">
                                      <label for="name" class="cols-sm-2 control-label">Full Name:</label>
                                      <div class="cols-sm-6">
                                        <div class="input-group">
                                          <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                          <input value="{{$person_info->name}}" type="text" name="name" class="name form-control" id="name" placeholder="Full Name*" required="required">
                                        </div>
                                      </div>
                                    </div>
                        
                        			<div class="form-group">
                                      <label for="mobile" class="cols-sm-2 control-label">Moble:</label>
                                      <div class="cols-sm-10">
                                        <div class="input-group">
                                          <span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                          <input value="{{$person_info->mobile}}" type="text" name="mobile" class="name form-control" id="mobile" placeholder="Mobile*" required="required">
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <div class="form-group">
                						<label for="name" class="cols-sm-2 control-label">Divisions :</label>
                						<div class="cols-sm-10">
                							<div class="input-group">
                								<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                								<select name="division" id="Divisions" required="required" class="form-control">
                									<option value=" "> --Divisions-- </option>
                									<option value="1" {{$person_info->division==1?'selected':''}}> Chattagram </option>
                									<option value="2" {{$person_info->division==2?'selected':''}}> Rajshahi </option>
                									<option value="3" {{$person_info->division==3?'selected':''}}> Khulna </option>
                									<option value="4" {{$person_info->division==4?'selected':''}}> Barisal </option>
                									<option value="5" {{$person_info->division==5?'selected':''}}> Sylhet </option>
                									<option value="6" {{$person_info->division==6?'selected':''}}> Dhaka </option>
                									<option value="7" {{$person_info->division==7?'selected':''}}> Rangpur </option>
                									<option value="8" {{$person_info->division==8?'selected':''}}> Mymensingh </option>
                                                    
                								</select>
                							</div>
                						</div>
                					</div>
                					
                				    <div class="form-group" id="ResultShow">
                						<label for="name" class="cols-sm-2 control-label">Districts :</label>
                						<div class="cols-sm-10">
                							<div class="input-group">
                								<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                								<select id="District" name="district" required="required" class="form-control">
                									<option value="{{$person_info->district}}"> --Districts-- </option>
                								</select>
                							</div>
                						</div>
                					</div>
                					
                				    <div class="form-group" id="ResultShow">
                						<label for="name" class="cols-sm-2 control-label">Upazilla :</label>
                						<div class="cols-sm-10">
                							<div class="input-group">
                								<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                								<select id="UpaZilla" name="upazila" required="required" class="form-control">
                									<option value="{{$person_info->upazila}}"> --Upazilla-- </option>
                								</select>
                							</div>
                						</div>
                					</div>
                					
                                </div>
                			
                			
                			    <div class="col-sm-6" style="padding-right:20px; padding-left:20px;">
                			        
                    			    <div class="form-group">
                    					<label for="blood_group" class="cols-sm-2 control-label">Blood group:</label>
                    					<div class="cols-sm-10">
                    						<div class="input-group">
                    							<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    							<select name="blood_group" class="form-control">
                    								<option value="position">--Blood group--</option>
                    								<option value="A+" {{$person_info->blood_group=='A+'?'selected':''}}>A+</option>
                    								<option value="A-" {{$person_info->blood_group=='A-'?'selected':''}}>A-</option>
                    								<option value="B+" {{$person_info->blood_group=='B+'?'selected':''}}>B+</option>
                    								<option value="B-" {{$person_info->blood_group=='B-'?'selected':''}}>B-</option>
                    								<option value="O+" {{$person_info->blood_group=='O+'?'selected':''}}>O+</option>
                    								<option value="O-" {{$person_info->blood_group=='O-'?'selected':''}}>O-</option>
                    								<option value="AB+" {{$person_info->blood_group=='AB+'?'selected':''}}>AB+</option>
                    								<option value="AB-" {{$person_info->blood_group=='AB-'?'selected':''}}>AB-</option>
                    							</select>
                    						</div>
                    					</div>
                    				</div>
                                    
                    				<div class="form-group">
                    					<label for="email" class="cols-sm-2 control-label">Email:</label>
                    					<div class="cols-sm-10">
                    						<div class="input-group">
                    							<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    							<input value="{{$person_info->email}}" type="email" name="email" class="name form-control" id="email" placeholder="Email*" >
                    						</div>
                    					</div>
                    				</div>
                    			        
                    		        <div class="form-group">
                    					<label for="name" class="cols-sm-2 control-label">Gender:</label>
                    					<div class="cols-sm-10">
                    						<div class="input-group">
                    							<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    							<select name="gender" class="form-control">
                    								<option value="">Gender</option>
                    								<option value="Male" {{$person_info->gender=='Male'?'selected':''}}>Male</option>
                    								<option value="Female" {{$person_info->gender=='Female'?'selected':''}}>Female</option>
                    								<option value="Others" {{$person_info->gender=='Others'?'selected':''}}>Others</option>
                    							</select>
                    						</div>
                    					</div>
                    				</div>
                    				
                    			    <div class="form-group">
                    					<label for="dob" class="cols-sm-2 control-label">Birth Date:</label>
                    					<div class="cols-sm-10">
                    						<div class="input-group">
                    							<span class="input-group-addon iconbk"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    							<input value="{{$person_info->dob}}" name="dob" id="datepicker" placeholder="DD-MM-YYYY" class="textbox-n form-control" type="text" required="">
                    						</div>
                    					</div>
                    				</div>	
                    				
                    		        <div class="form-group">
                    					<label for="file" class="cols-sm-2 control-label">File:</label>
                    					<div class="cols-sm-10">
                    						<div class="input-group">
                    							<span class="input-group-addon iconbk"><i class="fa fa-file fa-lg " aria-hidden="true"></i></span>
                    							<input type="file" name="image" class="form-control" id="Pwd" placeholder="file" />
                    						</div>
                    						<div class="mt-2">
                    						    <img src="{{asset('uploads/project')}}/{{$person_info->image}}" width="100px;"/>
                    						</div>
                    					</div>
                    				</div>
                    				
                				</div>
                			</div>
                
                			<div class="form-group ">
                			  <button type="submit" class="btn btn-success btn-lg btn-block login-button">Update</button>
                			</div>
                		
                			
                          </form>
				</div>
			</div>
		</div>
	</section>
<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Revolution Slider-->
<script src="{{asset('plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{asset('js/main-slider-script.js')}}"></script>
<!--End Revolution Slider-->
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.js')}}"></script>
<script src="{{asset('js/owl.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/knob.js')}}"></script>
<script src="{{asset('js/appear.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>