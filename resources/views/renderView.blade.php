@extends('adminlte::page')

@section('content')
    <div style='margin-left: auto; margin-right: auto'>
        <iframe src="{{$url}}" style='width: 100% ; height: 100vh;border: none'/>
    </div>
{{--    {{$var}}--}}
@stop
