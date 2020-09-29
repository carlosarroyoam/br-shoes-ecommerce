<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCategoriesTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_edit_displays_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $category = Category::factory()->create();

        $response = $this->get(route('admin.categories.edit', $category));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.edit');
        $response->assertViewHas('category', $category);
    }


    /**
     * The update action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Categories\CategoryController::class,
            'update',
            \Modules\Admin\Http\Requests\Categories\CategoryUpdateRequest::class
        );
    }


    /**
     * Update action updates and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_update_updates_and_redirects_for_admin_users()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);
        $category = Category::factory()->create();
        $expected = [
            'name' => $this->faker->name,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->put(route('admin.categories.update', $category), [
            'name' => $expected['name']
        ]);
        $category->fresh();

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('category.id', $category->id);
        $this->assertDatabaseHas('categories', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
        ]);
    }

    /**
     * Update action doesn't updates for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_udpate_doesnt_updates_for_non_admin_users()
    {
        $customerUser = Customer::factory()->create();
        $this->actingAs($customerUser->user);
        $category = Category::factory()->create();

        $response = $this->put(route('admin.categories.update', $category), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update action doesn't updates for an unauthenticated user.
     *
     * @return void
     */
    public function test_update_doesnt_updates_for_non_authenticated_users()
    {
        $category = Category::factory()->create();

        $response = $this->put(route('admin.categories.update', $category), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
