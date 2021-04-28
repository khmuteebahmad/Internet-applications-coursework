@extends('layouts.app') <!-- Adds navbar -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Welcomes admin to the portal and informs them what they can do -->
                    Welcome to the admin portal!<br/> <br/>
                    You can view all pending requests <br/>
                    Add pets up for adoption <br/>
                    and view all pets on the system.
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
