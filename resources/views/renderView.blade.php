@extends('adminlte::page')

@section('content')
    <style>
        .content-header {
            padding: 0;
        }
    </style>
        <script type="text/javascript" src="http://192.168.20.213/javascripts/api/viz_v1.js"></script>
        {{--    <div class='tableauPlaceholder' style='width: 100px; height: 950px;margin-left: auto; margin-right: auto'>--}}
        <object class="tableauViz " width="100%" height="" style="border:none; padding-top: 0; min-height: 100vh">
{{--            <object class="tableauViz " width="100%" height="1000px" style="border:none; padding-top: 0;">--}}
            <param name="path" value={{$url}} />
            <param name="tabs" value="no"/>
            <param name='toolbar' value='top'/>
            <param name='showShareOptions' value='false' />
            <param name='tooltip' value='no'/>
        </object>
@stop
