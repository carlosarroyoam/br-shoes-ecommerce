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

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase, AdditionalAssertions, WithFaker;


    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_create_displays_view()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);

        $response = $this->get(route('categories.create'));

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
        $this->withoutExceptionHandling();

        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Categories\CategoryController::class,
            'store',
            \App\Http\Requests\Categories\CategoryStoreRequest::class
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

        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);
        $expected = [
            'name' => $this->faker->name,
        ];
        $expected['slug'] = Str::slug($expected['name']);

        $response = $this->post(route('categories.store'), [
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
     * Store action doesn't save for an authenticated non-admin user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_admin_users()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post(route('categories.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * Store action doesn't save for an unauthenticated user.
     *
     * @return void
     */
    public function test_store_doesnt_saves_for_non_authenticated_users()
    {
        $response = $this->post(route('categories.store'), []);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    /**
     * On the store action, the attribute name of a category cannot be empty or null.
     *
     * @return void
     */
    public function test_a_category_name_should_not_be_empty_or_null()
    {
        $user = factory(User::class)->states('is_admin')->create();
        $this->actingAs($user);

        $response = $this->post(route('categories.store'), [
            'name' => ''
        ]);

        $response->assertSessionHasErrors(['name']);
    }
}
