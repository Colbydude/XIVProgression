<?php

namespace Tests\Feature;

use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgressionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function fetches_character_info_and_stores_character()
    {
        $response = $this->get('/api/fetch?name=Enyl+Noves&server=Leviathan');

        $response->assertStatus(200);

        $decoded = $response->decodeResponseJson();
        $this->assertEquals('2249861', $decoded['Character']['ID']);
        $this->assertEquals('Enyl Noves', $decoded['Character']['Name']);
        $this->assertEquals('Leviathan', $decoded['Character']['Server']);

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

        Character::factory()->make([
            'lodestone_id' => '4106410',
            'name' => 'Marin Valde',
            'server' => 'Leviathan'
        ]);

        $response = $this->get('/api/fetch?name=Marin+Valde&server=Leviathan');

        $response->assertStatus(200);

        $decoded = $response->decodeResponseJson();
        $this->assertEquals('4106410', $decoded['Character']['ID']);
        $this->assertEquals('Marin Valde', $decoded['Character']['Name']);
        $this->assertEquals('Leviathan', $decoded['Character']['Server']);

        $this->assertEquals(Character::count(), 1);
    }

    /** @test */
    public function throws_not_found_for_non_existant_character()
    {
        $response = $this->get('/api/fetch?name=Someguythatwont+Everexistever&server=Balmung');
        $response->assertStatus(404);
    }
}
