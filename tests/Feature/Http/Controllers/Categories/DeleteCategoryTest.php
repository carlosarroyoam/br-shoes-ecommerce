<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * An admin can delete categories.
     *
     * @return void
     */
    public function test_an_admin_can_delete_categories()
    {
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $this->assertDeleted('categories', [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
        ]);
    }

    /**
     * An authenticated non-admin user cannot delete categories.
     *
     * @return void
     */
    public function test_a_user_cannot_delete_categories()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('categories.destroy', $category));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * An unauthenticated user cannot delete categories.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_cannot_delete_categories()
    {
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('categories.destroy', $category));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
