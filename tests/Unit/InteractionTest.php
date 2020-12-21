<?php

namespace Tests\Unit;

use App\Models\Interaction;
use App\Models\InteractionOutcome;
use App\Models\InteractionType;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class InteractionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->profile = factory(Profile::class)->create();
    }

    /** @test */
    public function request_should_fail_when_required_field_is_missing()
    {
        $response = $this->postJson(route('interactions.store'), [
            'type' => InteractionType::IN_PERSON
        ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('outcome', 'error.message');
    }

    //  other tests would be for strings that are too long

    /** @test */
    public function request_should_pass_when_required_fields_are_provided()
    {
        //  Need a valid profile
        $profile = Profile::create(['email' => $this->faker->email()]);

        $response = $this->postJson(route('interactions.store'), [
            'type'                  => InteractionType::IN_PERSON,
            'outcome'               => InteractionOutcome::CONTACTED,
            'interaction_timestamp' => $this->faker->date(),
            'profile_id'            => $profile->id
        ]);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonPath('data.profile_id', $profile->id);
    }

    /** @test */
    public function get_should_return_404_on_nonexistant()
    {
        $response = $this->get(route('interactions.show', [
            'interaction' => 0
        ]))
                         ->assertStatus(Response::HTTP_NOT_FOUND);

    }

    /** @test */
    public function get_should_return_object()
    {
        $fakedEmail = $this->faker->email();
        $profile    = Profile::create(['email' => $fakedEmail]);

        $interaction = Interaction::create([
            'type'                  => InteractionType::IN_PERSON,
            'outcome'               => InteractionOutcome::CONTACTED,
            'interaction_timestamp' => $this->faker->date(),
            'profile_id'            => $profile->id
        ]);

        $this->get(route('interactions.show', [
            'interaction' => $profile->id
        ]))
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonPath('data.profile_id', $profile->id);
    }

    //  Removing the following 2 as requirements did not state index needs
    public function get_index_should_return_empty_when_none_available()
    {
        $this->get(route('interactions.index'))
             ->assertStatus(Response::HTTP_OK);

    }

    public function get_index_should_return_list_when_available()
    {
        $fakedEmail = $this->faker->email();
        $profile    = Profile::create(['email' => $fakedEmail]);

        $interaction = Interaction::create([
            'type'                  => InteractionType::IN_PERSON,
            'outcome'               => InteractionOutcome::CONTACTED,
            'interaction_timestamp' => $this->faker->date(),
            'profile_id'            => $profile->id
        ]);

        $this->get(route('interactions.index'))
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonFragment(['profile_id' => $profile->id]);

    }
}
