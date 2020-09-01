<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_get_a_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('categories.show', $category->slug));

        $category = Category::first();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.show');
        $response->assertViewHas('category', $category);
    }

}
