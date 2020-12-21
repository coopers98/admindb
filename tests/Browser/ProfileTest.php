<?php

namespace Tests\Browser;

use App\Http\Controllers\ProfileController;
use App\Http\Requests\Profile\CreateProfileRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileTest extends DuskTestCase
{
    use WithFaker;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpFaker();
    }
}
