@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">Create a new Pet entry</div>
					@if($errors->any())
					<div class="alert alert-danger">
						<ul> @foreach ($errors->all() as $error)
							<li>{{ $error}}</li>
						@endforeach </ul>
					</div> <br/> @endif

					@if (\Session::has('success'))
					<div class="alert alert-success">
						<p>{{ \Session::get('success') }}</p>
					</div><br /> @endif
					<div class="card-body">
						<!-- Form to add a new animal to database -->
						<form class="form-horizontal" method="POST" action="{{url('animals')}}" enctype="multipart/form-data">
							@csrf
							<div class="col-md-8">
								<label>Animal Name: </label>
								<input type="text" name="name" placeholder="Name"/>
							</div>
							<div class="col-md-8">
								<label>Date of Birth: </label>
								<input type="date" name="dob" placeholder="dd/mm/yyyy" />
							</div>
							<div class="col-md-8">
								<label>Description: </label>
							</div>
							<div class="col-md-8">
								<textarea rows="4" cols="50" name="description" placeholder="Description"></textarea>
							</div>
							<div class="col-md-8">
								<label>Image: </label>
								<input type="file" name="images[]" multiple="multiple" placeholder="Image file"/>
							</div>
							<div class="col-md-8">
								<label>Type: </label>
								<select name="type">
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
							</div>
							<div class="col-md-6 col-md-offset-4">
								<input type="submit" class="btn btn-primary"/>
								<input type="reset" class="btn btn-primary"/>
								<a href="{{ route('display_animal')}}" class="btn btn-primary">Close</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection