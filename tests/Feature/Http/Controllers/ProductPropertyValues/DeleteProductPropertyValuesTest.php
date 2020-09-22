<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\ProductPropertyValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteProductPropertyValuesTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Destroy action deletes and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_destroy_deletes_and_redirects_for_admin_users()
    {
        $this->withoutExceptionHandling();
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $productPropertyValue = ProductPropertyValue::factory()->create();

        $response = $this->delete(route('product-property-values.destroy', $productPropertyValue));

        $response->assertRedirect(route('product-property-values.index'));
        $this->assertDeleted($productPropertyValue);
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
        $productPropertyValue = ProductPropertyValue::factory()->create();

        $response = $this->delete(route('product-property-values.destroy', $productPropertyValue));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Destroy action doesn't deletes for an unauthenticated user.
     *
     * @return void
     */
    public function test_destroy_dont_deletes_for_non_authenticated_users()
    {
        $productPropertyValue = ProductPropertyValue::factory()->create();

        $response = $this->delete(route('product-property-values.destroy', $productPropertyValue));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
