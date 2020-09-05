<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\User;
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
        $this->withoutExceptionHandling();

        $userContactDetails = factory(UserContactDetail::class, 3)->create();

        $response = $this->get(route('user-contact-details.index'));

        $response->assertOk();
        $response->assertViewIs('pages.users.contact-details.index');
        $response->assertViewHas('userContactDetails');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-contact-details.create'));

        $response->assertOk();
        $response->assertViewIs('pages.users.contact-details.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserContactDetailController::class,
            'store',
            \App\Http\Requests\Users\ContactDetails\UserContactDetailStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $phone_number = '4131092978';

        $response = $this->post(route('user-contact-details.store'), [
            'user_id' => $user->id,
            'phone_number' => $phone_number,
        ]);

        $userContactDetails = UserContactDetail::query()
            ->where('user_id', $user->id)
            ->where('phone_number', $phone_number)
            ->get();
        $this->assertCount(1, $userContactDetails);
        $userContactDetail = $userContactDetails->first();

        $response->assertRedirect(route('user-contact-details.index'));
        $response->assertSessionHas('userContactDetail.id', $userContactDetail->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();

        $response = $this->get(route('user-contact-details.show', $userContactDetail));

        $response->assertOk();
        $response->assertViewIs('pages.users.contact-details.show');
        $response->assertViewHas('userContactDetail');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();

        $response = $this->get(route('user-contact-details.edit', $userContactDetail));

        $response->assertOk();
        $response->assertViewIs('pages.users.contact-details.edit');
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
            \App\Http\Requests\Users\ContactDetails\UserContactDetailUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();
        $newPhoneNumber = '4131092978';

        $response = $this->put(route('user-contact-details.update', $userContactDetail), [
            'phone_number' => $newPhoneNumber,
        ]);

        $userContactDetail->refresh();

        $response->assertRedirect(route('user-contact-details.index'));
        $response->assertSessionHas('userContactDetail.id', $userContactDetail->id);

        $this->assertEquals($newPhoneNumber, $userContactDetail->phone_number);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userContactDetail = factory(UserContactDetail::class)->create();

        $response = $this->delete(route('user-contact-details.destroy', $userContactDetail));

        $response->assertRedirect(route('user-contact-details.index'));

        $this->assertDeleted($userContactDetail);
    }
}
