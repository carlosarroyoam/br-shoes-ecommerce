<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use JMac\Testing\Traits\AdditionalAssertions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
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

        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->get(route('categories.edit', $category));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.edit');
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

        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();
        $expected = [
            'name' => $this->faker->name,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->put(route('categories.update', $category), [
            'name' => $expected['name']
        ]);

        $response->assertRedirect(route('categories.index'));
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
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

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
        $category = factory(Category::class)->create();

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
        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->put(route('categories.update', $category), [
            'name' => ''
        ]);

        $response->assertSessionHasErrors(['name']);
    }
}
