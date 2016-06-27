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
    $('#loading .preloader-wrapper').show();

    $('#loading h1').text('Fetching data...');
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
            $('#loading .preloader-wrapper').hide();
        }
    });
}

function updateDetails(data)
{
    if (!('error' in data.character))
    {
        $('#character_portrait').attr('src', data.character.portrait);
        $('#character_name').text(data.character.name);
        $('#lodestone_profile').attr('href', 'http://na.finalfantasyxiv.com/lodestone/character/' + data.character.id);
        $('#active_class').html(data.character.activeJob !== null ? data.character.activeJob : data.character.activeClass);
        $('#active_class_level').html(data.character.activeLevel);
        $('#active_avg_ilvl').html(data.character.gearStats.average);
        $('#character-data').show();

        if (!('error' in data.achievements))
        {
            raid8Data = displayCardWithTurnsByClears('The Binding Coil of Bahamut',
                            new Array(
                                data.achievements['747'],
                                data.achievements['748'],
                                data.achievements['749']
                            ),
                            new Array(
                                displayRow('Turn 1', data.achievements['680']),
                                displayRow('Turn 2', data.achievements['681']),
                                displayRow('Turn 3', data.achievements['682']),
                                displayEmptyRow('Turn 4'),
                                displayRow('Turn 5', data.achievements['684'])
                            ),
                        't5.jpg') +
                        displayCardWithTurnsByClears('The Second Coil of Bahamut',
                            new Array(
                                data.achievements['887'],
                                data.achievements['888'],
                                data.achievements['889']
                            ),
                            new Array(
                                displayRow('Turn 1', data.achievements['890']),
                                displayRow('Turn 2', data.achievements['891']),
                                displayRow('Turn 3', data.achievements['892']),
                                displayEmptyRow('Turn 4')
                            ),
                        't9.jpg') +
                        displayCardWithTurnsByTurns('The Second Coil of Bahamut (Savage)',
                            new Array(
                                data.achievements['997'],
                                data.achievements['998'],
                                data.achievements['999'],
                                data.achievements['1000']
                            ),
                            new Array(
                                displayRow('Turn 1', data.achievements['997']),
                                displayRow('Turn 2', data.achievements['998']),
                                displayRow('Turn 3', data.achievements['999']),
                                displayRow('Turn 4', data.achievements['1000'])
                            ),
                        't9.jpg') +
                        displayCardWithTurnsByClears('The Final Coil of Bahamut',
                            new Array(
                                data.achievements['1040'],
                                data.achievements['1041'],
                                data.achievements['1042']
                            ),
                            new Array(
                                displayRow('Turn 1', data.achievements['1043']),
                                displayRow('Turn 2', data.achievements['1044']),
                                displayEmptyRow('Turn 3'),
                                displayEmptyRow('Turn 4')
                            ),
                        't13.jpg') +
                        displayCardWithTurnsByClears('Alexander: Gordias',
                            new Array(
                                data.achievements['1228'],
                                data.achievements['1229'],
                                data.achievements['1230']
                            ),
                            new Array(
                                displayRow('Fist of the Father', data.achievements['1216']),
                                displayRow('Cuff of the Father', data.achievements['1217']),
                                displayRow('Arm of the Father', data.achievements['1218']),
                                displayEmptyRow('Burden of the Father')
                            ),
                        'a4.jpg') +
                        displayCardWithTurnsByClears('Alexander: Gordias (Savage)',
                            new Array(
                                data.achievements['1231'],
                                data.achievements['1232'],
                                data.achievements['1233']
                            ),
                            new Array(
                                displayEmptyRow('Fist of the Father (Savage)'),
                                displayEmptyRow('Cuff of the Father (Savage)'),
                                displayEmptyRow('Arm of the Father (Savage)'),
                                displayEmptyRow('Burden of the Father (Savage)')
                            ),
                        'a4.jpg') +
                        displayCardWithTurnsByClears('Alexander: Midas',
                            new Array(
                                data.achievements['1476'],
                                data.achievements['1477'],
                                data.achievements['1478']
                            ),
                            new Array(
                                displayRow('Fist of the Son', data.achievements['1482']),
                                displayRow('Cuff of the Son', data.achievements['1483']),
                                displayRow('Arm of the Son', data.achievements['1484']),
                                displayEmptyRow('Burden of the Son')
                            ),
                        'a8.jpg') +
                        displayCardWithTurnsByClears('Alexander: Midas (Savage)',
                            new Array(
                                data.achievements['1479'],
                                data.achievements['1480'],
                                data.achievements['1481']
                            ),
                            new Array(
                                displayEmptyRow('Fist of the Son (Savage)'),
                                displayEmptyRow('Cuff of the Son (Savage)'),
                                displayEmptyRow('Arm of the Son (Savage)'),
                                displayEmptyRow('Burden of the Son (Savage)')
                            ),
                        'a8.jpg');

            raid24Data = displaySimpleCard('Labryinth of the Ancients', data.achievements['883'], 'labyrinth_of_the_ancients.jpg') +
                         displaySimpleCard('Syrcus Tower', data.achievements['995'], 'syrcus_tower.jpg') +
                         displaySimpleCard('World of Darkness', data.achievements['1068'], 'world_of_darkness.jpg') +
                         displaySimpleCard('Void Ark', data.achievements['1399'], 'void_ark.jpg') +
                         displaySimpleCard('Weeping City of Mhach', data.achievements['1574'], 'weeping_city.jpg');

            trialsData = displaySimpleCard('The Howling Eye', data.achievements['856'], 'garuda_ex.jpg') +
                         displaySimpleCard('The Navel', data.achievements['857'], 'titan_ex.jpg') +
                         displaySimpleCard('The Bowl of Embers', data.achievements['855'], 'ifrit_ex.jpg') +
                         displaySimpleCard('The <em>Whorleater</em>', data.achievements['893'], 'leviathan_ex.jpg') +
                         displaySimpleCard('Thornmarch', data.achievements['894'], 'king_mog_ex.jpg') +
                         displaySimpleCard('The Striking Tree', data.achievements['994'], 'ramuh_ex.jpg') +
                         displaySimpleCard('Akh Afah Amphitheatre', data.achievements['1045'], 'shiva_ex.jpg') +
                         displaySimpleCard('Urth\'s Fount', data.achievements['1064'], 'odin_hm.jpg') +
                         displaySimpleCard('Battle in the Big Keep', data.achievements['1066'], 'gilgamesh_hm.jpg') +
                         displaySimpleCard('The Chrysalis', data.achievements['1067'], 'chrysalis.jpg') +
                         displaySimpleCard('The Steps of Faith', data.achievements['1065'], 'steps_of_faith.jpg') +
                         displaySimpleCard('The Limitless Blue', data.achievements['1220'], 'bismark_ex.jpg') +
                         displaySimpleCard('Thok ast Thok', data.achievements['1221'], 'ravana_ex.jpg') +
                         displaySimpleCard('The Minstrel\'s Ballad: Thordan\'s Reign', data.achievements['1400'], 'kotr_hm.jpg') +
                         displaySimpleCard('Containment Bay S1T7', data.achievements['1485'], 'sephirot_ex.jpg') +
                         displaySimpleCard('The Minstrel\'s Ballad: Nidhogg\'s Rage', data.achievements['1601'], 'nidhogg_hm.jpg');


            $('#raids-8').html(raid8Data);
            $('#raids-24').html(raid24Data);
            $('#trials').html(trialsData);

            $('#loading').hide();
            $('#progression-data').show();
        }
        else
        {
            $('#loading h1').text(data.achievements.error);
            $('#loading .preloader-wrapper').hide();
        }
    }
    else
    {
        $('#loading h1').text(data.character.error);
        $('#loading .preloader-wrapper').hide();
    }
}

