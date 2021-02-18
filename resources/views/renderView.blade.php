@extends('adminlte::page')

@section('content')
    <script type="text/javascript" src="http://192.168.20.213/javascripts/api/viz_v1.js"></script>
{{--    <div class='tableauPlaceholder' style='width: 100px; height: 950px;margin-left: auto; margin-right: auto'>--}}
        <object class="tableauViz" width="100%" height="872" style="border:none;">
            <param name="path" value={{$url}} />
            <param name="tabs" value="no"/>
            <param name='toolbar' value='top'/>
            <param name='showShareOptions' value='false' />
            <param name='tooltip' value='no'/>
        </object>
{{--    </div>--}}
    {{--    <div class="tableauPlaceholder" style='margin-left: auto; margin-right: auto'>--}}
    {{--        <iframe src="{{$url}}" style='width: 100% ; height: 100vh;border: none'/>--}}
    {{--    </div>--}}
{{--        {{$url}}--}}
@stop
