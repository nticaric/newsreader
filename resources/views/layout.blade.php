<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
    <title>TNT News</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic">
    <link rel="stylesheet" href="/css/main.css" />

</head>

<body class="home">
    <header id="header" class="">
        <div class="left">
            <a @if(app('request')->segment(1) == 'jutarnji' || app('request')->segment(1) == '') class="active" @endif href="/">jutarnji.hr</a>
            <a @if(app('request')->segment(1) == 'index.hr') class="active" @endif href="/index.hr">index.hr</a>
            <a @if(app('request')->segment(1) == 'vijesti.hr') class="active" @endif href="/vijesti.hr">vijesti.hr</a>
            <a @if(app('request')->segment(1) == 'net.hr') class="active" @endif href="/net.hr">net.hr</a>
            <a @if(app('request')->segment(1) == 'poslovni.hr') class="active" @endif href="/poslovni.hr">poslovni.hr</a>
        </div>
        <div class="logo"> 
            <a href="">TNT Readable News</a>
        </div>
    </header>

    <div id="container">
        <div id="content">
            <div id="content-articles">
                <div id="queue">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>