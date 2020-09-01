<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;
a
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_admin_can_delete_categories()
    {
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('categories.destroy', $category));

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
    public function test_a_user_can_not_delete_categories()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user);
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('categories.destroy', $category));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
