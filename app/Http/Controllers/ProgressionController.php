<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Services\XIVAPIServiceInterface;
use Exception;
use Illuminate\Http\Request;

class ProgressionController extends Controller
{
    /**
     * The XIVAPI service implementation.
     *
     * @var XIVAPIServiceInterface
     */
    private XIVAPIServiceInterface $api;

    /**
     * Create a new controller instance.
     *
     * @param  XIVAPIServiceInterface  $api
     * @return void
     */
    public function __construct(XIVAPIServiceInterface $api)
    {
        $this->api = $api;
    }

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
                // Search for the character.
                $response = $this->api->characterSearch($name, $server);

                if (empty($response->Results)) {
                    return response()->json(['error' => 'Character not found.'], 404);
                }

                // Save the character to our DB.
                $result = $response->Results[0];
                $server = preg_replace( "~\x{00a0}~siu", ' ', $result->Server); // Replace non-breaking space character with a regular space.

                // Trim out the data center.
                if (substr_count($server, ' (') > 0) {
                    $server = explode(' (', $server)[0];
                }

                $character = Character::updateOrCreate([
                    'lodestone_id' => $result->ID,
                    'name' => $result->Name,
                    'server' => $server
                ]);
            }
            catch (Exception $e) {
                return response()->json(['error' => 'Unexpected error occurred.'], 500);
            }
        }

        try {
            // Now, fetch character data and achievement data.
            $characterData = $this->api->character($character->lodestone_id);

            return response()->json($characterData, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Unexpected error occurred.'], 500);
        }
    }
}
