@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => trans('backpack::base.use_sidebar'),
        'button_link' => url('/'),
        'button_text' => 'Back to Tableau Dashboard',
    ];
@endphp

@section('content')
@endsection
