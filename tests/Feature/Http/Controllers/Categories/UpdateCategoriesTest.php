<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
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
        $this->withoutExceptionHandling();

        $user = User::factory()->admin()->make();
        $this->actingAs($user);
        $category = Category::factory()->create();

        $response = $this->get(route('categories.edit', $category));

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
        $this->withoutExceptionHandling();

        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Categories\CategoryController::class,
            'update',
            \App\Http\Requests\Categories\CategoryUpdateRequest::class
        );
    }


    /**
     * Update action updates and redirects to index for an admin user.
     *
     * @return void
     */
    public function test_update_updates_and_redirects_for_admin_users()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->admin()->make();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $expected = [
            'name' => $this->faker->name,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->put(route('categories.update', $category), [
            'name' => $expected['name']
        ]);
        $categories = Category::query()
            ->where('name', $expected['name'])
            ->get();
        $category = $categories->first();


        $response->assertRedirect(route('categories.index'));
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
        $user = User::factory()->make();
        $this->actingAs($user);
        $category = Category::factory()->create();

        $response = $this->put(route('categories.update', $category), []);

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

        $response = $this->put(route('categories.update', $category), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * On the update action, the attribute name of a category cannot be empty or null.
     *
     * @return void
     */
    public function test_a_category_name_should_not_be_empty_or_null()
    {
        $user = User::factory()->admin()->make();
        $this->actingAs($user);
        $category = Category::factory()->create();

        $response = $this->put(route('categories.update', $category), [
            'name' => ''
        ]);

        $response->assertSessionHasErrors(['name']);
    }
}
