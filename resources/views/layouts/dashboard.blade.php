@extends('layouts.app')

@section('content')

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Start Bootstrap </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
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
    <script src= {{ asset('js/bootstrap.bundle.min.js') }}></script>

    <!-- Menu Toggle Script -->
{{--    <script>--}}
{{--        $("#menu-toggle").click(function(e) {--}}
{{--            e.preventDefault();--}}
{{--            $("#wrapper").toggleClass("toggled");--}}
{{--        });--}}
{{--    </script>--}}

    <script>
        document.getElementById('menu-toggle').click((e) => {
            console.log('func fired')
            e.preventDefault();
            document.getElementById('wrapper').className = 'toggled'
        })
    </script>
@endsection
