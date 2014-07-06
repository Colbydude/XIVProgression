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
	$("#data").hide();
	$("#loading").show();

	$("#loading h1").text("Collecting data. Please wait a moment...");
	$.ajax(
	{
		type: "GET",
		url: 'includes/progression.php',
		dataType: "json",
		data:{
			name: $("#name").val(),
			server: $("#server").val()
		},
		success: function (data)
		{
			if ("Error" in data)
			{
				$("#loading h1").text(data["Error"]);
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
	// There's probably a shorter and better way to do this, but this'll do for now.

	// ----- Raids ----- \\
	raids_string = "";

	// Binding Coil of Bahamut.
	if (data["Raids"]["Binding Coil of Bahamut"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["Raids"]["Binding Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
		raids_string += "<tr>";
			raids_string += "<td>&nbsp;</td>";	// TODO: Icon
			raids_string += "<td>Binding Coil of Bahamut</td>";
			if (data["Raids"]["Binding Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Raids"]["Binding Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_string += "<td>" + data["Raids"]["Binding Coil of Bahamut"]["times"] + "</td>";
		raids_string += "</tr>";
	}
	else
	{
		raids_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"3\">Binding Coil of Bahamut</td></tr>";
	}
	// Individual BCoB Turns.
	for (i = 0; i < 5; i++)
	{
		if (data["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
		{
			explore_date = new Date();
			explore_date.setTime((data["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>"; // TODO: Icon
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_string += "<td>&nbsp;</td>";
			raids_string += "</tr>";
		}
		else if (data["Raids"]["Binding Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
		{
			raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>"; // TODO: Icon
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td colspan=\"2\">No corresponding achievement</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger small\">";
				raids_string += "<td>&nbsp;</td>"; // TODO: Icon
				raids_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
			raids_string += "</tr>";
		}
	}

	// Labyrinth of the Ancients.
	if (data["Raids"]["Labyrinth of the Ancients"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["Raids"]["Labyrinth of the Ancients"]["date"] + "0000000000000").slice(0, 13));
		raids_string += "<tr>";
			raids_string += "<td>&nbsp;</td>"; // TODO: Icon
			raids_string += "<td>Labyrinth of the Ancients</td>";
			raids_string += "<td>" + clear_date.toDateString() + "</td>";
			raids_string += "<td>1</td>";
		raids_string += "</tr>";
	}
	else
	{
		raids_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"3\">Labyrinth of the Ancients</td></tr>";
	}

	// Second Coil of Bahamut.
	if (data["Raids"]["Second Coil of Bahamut"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["Raids"]["Second Coil of Bahamut"]["date"] + "0000000000000").slice(0, 13));
		raids_string += "<tr>";
			raids_string += "<td>&nbsp;</td>";	// TODO: Icon
			raids_string += "<td>Second Coil of Bahamut</td>";
			if (data["Raids"]["Second Coil of Bahamut"]["first"])
			{
				first_date = new Date();
				first_date.setTime((data["Raids"]["Second Coil of Bahamut"]["first"] + "0000000000000").slice(0, 13));
				raids_string += "<td><strong>First:</strong> " + first_date.toDateString() + "<br><strong>Recent:</strong> " + clear_date.toDateString() + "</td>";
			}
			else
			{
				raids_string += "<td>" + clear_date.toDateString() + "</td>";
			}
			raids_string += "<td>" + data["Raids"]["Second Coil of Bahamut"]["times"] + "</td>";
		raids_string += "</tr>";
	}
	else
	{
		raids_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"3\">Second Coil of Bahamut</td></tr>";
	}
	// Individual SCoB Turns.
	for (i = 0; i < 4; i++)
	{
		if (data["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == true)
		{
			explore_date = new Date();
			explore_date.setTime((data["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["date"] + "0000000000000").slice(0, 13));
			raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>"; // TODO: Icon
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td>" + explore_date.toDateString() + "</td>";
				raids_string += "<td>&nbsp;</td>";
			raids_string += "</tr>";
		}
		else if (data["Raids"]["Second Coil of Bahamut"]["turns"]["Turn " + (i + 1)]["explored"] == "Unknown")
		{
			raids_string += "<tr class=\"small\">";
				raids_string += "<td>&nbsp;</td>"; // TODO: Icon
				raids_string += "<td>- Turn " + (i + 1) + "</td>";
				raids_string += "<td colspan=\"2\">No corresponding achievement</td>";
			raids_string += "</tr>";
		}
		else
		{
			raids_string += "<tr class=\"danger small\">";
				raids_string += "<td>&nbsp;</td>"; // TODO: Icon
				raids_string += "<td colspan=\"3\">- Turn " + (i + 1) + "</td>";
			raids_string += "</tr>";
		}
	}

	// ----- EX Primals ----- \\
	primals_string = ""; 

	// Howling Eye.
	if (data["EX Primals"]["Howling Eye"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Howling Eye"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Howling Eye (Garuda)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}
	else
	{
		primals_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"2\">Howling Eye (Garuda)</td></tr>";
	}

	// Navel.
	if (data["EX Primals"]["Navel"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Navel"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Navel (Titan)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}
	else
	{
		primals_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"2\">Navel (Titan)</td></tr>";
	}

	// Bowl of Embers.
	if (data["EX Primals"]["Bowl of Embers"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Bowl of Embers"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Bowl of Embers (Ifrit)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}
	else
	{
		primals_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"2\">Bowl of Embers (Ifrit)</td></tr>";
	}

	// Whorleater.
	if (data["EX Primals"]["Whorleater"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Whorleater"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td><em>Whorleater</em> (Leviathan)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}
	else
	{
		primals_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"2\"><em>Whorleater</em> (Leviathan)</td></tr>";
	}

	// Thornmarch.
	if (data["EX Primals"]["Thornmarch"]["cleared"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Thornmarch"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Thornmarch (Good King Moggle Mog XII)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}
	else
	{
		primals_string += "<tr class=\"danger\"><td>&nbsp;</td><td colspan=\"2\">Thornmarch (Good King Moggle Mog XII)</td></tr>";
	}

	// Output.
	$("#raids tbody").html(raids_string);
	$("#ex-primals tbody").html(primals_string);

	$("#loading").hide();
	$("#data").show();
}