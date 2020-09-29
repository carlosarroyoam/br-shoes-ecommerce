<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Faker\Generator as Faker;
use Tests\TestCase;

class CreateCategoriesTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions, WithFaker;


    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_create_displays_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin->user);

        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.create');
    }


    /**
     * The store action in the controller uses form request validation.
     *
     * @return void
     */
    public function test_store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\Categories\CategoryController::class,
            'store',
            \Modules\Admin\Http\Requests\Categories\CategoryStoreRequest::class
        );
    }


    /**
     * Store action saves and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_store_saves_and_redirects_for_admin_users()
    {
        $this->withoutExceptionHandling();
        $adminUser = Admin::factory()->create();
        $this->actingAs($adminUser->user);
        $expected = [
            'name' => $this->faker->name,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->post(route('admin.categories.store'), [
            'name' => $expected['name']
        ]);
        $categories = Category::query()
            ->where('name', $expected['name'])
            ->get();
        $category = $categories->first();

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('category.id', $category->id);
        $this->assertDatabaseHas('categories', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
        ]);
    }


    /**
     * Store action doesn't save for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_admin_users()
    {
        $customerUser = Customer::factory()->create();
        $this->actingAs($customerUser->user);

        $response = $this->post(route('admin.categories.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('admin.categories.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
