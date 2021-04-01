@extends('adminlte::page')

@section('left-sidebar')

@stop

@section('content')
    <style>
        .recent-section-header {
            border-bottom: 1px rgb(230, 230, 230) solid;
            margin-bottom: 1.2em;
        }
        .photo {
            width: 20rem;
            height: 12rem;
            margin-left: 1rem;
            border: 1px solid #d8d8d8;
            border-radius: 1px;
            background-size: cover;
            background-repeat: no-repeat;
            box-shadow: 0 1px 2px rgb(0 0 0 / 15%);
        }
        .photo:hover {
            opacity: 0.3;
        }
        .card-name{
            margin-top: 0.5rem;
            margin-left: 2rem;
        }
        .recent-access-time{
            margin-top: 0.5rem;
            margin-left: 2rem;
            color: rgba(0, 0, 0, 0.6);
        }

    </style>
    <section class="recent-content">
        <header class="recent-section-header">
            <h4>Recents</h4>
        </header>
        <div class="cards-container d-flex flex-row">
            <div class="card-content-wrapper d-flex flex-column">
                <a class="photo" href="#" id="photo" style="background-image: url({{asset('photos/thumb.png')}})"></a>
                <div class="card-text d-flex flex-row">
                    <h5 class="card-name">General</h5>
                    <h6 class="recent-access-time">4 hours ago</h6>
                </div>


            </div>

            <a class="photo" href="#" id="photo" style="background-image: url({{asset('photos/thumb.png')}})"></a>
            <a class="photo" href="#" id="photo" style="background-image: url({{asset('photos/thumb.png')}})"></a>
            <a class="photo" href="#" id="photo" style="background-image: url({{asset('photos/thumb.png')}})"></a>


        </div>
    </section>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    </script>
@stop
