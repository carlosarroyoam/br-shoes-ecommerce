<?php

namespace Tests\Feature\Http\Controllers\ShoppingBag;

use App\ShoppingBag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ShoppingBag\ShoppingBagController
 */
class ShoppingBagControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShoppingBag\ShoppingBagController::class,
            'store',
            \App\Http\Requests\ShoppingBag\ShoppingBagStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('shopping-bag.store'), [
            'user_id' => $user->id,
        ]);

        $shoppingBags = ShoppingBag::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $shoppingBags);
        $shoppingBag = $shoppingBags->first();

        $response->assertRedirect(route('shopping-bag.show', $shoppingBag));
        $response->assertSessionHas('shoppingBag.id', $shoppingBag->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $shoppingBag = factory(ShoppingBag::class)->create();

        $response = $this->get(route('shopping-bag.show', $shoppingBag));

        $response->assertOk();
        $response->assertViewIs('pages.shopping-bag.show', $shoppingBag);
        $response->assertViewHas('shoppingBag');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ShoppingBag\ShoppingBagController::class,
            'update',
            \App\Http\Requests\ShoppingBag\ShoppingBagUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $shoppingBag = factory(ShoppingBag::class)->create();
        $user = factory(User::class)->create();

        $response = $this->put(route('shopping-bag.update', $shoppingBag), [
            'user_id' => $user->id,
        ]);

        $shoppingBag->refresh();

        $response->assertRedirect(route('shopping-bag.show', $shoppingBag));
        $response->assertSessionHas('shoppingBag.id', $shoppingBag->id);

        $this->assertEquals($user->id, $shoppingBag->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $shoppingBag = factory(ShoppingBag::class)->create();

        $response = $this->delete(route('shopping-bag.destroy', $shoppingBag));

        $response->assertRedirect(route('shopping-bag.show', $shoppingBag));

        $this->assertDeleted($shoppingBag);
    }
}
