@extends('layout')

@section('content')


        <div id="content-header"></div>
        <div id="content-articles">
            <div id="well">
                <article id="item-717956" class="item article global has-hero">
                    <header class="item-header content-width">
                        <h1>{{$title}}</h1>
                    </header>
                    <figure class="featured-image">
                        <picture>
                            <img src="{{$image}}">
                        </picture>
                    </figure>
                    <div class="item-content ">
                        <div class="item-body">
                            {!! $text !!}
                        </div>
                    </div>
                </article>
            </div>
        </div>
@stop