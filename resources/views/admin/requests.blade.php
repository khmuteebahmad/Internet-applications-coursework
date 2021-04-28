@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Requests</div>
                <div class="card-body">
                @if (session('status'))
                 <div class="alert alert-success">
                 {{ session('status') }}
                 </div>
                 @endif
                 <br/>
                 <!-- Table that displays all requests made by all users -->
                 <table class="table table-striped table-bordered table-hover">
                    <thead>
                         <tr>
                         <th> AnimalID</th><th> Pet Name</th><th> Username</th>
                         <th> Outcome </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adoptions as $adoption)
                        <tr>
                            <td>{{$adoption->animalId}} </td>
                            <td>{{$adoption->petname}} </td>
                            <td>{{$adoption->username}}</td>
                            <td>{{$adoption->accepted}} </td>
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