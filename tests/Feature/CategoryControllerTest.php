<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRetrievesListOfCategories()
    {
        $this->withoutExceptionHandling();

        factory(Category::class, 5)->create();
        $categories = Category::all();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.categories.index');
        $response->assertViewHas('categories', $categories);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRetrievesACategory()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $response = $this->get(route('categories.show', $category->slug));

        $category = Category::first();

        $response->assertStatus(200);
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
        $this->withoutExceptionHandling();

        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->states('admin')->make();

        $response = $this->actingAs($user)
            ->postJson(route('categories.store'), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(200);
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
    public function testATagCanBeUpdated()
    {
        $this->withoutExceptionHandling();

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

        $response->assertStatus(200);
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
    public function testATagCanBeDeleted()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->states('admin')->make();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->deleteJson(route('categories.destroy', $category->slug));

        $response->assertStatus(200);
        $this->assertDeleted('categories', [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
        ]);
    }

}
