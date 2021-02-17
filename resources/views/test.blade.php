@extends('layouts.dashboard')

@section('inside')
    <div style='margin-left: auto; margin-right: auto'>
        <iframe src="{{$url}}" style='width: 85% ; height: 90vh;border: none'/>
    </div>
@endsection
