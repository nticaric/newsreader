@extends('layout')

@section('content')
  <div class="container">
  @foreach($news as $entry)
    <article class="queue-article">

        <h1 class="queue-article-title"><a href="{{$entry->link}}">{{$entry->title}}</a></h1>

        <div class="row">
            <div class="col-md-3">
                <figure class="queue-article-hero">
                    <picture>
                      <a href="{{$entry->link}}">
                        <img src="{{$entry->image}}" />
                      </a>
                    </picture>
                </figure>
            </div>
            <div class="col-md-9">
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
        </div>
    </article>
  @endforeach
  </div>
@stop
