<?php

namespace App\Http\Controllers;

use App\Character;
use Exception;
use Illuminate\Http\Request;
use XIVAPI\XIVAPI;

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
        // POST variables.
        $name = $request->input('name');
        $server = $request->input('server');

        // Check the database for the character already.
        $character = Character::where('name', $name)->where('server', $server)->first();

        if ($character == null) {
            try {
                // Instantiate API.
                $api = new XIVAPI();

                // Set env.
                $api->environment->key(config('services.xivapi.key'));

                // Search for the character.
                $response = $api->character->search($name, $server);

                if (empty($response->Results)) {
                    return response()->json(['error' => 'Character not found.'], 404);
                }

                // Save the character to our DB.
                $result = $response->Results[0];

                $character = Character::updateOrCreate([
                    'lodestone_id' => $result->ID,
                    'name' => $result->Name,
                    'server' => $result->Server
                ]);
            }
            catch (Exception $e) {
                return response()->json(['error' => 'Unexpected error occurred.'], 500);
            }
        }

        return response()->json($character, 200);
    }
}
