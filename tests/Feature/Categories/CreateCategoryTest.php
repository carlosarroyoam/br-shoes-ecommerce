<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_admin_can_create_categories()
    {
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $expected = [
            'name' => 'Snake Sneakers',
            'slug' => 'snake-sneakers'
        ];

        $response = $this->postJson(route('categories.store'), [
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
    public function test_a_user_can_not_create_categories()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $expected = [
            'name' => 'Sneaker Snake',
            'slug' => 'snake-sneakers'
        ];

        $response = $this->postJson(route('categories.store'), [
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
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $expected = [
            'name' => '',
            'slug' => 'snake-sneakers'
        ];

        $response = $this->postJson(route('categories.store'), [
            'name' => $expected['name']
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['name']);
    }

}
