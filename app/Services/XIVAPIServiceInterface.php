<?php

namespace App\Services;

interface XIVAPIServiceInterface
{
    public function character(string $characterId);
    public function characterSearch(string $name, string $server);
}
