@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div >
			<div class="card">
				<div class="card-header">Display all Pets</div>
				<div class="card-body">
					<!-- Filters the number of animals on display by type -->
					<form>
						Filter by Pet Type:
						<select name="type">
							<option value="">All</option>
							<option value="Dog">Dog</option>
							<option value="Cat">Cat</option>
							<option value="Aquarium">Aquarium</option>
							<option value="Bird">Bird</option>
							<option value="Mammal">Mammal</option>
							<option value="Rodent">Rodent</option>
							<option value="Reptile">Reptile</option>
							<option value="Amphiban">Amphibian</option>
							<option value="Horse">Horse</option>
						</select>
						<input type="submit" value="Filter" /> |
						<a href="index/"> Reset </a>
					</form> <br/>
					<!-- Table that displays all the animals in the database -->
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>DOB</th>
								<th>Description</th>
								<th>Type</th>
								<th>Image</th>
								<th>Availability</th>
								<th>Owner</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($animals as $animal)
							<tr>
								<td>{{$animal['name']}}</td>
								<td>{{$animal['dob']}}</td>
								<td>{{$animal['description']}}</td>
								<td>{{$animal['type']}}</td>
								<td>
									@foreach ($animal->files as $file)
										
									<img style="width:60px;"src="{{ asset(''.$file->file)}}">
									@endforeach

								</td>
								<td>{{$animal['availability']}}</td>
								<?php $adopt = $adoptions->where('animalId', '=', $animal['id'])->where('accepted', '=', 'Approved')->first();
								?>
								<td>
									@unless (is_null($adopt))
									<a href="{{route('user', ['username' => $adopt['username']])}}">{{$adopt['username']}}</a>
									@endunless
								</td> <!-- Link to owner details -->
								<td>
									<a href="{{action('AnimalController@show', $animal['id'])}}" class="btn btn- primary">Details</a>
								</td> <!-- Link to details about the animal -->
								<td>
									<a href="{{action('AnimalController@edit', $animal['id'])}}" class="btn
									btn- warning">Edit</a>
								</td> <!-- Link to edit the animals record -->
									<td>
										<form action="{{action('AnimalController@destroy', $animal['id'])}}"
										method="post"> @csrf
										<input name="_method" type="hidden" value="DELETE">
										<button class="btn btn-danger" type="submit"> Delete</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<!-- Link to add pet to the database -->
					<a href="{{action('AnimalController@create')}}" class="btn btn-primary">Add Pet</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection