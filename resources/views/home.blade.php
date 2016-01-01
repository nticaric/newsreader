@extends('layout')

@section('content')
  @foreach($news as $entry)
    <div class="col-md-4 grid-item">
      <div class="boxed push-down-45">

          <div class="meta">
            <a href="{{$entry->link}}">
              <img class="wp-post-image" src="{{$entry->image}}" alt="Blog image" width="748" height="324">
            </a>
            <div class="meta__container">
              <div class="row">
                <div class="col-xs-12  col-sm-12">
                  <div class="meta__info">
                    <span class="meta__author"><img src="images/dummy/about-5.jpg" alt="Meta avatar" width="30" height="30"> <a href="#">{{$entry->author}}</a> in <a href="#">{{$entry->category}}</a> </span>
                    <span class="meta__date"><span class="fa fa-calendar"></span> {{$entry->updated}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
              <div class="col-xs-10  col-xs-offset-1">

                  <div class="post-content--front-page">
                      <h2 class="front-page-title">
                        <a href="{{$entry->link}}">{{$entry->title}}</a>
                      </h2>
                      <h3>{{$entry->summary}}</h3>
                  </div>

                  <a href="{{$entry->link}}">
                      <div class="read-more">
                          Continue reading
                          <div class="read-more__arrow">
                              <span class="fa fa-chevron-right"></span>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
    </div>
  @endforeach
@stop