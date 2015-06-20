<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Viion\Lodestone\LodestoneAPI;

class ApiController extends BaseController
{
    public function check(Request $request)
    {
        // Instantiate API.
        $api = new LodestoneAPI();

        // POST variables.
        $name = $request->input('name');
        $server = $request->input('server');

        // Parse the character.
        $character = $api->Search->Character($name, $server);

        if ($character)
        {
            // Get character's achievements.
            $achievements = $api->Search->Achievements($character->id, true, false);

            if ($achievements->public == true)
            {
                // Add times count to specific achievements (Temp maybe?).
                $achievements->list[747]['times'] = 1;      // The Binds that Tie I
                $achievements->list[748]['times'] = 5;      // The Binds that Tie II
                $achievements->list[749]['times'] = 10;     // The Binds that Tie III
                $achievements->list[887]['times'] = 1;      // In Another Bind I
                $achievements->list[888]['times'] = 5;      // In Another Bind II
                $achievements->list[889]['times'] = 10;     // In Another Bind III
                $achievements->list[1040]['times'] = 1;     // Out of a Bind I
                $achievements->list[1041]['times'] = 5;     // Out of a Bind II
                $achievements->list[1042]['times'] = 10;    // Out of a Bind III

                // Get the only achievements we need.
                $achievements = [
                    // --- Raids -- \\
                    // The Binding Coil of Bahamut.
                    '680' => $achievements->list[680],      // Mapping the Realm: The Binding Coil of Bahamut I
                    '681' => $achievements->list[681],      // Mapping the Realm: The Binding Coil of Bahamut II
                    '682' => $achievements->list[682],      // Mapping the Realm: The Binding Coil of Bahamut III
                    '684' => $achievements->list[684],      // Mapping the Realm: The Binding Coil of Bahamut V
                    '747' => $achievements->list[747],      // The Binds that Tie I
                    '748' => $achievements->list[748],      // The Binds that Tie II
                    '749' => $achievements->list[749],      // The Binds that Tie III
                    // The Second Coil of Bahamut.
                    '890' => $achievements->list[890],      // Mapping the Realm: The Second Coil of Bahamut I
                    '891' => $achievements->list[891],      // Mapping the Realm: The Second Coil of Bahamut II
                    '892' => $achievements->list[892],      // Mapping the Realm: The Second Coil of Bahamut III
                    '887' => $achievements->list[887],      // In Another Bind I
                    '888' => $achievements->list[888],      // In Another Bind II
                    '889' => $achievements->list[889],      // In Another Bind III
                    // The Second Coil of Bahamut (Savage).
                    '997' => $achievements->list[997],      // A Flower By Any Other Name
                    '998' => $achievements->list[998],      // Seconds
                    '999' => $achievements->list[999],      // Obtanium
                    '1000' => $achievements->list[1000],    // The Crying Game
                    // The Final Coil of Bahamut.
                    '1043' => $achievements->list[1043],    // Mapping the Realm: The Final Coil of Bahamut I
                    '1044' => $achievements->list[1044],    // Mapping the Realm: The Final Coil of Bahamut II
                    '1040' => $achievements->list[1040],    // Out of a Bind I
                    '1041' => $achievements->list[1041],    // Out of a Bind II
                    '1042' => $achievements->list[1042],    // Out of a Bind III
                    // The Crystal Tower.
                    '883' => $achievements->list[883],      // You Call That a Labyrinth
                    '995' => $achievements->list[995],      // Life is a Syrcus
                    '1068' => $achievements->list[1068],    // Let the Sun Shine In

                    // --- Trials --- \\
                    '855' => $achievements->list[855],      // Going Up in Flames
                    '856' => $achievements->list[856],      // Gone with the Wind
                    '857' => $achievements->list[857],      // Earth to Earth
                    '893' => $achievements->list[893],      // I Eat Whorls for Breakfast
                    '894' => $achievements->list[894],      // Good Kingslayer
                    '994' => $achievements->list[994],      // Contempt of Court
                    '1045' => $achievements->list[1045],    // Let It Go
                    '1064' => $achievements->list[1064],    // Missed The Cut
                    '1066' => $achievements->list[1066],    // Enough Expository Banter
                    '1067' => $achievements->list[1067],    // Secret Ascian Man
                    '1065' => $achievements->list[1065],    // Broken Bridges
                ];
            }
            else
            {
                return ['character' => $character, 'achievements' => ['error' => 'This character does not have public achievement viewing enabled.']];
            }
        }
        else
        {
            return ['character' =>['error' => 'Character not found.']];
        }

        //dd(['character' => $character, 'achievements' => $achievements]);
        return ['character' => $character, 'achievements' => $achievements];
    }
}
