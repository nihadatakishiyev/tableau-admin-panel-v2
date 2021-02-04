@extends('layouts.app')

@section('content')
    <div class="content" style="display: flex">
        <div class="text" style="margin-left: auto; margin-right: auto; margin-top: 10%">
            <h4 style="">Oh no! Page not found</h4>
            <p>Looks like you hit a bad link somehow</p>
            <img src="{{asset('photos/status-not-found.svg')}}" alt="" style="margin-top: 2rem">
        </div>
    </div>


@endsection
