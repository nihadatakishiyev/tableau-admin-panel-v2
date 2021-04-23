@extends('adminlte::page')

@section('left-sidebar')

@stop

@section('content')
    <style>
        .photo {
            width: 17vw;
            min-width: 100px;
            height: 21vh;
            min-height: 100px;
            margin-left: 1vw;
            border: 1px solid #d8d8d8;
            border-radius: 1px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            box-shadow: 0 1px 2px rgb(0 0 0 / 15%);
        }
        .photo:hover {
            opacity: 0.3;
        }
        .home-section-header {
            border-bottom: 1px rgb(230, 230, 230) solid;
            margin-bottom: 2vh;
            color: rgba(0,0,0,.5);
        }
        .card-text{
            margin-top: 0.8vh;
            max-width: 22vw;
            margin-left: 1.1vw;
        }
        .card-name{
            font-size: 0.8vw;
            width: 10vw;
            white-space: nowrap;
            overflow: hidden;
            text-overflow:ellipsis;
        }
        .recent-access-time{
            font-size: 0.8vw;
            color: rgba(0, 0, 0, 0.6);
        }
        .recent-content{
            margin-bottom: 10vh;
        }
    </style>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

        @if(count($recents))
            <section class="recent-content">
                <header class="home-section-header">
                    <h4>Recents</h4>
                </header>
                <div class="cards-container d-flex flex-row">
                    @foreach($recents as $recent)
                        <div class="card-content-wrapper d-flex flex-column">
                            <a class="photo" href="{{$recent->page_url}}" id="photo" style="background-image: url({{asset('photos/tableau.jpg')}})"></a>
                            <div class="card-text d-flex flex-row justify-content-between">
                                <div class="card-name">{{$recent->name}}</div>
                                <div class="recent-access-time">{{$recent->seconds}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if(count($recoms))
            <section class="recommendation-content">
                <header class="home-section-header">
                    <h4>Recommendations</h4>
                </header>
                <div class="cards-container d-flex flex-row">
                    @foreach($recoms as $recom)
                        <div class="card-content-wrapper d-flex flex-column">
                            <a class="photo" href="{{$recom->page_url}}" id="photo" style="background-image: url({{asset('photos/tableau.jpg')}})"></a>
                            <div class="card-text d-flex flex-row justify-content-between">
                                <div class="card-name">{{$recom->name}} </div>
                                <div class="recent-access-time">
                                    <i class="fas fa-eye"></i> &nbsp;
                                    {{$recom->times}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(1500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);
    </script>
@stop
