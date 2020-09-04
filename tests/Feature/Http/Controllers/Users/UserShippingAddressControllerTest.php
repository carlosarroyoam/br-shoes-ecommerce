<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\UserShippingAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Users\UserShippingAddressController
 */
class UserShippingAddressControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $userShippingAddresses = factory(UserShippingAddress::class, 3)->create();

        $response = $this->get(route('user-shipping-address.index'));

        $response->assertOk();
        $response->assertViewIs('userShippingAddress.index');
        $response->assertViewHas('userShippingAddresses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-shipping-address.create'));

        $response->assertOk();
        $response->assertViewIs('userShippingAddress.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserShippingAddressController::class,
            'store',
            \App\Http\Requests\Users\UserShippingAddressStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user_id = $this->faker->randomNumber();
        $address = $this->faker->word;
        $city = $this->faker->city;
        $state = $this->faker->word;
        $zip_code = $this->faker->randomNumber();
        $country = $this->faker->country;

        $response = $this->post(route('user-shipping-address.store'), [
            'user_id' => $user_id,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'country' => $country,
        ]);

        $userShippingAddresses = UserShippingAddress::query()
            ->where('user_id', $user_id)
            ->where('address', $address)
            ->where('city', $city)
            ->where('state', $state)
            ->where('zip_code', $zip_code)
            ->where('country', $country)
            ->get();
        $this->assertCount(1, $userShippingAddresses);
        $userShippingAddress = $userShippingAddresses->first();

        $response->assertRedirect(route('userShippingAddress.index'));
        $response->assertSessionHas('userShippingAddress.id', $userShippingAddress->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userShippingAddress = factory(UserShippingAddress::class)->create();

        $response = $this->get(route('user-shipping-address.show', $userShippingAddress));

        $response->assertOk();
        $response->assertViewIs('userShippingAddress.show');
        $response->assertViewHas('userShippingAddress');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userShippingAddress = factory(UserShippingAddress::class)->create();

        $response = $this->get(route('user-shipping-address.edit', $userShippingAddress));

        $response->assertOk();
        $response->assertViewIs('userShippingAddress.edit');
        $response->assertViewHas('userShippingAddress');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserShippingAddressController::class,
            'update',
            \App\Http\Requests\Users\UserShippingAddressUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userShippingAddress = factory(UserShippingAddress::class)->create();
        $user_id = $this->faker->randomNumber();
        $address = $this->faker->word;
        $city = $this->faker->city;
        $state = $this->faker->word;
        $zip_code = $this->faker->randomNumber();
        $country = $this->faker->country;

        $response = $this->put(route('user-shipping-address.update', $userShippingAddress), [
            'user_id' => $user_id,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'country' => $country,
        ]);

        $userShippingAddress->refresh();

        $response->assertRedirect(route('userShippingAddress.index'));
        $response->assertSessionHas('userShippingAddress.id', $userShippingAddress->id);

        $this->assertEquals($user_id, $userShippingAddress->user_id);
        $this->assertEquals($address, $userShippingAddress->address);
        $this->assertEquals($city, $userShippingAddress->city);
        $this->assertEquals($state, $userShippingAddress->state);
        $this->assertEquals($zip_code, $userShippingAddress->zip_code);
        $this->assertEquals($country, $userShippingAddress->country);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userShippingAddress = factory(UserShippingAddress::class)->create();

        $response = $this->delete(route('user-shipping-address.destroy', $userShippingAddress));

        $response->assertRedirect(route('userShippingAddress.index'));

        $this->assertDeleted($userShippingAddress);
    }
}
