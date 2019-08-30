@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Localization message</div>

                <div class="card-body">
                    <p>@lang('messages.welcome')</p>
                    <a class="btn btn-info" href="{{route('localization', ['locale' => 'en'])}}">View in english</a>
                    <a class="btn btn-info" href="{{route('localization', ['locale' => 'fr'])}}">View in french</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
