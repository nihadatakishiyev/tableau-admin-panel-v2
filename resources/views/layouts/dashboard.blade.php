@extends('layouts.app')

@section('content')

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper" style="background-color: #f5f6f8!important">
            <div class="sidebar-heading" style="padding-bottom: 0">Available Dashboards</div>
            <div class="list-group list-group-flush">

                @foreach($permissions as $permission)
                    <a href="{{route(''. $permission . '')}}" class="list-group-item {{ request()->path() == 'dashboard/'. lcfirst($permission) ? 'custom-active' : '' }}">{{$permission}}</a>
{{--                        {{$permission}}--}}
                @endforeach
{{--                <a href="#" class="list-group-item custom-active">Dashboard</a>--}}
{{--                <a href="#" class="list-group-item">Shortcuts</a>--}}
{{--                <a href="#" class="list-group-item">Overview</a>--}}
{{--                <a href="#" class="list-group-item">Events</a>--}}
{{--                <a href="#" class="list-group-item">Profile</a>--}}
{{--                <a href="#" class="list-group-item">Status</a>--}}
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" class="px-3 py-3">
            @yield('inside')
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src= {{ asset('js/jquery.min.js') }}></script>
{{--    <script src= {{ asset('js/bootstrap.bundle.min.js') }}></script>--}}

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

{{--    <script>--}}
{{--        document.getElementById('menu-toggle').click((e) => {--}}
{{--            console.log('func fired')--}}
{{--            e.preventDefault();--}}
{{--            document.getElementById('wrapper').className = 'toggled'--}}
{{--        })--}}
{{--    </script>--}}
@endsection
