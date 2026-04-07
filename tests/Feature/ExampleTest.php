<?php

namespace Tests\Feature;

use Galaxy\GalaxyTests\Tests\Unit\GalaxyTestCase;

class ExampleTest extends GalaxyTestCase
{
    /**
     * A basic test example.
     */
    public function testBasicTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
