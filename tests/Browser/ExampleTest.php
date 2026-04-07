<?php

namespace Tests\Browser;

use Galaxy\GalaxyTests\Tests\GalaxyDuskTestCase;
use Laravel\Dusk\Browser;

class ExampleTest extends GalaxyDuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }
}
