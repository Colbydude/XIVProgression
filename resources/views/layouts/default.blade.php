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

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

        @include('layouts.partials.google-analytics')
    </body>
</html>
