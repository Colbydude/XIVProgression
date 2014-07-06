<?php
	require_once("includes/lodestone-api.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>FFXIV Progression Checker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A simple tool to check a character's raid progression in FFXIV.">
		<meta name="keywords" content="FFXIV, Final Fantasy XIV, A Realm Reborn, ARR, Progression, Checker, Tool">
		<meta name="author" content="Punk Programmer">
		<link href="http://ffxiv.voidteam.net/progression" rel="canonical">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script src="//code.jquery.com/jquery.js"></script>
		<script>
			// Google Analytics
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
					<a class="navbar-brand" href="http://ffxiv.voidteam.net/progression/">FFXIV Progression Checker</a>
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
							<input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
						</div>
						<div class="form-group">
							<label for="server">Server</label>
							<select id="server" name="server" class="form-control">
								<option value="Adamantoise">Adamantoise</option>
								<option value="Aegis">Aegis</option>
								<option value="Alexander">Alexander</option>
								<option value="Anima">Anima</option>
								<option value="Asura">Asura</option>
								<option value="Atomos">Atomos</option>
								<option value="Bahamut">Bahamut</option>
								<option value="Balmung">Balmung</option>
								<option value="Behemoth">Behemoth</option>
								<option value="Belias">Belias</option>
								<option value="Brynhildr">Brynhildr</option>
								<option value="Cactuar">Cactuar</option>
								<option value="Carbuncle">Carbuncle</option>
								<option value="Cerberus">Cerberus</option>
								<option value="Chocobo">Chocobo</option>
								<option value="Coeurl">Coeurl</option>
								<option value="Diabolos">Diabolos</option>
								<option value="Durandal">Durandal</option>
								<option value="Excalibur">Excalibur</option>
								<option value="Exodus">Exodus</option>
								<option value="Faerie">Faerie</option>
								<option value="Famfrit">Famfrit</option>
								<option value="Fenrir">Fenrir</option>
								<option value="Garuda">Garuda</option>
								<option value="Gilgamesh">Gilgamesh</option>
								<option value="Goblin">Goblin</option>
								<option value="Gungnir">Gungnir</option>
								<option value="Hades">Hades</option>
								<option value="Hyperion">Hyperion</option>
								<option value="Ifrit">Ifrit</option>
								<option value="Ixion">Ixion</option>
								<option value="Jenova">Jenova</option>
								<option value="Kujata">Kujata</option>
								<option value="Lamia">Lamia</option>
								<option value="Leviathan">Leviathan</option>
								<option value="Lich">Lich</option>
								<option value="Malboro">Malboro</option>
								<option value="Mandragora">Mandragora</option>
								<option value="Masamune">Masamune</option>
								<option value="Mateus">Mateus</option>
								<option value="Midgardsormr">Midgardsormr</option>
								<option value="Moogle">Moogle</option>
								<option value="Odin">Odin</option>
								<option value="Pandaemonium">Pandaemonium</option>
								<option value="Phoenix">Phoenix</option>
								<option value="Ragnarok">Ragnarok</option>
								<option value="Ramuh">Ramuh</option>
								<option value="Ridill">Ridill</option>
								<option value="Sargatanas">Sargatanas</option>
								<option value="Shinryu">Shinryu</option>
								<option value="Shiva">Shiva</option>
								<option value="Siren">Siren</option>
								<option value="Tiamat">Tiamat</option>
								<option value="Titan">Titan</option>
								<option value="Tonberry">Tonberry</option>
								<option value="Typhon">Typhon</option>
								<option value="Ultima">Ultima</option>
								<option value="Ultros">Ultros</option>
								<option value="Unicorn">Unicorn</option>
								<option value="Valefor">Valefor</option>
								<option value="Yojimbo">Yojimbo</option>
								<option value="Zalera">Zalera</option>
								<option value="Zeromus">Zeromus</option>
								<option value="Zodiark">Zodiark</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Check</button>
					</form>
					<br>
					<p class="text-muted"><small>Tool Last Updated: June 5th 2014<br>By <a href="https:/twitter.com/Colbydude" target="_blank">@Colbydude</a> | <a href="http://na.finalfantasyxiv.com/lodestone/character/2249861/" target="_blank">Enyl Noves</a> of Leviathan</small></p>
				</div>
				<div class="col-sm-8">
					<div id="data">
						<h2>Raids</h2>
						<div class="table-responsive">
							<table class="table table-striped table-condensed" id="raids">
								
							</table>
						</div>
						<h2>EX Primals</h2>
						<div class="table-responsive">
							<table class="table table-striped table-condensed" id="ex-primals">

							</table>
						</div>
					</div>
					<div id="loading" style="display: none;">
						<h1 style="margin-top: 0;">Collecting data. Please wait a moment...</h1>
					</div>
				</div>
			</div>
		</div>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="js/application.js"></script>
	</body>
</html>