<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\User;
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

        $response = $this->get(route('user-shipping-addresses.index'));

        $response->assertOk();
        $response->assertViewIs('pages.users.shipping-addresses.index');
        $response->assertViewHas('userShippingAddresses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-shipping-addresses.create'));

        $response->assertOk();
        $response->assertViewIs('pages.users.shipping-addresses.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserShippingAddressController::class,
            'store',
            \App\Http\Requests\Users\ShippingAddresses\UserShippingAddressStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();
        $address = $this->faker->word;
        $city = $this->faker->city;
        $state = $this->faker->word;
        $zip_code = $this->faker->randomNumber();
        $country = $this->faker->country;

        $response = $this->post(route('user-shipping-addresses.store'), [
            'user_id' => $user->id,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'country' => $country,
        ]);

        $userShippingAddresses = UserShippingAddress::query()
            ->where('user_id', $user->id)
            ->where('address', $address)
            ->where('city', $city)
            ->where('state', $state)
            ->where('zip_code', $zip_code)
            ->where('country', $country)
            ->get();
        $this->assertCount(1, $userShippingAddresses);
        $userShippingAddress = $userShippingAddresses->first();

        $response->assertRedirect(route('user-shipping-addresses.index'));
        $response->assertSessionHas('userShippingAddress.id', $userShippingAddress->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userShippingAddress = factory(UserShippingAddress::class)->create();

        $response = $this->get(route('user-shipping-addresses.show', $userShippingAddress));

        $response->assertOk();
        $response->assertViewIs('pages.users.shipping-addresses.show');
        $response->assertViewHas('userShippingAddress');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userShippingAddress = factory(UserShippingAddress::class)->create();

        $response = $this->get(route('user-shipping-addresses.edit', $userShippingAddress));

        $response->assertOk();
        $response->assertViewIs('pages.users.shipping-addresses.edit');
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
            \App\Http\Requests\Users\ShippingAddresses\UserShippingAddressUpdateRequest::class
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

        $response = $this->put(route('user-shipping-addresses.update', $userShippingAddress), [
            'user_id' => $user_id,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code,
            'country' => $country,
        ]);

        $userShippingAddress->refresh();

        $response->assertRedirect(route('user-shipping-addresses.index'));
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

        $response = $this->delete(route('user-shipping-addresses.destroy', $userShippingAddress));

        $response->assertRedirect(route('user-shipping-addresses.index'));

        $this->assertDeleted($userShippingAddress);
    }
}
