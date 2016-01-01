<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>TNT Readable News</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/stylesheets/363f9277.main.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->

</head>

<body>

    <header class="header push-down-45">
        <div class="container">
            <div class="logo  pull-left">
                <a href="/">
                    <img src="/images/logo.png" alt="Logo" width="352" height="140">
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
                        <li class="active">
                            <a href="/" class="dropdown-toggle" data-toggle="dropdown">Jutarnji.hr</a>
                        </li>
                        <li class="">
                            <a href="/index.hr" class="dropdown-toggle" data-toggle="dropdown">Index.hr</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="grid row">
            @yield('content')
        </div>
    </div>
    
    <footer class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-xs-12  col-sm-6">
                    <a href="http://tntstudio.us" target="_blank">TNT Studio</a> News Reader © Copyright {{date('Y')}}.
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/main.js"></script>
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