<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\UserContactDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Users\UserContactDetailController
 */
class UserContactDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $userContactDetails = factory(UserContactDetail::class, 3)->create();

        $response = $this->get(route('user-contact-detail.index'));

        $response->assertOk();
        $response->assertViewIs('userContactDetail.index');
        $response->assertViewHas('userContactDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-contact-detail.create'));

        $response->assertOk();
        $response->assertViewIs('userContactDetail.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserContactDetailController::class,
            'store',
            \App\Http\Requests\Users\UserContactDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user_id = $this->faker->randomNumber();
        $phone_number = $this->faker->phoneNumber;

        $response = $this->post(route('user-contact-detail.store'), [
            'user_id' => $user_id,
            'phone_number' => $phone_number,
        ]);

        $userContactDetails = UserContactDetail::query()
            ->where('user_id', $user_id)
            ->where('phone_number', $phone_number)
            ->get();
        $this->assertCount(1, $userContactDetails);
        $userContactDetail = $userContactDetails->first();

        $response->assertRedirect(route('userContactDetail.index'));
        $response->assertSessionHas('userContactDetail.id', $userContactDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();

        $response = $this->get(route('user-contact-detail.show', $userContactDetail));

        $response->assertOk();
        $response->assertViewIs('userContactDetail.show');
        $response->assertViewHas('userContactDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();

        $response = $this->get(route('user-contact-detail.edit', $userContactDetail));

        $response->assertOk();
        $response->assertViewIs('userContactDetail.edit');
        $response->assertViewHas('userContactDetail');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserContactDetailController::class,
            'update',
            \App\Http\Requests\Users\UserContactDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();
        $user_id = $this->faker->randomNumber();
        $phone_number = $this->faker->phoneNumber;

        $response = $this->put(route('user-contact-detail.update', $userContactDetail), [
            'user_id' => $user_id,
            'phone_number' => $phone_number,
        ]);

        $userContactDetail->refresh();

        $response->assertRedirect(route('userContactDetail.index'));
        $response->assertSessionHas('userContactDetail.id', $userContactDetail->id);

        $this->assertEquals($user_id, $userContactDetail->user_id);
        $this->assertEquals($phone_number, $userContactDetail->phone_number);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();

        $response = $this->delete(route('user-contact-detail.destroy', $userContactDetail));

        $response->assertRedirect(route('userContactDetail.index'));

        $this->assertDeleted($userContactDetail);
    }
}
