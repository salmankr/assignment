@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generate API Key</div>

                <div class="card-body">
                    <a href="{{route('api')}}" class="btn btn-primary">Generate New Key</a>
                    <div class="alert alert-light" role="alert">
                      	Your API Key:  {{$apiKey}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