function displaySimpleCard(instanceName, achievementData, image)
{
    var clear_date = '';
    var grayscale = "grayscale_";

    if (achievementData.obtained)
    {
        clear_date = new Date();
        clear_date.setTime((achievementData.time + "0000000000000").slice(0, 13));
        clear_date = clear_date.toDateString();
        grayscale = '';
    }

    return  '<div class="col s12 m6 l4">' +
                '<div class="card small instance-card hoverable">' +
                    '<div class="card-image" style="background-image: url(\'/img/cards/' + grayscale + image + '\');">' +
                        '<div class="instance-info white-text">' +
                            '<span class="instance-clear-date">' + clear_date + '</span>' +
                        '</div>' +
                        '<span class="card-title">' + instanceName + '</span>' +
                    '</div>' +
                '</div>' +
            '</div>';
}

// Display an instance card that has it's own clear achievement as well as individual turn achievements.
// Usually "Mapping of the Realm" achievements for turns.
function displayCardWithTurnsByClears(instanceName, achievementData, turnData, image)
{
    var clear_date = '';
    var clear_times = '';
    var grayscale = "grayscale_";

    var usedAchievement = achievementData[0];
    var firstAchievement = achievementData[0];
    var lastAchievement = achievementData[0];

    for (var i = 0, length = achievementData.length; i < length; i++)
    {
        if (i == length - 1 && achievementData[i].obtained)
            usedAchievement = achievementData[i];
        else if (i != length - 1 && achievementData[i].obtained)
            lastAchievement = achievementData[i];
        else
            usedAchievement = lastAchievement;
    }

    if (usedAchievement.obtained)
    {
        clear_date = new Date();
        clear_date.setTime((usedAchievement.time + "0000000000000").slice(0, 13));
        grayscale = '';

        // Display only first date if the achievement is first clear achievement.
        if (usedAchievement.name == firstAchievement.name)
        {
            clear_date = clear_date.toDateString();
            clear_times = '1 time';
        }
        // Otherwise display both the first and most recent clear date.
        else if (usedAchievement.name != firstAchievement.name)
        {
            first_date = new Date();
            first_date.setTime((firstAchievement.time + "0000000000000").slice(0, 13));

            clear_date = '<strong>First:</strong> ' + first_date.toDateString() + '<br><strong>Recent:</strong> ' + clear_date.toDateString();
            clear_times = usedAchievement.times + ' times';
        }
    }

    return  '<div class="col s12 m6 l4">' +
                '<div class="card small instance-card hoverable">' +
                    '<div class="card-image" style="background-image: url(\'/img/cards/' + grayscale + image + '\');">' +
                        '<div class="instance-info white-text">' +
                            '<span class="instance-clear-date">' + clear_date + '</span><br>' +
                            '<small><span class="instance-clear-times">' + clear_times + '</span></small>' +
                        '</div>' +
                        '<span class="card-title">' + instanceName + '</span>' +
                    '</div>' +
                    '<table class="condensed striped table-responsive">' +
                        '<thead>' +
                            '<th>&nbsp;</th>' +
                            '<th>Instance</th>' +
                            '<th>Cleared</th>' +
                        '</thead>' +
                        '<tbody>' +
                            turnData.join("") +
                        '</tbody>' +
                    '</table>' +
                '</div>' +
            '</div>';
}

