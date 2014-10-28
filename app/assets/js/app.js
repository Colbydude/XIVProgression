$(document).ready(function ()
{
	// Get data immediately if URL parameters are defined.
	var name = $("#name").val().trim();
	var server = $("#server").val().trim();
	if (name.length && server.length)
	{
		checkProgression();
	}

	$("#check-form").submit(function (e)
	{
		e.preventDefault();
		checkProgression();
		history.pushState({}, "", "?name=" + $("#name").val() + "&server=" + $("#server").val());
	});
});

function checkProgression()
{
	$("#character-data").hide();
	$("#progression-data").hide();
	$("#loading").show();

	$("#loading h1").text("Collecting data. Please wait a moment...");
	$.ajax(
		{
			type: "GET",
			url: 'app/includes/progression.php',
			dataType: "json",
			data:{
				name: $("#name").val(),
				server: $("#server").val()
			},
			success: function (data)
			{
				if ("Error" in data["Character"])
				{
					$("#loading h1").text(data["Character"]["Error"]);
				}
				else
				{
					updateDetails(data);
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{
				// Error actions
				$("#loading h1").text("A failure occurred in attempting to fetch the data.");
			}
		});
}

function updateDetails(data)
{
	// Character Data.
	$("#character_portrait").attr("src", data["Character"]["portrait"]);
	$("#character_name").text(data["Character"]["name"]);
	$("#lodestone_profile").attr("href", data["Character"]["profile"]);
	$("#active_class").html(data["Character"]["active_class"]);
	$("#active_class_level").html(data["Character"]["active_class_level"]);
	$("#active_avg_ilvl").html(data["Character"]["active_avg_ilvl"]);

	$("#character-data").show();

	// There's probably a shorter and better way to do this, but this'll do for now.

	// ----- Raids ----- \\
	if (!("Error" in data["Progression"]))
	{
		raids_string = "";

		// Binding Coil of Bahamut.
		if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Binding Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr>";
			raids_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000607.png?patch=240\" alt=\"The Binds that Tie\"></td>";
			raids_string += "<td>Binding Coil of Bahamut</td>";
			if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Progression"]["Raids"]["Binding Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_string += "<td>" + data["Progression"]["Raids"]["Binding Coil of Bahamut"]["times"] + "</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000607.png?patch=240\" alt=\"The Binds that Tie\"></td><td colspan=\"3\">Binding Coil of Bahamut</td></tr>";
		}
		// Individual BCoB Turns.
		for (i = 0; i < 5; i++)
		{
			if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
			{
				explore_date = new Date();
				explore_date.setTime((data["Progression"]["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_string += "<tr class=\"small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=240\" alt=\"Mapping The Realm: The Binding Coil of Bahamut\"></td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "</tr>";
			}
			else if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
			{
				raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td colspan=\"2\">No corresponding achievement</td>";
				raids_string += "</tr>";
			}
			else
			{
				raids_string += "<tr class=\"danger small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=240\" alt=\"Mapping The Realm: The Binding Coil of Bahamut\"></td>";
				raids_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_string += "</tr>";
			}
		}

		// Labyrinth of the Ancients.
		if (data["Progression"]["Raids"]["Labyrinth of the Ancients"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Labyrinth of the Ancients"]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr>";
			raids_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=240\" alt=\"You Call That A Labyrinth\"></td>";
			raids_string += "<td>Labyrinth of the Ancients</td>";
			raids_string += "<td colspan=\"2\">" + clear_date.toDateString() + "</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=240\" alt=\"You Call That A Labyrinth\"></td><td colspan=\"3\">Labyrinth of the Ancients</td></tr>";
		}

		// Second Coil of Bahamut.
		if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr>";
			raids_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=240\" alt=\"In Another Bind\"></td>";
			raids_string += "<td>Second Coil of Bahamut</td>";
			if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_string += "<td>" + data["Progression"]["Raids"]["Second Coil of Bahamut"]["times"] + "</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=240\" alt=\"In Another Bind\"></td><td colspan=\"3\">Second Coil of Bahamut</td></tr>";
		}
		// Individual SCoB Turns.
		for (i = 0; i < 4; i++)
		{
			if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
			{
				explore_date = new Date();
				explore_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_string += "<tr class=\"small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=240\" alt=\"Mapping The Realm: The Second Coil of Bahamut\"></td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "</tr>";
			}
			else if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
			{
				raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td colspan=\"2\">No corresponding achievement</td>";
				raids_string += "</tr>";
			}
			else
			{
				raids_string += "<tr class=\"danger small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=240\" alt=\"Mapping The Realm: The Second Coil of Bahamut\"></td>";
				raids_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_string += "</tr>";
			}
		}

		// Syrcus Tower.
		if (data["Progression"]["Raids"]["Syrcus Tower"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Syrcus Tower"]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr>";
			raids_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=240\" alt=\"Life Is A Syrcus\"></td>";
			raids_string += "<td>Syrcus Tower</td>";
			raids_string += "<td colspan=\"2\">" + clear_date.toDateString() + "</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=240\" alt=\"Life Is A Syrcus\"></td><td colspan=\"3\">Syrcus Tower</td></tr>";
		}

		// Second Coil of Bahamut (Savage)
		if (data["Progression"]["Raids"]["Second Coil of Bahamut (Savage)"]["cleared"])
		{
			raids_string += "<tr>";
			raids_string += "<td>&nbsp;</td>";
			raids_string += "<td colspan=\"3\">Second Coil of Bahamut (Savage)</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"3\">Second Coil of Bahamut (Savage)</td></tr>";
		}
		// Individual SCoBS Turns.
		for (i = 0; i < 4; i++)
		{
			if (data["Progression"]["Raids"]["Second Coil of Bahamut (Savage)"]["turns"]["Turn " + (i + 1)]["cleared"] == true)
			{
				clear_date = new Date();
				clear_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut (Savage)"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_string += "<tr class=\"small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=240\" alt=\"In Another Bind\"></td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td>" + clear_date.toDateString() + "</td>";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "</tr>";
			}
			else
			{
				raids_string += "<tr class=\"danger small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=240\" alt=\"In Another Bind\"></td>";
				raids_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_string += "</tr>";
			}
		}

		// Final Coil of Bahamut.
		if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Final Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr>";
			raids_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003762.png?patch=240\" alt=\"Out of a Bind\"></td>";
			raids_string += "<td>Final Coil of Bahamut</td>";
			if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Progression"]["Raids"]["Final Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_string += "<td>" + data["Progression"]["Raids"]["Final Coil of Bahamut"]["times"] + "</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003762.png?patch=240\" alt=\"Out of a Bind\"></td><td colspan=\"3\">Final Coil of Bahamut</td></tr>";
		}
		// Individual FCoB Turns.
		for (i = 0; i < 4; i++)
		{
			if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
			{
				explore_date = new Date();
				explore_date.setTime((data["Progression"]["Raids"]["Final Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_string += "<tr class=\"small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=240\" alt=\"Mapping The Realm: The Final Coil of Bahamut\"></td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "</tr>";
			}
			else if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
			{
				raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>";
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td colspan=\"2\">No corresponding achievement</td>";
				raids_string += "</tr>";
			}
			else
			{
				raids_string += "<tr class=\"danger small\">";
				raids_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=240\" alt=\"Mapping The Realm: The Final Coil of Bahamut\"></td>";
				raids_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_string += "</tr>";
			}
		}

		// ----- EX Primals ----- \\
		primals_string = "";

		// Howling Eye.
		if (data["Progression"]["EX Primals"]["Howling Eye"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Howling Eye"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Gone With The Wind\"></td>";
			primals_string += "<td>Howling Eye (Garuda)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Gone With The Wind\"></td><td colspan=\"2\">Howling Eye (Garuda)</td></tr>";
		}

		// Navel.
		if (data["Progression"]["EX Primals"]["Navel"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Navel"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Earth To Earth\"></td>";
			primals_string += "<td>Navel (Titan)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Earth To Earth\"></td><td colspan=\"2\">Navel (Titan)</td></tr>";
		}

		// Bowl of Embers.
		if (data["Progression"]["EX Primals"]["Bowl of Embers"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Bowl of Embers"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Going Up In Flames\"></td>";
			primals_string += "<td>Bowl of Embers (Ifrit)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Going Up In Flames\"></td><td colspan=\"2\">Bowl of Embers (Ifrit)</td></tr>";
		}

		// Whorleater.
		if (data["Progression"]["EX Primals"]["Whorleater"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Whorleater"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"I Eat Whorls For Breakfast\"></td>";
			primals_string += "<td><em>Whorleater</em> (Leviathan)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"I Eat Whorls For Breakfast\"></td><td colspan=\"2\"><em>Whorleater</em> (Leviathan)</td></tr>";
		}

		// Thornmarch.
		if (data["Progression"]["EX Primals"]["Thornmarch"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Thornmarch"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Good Kingslayer\"></td>";
			primals_string += "<td>Thornmarch (Good King Moggle Mog XII)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Good Kingslayer\"></td><td colspan=\"2\">Thornmarch (Good King Moggle Mog XII)</td></tr>";
		}

		// Striking Tree.
		if (data["Progression"]["EX Primals"]["Striking Tree"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Striking Tree"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Contempt Of Court\"></td>";
			primals_string += "<td>Striking Tree (Ramuh)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Contempt Of Court\"></td><td colspan=\"2\">Striking Tree (Ramuh)</td></tr>";
		}

		// Akh Afah Amphitheatre.
		if (data["Progression"]["EX Primals"]["Akh Afah Amphitheatre"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["EX Primals"]["Akh Afah Amphitheatre"]["date"] + "0000000000000").slice(0, 13));
			primals_string += "<tr>";
			primals_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Let It Go\"></td>";
			primals_string += "<td>Akh Afah Amphitheatre (Shiva)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
			primals_string += "</tr>";
		}
		else
		{
			primals_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=240\" alt=\"Let It Go\"></td><td colspan=\"2\">Akh Afah Amphitheatre (Shiva)</td></tr>";
		}

		// Output.
		$("#raids tbody").html(raids_string);
		$("#ex-primals tbody").html(primals_string);

		$("#loading").hide();
		$("#progression-data").show();
	}
	else
	{
		$("#loading h1").text(data["Progression"]["Error"]);
	}
}