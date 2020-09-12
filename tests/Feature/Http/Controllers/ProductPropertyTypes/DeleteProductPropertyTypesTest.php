<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductPropertyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteProductPropertyTypesTest extends TestCase
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
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->delete(route('product-property-types.destroy', $productPropertyType));

        $response->assertRedirect(route('product-property-types.index'));
        $this->assertDeleted($productPropertyType);
    }


    /**
     * Destroy action doesn't delete for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_admin_users()
    {
        $customerUser = Customer::factory()->create();
        $this->actingAs($customerUser->user);
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->delete(route('product-property-types.destroy', $productPropertyType));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Destroy action doesn't deletes for an unauthenticated user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_authenticated_users()
    {
        $productPropertyType = ProductPropertyType::factory()->create();

        $response = $this->delete(route('product-property-types.destroy', $productPropertyType));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
