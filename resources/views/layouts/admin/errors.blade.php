@if(Session::has('error'))
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="alert alert-danger" style="background:#fef2f2;color:#991b1b;padding:12px 16px;border-radius:6px;margin-bottom:16px;">
				<strong>{{ session('error') }}</strong>
			</div>
		</div>
	</div>
@endif

@if(Session::has('success'))
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!--{!! Session::get('success') !!}		-->
				
				<div class="alert alert-success" style="background:#f0fdf4;color:#166534;padding:12px 16px;border-radius:6px;margin-bottom:16px;">
				    <strong>{{session('success')}}</strong>
				</div>
			
		</div>
	</div>
@endif

@if($errors->any())
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    <div class="alert alert-danger" style="background:#fef2f2;color:#991b1b;padding:12px 16px;border-radius:6px;margin-bottom:16px;">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		</div>
	</div>
@endif