<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Destroy action deletes and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_destroy_deletes_and_redirects_for_admin_users()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $category = Category::factory()->create();

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
        $customer = Customer::factory()->create();
        $this->actingAs($customer->user);
        $category = Category::factory()->create();

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
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
