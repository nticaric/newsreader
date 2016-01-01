<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ProteusThemes">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Readable - HTML Template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheets/363f9277.main.css"/>
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>
    <script type="text/javascript">
    WebFontConfig = {
    google: {
    families: ['Open+Sans:300,400,700:latin', 'Lato:700,900:latin']
    }
    };
    (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
    })();
    </script>
  </head>
  <body>
    
    <header class="header  push-down-45">
      <div class="container">
        <div class="logo  pull-left">
          <a href="/">
            <img src="images/logo.png" alt="Logo" width="352" height="140">
          </a>
        </div>
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#readable-navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <nav class="navbar  navbar-default" role="navigation">
          
          <div class="collapse  navbar-collapse" id="readable-navbar-collapse">
            <ul class="navigation">
              <li class="dropdown  active">
                <a href="/" class="dropdown-toggle" data-toggle="dropdown">Home</a>
                <ul class="navigation__dropdown">
                  <li> <a href="/">Home (Sidebar)</a> </li>
                  <li> <a href="home-slider.html">Home (Slider)</a> </li>
                  <li> <a href="home-multi-columns.html">Home (Multi Columns)</a> </li>
                  <li> <a href="home-ads.html">Home (With Ads)</a> </li>
                  <li> <a href="home-no-sidebar.html">Home (No Sidebar)</a> </li>
                  <li> <a href="home-full-width.html">Home (Full Width)</a> </li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="single-post.html" class="dropdown-toggle" data-toggle="dropdown">Post formats</a>
                <ul class="navigation__dropdown">
                  <li> <a href="single-post.html">Single Post</a> </li>
                  <li> <a href="single-post-without-image.html">Single Post (No Image)</a> </li>
                  <li> <a href="single-post-video.html">Single Post (Video)</a> </li>
                  <li> <a href="single-post-full-width.html">Single Post (Full Width Image)</a> </li>
                  <li> <a href="search-results.html">Search Results</a> </li>
                </ul>
              </li>
              <li class="">
                <a href="elements.html" class="dropdown-toggle" data-toggle="dropdown">Elements</a>
              </li>
              <li class="">
                <a href="features.html" class="dropdown-toggle" data-toggle="dropdown">Features</a>
              </li>
              <li class="">
                <a href="about-us.html" class="dropdown-toggle" data-toggle="dropdown">About</a>
              </li>
              <li class="">
                <a href="contact.html" class="dropdown-toggle" data-toggle="dropdown">Contact</a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="hidden-xs  hidden-sm">
          <a href="#" class="search__container  js--toggle-search-mode"> <span class="fa fa-search"></span> </a>
          <div class="social">
            <a href="#" class="social__container"> <span class="fa fa-heart"></span> </a>
            <ul class="social__dropdown">
              <li>
                <a href="https://www.facebook.com/ProteusThemes" target="_blank" class="social__container"> <span class="zocial-facebook"></span> </a>
              </li>
              <li>
                <a href="https://twitter.com/ProteusNetCom" target="_blank" class="social__container"> <span class="zocial-twitter"></span> </a>
              </li>
              <li>
                <a href="http://www.specificfeeds.com/follow" target="_blank" class="social__container"> <span class="zocial-rss"></span> </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>
    
    <div class="search-panel">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <form action="search-results.html">
              <input type="text" class="search-panel__form  js--search-panel-text" placeholder="Begin typing for search">
              <p class="search-panel__text">Press enter to see results or esc to cancel.</p>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="multi-columns">
      <div class="container">
        <div class="grid row">
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
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="col-xs-12  col-md-3">
          <div class="widget-about  push-down-30">
            <img src="images/logo.png" alt="Logo" width="176" height="70">
            <br/>
            <span class="footer__text">We focus on highly customizable, fast and optimized themes for variety of popular platform like WordPress and Magento.</span>
            <br/>
            <br/>
            <div class="social-icons  widget-social-icons">
              <a href="#" class="social-icons__container"> <span class="zocial-facebook"></span> </a>
              <a href="#" class="social-icons__container"> <span class="zocial-twitter"></span> </a>
              <a href="#" class="social-icons__container"> <span class="zocial-youtube"></span> </a>
            </div>
          </div>
        </div>
        <div class="col-xs-12  col-md-3">
          <div class="tags  widget-tags">
            <h6>Tags</h6>
            <hr>
            <a href="#" class="tags__link">Tech</a>
            <a href="#" class="tags__link">Web</a>
            <a href="#" class="tags__link">UI/UX</a>
            <a href="#" class="tags__link">Tutorials</a>
            <a href="#" class="tags__link">Workflow</a>
          </div>
        </div>
        <div class="col-xs-12  col-md-3">
          <nav class="widget-navigation  push-down-30">
            <h6>Navigation</h6>
            <hr>
            <ul class="navigation">
              <li> <a href="/">Home</a> </li>
              <li> <a href="single-post.html">Post Formats</a> </li>
              <li> <a href="elements.html">Elements</a> </li>
              <li> <a href="about-us.html">About</a> </li>
              <li> <a href="contact.html">Contact</a> </li>
            </ul>
          </nav>
        </div>
        <div class="col-xs-12  col-md-3">
          <div class="widget-contact  push-down-30">
            <h6>Contact Us</h6>
            <hr>
            <span class="widget-contact__text">
              <span class="widget-contact__title">Readable Itd.</span>
              <br>Tehnološki park 19,
              <br>1000 Ljubljana
              <br>Slovenia
            </span>
          </div>
        </div>
      </div>
    </footer>
    <footer class="copyrights">
      <div class="container">
        <div class="row">
          <div class="col-xs-12  col-sm-6">
            <a href="http://themeforest.net/item/readable-blog-template-focused-on-readability/7499064?ref=ProteusThemes">Readable</a> HTML Template © Copyright 2014.
          </div>
          <div class="col-xs-12  col-sm-6">
            <div class="copyrights--right">
              Made by
              <a href="http://proteusthemes.com" target="_blank">ProteusThemes</a> .
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="js/main.js"></script>
    <script type="text/javascript">
    $( window ).load( function() {
      var elem = document.querySelector('.grid');
      var msnry = new Masonry( elem, {
        // options
        itemSelector: '.grid-item',
      });
    });

    </script>
  </body>
</html>