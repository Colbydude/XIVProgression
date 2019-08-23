<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>VoidTeam Free Company</title>
        <meta name="description" content="VoidTeam Free Company for Final Fantasy XIV Online.">
        <meta name="keywords" content="VoidTeam, Free Company, FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Heavensward, Stormblood">
        <meta name="author" content="VoidTeam Network">
        <link href="https://ffxiv.voidteam.net" rel="canonical">

        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300" rel="stylesheet" type="text/css">

        {{-- Styles --}}
        <style>
            html, body {
                background-color: #fff;
                color: rgba(0, 0, 0, .75);
                font-family: 'Source Sans Pro', sans-serif;
                font-weight: 300;
                height: 100vh;
                margin: 0;
            }

            body {
                background-image: url('../img/shadowbringers-bg.jpg');
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    &lt;VOID&gt;
                </div>
            </div>
        </div>

        @include('layouts.partials.google-analytics')
    </body>
</html>
