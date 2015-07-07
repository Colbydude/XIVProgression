$(document).ready(function ()
{
    // Get data immediately if URL parameters are defined.
    var name = $('#name').val().trim();
    var server = $('#server').val().trim();

    if (name.length && server.length)
    {
        checkProgression();
    }

    $('#check-form').submit(function(e)
    {
        e.preventDefault();
        checkProgression();
        history.pushState({}, '', '?name=' + $('#name').val() + '&server=' + $('#server').val());
    });
});

function checkProgression()
{
    $('#character-data').hide();
    $('#progression-data').hide();
    $('#loading').show();

    $('#loading h1').text('Collecting data. Please wait a moment...');
    $.ajax(
    {
        type: 'POST',
        url: '/api',
        dataType: 'json',
        data:{
            name: $('#name').val(),
            server: $('#server').val()
        },
        success: function (data)
        {
            updateDetails(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
            // Error actions.
            $('#loading h1').text('A failure occurred in attempting to fetch the data.');
        }
    });
}

function updateDetails(data)
{
    if (!('error' in data['character']))
    {
        $('#character_portrait').attr('src', data['character']['portrait']);
        $('#character_name').text(data['character']['name']);
        $('#lodestone_profile').attr('href', 'http://na.finalfantasyxiv.com/lodestone/character/' + data['character']['id']);
        $('#active_class').html(data['character']['activeJob'] != null ? data['character']['activeJob'] : data['character']['activeClass']);
        $('#active_class_level').html(data['character']['activeLevel']);
        $('#active_avg_ilvl').html(data['character']['gearStats']['average']);
        $('#character-data').show();

        if (!('error' in data['achievements']))
        {
            raid8Data  = displayRaidRowByClears('The Binding Coil of Bahamut', new Array(data['achievements']['747'], data['achievements']['748'], data['achievements']['749'])) +
                         displayRow('Turn 1', data['achievements']['680'], true) +
                         displayRow('Turn 2', data['achievements']['681'], true) +
                         displayRow('Turn 3', data['achievements']['682'], true) +
                         displayEmptyRow('Turn 4', true) +
                         displayRow('Turn 5', data['achievements']['684'], true) +
                         displayRaidRowByClears('The Second Coil of Bahamut', new Array(data['achievements']['887'], data['achievements']['888'], data['achievements']['889'])) +
                         displayRow('Turn 1', data['achievements']['890'], true) +
                         displayRow('Turn 2', data['achievements']['891'], true) +
                         displayRow('Turn 3', data['achievements']['892'], true) +
                         displayEmptyRow('Turn 4', true) +
                         displayRaidRowByTurns('The Second Coil of Bahamut (Savage)', new Array(data['achievements']['997'], data['achievements']['998'], data['achievements']['999'], data['achievements']['1000'])) +
                         displayRow('Turn 1', data['achievements']['997']) +
                         displayRow('Turn 2', data['achievements']['998']) +
                         displayRow('Turn 3', data['achievements']['999']) +
                         displayRow('Turn 4', data['achievements']['1000']) +
                         displayRaidRowByClears('The Final Coil of Bahamut', new Array(data['achievements']['1040'], data['achievements']['1041'], data['achievements']['1042'])) +
                         displayRow('Turn 1', data['achievements']['1043'], true) +
                         displayRow('Turn 2', data['achievements']['1044'], true) +
                         displayEmptyRow('Turn 3', true) +
                         displayEmptyRow('Turn 4', true);

            raid24Data = displayRow('Labryinth of the Ancients', data['achievements']['883']) +
                         displayRow('Syrcus Tower', data['achievements']['995']) +
                         displayRow('World of Darkness', data['achievements']['1068']);

            trialsData = displayRow('Howling Eye (Garuda)', data['achievements']['856']) +
                         displayRow('Navel (Titan)', data['achievements']['857']) +
                         displayRow('Bowl of Embers (Ifrit)', data['achievements']['855']) +
                         displayRow('<em>Whorleater</em> (Leviathan)', data['achievements']['893']) +
                         displayRow('Thornmarch (Good King Moggle Mog XII)', data['achievements']['894']) +
                         displayRow('Striking Tree (Ramuh)', data['achievements']['994']) +
                         displayRow('Akh Afah Amphitheatre (Shiva)', data['achievements']['1045']) +
                         displayRow('Urth\'s Fount (Odin)', data['achievements']['1064']) +
                         displayRow('Battle in the Big Keep (Gilgamesh)', data['achievements']['1066']) +
                         displayRow('Chrysalis (Nabriales)', data['achievements']['1067']) +
                         displayRow('Steps of Faith (Vishap)', data['achievements']['1065']);

            $('#raids-8 tbody').html(raid8Data);
            $('#raids-24 tbody').html(raid24Data);
            $('#trials tbody').html(trialsData);

            $('#loading').hide();
            $('#progression-data').show();
        }
        else
        {
            $('#loading h1').text(data['achievements']['error']);
        }
    }
    else
    {
        $('#loading h1').text(data['character']['error']);
    }
}

function displayRow(instanceName, achievementData, small)
{
    small = small ? 'small' : '';

    if (achievementData['obtained'])
    {

        clear_date = new Date();
        clear_date.setTime((achievementData['time'] + "0000000000000").slice(0, 13));

        return  '<tr class="' + small + '">' +
                    '<td><img class="xivdb-icon" src="' + achievementData['icon'] + '" alt="' + achievementData['name'] + '"></td>' +
                    '<td>' + instanceName + '</td>' +
                    '<td colspan="2">' + clear_date.toDateString() + '</td>' +
                '</tr>';
    }
    else
    {
        return  '<tr class="danger ' + small + '">' +
                    '<td><img class="xivdb-icon" src="' + achievementData['icon'] + '" alt="' + achievementData['name'] + '"></td>' +
                    '<td colspan="3">' + instanceName + '</td>' +
                '</tr>';
    }
}

function displayEmptyRow(instanceName, small)
{
    small = small ? 'small' : '';

    return  '<tr class="' + small + '">' +
                '<td>&nbsp;</td>' +
                '<td>' + instanceName + '</td>' +
                '<td colspan="2">No corresponding achievement.</td>' +
            '</tr>';
}

function displayRaidRowByClears(instanceName, achievementData)
{
    usedAchievement = achievementData[0];
    firstAchievement = achievementData[0];
    lastAchievement = achievementData[0];

    for (var i = 0, length = achievementData.length; i < length; i++)
    {
        if (i == length - 1 && achievementData[i]['obtained'])
            usedAchievement = achievementData[i];
        else if (i != length - 1 && achievementData[i]['obtained'])
            lastAchievement = achievementData[i];
        else
            usedAchievement = lastAchievement;
    }

    if (usedAchievement['obtained'])
    {
        clear_date = new Date();
        clear_date.setTime((usedAchievement['time'] + "0000000000000").slice(0, 13));

        clear_row = '<td>&nbsp;</td>';

        // Display only first date if the achievement is first clear achievement.
        if (usedAchievement['name'] == firstAchievement['name'])
        {
            clear_row = '<td>' + clear_date.toDateString() + '</td>';
        }
        // Otherwise display both the first and most recent clear date.
        else if (usedAchievement['name'] != firstAchievement['name'])
        {
            first_date = new Date();
            first_date.setTime((firstAchievement['time'] + "0000000000000").slice(0, 13));

            clear_row = '<td><strong>First:</strong> ' + first_date.toDateString() + '<br><strong>Recent:</strong> ' + clear_date.toDateString() + '</td>';
        }

        // Output.
        return  '<tr>' +
                    '<td><img class="xivdb-icon" src="' + usedAchievement['icon'] + '" alt="' + usedAchievement['name'] + '"></td>' +
                    '<td><strong>' + instanceName + '</strong></td>' +
                    clear_row +
                    '<td>' + usedAchievement['times'] + '</td>' +
                '</tr>';
    }
    else
    {
        return  '<tr class="danger">' +
                    '<td><img class="xivdb-icon" src="' + usedAchievement['icon'] + '" alt="' + usedAchievement['name'] + '"></td>' +
                    '<td colspan="3"><strong>' + instanceName + '</strong></td>' +
                '</tr>';
    }
}

function displayRaidRowByTurns(instanceName, achievementData)
{
    cleared = true;

    achievementData.forEach(function (achievement)
    {
        if (achievement['obtained'] == false)
            cleared = false;
    });

    if (cleared)
    {
        clear_date = new Date();
        clear_date.setTime((usedAchievement['time'] + "0000000000000").slice(0, 13));

        return  '<tr>' +
                    '<td>&nbsp;</td>' +
                    '<td colspan="3"><strong>' + instanceName + '</strong></td>' +
                '</tr>';
    }
    else
    {
        return  '<tr class="danger">' +
                    '<td>&nbsp;</td>' +
                    '<td colspan="3"><strong>' + instanceName + '</strong></td>' +
                '</tr>';
    }
}
