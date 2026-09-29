<footer>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer-wiget">
                    @php
                        $setting = \App\Setting::first();    
                    @endphp
                    <img src="{{ asset('uploads/setting/'.$setting->logo) }}" style="width:100px;box-shadow: 5px 5px 10px;margin-top: 25px" class="img-fluid">
                    <address>
                        @php
                            $setting = \App\Setting::first();    
                        @endphp
                        <p> <i class="fa fa-map"></i> {{ $setting->address_1 }}    </p>
                        <p>    <i class="fa fa-envelope"></i> {{ $setting->email }}    </p>
                        <p>    <span style='font-family:"calibri",sans-serif;'><i class="fa fa-phone"></i> {{ $setting->mobile }}</span>     </p>
                    </address>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer-wiget">
                    <h3>Useful Links</h3>
                        <ul>
                            <li><a target="_blank" href="/student-login">Login</a></li>
                            <li><a target="_blank" href="/member/registration">Registration</a></li>
                            <li><a target="_blank" href="/contact-us">Contact Us</a></li>
                            <li style="color:white"><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
                            <li><span style='font-family:"calibri" ,sans-serif;color:white'><i class="fa fa-phone"></i> {{ $setting->mobile }}</span></li>
                            </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="footer-wiget">
                    <h3>Registration Video</h3>
                        <iframe width="220" height="170" src="https://www.youtube.com/embed/Ggt4fdT8ZcY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer-wiget">
                    <h3>Follow Us on Facebook</h3>
                <div class="fb-page" data-href="https://www.facebook.com/groups/4222306504463748" data-tabs="" data-width="275px" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                           <blockquote cite="https://www.facebook.com/groups/4222306504463748" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/groups/4222306504463748">Bangladesh Apparel General Manager Association</a></blockquote>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-text text-center">
     {{ env("APP_NAME") }} <i class="fa fa-copyright"></i> {{ date("Y") }} All Rights Reserved. |  Developed By  <a href="https://uttarainfotech.com">Uttara</a> <a href="https://uit.com.bd"> Info Tech </a> 
    </div>
</footer>

    <script src="{{ asset('web/js/jquery.min.js')}}"></script>
    <script src="{{ asset('web/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('web/js/jquery.fancybox.min.js') }} "></script>
    <script type="text/javascript">
          $(document).ready(function(){
          $('ul li a').click(function(){
            $('li a').removeClass("active");
            $(this).addClass("active");
          });
        });
    </script>
    @stack('js')
</body>
</html>

