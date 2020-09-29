<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductProperty;
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
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $productProperty = ProductProperty::factory()->create();

        $response = $this->delete(route('admin.product-properties.destroy', $productProperty));

        $response->assertRedirect(route('admin.product-properties.index'));
        $this->assertDeleted($productProperty);
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
        $productProperty = ProductProperty::factory()->create();

        $response = $this->delete(route('admin.product-properties.destroy', $productProperty));

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

        $response = $this->delete(route('admin.product-properties.destroy', $productProperty));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
