@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 ">
			<div class="card">
				<div class="card-header">{{$animals['name']}} Record</div>
				<div class="card-body">
					<!-- Table to display information about specific pet -->
				<table class="table table-striped" border="1" >
					<tr> <td colspan='2' >
						@foreach ($animals->files as $file)
 							<img style="width:60px;"src="{{ asset(''.$file->file)}}">
						@endforeach
					</td></tr>
					<tr> <th> <b>Name </th> <td> {{$animals['name']}}</td></tr>
					<tr> <th>DOB</th> <td>{{$animals['dob']}}</td></tr>
					<tr> <th>Description </th> <td>{{$animals['description']}}</td></tr>
					<tr> <th>Type </th> <td>{{$animals['type']}}</td></tr>
				</table>
				<table><tr>
					<!-- Link back to list of all animals -->
					<td><a href="{{ route('display_animal')}}" class="btn btn-primary" role="button">Back to the list</a></td>
					<!-- Link to edit pet -->
					<td><a href="{{action('AnimalController@edit', $animals['id'])}}" class="btn
					btn- warning">Edit</a></td>
					<!-- Delete this pet-->
					<td><form action="{{action('AnimalController@destroy', $animals['id'])}}"
					method="post"> @csrf
					<input name="_method" type="hidden" value="DELETE">
					<button class="btn btn-danger" type="submit">Delete</button>
				</form></td>
				</tr></table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection