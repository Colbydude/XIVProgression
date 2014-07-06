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
		$API->parseAchievementsByCategory(1, $CharID);
		$BattleAchievements = $API->getAchievements()[1]->get();

		if ($BattleAchievements)
		{
			$Progression = array();
			$Raids = array();
			$EXPrimals = array();

			// ----- RAIDS ----- \\
			// Binding Coil of Bahamut.
			if ($BattleAchievements[55]["obtained"])
				$Raids["Binding Coil of Bahamut"] = array("cleared" => TRUE, "date" => $BattleAchievements[55]["date"], "times" => 1);
			if ($BattleAchievements[56]["obtained"])
			{
				$Raids["Binding Coil of Bahamut"]["first"] = $BattleAchievements[55]["date"];
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[56]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[57]["obtained"])
			{
				$Raids["Binding Coil of Bahamut"]["date"] = $BattleAchievements[57]["date"];
				$Raids["Binding Coil of Bahamut"]["times"] = 10;
			}

			// Labyrinth of the Ancients.
			if ($BattleAchievements[58]["obtained"])
				$Raids["Labyrinth of the Ancients"] = array("cleared" => TRUE, "date" => $BattleAchievements[58]["date"]);

			// Second Coil of Bahamut.
			if ($BattleAchievements[59]["obtained"])
				$Raids["Second Coil of Bahamut"] = array("cleared" => TRUE, "date" => $BattleAchievements[59]["date"], "times" => 1);
			if ($BattleAchievements[60]["obtained"])
			{
				$Raids["Second Coil of Bahamut"]["first"] = $BattleAchievements[59]["date"];
				$Raids["Second Coil of Bahamut"]["date"] = $BattleAchievements[60]["date"];
				$Raids["Second Coil of Bahamut"]["times"] = 5;
			}
			if ($BattleAchievements[61]["obtained"])
			{
				$Raids["Second Coil of Bahamut"]["date"] = $BattleAchievements[61]["date"];
				$Raids["Second Coil of Bahamut"]["times"] = 10;
			}

			// ----- EX Primals ----- \\
			// Ifrit EX.
			if ($BattleAchievements[50]["obtained"])
				$EXPrimals["Bowl of Embers"] = array("cleared" => TRUE, "date" => $BattleAchievements[50]["date"]);
			// Garuda EX.
			if ($BattleAchievements[51]["obtained"])
				$EXPrimals["Howling Eye"] = array("cleared" => TRUE, "date" => $BattleAchievements[51]["date"]);
			// Titan EX.
			if ($BattleAchievements[52]["obtained"])
				$EXPrimals["Navel"] = array("cleared" => TRUE, "date" => $BattleAchievements[52]["date"]);
			// Leviathan EX.
			if ($BattleAchievements[53]["obtained"])
				$EXPrimals["Whorleater"] = array("cleared" => TRUE, "date" => $BattleAchievements[53]["date"]);
			// Good King Mog EX.
			if ($BattleAchievements[54]["obtained"])
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