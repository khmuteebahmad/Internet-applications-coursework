@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">Make Request</div>
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
					<!-- Displays information about the pet chosen to be adopted-->
					<form class="form-horizontal" method="POST" action="{{ action('AdoptionRequestController@update',
					$animals['id']) }} " enctype="multipart/form-data" >
					@method('PATCH')
					@csrf
					<div class="col-md-8">
						<label>Pet ID</label>
						<input type="text" name="id" value="{{$animals->id}}" readonly/>
					</div>
					<div class="col-md-8">
						<label>Pet Name</label>
						<input type="text" name="petname" value="{{$animals->name}}" readonly/>
					</div>
					<div class="col-md-8">
						<label>Username</label>
						<input type="text" name="username" value="{{Auth::user()->username}}" readonly/>
					</div>
					<div class="col-md-6 col-md-offset-4">
						<input type="submit" class="btn btn-primary" />
						<a href="{{ route('available_pets')}}" class="btn btn-primary" role="button">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection