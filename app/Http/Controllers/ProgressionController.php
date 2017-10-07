<?php

namespace App\Http\Controllers;

use App\Character;
use Illuminate\Http\Request;
use Lodestone\Api as LodestoneApi;
use Log;

class ProgressionController extends Controller
{
    /**
     * Display the progression page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $name = $request->input('name');
        $server = $request->input('server');

        return view('progression', compact('name', 'server'));
    }

    /**
     * Fetch progression information from the Lodestone.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        Log::info($request->all());

        // POST variables.
        $name = $request->input('name');
        $server = $request->input('server');

        // Check the database for the character already.
        $character = Character::where('name', $name)->where('server', $server)->first();

        if ($character == null) {
            // Instantiate API.
            $api = new LodestoneApi();

            try {
                // Search for the character on the Lodestone.
                $search = $api->searchCharacter($name, $server);

                if (empty($search->getCharacters())) {
                    return response()->json(['error' => 'Character not found.'], 404);
                }

                $result = $search->getCharacters()[0]->toArray();

                $character = Character::create([
                    'lodestone_id' => $result['id'],
                    'name' => $result['name'],
                    'server' => $result['server'],
                    'avatar' => $result['avatar']
                ]);
            }
            catch (HttpMaintenanceValidationException $e) {
                return response()->json(['error' => 'Lodestone is down for maintenance.'], 403);
            }
            catch (HttpNotFoundValidationException $e) {
                return response()->json(['error' => 'Character not found.'], 404);
            }
            catch (ValidationException $e) {
                return response()->json(['error' => 'Unexpected data found. Lodestone may have updated.'], 400);
            }
        }

        return response()->json($character, 200);

        // Set ID from results.
        /*$id = $search->results[0]['id'];

        // Get character information.
        $character = (Object) $api->getCharacter($id);

        // Get character's achievements.
        $battleAchievements = $api->getCharacterAchievements($id, 1);

        // First check if achievements are private.
        if ($battleAchievements == "private") {
            return response()->json([
                'character' => $character,
                'achievements' => ['error' => 'This character does not have public achievement viewing enabled.']
            ]);
        }

        // Fetch the rest of the achievements.
        $characterAchievements = $api->getCharacterAchievements($id, 2);
        $explorationAchievements = $api->getCharacterAchievements($id, 11);

        $achievements = (Object) [
            // NOTE: We're "adding" arrays to retain keys.
            'list' => $battleAchievements['list'] + $characterAchievements['list'] + $explorationAchievements['list'],
            'points' => [
                'possible' => $battleAchievements['points']['possible'] + $characterAchievements['points']['possible'] + $explorationAchievements['points']['possible'],
                'obtained' => $battleAchievements['points']['obtained'] + $characterAchievements['points']['obtained'] + $explorationAchievements['points']['obtained'],
            ]
        ];

        $achievements = $this->formatAchievements($achievements);*/
    }

    /**
     * Format the achievements array.
     *
     * @param  array
     * @return array
     */
    private function formatAchievements($achievements)
    {
        // Fill out empty achievements because apparently we don't always get all of the achievements?
        $achievements = $this->fillEmptyAchievements($achievements);

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
        $achievements->list[1228]['times'] = 1;     // Sins of the Father I
        $achievements->list[1229]['times'] = 5;     // Sins of the Father II
        $achievements->list[1230]['times'] = 10;    // Sins of the Father III
        $achievements->list[1231]['times'] = 1;     // Sins of the Savage Father I
        $achievements->list[1232]['times'] = 5;     // Sins of the Savage Father II
        $achievements->list[1233]['times'] = 10;    // Sins of the Savage Father III
        $achievements->list[1476]['times'] = 1;     // Sins of the Son I
        $achievements->list[1477]['times'] = 5;     // Sins of the Son II
        $achievements->list[1478]['times'] = 10;    // Sins of the Son III
        $achievements->list[1479]['times'] = 1;     // Sins of the Savage Son I
        $achievements->list[1480]['times'] = 5;     // Sins of the Savage Son II
        $achievements->list[1481]['times'] = 10;    // Sins of the Savage Son III
        $achievements->list[1639]['times'] = 1;     // Sins of the Creator I
        $achievements->list[1640]['times'] = 5;     // Sins of the Creator II
        $achievements->list[1641]['times'] = 10;    // Sins of the Creator III
        $achievements->list[1642]['times'] = 1;     // Sins of the Savage Creator I
        $achievements->list[1643]['times'] = 5;     // Sins of the Savage Creator II
        $achievements->list[1644]['times'] = 10;    // Sins of the Savage Creator III
        $achievements->list[1895]['times'] = 1;     // I Am The Delta, I Am The Omega I
        $achievements->list[1896]['times'] = 5;     // I Am The Delta, I Am The Omega II
        $achievements->list[1897]['times'] = 10;    // I Am The Delta, I Am The Omega III
        $achievements->list[1898]['times'] = 1;     // I Am The Savage Delta, I Am The Savage Omega I
        $achievements->list[1899]['times'] = 5;     // I Am The Savage Delta, I Am The Savage Omega II
        $achievements->list[1900]['times'] = 10;    // I Am The Savage Delta, I Am The Savage Omega III

        // Filter to only the achievements we need.
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
            '887' => $achievements->list[887],      // In Another Bind I
            '888' => $achievements->list[888],      // In Another Bind II
            '889' => $achievements->list[889],      // In Another Bind III
            '890' => $achievements->list[890],      // Mapping the Realm: The Second Coil of Bahamut I
            '891' => $achievements->list[891],      // Mapping the Realm: The Second Coil of Bahamut II
            '892' => $achievements->list[892],      // Mapping the Realm: The Second Coil of Bahamut III

            // The Second Coil of Bahamut (Savage).
            '997' => $achievements->list[997],      // A Flower By Any Other Name
            '998' => $achievements->list[998],      // Seconds
            '999' => $achievements->list[999],      // Obtanium
            '1000' => $achievements->list[1000],    // The Crying Game

            // The Final Coil of Bahamut.
            '1040' => $achievements->list[1040],    // Out of a Bind I
            '1041' => $achievements->list[1041],    // Out of a Bind II
            '1042' => $achievements->list[1042],    // Out of a Bind III
            '1043' => $achievements->list[1043],    // Mapping the Realm: The Final Coil of Bahamut I
            '1044' => $achievements->list[1044],    // Mapping the Realm: The Final Coil of Bahamut II

            // The Crystal Tower.
            '883' => $achievements->list[883],      // You Call That a Labyrinth
            '995' => $achievements->list[995],      // Life is a Syrcus
            '1068' => $achievements->list[1068],    // Let the Sun Shine In

            // Alexander: Gordias
            '1228' => $achievements->list[1228],    // Sins of the Father I
            '1229' => $achievements->list[1229],    // Sins of the Father II
            '1230' => $achievements->list[1230],    // Sins of the Father III
            '1231' => $achievements->list[1231],    // Sins of the Savage Father I
            '1232' => $achievements->list[1232],    // Sins of the Savage Father II
            '1233' => $achievements->list[1233],    // Sins of the Savage Father III
            '1216' => $achievements->list[1216],    // Mapping the Realm: Gordias I
            '1217' => $achievements->list[1217],    // Mapping the Realm: Gordias II
            '1218' => $achievements->list[1218],    // Mapping the Realm: Gordias III

            // Void Ark
            '1399' => $achievements->list[1399],    // Touching the Void

            // Alexander: Midas
            '1476' => $achievements->list[1476],    // Sins of the Son I
            '1477' => $achievements->list[1477],    // Sins of the Son II
            '1478' => $achievements->list[1478],    // Sins of the Son III
            '1479' => $achievements->list[1479],    // Sins of the Savage Son I
            '1480' => $achievements->list[1480],    // Sins of the Savage Son II
            '1481' => $achievements->list[1481],    // Sins of the Savage Son III
            '1482' => $achievements->list[1482],    // Mapping the Realm: Midas I
            '1483' => $achievements->list[1483],    // Mapping the Realm: Midas II
            '1484' => $achievements->list[1484],    // Mapping the Realm: Midas III

            // Weeping City of Mhach
            '1574' => $achievements->list[1574],    // Ex Mhachina

            // Alexander The Creator
            '1639' => $achievements->list[1639],    // Sins of the Creator I
            '1640' => $achievements->list[1640],    // Sins of the Creator II
            '1641' => $achievements->list[1641],    // Sins of the Creator III
            '1642' => $achievements->list[1642],    // Sins of the Savage Creator I
            '1643' => $achievements->list[1643],    // Sins of the Savage Creator II
            '1644' => $achievements->list[1644],    // Sins of the Savage Creator III
            '1645' => $achievements->list[1645],    // Mapping the Realm: Alexander I
            '1646' => $achievements->list[1646],    // Mapping the Realm: Alexander II
            '1647' => $achievements->list[1647],    // Mapping the Realm: Alexander III

            // Dun Scaith
            '1689' => $achievements->list[1689],    // What's Dun Is Done

            // Interdimensional Rift: Deltascape
            '1895' => $achievements->list[1895],    // I Am The Delta, I Am The Omega I
            '1896' => $achievements->list[1896],    // I Am The Delta, I Am The Omega II
            '1897' => $achievements->list[1897],    // I Am The Delta, I Am The Omega III
            '1898' => $achievements->list[1898],    // I Am The Savage Delta, I Am The Savage Omega I
            '1899' => $achievements->list[1899],    // I Am The Savage Delta, I Am The Savage Omega II
            '1900' => $achievements->list[1900],    // I Am The Savage Delta, I Am The Savage Omega III

            // --- Trials --- \\
            '855' => $achievements->list[855],      // Going Up in Flames
            '856' => $achievements->list[856],      // Gone with the Wind
            '857' => $achievements->list[857],      // Earth to Earth
            '893' => $achievements->list[893],      // I Eat Whorls for Breakfast
            '894' => $achievements->list[894],      // Good Kingslayer
            '994' => $achievements->list[994],      // Contempt of Court
            '1045' => $achievements->list[1045],    // Let It Go
            '1064' => $achievements->list[1064],    // Missed The Cut
            '1065' => $achievements->list[1065],    // Broken Bridges
            '1066' => $achievements->list[1066],    // Enough Expository Banter
            '1067' => $achievements->list[1067],    // Secret Ascian Man
            '1220' => $achievements->list[1220],    // Limitless
            '1221' => $achievements->list[1221],    // Hive Mind
            '1400' => $achievements->list[1400],    // The King and Die
            '1485' => $achievements->list[1485],    // Veni Veni Venias
            '1601' => $achievements->list[1601],    // Let Me Be Your Hogg
            '1636' => $achievements->list[1636],    // Sophia's Choice
            '1685' => $achievements->list[1685],    // Zurvan Safari
            '1901' => $achievements->list[1901],    // Lakshmi Intolerant
            '1902' => $achievements->list[1902],    // Just Say The Word
        ];

        return $achievements;
    }

    /**
     * Fill out empty achievements... because we don't get all the necessary achievements sometimes...
     *
     * @param  array
     * @return array
     */
    private function fillEmptyAchievements($achievements) {
        $ids = [
            680, 681, 682, 684, 747, 748, 749, 855, 856, 857,
            883, 887, 888, 889, 890, 891, 892, 893, 894, 994,
            995, 997, 998, 999, 1000, 1040, 1041, 1042, 1043,
            1044, 1045, 1064, 1065, 1066, 1067, 1068, 1216,
            1217, 1218, 1220, 1221, 1228, 1229, 1230, 1231,
            1232, 1233, 1399, 1400, 1476, 1477, 1478, 1479,
            1480, 1481, 1482, 1483, 1484, 1485, 1574, 1601,
            1636, 1639, 1640, 1641, 1642, 1643, 1644, 1645,
            1646, 1647, 1685, 1689, 1895, 1896, 1897, 1898,
            1899, 1900, 1901, 1902
        ];

        foreach ($ids as $id) {
            if (!isset($achievements->list[$id])) {
                $achievements->list[$id] = [
                    'id' => $id,
                    'points' => 0,
                    'timestamp' => null
                ];
            }
        }

        return $achievements;
    }
}
