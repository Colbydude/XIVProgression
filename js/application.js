$(document).ready(function ()
{
	$("#data").hide();

	$("#check-form").submit(function(e) 
	{
		e.preventDefault();
		checkProgression();
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

	// Table header.
	raids_string = "<tr><th>&nbsp;</th><th>Instance</th><th>Cleared on</th><th>Times</th></tr>";

	// Binding Coil of Bahamut.
	if (data["Raids"]["Binding Coil of Bahamut"])
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

	// Labyrinth of the Ancients.
	if (data["Raids"]["Labyrinth of the Ancients"])
	{
		clear_date = new Date();
		clear_date.setTime((data["Raids"]["Labyrinth of the Ancients"]["date"] + "0000000000000").slice(0, 13));
		raids_string += "<tr>";
			raids_string += "<td>&nbsp;</td>";	// TODO: Icon
			raids_string += "<td>Labyrinth of the Ancients</td>";
			raids_string += "<td>" + clear_date.toDateString() + "</td>";
			raids_string += "<td>1</td>";
		raids_string += "</tr>";
	}

	// Second Coil of Bahamut.
	if (data["Raids"]["Second Coil of Bahamut"])
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

	// ----- EX Primals ----- \\

	// Table header.
	primals_string = "<tr><th>&nbsp;</th><th>Instance</th><th>Cleared on</th></tr>"; 

	// Howling Eye.
	if (data["EX Primals"]["Howling Eye"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Howling Eye"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Howling Eye (Garuda)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}

	// Navel.
	if (data["EX Primals"]["Navel"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Navel"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Navel (Titan)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}

	// Bowl of Embers.
	if (data["EX Primals"]["Bowl of Embers"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Bowl of Embers"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Bowl of Embers (Ifrit)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}

	// Whorleater.
	if (data["EX Primals"]["Whorleater"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Whorleater"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td><em>Whorleater</em> (Leviathan)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}

	// Thornmarch.
	if (data["EX Primals"]["Thornmarch"])
	{
		clear_date = new Date();
		clear_date.setTime((data["EX Primals"]["Thornmarch"]["date"] + "0000000000000").slice(0, 13));
		primals_string += "<tr>";
			primals_string += "<td>&nbsp;</td>";	// TODO: Icon
			primals_string += "<td>Thornmarch (Good King Moggle Mog XII)</td>";
			primals_string += "<td>" + clear_date.toDateString() + "</td>";
		primals_string += "</tr>";
	}

	// Output.
	$("#raids").html(raids_string);
	$("#ex-primals").html(primals_string);

	$("#loading").hide();
	$("#data").show();
}