<!--<div class="footer" style="background-image: url({{asset('images/background/37.jpg')}});">-->
<div class="footer" style="background: #02CCFF;">
		<div class="content-wrap">
			<div class="container footer-start">

				<div class="row">
					<div class="col-sm-3 col-md-3">
                            <div class="footer-item">
							    <div class="footer-title">About Us</div>
							</div>
							@php
								$subabout = \App\Page::whereIn('id', [4,5,6,7,9])->limit('8')->get();
							@endphp
							@foreach($subabout AS $item)
							<div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:500; font-weight:bold;" href="{{route('page', [$item->id, $item->slug])}}">{{$item->title}}</a>
							</div>

							@endforeach
							
							<div style="margin-top:20px;">
							    <a href="https://info.flagcounter.com/tFho"><img src="https://s01.flagcounter.com/count2/tFho/bg_FFFFFF/txt_000000/border_CCCCCC/columns_3/maxflags_20/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
							</div>
					    <!--<iframe width="100%" height="auto" src="https://www.youtube.com/embed/JsW3pJw9PoI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
					    {{--
						<!--<div class="footer-item">-->
						<!--    <div class="text-center">-->
						<!--        <img src="{{asset('images/logo.png')}}" alt="logo bottom" class="logo-bottom">-->
						<!--    </div>-->
						<!--	<div class="spacer-30"></div>-->
						<!--	<h3>Vision of IPAO</h3>-->
						<!--<p class="one-footer-part">-->
						<!--Offering a helping hand to people in need.-->
						<!--</p>-->
						<!--<h3>Mission of IPAO</h3>-->
						<!--<p class="one-footer-part">-->
						<!--To alleviate human suffering, encourage people to reach their destiny, support for well being, try to change their lives and serves all people regardless of race, religion and gender.-->
						<!--</p>-->
						<!--</div>-->
						--}}
					</div>

					<div class="col-sm-3 col-md-3">
						<div class="footer-item">
							<div class="footer-title">
                            Our Work
							</div>

							<div class="row">
								<div class="col-sm-12 col-md-12">
								    @php
										$gparent = \App\Project::where('parent', 0)->where('order','!=',0)->orderBy('order','asc')->limit('8')->get();
								    @endphp
									@foreach($gparent AS $item)
									<div>
        							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('project',[$item->id, $item->slug])}}">{{$item->title}}</a>
        							</div>
									@endforeach
									<!--<ul class="list">-->
									<!--	<li><a href="{{route('blood.doner.list')}}" title="Blood Doner"><i class="fa fa-angle-right"></i> Blood Doner </a></li>-->
									{{--
										<!--<li><a href="{{route('dedicated.volunteer')}}" title="Dedicateed Volenter"><i class="fa fa-angle-right"></i> Dedicateed Volenter</a></li>-->
										<!--<li><a href="{{route('area.volunter')}}" title="Area Volunter"><i class="fa fa-angle-right"></i> Area Volunter</a></li>-->
										<!--<li><a href="{{route('districs.ambasador')}}" title="Districs Ambasador"><i class="fa fa-angle-right"></i> Districs Ambasador</a></li>-->
										<!--<li><a href="{{route('campus')}}" title="Campus"><i class="fa fa-angle-right"></i> Campus</a></li>-->
									--}}
									<!--</ul>-->
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-3 col-md-3">
						<div class="footer-item">
							<div class="footer-title">
								Get Involved
							</div>
							<div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('blood.doner')}}">Donate Blood</a>
							</div>
							<div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{ route('blood.doner.list')}}">Take Blood</a>
							</div>
							<div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('blood.doner')}}">Be a Volunteer</a>
							</div>
							<div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{ route('blood.volunteer.list')}}">Volunteer</a>
							</div>
							<!--<ul class="list-info">-->

							<!--	<li>-->
							<!--		<div class="info-icon">-->
							<!--			<span class="fa fa-map-marker"></span>-->
							<!--		</div>-->
       <!--                             
       <!--                         </li>-->

							<!--	<li>-->
							<!--		<div class="info-icon">-->
							<!--			<span class="fa fa-phone"></span>-->
							<!--		</div>-->
							<!--		<div class="info-text">+880 1874-041113</div>-->
       <!--                         </li>-->

							<!--	<li>-->
							<!--		<div class="info-icon">-->
							<!--			<span class="fa fa-envelope"></span>-->
							<!--		</div>-->
							<!--		<div class="info-text">info@ipaongo.org </div>-->
       <!--                         </li>-->

       <!--                         <li>-->
							<!--		<div class="info-icon">-->
							<!--			<span class="fa fa-globe"></span>-->
							<!--		</div>-->
       <!--                             <div class="info-text">ipaongo.org</div>-->
       <!--                         </li>-->

							<!--</ul>-->

						</div>
					</div>

					<div class="col-sm-3 col-md-3">
						<div class="footer-item">
							<div class="footer-title">
								Media
							</div>
                            <div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('all.member')}}">Media Coverage</a>
							</div>
                            <div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('news')}}">News and Event</a>
							</div>
                            <div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('area.volunter')}}">Bulletin</a>
							</div>
                            <div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('gallery')}}">Photo Galllery</a>
							</div>
                            <div>
							    <a style="color:#F2F2F2; padding:8px 0px; font-size:15px; font-weight:600;" href="{{route('show.video')}}">Video Gallery</a>
							</div>
							<!--<div class="sosmed-icon primary">-->
       <!--                         <div id="fb-root"></div>-->
       <!--                             <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v11.0&appId=413376036014381&autoLogAppEvents=1" nonce="7JcOi75e"></script>-->
       <!--                         <div class="fb-page" data-href="https://www.facebook.com/ipaongobd" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/ipaongobd" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ipaongobd">IPAO</a></blockquote>-->
       <!--                         </div>-->
							<!--</div>-->
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
					<!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
		<div class="br"></div>

		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
					    @php
    						$setting = \App\Helpers\Website::setting();
    					@endphp
    					<div class="info-icon info-text" style="margin-bottom:10px; color:#fff;text-aling:center; display:flex;justify-content:center; font-weight:600;">
							<span style="margin:5px 10px;" class="fa fa-map-marker"></span>@if($setting) {{ $setting->address_1 }} @endif ,
							<span style="margin:5px 10px;" class="fa fa-phone"></span>@if($setting) {{ $setting->mobile }} @endif ,
							<span style="margin:5px 10px;" class="fa fa-envelope"></span>@if($setting) {{ $setting->email }} @endif 
						</div>
						<!--<p class="ftex one-footer-part">Copyright {{date('Y')}} &copy; <span class="color-primary">ipaongo</span>. Developed by-->
						<!--<a style="margin-left:4px;" href="https://www.uttarainfotech.com/" target="_new" > Uttara</a><a href="http://uit.com.bd/" target="_new"> Infotech</a>-->
						<!--</p>-->
					</div>
				</div>
			</div>
		</div>


		<div class="br"></div>
	
		<div class="fcopy">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p style="color:#fff;" class="ftex one-footer-part"> &copy; {{date('Y')}} All rights reserved by ipaongo
						<!--<a style="margin-left:4px;" href="https://www.uttarainfotech.com/" target="_new" > Uttara</a><a href="http://uit.com.bd/" target="_new"> Infotech</a>-->
						</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--End pagewrapper-->
 
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>

