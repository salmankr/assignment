@extends('layouts.app')

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
                    @if(isset($message))
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    <a class="btn btn-primary" href="{{route('verification.notice')}}" role="button">Go to Verification page</a>
                    @else
                    <h3>{{$userObj->name}}</h3>
                    <h3>{{$userObj->email}}</h3>
                    <p>Address: {{$userObj->address}}</p>
                    <p>City: {{$userObj->city}}</p>
                    <p>Country: {{$userObj->country->name}}</p>
                    <p>State: {{$userObj->state->name}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
