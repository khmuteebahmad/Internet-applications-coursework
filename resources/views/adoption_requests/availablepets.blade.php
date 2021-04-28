@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Available Pets</div>
                <div class="card-body">
                @if (session('status'))
                 <div class="alert alert-success">
                 {{ session('status') }}
                 </div>
                 @endif
                 <!-- Filters the pets displayed by the pet -->
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
	                 <a href="availablepets/"> Reset </a>
	             </form>
	             <br/>
                 <!-- Table to display pets that are available for adoption -->
                 <table class="table table-striped table-bordered table-hover">
                    <th2ead>
                         <tr>
                         <th> Name</th><th> DOB</th>
                         <th> Description </th><th> Type</th><th> Picture </th><th>Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($animals as $animal)
                        <?php $requested = false; ?>
                        @if($animal->availability == 'Available')
                        <tr>
                        <td> {{$animal->name}} </td>
                        <td> {{$animal->dob}} </td>
                        <td> {{$animal->description}} </td>
                        <td> {{$animal->type}} </td>
                        <td>
                            @foreach ($animal->files as $file)
                                <img style="width:60px;"src="{{ asset(''.$file->file)}}">
                            @endforeach
                       </td>
                        <td>
                        @if ($animal->requested())
                            Request Made
                        @else
                            <a href="{{action('AdoptionRequestController@create', $animal['id'])}}" class="btn btn-primary" role="button">Make Request</a> 
                        @endif

                        </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <!-- Adds type to the url -->
                {{ $animals->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection