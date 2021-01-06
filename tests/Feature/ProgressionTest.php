<?php

namespace Tests\Feature;

use App\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function fetches_character_info_and_store_character()
    {
        $response = $this->get('/api/fetch?name=Enyl+Noves&server=Leviathan');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'lodestone_id' => '2249861',
            'name' => 'Enyl Noves',
            'server' => 'Leviathan'
        ]);

        $this->assertEquals(1, Character::count());

        $character = Character::first();
        $this->assertEquals('2249861', $character->lodestone_id);
        $this->assertEquals('Enyl Noves', $character->name);
        $this->assertEquals('Leviathan', $character->server);
    }

    /** @test */
    public function fetches_character_info_for_stored_character()
    {
        $this->assertEquals(Character::count(), 0);

        $character = factory(Character::class)->create([
            'lodestone_id' => '4106410',
            'name' => 'Marin Valde',
            'server' => 'Leviathan'
        ]);

        $response = $this->get('/api/fetch?name=Marin+Valde&server=Leviathan');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'lodestone_id' => '4106410',
            'name' => 'Marin Valde',
            'server' => 'Leviathan'
        ]);

        $this->assertEquals(Character::count(), 1);
    }

    /** @test */
    public function throws_not_found_for_non_existant_character()
    {
        $response = $this->get('/api/fetch?name=Someguythatwont+Everexistever&server=Balmung');
        $response->assertStatus(404);
    }
}
