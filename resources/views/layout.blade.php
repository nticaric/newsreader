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
            <a href="/">jutarnji.hr</a>
            <a href="/index.hr">index.hr</a>
            <a href="/net.hr">net.hr</a>
            <a href="/vecernji.hr">vecernji.hr</a>
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