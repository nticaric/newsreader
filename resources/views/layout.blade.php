<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
    <title> @yield('title') | TNT News</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/main.css" />

    @yield('head')
</head>

<body class="home">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">TNT Readable News</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li @if(app('request')->segment(1) == 'jutarnji' || app('request')->segment(1) == '') class="active" @endif ><a href="/">jutarnji.hr</a></li>
            <li @if(app('request')->segment(1) == 'index.hr') class="active" @endif><a href="/index.hr">index.hr</a></li>
            <li @if(app('request')->segment(1) == 'vijesti.hr') class="active" @endif><a href="/vijesti.hr">vijesti.hr</a></li>
            <li @if(app('request')->segment(1) == 'net.hr') class="active" @endif><a href="/net.hr">net.hr</a></li>
            <li @if(app('request')->segment(1) == 'poslovni.hr') class="active" @endif><a href="/poslovni.hr">poslovni.hr</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>
