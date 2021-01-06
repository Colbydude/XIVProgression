<?php

use App\Models\Character;
use Illuminate\Database\Seeder;

class CharacterDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Character::class, 50)->create();
    }
}
