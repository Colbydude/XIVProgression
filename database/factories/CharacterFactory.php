<?php

use App\Models\Character;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$testServers = [
    'Valefor',
    'Ifrit',
    'Ixion',
    'Shiva',
    'Bahamut',
    'Yojimbo',
    'Anima'
];

$factory->define(Character::class, function (Faker $faker) use ($testServers) {
    return [
        'lodestone_id' => $faker->randomNumber(),
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'server' => $testServers[array_rand($testServers)]
    ];
});
