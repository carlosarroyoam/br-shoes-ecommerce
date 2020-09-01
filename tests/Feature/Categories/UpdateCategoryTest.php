<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_admin_can_update_categories()
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
    public function test_a_user_can_not_update_categories()
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
    public function test_a_category_name_should_not_be_empty()
    {
        $expected = [
            'name' => '',
            'slug' => 'snake-sneakers'
        ];

        $user = factory(User::class)->states('admin')->make();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)
            ->putJson(route('categories.update', $category), [
                'name' => $expected['name']
            ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['name']);
    }

}
