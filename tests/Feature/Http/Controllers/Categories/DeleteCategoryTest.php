<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions;

    /**
     * Destroy action deletes and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_destroy_deletes_and_redirects_for_admin_users()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $this->assertDeleted($category);
    }

    /**
     * Destroy action doesn't delete for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_admin_users()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Destroy action doesn't deletes for an unauthenticated user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_authenticated_users()
    {
        $category = factory(Category::class)->create();

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
