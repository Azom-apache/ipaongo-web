@extends('layouts.profiles.master')
@section('content')
	  <div id="content" class="p-4 p-md-5">
	  	@include('layouts.profiles.nav')
	  	@include('layouts.admin.errors')
	  	<div class="row">
	  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  			<div class="card">
	  				<div class="card-header">
	  					Advertisememt
	  				</div>
	  				<div class="card-body">
	  					<table class="table table-bordered">
	  						<thead>
	  							<tr>
	  								<th>Sl</th>
	  								<th>Title</th>
	  								<th>Action</th>
	  							</tr>
	  						</thead>
	  						<tbody>
	  							@foreach($bikroys as $ad)
	  							@php
	  								 @$sl++;
	  							@endphp
	  							<tr>
	  								<td style="width: 5%;">{{ $sl }}</td>
	  								<td>{{ $ad->title }}</td>
	  								<td>
	  									<div class="btn-group">
	  										<a class="btn btn-warning btn-sm" href="{{ route('profile.bikroy.edit',$ad->id) }}">
	  										<i class="fa fa-edit"></i>
	  									   </a>
	  									<form action="{{ route('profile.bikroy.delete',$ad->id) }}" method="post">
	  										@csrf
	  										@method("DELETE")
	  										<button class="btn btn-danger btn-sm" onclick="return confrim('Are You Sure ?')"><i class='fa fa-trash'></i></button>

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
		
@endsection