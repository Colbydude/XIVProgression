@extends('layouts.default')

@section('meta_title', 'FFXIV Progression Checker')
@section('meta_description', 'A simple tool to check a character\'s main scenario quest and duty progression in FFXIV.')
@section('meta_keywords', 'FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Progression, Checker, Tool, Heavensward, Stormblood, Shadowbringers')
@section('canonical', 'https://ffxiv.voidteam.net/progression')

@section('content')
    @include('layouts.partials.header')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <search-form
                            character-name="{{ request()->input('name') }}"
                            character-server="{{ request()->input('server') }}"
                        />
                    </div>
                </div>

                <p class="text-light">
                    <small>
                        Tool Last Updated: <a href="https://github.com/Colbydude/FFXIVProgressionChecker" target="_blank">June 10th, 2021</a><br>
                        By <a href="https://twitter.com/Colbydude" target="_blank">@Colbydude</a> | <a href="http://na.finalfantasyxiv.com/lodestone/character/2249861/" target="_blank">Enyl Noves</a> of Leviathan
                    </small>
                </p>
            </div>

            <div class="col-md-8">
                <character-pane />
            </div>
        </div>

        <instance-list />
    </div>
@stop
