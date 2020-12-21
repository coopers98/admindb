<?php

namespace Tests\Unit;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->profile = factory(Profile::class)->create();
    }

    /** @test */
    public function request_should_fail_when_no_email_is_provided()
    {
        $response = $this->postJson(route('profiles.store'), [
            'first_name' => $this->faker->firstName()
        ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('email', 'error.message');
    }

    //  other tests would be for strings that are too long

    /** @test */
    public function request_should_pass_when_email_is_provided()
    {
        $fakedEmail = $this->faker->email();
        $response   = $this->postJson(route('profiles.store'), [
            'email' => $fakedEmail
        ]);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonPath('data.email', $fakedEmail);
    }

    /** @test */
    public function get_should_return_404_on_nonexistant()
    {
        $response = $this->get(route('profiles.show', [
            'profile' => 0
        ]))
                         ->assertStatus(Response::HTTP_NOT_FOUND);

    }

    /** @test */
    public function get_should_return_object()
    {
        $fakedEmail = $this->faker->email();
        $profile    = Profile::create(['email' => $fakedEmail]);

        $this->get(route('profiles.show', [
            'profile' => $profile->id
        ]))
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonPath('data.email', $fakedEmail);
    }

    /** @test */
    public function get_index_should_return_empty_when_none_available()
    {
        $response = $this->get(route('profiles.index'))
                         ->assertStatus(Response::HTTP_OK);

    }

    /** @test */
    public function get_index_should_return_list_when_available()
    {
        $fakedEmail = $this->faker->email();
        $profile    = Profile::create(['email' => $fakedEmail]);

        $response = $this->get(route('profiles.index'))
                         ->assertStatus(Response::HTTP_OK)
                         ->assertJsonFragment(['email' => $fakedEmail]);

    }

    /** @test */
    public function update_should_work()
    {
        $fakedEmail = $this->faker->email();
        $profile    = Profile::create([
            'first_name' => 'INITIAL FIRST NAME',
            'email'      => $fakedEmail
        ]);

        $newFirstName = $this->faker->firstName();
        $this->put(route('profiles.update', [
            'profile' => $profile->id
        ]), ['first_name' => $newFirstName])
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonFragment(['first_name' => $newFirstName]);

        $updatedProfile = Profile::find($profile->id);
        $this->assertTrue($updatedProfile->first_name === $newFirstName);
    }

    /** @test */
    public function delete_should_work()
    {
        $fakedEmail = $this->faker->email();
        $profile    = Profile::create(['email' => $fakedEmail]);

        $this->delete(route('profiles.destroy', [
            'profile' => $profile->id
        ]))
             ->assertStatus(Response::HTTP_OK);

        //  Additionally ensure the profile is now gone
        $this->assertNull(Profile::find($profile->id));

    }


}
