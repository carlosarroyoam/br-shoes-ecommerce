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
     * An user can retrieve a specified category.
     *
     * @return void
     */
    public function test_an_user_can_get_a_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('categories.show', $category->slug));

        $category = Category::first();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.show');
        $response->assertViewHas('category', $category);
    }

    /**
     * An user cannot retrieve a specified category if the category doesn't exist.
     *
     * @return void
     */
    public function test_an_user_cannot_get_a_category_if_doesnt_exists()
    {
        $nonExistingSlug = 'snake-sneaker';

        $response = $this->get(route('categories.show', $nonExistingSlug));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