<!--facebook messanger plugin START -->
<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "101587602150119");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
<!--facebook messanger plugin END-->

 <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "101587602150119");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
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



<!-- New Slider Script -->
<script>
 const slides=document.querySelector(".slider").children;
 const prev=document.querySelector(".prev");
 const next=document.querySelector(".next");
 const indicator=document.querySelector(".indicator");
 let index=0;


   prev.addEventListener("click",function(){
       prevSlide();
       updateCircleIndicator(); 
       resetTimer();
   })

   next.addEventListener("click",function(){
      nextSlide(); 
      updateCircleIndicator();
      resetTimer();
      
   })

   // create circle indicators
    function circleIndicator(){
        for(let i=0; i< slides.length; i++){
        	const div=document.createElement("div");
        	      div.innerHTML=i+1;
                div.setAttribute("onclick","indicateSlide(this)")
                div.id=i;
                if(i==0){
                	div.className="active";
                }
               indicator.appendChild(div);
        }
    }
    circleIndicator();

    function indicateSlide(element){
         index=element.id;
         changeSlide();
         updateCircleIndicator();
         resetTimer();
    }
     
    function updateCircleIndicator(){
    	for(let i=0; i<indicator.children.length; i++){
    		indicator.children[i].classList.remove("active");
    	}
    	indicator.children[index].classList.add("active");
    }

   function prevSlide(){
   	 if(index==0){
   	 	index=slides.length-1;
   	 }
   	 else{
   	 	index--;
   	 }
   	 changeSlide();
   }

   function nextSlide(){
      if(index==slides.length-1){
      	index=0;
      }
      else{
      	index++;
      }
      changeSlide();
   }

   function changeSlide(){
   	       for(let i=0; i<slides.length; i++){
   	       	 slides[i].classList.remove("active");
   	       }

       slides[index].classList.add("active");
   }

   function resetTimer(){
   	  // when click to indicator or controls button 
   	  // stop timer 
   	  clearInterval(timer);
   	  // then started again timer
   	  timer=setInterval(autoPlay,4000);
   }
 
  
  function autoPlay(){
      nextSlide();
      updateCircleIndicator();
  }

  let timer=setInterval(autoPlay,4000);

