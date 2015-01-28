<?php header('Content-Type: application/json');

	// TODO: L2API

	// Force turn off any error reporting (cause this is kind of sloppy).
	error_reporting(0);

	// Require API.
	require_once("../../vendor/viion/xivpads-lodestoneapi/API.php");

	// Initialize a LodestoneAPI Object
	$API = new LodestoneAPI();

	// Variables.
	$name = urldecode($_GET["name"]);
	$server = urldecode($_GET["server"]);

	// Output arrays.
	$Output = array();
	$Char = array();
	$Progression = array();

	// Parse the character.
	$Character = $API->get(array(
		"name" => $name, 
		"server" => $server
	));

	if ($Character)
	{
		// Associate Character Data.
		$Char = array(
			"id" => $Character->getID(),
			"name" => $name,
			"server" => $server,
			"profile" => $Character->getLodestone(),
			"portrait" => $Character->getPortrait(),
			"active_class" => ucfirst(trim($Character->getActiveClass())),
			"active_class_level" => $Character->getActiveLevel(),
			"active_avg_ilvl" => $Character->getGear()["item_level_average"]
		);

		if ($Character->getActiveJob())
			$Char["active_class"] = ucfirst(trim($Character->getActiveJob()["name"]));

		// Parse achievements
		// Kind of sketchy on using all these absolute numbers, need to find a better way to do this if possible.
		$BattleAchievements = $API->parseAchievementsByCategory(1, $Char["id"]);
		$ExplorationAchievements = $API->parseAchievementsByCategory(11, $Char["id"]);
		
		if ($BattleAchievements && $ExplorationAchievements)
		{
			$BattleAchievements = $BattleAchievements->get();
			$ExplorationAchievements = $ExplorationAchievements->get();

			$Progression = array();
			$Raids = array(
				"Binding Coil of Bahamut" => array("cleared" => FALSE),
				"Second Coil of Bahamut" => array("cleared" => FALSE),
				"Second Coil of Bahamut (Savage)" => array("cleared" => FALSE),
				"Final Coil of Bahamut" => array("cleared" => FALSE),
				"Labyrinth of the Ancients" => array("cleared" => FALSE),
				"Syrcus Tower" => array("cleared" => FALSE),
				"World of Darkness" => array("cleared" => FALSE)
			);

			$BCoBTurns = array("Turn 1" => array("explored" => FALSE), "Turn 2" => array("explored" => FALSE), "Turn 3" => array("explored" => FALSE), "Turn 4" => array("explored" => "Unknown"), "Turn 5" => array("explored" => FALSE));
			$SCoBTurns = array("Turn 1" => array("explored" => FALSE), "Turn 2" => array("explored" => FALSE), "Turn 3" => array("explored" => FALSE), "Turn 4" => array("explored" => "Unknown"));
			$SCoBSTurns = array("Turn 1" => array("cleared" => FALSE), "Turn 2" => array("cleared" => FALSE), "Turn 3" => array("cleared" => FALSE), "Turn 4" => array("cleared" => FALSE));
			$FCoBTurns = array("Turn 1" => array("explored" => FALSE), "Turn 2" => array("explored" => FALSE), "Turn 3" => array("explored" => "Unknown"), "Turn 4" => array("explored" => "Unknown"));

			$Trials = array(
				"Bowl of Embers" => array("cleared" => FALSE),
				"Howling Eye" => array("cleared" => FALSE),
				"Navel" => array("cleared" => FALSE),
				"Whorleater" => array("cleared" => FALSE),
				"Thornmarch" => array("cleared" => FALSE),
				"Striking Tree" => array("cleared" => FALSE),
				"Akh Afah Amphitheatre" => array("cleared" => FALSE),
				"Urth's Fount" => array("cleared" => FALSE),
				"Battle in the Big Keep" => array("cleared" => FALSE),
				"Chrysalis" => array("cleared" => FALSE)
			);

			// ----- RAIDS ----- \\
			// Binding Coil of Bahamut.

			// --- Individual Turns --- \\
			if ($ExplorationAchievements[680]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut I
			{
				$BCoBTurns["Turn 1"]["explored"] = TRUE;
				$BCoBTurns["Turn 1"]["date"] = $ExplorationAchievements[680]["date"];
			}
			if ($ExplorationAchievements[681]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut II
			{
				$BCoBTurns["Turn 2"]["explored"] = TRUE;
				$BCoBTurns["Turn 2"]["date"] = $ExplorationAchievements[681]["date"];
			}
			if ($ExplorationAchievements[682]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut III
			{
				$BCoBTurns["Turn 3"]["explored"] = TRUE;
				$BCoBTurns["Turn 3"]["date"] = $ExplorationAchievements[682]["date"];
			}
			if ($ExplorationAchievements[684]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut V
			{
				$BCoBTurns["Turn 5"]["explored"] = TRUE;
				$BCoBTurns["Turn 5"]["date"] = $ExplorationAchievements[684]["date"];
			}

			// --- Full Clears --- \\
			if ($BattleAchievements[747]["obtained"])	// The Binds that Tie I
			{
				$Raids["Binding Coil of Bahamut"]["cleared"] = TRUE;
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[747]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 1;
			}
			if ($BattleAchievements[748]["obtained"])	// The Binds that Tie II
			{
				$Raids["Binding Coil of Bahamut"]["first"] = $BattleAchievements[747]["date"];
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[748]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[749]["obtained"])	// The Binds that Tie III
			{
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[749]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 10;
			}

			$Raids["Binding Coil of Bahamut"]["turns"] = $BCoBTurns;

			// Second Coil of Bahamut.

			// --- Individual Turns --- \\
			if ($ExplorationAchievements[890]["obtained"])	// Mapping the Realm: The Second Coil of Bahamut I
			{
				$SCoBTurns["Turn 1"]["explored"] = TRUE;
				$SCoBTurns["Turn 1"]["date"] = $ExplorationAchievements[890]["date"];
			}
			if ($ExplorationAchievements[891]["obtained"])	// Mapping the Realm: The Second Coil of Bahamut II
			{
				$SCoBTurns["Turn 2"]["explored"] = TRUE;
				$SCoBTurns["Turn 2"]["date"] = $ExplorationAchievements[891]["date"];
			}
			if ($ExplorationAchievements[892]["obtained"])	// Mapping the Realm: The Second Coil of Bahamut III
			{
				$SCoBTurns["Turn 3"]["explored"] = TRUE;
				$SCoBTurns["Turn 3"]["date"] = $ExplorationAchievements[892]["date"];
			}

			// --- Full Clears --- \\
			if ($BattleAchievements[887]["obtained"])	// In Another Bind I
				$Raids["Second Coil of Bahamut"] = array("cleared" => TRUE, "date" => $BattleAchievements[887]["date"], "times" => 1);
			if ($BattleAchievements[888]["obtained"])	// In Another Bind II
			{
				$Raids["Second Coil of Bahamut"]["first"] = $BattleAchievements[887]["date"];
				$Raids["Second Coil of Bahamut"]["date"] = $BattleAchievements[888]["date"];
				$Raids["Second Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[889]["obtained"])	// In Another Bind III
			{
				$Raids["Second Coil of Bahamut"]["date"] = $BattleAchievements[889]["date"];
				$Raids["Second Coil of Bahamut"]["times"] = 10;
			}

			$Raids["Second Coil of Bahamut"]["turns"] = $SCoBTurns;

			// Second Coil of Bahamut (Savage).

			// --- Individual Turns --- \\
			if ($BattleAchievements[997]["obtained"])	// A Flower By Any Other Name
			{
				$SCoBSTurns["Turn 1"]["cleared"] = TRUE;
				$SCoBSTurns["Turn 1"]["date"] = $BattleAchievements[997]["date"];
			}
			if ($BattleAchievements[998]["obtained"])	// Seconds
			{
				$SCoBSTurns["Turn 2"]["cleared"] = TRUE;
				$SCoBSTurns["Turn 2"]["date"] = $BattleAchievements[998]["date"];
			}
			if ($BattleAchievements[999]["obtained"])	// Obtanium
			{
				$SCoBSTurns["Turn 3"]["cleared"] = TRUE;
				$SCoBSTurns["Turn 3"]["date"] = $BattleAchievements[999]["date"];
			}
			if ($BattleAchievements[1000]["obtained"])	// The Crying Game
			{
				$SCoBSTurns["Turn 4"]["cleared"] = TRUE;
				$SCoBSTurns["Turn 4"]["date"] = $BattleAchievements[1000]["date"];
			}

			// --- Full Clears --- \\
			if ($SCoBSTurns["Turn 1"]["cleared"] && $SCoBSTurns["Turn 2"]["cleared"] && $SCoBSTurns["Turn 3"]["cleared"] && $SCoBSTurns["Turn 4"]["cleared"])
				$Raids["Second Coil of Bahamut (Savage)"] = array("cleared" => TRUE);

			$Raids["Second Coil of Bahamut (Savage)"]["turns"] = $SCoBSTurns;

			// Final Coil of Bahamut.

			// --- Individual Turns --- \\
			if ($ExplorationAchievements[1043]["obtained"])	// Mapping the Realm: The Final Coil of Bahamut I
			{
				$FCoBTurns["Turn 1"]["explored"] = TRUE;
				$FCoBTurns["Turn 1"]["date"] = $ExplorationAchievements[1043]["date"];
			}
			if ($ExplorationAchievements[1044]["obtained"])	// Mapping the Realm: The Final Coil of Bahamut II
			{
				$FCoBTurns["Turn 2"]["explored"] = TRUE;
				$FCoBTurns["Turn 2"]["date"] = $ExplorationAchievements[1044]["date"];
			}

			// --- Full Clears --- \\
			if ($BattleAchievements[1040]["obtained"])	// Out of a Bind I
				$Raids["Final Coil of Bahamut"] = array("cleared" => TRUE, "date" => $BattleAchievements[1040]["date"], "times" => 1);
			if ($BattleAchievements[1041]["obtained"])	// Out of a Bind II
			{
				$Raids["Final Coil of Bahamut"]["first"] = $BattleAchievements[1040]["date"];
				$Raids["Final Coil of Bahamut"]["date"] = $BattleAchievements[1041]["date"];
				$Raids["Final Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[1042]["obtained"])	// Out of a Bind III
			{
				$Raids["Final Coil of Bahamut"]["date"] = $BattleAchievements[1042]["date"];
				$Raids["Final Coil of Bahamut"]["times"] = 10;
			}

			$Raids["Final Coil of Bahamut"]["turns"] = $FCoBTurns;

			// Labyrinth of the Ancients.
			if ($BattleAchievements[883]["obtained"])	// You Call That a Labyrinth
				$Raids["Labyrinth of the Ancients"] = array("cleared" => TRUE, "date" => $BattleAchievements[883]["date"]);

			// Syrcus Tower.
			if ($BattleAchievements[995]["obtained"])	// Life is a Syrcus
				$Raids["Syrcus Tower"] = array("cleared" => TRUE, "date" => $BattleAchievements[995]["date"]);

			// World of Darkness.
			if ($BattleAchievements[1068]["obtained"])	// Let the Sun Shine In
				$Raids["World of Darkness"] = array("cleared" => TRUE, "date" => $BattleAchievements[1068]["date"]);

			// ----- EX Primals ----- \\
			// Ifrit EX.
			if ($BattleAchievements[855]["obtained"])	// Going Up in Flames
				$Trials["Bowl of Embers"] = array("cleared" => TRUE, "date" => $BattleAchievements[855]["date"]);
			// Garuda EX.
			if ($BattleAchievements[856]["obtained"])	// Gone with the Wind
				$Trials["Howling Eye"] = array("cleared" => TRUE, "date" => $BattleAchievements[856]["date"]);
			// Titan EX.
			if ($BattleAchievements[857]["obtained"])	// Earth to Earth
				$Trials["Navel"] = array("cleared" => TRUE, "date" => $BattleAchievements[857]["date"]);
			// Leviathan EX.
			if ($BattleAchievements[893]["obtained"])	// I Eat Whorls for Breakfast
				$Trials["Whorleater"] = array("cleared" => TRUE, "date" => $BattleAchievements[893]["date"]);
			// Good King Mog EX.
			if ($BattleAchievements[894]["obtained"])	// Good Kingslayer
				$Trials["Thornmarch"] = array("cleared" => TRUE, "date" => $BattleAchievements[894]["date"]);
			// Ramuh EX.
			if ($BattleAchievements[994]["obtained"])	// Contempt of Court
				$Trials["Striking Tree"] = array("cleared" => TRUE, "date" => $BattleAchievements[994]["date"]);
			// Shiva EX.
			if ($BattleAchievements[1045]["obtained"])	// Let It Go
				$Trials["Akh Afah Amphitheatre"] = array("cleared" => TRUE, "date" => $BattleAchievements[1045]["date"]);
			// Odin EX.
			if ($BattleAchievements[1064]["obtained"])	// Missed The Cut
				$Trials["Urth's Fount"] = array("cleared" => TRUE, "date" => $BattleAchievements[1064]["date"]);
			// Gilgamesh EX.
			if ($BattleAchievements[1066]["obtained"])	// Enough Expository Banter
				$Trials["Battle in the Big Keep"] = array("cleared" => TRUE, "date" => $BattleAchievements[1066]["date"]);
			// Nabriales.
			if ($BattleAchievements[1067]["obtained"])	// Secret Ascian Man
				$Trials["Chrysalis"] = array("cleared" => TRUE, "date" => $BattleAchievements[1067]["date"]);

			$Progression["Raids"] = $Raids;
			$Progression["Trials"] = $Trials;
		}
		else
		{
			$Progression = array("Error" => "This character does not have public achievement viewing enabled.");
		}
	}
	else
	{
		$Char = array("Error" => "Character not found.");
	}
	
	// Combine arrays.
	$Output = array("Character" => $Char, "Progression" => $Progression);

	// Display in JSON.
	echo json_encode($Output);
