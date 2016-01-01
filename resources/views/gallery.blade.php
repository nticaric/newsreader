@extends('layout')

@section('content')

    @foreach($images as $image)
        <div class="boxed  push-down-60">

            <img class="wp-post-image" src="{{$image}}">

        </div>
    @endforeach

@stop