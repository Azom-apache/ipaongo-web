@if(Session::has('success'))
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!--{!! Session::get('success') !!}		-->
				
				<div class="alert alert-success">
				    <strong>{{session('success')}}</strong>
				</div>
			
		</div>
	</div>
@endif

@if($errors->any())
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		</div>
	</div>
@endif