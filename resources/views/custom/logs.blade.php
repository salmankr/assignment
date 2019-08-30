@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your current logs</div>

                <div class="card-body">
                    <ul>
                    	@foreach($logsHistory as $log)
                    	<li>{{$log->status->description}} from {{$log->browser->name}} browser & {{$log->ip->ip}} ip {{$log->created_at->diffForHumans()}}</li>
                    	@endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
