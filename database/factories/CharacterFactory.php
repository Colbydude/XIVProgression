<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    private $testServers = [
        'Valefor',
        'Ifrit',
        'Ixion',
        'Shiva',
        'Bahamut',
        'Yojimbo',
        'Anima'
    ];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lodestone_id' => $this->faker->randomNumber(),
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'server' => $this->faker->randomElement($this->testServers)
        ];
    }
}