// Display an instance card with achievements that are obtained by clearing the turn.
// So far this is just for SCoB and Alexander Savage.
function displayCardWithTurnsByTurns(instanceName, achievementData, turnData, image)
{
    var cleared = true;
    var grayscale = "grayscale_";

    achievementData.forEach(function (achievement)
    {
        if (achievement.obtained === false)
            cleared = false;
    });

    if (cleared)
    {
        grayscale = '';
    }

    return  '<div class="col s12 m6 l4">' +
                '<div class="card small instance-card hoverable">' +
                    '<div class="card-image" style="background-image: url(\'/img/cards/' + grayscale + image + '\');">' +
                        '<div class="instance-info white-text">' +
                            //'<span class="instance-clear-date">' + clear_date + '</span>' +
                        '</div>' +
                        '<span class="card-title">' + instanceName + '</span>' +
                    '</div>' +
                    '<table class="condensed striped table-responsive">' +
                        '<thead>' +
                            '<th>&nbsp;</th>' +
                            '<th>Instance</th>' +
                            '<th>Cleared</th>' +
                        '</thead>' +
                        '<tbody>' +
                            turnData.join("") +
                        '</tbody>' +
                    '</table>' +
                '</div>' +
            '</div>';
}

function displayRow(instanceName, achievementData)
{
    var clear_date = 'Not yet cleared.';

    if (achievementData.obtained)
    {

        clear_date = new Date();
        clear_date.setTime((achievementData.time + "0000000000000").slice(0, 13));

        clear_date = clear_date.toDateString();
    }

    return  '<tr>' +
                '<td><img class="xivdb-icon" src="' + achievementData.icon + '" alt="' + achievementData.name + '"></td>' +
                '<td>' + instanceName + '</td>' +
                '<td>' + clear_date + '</td>' +
            '</tr>';
}

function displayEmptyRow(instanceName)
{
    return  '<tr>' +
                '<td>&nbsp;</td>' +
                '<td>' + instanceName + '</td>' +
                '<td colspan="2">No corresponding achievement.</td>' +
            '</tr>';
}
