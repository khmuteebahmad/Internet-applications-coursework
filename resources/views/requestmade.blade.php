@extends('layouts.app') <!-- Adds navbar -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request Made</div>
                <div class="card-body">
                @if (session('status'))
                 <div class="alert alert-success">
                 {{ session('status') }}
                 </div>
                 @endif
                 Your Request Has Been Made!
                 <br/>
                 <a href="{{ route('home')}}" class="btn btn-primary" role="button">Return to home</a>
             </div>
         </div>
     </div>
 </div>
</div>
@endsection