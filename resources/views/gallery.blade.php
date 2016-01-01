@extends('layout')

@section('content')

    @foreach($images as $image)
        <div class="col-md-12 push-down-60">

            <img src="{{$image}}">

        </div>
    @endforeach

@stop