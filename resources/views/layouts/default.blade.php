<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('meta_title', 'XIVProgression')</title>
        <meta name="description" content="@yield('meta_description', 'A simple tool to check a character\'s main scenario quest and duty progression in FFXIV.')">
        <meta name="keywords" content="@yield('meta_keywords', 'FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Progression, Checker, Tool, Heavensward, Stormblood, Shadowbringers, Endwalker')">
        <meta name="author" content="@yield('meta_author', 'Colbydude')">
        <link href="@yield('meta_canonical', 'https://xivprogression.com')" rel="canonical">

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>

        @include('layouts.partials.footer')

        <script src="{{ mix('/js/app.js') }}"></script>

        @include('layouts.partials.google-analytics')
    </body>
</html>
