	@php
		$profile = \App\Profile::where('id',Session::get('id'))->first();
	@endphp
	<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url({{ asset('uploads/profiles/'.$profile->image) }});"></a>
	        <ul class="list-unstyled components mb-5">
	         
	          <li>
	            <a href="/">Back to website</a>
	          </li>
	         
	          <li>
	            <a href="{{ route('profile.index') }}">Home</a>
	          </li>

	          <li>
	            <a href="{{ route('profile.myProfile') }}">My Profile</a>
	          </li>
				<li>
					<a href="#jobMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Jobs</a>
					<ul class="collapse list-unstyled" id="jobMenu">
						<li>
							<a href="{{ route('profile.jobs.create') }}">Add jobs</a>
						</li>
						<li>
							<a href="{{ route('profile.jobs.index') }}">All Jobs</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#blogMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Blogs</a>
					<ul class="collapse list-unstyled" id="blogMenu">
						<li>
							<a href="{{ route('profile.blogs.create') }}">Add Blog</a>
						</li>
						<li>
							<a href="{{ route('profile.blogs.index') }}">All Blog</a>
						</li>
					</ul>
				</li>


				<li>
					<a href="#bikroyMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Buy & Sale</a>
					<ul class="collapse list-unstyled" id="bikroyMenu">
						<li>
							<a href="{{ route('profile.bikroy.create') }}">Add Buy Sale</a>
						</li>
						<li>
							<a href="{{ route('profile.bikroy.index') }}">All Buy Sale</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="#adsMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">I need Job</a>
					<ul class="collapse list-unstyled" id="adsMenu">
						<li>
							<a href="{{ route('profile.advertisement.create') }}">Add new</a>
						</li>
						<li>
							<a href="{{ route('profile.advertisement.index') }}">View All</a>
						</li>
					</ul>
				</li>
	          <li>
	              <a href="#" id="logout" >Logout</a>
	          </li>
	          <li>
	        </ul>

	        <div class="footer">
	        	<p>
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="icon-heart" aria-hidden="true"></i>  by  <a href="https://uttarainfotech.com" target="_blank">Uttara </a> <a href="https://uit.com.bd"> Infotech </a></a></p>
	        </div>

	      </div>
    	</nav>
    	<form action='{{ route('profile.logout') }}' id="logoutForm" method="post">
    		@csrf
    	</form>
    	@push('js')
    		<script>
    			$("#logout").click(function(){
    				$("#logoutForm").submit();  				
    			});
    		</script>
    	@endpush