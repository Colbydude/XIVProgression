@extends('layouts.default')

@section('meta_title', 'FFXIV Progression Checker')
@section('meta_description', 'A simple tool to check a character\'s raid progression in FFXIV.')
@section('meta_keywords', 'FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Progression, Checker, Tool')
@section('canonical', 'http://ffxiv.voidteam.net/progression')

@section('content')
    @include('layouts.partials.header')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <form id="check-form">
                    <div class="form-group">
                        <label for="name">Character Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $name or '' }}" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label for="server">Server</label>
                        <select id="server" name="server" class="form-control">
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
                <br>
                <p class="text-muted">
                    <small>
                        Tool Last Updated: <a href="https://github.com/Colbydude/FFXIV-Progression-Checker" target="_blank">June 20th, 2015</a><br>
                        By <a href="https://twitter.com/Colbydude" target="_blank">@Colbydude</a> | <a href="http://na.finalfantasyxiv.com/lodestone/character/2249861/" target="_blank">Enyl Noves</a> of Leviathan
                    </small>
                </p>
            </div>
            <div class="col-sm-8">
                <div id="character-data" style="display: none;">
                    <div class="row">
                        <div class="hidden-xs col-sm-4">
                            <p><img class="img-responsive img-thumbnail" id="character_portrait" src="//placehold.it/264x360" alt="Placeholder"></p>
                        </div>
                        <div class="col-sm-8">
                            <h1 id="character_name" style="margin-top: 0;"></h1>
                            <p>
                                <strong>Active Class:</strong> <span id="active_class"></span> [<span id="active_class_level"></span>]<br>
                                <strong>Average iLvl:</strong> <span id="active_avg_ilvl"></span>
                            </p>
                            <p><a class="btn btn-primary" id="lodestone_profile" href="http://na.finalfantasyxiv.com" target="_blank">View Lodestone Profile</a></p>
                        </div>
                    </div>
                </div>
                <div id="progression-data" style="display: none;">
                    <h2>8-Man Raids</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed" id="raids-8">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Instance</th>
                                    <th>Cleared on</th>
                                    <th>Times*</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <p><small>* This number only reflects the number based off of the "The Binds that Tie" and "In Another Bind" achievements, not actual clears.<br>** Note that individual Turn clears can only roughly be determined by the "Mapping the Realm: X" achievements, so the results may not be accurate.</small></p>
                    <h2>24-Man Raids</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed" id="raids-24">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Instance</th>
                                    <th>Cleared on</th>
                                    <th>Times*</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <h2>Trials</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed" id="trials">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Instance</th>
                                    <th colspan="2">Cleared on</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div id="loading" style="display: none;">
                    <h1>Collecting data. Please wait a moment...</h1>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/js/app.min.js"></script>
@stop
