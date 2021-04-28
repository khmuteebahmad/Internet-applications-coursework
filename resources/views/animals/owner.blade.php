@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
			<div class="card-header">Owner Details</div>
			<div class="card-body">
				<!-- Table contain details about the owner -->
			<table class="table table-striped">
				<tr><th>Username</th><td>{{$user['username']}}</td></tr>
				<tr><th>Name</th><td>{{$user['firstName']}}</td></tr>
				<tr><th>Email</th><td>{{$user['email']}}</td></tr>
				</table>
				<br/>
					<!-- Link back list of all animals -->
					<a href="{{ route('display_animal')}}" class="btn btn-primary" role="button">Back to the list</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection