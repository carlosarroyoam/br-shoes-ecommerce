<?php

namespace Tests\Feature;

use App\Models\ProductProperty;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteProductPropertiesTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Destroy action deletes and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_destroy_deletes_and_redirects_for_admin_users()
    {
        $user = User::factory()->admin()->make();
        $this->actingAs($user);
        $productProperty = ProductProperty::factory()->create();

        $response = $this->delete(route('product-properties.destroy', $productProperty));

        $response->assertRedirect(route('product-properties.index'));
        $this->assertDeleted($productProperty);
    }


    /**
     * Destroy action doesn't delete for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_admin_users()
    {
        $user = User::factory()->make();
        $this->actingAs($user);
        $productProperty = ProductProperty::factory()->create();

        $response = $this->delete(route('product-properties.destroy', $productProperty));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Destroy action doesn't deletes for an unauthenticated user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_authenticated_users()
    {
        $productProperty = ProductProperty::factory()->create();

        $response = $this->delete(route('product-properties.destroy', $productProperty));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
