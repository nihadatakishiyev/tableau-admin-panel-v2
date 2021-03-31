@extends('adminlte::page')

@section('left-sidebar')

@stop

@section('content')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    </script>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@stop
