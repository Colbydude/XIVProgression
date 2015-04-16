<?php
	require_once("vendor/viion/xivpads-lodestoneapi/API.php");

	if (isset($_GET["name"]))
		$name = urldecode($_GET["name"]);
	else
		$name = NULL;

	if (isset($_GET["server"]))
		$server = urldecode($_GET["server"]);
	else
		$server = NULL;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>FFXIV Progression Checker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A simple tool to check a character's raid progression in FFXIV.">
		<meta name="keywords" content="FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Progression, Checker, Tool">
		<meta name="author" content="VoidTeam">
		<link href="http://ffxiv.voidteam.net/progression" rel="canonical">
		<link href="css/app.min.css" rel="stylesheet">
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-44795853-2', 'auto');
			ga('send', 'pageview');
		</script>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">FFXIV Progression Checker</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://github.com/Colbydude/FFXIV-Progression-Checker" target="_blank">GitHub</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<form id="check-form">
						<div class="form-group">
							<label for="name">Character Name</label>
							<input type="text" id="name" name="name" class="form-control" <?php echo isset($name) ? 'value="'.urldecode($_GET["name"]).'"' : ''; ?> placeholder="John Doe" required>
						</div>
						<div class="form-group">
							<label for="server">Server</label>
							<select id="server" name="server" class="form-control">
								<option value="Adamantoise" <?php echo $server == "Adamantoise" ? "selected" : ''; ?>>Adamantoise</option>
								<option value="Aegis" <?php echo $server == "Aegis" ? "selected" : ''; ?>>Aegis</option>
								<option value="Alexander" <?php echo $server == "Alexander" ? "selected" : ''; ?>>Alexander</option>
								<option value="Anima" <?php echo $server == "Anima" ? "selected" : ''; ?>>Anima</option>
								<option value="Asura" <?php echo $server == "Asura" ? "selected" : ''; ?>>Asura</option>
								<option value="Atomos" <?php echo $server == "Atomos" ? "selected" : ''; ?>>Atomos</option>
								<option value="Bahamut" <?php echo $server == "Bahamut" ? "selected" : ''; ?>>Bahamut</option>
								<option value="Balmung" <?php echo $server == "Balmung" ? "selected" : ''; ?>>Balmung</option>
								<option value="Behemoth" <?php echo $server == "Behemoth" ? "selected" : ''; ?>>Behemoth</option>
								<option value="Belias" <?php echo $server == "Belias" ? "selected" : ''; ?>>Belias</option>
								<option value="Brynhildr" <?php echo $server == "Brynhildr" ? "selected" : ''; ?>>Brynhildr</option>
								<option value="Cactuar" <?php echo $server == "Cactuar" ? "selected" : ''; ?>>Cactuar</option>
								<option value="Carbuncle" <?php echo $server == "Carbuncle" ? "selected" : ''; ?>>Carbuncle</option>
								<option value="Cerberus" <?php echo $server == "Cerberus" ? "selected" : ''; ?>>Cerberus</option>
								<option value="Chocobo" <?php echo $server == "Chocobo" ? "selected" : ''; ?>>Chocobo</option>
								<option value="Coeurl" <?php echo $server == "Coeurl" ? "selected" : ''; ?>>Coeurl</option>
								<option value="Diabolos" <?php echo $server == "Diabolos" ? "selected" : ''; ?>>Diabolos</option>
								<option value="Durandal" <?php echo $server == "Durandal" ? "selected" : ''; ?>>Durandal</option>
								<option value="Excalibur" <?php echo $server == "Excalibur" ? "selected" : ''; ?>>Excalibur</option>
								<option value="Exodus" <?php echo $server == "Exodus" ? "selected" : ''; ?>>Exodus</option>
								<option value="Faerie" <?php echo $server == "Faerie" ? "selected" : ''; ?>>Faerie</option>
								<option value="Famfrit" <?php echo $server == "Famfrit" ? "selected" : ''; ?>>Famfrit</option>
								<option value="Fenrir" <?php echo $server == "Fenrir" ? "selected" : ''; ?>>Fenrir</option>
								<option value="Garuda" <?php echo $server == "Garuda" ? "selected" : ''; ?>>Garuda</option>
								<option value="Gilgamesh" <?php echo $server == "Gilgamesh" ? "selected" : ''; ?>>Gilgamesh</option>
								<option value="Goblin" <?php echo $server == "Goblin" ? "selected" : ''; ?>>Goblin</option>
								<option value="Gungnir" <?php echo $server == "Gungnir" ? "selected" : ''; ?>>Gungnir</option>
								<option value="Hades" <?php echo $server == "Hades" ? "selected" : ''; ?>>Hades</option>
								<option value="Hyperion" <?php echo $server == "Hyperion" ? "selected" : ''; ?>>Hyperion</option>
								<option value="Ifrit" <?php echo $server == "Ifrit" ? "selected" : ''; ?>>Ifrit</option>
								<option value="Ixion" <?php echo $server == "Ixion" ? "selected" : ''; ?>>Ixion</option>
								<option value="Jenova" <?php echo $server == "Jenova" ? "selected" : ''; ?>>Jenova</option>
								<option value="Kujata" <?php echo $server == "Kujata" ? "selected" : ''; ?>>Kujata</option>
								<option value="Lamia" <?php echo $server == "Lamia" ? "selected" : ''; ?>>Lamia</option>
								<option value="Leviathan" <?php echo $server == "Leviathan" ? "selected" : ''; ?>>Leviathan</option>
								<option value="Lich" <?php echo $server == "Lich" ? "selected" : ''; ?>>Lich</option>
								<option value="Malboro" <?php echo $server == "Malboro" ? "selected" : ''; ?>>Malboro</option>
								<option value="Mandragora" <?php echo $server == "Mandragora" ? "selected" : ''; ?>>Mandragora</option>
								<option value="Masamune" <?php echo $server == "Masamune" ? "selected" : ''; ?>>Masamune</option>
								<option value="Mateus" <?php echo $server == "Mateus" ? "selected" : ''; ?>>Mateus</option>
								<option value="Midgardsormr" <?php echo $server == "Midgardsormr" ? "selected" : ''; ?>>Midgardsormr</option>
								<option value="Moogle" <?php echo $server == "Moogle" ? "selected" : ''; ?>>Moogle</option>
								<option value="Odin" <?php echo $server == "Odin" ? "selected" : ''; ?>>Odin</option>
								<option value="Pandaemonium" <?php echo $server == "Pandaemonium" ? "selected" : ''; ?>>Pandaemonium</option>
								<option value="Phoenix" <?php echo $server == "Phoenix" ? "selected" : ''; ?>>Phoenix</option>
								<option value="Ragnarok" <?php echo $server == "Ragnarok" ? "selected" : ''; ?>>Ragnarok</option>
								<option value="Ramuh" <?php echo $server == "Ramuh" ? "selected" : ''; ?>>Ramuh</option>
								<option value="Ridill" <?php echo $server == "Ridill" ? "selected" : ''; ?>>Ridill</option>
								<option value="Sargatanas" <?php echo $server == "Sargatanas" ? "selected" : ''; ?>>Sargatanas</option>
								<option value="Shinryu" <?php echo $server == "Shinryu" ? "selected" : ''; ?>>Shinryu</option>
								<option value="Shiva" <?php echo $server == "Shiva" ? "selected" : ''; ?>>Shiva</option>
								<option value="Siren" <?php echo $server == "Siren" ? "selected" : ''; ?>>Siren</option>
								<option value="Tiamat" <?php echo $server == "Tiamat" ? "selected" : ''; ?>>Tiamat</option>
								<option value="Titan" <?php echo $server == "Titan" ? "selected" : ''; ?>>Titan</option>
								<option value="Tonberry" <?php echo $server == "Tonberry" ? "selected" : ''; ?>>Tonberry</option>
								<option value="Typhon" <?php echo $server == "Typhon" ? "selected" : ''; ?>>Typhon</option>
								<option value="Ultima" <?php echo $server == "Ultima" ? "selected" : ''; ?>>Ultima</option>
								<option value="Ultros" <?php echo $server == "Ultros" ? "selected" : ''; ?>>Ultros</option>
								<option value="Unicorn" <?php echo $server == "Unicorn" ? "selected" : ''; ?>>Unicorn</option>
								<option value="Valefor" <?php echo $server == "Valefor" ? "selected" : ''; ?>>Valefor</option>
								<option value="Yojimbo" <?php echo $server == "Yojimbo" ? "selected" : ''; ?>>Yojimbo</option>
								<option value="Zalera" <?php echo $server == "Zalera" ? "selected" : ''; ?>>Zalera</option>
								<option value="Zeromus" <?php echo $server == "Zeromus" ? "selected" : ''; ?>>Zeromus</option>
								<option value="Zodiark" <?php echo $server == "Zodiark" ? "selected" : ''; ?>>Zodiark</option>
							</select>
						</div>
						<button type="submit" id="submit" name="submit" class="btn btn-primary">Check</button>
					</form>
					<br>
					<p class="text-muted">
						<small>
							Tool Last Updated: <a href="https://github.com/Colbydude/FFXIV-Progression-Checker" target="_blank">April 2nd, 2015</a><br>
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
										<th>Cleared on</th>
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

		<script src="js/app.min.js"></script>
	</body>
</html>
