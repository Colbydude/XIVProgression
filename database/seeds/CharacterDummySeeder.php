<?php

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
        factory(App\Character::class, 50)->create();
    }
}
