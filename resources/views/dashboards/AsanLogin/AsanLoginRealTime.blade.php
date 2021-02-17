@extends('layouts.dashboard')

@section('inside')

{{--    <script type='text/javascript' src='http://192.168.20.213/javascripts/api/viz_v1.js'></script>--}}

    <div class='tableauPlaceholder' style='width: 1000px; height: 827px; margin-left: auto; margin-right: auto'>
{{--        <object class='tableauViz' width='1000' height='827' style='display:none;'>--}}
{{--            '<param name='host_url' value='http%3A%2F%2F192.168.20.213%2F' />--}}
{{--            <param name='embed_code_version' value='3' />--}}
{{--            <param name='site_root' value='' />--}}
{{--            <param name='name' value='AsanLoginRealTime&#47;General' />--}}
{{--            <param name='tabs' value='no' />--}}
{{--            <param name='toolbar' value='no' />--}}
{{--            <param name='showAppBanner' value='false' />--}}
            <iframe src="http://192.168.20.213/views/AsanLoginRealTime/General?
            :embed=y&:showVizHome=no&:host_url=http%3A%2F%2F192.168.20.213%2F&:
            embed_code_version=3&:tabs=no&:toolbar=no&:showAppBanner=false&:display_spinner=no&:loadOrderID=0" frameborder="0" style="width: 100%; height: 827px;">

            </iframe>

{{--        </object>--}}
    </div>


@endsection
