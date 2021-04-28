@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
	<div class="col-md-8 ">
	<div class="card">
	<div class="card-header">Edit Details</div>
		@if ($errors->any())
		<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
		</div>
		<br />
		@endif
		@if (\Session::has('success'))
		<div class="alert alert-success">
			<p>{{ \Session::get('success') }}</p>
		</div><br />
		@endif
		<div class="card-body">
		<!-- Form to edit certain user details -->
		<form class="form-horizontal" method="POST" action="{{ action('HomeController@update',
		$users['id']) }} " enctype="multipart/form-data" >
		@method('PATCH')
		@csrf
		<div class="col-md-8">
			<label>First Name</label>
			<input type="text" name="firstName" value="{{$users->firstName}}"/>
		</div>
		<div class="col-md-8">
			<label>Last Name</label>
			<input type="text" name="lastName" value="{{$users->lastName}}" />
		</div>
		<div class="col-md-8">
			<label>Address</label>
			<input type="text" name="address" value="{{$users->address}}" />
		</div>
		<div class="col-md-8">
			<label>Postcode</label>
			<input type="text" name="postcode" value="{{$users->postcode}}" />
		</div>
		<div class="col-md-6 col-md-offset-4">
			<input type="submit" class="btn btn-primary" />
			<input type="reset" class="btn btn-primary" />
			<a href="{{ route('home')}}" class="btn btn-primary">Close</a>
			</a>
		</div>
		</form>
	</div>
	</div>
	</div>
	</div>
</div>
@endsection