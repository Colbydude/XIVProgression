@extends('layouts.default')

@section('additional_css')
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <style>
        html
        {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body
        {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-image: url('../img/stormblood-bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container
        {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content
        {
            text-align: center;
            display: inline-block;
        }

        .title
        {
            font-size: 96px;
            margin-bottom: 40px;
        }

        .quote
        {
            font-size: 24px;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="content">
            <div class="title">&lt;VOID&gt;</div>
        </div>
    </div>
@stop
