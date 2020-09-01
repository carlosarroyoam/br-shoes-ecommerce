<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAListOfCategoriesCanBeRetrieved()
    {
        factory(Category::class, 5)->create();
        $categories = Category::all();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.index');
        $response->assertViewHas('categories', $categories);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testACategoryCanBeRetrieved()
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('categories.show', $category->slug));

        $category = Category::first();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.show');
        $response->assertViewHas('category', $category);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testATagCanBeCreated()
    {
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->states('admin')->make();

        $response = $this->actingAs($user)
            ->postJson(route('categories.store'), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('categories', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testATagNameShouldNotBeEmpty()
    {
        $expected = [
            'name' => '',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->states('admin')->make();

        $response = $this->actingAs($user)
            ->postJson(route('categories.store'), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['name']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testACategoryCanOnlyBeCreatedByAdmins()
    {
        $expected = [
            'name' => 'Sneaker Snake',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)
            ->postJson(route('categories.store'), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testATagCanBeUpdated()
    {
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->states('admin')->make();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)
            ->putJson(route('categories.update', $category), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('categories', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testACategoryCanOnlyBeUpdatedByAdmins()
    {
        $expected = [
            'name' => 'Sneaker Snake',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->make();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)
            ->putJson(route('categories.update', $category), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testATagCanBeDeleted()
    {
        $user = factory(User::class)->states('admin')->make();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->deleteJson(route('categories.destroy', $category->slug));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDeleted('categories', [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testACategoryCanOnlyBeDeletedByAdmins()
    {
        $user = factory(User::class)->make();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->deleteJson(route('categories.destroy', $category->slug));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
