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
                        <figcaption class="featured-image-caption">
                            <div class="content-width">
                                <i class="fa fa-camera"></i> {{$meta['pictureCaption']}} <span class="featured-image-credit">({{$meta['pictureAuthor']}})</span>
                            </div>
                        </figcaption>
                    </figure>
                    <div class="container">
                        <div class="item-content">
                            <div class="item-meta">
                                <div class="byline item-meta-row">
                                    <h5>Written by</h5>
                                    <a href="#" class="author-name" data-index="0">{{$meta['author']}}</a>
                                </div>

                                <div class="item-obsession item-meta-row">
                                    <h5>Category</h5>
                                    <a href="#">{{$meta['category']}}</a>
                                </div>

                                <div class="item-timestamp item-meta-row">
                                    <h5>Date</h5>
                                    <span class="timestamp" itemprop="datePublished">{{$meta['published']}}</span>
                                    <br><br>
                                </div>
                            </div>
                            <div class="item-body">
                                {!! $text !!}
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
@stop