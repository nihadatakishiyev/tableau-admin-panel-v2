@extends('adminlte::page')

@section('content')
    <style>
        .content-header {
            padding: 0;
        }
    </style>
    <embed src="{{$url}}" width="100%" height="" style="border:none; min-height: 93vh"
           type="application/pdf">
@stop
