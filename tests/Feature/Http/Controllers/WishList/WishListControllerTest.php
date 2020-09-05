<?php

namespace Tests\Feature\Http\Controllers\WishList;

use App\WishList;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\WishList\WishListController
 */
class WishListControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WishList\WishListController::class,
            'store',
            \App\Http\Requests\WishList\WishListStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->post(route('wish-list.store'), [
            'user_id' =>  $user->id,
        ]);

        $wishLists = WishList::query()
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $wishLists);
        $wishList = $wishLists->first();

        $response->assertRedirect(route('wish-list.show', $wishList));
        $response->assertSessionHas('wishList.id', $wishList->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $wishList = factory(WishList::class)->create();

        $response = $this->get(route('wish-list.show', $wishList));

        $response->assertOk();
        $response->assertViewIs('pages.wish-list.show');
        $response->assertViewHas('wishList');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\WishList\WishListController::class,
            'update',
            \App\Http\Requests\WishList\WishListUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $wishList = factory(WishList::class)->create();
        $user = factory(User::class)->create();

        $response = $this->put(route('wish-list.update', $wishList), [
            'user_id' => $user->id,
        ]);

        $wishList->refresh();

        $response->assertRedirect(route('wish-list.show', $wishList));
        $response->assertSessionHas('wishList.id', $wishList->id);

        $this->assertEquals($user->id, $wishList->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $wishList = factory(WishList::class)->create();

        $response = $this->delete(route('wish-list.destroy', $wishList));

        $response->assertRedirect(route('wish-list.show', $wishList));

        $this->assertDeleted($wishList);
    }
}
