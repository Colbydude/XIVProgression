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
			url: '/includes/progression.php',
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
		raids_8_string = "";
		raids_24_string = "";

		// Binding Coil of Bahamut.
		if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Binding Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
			raids_8_string += "<tr>";
			raids_8_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000607.png?patch=250\" alt=\"The Binds that Tie\"></td>";
			raids_8_string += "<td>Binding Coil of Bahamut</td>";
			if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Progression"]["Raids"]["Binding Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_8_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_8_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_8_string += "<td>" + data["Progression"]["Raids"]["Binding Coil of Bahamut"]["times"] + "</td>";
			raids_8_string += "</tr>";
		}
		else
		{
			raids_8_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000607.png?patch=250\" alt=\"The Binds that Tie\"></td><td colspan=\"3\">Binding Coil of Bahamut</td></tr>";
		}
		// Individual BCoB Turns.
		for (i = 0; i < 5; i++)
		{
			if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
			{
				explore_date = new Date();
				explore_date.setTime((data["Progression"]["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=250\" alt=\"Mapping The Realm: The Binding Coil of Bahamut\"></td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "</tr>";
			}
			else if (data["Progression"]["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
			{
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td colspan=\"2\">No corresponding achievement</td>";
				raids_8_string += "</tr>";
			}
			else
			{
				raids_8_string += "<tr class=\"danger small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=250\" alt=\"Mapping The Realm: The Binding Coil of Bahamut\"></td>";
				raids_8_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_8_string += "</tr>";
			}
		}

		// Second Coil of Bahamut.
		if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
			raids_8_string += "<tr>";
			raids_8_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=250\" alt=\"In Another Bind\"></td>";
			raids_8_string += "<td>Second Coil of Bahamut</td>";
			if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_8_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_8_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_8_string += "<td>" + data["Progression"]["Raids"]["Second Coil of Bahamut"]["times"] + "</td>";
			raids_8_string += "</tr>";
		}
		else
		{
			raids_8_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=250\" alt=\"In Another Bind\"></td><td colspan=\"3\">Second Coil of Bahamut</td></tr>";
		}
		// Individual SCoB Turns.
		for (i = 0; i < 4; i++)
		{
			if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
			{
				explore_date = new Date();
				explore_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=250\" alt=\"Mapping The Realm: The Second Coil of Bahamut\"></td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "</tr>";
			}
			else if (data["Progression"]["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
			{
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td colspan=\"2\">No corresponding achievement</td>";
				raids_8_string += "</tr>";
			}
			else
			{
				raids_8_string += "<tr class=\"danger small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=250\" alt=\"Mapping The Realm: The Second Coil of Bahamut\"></td>";
				raids_8_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_8_string += "</tr>";
			}
		}

		// Second Coil of Bahamut (Savage)
		if (data["Progression"]["Raids"]["Second Coil of Bahamut (Savage)"]["cleared"])
		{
			raids_8_string += "<tr>";
			raids_8_string += "<td>&nbsp;</td>";
			raids_8_string += "<td colspan=\"3\">Second Coil of Bahamut (Savage)</td>";
			raids_8_string += "</tr>";
		}
		else
		{
			raids_8_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"3\">Second Coil of Bahamut (Savage)</td></tr>";
		}
		// Individual SCoBS Turns.
		for (i = 0; i < 4; i++)
		{
			if (data["Progression"]["Raids"]["Second Coil of Bahamut (Savage)"]["turns"]["Turn " + (i + 1)]["cleared"] == true)
			{
				clear_date = new Date();
				clear_date.setTime((data["Progression"]["Raids"]["Second Coil of Bahamut (Savage)"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=250\" alt=\"In Another Bind\"></td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td>" + clear_date.toDateString() + "</td>";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "</tr>";
			}
			else
			{
				raids_8_string += "<tr class=\"danger small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003304.png?patch=250\" alt=\"In Another Bind\"></td>";
				raids_8_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_8_string += "</tr>";
			}
		}

		// Final Coil of Bahamut.
		if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Final Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
			raids_8_string += "<tr>";
			raids_8_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003762.png?patch=250\" alt=\"Out of a Bind\"></td>";
			raids_8_string += "<td>Final Coil of Bahamut</td>";
			if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Progression"]["Raids"]["Final Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_8_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_8_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_8_string += "<td>" + data["Progression"]["Raids"]["Final Coil of Bahamut"]["times"] + "</td>";
			raids_8_string += "</tr>";
		}
		else
		{
			raids_8_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003762.png?patch=250\" alt=\"Out of a Bind\"></td><td colspan=\"3\">Final Coil of Bahamut</td></tr>";
		}
		// Individual FCoB Turns.
		for (i = 0; i < 4; i++)
		{
			if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
			{
				explore_date = new Date();
				explore_date.setTime((data["Progression"]["Raids"]["Final Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=250\" alt=\"Mapping The Realm: The Final Coil of Bahamut\"></td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "</tr>";
			}
			else if (data["Progression"]["Raids"]["Final Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
			{
				raids_8_string += "<tr class=\"small\">";
				raids_8_string += "<td>&nbsp;</td>";
				raids_8_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_8_string += "<td colspan=\"2\">No corresponding achievement</td>";
				raids_8_string += "</tr>";
			}
			else
			{
				raids_8_string += "<tr class=\"danger small\">";
				raids_8_string += "<td><img class=\"xivdb-icon-sm\" src=\"http://xivdbimg.zamimg.com/images/icons/001000/001501.png?patch=250\" alt=\"Mapping The Realm: The Final Coil of Bahamut\"></td>";
				raids_8_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
				raids_8_string += "</tr>";
			}
		}

		// Labyrinth of the Ancients.
		if (data["Progression"]["Raids"]["Labyrinth of the Ancients"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Labyrinth of the Ancients"]["date"] + "0000000000000").slice(0, 13));
			raids_24_string += "<tr>";
			raids_24_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=250\" alt=\"You Call That A Labyrinth\"></td>";
			raids_24_string += "<td>Labyrinth of the Ancients</td>";
			raids_24_string += "<td colspan=\"2\">" + clear_date.toDateString() + "</td>";
			raids_24_string += "</tr>";
		}
		else
		{
			raids_24_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=250\" alt=\"You Call That A Labyrinth\"></td><td colspan=\"3\">Labyrinth of the Ancients</td></tr>";
		}

		// Syrcus Tower.
		if (data["Progression"]["Raids"]["Syrcus Tower"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["Syrcus Tower"]["date"] + "0000000000000").slice(0, 13));
			raids_24_string += "<tr>";
			raids_24_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=250\" alt=\"Life Is A Syrcus\"></td>";
			raids_24_string += "<td>Syrcus Tower</td>";
			raids_24_string += "<td colspan=\"2\">" + clear_date.toDateString() + "</td>";
			raids_24_string += "</tr>";
		}
		else
		{
			raids_24_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=250\" alt=\"Life Is A Syrcus\"></td><td colspan=\"3\">Syrcus Tower</td></tr>";
		}

		// World of Darkness
		if (data["Progression"]["Raids"]["World of Darkness"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Raids"]["World of Darkness"]["date"] + "0000000000000").slice(0, 13));
			raids_24_string += "<tr>";
			raids_24_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=250\" alt=\"Let the Sun Shine In\"></td>";
			raids_24_string += "<td>World of Darkness</td>";
			raids_24_string += "<td colspan=\"2\">" + clear_date.toDateString() + "</td>";
			raids_24_string += "</tr>";
		}
		else
		{
			raids_24_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/003000/003774.png?patch=250\" alt=\"Let the Sun Shine In\"></td><td colspan=\"3\">World of Darkness</td></tr>";
		}

		// ----- EX Primals ----- \\
		trials_string = "";

		// Howling Eye.
		if (data["Progression"]["Trials"]["Howling Eye"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Howling Eye"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Gone With The Wind\"></td>";
			trials_string += "<td>Howling Eye (Garuda)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Gone With The Wind\"></td><td colspan=\"2\">Howling Eye (Garuda)</td></tr>";
		}

		// Navel.
		if (data["Progression"]["Trials"]["Navel"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Navel"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Earth To Earth\"></td>";
			trials_string += "<td>Navel (Titan)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Earth To Earth\"></td><td colspan=\"2\">Navel (Titan)</td></tr>";
		}

		// Bowl of Embers.
		if (data["Progression"]["Trials"]["Bowl of Embers"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Bowl of Embers"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Going Up In Flames\"></td>";
			trials_string += "<td>Bowl of Embers (Ifrit)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Going Up In Flames\"></td><td colspan=\"2\">Bowl of Embers (Ifrit)</td></tr>";
		}

		// Whorleater.
		if (data["Progression"]["Trials"]["Whorleater"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Whorleater"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"I Eat Whorls For Breakfast\"></td>";
			trials_string += "<td><em>Whorleater</em> (Leviathan)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"I Eat Whorls For Breakfast\"></td><td colspan=\"2\"><em>Whorleater</em> (Leviathan)</td></tr>";
		}

		// Thornmarch.
		if (data["Progression"]["Trials"]["Thornmarch"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Thornmarch"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Good Kingslayer\"></td>";
			trials_string += "<td>Thornmarch (Good King Moggle Mog XII)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Good Kingslayer\"></td><td colspan=\"2\">Thornmarch (Good King Moggle Mog XII)</td></tr>";
		}

		// Striking Tree.
		if (data["Progression"]["Trials"]["Striking Tree"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Striking Tree"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Contempt Of Court\"></td>";
			trials_string += "<td>Striking Tree (Ramuh)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Contempt Of Court\"></td><td colspan=\"2\">Striking Tree (Ramuh)</td></tr>";
		}

		// Akh Afah Amphitheatre.
		if (data["Progression"]["Trials"]["Akh Afah Amphitheatre"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Akh Afah Amphitheatre"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Let It Go\"></td>";
			trials_string += "<td>Akh Afah Amphitheatre (Shiva)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Let It Go\"></td><td colspan=\"2\">Akh Afah Amphitheatre (Shiva)</td></tr>";
		}

		// Urth's Fount.
		if (data["Progression"]["Trials"]["Urth's Fount"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Urth's Fount"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Missed The Cut\"></td>";
			trials_string += "<td>Urth's Fount (Odin)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Missed The Cut\"></td><td colspan=\"2\">Urth's Fount (Odin)</td></tr>";
		}

		// Battle in the Big Keep.
		if (data["Progression"]["Trials"]["Battle in the Big Keep"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Battle in the Big Keep"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Enough Expository Banter\"></td>";
			trials_string += "<td>Battle in the Big Keep (Gilgamesh)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Enough Expository Banter\"></td><td colspan=\"2\">Battle in the Big Keep (Gilgamesh)</td></tr>";
		}

		// Chrysalis.
		if (data["Progression"]["Trials"]["Chrysalis"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Chrysalis"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Secret Ascian Man\"></td>";
			trials_string += "<td>Chrysalis (Nabriales)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Secret Ascian Man\"></td><td colspan=\"2\">Chrysalis (Nabriales)</td></tr>";
		}

		// Steps of Faith.
		if (data["Progression"]["Trials"]["Steps of Faith"]["cleared"])
		{
			clear_date = new Date();
			clear_date.setTime((data["Progression"]["Trials"]["Steps of Faith"]["date"] + "0000000000000").slice(0, 13));
			trials_string += "<tr>";
			trials_string += "<td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Broken Bridges\"></td>";
			trials_string += "<td>Steps of Faith (Vishap)</td>";
			trials_string += "<td>" + clear_date.toDateString() + "</td>";
			trials_string += "</tr>";
		}
		else
		{
			trials_string += "<tr class=\"danger\"><td><img class=\"xivdb-icon\" src=\"http://xivdbimg.zamimg.com/images/icons/000000/000517.png?patch=250\" alt=\"Broken Bridges\"></td><td colspan=\"2\">Steps of Faith (Vishap)</td></tr>";
		}

		// Output.
		$("#raids-8 tbody").html(raids_8_string);
		$("#raids-24 tbody").html(raids_24_string);
		$("#trials tbody").html(trials_string);

		$("#loading").hide();
		$("#progression-data").show();
	}
	else
	{
		$("#loading h1").text(data["Progression"]["Error"]);
	}
}
