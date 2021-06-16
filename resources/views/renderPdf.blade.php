@extends('adminlte::page')

@section('content')
    <style>
        .content-header {
            padding: 0;
        }
    </style>

    <embed src="{{$url}}" width="100%" height="" style="border:none; min-height: 92vh" type="application/pdf">
{{--    <iframe src='{{$url}}' width='100%' height='600px' style="border:none; min-height: 93vh">--}}

@stop