</script>

<script>
$("#sticky-headerLogo").hover(function () {
    $('.logo-show').show('slow');
}, function () {
    $('.logo-show').hide('slow');
});
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
$(document).ready(function(){
     $("#ParentCat").change(function(){
        var parent = $(this).val();
        if(parent){
        jQuery.ajax({
			type:'GET',
            dataType: 'JSON',
			data:'id='+parent,
			url:"{{route('subcategory.donate')}}",
			success:function(response){
			//console.log(response);
			    if(response){
                    $('select[name="subcat"]').empty();
                    $('#SubCategory').append('<option value="">-- Select Project --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="subcat"]').append('<option value="'+ value.id +'">' + value.title+ '</option>');
                        });
    			    }else{
                        $('#ResultShow').empty();
                    }
			    }
            });
        }else{
              $('#city').empty();
        }
    });
    
    $("#SubCategory").change(function(){
        var subcat = $(this).val();
        jQuery.ajax({
            type:'GET',
            data:'subcat='+subcat,
            url:"{{route('subcategory.donate')}}",
            success:function(data){
                //jQuery('#SubSubCategory').html(data);
                //jQuery('#ResultShow').multiselect('multiselect');
                if(data){
                    $('select[name="subsubcat"]').empty();
                    $('#subsubCategory').append('<option value="">-- Select Project --</option>');
                    $.each(data, function(key, value) {
                        $('select[name="subsubcat"]').append('<option value="'+ value.id +'">' + value.title+ '</option>');
                    });
                }
            }
        });
    });
    $("#subsubCategory").change(function(){
        var price = $(this).val();
        jQuery.ajax({
            type:'GET',
            data:'price='+price,
            url:"{{route('subcategory.donate')}}",
            success:function(data){
                jQuery("#budget").val(data);
            }
        });
    });
    $("#quantity").keyup(function(){
    var qty = $(this).val();
    var budget = $("#budget").val();
    $("#usd").val(qty * budget);
      
    });
    
    $("#Divisions").change(function(){
        var parent = $(this).val();
        if(parent){
        jQuery.ajax({
			type:'GET',
            dataType: 'JSON',
			data:'id='+parent,
			url:"{{route('districts.list')}}",
			success:function(response){
			console.log(response);
			    if(response){
                    $('select[name="district"]').empty();
                    $('#District').append('<option value="">-- Select District --</option>');
                        $.each(response, function(key, value) {
                            $('select[name="district"]').append('<option value="'+ value.id +'">' + value.name + '</option>');
                        });
    			    }else{
                        $('#ResultShow').empty();
                    }
			    }
            });
        }else{
              $('#city').empty();
        }
    });
    
    $("#District").change(function(){
        var district = $(this).val();
        jQuery.ajax({
            type:'GET',
            data:'district='+district,
            url:"{{route('districts.list')}}",
            success:function(data){
                if(data){
                    $('select[name="upazila"]').empty();
                    $('#UpaZilla').append('<option value="">-- Select Upazilla --</option>');
                    $.each(data, function(key, value) {
                        $('select[name="upazila"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
                    });
                }
            }
        });
    });
    
//     $("#Divisions").change(function(){
//         var division = $(this).val();
//         if(division){
//         jQuery.ajax({
// 			type:'GET',
//             dataType:'JSON',
// 			data:'id='+division,
// 			url:"{{route('districts.list')}}",
// 			success:function(response){
// 			//console.log(response);
// 			    if(response){
//                     $('select[name="district"]').empty();
//                     $('#District').append('<option value="">-- Select Project --</option>');
//                         $.each(response, function(key, value) {
//                             $('select[name="thana"]').append('<option value="'+ value.id +'">' + value.name+ '</option>');
//                         });
//     			    }else{
//                          $('#ResultShow').empty();
//                     }
// 			    }
//             });
//         }else{
//               $('#city').empty();
//         }
//     });
});
</script>


</body>
</html>