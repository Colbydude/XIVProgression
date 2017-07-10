<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('meta_title', 'VoidTeam Free Company')</title>
        <meta name="description" content="@yield('meta_description', 'VoidTeam Free Company for Final Fantasy XIV: A Realm Reborn.')">
        <meta name="keywords" content="@yield('meta_keywords', 'VoidTeam, Free Company, FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Heavensward')">
        <meta name="author" content="@yield('meta_author', 'VoidTeam Network')">
        <link href="@yield('meta_canonical', 'https://ffxiv.voidteam.net')" rel="canonical">

        @yield('additional_meta')

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        @yield('additional_css')

        @yield('header_scripts')

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @yield('content')

        <script src="{{ mix('/js/app.js') }}"></script>
        @yield('scripts')

        {{-- Google Analytics --}}
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-44795853-2', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
