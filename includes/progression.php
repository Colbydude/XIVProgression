<?php
	// Force turn off any error reporting (cause this is kind of sloppy).
	error_reporting(0);

	// Require API.
	require_once("lodestone-api.php");

	// Initialize a LodestoneAPI Obkect
	$API = new LodestoneAPI();

	// Variables.
	$name = urldecode($_GET["name"]);
	$server = urldecode($_GET["server"]);

	// Parse the character.
	$Character = $API->get(array(
		"name" => $name, 
		"server" => $server
	));

	if ($Character)
	{
		$CharID = $Character->getID();

		// Parse achievements
		// Kind of sketchy on using all these absolute numbers, need to find a better way to do this if possible.
		$API->parseAchievementsByCategory(1, $CharID);
		$BattleAchievements = $API->getAchievements()[1]->get();
		$API->parseAchievementsByCategory(11, $CharID);					// Why is this 11 and not 7?
		$ExplorationAchievements = $API->getAchievements()[11]->get();
		if ($BattleAchievements && $ExplorationAchievements)
		{
			$Progression = array();
			$Raids = array("Binding Coil of Bahamut" => array("cleared" => FALSE), "Labyrinth of the Ancients" => array("cleared" => FALSE), "Second Coil of Bahamut" => array("cleared" => FALSE));
				$BCoBTurns = array("Turn 1" => array("explored" => FALSE), "Turn 2" => array("explored" => FALSE), "Turn 3" => array("explored" => FALSE), "Turn 4" => array("explored" => "Unknown"), "Turn 5" => array("explored" => FALSE));
				$SCoBTurns = array("Turn 1" => array("explored" => FALSE), "Turn 2" => array("explored" => FALSE), "Turn 3" => array("explored" => FALSE), "Turn 4" => array("explored" => "Unknown"));
			$EXPrimals = array("Bowl of Embers" => array("cleared" => FALSE), "Howling Eye" => array("cleared" => FALSE), "Navel" => array("cleared" => FALSE), "Whorleater" => array("cleared" => FALSE), "Thornmarch" => array("cleared" => FALSE));

			// ----- RAIDS ----- \\
			// Binding Coil of Bahamut.

			// --- Individual Turns --- \\
			if ($ExplorationAchievements[11]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut I
			{
				$BCoBTurns["Turn 1"]["explored"] = TRUE;
				$BCoBTurns["Turn 1"]["date"] = $ExplorationAchievements[11]["date"];
			}
			if ($ExplorationAchievements[12]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut II
			{
				$BCoBTurns["Turn 2"]["explored"] = TRUE;
				$BCoBTurns["Turn 2"]["date"] = $ExplorationAchievements[12]["date"];
			}
			if ($ExplorationAchievements[13]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut III
			{
				$BCoBTurns["Turn 3"]["explored"] = TRUE;
				$BCoBTurns["Turn 3"]["date"] = $ExplorationAchievements[13]["date"];
			}
			if ($ExplorationAchievements[14]["obtained"])	// Mapping the Realm: The Binding Coil of Bahamut V
			{
				$BCoBTurns["Turn 5"]["explored"] = TRUE;
				$BCoBTurns["Turn 5"]["date"] = $ExplorationAchievements[14]["date"];
			}

			// --- Full Clears --- \\
			if ($BattleAchievements[55]["obtained"])	// The Binds that Tie I
			{
				$Raids["Binding Coil of Bahamut"]["cleared"] = TRUE;
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[55]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 1;
			}
			if ($BattleAchievements[56]["obtained"])	// The Binds that Tie II
			{
				$Raids["Binding Coil of Bahamut"]["first"] = $BattleAchievements[55]["date"];
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[56]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[57]["obtained"])	// The Binds that Tie III
			{
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[57]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 10;
			}

			$Raids["Binding Coil of Bahamut"]["turns"] = $BCoBTurns;

			// Labyrinth of the Ancients.
			if ($BattleAchievements[58]["obtained"])	// You Call That a Labyrinth
				$Raids["Labyrinth of the Ancients"] = array("cleared" => TRUE, "date" => $BattleAchievements[58]["date"]);

			// Second Coil of Bahamut.

			// --- Individual Turns --- \\
			if ($ExplorationAchievements[25]["obtained"])	// Mapping the Realm: The Second Coil of Bahamut I
			{
				$SCoBTurns["Turn 1"]["explored"] = TRUE;
				$SCoBTurns["Turn 1"]["date"] = $ExplorationAchievements[25]["date"];
			}
			if ($ExplorationAchievements[26]["obtained"])	// Mapping the Realm: The Second Coil of Bahamut II
			{
				$SCoBTurns["Turn 2"]["explored"] = TRUE;
				$SCoBTurns["Turn 2"]["date"] = $ExplorationAchievements[26]["date"];
			}
			if ($ExplorationAchievements[27]["obtained"])	// Mapping the Realm: The Second Coil of Bahamut III
			{
				$SCoBTurns["Turn 3"]["explored"] = TRUE;
				$SCoBTurns["Turn 3"]["date"] = $ExplorationAchievements[27]["date"];
			}

			// --- Full Clears --- \\
			if ($BattleAchievements[59]["obtained"])	// In Another Bind I
				$Raids["Second Coil of Bahamut"] = array("cleared" => TRUE, "date" => $BattleAchievements[59]["date"], "times" => 1);
			if ($BattleAchievements[60]["obtained"])	// In Another Bind II
			{
				$Raids["Second Coil of Bahamut"]["first"] = $BattleAchievements[59]["date"];
				$Raids["Second Coil of Bahamut"]["date"] = $BattleAchievements[60]["date"];
				$Raids["Second Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[61]["obtained"])	// In Another Bind III
			{
				$Raids["Second Coil of Bahamut"]["date"] = $BattleAchievements[61]["date"];
				$Raids["Second Coil of Bahamut"]["times"] = 10;
			}

			$Raids["Second Coil of Bahamut"]["turns"] = $SCoBTurns;

			// ----- EX Primals ----- \\
			// Ifrit EX.
			if ($BattleAchievements[50]["obtained"])	// Going Up in Flames
				$EXPrimals["Bowl of Embers"] = array("cleared" => TRUE, "date" => $BattleAchievements[50]["date"]);
			// Garuda EX.
			if ($BattleAchievements[51]["obtained"])	// Gone with the Wind
				$EXPrimals["Howling Eye"] = array("cleared" => TRUE, "date" => $BattleAchievements[51]["date"]);
			// Titan EX.
			if ($BattleAchievements[52]["obtained"])	// Earth to Earth
				$EXPrimals["Navel"] = array("cleared" => TRUE, "date" => $BattleAchievements[52]["date"]);
			// Leviathan EX.
			if ($BattleAchievements[53]["obtained"])	// I Eat Whorls for Breakfast
				$EXPrimals["Whorleater"] = array("cleared" => TRUE, "date" => $BattleAchievements[53]["date"]);
			// Good King Mog EX.
			if ($BattleAchievements[54]["obtained"])	// Good Kingslayer
				$EXPrimals["Thornmarch"] = array("cleared" => TRUE, "date" => $BattleAchievements[54]["date"]);

			$Progression["Raids"] = $Raids;
			$Progression["EX Primals"] = $EXPrimals;
		}
		else
		{
			$Progression = array("Error" => "This character does not have public achievement viewing enabled.");
		}
	}
	else
	{
		$Progression = array("Error" => "Character not found.");
	}

	// Display in JSON.
	echo json_encode($Progression);
?>