@extends('layout')

@section('content')
  @foreach($news as $entry)
    <article class="queue-article">
        <div class="content-width">
            <header class="queue-article-obsession-header">
                <a href="" class="queue-article-obsession-name">The Future of Hong Kong</a>
                <a href="">See all</a></i>
            </header>

            <h1 class="queue-article-title"><a href="{{$entry->link}}">{{$entry->title}}</a></h1>

            <figure class="queue-article-hero">
                <picture>
                    <img src="{{$entry->image}}" />
                </picture>
            </figure>
            <div class="queue-article-content">
                <p class="queue-article-summary">{{$entry->summary}}</p>

                <div class="queue-article-meta">

                    <div class="item-obsession">
                        <a href="">{{$entry->category}}</a>
                    </div>

                    <div class="byline">
                        <a href="" class="author-name">{{$entry->author}}</a>
                    </div>

                    <div class="timestamp" title="">{{$entry->updated}}</div>
                </div>
            </div>

        </div>
    </article>
  @endforeach

@stop