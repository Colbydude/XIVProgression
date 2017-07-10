@extends('layouts.default')

@section('meta_title', 'FFXIV Progression Checker')
@section('meta_description', 'A simple tool to check a character\'s raid progression in FFXIV.')
@section('meta_keywords', 'FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Progression, Checker, Tool')
@section('canonical', 'https://ffxiv.voidteam.net/progression')

@section('content')
    @include('layouts.partials.header')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="check-form">
                            <div class="form-group">
                                <label for="name">Character Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $name or '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="server">Server</label>
                                <select id="server" name="server" class="form-control">
                                    <option value="" disabled selected>Choose your realm</option>
                                    <option value="Adamantoise" {{ $server == "Adamantoise" ? "selected" : '' }}>Adamantoise</option>
                                    <option value="Aegis" {{ $server == "Aegis" ? "selected" : '' }}>Aegis</option>
                                    <option value="Alexander" {{ $server == "Alexander" ? "selected" : '' }}>Alexander</option>
                                    <option value="Anima" {{ $server == "Anima" ? "selected" : '' }}>Anima</option>
                                    <option value="Asura" {{ $server == "Asura" ? "selected" : '' }}>Asura</option>
                                    <option value="Atomos" {{ $server == "Atomos" ? "selected" : '' }}>Atomos</option>
                                    <option value="Bahamut" {{ $server == "Bahamut" ? "selected" : '' }}>Bahamut</option>
                                    <option value="Balmung" {{ $server == "Balmung" ? "selected" : '' }}>Balmung</option>
                                    <option value="Behemoth" {{ $server == "Behemoth" ? "selected" : '' }}>Behemoth</option>
                                    <option value="Belias" {{ $server == "Belias" ? "selected" : '' }}>Belias</option>
                                    <option value="Brynhildr" {{ $server == "Brynhildr" ? "selected" : '' }}>Brynhildr</option>
                                    <option value="Cactuar" {{ $server == "Cactuar" ? "selected" : '' }}>Cactuar</option>
                                    <option value="Carbuncle" {{ $server == "Carbuncle" ? "selected" : '' }}>Carbuncle</option>
                                    <option value="Cerberus" {{ $server == "Cerberus" ? "selected" : '' }}>Cerberus</option>
                                    <option value="Chocobo" {{ $server == "Chocobo" ? "selected" : '' }}>Chocobo</option>
                                    <option value="Coeurl" {{ $server == "Coeurl" ? "selected" : '' }}>Coeurl</option>
                                    <option value="Diabolos" {{ $server == "Diabolos" ? "selected" : '' }}>Diabolos</option>
                                    <option value="Durandal" {{ $server == "Durandal" ? "selected" : '' }}>Durandal</option>
                                    <option value="Excalibur" {{ $server == "Excalibur" ? "selected" : '' }}>Excalibur</option>
                                    <option value="Exodus" {{ $server == "Exodus" ? "selected" : '' }}>Exodus</option>
                                    <option value="Faerie" {{ $server == "Faerie" ? "selected" : '' }}>Faerie</option>
                                    <option value="Famfrit" {{ $server == "Famfrit" ? "selected" : '' }}>Famfrit</option>
                                    <option value="Fenrir" {{ $server == "Fenrir" ? "selected" : '' }}>Fenrir</option>
                                    <option value="Garuda" {{ $server == "Garuda" ? "selected" : '' }}>Garuda</option>
                                    <option value="Gilgamesh" {{ $server == "Gilgamesh" ? "selected" : '' }}>Gilgamesh</option>
                                    <option value="Goblin" {{ $server == "Goblin" ? "selected" : '' }}>Goblin</option>
                                    <option value="Gungnir" {{ $server == "Gungnir" ? "selected" : '' }}>Gungnir</option>
                                    <option value="Hades" {{ $server == "Hades" ? "selected" : '' }}>Hades</option>
                                    <option value="Hyperion" {{ $server == "Hyperion" ? "selected" : '' }}>Hyperion</option>
                                    <option value="Ifrit" {{ $server == "Ifrit" ? "selected" : '' }}>Ifrit</option>
                                    <option value="Ixion" {{ $server == "Ixion" ? "selected" : '' }}>Ixion</option>
                                    <option value="Jenova" {{ $server == "Jenova" ? "selected" : '' }}>Jenova</option>
                                    <option value="Kujata" {{ $server == "Kujata" ? "selected" : '' }}>Kujata</option>
                                    <option value="Lamia" {{ $server == "Lamia" ? "selected" : '' }}>Lamia</option>
                                    <option value="Leviathan" {{ $server == "Leviathan" ? "selected" : '' }}>Leviathan</option>
                                    <option value="Lich" {{ $server == "Lich" ? "selected" : '' }}>Lich</option>
                                    <option value="Malboro" {{ $server == "Malboro" ? "selected" : '' }}>Malboro</option>
                                    <option value="Mandragora" {{ $server == "Mandragora" ? "selected" : '' }}>Mandragora</option>
                                    <option value="Masamune" {{ $server == "Masamune" ? "selected" : '' }}>Masamune</option>
                                    <option value="Mateus" {{ $server == "Mateus" ? "selected" : '' }}>Mateus</option>
                                    <option value="Midgardsormr" {{ $server == "Midgardsormr" ? "selected" : '' }}>Midgardsormr</option>
                                    <option value="Moogle" {{ $server == "Moogle" ? "selected" : '' }}>Moogle</option>
                                    <option value="Odin" {{ $server == "Odin" ? "selected" : '' }}>Odin</option>
                                    <option value="Pandaemonium" {{ $server == "Pandaemonium" ? "selected" : '' }}>Pandaemonium</option>
                                    <option value="Phoenix" {{ $server == "Phoenix" ? "selected" : '' }}>Phoenix</option>
                                    <option value="Ragnarok" {{ $server == "Ragnarok" ? "selected" : '' }}>Ragnarok</option>
                                    <option value="Ramuh" {{ $server == "Ramuh" ? "selected" : '' }}>Ramuh</option>
                                    <option value="Ridill" {{ $server == "Ridill" ? "selected" : '' }}>Ridill</option>
                                    <option value="Sargatanas" {{ $server == "Sargatanas" ? "selected" : '' }}>Sargatanas</option>
                                    <option value="Shinryu" {{ $server == "Shinryu" ? "selected" : '' }}>Shinryu</option>
                                    <option value="Shiva" {{ $server == "Shiva" ? "selected" : '' }}>Shiva</option>
                                    <option value="Siren" {{ $server == "Siren" ? "selected" : '' }}>Siren</option>
                                    <option value="Tiamat" {{ $server == "Tiamat" ? "selected" : '' }}>Tiamat</option>
                                    <option value="Titan" {{ $server == "Titan" ? "selected" : '' }}>Titan</option>
                                    <option value="Tonberry" {{ $server == "Tonberry" ? "selected" : '' }}>Tonberry</option>
                                    <option value="Typhon" {{ $server == "Typhon" ? "selected" : '' }}>Typhon</option>
                                    <option value="Ultima" {{ $server == "Ultima" ? "selected" : '' }}>Ultima</option>
                                    <option value="Ultros" {{ $server == "Ultros" ? "selected" : '' }}>Ultros</option>
                                    <option value="Unicorn" {{ $server == "Unicorn" ? "selected" : '' }}>Unicorn</option>
                                    <option value="Valefor" {{ $server == "Valefor" ? "selected" : '' }}>Valefor</option>
                                    <option value="Yojimbo" {{ $server == "Yojimbo" ? "selected" : '' }}>Yojimbo</option>
                                    <option value="Zalera" {{ $server == "Zalera" ? "selected" : '' }}>Zalera</option>
                                    <option value="Zeromus" {{ $server == "Zeromus" ? "selected" : '' }}>Zeromus</option>
                                    <option value="Zodiark" {{ $server == "Zodiark" ? "selected" : '' }}>Zodiark</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Check</button>
                        </form>
                    </div>
                </div>
                <p class="text-light">
                    <small>
                        Tool Last Updated: <a href="https://github.com/Colbydude/FFXIVProgressionChecker" target="_blank">July 10th, 2017</a><br>
                        By <a href="https://twitter.com/Colbydude" target="_blank">@Colbydude</a> | <a href="http://na.finalfantasyxiv.com/lodestone/character/2249861/" target="_blank">Enyl Noves</a> of Leviathan<br>
                        Further updates coming later this week.
                    </small>
                </p>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default" id="character-data" style="display: none;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 hidden-xs">
                                <img class="img-responsive" id="character_portrait" src="//placehold.it/264x360" alt="Placeholder">
                            </div>
                            <div class="col-md-8">
                                <h1 id="character_name" style="margin-top: 0;"></h1>
                                <p><strong>Active Class:</strong> <span id="active_class"></span> [<span id="active_class_level"></span>]</p>
                                <a class="btn btn-info" id="lodestone_profile" href="http://na.finalfantasyxiv.com" target="_blank">View Lodestone Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="loading" style="display: none;">
                <h1 class="text-light">Fetching data...</h1>
                <div class="form-group preloader-wrapper text-light">
                    <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div id="progression-data" style="display: none;">
            <h2 class="text-light">8-Man Raids</h2>
            <div class="row multi-columns-row" id="raids-8">
            </div>

            <h2 class="text-light">24-Man Raids</h2>
            <div class="row multi-columns-row" id="raids-24">
            </div>

            <h2 class="text-light">Trials</h2>
            <div class="row multi-columns-row" id="trials">
            </div>
        </div>
    </div>
@stop
