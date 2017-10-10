<?php

namespace App\Http\Controllers;

use App\Character;
use Exception;
use Illuminate\Http\Request;
use Lodestone\Api as LodestoneApi;
use Lodestone\Validator\Exceptions\HttpMaintenanceValidationException;
use Lodestone\Validator\Exceptions\HttpNotFoundValidationException;
use Lodestone\Validator\Exceptions\ValidationException;
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
            try {
                // Instantiate API.
                $api = new LodestoneApi();

                // Search for the character on the Lodestone.
                $search = $api->searchCharacter($name, $server);

                if (empty($search->getCharacters())) {
                    return response()->json(['error' => 'Character not found.'], 404);
                }

                $result = $search->getCharacters()[0]->toArray();

                $character = Character::updateOrCreate([
                    'lodestone_id' => $result['id'],
                    'name' => $result['name'],
                    'server' => $result['server']
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
            catch (Exception $e) {
                return response()->json(['error' => 'Unexpected error occurred.'], 500);
            }
        }

        return response()->json($character, 200);
    }
}
