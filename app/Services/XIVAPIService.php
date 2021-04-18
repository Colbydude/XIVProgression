<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use XIVAPI\XIVAPI;

class XIVAPIService implements XIVAPIServiceInterface
{
    private XIVAPI $api;

    public function __construct()
    {
        $this->api = new XIVAPI();
        $this->api->environment->key(config('services.xivapi.key'));
    }

    public function character(string $characterId)
    {
        if (Cache::has("xivapi-character-$characterId")) {
            return Cache::get("xivapi-character-$characterId");
        }

        $response = Cache::remember("xivapi-character-$characterId", 60 * 60, function () use ($characterId) {
            return $this->api->character->get($characterId, ['AC'], true);
        });

        return $response;
    }

    public function characterSearch(string $name, string $server)
    {
        if (Cache::has("xivapi-characterSearch-$name-$server")) {
            return Cache::get("xivapi-characterSearch-$name-$server");
        }

        $response = Cache::remember("xivapi-characterSearch-$name-$server", 60 * 60 * 24, function() use ($name, $server) {
            return $this->api->character->search($name, $server);
        });

        return $response;
    }
}
