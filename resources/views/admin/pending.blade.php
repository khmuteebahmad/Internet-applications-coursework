@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pending Requests</div>
                <div class="card-body">
                @if (session('status'))
                 <div class="alert alert-success">
                 {{ session('status') }}
                 </div>
                 @endif
                 <br/>
                 <!-- Table that displays all the requests that need to be approved -->
                 <table class="table table-striped table-bordered table-hover">
                    <thead>
                         <tr>
                         <th> AnimalID</th><th> Pet Name</th><th> Username</th>
                         <th> Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adoptions as $adoption)
                        @if($adoption->accepted == 'Pending')
                        <tr>
                            <td>{{$adoption->animalId}} </td>
                            <td>{{$adoption->petname}} </td>
                            <td>{{$adoption->username}}</td>
                            <td>
                                <!-- Decision of the request -->
                                <form class="form-horizontal" method="POST" action="{{ action('DashboardController@review', [$adoption->id, $adoption->animalId]) }}" enctype="multipart/form-data" >
                                    @csrf
                                    <select name="accepted">
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                    <input type="submit" class="btn btn-primary" />
                                </form>
                        </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection