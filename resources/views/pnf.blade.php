@extends('adminlte::page')

@section('left-sidebar')
    <li>test6544</li>
@stop

@section('content')
{{--        {{gettype($permissions)}}--}}
{{--    @foreach($permissions as $i => $permission)--}}
{{--        <h4>{{$permission['name']}}</h4>--}}
{{--            @foreach($permission['workbooks'] as $workbook)--}}
{{--                <h3>{{$workbook['name']}}</h3>--}}
{{--                {{gettype($workbook)}}--}}
{{--            @endforeach--}}
{{--    @endforeach--}}
{{--    @if(auth()->user()->can('ASAN Finans'))--}}
{{--        abc--}}
{{--    @endif--}}
    @foreach($permissions as $permission)
        @if(auth()->user()->can($permission['name']))
            <h1>{{$permission['name']}}</h1>
        @endif
            @foreach($permission['workbooks'] as $workbook)
                @if(auth()->user()->can($permission['name'] . '.' . $workbook['name']))
                    <h3>{{$workbook['name']}}</h3>
                @endif
                    @foreach($workbook['views'] as $view)
                        @if(auth()->user()->can($permission['name'] . '.' . $workbook['name'] . '.' . $view['name']))
                            <h5>{{$view['name']}}</h5>
                        @endif
                    @endforeach
            @endforeach
    @endforeach

@stop
