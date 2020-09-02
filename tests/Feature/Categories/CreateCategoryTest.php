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
     * An admin can create categories.
     *
     * @return void
     */
    public function test_an_admin_can_create_categories()
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

        $response->assertRedirect(route('categories.show', $expected['slug']));
        $this->assertDatabaseHas('categories', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
        ]);
    }

    /**
     * An authenticated non-admin user cannot create categories.
     *
     * @return void
     */
    public function test_a_user_cannot_create_categories()
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
     * An unauthenticated user cannot create categories.
     *
     * @return void
     */
    public function test_an_unauthenticated_user_cannot_create_categories()
    {
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
     * The attribute name of a category cannot be empty.
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
