<?php

namespace Tests\Feature;

use Tests\TestCase;

class BuildTest extends TestCase
{
    /**
     * A basic smoke test to ensure that the site builds and deploys.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/progression');

        $response->assertStatus(200);
    }
}
