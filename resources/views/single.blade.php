@extends('layout')

@section('content')

    <div class="col-md-8 col-sm-12">

        <div class="meta">
            <img class="wp-post-image" src="{{$image}}" alt="Blog image" width="1138" height="493">
        </div>

        <div class="post-content">
            {!! $text !!}
        </div>
        <div class="post-comments">
            <a class="btn  btn-primary" href="/">Back to Homepage</a>
        </div>

    </div>

@stop