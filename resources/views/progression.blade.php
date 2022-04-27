@extends('layouts.default')

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
                        Tool Last Updated: <a href="https://github.com/Colbydude/XIVProgression" target="_blank">April 27th, 2022</a><br>
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
